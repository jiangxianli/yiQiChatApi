<?php

namespace App\Jobs\Mood;

use App\Models\Mood;
use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class GetList extends Job implements SelfHandling
{
    public $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();

        $moods = Mood::orderBy('created_at', 'desc')->get();

        return $moods;

    }
}
