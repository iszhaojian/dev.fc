<?php
namespace apps\admin\ctrl;
use apps\admin\model\user;
use core\lib\conf;
use vendor\page\Page;

class userCtrl extends baseCtrl{
	public $db;
	public $id;
  public $pid;
	public $type;
	public function _auto(){
    if (isset($_SESSION['userinfo']) == null) {
            echo "<script>window.location.href='/admin/login/index'</script>";
            die;
    }
		$this->db = new user();
		$this->type = isset($_GET['type']) ? intval($_GET['type']) : 0;
    $this->assign('type',$this->type);
    $this->id = isset($_GET['id']) ? intval($_GET['id']) : 0;
		$this->pid = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
	}
	public function index(){

    // 读取用户信息 type>0 普通用户，1>总代理，2>代理商，3>经销商
    $data = $this->db->gettypeAll($this->pid,$this->type);
    // assign
    $this->assign('data',$data);
    // display
    $this->display('user','index.html');
    die;

    /*// 获取搜索条件
    $search = isset($_POST['search']) ? htmlspecialchars($_POST['search']) : '';

    // 总记录数
    $cou = $this->db->cou();
    // 数据分页
    $page = new Page($cou,conf::get('LIMIT','admin'));
    // 结果集

		$data = $this->db->getAll($this->type,$this->id,$page->limit,$search);

    $type = $this->type;

    $this->assign('type',$type);
		$this->assign('data',$data);
    $this->assign('page',$page->showpage());
		$this->display('user','index.html');
		die;*/

	}

	  // 初始化数据
  private function getData(){
    // data
    $data = array();
    $data['cname'] = $_POST['cname'];
    $data['phone'] = $_POST['phone'];
    $data['uid']   = $this->id;
    return $data;
  }

  public function add(){
   // Ajax
    if (IS_AJAX === true) {
        // password
      $type = $this->type;
      // update
      $delt = $this->db->ePass($this->id,$type);

      //data
       $data = $this->getData();
      // insert
       $res = $this->db->add($data);
      if ($res) {
        echo json_encode(true);
        die;
      } else {
        echo json_encode(false);
        die;
      }
    }
}

}