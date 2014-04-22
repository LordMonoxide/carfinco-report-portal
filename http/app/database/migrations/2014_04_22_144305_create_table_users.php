<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration {
  public function up() {
    Schema::create('users', function($table) {
      $table->increments('id');
      $table->string('email');
      $table->string('password');
      $table->string('name_first', 30);
      $table->string('name_last', 30);
      $table->string('phone', 20);
      
      $table->string('remember_token', 100)->nullable();
      
      $table->timestamps();
    });
  }
  
  public function down() {
    Schema::drop('users');
  }
}