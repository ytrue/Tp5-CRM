<?php
/**
 * Created by PhpStorm.
 * User: 阳毅
 * Date: 2018/9/22
 * Time: 10:23
 */

namespace app\common\model;


use think\Db;
use think\Model;

class Product extends Model
{
    public function productExtend()
    {
        return $this->hasOne('ProductExtend','product_id');
    }

    public function getList()
    {
        $object=$this->order('create_time','desc')->paginate(10,false);
        return $object;
    }

    //库存警告
    public function alarm()
    {
        $object=Db::name($this)->query("SELECT * FROM  crm_product WHERE  inventory  < inventory_alarm  ");
        return $object;
    }
    public function getAll()
    {
        $object=$this->field(['sn','name','unit','pro_price','id','type'])->select();
        return $object;
    }
}