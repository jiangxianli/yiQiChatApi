<?php

namespace App\Jobs\Mood;

use App\Models\MoodComment;
use Illuminate\Http\Request;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class GetComment extends Job implements SelfHandling
{
    public $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();

        $comments = MoodComment::with('sons.customer.image', 'father.customer')->whereHas('mood', function ($query) use ($data) {

            $query->where('u_num', $data['u_num']);

        })->orderBy('created_at', 'asc')->get();

        return $comments;

    }
}
