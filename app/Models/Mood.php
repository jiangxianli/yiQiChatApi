<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 心情模型
 *
 * Class Mood
 * @package App\Models
 * @author jiangxianli
 * @created_at 2019-04-24 10:23
 */
class Mood extends Model
{
    /**
     * 表名
     *
     * @var string
     */
    protected $table = 'moods';

    /**
     * 可填充字段
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'location',
        'hidden'
    ];

    /**
     * 图片关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author jiangxianli
     * @created_at 2019-04-24 10:24
     */
    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'mood_images', 'mood_id', 'image_id');
    }

    /**
     * 用户关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author jiangxianli
     * @created_at 2019-04-24 10:24
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }

    /**
     * 评论关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author jiangxianli
     * @created_at 2019-04-24 10:24
     */
    public function comments()
    {
        return $this->hasMany('App\Models\MoodComment', 'mood_id', 'id');
    }

    /**
     * 评论点赞
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 10:25
     */
    public function authPraise()
    {
        $customer_id = 0;
        if (\Auth::check()) {
            $customer_id = \Auth::user()->id;
        }
        return $this->hasMany('App\Models\MoodPraise', 'mood_id', 'id')->where('customer_id', $customer_id);
    }


}
