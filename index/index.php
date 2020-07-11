<?php
require_once '../common/regsession.php';
require_once '../common/config.php';
require_once '../common/fun.php';
require_once '../common/db_class.php';

$db = new db_class(HOST, USERNAME, PASSWORD, DBNAME);   //连接数据库
$db->db_settablename('article_infor');  //设置表名    

//首页文章显示
$db->db_setorder("time DESC");
if (empty($_GET['page'])) {
    $page = 1;
} else {
    $page = intval($_GET['page']);
}
$res = $db->db_setlimit($page, 1);


?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy">


    <title>首页</title>
    <!-- Custom styles for this template -->
    <link href="../css/blog.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/blog.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    


</head>

<body>

    <div class="blog-masthead">
        <div class="container">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a class="blog-nav-item " href="/bf/index/index.php">首页</a>
                </li>
                <li>
                    <a class="blog-nav-item" href="/bf/index/create.article.php">写文章</a>
                </li>
                <li>
                    <input name="query" type="text" value="" class="form-control" style="margin-top:10px" placeholder="搜索词">
                </li>
                <li>
                    <button class="btn btn-default" style="margin-top:10px" type="submit">Go!</button>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <div>
                        <img src="/storage/9f0b0809fd136c389c20f949baae3957/iBkvipBCiX6cHitZSdTaXydpen5PBiul7yYCc88O.jpeg" alt="" class="img-rounded" style="border-radius:500px; height: 30px">
                        <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['user_name'] ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="logout.php">登出</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">

        <div class="blog-header">
        </div>

        <div class="row">
            <div class="col-sm-8 blog-main">
                <div style="height: 20px;">
                </div>
                <div>
                    <?php
                    foreach ($res['data'] as $data) {
                    ?>
                        <div class="blog-post">
                            <h2 class="blog-post-title"><a href="article_show.php/?article_id=<?php echo $data['id'] ?>"><?php echo $data['title'] ?></a></h2>
                            <p class="blog-post-meta"><?php echo $data['time']; ?> <a href="/user/5"></a></p>

                            <p><?php echo subtext($data['cont']) ?>
                        </div>
                    <?php
                    }
                    ?>

                    <ul class="pagination">
                        <?php
                        for ($i = 1; $i <= $res['page']; $i++) {
                        ?>
                            <li><a href="/bf/index/index.php/?page=<?php echo $i ?>"><span><?php echo $i; ?></span></a></li>
                        <?php
                        }
                        ?>
                    </ul>

                </div>
                <!-- /.blog-main -->
            </div>

            <div id="sidebar" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            </div>
        </div>
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container -->

    <footer class="blog-footer">
        <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
        <p>
            <a href="#">Back to top</a>
        </p>
    </footer>
    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/wangEditor.min.js"></script>
    <script src="js/ylaravel.js"></script>

</body>

</html>