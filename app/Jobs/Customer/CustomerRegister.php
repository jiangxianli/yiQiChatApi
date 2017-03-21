<?php

namespace App\Jobs\Customer;

use App\Helpers\AppHelper;
use App\Http\Requests\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

use App\Helpers\EasemobHelper;

class CustomerRegister extends Job implements SelfHandling
{
    public $request ;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();

        $customer = new Customer();

        $customer->mobile = $data['account'];

        $customer->encrypted_password = \Hash::make($data['password']);

        $customer->easemob_username = $data['account'];

        $customer->easemob_password = rand(1000,9999).rand(1000,9999);

        $customer->uuid = AppHelper::uuid();

        $customer->user_num = 'iqc_'.time().rand(10000,99999);

        $system = Customer::where('is_system',true)->first();

        EasemobHelper::registerEasemobUser($customer->easemob_username,$customer->easemob_password);

        EasemobHelper::addFriend($system->easemob_username,$customer->easemob_username);
        EasemobHelper::addFriend($customer->easemob_username,$system->easemob_username);

        $customer->save();

        return $customer;

    }
}
