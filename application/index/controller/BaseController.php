<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11
 * Time: 9:09
 */

namespace app\index\controller;


use gmars\rbac\Rbac;
use think\Controller;
use think\Hook;
use think\Request;

class BaseController extends Controller
{
    public function _initialize()
    {
        Hook::add('app_init', 'app\\index\\behavior\\Log');  //set行为
        $this->check_login();
    }

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    public function layout()
    {
        return view('layout/layout');
    }

    private function check_login()
    {
        if(!session('id') || !session('accounts')){
            $this->error('您尚未登录系统',url('/login'));
        }
    }

    public function logout()
    {
        session(null);
        $this->success('退出系统成功！',url('login/index'));
    }
}