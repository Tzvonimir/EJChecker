<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppLanguagesTable extends Migration
{
  public function up() {
    Schema::create('app_languages', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->nullableTimestamps();
    });
  }

  public function down() {
    Schema::drop('app_languages');
  }
}
