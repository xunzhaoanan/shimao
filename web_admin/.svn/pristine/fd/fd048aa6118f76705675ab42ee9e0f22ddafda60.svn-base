<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '众筹活动';
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
        <script type="text/javascript">try {
          ace.settings.check('breadcrumbs', 'fixed')
        } catch (e) {
        }</script>
        <ul class="breadcrumb">
          <li>众筹活动</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="tabbable">
              <ul class="nav nav-tabs tab-color-blue " id="myTab4">
                <li class="active"><a href="/collect-zan/list">点赞众筹</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active">
                  <a class="btn btn-xs btn-primary" ng-if="$root.hasPermission('collect-zan/add')"
                     href="/collect-zan/add">添加点赞众筹</a>

                  <div class="space-6"></div>
                  <form class="form-horizontal">
                    <table width="100%"
                           class="table table-striped table-bordered table-hover table-width action-buttons">
                      <thead>
                      <tr>
                        <th width="20%" class="text-center">活动名称</th>
                        <th width="20%" class="text-center">活动类型</th>
                        <th width="21%" class="text-center">活动时间</th>
                        <th width="10%" class="text-center">状态</th>
                        <th width="15%" class="text-center">操作</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr ng-repeat="list in lists" ng-cloak>
                        <td class="text-center" ng-bind="list.name"></td>
                        <td class="text-center" ng-bind="shareType(list.share_type)"></td>
                        <td class="text-center">
                          <span ng-bind="list.start_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></span>
                          至 <span ng-bind="list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></span>
                        </td>
                        <td class="text-center">
                          <label>
                            <input name="switch-field-1"
                                   ng-disabled="!$root.hasPermission('collect-zan/open-ajax')"
                                   class="ace ace-switch ace-switch-6" type="checkbox"
                                   ng-model="list.isDeleted"
                                   ng-click="statusColllect(list.deleted, list.id)">
                            <span class="lbl"></span>
                          </label>
                        </td>
                        <td class="text-center">
                          <a target="_blank"
                             ng-href="{{'/activity/qrcode?model=collectzan&model_id='+list.id}}"
                             class="blue pointer " title="查看二维码">
                            <i class="icon-erweima bigger-130 text-decoration"></i>
                          </a>
                          <a class="grey pointer " href="/collect-zan/join-user?id={{list.id}}"
                             title="参与名单">
                            <i class="icon-renyuanjieshao bigger-130 text-decoration"></i>
                          </a>
                          <a href="/collect-zan/edit-news?id={{list.id}}"
                             ng-if="$root.hasPermission('collect-zan/edit')" class="pointer"
                             title="编辑">
                            <i class="icon-bianji bigger-130 text-decoration"></i>
                          </a>
                          <a class="red pointer" title="删除"
                             ng-click="deleteCollect(list.id, list.deleted)">
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
  app.controller("mainController", function ($scope, $rootScope, $timeout) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'eb');
    }, 100);

    //分页
    $scope.options = {callback: getData};
    var int = 1;
    getData(int);
    function getData(int) {//获取列表
      $.ajax({
        url: '<?= Url::to(["collect-zan/list-ajax"]);?>',
        type: 'POST',
        dataType: 'json',
        data: {
          '_page': int,
          '_page_size': 12
        },
        success: function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.lists = msg.errmsg.data;
            console.log("lists", $scope.lists);
            $scope.page = msg.errmsg.page;
            $.each($scope.lists, function (a, b) {
              b.isDeleted = b.deleted == 1 ? true : false;
            });
            $scope.$apply();
          });
        }
      });
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
        default :
          return '没有活动类型';
      }
    };
    //删除活动
    $scope.deleteCollect = function (id, deletes) {
      wsh.setDialog('', '确定要删除该众筹吗?', '/collect-zan/del-ajax', {
        "id": id
      }, function () {
        getData(1);
      }, '删除成功！');

    };

    //活动状态
    $scope.statusColllect = function (status, id) {
      if (status == 1) {
        $.ajax({
          url: '<?= Url::to(["collect-zan/close-ajax"]);?>',
          type: 'POST',
          dataType: 'json',
          data: {
            'id': id
          },
          success: function (msg) {
            wsh.successback(msg, '状态已禁用！', false, function () {
              if (msg.errcode == 0) {
                status = 2;
              }
            });
          }
        });
      } else {
        $.ajax({
          url: '<?= Url::to(["collect-zan/open-ajax"]);?>',
          type: 'POST',
          dataType: 'json',
          data: {
            'id': id
          },
          success: function (msg) {
            wsh.successback(msg, '状态已启用！', false, function () {
              if (msg.errcode == 0) {
                status = 1;
              }
            });
          }
        });
      }

    }


  });
</script>