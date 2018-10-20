<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Client extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
         $client=model('Client');
         return view('index',['data'=>$client->getList()]);
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
            $data['enter']=session('name');

            $post=new \app\common\model\Client($data);
            $post->save();
            $post_ids=$post->getLastInsID();
            return $post_ids;

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
            $client=model('Client');
            $findOne=$client->findOne($id);
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
            $post=model('Client');
            $post->save(['name'=>$data['name'],'company'=>$data['company'],'tel'=>$data['tel'],'source'=>$data['source']],['id'=>$data['id']]);
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
            $post=\app\common\model\Client::destroy($id);
            if ($post){
                return true;
            }
        }
    }
}
