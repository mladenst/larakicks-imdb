<?php

namespace App\Http\Controllers\Auth;

use Dinkara\DinkoApi\Http\Controllers\ApiController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\User\UserAttachSocialNetworkRequest;
use Illuminate\Cache\RateLimiter;
use Illuminate\Database\QueryException;
use App\Http\Requests\User\StoreUserRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Repositories\User\IUserRepo;
use App\Repositories\Profile\IProfileRepo;
use App\Repositories\SocialNetwork\ISocialNetworkRepo;
use App\Repositories\UserSession\IUserSessionRepo;
use App\Repositories\Role\IRoleRepo;
use App\Support\Enum\UserStatuses;
use App\Support\Enum\RoleTypes;
use App\Support\Enum\SocialNetworks;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpFoundation\Response;
use Socialite;
use Lang;
use ApiResponse;
use Location;
use Carbon\Carbon;

/**
 * @resource Auth
 */
class AuthController extends ApiController
{
    use AuthenticatesUsers;
    
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(IUserRepo $userRepo, IProfileRepo $profileRepo, IRoleRepo $roleRepo, IUserSessionRepo $userSessionRepo, ISocialNetworkRepo $socialNetworkRepo)
    {
        $this->userRepo = $userRepo;
        $this->profileRepo = $profileRepo;
        $this->roleRepo = $roleRepo;
        $this->socialNetworkRepo = $socialNetworkRepo;
        $this->userSessionRepo = $userSessionRepo;
        $this->agent = new Agent();
    }

    /**
     * Login
     *
     * Returns unique user token
     * @param LoginRequest $request
     * @return type
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only("email", "password");

        if ($this->hasTooManyLoginAttempts($request)) {
            $seconds = app(RateLimiter::class)->availableIn(
                $this->throttleKey($request)
            );
            return ApiResponse::Unauthorized(Lang::get('auth.throttle', ['seconds' => $seconds]))->setStatusCode(Response::HTTP_TOO_MANY_REQUESTS);
        }

        try {
            $this->invalidateJWTToken();
            // Attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                $this->incrementLoginAttempts($request);
                return ApiResponse::Unauthorized(Lang::get('auth.failed'));
            }
        } catch (JWTException $e) {
            // Something went wrong whilst attempting to encode the token
            $this->incrementLoginAttempts($request);
            return ApiResponse::InternalError();
        }

        $user = JWTAuth::toUser($token);

        if ($user->status == UserStatuses::_UNCONFIRMED) {
            return ApiResponse::Unauthorized(Lang::get('auth.confirm_email'));
        }

        if ($user->status == UserStatuses::_BANNED) {
            return ApiResponse::Forbidden(Lang::get('auth.banned'));
        }

        if ($user->status == UserStatuses::_DELETED) {
            return ApiResponse::Forbidden(Lang::get('auth.deleted'));
        }

        if ($user->passwordReset) {
            return ApiResponse::Unauthorized(Lang::get('passwords.reset_password_requested'));
        }

        $this->storeUserSession($request, $user);
        return ApiResponse::Token(compact('token'));
    }
    
    /**
     * Facebook Auth
     *
     * Login user via Facebook
     * @param UserAttachSocialNetworkRequest $request
     * @return type
     */
    public function facebookAuth(UserAttachSocialNetworkRequest $request)
    {
        $token = $request->get(array_keys($request->rules())[0]);
        
        return $this->socialLogin($token, SocialNetworks::FACEBOOK, $request);
    }
    
    /**
     * Google Auth
     *
     * Login user via Google
     * @param UserAttachSocialNetworkRequest $request
     * @return type
     */
    public function googleAuth(UserAttachSocialNetworkRequest $request)
    {
        $token = $request->get(array_keys($request->rules())[0]);
        
        return $this->socialLogin($token, SocialNetworks::GOOGLE, $request);
    }
    
