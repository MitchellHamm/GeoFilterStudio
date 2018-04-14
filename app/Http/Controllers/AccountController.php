<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Services\AccountService;
use Mockery\CountValidator\Exception;
use UxWeb\SweetAlert\SweetAlert;

class AccountController extends Controller
{
    //Valid account routes
    private $validRoutes = ['home', 'order', 'existing-orders', 'change-password', 'user-roles', 'my-designs', 'assign-designs', 'my-team', 'designer-reports'];

    //Valid input for the additional post
    private $validAdditionalInfo = ['first_name', 'last_name', 'phone_number', 'email'];

    //Valid input for the order post
    private $validOrderData = ['event_type', 'event_theme', 'filter_text', 'filter_colors', 'filter_imagery'];

    private $validUserSearchData = ['email'];

    private $validRoleUpdateData = ['user_role', 'user_id'];

    private $validAddTeamData = ['name'];

    private $validAddTeamMemberData = ['team_id', 'user_email'];

    /*
     * @param $section string
     */
    public function getAccount($section = null) {
        if(in_array($section, $this->validRoutes)) {
            //Valid account route
            return $this->getAccountTab($section);
        } else {
            return Redirect::route('account.index', ['home']);
        }
    }

    public function postAccount(Request $request, $section) {
        if(in_array($section, $this->validRoutes)) {
            return $this->postAccountTab($section, $request);
        }
    }

    public function updateUserRole(Request $request) {
        $roleUpdate = $request->only($this->validRoleUpdateData);
        $result = AccountService::updateUserRole($roleUpdate);
        return response()->json($result);
    }

    public function addTeamMember(Request $request) {
        $newTeamMember = $request->only($this->validAddTeamMemberData);
        $result = AccountService::addTeamMember($newTeamMember);
        return response()->json($result);
    }

    /*
     * @param $section string
     */
    private function getAccountTab($section) {
        $profileTabs = $this->getProfileTabs();
        if(isset($profileTabs[$section])) {
            $profileTabs[$section]['class'] .= ' active';
        }

        $renderArray = [
            'listItems'     => $profileTabs,
            'accountTab'    => $section,
            'user'          => Auth::user(),
            'tabParams'     => $this->getAccountTabParams($section),
        ];

        return view('controllers/account/account-home-index', $renderArray);
    }

    private function postAccountTab($section, $request) {
        //Dynamically call functions to avoid large switch statements
        $sanitizedSection = str_replace('-', '', ucwords($section, '-'));
        $function = 'postAccount' . $sanitizedSection . 'Data';
        if(method_exists($this, $function)) {
            return $this->$function($request);
        }
    }

    /*
     * @param $section string
     */
    private function getAccountTabParams($section) {
        //Dynamically call functions to avoid large switch statements
        if(strpos($section, '-') === false) {
            $sanitizedSection = ucwords($section);
        } else {
            $sanitizedSection = str_replace('-', '', ucwords($section, '-'));
        }

        $function = 'getAccount' . $sanitizedSection . 'Data';
        if(method_exists($this, $function)) {
            return $this->$function();
        }
    }

    private function postAccountHomeData($request) {
        $additionalInfo = $request->only($this->validAdditionalInfo);

        try {
            $result = AccountService::updateUserData($additionalInfo);

            if($result->fails()) {
                return Redirect::back()->withErrors($result)->withInput();
            } else {
                SweetAlert::success('Your user information has been successfully updated', 'Information Updated');
                return Redirect::route('account.index', ['home']);
            }
        } catch (Exception $e) {
            SweetAlert::error('Please log in to access this feature', 'Authorization Error');
            return Redirect::route('login.index');
        }
    }

    private function postAccountOrderData($request) {
        $orderData = $request->only($this->validOrderData);
        $customImagery = $request->get('filter_imagery_toggle');

        if($customImagery != 'on') {
            unset($orderData['filter_imagery']);
        }

        try {
            $result = AccountService::placeOrder($orderData);

            if($result->fails()) {
                return Redirect::back()->withErrors($result)->withInput();
            } else {
                alert()->success('Your order has been successfully placed, you will be notified once a designer begins working on your geofilter. Feel free to update your order, contact your designer or cancel your order via the links at the bottom of the order', 'Order Placed')->persistent('Got It!');
                return Redirect::route('account.index', ['existing-orders']);
            }
        } catch (Exception $e) {
            return Redirect::route('login.index');
        }
    }

    private function postAccountUserRolesData($request) {
        $userSearch = $request->only($this->validUserSearchData);

        try {
            $result = AccountService::getUsersByEmail($userSearch);
            $renderArray = [
                'listItems'     => $this->getProfileTabs(),
                'accountTab'    => 'user-roles',
                'user'          => Auth::user(),
                'tabParams'     => $this->getAccountTabParams('user-roles'),
            ];
            $renderArray['listItems']['user-roles']['class'] .= ' active';
            $renderArray['tabParams']['userSearch'] =  $userSearch['email'];

            if(empty($result)) {
                $renderArray['tabParams']['searchError'] = 'No Results Found';
            } else {
                $renderArray['tabParams']['results'] = $result;
            }
            return view('controllers/account/account-home-index', $renderArray);
        } catch (Exception $e) {
            return Redirect::route('login.index');
        }
    }

    private function postAccountMyTeamData($request) {
        $teamData = $request->only($this->validAddTeamData);

        try {
            $result = AccountService::createTeam($teamData);

            if($result->fails()) {
                return Redirect::back()->withErrors($result)->withInput();
            } else {
                SweetAlert::success('Your team has een successfully created! You can now add members to it via the panel below', 'Team Created');
                return Redirect::route('account.index', ['my-team']);
            }
        } catch (Exception $e) {
            SweetAlert::error('Please log in to access this feature', 'Authorization Error');
            return Redirect::route('login.index');
        }
    }

    private function getAccountHomeData() {
        //Dynamically called function for the home section
        $additionalInfo = Config::get('constants.user.attributes');

        $renderArray = ['additionalInfo' => $additionalInfo];

        $user = Auth::user();
        if(!is_null($user)) {
            $renderArray['user'] = $user->toArray();
        }

        return $renderArray;
    }

    private function getAccountOrderData() {
        //Dynamically called function for the order section
        $textAreas = Config::get('constants.place_order.required_fields');
        $optionalTextAreas = Config::get('constants.place_order.optional_fields');
        $additionalComments = Config::get('constants.place_order.additional_comments');

        $renderArray = [
            'textAreas' => $textAreas,
            'optionalTextAreas' => $optionalTextAreas,
            'additionalComments' => $additionalComments,
        ];

        $user = Auth::user();
        if(!is_null($user)) {
            $renderArray['user'] = $user->toArray();
        }

        return $renderArray;
    }

    private function getAccountExistingOrdersData() {
        $existingOrders = AccountService::getUserOrders();

        $renderArray = [
            'existingOrders' => $existingOrders,
        ];

        return $renderArray;
    }

    private function getAccountMyTeamData() {
        //Dynamically called function for the my-team section
        $myTeams = AccountService::getMyTeams();

        $renderArray = ['teams' => $myTeams];

        $user = Auth::user();
        if(!is_null($user)) {
            $renderArray['user'] = $user->toArray();
        }

        return $renderArray;
    }
    
    private function getProfileTabs() {
        $user = Auth::user();
        if(!is_null($user)) {
            $userRole = $user->role->role_name;
            $userRole = lcfirst($userRole);
            $userRoleTabs = Config::get('constants.account.' . $userRole . '_tabs');
            if(is_array($userRoleTabs)) {
                return $userRoleTabs;
            }
        }
    }
}