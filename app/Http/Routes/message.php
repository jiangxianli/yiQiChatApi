<?php

$api->group(['prefix' => 'message'], function ($api) {

    $api->group(['middleware' => ['auth.customer', 'api.auth']], function ($api) {

        $api->post('sendTextMsg', ['as' => 'message.sendTextMsg', 'uses' => 'MessageController@sendTextMsg']);

        $api->post('receiveMsg', ['as' => 'message.receiveMsg', 'uses' => 'MessageController@receiveMsg']);

        $api->post('msgList', ['as' => 'message.msgList', 'uses' => 'MessageController@getMessageList']);

        $api->post('unreadMsgList', ['as' => 'message.unreadMsgList', 'uses' => 'MessageController@unreadMsgList']);

        $api->post('customerUnreadMsg', ['as' => 'message.customerUnreadMsg', 'uses' => 'MessageController@getCustomerUnreadMsg']);

        $api->post('totalUnreadNum', ['as' => 'message.totalUnreadNum', 'uses' => 'MessageController@getTotalUnreadNum']);

    });


});

