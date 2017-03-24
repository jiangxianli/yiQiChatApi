<?php

namespace App\Jobs\Message;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use App\Models\Friend;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

class unreadMsgList extends Job implements SelfHandling
{
    use DispatchesJobs;

    public $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {
        \Log::info('-------------------------');

        $data = $this->request->all();

        $messages = Message::where(function ($query) {

            $query->where('from', \Auth::user()->id)->orWhere('to', \Auth::user()->id);

        })->orderBy('created_at', 'desc')->get();


        $customer_list = [];

        $max_count = $messages->count();
        $cur_count = 0;

        while ($max_count && $cur_count < $max_count) {

            $message = $messages->get($cur_count);

            //我发送的
            if ($message->from == \Auth::user()->id) {

                if (in_array($message->to, $customer_list)) {

                    $messages->splice($cur_count, 1);

                } else {

                    $cur_count++;
                    array_push($customer_list, $message->to);
                }


            } else {

                if (in_array($message->from, $customer_list)) {

                    $messages->splice($cur_count, 1);

                } else {

                    $cur_count++;
                    array_push($customer_list, $message->from);
                }

            }

            $max_count = $messages->count();


        }

        return $messages;

    }
}
