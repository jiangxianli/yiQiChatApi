<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoodCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mood_comments', function (Blueprint $table) {
            $table->increments('id');

            $table->string('content',1500)->default('');

            $table->integer('father_id')->default(0);

            $table->integer('mood_id')->default(0);
            $table->integer('customer_id')->default(0);

            $table->string('ip')->default('');

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
        Schema::drop('mood_comments');
    }
}
