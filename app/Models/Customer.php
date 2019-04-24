<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * 用户模型
 *
 * Class Customer
 * @package App\Models
 * @author jiangxianli
 * @created_at 2019-04-24 10:16
 */
class Customer extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword;

    /**
     * 表名
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * 好友关联
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2019-04-24 10:16
     */
    public function friends()
    {
        return $this->hasMany('App\Models\Friend', 'owner_id', 'id')->where('is_received', true);
    }

    /**
     * 发送信息关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author jiangxianli
     * @created_at 2019-04-24 10:17
     */
    public function fromMsg()
    {
        return $this->hasMany('App\Models\Message', 'from', 'id');
    }

    /**
     * 接收消息关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author jiangxianli
     * @created_at 2019-04-24 10:17
     */
    public function toMsg()
    {
        return $this->hasMany('App\Models\Message', 'to', 'id');
    }

    /**
     * 用户头像关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author jiangxianli
     * @created_at 2019-04-24 10:17
     */
    public function image()
    {
        return $this->belongsTo('App\Models\Image', 'image_id');
    }

    /**
     * 用户二维码关联
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author jiangxianli
     * @created_at 2019-04-24 10:17
     */
    public function qrcodeImage()
    {
        return $this->belongsTo('App\Models\Image', 'qrcode');
    }
}
