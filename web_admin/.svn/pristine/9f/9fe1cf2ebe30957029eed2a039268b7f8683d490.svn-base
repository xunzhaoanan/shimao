<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '积分活动管理';
?>
<div class="main-container" id="main-container" ng-controller="pointsController">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner">
    <?php
    echo $this->render('@app/views/side/marketing.php');
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
          <li>积分活动</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="tabbable">
              <ul class="nav nav-tabs tab-color-blue " id="myTab">
                <li class="active"><a>送积分活动</a></li>
                <li><a ng-href="/points-redeem/list">积分抵扣活动</a></li>
              </ul>
              <div class="tab-content">

                <!--送积分活动开始了-->
                <div class="tab-pane active">
                  <a href="/activity-points/add" ng-if="$root.hasPermission('activity-points/add')"
                     class="btn btn-xs btn-primary">添加积分活动</a>
                  <span>注:同时只能有一个送积分活动启用</span>

                  <div class="space-6"></div>
                  <form class="form-horizontal">
                    <table width="100%"
                           class="table table-striped table-bordered table-hover table-width action-buttons">
                      <thead>
                      <tr>
                        <th width="14%" class="text-center">活动名称</th>
                        <th width="14%" class="text-center">活动策略</th>
                        <th width="16%" class="text-center">活动时间</th>
                        <th width="14%" class="text-center">是否启用</th>
                        <th width="10%" class="text-center">操作</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr ng-repeat="list in lists" ng-cloak>
                        <td class="text-center" ng-bind="list.name"></td>
                        <td class="text-center" ng-cloak ng-if="list.pointsConsumption.type == 2">
                          订单满<span ng-bind="list.pointsConsumption.amount/100"></span>元，送<span ng-bind="list.pointsConsumption.points"></span>积分
                        </td>
                        <td class="text-center" ng-cloak ng-if="list.pointsConsumption.type == 1">
                          订单每满<span ng-bind="list.pointsConsumption.amount/100"></span>元，送<span ng-bind="llist.pointsConsumption.points"></span>积分
                        </td>
                        <td class="text-center" ng-cloak>
                          <span ng-show="list.expire_type != 2"
                                ng-if="list.start_time >= 0 && list.end_time >= 0">
                            <span ng-bind="list.start_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></span> 至 <span ng-bind="list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></span></span>
                          <span ng-show="list.expire_type == 2">无时间限制</span>
                        </td>

                        <td class="text-center">

                          <label>
                            <input name="switch-field-1"
                                   ng-disabled="!$root.hasPermission('activity-points/open-ajax')"
                                   class="ace ace-switch ace-switch-6" type="checkbox"
                                   ng-model="list.isdeleted"
                                   ng-click="status(list.deleted, list.id)">
                            <span class="lbl"></span> </label>
                        </td>
                        <td class="text-center">
                          <a class="blue pointer"
                             ng-if="$root.hasPermission('activity-points/edit')" title="编辑"
                             ng-href="{{'/activity-points/edit?id=' + list.id}}">
                            <i class="icon-bianji bigger-130"></i>
                          </a>
                          <a class="red pointer" title="删除" ng-click="delete(list.id)">
                            <i class="icon-shanchu bigger-140"></i>
                          </a>
                        </td>
                      </tr>
                      <tr ng-cloak ng-show="!lists.length || !lists" class="center">
                        <td colspan="5">暂无数据</td>
                      </tr>
                      </tbody>
                    </table>
                  </form>
                </div>

                <!--送积分活动结束了-->
                <div ng-paginate options="options" page="page"></div>

              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  app.controller('pointsController', function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ec');
    }, 100);
    $scope.options = {callback: getData};
    //送积分活动列表
    var int = 1;
    getData(int);

    //积分抵扣活动列表
    $scope.activeTime = function (list) {
      if (list.start_time && list.end_time) {
        return wsh.getdate(list.start_time) + ' 至 ' + wsh.getdate(list.end_time);
      } else {
        return '无时间限制';
      }
    };

    function getData(int) {
      $http.post("<?= Url::to(['/activity-points/list-ajax']);?>", {"_page": int, "_page_size": 15})
          .success(function (msg) {
            wsh.successback(msg, "", false, function () {
              $scope.lists = msg.errmsg.data;
              $scope.page = msg.errmsg.page;
              $.each($scope.lists, function (a, b) {
                b.isdeleted = b.deleted == 1 ? true : false;  //deleted  1是开启，2是关闭
              });
            })
          });
    }

    //送积分活动的删除
    $scope.delete = function (id) {
      dialog({
        zIndex: 9999998,
        title: "活动删除提示",
        content: "确定要删除此活动吗?",
        okValue: "删除",
        ok: function () {
          $http.post("<?= Url::to(['/activity-points/del-ajax']);?>", {"id": id})
              .success(
              function (msg) {
                wsh.successback(msg, '删除成功', false, function () {
                  getData(1);

                });
              }
          );
        },
        otherBtnValue: "取消",
        otherBtn: function () {
        }
      }).width(320).showModal();
    };
    //状态
    $scope.status = function (deleted, id ,lists) {
      if (deleted == 1) { //活动关闭
        $http.post("<?= Url::to(['/activity-points/close-ajax']);?>", {"id": id})
            .success(
            function (msg) {
              wsh.successback(msg, '活动已关闭', false, function () {
                if (msg.errcode == 0) {
                  deleted = 2;
                }
              });
            }
        );
      } else {  //活动开启
        $http.post("<?= Url::to(['/activity-points/open-ajax']);?>", {"id": id}).
            success(
            function (msg) {
              wsh.successback(msg, '活动已启用', false, function () {
                if (msg.errcode == 0) {
                    angular.forEach($scope.lists, function(obj){
                      obj.deleted = obj.id === id ? 1 : 2;
                      obj.isdeleted = obj.id === id;
                    });
                }
              });
            }
        );
      }
    };

  });
</script>