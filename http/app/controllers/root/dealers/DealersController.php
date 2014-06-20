<?php namespace root\dealers;

use Auth;
use Hash;
use Input;
use Redirect;
use Validator;
use View;

use BaseController;
use Admin;
use Dealer;
use User;

class DealersController extends BaseController {
  public function view() {
    return View::make('root.dealers.view')->with('user', Auth::user())->with('dealers', Auth::user()->account->dealers);
  }
  
  public function create() {
    $admins = [];
    
    Auth::user()->account->admins->each(function($admin) use(&$admins) {
      $admins[$admin->id] = $admin->user->email;
    });
    
    return View::make('root.dealers.new')->with('user', Auth::user())->with('admins', $admins);
  }
  
  public function add() {
    $validator = Validator::make(Input::all(), [
      'name_first' => ['required', 'min:2',  'max:30'],
      'name_last'  => ['required', 'min:2',  'max:30'],
      'phone'      => ['required', 'min:10', 'max:20'],
      'email'      => ['required', 'email',  'unique:users,email'],
      'password'   => ['required', 'confirmed', 'min:8', 'max:255'],
      'number'     => ['required', 'min:2',  'max:255'],
      'admin'      => ['required', 'exists:admins,id']
    ]);
    
    if($validator->passes()) {
      $dealer = new Dealer;
      $dealer->admin_id   = Input::get('admin');
      $dealer->number     = Input::get('number');
      $dealer->name_first = Input::get('name_first');
      $dealer->name_last  = Input::get('name_last');
      $dealer->phone      = Input::get('phone');
      $dealer->save();
      
      $user = new User;
      $user->email        = Input::get('email');
      $user->password     = Hash::make(Input::get('password'));
      $user->account_type = 'Dealer';
      $user->account_id   = $dealer->id;
      $user->save();
      
      return Redirect::route('root.dealers.view');
    } else {
      return Redirect::back()->withInput(Input::except(['password', 'password_confirmation']))->withErrors($validator->messages());
    }
  }
  
  public function edit(Dealer $dealer) {
    $admins = [];
    
    Auth::user()->account->admins->each(function($admin) use(&$admins) {
      $admins[$admin->id] = $admin->user->email;
    });
    
    return View::make('root.dealers.edit')->with('user', Auth::user())->with('dealer', $dealer)->with('admins', $admins);
  }
  
  public function update(Dealer $dealer) {
    $validator = Validator::make(Input::all(), [
      'name_first' => ['required', 'min:2',  'max:30'],
      'name_last'  => ['required', 'min:2',  'max:30'],
      'phone'      => ['required', 'min:10', 'max:20'],
      'password'   => ['required_with:is_change', 'confirmed', 'min:8', 'max:255'],
      'admin'      => ['required', 'exists:admins,id']
    ]);
    
    if($validator->passes()) {
      $dealer->name_first = Input::get('name_first');
      $dealer->name_last  = Input::get('name_last');
      $dealer->phone      = Input::get('phone');
      $dealer->admin_id   = Input::get('admin');
      
      if(Input::has('is_change')) {
        $dealer->user->password = Input::get('password');
        $dealer->user->save();
      }
      
      $dealer->save();
      $dealer->user->touch();
      
      return Redirect::route('root.dealers.view');
    } else {
      return Redirect::back()->withInput(Input::except(['password', 'password_confirmation']))->withErrors($validator->messages());
    }
  }
  
  public function delete(Dealer $dealer) {
    $dealer->delete();
    return Redirect::route('root.dealers.view');
  }
}