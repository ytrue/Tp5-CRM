<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Exception;
use think\Request;

class Receipt extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $order=model('Order');
        $receipt=model('Receipt');
        return view('index',['order'=>$order->select(),'data'=>$receipt->order('create_time','desc')->paginate(10,false)]);
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
            $receipt=model('Receipt');
            $outlib=model('Outlib');
            $order=model('Order');
            $data=input('post.');
            $data['enter']=session('name');
            $data['create_time']=date('Y-m-d H:i:s');

            Db::startTrans();
            try{
                $receipt->insert($data);
                $outlib->where('order_sn',$data['order_sn'])->update(['state'=>'已收款']);
                $order->where('sn',$data['order_sn'])->update(['pay_state'=>'已支付']);
                Db::commit();
                return true;
            }catch (Exception $exception){
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
