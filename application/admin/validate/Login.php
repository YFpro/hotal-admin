<?php


namespace app\admin\validate;


use think\Validate;

class Login extends Validate
{
protected $rule=[
    'username'=>'require',
    'password'=>'require',
    'oldpass'=>'require',
    'newpass'=>'require',
    'newpassagin'=>'require|confirm:newpass'

];
protected $message=[
     'username'=>'用户名不能为空',
     'password'=>'密码不能为空',
     'oldpass'=>'旧密码必填',
     'newpass'=>'新密码必填',
     'newpassagain.require'=>'确认密码必填',
     'newpassagin.confirm'=>'新密码相同'
];
protected $scene =[
    'login'=>'username,password',
    'changepass'=>'oldpass,newpass,newpassagin'
];
}