<?php

class Report extends Eloquent {
  public function dealer() {
    return $this->belongsTo('Dealer');
  }
}