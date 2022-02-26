<?php

namespace app\index\controller;

use think\Controller;
use think\JWT;
use think\Request;

class Login extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
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
        $data=$this->request->post();
        $model=model('User');
        $result=$model->queryOne(['phone'=>$data['phone']]);
        $pas = secretPassword($data['password']);
        if($result===null){
              return json([
                  'code'=>400,
                  'msg'=>'该用户不存在'
              ]);
        }else if($pas!==$result['password']){
               return json([
                   'code'=>400,
                   'msg'=>'密码错误'
               ]);
        }else{
            $udata = [
                'uid'=>$result['uid'],
                'uname' =>$result['uname'],
                'avatar'=>$result['avatar']
            ];
            $token = JWT::getToken($udata, config('jwtkey'));
            return json([
                'code'=>200,
                'msg'=>'登录成功',
                'token'=>$token,
                'data'=>$result
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
