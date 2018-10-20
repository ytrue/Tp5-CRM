<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],
//
//];


\think\Route::get('/','BaseController/layout');
\think\Route::resource('/index','index');

//login
\think\Route::get('/login','login/index');
\think\Route::post('/login','login/check_login');
\think\Route::get('/register','login/register');
//logout
\think\Route::get('/logout','BaseController/logout');


/*人事管理*/
//职位部门
\think\Route::resource('/post','Post');
//员工档案
\think\Route::post('/staff/details','Staff/details');
\think\Route::resource('/staff','Staff');
//登陆账号
\think\Route::resource('/user','User');

/*仓库管理*/
//产品信息
\think\Route::post('/product/details','product/details');
\think\Route::resource('product','Product');
//库存警告
\think\Route::resource('alarm','Alarm');
//入库记录
\think\Route::post('/inlib/details','Inlib/details');
\think\Route::resource('inlib','Inlib');
//出库记录
\think\Route::post('/outlib/ok','Outlib/ok');
\think\Route::resource('outlib','Outlib');
//采购记录
\think\Route::post('/procure/details','Procure/details');
\think\Route::resource('procure','Procure');


/* 财务管理*/
//支出记录
\think\Route::post('/payment/details','Payment/details');
\think\Route::resource('payment','Payment');
//收款记录
\think\Route::post('/receipt/details','receipt/details');
\think\Route::resource('receipt','Receipt');

/*客户管理*/
//客户信息
\think\Route::resource('client','Client');
//跟单记录
\think\Route::post('/documentary/details','Documentary/details');
\think\Route::resource('documentary','Documentary');
//销售订单
\think\Route::post('/order/details','Order/details');
\think\Route::resource('order','Order');

/*办公管理*/
//工作计划
\think\Route::post('/work/extend','Work/extend');
\think\Route::post('/work/details','Work/details');
\think\Route::resource('work','Work');
//分配任务
\think\Route::resource('allo','Allo');
//通知管理
\think\Route::post('/inform/details','Inform/details');
\think\Route::resource('inform','Inform');
//私信收发
\think\Route::resource('letter','Letter');

/*系统管理*/
//日志
\think\Route::get('/log','Log/index');
//权限管理
//\think\Route::get('/jurisdiction/jurisdictionlist','Jurisdiction/jurisdictionlist');
//权限管理
\think\Route::resource('permission','Permission');
//角色管理
\think\Route::resource('role','Role');
//给角色分配权限
\think\Route::resource('role_permission','RolePermission');
//给用户分配角色
\think\Route::resource('user_role','UserRole');