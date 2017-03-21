<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name')->default(''); //名称

            $table->string('url')->default(''); //url

            $table->string('path')->default(''); //path

            $table->string('extension')->default(''); //extension

            $table->string('alt')->default('');

            $table->integer('size')->default(0); //size

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('images');
    }
}
