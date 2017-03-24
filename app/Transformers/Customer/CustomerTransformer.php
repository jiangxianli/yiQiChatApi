<?php

namespace App\Transformers\Customer;

use App\Helpers\AppHelper;
use App\Models\Customer;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class CustomerTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [

    ];

    protected $availableIncludes = [

    ];

    public function transform(Customer $transform)
    {
        $image = $transform->image;
        return [
            'id'               => $transform->id,
            'easemob_username' => $transform->easemob_username,
            'image_url'        => $image ? AppHelper::imgSrc($image->url) : '/assets/images/touxiang.png',
            'uuid'             => $transform->uuid,
            'intro'            => $transform->intro,
            'user_name'        => $transform->user_name,
            'user_num'         => $transform->user_num,
            'lng'              => $transform->lng,
            'lat'              => $transform->lat
        ];
    }
}