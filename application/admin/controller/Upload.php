<?php


namespace app\admin\controller;


use think\Controller;

class Upload extends Controller
{
public function index(){
   $file =$this->request->file('file');
    if($file){
        $info = $file->validate(['size'=>1000*1024,'ext'=>'jpg,png,jpeg,webg'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
             $imgpath=date('Ymd').'/'.$info->getFilename();
             return json([
                'code'=>200,
                'msg'=>'图片上传成功',
                'imgpath'=>'/hotel-admin/public/uploads/'.$imgpath
             ]);
        }else{
            return json([
                'code'=>404,
                'msg'=>$file->getError(),
            ]);

        }
    }else{
        return json([
            'code'=>404,
            'msg'=>'上传文件不能为空'
        ]);
    }
}
}