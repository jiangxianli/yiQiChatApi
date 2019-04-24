<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 心情评论模型
 *
 * Class MoodComment
 * @package App\Models
 * @author jiangxianli
 * @created_at 2019-04-24 10:25
 */
class MoodComment extends Model
{
    /**
     * 表名
     *
     * @var string
     */
    protected $table = 'mood_comments';

    /**
     * 用户关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author jiangxianli
     * @created_at 2019-04-24 10:25
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    /**
     * 心情关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author jiangxianli
     * @created_at 2019-04-24 10:25
     */
    public function mood()
    {
        return $this->belongsTo('App\Models\Mood', 'mood_id');
    }

    /**
     * 父级评论关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author jiangxianli
     * @created_at 2019-04-24 10:26
     */
    public function father()
    {
        return $this->belongsTo('App\Models\MoodComment', 'father_id');
    }

    /**
     * 子级评论关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author jiangxianli
     * @created_at 2019-04-24 10:26
     */
    public function sons()
    {
        return $this->hasMany('App\Models\MoodComment', 'father_id');
    }


}
