<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type:text/html; charset=utf-8');
include_once('docs/html.class.php');
$docsConfig = include('docs/config.php');
$menuConfig = $docsConfig['menu'];
$itemsConfig = $docsConfig['items'];

$m = isset($_GET['m']) && array_key_exists($_GET['m'], $menuConfig) ? $_GET['m'] : 'user';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="API文档">
    <meta name="keywords" content="docs, api">
    <meta name="author" content="laosan">
    <meta name="author" content="laosan <zhangxitao126@qq.com>">

    <title>API文档</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional Bootstrap Theme -->
    <link href="data:text/css;charset=utf-8," data-href="assets/css/bootstrap-theme.min.css" rel="stylesheet" id="bs-theme-stylesheet">
    <link href="assets/css/patch.css" rel="stylesheet">

    <!-- Documentation extras -->
    <link href="assets/css/docs.min.css" rel="stylesheet">
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-precomposed.png">
    <link rel="icon" href="/favicon.ico">

</head>
<body>
<a class="sr-only sr-only-focusable" href="#content">Skip to main content</a>

<!-- Docs master nav -->
<header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="./" class="navbar-brand">API</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <?php foreach ($menuConfig as $key => $val) {?>
                <li<?php if($key == $m) echo ' class="active"';?>>
                    <a href="?m=<?php echo $key;?>"><?php echo $val['title'];?></a>
                </li>
                <?php }?>
            </ul>
        </nav>
    </div>
</header>

<!-- Docs page layout -->
<div class="bs-docs-header" id="content">
    <div class="container">
        <h1><?php echo $menuConfig[$m]['title'];?></h1>
        <p><?php echo array_key_exists('description', $menuConfig[$m]) ? $menuConfig[$m]['description'] : '';?></p>
    </div>
</div>

<div class="container bs-docs-container">

<div class="row">
<div class="col-md-9" role="main">
<?php
foreach ($menuConfig[$m]['method'] as $menu) {
    if ($docs = lib::getDocs($m, $menu)) {
        $html = new html($m, $menu, $docs, $docsConfig);
?>
<div class="bs-docs-section">
    <h1 id="<?php echo $menu;?>" class="page-header"><?php echo $docs['title'];?></h1>
    <p class="lead"><?php echo $docs['description'];?></p>
    <?php
        foreach ($itemsConfig as $it => $item) {
            if (array_key_exists($it, $docs)) {
                echo $html->{$it}();
            }
        }
    ?>
</div>
<?php }}?>

</div>
<div class="col-md-3">
    <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm" role="complementary">
        <ul class="nav bs-docs-sidenav">
            <?php
            foreach ($menuConfig[$m]['method'] as $menu) {
            $docs = lib::getDocs($m, $menu); 
            if ($docs) {?>
            <li>
                <a href="#<?php echo $menu;?>"><?php echo $docs['title'];?></a>
                <ul class="nav">
                <?php
                foreach ($itemsConfig as $it => $item) {
                    if (array_key_exists($it, $docs)) {
                        echo '<li><a href="#'.$menu.'-'.$it.'">'.$item['name'].'</a></li>';
                    }
                }
                ?>
                </ul>
            </li>
            <?php }}?>
        </ul>
        <a class="back-to-top" href="#top">
            返回顶部
        </a>
    </div>
</div>
</div>
</div>

<!-- Footer
================================================== -->
<footer class="bs-docs-footer" role="contentinfo">
    <div class="container">
        <ul class="bs-docs-footer-links muted">
            <li>当前版本： v<?php echo _VERSION_;?></li>
            <li>&middot;</li>
            <li><a href="#">API文档</a></li>
        </ul>
    </div>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/docs.min.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="assets/js/ie10-viewport-bug-workaround.js"></script>


</body>
</html>