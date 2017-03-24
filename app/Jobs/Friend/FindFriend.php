<?php

namespace App\Jobs\Friend;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use App\Models\Friend;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

class FindFriend extends Job implements SelfHandling
{
    use DispatchesJobs;

    public $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();

        $friend = Friend::where('owner_id', \Auth::user()->id)->where('friend_id', $data['friend_id'])->first();

        return $friend;


    }
}
