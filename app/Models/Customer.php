<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class Customer extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword;

    protected $table = 'customers';

    public function friends(){

        return $this->hasMany('App\Models\Friend','owner_id','id')->where('is_received',true);
    }


    public function fromMsg(){

        return $this->hasMany('App\Models\Message','from','id');
    }

    public function toMsg(){

        return $this->hasMany('App\Models\Message','to','id');
    }

    public function image(){

        return $this->belongsTo('App\Models\Image','image_id');
    }


    public function qrcodeImage(){

        return $this->belongsTo('App\Models\Image','qrcode');
    }
}
