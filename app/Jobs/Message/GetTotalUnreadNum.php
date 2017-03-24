<?php

namespace App\Jobs\Message;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use App\Models\Friend;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

class GetTotalUnreadNum extends Job implements SelfHandling
{
    use DispatchesJobs;

    public $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();

        $count = Message::where('to', \Auth::user()->id)->orderBy('created_at', 'asc')->where('is_read', false)->count();

        return $count;

    }
}
