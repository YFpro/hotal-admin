<?php


namespace app\common\model;


use think\Model;

class User extends Model
{
    protected $autoWriteTimestamp=true;
    public function add($data){
      return $this->save($data);
 }
    public function queryOne($where , $field="uid,uname,phone,avatar,password,collections"){
        return $this->field($field)->where($where)->find();
    }

}