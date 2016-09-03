<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '现金红包';
?>
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
          <li>现金红包</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="tabbable">

              <ul class="nav nav-tabs tab-color-blue " id="myTab4">
                <li class="active"><a ng-if="$root.hasPermission('cash-redpack/list')"
                                      href="/cash-redpack/list">现金红包 </a></li>
                <li class=""><a ng-if="$root.hasPermission('cash-redpack/policy-list')"
                                href="/cash-redpack/policy-list">赠送策略</a></li>
                <li class=""><a ng-if="$root.hasPermission('cash-redpack/send-list')"
                                href="/cash-redpack/send-list">手动派发</a></li>
              </ul>

              <div class="tab-content">
                <div class="tab-pane active">
                  <div class="clearfix no-padding">
                    <a class="btn btn-xs btn-primary float-left"
                       ng-href="/cash-redpack/add" ng-if="$root.hasPermission('cash-redpack/add')">添加红包</a>
                    <a class="btn btn-xs btn-primary float-right" ng-href="/cash-redpack/help">现金红包说明</a>
                  </div>
                  <div class="clearfix no-padding margin-top10">
                    <div class="input-group  float-left margin-right10 ">
                      <label class="float-left padding5" for="form-field-1">红包类型：</label>
                      <select class="width150" ng-model="type"
                              ng-options="o.id as o.title for o in redpackOption">
                      </select>
                    </div>
                    <div class="input-group  float-left margin-right10 ">
                      <label class="float-left padding5" for="form-field-1">状态：</label>
                      <select class="width81" ng-options="o.id as o.title for o in statusOption"
                              ng-model="status">
                      </select>
                    </div>
                    <div class="input-group  float-left ">
                      <input class="text marginleft1 ng-pristine ng-untouched ng-valid" type="text"
                             ng-model="searchName" placeholder="搜索红包名称">
                      <span ng-click="btnSearch()">
                          <a class="btn btn-xs btn-primary align-top" style="margin-left:-4px;">
                            <i class="icon-search icon-on-right bigger-90"> </i>
                          </a>
                      </span>
                    </div>
                    <!--分组-->

                  </div>
                  <form class="form-horizontal">
                    <table width="100%"
                           class="table table-striped table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th width="20%" class="text-center">红包名称</th>
                        <th width="15%" class="text-center">红包类型</th>
                        <th width="20%" class="text-center">总金额（元）</th>
                        <th width="25%" class="text-center">单个红包金额（元）</th>
                        <th width="15%" class="text-center">红包总数量</th>
                        <th width="15%" class="text-center">已领取数</th>
                        <th width="15%" class="text-center">未领取数</th>
                        <th width="20%" class="text-center">发送失败数</th>
                        <th width="15%" class="text-center">已退款数</th>
                        <th width="10%" class="text-center">状态</th>
                        <th width="20%" class="text-center">操作</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr ng-repeat="list in lists" ng-cloak>
                        <td class="lt-width3 text-center" ng-bind="list.act_name"></td>
                        <td class="text-center" ng-if="list.type ==1">微信定额红包</td>
                        <td class="text-center" ng-if="list.type == 2">微信随机红包</td>
                        <td class="text-center" ng-if="list.type ==1" ng-bind="(list.min_value *
                          list.quantity / 100)| number:2">
                        </td>
                        <td class="text-center" ng-if="list.type ==2"><span ng-bind="(list.min_value *
                          list.quantity / 100)| number:2"></span> ~<span ng-bind="(list.max_value * list.quantity /
                          100)| number:2"></span>
                        </td>
                        <td class="text-center" ng-if="list.type ==1" ng-bind="(list.min_value /100) |
                          number:2">
                        </td>
                        <td class="text-center" ng-if="list.type ==2"><span ng-bind="(list.min_value /100) |
                          number:2"></span> ~<span
                            ng-bind="(list.max_value /100) | number:2"></span>
                        </td>
                        <td class="text-center" ng-bind="list.quantity"></td>
                        <td class="text-center" ng-bind="list.received_num"></td>
                        <td class="text-center" ng-bind="list.not_received_num"></td>
                        <td class="text-center" ng-bind="list.failed_num"></td>
                        <td class="text-center" ng-bind="list.refunded_num"></td>

                        <td class="text-center">
                          <label>
                            <input name="switch-field-1"
                                   class="ace ace-switch ace-switch-6 ng-pristine ng-valid ng-touched ng-scope"
                                   ng-change="changeActive($index, list)" ng-model="list.ischoose"
                                   type="checkbox"
                                   ng-disabled="!$root.hasPermission('cash-redpack/open-ajax')">
                            <span class="lbl"></span>
                          </label></td>

                        <td class="text-center">
                          <div
                              class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                            <a class="pointer" title="二维码管理" target="_blank"
                               ng-href="{{'/activity/qrcode?model=cashredpack&model_id=' + list.id}}">
                              <i class="icon-erweima bigger-130"></i>
                            </a>
                            <a class="grey pointer" data-toggle="modal" data-target="#JoinUserModal"
                               title="参与人员" ng-click="showJoinUser($index, list)"
                               ng-if="$root.hasPermission('cash-redpack/join-user-list-ajax')">
                              <i class="icon-renyuanjieshao bigger-130"></i>
                            </a>
                            <a class="blue pointer"
                               title="编辑" ng-href="{{'/cash-redpack/edit?id=' + list.id}}"
                               ng-if="$root.hasPermission('cash-redpack/edit')">
                              <i class="icon-bianji bigger-130"></i>
                            </a>
                            <a class="red pointer" href="#" title="删除" ng-click="delete(list.id)"
                               ng-if="$root.hasPermission('cash-redpack/del-ajax')">
                              <i class="icon-shanchu bigger-140"></i>
                            </a>

                          </div>
                        </td>
                      </tr>
                      <tr ng-cloak ng-show="!lists.length || !lists" class="center">
                        <td colspan="11" class="red">暂无数据</td>
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
<?php
    echo $this->render('@app/views/cash-redpack/join-user.php');
