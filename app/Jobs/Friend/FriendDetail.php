<?php

namespace App\Jobs\Friend;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class FriendDetail extends Job implements SelfHandling
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
     * 好友详情
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 10:06
     */
    public function handle()
    {
        $data = $this->request->all();

        $customer = Customer::whereId($data['id'])->whereHas('friends', function ($query) {
            $query->where('friend_id', \Auth::user()->id);
        })->first();

        return $customer;
    }
}
