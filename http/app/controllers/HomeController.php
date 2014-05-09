<?php

use \Report;

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
    $year = Auth::user()->account->reports()->whereRaw('YEAR(timestamp) = YEAR(CURDATE())');
    $month = [];
    
    for($i = 1; $i <= 12; $i++) {
      $month[] = [
        'name' => date("F", mktime(0, 0, 0, $i, date("d"), date("Y"))),
        'data' => $year->whereRaw('MONTH(timestamp) = ' . $i)->take(1)->get()
      ];
    }
    
    return View::make('reports')->with('user', Auth::user())->with('yearly', $year)->with('monthly', $month);
  }
  
  public function help() {
    return View::make('help')->with('user', Auth::user());
  }
}