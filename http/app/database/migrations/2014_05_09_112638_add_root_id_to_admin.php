<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRootIdToAdmin extends Migration {
  public function up() {
    Schema::table('admins', function($table) {
      $table->integer('root_id')->unsigned()->after('id');
    });
    
    $root = Root::first();
    Admin::all()->each(function($admin) use($root) {
      $admin->root_id = $root->id;
      $admin->save();
    });
    
    Schema::table('admins', function($table) {
      $table->foreign('root_id')
            ->references('id')
            ->on('roots');
    });
  }
  
  public function down() {
    Schema::table('admins', function($table) {
      $table->dropForeign('admins_root_id_foreign');
      $table->dropColumn('root_id');
    });
  }
}