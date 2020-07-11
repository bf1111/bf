<?php
require_once 'config.php';
//判断用户是否登录
session_start();
if ($_SESSION['user_name'] == "" || $_SESSION['user_id'] == "") {
    echo "<script>window.location.href='" . LOGINPAGE . "'</script>";
    exit;
}
