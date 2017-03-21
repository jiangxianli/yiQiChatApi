<?php

namespace App\Jobs\Customer;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class SetAddress extends Job implements SelfHandling
{
    public $request ;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();

        $customer = \Auth::user();

        if($customer){

            $address = [
                'province' => $data['province'],
                'city' => $data['city'],
                'street' => $data['street']
            ];

            $customer->address = json_encode($address);

            $customer->save();

        }

        return $customer;
    }
}
