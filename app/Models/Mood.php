<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Mood extends Model
{
    protected $table = 'moods';

    protected $fillable = ['content','location','hidden'];

    public function images(){

        return $this->belongsToMany('App\Models\Image','mood_images','mood_id','image_id');
    }

    public function customer(){

        return $this->belongsTo('App\Models\Customer','customer_id','id');
    }

    public function comments(){

        return $this->hasMany('App\Models\MoodComment','mood_id','id');
    }

    public function authPraise(){

        $customer_id = 0;
        if(\Auth::check()){

            $customer_id = \Auth::user()->id;
        }
        return $this->hasMany('App\Models\MoodPraise','mood_id','id')->where('customer_id',$customer_id);
    }


}
