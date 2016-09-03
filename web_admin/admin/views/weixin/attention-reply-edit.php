<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '编辑关注后回复';
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
          <li>编辑关注后回复</li>
        </ul>
        <!-- .breadcrumb -->
        <!-- #nav-search -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="space-10"></div>
          <div class="col-sm-12 floatnone">
            <div class="col-sm-6">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="weiright-td ">
                <tr>
                  <td colspan="2" valign="top" class="no-padding">
                    <h4 class="header smaller lighter blue no-margin-bottom"><span
                        class="badge badge-danger"></span> 设置回复规则</h4>
                  </td>
                </tr>
                <tr>
                  <td align="right" class="width101 " valign="middle"><span class="red">*</span> 规则名
                  </td>
                  <td><input type="text" class="col-sm-4" placeholder="关注后自动回复" value="关注后自动回复"
                             readonly="readonly"></td>
                </tr>
                <!--<tr>
                  <td align="right" valign="top"><span class="red">*</span> 发送方式</td>
                  <td><select>
                      <option value="随机发送一条" selected="">随机发送一条</option>
                      <option value="全部发送">全部发送</option>
                    </select></td>
                </tr>-->
              </table>
            </div>
            <div class="col-sm-6">
              <table width="100%" border="0" cellspacing="0" cellpadding="0"
                     class="weiright-td tjhf">
                <tr class="no-border">
                  <td colspan="2" valign="top" class="no-border no-padding">
                    <h4 class="header smaller lighter blue no-margin-bottom"><span
                        class="badge badge-danger"></span> 添加回复消息</h4>
                  </td>
                </tr>
                <tr ng-repeat="list in MaterialLists track by $index" ng-cloak>
                  <td valign="top" ng-class="{true: 'zdhf'}[list.desc == '语音']">
                    {{$index+1 +'、'}}
                    <div class="inline align-top width90">
                      <div class="margin-bottom5 text-overflow">
                        <span class="label label-sm label-primary weibq margin-right5"
                              ng-bind="list.desc"></span><strong>{{list.title}}</strong>
                      </div>
                      <a class="table-width"
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
                    <a ng-if="$root.hasPermission('weixin/attention-reply-edit')"
                       class="blue pointer" ng-click="history($index)" data-rel="tooltip"
                       data-placement="right" data-toggle="modal" data-target="#insertMaterial"
                       title="编辑"> <i class="icon-bianji bigger-130"></i></a>
                    <a class="red pointer" data-rel="tooltip" data-placement="right" title="删除"
                       ng-click="Delete($index)">
                      <i class="icon-shanchu bigger-140"></i></a></td>
                </tr>
                <tr>
                  <td valign="top" colspan="2" class="no-border text-right">
                    <a class="btn btn-primary" data-toggle="modal" data-target="#insertMaterial"
                       ng-click="restHistory()" ng-show="MaterialLists.length < 5"> 添加一条消息 </a>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="modal-footer margin-auto" id="modal-footer"><a class="btn btn-primary"
                                                                     ng-click="save()"> 确定 </a>
          </div>
        </div>
        <!-- /.col -->
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
      <div
        class="modal-body"> <?php echo $this->render('@app/views/wxmaterial/index.php'); ?> </div>
      <div class="modal-footer no-margin-top"><a data-bb-handler="cancel" class="btn btn-default"
                                                 data-dismiss="modal">取消</a> <a
          data-bb-handler="confirm" class="btn btn-primary" ng-click="$root.getWxmaterials()">确定</a>
      </div>
    </div>
  </div>
</div>
<script language="javascript" type="text/javascript"
        src="/ace/js/jquery.slimscroll.min.js"></script>
<script type="text/javascript">
  jQuery(function ($) {
    $('.slim-scroll').each(function () {
      var $this = $(this);
      $this.slimScroll({
        height: $this.data('height') || 100,
        railVisible: true
      });
    });
  })
</script>
<script type="text/javascript">
  $(".dtw_tu").click(function () {
    $(this).addClass("dtwplay");
    setTimeout(function () {
      $(".dtw_tu").removeClass("dtwplay");
    }, 5000);
  });
</script>
<script>
  app.controller('mainController', function ($scope, $http, $rootScope, $timeout) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'bb');
    }, 100);
    $http.post("/weixin/attention-reply-get-ajax", {})
      .success(function (msg) {
        wsh.successback(msg, '', false, function () {
          $scope.model = msg.errmsg;
          console.log('$scope.model', $scope.model);
          if (!$.isEmptyObject($scope.model)) {
            $scope.MaterialLists = $scope.model.reply_ids || [];
            console.log($scope.model);
            $scope.url = '/weixin/attention-reply-edit-ajax';
          } else {
            $scope.url = '/weixin/attention-reply-add-ajax';
            $scope.MaterialLists = [];
          }
        });
      });

    $scope.historyIndex = -1;
    $scope.history = function (index) {
      $scope.historyIndex = index;
    };
    $scope.restHistory = function (event) {
      $scope.historyIndex = -1;
    };
    $rootScope.getWxmaterials = function () {
      if ($.isEmptyObject($rootScope.Wxmaterials)) return alert('请选择素材');
      $('#insertMaterial').modal('toggle');
//		$rootScope.Wxmaterials.wxImagetxtReplyItems = [];
//		$rootScope.Wxmaterials.wxImagetxtReplyItems[0] = $rootScope.Wxmaterials.wxImagetxtItem;
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
      $('#submit').attr('disabled', 'disabled');

      $.ajax({
        type: "POST",
        url: $scope.url,
        data: {reply_ids: $scope.MaterialLists, id: $scope.model.id},
        dataType: "json",
        success: function (msg) {
          $('#submit').removeAttr('disabled');
          wsh.successback(msg, '提交成功', false, function () {
            window.location.href = 'attention-reply-edit';
          });
        },
        error: function () {
          $('#submit').removeAttr('disabled');
          alert('服务器忙');
        }
      });
    }
    $scope.Delete = function (index) {
      wsh.setNoAjaxDialog('删除提示', '您确定要删除该消息？', function () {
        $scope.MaterialLists.splice(index, 1);
        $scope.$apply();
      });
    };

  });
</script>