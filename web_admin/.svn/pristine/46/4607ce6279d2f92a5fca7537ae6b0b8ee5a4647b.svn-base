<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '支付方式';
?>

<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner">
    <?php
    echo $this->render('@app/views/side/manage_setting.php');
    ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li> 支付方式</li>
        </ul>
        <!-- .breadcrumb -->
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="space-16"></div>
            <div class="clearfix"></div>
            <form class="form-horizontal" ro;e="form">
              <table width="100%"
                     class="table table-striped table-bordered table-hover table-width">
                <thead>
                <tr>
                  <th width="14%" class="text-center">支付方式</th>
                  <th width="31%" class="text-center">简要说明</th>
                  <th width="15%" class="text-center">接口类型</th>
                  <th width="10%" class="text-center">状态</th>
                  <th width="30%" class="text-center">操作</th>
                </tr>
                </thead>
                <tbody>
<!--                <tr>-->
<!--                  <td class="text-center">自动退款</td>-->
<!--                  <td class="text-center"> 开启后，如果您在用户申请退款时点击同意，剩下的操作将由系统自动完成，无需您的额外操作。（开启或关闭不会影响已有售后订单）</td>-->
<!--                  <td class="text-center"> 自动退款</td>-->
<!--                  <td class="text-center"><label>-->
<!--                      <input name="switch-field-1"  ng-disabled="!$root.hasPermission('shop/refund-setting-edit-ajax')" class="ace ace-switch ace-switch-6"-->
<!--                             ng-model="refundauto" type="checkbox" ng-change="changeRefund()">-->
<!--                      <span class="lbl"></span> </label></td>-->
<!--                  <td class="text-center">-->
<!--                    <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons"><a-->
<!--                          class="blue"> </a></div>-->
<!--                  </td>-->
<!--                </tr>-->
                <tr>
                  <td class="text-center">微信支付（新）</td>
                  <td class="text-center"><a target="_blank"
                                             href="https://mp.weixin.qq.com/paymch/readtemplate?t=mp/business/faq_tmpl">微信支付申请流程介绍（仅限服务号）</a>
                  </td>
                  <td class="text-center"> -------------</td>
                  <td class="text-center">
                    <label>
                      <input name="switch-field-1" class="ace ace-switch ace-switch-6"
                             ng-model="model.newwxpay" type="checkbox" ng-change="change()">
                      <span class="lbl"></span>
                    </label>
                  </td>
                  <td class="text-center">
                    <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons"><a
                        class="blue" href="/shop/payment-setting-new-wxpay"><i
                          class="icon-bianji bigger-130"></i> 帐号设置</a></div>
                  </td>
                </tr>
                <tr class="hide">
                  <td class="text-center">微信支付</td>
                  <td class="text-center"><a target="_blank"
                                             href="https://mp.weixin.qq.com/paymch/readtemplate?t=mp/business/faq_tmpl">微信支付申请流程介绍（仅限服务号）</a>
                  </td>
                  <td class="text-center"> -------------</td>
                  <td class="text-center"><label>
                      <input name="switch-field-1" class="ace ace-switch ace-switch-6"
                             ng-model="model.wxpay" type="checkbox" ng-change="change()">
                      <span class="lbl"></span> </label></td>
                  <td class="text-center">
                    <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons"><a
                        class="blue" href="/shop/payment-setting-wxpay"><i
                          class="icon-bianji bigger-130"></i> 帐号设置</a></div>
                  </td>
                </tr>
                <!--              <tr>-->
                <!--                  <td class="text-center">手Q支付</td>-->
                <!--                  <td class="text-center">依托8亿手Q用户，集银行卡支付、NFC支付等方式成为一体的移动支付方式</a></td>-->
                <!--                  <td class="text-center"> ------------- </td>-->
                <!--                  <td class="text-center"><label>-->
                <!--                          <input name="switch-field-1" class="ace ace-switch ace-switch-6" ng-model="model.qqpay" type="checkbox" ng-change="change()">-->
                <!--                          <span class="lbl"></span> </label></td>-->
                <!--                  <td class="text-center"><div class="visible-md visible-lg hidden-sm hidden-xs action-buttons"> <a class="blue" href="/shop/payment-setting-qqpay"><i class="icon-bianji bigger-130"></i> 帐号设置</a> </div></td>-->
                <!--              </tr>-->
                <tr class="hide">
                  <td class="text-center">财付通</td>
                  <td class="text-center"><a target="_blank"
                                             href="http://mch.tenpay.com/market/ps_intro_08.shtml">财付通即时到帐介绍及申请</a>
                  </td>
                  <td class="text-center">手机网页支付接口</td>
                  <td class="text-center"><label>
                      <input name="switch-field-1" class="ace ace-switch ace-switch-6"
                             type="checkbox" ng-model="model.tenpay" ng-change="change()">
                      <span class="lbl"></span> </label></td>
                  <td class="text-center">
                    <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons"><a
                        class="blue" href="/shop/payment-setting-tenpay"><i
                          class="icon-bianji bigger-130"></i> 帐号设置</a></div>
                  </td>
                </tr>
                <tr class="hide">
                  <td class="text-center">代收款（财付通）</td>
                  <td class="text-center"> 由微商户平台代收款</td>
                  <td class="text-center">手机网页支付接口</td>
                  <td class="text-center"><label>
                      <input name="switch-field-1" class="ace ace-switch ace-switch-6"
                             ng-model="model.agentpay" type="checkbox" ng-change="change()">
                      <span class="lbl"></span> </label></td>
                  <td class="text-center">
                    <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons"><a
                        target="_blank" class="blue" href="/shop/payment-setting-agentpay"><i
                          class="icon-bianji bigger-130"></i> 提款设置</a></div>
                  </td>
                </tr>
                <tr>
                  <td class="text-center">货到付款</td>
                  <td class="text-center"> 由商户自行与快递公司合作</td>
                  <td class="text-center"> 货到付款</td>
                  <td class="text-center"><label>
                      <input name="switch-field-1"   class="ace ace-switch ace-switch-6"
                             ng-model="model.delivery" type="checkbox" ng-change="change()">
                      <span class="lbl"></span> </label></td>
                  <td class="text-center">
                    <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons"><a
                        class="blue"> </a></div>
                  </td>
                </tr>
                </tbody>
              </table>
              <!---->
              <!--            <table width="100%" class="table table-striped table-bordered table-hover table-width">-->
              <!--                <thead>-->
              <!--                <tr>-->
              <!--                    <th width="14%" class="text-center">退款方式</th>-->
              <!--                    <th width="31%" class="text-center">简要说明</th>-->
              <!--                    <th width="30%" class="text-center">操作</th>-->
              <!--                </tr>-->
              <!--                </thead>-->
              <!--                <tbody>-->
              <!--                <tr>-->
              <!--                    <td class="text-center">微信退款</td>-->
              <!--                    <td class="text-center">买家用微信支付方式支付，申请退款的设置</td>-->
              <!--                    <td class="text-center">-->
              <!--                        <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">-->
              <!--                            <a class="blue" href="/shop/upload-certificate"  data-rel="tooltip" title="上传证书"><i class="icon-key bigger-130"></i> 证书上传</a>-->
              <!--                        </div>-->
              <!--                    </td>-->
              <!--                </tr>-->
              <!---->
              <!--                </tbody>-->
              <!--            </table>-->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  app.controller("mainController", function ($scope, $http, $timeout, $rootScope) {

    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'aa');
    }, 100);

    $scope.model = JSON.parse('<?= json_encode($model);?>');
    $scope.refundauto = JSON.parse('<?= json_encode($refundauto);?>') ? true : false;

    $.each($scope.model, function (i, e) {
      $scope.model[i] = e ? true : false;
    });

    $scope.object = {};

    function setArray() {
      $.each($scope.model, function (i, e) {
        $scope.object[i] = e ? 1 : 0;
      });
    }

    $scope.change = function () {
      setArray();
      $http.post(wsh.url + 'payment-setting-list-edit-ajax', $scope.object)
        .success(function (msg) {
          wsh.successback(msg, '更改成功');
        });
    };
//    $scope.changeRefund = function () {
//      $http.post(wsh.url + 'refund-setting-edit-ajax', {refundauto:$scope.refundauto ? 1 : 0})
//          .success(function (msg) {
//            wsh.successback(msg, '更改成功');
//          });
//    };
  });
</script>