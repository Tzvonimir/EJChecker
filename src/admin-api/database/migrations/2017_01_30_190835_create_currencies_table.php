<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration {

  public function up() {
    Schema::create('currencies', function (Blueprint $table) {
      $table->increments('id');
      $table->string('iso', 3);
      $table->string('name');
      $table->nullableTimestamps();
    });
  }

  public function down() {
    Schema::drop('currencies');
  }
}
