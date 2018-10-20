<?php
/**
 * Created by PhpStorm.
 * User: 阳毅
 * Date: 2018/9/17
 * Time: 10:35
 */

namespace app\common\model;


use think\Model;

class Staff extends Model
{
    public function staffextend()
    {
        return $this->hasOne('StaffExtend','staff_id');
    }


    public function user()
    {
        return $this->belongsTo('User','user_id');
    }


    public function getList()
    {
//        if ($name){
//            $object=$this->order('create_time','desc')->where('name','like','%'.$name.'%')
//                ->whereOr('')
//                ->paginate(10,false);
//        }
        //name   or  number   or  tel   and  shijain
        $object=$this->order('create_time','desc')->paginate(10,false);
        return $object;
    }

    public function getALL()
    {
        $object=$this->where('user_id','0')->order('create_time','desc')->select();
        return $object;
    }

    public function getAlls()
    {
        $object=$this->order('create_time','desc')->select();
        return $object;
    }

}