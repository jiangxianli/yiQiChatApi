<?php

namespace App\Helpers;

/**
 * 环信聊天
 *
 * Class EasemobHelper
 * @package App\Helpers
 * @author jiangxianli
 * @created_at 2019-04-22 11:32
 */
class EasemobHelper
{
    public static $org_name;
    public static $app_name;
    public static $client_id;
    public static $client_secret;
    public static $token_name = 'EasemobToken';

    /**
     * 构造函数
     *
     * EasemobHelper constructor.
     */
    public static function initConfig()
    {
        self::$org_name = config('easemob.org_name');
        self::$app_name = config('easemob.app_name');
        self::$client_id = config('easemob.client_id');
        self::$client_secret = config('easemob.client_secret');
    }

    /**
     * 公共请求方法
     *
     * @param $url
     * @param array $header
     * @param $body
     * @param string $method
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-22 11:33
     */
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
        if (!empty($body)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }
        if (count($header) > 0) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        $ret = curl_exec($ch);
        curl_close($ch);
        \Log::info(json_encode([$ret, $url, $header, $body]));
        $data = json_decode($ret, true);
        return $data;

    }

    /**
     * 获取环信Token
     *
     * @return mixed|null
     * @author jiangxianli
     * @created_at 2019-04-22 11:33
     */
    public static function getEasemobAuthToken()
    {
        self::initConfig();

        if ($token = \Cache::get(self::$token_name)) {
            return $token;
        } else {

            $url = "https://a1.easemob.com/" . self::$org_name . "/" . self::$app_name . "/token";
            $header = array();

            $body = '{
                    "grant_type":"client_credentials",
                    "client_id":"' . self::$client_id . '",
                    "client_secret":"' . self::$client_secret . '"
                }';

            $data = self::postRequestWithHeader($url, $header, $body);
            if (array_key_exists('access_token', $data)) {
                \Cache::pull(self::$token_name, $data['access_token'], 60 * 24 * 5);
                return $data['access_token'];

            } else {
                \Log::error('----------------获取环信管理员token失败---------------');
                return null;
            }
        }

    }

    /**
     * 发送缓存消息
     *
     * @param $username
     * @author jiangxianli
     * @created_at 2019-04-24 9:33
     */
    public static function sendTextMsg($username)
    {
        self::initConfig();

        $auth_token = self::getEasemobAuthToken();

        if ($auth_token) {

            $url = "https://a1.easemob.com/" . self::$org_name . "/" . self::$app_name . "/messages";

            $header = array(
                'Authorization: Bearer ' . $auth_token
            );

            $body = '{
                "target_type" : "users",
                 "target" : ["' . $username . '"],
                    "msg" : {
                        "type" : "txt",
                        "msg" : ""
                        },
                    "from" : "",
                    "ext" : {
                    }
            }';

            $data = self::postRequestWithHeader($url, $header, $body);

            if (array_key_exists('error', $data)) {
                \Log::error('-------- 发送文本消息失败 ---------');

            } else {
                \Log::info('-------- 发送文本消息成功 ---------');

            }
        } else {
            \Log::error('-----------没有TOKEN-------------');
        }

    }

    /**
     * 添加好友
     *
     * @param $owner_username
     * @param $friend_username
     * @author jiangxianli
     * @created_at 2019-04-24 9:33
     */
    public static function addFriend($owner_username, $friend_username)
    {
        self::initConfig();

        $auth_token = self::getEasemobAuthToken();

        if ($auth_token) {
            $url = "https://a1.easemob.com/" . self::$org_name . "/" . self::$app_name . "/users/" . $owner_username . "/contacts/users/" . $friend_username;
            $header = array(
                'Authorization: Bearer ' . $auth_token
            );

            $body = '{}';

            $data = self::postRequestWithHeader($url, $header, $body);

            if (array_key_exists('error', $data)) {
                \Log::error('-------- 添加朋友失败 ---------');
            } else {
                \Log::info('-------- 添加朋友成功 ---------');
            }
        } else {
            \Log::error('-----------没有TOKEN-------------');
        }
    }

    /**
     * 注册环信用户
     *
     * @param $username
     * @param $password
     * @return null
     * @author jiangxianli
     * @created_at 2019-04-24 9:34
     */
    public static function registerEasemobUser($username, $password)
    {
        self::initConfig();

        $auth_token = self::getEasemobAuthToken();

        if ($auth_token) {

            $url = "https://a1.easemob.com/" . self::$org_name . "/" . self::$app_name . "/users";

            $header = array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $auth_token
            );

            $body = '{
                "username":"' . $username . '",
                "password":"' . $password . '"
            }';

            $data = self::postRequestWithHeader($url, $header, $body);

            if (array_key_exists('error', $data)) {
                return null;
            } else {
                return $data['entities'][0];
            }
        } else {
            \Log::error('-----------没有TOKEN-------------');
            return null;
        }
    }


}