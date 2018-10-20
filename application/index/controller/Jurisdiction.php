<?php
/**
 * Created by PhpStorm.
 * User: 阳毅
 * Date: 2018/10/17
 * Time: 12:46
 */

namespace app\index\controller;


class Jurisdiction extends BaseController
{
    public function jurisdictionlist()
    {
        return view('jurisdictionlist');
    }
}