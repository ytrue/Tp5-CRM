<?php

namespace app\index\controller;

use gmars\rbac\Rbac;
use think\Controller;
use think\Db;
use think\Request;

class Role extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $role=model('Role');
        $data=$role->order('id','desc')->paginate(10,false);
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
            $getLastId=Db::query(" SHOW TABLE STATUS LIKE 'role' ");
            $rbacObj=new Rbac();
            $data = [
                'name' => input('post.name'),
                'status' => 1,
                'description' => input('post.description'),
                'sort_num' => $getLastId[0]['Auto_increment'],
            ];
            if($rbacObj->createRole($data)){
                return $getLastId[0]['Auto_increment'];
            }else{
                return 0;
            }
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
