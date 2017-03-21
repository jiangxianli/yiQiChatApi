<?php

$api->group(['prefix' => 'mood'], function ($api) {


    $api->post('getList', ['as' => 'mood.getList', 'uses' => 'MoodController@getList']);

    $api->post('detail', ['as' => 'mood.getDetail', 'uses' => 'MoodController@getDetail']);

    $api->post('comments', ['as' => 'mood.getComments', 'uses' => 'MoodController@getComments']);

    $api->group(['middleware' => ['auth.customer', 'api.auth']], function ($api) {

        $api->post('uploadImage', ['as' => 'mood.uploadImage', 'uses' => 'MoodController@uploadImage']);

        $api->post('create', ['as' => 'mood.create', 'uses' => 'MoodController@create']);

        $api->post('praise', ['as' => 'mood.praise', 'uses' => 'MoodController@praiseMood']);

        $api->post('addComment', ['as' => 'mood.createComment', 'uses' => 'MoodController@createComment']);

    });

});

