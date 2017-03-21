<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('from')->default(0); //发送者ID

            $table->integer('to')->default(0); // 接收者ID

            $table->string('from_name')->default(0); //环信发送者name

            $table->string('to_name')->default(0); //环信接收者name

            $table->boolean('is_received')->default(false); //被接收

            $table->boolean('is_deleted')->default(false); //被发送者删除

            $table->boolean('is_remove')->default(false); //被接收者移除列表

            $table->text('easemob_content')->nullable(); //消息json数据

            $table->string('type')->default('text'); //消息类型 text image video position

            $table->string('place')->default('chat'); // chat or room

            $table->boolean('is_system')->default(false); //系统消息


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
        Schema::drop('messages');
    }
}
