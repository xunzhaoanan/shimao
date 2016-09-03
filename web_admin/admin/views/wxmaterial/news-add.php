<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '新增图文';
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
          <li>新增微信图文</li>
        </ul>
        <!-- .breadcrumb -->
        <!-- #nav-search -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <div class="space-10"></div>

            <div class="weileft col-sm-push-2 col-sm-3">
              <div class="weileftda ">
                <div class="margin-top10 slim-scroll">
                  <dl class="duodu no-margin editing" data-height="455">
                    <dt>
                    <div class="imgh3 ">
                      <div class="weibian action-buttons">
                        <a class="pointer" title="编辑" ng-click="itemClick(0)"><i
                            class="icon-pencil bigger-130"></i></a>
                      </div>
                      <div class="dbg"></div>
                      <img ng-src="{{items[0].cdn_path}}" ng-show="items[0].cdn_path">

                      <span class="appmsg_thumb default" >建议尺寸：900 x 500像素</span>
                      <!--<span class="appmsg_thumb default" ng-show="!items[0].cdn_path">建议尺寸：900 x 500像素</span>-->


                      <h3 class="duotu_title text-overflow" ng-bind="items[0].title">标题</h3>
                    </div>
                    </dt>
                    <dd ng-repeat="list in items" ng-if="$index > 0">
                      <div class="ds">
                        <div class="lbian"></div>
                        <div class="weibian action-buttons">
                          <a class="pointer" title="编辑" ng-click="itemClick($index)"><i
                              class="icon-pencil bigger-130"></i></a>
                          <a class="pointer" title="删除" ng-click="deleteTuWen(list, $index)"><i
                              class="icon-trash bigger-130"></i></a>
                        </div>
                        <div class="dbg"></div>
                        <span ng-bind="list.title">标题</span>
                        <span ng-if="!list.title">标题</span>
                        <img ng-src="{{list.cdn_path}}" ng-show="list.cdn_path">
                        <img ng-if="!list.cdn_path" src="data:image/jpg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA8AAD/4QMraHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjMtYzAxMSA2Ni4xNDU2NjEsIDIwMTIvMDIvMDYtMTQ6NTY6MjcgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDUzYgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjg1NEJBRjk1MkEyNDExRTZCMDYzQTU0Mzg1QUZBQzE4IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjg1NEJBRjk2MkEyNDExRTZCMDYzQTU0Mzg1QUZBQzE4Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6ODU0QkFGOTMyQTI0MTFFNkIwNjNBNTQzODVBRkFDMTgiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6ODU0QkFGOTQyQTI0MTFFNkIwNjNBNTQzODVBRkFDMTgiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7/7gAOQWRvYmUAZMAAAAAB/9sAhAAGBAQEBQQGBQUGCQYFBgkLCAYGCAsMCgoLCgoMEAwMDAwMDBAMDg8QDw4MExMUFBMTHBsbGxwfHx8fHx8fHx8fAQcHBw0MDRgQEBgaFREVGh8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx//wAARCAAtAC0DAREAAhEBAxEB/8QAagAAAwADAQAAAAAAAAAAAAAAAAMEAQIFCAEBAAAAAAAAAAAAAAAAAAAAABAAAgIBAwMDAwEJAAAAAAAAAQIRAxIAIQQxExRBUQUiMjNhcYGRoeFCUiMVEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD1ToDQGgNAaA0EnyHNHGWoTDWOB0kwNyAPc/aP1Ogif5jlrb+GtVBZO2XsYsw9mSplkQdp0GzfMckW/hUqAp7QJNksqNAHvL6Dfg/Ic22UtRC1aMb2UmUcdEYEAT+/poJT8tzVWss851h/pqAljH0IGsXM7+mgo8zn/iyXu+R2pw3x8bvRjlGU7fdoK+fTZZ2sFdijZAIyosgbZEyf4aDhXcO1UsRaS4rS4Vl6mtI/32wQclgkEb76C2743kWcp7eyuDYxcGxsgIgMQJ/tI66BfA4jrbS2FwbsubS9aVjOBtKKpO7HZtArw+UUqZOI0hEV62RZaAJDMzvtI/w0FHjvGXhv2vKy8eBOHidv3iMv10HVs5XbtVHrYI7BBbtGRE9Jn+WgSPlKcQzVuodBZTMS6khRjv1lh199Bk/JUopNqsjrYKmSCxyMEfbPUNOgY/LCXLXYjKrkqlhiCVUsdpnop9NAofJ14y1bqWVWqUxLh2CrG+xkjroNvPTD8bd3udns7TnGXWYjH6v2aDDUcmzl52qjUrtUA7SsiC2OMFvTr00E/wDzeS1dSuyB+MipSQTDFXR5bYRPaXpOgro4xm2y9UL2vliPqCgIEgEgeg9tAs8bk28l2vVDWQyVlXaVUiJxxjJvXf8AqCT8fynWtnKC2hUWqCYYo4YlttssQPWNA3w75730eR3+/hJw/H2scon7P066C3QGgNAaA0BoP//Z" alt="">
                      </div>
                    </dd>
                    <div ng-show="items.length==8" style="margin-bottom: 8px"></div>
                    <div class="new_add" ng-hide="items.length>=8">
                      <a class="pointer align-center " ng-click="addTuWen()">
                        <i class="icon-plus center"></i></a>
                    </div>
                    <div ng-show="items.length<8" style="margin-bottom: 8px"></div>
                  </dl>
                </div>
              </div>
            </div>

            <!--右邊區域-->
            <div class="media_edit_area col-sm-push-2 col-sm-6">

              <div class="js_appmsg_editor clearfix">
                <div class="appmsg_editor active">
                  <form name="myform" novalidate>
                    <div class="inner">

                      <div class="form-group margin-bottom10 clearfix">
                        <label class="control-label">标题<span class="red">*</span></label>

                        <div class="frm_input_box with_counter counter_in append count">
                          <input type="text" class="form-control"
                                 ng-model="items[itemIndex].title"  name="titleaa" reg-char-len="30" prompt-msg="titleaaMsg" prompt-type="1"
                                 required  ng-trim="false" diff-zh="true">
                          <span class="inline padding5" ng-class="{'red':namemy.titleaa.$error.exceed}" ng-bind="titleaaMsg"></span>
                          <!--   <em class="frm_input_append frm_counter"><span id="counts">0</span>/30</em> -->
                          <span class="block red"
                                ng-show="myform.titleaa.$error.maxlength">字符过多</span>
                          <span class="block red"
                                ng-show="myform.titleaa.$error.required && istrue">必填项</span>
                          <!-- <span class="block grey">标题文字长度不超过30个字</span> -->
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="control-label">封面<span class="red">*</span>
<!--                          <span class="grey">（大图建议尺寸：900 x 500像素，小图建议尺寸：200 x 200像素）</span>-->
                        </label>

                        <div class="frm_input_box">
                          <!--                           <a class="btn btn-sm btn-info margin-right10" data-toggle="modal" data-target="#insertImageMaterial" ng-bind="items[itemIndex].cdn_path ? '重新选择' : '本地上传'"></a>  -->
                          <a class="btn btn-sm btn-info" data-toggle="modal"
                             data-target="#insertImageMaterial"
                             ng-bind="items[itemIndex].cdn_path ? '重新选择' : '选择图片'"></a>
                          <!-- <span class="block text-muted">不超过2M，格式: bmp, png, jpeg, jpg, gif，大图建议尺寸：900 x 500像素</span> -->
                          <span class="block red"
                                ng-show="!items[itemIndex].cdn_path && istrue||isCdnpath">必填项</span>

                          <div class="upload_preview margin-bottom10">
                            <img ng-src="{{items[itemIndex].cdn_path}}"
                                 ng-if="items[itemIndex].cdn_path" width="100" class="width101">
                            <span class="block red" ng-show="imgCdnpath">请选择图片</span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group clearfix">
                        <label>
                          <input name="form-field-checkbox" type="checkbox"
                                 ng-model="items[itemIndex].show_cover_pic" class="ace"
                                 ng-click="choosePicter($event)">
                          <span class="lbl">在正文中展示封面图片</span>
                        </label>
                      </div>
                      <div class="form-group margin-bottom20 clearfix">
                        <label class="control-label">摘要<span class="red">*</span></label>

                        <div
                            class="frm_textarea_box with_counter counter_out counter_in append count">
                          <textarea class="form-control " style="height:100px; resize:none;"
                                    placeholder="单条图文才显示摘要" name="description"
                                    ng-model="items[itemIndex].description" reg-char-len="120" prompt-msg="promptMsg" prompt-type="2" ng-trim="false" diff-zh="true" required >
                                    </textarea>
                          <!--  <em class="frm_input_append frm_counter">0/120</em> -->
                          <span class="block  red"
                                ng-show="myform.description.$error.required && istrue">必填项</span>
                          <span class="block  red" ng-show="myform.description.$error.maxlength">字符过多</span>
                          <span class="inline padding5" ng-class="{'red':namemy.description.$error.exceed}" ng-bind="promptMsg"></span>
                          <!-- <div class="block grey">摘要文字长度不超过120个字</div> -->
                        </div>
                      </div>

                      <div class="form-group margin-bottom20 clearfix">
                        <label class="control-label">正文<span class="red">*</span></label>

                        <div class="frm_input_editbox">
                          <textarea class="width100" style="height:180px; resize:none;"
                                    id="myEditor" placeholder=""></textarea>
                          <span class="block  red" ng-show="isMyEditor">必填项</span>
                        </div>
                      </div>

                      <div class="form-group margin-bottom20 clearfix">
                        <label class="control-label">原文地址</label>

                        <div class="frm_input_box">
                          <input type="url" class="form-control" name="url"
                                 placeholder="http://    当原文地址未填写时，默认跳转商城首页"
                                 ng-model="items[itemIndex].url" ng-maxlength="200">
                          <span class="block  red"
                                ng-show="myform.title.$error.maxlength">字符过多</span>
                          <span class="block red" ng-show="myform.title.$error.pattern && istrue">{{$root.regUrlText}}</span>
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
          <a class="btn btn-primary" ng-click="save()" id="submit">保存并关闭</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->render('@app/views/wxmaterial/imageIndex.php'); ?>
