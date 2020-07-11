<?php
header('Content-Type:text/html;charset=utf-8');   //设置编码格式
require_once '../common/config.php';
require_once '../common/fun.php';
require_once '../common/db_class.php';
session_start();

$db = new db_class(HOST, USERNAME, PASSWORD, DBNAME);   //连接数据库

//判断是否POST提交
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //接收数据
    $article_id = $_POST['article_id'];  //文章id
    $cont = $_POST['cont'];   //评论内容
    date_default_timezone_set('PRC');   //设置时区
    $date = date('Y-m-d H:i:s');        //获取时间
    $db->db_settablename('revert_infor');  //设置表名

    //判断文章id是否为空
    if (empty($article_id)) {
        alertExit('请求不合法1', LOGINPAGE);
    }

    //判断评论内容是否为空
    if (empty($cont)) {
        alertExit('请输入评论内容', PINGLUNPAGE . "/?article_id={$article_id}");
    }

    //验证成功后插入数据
    $res = $db->db_insert(['article_id', 'cont', 'user_id', 'time'], ["'" . $article_id . "'", "'" . $cont . "'", "'" . $_SESSION['user_id'] . "'", "'" . $date . "'"]);
    if ($res > 0) {
        alertExit('评论成功', INDEXPAGE);
    } else {
        alertExit('注册失败,服务端错误', INDEXPAGE);
    }
} else {
    alertExit('请求不合法', LOGINPAGE);
}
