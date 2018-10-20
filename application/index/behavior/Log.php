<?php
/**
 * Created by PhpStorm.
 * User: 阳毅
 * Date: 2018/10/17
 * Time: 8:57
 */
namespace app\index\behavior;

class Log
{
    public function run($params)
    {
        //编写日志
        $log=model('Log');
        $log->save($params);

    }
}