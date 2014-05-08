<?php

class Dealer extends Eloquent {
  public function user() {
    return $this->morphOne('User', 'account');
  }
}