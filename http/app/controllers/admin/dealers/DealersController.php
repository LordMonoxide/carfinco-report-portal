<?php namespace Admin\Dealers;

use Auth;
use Hash;
use Input;
use Redirect;
use Validator;
use View;

use BaseController;
use Dealer;
use User;

class DealersController extends BaseController {
  public function view() {
    return View::make('admin.dealers.view')->with('user', Auth::user())->with('dealers', Auth::user()->account->dealers);
  }
  
  public function create() {
    return View::make('admin.dealers.new')->with('user', Auth::user());
  }
  
  public function add() {
    $validator = Validator::make(Input::all(), [
      'name_first' => ['required', 'min:2',  'max:30'],
      'name_last'  => ['required', 'min:2',  'max:30'],
      'phone'      => ['required', 'min:10', 'max:20'],
      'email'      => ['required', 'email',  'unique:users,email'],
      'number'     => ['required', 'min:2',  'max:255'],
      'password'   => ['required', 'confirmed', 'min:8', 'max:255'],
    ]);
    
    if($validator->passes()) {
      $dealer = new Dealer;
      $dealer->admin_id   = Auth::user()->account->id;
      $dealer->number     = Input::get('number');
      $dealer->name_first = Input::get('name_first');
      $dealer->name_last  = Input::get('name_last');
      $dealer->phone      = Input::get('phone');
      $dealer->save();
      
      $user = new User;
      $user->email        = Input::get('email');
      $user->password     = Hash::make(Input::get('password'));
      $user->account_type = 'dealer';
      $user->account_id   = $dealer->id;
      $user->save();
      
      return Redirect::route('admin.dealers.view');
    } else {
      return Redirect::back()->withInput(Input::except(['password', 'password_confirmation']))->withErrors($validator->messages());
    }
  }
  
  public function edit($dealer) {
    return View::make('admin.dealers.edit')->with('user', Auth::user())->with('dealer', $dealer);
  }
  
  public function update($dealer) {
    $validator = Validator::make(Input::all(), [
      'name_first' => ['required', 'min:2',  'max:30'],
      'name_last'  => ['required', 'min:2',  'max:30'],
      'phone'      => ['required', 'min:10', 'max:20'],
      'password'   => ['required_with:is_change', 'confirmed', 'min:8', 'max:255']
    ]);
    
    if($validator->passes()) {
      $dealer->name_first = Input::get('name_first');
      $dealer->name_last  = Input::get('name_last');
      $dealer->phone      = Input::get('phone');
      
      if(Input::has('is_change')) {
        $dealer->password = Input::get('password');
      }
      
      $dealer->save();
      $dealer->user()->touch();
      
      return Redirect::back();
    } else {
      return Redirect::back()->withInput(Input::except(['password', 'password_confirmation']))->withErrors($validator->messages());
    }
  }
  
  public function delete($dealer) {
    
  }
}