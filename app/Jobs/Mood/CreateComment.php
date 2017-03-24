<?php

namespace App\Jobs\Mood;

use App\Models\Mood;
use App\Models\MoodComment;
use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateComment extends Job implements SelfHandling
{
    public $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();

        $comment = new MoodComment();

        $comment->mood_id     = $data['mood_id'];
        $comment->customer_id = \Auth::user()->id;
        $comment->ip          = $this->request->getClientIp();

        $comment->content   = $data['content'];
        $comment->father_id = $data['father_id'];

        $comment->save();

        return $comment;

    }
}
