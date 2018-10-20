<?php
/**
 * Created by PhpStorm.
 * User: 阳毅
 * Date: 2018/9/11
 * Time: 19:30
 */

namespace app\index\validate;

use think\Validate;

class Post extends Validate
{
    protected $rule=[
        'name'=>'require|min:2|max:10|unique:post',
    ];

    protected $message=[
        'name.require '=>'职位名称不得为空',
        'name.min'=>'职位名称不得小于2位',
        'name.min'=>'职位名称不得大于10位',
        'name.unique'=>'职位名称已存在'
    ];

    protected $scene=[
        'save'=>['name'],
        'edit'=>['name'],
    ];
}