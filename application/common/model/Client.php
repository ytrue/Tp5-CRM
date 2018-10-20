<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/25
 * Time: 10:07
 */

namespace app\common\model;


use think\Model;

class Client extends Model
{
    //获取数据列表
    public function getList()
    {
            $object=$this->order('create_time','desc')->paginate(10,false);
            return $object;
    }


    public function findOne($id)
    {
        return $findOne=$this->find($id);
    }

    public function getAll()
    {
        return $this::select();
    }

}