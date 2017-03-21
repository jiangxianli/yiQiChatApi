<?php

use App\Models\AuthCode;

Validator::extend('phoneoremail', function ($attribute, $value, $parameters) {
    return (preg_match('/^(((1(3|4|5|7|8)[0-9]{1}))+\d{8})$/',
            $value) || preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/",
            $value));
});

Validator::extend('cnphone', function ($attribute, $value, $parameters) {
    return (preg_match('/^(((1(3|4|5|7|8)[0-9]{1}))+\d{8})$/', $value));
});

Validator::extend('password', function ($attribute, $value, $parameters) {

    return preg_match("/^[a-zA-Z0-9!#$@_\-=+]{" . $parameters[0] . "," . $parameters[1] . "}$/", $value);
});

Validator::extend('phone_verify_code', function ($attribute, $value, $parameters) {

    $authCode = AuthCode::type('mobile')->mobile($parameters[0])->code($value)->valid()->count();

    return $authCode > 0;
});
