<link href="/ace/js/angular-qqface/emoji.min.css" rel="stylesheet"/>
<div class="main-container" ng-controller="childController">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner">
    <div class="page-content">
      <div class="row">
        <div class="col-xs-12">
          <!--操作栏-->
          <div class="clearfix no-padding">
            <div class="col-sm-7 no-padding"></div>
            <div class="col-sm-5 no-padding">
              <div class="col-sm-12 float-right no-padding">
                <div class="float-right">
                  <div class="input-group float-left">
                    <input class="min-width120 float-left" ng-model="searchText"
                           placeholder="搜索消息相关关键字" type="text">
                    <span class="float-left "> <a ng-click="searchList()"
                                                  class="btn btn-xs btn-primary margin_right1"><i
                          class="icon-search icon-on-right bigger-110"></i></a> </span></div>
                </div>
              </div>
            </div>
          </div>
          <!--/操作栏-->
          <div class="space-6 clearfix col-sm-12 floatnone"></div>
          <div class="tabbable">
            <ul class="nav nav-tabs" id="myWxmaterialTab">
              <li ng-class="{true: 'active'}[toggleIndex == 0]"><a isshow="true"
                                                                   ng-click="toggle(0, $event)">图文素材</a>
              </li>
              <li ng-class="{true: 'active'}[toggleIndex == 1]"><a isshow="false"
                                                                   ng-click="toggle(1, $event)">文本素材</a>
              </li>
              <li ng-class="{true: 'active'}[toggleIndex == 2]"><a isshow="false"
                                                                   ng-click="toggle(2, $event)">图片素材</a>
              </li>
            </ul>
            <div class="tab-content col-sm-12 clearfix" id="mytabPane">
              <div
                ng-class="{true: 'tab-pane active clearfix', false: 'tab-pane'}[toggleIndex == 0]"
                style="display:block;" ng-show="toggleIndex == 0">
                <!--图文素材-->
                <ul class="dtw clearfix">
                  <li ng-repeat="list in newsLists" ng-click="newsClick($index)"
                      ng-class="{true: 'outline_1_red'}[newsIndex == $index]">
                    <h3 class="sc_title" ng-bind="list.title | limitTo: 20"
                        title="{{list.title}}"></h3>

                    <p class="text-muted"
                       ng-bind="list.modified*1000 | date:'yyyy/MM/dd h:mma'"></p>

                    <div class="imgbox95">
                      <img ng-src="{{list.wxImagetxtReplyItems[0].cdn_path}}"
                           class="imgthd no-margin">
                    </div>

                  </li>
                </ul>
              </div>
              <div
                ng-class="{true: 'tab-pane active clearfix', false: 'tab-pane'}[toggleIndex == 1]"
                style="display:block;" ng-show="toggleIndex == 1">
                <!--文本素材-->

                <ul class="dtw clearfix">
                  <li ng-repeat="list in textLists" ng-click="textClick($index)"
                      ng-class="{true: 'outline_1_red'}[textIndex == $index]">
                    <h3 class="sc_title" ng-bind="list.title | limitTo: 20"
                        title="{{list.title}}"></h3>

                    <p class="text-muted"
                       ng-bind="list.modified*1000 | date:'yyyy/MM/dd h:mma'"></p>

                    <div class="textbox95">
                      <p ng-bind-html="list.reply_content  | sysface | trust:'html'"
                         class="textthd"></p>
                    </div>
                  </li>
                </ul>
                <!--/文本素材-->
              </div>
              <div
                ng-class="{true: 'tab-pane active clearfix', false: 'tab-pane'}[toggleIndex == 2]"
                style="display:block;" ng-show="toggleIndex == 2">
                <!--图片素材-->
                <ul class="dtw clearfix">
                  <li ng-repeat="list in imageLists" ng-click="imageClick($index)"
                      ng-class="{true: 'outline_1_red'}[imageIndex == $index]">
                    <h3 ng-bind="list.title | limitTo: 20" title="{{list.title}}"></h3>

                    <p class="text-muted"
                       ng-bind="list.modified*1000 | date:'yyyy/MM/dd h:mma'"></p>

                    <div class="imgbox95">
                      <img ng-src="{{list.cdn_path}}" class="imgthd no-margin">
                    </div>
                  </li>
                </ul>
                <!--/图片素材-->
              </div>
              <div
                ng-class="{true: 'tab-pane active clearfix', false: 'tab-pane'}[toggleIndex == 3]"
                style="display:block;" ng-show="toggleIndex == 3">
                <!--语音素材-->
                <ul class="dtw xzs slim-scroll clearfix">
                  <li ng-repeat="list in voiceLists" ng-click="voiceClick($index)"
                      ng-class="{true: 'outline_1_red'}[voiceIndex == $index]">
                    <div class="dtwcont">
                      <div class="dtw_tu"></div>
                      <span>4"</span></div>
                    <p class="dtwtitle">我是名称或备注...<span class="float-right light-grey">15K</span>
                    </p>
                  </li>
                </ul>
                <!--/语音素材-->
              </div>
              <div
                ng-class="{true: 'tab-pane active clearfix', false: 'tab-pane'}[toggleIndex == 4]"
                style="display:block;" ng-show="toggleIndex == 4">
                <!--视频素材-->
                <ul class="dtw xzs slim-scroll clearfix">
                  <li ng-repeat="list in videoLists" ng-click="videoClick($index)"
                      ng-class="{true: 'outline_1_red'}[videoIndex == $index]">
                    <h3>我是标题啊啊</h3>
                    <span class="text-muted">2014-11-03</span> <img src="/ace/images/use01.jpg"
                                                                    width="800" height="355">

                    <p>我就是内容内容我就是内容内容我就是内容内容我就是内容内容我就是内容内容</p>
                  </li>
                </ul>
                <!--/视频素材-->
              </div>
              <div
                ng-class="{true: 'tab-pane active clearfix', false: 'tab-pane'}[toggleIndex == 5]"
                style="display:block;" ng-show="toggleIndex == 5">
                <!--音乐素材-->
                <ul class="dtw xzs slim-scroll clearfix">
                  <li ng-repeat="list in musicLists" ng-click="musicClick($index)"
                      ng-class="{true: 'outline_1_red'}[musicIndex == $index]">
                    <h3>我是标题啊啊</h3>
                    <span class="text-muted">2014-11-03</span> <img src="/ace/images/use01.jpg"
                                                                    width="800" height="355">

                    <p>我就是内容内容我就是内容内容我就是内容内容我就是内容内容我就是内容内容</p>
                  </li>
                </ul>
                <!--/音乐素材-->
              </div>
              <div ng-paginate style="margin-top: 20px;" options="options" page="page"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  app.controller('childController', function ($scope, $http, $rootScope) {

    $scope.toggleIndex = 0;
    $scope.newsIndex = $scope.textIndex = $scope.imageIndex = $scope.voiceIndex = $scope.videoIndex = $scope.musicIndex = -1;

    var mainArray = [
      function getNews(int) {
        $http.post("/wxmaterial/news-list-ajax", {'_page': int, '_page_size': 10, 'title': title})
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              $scope.newsLists = msg.errmsg.data;
              $scope.page = msg.errmsg.page;
            });
          })
      }, function getText(int) {
        $http.post("/wxmaterial/text-list-ajax", {'_page': int, '_page_size': 10, 'title': title})
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              $scope.textLists = msg.errmsg.data;
              $scope.page = msg.errmsg.page;
            });
          })
      }, function getImage(int) {
        $http.post("/wxmaterial/image-list-ajax", {
          '_page': int,
          '_page_size': 10,
          'title': title
        })
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              $scope.imageLists = msg.errmsg.data;
              $scope.page = msg.errmsg.page;
            });
          })
      }, function getVoice(int) {
        $.post('/wxmaterial/voice-list-ajax', {
          '_page': int,
          '_page_size': 10,
          'title': title
        }, function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.voiceLists = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
            $scope.$apply();
          });
        }, 'json');
      }, function getVideo(int) {
        $.post('/wxmaterial/video-list-ajax', {
          '_page': int,
          '_page_size': 10,
          'title': title
        }, function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.videoLists = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
            $scope.$apply();
          });
        }, 'json');
      }, function getMusic(int) {
        $.post('/wxmaterial/music-list-ajax', {
          '_page': int,
          '_page_size': 10,
          'title': title
        }, function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.musicLists = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
            $scope.$apply();
          });
        }, 'json');
      }
    ];
    $scope.newsClick = function (index) {
      $scope.newsIndex = index;
      $rootScope.Wxmaterials = $scope.newsLists[index];
      $rootScope.Wxmaterials.desc = '图文';
      $rootScope.Wxmaterials.type = 3;
    };
    $scope.textClick = function (index) {
      $scope.textIndex = index;
      $rootScope.Wxmaterials = $scope.textLists[index];
      $rootScope.Wxmaterials.desc = '文本';
      $rootScope.Wxmaterials.type = 1;
    };
    $scope.imageClick = function (index) {
      $scope.imageIndex = index;
      $rootScope.Wxmaterials = $scope.imageLists[index];
      $rootScope.Wxmaterials.desc = '图片';
      $rootScope.Wxmaterials.type = 2;
    };
    $scope.voiceClick = function (index) {
      $scope.voiceIndex = index;
      $rootScope.Wxmaterials = $scope.voiceLists[index];
      $rootScope.Wxmaterials.desc = '语音';
      $rootScope.Wxmaterials.type = 4;
    };

    function search(page) {
      mainArray[$scope.toggleIndex](page);
    }

    $scope.options = {callback: search};

    search(1);

    $scope.toggle = function (index) {
      if ($scope.toggleIndex != index) {
        $scope.page = {};
        $scope.toggleIndex = index;
        search(1);
        title = null;
        $scope.searchText = '';
      }
    };

    //右上侧搜索设置
    $scope.searchText = '';
    var title;
    $scope.searchList = function () {
      if (!$scope.searchText) return alert('请输入相关关键字');
      title = $scope.searchText;
      search(1);
    };
  });
</script> 
