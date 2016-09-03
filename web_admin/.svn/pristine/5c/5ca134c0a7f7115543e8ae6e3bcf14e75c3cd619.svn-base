<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '自定义菜单';
?>
<link rel="stylesheet" type="text/css" href="/ace/style/wx_menu/wxmenu.css">
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <div
    class="main-container-inner"> <?php echo $this->render('@app/views/side/weixin_setting.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
          <li> 自定义菜单</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="space-6 clearfix"></div>
            <!--左边的手机区域开始了-->
            <div class="mobile_preview col-sm-push-1 col-sm-3">
              <div class="mobile_preview_hd">
                <strong class="nickname">微信公众账号</strong>
              </div>
              <div class="mobile_preview_bd">
                <ul id="viewShow" class="show_list">
                </ul>
              </div>
              <div class="mobile_preview_ft">
                <ul class="pre_menu_list clearfix">
                  <li class="pre_menu_item grid_item" ng-repeat="list in models">
                    <a href="javascript:void(0);" class="pre_menu_link" title="菜单1.0">
                      <i class="icon_menu_dot"></i>
                      <span ng-bind="list.parents.menuname"></span>
                    </a>

                    <div class="sub_pre_menu_box" ng-show="list.child.length">
                      <ul class="sub_pre_menu_list no-margin no-padding">
                        <li ng-repeat="listChild in list.child"><a
                            ng-bind="listChild.menuname"></a>
                        </li>
                      </ul>
                      <i class="arrow arrow_out"></i>
                      <i class="arrow arrow_in"></i>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <!-- 右边内容区域  -->
            <div class="tabbable col-sm-push-1 col-sm-7">
              <p class="menu_setting_tips">可创建最多3个一级菜单，每个一级菜单下可创建最多5个二级菜单。</p>
              <!--商品活动列表-->
              <div class="table-responsive wxmenumain clearfix">
                <div class="wxmenu_cont clearfix">
                  <div class="wxmenu_left" style="min-height:490px">
                    <form name="myform" novalidate="novalidate">
                      <div class="wxmenu_side_nav clearfix">
                        <h1 class="float-left"><span
                            class="icon-file margin-right5 grey"></span>菜单管理
                        </h1>

                        <div class="opr_wrp text-right">
                          <a ng-click="addParent($event)"
                             ng-show="$root.hasPermission('weixin/diymenu-add-parents-ajax')"
                             ng-show="models.length < 3" title="添加一级菜单" data-rel="tooltip"
                             class="icon-plus margin-right5 align-middle"
                             style="display: inline-block; cursor:pointer; ">添加</a>
                        </div>
                      </div>
                      <div class="wxmenu_navlist">
                        <div ng-sortable="options" style="position: relative !important;">
                          <div class="dl" ng-repeat="list in models"
                               pid="{{list.parents.id}}">
                            <div class="dt">
                              <a class="pointer"
                                 ng-click="editParentObj(list, $event)">
                                <em class="icon-caret-right margin-right3"></em>
                                <span ng-bind="list.parents.menuname"></span>
                                <i class="icon-trash"
                                   ng-show="$root.hasPermission('weixin/diymenu-del-ajax')"
                                   ng-click="deleteParents($index, $event)"
                                   data-rel="tooltip"
                                   data-title="删除"></i>
                                <i class="icon-plus"
                                   ng-show="$root.hasPermission('weixin/diymenu-add-ajax')"
                                   ng-show="list.child.length < 5"
                                   ng-click="addChild(list, $index, $event)"
                                   data-rel="tooltip"
                                   data-title="设置动作"></i>
                              </a>
                            </div>
                            <div ng-sortable="list.options"
                                 style="position: relative !important;">
                              <div class="dd"
                                   ng-repeat="listChild in list.child">
                                <a ng-click="editChildObj(listChild, $event)"
                                   class="pointer">
                                  <span ng-bind="listChild.menuname"></span>
                                  <i ng-show="$root.hasPermission('weixin/diymenu-del-ajax')"
                                     class="icon-trash"
                                     ng-click="deleteChild(list.child, $index, $event)"
                                     data-rel="tooltip" data-title="删除"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- 动作面板  -->
                  <div class="wxmenu_right" ng-show="obj.menu_type">
                    <form class="form-horizontal" name="myform" novalidate="novalidate">
                      <div class="wxmenu_side_nav clearfix">
                        <h1 class="float-left"><span class="icon-cog margin-right5 grey"></span>设置动作<span
                            style="color:gray; font-size: 12px;"
                            ng-bind="setStatus()"></span>
                        </h1>
                      </div>
                      <div class="wxmenu_main">
                        <div class="wxmenu_null" ng-show="obj.menu_type">
                          <!-- 设置名称  -->
                          <div class="form-group">
                            <label for="menuname"
                                   class="col-sm-2 control-label">菜单名称：</label>

                            <div class="col-sm-10">
                              <input type="text" class="form-control"
                                     ng-disabled="!$root.hasPermission('weixin/diymenu-edit-ajax')"
                                     ng-model="obj.menuname">

                              <p class="grey font-size12 margin-top5 margin-bottom5"
                                 ng-show="status === 1 || status === 3">一级菜单只能输入4个汉字或者8个字符</p>

                              <p class="grey font-size12 margin-top5 margin-bottom5"
                                 ng-hide="status === 1 || status === 3">二级菜单只能输入7个汉字或者14个字符</p>
                            </div>
                          </div>
                          <!-- 设置动作  -->
                          <div ng-show="!obj.childLength">
                            <div class="form-group">
                              <label class="col-sm-2 control-label">点击设置：</label>

                              <div class="col-sm-10">
                                <select class="form-control"
                                        ng-disabled="!$root.hasPermission('weixin/diymenu-edit-ajax')"
                                        ng-change="changeAnimate()"
                                        ng-model="selectAnimate">
                                  <option ng-repeat="o in selectAnimateD"
                                          value="{{o.id}}"
                                          ng-bind="o.name"
                                          ng-selected="o.id==selectAnimate"></option>
                                </select>

                                <p class="grey font-size12 margin-top5 margin-bottom5">
                                  请设置动作后进行保存</p>
                              </div>
                            </div>
                            <!-- 素材  -->
                            <div class="form-group" ng-show="selectAnimate == 1">
                              <label class="col-sm-2 control-label">点击回复：</label>

                              <div class="col-sm-10 ">
                                <p class="form-control-static sucai_name action-buttons clearfix">
                                  <span><span class="inline bg-primary"
                                              ng-show="obj.menu_url[0].desc=='图文'"
                                              ng-bind="obj.menu_url[0].desc || ''"></span></span>
                                  <a ng-show="$root.hasPermission('weixin/diymenu-edit-ajax')"
                                     class="sucai_edit pointer float-right"
                                     data-toggle="modal"
                                     data-target="#insertMaterial"
                                     ng-click="showHref = false"
                                     title="编辑">
                                    <i class="icon-pencil blue bigger-160 "></i>
                                  </a>
                                </p>

                                <h3 class="diymenu_title" class="text-overflow"
                                    ng-bind="obj.menu_url && obj.menu_url[0].title || ''">
                                  989</h3>
                                <span class="text-muted"
                                      ng-show="obj.menu_url[0].desc == '图文' || obj.menu_url[0].desc == '图片'"
                                      ng-bind="obj.menu_url && (obj.menu_url[0].modified*1000 | date: 'yyyy-MM-dd HH:mm:ss') ">2015-10-14 16:35:36</span>

                                <div class="sucai_add"
                                     ng-show="obj.menu_url[0].desc == '图文' || obj.menu_url[0].desc == '图片'">
                                  <img
                                    class="create_access_primary no-underline pointer"
                                    style="padding-top: 0;"
                                    ng-show="obj.menu_url[0].cdn_path"
                                    ng-src="{{obj.menu_url[0].cdn_path}}"/>
                                  <img
                                    class="create_access_primary no-underline pointer"
                                    style="padding-top: 0;"
                                    ng-show="obj.menu_url[0].wxImagetxtItem.cdn_path"
                                    ng-src="{{obj.menu_url[0].wxImagetxtItem.cdn_path}}"/>
                                  <img
                                    class="create_access_primary no-underline pointer"
                                    style="padding-top: 0;"
                                    ng-show="obj.menu_url[0].wxImagetxtReplyItems[0].cdn_path"
                                    ng-src="{{obj.menu_url[0].wxImagetxtReplyItems[0].cdn_path}}"/>
                                </div>
                              </div>
                            </div>
                            <!-- 模块  -->
                            <div class="form-group" ng-show="selectAnimate == 2">
                              <label class="col-sm-2 control-label">点击回复：</label>

                              <div class="col-sm-10 ">
                                <p class="form-control-static mokuai_name action-buttons clearfix">
                                  <span
                                    class="inline" ng-show="obj.menu_url[0].type">模块类型：<span
                                      ng-bind="setTitle(obj.menu_url[0].type)"></span></span>
                                  <a ng-show="$root.hasPermission('weixin/diymenu-edit-ajax')"
                                     class="sucai_edit pointer float-right"
                                     data-toggle="modal"
                                     data-target="#activityModal"
                                     ng-click="showHref = false"
                                     title="编辑">
                                    <i class="icon-pencil blue bigger-160 "></i></a>
                                </p>

                                <div
                                  ng-show="obj.menu_url[0].type == 1 ||  obj.menu_url[0].type == 2 || obj.menu_url[0].type == 3 || obj.menu_url[0].type == 4 || obj.menu_url[0].type == 5 || obj.menu_url[0].type == 6 || obj.menu_url[0].type == 7">
                                  <h3
                                    ng-show="obj.menu_url[0].type == 1 ||  obj.menu_url[0].type == 2 || obj.menu_url[0].type == 3 || obj.menu_url[0].type == 5 || obj.menu_url[0].type == 7"
                                    ng-bind="obj.menu_url[0].name"></h3>

                                  <h3 ng-show="obj.menu_url[0].type == 4"
                                      ng-bind="obj.menu_url[0].title"></h3>

                                  <h3 ng-show="obj.menu_url[0].type == 6"
                                      ng-bind="obj.menu_url[0].activity_name"></h3>
                                <span class="text-muted"
                                      ng-show="obj.menu_url[0].start_time ||obj.menu_url[0].begin_time">
                                  <span
                                    ng-bind="obj.menu_url[0].start_time * 1000 || obj.menu_url[0].begin_time * 1000 | date: 'yyyy-MM-dd HH:mm:ss'"></span> 至
                                  <span
                                    ng-bind="obj.menu_url[0].end_time * 1000 | date: 'yyyy-MM-dd HH:mm:ss'"></span>
                                </span>

                                  <div class="sucai_add"
                                       ng-show="obj.menu_url[0].type == 2 || obj.menu_url[0].type == 3 || obj.menu_url[0].type == 4 || obj.menu_url[0].type == 6 || obj.menu_url[0].type == 7">
                                    <img
                                      ng-show="obj.menu_url[0].news.wxImagetxtReplyItems[0].documentLib.file_cdn_path || obj.menu_url[0].cdn_path"
                                      class="create_access_primary no-underline pointer"
                                      style="padding-top: 0;"
                                      ng-src="{{obj.menu_url[0].news.wxImagetxtReplyItems[0].documentLib.file_cdn_path || obj.menu_url[0].cdn_path}}">
                                  </div>
                                  <div class="sucai_add"
                                       ng-show="obj.menu_url[0].type == 5">
                                    <img
                                      ng-show="obj.menu_url[0].news.wxImagetxtReplyItems[0].documentLib.file_cdn_path"
                                      class="create_access_primary no-underline pointer"
                                      style="padding-top: 0;"
                                      ng-src="{{obj.menu_url[0].news.wxImagetxtReplyItems[0].documentLib.file_cdn_path }}">
                                  </div>
                                </div>
                                <div ng-show="obj.menu_url[0].type == 8">
                                  <h3 ng-bind="obj.menu_url[0].news.title"></h3>
                                <span class="text-muted" ng-show="obj.menu_url[0].begin_time">
                                  <span
                                    ng-bind="obj.menu_url[0].begin_time * 1000 | date: 'yyyy-MM-dd HH:mm:ss'"></span> 至
                                  <span
                                    ng-bind="obj.menu_url[0].end_time * 1000 | date: 'yyyy-MM-dd HH:mm:ss'"></span></span>

                                  <div class="sucai_add"
                                       ng-show="obj.menu_url[0].cardTypeInfo.logo_url">

                                    <img class="create_access_primary no-underline pointer"
                                         style="padding-top: 0;"
                                         ng-src="{{obj.menu_url[0].cardTypeInfo.logo_url }}">
                                  </div>
                                </div>
                                <div ng-show="obj.menu_url[0].type == 9">
                                  <h3 ng-bind="obj.menu_url[0].news.title"></h3>
                                <span class="text-muted" ng-show="obj.menu_url[0].start_time">
                                  <span
                                    ng-bind="obj.menu_url[0].start_time * 1000 | date: 'yyyy-MM-dd HH:mm:ss'"></span> 至
                                  <span
                                    ng-bind="obj.menu_url[0].end_time * 1000 | date: 'yyyy-MM-dd HH:mm:ss'"></span>
                                </span>

                                  <div class="sucai_add"
                                       ng-show="obj.menu_url[0].news.wxImagetxtReplyItems[0].documentLib.file_cdn_path">

                                    <img
                                      class="create_access_primary no-underline pointer"
                                      style="padding-top: 0;"
                                      ng-src="{{obj.menu_url[0].news.wxImagetxtReplyItems[0].documentLib.file_cdn_path}}">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- 链接  -->
                            <div class="form-group" ng-show="selectAnimate == 3">
                              <label class="col-sm-2 control-label">链接内容：</label>

                              <div class="col-sm-10 ">
                                <input type="hidden" class="form-control">
                                <select
                                  ng-disabled="!$root.hasPermission('weixin/diymenu-edit-ajax')"
                                  class="form-control"
                                  ng-change="changeHref()"
                                  ng-model="hrefSelected">
                                  <option ng-repeat="o in hrefSelect" value="{{o.id}}"
                                          ng-bind="o.name"
                                          ng-selected="o.id==hrefSelected"></option>
                                </select>
                                <input
                                  ng-disabled="!$root.hasPermission('weixin/diymenu-edit-ajax')"
                                  type="url" ng-show="hrefSelected == 7"
                                  ng-model="obj.menu_url"
                                  class="form-control margin-top5" name="url" required
                                  placeholder="请输入完整的url地址,例:http://">

                                <p class="grey font-size12 margin-top5">
                                  订阅者点击后，会跳到以上链接</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="wxmeun_bot">
                  <p class="menu_msg red" style="display:none">待发布(还有13小时)</p>

                  <p class="menu_msg green" style="display:none">菜单正在使用中</p>

                  <p class="menu_tips">编辑中的菜单需要进行发布才能更新到用户手机上</p>
                </div>
              </div>
              <!--商品活动列表-->
              <div class="text-center margin-top20">
                <a ng-disabled="!$root.hasPermission('weixin/diymenu-edit-ajax')"
                   ng-click="btnSave()" class="btn btn-primary width-160px">仅保存</a>
                <a ng-show="$root.hasPermission('weixin/diymenu-publish-ajax')"
                   class="btn btn-success width-160px" ng-click="publish()">保存并发布</a>
              </div>
            </div>
          </div>
        </div>
        <div class="space-32 clearfix"></div>
      </div>
    </div>
  </div>
  <div class="bootbox modal fade in" id="insertMaterial" tabindex="-1" role="dialog"
       open-close-modal
       aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog6">
      <div class="modal-content">
        <div class="modal-header modal-header2">
          <a class="bootbox-close-button close" data-dismiss="modal">×</a>
          <h4 class="modal-title">选择素材</h4>
        </div>
        <div
          class="modal-body"> <?php echo $this->render('@app/views/wxmaterial/index.php'); ?> </div>
        <div class="modal-footer no-margin-top">
          <a class="btn btn-default" data-dismiss="modal">取消</a>
          <a class="btn btn-primary" ng-click="$root.getWxmaterials()">确定</a>
        </div>
      </div>
    </div>
  </div>
  <div class="bootbox modal fade in" id="dd" tabindex="-1" role="dialog" open-close-modal
       aria-labelledby="myModalLabel"
       aria-hidden="true">
    <div class="modal-dialog">
      <div class="alert alert-light alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">×</span></button>
        <h3>发布成功!</h3>

        <p>24小时内会对用户菜单进行更新；或者用户重新关注公众号即可查看</p>
      </div>
    </div>
  </div>
  <?php echo $this->render('@app/views/uploadImg/activityIndex.php'); ?>
</div>
<script src="/ace/js/ng-sortable/Sortable.min.js"></script>
<script src="/ace/js/ng-sortable/ng-sortable.js"></script>
<script>
  (function () {
    'use strict';
    app.requires.push('ng-sortable');
    app.controller('mainController', function ($scope, $rootScope, $http, $timeout) {

      $timeout(function () {
        $rootScope.$broadcast('leftMenuChange', 'bc');
      }, 100);

      var data = JSON.parse('<?= addslashe(json_encode($model)); ?>') ? JSON.parse('<?= addslashe(json_encode($model)); ?>') : {};//后台返回的菜单信息
      var arr = [];//临时数据
      $.each(data, function (key, value) {
        value.child = value.child || [];
        //二级菜单拖拽配置项
        value.options = {animation: 150};
        value.options.draggable = '.dd';
        arr.push(value);
      });
      $scope.models = angular.copy(arr);//菜单树对象

      //一级菜单拖拽配置项
      $scope.options = {animation: 150};
      $scope.options.draggable = '.dl';
      $scope.selectAnimate = 0;//动作
      $scope.hrefSelected = 0;//链接
      $scope.status = 0; //状态码  1为添加父级 2为添加子级 3为编辑父级 4为编辑子级
      $scope.obj = -1;//当前操作的对象

      //动作选项值
      $scope.selectAnimateD = [
        {id: 0, name: '请选择一个动作'},
        {id: 1, name: '点击后回复素材'},
        {id: 2, name: '点击后回复模块'},
        {id: 3, name: '点击后打开链接'}
      ];

      //动作改变事件
      $scope.changeAnimate = function () {
        switch ($scope.selectAnimate) {
          case '1':
            $('#insertMaterial').modal('show');
            $scope.obj.menu_type = 1;
            break;
          case '2':
            $('#activityModal').modal('show');
            $scope.obj.menu_type = 2;
            break;
          case '3':
            $scope.hrefSelected = -1;
            $scope.obj.menu_type = 3;
            break;
          default:
            $scope.obj.menu_type = -1;
            break;
        }
      };

      //链接选项值
      $scope.hrefSelect = [
        {id: -1, name: '请选择关联地址', type_url: ''},
        {id: 0, name: '微商城首页', type_url: '/mall/index'},
        {id: 1, name: '微商城商品列表', type_url: '/product/category'},
        {id: 2, name: '微商城惊喜', type_url: '/surprise/index'},
        {id: 3, name: '微商城购物车', type_url: '/cart/index'},
        {id: 4, name: '微商城个人中心', type_url: '/user/home'},
        {id: 5, name: '微推广', type_url: '/fx/apply'},
        {id: 6, name: '微官网', type_url: '/mall/home'},
        {id: 7, name: '外链接', type_url: ''},
        {id: 8, name: '会员卡', type_url: '/member/user-validate'}
      ];

      //链接改变事件
      $scope.changeHref = function () {
        if ($scope.hrefSelected == -1) return;
        if ($scope.hrefSelected == 7) {
          $scope.obj.menu_url = '';
        } else {
          $scope.obj.menu_url = $scope.hrefSelect[parseInt($scope.hrefSelected) + 1].type_url;
        }
      };

      //状态值转换
      $scope.setStatus = function () {
        if ($scope.status === 1 || $scope.status === 2) return '添加状态';
        if ($scope.status === 3 || $scope.status === 4) return '编辑状态';
      };

      //设置标题
      $scope.setTitle = function (type) {
        type = parseInt(type);
        switch (type) {
          case 2:
            return '点赞活动';
            break;
          case 3:
            return '秒杀活动';
            break;
          case 4:
            return '预约活动';
            break;
          case 5:
            return '红包活动';
            break;
          case 6:
            return '大转盘';
            break;
          case 7:
            return '砸金蛋';
            break;
          case 8:
            return '卡券';
            break;
          case 9:
            return '拼团';
            break;
        }
      };

      //添加一级
      $scope.addParent = function () {
        if (!validation())return;
        if ($scope.models.length >= 3) {
          alert('可创建最多3个一级菜单');
          return;
        }
        $scope.selectAnimate = 0;
        $scope.status = 1;
        $scope.obj = {
          menu_type: 4,
          menuname: '菜单' + ($scope.models.length + 1) + '.0',
          childLength: 0
        };
        $scope.models.push({parents: $scope.obj, child: []});
      };

      //添加二级
      $scope.addChild = function (list, index, event) {
        event.stopPropagation();
        event.preventDefault();
        if (!validation())return;
        if (list.child.length >= 5) {
          alert('每个一级菜单下可创建最多5个二级菜单');
          return;
        }
        $scope.selectAnimate = 0;
        $scope.status = 2;
        $scope.obj = {
          pid: list.parents.id,
          menu_type: 4,
          menuname: '菜单' + (index + 1) + '.' + (list.child.length + 1)
        };
        list.child.push($scope.obj);
      };

      //编辑一级
      $scope.editParentObj = function (obj, event) {
        event.stopPropagation();
        event.preventDefault();
        if (!validation())return;
        $scope.status = 3;
        obj.parents.childLength = obj.child ? obj.child.length : 0;
        $scope.obj = obj.parents;
        setUrl();
      };

      //编辑二级
      $scope.editChildObj = function (obj, event) {
        event.stopPropagation();
        event.preventDefault();
        if (!validation())return;
        $scope.status = 4;
        $scope.obj = obj;
        setUrl();
      };

      //关联模板
      $scope.$on('chooseActivity', function (e, obj, type) {
        $scope.obj.menu_type = 2;
        $scope.obj.menu_url = [];
        $scope.obj.menu_url[0] = obj;
        $scope.obj.menu_url[0].type = type + 1;
      });

      //素材管理
      $rootScope.getWxmaterials = function () {
        if ($.isEmptyObject($rootScope.Wxmaterials)) return alert('请选择素材');
        $('#insertMaterial').modal('toggle');
        $scope.obj.menu_url = [];
        $scope.obj.menu_url[0] = $rootScope.Wxmaterials;
        $scope.obj.menu_type = 1;
      };

      //校验方法
      function validation() {
        var result = true;
        if ($scope.obj !== -1) {
          var nameLen = wsh.getLength($scope.obj.menuname);//获取菜单名的长度
          if ($scope.status === 1 || $scope.status === 3) {//如果是一级菜单
            if (!nameLen || nameLen > 8) {
              result = false;
              alert('一级菜单只能输入4个汉字或者8个字符');
            }
          } else if ($scope.status === 2 || $scope.status === 4) {//如果是二级菜单
            if (!nameLen || nameLen > 14) {
              result = false;
              alert('二级菜单只能输入7个汉字或者14个字符');
            }
          }
          if (!$scope.obj.childLength && result) {
            if ($scope.selectAnimate == 0) {
              result = false;
              alert('请选择一个动作！');
            } else if ($scope.selectAnimate == 1 || $scope.selectAnimate == 2) {
              if (!$scope.obj.menu_url.length || !$scope.obj.menu_url[0].id) {
                result = false;
                alert('请选择回复内容');
              }
            } else if ($scope.selectAnimate == 3) {
              if ($scope.hrefSelected == -1) {
                result = false;
                alert('您没有选择关联地址');
              }
              if ($scope.hrefSelected == 7) {
                if ($scope.myform.url && !$scope.myform.url.$valid) {
                  $scope.obj.menu_url = '';
                  result = false;
                  alert('链接填写错误');
                }
              }
            }
          }
        }
        return result;
      }

      //保存方法
      $scope.btnSave = function () {
        if (!$scope.models.length) return alert('自定义菜单不能为空');
        if (!validation())return;
        $('#loadingBox').show();
        $http.post('/weixin/diymenu-batch-add-ajax', $scope.models)
          .success(function (msg) {
            wsh.successback(msg, '保存成功！', false, function () {
              $('#loadingBox').hide();
            }, function () {
              $('#loadingBox').hide();
            });
          }).error(function () {
            $('#loadingBox').hide();
          });
      };

      //一级删除
      $scope.deleteParents = function (index, event) {
        event.stopPropagation();
        if ($scope.models.length === 1) return alert('自定义菜单不能为空');
        wsh.setNoAjaxDialog('删除提示', '确定该菜单及其子菜单吗?', function () {
          $scope.models.splice(index, 1);
        });
      };

      //二级删除
      $scope.deleteChild = function (arr, index, event) {
        event.stopPropagation();
        wsh.setNoAjaxDialog('删除提示', '确定该菜单吗?', function () {
          arr.splice(index, 1);
        });
      };

      function setUrl() {
        if ($scope.obj.menu_type) {
          //设置动作
          $scope.selectAnimate = $scope.obj.menu_type;
          if ($scope.obj.menu_type === 3) {
            if ($scope.obj.menu_url) {
              switch ($scope.obj.menu_url) {
                case '/mall/index':
                  $scope.hrefSelected = 0;
                  break;
                case '/product/category':
                  $scope.hrefSelected = 1;
                  break;
                case '/surprise/index':
                  $scope.hrefSelected = 2;
                  break;
                case '/cart/index':
                  $scope.hrefSelected = 3;
                  break;
                case '/user/home':
                  $scope.hrefSelected = 4;
                  break;
                case '/fx/apply':
                  $scope.hrefSelected = 5;
                  break;
                case '/mall/home':
                  $scope.hrefSelected = 6;
                  break;
                case '/member/user-validate':
                  $scope.hrefSelected = 8;
                  break;
                default:
                  $scope.hrefSelected = 7;
                  break;
              }
            } else {
              $scope.hrefSelected = -1;
            }
          }
        } else {
          $scope.selectAnimate = 0;
        }
      }

      //发布
      $scope.publish = function () {
        if (!$scope.models.length) return alert('自定义菜单不能为空');
        if (!validation())return;
        $('#loadingBox').show();
        $http.post('/weixin/diymenu-batch-add-ajax', $scope.models)
          .success(function (msg) {
            wsh.successback(msg, null, false, function () {
              $http.post('/weixin/diymenu-publish-ajax')
                .success(function () {
                  $('#loadingBox').hide();
                  alert('发布成功');
                });
            }, function () {
              $('#loadingBox').hide();
            });
          }).error(function () {
            $('#loadingBox').hide();
          });
      };
    });
  })();
</script>