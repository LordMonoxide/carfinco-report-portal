<?php namespace profile;

use BaseController;

use Auth;
use View;

class ProfileController extends BaseController {
  public function __construct() {
    $this->beforeFilter('auth');
    $this->beforeFilter('csrf', ['on' => ['post', 'put', 'delete']]);
  }
  
  public function view() {
    return View::make('profile.view')->with('user', Auth::user());
  }
  
  public function update($user) {
    
  }
}