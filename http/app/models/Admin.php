<?php

class Admin extends Eloquent {
  public function user() {
    return $this->morphOne('User', 'account');
  }
  
  public function root() {
    return $this->belongsTo('Root');
  }
  
  public function dealers() {
    return $this->hasMany('Dealer');
  }
}