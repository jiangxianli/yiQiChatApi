<?php

namespace App\Jobs\Friend;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use App\Models\Friend;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

class FriendApply extends Job implements SelfHandling
{
    use DispatchesJobs;

    /**
     * @var Request
     */
    public $request;

    /**
     * 构造函数
     *
     * CreateCustomerQrcode constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 申请加好友
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 10:04
     */
    public function handle()
    {
        $data = $this->request->all();

        //别人加我为好友
        $customer = Customer::where('easemob_username', $data['from'])->first();

        if ($customer) {
            //别人加我
            $owner = Friend::where('owner_id', $customer->id)->where('friend_id', \Auth::user()->id)->first();
            //我加别人
            $friend = Friend::where('friend_id', $customer->id)->where('owner_id', \Auth::user()->id)->first();

            if (!$owner) {

                $owner = new Friend();
                $owner->owner_id = $customer->id;
                $owner->friend_id = \Auth::user()->id;
                $owner->is_received = false;
                $owner->is_deleted = false;
                $owner->type = $data['type'];

                $owner->save();

                if ($friend) {
                    $friend->is_received = true;
                    $owner->is_received = true;
                    $friend->save();
                    $owner->save();
                }

            }

            return $this->dispatch(new FriendApplyList($this->request));
        }
    }
}
