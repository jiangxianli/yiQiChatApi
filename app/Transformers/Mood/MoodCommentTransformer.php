<?php

namespace App\Transformers\Mood;


use App\Helpers\AppHelper;
use App\Models\Message;
use App\Models\Mood;
use App\Models\MoodComment;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class MoodCommentTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [

    ];

    protected $availableIncludes = [

    ];

    public function transform(MoodComment $transform)
    {

        $comment = self::getComment($transform);

//        foreach($transform->sons as $son_comment){
//
//            array_push($comment['son_comments'],self::getComment($son_comment));
//        }

        return $comment;
    }


    public static function getComment($comment){

        $customer = $comment->customer;

        $father = $comment->father;

        return [

            'id' => $comment->id,
            'image_url' => $customer && $customer->image ? AppHelper::imgSrc($customer->image->url) : '/assets/images/touxiang.png',
            'content' => $comment->content,
            'ip' => $comment->id,
            'remark' => AppHelper::getRemark($customer,null),
            'customer_uuid' => $customer->uuid,
            'father_id' => $comment->father_id,
            'father_uuid' => $father ? $father->customer->uuid : '',
            'father_remark' => $father ? AppHelper::getRemark($father->customer,null) : '',
            'son_comments' => [],
            'created_at' => $comment->created_at
        ];
    }
}