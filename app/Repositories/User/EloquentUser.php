<?php

namespace App\Repositories\User;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Repositories\Profile\IProfileRepo;
use App\Repositories\Role\IRoleRepo;
use App\Repositories\PasswordReset\IPasswordResetRepo;
use App\Repositories\SocialNetwork\ISocialNetworkRepo;
use Mail;
use App\Mail\EmailConfirmation;
use App\Mail\ForgotPassword;
use App\Support\Enum\UserStatuses;
use App\Models\User;
use App\Models\Role;
use App\Models\SocialNetwork;
use App\Models\Movie;

class EloquentUser extends EloquentRepo implements IUserRepo
{
    private $profileRepo;
    private $roleRepo;
    private $passwordResetRepo;
    private $socialNetworkRepo;

    public function __construct(IRoleRepo $roleRepo, IPasswordResetRepo $passwordResetRepo, IProfileRepo $profileRepo, ISocialNetworkRepo $socialNetworkRepo)
    {
        $this->roleRepo = $roleRepo;
        $this->passwordResetRepo = $passwordResetRepo;
        $this->profileRepo = $profileRepo;
        $this->socialNetworkRepo = $socialNetworkRepo;
    }

    /**
     * Configure the Model
     * */
    public function model()
    {
        return new User;
    }
    
    public function register($fields, $sendEmail = true)
    {
        $fields["confirmation_code"] = $sendEmail ? str_random(30) : null;

        $result = $this->create($fields);

        if ($result && $sendEmail) {
            $this->sendConfirmationEmail();
        }

        return $this->finalize($result);
    }

    public function validateEmail($confirmation_code)
    {
        $this->initialize();

        $this->model = $this->model->where("confirmation_code", $confirmation_code)->first();

        if ($this->model) {
            $this->update([
                "status" => UserStatuses::_ACTIVE,
                "confirmation_code" => null
            ]);
        }

        return $this->finalize($this->model);
    }

    public function activate($id = null)
    {
        if ($id) {
            $this->find($id);
        }

        if (!$this->model) {
            return false;
        }

        return $this->update(["status" => UserStatuses::_ACTIVE]);
    }

    public function sendConfirmationEmail()
    {
        $result = $this->update(["status" => UserStatuses::_UNCONFIRMED]);

        if ($result) {
            $result = Mail::to($this->getModel())->send(new EmailConfirmation($this->getModel()));
        }

        return $this->finalize($result);
    }

    public function sendForgotPasswordEmail()
    {
        if (!$this->model) {
            return false;
        }

        $fields = ["user_id" => $this->getModel()->id, "token" => str_random(30)];

        if (!$this->model->passwordReset) {
            $result = $this->model->passwordReset()->save($this->passwordResetRepo->fill($fields)->getModel());
            $this->model->passwordReset = $this->passwordResetRepo->getModel();
        } else {
            $result = $this->model->passwordReset()->update($fields);
            $this->model->passwordReset->token = $fields["token"];
        }

        if ($result) {
            $result = Mail::to($this->getModel())->send(new ForgotPassword($this->getModel()));
        }

        return $this->finalize($result);
    }

    public function passwordResetTokenMatch($token)
    {
        if (!$this->model) {
            return false;
        }

        return $this->model->passwordReset->token != $token;
    }

    public function resetPassword($password)
    {
        if (!$this->model) {
            return false;
        }

        $this->model->password = $password;

        $this->model->passwordReset()->delete();

        return $this->finalize($this->save());
    }

    public function banned($perPage = 15)
    {
        $this->initialize();
        
        $result = $this->model()->where("status", UserStatuses::_BANNED)->paginate($perPage);
                
        return $result;
    }

    public function isBanned()
    {
        if (!$this->model) {
            return false;
        }

        $result = $this->model->status == UserStatuses::_BANNED;
        
        return $result;
    }
    
