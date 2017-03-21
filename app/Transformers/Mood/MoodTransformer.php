<?php

namespace App\Transformers\Mood;


use App\Helpers\AppHelper;
use App\Models\Message;
use App\Models\Mood;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class MoodTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [

    ];

    protected $availableIncludes = [

    ];

    public function transform(Mood $transform)
    {

        $customer = $transform->customer;


        return [
            'id' => $transform->id,
            'u_num' => $transform->u_num,
            'praise_num' => $transform->praise_num,
            'comment_num' => $transform->comments->count(),
            'image_url' => $customer && $customer->image ? AppHelper::imgSrc($customer->image->url) : '/assets/images/touxiang.png',
            'content' => $transform->content,
            'images' => self::getImageList($transform->images),
            'created_at' => $transform->created_at,
            'customer_name' => AppHelper::getRemark($customer,null)
         ];
    }


    public static  function getImageList($images){

        foreach($images as $key => $image){

            $images[$key]['url'] = AppHelper::imgSrc($images[$key]['url']);
        }

        return $images;


    }
}