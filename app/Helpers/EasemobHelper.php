<?php

namespace App\Helpers;

class EasemobHelper {


    public static $org_name = '144disk';
    public static $app_name = 'wechat';
    public static $client_id = 'YXA6UojoAGNHEeWZjMGm6zwk3Q';
    public static $client_secret = 'YXA6vmqu0_29BcURpLdYGRV93d2S8WI';
    public static $token_name = 'EasemobToken';

    public static function postRequestWithHeader($url,$header=array(),$body,$method='POST'){

        array_push($header, 'Accept:application/json');
        array_push($header, 'Content-Type:application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        switch ($method){
            case "GET" :
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                break;
            case "POST":
                curl_setopt($ch, CURLOPT_POST,true);
                break;
            case "PUT" :
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                break;
            case "DELETE":
                curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
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

        $data = json_decode($ret,true);
        return $data;

    }

    public static function getEasemobAuthToken(){

        if($token = \Cache::get(self::$token_name)){

            return $token;
        }else{

            $url = "https://a1.easemob.com/".self::$org_name."/".self::$app_name."/token";

            $header = array();

            $body = '{
                    "grant_type":"client_credentials",
                    "client_id":"'.self::$client_id.'",
                    "client_secret":"'.self::$client_secret.'"
                }';

            $data = self::postRequestWithHeader($url,$header,$body);

            if(array_key_exists('access_token',$data)){

                \Cache::pull(self::$token_name,$data['access_token'],60*24*5);

                return $data['access_token'] ;

            }else{

                \Log::error('----------------获取环信管理员token失败---------------');
                return null;

            }

        }

    }

    public static function sendTextMsg($username){

        $auth_token = self::getEasemobAuthToken();

        if($auth_token){

            $url = "https://a1.easemob.com/".self::$org_name."/".self::$app_name."/messages";

            $header = array(
                'Authorization: Bearer '.$auth_token
            );

            $body = '{
                "target_type" : "users",
                 "target" : ["'.$username.'"],
                    "msg" : {
                        "type" : "txt",
                        "msg" : ""
                        },
                    "from" : "",
                    "ext" : {
                    }
            }';

            $data = self::postRequestWithHeader($url,$header,$body);

            if(array_key_exists('error',$data)){

                \Log::error('-------- 发送文本消息失败 ---------');

            }else{

                \Log::error('-------- 发送文本消息成功 ---------');

            }

        }else{
            \Log::info('-----------没有TOKEN-------------');
        }

    }

    public static function addFriend($owner_username,$friend_username){
        $auth_token = self::getEasemobAuthToken();

        if($auth_token){

            $url = "https://a1.easemob.com/".self::$org_name."/".self::$app_name."/users/".$owner_username."/contacts/users/".$friend_username;

            $header = array(
                'Authorization: Bearer '.$auth_token
            );

            $body = '{}';

            $data = self::postRequestWithHeader($url,$header,$body);

            if(array_key_exists('error',$data)){

                \Log::error('-------- 添加朋友失败 ---------');

            }else{

                \Log::error('-------- 添加朋友成功 ---------');

            }

        }else{
            \Log::info('-----------没有TOKEN-------------');
        }


    }

    public static function registerEasemobUser($username,$password){

        $auth_token = self::getEasemobAuthToken();

        if($auth_token) {

            $url = "https://a1.easemob.com/" . self::$org_name . "/" . self::$app_name . "/users";

            $header = array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$auth_token
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
        }else{

            return null;
            \Log::error('-----------No Easemob Token------------------');
        }
    }





} 