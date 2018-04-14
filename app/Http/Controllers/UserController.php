<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Alert;

class UserController extends Controller
{
    //Valid input for the account create post
    private $validAccountCreate = ['email', 'password'];

    //Valid input for the account login post
    private $validAccountLogin = ['email', 'password'];

    public function getCreateAccount() {
        $renderArray = [
            'requiredFields' => Config::get('constants.create_account.required_fields'),
        ];

        return view('controllers/create-account-index', $renderArray);
    }

    public function postCreateAccount(Request $request) {
        $newUser = $request->only($this->validAccountCreate);
        $paramConstraints = Config::get('constants.create_account.field_constraints');
        $validator = Validator::make($newUser, $paramConstraints);

        if($validator->fails()) {
            //Handle input errors
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            //Success, Fire off the email
            $user = UserService::createUser($newUser);

            if(App::environment('production')) {
                Mail::send('emails/test-email', ['order_fields' => $newUser], function($m) use ($newUser) {
                    $m->from('test@test.com', 'Test Email');
                    $m->to($newUser['email'])->subject('Test');
                });
            }

            Auth::login($user);

            alert()->success('Your account has been successfully created, you have been taken to your account page.', 'Account Created!')->persistent('Close');

            return Redirect::route('account.index', ['home']);
        }
    }

    public function postLogout() {
        Auth::logout();
        alert()->success('You have been logged out.', 'Logout Successful');
        return Redirect::route('login.index');
    }

    public function getLogin() {
        $renderArray = [
            'requiredFields' => Config::get('constants.login.required_fields'),
        ];

        return view('controllers/login-index', $renderArray);
    }

    public function postLogin(Request $request) {
        $userRequest = $request->only($this->validAccountLogin);
        $rememberParam = $request->only('remember_me');

        $rememberMe = $rememberParam['remember_me'] = '1' ? true : false;

        if(isset($userRequest['email']) && isset($userRequest['password'])) {;
            if($user = Auth::attempt($userRequest, $rememberMe)) {
                return Redirect::route('account.index', ['home']);
            } else {
                $errors = new MessageBag(['password' => ['Email and/or password invalid']]);
                return Redirect::back()->withErrors($errors)->withInput();
            }
        }
    }
}