<?php

namespace App\Jobs\Message;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use App\Models\Friend;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

class ReceivetMsg extends Job implements SelfHandling
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
     * 接收消息
     *
     * @author jiangxianli
     * @created_at 2019-04-24 10:10
     */
    public function handle()
    {
        $data = $this->request->all();

        $message = Message::where('to', \Auth::user()->id)->where('id', $data['id'])->first();

        if ($message) {
            $message->is_received = true;
            $message->save();
        }
    }
}
