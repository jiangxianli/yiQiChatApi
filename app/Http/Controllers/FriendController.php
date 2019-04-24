<?php

namespace App\Http\Controllers;

use App\Jobs\Friend\FindFriend;
use App\Jobs\Friend\FriendAgree;
use App\Jobs\Friend\FriendApply;
use App\Jobs\Friend\FriendApplyList;
use App\Jobs\Friend\FriendDetail;
use App\Jobs\Friend\FriendList;
use App\Jobs\Friend\FriendSearch;
use App\Jobs\Friend\SetRemark;
use App\Transformers\Customer\CustomerTransformer;
use App\Transformers\Friend\FriendDetailTransformer;
use App\Transformers\Friend\FriendTransformer;
use Illuminate\Http\Request;
use App\Http\Requests\Friend\SearchRequest;

class FriendController extends Controller
{
    /**
     * 搜索好友
     *
     * @param SearchRequest $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:39
     */
    public function postSearch(SearchRequest $request)
    {

        $job = new FriendSearch($request);

        $customer = $this->dispatch($job);

        return $this->response()->item($customer, new CustomerTransformer());

    }

    /**
     * 申请加好友
     *
     * @param Request $request
     * @author jiangxianli
     * @created_at 2019-04-24 9:40
     */
    public function postApply(Request $request)
    {

        $job = new FriendApply($request);

        $this->dispatch($job);
    }

    /**
     * 同意好友请求
     *
     * @param Request $request
     * @author jiangxianli
     * @created_at 2019-04-24 9:41
     */
    public function postAgree(Request $request)
    {

        $job = new FriendAgree($request);

        $this->dispatch($job);
    }

    /**
     * 获取好友申请列表
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:41
     */
    public function getApplyList(Request $request)
    {
        $job = new FriendApplyList($request);

        $applies = $this->dispatch($job);

        return $this->response()->collection($applies, new FriendTransformer());
    }

    /**
     * 获取朋友列表
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:41
     */
    public function getFriendList(Request $request)
    {
        $job = new FriendList($request);

        $friends = $this->dispatch($job);

        return $this->response()->collection($friends, new CustomerTransformer());
    }

    /**
     * 获取朋友详情
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:42
     */
    public function getDetail(Request $request)
    {
        $job = new FriendDetail($request);

        $customer = $this->dispatch($job);

        return $this->response()->item($customer, new CustomerTransformer());
    }

    /**
     * 设置好友备注
     *
     * @param Request $request
     * @author jiangxianli
     * @created_at 2019-04-24 9:42
     */
    public function setRemark(Request $request)
    {
        $job = new SetRemark($request);

        $this->dispatch($job);
    }

    /**
     * 查询好友信息
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:42
     */
    public function findFriend(Request $request)
    {
        $job = new FindFriend($request);

        $friend = $this->dispatch($job);

        return $this->response()->item($friend, new FriendDetailTransformer());
    }

}
