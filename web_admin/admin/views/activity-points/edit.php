<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '编辑送积分活动';
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner">
    <?php echo $this->render('@app/views/side/marketing.php');?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>编辑送积分活动</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <form class="form-horizontal" name="myform">
              <div class="form-group  clearfix">
                <div class="col-sm-12 leader margin-bottom10" >
                  <span class="label label-light  no-padding center">
                    <b class="red">提示：活动一旦开启就不能再进行任何改动</b>
                  </span>
                </div>

                <label class="col-sm-2 control-label"><span class="red">*</span>活动名称：</label>

                <div class="col-sm-10">
                  <input type="text" class="col-sm-2" name="name" ng-model="model.activity.name"
                         required maxlength="100">
                  <span class="inline padding5 red"
                        ng-show="myform.name.$error.required && isSubmit" ng-cloak>必填项</span>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"><span class="red">*</span>活动时间：</label>

                <div class="col-sm-10">
                  <select class="col-sm-2" ng-model="model.activity.expire_type"
                          ng-options="o.id as o.title for o in expireOption"
                          ng-change="changeExpire(model.activity.expire_type)">
                  </select>
                </div>
              </div>

              <div class="form-group margin-bottom10 clearfix" ng-show="isExpire">
                <label class="col-sm-2 control-label"> </label>

                <div class="col-sm-10">
                  <div class="input-group col-sm-2 no-padding">
                    <input type="text" name="start" id="start_time"
                           class="Wdate form-control hasDatepicker"
                           onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'start_time\')}',maxDate:'2030-10-01'});"
                           value=""/>
                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                  </div>
                  <span class="float-left padding5 "> 至 </span>

                  <div class="input-group col-sm-2 no-padding">
                    <input type="text" name="start" id="end_time"
                           class="Wdate form-control hasDatepicker"
                           onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}',maxDate:'2030-10-01'});"
                           value=""/>
                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                  </div>
                  <span class="inline padding5 red" ng-show="isTimes" ng-cloak>必填项</span>
                  <span class="inline padding5 red" ng-show="isCompare" ng-cloak>结束时间必须大于开始时间</span>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"> 活动策略：</label>

                <div class="col-sm-10">
                  <select class="col-sm-2" ng-model="model.pointsConsumption.type"
                          ng-options="o.id as o.title for o in policyOption"
                          ng-change="changePolicy(model.pointsConsumption.type)">
                  </select>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label" ng-if="model.pointsConsumption.type ==2"><span
                    class="red">*</span>单笔订单满：</label>
                <label class="col-sm-2 control-label" ng-if="model.pointsConsumption.type ==1"><span
                    class="red">*</span>单笔订单每满：</label>

                <div class="col-sm-8">
                  <div class="col-sm-3 no-padding width150">
                    <input type="text" class="col-sm-6" maxlength="7" ng-model="consumptionAmount"
                           name="aumout" required ng-pattern="" reg-money>
                    <span class="lbl padding5 width51 inline">元，送</span>
                    <span class="inline padding5 red"
                          ng-show="myform.aumout.$error.required && isSubmit" ng-cloak>必填项</span>
                    <span class="inline padding5 red" ng-show="myform.aumout.$error.pattern"
                          ng-cloak ng-bind="$root.regMoneyText"></span>
                  </div>
                  <div class="col-sm-3 no-padding width150">
                    <input type="text" class="col-sm-6" maxlength="7"
                           ng-model="model.pointsConsumption.points" name="points" required
                           ng-pattern="" reg-int>
                    <span class="lbl padding5 width51 inline">积分</span>
                  </div>
                  <span class="inline padding5 red"
                        ng-show="myform.points.$error.required && isSubmit" ng-cloak>必填项</span>
                  <span class="inline padding5 red" ng-show="myform.points.$error.pattern" ng-cloak ng-bind="$root.regIntText"></span>
                </div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"> <strong class="red">*</strong>积分赠送规则：</label>
                  <div class="col-sm-10" id="radio">
                    <label>
                      <input name="favorable" id="no_favorable" type="radio" ng-model="model.pointsConsumption.count_type" class="ace" value="1">
                      <span class="lbl"> 按订单金额赠送（订单金额即购物车中商品销售价之和） </span>
                    </label>
                  </div>
                  <div class="col-sm-10" id="radio">
                    <label>
                      <input name="favorable" id="favorable" type="radio" class="ace" ng-model="model.pointsConsumption.count_type" value="2">
                      <span class="lbl"> 按实付金额赠送（实付金额即购物车中扣除会员折扣、卡券、红包、积分等优惠后的实际支付金额） </span>
                    </label>
                  </div>
                </div>
            </form>
            <!-- 确定 -->
            <div class="modal-footer margin-auto" id="modal-footer">
              <a class="btn btn-infor" href="javascript:history.go(-1)"> 返回 </a>
              <a ng-disabled="isDisabled" class="btn btn-primary" ng-click="btnSava()"> 保存 </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script language="javascript" type="text/javascript"
        src="/ace/js/DatePicker/WdatePicker.js"></script>
