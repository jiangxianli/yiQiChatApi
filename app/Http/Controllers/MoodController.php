<?php

namespace App\Http\Controllers;

use App\Jobs\Image\ImageUpload;
use App\Jobs\Mood\CreateComment;
use App\Jobs\Mood\CreateMood;
use App\Jobs\Mood\GetComment;
use App\Jobs\Mood\GetDetail;
use App\Jobs\Mood\GetList;
use App\Jobs\Mood\Praise;
use App\Transformers\Image\ImageTransformer;
use App\Transformers\Mood\MoodCommentTransformer;
use App\Transformers\Mood\MoodDetailTransformer;
use Illuminate\Http\Request;

class MoodController extends Controller
{
    /**
     * 上传心情图片
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:44
     */
    public function uploadImage(Request $request)
    {
        $job = new ImageUpload($request);

        $image = $this->dispatch($job);

        return $this->response()->item($image, new ImageTransformer());
    }

    /**
     * 发布心情
     *
     * @param Request $request
     * @author jiangxianli
     * @created_at 2019-04-24 9:44
     */
    public function create(Request $request)
    {

        $job = new CreateMood($request);

        $this->dispatch($job);
    }

    /**
     * 获取心情广场列表
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:44
     */
    public function getList(Request $request)
    {
        $job = new GetList($request);

        $moods = $this->dispatch($job);

        return $this->response()->collection($moods, new MoodDetailTransformer());
    }

    /**
     * 点赞心情
     *
     * @param Request $request
     * @author jiangxianli
     * @created_at 2019-04-24 9:46
     */
    public function praiseMood(Request $request)
    {
        $job = new Praise($request);

        $this->dispatch($job);
    }

    /**
     * 心情详情
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:46
     */
    public function getDetail(Request $request)
    {
        $job = new GetDetail($request);

        $mood = $this->dispatch($job);

        return $this->response()->item($mood, new MoodDetailTransformer());
    }

    /**
     * 获取心情评论
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:46
     */
    public function getComments(Request $request)
    {
        $job = new GetComment($request);

        $comments = $this->dispatch($job);

        return $this->response()->collection($comments, new MoodCommentTransformer());
    }

    /**
     * 发布心情评论
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @author jiangxianli
     * @created_at 2019-04-24 9:46
     */
    public function createComment(Request $request)
    {
        $job = new CreateComment($request);

        $comment = $this->dispatch($job);

        return $this->response()->item($comment, new MoodCommentTransformer());

    }

}