    private function socialLogin($token, $network, $request)
    {
        try {
            $user = Socialite::driver($network)->stateless()->user();
        } catch (\Exception $e) {
            return ApiResponse::Unauthorized(Lang::get('auth.invalid_access_token'));
        }
                
        try {
            $socialData = ["access_token" => $user->token, "provider_id" => $user->id];
            
            $userFacebook = $this->socialNetworkRepo->findBySocialId($user->id, $network);
            
            if (!$this->userRepo->findByEmail($user->email) && !$userFacebook) {
                $register = ["email" => $user->email];
                
                $this->userRepo->register($register, false)
                                ->activate()
                                ->attachRole($this->roleRepo->findByName(RoleTypes::USER)->getModel())
                                ->attachSocialNetwork($this->socialNetworkRepo->findByName($network)->getModel(), $socialData);
                
                $profileData = ["user_id" => $this->userRepo->getModel()->id, "name" => $user->name];
                $this->profileRepo->create($profileData);
                $userFacebook = $this->socialNetworkRepo->findBySocialId($user->id, $network);
            }
            
            if (!$userFacebook) {
                $this->userRepo->attachSocialNetwork($this->socialNetworkRepo->findByName($network)->getModel(), $socialData);
            } else {
                //refresh Facebook access token
                //todo Refactor
                $userFacebook->getModel()->pivot->update($socialData);
            }

            $token = JWTAuth::fromUser($this->userRepo->getModel());
            $this->storeUserSession($request, $this->userRepo->getModel());
            return ApiResponse::Token(compact('token'));
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
    }

    /**
     * Logout
     *
     * Logout user with passed token.
     * @return type
     */
    public function logout()
    {
        $this->invalidateJWTToken();
        return ApiResponse::SuccessMessage();
    }
    
    /**
     * Refresh token
     *
     * Refresh token and get back to the client.
     * @return type
     */
    public function getToken()
    {
        $oldToken = JWTAuth::getToken();
        if (!$oldToken) {
            ApiResponse::Unauthorized(Lang::get('auth.invalid_token'));
        }
        try {
            $token = JWTAuth::refresh($oldToken);
            $this->invalidateJWTToken();
        } catch (JWTException $e) {
            ApiResponse::InternalError(Lang::get('status.500'));
        }

        return ApiResponse::Token(compact('token'));
    }

    /**
     * Register
     *
     * Create new user
     * @param StoreUserRequest $request
     * @return type
     */
    public function register(StoreUserRequest $request)
    {
        try {
            $requestKeys = array_keys($request->rules());
            $userData = $request->only(array_intersect($requestKeys, $this->userRepo->getModel()->getFillable()));
            $profileData = $request->only(array_intersect($requestKeys, $this->profileRepo->getModel()->getFillable()));
            $this->userRepo->register($userData)->attachRole($this->roleRepo->findByName(RoleTypes::USER)->getModel());
            $profileData["user_id"] = $this->userRepo->getModel()->id;

            if (isset($profileData['avatar'])) {
                $profileData['avatar'] = $profileData['avatar']->store(config('storage.profiles.avatar'));
            }

            $this->profileRepo->create($profileData);

            return ApiResponse::SuccessMessage(Lang::get('auth.success_registration'));
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
    }
    
    /**
     * Confirm Email
     *
     * Confirming user. Change status to active.
     * @param type $confirmation_code
     * @return type
     */
    public function confirmEmail($confirmation_code)
    {
        $user = $this->userRepo->validateEmail($confirmation_code);

        if ($user) {
            return ApiResponse::SuccessMessage(Lang::get('auth.success_confirmation'));
        } else {
            return ApiResponse::Unauthorized(Lang::get('auth.invalid_code'));
        }
    }

    /**
     * Store user session during login or register
     *
     * @param $request
     * @param $user
     */
    private function storeUserSession($request, $user)
    {
        $this->updateLastLogin($user->id);

        $ip = $request->ip();
        $location = Location::get($ip);
        $data = [
            'user_id' => $user->id,
            'ip_address' => $ip,
            'city' => $location->cityName,
            'country' => $location->countryName,
            'country_code' => $location->countryCode,
            'zip_code' => $location->zipCode,
            'browser' => $this->agent->browser(),
        ];

        $this->userSessionRepo->create($data);
    }

    /**
     * Update last login for user who tried to login
     *
     * @param $userId
     */
    private function updateLastLogin($userId)
    {
        $user = $this->userRepo->find($userId)->update(["last_login" => Carbon::now()]);
    }
}
