<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Inform extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $inform=model('Inform');
        $data=$inform->order('create_time','desc')->paginate(false,10);
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
            $inform=model('Inform');
            $data['staff_id']=session('staff_id');
            $data['staff_name']=session('name');
            $data['title']=input('post.title');
            $data['details']=input('post.details');
            $data['create_time']=date('Y-m-d H:i:s');
            if($inform->save($data)){
                 return  $inform->getLastInsID();
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
    public function edit($id)
    {
        if (\request()->isGet()){
            //findOne
            $inform=model('Inform');
            $findOne=$inform->find($id);
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
            $inform=model('Inform');
            if($inform->save(['title'=>$data['title'],'details'=>$data['details']],['id'=>$data['id']])){
                return true;
            }else{
                return false;
            }
        }
    }


    /*list*/
    public function details(Request $request)
    {
        if ($request->isPost()){
            $inform=model('Inform');
            $id=input('post.id');
            $findOne=$inform->find($id);
            return $findOne;
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
            $post=\app\common\model\Inform::destroy($id);
            if ($post){
                return true;
            }
        }
    }
}
