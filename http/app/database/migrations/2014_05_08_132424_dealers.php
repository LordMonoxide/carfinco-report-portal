<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dealers extends Migration {
  public function up() {
    Schema::create('dealers', function($table) {
      $table->increments('id');
      $table->string('number');
      $table->string('name_first', 30);
      $table->string('name_last', 30);
      $table->string('phone', 20);
      $table->timestamps();
    });
  }
  
  public function down() {
    Schema::drop('dealers');
  }
}