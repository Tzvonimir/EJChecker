<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('users', function (Blueprint $table) {
      $table->increments('id');
      $table->string('email');
      $table->string('password');
      $table->string('first_name');
      $table->string('middle_name')->nullable();
      $table->string('last_name');
      $table->string('phone')->nullable();
      $table->string('mobile')->nullable();
      $table->tinyInteger('is_active')->default(0);
      $table->nullableTimestamps();

      /**
       * TODO
       * timezone_id
       * app_language_id
       */
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('users');
  }
}
