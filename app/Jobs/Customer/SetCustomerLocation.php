<?php

namespace App\Jobs\Customer;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class SetCustomerLocation extends Job implements SelfHandling
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
     * 设置用定位
     *
     * @author jiangxianli
     * @created_at 2019-04-24 10:00
     */
    public function handle()
    {
        $data = $this->request->all();

        if (\Auth::check()) {

            $customer = \Auth::user();
            $customer->lng = $data['lng'];
            $customer->lat = $data['lat'];

            $customer->save();
        }
    }
}
