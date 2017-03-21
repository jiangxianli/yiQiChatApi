<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class Job
{
    /*
    |--------------------------------------------------------------------------
    | Queueable Jobs
    |--------------------------------------------------------------------------
    |
    | This job base class provides a central location to place any logic that
    | is shared across all of your jobs. The trait included with the class
    | provides access to the "queueOn" and "delay" queue helper methods.
    |
    */

    use Queueable;


    /**
     * 一，如果有新值，将新的值存入sssion中，返回新值
     * 二，如果session中有值，返回session中的值
     * 三，如果没有新值且session中无值，则返回默认值
     * @param $prefix session key前缀
     * @param $key    session key
     * @param $default 默认值
     * @param $data   新值
     * @return mixed
     */
    public static function getSessionDefaultVal($prefix,$key,$default,$data){


        if($data){

            session()->put($prefix.'_'.$key,$data);

        }else if( !($data = session()->get($prefix.'_'.$key)) ) {

            session()->put($prefix . '_' . $key, $default);

            $data = $default;

        }

        return $data;

    }

    public static function throwException($code,$message=null,$statusCode=422){

        if(is_null($message)){

            $message = trans('error.'.$code) ? trans('error.'.$code) : trans('error.undefined') ;

        }

        throw new HttpException($statusCode,$message,null,[],$code);

    }
}
