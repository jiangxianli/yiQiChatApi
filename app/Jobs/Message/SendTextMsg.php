<?php

namespace App\Jobs\Message;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use App\Models\Friend;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SendTextMsg extends Job implements SelfHandling
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
     * 发送文本消息
     *
     * @author jiangxianli
     * @created_at 2019-04-24 10:11
     */
    public function handle()
    {
        $data = $this->request->all();
        \Log::info($data);

        $customer = Customer::where('id', $data['to'])->first();

        if ($customer) {

            $message = new Message();
            $message->to = $customer->id;
            $message->to_name = $customer->easemob_username;
            $message->from = \Auth::user()->id;
            $message->from_name = \Auth::user()->easemob_username;
            $message->is_received = false;
            $message->is_deleted = false;
            $message->is_remove = false;
            $message->content = $data['content'];
            $message->type = 'text';
            $message->is_system = false;
            $message->save();
        }
    }
}
