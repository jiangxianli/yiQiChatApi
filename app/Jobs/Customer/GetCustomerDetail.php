<?php

namespace App\Jobs\Customer;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class GetCustomerDetail extends Job implements SelfHandling
{
    public $request ;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();

       $customer = Customer::where('uuid',$data['uuid'])->first();

        return $customer;
    }
}
