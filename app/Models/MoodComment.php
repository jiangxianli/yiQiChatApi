<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class MoodComment extends Model
{
    protected $table = 'mood_comments';

    public function customer()
    {

        return $this->belongsTo('App\Models\Customer', 'customer_id');

    }

    public function mood()
    {

        return $this->belongsTo('App\Models\Mood', 'mood_id');
    }

    public function father()
    {

        return $this->belongsTo('App\Models\MoodComment', 'father_id');
    }

    public function sons()
    {

        return $this->hasMany('App\Models\MoodComment', 'father_id');
    }


}
