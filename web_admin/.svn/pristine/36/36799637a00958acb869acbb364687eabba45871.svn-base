<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '签到活动管理';
?>
<div class="main-container" id="main-container" ng-controller="mainController">
  <!--<script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>-->
  <div class="main-container-inner">
    <?php
    echo $this->render('@app/views/side/marketing.php');
    ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <!--<script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>-->
        <ul class="breadcrumb">
          <li>签到活动管理</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="clearfix no-padding">
              <div class="col-sm-7 no-padding">
                <ul class="listli left-space1 btn-primary bune">
                  <li><a href="/signin-setting/add" class="btn btn-xs btn-primary" ng-if="$root.hasPermission('signin-setting/add')">添加活动</a></li>
                </ul>
              </div>
            </div>
            <div class="space-6 clearfix col-sm-12"></div>
            <div class="table-responsive clearfix">
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                <tr>
                  <th width="10%" class="text-center">活动名称</th>
                  <th width="15%" class="text-center">开始时间</th>
                  <th width="15%" class="text-center">结束时间</th>
                  <th width="10%" class="text-center">状态</th>
                  <th width="20%" class="text-center">操作</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-show="lists" ng-repeat="list in lists" ng-cloak>
                  <td class="lt-width3 text-center" ng-bind="list.name"></td>
                  <td class="text-center"
                      ng-bind="list.start_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                  <td class="text-center"
                      ng-bind="list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                  <td class="text-center">
                    <label>
                      <input name="switch-field-1" ng-disabled="!$root.hasPermission('signin-setting/open-ajax')"
                             class="ace ace-switch ace-switch-6" ng-model="list.ischoose"
                             type="checkbox" ng-click="statusColllect($index, list)">
                      <span class="lbl"></span>
                    </label>
                  </td>
                  <td class="text-center">
                    <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                      <a class="dropdown-toggle" ng-href="{{'/signin-setting/signin-join?id=' + list.id}}" title="签到活动" ng-if="$root.hasPermission('signin-setting/signin-join-list-ajax')">
                        <i class="icon-user bigger-130"></i>

                      </a>
                      <a target="_blank" class="ng-pristine ng-valid ng-touched" title="查看二维码" ng-model="list.id"  ng-click="getQrcodee(list.id)" data-toggle="modal" data-target="#query">
                        <i class="icon-erweima bigger-130"></i>
                      </a>
                      <a class="blue pointer" ng-if="$root.hasPermission('signin-setting/edit')"
                         title="编辑" ng-href="{{'/signin-setting/edit?id=' + list.id}}">
                        <i class="icon-bianji bigger-130"></i>
                      </a>
                      <a class="red pointer" href="#" title="删除" ng-click="delete(list.id,list.deleted)">
                        <i class="icon-shanchu bigger-140"></i>
                      </a>
                    </div>
                  </td>
                </tr>
                <tr ng-cloak ng-show="!lists.length || !lists" class="center">
                  <td colspan="5">暂无数据</td>
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
  <!--查看活动二维码-->
  <div class="bootbox modal fade in" id="query" tabindex="-1" role="dialog" open-close-modal
       aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"><a type="button" class="bootbox-close-button close"
                                     data-dismiss="modal">×</a>
          <h4 class="modal-title">查看签到活动的二维码</h4>
        </div>
        <div class="modal-body">
          <div class="bootbox-body">
            <div class="center">
              <img ng-src="{{$root.srcUrl}}">
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
      $rootScope.$broadcast('leftMenuChange', 'ed');
    }, 100);
    $scope.url = JSON.parse('<?= addslashe(json_encode($url)); ?>');
    //分页
    $scope.page = {};
    $scope.options = {callback: getData};
    var int = 1;//第一页
    getData(int);
    function getData(int,id) {//请求列表
      $http.post("<?= Url::to(['/signin-setting/list-ajax']);?>", {"id":id,"_page": int, "_page_size": 15})
        .success(function (msg) {
          wsh.successback(msg, "", false, function () {
            $scope.lists = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
            $.each($scope.lists, function (a, b) {
              b.ischoose = b.deleted == 1 ? true : false;  //deleted  1是开启，2是关闭
              b.issubscribe  = b.is_subscribe  == 1 ? true : false;  //is_dispaly  1是开启，2是关闭
            });
          })
        });
    }

    //状态
    $scope.statusColllect = function (index, list) {
      list.isdisabled = true;
      if (!list.ischoose) { //开启
        $http.post("<?= Url::to(['/signin-setting/close-ajax']);?>", {"id": list.id})
          .success(function (msg) {
            wsh.successback(msg, '活动已关闭', false, function () {
              if (msg.errcode == 0) {
                list.isdisabled = false;
              } else {
                list.ischoose = list.ischoose == true ? false : true;
              }
            });
          });

      } else {  //关闭
        $http.post("<?= Url::to(['/signin-setting/open-ajax']);?>", {"id": list.id})
          .success(function (msg) {
            wsh.successback(msg, '活动已开启', false, function () {
              if (msg.errcode == 0) {
                list.isdisabled = false;
              } else {
                list.ischoose = list.ischoose == true ? false : true;
              }
            });
          });
      }
    };

    //查看活动二维码
    $scope.getQrcodee = function (id) {
      $rootScope.srcUrl = '../qrcode/image?url=' + $scope.url + id;
    }

    //删除
    $scope.delete = function (id) {
      dialog({
        zIndex: 9999998,
        title: "活动删除提示",
        content: "确定要删除此活动吗?",
        okValue: "删除",
        ok: function () {
          $http.post("<?= Url::to(['/signin-setting/del-ajax']);?>", {"id": id})
            .success(function (msg) {
              wsh.successback(msg, '删除成功', false, function () {
                getData(1);
              });
            });
        },
        otherBtnValue: "取消",
        otherBtn: function () {
        }
      }).width(320).showModal();
    };
  });
</script>
