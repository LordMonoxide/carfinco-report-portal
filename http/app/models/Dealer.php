<?php

class Dealer extends Eloquent {
  public function user() {
    return $this->morphOne('User', 'account');
  }
  
  public function reports() {
    return $this->hasMany('Reports');
  }
}