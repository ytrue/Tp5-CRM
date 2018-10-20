<?php
/**
 * Created by PhpStorm.
 * User: T50725
 * Date: 2018/9/14
 * Time: 9:27
 */

namespace app\common\model;


use gmars\rbac\Rbac;
use phpDocumentor\Reflection\Types\Array_;
use think\Hook;
use think\Model;

class User extends Model
{
//    public function setPasswordAttr($value)
////    {
////        return  sha1($value['password']);
////    }
///
    protected $field = true;

    public function staff($id)
    {
        return $this->hasOne('Staff','user_id');
    }


    public function Role()
    {
        return $this->belongsToMany('Role','user_role','role_id','user_id');
    }

    public function getList($accounts = null, $state = null, $start = null, $end = null)
    {
        if ($accounts) {
            $object = $this
                ->field(['id', 'accounts', 'password', 'last_login_time', 'last_login_ip', 'login_count', 'state', 'create_time'])
                ->where('accounts', 'like', '%' . $accounts . '%')
                ->where('state', $state)
                ->where('create_time', 'between time', [$start, $end])
                ->order('create_time', 'desc')
                ->paginate(100000, false);
            return $object;
        } else {
            $object = $this->field(['id', 'accounts', 'password', 'last_login_time', 'last_login_ip', 'login_count', 'state', 'create_time'])->order('create_time', 'desc')->paginate(10, false);
            return $object;
        }

    }


    public function getCount()
    {
        $count = $this->field('id')->count();
        return $count;
    }

    public function findOne($id)
    {
        return $findOne = $this->field(['id', 'accounts', 'password', 'state','staff_name'])->find($id);
    }

    //login
    public function login($data)
    {
        $user = User::getByAccounts($data['username']);
        $staff=Staff::where('user_id',$user['id'])->find();
        if ($user) {
            if ($user['password'] == sha1($data['password'])) {
               // $premission = db('level')->where('id', $manage['lid'])->find();
                session('id', $user['id']);
                session('accounts', $user['accounts']);
                session('name',$staff['name']);
                session('staff_id',$staff['id']);
                //session('premission', $premission['premission']);
                //写入日志
                $params['user']=session('accounts').'('. session('name').')';
                $params['type']='登录系统';
                $params['type_name']=request()->action();
                $params['module']='人事管理 >> 登录帐号';
                $params['ip']=$_SERVER["REMOTE_ADDR"];
                $params['create_time']=date('Y-m-d H:i:s');
                Hook::add('app_init', 'app\\index\\behavior\\Log');
                Hook::listen('app_init',$params);

                $rbacObj=new Rbac();
                $rbacObj->cachePermission(session('id'));

                return 2; //登录密码正确的情况
            } else {
                return 3; //登录密码错误
            }
        } else {
            return 1; //用户不存在的情况
        }

    }
}