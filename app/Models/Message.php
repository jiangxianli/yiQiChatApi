<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
    protected $table = 'messages';

    public function fromer(){

        return $this->belongsTo('App\Models\Customer','from','id');
    }

    public function toer(){

        return $this->belongsTo('App\Models\Customer','to','id');

    }

    public function friend(){

        if($this->attributes['from'] == \Auth::user()->id){

            return $this->belongsTo('App\Models\Friend','to','friend_id')->where('owner_id',\Auth::user()->id);
        }
        else {
            return $this->belongsTo('App\Models\Friend','from','friend_id')->where('owner_id',\Auth::user()->id);
        }


    }

    public function customer(){

        if($this->attributes['from'] == \Auth::user()->id){

            return $this->belongsTo('App\Models\Customer','to','id');
        }
        else {
            return $this->belongsTo('App\Models\Customer','from','id');
        }


    }

    protected $appends = [
        'status'
    ];

    public function getStatusAttribute()
    {
        if($this->attributes['is_read']){

            return '已读';
        }

        return $this->attributes['is_received'] ? '已发送':'已送达';

    }



}
