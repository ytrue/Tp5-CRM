<?php

namespace app\index\controller;


use think\Controller;
use think\Db;
use think\Request;

class Staff extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $staff=model('Staff');

        //显示所有职位
        $post=model('Post');

        return view('staff/index',['data'=>$staff->getList(),'post'=>$post->getAll()]);
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
        if ($request->isAjax()){
            $staffData=$request->only([
                'name',
                'number',
                'gender',
                'post',
                'type',
                'id_card',
                'tel',
                'nation',
                'marital_status',
                'entry_status',
                'entry_date',
                'dimission_date',
                'politics_statu',
                'education'
            ]);

            $staffExtendData=$request->except([
                'name',
                'number',
                'gender',
                'post',
                'type',
                'id_card',
                'tel',
                'nation',
                'marital_status',
                'entry_status',
                'entry_date',
                'dimission_date',
                'politics_statu',
                'education'
            ]);
            $staffData['create_time']=date('Y-m-d H:i:s');
       //     $staffExtendData['create_time']=date('Y-m-d H:i:s');
            Db::startTrans();
            try{
            $staff=model('Staff');
            $staff->save($staffData);
            $staff_ids=$staff->getLastInsID();
            $staffExtendDatas=\app\common\model\Staff::find($staff_ids);
            $staffExtendDatas->staffextend()->save($staffExtendData);
            Db::commit();
            return  $staff_ids;
            }catch (\Exception $exception){
                Db::rollback();
            }

            //数据过多 就不做验证了

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
            $staff=\app\common\model\Staff::find($id);
            $staffextend= $staff->staffextend;
            $data=array_merge($staff->toArray(),$staffextend->toArray());
            return  $data;
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
            $staffData=$request->only([
                'name',
                'number',
                'gender',
                'post',
                'type',
                'id_card',
                'tel',
                'nation',
                'marital_status',
                'entry_status',
                'entry_date',
                'dimission_date',
                'politics_statu',
                'education'
            ]);
            $staffExtendData=$request->except([
                'id',
                'name',
                'number',
                'gender',
                'post',
                'type',
                'id_card',
                'tel',
                'nation',
                'marital_status',
                'entry_status',
                'entry_date',
                'dimission_date',
                'politics_statu',
                'education'
            ]);
            Db::startTrans();
            try{
                $staff=new \app\common\model\Staff();
                $staff->save($staffData,['id'=>input('put.id')]);
                $staffs=\app\common\model\Staff::find(input('put.id'));
                $staffs->staffextend->save($staffExtendData);
                Db::commit();
                return true;
            }catch (\Exception $e){
                Db::rollback();
            }
        }
    }


    //个人详情
    public function details(Request $request)
    {
        if ($request->isPost()){
            $id=input('post.id');
            $staff=model('Staff');
            $data=$staff->find($id);
            $staff_user=$staff->user()->find($data['user_id']);
            $staff_extend=$staff->staffextend()->find($id);
            $data['accounts']=$staff_user['accounts'];
            $data['state']=$staff_user['state'];
            $data['intro']=$staff_extend['intro'];
            $data['details']=$staff_extend['datails'];
            return $data;
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
            //事物
            Db::startTrans();
            try{
                \app\common\model\Staff::destroy($id);
                $staffExtend=new \app\common\model\StaffExtend();
                $staffExtend->whereIn('staff_id',$id)->delete();
                // 提交事务
                Db::commit();
                return true;
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
            }
        }
    }
}
