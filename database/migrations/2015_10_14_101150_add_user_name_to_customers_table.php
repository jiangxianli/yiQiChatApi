<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserNameToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('user_name')->default(''); //昵称
            $table->boolean('sex')->default(true); //性别
            $table->boolean('is_login')->default(false); //是否已登录
            $table->decimal('lng',11,8)->default(0);
            $table->decimal('lat',11,8)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {

            $table->dropColumn('user_name');
            $table->dropColumn('sex');
            $table->dropColumn('is_login');
            $table->dropColumn('lng');
            $table->dropColumn('lat');
        });
    }
}
