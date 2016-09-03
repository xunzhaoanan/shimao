<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '客户统计';
?>
<div class="main-container" id="main-container">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner" ng-controller="mainController">
    <?php echo $this->render('@app/views/side/terminal.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }</script>
        <ul class="breadcrumb">
          <li>客户统计</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <span terminal="false"></span>

          <div class="space-06"></div>
          <div class="col-xs-12">

            <div class="tabbable">
              <ul class="nav nav-tabs" id="myTab">
                <li><a href="/terminal/member-shop">按终端店统计</a></li>
                <li class="active"><a>按员工统计</a></li>
              </ul>
              <div class="tab-content">

                <div class="space-6"></div>

                <div id="wan" class="tab-pane active">
                  <span>员工粉丝总计：<em class="red" ng-bind="totalData">14</em>个</span>
                  <a class="btn btn-xs btn-primary float-right"> 导出数据 </a>

                  <form class="form-horizontal">
                    <table width="100%"
                           class="table  margin-top15 table-striped table-bordered table-hover table-width action-buttons">
                      <thead>
                      <tr>
                        <th width="20%" class="text-center">ID</th>
                        <th width="21%" class="text-center">员工名称</th>
                        <th width="16%" class="text-center">所属终端店</th>
                        <th width="16%" class="text-center">粉丝总数</th>
                        <th width="25%" class="text-center">操作</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr ng-repeat="list in lists">
                        <td class="text-center" ng-bind="list.id">2527</td>
                        <td class="text-center" ng-bind="list.real_name">sss</td>
                        <td class="text-center" ng-bind="list.shopinfo_name">上海微商户（分店）</td>
                        <td class="text-center" ng-bind="list.num">13</td>
                        <td class="text-center">
                          <a target="_blank" class="margin-left10 grey" title="查看粉丝明细" href="#"><i
                              class="icon-file-o bigger-130"></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="5" ng-show="!lists.length" class="text-center red">暂时没有可显示的数据
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
<script src="/ace/js/terminal.js"></script>
<script type="text/javascript" src="/ace/js/DatePicker/WdatePicker.js"></script>
<script>
  app.controller("mainController", function ($scope, $timeout, $rootScope, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 1);
    }, 100);
    var isajax = false, start = end = 0;
    $scope.lists = [];
    $scope.$on('changeTerminal', function (e, start, end) {
      start = start;
      end = end;
      getData(1, start, end);
    });
    function getData(int, start, end) {
      if (isajax) return;
      isajax = true;
      $http.post(wsh.url + 'member-by-staff-ajax', {
        "createStart": start,
        "createEnd": end,
        kind: 2
      })
        .success(function (msg) {
          isajax = false;
          wsh.successback(msg, "", false, function () {
            $scope.totalData = msg.errmsg.totalData;
            if (!angular.isArray(msg.errmsg.listData.data)) {
              msg.errmsg.listData.data = wsh.changeObj(msg.errmsg.listData.data);
            }
            if (msg.errmsg.listData.data.length) {
              $scope.lists = msg.errmsg.listData.data;
              $scope.page = msg.errmsg.listData.page;
            } else {
              $scope.lists = [];
            }
          });
        });
    }


    //分页
    $scope.options = {callback: getData};
  });
</script>

