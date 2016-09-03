<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '派发管理';
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">
<div class="main-container" id="main-container" ng-controller="mainController">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/marketing.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>卡券管理</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="tabbable">

              <ul class="nav nav-tabs tab-color-blue " id="myTab4">
                <li class=""><a href="/card-coupons/list">卡券列表 </a></li>
                <li class=""><a href="/card-coupons/receive-list">直接领取 </a></li>
                <li class=""><a href="/card-coupons/policy-list">赠送策略</a></li>
                <li class="active"><a href="/card-coupons/send-list">手动派发</a></li>
              </ul>

              <div class="tab-content">
                <div class="tab-pane active">
                  <div class="clearfix no-padding">
                    <div class="col-sm-7 no-padding">
                      <ul class="listli left-space1 btn-primary bune">
                        <li><a href="/card-coupons/send"
                               ng-if="$root.hasPermission('card-coupons/send')"
                               class="btn btn-xs btn-primary">派送卡券</a></li>
                      </ul>
                    </div>
                  </div>
                  <form class="form-horizontal">
                    <table width="100%"
                           class="table  margin-top15 table-striped table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th width="10%" class="text-center">卡券名称</th>
                        <th width="8%" class="text-center">接受者昵称</th>
                        <th width="8%" class="text-center">用户编号</th>
                        <th width="15%" class="text-center">卡券编号</th>
                        <th width="15%" class="text-center">卡券派送时间</th>
                        <th width="15%" class="text-center">卡券使用期限</th>
                        <th width="7%" class="text-center">卡券状态</th>
                        <th width="7%" class="text-center">平台类型</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr ng-repeat="list in lists" ng-cloak>
                        <td class="text-center" ng-bind="list.cardTypeInfo.title">商户卡券</td>
                        <td class="text-center" ng-bind="list.wxUser.nickname">范菁菁 :)</td>
                        <td class="text-center" ng-bind="list.wxUser.id">1036009</td>
                        <td class="text-center" ng-bind="list.code"></td>
                        <td class="text-center"
                            ng-bind="list.created*1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                        <td class="text-center">
                          <span ng-bind="list.begin_time*1000 | date:'yyyy-MM-dd'"></span> 至
                          <span ng-bind="list.end_time*1000 | date:'yyyy-MM-dd'"></span>
                        </td>
                        <td class="text-center" ng-bind="status(list.status)">已领取</td>
                        <td class="text-center" ng-bind="list.type == 1?'微商户':'微信'"></td>
                      </tr>
                      <tr>
                        <td colspan="8" ng-show="!lists.length" class="red text-center" ng-cloak>
                          暂无数据
                        </td>
                      </tr>
                      </tbody>
                    </table>
                    <div ng-paginate options="options" page="page"></div>
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

<script>
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ec');
    }, 100);
    //分页
    $scope.options = {callback: getData};
    var int = 1;
    getData(int);
    function getData(int) {
      $http.post(wsh.url + 'send-list-ajax', {"_page": int, "_page_size": 15})
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              $scope.lists = msg.errmsg.data;
              $scope.page = msg.errmsg.page;
            })
          })
    }

    $rootScope.objects = {};
    $scope.popfun = true;

   //卡券类型
    $scope.wxCardType = function (id) {
      switch (id) {
        case 1:
          return '代金券';
          break;
        case 2:
          return '优惠券';
          break;
        default :
          return '没有卡券类型';
      }
    };
   //状态
    $scope.status = function (id) {
      switch (id) {
        case 1:
          return '未领取';
          break;
        case 2:
          return '已领取';
          break;
        case 3:
          return '已核销';
          break;
        case 4:
          return '已赠送';
          break;
        default :
          return '没有状态';
      }
    };
    //删除活动
    $scope.delete = function (id) {
      dialog({
        zIndex: 9999998,
        title: "红包管理提示",
        content: "确实要删除该红包吗?",
        okValue: "删除",
        ok: function () {
          $.ajax({
            type: "POST",
            url: "<?= Url::to(['/redpack-manage/del-ajax']);?>",
            dataType: "JSON",
            data: {"id": id},
            success: function (msg) {
              wsh.successback(msg, '删除成功！', false, function () {
                getData(parseInt($scope.page.current_page) + 1);
              });
            }
          });
        },
        otherBtnValue: "取消",
        otherBtn: function () {
        }
      }).width(320).showModal();
    };

  });

</script> 
