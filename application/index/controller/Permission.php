<?php

namespace app\index\controller;

use gmars\rbac\Rbac;
use think\Controller;
use think\Request;

class Permission extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $permission=model('Permission');
        $data=$permission->order('create_time','desc')->paginate(10,false);
        return view('index',['data'=>$data]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
         if ($request->isPost()){
             //$rbacObj=new Rbac();
             $permission=model('Permission');
             $data['name']=input('post.name');
             $data['path']=input('post.path');
             $data['description']=input('post.description');
             $data['status']=1;
             $data['create_time']=time();
             if ($permission->save($data)){
                 return $permission->getLastInsID();
             }else{
                 return 0;
             }
             /*
             if($rbacObj->createPermission($data)){
                 return true;
             }else{
                 return false;
             }*/

         }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
