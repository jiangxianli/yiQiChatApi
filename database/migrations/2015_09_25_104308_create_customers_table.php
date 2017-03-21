<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {

            $table->increments('id');

            $table->string('mobile')->default(''); //手机号码

            $table->string('encrypted_password')->default('');//密码

            $table->string('email')->default('');//邮箱地址

            $table->string('remember_token')->default('');//remember_token


            $table->integer('image_id')->default(0); //头像

            $table->string('openid')->default(''); //openid

            $table->text('wechat_userinfo')->nullable(); //openid

            $table->string('easemob_username')->default(''); //环信用户名

            $table->string('easemob_password')->default(''); //环信密码


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
        Schema::drop('customers');
    }
}
