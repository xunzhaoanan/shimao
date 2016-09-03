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
                    <li>添加签到活动</li>
                </ul>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="leader clearfix">
                        </div>
                        <div class="tabbable clearfix">
                            <div id="rule" class="tab-pane active ruleCont margin-top20 clearfix">
                                <form class="form-horizontal" name="myform" novalidate="novalidate">
                                    <div class="form-group  clearfix">
                                        <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>活动名称：</label>
                                        <div class="col-sm-5">
                                            <input type="text"  name="name" ng-model="name"
                                                   required reg-char-len="30" prompt-msg="nameMsg" prompt-type="1" ng-trim="false" diff-zh="true"  style="width: calc(66.6666% + 22px);width: -webkit-calc(66.6666% + 22px)">
                                             <span class="inline padding5 red" ng-show="myform.name.$error.required && isSubmit" ng-cloak>必填项</span>
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
                                   <!-- <div class="form-group clearfix">
                                        <label class="col-sm-2 control-label"> <strong class="red verg_mid">*</strong>签到人数上限：</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="col-sm-4" name="number" ng-model="limit_count"
                                                   required maxlength="30">
                                            <span class="lbl padding5 inline">人</span>
                                             <span class="inline padding5 red"
                                                   ng-show="noNumber">必填项</span>
                                        </div>
                                    </div>

                            </div>-->
                        </div>
                        <div class="modal-footer margin-auto" id="modal-footer">
                            <a class="btn btn-infor" href="/signin-setting/list"> 返回列表 </a>
                            <a id="saveBtn" class="btn btn-success" ng-click="btnSave()"> 保存并关闭 </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="/ace/js/DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
    app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
        $timeout(function () {
            $rootScope.$broadcast('leftMenuChange', 'eb');
        }, 100);

        //保存

      $scope.isCompare = $scope.isTimes = false;
      $scope.btnSave = function () {

      $scope.startt = $("#start_time").val(),
        $scope.endtime = $("#end_time").val();
      if ($scope.startt == "" || $scope.startt == "undefined" || $scope.endtime == "" || $scope.endtime == "undefined" ||$scope.myform.$invalid) {
        $scope.isTimes = true;
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isTimes = false;
          $scope.isSubmit = false;
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

            $http.post(wsh.url + "add-ajax",
                 {
                     "name": $scope.name,
                    "start_time": $scope.start,
                    "end_time": $scope.end
                }).success(function (msg) {
                    wsh.successback(msg, '添加成功', false, function () {
                        $('#btnSave').removeAttr('disabled');
                        window.location = 'list';
                    });
                    $('#btnSave').removeAttr('disabled');
                }).error(function () {
                    $('#btnSave').removeAttr('disabled');
                });

        }


    });

</script>