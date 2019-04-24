<?php

namespace App\Jobs\Friend;

use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use App\Models\Friend;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SetRemark extends Job implements SelfHandling
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
     * 设置好友备注
     *
     * @author jiangxianli
     * @created_at 2019-04-24 10:07
     */
    public function handle()
    {
        $data = $this->request->all();

        $friend = Friend::where('owner_id', \Auth::user()->id)->where('friend_id', $data['friend_id'])->first();

        if ($friend) {
            $friend->remark = $data['remark'];
            $friend->save();
        }
    }
}
