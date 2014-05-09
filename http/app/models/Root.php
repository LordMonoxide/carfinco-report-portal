<?php

class Root extends Eloquent {
  public function user() {
    return $this->morphOne('User', 'account');
  }
  
  public function admins() {
    return $this->hasMany('Admin');
  }
}