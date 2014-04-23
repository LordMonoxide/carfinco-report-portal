<?php namespace profile;

use BaseController;

use Auth;
use Input;
use Redirect;
use Validator;
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
    $validator = Validator::make(Input::all(), [
      'name_first' => ['required', 'min:2',  'max:30'],
      'name_last'  => ['required', 'min:2',  'max:30'],
      'phone'      => ['required', 'min:10', 'max:20'],
      'password'   => ['required_with:is_change', 'confirmed', 'min:8', 'max:255']
    ]);
    
    if($validator->passes()) {
      $user->name_first = Input::get('name_first');
      $user->name_last  = Input::get('name_last');
      $user->phone      = Input::get('phone');
      
      if(Input::has('is_change')) {
        $user->password = Input::get('password');
      }
      
      $user->save();
      
      return Redirect::back();
    } else {
      return Redirect::back()->withInput(Input::except(['password', 'password_confirmation']))->withErrors($validator->messages());
    }
  }
}