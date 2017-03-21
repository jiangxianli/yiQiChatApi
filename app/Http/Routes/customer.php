<?php

$api->group(['prefix' => 'customer'], function ($api) {

    $api->post('register', ['as' => 'customer.register', 'uses' => 'CustomerController@postRegister']);

    $api->post('login', ['as' => 'customer.login', 'uses' => 'CustomerController@postLogin']);

    $api->group(['middleware' => ['auth.customer', 'api.auth']], function ($api) {

        $api->post('auth', ['as' => 'customer.auth', 'uses' => 'CustomerController@postGetAuthInfo']);

        $api->post('find', ['as' => 'customer.find', 'uses' => 'CustomerController@postFindById']);

        $api->post('setLocation', ['as' => 'customer.setLocation', 'uses' => 'CustomerController@setLocation']);

        $api->post('nearby', ['as' => 'customer.nearby', 'uses' => 'CustomerController@getNearbyCustomers']);

        $api->post('detail', ['as' => 'customer.detail', 'uses' => 'CustomerController@getDetail']);

        $api->post('setAddress', ['as' => 'customer.setAddress', 'uses' => 'CustomerController@setAddress']);

        $api->post('setUserName', ['as' => 'customer.setUserName', 'uses' => 'CustomerController@setUserName']);

        $api->post('setIntro', ['as' => 'customer.setIntro', 'uses' => 'CustomerController@setIntro']);

        $api->post('setSex', ['as' => 'customer.setSex', 'uses' => 'CustomerController@setSex']);

        $api->post('createQrcode', ['as' => 'customer.createQrcode', 'uses' => 'CustomerController@createQrcode']);

        $api->post('uploadImage', ['as' => 'customer.uploadImage', 'uses' => 'CustomerController@uploadCustomerImage']);

    });

});

