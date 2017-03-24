<?php

namespace App\Http\Helpers;

use Symfony\Component\HttpKernel\Exception\HttpException;

class EasemobHelper
{

    private static $ORG_NAME = '144disk';
    private static $APP_NAME = 'wechat';
    private static $CLIENT_ID = 'YXA6UojoAGNHEeWZjMGm6zwk3Q';
    private static $CLIENT_SECRET = 'YXA6vmqu0_29BcURpLdYGRV93d2S8WI';
    private static $CACHE_TOKEN_NAME = 'EasemobCacheToken';


    public static function postRequestWithHeader($url, $header = array(), $body, $method = 'POST')
    {

        array_push($header, 'Accept:application/json');
        array_push($header, 'Content-Type:application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        switch ($method) {
            case "GET" :
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                break;
            case "POST":
                curl_setopt($ch, CURLOPT_POST, true);
                break;
            case "PUT" :
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                break;
            case "DELETE":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
        }

        curl_setopt($ch, CURLOPT_USERAGENT, 'SSTS Browser/1.0');
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        if (isset($body{3}) > 0) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }
        if (count($header) > 0) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        $ret = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($ret, true);
        return $data;

    }


    //获取管理员token
    public static function getAuthToken()
    {

        if ($token = \Cache::get(static::$CACHE_TOKEN_NAME)) {

            return $token;
        } else {

            $url = "https://a1.easemob.com/" . static::$ORG_NAME . "/" . static::$APP_NAME . "/token";

            $header = array();

            $body = '{
                    "grant_type":"client_credentials",
                    "client_id":"' . static::$CLIENT_ID . '",
                    "client_secret":"' . static::$CLIENT_SECRET . '"
                }';

            $data = self::postRequestWithHeader($url, $header, $body);

            if ($data && array_key_exists('access_token', $data)) {

                \Cache::pull(static::$CACHE_TOKEN_NAME, $data['access_token'], 60 * 24 * 5);

                return $data['access_token'];

            } else {

                \Log::error('----------------获取环信管理员token失败---------------');
                return null;

            }

        }

    }


    public static function checkResultCorrect($data)
    {


        if (!$data) {

            self::throwException(null, '接口没有返回信息', 500);

        } else if (array_key_exists('error', $data)) {

            self::throwException(null, $data['error'], 500);
        }

    }


    public static function throwException($code, $message = null, $statusCode = 422)
    {

        if (is_null($message)) {

            $message = trans('error.' . $code) ? trans('error.' . $code) : trans('error.undefined');

        }

        throw new HttpException($statusCode, $message, null, [], $code);

    }


    public static function formatUserInfo($data)
    {

        if ($data && array_key_exists('entities', $data)) {

            return $data['entities'][0];

        }

        return null;

    }


} 