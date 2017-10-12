<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name', 255)->nullable();
          $table->string('filename', 255)->nullable();
          $table->string('description')->nullable();
          $table->string('original_filename', 255);
          $table->integer('filesize');
          $table->string('mime_type', 255);
          $table->integer('documentable_id');
          $table->string('documentable_type', 255);
          $table->integer('uploaded_by_id')->unsigned()->nullable();
          $table->foreign('uploaded_by_id')->references('id')->on('users');
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
        Schema::dropIfExists('media');
    }
}
