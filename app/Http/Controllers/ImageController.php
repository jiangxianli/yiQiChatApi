<?php

namespace App\Http\Controllers;

use App\Jobs\Friend\FriendAgree;
use App\Jobs\Image\ImageUpload;
use App\Transformers\Image\ImageTransformer;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    public function postUpload(Request $request){

        $job = new ImageUpload($request);

        $image = $this->dispatch($job);

        $customer = \Auth::user();
        $customer->image_id = $image->id;
        $customer->save();

        return $this->response()->item($image,new ImageTransformer());
    }


}
