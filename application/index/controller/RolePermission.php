<?php

namespace app\index\controller;

use gmars\rbac\Rbac;
use think\Controller;
use think\Db;
use think\Request;

class RolePermission extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $role=model('Role');
        $permission=model('Permission');
        $roleData=$role->where('key','0')->select();
        $data=$role->order('id','desc')->where('key','1')->select();
        $permissionData=$permission->order('create_time','desc')->select();
        return view('index',['permission'=>$permissionData,'role'=>$roleData,'data'=>$data]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {

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
            $role=model('Role');
            $rbacObj=new Rbac();
            $role_id=input('post.role_id');
            $permission_ids=json_decode(input('post.ids'));
            $role->save(['key'=>1],['id'=>$role_id]);
           if($rbacObj->assignRolePermission($role_id,$permission_ids)){
               return true;
           }else{
               return false;
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
    public function edit(Request $request,$id)
    {
        if ($request->isGet()){
            $role=\app\common\model\Role::get($id);
            $rolePermissionId=$role->Permission;
            $rolePermissionIds=[];
            for ($i = 0; $i < count($rolePermissionId); $i++){
                $rolePermissionIds[$i]=$rolePermissionId[$i]['id'];
            }
            return json_encode($rolePermissionIds).'@@'.json_encode($role->name);
        }
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
        if ($request->isPut()){
            $rbacObj=new Rbac();
            $ids=input('put.ids');
            $idArray=json_decode($ids);  //array
            $role_permission=model('RolePermission');
            Db::startTrans();
            try{
                $role_permission->where('role_id',input('put.id'))->delete();
                $rbacObj->assignRolePermission(input('put.id'),$idArray);
                Db::commit();
                return true;
            }catch (\Exception $exception){
                Db::rollback();
            }
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete(Request $request)
    {
        if ($request->isDelete()){
            $ids=input('delete.id');
            $idArray=json_decode($ids);  //array
            $id=implode(',',$idArray);
            Db::startTrans();
            try{
                $role=model('Role');
                $role->whereIn('id',$id)->update(['key'=>0]);
                $staffExtend=new \app\common\model\RolePermission();
                $staffExtend->whereIn('role_id',$id)->delete();
                Db::commit();
                return true;
            }catch (\Exception $exception){
                Db::rollback();
            }


        }
    }
}
