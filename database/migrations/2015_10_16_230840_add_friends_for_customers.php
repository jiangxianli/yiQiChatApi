<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Helpers\EasemobHelper;

class AddFriendsForCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $customers = \App\Models\Customer::all();
        $mobile = '13888888888';

        foreach ($customers as $customer) {
            if ($customer->easemob_username == $mobile) {
                continue;
            }
            EasemobHelper::addFriend($mobile, $customer->easemob_username);
            EasemobHelper::addFriend($customer->easemob_username, $mobile);
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
