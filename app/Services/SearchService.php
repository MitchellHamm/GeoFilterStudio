<?php


namespace App\Services;

use App\Models\User;
use App\Models\Roles;
use App\Models\UserRoles;
use Illuminate\Support\Facades\Auth;

class SearchService
{
    /*
    * @param $data: Expected array of user data
    * @return User model
    */
    public static function getUserByEmail($queryString) {
        if(strlen($queryString) >= 3) {
            $query = User::where('email', 'like', '%' . $queryString . '%')
                ->select('users.email')
                ->take(10);
            $user = Auth::user();

            if($user) {
                //If the user is logged in hide themselves from this query
                $query->where('id', '!=', $user->id);
            }
            $results = $query->get()->toArray();
            if(count($results)) {
                return ['result' => $results, 'status' => 200];
            } else {
                return ['result' => 'No results found', 'status' => 404];
            }
        } else {
            return ['result' => 'Query string too short', 'status' => 400];
        }
    }
}