<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '修改图文';
?>
<div class="main-container" ng-controller="addController" ng-cloak>
  <div class="main-container-inner">
    <?php echo $this->render('@app/views/side/weixin_setting.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
          <li>修改微商户图文</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="space-10"></div>

            <div class="weileft col-sm-push-2 col-sm-3">
              <div class="weileftda ">
                <div class="margin-top10 slim-scroll" style="padding-bottom: 10px;">
                  <dl class="duodu no-margin editing" data-height="455">
                    <dt>
                    <div class="imgh3 ">
                      <div class="weibian action-buttons">
                        <a class="pointer" title="编辑" ng-click="selectItem(items[0])"><i
                            class="icon-pencil bigger-130"></i></a>
                      </div>
                      <div class="dbg"></div>
                      <img ng-src="{{items[0].cdn_path}}" ng-show="items[0].cdn_path">
                      <span class="appmsg_thumb default">建议尺寸：900 x 500像素</span>

                      <h3 class="duotu_title text-overflow" ng-bind="items[0].title"></h3>
                    </div>
                    </dt>
                    <dd ng-repeat="item in items" ng-show="$index > 0">
                      <div class="ds">
                        <div class="lbian"></div>
                        <div class="weibian action-buttons">
                          <a class="pointer" title="编辑" ng-click="selectItem(item)"><i
                              class="icon-pencil bigger-130"></i></a>
                          <a class="pointer" title="删除"
                             ng-click="delItem($index)"><i
                              class="icon-trash bigger-130"></i></a>
                        </div>
                        <div class="dbg"></div>
                        <span ng-bind="item.title"></span>
                        <span ng-if="!item.title">标题</span>
                        <img ng-if="item.cdn_path" ng-src="{{item.cdn_path}}">
                        <img ng-if="!item.cdn_path" src="data:image/jpg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA8AAD/4QMraHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjMtYzAxMSA2Ni4xNDU2NjEsIDIwMTIvMDIvMDYtMTQ6NTY6MjcgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDUzYgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjg1NEJBRjk1MkEyNDExRTZCMDYzQTU0Mzg1QUZBQzE4IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjg1NEJBRjk2MkEyNDExRTZCMDYzQTU0Mzg1QUZBQzE4Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6ODU0QkFGOTMyQTI0MTFFNkIwNjNBNTQzODVBRkFDMTgiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6ODU0QkFGOTQyQTI0MTFFNkIwNjNBNTQzODVBRkFDMTgiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7/7gAOQWRvYmUAZMAAAAAB/9sAhAAGBAQEBQQGBQUGCQYFBgkLCAYGCAsMCgoLCgoMEAwMDAwMDBAMDg8QDw4MExMUFBMTHBsbGxwfHx8fHx8fHx8fAQcHBw0MDRgQEBgaFREVGh8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx//wAARCAAtAC0DAREAAhEBAxEB/8QAagAAAwADAQAAAAAAAAAAAAAAAAMEAQIFCAEBAAAAAAAAAAAAAAAAAAAAABAAAgIBAwMDAwEJAAAAAAAAAQIRAxIAIQQxExRBUQUiMjNhcYGRoeFCUiMVEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD1ToDQGgNAaA0EnyHNHGWoTDWOB0kwNyAPc/aP1Ogif5jlrb+GtVBZO2XsYsw9mSplkQdp0GzfMckW/hUqAp7QJNksqNAHvL6Dfg/Ic22UtRC1aMb2UmUcdEYEAT+/poJT8tzVWss851h/pqAljH0IGsXM7+mgo8zn/iyXu+R2pw3x8bvRjlGU7fdoK+fTZZ2sFdijZAIyosgbZEyf4aDhXcO1UsRaS4rS4Vl6mtI/32wQclgkEb76C2743kWcp7eyuDYxcGxsgIgMQJ/tI66BfA4jrbS2FwbsubS9aVjOBtKKpO7HZtArw+UUqZOI0hEV62RZaAJDMzvtI/w0FHjvGXhv2vKy8eBOHidv3iMv10HVs5XbtVHrYI7BBbtGRE9Jn+WgSPlKcQzVuodBZTMS6khRjv1lh199Bk/JUopNqsjrYKmSCxyMEfbPUNOgY/LCXLXYjKrkqlhiCVUsdpnop9NAofJ14y1bqWVWqUxLh2CrG+xkjroNvPTD8bd3udns7TnGXWYjH6v2aDDUcmzl52qjUrtUA7SsiC2OMFvTr00E/wDzeS1dSuyB+MipSQTDFXR5bYRPaXpOgro4xm2y9UL2vliPqCgIEgEgeg9tAs8bk28l2vVDWQyVlXaVUiJxxjJvXf8AqCT8fynWtnKC2hUWqCYYo4YlttssQPWNA3w75730eR3+/hJw/H2scon7P066C3QGgNAaA0BoP//Z" alt="">
                      </div>
                    </dd>
                    <div ng-show="items.length==8" style="margin-bottom: 8px"></div>
                    <div class="new_add" ng-hide="items.length>=8">
                      <a class="pointer" ng-click="addItem()"
                         style="width:100%; background:#FFF;"><i
                          class="icon-plus"></i> 新增</a>
                    </div>
                  </dl>
                </div>
              </div>
            </div>
            <!--右边区域-->
            <div class="media_edit_area col-sm-push-2 col-sm-6">
              <div class="js_appmsg_editor clearfix">
                <div class="appmsg_editor active">
                  <form name="myform" novalidate>
                    <div class="inner">
                      <div class="form-group margin-bottom10 clearfix">
                        <label class="control-label">标题<span class="red">*</span></label>

                        <div class="frm_input_box with_counter counter_in append count">
                          <input type="text" class="form-control" ng-model="selectedItem.title" required name="title" reg-char-len="30" prompt-msg="titlePromptMsg" prompt-type="1" ng-trim="false" diff-zh="false">
                          <span class="inline padding5 red" ng-if="myform.title.$error.required && selectedItem.valid===false">必填</span>
                          <span class="inline padding5" ng-class="{'red':myform.title.$error.exceed}" ng-bind="titlePromptMsg"></span>
                        </div>
                      </div>
                      <div class="form-group clearfix">
                        <label class="control-label">封面<span class="red">*</span><span
                            class="grey">（大图建议尺寸：900 x 500像素，小图建议尺寸：200 x 200像素）</span></label>

                        <div class="frm_input_box">
                          <a class="btn btn-sm btn-info" data-toggle="modal"
                             data-target="#myModalImage"
                             ng-bind="selectedItem.cdn_path ? '重新选择' : '选择图片'"></a>

                          <div class="upload_preview margin-bottom10">
                            <img ng-src="{{selectedItem.cdn_path}}" ng-if="selectedItem.cdn_path"
                                 width="100">
                            <span ng-if="!selectedItem.cdn_path && selectedItem.valid===false"
                                  class="block red">请选择图片</span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group margin-bottom10 clearfix">
                        <label class="control-label">摘要<span class="red">*</span></label>
                        <textarea class="form-control" style="height:100px; resize:none;" placeholder="单条图文才显示摘要" name="description" reg-char-len="120" prompt-msg="promptMsg" prompt-type="2" ng-trim="false" diff-zh="false" required ng-model="selectedItem.description"></textarea>
                        <span class="inline padding5 red" ng-show="myform.description.$error.required && selectedItem.valid===false">必填项</span>
                        <span class="inline padding5" ng-class="{'red':myform.description.$error.exceed}" ng-bind="promptMsg"></span>
                      </div>

                      <div class="form-group margin-bottom10 clearfix">
                        <label class="control-label">图文外链类型<span class="red">*</span></label>
                        <select class="form-control" ng-change="changeLinkType()"
                                ng-model="selectedItem.link_type">
                          <option ng-repeat="linkType in linkTypeList"
                                  ng-selected="linkType.id==selectedItem.link_type"
                                  value="{{linkType.id}}"
                                  ng-bind="linkType.name"></option>
                        </select>
                        <span class="block red"
                              ng-if="!selectedItem.link_type && selectedItem.valid===false">必填项</span>
                      </div>

                      <!--链接-->
                      <div class="form-group" ng-show="selectedItem.link_type == 3">
                        <label class="control-label">链接内容<span class="red">*</span></label>
                        <input type="hidden" class="form-control">
                        <select class="form-control" ng-change="changeLink()"
                                ng-model="selectedItem.linkUrl">
                          <option ng-repeat="link in linkList"
                                  ng-selected="selectedItem.linkUrl==link.url"
                                  value="{{link.url}}"
                                  ng-bind="link.name"></option>
                        </select>
                        <span class="block red"
                              ng-if="!selectedItem.linkUrl && selectedItem.valid===false">必填项</span>
                        <input class="form-control margin-top5"
                               ng-model="selectedItem.link_param"
                               ng-show="selectedItem.linkUrl==='link'"
                               placeholder="请输入完整的url地址,例:http://">
                        <span class="block red"
                              ng-if="selectedItem.urlValid===false && selectedItem.valid===false">请输入正确的地址</span>

                        <p class="grey font-size12 margin-top5">订阅者点击后，会跳到以上链接</p>
                      </div>

                      <!--营销模块-->
                      <div class="form-group clearfix" ng-show="selectedItem.link_type == 2">
                        <label class="col-sm-2 control-label">模块：</label>

                        <div class="col-sm-10">
                          <p class="form-control-static mokuai_name action-buttons clearfix">
                            <span class="inline" ng-if="selectedItem.link_param.type">
                              模块类型：<span
                                ng-bind="activitys[selectedItem.link_param.type - 2]"></span>
                            </span>
                            <span class="block red float-right" style="padding-left: 12px;"
                                  ng-if="selectedItem.valid===false&&!selectedItem.link_param.id">必填项</span>
                            <a class="sucai_edit pointer float-right" data-toggle="modal"
                               data-target="#activityModal" title="编辑">
                              <i class="icon-pencil blue bigger-160 "></i>
                            </a>
                          </p>

                          <h3 ng-bind="selectedItem.link_param.name"></h3>
                          <span class="text-muted" ng-show="selectedItem.link_param.start_time">
                            <span
                              ng-bind="selectedItem.link_param.start_time * 1000 | date: 'yyyy-MM-dd HH:mm:ss'"></span>
                            &nbsp;至&nbsp;
                            <span
                              ng-bind="selectedItem.link_param.end_time * 1000 | date: 'yyyy-MM-dd HH:mm:ss'"></span>
                          </span>

                          <div class="sucai_add" ng-show="selectedItem.link_param.cdn_path">

                            <img class="create_access_primary no-underline pointer"
                                 style="padding-top: 0;"
                                 ng-src="{{selectedItem.link_param.cdn_path}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <i class="arrow arrow_out" style="margin-top: 0px;"></i>
                  <i class="arrow arrow_in" style="margin-top: 0px;"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="space-32"></div>
        <div class="modal-footer margin-auto" id="modal-footer">
          <a class="btn btn-primary" ng-click="save()">保存</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->render('@app/views/uploadImg/activityIndex.php'); ?>
<?php echo $this->render('@app/views/uploadImg/imageIndex.php'); ?>
<script src="/ace/js/jquery.slimscroll.min.js"></script>
<script>

  (function ($) {
    $('.slim-scroll').slimScroll({
      height: '466px'
    });
  })(jQuery);

  (function (window, document, app, angular) {
    'use strict';
    app.controller('addController', [
      '$scope', '$timeout', '$http',
      function ($scope, $timeout, $http) {
        //基础数据
        var base = {
          title: '',
          description: '',
          document_id: '',
          cdn_path: '',
          link_type: '',
          link_param: '',
          linkUrl: ''
        };

        $scope.activitys = ['点赞活动', '秒杀活动', '预约活动', '红包活动', '大转盘活动', '砸金蛋活动', '卡券', '拼团'];

        var data = JSON.parse('<?= addslashe(json_encode($model)); ?>');//数据

        angular.forEach(data.wxImagetxtReplyItems, function (obj) {
          if (obj.link_type == 2) {
            obj.link_param = obj.link_param[0];
            obj.link_param.cdn_path = obj.link_param.news ? obj.link_param.news.wxImagetxtReplyItems[0].documentLib.file_cdn_path : '';
          }
        });

        //图文集合
        $scope.items = data.wxImagetxtReplyItems;

        //链接类型列表
        $scope.linkTypeList = [
          {name: '选择链接类型', id: ''},
          {name: '打开营销模块', id: 2},
          {name: '打开链接', id: 3}
        ];

        //外链列表
        $scope.linkList = [
          {name: '请选择关联地址', url: ''},
          {name: '微商城首页', url: '/mall/index'},
          {name: '微商城商品列表', url: '/product/category'},
          {name: '微商城惊喜', url: '/surprise/index'},
          {name: '微商城购物车', url: '/cart/index'},
          {name: '微商城个人中心', url: '/user/home'},
          {name: '微推广', url: '/fx/apply'},
          {name: '微官网', url: '/mall/home'},
          {name: '外链接', url: 'link'},
          {name: '会员卡', url: '/member/user-validate'}
        ];

        //选中的项
        $scope.selectedItem = $scope.items[0];
        if ($scope.selectedItem.link_type == 3) {
          $scope.selectedItem.linkUrl = $scope.selectedItem.link_param.indexOf('http') > -1 ? 'link' : $scope.selectedItem.link_param;
        }
        if ($scope.selectedItem.link_param.type == 4) {
          $scope.selectedItem.link_param.name = $scope.selectedItem.link_param.title;
        }
        if ($scope.selectedItem.link_param.type == 6 || $scope.selectedItem.link_param.type == 7) {
          $scope.selectedItem.link_param.name = $scope.selectedItem.link_param.activity_name;
        }
        if ($scope.selectedItem.link_param.type == 8) {
          $scope.selectedItem.link_param.name = $scope.selectedItem.link_param.news.title;
          ;
          $scope.selectedItem.link_param.start_time = $scope.selectedItem.link_param.begin_time;
          $scope.selectedItem.link_param.cdn_path = $scope.selectedItem.link_param.cardTypeInfo.logo_url;
          ;
        }

        //选择
        $scope.selectItem = function (obj) {
          if (!validate())return;
          $scope.selectedItem = obj;
          if ($scope.selectedItem.link_type == 3) {
            $scope.selectedItem.linkUrl = $scope.selectedItem.link_param.indexOf('http') > -1 ? 'link' : $scope.selectedItem.link_param;
          }
        };

        //删除
        $scope.delItem = function (index) {
          $scope.items.splice(index, 1);
          $scope.selectedItem = $scope.items[0];
        };

        //新增
        $scope.addItem = function () {
          if (!validate())return;
          $scope.items.push(angular.copy(base));
          $scope.selectedItem = $scope.items[$scope.items.length - 1];
        };

        //选中封面图片时
        $scope.$on('ImageChoose', function (e, param) {
          $scope.selectedItem.document_id = param[0].id;
          $scope.selectedItem.cdn_path = param[0].file_cdn_path;
        });

        //上传封面图片时
        $scope.$on('ImageListChange', function (e, param) {
          $scope.selectedItem.document_id = param[0].id;
          $scope.selectedItem.cdn_path = param[0].file_cdn_path;
        });

        //选择活动时
        $scope.$on('chooseActivity', function (e, param, type) {

          $scope.selectedItem.link_param = {
            id: param.id,
            type: type + 1,
            cdn_path: param.cdn_path,
            name: param.name,
            start_time: param.start_time,
            end_time: param.end_time
          };
        });

        $scope.changeLink = function () {
          if ($scope.selectedItem.linkUrl !== '' && $scope.selectedItem.linkUrl !== 'link') {
            $scope.selectedItem.link_param = $scope.selectedItem.linkUrl;
          } else {
            $scope.selectedItem.link_param = '';
          }
        };

        $scope.changeLinkType = function () {
          if ($scope.selectedItem.link_type == 2) {
            $('#activityModal').modal('show');
            $scope.selectedItem.link_param = {
              id: '',
              type: '',
              name: '',
              cdn_path: '',
              start_time: '',
              end_time: ''
            };
          } else {
            $scope.selectedItem.link_param = $scope.selectedItem.linkUrl;
          }
        };

        //校验方法
        function validate() {
          if ($scope.myform.$invalid) {//如果表单校验不通过
            $scope.selectedItem.valid = false;
          } else if (!$scope.selectedItem.cdn_path) {
            $scope.selectedItem.valid = false;
          } else if ($scope.selectedItem.link_type == 3 && $scope.selectedItem.linkUrl === 'link') {
            $scope.selectedItem.valid = $scope.selectedItem.urlValid = Boolean($scope.selectedItem.link_param && /^[A-Za-z][A-Za-z\d.+-]*:\/*(?:\w+(?::\w+)?@)?[^\s/]+(?::\d+)?(?:\/[\w#!:.?+=&%@\-/[\]$'()*,;~]*)?$/.test($scope.selectedItem.link_param));
          } else if ($scope.selectedItem.link_type == 2 && !$scope.selectedItem.link_param.id) {
            $scope.selectedItem.valid = false;
          } else if ($scope.selectedItem.link_type == 3 && $scope.selectedItem.linkUrl === '') {
            $scope.selectedItem.valid = false;
          } else if ($scope.selectedItem.link_type == '') {
            $scope.selectedItem.valid = false;
          } else {
            $scope.selectedItem.valid = true;
          }
          $timeout(function () {
            $scope.selectedItem.valid = true;
          }, 2000);
          return $scope.selectedItem.valid;
        }

        //保存
        $scope.save = function () {
          if (!validate())return;
          var param = angular.copy($scope.items);
          param.map(function (obj) {
            obj.link_type = parseInt(obj.link_type);
            obj.document_id = obj.document_id.toString();
          });
          $('#loadingBox').show();
          $http.post(wsh.url + 'news-wsh-edit-ajax', {
            id: data.id,
            wxImagetxtReplyItems: param,
            title: param[0].title
          })
            .success(function (msg) {
              $('#loadingBox').hide();
              wsh.successback(msg, '修改成功！', false, function () {
                window.location.href = 'news-list';
              });
            });
        };
      }
    ]);
  })(window, document, app, angular);
</script>