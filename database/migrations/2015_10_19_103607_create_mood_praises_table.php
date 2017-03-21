<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoodPraisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mood_praises', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('customer_id')->default(0);
            $table->integer('mood_id')->default(0);

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
        Schema::drop('mood_praises');
    }
}
