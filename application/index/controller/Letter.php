<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Letter extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $staff=model('Staff');
        $letter=model('Letter');
        $data=$letter->where('staff_id',session('staff_id'))->order('create_time','desc')->paginate(10,false);
        $staffData=$staff->select();
        return view('index',['staffData'=>$staffData,'data'=>$data]);
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
          $data['message']=input('post.message');
          $data['staff_id']=input('post.staff_id');
          $data['staff_name']=input('post.staff_name');
          $data['send_id']=session('staff_id');
          $data['send_name']=session('name');
          $data['create_time']=date('Y-m-d H:i:s');
          $data['isread']='未读';
          $letter=model('Letter');
          if ($letter->save($data)){
              return $letter->getLastInsID();
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
       // if ($request->isGet()){
            $letter=model('Letter');
            $letterData=$letter->find($id);
            if ($letterData['isread']=='未读') {
                $letter->where('id', $id)->update(['isread' => '已读']);
            }
            return $letterData;
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
    public function delete(Request $request)
    {
        if ($request->isDelete()){
            $ids=input('delete.id');
            $idArray=json_decode($ids);  //array
            $id=implode(',',$idArray);
            $post=\app\common\model\Letter::destroy($id);
            if ($post){
                return true;
            }
        }
    }
}