<script src="/ace/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="/ace/js/jquery.slimscroll.min.js"></script>
<script>
  (function ($) {
    $('.slim-scroll').slimScroll({
      height: '456px'
    });
  })(jQuery);


  app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ba');
    }, 100);


    var openModalType = '';

    $('#insertImageMaterial').on('hidden.bs.modal', function () {
      openModalType = '';
      editor.focus();
    });

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
    $scope.itemIndex = 0;
    $scope.addTuWen = function () {
      $("input[type='checkbox']").is(':checked');
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
    $scope.deleteTuWen = function (obj, index) {
      wsh.setNoAjaxDialog('删除提示', '确定要删除该图文吗', function () {
        alert('删除成功');
        $scope.items.splice(index, 1);
        $scope.itemIndex = (index - 1) > -1 ? (index - 1) : 0;
        $scope.$apply();
      });
    };


    $scope.imgCdnpath = false;

//    $scope.inmFun=function(){
//      $scope.inputVale=$("input[type='checkbox']").is(':checked');
//      if($scope.inputVale){
//        $scope.items[$scope.itemIndex].show_cover_pic = 1;
//
//        console.log('111111',$scope.items[$scope.itemIndex].show_cover_pic);
////        if($scope.items[$scope.itemIndex].cdn_path==undefined){
////          $scope.imgCdnpath=true;
////          setTimeout(function(){$scope.imgCdnpath=false},2000)
////        }else{
////          editor.execCommand('inserthtml', '<img isface mediaid="' + $scope.items[$scope.itemIndex].media_id + '" wxurl="' + $scope.items[$scope.itemIndex].wx_url + '" src="' + $scope.items[$scope.itemIndex].cdn_path + '"/>');
////        }
//      }else{
//        $scope.items[$scope.itemIndex].show_cover_pic = 2;
//        console.log('2222',$scope.items[$scope.itemIndex].show_cover_pic);
////      //清空文本图片
////        var temp = editor.getContent().replace(/<img.*?isface.*?>/g,'');
////        editor.setContent(temp);
//      }
//      console.log('testtest', $scope.items);
//    };

    $scope.choosePicter = function (e) {
      if (!$scope.items[$scope.itemIndex].cdn_path) {
        alert('请先选择封面图片');
        e.preventDefault();
      }
    };
    //show_cover_pic  =  1显示
    //show_cover_pic  =  2不显示

    //选中的封面图片
    $scope.$on('chooseImageWxmaterials', function (e, obj) {
      if (openModalType === 'weixinimageselector') {
        editor.execCommand('inserthtml', '<img mediaid="' + obj.media_id + '" wxurl="' + obj.wx_url + '" src="' + obj.cdn_path + '"/>');
      } else {
        $scope.items[$scope.itemIndex].media_id = obj.media_id;
        $scope.items[$scope.itemIndex].cdn_path = obj.cdn_path;
        $scope.items[$scope.itemIndex].wx_url = obj.wx_url;
      }
    });

    $scope.checkbox_index = 0;

    $scope.itemClick = function (index) {

      $scope.checkbox_index = index;

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
      $scope.itemIndex = index;
      editor.setContent($scope.items[$scope.itemIndex].content);
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
      $('#loadingBox').show();
      $http.post("/wxmaterial/news-add-ajax", {
        title: param[0].title,
        cdn_path: param[0].cdn_path,
        wx_url: param[0].wx_url,
        item: param
      })
          .success(function (msg) {
            $('#submit').removeAttr('disabled');
            $('#loadingBox').hide();
            wsh.successback(msg, '提交成功', false, function () {
              window.location.href = 'news-list';
            });
          })
    };
  });

</script> 