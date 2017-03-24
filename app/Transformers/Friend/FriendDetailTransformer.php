<?php

namespace App\Transformers\Friend;

use App\Helpers\AppHelper;
use App\Models\Customer;
use App\Models\Friend;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class FriendDetailTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [

    ];

    protected $availableIncludes = [

    ];

    public function transform(Friend $transform)
    {
        $customer = $transform->to;
        return [
            'uuid'        => $customer->uuid,
            'image_url'   => $customer && $customer->image ? AppHelper::imgSrc($customer->image->url) : '/assets/images/touxiang.png',
            'remark'      => $transform->remark,
            'is_received' => $transform->is_received,
            'type'        => $transform->type
        ];
    }
}