<?php
header('Content-Type:text/html;charset=utf-8');   //设置编码格式
require_once 'config.php';
require_once 'fun.php';
require_once 'db_class.php';

$db = new db_class(HOST, USERNAME, PASSWORD, DBNAME);   //连接数据库

//判断是否POST提交
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//接收数据
	$title = $_POST['title'];
	$cont = $_POST['cont'];
	date_default_timezone_set('PRC');   //设置时区
	$date = date('Y-m-d H:i:s');        //获取时间
	$db->db_settablename('article_infor');  //设置表名

	//判断标题和内容是否为空
	if (empty($title) || empty($cont)) {
		alertExit('标题或内容不能为空', ARTICLEPAGE);
	}

	//不为空数据入库
	$res = $db->db_insert(['user_id', 'title', 'cont', 'time'], ["'" . $_SESSION['user_id'] . "'", "'" . $title . "'", "'" . $cont . "'", "'" . $date . "'"]);
	if ($res > 0) {
		alertExit('发布成功', INDEXPAGE);
	} else {
		alertExit('发布失败,服务端错误', ARTICLEPAGE);
	}
} else {
	alertExit('请求不合法', LOGINPAGE);
}
