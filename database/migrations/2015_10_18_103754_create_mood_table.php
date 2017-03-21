<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moods', function (Blueprint $table) {
            $table->increments('id');

            $table->string('u_num')->default('');
            $table->integer('customer_id')->default(0);
            $table->text('content');
            $table->string('location')->default('');
            $table->boolean('hidden')->default(false);
            $table->integer('view_num')->default(0);
            $table->integer('praise_num')->default(0);
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
        Schema::drop('moods');
    }
}
