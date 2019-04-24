<?php

namespace App\Jobs\Customer;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class CustomerFind extends Job implements SelfHandling
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
     * 查询用户
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 9:57
     */
    public function handle()
    {

        $data = $this->request->all();
        \Log::info($data);

        $customer = Customer::find($data['id']);

        return $customer;

        self::throwException('10000');
    }
}
