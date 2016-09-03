<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '微信帐号设置';
?>

<div class="main-container" id="main-container" ng-controller="mainController"> 
  <script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
  <div class="main-container-inner">
    <?php
  echo $this->render('@app/views/side/manage_setting.php');
  ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs" > 
        <script type="text/javascript">
              try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>
        <ul class="breadcrumb">
          <li> 微信帐号设置</li>
        </ul>
        <!-- .breadcrumb --> 
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="space-10"></div>
            <form class="form-horizontal" novalidate="novalidate" name="myform">
              <div class="form-group margin-bottom10 clearfix">
                <label class="width160 float-left text-right margin-right10 clearfix" for="form-field-1">支付方式名称：</label>
                <div class="col-sm-9"> <span class="label label-success arrowed-in-right float-left"> 微信[即时到帐] </span><span >支持交易货币：人民币</span></div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width160 float-left text-right margin-right10 clearfix" for="form-field-1">支付签名：</label>
                <div class="col-sm-9">
                  <input type="text" class="col-sm-5 margin-right10 clearfix" placeholder="" name="sign_key" ng-model="model.sign_key" required="required">
                  <span style="color:#f00;" ng-show="myform.sign_key.$error.required && istrue">必填项</span> </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width160 float-left text-right margin-right10 clearfix" for="form-field-1">客户号：</label>
                <div class="col-sm-9">
                  <input type="text" class="col-sm-5 margin-right10 clearfix" placeholder="" name="account" ng-model="model.account" required="required">
                  <span style="color:#f00;" ng-show="myform.account.$error.required && istrue">必填项</span> <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="财付通商户号必须是经过实名认证才可以使用！" title="">?</span> </div>
              </div>
             <!-- <div class="form-group margin-bottom10 clearfix">
                <label class="width160 float-left text-right margin-right10 clearfix" for="form-field-1">初始密钥：</label>
                <div class="col-sm-9">
                  <input type="text" class="col-xs-10 col-sm-5" placeholder="" name="key" ng-model="model.key" required="required">
                  <span style="color:#f00;" ng-show="myform.key.$error.required && istrue">必填项</span> </div>
              </div>-->
              <div class="form-group margin-bottom10 clearfix">
                <label class="width160 float-left text-right margin-right10 clearfix" for="form-field-1">友情提示：</label>
                <div class="col-sm-9"> 支付授权目录： http://wsh.gaopeng.com/scliveapp2015/wxpay <br>
                  支付请求实例： http://wsh.gaopeng.com/scliveapp2015/wxpay/pay <br>
                  Native原生支付： http://wsh.gaopeng.com/scliveapp2015/wxpay/getPackage <br>
                  维权通知URL：   http://wsh.gaopeng.com/scliveapp2015/wxpay/payFeedback <br>
                  告警通知URL：     http://wsh.gaopeng.com/scliveapp2015/wxpay/warning <br>
                  <lable style="color: red">注:此链接不可直接访问，如有疑问，请联系客服人员！</lable>
                </div>
              </div>
              <div class="space-6"></div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width160 float-left text-right margin-right10 clearfix" for="form-field-1"></label>
                <div class="col-sm-9"> <a class="btn btn-primary" ng-click="save()"> 确定 </a> </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.page-content --> 
      </div>
    </div>
  </div>
</div>
<script>
app.controller('mainController', function($scope, $rootScope, $timeout, $http){
  $timeout(function () { $rootScope.$broadcast('leftMenuChange', 'ab');  }, 100);
	$scope.istrue = false;
	$scope.model = JSON.parse('<?= json_encode($model); ?>');
	$scope.save = function(){
		if($scope.myform.$invalid){
			$scope.istrue = true;
			return $timeout(function(){$scope.istrue = false;}, 3000);
		}
        $http.post(wsh.url + "payment-setting-edit-ajax", $scope.model)
            .success(function(msg){
                wsh.successback(msg, '提交成功', false, function(){
                    window.location.href = wsh.url + 'payment-setting-list';
                });
            })
	}
});
</script> 
