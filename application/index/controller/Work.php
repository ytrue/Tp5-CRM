<?php

namespace app\index\controller;

use app\common\model\WorkStage;
use think\Controller;
use think\Db;
use think\Request;

class Work extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $work=model('Work');
        $data=$work->where('staff_id',session('id'))->order('create_time','desc')->paginate(10,false);
        return view('index',['data'=> $data]);
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
            $data['staff_name']=session('name');
            $data['allo_name']=session('name');
            $data['staff_id']=session('id');
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
    public function edit(\app\common\model\Work $work,Request $request,$id)
    {
        if ($request->isGet()){
             $workData=$work->where('id',$id)->find();
             $workStageData=$work->WorkStage($id)->select();
             return  json_encode($workData).'@@'.json_encode($workStageData);
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
            $work=model('Work');
            $work->save(['state'=>'已完成'],['id'=>input('put.id')]);
            return true;
        }
    }


    /*add workStage*/
    public function extend(Request $request)
    {
        if ($request->isPost()){
                /*这里使用事务处理会有bug 需要再调整*/
                $work=model('Work');
                $workStage=model('WorkStage');
                $workStage->save(['work_id'=>input('post.work_id'),'title'=>input('post.title'),'create_time'=>input('post.create_time')]);
                $work->save(['stage'=>input('post.title')],['id'=>input('post.work_id')]);
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

            Db::startTrans();
            try{
                \app\common\model\Work::destroy($id);
                WorkStage::where(['work_id' => ['in',' '.$id.' ']])->delete();
                Db::commit();
                return true;
            }catch (\Exception $exception){
                Db::rollback();
            }

        }
    }
}
