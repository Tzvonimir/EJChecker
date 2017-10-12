<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityTable extends Migration {
  public function up() {
    Schema::create('cities', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->integer('country_id')->unsigned();
      $table->foreign('country_id')->references('id')->on('countries')
        ->onDelete('cascade');
      $table->nullableTimestamps();
    });
  }

  public function down() {
    Schema::drop('cities');
  }
}
