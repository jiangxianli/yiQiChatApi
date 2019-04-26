<?php

namespace App\Jobs\Mood;

use App\Models\Mood;
use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateMood extends Job implements SelfHandling
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
     * 发布心情
     *
     * @author jiangxianli
     * @created_at 2019-04-24 10:13
     */
    public function handle()
    {
        $data = $this->request->all();

        if (empty($data['content']) || empty(trim($data['content']))) {
            self::throwException(20001);
        }

        $mood = new Mood();
        $mood->fill($data);
        $mood->u_num = time() . rand(10000, 99999);
        $mood->customer_id = \Auth::user()->id;

        $mood->save();

        if ($data['images']) {
            $mood->images()->sync($data['images']);
        }
    }
}
