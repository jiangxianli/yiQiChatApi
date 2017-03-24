<?php

namespace App\Jobs\Customer;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class SetCustomerLocation extends Job implements SelfHandling
{
    public $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();

        if (\Auth::check()) {

            $customer = \Auth::user();

            $customer->lng = $data['lng'];
            $customer->lat = $data['lat'];

            $customer->save();
        }
    }
}
