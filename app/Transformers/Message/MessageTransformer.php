<?php

namespace App\Transformers\Message;


use App\Helpers\AppHelper;
use App\Models\Message;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class MessageTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [

    ];

    protected $availableIncludes = [

    ];

    public function transform(Message $transform)
    {
        $fromer = $transform->fromer;
        $toer = $transform->toer;
        $friend = $transform->friend;
        $customer = $transform->customer;
        return [
            'from' => $transform->from,
            'from_img_url' => $fromer && $fromer->image ? AppHelper::imgSrc($fromer->image->url) : '/assets/images/touxiang.png',
            'to_img_url' => $toer && $toer->image ? AppHelper::imgSrc($toer->image->url) : '/assets/images/touxiang.png',
            'to' => $transform->to,
            'fromer' => $fromer,
            'toer' => $toer,
            'is_received' => $transform->is_received,
            'easemob_content' => $transform->easemob_content,
            'content' => $transform->content,
            'is_system' => $transform->is_system,
            'type'  => $transform->type,
            'status' => $transform->status,
            'remark' => AppHelper::getRemark($customer,$friend)
         ];
    }
}