<?php

namespace App\Jobs\Friend;

use App\Http\Requests\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class FriendSearch extends Job implements SelfHandling
{
    public $request ;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();

        $customer = Customer::whereMobile($data['query'])->orWhere('easemob_username',$data['query'])->first();

        return $customer;
    }
}
