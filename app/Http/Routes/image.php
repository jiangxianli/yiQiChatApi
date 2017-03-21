<?php

$api->group(['prefix' => 'image'], function ($api) {

    $api->group(['middleware' => ['auth.customer', 'api.auth']], function ($api) {

        $api->post('upload', ['as' => 'image.upload', 'uses' => 'ImageController@postUpload']);


    });





});

