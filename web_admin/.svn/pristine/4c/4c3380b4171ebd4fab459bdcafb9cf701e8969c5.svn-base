<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'My Yii Application';
?>

<div class="main-container" id="main-container"> 
  <script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
  <div class="main-container-inner">
    <?php
  echo $this->render('@app/views/side/manage_setting.php');
  ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs" ng-controller="mainController" ng-cloak> 
        <script type="text/javascript">
              try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>
        <ul class="breadcrumb">
          <li> 支付方式</li>
        </ul>
        <!-- .breadcrumb --> 
      </div>
      <div class="page-content">
        <div class="row">
          <div class="table">
            <div class="tab-content">
              <form method="post">
                <div class="control_group part_bg">
                  <table border="0" cellspacing="0" cellpadding="0" class="main_tab">
                    <tr>
                      <td colspan="2">支付方式名称：财付通[即时到帐]<span class="text_space2">|</span>支持交易货币：人民币</td>
                    </tr>
                    <tr>
                      <td>客户号：</td>
                      <td><input type="text" value="" maxlength="80" required="required"/></td>
                    </tr>
                    <tr>
                      <td>密钥：</td>
                      <td><input type="text" value="" maxlength="80" required="required"/></td>
                    </tr>
                  </table>
                  <p style="font-size:12px;">客户是什么：是财付通企业版的账号，一般由10位数字构成，此账号一般是由公司或企业等非个人单位才可以开通获得，申请地址：<a href="http://mch.tenpay.com" target="_blank">http://mch.tenpay.com</a>。</p>
                  <p style="font-size:12px;">密钥是什么：是财付通支付接口时需要用到的一个参数，申请财付通企业版成功后会收到初始密钥信息邮件，获得初始密钥后要及时登陆财付通系统修改，否则支付时会错。</p>
                </div>
                <div class="turn-page">
                  <input type="submit" class="btn btn-primary"  style="margin-left: 506px;" value="提交" />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
app.controller('mainController', function($rootScope, $http){
  $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ab');
  }, 100);

	$scope.istrue = false;
	$scope.model = JSON.parse('<?= json_encode($model); ?>');
	console.log($scope.model);
	$scope.save = function(){
		if($scope.myform.$invalid){
			$scope.istrue = true;
			return $timeout(function(){$scope.istrue = false;}, 3000);
		}
        $http.post(wsh.url + 'payment-setting-wxpay', $scope.model)
            .success(function(msg){
                wsh.successback(msg, '更改成功', false, function(){
                    window.location.href = wsh.url + 'payment-setting-list';
                });
            })
	}
});
</script> 
