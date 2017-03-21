<?php

namespace App\Jobs\Message;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use App\Models\Friend;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

class MsgList extends Job implements SelfHandling
{
    use DispatchesJobs;

    public $request ;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();

        $customer = Customer::where('id',$data['to'])->first();

        if($customer){

            $messages = Message::where(function($query) use ($customer){

                $query->where('from',\Auth::user()->id)->where('to',$customer->id);
            })->orWhere(function($query) use ($customer){

                $query->where('to',\Auth::user()->id)->where('from',$customer->id);
            })->orderBy('created_at','asc')->get();

            foreach($messages as $key => $message){

                if(!$message->is_read &&  $message->to == \Auth::user()->id){

                    $message->is_read = true;
                    $message->save();

                    $messages[$key] = $message;

                }
            }

            return $messages;

        }


    }
}
