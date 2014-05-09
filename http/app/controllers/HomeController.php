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
  
  public function reports($yearNum = null) {
    switch(Auth::user()->account_type) {
      case 'Dealer':
        $yearNow = strftime('%Y');
        
        if($yearNum === null) {
          $yearNum = $yearNow;
        }
        
        $year = Auth::user()->account->reports()->whereRaw('YEAR(timestamp) = ' . $yearNum);
        $month = [];
        
        for($i = 1; $i <= 12; $i++) {
          $month[] = [
            'name' => date("F", mktime(0, 0, 0, $i, date("d"), date("Y"))),
            'data' => Auth::user()->account->reports()->whereRaw('YEAR(timestamp) = ' . $yearNum)->whereRaw('MONTH(timestamp) = ' . $i)->take(1)->first()
          ];
        }
        
        return View::make('reports')->with('user', Auth::user())->with('yearNow', $yearNow)->with('yearNum', $yearNum)->with('monthly', $month);
        
      case 'Admin':
        return View::make('admin.reports')->with('user', Auth::user())->with('dealers', Auth::user()->account->dealers);
        
      case 'Root':
        return View::make('root.reports')->with('user', Auth::user())->with('admins', Auth::user()->account->admins);
    }
  }
  
  public function help() {
    return View::make('help')->with('user', Auth::user());
  }
}