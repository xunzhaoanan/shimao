<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '编辑图文素材';
?>
<script type="text/javascript" src="/ace/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/ace/js/ueditor/ueditor.all.js"></script>

<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div
      class="main-container-inner"> <?php echo $this->render('@app/views/side/weixin_setting.php');
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
          <li>编辑图文素材</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="space-10"></div>

            <div class="weileft col-sm-push-2 col-sm-3">
              <div class="weileftda">
                <div class="padding-right10 slim-scroll">
                  <dl class="duodu " data-height="455">
                    <dt>
                    <div class="imgh3">
                      <div class="weibian action-buttons">
                        <a class="pointer" title="编辑" ng-click="itemClick($event, 0)"><i
                            class="icon-pencil bigger-130"></i></a>
                      </div>
                      <img ng-show="!list.cdn_path" ng-src="{{items[0].cdn_path}}">

                      <h3 class="text-overflow" ng-bind="items[0].title"></h3>
                    </div>
                    </dt>
                    <dd>
                      <div class="ds" ng-repeat="list in items" ng-if="$index > 0">
                        <div class="weibian action-buttons">
                          <a class="pointer" title="编辑" ng-click="itemClick($event, $index)"><i
                              class="icon-pencil bigger-130"></i></a>
                          <a class="pointer" title="删除" ng-click="deleteTuWen($event, $index)"><i
                              class="icon-trash bigger-130"></i></a>
                        </div>
                        <span ng-bind="list.title">标题</span>
                        <span ng-if="!list.title">标题</span>
                        <img ng-show="list.cdn_path" ng-src="{{list.cdn_path}}">
                        <img ng-if="!list.cdn_path" src="data:image/jpg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA8AAD/4QMraHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjMtYzAxMSA2Ni4xNDU2NjEsIDIwMTIvMDIvMDYtMTQ6NTY6MjcgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDUzYgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjg1NEJBRjk1MkEyNDExRTZCMDYzQTU0Mzg1QUZBQzE4IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjg1NEJBRjk2MkEyNDExRTZCMDYzQTU0Mzg1QUZBQzE4Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6ODU0QkFGOTMyQTI0MTFFNkIwNjNBNTQzODVBRkFDMTgiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6ODU0QkFGOTQyQTI0MTFFNkIwNjNBNTQzODVBRkFDMTgiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7/7gAOQWRvYmUAZMAAAAAB/9sAhAAGBAQEBQQGBQUGCQYFBgkLCAYGCAsMCgoLCgoMEAwMDAwMDBAMDg8QDw4MExMUFBMTHBsbGxwfHx8fHx8fHx8fAQcHBw0MDRgQEBgaFREVGh8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx//wAARCAAtAC0DAREAAhEBAxEB/8QAagAAAwADAQAAAAAAAAAAAAAAAAMEAQIFCAEBAAAAAAAAAAAAAAAAAAAAABAAAgIBAwMDAwEJAAAAAAAAAQIRAxIAIQQxExRBUQUiMjNhcYGRoeFCUiMVEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD1ToDQGgNAaA0EnyHNHGWoTDWOB0kwNyAPc/aP1Ogif5jlrb+GtVBZO2XsYsw9mSplkQdp0GzfMckW/hUqAp7QJNksqNAHvL6Dfg/Ic22UtRC1aMb2UmUcdEYEAT+/poJT8tzVWss851h/pqAljH0IGsXM7+mgo8zn/iyXu+R2pw3x8bvRjlGU7fdoK+fTZZ2sFdijZAIyosgbZEyf4aDhXcO1UsRaS4rS4Vl6mtI/32wQclgkEb76C2743kWcp7eyuDYxcGxsgIgMQJ/tI66BfA4jrbS2FwbsubS9aVjOBtKKpO7HZtArw+UUqZOI0hEV62RZaAJDMzvtI/w0FHjvGXhv2vKy8eBOHidv3iMv10HVs5XbtVHrYI7BBbtGRE9Jn+WgSPlKcQzVuodBZTMS6khRjv1lh199Bk/JUopNqsjrYKmSCxyMEfbPUNOgY/LCXLXYjKrkqlhiCVUsdpnop9NAofJ14y1bqWVWqUxLh2CrG+xkjroNvPTD8bd3udns7TnGXWYjH6v2aDDUcmzl52qjUrtUA7SsiC2OMFvTr00E/wDzeS1dSuyB+MipSQTDFXR5bYRPaXpOgro4xm2y9UL2vliPqCgIEgEgeg9tAs8bk28l2vVDWQyVlXaVUiJxxjJvXf8AqCT8fynWtnKC2hUWqCYYo4YlttssQPWNA3w75730eR3+/hJw/H2scon7P066C3QGgNAaA0BoP//Z" alt="">


                      </div>
                    </dd>
                    <dd>
                      <div class="new_add" ng-hide="items.length >= 8">
                        <a class="pointer" ng-click="addTuWen()"
                           style="width:100%; background:#FFF;"><i class="icon-plus"></i> 新增</a>
                      </div>
                    </dd>
                  </dl>
                </div>
              </div>
            </div>

            <div class="media_edit_area col-sm-push-2 col-sm-6">
              <div class="js_appmsg_editor clearfix">

                <div class="appmsg_editor active">
                  <form name="myform" novalidate>
                    <div class="inner">

                      <div class="form-group margin-bottom10 clearfix">
                        <label class="control-label">标题<span class="red">*</span></label>

                        <div class="frm_input_box with_counter counter_in append count">
                          <input type="text" class="form-control" ng-model="items[itemIndex].title"
                                 required name="tagname"  placeholder="不能超过30个字符" reg-char-len="30"
                          prompt-msg="promptMsg" prompt-type="1" ng-trim="false" diff-zh="true" >
                          <span class="inline padding5" ng-class="{'red':namemy.tagname.$error.exceed}" ng-bind="promptMsg"></span>
                        </div>
                      </div>

                      <div class="form-group margin-bottom20 clearfix">
                        <label class="control-label">封面<span class="red">*</span><!--<span class="grey">（大图建议尺寸：900 x 500像素）</span>--></label>

                        <div class="frm_input_box">
                          <a class="btn btn-sm btn-info" data-toggle="modal"
                             data-target="#insertImageMaterial"
                             ng-bind="items[itemIndex].cdn_path ? '重新选择' : '选择图片'"></a>
                          <span class="block red"
                                ng-show="!items[itemIndex].cdn_path && istrue">必填项</span>
                          <!--<span class="block grey">不超过2M，格式: bmp, png, jpeg, jpg, gif，大图建议尺寸：900 x 500像素</span>-->
                          <div class="upload_preview">
                            <img ng-src="{{items[itemIndex].cdn_path}}"
                                 ng-if="items[itemIndex].cdn_path" class="width100">
                            <span class="block red" ng-show="isCdnpath">请选择图片</span>
                          </div>
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label>
                          <input name="form-field-checkbox" type="checkbox" class="ace"
                                 ng-model="items[itemIndex].show_cover_pic"
                                 ng-click="choosePictere($event)">
                          <span class="lbl">在正文中展示封面图片</span>
                        </label>
                      </div>

                      <div class="form-group margin-bottom20 clearfix">
                        <label class="control-label">摘要<span class="red">*</span></label>

                        <div
                            class="frm_textarea_box with_counter counter_out counter_in append count">
                          <textarea class="form-control padding5" style="height:100px; resize:none;"
                                    placeholder="单条图文才显示摘要" name="description"
                                    ng-model="items[itemIndex].description"
                                     reg-char-len="120"
                                    prompt-msg="descriptionMsg" prompt-type="2" ng-trim="false" diff-zh="true"></textarea>
                          <span class="inline padding5" ng-class="{'red':namemy.description.$error.exceed}" ng-bind="descriptionMsg"></span>

                        </div>
                      </div>

                      <div class="form-group margin-bottom20 clearfix">
                        <label class="control-label">正文<span class="red">*</span></label>

                        <div class="frm_input_editbox">
                          <textarea class="width100" style="height:180px;" id="myEditor"
                                    placeholder=""></textarea>
                          <span class="block red" ng-show="isMyEditor">必填项</span>
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="control-label">原文地址</label>

                        <div class="frm_input_box">
                          <input type="url" class="form-control"
                                 placeholder="http://    当原文地址未填写时，默认跳转商城首页"
                                 ng-model="items[itemIndex].url" name="url" ng-maxlength="200">
                          <span class="block red"
                                ng-show="myform.title.$error.maxlength">字符过多</span>
                          <span class="block red"
                                ng-show="myform.title.$error.pattern">请填写合法的地址</span>
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
          <a class="btn btn-primary" ng-click="save()" id="submit">保存</a>
        </div>
      </div>
      <!-- /.main-container-inner -->
    </div>
  </div>
  <?php echo $this->render('@app/views/wxmaterial/imageIndex.php'); ?>
