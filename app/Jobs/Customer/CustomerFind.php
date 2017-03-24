<?php

namespace App\Jobs\Customer;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class CustomerFind extends Job implements SelfHandling
{
    public $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();
        \Log::info($data);

        $customer = Customer::find($data['id']);

        return $customer;

        self::throwException('10000');
    }
}
