<?php

use App\Models\AuthCode;

//手机号或邮箱地址验证
Validator::extend('phoneoremail', function ($attribute, $value, $parameters) {
    return (preg_match('/^(((1(3|4|5|7|8)[0-9]{1}))+\d{8})$/',
            $value) || preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/",
            $value));
});

//手机号规则验证
Validator::extend('cnphone', function ($attribute, $value, $parameters) {
    return (preg_match('/^(((1(3|4|5|7|8)[0-9]{1}))+\d{8})$/', $value));
});

//密码格式验证
Validator::extend('password', function ($attribute, $value, $parameters) {
    return preg_match("/^[a-zA-Z0-9!#$@_\-=+]{" . $parameters[0] . "," . $parameters[1] . "}$/", $value);
});

//手机验证码验证
Validator::extend('phone_verify_code', function ($attribute, $value, $parameters) {
    $authCode = AuthCode::type('mobile')->mobile($parameters[0])->code($value)->valid()->count();
    return $authCode > 0;
});
