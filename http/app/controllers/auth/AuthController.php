<?php namespace auth;

use BaseController;

use Auth;
use Input;
use Redirect;
use URL;
use Validator;
use View;

class AuthController extends BaseController {
  public function __construct() {
    $this->beforeFilter('auth',  ['only'   => ['logout']]);
    $this->beforeFilter('nauth', ['except' => ['logout']]);
    $this->beforeFilter('csrf',  ['on'     => ['post', 'put', 'delete']]);
  }
  
  public function login() {
    return View::make('auth.login');
  }
  
  public function loginAttempt() {
    $validator = Validator::make(Input::all(), [
      'email'    => ['required', 'email', 'exists:users,email'],
      'password' => ['required', 'min:8', 'max:256']
    ]);
    
    if($validator->passes()) {
      if(!Auth::attempt(Input::only(['email', 'password']))) {
        return Redirect::back()->withInput(Input::only('email'))->withErrors(['password' => ['Invalid password']]);
      }
      
      return Redirect::intended(URL::route('home'));
    } else {
      return Redirect::back()->withInput(Input::only('email'))->withErrors($validator->messages());
    }
  }
  
  public function logout() {
    Auth::logout();
    return Redirect::route('home');
  }
}