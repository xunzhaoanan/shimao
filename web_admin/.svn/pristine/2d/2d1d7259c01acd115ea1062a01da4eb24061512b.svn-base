<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '素材管理';
?>
<link href="/ace/css/weixin/style.v1.css" rel="stylesheet"/>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner"> <?php echo $this->
    render('@app/views/side/weixin_setting.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>素材管理</li>
        </ul>
        <!-- .breadcrumb -->
        <!-- #nav-search -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <!--内容区-->
            <div class="row">
              <div class="col-xs-12">
                <div class="wxtw-head clearfix">
                  <div class="wxtw-hleft float-left">
                    <a href="/wxmaterial/news-add">
                      <div class="wxtw-btn margin-right10" ng-if="$root.hasPermission('wxmaterial/news-add')" >
                        <img class="float-left margin-right10"
                             src="http://imgcache.vikduo.com/static/689dde8060ec0bbec235df0178d4496f.png"
                             alt=""/>

                        <div class="tw-text">
                          <h3 class="tw-title">添加微信图文</h3>

                          <p class="tw-desc">图文将同步到微信公众平台</p>
                        </div>
                      </div>
                    </a>
                    <a href="/wxmaterial/news-wshadd">
                      <div class="wshtw-btn" ng-if="$root.hasPermission('wxmaterial/news-add')">
                        <img class="float-left margin-right10"
                             src="http://imgcache.vikduo.com/static/d9646a682bf2b9b3c9a03f666e168e1d.png"
                             alt=""/>

                        <h3 class="tw-title">添加微商户图文</h3>

                        <p class="tw-desc">可以将“微营销”增添到图文中</p>
                      </div>
                    </a>
                  </div>
                  <div class="wxtw-hright float-right">
                    <div class="input-group">
                      <select name="" class="width120 float-left" style="margin-right: -1px;"
                              ng-model="normalName" ng-change="changeClack(normalName)">
                        <option value="{{o.type}}" ng-bind="o.name"
                                ng-repeat="o in normal"></option>
                      </select>
                      <input ng-show="normalName==1" class="min-width120  float-left"
                             placeholder="搜索图文标题" type="text" ng-model="searchText">
                      <select ng-show="normalName==2" ng-model="searchTwo" class="float-left"
                              style="width: 141px;">
                        <option value="{{o.type}}" ng-bind="o.name"
                                ng-repeat="o in searchTwoOption"></option>
                      </select>
                      <span class="float-left">
                        <a ng-click="searchList()" class="btn btn-xs btn-primary margin_right1">
                          <i class="icon-search icon-on-right bigger-110"></i>
                        </a>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="hr"></div>

            <!--左边手机端-->
            <div class="row">
              <div class="space-4"></div>
              <div id="wx-iphone">
                <div class="wx-iphone margin-left10">
                  <div class="wx-iphone-box">
                      <!--单一-->
                    <div class="wxtw-info" ng-show="!leftList.length">
                      <div class="wxtw-info-title" ng-bind="phone_tilte"></div>
                      <div class="wxtw-info-time"
                           ng-bind="phone_time*1000?phone_time*1000:'' | date:'yyyy-MM-dd HH:mm:ss'"></div>
                      <div class="wxtw-info-img">
                        <img class="twimg" ng-src="{{phone_img}}" alt=""/>
                      </div>
                      <div class="wxtw-info-desc" ng-bind="phone_description"></div>
                  <!--    <div class="hr hr8"></div>-->
                     <!-- <div class="wxtw-info-more">
                        <a href="" class="block clearfix">
                          <span class="readmore">阅读全文</span>
                          <span class="icon-chevron-right float-right"></span>
                        </a>
                      </div>-->
                    </div>
                     <!--多个-->
                   <div class="wxtw-info" ng-show="leftList.length">
                      <div class="wxtw-info-title" ng-bind="leftList[0].title"></div>
                      <div class="wxtw-info-time"
                           ng-bind="leftList[0].modified*1000 | date:'yyyy-MM-dd HH:mm:ss'"></div>
                      <div class="wxtw-info-img">
                        <img class="twimg" ng-src="{{leftList[0].cdn_path}}" alt=""/>
                      </div>
                      <div class="wxtw-info-desc" ng-bind="leftList[0].description | limitTo: 25"></div>
                    <!--<div class="hr hr8"></div>-->
                   </div>

                     <div class="duodu" style="margin: -2px 8px 0 8px; width: auto;">
                       <dd ng-repeat="item in leftList" ng-if="$index>0">
                         <div class="ds">
                           <span ng-bind="item.title"></span>
                           <span ng-if="!item.title">标题</span>
                           <!--     <div ng-bind="item.modified*1000 | date:'yyyy-MM-dd HH:mm:ss'"></div>-->

                           <img ng-src="{{item.cdn_path}}" ng-show="item.cdn_path">
                           <span class="appmsg_thumb default" ng-if="!item.cdn_path">缩略图</span>
                         </div>
                         </dd>
                      <!--<div class="wxtw-info-more">
                        <a href="" class="block clearfix" ng-click="read()">
                          <span class="readmore">阅读全文</span>
                          <span class="icon-chevron-right float-right"></span>
                        </a>
                      </div>-->

                     </div>
                      <!--第二个-->
                  </div>
                </div>
              </div>
              <!--右边图文素材-->
              <div class="wxtw-info-list clearfix">
                <ul class="wxtw-info-listul" ng-repeat="list in tuWenList">
                  <li class="wxtw-info-item clearfix "
                      ng-click="tuPian(list)">
                    <div class="tw-info-list">
                      <div class="tw-info-btn float-left">
                        <span class="wx-tag tag-green" ng-if="list.media_id">微信图文</span>
                        <span class="wx-tag tag-green" ng-if="!list.media_id">微商户图文</span>
                        <span class="wx-tag tag-blue pictrue"
                              ng-show="list.wxImagetxtReplyItems.length > 1 ">多图文</span>
                        <span class="wx-tag tag-blue pictrue"
                              ng-show="list.wxImagetxtReplyItems.length == 1 ">单图文</span>
                      </div>
                      <div class="wxtw-info-img float-left">
                        <img class="twimg" ng-src="{{list.wxImagetxtReplyItems[0].cdn_path}}"
                             alt=""/>
                      </div>

                      <div class="wxtw-setbox float-right">
                        <div class="inline uptime"
                             ng-bind="list.modified*1000 | date:'yyyy-MM-dd HH:mm:ss'"></div>
                        <div class="inline editbox action-buttons">
                          <a class="green pointer" ng-show="list.media_id"
                             ng-if="$root.hasPermission('wxmaterial/news-list')" data-rel="tooltip"
                             title="查看二维码" ng-model="list.id" ng-click="getQrcode(list.id)"
                             data-toggle="modal" data-target="#query"> <i
                              class="icon-erweima bigger-130"></i> </a>
                          <a class="green pointer" ng-show="!list.media_id"
                             ng-if="$root.hasPermission('wxmaterial/news-list')" data-rel="tooltip"
                             title="查看二维码" ng-model="list.id" ng-click="getQrcodee(list.id)"
                             data-toggle="modal" data-target="#queryy"> <i
                              class="icon-erweima bigger-130"></i> </a>
                          <a class="blue pointer" ng-show="list.media_id"
                             ng-if="$root.hasPermission('wxmaterial/news-edit')"
                             data-rel="tooltip" href="{{'/wxmaterial/news-edit?id=' + list.id}}"
                             class="blue" title="编辑"> <i class="icon-bianji bigger-130"></i> </a>
                          <a class="blue pointer" ng-show="!list.media_id"
                             ng-if="$root.hasPermission('wxmaterial/news-edit')"
                             data-rel="tooltip" href="{{'/wxmaterial/news-wshedit?id=' + list.id}}"
                             class="blue" title="编辑"> <i class="icon-bianji bigger-130"></i> </a>
                          <a class="red pointer" title="删除" ng-click="deleteTuWen(list)"
                             ng-if="$root.hasPermission('wxmaterial/news-edit')">
                            <i class="icon-shanchu bigger-130"></i> </a>


                        </div>
                      </div>
                      <div class="space-6"></div>
                      <div class="tw-tempate-list">
                        <div class="tempate-com tempate-list1"
                             ng-repeat="lista in list.wxImagetxtReplyItems">
                          <span ng-bind="$index+1+'.'"></span>
                          <span ng-bind="lista.title"></span>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
                <div ng-show="!tuWenList.length" class="text-center red">暂时没有可显示的数据</div>
                <div ng-paginate options="options" page="page"></div>
              </div>
            </div>

            <!--内容区-->
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>

    <!--查看微信二维码-->
    <div class="bootbox modal fade in" id="query" tabindex="-1" role="dialog" open-close-modal
         aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header"><a type="button" class="bootbox-close-button close"
                                       data-dismiss="modal">×</a>
            <h4 class="modal-title">查看微信图文二维码</h4>
          </div>
          <div class="modal-body">
            <div class="bootbox-body">
              <div class="center">
                <img ng-src="{{$root.srcImg}}">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--查看微商户二维码-->
    <div class="bootbox modal fade in" id="queryy" tabindex="-1" role="dialog" open-close-modal
         aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header"><a type="button" class="bootbox-close-button close"
                                       data-dismiss="modal">×</a>
            <h4 class="modal-title">查看微商户图文二维码</h4>
          </div>
          <div class="modal-body">
            <div class="bootbox-body">
              <div class="center">
                <img ng-src="{{$root.srcImg}}">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- /.main-container-inner -->
  </div>
</div>
<script>
  app.controller('mainController', function ($scope, $http, $timeout, $rootScope) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ba');
    }, 100);

    //select下拉框数组
    $scope.normal = [{type: 1, name: '图文标题'}, {type: 2, name: '图文类型'}];
    $scope.searchTwoOption = [{type: 1, name: '微商户图文'}, {type: 2, name: '微信图文'}];
    //初始值
    $scope.normalName = $scope.normal[0].type;
    $scope.searchTwo = $scope.searchTwoOption[0].type;
    $scope.searchText = '';//图文标题
    $scope.imgTextType = '';//图文类型
    var title = $scope.searchText;
    var imgTextType = $scope.imgTextType;

    //获取图文素材
    function getTuWen(int) {
      $http.post("/wxmaterial/news-list-ajax", {
        '_page': int,
        '_page_size': 10,
        'title': title,
        'is_wsh': imgTextType
      })
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.tuWenList = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
            $scope.phone_tilte = $scope.tuWenList[0].title;
            $scope.phone_img = $scope.tuWenList [0].wxImagetxtReplyItems[0].cdn_path;
            $scope.phone_time = $scope.tuWenList [0].wxImagetxtReplyItems[0].modified;
            $scope.phone_description = $scope.tuWenList [0].wxImagetxtReplyItems[0].description;
            if ($scope.tuWenList.length == 0) {
              return $scope.list = true;
            }
            $scope.list = false;
          });
        })
    }

    getTuWen(1);

    //右上侧搜索设置
    $scope.searchList = function () {
      if ($scope.normalName == 1) {
        title = $scope.searchText;
        imgTextType = '';
        getTuWen(1);
      } else {
        title = '';
        imgTextType = $scope.searchTwo;
        getTuWen(1);
      }
    };
    $scope.searchList();

    //切换select时清空input图文名称
    $scope.changeClack = function (val) {
      if (val == 1) {
        $scope.searchText = '';
      }
    }

    //点击变换左边手机内容
    $scope.leftList = {};
    $scope.tuPian = function (obj) {
      $scope.leftList = obj.wxImagetxtReplyItems;
    }

    //查看微信二维码
    $scope.getQrcode = function (id) {
      $http.post('/weixin/qrcode-detail-ajax', {"model": "wx_imagetxt_reply", "model_id": id})
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $rootScope.srcImg = msg["errmsg"];
          });
        })
    }
    //查看微商户二维码
    $scope.getQrcodee = function (id) {
      $http.post('/weixin/qrcode-detail-ajax', {"model": "wsh_news", "model_id": id})
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              $rootScope.srcImg = msg["errmsg"];
            });
          })
    }

    //删除
    $scope.deleteTuWen = function (list) {
      wsh.setDialog('删除提示', '确定删除此素材', '/wxmaterial/news-del-ajax', {id: list.id}, function () {
        getTuWen(1);
      }, '删除成功');
    };
    //手机滚动的 效果
//    window.onscroll = function () {
//      var t = document.documentElement.scrollTop || document.body.scrollTop;
//      var top = document.getElementById("wx-iphone");
//      if (t >= 180) {
//        top.className = 'iphonetop';
//      } else {
//        top.className = '';
//      }
//    }

    //分页
    $scope.options = {callback: getTuWen};
  });
</script>