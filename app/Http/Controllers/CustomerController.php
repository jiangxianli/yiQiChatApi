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
use App\Transformers\Customer\CustomerAuthTransformer;
use App\Transformers\Customer\CustomerDetailTransformer;
use App\Transformers\Customer\CustomerTransformer;

use App\Http\Requests\Customer\RegisterRequest;
use App\Http\Requests\Customer\LoginRequest;

use App\Transformers\Image\ImageTransformer;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function postRegister(RegisterRequest $request)
    {

        $job = new CustomerRegister($request);

        $customer = $this->dispatch($job);

        $token = JWTAuth::fromUser($customer);

        return $this->response()->item($customer, new CustomerAuthTransformer())->addMeta('token', $token);
    }

    public function postLogin(LoginRequest $request)
    {

        $job = new CustomerLogin($request);

        $customer = $this->dispatch($job);

        $token = JWTAuth::fromUser($customer);

        return $this->response()->item($customer, new CustomerAuthTransformer())->addMeta('token', $token);

    }

    public function postGetAuthInfo(Request $request)
    {

        \Log::info(\Auth::check());

        $customer = \Auth::user();

        $point = AppHelper::ipToPoint($request->getClientIp());

        if ($point) {

            $customer->lat = $point['y'];
            $customer->lng = $point['x'];
            $customer->save();
        }

        $token = JWTAuth::fromUser($customer);

        return $this->response()->item($customer, new CustomerAuthTransformer())->addMeta('token', $token);

    }

    public function postFindById(Request $request)
    {

        $job = new CustomerFind($request);

        $customer = $this->dispatch($job);

        \Log::info($customer);

        return $this->response()->item($customer, new CustomerTransformer());
    }

    //设置定位信息
    public function setLocation(Request $request)
    {

        $job = new SetCustomerLocation($request);

        $this->dispatch($job);

    }

    public function getNearbyCustomers(Request $request)
    {

        $job = new NearbyCustomers($request);

        $customers = $this->dispatch($job);

        return $this->response()->collection($customers, new CustomerTransformer());

    }

    public function getDetail(Request $request)
    {

        $job = new GetCustomerDetail($request);

        $customer = $this->dispatch($job);

        return $this->response()->item($customer, new CustomerDetailTransformer());

    }

    public function createQrcode(Request $request)
    {

        $job = new CreateCustomerQrcode($request);

        $customer = $this->dispatch($job);

        return $this->response()->item($customer, new CustomerAuthTransformer());


    }

    public function setAddress(Request $request)
    {

        $job = new SetAddress($request);

        $customer = $this->dispatch($job);

        return $this->response()->item($customer, new CustomerAuthTransformer());

    }

    public function setUserName(Request $request)
    {

        $job = new SetUserName($request);

        $customer = $this->dispatch($job);

        return $this->response()->item($customer, new CustomerAuthTransformer());
    }

    public function setIntro(Request $request)
    {

        $job = new SetIntro($request);

        $customer = $this->dispatch($job);

        return $this->response()->item($customer, new CustomerAuthTransformer());

    }

    public function setSex(Request $request)
    {

        $job = new SetSex($request);

        $customer = $this->dispatch($job);

        return $this->response()->item($customer, new CustomerAuthTransformer());

    }

    public function uploadCustomerImage(Request $request)
    {

        $job = new ImageUpload($request);

        $image = $this->dispatch($job);

        $customer           = \Auth::user();
        $customer->image_id = $image->id;
        $customer->save();

        return $this->response()->item($image, new ImageTransformer());
    }

}
