<?php


namespace App\Services;

use App\Models\Order;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Roles;
use App\Models\UserRoles;
use App\Models\OrderAssignments;
use App\Models\TeamAssignments;
use App\Models\Teams;

class AccountService
{
    public static function updateUserData($data) {
        $user = Auth::user();

        if(!is_null($user)) {
            $fieldConstraints = [
                'first_name'    => 'Min:2|Max:50|Alpha',
                'last_name'     => 'Min:2|Max:50|Alpha',
                'phone_number'  => 'phone:US,CA',
                'email'         => 'Required|Between:3,64|Email|Unique:users,email' . ($user->id ? ",$user->id" : ''),
            ];

            $validator = Validator::make($data, $fieldConstraints);

            if(!$validator->fails()) {
                $user->fill($data);
                $user->save();
            }

            return $validator;
        } else {
            throw new Exception('User not authorized');
        }
    }

    public static function placeOrder($orderData) {
        $user = Auth::user();

        if(!is_null($user)) {
            $orderData['user_id'] = $user->id;
            $orderData['status'] = 1;
            $fieldRequirements = Config::get('constants.place_order.field_constraints');
            $validator = Validator::make($orderData, $fieldRequirements);

            if(!$validator->fails()) {
                Order::create($orderData);
            }

            return $validator;
        } else {
            throw new Exception('User not authorized');
        }
    }

    public static function getUserOrders() {
        $user = Auth::user();

        if(!is_null($user)) {
            $orders = Order::where('user_id', $user->id)
                            ->orderBy('updated_at', 'desc')
                            ->join('order_status', 'orders.status', '=', 'order_status.id')
                            ->get();
            return $orders->toArray();
        }
    }

    public static function getUsersByEmail($searchData) {
        $user = Auth::user();

        if(!is_null($user)) {
            $userRole = $user->role->role_name;
            if($userRole == 'Admin' || $userRole == 'Developer') {
                return User::where('email', 'like', '%' . $searchData['email'] . '%')
                            ->select('users.*', 'roles.role')
                            ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
                            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
                            ->get()->toArray();
            } else {
                throw new Exception('User not authorized');
            }
        } else {
            throw new Exception('User not authorized');
        }
    }

    public static function updateUserRole($updateData) {
        $role = $updateData['user_role'];
        $user_id = $updateData['user_id'];

        $user = Auth::user();

        if(!is_null($user)) {
            $userRole = $user->role->role_name;
            if($userRole == 'Admin' || $userRole == 'Developer') {
                if($role && $user_id) {
                    $role_id = Roles::where('role', $role)->value('id');
                    UserRoles::where([
                        ['user_id', '=', $user_id],
                        ['role_id', '!=', 5]
                        ])
                        ->update(['role_id' => $role_id]);
                    return ['result' => 'The users role has successfully been changed', 'status' => 200];
                } else {
                    return ['result' => 'User id or role id not defined', 'status' => 500];
                }
            } else {
                return ['result' => 'You are not authorized to change a users role', 'status' => 401];
            }
        } else {
            return ['result' => 'You are not authorized to change a users role', 'status' => 401];
        }
    }

    public static function getMyTeams() {
        $user = Auth::user();

        if(!is_null($user)) {
            $userRole = $user->role->role_name;
            if($userRole == 'Admin' || $userRole == 'Developer' || $userRole == 'Manager') {
                return Teams::where('user_id', $user->id)
                            ->get()->toArray();
            } else {
                throw new Exception('User not authorized');
            }
        } else {
            throw new Exception('User not authorized');
        }
    }
    
    public static function createTeam($data) {
        $fieldConstraints = Config::get('constants.my_team.field_constraints');
        $validator = Validator::make($data, $fieldConstraints);

        if(!$validator->fails()) {
            $user = Auth::user();

            if(!is_null($user)) {
                $userRole = $user->role->role_name;
                if($userRole == 'Admin' || $userRole == 'Developer' || $userRole == 'Manager') {
                    Teams::create(['user_id' => $user->id, 'name' => $data['name']]);
                } else {
                    throw new Exception('User not authorized');
                }
            } else {
                throw new Exception('User not authorized');
            }
        }

        return $validator;
    }

    public static function addTeamMember($data) {
        $fieldConstraints = [
            'team_id'       => 'Required|exists:teams,id',
            'user_email'    => 'Required|exists:users,email',
        ];
        $validator = Validator::make($data, $fieldConstraints);

        if(!$validator->fails()) {
            $user = Auth::user();

            if(!is_null($user)) {
                $userRole = $user->role->role_name;
                if($userRole == 'Admin' || $userRole == 'Developer' || $userRole == 'Manager') {
                    $newTeamUser = User::where('email', $data['user_email'])->get()->first();
                    $doesEntryExist = TeamAssignments::where('team_id', $data['team_id'])->where('user_id', $newTeamUser->id)->get()->first();
                    if(!$doesEntryExist) {
                        TeamAssignments::create(['team_id' => $data['team_id'], 'user_id' => $newTeamUser->id]);
                        return ['result' => 'The user has been added to your team', 'status' => 200];
                    } else {
                        return ['result' => 'The user is already on this team', 'status' => 400];
                    }
                } else {
                    return ['result' => 'You are not authorized to add team members', 'status' => 500];
                }
            } else {
                return ['result' => 'You are not authorized to add team members', 'status' => 401];
            }
        } else {
            return ['result' => $validator->errors()->all(), 'status' => 401];
        }
    }
}