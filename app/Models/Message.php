<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 消息模型
 *
 * Class Message
 * @package App\Models
 * @author jiangxianli
 * @created_at 2019-04-24 10:21
 */
class Message extends Model
{
    /**
     * 表名
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * 谁发的消息
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author jiangxianli
     * @created_at 2019-04-24 10:21
     */
    public function fromer()
    {
        return $this->belongsTo('App\Models\Customer', 'from', 'id');
    }

    /**
     * 谁接收的消息
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author jiangxianli
     * @created_at 2019-04-24 10:22
     */
    public function toer()
    {
        return $this->belongsTo('App\Models\Customer', 'to', 'id');
    }

    /**
     * 查询好友
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 10:22
     */
    public function friend()
    {
        if ($this->attributes['from'] == \Auth::user()->id) {
            return $this->belongsTo('App\Models\Friend', 'to', 'friend_id')->where('owner_id', \Auth::user()->id);
        } else {
            return $this->belongsTo('App\Models\Friend', 'from', 'friend_id')->where('owner_id', \Auth::user()->id);
        }
    }

    /**
     * 查询用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author jiangxianli
     * @created_at 2019-04-24 10:22
     */
    public function customer()
    {
        if ($this->attributes['from'] == \Auth::user()->id) {
            return $this->belongsTo('App\Models\Customer', 'to', 'id');
        } else {
            return $this->belongsTo('App\Models\Customer', 'from', 'id');
        }


    }

    protected $appends = [
        'status'
    ];

    /**
     * 消息状态
     *
     * @return string
     * @author jiangxianli
     * @created_at 2019-04-24 10:23
     */
    public function getStatusAttribute()
    {
        if ($this->attributes['is_read']) {
            return '已读';
        }

        return $this->attributes['is_received'] ? '已发送' : '已送达';
    }

}
