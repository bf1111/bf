<?php
header('Content-Type:text/html;charset=utf-8');   //设置编码格式
require_once '../common/config.php';
require_once '../common/fun.php';
require_once '../common/db_class.php';

$db = new db_class(HOST, USERNAME, PASSWORD, DBNAME);   //连接数据库

//判断是否POST提交
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //接收数据
    $user_name = $_POST['user_name'];
    $user_pw = $_POST['user_pw'];
    $user_confirmpw = $_POST['user_confirmpw'];
    date_default_timezone_set('PRC');   //设置时区
    $date = date('Y-m-d H:i:s');        //获取时间
    $db->db_settablename('user_infor');  //设置表名

    //判断数据是否为空
    if (empty($user_name) || empty($user_pw) || empty($user_confirmpw)) {
        alertExit('用户名、密码、重复密码不能为空', REGISTERPAGE);
    }

    //判断用户名是否符合规范（4-16位单词或数字）
    if (!preg_match("/^\w{4,12}$/", $user_name)) {
        alertExit('请输入4~12位单词或数字的用户名', REGISTERPAGE);
    }

    //判断密码是否符合规范(8~16位首字母单词)
    if (!preg_match("/^[a-zA-Z]{1}\w{7,15}$/", $user_pw)) {
        alertExit('请输入首位单词的8~16位密码', REGISTERPAGE);
    }

    //判断两次密码是否一致
    if ($user_pw != $user_confirmpw) {
        alertExit('您输入的两次密码不一致', REGISTERPAGE);
    }

    //判断用户名是否已存在
    $res = $db->db_select("", "user_name=" . "'" . $user_name . "'");
    if (count($res) > 0) {
        alertExit('该用户名已被注册', REGISTERPAGE);
    }

    //向数据库插入新数据
    $res = $db->db_insert(['user_name', 'user_pw', 'time'], ["'".$user_name."'","'".$user_pw."'","'".$date."'"]);
    if ($res > 0) {
        alertExit('注册成功', LOGINPAGE);
    } else {
        alertExit('注册失败,服务端错误', REGISTERPAGE);
    }
} else {
    alertExit('请求不合法', REGISTERPAGE);
}