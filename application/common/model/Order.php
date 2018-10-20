<?php
/**
 * Created by PhpStorm.
 * User: 阳毅
 * Date: 2018/9/26
 * Time: 16:23
 */

namespace app\common\model;


use think\Model;

class Order extends Model
{
    public function orderExtend()
    {
        return $this->hasOne('OrderExtend','order_id');
    }

    public function documentary()
    {
        return $this->belongsTo('Documentary','documentary_id');
    }

    public function outlib()
    {
        return $this->hasMany('Outlib','order_sn','sn');
    }
}