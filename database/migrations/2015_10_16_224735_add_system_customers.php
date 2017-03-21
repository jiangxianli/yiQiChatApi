<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Helpers\EasemobHelper;
class AddSystemCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mobile = '13888888888';
        $email = '997204035@qq.com';
        $password = 'jxlandclx2015';
        $easemob_password = str_random(16);

        $easemobUser = EasemobHelper::registerEasemobUser($mobile,$easemob_password);

        if($easemobUser){

            $customer = new \App\Models\Customer();
            $customer->mobile = $mobile;
            $customer->email = $email;
            $customer->encrypted_password = \Hash::make($password);
            $customer->is_system = true;
            $customer->easemob_username = $mobile;
            $customer->easemob_password = $easemob_password;
            $customer->user_name = '系统中心';
            $customer->user_num = 'iqc_88888888';
            $customer->uuid = \App\Helpers\AppHelper::uuid();

            $customer->save();



        }
        else{
            throw new \Exception('系统环信账号注册失败!');
        }



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
