<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/18
 * Time: 8:36
 */

namespace app\index\validate;


use think\Validate;

class Staff  extends Validate
{
    protected $rule=[
        'name'=>'require|max:20',
        'number'=>'require|max:5'

    ];
}