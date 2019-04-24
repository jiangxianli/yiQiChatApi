<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 图片模型
 *
 * Class Image
 * @package App\Models
 * @author jiangxianli
 * @created_at 2019-04-24 10:19
 */
class Image extends Model
{
    /**
     * 表名
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * 可填充字段
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'url',
        'path',
        'name',
        'size',
        'extension',
        'alt'
    ];

}
