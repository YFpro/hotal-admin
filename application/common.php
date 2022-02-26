<?php
// 应用公共文件
use\think\JWT;
function checkToken(){
      $get_token=request()->get('token');
      $post_token=request()->post('token');
      $header_token=request()->header('token');
      if($get_token){
          $token=$get_token;
      }else if($post_token){
          $token=$post_token;
      } else if($header_token){
          $token=$header_token;
      }else{
          json(['code'=>404,'msg'=>'token不能为空'],401)->send();
          exit();
      }
      $tokenResult=JWT::verify($token,config('jwtkey'));
      if(!$tokenResult){
        json(['code'=>404, 'msg'=>'token验证失败' ],401)->send();
        exit();
}
    request()->id = $tokenResult['id'];
    request()->username = $tokenResult['username'];
}
function secretPassword($pass){
    return md5(crypt($pass,config('salt')));
}
function resetpassword(){
    return md5(crypt(config('defaultPassword'),config('salt')));
}