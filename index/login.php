
<?php
header('Content-Type:text/html;charset=utf-8');   //设置编码格式
require_once '../common/config.php';
require_once '../common/fun.php';
require_once '../common/db_class.php';
$db = new db_class(HOST, USERNAME, PASSWORD, DBNAME);   //连接数据库

//判断是否POST提交
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //接收数据
    $user = $_POST['user'];
    $password = $_POST['password'];
    date_default_timezone_set('PRC');   //设置时区
    $date = date('Y-m-d H:i:s');        //获取时间
    $db->db_settablename('user_infor');  //设置表名

    //判断用户名和密码是否为空
    if (empty($user) || empty($password)) {
        alertExit('用户名或密码不能为空', LOGINPAGE);
    }

    //判断该用户是否存在
    $res = $db->db_select("", "user_name=" . "'" . $user . "'");
    if (count($res) <= 0) {
        alertExit('该用户不存在', LOGINPAGE);
    }

    //判断密码是否正确
    if ($res[0]['user_pw'] != $password) {
        alertExit('密码不正确', LOGINPAGE);
    }

    //验证成功后存储session
    session_start();
    $_SESSION['user_name'] = $user;
    $_SESSION['user_id'] = $res[0]['id'];
    // 跳转首页
    alertExit('登录成功', INDEXPAGE);
} else {
    alertExit('请求不合法', LOGINPAGE);
}
