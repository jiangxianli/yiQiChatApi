<?php

namespace App\Helpers;

class AppHelper
{


    public static function imgSrc(/* String */
        $url, $options = array())
    {
        $type         = AppHelper::getOption($options, 'type') ? AppHelper::getOption($options, 'type') : 'c';
        $width        = AppHelper::getOption($options, 'width');
        $height       = AppHelper:: getOption($options, 'height');
        $alter_url    = AppHelper::getOption($options, 'alter_url');
        $combined_url = $url ? ltrim($url, '\/') : $alter_url;
        if ($width && $height && $type) {
            $size_url = "/$type/{$width}x{$height}/";
        } else {
            $size_url = '/';
        }
        $fixed_url = \URL::asset(env('IMAGE_DOMAIN') . $size_url . $combined_url);
        return $fixed_url;
    }

    /**
     * Get option value from options
     * @param $options Option values
     * @param $key Option key
     * @param $default If option has not cotain key, this value will be returned instead
     * @return $options[$key] or $default if previous is null
     */
    public static function getOption($options, $key, $default = null)
    {
        return key_exists($key, $options) ? array_pull($options, $key) : $default;
    }


    /**
     *计算某个经纬度的周围某段距离的正方形的四个点
     *
     * @param lng float 经度
     * @param lat float 纬度
     * @param distance float 该点所在圆的半径，该圆与此正方形内切，默认值为0.5千米
     * @return array 正方形的四个点的经纬度坐标
     */
    public static function returnSquarePoint($lng, $lat, $distance = 0.5)
    {

//        define(EARTH_RADIUS, 6371);//地球半径，平均半径为6371km
        $EARTH_RADIUS = 6371;

        $dlng = 2 * asin(sin($distance / (2 * $EARTH_RADIUS)) / cos(deg2rad($lat)));
        $dlng = rad2deg($dlng);

        $dlat = $distance / $EARTH_RADIUS;
        $dlat = rad2deg($dlat);

        return array(
            'left-top'     => array('lat' => $lat + $dlat, 'lng' => $lng - $dlng),
            'right-top'    => array('lat' => $lat + $dlat, 'lng' => $lng + $dlng),
            'left-bottom'  => array('lat' => $lat - $dlat, 'lng' => $lng - $dlng),
            'right-bottom' => array('lat' => $lat - $dlat, 'lng' => $lng + $dlng)
        );
    }


    public static function uuid($prefix = "")
    {    //可以指定前缀
        $str  = md5(uniqid(mt_rand(), true));
        $uuid = substr($str, 0, 8) . '-';
        $uuid .= substr($str, 8, 4) . '-';
        $uuid .= substr($str, 12, 4) . '-';
        $uuid .= substr($str, 16, 4) . '-';
        $uuid .= substr($str, 20, 12);
        return $prefix . $uuid;
    }

    public static function ipToPoint($ip)
    {

        //初始化
        $ch = curl_init();

        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, "http://api.map.baidu.com/location/ip?ak=LtVtCMs4NwAnQsbrBI358UlG&ip=" . $ip . "&coor=bd09ll");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        //执行并获取HTML文档内容
        $result = curl_exec($ch);

        //释放curl句柄
        curl_close($ch);

        $result = json_decode($result, true);

        if ($result && array_key_exists('status', $result)) {

            if ($result['status']) return null;

            if (array_key_exists('content', $result)) {

                return $result['content']['point'];
            }

            return null;

        }


    }


    public static function getRemark($customer, $friend)
    {

        if ($friend) {

            if ($friend->remark) return $friend->remark;
        }

        if ($customer->user_name) return $customer->user_name;

        if ($customer->user_num) return $customer->user_num;

    }

} 