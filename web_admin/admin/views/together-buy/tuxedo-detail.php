<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '参团详情';
?>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
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
          <li>参团详情</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="clearfix no-padding order-boxm ">
          <!--头部 订单号等的查询-->
          <div class="row  margin-bottom10 padding-left10 clearfix">
            <div class=" no-padding-left ">
              <span class="float-left "> 该拼团活动共产生<b class="red" ng-bind="total_count">100</b>个团</span>
            </div>

            <div class=" no-padding-left margin-right10">


                            <span class="float-right "><a class="btn btn-xs btn-primary"
                                                          ng-click="searchFun()">搜索</a></span>

              <div class="input-group  no-padding-left  float-right clearfix">
                <input class="text marginleft1" type="text" placeholder="输入团长昵称" ng-model="nickName">
              </div>
              <select class="float-right margin-right10" style="width: 100px" ng-model="tatusId"
                      ng-options="o.id as o.title for o in statusList"
                      ng-change="changeStaue(typeId)">
                <option value="1">全部状态</option>
              </select>
            </div>
          </div>
          <!--头部 订单号等的查询-->

        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="space-4"></div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                <tr>
                  <th width="12%" class="text-center">团长昵称</th>
                  <th width="15%" class="text-center">开团时间</th>
                  <th width="8%" class="text-center">拼团进度</th>
                  <th width="8%" class="text-center">拼团状态</th>
                  <th width="5%" class="text-center">操作</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="list in lists">
                  <td class="text-center" ng-bind="list.userInfo.nickname"></td>
                  <td class="text-center"
                      ng-bind="list.start_time ? list.start_time* 1000 :'' | date:'yyyy-MM-dd HH:mm:ss'"></td>
                  <td class="text-center"><span ng-bind="list.joinCount"></span>/<span
                      ng-bind="list.togetherBuyGoods.together_num"></span></td>
                  <td class="text-center">
                    <span ng-show="list.is_help != 1" ng-bind="showStatus(list.status,list.close_reason)"></span>
                    <span ng-show="list.is_help == 1 && list.status == 3">直接成团</span>
                    <span ng-show="list.is_help == 1 && list.status == 4">拼团失败</span>
                    <img ng-show="list.status == 4" src="http://imgcache.vikduo.com/static/db358ebbdfdfa08455415509d75b9d92.png" title="{{list.close_reason}}"/>
                  </td>

                  <td class="text-center">
                    <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons"
                         style="cursor:pointer;">
                      <a ng-href="/together-buy/detail?id={{list.id}}" ng-if="$root.hasPermission('together-buy/detail')" title="拼团详情"
                         class="pointer grey"><i
                          class="icon-xiangqing bigger-140 align-middle"></i></a>
                      <a class="margin-left10 red pointer ng-scope" data-toggle="modal"
                         data-target="#myModal" title="关闭" ng-show="list.status != 4" ng-if="$root.hasPermission('together-buy/close-queue-ajax')" ng-click="close(list.id)">
                        <i class="icon-guanbi bigger-130 align-middle"></i>
                      </a>
                      <a class="margin-left10  pointer ng-scope" data-toggle="modal"
                         data-target="#queueModal" ng-show="list.status ==2" ng-click="clump(list.id)">
                        直接成团
                      </a>
                    </div>
                  </td>
                </tr>
                <tr ng-cloak ng-show="!lists.length || !lists" class="center">
                  <td colspan="5" class="red text-center">暂时没有可显示的数据</td>
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

<div class="bootbox modal fade in" id="myModal" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><a class="bootbox-close-button close" data-dismiss="modal">×</a>
        <h4 class="modal-title">请输入关闭原因</h4>
      </div>
      <div class="modal-body">
        <div class="bootbox-body">
          <form class="form-horizontal" name="myform" novalidate="novalidate">
            <div class="row">
              <div class="col-xs-12">

                <div class="form-group clearfix">
                  <label class="col-sm-4 control-label">关闭原因：</label>

                  <div class="col-sm-8">
                    <input type="text" class="col-sm-8" name="reason" required="required"
                           maxlength="50" ng-model="$root.reason"
                           ng-pattern="">
                      <span class="inline padding5 red"
                            ng-show="myform.reason.$error.required && $root.istrue"
                            ng-cloak>必填项</span>
                  </div>
                </div>

              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer"><a class="btn btn-default" data-dismiss="modal">取消</a> <a
          class="btn btn-primary" ng-click="$root.btnConfirm()">确定</a></div>
    </div>
  </div>
