<?php

//心情相关路由
$api->group(['prefix' => 'mood'], function ($api) {
    //获取心情广场列表
    $api->post('getList', ['as' => 'mood.getList', 'uses' => 'MoodController@getList']);
    //心情详情
    $api->post('detail', ['as' => 'mood.getDetail', 'uses' => 'MoodController@getDetail']);
    //心情评论列表
    $api->post('comments', ['as' => 'mood.getComments', 'uses' => 'MoodController@getComments']);

    $api->group(['middleware' => ['auth.customer', 'api.auth']], function ($api) {
        //上传心情图片
        $api->post('uploadImage', ['as' => 'mood.uploadImage', 'uses' => 'MoodController@uploadImage']);
        //发布心情
        $api->post('create', ['as' => 'mood.create', 'uses' => 'MoodController@create']);
        //点赞心情
        $api->post('praise', ['as' => 'mood.praise', 'uses' => 'MoodController@praiseMood']);
        //添加评论
        $api->post('addComment', ['as' => 'mood.createComment', 'uses' => 'MoodController@createComment']);
    });

});

