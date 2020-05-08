<?php

use Illuminate\Database\Seeder;
use App\Repositories\User\IUserRepo;
use App\Repositories\Role\IRoleRepo;
use App\Repositories\Profile\IProfileRepo;
use App\Support\Enum\RoleTypes;
use  Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(IUserRepo $userRepo, IRoleRepo $roleRepo, IProfileRepo $profileRepo)
    {
        $admins = [
            [
                "users" => [
                    "email" => "admin@larakicks.com",
                    "password" => "Admin123!",

                ],
                "profiles" => [
                    "name" => "Larakicks",

                ]
            ]
        ];
        for ($i=0; $i < count($admins); $i++) {
            $userRepo->create($admins[$i]["users"])->attachRole($roleRepo->findByName(RoleTypes::ADMIN)->getModel());

            $profileData = $admins[$i]['profiles'];
            $profileData["user_id"] = $userRepo->getModel()->id;
            $profileRepo->create($profileData);
        }
    }
}
