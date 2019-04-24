<?php

namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    use Helpers;

    /**
     * 获取数组特定Key值
     *
     * @param $data
     * @param $key
     * @param null $default
     * @return null
     * @author jiangxianli
     * @created_at 2019-04-24 9:35
     */
    public static function getArrayDefaultVal($data, $key, $default = null)
    {
        return array_key_exists($key, $data) ? $data[$key] : $default;
    }

    /**
     * 抛出异常
     *
     * @param $code
     * @param null $message
     * @param int $statusCode
     * @author jiangxianli
     * @created_at 2019-04-24 9:35
     */
    public static function throwException($code, $message = null, $statusCode = 422)
    {
        if (is_null($message)) {
            $message = trans('error.' . $code) ? trans('error.' . $code) : trans('error.undefined');
        }

        throw new HttpException($statusCode, $message, null, [], $code);
    }
}
