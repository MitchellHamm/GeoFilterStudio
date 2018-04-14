<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return Redirect::route('login.index');
});

Route::get('create-account', [
    'as'     => 'create-account.index',
    'uses'   => 'UserController@getCreateAccount'
]);

Route::post('create-account', [
    'as'     => 'create-account.submit',
    'uses'   => 'UserController@postCreateAccount'
]);

Route::get('login', [
    'as'    => 'login.index',
    'uses'  => 'UserController@getLogin'
]);

Route::post('login', [
    'as'    => 'login.submit',
    'uses'  => 'UserController@postLogin'
]);

Route::get('user/search', [
    'as'    => 'user.search',
    'uses'  => 'SearchController@searchUsers'
]);

Route::group(['middleware' => 'auth'], function() {

    Route::get('logout', [
        'as'    => 'logout.submit',
        'uses'  => 'UserController@postLogout'
    ]);

    Route::post('user-roles/update', [
        'as'    => 'user-roles.update',
        'uses'  => 'AccountController@updateUserRole'
    ]);

    Route::post('team/add-member', [
        'as'    => 'team.add-member',
        'uses'  => 'AccountController@addTeamMember'
    ]);

    //Register Account Routes
    Route::get('account/{section?}', [
        'as'    => 'account.index',
        'uses'  => 'AccountController@getAccount'
    ]);

    Route::post('account/{section?}', [
        'as'    => 'account.submit',
        'uses'  => 'AccountController@postAccount'
    ]);
});