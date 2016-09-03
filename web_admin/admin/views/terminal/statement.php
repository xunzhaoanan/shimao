<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '收款账户设置';
?>

<div class="main-container" id="main-container" ng-cloak>
  <script type="text/javascript">
    try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
  <div class="main-container-inner">
    <?php echo $this->render('@app/views/side/terminal.php'); ?>
    <div class="main-content" ng-controller="mainController">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>
        <ul class="breadcrumb">
          <li>收款账户设置</li>
        </ul>
        <!-- .breadcrumb -->
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="tabbable">
              <ul class="nav nav-tabs" id="myTab">
                <li class="active"> <a data-toggle="tab" href="#home">收款账户设置</a> </li>
              </ul>
              <div class="tab-content">
                <div id="home" class="tab-pane in active">
                  <form class="form-horizontal ng-pristine ng-valid" >
                    <div class="space-6"></div>
                    <div class="form-group clearfix">
                      <label class="col-sm-2 width120 control-label" for="form-field-1"><strong>终端店名称:</strong></label>
                      <div class="col-sm-9">
                        <p class="form-control-static" for="form-field-1" ng-bind="data.shopInfo.name" >
                        </p>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <label class="col-sm-2 width120 control-label" for="form-field-1"><strong>收款人姓名:</strong></label>
                      <div class="col-sm-8 margin-bottom10">
                        <p class="form-control-static" for="form-field-1" ng-bind="model.payee" >
                        </p>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <label class="col-sm-2 width120 control-label" for="form-field-1"><strong>收款银行:</strong></label>
                      <div class="col-sm-8">
                        <p class="form-control-static"  ng-bind="model.due_bank">
                        </p>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <label class="col-sm-2 width120 control-label" for="form-field-1"><strong>开户行:</strong></label>
                      <div class="col-sm-8">
                        <p class="form-control-static" ng-bind="model.opening_bank">
                        </p>
                      </div>
                    </div>


                    <div class="form-group clearfix">
                      <label class="col-sm-2 width120 control-label"><strong>银行账号:</strong></label>
                      <div class="col-sm-8">
                        <label class="form-control-static" ng-bind="model.account_no">
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <label class="col-sm-2 width120 control-label" for="form-field-1"><strong>联系电话:</strong></label>
                      <div class="col-sm-10">
                        <label class="form-control-static" ng-bind="model.tel" style="word-break: break-all;">
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <label class="col-sm-2 width120 control-label" for="form-field-1"></label>
                      <div class="col-sm-8">
                        <a ng-href="{{'/terminal/statement-receive-setting?terminal_id=' +id}}"  class="btn btn-primary">
                          <i class="icon-ok bigger-110"></i> 编辑 </a>
                      </div>
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
</div>
</div>
<script type="text/javascript">
  app.controller('mainController', function($scope, $rootScope, $timeout ) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 0);
    }, 100);
   //请求数据
    $scope.id = wsh.getHref('terminal_id');
    $scope.model = JSON.parse('<?=addslashe(json_encode($model));?>');
    $scope.data = JSON.parse('<?=addslashe(json_encode($data));?>');
  });
</script>
