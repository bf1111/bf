<?php
require_once '../common/config.php';
require_once '../common/fun.php';
//清除session
$_SESSION['user_name'] = null;
$_SESSION['user_id'] = null;
$_SESSION = array();
session_destroy();  //销毁数据
// 跳转
if(empty($_SESSION)){
    alertExit('退出成功',LOGINPAGE);
}

