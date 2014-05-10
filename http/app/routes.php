<?php

Route::group(['prefix' => 'auth'], function() {
  Route::get ('/login',  ['as' => 'auth.login',         'uses' => 'auth\AuthController@login']);
  Route::post('/login',  ['as' => 'auth.login.attempt', 'uses' => 'auth\AuthController@loginAttempt']);
  Route::get ('/logout', ['as' => 'auth.logout',        'uses' => 'auth\AuthController@logout']);
});

Route::group(['prefix' => 'profile'], function() {
  Route::model('dealer', 'Dealer');
  
  Route::get ('/',         ['as' => 'profile.view',   'uses' => 'profile\ProfileController@view']);
  Route::post('/{dealer}', ['as' => 'profile.update', 'uses' => 'profile\ProfileController@update']);
});

Route::group(['prefix' => 'admin'], function() {
  Route::group(['prefix' => 'dealers'], function() {
    Route::model('dealer', 'Dealer');
    
    Route::get   ('/',                ['as' => 'admin.dealers.view',   'uses' => 'admin\dealers\DealersController@view']);
    Route::get   ('/new',             ['as' => 'admin.dealers.new',    'uses' => 'admin\dealers\DealersController@create']);
    Route::put   ('/new',             ['as' => 'admin.dealers.add',    'uses' => 'admin\dealers\DealersController@add']);
    Route::get   ('/edit/{dealer}',   ['as' => 'admin.dealers.edit',   'uses' => 'admin\dealers\DealersController@edit']);
    Route::post  ('/edit/{dealer}',   ['as' => 'admin.dealers.update', 'uses' => 'admin\dealers\DealersController@update']);
    Route::delete('/delete/{dealer}', ['as' => 'admin.dealers.delete', 'uses' => 'admin\dealers\DealersController@delete']);
  });
});

Route::group(['prefix' => 'root'], function() {
  Route::group(['prefix' => 'admins'], function() {
    Route::model('admin', 'Admin');
    
    Route::get   ('/',               ['as' => 'root.admins.view',   'uses' => 'root\admins\AdminsController@view']);
    Route::get   ('/new',            ['as' => 'root.admins.new',    'uses' => 'root\admins\AdminsController@create']);
    Route::put   ('/new',            ['as' => 'root.admins.add',    'uses' => 'root\admins\AdminsController@add']);
    Route::get   ('/edit/{admin}',   ['as' => 'root.admins.edit',   'uses' => 'root\admins\AdminsController@edit']);
    Route::post  ('/edit/{admin}',   ['as' => 'root.admins.update', 'uses' => 'root\admins\AdminsController@update']);
    Route::delete('/delete/{admin}', ['as' => 'root.admins.delete', 'uses' => 'root\admins\AdminsController@delete']);
  });
});

Route::get('/',                ['as' => 'home',    'uses' => 'HomeController@home']);
Route::get('/reports/{year?}', ['as' => 'reports', 'uses' => 'HomeController@reports'])->where('year', '[0-9]{4}');
Route::get('/help',            ['as' => 'help',    'uses' => 'HomeController@help']);
