<?php

namespace App\Jobs\Friend;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use App\Models\Friend;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

class FriendList extends Job implements SelfHandling
{
    use DispatchesJobs;



    public function __construct()
    {

    }


    public function handle()
    {


        $friends = Customer::whereHas('friends',function($query){

            $query->where('friend_id',\Auth::user()->id);

        })->get();

        return $friends;

    }
}
