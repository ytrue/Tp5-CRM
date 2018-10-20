<?php
/**
 * Created by PhpStorm.
 * User: 阳毅
 * Date: 2018/9/11
 * Time: 15:16
 */

namespace app\common\model;

use think\Model;

class Post extends Model
{
    //获取数据列表
    public function getList($name=null,$start=null,$end=null)
    {
        if ($name){
            $object=$this->field(['id','name','create_time'])->where('name','like','%'.$name.'%')->where('create_time','between time',[$start,$end])->order('create_time','desc')->paginate(10000,false);
            return $object;
        }else{
            $object=$this->field(['id','name','create_time'])->order('create_time','desc')->paginate(10,false);
            return $object;
        }

    }

    public function getAll()
    {
        $object=$this->field('name')->select();
        return $object;
    }

    public function getCount()
    {
        $count=$this->field('id')->count();
        return $count;
    }

    public function findOne($id)
    {
        return $findOne=$this->field(['id','name'])->find($id);
    }




}