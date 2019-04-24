<?php

namespace App\Jobs\Mood;

use App\Models\MoodComment;
use Illuminate\Http\Request;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class GetComment extends Job implements SelfHandling
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
     * 获取心情评论
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 10:13
     */
    public function handle()
    {
        $data = $this->request->all();

        $comments = MoodComment::with('sons.customer.image', 'father.customer')->whereHas('mood', function ($query) use ($data) {
            $query->where('u_num', $data['u_num']);
        })->orderBy('created_at', 'asc')->get();

        return $comments;
    }
}
