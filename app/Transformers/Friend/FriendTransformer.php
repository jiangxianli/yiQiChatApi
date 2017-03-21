<?php

namespace App\Transformers\Friend;

use App\Helpers\AppHelper;
use App\Models\Customer;
use App\Models\Friend;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class FriendTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [

    ];

    protected $availableIncludes = [

    ];

    public function transform(Friend $transform)
    {
        $customer = $transform->from;
        return [
             'uuid' => $customer->uuid,
            'from' => $transform->from,
            'from_image_url' => $transform->from && $transform->from->image ? AppHelper::imgSrc($transform->from->image->url) : '/assets/images/touxiang.png',
            'remark' => $transform->remark,
            'is_received' => $transform->is_received,
            'type'  => $transform->type
         ];
    }
}