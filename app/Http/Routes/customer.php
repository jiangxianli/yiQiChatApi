<?php

//用户相关路由
$api->group(['prefix' => 'customer'], function ($api) {
    //用户注册
    $api->post('register', ['as' => 'customer.register', 'uses' => 'CustomerController@postRegister']);
    //用户登录
    $api->post('login', ['as' => 'customer.login', 'uses' => 'CustomerController@postLogin']);
    //用户相关
    $api->group(['middleware' => ['auth.customer', 'api.auth']], function ($api) {
        //获取登录信息
        $api->post('auth', ['as' => 'customer.auth', 'uses' => 'CustomerController@postGetAuthInfo']);
        //查询用户信息
        $api->post('find', ['as' => 'customer.find', 'uses' => 'CustomerController@postFindById']);
        //设置用户定位信息
        $api->post('setLocation', ['as' => 'customer.setLocation', 'uses' => 'CustomerController@setLocation']);
        //搜索附近好友
        $api->post('nearby', ['as' => 'customer.nearby', 'uses' => 'CustomerController@getNearbyCustomers']);
        //获取用户详情
        $api->post('detail', ['as' => 'customer.detail', 'uses' => 'CustomerController@getDetail']);
        //设置用户地址
        $api->post('setAddress', ['as' => 'customer.setAddress', 'uses' => 'CustomerController@setAddress']);
        //设置用户名
        $api->post('setUserName', ['as' => 'customer.setUserName', 'uses' => 'CustomerController@setUserName']);
        //设置用户简介
        $api->post('setIntro', ['as' => 'customer.setIntro', 'uses' => 'CustomerController@setIntro']);
        //设置用户性别
        $api->post('setSex', ['as' => 'customer.setSex', 'uses' => 'CustomerController@setSex']);
        //创建用户二维码
        $api->post('createQrcode', ['as' => 'customer.createQrcode', 'uses' => 'CustomerController@createQrcode']);
        //上传图片
        $api->post('uploadImage', ['as' => 'customer.uploadImage', 'uses' => 'CustomerController@uploadCustomerImage']);
    });
});
