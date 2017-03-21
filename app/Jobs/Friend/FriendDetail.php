<?php

namespace App\Jobs\Friend;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class FriendDetail extends Job implements SelfHandling
{
    public $request ;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();

        $customer = Customer::whereId($data['id'])->whereHas('friends',function($query){
            $query->where('friend_id',\Auth::user()->id);
        })->first();

        return $customer;
    }
}
