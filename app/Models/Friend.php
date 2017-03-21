<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Friend extends Model
{
    protected $table = 'friends';

    public function from(){

        return $this->belongsTo('App\Models\Customer','owner_id','id');
    }

    public function to(){

        return $this->belongsTo('App\Models\Customer','friend_id','id');
    }


}
