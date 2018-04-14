<?php


namespace App\Services;

use App\Models\User;
use App\Models\Roles;
use App\Models\UserRoles;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /*
    * @param $data: Expected array of user data
    * @return User model
    */
    public static function createUser($data) {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        UserRoles::create(['user_id' => $user->id, 'role_id' => '1']);
        return $user;
    }
}