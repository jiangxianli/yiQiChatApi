<?php

//消息相关路由
$api->group(['prefix' => 'message'], function ($api) {

    $api->group(['middleware' => ['auth.customer', 'api.auth']], function ($api) {
        //发送文本消息
        $api->post('sendTextMsg', ['as' => 'message.sendTextMsg', 'uses' => 'MessageController@sendTextMsg']);
        //接收消息
        $api->post('receiveMsg', ['as' => 'message.receiveMsg', 'uses' => 'MessageController@receiveMsg']);
        //消息列表
        $api->post('msgList', ['as' => 'message.msgList', 'uses' => 'MessageController@getMessageList']);
        //未读消息列表
        $api->post('unreadMsgList', ['as' => 'message.unreadMsgList', 'uses' => 'MessageController@unreadMsgList']);
        //客户未读消息
        $api->post('customerUnreadMsg', ['as' => 'message.customerUnreadMsg', 'uses' => 'MessageController@getCustomerUnreadMsg']);
        //未读消息总数
        $api->post('totalUnreadNum', ['as' => 'message.totalUnreadNum', 'uses' => 'MessageController@getTotalUnreadNum']);
    });
});
