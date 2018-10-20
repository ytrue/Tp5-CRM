<?php
/**
 * Created by PhpStorm.
 * User: 阳毅
 * Date: 2018/9/24
 * Time: 11:37
 */

namespace app\common\model;


use think\Model;

class Inlib extends Model
{
    protected $field = true;

    public function product()
    {
        return $this->belongsTo('Product','product_id');
    }

}