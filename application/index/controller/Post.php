<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Hook;
use think\Request;

class Post extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($name=null,$start=null,$end=null)
    {
            $post=model('Post');
            if (\request()->isGet() && $name && $start && $end){
                $data = $post->getList($name,$start,$end)->toArray();
                return $data;
            }else{
                $data = $post->getList();
            }
            $count = $post->getCount();
            return view('post/index', ['data' => $data, 'count' => $count]);

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
        if ($request->isPost()){
            $data=input('post.');
            $data['create_time']=date('Y-m-d H:i:s');
            $validate=validate('Post');
            if(!$validate->scene('save')->check($data)){
                return $this->error($validate->getError());
            }else{
                $post=new \app\common\model\Post($data);
                if($post->save()){
                    //这一块可以写到 model 里，这里因为模块太多就直接在控制器中写入
                    $params['user']=session('accounts').'('. session('name').')';
                    $params['type']='登录系统';
                    $params['type_name']=request()->action();
                    $params['module']='人事管理 >> 新增职位';
                    $params['ip']=$_SERVER["REMOTE_ADDR"];
                    $params['create_time']=date('Y-m-d H:i:s');
                    Hook::add('app_init', 'app\\index\\behavior\\Log');
                    Hook::listen('app_init',$params);
                    $post_ids=$post->getLastInsID();
                    return $post_ids;
                }
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
            $post=model('Post');
            $findOne=$post->findOne($id);
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
    public function update(Request $request)
    {
        if ($request->isPut()){
            $data=input('put.');
            $post=model('Post');
            $validate=validate('Post');
            if(!$validate->scene('edit')->check($data)){
                return $this->error($validate->getError());
            }else{
                $post->save(['name'=>$data['name']],['id'=>$data['id']]);
                return true;
            }

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
            $post=\app\common\model\Post::destroy($id);
            if ($post){
                return true;
            }
        }
    }
}
