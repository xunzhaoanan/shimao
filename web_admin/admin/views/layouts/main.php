<?php
use yii\helpers\Html;
use admin\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" ng-app="myapp">
<head>
  <meta charset="<?= Yii::$app->charset ?>"/>
  <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <meta name="keywords" content="微商户后台管理系统"/>
  <meta name="description" content="微商户 - 移动互联网营销的大赢家"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- basic styles -->
  <link href="/ace/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="/ace/js/ui-bootstrap/ui-bootstrap-custom-1.2.1.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="/ace/css/font.css"/>
  <link rel="stylesheet" href="/ace/js/jstree/themes/default/style.min.css">
  <!-- ace styles -->
  <link rel="stylesheet" href="/ace/css/ace.min.css"/>
  <link rel="stylesheet" href="/ace/css/ace-rtl.min.css"/>
  <link rel="stylesheet" href="/ace/css/ace-skins.min.css"/>
  <!-- plugin styles -->
  <link rel="stylesheet" href="/ace/css/dialog.css"/>
  <link rel="stylesheet" type="text/css" href="/ace/css/loading-box.min.css">
  <link href="/ace/css/style.css" rel="stylesheet">
  <!-- common script -->
  <script src="/ace/js/jquery-2.0.3.min.js"></script>
  <script src="http://imgcache.vikduo.com/static/aab30649fcbab646916b4c3c51d3bf27.js"></script>
  <script src="/ace/js/ui-bootstrap/ui-bootstrap-custom-tpls-1.2.1.min.js"></script>
  <script src="/ace/js/jstree/jstree.min.js"></script>
  <script src="/ace/js/ace-extra.min.js"></script>
  <script src="/ace/js/dialog.js"></script>
  <script src="/ace/js/global.js"></script>
  <script src="/ace/js/angular.config.js"></script>
  <script src="/ace/js/wsh.modal.js"></script>
</head>
<?php $this->head() ?>
<body class="navbar-fixed">
<?php $this->beginBody() ?>
<?php include 'head.php'; ?>
<?= $content ?>

<?php include 'foot.php'; ?>
<?php $this->endBody() ?>
<div id="loadingBox" class="loading-box">
  <div class="la-ball-spin-clockwise la-2x">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>
<script src="http://ta.nexto2o.com/js/ta.js?id=1&siteid=682"></script>
<script src="/ace/js/checkBrowser/checkBrowser.js"></script>
</body>
</html>
<?php $this->endPage() ?>


















