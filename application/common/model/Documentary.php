<?php
/**
 * Created by PhpStorm.
 * User: 阳毅
 * Date: 2018/9/26
 * Time: 10:33
 */

namespace app\common\model;


use think\Model;

class Documentary extends Model
{
    public function getList()
    {
        return $this->order('create_time','desc')->paginate(10,false);
    }


    public function findOne($id)
    {
        return $findOne=$this->find($id);
    }

}