<?php

namespace App\Jobs\Friend;

use App\Http\Requests\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class FriendSearch extends Job implements SelfHandling
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
     * 好友列表
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 10:07
     */
    public function handle()
    {
        $data = $this->request->all();

        $customer = Customer::whereMobile($data['query'])->orWhere('easemob_username', $data['query'])->first();

        return $customer;
    }
}
