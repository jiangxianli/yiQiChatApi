<?php

namespace App\Jobs\Message;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

class GetTotalUnreadNum extends Job implements SelfHandling
{
    use DispatchesJobs;

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
     * 获取未读消息总数
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 10:09
     */
    public function handle()
    {
        $data = $this->request->all();

        $count = Message::where('to', \Auth::user()->id)->orderBy('created_at', 'asc')->where('is_read', false)->count();

        return $count;
    }
}
