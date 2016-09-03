<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '微信帐号设置';
?>

<div class="main-container" id="main-container" ng-controller="mainController">
<script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
<div class="main-container-inner"> <?php echo $this->render('@app/views/side/manage_setting.php'); ?>
  <div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs" > 
      <script type="text/javascript">
              try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>
      <ul class="breadcrumb">
        <li>微信帐号设置</li>
      </ul>
      <!-- .breadcrumb --> 
    </div>
    <div class="page-content">
      <div class="row">
        <div class="col-xs-12">
          <div class="tabbable">
            <div class="tab-content">
              <div id="home" class="tab-pane in active">
                <form class="form-horizontal" name="myform" novalidate="novalidate">
                  <div class="space-6"></div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label" for="form-field-1"><strong>微信帐号</strong>：</label>
                    <div class="col-sm-10">
                      <input type="text" id="form-field-1" placeholder="Username" class="col-sm-5 " ng-model="model.account" readonly="readonly" required="required" />
                      <span style="color:#f00;" ng-show="myform.name.$error.required" ng-cloak>必填项</span> </div>
                  </div>

                  <!--   多行表单-->
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label" for="form-field-1"><strong>URL</strong>：</label>
                    <div class="col-sm-10">
                      <input type="text" class="col-sm-5" for="form-field-1" value="<?=getMobileSite().'/wxapi/index'?>"  readonly="readonly" placeholder="http://www.baidu.com"  required="required"/>
                      <span style="color:#f00;" ng-show="myform.name.$error.required" ng-cloak>必填项</span> </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label" for="form-field-1"><strong>TOKEN</strong>：</label>
                    <div class="col-sm-10">
                      <input class="col-sm-5" for="form-field-1" ng-model="model.token" name="token" required="required" ng-maxlength="20">
                      <span style="color:#f00;" ng-show="myform.token.$error.required && istrue" ng-cloak>必填项</span> <span style="color:#f00;" ng-show="myform.token.$error.maxlength" ng-cloak>字符过多</span> </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label" for="form-field-1"><strong>APPID</strong>：</label>
                    <div class="col-sm-10">
                      <input class="col-sm-5" for="form-field-1" ng-model="model.appid" name="appid" required="required" ng-maxlength="50">
                      <span style="color:#f00;" ng-show="myform.appid.$error.required && istrue" ng-cloak>必填项</span> <span style="color:#f00;" ng-show="myform.appid.$error.maxlength" ng-cloak>字符过多</span> </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label" for="form-field-1"><strong>SECRET</strong>：</label>
                    <div class="col-sm-10">
                      <input class="col-sm-5" name="secret" ng-model="model.secret" required="required" ng-maxlength="50">
                      <span style="color:#f00;" ng-show="myform.secret.$error.required && istrue" ng-cloak>必填项</span> <span style="color:#f00;" ng-show="myform.secret.$error.maxlength" ng-cloak>字符过多</span> </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label" for="form-field-1"></label>
                    <div class="col-sm-10"> <a class="btn btn-primary" ng-click="save()" id="submit">提交</a> <a class="btn btn-primary" style="background-color: #58a958 !important;border-color: #58a958;" target="_blank" href="https://mp.weixin.qq.com/cgi-bin/loginpage?t=wxm2-login&lang=zh_CN">去微信绑定账号</a> </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
app.controller('mainController', function($scope, $rootScope, $timeout, $http){
   $timeout(function(){$rootScope.$broadcast('leftMenuChange', 'aa');}, 100);

	$scope.istrue = false;
	$scope.model = JSON.parse('<?= json_encode($model); ?>');
	$scope.save = function(){
		if($scope.myform.$invalid){
			$scope.istrue = true;
			return $timeout(function(){$scope.istrue = false;}, 3000);
		}
		$('#submit').attr('disabled', 'disabled');
        $http.post(wsh.url + "wx-account-ajax", $scope.model)
            .success(function(msg){
                $('#submit').removeAttr('disabled');
                wsh.successback(msg, '提交成功');
            })
            .error(function(msg){
                $('#submit').removeAttr('disabled');
                wsh.successback(msg, '提交失败');
            })
	};
});
</script>