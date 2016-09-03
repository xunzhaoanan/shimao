<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '编辑收款账户设置';
?>

<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/terminal.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }</script>
        <ul class="breadcrumb">
          <li>编辑收款账户设置</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-sm-12">
            <div class="space-10"></div>
            <form novalidate="novalidate" class="form-horizontal" name="myform">
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"> <strong>终端店名称:</strong> </label>

                <div class="col-xs-9">
                  <p class="col-sm-3" ng-bind="name" name="name"></p>
                  <!--<span ng-show="myform.name.$error.required && istrue" class="red inline padding5">必填项</span>-->
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"><span class="red">*</span>
                  <strong>收款人姓名:</strong> </label>

                <div class="col-sm-10">
                  <input type="text" class="col-sm-3 no-float" ng-model="model.payee" name="duename"
                         required="required" maxlength="10">（最多只能输入10个字符）
                  <!--<span ng-show="myform.avgPrice.$error.pattern" class="red inline padding5">{{$root.regIntText}}</span>-->
                  <span ng-show="myform.duename.$error.required && istrue"
                        class="red inline padding5">必填项</span>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"><span class="red">*</span>
                  <strong>收款银行:</strong> </label>

                <div class="col-sm-10">
                  <input type="text" class="col-sm-3 no-float" ng-model="model.due_bank"
                         name="duebank" maxlength="20" required="required">（只能输入20个字符长度）
                  <span ng-show="myform.duebank.$error.required && istrue"
                        class="red inline padding5">必填项</span>
                  <span class="red inline padding5" ng-show="myform.duebank.$error.maxlength">只能输入20个字符长度</span>

                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"><span class="red">*</span>
                  <strong>开户行:</strong> </label>

                <div class="col-sm-10">
                  <input type="text" class="col-sm-3 no-float" ng-model="model.opening_bank"
                         name="openbank" required="required" maxlength="20">（只能输入20个字符长度）
                  <!--<span class="red inline padding5" ng-show="myform.openbank.$error.chinese">请输入正确的银行卡号</span>-->
                  <span ng-show="myform.openbank.$error.required && istrue"
                        class="red inline padding5">必填项</span>
                  <span class="red inline padding5" ng-show="myform.duebank.$error.maxlength">只能输入20个字符长度</span>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"><span class="red">*</span>
                  <strong>银行账号:</strong> </label>

                <div class="col-sm-10">
                  <input type="text" class="col-sm-3 no-float" ng-model="model.account_no"
                         name="account" required="required" reg-card-no>
                  <span class="red inline padding5" ng-show="myform.account.$error.cardNo">请输入正确的银行卡号</span>
                  <span ng-show="myform.account.$error.required && istrue"
                        class="red inline padding5">必填项</span>
                </div>
              </div>


              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"> <strong>联系电话:</strong> </label>

                <div class="col-sm-10">
                  <input type="text" class="col-sm-3 no-float" ng-model="model.tel" name="phone"
                         reg-telephone>
                  <span class="red inline padding5" ng-show="myform.phone.$error.telephone">请输入正确的电话号码</span>
                  <!--<span ng-show="myform.phone.$error.required && istrue" class="red inline padding5">必填项</span>-->
                </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <a class="btn btn-primary" ng-click="save()"> 确定 </a>
                  <a class="btn btn-grey margin-left30" onclick="history.go(-1);" title="返回">返回</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  app.controller("mainController", function ($scope, $http, $timeout, $rootScope) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 0);
    }, 100);
    $scope.id = wsh.getHref('terminal_id');
    $scope.model = JSON.parse('<?=addslashe(json_encode($model));?>');
    $scope.data = JSON.parse('<?=addslashe(json_encode($data));?>');
    $scope.name = $scope.data.shopInfo ? $scope.data.shopInfo.name : '';
    $scope.istrue = false;
    $scope.save = function () {
      if ($scope.myform.$invalid) {
        $scope.istrue = true;
        return $timeout(function () {
          $scope.istrue = false;
        }, 3000);
      }
      $http.post('/terminal/statement-receive-setting-ajax', {
        'payee': $scope.model.payee,
        'due_bank': $scope.model.due_bank,
        'opening_bank': $scope.model.opening_bank,
        'account_no': $scope.model.account_no,
        'tel': $scope.model.tel,
        'shop_sub_id': $scope.id
      }).success(function (msg) {
        wsh.successback(msg, '修改成功', false, function () {
          window.location.href = wsh.url + 'statement' + $rootScope.getSearchUrl;
        });
      })
    }
  });
</script>