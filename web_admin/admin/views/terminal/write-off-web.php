<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '核销管理';
?>
<div class="main-container" id="main-container">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner" ng-controller="mainController"
       ng-cloak> <?php echo $this->render('@app/views/side/manage_setting.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }</script>
        <ul class="breadcrumb">
          <li>网页核销</li>
        </ul>
        <!-- .breadcrumb -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <div class="row">
              <div class="col-xs-12">

                <div class="alert alert-block alert-success" ng-if="isshow">
                  <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon icon-times"></i>
                  </button>
                  <p><i class="ace-icon icon-check green"></i> 1.只有员工绑定的微信号正常，才能进行核销。</p>

                  <p><i class="ace-icon icon-check green"></i> 2.员工绑定微信号请到“员工管理”页面进行绑定</p>
                </div>
              </div>
            </div>

            <div class="tabbable">
              <ul class="nav nav-tabs tab-color-blue " id="myTab" ng-if="isshow">
                <li><a ng-if="$root.hasPermission('terminal/write-off')"
                       ng-href="/terminal/write-off{{$root.getSearchUrl}}">绑定核销员</a></li>
                <li class="active"><a ng-if="$root.hasPermission('terminal/write-off-web')"
                                      ng-href="/terminal/write-off-web{{$root.getSearchUrl}}">网页核销</a>
                </li>
                <li><a ng-if="$root.hasPermission('terminal/write-off-records')"
                       ng-href="/terminal/write-off-records{{$root.getSearchUrl}}">核销记录</a></li>
                <li><a ng-if="$root.hasPermission('terminal/write-off-shop')"
                       ng-href="/terminal/write-off-shop{{$root.getSearchUrl}}">核销门店排行榜</a></li>
                <li><a ng-if="$root.hasPermission('terminal/write-off-staff')"
                       ng-href="/terminal/write-off-staff{{$root.getSearchUrl}}">核销员排行榜</a></li>
              </ul>
              <div class="tab-content">

                <div class="tab-pane active">

                  <div class="space-6"></div>
                  <form name="searchform">
                    <div class="input-group no-padding-left margin-right10  float-left ">
                      <!--                      <label class="float-left padding5" for="form-field-1">卡券号：</label>-->
                      <select class="float-left margin-left10 margin-right10"
                              ng-options="o.id as o.title for o in typeOption" ng-model="typeCard"
                              ng-change="typeChange(o.id)">
                      </select>
                      <input class="text marginleft1 align-middle" type="text" id="codehao"
                             ng-show="typeCard == 0"
                             ng-model="cancelCardCode" name="code" required>
                      <input class="text marginleft1 align-middle" type="text" id="delivery"
                             ng-show="typeCard == 1"
                             ng-model="cancelPickupCode" name="pickup_code" required maxlength="12">
                      <a class="btn btn-xs btn-primary margin-left10 align-middle"
                         ng-click="cancelCard()">提交</a>
                      <!-- <span class="red ng-binding ng-hide"
                             ng-show="searchform.code.$error.required && isSubmit">必填项</span>
                       <span class="red ng-binding ng-hide" ng-show="searchform.code.$error.pattern">卡券code码不合法</span>
                       <span class="red ng-binding ng-hide"
                             ng-show="searchform.good.$error.required && isSubmit">必填项</span>
                       <span class="red ng-binding ng-hide" ng-show="searchform.good.$error.pattern">提货码不存在</span>-->

                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!--    <div class="poplayer_box layer_type1" ng-show="$root.showCodeTxt" ng-cloak>-->
    <!--      <div class="poplayer_bg"></div>-->
    <!--      <div class="poplayer_content">-->
    <!--        <div class="poplayer_section">-->
    <!--          <div class="layer_type layer_style">-->
    <!--            <!-- 样式风格 -->
    <!--            <div class="layercont">-->
    <!--              <div class="btn_main">-->
    <!--                <div class="layer_text">该提货码已于2016-04-28  被使用</div>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--            <div class="layerbtn">-->
    <!--              <!--<span class="cancel">取消</span> -->
    <!--              <span class="ok" ng-click="$root.showCodeTxt = false">确定</span>-->
    <!--            </div>-->
    <!--            <!-- 样式风格 -->
    <!--          </div>-->
    <!--        </div>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->


  </div>
  <script type="text/javascript" src="/ace/js/DatePicker/WdatePicker.js"></script>
  <script>
    app.filter('cancelStatus', function () {
      return function (val) {
        switch (val) {
          case 1:
            return '卡券';
            break;
          case 2:
            return '抽奖活动';
            break;
          case 3:
            return '到店自提';
          case 4:
            return '众筹';
            break;
        }
        ;
      };
    });
    app.controller("mainController", function ($scope, $http, $rootScope, $timeout) {
      $timeout(function () {
        $rootScope.$broadcast('leftMenuChange', 'ae');
      }, 100);
      $scope.isshow = false;
      if (wsh.getHref("terminal_id")) {
        $scope.isshow = true;
      }

      $scope.typeCard = 0;
      $scope.typeOption = [{"id": 0, "title": "卡劵号"}, {"id": 1, "title": "提货码"}];
      //网页核销卡劵号（提交）
      var is_ajax = false;
      $scope.cancelCard = function () {
        console.log('222', $scope.typeCard)
        if ($scope.typeCard == 0) {
          if (!$('#codehao').val()) {
            alert('请填写卡券号');
            return;
          }
          var netName = $('#codehao').val();
          var str = /^[a-zA-Z0-9]{0,20}$/;
          if (!str.test(netName)) {
            $('#codehao').val('');
            alert('请填写正确的卡券号');
            return;
          }
          if (is_ajax) {
            return;
          }
          is_ajax = true;
          $http.post('/card-coupons/cancel-card-ajax', {'code': $scope.cancelCardCode,}).
          success(function (msg) {
            wsh.successback(msg, "", false, function () {
              if (msg.errmsg.isExistCode) {
                //跳转确认核销页面
                window.location = '../card-coupons/cancel?id=' + msg.errmsg.model.id
              } else {
                $rootScope.showCodeTxt = true;
              }
              console.log(msg);
            });
            is_ajax = false;
          }).error(function (msg) {
            wsh.successText('服务器忙！', false, $rootScope, $timeout);
            is_ajax = false;
          });
        } else {
          if (!$('#delivery').val()) {
            alert('请填写提货码');
            return;
          }
          var netName = $('#delivery').val();
          var str = /^\d{12}$/;
          if (!str.test(netName)) {
            $('#delivery').val('');
            alert('请填写正确的提货码');
            return;
          }
          if (is_ajax) {
            return;
          }
          is_ajax = true;
          $http.post('/order/get-self-pickup-order-ajax',{
            'pickup_code':netName,
          }).success(function(msg){
            wsh.successback(msg,'',false,function(){
              window.location = '../terminal/card-confirm?pickupCode=' + netName;
            });
            is_ajax = false;
          });
        }
      }
    });

  </script>
