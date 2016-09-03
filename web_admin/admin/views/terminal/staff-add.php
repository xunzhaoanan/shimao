<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '员工添加';
?>
<div class="main-container" id="main-container"  ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
  <div class="main-container-inner">
    <?php echo $this->render('@app/views/side/terminal.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs" >
        <script type="text/javascript">try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}</script>
        <ul class="breadcrumb">
          <li>员工添加</li>
        </ul>
        <!-- .breadcrumb -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <div class="space-10"></div>
            <form class="form-horizontal " role="form" novalidate="novalidate" name="myform">

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label" for="form-field-1">登录名：</label>
                <div class="col-sm-10">
                  <input placeholder="" class="col-sm-3 no-float" type="text" name="user_name" ng-model="model.user_name" required="required">
                    <span>{{'@'+wxAccount}}</span>
                  <span class="red" ng-show="myform.user_name.$error.required && istrue">必填项</span>
                  <span class="red" ng-show="myform.user_name.$error.pattern">登录名格式错误</span>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label" for="form-field-1">密码：</label>
                <div class="col-sm-10">
                  <input placeholder="" class="col-sm-3 no-float" type="password" name="password" ng-model="model.password" required="required" ng-minlength="6" ng-maxlength="15">
<!--                  <span style="color:gray;" ng-show="!istrue">密码不可少于6位数</span>-->
                  <span class="red" ng-show="myform.password.$error.required && istrue">必填项</span>
                  <span ng-show="myform.password.$error.minlength && istrue" class="red">密码长度不得小于6位</span>
                  <span ng-show="myform.password.$error.maxlength && istrue" class="red">密码长度不得大于15位</span>
                </div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label" for="form-field-1">姓名：</label>
                <div class="col-sm-10">
                  <input placeholder="" class="col-sm-3 no-float" type="text" name="real_name" ng-model="model.real_name" required="required" ng-pattern="/^[\u2E80-\u9FFF]{2,5}$/">
                  <span style="color:gray;" ng-show="!istrue">请输入2-5个汉字</span>
                  <span class="red" ng-show="myform.real_name.$error.required && istrue">必填项</span>
                  <span class="red" ng-show="myform.real_name.$error.pattern">姓名验证错误</span>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label" for="form-field-1">所属终端店：</label>
                <div class="col-sm-10">
                 <select class="col-sm-3 no-float" ng-disabled="ischange" ng-model="model.shop_sub_id" ng-options="o.shopInfo.shop_sub_id as o.shopInfo.name for o in shopTypeList"></select>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label" for="form-field-1">角色：</label>
                <div class="col-sm-10">
                  <select class="col-sm-3 no-float" ng-model="model.role_id" ng-options="o.id as o.title for o in roleList">

                  </select>
                </div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label" for="form-field-1">Email：</label>
                <div class="col-sm-10">
                  <input placeholder="" class="col-sm-3 no-float" type="text" name="email" ng-model="model.email" required="required" ng-pattern="" reg-email>
                  <span class="red" ng-show="myform.email.$error.required && istrue">必填项</span>
                   <span class="red" ng-show="myform.email.$error.pattern">{{$root.regEmailText}}</span>
                </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="col-sm-2 control-label" for="form-field-1">电话：</label>
                <div class="col-sm-10">
                  <input placeholder="" class="col-sm-3 no-float" type="text" name="mobile" ng-model="model.mobile" required="required" ng-pattern="" reg-mobile>
                  <span style="color:gray;" ng-show="!istrue">手机号码 座机 400电话均可输入</span>
                  <span class="red" ng-show="myform.mobile.$error.required && istrue">必填项</span>
                  <span class="red" ng-show="myform.mobile.$error.pattern">{{$root.regMobileText}}</span>
                </div>
              </div>

            <div class="form-group margin-bottom10 clearfix">
                <label class="col-sm-2 control-label" for="form-field-1"></label>
                <div class="col-sm-10">
                  <a type="button" class="btn btn-primary" ng-click="save()"> 确定 </a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<script>
app.controller("mainController", function($scope, $rootScope, $timeout, $http, userInfo){
	$timeout(function(){$rootScope.$broadcast('leftMenuChange', 0);},100);
	$scope.istrue = false;
	$scope.model = {};
    $scope.wxAccount = JSON.parse('<?= addslashe(json_encode($wxAccount)); ?>');
    var shopTypeList = userInfo.shopTypeList();
    shopTypeList.then(function(data){
        $scope.shopTypeList = data.data;
        $scope.model.shop_sub_id = $scope.shopTypeList[0].shopInfo.shop_sub_id;
    })
    $scope.$watch('model.shop_sub_id', function(a){
        if(a){
            $scope.ischange = true;
            $http.post('/role/list-ajax',{id: a})
                .success(function(msg){
                    $scope.ischange = false;
                    wsh.successback(msg,'', false, function(){
                        if(msg.errmsg.data.length){
                            $scope.roleList = msg.errmsg.data;
                            $scope.model.role_id = $scope.roleList[0].id;
                        }else{
                            $scope.roleList = [{id: -1, title: '该终端店没有角色'}];
                            $scope.model.role_id = -1;
                        }
                    });
                })
        }
    })

	$scope.save = function(){
		if($scope.myform.$invalid){
			$scope.istrue = true;
			return $timeout(function(){$scope.istrue = false;}, 3000);
		}
        if($scope.model.role_id == -1) return alert('请选择员工所属角色');
   $http.post(wsh.url + 'staff-add-ajax',$scope.model).success(function(msg){
         wsh.successback(msg, '添加成功', false, function(){
             window.location.href = 'staff-list';
         });
       })


	}
});
</script>
</div>
