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

    /**
     * 用户注册
     *
     * @param RegisterRequest $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:35
     */
    public function postRegister(RegisterRequest $request)
    {
        $job = new CustomerRegister($request);

        $customer = $this->dispatch($job);

        $token = JWTAuth::fromUser($customer);

        return $this->response()->item($customer, new CustomerAuthTransformer())->addMeta('token', $token);
    }

    /**
     * 用户登录
     *
     * @param LoginRequest $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:36
     */
    public function postLogin(LoginRequest $request)
    {
        $job = new CustomerLogin($request);

        $customer = $this->dispatch($job);

        $token = JWTAuth::fromUser($customer);

        return $this->response()->item($customer, new CustomerAuthTransformer())->addMeta('token', $token);
    }

    /**
     * 获取登录用户信息
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:36
     */
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

    /**
     * 查找用户信息
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:37
     */
    public function postFindById(Request $request)
    {
        $job = new CustomerFind($request);

        $customer = $this->dispatch($job);

        \Log::info($customer);

        return $this->response()->item($customer, new CustomerTransformer());
    }

    /**
     * 设置用户定位信息
     *
     * @param Request $request
     * @author jiangxianli
     * @created_at 2019-04-24 9:37
     */
    public function setLocation(Request $request)
    {
        $job = new SetCustomerLocation($request);

        $this->dispatch($job);
    }

    /**
     * 获取附近用户列表
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:37
     */
    public function getNearbyCustomers(Request $request)
    {
        $job = new NearbyCustomers($request);

        $customers = $this->dispatch($job);

        return $this->response()->collection($customers, new CustomerTransformer());
    }

    /**
     * 获取用户详情
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:37
     */
    public function getDetail(Request $request)
    {
        $job = new GetCustomerDetail($request);

        $customer = $this->dispatch($job);

        return $this->response()->item($customer, new CustomerDetailTransformer());
    }

    /**
     * 获取用户二维码
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:38
     */
    public function createQrcode(Request $request)
    {
        $job = new CreateCustomerQrcode($request);

        $customer = $this->dispatch($job);

        return $this->response()->item($customer, new CustomerAuthTransformer());
    }

    /**
     * 设置用户地址
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:38
     */
    public function setAddress(Request $request)
    {
        $job = new SetAddress($request);

        $customer = $this->dispatch($job);

        return $this->response()->item($customer, new CustomerAuthTransformer());
    }

    /**
     * 设置用户昵称
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:38
     */
    public function setUserName(Request $request)
    {
        $job = new SetUserName($request);

        $customer = $this->dispatch($job);

        return $this->response()->item($customer, new CustomerAuthTransformer());
    }

    /**
     * 设置用户简介
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:39
     */
    public function setIntro(Request $request)
    {
        $job = new SetIntro($request);

        $customer = $this->dispatch($job);

        return $this->response()->item($customer, new CustomerAuthTransformer());
    }

    /**
     * 设置用户性别
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:39
     */
    public function setSex(Request $request)
    {
        $job = new SetSex($request);

        $customer = $this->dispatch($job);

        return $this->response()->item($customer, new CustomerAuthTransformer());
    }

    /**
     * 设置用户头像
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:39
     */
    public function uploadCustomerImage(Request $request)
    {
        $job = new ImageUpload($request);

        $image = $this->dispatch($job);

        $customer = \Auth::user();
        $customer->image_id = $image->id;
        $customer->save();

        return $this->response()->item($image, new ImageTransformer());
    }

}
