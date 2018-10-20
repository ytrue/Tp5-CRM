<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Exception;
use think\Request;

class User extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($accounts=null,$state=null,$start=null,$end=null)
    {
        $user=model('User');
        if (\request()->isGet() && $accounts && $state && $start && $end){
            $data = $user->getList($accounts,$state,$start,$end)->toArray();
            return $data;
        }else{
            $data=$user->getList();
        }
        $staff = model('Staff');
        $role=model('Role');
        $count = $user->getCount();
        return view('user/index', ['data' => $data, 'count' => $count,'staff'=>$staff->getAll(),'role'=>$role->order('id','desc')->select()]);
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
            $data=input('post.');
            $data['create_time']=date('Y-m-d H:i:s');
            $data['last_login_ip']=$_SERVER['SERVER_ADDR'];
            $data['last_login_time']=date('Y-m-d H:i:s');
            $data['password']=sha1(input('post.password'));
            $data['status']=1;
            $validate=validate('User');
            if(!$validate->scene('save')->check($data)){
                return $this->error($validate->getError());
            }else{
                Db::startTrans();
                try {
                    $user = new \app\common\model\User($data);
                    $user->save();
                    $user_ids = $user->getLastInsID();
                    $staff = model('Staff');
                    $staff->save(['user_id' => $user_ids], ['id' => $_POST['staff_id']]);
                    Db::commit();
                    return $user_ids;
                }catch (\Exception $exception){
                    Db::rollback();
                }

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
        if (\request()->isGet()){
            //findOne
            $user=model('User');
            $staff=model('Staff');
            $findOne=$user->findOne($id);
            $staffArray=$staff->where('user_id',$id)->find();
            if ($staffArray){
                $staffId=$staffArray->toArray();
                $findOne['old_staff_id']=$staffId['id'];
                $findOne['old_staff_name']=$staffId['name'];
                $findOne['old_staff_number']=$staffId['number'];
                $findOne['old_staff_gender']=$staffId['gender'];
                $findOne['old_staff_post']=$staffId['post'];
                $findOne['old_staff_id_card']=$staffId['id_card'];
            }
            return $findOne;
        }
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request)
    {
        $user=model('User');
        if ($request->isPut()){
            $data=input('put.');
            $findOne=$user->findOne($data['id']);
            if (!$data['password']){
                 $data['password']=$findOne->password;
            }else{
                 $data['password']=sha1($data['password']);
            }
            $data['accounts']=$findOne->accounts;
            $validate=validate('User');
            if(!$validate->scene('edit')->check($data)){
                return $this->error($validate->getError());
            }else{
                if ($data['staff_name']==$findOne->staff_name){
                    $user->save($data,['id'=>$data['id']]);
                }else{
                    Db::startTrans();
                    try {
                        $staff = model('Staff');
                        $staff->where('id', $data['old_staff_id'])->update(['user_id' => 0]);
                        $staff->save(['user_id' => $data['id']], ['name' => $data['staff_name']]);
                        $user->save($data, ['id' => $data['id']]);
                        Db::commit();
                        return true;
                    }catch (\Exception $exception){
                        Db::rollback();
                    }


                }}
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
            $staff = model('Staff');
            $delete_data=$staff->where(['user_id' => ['in',$id]])->select();
            Db::startTrans();
            try {
                $staff->where(['user_id' => ['in',' '.$id.' ']])->update(['user_id' => 0]);
                \app\common\model\User::destroy($id);
                Db::commit();
            }catch (\Exception $exception){
                Db::rollback();
            }
            return $delete_data;

        }
    }
}
