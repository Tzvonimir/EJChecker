<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionRoleTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('action_role', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('action_id')->unsigned();
      $table->foreign('action_id')->references('id')->on('actions')
        ->onDelete('cascade');
      $table->integer('role_id')->unsigned();
      $table->foreign('role_id')->references('id')->on('roles')
        ->onDelete('cascade');
      $table->tinyInteger('is_allowed')->default(0);
      $table->nullableTimestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('action_role');
  }
}
