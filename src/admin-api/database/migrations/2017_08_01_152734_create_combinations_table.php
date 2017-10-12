<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combinations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('first_number')->unsigned();
          $table->foreign('first_number')->references('id')->on('numbers')
                ->onDelete('cascade');
          $table->integer('second_number')->unsigned();
          $table->foreign('second_number')->references('id')->on('numbers')
                ->onDelete('cascade');
          $table->integer('third_number')->unsigned();
          $table->foreign('third_number')->references('id')->on('numbers')
                ->onDelete('cascade');
          $table->integer('fourth_number')->unsigned();
          $table->foreign('fourth_number')->references('id')->on('numbers')
                ->onDelete('cascade');
          $table->integer('fifth_number')->unsigned();
          $table->foreign('fifth_number')->references('id')->on('numbers')
                ->onDelete('cascade');
          $table->integer('first_extra_number')->unsigned();
          $table->foreign('first_extra_number')->references('id')->on('extra_numbers')
                ->onDelete('cascade');
          $table->integer('second_extra_number')->unsigned();
          $table->foreign('second_extra_number')->references('id')->on('extra_numbers')
                ->onDelete('cascade');
          $table->tinyInteger('is_winning')->default(0);
          $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combinations');
    }
}
