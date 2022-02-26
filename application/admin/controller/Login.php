<?php


namespace app\admin\controller;


use think\Controller;
use think\Db;
use think\JWT;
class Login extends Controller
{
   public function check(){
       $method = $this->request->method();
       if($method!='POST'){
           return json([
               'code'=>404,
               'msg'=>'请求方式错误'
           ]);
       }
       $data=$this->request->post();
       $validate=validate('login');
       $flag=$validate->scene('login')->check($data);
       if(!$flag){
           return json([
               'code'=>404,
               'msg'=>$validate->getError(),
           ]);
       }
       $whereArr=['username'=>$data['username']];
       $user=Db::table('admin')->where($whereArr)->find();
       if($user){
          $password= md5(crypt($data['password'],config('salt')));
          if($password === $user['password']){
              $payload = [
                  'id'=>$user['id'],
                  'username' =>$user['username'],
                  'avatar'=>$user['avatar']
           ];
            $token = JWT::getToken($payload, config('jwtkey'));
              return json([
                  'code'=>200,
                  'msg'=>'登录成功',
                  'token'=>$token,
                  'user'=>$payload
              ]);
          }else{
              return json([
                  'code'=>404,
                  'msg'=>'用户名或密码不正确'
              ]);
          }
       }else{
           return json([
               'code'=>404,
               'msg'=>'该用户不存在'
           ]);
       }
   }
   public function updatepass(){
       checkToken();
       if(!$this->request->isPost()){
           return json([
               'code'=>404,
               'msg'=>'请求方式错误',
           ]);
       }
        $data=$this->request->post();
       $validate=validate('login');
       if(!$validate->scene('changepass')->check($data)){
           return json([
               'code'=>404,
               'msg'=>$validate->getError()
           ]);
       }
       $id=$this->request->id;
       $oldpass=secretPassword($data['oldpass']);
       $newpass=secretPassword($data['newpass']);
       if($oldpass == $newpass){
           return json([
               'code'=>404,
               'msg'=>'新密码和原密码不能相同'
           ]);
       }
       $result=Db::table('admin')->field('password')->where('id',$id)->find();
       $password=$result['password'];
       if($password != $oldpass){
           return json([
               'code'=>404,
               'msg'=>'原密码错误'
              ]);
           }
     $result = Db::table('admin')->where('id',$id)->update(['password'=>$newpass]);
       if($result){
           return json([
               'code'=>200,
               'msg'=>'密码修改成功',
           ]);
       }else{
           return json([
               'code'=>404,
               'msg'=>'密码修改失败',
           ]);
       }
   }
}
