<?php

namespace App\Jobs\Friend;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use App\Models\Friend;
use Illuminate\Contracts\Bus\SelfHandling;

class FriendApplyList extends Job implements SelfHandling
{
    public $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();

        $applies = Friend::where('friend_id', \Auth::user()->id)->where('type', 'search')->orderBy('created_at', 'desc')->get();

        return $applies;
    }
}
