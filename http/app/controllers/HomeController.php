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
    
    switch(Auth::user()->account_type) {
      case 'dealer': return Redirect::route('profile.view');
      case 'admin' : return Redirect::route('reports');
      case 'root'  : return Redirect::route('reports');
    }
  }
  
  public function reports() {
    return View::make('reports')->with('user', Auth::user());
  }
  
  public function help() {
    return View::make('help')->with('user', Auth::user());
  }
}