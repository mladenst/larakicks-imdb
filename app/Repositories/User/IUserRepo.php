<?php

namespace App\Repositories\User;

use Dinkara\RepoBuilder\Repositories\IRepo;
use App\Repositories\Profile\IProfileRepo;
use App\Models\User;
use App\Models\Role;
use App\Models\SocialNetwork;
use App\Models\Movie;

/**
 * Interface UserRepository
 * @package App\Repositories\User
 */
interface IUserRepo extends IRepo
{
   
    /**
     * Function that creates new user
     * @param type $fields
     * @param type $sendEmail
     */
    public function register($fields, $sendEmail = true);
    
    /**
     * Function that validates user email
     * @param type $confirmation_code
     */
    public function validateEmail($confirmation_code);
    
    /**
     * Function that sets user account to active state. If $id is submitted it tries to find user first
     * @param type $id
     */
    public function activate($id = null);
    
    /**
     * Function that sends email to user, with instructions how to confirm his email
     */
    public function sendConfirmationEmail();
    
    /**
     * Function that sends email to user with instructions how to reset his password
     */
    public function sendForgotPasswordEmail();
    
    /**
     * Checks if password reset token matches with user email
     * @param type $token
     */
    public function passwordResetTokenMatch($token);
    
    /**
     * Function that sets new user password
     * @param type $password
     */
    public function resetPassword($password);
    
    /**
     * Function that returns paginated list of all banned users
     * @param type $perPage
     */
    public function banned($perPage = 15);
    
    /**
     * Function that checks if user inside repo is banned
     */
    public function isBanned();
    
    /**
     * Function that bans user account
     * @param type $status
     */
    public function ban();
    
    /**
     * Function that unbans user account
     * @param type $status
     */
    public function unban();
    
    /**
     * Function that restores deleted user account
     * @param type $status
     */
    public function restore();
    
    /**
     * Function that verifies user account
     * @param type $status
     */
    public function verify();

    public function attachRole(Role $model, array $data = []);

    public function attachSocialNetwork(SocialNetwork $model, array $data = []);

    public function attachFavoriteMovie(Movie $model, array $data = []);

    public function attachWishlistMovie(Movie $model, array $data = []);

    public function syncRoles(array $data = [], $detach = true);

    public function syncSocialNetworks(array $data = [], $detach = true);

    public function syncFavoriteMovies(array $data = [], $detach = true);

    public function syncWishlistMovies(array $data = [], $detach = true);

    public function detachRole(Role $model);

    public function detachSocialNetwork(SocialNetwork $model);

    public function detachFavoriteMovie(Movie $model);

    public function detachWishlistMovie(Movie $model);

    public function isAttachedToRole($id);

    public function isAttachedToSocialNetwork($id);

    public function isAttachedToFavoriteMovie($id);

    public function isAttachedToWishlistMovie($id);
}
