<?php

//图片相关路由
$api->group(['prefix' => 'image'], function ($api) {

    $api->group(['middleware' => ['auth.customer', 'api.auth']], function ($api) {
        //图片上传
        $api->post('upload', ['as' => 'image.upload', 'uses' => 'ImageController@postUpload']);
    });
});
