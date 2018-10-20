<?php
/**
 * Created by PhpStorm.
 * User: 阳毅
 * Date: 2018/9/11
 * Time: 19:30
 */

namespace app\index\validate;

use think\Validate;

class User extends Validate
{
    protected $rule=[
        'accounts'=>'require|min:2|max:10|unique:user',
        'password'=>'require',

    ];

    protected $message=[
        'accounts.require '=>'accounts不得为空',
        'accounts.min'=>'accounts不得小于2位',
        'accounts.max'=>'accounts不得大于10位',
        'accounts.unique'=>'accounts名称已存在',
        'password.require'=>'password不得为为空'
    ];

    protected $scene=[
        'save'=>['accounts','password'],
        'edit'=>['password'],
    ];
}