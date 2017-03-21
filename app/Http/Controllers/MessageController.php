<?php

namespace App\Http\Controllers;

use App\Jobs\Friend\FriendAgree;
use App\Jobs\Friend\FriendApply;
use App\Jobs\Friend\FriendApplyList;
use App\Jobs\Friend\FriendList;
use App\Jobs\Friend\FriendSearch;
use App\Jobs\Message\getCustomerUnreadMsg;
use App\Jobs\Message\GetTotalUnreadNum;
use App\Jobs\Message\getUnreadMsgNum;
use App\Jobs\Message\MsgList;
use App\Jobs\Message\ReceivetMsg;
use App\Jobs\Message\SendTextMsg;
use App\Jobs\Message\unreadMsgList;
use App\Transformers\Customer\CustomerTransformer;

use App\Transformers\Friend\FriendTransformer;
use App\Transformers\Message\MessageTransformer;
use Illuminate\Http\Request;

use App\Http\Requests\Friend\SearchRequest;

class MessageController extends Controller
{

    public function sendTextMsg(Request $request){

        $job = new SendTextMsg($request);

        $this->dispatch($job);

    }

    public function receiveMsg($request){

        $job = new ReceivetMsg($request);

        $this->dispatch($job);


    }

    public function getMessageList(Request $request){

        $job = new MsgList($request);

        $messages = $this->dispatch($job);

        return $this->response()->collection($messages,new MessageTransformer());

    }


    public function unreadMsgList(Request $request){

        $job = new unreadMsgList($request);

        $messages = $this->dispatch($job);

        return $this->response()->collection($messages,new MessageTransformer());

    }

    public function getCustomerUnreadMsg(Request $request){

        $job = new getCustomerUnreadMsg($request);

        $messages = $this->dispatch($job);

        return $this->response()->collection($messages,new MessageTransformer());

    }

    public function getTotalUnreadNum(Request $request){

        $job = new GetTotalUnreadNum($request);

        $count = $this->dispatch($job);

        return $this->response()->array(['data'=>$count]);
    }

}
