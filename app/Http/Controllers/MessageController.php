<?php

namespace App\Http\Controllers;

use App\Jobs\Message\getCustomerUnreadMsg;
use App\Jobs\Message\GetTotalUnreadNum;
use App\Jobs\Message\MsgList;
use App\Jobs\Message\ReceivetMsg;
use App\Jobs\Message\SendTextMsg;
use App\Jobs\Message\unreadMsgList;
use App\Transformers\Message\MessageTransformer;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * 发送信息
     *
     * @param Request $request
     * @author jiangxianli
     * @created_at 2019-04-24 9:42
     */
    public function sendTextMsg(Request $request)
    {
        $job = new SendTextMsg($request);

        $this->dispatch($job);

    }

    /**
     * 接收信息
     *
     * @param $request
     * @author jiangxianli
     * @created_at 2019-04-24 9:43
     */
    public function receiveMsg($request)
    {
        $job = new ReceivetMsg($request);

        $this->dispatch($job);
    }

    /**
     * 获取消息列表
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:43
     */
    public function getMessageList(Request $request)
    {
        $job = new MsgList($request);

        $messages = $this->dispatch($job);

        return $this->response()->collection($messages, new MessageTransformer());
    }

    /**
     * 未读消息列表
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:43
     */
    public function unreadMsgList(Request $request)
    {
        $job = new unreadMsgList($request);

        $messages = $this->dispatch($job);

        return $this->response()->collection($messages, new MessageTransformer());
    }

    /**
     * 未读消息详情
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:43
     */
    public function getCustomerUnreadMsg(Request $request)
    {
        $job = new getCustomerUnreadMsg($request);

        $messages = $this->dispatch($job);

        return $this->response()->collection($messages, new MessageTransformer());
    }

    /**
     * 未读消息总数
     *
     * @param Request $request
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 9:44
     */
    public function getTotalUnreadNum(Request $request)
    {
        $job = new GetTotalUnreadNum($request);

        $count = $this->dispatch($job);

        return $this->response()->array(['data' => $count]);
    }

}
