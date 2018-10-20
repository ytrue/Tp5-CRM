<?php
/**
 * Created by PhpStorm.
 * User: 阳毅
 * Date: 2018/10/18
 * Time: 20:35
 */

namespace app\common\model;


use think\Model;

class Role extends Model
{
    protected  $table='role';

    //多对多
    public function Permission()
    {
        return $this->belongsToMany('Permission','role_permission','permission_id','role_id');
    }
}