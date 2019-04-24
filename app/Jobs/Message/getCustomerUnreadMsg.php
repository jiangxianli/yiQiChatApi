<?php

namespace App\Jobs\Message;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use App\Models\Friend;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

class getCustomerUnreadMsg extends Job implements SelfHandling
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
     * 获取用户未读消息
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 10:09
     */
    public function handle()
    {
        $data = $this->request->all();

        $customer = Customer::where('id', $data['to'])->first();

        if ($customer) {
            $messages = Message::where(function ($query) use ($customer) {
                $query->where('to', \Auth::user()->id)->where('from', $customer->id);
            })->orderBy('created_at', 'asc')->where('is_read', false)->get();

            return $messages;
        }
    }
}
