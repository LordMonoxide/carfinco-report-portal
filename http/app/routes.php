<?php

Route::group(['prefix' => 'auth'], function() {
  Route::get ('/login',  ['as' => 'auth.login',         'uses' => 'auth\AuthController@login']);
  Route::post('/login',  ['as' => 'auth.login.attempt', 'uses' => 'auth\AuthController@loginAttempt']);
  Route::get ('/logout', ['as' => 'auth.logout',        'uses' => 'auth\AuthController@logout']);
});

Route::group(['prefix' => 'profile'], function() {
  Route::get ('/', ['as' => 'profile.view',   'uses' => 'profile\ProfileController@view']);
  Route::post('/', ['as' => 'profile.update', 'uses' => 'profile\ProfileController@update']);
});

Route::get('/',        ['as' => 'home',    'uses' => 'HomeController@home']);
Route::get('/reports', ['as' => 'reports', 'uses' => 'HomeController@reports']);
Route::get('/help',    ['as' => 'help',    'uses' => 'HomeController@help']);