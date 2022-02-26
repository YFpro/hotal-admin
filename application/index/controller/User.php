<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class User extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = $this->request->get();
        $sid =$data['sid'];
        $uid=$data['uid']*1;
        $collection= Db::table('user')->where('uid',$uid)->field('collections')->find();
        $coll=explode(',',$collection['collections']);
        if(in_array($sid,$coll,true)){
            foreach($coll as $k=>$v){
                if($v == $sid){
                    unset($coll[$k]);
              }
            }
            $coll1= implode(',', $coll);
           $res= Db::table('user')->where('uid',$uid)->update(['collections'=>$coll1]);
            if($res){
                return json([
                     'code'=>200,
                      'msg'=>'取消收藏'
                ]);
            }
        }else{
            array_push($coll,$sid);
            $coll1=implode(',',$coll);
            $res1= Db::table('user')->where('uid',$uid)->update(['collections'=>$coll1]);
            if ($res1){
                return json([
                    'code'=>200,
                    'msg'=>'收藏成功'
                ]);
            }
        }
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
        $data=$this->request->post();
        $data['password']=secretPassword($data['password']);
        $data['uname']='小明'.time();
        $phone=$data['phone'];
        $kkk= Db::table('user')->where('phone',$phone)->find();
        if($kkk){
            return json([
                'code'=>400,
                'msg'=>'该手机号已注册',
            ]);
        }
        $model=model('User');
        $result=$model->add($data);
        if($result){
            return json([
                'code'=>200,
                'msg'=>'注册成功'
            ]);
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
        //
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
