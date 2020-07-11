<?php
require_once 'config.php';
//判断用户是否登录
if(empty($_SESSION['user_name']) || empty($_SESSION['user_id']))
{
    echo "<script>window.location.href='".LOGINPAGE."'</script>";
    exit;
}