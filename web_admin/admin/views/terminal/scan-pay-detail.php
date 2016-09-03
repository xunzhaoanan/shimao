<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '终端店收款码';
?>

<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner">
    <?php echo $this->render('@app/views/side/terminal.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>终端店收款码</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12 clearfix">
            <div class="float-left">
              <img ng-src="{{qrcodeUrl}}" width="430px" height="430px">
            </div>
            <div  class="float-left margin-top40 font-size14 margin-left30">
              <p>
                店铺收款二维码：<strong ng-bind="lists.shopInfo.name"></strong>
              </p>
              <p>
                用于线下门店购物场景中，方便顾客快速扫码，输入自定义的订单金额，完成支付
              </p>
              <p class="margin-top40">
                收款码状态：<span ng-bind="statue"></span>
              </p>
              <p>
                单笔订单扫码支付最高限额<span ng-bind="limit" class="margin-left10 margin-right10"></span>元</span>
              </p>
              <p class="font-size12 margin-top150">
                <a ng-href="{{downUrl}}" target="_blank">下载收款码</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
  app.controller('mainController', function ($scope, $http) {


    var ids = window.location.search.split('?terminal_id=')[1]

    var qrcode = JSON.parse('<?= addslashe(json_encode($qrcode)); ?>');
    $scope.qrcodeUrl = qrcode + '?id=' + ids;

    $scope.limitaa = JSON.parse('<?= addslashe(json_encode($limit)); ?>');
    $scope.limit = $scope.limitaa/100;
    $scope.downUrl = JSON.parse('<?= addslashe(json_encode($downUrl)); ?>');


    $http.post('/terminal/list-ajax', {"ids": [ids]})
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            console.log(msg);
            $scope.lists = msg.errmsg.data[0];
            if(!$scope.lists.shopSubSetting) $scope.lists.shopSubSetting = {};
            $scope.statue = $scope.lists.shopSubSetting.is_scan_pay == 1 ? '启用' : '禁用';
          });
        })
        .error(function () {
          alert('网络异常，请重试');
        });

  });
</script>