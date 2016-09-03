<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '添加关键字';
?>

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
          <li>添加关键字</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="space-10"></div>
          <div class="col-sm-12 floatnone">
            <form name="myform" novalidate="novalidate">
              <div class="col-sm-6">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="weiright-td ">
                  <tr>
                    <td colspan="2" valign="top" class="no-padding">
                      <h4 class="header smaller lighter blue no-margin-bottom">
                        <span class="badge badge-danger"></span> 设置关键词</h4>
                    </td>
                  </tr>
                  <tr>
                    <td align="right" class="width101 " valign="middle"><span class="red">*</span>
                      关键字
                    </td>
                    <td><input type="text" class="col-sm-4" name="name" ng-model="name"
                               required="required" ng-maxlength="50">
                      <span class="inline red padding5"
                            ng-show="myform.name.$error.required && istrue">必填项</span>
                      <span class="inline red padding5"
                            ng-show="myform.name.$error.maxlength">字符过多</span>
                      <span class="inline text-muted padding5">规则文字长度不超过50个字</span></td>
                  </tr>

                  <tr>
                    <td align="right" valign="middle">发送方式</td>
                    <td>
                      <input type="text" class="col-sm-4" readonly="readonly" value="随机发送一条">
                    </td>
                  </tr>
                  <tr>
                    <td align="right" valign="middle"><span class="red">*</span> 匹配方式</td>
                    <td><select ng-model="match_type"
                                ng-options="o.id as o.name for o in matchSelect">
                      </select></td>
                  </tr>
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
                  <tr ng-repeat="list in MaterialLists track by $index">
                    <td valign="top" ng-class="{true: 'zdhf'}[list.desc == '语音']">
                      {{$index+1 +'、'}}
                      <div class="inline align-top width90">
                        <div class="margin-bottom5 text-overflow">
                          <span class="label label-sm label-primary weibq margin-right5"
                                ng-bind="list.desc"></span>
                          <strong>{{list.title}} </strong>
                        </div>
                        <a ng-bind-html="list.reply_content | sysface | trust:'html'"
                           ng-if="list.desc == '文本'"></a>

                        <div class="dtw_tu" ng-if="list.desc == '语音'"></div>
                        <span ng-if="list.desc == '语音'">4"</span>
                        <img ng-src="{{list.cdn_path}}" class="align-top" width="45" height="45"
                             ng-if="list.desc == '图片'">
                        <img ng-src="{{list.wxImagetxtReplyItems[0].cdn_path}}" class="align-top"
                             width="45" height="45" ng-if="list.desc == '图文'">
                      </div>
                    </td>
                    <td class="visible-md visible-lg hidden-sm hidden-xs action-buttons width-60px">
                      <a class="blue pointer" ng-click="history($index)" data-toggle="modal"
                         data-target="#insertMaterial" title="编辑"> <i
                          class="icon-bianji bigger-130"></i></a>
                      <a class="red pointer" title="删除" ng-click="Delete($index)"> <i
                          class="icon-shanchu bigger-130"></i></a></td>
                  </tr>
                  <tr>
                    <td valign="top" colspan="2" class="no-border text-right">
                      <a class="btn btn-primary" data-toggle="modal" data-target="#insertMaterial"
                         ng-click="restHistory($event)" ng-show="MaterialLists.length < 5">
                        添加一条消息 </a>
                    </td>
                  </tr>
                </table>
              </div>
            </form>
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
     aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog6">
    <div class="modal-content">
      <div class="modal-header modal-header2"><a href="#" class="bootbox-close-button close"
                                                 data-dismiss="modal">×</a>
        <h4 class="modal-title">选择素材</h4>
      </div>
      <div class="modal-body">
        <?php echo $this->render('@app/views/wxmaterial/index.php'); ?>
      </div>
      <div class="modal-footer no-margin-top">
        <a data-bb-handler="cancel" class="btn btn-default" data-dismiss="modal">取消</a>
        <a data-bb-handler="confirm" class="btn btn-primary"
           ng-click="$root.getWxmaterials()">确定</a></div>
    </div>
  </div>
</div>
<script>
  app.controller('mainController', function ($scope, $http, $rootScope, $timeout) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'bb');
    }, 100);
    $scope.istrue = false;
    $scope.name = '';
    $scope.MaterialLists = [];
    $scope.historyIndex = -1;
    $scope.matchSelect = [{id: 1, name: '完全匹配'}, {id: 2, name: '包含匹配'}];
    $scope.match_type = 1;
    $scope.history = function (index) {
      $scope.historyIndex = index;
    };
    $scope.restHistory = function (event) {
      $scope.historyIndex = -1;
    };
    $rootScope.getWxmaterials = function () {

      if ($.isEmptyObject($rootScope.Wxmaterials)) return alert('请选择素材');
      $('#insertMaterial').modal('toggle');
      if ($scope.historyIndex == -1) {
        $scope.MaterialLists.push($rootScope.Wxmaterials);
      } else {
        $scope.MaterialLists[$scope.historyIndex] = $rootScope.Wxmaterials;
      }
    };
    $scope.save = function () {
      if ($scope.myform.$invalid) {
        $scope.istrue = true;
        return $timeout(function () {
          $scope.istrue = false;
        }, 3000);
      }
      if (!$scope.MaterialLists.length) {
        return alert('消息不可为空，请添加消息');
      }
      $('#submit').attr('disabled', 'disabled');
      $.ajax({
        type: "POST",
        url: "/weixin/keyword-reply-add-ajax",
        data: {
          keyword: $scope.name,
          reply_ids: $scope.MaterialLists,
          match_type: $scope.match_type
        },
        dataType: "json",
        success: function (msg) {
          $('#submit').removeAttr('disabled');
          wsh.successback(msg, '提交成功', false, function () {
            window.location.href = 'keyword-reply-list';
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