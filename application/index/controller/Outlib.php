<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Outlib extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $outlib=model('Outlib');
        return view('index',['data'=>$outlib->order('create_time','desc')->paginate(10,false)]);
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
        //
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

    //
    public function ok(Request $request)
    {
        if ($request->isPost()){
            $ids=input('post.id');
            $idArray=json_decode($ids);  //array
            $id=implode(',',$idArray);
            $outlib=model('Outlib');
            $outlib->whereIn('id',$id)->update(['state'=>'已出货','clerk'=>session('name'),'dispose_time'=>date('Y-m-d H:i:s')]);
            return true;
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $i
     *

     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
