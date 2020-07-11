<?php
//防止在别的程序里被其他人修改
//数据库
define('HOST','127.0.0.1');
define('USERNAME','root');
define('PASSWORD','123456');
define('DBNAME','article');

//页面信息
define('LOGINPAGE', 'login.html');   //登录页面
define('INDEXPAGE','index.php');     //首页
define('REGISTERPAGE','register.html');  //注册页面
define('ARTICLEPAGE','create_article.php');   //发布文章页面
define("ARTICLEEDITPAGE",'article_edit.php');  //编辑文章页面
define('PINGLUNPAGE','pinglun.php');   //评论页面
?>