<?php
/**
 * Created by PhpStorm.
 * User: 阳毅
 * Date: 2018/9/24
 * Time: 18:43
 */

namespace app\common\model;


use think\Model;

class Outlib extends Model
{
    protected $field = true;

    public function products($ids)
    {
        return $this->belongsTo('product','product_id','id')->whereIn('id',$ids);
    }
    public function product()
    {
        return $this->belongsTo('product','product_id','id');
    }
}