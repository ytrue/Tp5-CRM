<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Product extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Product=model('Product');
        return view('index',['data'=>$Product->getList()]);
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
        if ($request->isAjax()){
            $productData=$request->only([
                'name',
                 'sn',
                'pro_price',
                'sell_price',
                'unit',
                'type',
                'inventory_alarm'
            ]);

            $productExtendData=$request->only([
                'details'
            ]);
            Db::startTrans();
            try {
                $productData['create_time'] = date('Y-m-d H:i:s');
                $product = model('Product');
                $product->save($productData);
                $product_ids = $product->getLastInsID();
                $ProductExtendDatas = \app\common\model\Product::find($product_ids);
                $ProductExtendDatas->productExtend()->save($productExtendData);
                Db::commit();
            }catch (\Exception $exception){
                Db::rollback();
            }
            return  $product_ids;
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read(Request $request)
    {
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
            $product=\app\common\model\Product::find($id);
            $productExtend= $product->productExtend;
            $data=array_merge($product->toArray(),$productExtend->toArray());
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
        if ($request->isPut()) {
            $productData = $request->only([
                'id',
                'name',
                'sn',
                'pro_price',
                'sell_price',
                'unit',
                'type',
                'inventory_alarm'
            ]);

            $productExtendData = $request->only([
                'details'
            ]);
            Db::startTrans();
            try {
                $product = new \app\common\model\Product();
                $product->save($productData, ['id' => input('put.id')]);
                $products = \app\common\model\Product::find(input('put.id'));
                $products->productExtend->save($productExtendData);
                Db::commit();
                return true;
            }catch (\Exception $exception){
                Db::rollback();
            }
        }
    }

    //个人详情
    public function details(Request $request)
    {
        if ($request->isPost()){
            $id=input('post.id');
            $product=model('Product');
            $data=$product->find($id);
            $product_extend=$product->productExtend()->find($id);
            $data['details']=$product_extend['details'];
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
                \app\common\model\Product::destroy($id);
                $productExtend=new \app\common\model\ProductExtend();
                $productExtend->whereIn('product_id',$id)->delete();
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
