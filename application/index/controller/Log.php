<?php
/**
 * Created by PhpStorm.
 * User: 阳毅
 * Date: 2018/10/17
 * Time: 9:53
 */

namespace app\index\controller;


class Log extends BaseController
{
    public function index()
    {
        $log=model('Log');
        $data=$log->order('create_time','desc')->paginate(10,false);
        return view('index',['data'=>$data]);
    }
}