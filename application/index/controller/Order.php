<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Order extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $documentary=model('Documentary');
        $documentaryData=$documentary->where('evolve','谈判中')->select();
        $product=model('Product');
        $productData=$product->where('inventory','<>','0')->select();
        $order=model('Order');
        $orderData=$order->order('create_time','desc')->paginate(10,false);
        return view('index',['documentary'=>$documentaryData,'product'=>$productData,'order'=>$orderData]);
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
            $data['sn']=date('YmdHis');
            $data['title']=input('post.title');
            $data['documentary_id']=input('post.documentary_id');
            $data['original']=input('post.original');
            $data['pay_state']='未支付';
            $data['enter']=session('name');
            $data['create_time']=date('Y-m-d H:i:s');
            $data['cost']=input('post.cost');

            $dataNew['data']=input('post.data');
            $dataNew['order_sn']=date('YmdHis');
            $dataNew['state']='未处理';
            $dataNew['create_time']=date('Y-m-d H:i:s');
            $newData= json_decode($dataNew['data']);
            Db::startTrans();
            try {
                $outlib=model('Outlib');
                $order=model('Order');
                $orderExtend=model('OrderExtend');
                $product=model('Product');
                $order->save($data);
                $staff_ids = $order->getLastInsID();
                $orderExtend->save(['order_id' => $staff_ids, 'details' => input('post.details')]);

                for ($i=0; $i<sizeof($newData); $i++){

                    $outlib->insert([
                        'product_id'=>$newData[$i][1],
                        'number'=>$newData[$i][0],
                        'order_sn'=>$dataNew['order_sn'],
                        'state'=>$dataNew['state'],
                        'enter'=>session('name'),
                        'create_time'=>$dataNew['create_time'],
                    ]);

                    $product->where('id',$newData[$i][1])->setDec('inventory',$newData[$i][0]);
                    $product->where('id',$newData[$i][1])->setInc('inventory_out',$newData[$i][0]);
                }
                Db::commit();
                return  $staff_ids;
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

    public function details(Request $request)
    {
        if ($request->isPost()){
            $id=input('post.id');
            $order=model('Order');
            $product=model('Product');
            $outlib=model('Outlib');
            $dataOne=$order->find($id);
            $dataExend=$dataOne->orderExtend()->find();
            $dataDoucmentary=$dataOne->documentary()->find();
            $data['sn']=$dataOne['sn'];
            $data['title']=$dataOne['title'];
            $data['original']=$dataOne['original'];
            $data['cost']=$dataOne['cost'];
            $data['pay_state']=$dataOne['pay_state'];
            $data['enter']=$dataOne['enter'];
            $data['create_time']=$dataOne['create_time'];
            $data['details']=$dataExend['details'];
            $data['client_company']=$dataDoucmentary['client_company'];
            $data['staff_name']=$dataDoucmentary['staff_name'];
            $productData=$dataOne->outlib()->select();
            $OutlibId=[];
            for ($i=0; $i<sizeof($productData); $i++){
                $OutlibId[$i]=$productData[$i]['id'];
            }
            $OutlibIds=implode(',',$OutlibId);

            $yang=Db::view("outlib","number,state,dispose_time")->whereIn('outlib.id',$OutlibIds)
                ->view("product",'sn,name,sell_price',"outlib.product_id=product.id")
                ->select();
            return     json_encode( $yang) .'@@'. json_encode($data) ;
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

    }
}
