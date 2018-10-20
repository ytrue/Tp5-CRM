<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Allo extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $work=model('Work');
        $staff=model('Staff');
        $staffData=$staff->select();
        $data=$work->where('allo_id',session('id'))->order('create_time','desc')->paginate(10,false);
        return view('index',['data'=> $data,'staffData'=>$staffData]);
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
            $data['state']='进行中';
            $data['stage']='创建工作计划';
            $data['staff_name']=input('post.staff_name');
            $data['allo_name']=session('name');
            $data['staff_id']=input('post.staff_id');
            $data['allo_id']=session('id');
            $data['create_time']=date('Y-m-d H:i:s');

            //添加次计划的第一条初始阶段
            $WorkStageData['title']='创建工作任务';
            $WorkStageData['create_time']=date('Y-m-d H:i:s');

            Db::startTrans();
            try{
                $work = new \app\common\model\Work($data);
                $work->save();
                $work_id = $work->getLastInsID();
                $WorkStageData['work_id']=$work_id;
                $workStage=model('WorkStage');
                $workStage->save($WorkStageData);
                Db::commit();
                return $work_id;
            }catch (\Exception $exception){
                Db::rollback();
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
