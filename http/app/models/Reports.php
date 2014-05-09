<?php

// Laravel is having major issues with this class being named properly (ie. 'Report')...

class Reports extends Eloquent {
  protected $table = 'reports';
  
  public function dealer() {
    return $this->belongsTo('Dealer');
  }
}