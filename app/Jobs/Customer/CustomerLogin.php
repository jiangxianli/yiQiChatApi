<?php

namespace App\Jobs\Customer;

use App\Http\Requests\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class CustomerLogin extends Job implements SelfHandling
{
    public $request ;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();

        $customer = Customer::whereMobile($data['account'])->first();

        if($customer){

            if(!\Hash::check($data['password'],$customer->encrypted_password)){

               self::throwException('10001') ;

            }

            else{

                return $customer;
            }

        }

        self::throwException('10000') ;
    }
}
