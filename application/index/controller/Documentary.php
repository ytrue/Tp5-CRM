<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Documentary extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
       $documentary=model('Documentary');
       $client=model('Client');
       $staff=model('Staff');

       return view('index',['data'=>$documentary->getList(),'client'=>$client->getAll(),'staff'=>$staff->getAlls()]);
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
            $data['sn']=date('YmdHis');
            $data['enter']=session('name');
            $data['create_time']=date('Y-m-d H:i:s');
            $documentary=model('Documentary');
            $documentary->save($data);

            $data['last_add_id']=$documentary->getLastInsID();
            return $data;
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
            $post=model('Documentary');
            $findOne=$post->findOne($id);
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
    public function update(Request $request, $id)
    {
        if ($request->isPut()){
            $data=input('put.');
            $post=model('Documentary');
            $post->save(
                [
                    'title'=>$data['title'],
                    'client_company'=>$data['client_company'],
                    'client_id'=>$data['client_id'],
                    'staff_name'=>$data['staff_name'],
                    'staff_id'=>$data['staff_id'],
                    'way'=>$data['way'],
                    'evolve'=>$data['evolve'],
                    'remark'=>$data['remark'],
                ],
                ['id'=>$data['id']]);
                 return true;
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
            $post=\app\common\model\Documentary::destroy($id);
            if ($post){
                return true;
            }
        }
    }
}
