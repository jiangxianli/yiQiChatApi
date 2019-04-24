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
     * 好友列表
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 10:06
     */
    public function handle()
    {
        $friends = Customer::whereHas('friends', function ($query) {
            $query->where('friend_id', \Auth::user()->id);
        })->get();

        return $friends;
    }
}
