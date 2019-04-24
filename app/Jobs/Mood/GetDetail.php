<?php

namespace App\Jobs\Mood;

use App\Models\Mood;
use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class GetDetail extends Job implements SelfHandling
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
     * 获取心情详情
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 10:13
     */
    public function handle()
    {
        $data = $this->request->all();

        $mood = Mood::where('hidden', false)->where('u_num', $data['u_num'])->first();

        return $mood;
    }
}
