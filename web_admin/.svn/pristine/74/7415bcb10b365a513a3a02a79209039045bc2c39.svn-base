<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '回复管理';
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
          <li>回复管理</li>
        </ul>
        <!-- .breadcrumb -->
        <!-- #nav-search -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <!--操作栏-->
            <div class="clearfix no-padding">
              <div class="col-sm-7 no-padding">
                <ul class="listli left-space1 btn-primary bune float-left">
                  <li><a ng-if="$root.hasPermission('weixin/keyword-reply-add')"
                         href="/weixin/keyword-reply-add" class="btn btn-xs btn-primary tian">新建关键词回复</a>
                  </li>
                </ul>
              </div>
              <div class="col-sm-5 no-padding">
                <div class="col-sm-12 float-right no-padding">
                  <div class="float-right">
                    <div class="input-group float-left">
                      <input class="min-width120 float-left" placeholder="搜索消息相关关键字" type="text"
                             ng-model="searchKeyword">
                      <span class="float-left"> <a ng-click="getImage(1)"
                                                   class="btn btn-xs btn-primary margin_right1"><i
                            class="icon-search icon-on-right bigger-110"></i></a> </span></div>
                  </div>
                </div>
              </div>

            </div>
            <!--/操作栏-->
            <div class="tabbable">
              <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a ng-if="$root.hasPermission('weixin/keyword-reply-list')"
                                      href="/weixin/keyword-reply-list">关键词回复</a></li>
                <li><a ng-if="$root.hasPermission('weixin/default-reply-edit')"
                       href="/weixin/default-reply-edit">默认回复</a></li>
                <li><a ng-if="$root.hasPermission('weixin/attention-reply-edit')"
                       href="/weixin/attention-reply-edit">关注后回复</a></li>
              </ul>
              <div class="tab-content col-xs-12 clearfix">
                <div id="home" class="tab-pane active">
                  <!--关键字回复-->

                  <div id="main" role="main" class="clearfix">
                    <div class="space-6"></div>
                    <div class=" margin-auto">
                      <ul class="tiles text-left padding-left10 clearfix">
                        <li ng-repeat="list in model" style="display:block;"
                            class="inline align-top margin-right10 margin-bottom10">
                          <div class="wpb text-center"><b
                              class="blue padding-right6 font-size14 text-center text-overflow"
                              title="{{list.keyword}}">{{'关键字：' + list.keyword | limitTo:
                              15}}{{list.keyword.length > 15 ? '...' : ''}}</b>

                            <div class="float-right">
                              <label>
                                <input
                                  ng-disabled="!$root.hasPermission('weixin/keyword-reply-open-ajax')"
                                  class="ace ace-switch ace-switch-6" ng-model="list.ischoose"
                                  type="checkbox" ng-change="change(list, $index)"
                                  ng-disabled="list.isdisabled">
                                <span class="lbl"></span> </label>
                            </div>
                          </div>
                          <div class="wpb font-size14"><b>随机回复一条消息</b></div>
                          <div class="wpb" ng-repeat="listChild in list.reply_ids track by $index">
                            <span
                              class="label label-sm label-primary weibq margin-right5 float-left"
                              ng-bind="listChild.desc"></span> <img ng-src="{{listChild.cdn_path}}"
                                                                    class="stou" width="45"
                                                                    ng-if="listChild.desc == '图片'">
                            <img ng-src="{{listChild.wxImagetxtReplyItems[0].cdn_path}}"
                                 class="stou" width="45" ng-if="listChild.desc == '图文'"> <span
                              class="inline margin-left5" ng-bind="listChild.title"></span></div>
                          <div
                            class="visible-md visible-lg hidden-sm hidden-xs action-buttons weicb">
                          	<span class="inline width50 tw_btn">
                          		<a class="block blue pointer"
                                 ng-if="$root.hasPermission('weixin/keyword-reply-edit')"
                                 data-rel="tooltip"
                                 href="{{'/weixin/keyword-reply-edit?id=' + list.id}}" title="编辑">
                                <i class="icon-bianji bigger-130"></i> </a>
                          	</span>
                            <span class="inline width50 tw_btn">  
                              <a class="block red pointer"
                                 ng-if="$root.hasPermission('weixin/keyword-reply-del-ajax')"
                                 data-rel="tooltip" title="删除" ng-click="Delete($index)"> <i
                                  class="icon-shanchu bigger-140"></i> </a>
                            </span>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="red text-center" ng-show="!model.length" ng-cloak>暂时没有可显示的数据</div>
                    <div ng-paginate options="options" page="page"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.main-container-inner -->
  </div>
</div>
<script>
  app.controller('mainController', function ($scope, $http, $rootScope, $timeout) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'bb');
    }, 100);

    $scope.getImage = function (int) {
      $.post('/weixin/keyword-reply-list-ajax', {
        '_page': int,
        '_page_size': 10,
        'keyword': $scope.searchKeyword,
        'search_type': 1
      }, function (msg) {
        wsh.successback(msg, '', false, function () {
          if (msg.errmsg.data.length == 0)
            $scope.empty = true, $scope.$apply();
          $scope.model = msg.errmsg.data;
          $.each($scope.model, function (i, e) {
            e.ischoose = e.deleted == 1 ? true : false;
            e.isdisabled = false;
          });
          $scope.page = msg.errmsg.page;
          $scope.keyword = msg.errmsg.keyword;
          $scope.$apply();
        });
      }, 'json');
    };

    $scope.getImage(1);

    $scope.options = {callback: $scope.getImage};
    $scope.change = function (obj) {
      obj.isdisabled = true;
      if (obj.ischoose) {
        $.post('/weixin/keyword-reply-open-ajax', {id: obj.id}, function (msg) {
          wsh.successback(msg, '启用成功', false, function () {
            obj.isdisabled = false;
            $scope.$apply();
          });
        }, 'json');
      } else {
        $.post('/weixin/keyword-reply-close-ajax', {id: obj.id}, function (msg) {
          wsh.successback(msg, '禁用成功', false, function () {
            obj.isdisabled = false;
            $scope.$apply();
          });
        }, 'json');
      }
    };

    //右上侧搜索设置问题
    $scope.searchKeyword = '';
    $scope.Delete = function (index) {
      wsh.setDialog('删除提示', '确实要删除该消息吗？', '/weixin/keyword-reply-del-ajax', {id: $scope.model[index].id}, function () {
        $scope.getImage(1);
      }, '删除成功');
    };
  });
</script>