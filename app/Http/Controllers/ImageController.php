<?php

namespace App\Http\Controllers;

use App\Jobs\Image\ImageUpload;
use App\Transformers\Image\ImageTransformer;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * 上传图片
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:47
     */
    public function postUpload(Request $request)
    {
        $job = new ImageUpload($request);
        $image = $this->dispatch($job);

        $customer = \Auth::user();
        $customer->image_id = $image->id;
        $customer->save();

        return $this->response()->item($image, new ImageTransformer());
    }


}
