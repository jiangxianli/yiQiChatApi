<?php

namespace App\Jobs\Mood;

use App\Models\Mood;
use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateMood extends Job implements SelfHandling
{
    public $request ;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();

        $mood = new Mood();

        $mood->fill($data);

        $mood->u_num = time().rand(10000,99999);
        $mood->customer_id = \Auth::user()->id;

        $mood->save();

        if($data['images']){

            $mood->images()->sync($data['images']);

        }

    }
}
