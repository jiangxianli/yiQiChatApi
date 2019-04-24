<?php

namespace App\Jobs\Friend;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use App\Models\Friend;
use Illuminate\Contracts\Bus\SelfHandling;

class FriendApplyList extends Job implements SelfHandling
{
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
     * 好友申请列表
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 10:06
     */
    public function handle()
    {
        $data = $this->request->all();

        $applies = Friend::where('friend_id', \Auth::user()->id)->where('type', 'search')->orderBy('created_at', 'desc')->get();

        return $applies;
    }
}
