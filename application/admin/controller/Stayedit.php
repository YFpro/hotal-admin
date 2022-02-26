<?php


namespace app\admin\controller;


use think\Controller;
use think\Db;
class Stayedit extends Controller
{
    public function update()
    {
        $data = $this->request->post();
        $sid = $data['sid'];
        unset($data['sid']);
        unset($data['sbanner1']);
        $result = Db::table('stayhome')->where('sid', $sid)->update($data);
        if ($result) {
            return json([
                'code' => 200,
                'msg' => '更新成功',
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '更新失败',
            ]);
        }
    }

    public function delete()
    {
        $data = $this->request->get();
        $category = Db::table('stayhome')->where('sid', $data['sid'])->delete();
        if ($category) {
            return json([
                'code' => 200,
                'msg' => '删除成功',
            ]);
        } else {
            return json([
                'code' => 200,
                'msg' => '删除失败',
            ]);
    }
    }
}