<script>
  app.controller("mainController", function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ec');
    }, 100);
    $scope.isDisabled = false;

    $scope.model = JSON.parse('<?= addslashe(json_encode($model))?>');
    $scope.consumptionAmount = $scope.model.pointsConsumption.amount / 100;//满多少元
    //活动时间
    $scope.expireOption = [
      {"id": 2, "title": "无时间限制"},
      {"id": 1, "title": "指定时间有效"}
    ];
    $scope.isExpire = false;
    expire();
    $scope.changeExpire = function (id) {
      expire(id);
    };
    if ($scope.model.activity.start_time != "" && $scope.model.activity.start_time != "undefined") {
      $('#start_time').val(wsh.getdate($scope.model.activity.start_time));
    }
    if ($scope.model.activity.end_time != "" && $scope.model.activity.end_time != "undefined") {
      $('#end_time').val(wsh.getdate($scope.model.activity.end_time));
    }


    //活动策略
    $scope.policyOption = [
      {"id": 2, "title": "订单满多少送积分"},
      {"id": 1, "title": "订单每满多少送积分"}
    ];
    $scope.changePolicy = function (id) {
      $scope.model.pointsConsumption.type = id;
    };

    function expire(id) {
      if ($scope.model.activity.expire_type == 1) {
        $scope.isExpire = true;
      } else {
        $scope.isExpire = false;
      }
      if (id != undefined && id != "") {
        $scope.model.activity.expire_type = id;
      }
    }

    $scope.isSubmit = false;
    $scope.btnSava = function () {
      if ($scope.myform.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }

      if ($scope.model.activity.expire_type == 1) {
        $scope.isCompare = $scope.isTimes = false;
        $scope.startt = $("#start_time").val(), $scope.endtime = $("#end_time").val();
        if ($scope.startt == "" || $scope.startt == "undefined" || $scope.endtime == "" || $scope.endtime == "undefined") {
          $scope.isTimes = true;
          return $timeout(function () {
            $scope.isTimes = false;
          }, 2000);
        }
        $scope.start = +new Date($scope.startt) / 1000, $scope.end = +new Date($scope.endtime) / 1000;
        if ($scope.start >= $scope.end) {
          $scope.isCompare = true;
          return $timeout(function () {
            $scope.isCompare = false;
          }, 2000);
        }
      }
      $scope.isDisabled = true;
      $http.post(wsh.url + "edit-ajax", {
        activity: {
          "id": $scope.model.activity.id,
          "name": $scope.model.activity.name,
          "expire_type": $scope.model.activity.expire_type,
          "start_time": $scope.start ? $scope.start : 0,
          "end_time": $scope.end ? $scope.end : 0
        },
        "pointsConsumption": {
          "id": $scope.model.pointsConsumption.id,//活动id
          "type": $scope.model.pointsConsumption.type,//活动策略【1为订单满多少送，2为订单每满多少送】
          "amount": $scope.consumptionAmount * 100,//满多少元
          "points": $scope.model.pointsConsumption.points,//送多少积分
          "count_type": $scope.model.pointsConsumption.count_type
        }
      })
          .success(function (msg) {
            wsh.successback(msg, '保存成功！', false, function () {
              window.location = 'list';
            });
            $scope.isDisabled = false;
          });
    }
  });
</script>
