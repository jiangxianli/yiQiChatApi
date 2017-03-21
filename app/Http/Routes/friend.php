<?php

$api->group(['prefix' => 'friend'], function ($api) {

    $api->group(['middleware' => ['auth.customer', 'api.auth']], function ($api) {

        $api->post('search', ['as' => 'friend.search', 'uses' => 'FriendController@postSearch']);

        $api->post('apply', ['as' => 'friend.apply', 'uses' => 'FriendController@postApply']);

        $api->post('agree', ['as' => 'friend.agree', 'uses' => 'FriendController@postAgree']);

        $api->get('applyList', ['as' => 'friend.applyList', 'uses' => 'FriendController@getApplyList']);

        $api->get('list', ['as' => 'friend.list', 'uses' => 'FriendController@getFriendList']);

        $api->post('detail', ['as' => 'friend.detail', 'uses' => 'FriendController@getDetail']);

        $api->post('setRemark', ['as' => 'friend.setRemark', 'uses' => 'FriendController@setRemark']);

        $api->post('find', ['as' => 'friend.find', 'uses' => 'FriendController@findFriend']);

    });





});

