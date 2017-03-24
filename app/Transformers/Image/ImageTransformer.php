<?php

namespace App\Transformers\Image;


use App\Helpers\AppHelper;
use App\Models\Image;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class ImageTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [

    ];

    protected $availableIncludes = [

    ];

    public function transform(Image $transform)
    {
        return [
            'id'        => $transform->id,
            'url'       => AppHelper::imgSrc($transform->url),
            'extension' => $transform->extension
        ];
    }
}