</div>
<div class="bootbox modal fade in" id="queueModal" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><a class="bootbox-close-button close" data-dismiss="modal">×</a>
        <h4 class="modal-title">温馨提示</h4>
      </div>
      <div class="modal-body">
        <div class="bootbox-body">
          <form class="form-horizontal" name="myform" novalidate="novalidate">
            <div class="row">
              <div class="col-xs-12">

                <div class="form-group clearfix">

                  <div class="text-center">
                    <h4>该团还在进行中，是否直接使其成团</h4>

                  </div>
                </div>

              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer"><a class="btn btn-default" data-dismiss="modal">取消</a> <a
          class="btn btn-primary" ng-click="$root.btnSubmit()">确定</a></div>
    </div>
  </div>
</div>
<script>
  app.controller("mainController", function ($scope, $timeout, $rootScope, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ge');
    }, 100);
    $scope.model = JSON.parse('<?= addslashe(json_encode($model))?>');
    $scope.together = $scope.model.togetherBuy;
    $scope.statusList = [{id: 0, title: '全部状态'}, {id: 1, title: '已创建未开启'}, {id: 2, title: '进行中'}, {id: 3, title: '拼团成功'}, {id: 4, title: '拼团失败'}, {id: 5, title: '直接成团'}];
    $scope.tatusId = 0;
    //分页
    $scope.options = {callback: getData};
    var int = 1;//第一页
    getData(int);
    function getData(int) {//请求列表
      $http.post("<?= Url::to(['/together-buy/find-queue-list-ajax']);?>", {
          "_page": int,
          "_page_size": 15,
          "together_buy_id": $scope.together.id,
          'headNickname': $scope.nickName,
          '_status': $scope.tatusId == 0 ? '' : $scope.tatusId
        })
        .success(function (msg) {
          wsh.successback(msg, "", false, function () {
            $scope.lists = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
            $scope.total_count = $scope.page.total_count ? $scope.page.total_count : 0;
          })
        });
    }

    //状态选择
    $scope.changeStaue = function (id) {
      $scope.typeId = id;
    };
    //搜索
    $scope.searchFun = function () {
      getData(1)
    }
    //拼团状态
    $scope.showStatus = function (status, reason) {
      switch (status) {
        case 1:
          return '已创建未开启';
          break;
        case 2:
          return '进行中';
          break;
        case 3:
          return '拼团成功';
          break;
        case 4:
          return '拼团失败';
          break;
      }
    };
    $rootScope.reason = "";
    //关闭团
    $rootScope.btnConfirm = function () {
      if ($rootScope.myform.$invalid) {
        $rootScope.istrue = true;
        return $timeout(function () {
          $rootScope.istrue = false;
        }, 2000);
      }
      $http.post("<?= Url::to(['/together-buy/close-queue-ajax']);?>", {"id": $scope.id, 'close_reason': $rootScope.reason})
        .success(function (msg) {
          wsh.successback(msg, '关团成功', false, function () {
            $('#myModal').modal('toggle');
            getData(1);

          });
        });
    };
    //关闭原因
    $scope.close = function (id) {
      $rootScope.reason = "";
      $scope.id = id;
    };
    //直接成团
    $scope.clump = function (id) {
      $scope.c_id = id;
    };
    //注水
    var is_click = false;
    $rootScope.btnSubmit = function () {
      if (is_click) return;
      is_click = true;
      $http.post("<?= Url::to(['/together-buy/help-success-queue-ajax']);?>", {"id": $scope.c_id})
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $('#queueModal').modal('toggle');
            getData(1);

          });
          is_click = false;
        }).error(function () {
        alert('网络错误!');
        is_click = false;
      });
    }
  });
</script>
