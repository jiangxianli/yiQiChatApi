<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('owner_id')->default(0); //

            $table->integer('friend_id')->default(0); //

            $table->boolean('is_received')->default(0); //

            $table->boolean('is_deleted')->default(0);

            $table->string('type')->default('search'); //加好友方式

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
        Schema::drop('friends');
    }
}