    public function ban()
    {
        if (!$this->model) {
            return false;
        }

        $result = $this->updateStatus(UserStatuses::_BANNED);
        
        return $result;
    }
    
    public function unban()
    {
        if (!$this->model) {
            return false;
        }

        $result = $this->updateStatus(UserStatuses::_ACTIVE);
        
        return $result;
    }
    
    public function delete()
    {
        if (!$this->model) {
            return false;
        }

        $this->updateStatus(UserStatuses::_DELETED);
        
        $result = $this->model->delete();
        
        return $result;
    }
    
    public function restore()
    {
        if (!$this->model) {
            return false;
        }
                
        if ($result = $this->model->restore()) {
            $result = $this->updateStatus(UserStatuses::_ACTIVE);
        }
        
        return $result;
    }
    
    public function verify()
    {
        if (!$this->model) {
            return false;
        }
                
        $result = $this->updateStatus(UserStatuses::_ACTIVE);
        
        return $result;
    }
    
    private function updateStatus($status)
    {
        if (!$this->model) {
            return false;
        }

        $this->model->status = $status;
        
        $result = $this->save();
        
        return $result;
    }

    public function attachRole(Role $model, array $data = [])
    {
        if (!$this->model) {
            return false;
        }
        
        $result = $this->model->roles()->attach($model, $data);
        
        return $this->finalize($this->model);
    }

    public function attachSocialNetwork(SocialNetwork $model, array $data = [])
    {
        if (!$this->model) {
            return false;
        }
        
        $result = $this->model->socialNetworks()->attach($model, $data);
        
        return $this->finalize($this->model);
    }

    public function attachFavoriteMovie(Movie $model, array $data = [])
    {
        if (!$this->model) {
            return false;
        }
        
        $result = $this->model->favoriteMovies()->attach($model, $data);
        
        return $this->finalize($this->model);
    }

    public function attachWishlistMovie(Movie $model, array $data = [])
    {
        if (!$this->model) {
            return false;
        }
        
        $result = $this->model->wishlistMovies()->attach($model, $data);
        
        return $this->finalize($this->model);
    }

    public function syncRoles(array $data = [], $detach = true)
    {
        return $this->sync('roles', $data, $detach);
    }

    public function syncSocialNetworks(array $data = [], $detach = true)
    {
        return $this->sync('socialNetworks', $data, $detach);
    }

    public function syncFavoriteMovies(array $data = [], $detach = true)
    {
        return $this->sync('favoriteMovies', $data, $detach);
    }

    public function syncWishlistMovies(array $data = [], $detach = true)
    {
        return $this->sync('wishlistMovies', $data, $detach);
    }

    public function detachRole(Role $model)
    {
        if (!$this->model) {
            return false;
        }
    
        $result = $this->model->roles()->detach($model);
        
        return $this->finalize($this->model);
    }

    public function detachSocialNetwork(SocialNetwork $model)
    {
        if (!$this->model) {
            return false;
        }
    
        $result = $this->model->socialNetworks()->detach($model);
        
        return $this->finalize($this->model);
    }

    public function detachFavoriteMovie(Movie $model)
    {
        if (!$this->model) {
            return false;
        }
    
        $result = $this->model->favoriteMovies()->detach($model);
        
        return $this->finalize($this->model);
    }

    public function detachWishlistMovie(Movie $model)
    {
        if (!$this->model) {
            return false;
        }
    
        $result = $this->model->wishlistMovies()->detach($model);
        
        return $this->finalize($this->model);
    }

    public function isAttachedToRole($id)
    {
        return $this->isAttachedTo('roles', $id);
    }

    public function isAttachedToSocialNetwork($id)
    {
        return $this->isAttachedTo('socialNetworks', $id);
    }

    public function isAttachedToFavoriteMovie($id)
    {
        return $this->isAttachedTo('favoriteMovies', $id);
    }

    public function isAttachedToWishlistMovie($id)
    {
        return $this->isAttachedTo('wishlistMovies', $id);
    }
}
