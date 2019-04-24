<?php

namespace App\Jobs\Mood;

use App\Models\Mood;
use App\Models\MoodPraise;
use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class Praise extends Job implements SelfHandling
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
     * 点赞心情
     *
     * @author jiangxianli
     * @created_at 2019-04-24 10:14
     */
    public function handle()
    {
        $data = $this->request->all();

        $mood = Mood::where('hidden', false)->where('u_num', $data['u_num'])->first();

        if ($mood) {
            $praise = new MoodPraise();
            $praise->customer_id = \Auth::user()->id;
            $praise->mood_id = $mood->id;
            $praise->ip = $this->request->getClientIp();
            $praise->save();

            $mood->praise_num += 1;
            $mood->save();
        }
    }
}
