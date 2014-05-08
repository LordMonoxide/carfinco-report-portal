<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Roots extends Migration {
  public function up() {
    Schema::create('roots', function($table) {
      $table->increments('id');
      $table->timestamps();
    });
  }
  
  public function down() {
    Schema::drop('roots');
  }
}