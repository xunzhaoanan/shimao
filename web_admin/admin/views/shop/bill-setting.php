<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '对账单设置';
?>
<link href="/ace/uploadify/uploadify.css" rel="stylesheet"/>
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
          <li>对账单设置</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <form name="myform" novalidate class="form-horizontal">
            <div class="col-xs-12">
              <div class="row">
                <div class="col-xs-12">
                  <div class="space-6">
                  </div>
                    <div class="clearfix no-padding">
                    <a href="/shop/statement-record-info" target="_blank"  class="btn btn-xs btn-primary float-right" style="margin-bottom:20px">对账单操作说明</a>
                  </div>

                  <div class="alert alert-block alert-success">
                    <h4 class="black">对账单设置</h4>
                    <p class="alert-success">
                        用于直营店线上支付，扫码支付和POS机收款的订单对账，方便商家对各个直营店的微信支付收款，扫码收款等线上支付的订单进行</br>对账。结算完成之后，通过微信对直营店进行结算信息的推送。
                    </p>
                  </div>
                </div>
              </div>
              <div class="tab-content">
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"><strong>注意事项：</strong></label>
                            <div class="col-sm-10">
                                <div class="form-control-static">开启此功能后，请通知各直营店在管理后台设置收款账户信息。
                                    <form action="/shop/import-csv" id="form1" enctype="multipart/form-data"
                                          method="post" accept-charset="utf-8">
                                       <!-- <input class="btn btn-sm btn-primary margin-right10" type="file" name="UploadForm[file]" id="text1" value="批量导入收款账户"/>-->
                                        <input class=" btn btn-xs btn-primary" id="sub1"  data-toggle="modal" data-target="#myModalText"  value="批量导入收款账户"  >
                                        </form>
                                <a  class="inline align-middle blue" ng-click="export()" href="javascript:void(0);">下载表格模版</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <ng-form class="form-horizontal" name="myform" novalidate="novalidate">
                            <label for="" class="col-sm-2 control-label"><strong>转账费率：</strong></label>
                            <div class="col-sm-10">
                                <input type="text" name="number" class="inline align-middle width101" value="" ng-model="model.statement_rate" ng-pattern="" maxlength="10" required reg-percent/>
                                <span class="inline align-middle margin-left5">%</span>
                                <span class="inline align-middle grey margin-left4">（微信支付收取的费率一般是0.6%，如果结算时需要向直营店收取，请输入收取费率，在生成对账单时系统自动按设定比例进行计算。</br>&nbsp;&nbsp;&nbsp;如不需要向直营店收取转账费率，设置为0即不收取转账费率）
                                </span><br>
                              <span  class="inline padding5 red" ng-show="myform.number.$error.required && isSubmit">必填项</span>
                              <span class="inline padding5 red"
                                    ng-show="myform.number.$error.pattern">小于等于100的正整数或者保留2位小数</span>

                            </ng-form>
                        </div>
                        <div class="form-group margin-top10 clearfix">

                            <div class="text-center">
                             <a href="###" class="btn btn-primary" ng-click="save()">保存</a>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="space-32"></div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->render('@app/views/uploadImg/textIndex.php'); ?>
<script src="/ace/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript">
  app.controller('mainController', function ($scope, $timeout, $rootScope, $http) {
      $timeout(function () {
          $rootScope.$broadcast('leftMenuChange', 'aa');
      }, 100);

      $scope.model = JSON.parse('<?=addslashe(json_encode($model));?>');
    console.log($scope.model);

    //下載表格模板
    $scope.export = function(){
      window.location.href = "/export/statement-template";
    }
    //保存

    $scope.save = function(){
      $scope.isSubmit = false;
      if ($scope.myform.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
      $http.post('/shop/statement-rate-update',{'statement_rate':$scope.model.statement_rate})
       .success(function(msg){
        wsh.successback(msg,'保存成功',false,function(){
        })
      });
    }

  });
</script> 
