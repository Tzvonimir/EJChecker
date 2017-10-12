<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppConfigurationsTable extends Migration {
  public function up() {
    Schema::create('app_configurations', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('user_id')->unsigned()->nullable();
      $table->foreign('user_id')->references('id')->on('users')
        ->onDelete('set null');
      $table->string('key', 255);
      $table->string('value', 255);
      $table->nullableTimestamps();
    });
  }

  public function down() {
    Schema::drop('app_configurations');
  }
}
