<?php
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 9/24/14
 * Time: 4:42 AM
 */

Route::filter('auth', function(){
    if (!Auth::check())
        return Redirect::to('/')->with('message', 'session time has ben ended');
});

Route::filter('isAdmin', function(){
    if (isAdmin() == false)
        return Redirect::to('/')->with('message', 'session time has ben ended');
});

//registration
Route::get('registration', 'Meniqa\EmployeeMenpan\Controllers\AuthController@registration');
Route::post('registration', 'Meniqa\EmployeeMenpan\Controllers\AuthController@doRegister');

//login
Route::get('login', 'Meniqa\EmployeeMenpan\Controllers\AuthController@login');
Route::post('login', 'Meniqa\EmployeeMenpan\Controllers\AuthController@dologin');
Route::get('', 'Meniqa\EmployeeMenpan\Controllers\AuthController@login');

//logout
Route::get('logout', 'Meniqa\EmployeeMenpan\Controllers\AuthController@doLogout');

//user
Route::group(array('before' => 'auth', 'prefix' => 'user'), function(){

    Route::get('dashboard', array(
        'as' => 'dashboard.index',
        'uses' => 'Meniqa\EmployeeMenpan\Controllers\DashboardController@index'
    ));

    Route::get('dashboard/profile', array(
        'as' => 'dashboard.profile',
        'uses' => 'Meniqa\EmployeeMenpan\Controllers\DashboardController@profile'
    ));

    Route::any('changepassword', 'Meniqa\EmployeeMenpan\Controllers\UserSetting@changePassword');

    Route::get('mulaibosan', 'Meniqa\EmployeeMenpan\Controllers\AuthController@userData');
});


Route::group(array('before' => 'isAdmin', 'prefix' => 'admin'), function(){
    Route::get('dashboard', 'Meniqa\EmployeeMenpan\Controllers\AdminDashboardController@dashboard');
});