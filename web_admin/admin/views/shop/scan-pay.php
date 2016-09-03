<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '扫码支付';
?>
<div class="main-container" id="main-container">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner" ng-controller="mainController" ng-cloak>
    <?php echo $this->render('@app/views/side/manage_setting.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">try {
          ace.settings.check('breadcrumbs', 'fixed')
        } catch (e) {
        }</script>
        <ul class="breadcrumb">
          <li>扫码支付</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <form name="myform" novalidate class="form-horizontal">
            <div class="col-xs-12">
              <div class="row">
                <div class="col-xs-12">
                  <div class="space-6"></div>
                  <div class="alert alert-block alert-success">
                    <h4 class="black">扫码支付</h4>

                    <p class="alert-success col-sm-7"> 用于线下门店购物场景中，方便顾客快速扫码，输入自定义的订单金额，完成支付。 </p>
                    <label>
                      <input name="switch-field-1" ng-if="$root.hasPermission('shop/scan-pay-open-ajax') && $root.hasPermission('shop/scan-pay-close-ajax')"
                             class="ace ace-switch ace-switch-4 btn-empty" type="checkbox"
                             ng-model="model.is_scan_pay" my-check-box
                             ng-click="onOff()" >
                      <span class="lbl"></span> </label>
                  </div>
                </div>
              </div>
              <div class="space-10 "></div>
              <div class="tab-content">
                <div class="form-group margin-bottom10  padding-left10 padding-right10 clearfix">
                  <label class="col-sm-1 control-label" style="min-width: 7em"> <strong>扫码支付限额：</strong> </label>
                  <ng-form name="myform">
                    <div class="col-sm-9">
                      单笔订单扫码支付最高限额
                      <input type="text" class="width120 margin-left10 margin-right10"
                             ng-model="model.scan_limit_amount" name="maxmoey" required ng-pattern
                             reg-money>元
                      <span class="grey">（0~9999999.99的数字，默认保留的两位小数)</span>
                      <span class="inline padding5 red"
                            ng-show="myform.maxmoey.$error.required && isSubmit"
                            ng-bind="$root.regRequiredText"></span>
                      <span class="inline padding5 red" ng-show="myform.maxmoey.$error.pattern"
                            ng-bind="$root.regMoneyText"></span>
                    </div>
                  </ng-form>
                </div>
                <div class="text-center">
                  <input type="button" ng-disabled="isDisabled" class="btn btn-primary" value="保存" ng-if="$root.hasPermission('shop/scan-pay-ajax')"
                         ng-click="btnSave()"/>
                </div>

              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    app.controller("mainController", function ($scope, $http, $rootScope, $timeout) {
      $timeout(function () {
        $rootScope.$broadcast('leftMenuChange', 'aa');
      }, 100);

      //进入页面的时候是否有值
      $http.post("/shop/scan-pay-data-ajax")
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              console.log(msg);
              $scope.model = msg.errmsg;
              if(!$scope.model){
                $scope.model = {};
              }
              $scope.model.scan_limit_amount = $scope.model.scan_limit_amount/100;
            });
          })
          .error(function () {
            alert('网络异常');
          });

      //提交按钮
      $scope.isSubmit = $scope.isDisabled = false;
      $scope.btnSave = function () {
        if ($scope.myform.$invalid) {
          $scope.isSubmit = true;
          return $timeout(function () {
            $scope.isSubmit = false;
          }, 2000);
        }
        $scope.isDisabled = true;
        $http.post(wsh.url + "scan-pay-ajax", {'scan_limit_amount': $scope.model.scan_limit_amount*100})
            .success(function (msg) {
              wsh.successback(msg, '提交成功！', false, function () {
              });
              $scope.isDisabled = false;
            })
            .error(function () {
              alert('网络异常');
            });
      };

      //开关按钮（is_scan_pay: 2关闭 1：开启）
      $scope.onOff = function () {
        if ($scope.model.is_scan_pay === 1) {
          $http.post("/shop/scan-pay-open-ajax", {})
              .success(function (msg) {
                wsh.successback(msg, '启用成功', false, function () {
                });
              })
              .error(function () {
                alert('网络异常');
              });
        } else {
          $http.post("/shop/scan-pay-close-ajax", {})
              .success(function (msg) {
                wsh.successback(msg, '禁用成功', false, function () {
                });
              })
              .error(function () {
                alert('网络异常');
              });
        }
      }


    });
  </script>
</div>
