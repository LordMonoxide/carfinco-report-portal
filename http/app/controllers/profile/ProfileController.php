<?php namespace profile;

use BaseController;

use Auth;
use Hash;
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
    return View::make('profile.view')->with('user', Auth::user())->with('dealer', Auth::user()->account);
  }
  
  public function update() {
    $user = Auth::user();
    
    if($user->account_type === 'Dealer') {
      $validator = Validator::make(Input::all(), [
        'name_first' => ['required', 'min:2',  'max:30'],
        'name_last'  => ['required', 'min:2',  'max:30'],
        'phone'      => ['required', 'min:10', 'max:20'],
        'password'   => ['required_with:is_change', 'confirmed', 'min:8', 'max:255']
      ]);
    } else {
      $validator = Validator::make(Input::all(), [
        'password'   => ['required_with:is_change', 'confirmed', 'min:8', 'max:255']
      ]);
    }
    
    if($validator->passes()) {
      if($user->account_type === 'Dealer') {
        $dealer = $user->account();
        $dealer->name_first = Input::get('name_first');
        $dealer->name_last  = Input::get('name_last');
        $dealer->phone      = Input::get('phone');
        $dealer->save();
        $user->touch();
      }
      
      if(Input::has('is_change')) {
        $user->password = Hash::make(Input::get('password'));
        $user->save();
      }
      
      return Redirect::back();
    } else {
      return Redirect::back()->withInput(Input::except(['password', 'password_confirmation']))->withErrors($validator->messages());
    }
  }
}