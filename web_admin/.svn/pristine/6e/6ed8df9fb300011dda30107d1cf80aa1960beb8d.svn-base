<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '财付通帐号设置';
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
          <li> 财付通帐号设置</li>
        </ul>
        <!-- .breadcrumb --> 
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="space-10"></div>
            <form class="form-horizontal" novalidate="novalidate" name="myform">
              <div class="form-group margin-bottom10 clearfix">
                <label class="width160 float-left text-right margin-right10 clearfix" for="form-field-1">支付方式名称</label>
                <div class="col-sm-9"> <span class="label label-success arrowed-in-right  float-left"> 财付通[即时到帐] </span><span >支持交易货币：人民币</span><span class="middle"><a href="http://mch.tenpay.com/">我还没有申请服务，我要签约商家服务</a></span> </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width160 float-left text-right margin-right10 clearfix" for="form-field-1">客户号</label>
                <div class="col-sm-9">
                  <input type="text" class="col-sm-5 margin-right10 clearfix" placeholder="" name="account" required="required" ng-model="model.account">
                  <span style="color:#f00;" ng-show="myform.account.$error.required && istrue">必填项</span> <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="财付通商户号必须是经过实名认证才可以使用！" title="">?</span> </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width160 float-left text-right margin-right10 clearfix" for="form-field-1">密钥</label>
                <div class="col-sm-9">
                  <input type="text" class="col-xs-10 col-sm-5" placeholder="" name="key" required="required" ng-model="model.key">
                  <span style="color:#f00;" ng-show="myform.key.$error.required && istrue">必填项</span> </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width160 float-left text-right margin-right10 clearfix" for="form-field-1">简要说明</label>
                <div class="col-sm-9">
                  <textarea style="width: 500px; height:120px;" class="form-control col-xs-10 col-sm-3" id="form-field-8" placeholder="">
                    客户是什么：是财付通企业版的账号，一般由10位数字构成，此账号一般是由公司或企业等非个人单位才可以开通获得，申请地址：http://mch.tenpay.com
                    密钥是什么：是财付通支付接口时需要用到的一个参数，申请财付通企业版成功后会收到初始密钥信息邮件，获得初始密钥后要及时登陆财付通系统修改，否则支付时会错。
                  </textarea>
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
