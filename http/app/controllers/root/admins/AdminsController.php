<?php namespace root\admins;

use Auth;
use Hash;
use Input;
use Redirect;
use Validator;
use View;

use BaseController;
use Admin;
use User;

class AdminsController extends BaseController {
  public function view() {
    return View::make('root.admins.view')->with('user', Auth::user())->with('admins', Auth::user()->account->admins);
  }
  
  public function create() {
    return View::make('root.admins.new')->with('user', Auth::user());
  }
  
  public function add() {
    $validator = Validator::make(Input::all(), [
      'email'      => ['required', 'email',  'unique:users,email'],
      'password'   => ['required', 'confirmed', 'min:8', 'max:255'],
    ]);
    
    if($validator->passes()) {
      $admin = new Admin;
      $admin->root_id = Auth::user()->account->id;
      $admin->save();
      
      $user = new User;
      $user->email        = Input::get('email');
      $user->password     = Hash::make(Input::get('password'));
      $user->account_type = 'Admin';
      $user->account_id   = $admin->id;
      $user->save();
      
      return Redirect::route('root.admins.view');
    } else {
      return Redirect::back()->withInput(Input::except(['password', 'password_confirmation']))->withErrors($validator->messages());
    }
  }
  
  public function edit($admin) {
    return View::make('root.admins.edit')->with('user', Auth::user())->with('admin', $admin);
  }
  
  public function update($admin) {
    $validator = Validator::make(Input::all(), [
      'password'   => ['required_with:is_change', 'confirmed', 'min:8', 'max:255']
    ]);
    
    if($validator->passes()) {
      if(Input::has('is_change')) {
        $admin->user->password = Input::get('password');
      }
      
      $admin->user->save();
      
      return Redirect::route('root.admins.view');
    } else {
      return Redirect::back()->withInput(Input::except(['password', 'password_confirmation']))->withErrors($validator->messages());
    }
  }
  
  public function delete($admin) {
    $admin->delete();
    return Redirect::route('root.admins.view');
  }
}