<?php

//use App\User;
//Route::get('/', function () {
//    $user = new User();
//    $user->name='marcelo';
//    $user->email='marcelo@gmail.com';
//    $user->password=bcrypt('12345678');
//    $user->save();
//    return $user;

//    return view('main');
//});

//Route::any('/{all}', 'MainController@index')
//    ->where('all', '.*');

Route::get('/', 'MainController@index');

Route::apiResource('account', 'AccountController');
Route::apiResource('webAccount', 'WebAccountController');

Route::get('auth/init', 'AuthController@init');
Route::post('auth/login', 'AuthController@login');
Route::get('auth/logout', 'AuthController@logout');
Route::post('auth/store', 'AuthController@store');
