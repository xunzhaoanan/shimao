<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '中奖记录';
?>
<div class="main-container" id="main-container">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner"
       ng-controller="mainController"> <?php echo $this->render('@app/views/side/marketing.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">try {
          ace.settings.check('breadcrumbs', 'fixed')
        } catch (e) {
        }</script>
        <ul class="breadcrumb">
          <li>大转盘中奖记录</li>
        </ul>
        <!-- .breadcrumb -->
      </div>
      <div class="page-content" ng-cloak>
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <div class="tabbable">
              <ul class="nav nav-tabs tab-color-blue " id="myTab4">
                <li class="active"><a data-toggle="tab" href="#home">中奖记录</a></li>
              </ul>
              <div class="tab-content">
                <div id="home" class="tab-pane active">
                  <a class="btn btn-primary " ng-click="export()">导出中奖记录</a>

                  <div class="input-group float-right margin-left10">
                    <input class="min-width120 float-left" placeholder="姓名/微信昵称"
                           ng-model="searchNickname" type="text" id="searchName">
                                    <span class="float-left "> <a ng-click="search()"
                                                                  class="btn btn-xs btn-primary margin_right1">
                                      <i class="icon-search icon-on-right bigger-110"></i></a> </span>
                  </div>
                  <div class="float-right margin-left10" style="margin-right:-1px;">
                    <select id="form-field-select-1"
                            ng-options="o.id as o.levelName for o in levelList" ng-model="level"
                            ng-change="shopChange(level)">
                    </select>
                  </div>

                  <div class="space-6"></div>
                  <form class="form-horizontal" role="form">
                    <table width="100%"
                           class="table table-striped table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th width="15%" class="text-center">姓名/微信昵称</th>
                        <th width="21%" class="text-center">手机号码</th>
                        <th width="16%" class="text-center">地址</th>
                        <th width="16%" class="text-center">中奖等级</th>
                        <th width="9%" class="text-center">中奖物品</th>
                        <th width="21%" class="text-center">中奖时间</th>
                        <th width="16%" class="text-center">是否兑换</th>

                      </tr>
                      </thead>
                      <tbody>
                      <tr ng-repeat="list in lists">
                        <td class="text-center"
                            ng-bind="list.username ? list.username : list.wxUserInfos.nickname"></td>
                        <td class="text-center" ng-bind="list.mobile"></td>
                        <td class="text-center" ng-bind="list.address"></td>
                        <td class="text-center" ng-bind="showLevel(list)"></td>
                        <td class="text-center" ng-bind="list.prizes_name"></td>
                        <td class="text-center" ng-bind="list.created*1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                        <td class="text-center" ng-if="list.exchange==1">是</td>
                        <td class="text-center pointer" ng-if="list.exchange==2"><a
                            ng-click="exchange($index)">手动兑换</a></td>
                      </tr>
                      </tbody>
                      <tr>
                        <td colspan="7" ng-show="!lists.length" class="text-center red">暂时没有可显示的数据
                        </td>
                      </tr>
                    </table>
                    <div ng-paginate options="options" page="page"></div>
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- /row -->
        <div id="modal-table" class="modal fade" tabindex="-1" open-close-modal>
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header no-padding">
                <div class="table-header"><a href="#" type="button" class="close"
                                             data-dismiss="modal"
                                             aria-hidden="true"> <span class="white">&times;</span>
                </a>
                  Results for "Latest Registered Domains
                </div>
              </div>
              <div class="modal-footer no-margin-top"><a href="#"
                                                         class="btn btn-sm btn-danger pull-left"
                                                         data-dismiss="modal"> <i
                  class="icon-remove"></i>
                Close </a>
                <ul class="pagination pull-right no-margin">
                  <li class="prev disabled"><a href="#"> <i class="icon-double-angle-left"></i> </a>
                  </li>
                  <li class="active"><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li class="next"><a href="#"> <i class="icon-double-angle-right"></i> </a></li>
                </ul>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- PAGE CONTENT ENDS -->
      </div>
    </div>
  </div>
  <script>
    app.controller("mainController", function ($scope, $rootScope, $timeout) {
      $timeout(function () {
        $rootScope.$broadcast('leftMenuChange', 'eb');
      }, 100);
      $scope.model = JSON.parse('<?= addslashe(json_encode($model)); ?>');  //活动ID
      //分页
      $scope.options = {callback: getData};
      var int = 1;
      getData(int);
      function getData(int) {
        $.ajax({
          url: '<?= Url::to(["market-activity/record-list-ajax"]);?>',
          type: 'POST',
          dataType: 'json',
          data: {
            'id': $scope.model.id,
            '_page': int,
            '_page_size': 20,
            'findName': $scope.searchNickname ? $scope.searchNickname : '',
            'level': $scope.level == -1 ? '' : $scope.level
          },
          success: function (msg) {
            if (msg.errcode == 0) {
              $scope.lists = msg.errmsg.data;
              $scope.lists.forEach(function (i, e) {
                i.deleted = i.deleted == 1 ? true : false;
              });
              $scope.page = msg.errmsg.page;
              $scope.$apply();
            }
          }
        });
      };

      //导出
      $scope.export = function () {
        var level = $scope.level == -1 ? '' : $scope.level;
        var findName = $('#searchName').val();
        window.open("/export/market-activity?template=1&id=" + $scope.model.id + "&findName=" + findName + "&level=" + level);
      };

     //兑奖
      $scope.exchange = function (index) {
        $.post('<?= Url::to(["market-activity/exchange-record-ajax"]);?>', {
          id: $scope.lists[index].id,
          marketing_activity_id: $scope.lists[index].marketing_activity_id
        },
            function (msg) {
              wsh.successback(msg, '兑奖成功', false, function () {
                $scope.lists[index] = msg.errmsg;
                $scope.$apply();
                console.log($scope.lists);
              });
            }, 'json'
        )
      };
      //中奖等级
      $scope.showLevel = function (list) {
        var levelName = '';
        switch (list.level) {
          case 1:
            levelName = '一等奖';
            break;
          case 2:
            levelName = '二等奖';
            break;
          case 3:
            levelName = '三等奖';
            break;
          case 4:
            levelName = '四等奖';
            break;
          case 5:
            levelName = '五等奖';
            break;
        }
        return levelName;
      };
      $scope.level = -1;
      $scope.levelList = [
        {"id": -1, "levelName": '全部'},
        {"id": 1, "levelName": "一等奖"},
        {"id": 2, "levelName": "二等奖"},
        {"id": 3, "levelName": "三等奖"},
        {"id": 4, "levelName": "四等奖"},
        {"id": 5, "levelName": "五等奖"}
      ];
      $scope.search = function () {
        getData(1)
      };

    });
  </script>
</div>
