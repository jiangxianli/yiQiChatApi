<?php

//好友相关路由
$api->group(['prefix' => 'friend'], function ($api) {

    $api->group(['middleware' => ['auth.customer', 'api.auth']], function ($api) {
        //搜索好友
        $api->post('search', ['as' => 'friend.search', 'uses' => 'FriendController@postSearch']);
        //申请加好友
        $api->post('apply', ['as' => 'friend.apply', 'uses' => 'FriendController@postApply']);
        //同意加好友
        $api->post('agree', ['as' => 'friend.agree', 'uses' => 'FriendController@postAgree']);
        //好友申请列表
        $api->get('applyList', ['as' => 'friend.applyList', 'uses' => 'FriendController@getApplyList']);
        //好友列表
        $api->get('list', ['as' => 'friend.list', 'uses' => 'FriendController@getFriendList']);
        //好友详情
        $api->post('detail', ['as' => 'friend.detail', 'uses' => 'FriendController@getDetail']);
        //设置好友备注
        $api->post('setRemark', ['as' => 'friend.setRemark', 'uses' => 'FriendController@setRemark']);
        //查找好友
        $api->post('find', ['as' => 'friend.find', 'uses' => 'FriendController@findFriend']);
    });
});
