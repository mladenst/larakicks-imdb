<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('creator_id', 'comments_users_fk')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
        Schema::table('favorite_movies', function (Blueprint $table) {
            $table->foreign('user_id', 'favorite_movie_users_fk')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('movie_id', 'favorite_movie_movies_fk')
                  ->references('id')
                  ->on('movies')
                  ->onDelete('cascade');
        });
        Schema::table('movies_actors', function (Blueprint $table) {
            $table->foreign('movie_id', 'movies_actors_movies_fk')
                  ->references('id')
                  ->on('movies')
                  ->onDelete('cascade');
            $table->foreign('actor_id', 'movies_actors_actors_fk')
                  ->references('id')
                  ->on('actors')
                  ->onDelete('cascade');
        });
        Schema::table('movies_directors', function (Blueprint $table) {
            $table->foreign('movie_id', 'movies_directors_movies_fk')
                  ->references('id')
                  ->on('movies')
                  ->onDelete('cascade');
            $table->foreign('director_id', 'movies_directors_directors_fk')
                  ->references('id')
                  ->on('directors')
                  ->onDelete('cascade');
        });
        Schema::table('password_resets', function (Blueprint $table) {
            $table->foreign('user_id', 'password_resets_users_fk')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
        Schema::table('profiles', function (Blueprint $table) {
            $table->foreign('user_id', 'profiles_users_fk')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
        Schema::table('roles_permissions', function (Blueprint $table) {
            $table->foreign('role_id', 'roles_permissions_roles_fk')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('cascade');
            $table->foreign('permission_id', 'roles_permissions_permissions_fk')
                  ->references('id')
                  ->on('permissions')
                  ->onDelete('cascade');
        });
        Schema::table('user_sessions', function (Blueprint $table) {
            $table->foreign('user_id', 'user_sessions_users_fk')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
        Schema::table('users_roles', function (Blueprint $table) {
            $table->foreign('user_id', 'users_roles_users_fk')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('role_id', 'users_roles_roles_fk')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('cascade');
        });
        Schema::table('users_social_networks', function (Blueprint $table) {
            $table->foreign('user_id', 'users_social_networks_users_fk')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('social_network_id', 'users_social_networks_social_networks_fk')
                  ->references('id')
                  ->on('social_networks')
                  ->onDelete('cascade');
        });
        Schema::table('wishlist_movies', function (Blueprint $table) {
            $table->foreign('user_id', 'wishlist_movie_users_fk')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('movie_id', 'wishlist_movie_movies_fk')
                  ->references('id')
                  ->on('movies')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_users_fk');
        });
        Schema::table('favorite_movies', function (Blueprint $table) {
            $table->dropForeign('favorite_movie_users_fk');
            $table->dropForeign('favorite_movie_movies_fk');
        });
        Schema::table('movies_actors', function (Blueprint $table) {
            $table->dropForeign('movies_actors_movies_fk');
            $table->dropForeign('movies_actors_actors_fk');
        });
        Schema::table('movies_directors', function (Blueprint $table) {
            $table->dropForeign('movies_directors_movies_fk');
            $table->dropForeign('movies_directors_directors_fk');
        });
        Schema::table('password_resets', function (Blueprint $table) {
            $table->dropForeign('password_resets_users_fk');
        });
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign('profiles_users_fk');
        });
        Schema::table('roles_permissions', function (Blueprint $table) {
            $table->dropForeign('roles_permissions_roles_fk');
            $table->dropForeign('roles_permissions_permissions_fk');
        });
        Schema::table('user_sessions', function (Blueprint $table) {
            $table->dropForeign('user_sessions_users_fk');
        });
        Schema::table('users_roles', function (Blueprint $table) {
            $table->dropForeign('users_roles_users_fk');
            $table->dropForeign('users_roles_roles_fk');
        });
        Schema::table('users_social_networks', function (Blueprint $table) {
            $table->dropForeign('users_social_networks_users_fk');
            $table->dropForeign('users_social_networks_social_networks_fk');
        });
        Schema::table('wishlist_movies', function (Blueprint $table) {
            $table->dropForeign('wishlist_movie_users_fk');
            $table->dropForeign('wishlist_movie_movies_fk');
        });
    }
}
