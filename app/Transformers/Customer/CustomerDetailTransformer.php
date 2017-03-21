<?php

namespace App\Transformers\Customer;

use App\Helpers\AppHelper;
use App\Models\Customer;
use App\Models\Friend;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class CustomerDetailTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [

    ];

    protected $availableIncludes = [

    ];

    public function transform(Customer $transform)
    {
        $is_friend = false;
        $friend = null;

        if(\Auth::check()){

            $customer = \Auth::user();

            $friend = Friend::where('owner_id',$customer->id)->where('friend_id',$transform->id)->where('is_received',true)->first();

            if($friend){

                $is_friend = true;
            }
        }

        $image = $transform->image;
        return [
            'id' => $transform->id,
            'easemob_username' => $transform->easemob_username,
            'image_url' => $image ? AppHelper::imgSrc($image->url) : '/assets/images/touxiang.png',
            'uuid' => $transform->uuid,
            'user_name' => $transform->user_name,
            'user_num' => $transform->user_num,
            'address'=>json_decode($transform->address),
            'is_friend' => $is_friend,
            'remark' => AppHelper::getRemark($transform,$friend)
         ];
    }
}