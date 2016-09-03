<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '微预约列表';
?>
<div class="main-container" id="main-container" ng-controller="mainController">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/marketing.php');?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>微预约列表</li>
        </ul>
        <!-- .breadcrumb -->
        <!-- #nav-search -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <!--操作栏-->
            <div class="clearfix no-padding">
              <div class="col-sm-7 no-padding">
                <ul class="listli left-space1 btn-primary bune">
                  <li><a href="/reserve/add" ng-if="$root.hasPermission('reserve/add')"
                         class="btn btn-xs btn-primary">新增预约</a></li>
                </ul>
              </div>
            </div>
            <!--/操作栏-->
            <div class="space-6 clearfix col-sm-12"></div>
            <div class="table-responsive clearfix">
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                <tr>
                  <th width="15%" class="text-center">预约标题</th>
                  <th width="15%" class="text-center">活动类型</th>
                  <th width="15%" class="text-center">开始时间</th>
                  <th width="15%" class="text-center">结束时间</th>
                  <th width="8%" class="text-center">状态</th>
                  <th width="15%" class="text-center">操作</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="list in lists" ng-cloak>
                  <td class="lt-width3 text-center" ng-bind="list.title"></td>
                  <td class="text-center" ng-bind="shareType(list.share_type)"></td>
                  <td class="text-center"
                      ng-bind="list.start_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                  <td class="text-center"
                      ng-bind="list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                  <td class="text-center"><label>
                    <input name="switch-field-1"
                           ng-disabled="!$root.hasPermission('reserve/open-ajax')"
                           class="ace ace-switch ace-switch-6"
                           ng-change="changeActive($index, list)" ng-model="list.ischoose"
                           ng-disabled="list.isdisabled" type="checkbox">
                    <span class="lbl"></span> </label></td>
                  <td class="text-center">
                    <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                      <a ng-href="{{'/activity/qrcode?model=reserve&model_id='+list.id}}"
                         target="_blank" class="pointer ng-pristine ng-valid ng-touched"
                         title="二维码"><i class="icon-erweima bigger-130"></i></a>

                      <a class="blue pointer" ng-href="{{'/reserve/edit?id=' + list.id}}"
                         ng-if="$root.hasPermission('reserve/edit')" title="编辑"><i
                          class="icon-bianji bigger-130"></i></a>
                      <a class="success pointer" title="查看预约名单"
                         ng-href="{{'/reserve/join-user?id=' + list.id}}"><i
                          class="icon-mingchengpaixu  bigger-140"></i></a>
                      <a class="blue" title="签到页面" target="_blank"
                         ng-href="<?=getMobileSite()?>{{'/reserve/checkindetail?id=' + list.id}}"><i
                          class="icon-qiandao bigger-130"></i></a>
                      <a class="red pointer" ng-click="deleteActive($index, list)" title="删除"><i
                          class="icon-shanchu bigger-140"></i></a>
                    </div>
                  </td>
                </tr>
                <tr ng-cloak ng-show="!lists.length || !lists" class="center">
                  <td colspan="6">暂无数据</td>
                </tr>
                </tbody>
              </table>
            </div>
            <div ng-paginate options="options" page="page"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  app.controller('mainController', function ($scope, $rootScope, $timeout) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ed');
    }, 100);
    //分页
    $scope.options = {callback: getData};
    getData(1);

    function getData(int) {
      $.post('/reserve/list-ajax', {
        '_page': int,
        '_page_size': 15
      }, function (msg) {
        wsh.successback(msg, '', false, function () {
          $scope.lists = msg.errmsg.data;
          $scope.page = msg.errmsg.page;
          $.each($scope.lists, function (i, e) {
            e.ischoose = e.deleted == 1 ? true : false;
            e.isdisabled = false;
          });
          $scope.$apply();
        });
      }, 'json');
    }

    //活动类型
    $scope.shareType = function (id) {
      switch (id) {
        case 1:
          return '开放性活动';
          break;
        case 2:
          return '线下分享活动';
          break;
        case 3:
          return '线下活动';
          break;
        default :
          return '没有活动类型';
      }
    };
    //开启和关闭
    $scope.changeActive = function (index, obj) {
      obj.isdisabled = true;
      if (obj.ischoose) {
        $.post('/reserve/open-ajax', {id: obj.id}, function (msg) {
          wsh.successback(msg, '开启成功', false, function () {
            obj.isdisabled = false;
            $scope.$apply();
          });
        }, 'json');
      } else {
        $.post('/reserve/close-ajax', {id: obj.id}, function (msg) {
          wsh.successback(msg, '关闭成功', false, function () {
            obj.isdisabled = false;
            $scope.$apply();
          });
        }, 'json');
      }
    };
    //删除
    $scope.deleteActive = function (index, obj) {
      dialog({
        zIndex: 9999998,
        title: "删除提示",
        content: '确定要删除该活动吗?',
        okValue: "删除",
        ok: function () {
          $.post('/reserve/del-ajax', {id: obj.id}, function (msg) {
            wsh.successback(msg, '删除成功', false, function () {
              getData(1);
            });
          }, 'json');
        },
        otherBtnValue: "取消",
        otherBtn: function () {
        }
      }).width(320).showModal()
    };

  });
</script>
