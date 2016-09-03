<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '修改代理商信息';
?>
<div class="main-container" id="main-container">
  <script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>
  <div class="main-container-inner">
    <?php
    echo $this->render('@app/views/side/terminal.php');
    ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs"> 
        <script type="text/javascript">
              try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>
        <ul class="breadcrumb">
          <li>代理商信息-修改信息</li>
        </ul>
        <!-- .breadcrumb --> 
        <!-- #nav-search --> 
      </div>
      <div class="page-content"> 
        <!-- /.page-header --> 
        <!-- PAGE CONTENT BEGINS -->
        
        <div class="row" ng-controller="mainController" ng-cloak>
          <div class="col-xs-12">
            <div class="space-10"></div>
            <form novalidate name="myform">
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong>代理商名称:</strong> </label>
                <div class="col-xs-9">
                  <input  type="text" class="css col-sm-3" ng-readonly="isnew" required name="name"  ng-maxlength="10">
                </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong>上级代理商:</strong> </label>
                <div class="col-xs-9"> <span>无</span> 
                  <!--  <input  type="text" class="css col-sm-3" ng-readonly="isnew" required name="name"  ng-maxlength="10"> --> 
                </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><span class="red">*</span> <strong>负责人姓名:</strong> </label>
                <div class="col-xs-9">
                  <input type="text" class="col-sm-3" maxlength="50" required vaule="Kelly">
                  <span ng-show="myform.address.$error.required && istrue" style="color:#f00;">必填项</span> </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><span class="red">*</span> <strong>负责人电话:</strong> </label>
                <div class="col-xs-9">
                  <input type="text" class="col-sm-3" ng-model="model.shopInfo.phone" name="phone" placeholder="13800138000" required ng-pattern="/^(1[3|4|5|8]\d{9}|0755[\d]{7,8}|400[\d]{7})$/">
                  <span ng-show="myform.phone.$invalid && istrue" style="color:#f00;">请输入正确的电话号码</span> <span ng-show="myform.phone.$error.required && istrue" style="color:#f00;">必填项</span> </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong>负责区域:</strong> </label>
                <div class="col-xs-9">
                  <input  type="text" class="css col-sm-3" ng-readonly="isnew" required >
                </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>下级代理商数:</strong></label>
                <div class="col-sm-9">
                  <label class="width120 float-left text-left margin-right10 clearfix" for="form-field-1">102</label>
                  <a href="/agent/list">查看详情</a> </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>加盟店数:</strong></label>
                <div class="col-sm-9">
                  <label class="width120 float-left text-left margin-right10 clearfix" for="form-field-1">102</label>
                  <a href="/franchisee/franchisee-list">查看详情</a> </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong>代理商帐号:</strong> </label>
                <div class="col-xs-9">
                  <input  type="text" class="css col-sm-3" ng-readonly="isnew" required name="name"  ng-maxlength="20">
                  <span>@shangjiahouzuiming</span> </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong>登录密码:</strong> </label>
                <div class="col-xs-9">
                  <input  type="password" class="css col-sm-3" ng-readonly="isnew" required   ng-maxlength="10">
                </div>
              </div>
              <div class="space-6"></div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"></label>
                <div class="col-xs-9">
                  <button class="btn btn-primary" ng-click="save()" id="submit">保存</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp&key=TDCBZXVQ34XQFUEDG6F37SBHT42FU5"></script> 
<script type="text/javascript">
  app.controller("mainController", function($scope, $http, $timeout, $rootScope){
        $timeout(function(){$rootScope.$broadcast('leftMenuChange', 2);}, 100);
 })
</script>