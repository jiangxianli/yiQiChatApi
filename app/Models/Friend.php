<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 好友模型
 *
 * Class Friend
 * @package App\Models
 * @author jiangxianli
 * @created_at 2019-04-24 10:18
 */
class Friend extends Model
{
    /**
     * 表名
     *
     * @var string
     */
    protected $table = 'friends';

    /**
     * 谁是我的好友关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author jiangxianli
     * @created_at 2019-04-24 10:18
     */
    public function from()
    {
        return $this->belongsTo('App\Models\Customer', 'owner_id', 'id');
    }

    /**
     * 我是谁的好友关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author jiangxianli
     * @created_at 2019-04-24 10:18
     */
    public function to()
    {
        return $this->belongsTo('App\Models\Customer', 'friend_id', 'id');
    }

}
