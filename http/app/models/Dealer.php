<?php

class Dealer extends Eloquent {
  public function user() {
    return $this->morphOne('User', 'account');
  }
  
  public function admin() {
    return $this->belongsTo('Admin');
  }
  
  public function reports() {
    return $this->hasMany('Reports');
  }
  
  public function getNameAttribute() {
    return $this->name_first . ' ' . $this->name_last;
  }
}