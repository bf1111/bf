<?php
header('Content-Type:text/html;charset=utf-8');   //设置编码格式
require_once '../common/regsession.php';
require_once '../common/config.php';
require_once '../common/fun.php';
require_once '../common/db_class.php';

$db = new db_class(HOST, USERNAME, PASSWORD, DBNAME);   //连接数据库

//接收数据
$article_id = $_GET['article_id'];   //接收文章id
date_default_timezone_set('PRC');   //设置时区
$date = date('Y-m-d H:i:s');        //获取时间
$db->db_settablename('article_infor');  //设置表名

//查询数据（文章）
$res = $db->db_select("", "id=" . "'" . $article_id . "'");


//获取评论
$db->db_settablename('revert_infor');  //设置表名
$comments = $db->db_select("", "article_id=" . "'" . $article_id . "'");
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
    <!-- <meta name="csrf-token" content="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy"> -->


    <title>首页</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="../css/blog.css" rel="stylesheet">
    <link href="../../css/blog.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/blog.css"> -->
</head>

<body>

    <div class="blog-masthead">
        <div class="container">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a class="blog-nav-item " href="/19/bf/index/index.php">首页</a>
                </li>
                <li>
                    <a class="blog-nav-item" href="/19/bf/index/createarticle.php">写文章</a>
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
                        <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['user_name'] ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="../logout.php">登出</a></li>
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
                <div class="blog-post">
                    <div style="display:inline-flex">
                        <h2 class="blog-post-title"><?php echo $res[0]['title'] ?></h2>
                    </div>

                    <p class="blog-post-meta"><?php echo $res[0]['time'] ?> <a href="#"></a></p>

                    <p>
                        <p>
                            <?php echo $res[0]['cont'] ?>
                        </p>
                        <p><br></p>
                    </p>
                    <!-- <div>
                        <a href="/posts/62/zan" type="button" class="btn btn-primary btn-lg">赞</a>

                    </div> -->
                </div>

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">评论</div>

                    <!-- List group -->
                    <ul class="list-group">
                        <?php
                        if (count($comments) > 0) {
                            foreach ($comments as $comment) {
                        ?>
                                <li class="list-group-item">
                                    <h5><?php echo $comment['time'] ?></h5>
                                    <div>
                                        <?php echo $comment['cont'] ?>
                                    </div>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">发表评论</div>

                    <!-- List group -->
                    <ul class="list-group">
                        <form action="/bf/index/comment.php" method="post">
                            <input type="hidden" name="article_id" value="<?php echo $_GET['article_id']; ?>" />
                            <li class="list-group-item">
                                <textarea name="cont" class="form-control" rows="10"></textarea>
                                <button class="btn btn-default" type="submit">提交</button>
                            </li>
                        </form>

                    </ul>
                </div>

            </div><!-- /.blog-main -->




            <div id="sidebar" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="panel-heading">
                    专题
                </div>

                <ul class="category-root list-group">
                    <li class="list-group-item">
                        <a href="/topic/1">旅游
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="/topic/2">轻松
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="/topic/5">测试专题
                        </a>
                    </li>
                </ul>

                </aside>
            </div>
        </div>
    </div><!-- /.row -->
    </div><!-- /.container -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>