<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Report extends Migration {
  public function up() {
    Schema::create('reports', function($table) {
      $table->increments('id');
      $table->integer('dealer_id')->unsigned();
      $table->string('number');
      $table->timestamps();
      
      $table->foreign('dealer_id')
            ->references('id')
            ->on('dealers');
    });
  }
  
  public function down() {
    Schema::drop('reports');
  }
}