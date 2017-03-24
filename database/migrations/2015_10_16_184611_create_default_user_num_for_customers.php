<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultUserNumForCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $customers = \App\Models\Customer::all();

        foreach ($customers as $customer) {

            $customer->user_num = 'iqc_' . time() . rand(10000, 99999);
            $customer->save();
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
