<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimezonesTable extends Migration {
  public function up() {
    Schema::create('timezones', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->nullableTimestamps();
    });
  }

  public function down() {
    Schema::drop('timezones');
  }
}
