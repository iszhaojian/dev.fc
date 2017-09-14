<?php
namespace apps\home\model;
use core\lib\model;
class user extends model{
  public $table = 'user';
  /**
   * 根据oepnid读取详细信息
   */
  public function getopenidInfo($openid){
    return $this->get($this->table,'*',['openid'=>$openid]);
  }

  /**
   * 根据id读取详细信息
   */
  public function getidInfo($id){
    return $this->get($this->table,'*',['id'=>$id]);
  }

  /**
   * 写入数据表
   */
  public function add($data){
    $this->insert($this->table,$data);
    return $this->id();
  }

  /**
   * 更新数据表
   */
  public function save($id,$data){
    $res = $this->update($this->table,$data,['id'=>$id]);
    return $res->rowCount();
  }

}
