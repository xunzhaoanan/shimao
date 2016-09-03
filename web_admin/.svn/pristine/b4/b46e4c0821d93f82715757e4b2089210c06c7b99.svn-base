<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '签到活动';
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <!-- <script type="text/javascript">
       try {
           ace.settings.check('main-container', 'fixed')
       } catch (e) {
       }
   </script>-->
  <div class="main-container-inner">
    <?php
    echo $this->render('@app/views/side/marketing.php');
    ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <!--<script type="text/javascript">
            try {
                ace.settings.check('breadcrumbs', 'fixed')
            } catch (e) {
            }
        </script>-->
        <ul class="breadcrumb">
          <li>编辑签到活动</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="leader clearfix">
            </div>
            <div class="tabbable clearfix">
              <div id="rule" class="tab-pane active ruleCont margin-top20 clearfix">
                <form class="form-horizontal" name="myform">
                  <div class="form-group clearfix">
                    <div class="leader clearfix">
                      <div class="col-sm-12 margin-bottom10"><span
                          class="label label-light  no-padding center"><b class="red">提示：活动一旦开启就不能再进行任何改动</b> </span>
                      </div>
                    </div>
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>活动名称：</label>

                    <div class="col-sm-5">
                      <input type="text" class="col-sm-4" name="name"  style="width: calc(66.6666% + 22px);width: -webkit-calc(66.6666% + 22px)"
                             ng-model="model.name" required reg-char-len="30" prompt-msg="nameMsg" prompt-type="1" ng-trim="false" diff-zh="true">
                     <!-- <span class="inline padding5 red" ng-show="myform.name.$error.required && isSubmit">必填项</span>-->
                      <span class="inline padding5 red" ng-show="noName">必填项</span>
                      <span class="inline padding5" ng-class="{'red':myform.name.$error.exceed}" ng-bind="nameMsg"></span>

                    </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><span class="red">*</span>活动有效时间：</label>

                    <div class="col-sm-5">
                      <div class="input-group col-sm-4 no-padding">
                        <input type="text" name="start" id="start_time"
                               class="Wdate form-control hasDatepicker"
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}',maxDate:'#F{$dp.$D(\'end_time\')}'});"
                               value=""/>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                      </div>
                      <span class="float-left padding5"> 至 </span>
                      <div class="input-group col-sm-4 no-padding">
                        <input type="text" name="start" id="end_time"
                               class="Wdate form-control hasDatepicker"
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'start_time\')}',maxDate:'2030-10-01'});"
                               value=""/>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                      </div>
                      <span class="inline padding5 red" ng-show="isTimes" ng-cloak>必填项</span> <span
                        class="inline padding5 red" ng-show="isCompare" ng-cloak>结束时间必须大于开始时间</span>
                    </div>
                  </div>
                  <div class="modal-footer margin-auto" id="modal-footer">
                    <a class="btn btn-infor" href="/signin-setting/list"> 返回列表 </a>
                    <a id="saveBtn" class="btn btn-success" ng-click="saveBtn()"> 保存并关闭 </a></div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="/ace/js/DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
  app.controller('mainController', function ($scope, $rootScope, $timeout,$http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'eb');
    }, 100);
    $scope.model = JSON.parse('<?= addslashe(json_encode($model)); ?>');

    if ($scope.model.start_time != "" && $scope.model.start_time != "undefined") {
      $('#start_time').val(wsh.getdate($scope.model.start_time));
    }
    if ($scope.model.end_time != "" && $scope.model.end_time != "undefined") {
      $('#end_time').val(wsh.getdate($scope.model.end_time));
    }

    //保存
    $scope.isCompare = $scope.isTimes = false;
    $scope.saveBtn = function (id) {

      $scope.startt = $("#start_time").val(),
        $scope.endtime = $("#end_time").val();
      if ($scope.startt == "" || $scope.startt == "undefined" || $scope.endtime == "" || $scope.endtime == "undefined" ||!$scope.model.name) {
        $scope.isTimes = true;  $scope.noName = true;
        return $timeout(function () {
          $scope.isTimes = false;$scope.noName = false;
        }, 2000);
      }
      $scope.start = +new Date($scope.startt) / 1000,
        $scope.end = +new Date($scope.endtime) / 1000;
      if ($scope.start >= $scope.end) {
        $scope.isCompare = true;
        return $timeout(function () {
          $scope.isCompare = false;
        }, 2000);
      }

      if(!$scope.model.name || !$scope.end || !$scope.start) {
        return ;
      }

      $.ajax({
        type: "post",
        url: wsh.url + "edit-ajax",
        dataType: "JSON",
        data: {
          "id":$scope.model.id,
          "name": $scope.model.name,
          "start_time": $scope.start,
          "end_time": $scope.end
        },
        success: function (msg) {
          wsh.successback(msg, "修改成功", false, function () {
            $('#saveBtn').removeAttr('disabled');
            window.location = 'list';
          });
        }, error: function (msg) {
          console.log(msg);
          $('#saveBtn').removeAttr('disabled');
        }
      });
    }
  });

</script>