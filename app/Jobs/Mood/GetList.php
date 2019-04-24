<?php

namespace App\Jobs\Mood;

use App\Models\Mood;
use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class GetList extends Job implements SelfHandling
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
     * 获取心情列表
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 10:14
     */
    public function handle()
    {
        $data = $this->request->all();

        $moods = Mood::orderBy('created_at', 'desc')->get();

        return $moods;
    }
}
