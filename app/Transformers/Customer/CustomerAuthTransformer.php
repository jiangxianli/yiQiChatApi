<?php

namespace App\Transformers\Customer;

use App\Helpers\AppHelper;
use App\Models\Customer;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class CustomerAuthTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [

    ];

    protected $availableIncludes = [

    ];

    public function transform(Customer $transform)
    {
        $image  = $transform->image;
        $qrcode = $transform->qrcodeImage;

        return [
            'uuid'             => $transform->uuid,
            'user_num'         => $transform->user_num,
            'id'               => $transform->id,
            'mobile'           => $transform->mobile,
            'email'            => $transform->email,
            'easemob_username' => $transform->easemob_username,
            'easemob_password' => $transform->easemob_password,
            'image_url'        => $image ? AppHelper::imgSrc($image->url) : '/assets/images/touxiang.png',
            'lng'              => $transform->lng,
            'lat'              => $transform->lat,
            'intro'            => $transform->intro,
            'sex'              => $transform->sex,
            'user_name'        => $transform->user_name,
            'qrcode'           => $qrcode ? AppHelper::imgSrc($qrcode->url) : null,
            'address'          => json_decode($transform->address),
            'remark'           => AppHelper::getRemark($transform, null)
        ];
    }
}