<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Lists extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data =$this->request->get();
        if(isset($data['page'])&& !empty($data['page'])){
            $page =$data['page'];
        }else{
            $page =1;
        }
        if(isset($data['limit'])&& !empty($data['limit'])){
        $limit =$data['limit'];
        }else{
        $limit =5;
        }
        if(isset($data['field'])&& !empty($data['field'])){
            $field =$data['field'];
        }else{
            $field ='sid';
        }
        $where=[];
        if(isset($data['sname'])&& !empty($data['sname'])){
            $where['sname']= ['like', '%'.$data['sname'].'%'];
        }
        $where['types']='hotal';
        $result= Db::table('stayhome')->field('sid,sname,sprice,sthumb')->where($where)->order($field,'desc')->paginate($limit,false,['page'=>$page]);
        $stayhome =$result->items();
        $total =$result->total();
        if($stayhome && $result){
            return json([
                'code'=>200,
                'msg'=>'数据获取成功',
                'data'=>$stayhome,
                'total'=>$total,
                'where'=>$where
            ]);
        }else{
            return json([
                'code'=>404,
                'msg'=>'暂无数据',
            ]);
        }
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
