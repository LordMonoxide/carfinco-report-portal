<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminIdToDealer extends Migration {
  public function up() {
    Schema::table('dealers', function($table) {
      $table->integer('admin_id')->unsigned()->after('id');
    });
    
    $admin = Admin::first();
    Dealer::all()->each(function($dealer) use($admin) {
      $dealer->admin_id = $admin->id;
      $dealer->save();
    });
    
    Schema::table('dealers', function($table) {
      $table->foreign('admin_id')
            ->references('id')
            ->on('admins');
    });
  }
  
  public function down() {
    Schema::table('dealers', function($table) {
      $table->dropForeign('dealers_admin_id_foreign');
      $table->dropColumn('admin_id');
    });
  }
}