?>
<script>
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'eb');
    }, 100);

    var int = 1;
    $scope.model = {"_page_size": 15};//请求列表时给的参数
    $scope.getData = function (int) {
      $scope.model._page = int;
      $http.post(wsh.url + "list-ajax", $scope.model)
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              $scope.lists = msg.errmsg.data;
              $scope.page = msg.errmsg.page;
              $.each($scope.lists, function (i, e) {
                e.ischoose = e.deleted == 1 ? true : false;
                e.isdisabled = false;
              });
            });
          });
    };
    $scope.getData(int);
    //红包类型
    $scope.type = -1;
    $scope.redpackOption = [
      {"id": -1, "title": "全部"}, {"id": 1, "title": "微信固定金额红包"}, {"id": 2, "title": "微信随机金额红包"}
    ];
    //状态
    $scope.status = -1;
    $scope.statusOption = [
      {"id": -1, "title": "全部"}, {"id": 1, "title": "开启"}, {"id": 2, "title": "关闭"}
    ];
    //分页
    $scope.options = {callback: $scope.getData};
    //搜索
    $scope.btnSearch = function () {
      $scope.model.deleted = $scope.status != -1 ? $scope.status : '';
      $scope.model.type = $scope.type != -1 ? $scope.type : '';
      $scope.model.act_name = $scope.searchName ? $scope.searchName : '';

      $scope.getData(1);
    };


    //开启和关闭
    $scope.changeActive = function (index, obj) {
      obj.isdisabled = true;

      if (obj.ischoose) {
        $http.post(wsh.url + 'open-ajax', {id: obj.id})
            .success(function (msg) {
              wsh.successback(msg, '开启成功', false, '', function () {
                if (msg.errcode == 0) {
                  obj.isdisabled = false;
                } else {
                  obj.ischoose = obj.ischoose == true ? false : true;
                }
              });
            })
      } else {
        $http.post(wsh.url + 'close-ajax', {id: obj.id})
            .success(function (msg) {
              wsh.successback(msg, '关闭成功', false, '', function () {
                if (msg.errcode == 0) {
                  obj.isdisabled = false;
                } else {
                  obj.ischoose = obj.ischoose == true ? false : true;
                }
              });
            })
      }

    };
    //删除
    $scope.delete = function (id) {
      wsh.setDialog('删除提示', '确定要删除吗', wsh.url + 'del-ajax', {'id': id}, function () {
        $scope.getData(1);
      }, '删除成功！');
    };
    //编辑
    $scope.showJoinUser = function (index, list) {
      $rootScope.$broadcast('JoinUserModal', list);
    };
  });

</script> 
