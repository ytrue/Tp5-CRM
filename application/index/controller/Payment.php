<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Payment extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $product=model("Product");
        $staff=model('Staff');
        $inilb=model('Inlib');

        $data=Db::view("inlib","id,product_id,number,staff_name,mode,mode_explain,enter,create_time")
            ->view("product",'name,type,pro_price,sn,sell_price',"inlib.product_id=product.id")->order('inlib.create_time','desc')
            ->paginate(10,false);



        return view('index',['product'=>$product->getAll(),'staff'=>$staff->getAlls(),'data'=>$data]);

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

            $product=model('Product');
            $data=input('post.');
            $data['enter']=session('name');
            $data['create_time']=date('Y-m-d H:i:s');
            Db::startTrans();
            try{
                $inlib=new \app\common\model\Inlib($data);
                $inlib->save();
                $inlib_id=$inlib->getLastInsID();
                $product->where('id',$data['product_id'])->setInc('inventory',$data['number']);
                $product->where('id',$data['product_id'])->setInc('inventory_in',$data['number']);
                Db::commit();
            }catch (\Exception $exception){
                Db::rollback();
            }
            return  $inlib_id;





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

    //个人详情
    public function details(Request $request)
    {
        if ($request->isPost()){
            $id=input('post.id');
            $Inlib=model('Inlib');
            $data=$Inlib->find($id);
            $product_details=$Inlib->product()->find($data['product_id']);

            $data['type']=$product_details['type'];
            $data['sn']=$product_details['sn'];
            $data['pro_price']=$product_details['pro_price'];
            $data['name']=$product_details['name'];

            return $data;
        }
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
