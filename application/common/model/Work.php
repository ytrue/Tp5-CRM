<?php
/**
 * Created by PhpStorm.
 * User: 阳毅
 * Date: 2018/10/12
 * Time: 14:42
 */

namespace app\common\model;


use think\Model;

class Work extends Model
{
    public function WorkStage($id)
    {
        return $this->hasOne('WorkStage','work_id')->where('work_id',$id);
    }
}