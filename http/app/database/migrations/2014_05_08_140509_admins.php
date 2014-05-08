<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Admins extends Migration {
  public function up() {
    Schema::create('admins', function($table) {
      $table->increments('id');
      $table->timestamps();
    });
  }
  
  public function down() {
    Schema::drop('admins');
  }
}