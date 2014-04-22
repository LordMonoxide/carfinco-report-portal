<?php

class HomeController extends BaseController {
  public function __construct() {
    $this->beforeFilter('auth',  ['only' => ['reports', 'help']]);
    $this->beforeFilter('csrf',  ['on'   => ['post', 'put', 'delete']]);
  }
  
  public function home() {
    if(Auth::guest()) {
      return Redirect::route('auth.login');
    }
    
    return Redirect::route('profile.view');
  }
  
  public function reports() {
    return View::make('reports');
  }
  
  public function help() {
    return View::make('help');
  }
}