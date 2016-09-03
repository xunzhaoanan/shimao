<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '编辑默认回复';
?>
<link href="/ace/js/angular-qqface/emoji.min.css" rel="stylesheet"/>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div
    class="main-container-inner"> <?php echo $this->render('@app/views/side/weixin_setting.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>编辑默认回复</li>
        </ul>
        <!-- .breadcrumb -->
        <!-- #nav-search -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="space-10"></div>
          <div class=" alert alert-block label-yellow yellow-border" ng-show="isedit"><i
              class="icon-warning-sign"></i> 默认模式开启后，不管粉丝给你发什么信息，未触发其他自动回复规则时就会回复以下你设置的内容。<a
              ng-if="$root.hasPermission('weixin/default-reply-close-ajax')"
              class="btn btn-xs btn-danger"
              ng-click="closeReply()" ng-show="isOpenReply"> 停用 </a><a
              ng-if="$root.hasPermission('weixin/default-reply-open-ajax')" ng-show="!isOpenReply"
              class="btn btn-xs btn-danger" ng-click="openReply()"> 启用 </a></div>
          <div class="space-10"></div>
          <div class="clearfix">
            <div class="col-sm-12">
              <table width="80%" border="0" cellspacing="0" cellpadding="0"
                     class="weiright-td tjhf ">
                <tr class="no-border no-margin-bottom">
                  <td colspan="2" valign="top" class="no-border no-padding">
                    <h4 class="header smaller lighter blue no-margin-bottom">
                      <span class="badge badge-danger align-middle"></span> 添加回复消息
                    </h4>
                  </td>
                </tr>
                <tr ng-repeat="list in MaterialLists track by $index">
                  <td valign="top" ng-class="{true: 'zdhf'}[list.desc == '语音']">
                    {{$index+1+'、'}}
                    <div class="inline align-top width90">
                      <div class="margin-bottom5 text-overflow">
                        <span class="label label-sm label-primary weibq margin-right5"
                              ng-bind="list.desc"></span><strong>{{list.title}}</strong>
                      </div>
                      <a class="table-width inline dark"
                         ng-bind-html="list.reply_content | sysface | trust:'html'"
                         ng-if="list.desc == '文本'"></a>

                      <div class="dtw_tu" ng-if="list.desc == '语音'"></div>
                      <span ng-if="list.desc == '语音'">4"</span>
                      <img ng-src="{{list.cdn_path}}" style="vertical-align:text-top" width="45"
                           height="45" ng-if="list.desc == '图片'">
                      <img ng-src="{{list.wxImagetxtReplyItems[0].cdn_path}}"
                           style="vertical-align:text-top" width="45" height="45"
                           ng-if="list.desc == '图文'">
                    </div>
                  </td>
                  <td class="visible-md visible-lg hidden-sm hidden-xs action-buttons width-60px">
                    <a ng-if="$root.hasPermission('weixin/default-reply-edit-ajax')"
                       class="blue pointer" ng-click="history($index)"
                       data-toggle="modal" data-target="#insertMaterial"
                       title="编辑"> <i class="icon-bianji bigger-130"></i>
                    </a>
                    <a class="red pointer" data-rel="tooltip" data-placement="right" title="删除"
                       ng-click="Delete($index)"> <i class="icon-shanchu bigger-140"></i>
                    </a>
                  </td>
                </tr>

              </table>
            </div>
          </div>
          <div class="margin-top10 text-right width80">
            <a class="btn btn-primary" data-toggle="modal" data-target="#insertMaterial"
               ng-click="restHistory()" ng-show="MaterialLists.length < 5">添加一条消息 </a>
          </div>

          <div class="space-32"></div>

        </div>
        <!-- /.col -->
        <div class="modal-footer margin-auto" id="modal-footer">
          <a ng-if="$root.hasPermission('weixin/default-reply-edit-ajax')" ng-click="save()"
             class="btn btn-primary"> 确定 </a>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.main-container-inner -->
  </div>
</div>

<!-- 插入素材 -->
<div class="bootbox modal fade in" id="insertMaterial" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-dialog6">
    <div class="modal-content">
      <div class="modal-header modal-header2"><a href="#" class="bootbox-close-button close"
                                                 data-dismiss="modal">×</a>
        <h4 class="modal-title">选择素材</h4>
      </div>
      <div class="modal-body">
        <?php echo $this->render('@app/views/wxmaterial/index.php'); ?>
      </div>
      <div class="modal-footer no-margin-top"><a class="btn btn-default" data-dismiss="modal">取消</a>
        <a
          class="btn btn-primary" ng-click="$root.getWxmaterials()">确定</a></div>
    </div>
  </div>
</div>

<script>


  app.controller('mainController', function ($scope, $http, $rootScope, $timeout) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'bb');
    }, 100);
    if (!$.isEmptyObject(JSON.parse('<?= addslashe(json_encode($model));?>'))) {
      $scope.model = JSON.parse('<?= addslashe(json_encode($model));?>');
      $scope.MaterialLists = $scope.model.reply_ids || [];
      console.log($scope.model);
      $scope.url = '/weixin/default-reply-edit-ajax';
      $scope.isedit = true;
      $scope.isOpenReply = $scope.model.deleted == 1 ? true : false;
    } else {
      $scope.MaterialLists = [];
      $scope.isedit = false;
      $scope.url = '/weixin/default-reply-add-ajax';
    }
    $scope.closeReply = function () {
      dialog({
        zIndex: 9999998,
        title: "停用默认回复提示",
        content: "确定停用默认回复提示吗？",
        okValue: "停用",
        ok: function () {
          $.post('/weixin/default-reply-close-ajax', {id: $scope.model.id}, function (msg) {
            wsh.successback(msg, '停用成功');
            $scope.isOpenReply = !$scope.isOpenReply;
            $scope.$apply();
          }, 'json');
        },
        otherBtnValue: "取消",
        otherBtn: function () {
        }
      }).width(320).showModal()
    }
    $scope.openReply = function () {
      dialog({
        zIndex: 9999998,
        title: "启用默认回复提示",
        content: "确定启用默认回复提示吗？",
        okValue: "启用",
        ok: function () {
          $.post('/weixin/default-reply-open-ajax', {id: $scope.model.id}, function (msg) {
            wsh.successback(msg, '启用成功');
            $scope.isOpenReply = !$scope.isOpenReply;
            $scope.$apply();
          }, 'json');
        },
        otherBtnValue: "取消",
        otherBtn: function () {
        }
      }).width(320).showModal()
    }
    $scope.historyIndex = -1;
    $scope.history = function (index) {
      $scope.historyIndex = index;
    };
    $scope.restHistory = function () {
      $scope.historyIndex = -1;
    };
    $rootScope.getWxmaterials = function () {
      if ($.isEmptyObject($rootScope.Wxmaterials)) return alert('请选择素材');
      $('#insertMaterial').modal('toggle');
//            $rootScope.Wxmaterials.wxImagetxtReplyItems = [];
//            $rootScope.Wxmaterials.wxImagetxtReplyItems[0] = $rootScope.Wxmaterials.wxImagetxtItem;
      if ($scope.historyIndex == -1) {
        $scope.MaterialLists.push($rootScope.Wxmaterials);
      } else {
        $scope.MaterialLists[$scope.historyIndex] = $rootScope.Wxmaterials;
      }

      console.log($scope.MaterialLists);
    };
    $scope.save = function () {
      if (!$scope.MaterialLists.length) {
        return alert('消息不可为空，请添加消息');
      }
      var matchType = $('#select').find('option[selected]').val();
      $('#submit').attr('disabled', 'disabled');
      $.ajax({
        type: "POST",
        url: $scope.url,
        data: $scope.model ? $scope.model : {reply_ids: $scope.MaterialLists},
        dataType: "json",
        success: function (msg) {
          $('#submit').removeAttr('disabled');
          wsh.successback(msg, '提交成功', false, function () {
            window.location.href = 'default-reply-edit';
          });
        },
        error: function () {
          $('#submit').removeAttr('disabled');
          alert('服务器忙');
        }
      });
    }
    $scope.Delete = function (index) {
      dialog({
        zIndex: 9999998,
        title: "删除提示",
        content: "确定要删除该消息吗？",
        okValue: "删除",
        ok: function () {
          $scope.MaterialLists.splice(index, 1);
          $scope.$apply();
        },
        otherBtnValue: "取消",
        otherBtn: function () {
        }
      }).width(320).showModal()
    };
  });
</script>