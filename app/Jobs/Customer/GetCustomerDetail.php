<?php

namespace App\Jobs\Customer;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class GetCustomerDetail extends Job implements SelfHandling
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
     * 获取用户详情
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 9:58
     */
    public function handle()
    {
        $data = $this->request->all();

        $customer = Customer::where('uuid', $data['uuid'])->first();

        return $customer;
    }
}
