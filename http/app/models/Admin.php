<?php

class Admin extends Eloquent {
  public function user() {
    return $this->morphOne('User', 'account');
  }
}