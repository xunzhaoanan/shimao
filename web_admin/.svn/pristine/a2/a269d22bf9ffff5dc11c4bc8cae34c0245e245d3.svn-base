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
          <li>绑定核销员</li>
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

                <div class="alert alert-block alert-success">
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
                <li class="active"><a ng-if="$root.hasPermission('terminal/write-off')"
                                      ng-href="/terminal/write-off{{$root.getSearchUrl}}">绑定核销员</a>
                </li>
                <li><a ng-if="$root.hasPermission('terminal/write-off-web')"
                       ng-href="/terminal/write-off-web{{$root.getSearchUrl}}">网页核销</a></li>
                <li><a ng-if="$root.hasPermission('terminal/write-off-records')"
                       ng-href="/terminal/write-off-records{{$root.getSearchUrl}}">核销记录</a></li>
                <li><a ng-if="$root.hasPermission('terminal/write-off-shop')"
                       ng-href="/terminal/write-off-shop{{$root.getSearchUrl}}">核销门店排行榜</a></li>
                <li><a ng-if="$root.hasPermission('terminal/write-off-staff')"
                       ng-href="/terminal/write-off-staff{{$root.getSearchUrl}}">核销员排行榜</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active">
                  <a ng-click="$root.staffList = lists"
                     ng-if="$root.hasPermission('staff/cancel-staff-list-ajax')"
                     class="btn btn-xs btn-primary" data-toggle="modal" data-target="#staffModal">新增核销员</a>

                  <div class="space-6"></div>
                  <table width="100%"
                         class="table table-striped table-bordered table-hover table-width action-buttons">
                    <thead>
                    <tr>
                      <th width="21%" class="text-center">核销员</th>
                      <th width="16%" class="text-center">所在门店</th>
                      <th width="16%" class="text-center">微信绑定</th>
                      <th width="16%" class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="list in lists">
                      <td class="text-center" ng-bind="list.real_name"></td>
                      <td class="text-center" ng-bind="list.shopSub.shopInfo.name"></td>
                      <td class="text-center" ng-bind="list.is_bind == 1 ? '已绑定' : '未绑定'"></td>
                      <td class="text-center" ng-show="list.is_cancel == 1"><a class="pointer"
                                                                               title="取消授权"
                                                                               data-rel="tooltip"
                                                                               ng-click="cancelOauth(list)">
                          <i class="icon-quanxiandongjie bigger-130 green"></i> </a></td>
                      <td class="text-center" ng-show="list.is_cancel == 2"><a class="pointer"
                                                                               title="授权"
                                                                               data-rel="tooltip"
                                                                               ng-click="oauth(list)"><i
                            class="icon-jiedong bigger-130 red"></i></a></td>
                    </tr>
                    <tr ng-show="!lists.length" ng-cloak>
                      <td colspan="4" class="red text-center">暂时没有可显示的数据</td>
                    </tr>
                    </tbody>
                  </table>
                  <div class="text-center" id="center">
                    <div id="grid-pager"></div>
                    <div ng-paginate options="options" page="page">
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
</div>
<script type="text/javascript" src="/ace/js/DatePicker/WdatePicker.js"></script>
<?php echo $this->render('@app/views/terminal/staffIndex.php'); ?>
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


    $rootScope.staffList = [];
    $scope.oauth = function (obj) {
      $.post(wsh.url + 'oauth-ajax', {'id': obj.id}, function (msg) {
        wsh.successback(msg, '授权成功', false, function () {
          obj.is_cancel = 1;
          $scope.$apply();
        });
      }, 'json');
    }

    //接收事件
    $scope.$on('chooseStaff', function (e, json) {
      $.post(wsh.url + 'create-cancel-member-ajax', {'data': json}, function (msg) {
        wsh.successback(msg, '新增成功', true, function () {
          pageList(1);
        });
      }, 'json');
    });
    $scope.cancelOauth = function (obj) {
      $.post(wsh.url + 'cancel-oauth-ajax', {'id': obj.id}, function (msg) {
        wsh.successback(msg, '取消授权成功', true, function () {
          $scope.$apply();
        });
      }, 'json');
    };
    $scope.options = {callback: pageList};
    pageList(1);
    function pageList(int) {
      $http.post(wsh.url + 'cancel-member-list-ajax', {'_page': int, '_page_size': 10})
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.lists = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
          });
        })

    }

  });

</script>
