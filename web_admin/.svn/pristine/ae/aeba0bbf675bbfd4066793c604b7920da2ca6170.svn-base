<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '参与名单';
?>
<div class="main-container" id="main-container">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner" ng-controller="mainController" ng-cloak>
    <?php echo $this->render('@app/views/side/marketing.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">try {
          ace.settings.check('breadcrumbs', 'fixed')
        } catch (e) {
        }</script>
        <ul class="breadcrumb">
          <li>参与名单</li>
        </ul>
        <!-- .breadcrumb -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->

        <div class="row">
          <div class="col-xs-12">
            <a class="btn btn-primary" target="_blank"
               ng-href="{{'../export/collect-zan-all?id=' + id}}">导出参与名单</a>
            <a class="btn btn-primary" target="_blank"
               ng-href="{{'../export/collect-zan-all?id=' + id + '&_status=1'}}">导出中奖名单</a>

            <div class="inline float-right margin-left10">
              <input placeholder="搜索微信昵称" type="text" ng-model="searchName"
                     class="inline align-top">
											<span ng-click="normalSearch()">
												<a class="btn btn-xs btn-primary align-top" style="margin-left:-4px;">
                          <i class="icon-search icon-on-right bigger-90">
                          </i>
                        </a>
											</span>
            </div>
            <div class="space-6"></div>
            <div class="table-responsive clearfix">
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                <tr>
                  <th width="10%" class="text-center">微信昵称</th>
                  <th width="10%" class="text-center">参与时间</th>
                  <th width="8%" class="text-center">姓名</th>
                  <th width="8%" class="text-center">手机号码</th>
                  <th width="15%" class="text-center">地址</th>
                  <th width="15%" class="text-center">已集赞数</th>
                  <th width="10%" class="text-center">集赞状态</th>

                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="list in lists">
                  <td class="lt-width3 text-center" ng-bind="list.userInfo.nickname">熊猫侠</td>
                  <td class="text-center" ng-bind="list.created *1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                  <td class="text-center" ng-bind="list.name"></td>
                  <td class="text-center" ng-bind="list.mobile"></td>
                  <td class="text-center" ng-bind="list.address"></td>
                  <td class="text-center" ng-bind="list.current_num"></td>
                  <td class="text-center" ng-if="list.status == 1" ng-click="exchange(list)">
                    <a>手动兑换</a>
                  </td>
                  <td class="text-center" ng-if="list.status == 2">未完成</td>
                  <td class="text-center" ng-if="list.status == 3">已完成</td>
                </tr>
                <tr ng-show="!lists.length || !lists" class="center">
                  <td colspan="7">暂无数据</td>
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
  app.controller("mainController", function ($scope, $http, $rootScope, $compile, $timeout) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'eb');
    }, 100);
    $scope.id = "<?=$id?>";//获取中奖名单id
    $scope.options = {callback: getData};
    var int = 1;
    getData(int);
    function getData(int) {
      $.ajax({
        url: '<?= Url::to(["collect-zan/join-user-ajax"]);?>',
        type: 'POST',
        dataType: 'json',
        data: {
          'id': $scope.id,
          '_page': int,
          'nickname': $scope.searchName ? $scope.searchName : '',
          '_page_size': 10
        },
        success: function (msg) {
          if (msg.errcode == 0) {
            if (!$.isArray(msg.errmsg.data)) {
              return $scope.empty = true, $scope.$apply();
            }
            $scope.lists = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
            $scope.$apply();
          }
        }
      });
    };
    //查询
    $scope.normalSearch = function () {
      getData(1);
    };

    //兑换
    $scope.exchange = function (list) {
      $.ajax({
        url: '<?= Url::to(["collect-zan/exchange-ajax"]);?>',
        type: 'POST',
        dataType: 'json',
        data: {
          'id': list.id,
          'uid': list.uid,
          'collect_id': '<?= $id ?>'
    },
        success:function(msg) {
      wsh.successback(msg, '', false, function () {
        console.log("msg", msg);
        getData(int);
        $scope.$apply();
      });
    }
  });
  }

  });

</script>

