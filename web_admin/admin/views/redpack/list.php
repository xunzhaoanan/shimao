<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '红包活动';
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
          <li>红包活动</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="tabbable">

              <ul class="nav nav-tabs tab-color-blue " id="myTab4">
                <li class=""><a href="/redpack-manage/list">红包管理 </a></li>
                <li class="active"><a href="/redpack/list">红包活动</a></li>
              </ul>

              <div class="tab-content">
                <div id="home" class="tab-pane active">
                  <a href="/redpack/add" ng-if="$root.hasPermission('redpack/add')"
                     class="btn btn-xs btn-primary">新增活动</a>

                  <div class="space-6"></div>
                  <form class="form-horizontal">
                    <table width="100%"
                           class="table table-striped table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th width="10%" class="text-center">活动名称</th>
                        <th width="10%" class="text-center">活动类型</th>
                        <th width="8%" class="text-center">关联红包</th>
                        <th width="8%" class="text-center">关联金额</th>
                        <th width="8%" class="text-center">个数</th>
                        <th width="8%" class="text-center">已派发</th>
                        <th width="20%" class="text-center">有效时间</th>
                        <th width="10%" class="text-center">状态</th>
                        <th width="15%" class="text-center">操作</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr ng-repeat="list in lists" ng-cloak>
                        <td class="lt-width3 text-center" ng-bind="list.name"></td>
                        <td class="text-center" ng-bind="shareType(list.share_type)"></td>
                        <td class="text-center" ng-bind="list.redPacketEvent.redPacket.name"></td>
                        <!--关联红包-->
                        <td class="text-center"
                            ng-bind="list.redPacketEvent.redPacket.total_amount | price"></td>
                        <!--关联金额-->
                        <td class="text-center" ng-bind="list.redPacketEvent.red_packet_num"></td>
                        <!--个数-->
                        <td class="text-center" ng-bind="countInfo[list.redPacketEvent.id]"></td>
                        <!--已派发-->
                        <td class="text-center">
                          <span ng-bind="list.start_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></span> 至
                          <span ng-bind="list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></span>
                        </td>
                        <td class="text-center">
                          <label>
                            <input name="switch-field-1"
                                   ng-disabled="!$root.hasPermission('redpack/open-ajax')"
                                   class="ace ace-switch ace-switch-6" ng-model="list.isDeleted"
                                   type="checkbox" ng-click="chkDeleted(list.deleted, list.id)">
                            <span class="lbl"></span>
                          </label>
                        </td>
                        <td class="text-center">
                          <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                            <a class="pointer" title="二维码管理" target="_blank"
                               ng-href="{{'/activity/qrcode?model=redpack_group&model_id='+list.id}}">
                              <i class="icon-erweima bigger-130"></i>
                            </a>
                            <a class="grey pointer" href="/redpack/join?id={{list.id}}"
                               target="_bank" title="参与人员">
                              <i class="icon-renyuanjieshao bigger-130"></i>
                            </a>
                            <a class="blue pointer" href="/redpack/edit?id={{list.id}}"
                               ng-if="$root.hasPermission('redpack/edit')" title="编辑">
                              <i class="icon-bianji bigger-130"></i>
                            </a>
                            <a class="red pointer" title="删除" ng-click="delete(list.id)">
                              <i class="icon-shanchu bigger-140"></i>
                            </a>

                          </div>
                        </td>
                      </tr>
                      <tr ng-cloak ng-show="emptyLists" class="center">
                        <td colspan="9">暂无数据</td>
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

<!--查看二维码-->
<div class="bootbox modal fade in" id="query" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
      <div class="modal-header"><a href="#" type="button" class="bootbox-close-button close"
                                   data-dismiss="modal">×</a>
        <h4 class="modal-title">查看红包活动二维码</h4>
      </div>
      <div class="modal-body bjge3 no-padding-bottom">
        <div class="bootbox-body"><img ng-src="{{$root.srcImg}}"></div>
      </div>
    </div>
  </div>
</div>

<script>
  app.controller('mainController', function ($scope, $rootScope, $timeout) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ec');
    }, 100);

    //分页
    $scope.options = {callback: getData};
    var int = 1;
    getData(int);
    function getData(int) {
      $.ajax({
        type: "POST",
        url: "<?= Url::to(['/redpack/list-ajax']);?>",
        dataType: "JSON",
        data: {"_page": int, "_page_size": 15, "countFlag": true},
        success: function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.lists = msg.errmsg.data;
            $scope.countInfo = $scope.lists.countInfo;
            delete $scope.lists.countInfo; //去掉countInfo 对象
            $scope.emptyLists = $.isEmptyObject($scope.lists);
            $scope.redpackCount = msg.errmsg.redpackCount;
            $scope.page = msg.errmsg.page;
            $.each($scope.lists, function (a, b) {
              if (a != 'countInfo') {
                b.isDeleted = b.deleted == 1 ? true : false;
                b.isAttention = b.redPacketEvent.is_attention == 1 ? true : false;
              }
            });
          });
          $scope.$apply();
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
        case 3:
          return '线下活动';
          break;
        default :
          return '没有活动类型';
      }
    };
    //活动状态
    $scope.chkDeleted = function (del, id) {
      if (del == 1) {
        $.ajax({
          type: "POST",
          url: "<?= Url::to(['/redpack/close-ajax']);?>",
          dataType: "JSON",
          data: {"id": id},
          success: function (msg) {
            wsh.successback(msg, '关闭成功', false, function () {
              getData(parseInt($scope.page.current_page) + 1);
            });
          }
        });
      } else {
        $.ajax({
          type: "POST",
          url: "<?= Url::to(['/redpack/open-ajax']);?>",
          dataType: "JSON",
          data: {"id": id},
          success: function (msg) {
            wsh.successback(msg, '开启成功', false, function () {
              getData(parseInt($scope.page.current_page) + 1);
            });
          }
        });
      }
    };
     //删除活动
    $scope.delete = function (id) {
      dialog({
        zIndex: 9999998,
        title: "红包活动提示",
        content: "确定要删除该红包活动吗?",
        okValue: "删除",
        ok: function () {
          $.ajax({
            type: "POST",
            url: "<?= Url::to(['/redpack/del-ajax']);?>",
            dataType: "JSON",
            data: {"id": id},
            success: function (msg) {
              wsh.successback(msg, '删除成功！', false, function () {
                getData(1);
              });
            }
          });
        },
        otherBtnValue: "取消",
        otherBtn: function () {
        }
      }).width(320).showModal();
    }


  });

</script> 