</div>
<script src="/ace/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="/ace/js/jquery.slimscroll.min.js"></script>
<script>
  (function ($) {
    $('.slim-scroll').slimScroll({
      height: '456px',
      railVisible: true
    });
  })(jQuery);

  app.controller('mainController', function ($scope, $rootScope, $http, $timeout) {

    var openModalType = '';

    $('#insertImageMaterial').on('hidden.bs.modal', function () {
      openModalType = '';
      editor.focus();
    });

    $scope.checkbox_index = 0;

    UE.registerUI('button', function () {
      //注册按钮执行时的command命令，使用命令默认就会带有回退操作
      editor.registerCommand('button', {
        execCommand: function () {
          $('#insertImageMaterial').modal('show');
          openModalType = 'weixinimageselector';
        }
      });

      //创建一个button
      var btn = new UE.ui.Button({
        //按钮的名字
        name: 'button',
        //提示
        title: '微信图片',
        //需要添加的额外样式，指定icon图标，这里默认使用一个重复的icon
        cssRules: 'background-position: -726px -77px;',
        //点击时执行的命令
        onclick: function () {
          //这里可以不用执行命令,做你自己的操作也可
          editor.execCommand('button');
        }
      });
      return btn;
    }, [37]);

    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ba');
    }, 100);

    var editor = new UE.ui.Editor();
    editor.render("myEditor");
    editor.addListener('selectionchange', function () {
      $scope.items[$scope.itemIndex].content = editor.getContent();
    });

    //取消文本插件表情图标
    setInterval(function () {
      if ($("#myEditor #edui97").length > 0) {
        $("#myEditor #edui97").removeClass("edui-splitbutton edui-for-emotion");
        $("#myEditor #edui97").children().children().removeClass("edui-splitbutton-body");
      }
    }, 100)

    $scope.istrue = false;
    $scope.isCdnpath = false;
    $scope.isMyEditor = false;
    $scope.items = $scope.model = [{}];

    $scope.data = JSON.parse('<?= addslashe(json_encode($model)); ?>');
    console.log($scope.data);

    //是否展示封面图片
    $scope.items = $scope.data.wxImagetxtReplyItems;
    $scope.items.map(function (obj) {
      obj.show_cover_pic = obj.show_cover_pic == 1 ? true : false;
    });
    $scope.itemIndex = 0;

    editor.ready(function () {
      editor.setContent($scope.items[0].content);
    });

    //添加
    $scope.addTuWen = function () {
      if ($scope.myform.$invalid) {
        $scope.istrue = true;
        return $timeout(function () {
          $scope.istrue = false;
        }, 3000);
      }
      if (!$scope.items[$scope.itemIndex].cdn_path) {
        $scope.isCdnpath = true;
        return $timeout(function () {
          $scope.isCdnpath = false;
        }, 3000);
      }
      if (!$scope.items[$scope.itemIndex].content) {
        $scope.isMyEditor = true;
        return $timeout(function () {
          $scope.isMyEditor = false;
        }, 3000);
      }
      if ($scope.items.length >= 8) {
        return alert('最多只能添加八条数据');
      }
      $scope.items[$scope.itemIndex].content = editor.getContent();
      $scope.items.push({});
      $scope.itemIndex = $scope.items.length - 1;
      editor.setContent("");
    };
    $scope.deleteTuWen = function (eve, index) {
      if ($scope.items.length == 1) return alert('不能全部删除');
      eve.stopPropagation();
      wsh.setNoAjaxDialog('删除提示', '确实要删除该图文吗', function () {
        $scope.items.splice(index, 1);
        $scope.itemIndex = (index - 1) > -1 ? (index - 1) : 0;
        $scope.$apply();
      });
    };

    //编辑
    $scope.itemClick = function (eve, index) {
      $scope.checkbox_index = index;
      eve.stopPropagation();
      if ($scope.myform.$invalid) {
        $scope.istrue = true;
        return $timeout(function () {
          $scope.istrue = false;
        }, 3000);
      }
      if (!$scope.items[$scope.itemIndex].cdn_path) {
        console.log('1111', $scope.items[$scope.itemIndex].cdn_path);
        $scope.isCdnpath = true;
        return $timeout(function () {
          $scope.isCdnpath = false;
        }, 3000);
      }
      if (!$scope.items[$scope.itemIndex].content) {
        $scope.isMyEditor = true;
        return $timeout(function () {
          $scope.isMyEditor = false;
        }, 3000);
      }
      $scope.itemIndex = index;
      editor.setContent($scope.items[$scope.itemIndex].content);
    };
    $scope.$on('chooseImageWxmaterials', function (e, obj) {
      if (openModalType === 'weixinimageselector') {
        editor.execCommand('inserthtml', '<img mediaid="' + obj.media_id + '" wxurl="' + obj.wx_url + '" src="' + obj.cdn_path + '"/>');
      } else {
        $scope.items[$scope.itemIndex].media_id = obj.media_id;
        $scope.items[$scope.itemIndex].cdn_path = obj.cdn_path;
        $scope.items[$scope.itemIndex].wx_url = obj.wx_url;
      }
    });
    //正文展示封面图片
    $scope.imgCdnpath = false;
    $scope.choosePictere = function (e) {
      if (!$scope.items[$scope.itemIndex].cdn_path) {
        alert('请先选择封面图片');
        e.preventDefault();
      }
    };


    //保存
    $scope.save = function () {
      if ($scope.myform.$invalid) {
        $scope.istrue = true;
        return $timeout(function () {
          $scope.istrue = false;
        }, 3000);
      }
      if (!$scope.items[$scope.itemIndex].cdn_path) {
        $scope.isCdnpath = true;
        return $timeout(function () {
          $scope.isCdnpath = false;
        }, 3000);
      }
      if (!$scope.items[$scope.itemIndex].content) {
        $scope.isMyEditor = true;
        return $timeout(function () {
          $scope.isMyEditor = false;
        }, 3000);
      }
      var param = angular.copy($scope.items);
      angular.forEach(param, function (obj) {
        obj.url = obj.url ? obj.url : '';
        obj.show_cover_pic = obj.show_cover_pic ? 1 : 2;
      });
      angular.forEach(param, function (obj) {
        var imageList = [];
        angular.forEach($(obj.content).find('img'), function (img) {
          imageList.push({
            media_id: img.attributes['mediaid'].nodeValue,
            wx_url: img.attributes['wxurl'].nodeValue,
            cdn_path: img.src
          });
        });
        obj.imageList = imageList;
      });
      $('#submit').attr('disabled', 'disabled');
      $('#submit').text('保存中...');
      $('#loadingBox').show();
      $scope.data.title = param[0].title;
      $scope.data.cdn_path = param[0].cdn_path;
      $scope.data.wx_url = param[0].wx_url;
      $scope.data.wxImagetxtReplyItems = param;
      $http.post("/wxmaterial/news-edit-ajax", $scope.data)
          .success(function (msg) {
            $('#submit').removeAttr('disabled');
            $('#submit').text('保存');
            $('#loadingBox').hide();
            wsh.successback(msg, '提交成功', false, function () {
               window.location.href = 'news-list';
            });
          })
    };
  });
</script> 