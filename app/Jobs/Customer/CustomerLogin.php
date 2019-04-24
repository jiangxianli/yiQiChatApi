<?php

namespace App\Jobs\Customer;

use App\Http\Requests\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class CustomerLogin extends Job implements SelfHandling
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
     * 用户登录
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 9:58
     */
    public function handle()
    {
        $data = $this->request->all();

        $customer = Customer::whereMobile($data['account'])->first();

        if ($customer) {
            if (!\Hash::check($data['password'], $customer->encrypted_password)) {
                self::throwException('10001');
            } else {
                return $customer;
            }

        }

        self::throwException('10000');
    }
}
