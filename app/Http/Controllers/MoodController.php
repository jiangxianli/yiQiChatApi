<?php

namespace App\Http\Controllers;


use App\Helpers\AppHelper;
use App\Jobs\Customer\CreateCustomerQrcode;
use App\Jobs\Customer\CustomerFind;
use App\Jobs\Customer\CustomerLogin;
use App\Jobs\Customer\CustomerRegister;
use App\Jobs\Customer\GetCustomerDetail;

use App\Jobs\Customer\NearbyCustomers;
use App\Jobs\Customer\SetAddress;
use App\Jobs\Customer\SetCustomerLocation;
use App\Jobs\Customer\SetIntro;
use App\Jobs\Customer\SetSex;
use App\Jobs\Customer\SetUserName;
use App\Jobs\Image\ImageUpload;
use App\Jobs\Mood\CreateComment;
use App\Jobs\Mood\CreateMood;
use App\Jobs\Mood\GetComment;
use App\Jobs\Mood\GetDetail;
use App\Jobs\Mood\GetList;
use App\Jobs\Mood\Praise;
use App\Models\MoodComment;
use App\Transformers\Customer\CustomerAuthTransformer;
use App\Transformers\Customer\CustomerDetailTransformer;
use App\Transformers\Customer\CustomerTransformer;

use App\Http\Requests\Customer\RegisterRequest;
use App\Http\Requests\Customer\LoginRequest;

use App\Transformers\Image\ImageTransformer;
use App\Transformers\Mood\MoodCommentTransformer;
use App\Transformers\Mood\MoodDetailTransformer;
use App\Transformers\Mood\MoodTransformer;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class MoodController extends Controller
{

    public function uploadImage(Request $request){

        $job = new ImageUpload($request);

        $image = $this->dispatch($job);

        return $this->response()->item($image,new ImageTransformer());

    }

    public function create(Request $request){

        $job = new CreateMood($request);

        $this->dispatch($job);
    }


    public function getList(Request $request){

        $job = new GetList($request);

        $moods = $this->dispatch($job);

        return $this->response()->collection($moods,new MoodDetailTransformer());


    }

    public function praiseMood(Request $request){

        $job = new Praise($request);

        $this->dispatch($job);

    }

    public function getDetail(Request $request){

        $job = new GetDetail($request);

        $mood = $this->dispatch($job);

        return $this->response()->item($mood,new MoodDetailTransformer());

    }


    public function getComments(Request $request){

        $job = new GetComment($request);

        $comments = $this->dispatch($job);

        return $this->response()->collection($comments,new MoodCommentTransformer());

    }

    public function createComment(Request $request){

        $job = new CreateComment($request);

        $comment = $this->dispatch($job);

        return $this->response()->item($comment,new MoodCommentTransformer());

    }

}
