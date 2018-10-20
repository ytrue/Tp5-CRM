<?php
/**
 * Created by PhpStorm.
 * User: 阳毅
 * Date: 2018/9/14
 * Time: 23:26
 */

namespace app\index\controller;


use think\Controller;
use think\Request;

class Login extends Controller
{
    public function index()
    {
       return view('index');
    }

    public function check_login(Request $request)
    {
        if(request()->isPost()){
            $this->check(input('code'));
            $user=model('User');
            $num=$user->login(input('post.'));
            if($num==1){
                $this->error('账号不存在！');
            }
            if($num==2){
                $this->success('登录成功！',url('/'));
            }
            if($num==3){
                $this->error('密码错误！');
            }
            return;
        }
        return view();
    }

    private function check($code="")
    {
        if (!captcha_check($code)) {
            $this->error('验证码错误');
        } else {
            return true;
        }
    }
}