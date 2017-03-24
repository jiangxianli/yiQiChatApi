<?php

namespace App\Jobs\Friend;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use App\Models\Friend;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

class FriendAgree extends Job implements SelfHandling
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

        //别人加我为好友
        $customer = Customer::where('easemob_username', $data['to'])->first();

        if ($customer) {
            //别人加我
            $owner = Friend::where('owner_id', $customer->id)->where('friend_id', \Auth::user()->id)->first();
            //我加别人
            $friend = Friend::where('friend_id', $customer->id)->where('owner_id', \Auth::user()->id)->first();

            if (!$friend) {

                $friend = new Friend();

                $friend->owner_id = \Auth::user()->id;

                $friend->friend_id = $customer->id;

                $friend->is_received = true;

                $friend->is_deleted = false;

                $friend->type = $data['type'];

                $friend->save();

                if ($owner) {

                    $owner->is_received = true;

                    $owner->save();
                }

            }


            return $this->dispatch(new FriendApplyList($this->request));

        }


    }
}
