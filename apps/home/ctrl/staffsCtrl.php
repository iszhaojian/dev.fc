<?php
namespace apps\home\ctrl;
use apps\home\model\demo;
class staffsCtrl extends baseCtrl{
  // 构造方法
  public function _auto(){

  }

  // 职员页面
  public function index(){
    // Get
    if (IS_GET === true) {
      // 读取当前用户基本信息
      $data = $this->udb->getidInfo($_SESSION['userinfo']['id']);
      // 获取当前用户类型 1>总代理 ，2>代理商，3>经销商
      if ($data['type'] == 1) {
        // 读取代理商信息和总数
        $data['agent'] = $this->udb->getLevel($_SESSION['userinfo']['id']);
        $data['agent']['count'] = $this->udb->getTotalLevel($_SESSION['userinfo']['id']);
        // 读取经销商信息和总数
        foreach ($data['agent'] AS $k => $v) {
          $data['agency'][] = $this->udb->getLevel($v['id']);
          $data['agency']['count'][] = $this->udb->getTotalLevel($v['id']);
        }
        see($data);
        die;
        // 读取经销商邀请的用户和总数
        // foreach ($data['agency'] ) {

        // }

      }

      // assign
      $this->assign('push_money',$push_money);
      $this->assign('totalLevel',$totalLevel);
      // display
      $this->display('staffs','index.html');
      die;
    }
  }

  // 分享二维码页面
  public function shareQRcode(){
    // Get
    if (IS_GET === true) {
      // display
      $this->display('staffs','shareQRcode.html');
      die;
    }
  }

  // 生成二维码
  public function getQRcode(){
    // 引入二维码类
    include ICUNJI.'/vendor/wxpay/phpqrcode/phpqrcode.php';
    $data = isHttps() . '/base/index/pid/' . $_SESSION['userinfo']['id']; 
    $level = 'L';// 纠错级别：L、M、Q、H
    $size = 6;// 点的大小：1到10,用于手机端4就可以了
    $QRcode = new \QRcode();
    ob_start();
    $QRcode->png($data,false,$level,$size);
    $imageString = base64_encode(ob_get_contents());
    return $imageString;
  }






}