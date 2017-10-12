<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppModulesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('app_modules', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->tinyInteger('is_allowed')->default(0);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('app_modules');
  }
}
