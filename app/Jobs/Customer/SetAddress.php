<?php

namespace App\Jobs\Customer;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class SetAddress extends Job implements SelfHandling
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
     * 设置用户地址
     *
     * @return \App\User|null
     * @author jiangxianli
     * @created_at 2019-04-24 9:59
     */
    public function handle()
    {
        $data = $this->request->all();

        $customer = \Auth::user();

        if ($customer) {
            $address = [
                'province' => $data['province'],
                'city'     => $data['city'],
                'street'   => $data['street']
            ];
            $customer->address = json_encode($address);

            $customer->save();
        }

        return $customer;
    }
}
