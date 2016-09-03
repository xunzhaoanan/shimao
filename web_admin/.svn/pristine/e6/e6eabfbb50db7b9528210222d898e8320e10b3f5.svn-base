<div class="bootbox modal fade in" id="activityModal" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="activityController">
  <div class="modal-dialog modal-dialog6">
    <div class="modal-content">
      <div class="modal-header modal-header2"><a class="bootbox-close-button close"
                                                 data-dismiss="modal">×</a>
        <h4 class="modal-title">选择模板</h4>
      </div>
      <div class="modal-body">
        <div class="main-container">
          <script type="text/javascript">
            try {
              ace.settings.check('main-container', 'fixed')
            } catch (e) {
            }
          </script>
          <div class="main-container-inner">
            <div class="page-content">
              <!-- /.page-header -->
              <!-- PAGE CONTENT BEGINS -->
              <div class="row">
                <div class="col-xs-12">
                  <!--操作栏-->
                  <div class="clearfix no-padding">
                    <div class="col-sm-7 no-padding"></div>
                    <div class="col-sm-5 no-padding">
                      <div class="col-sm-12 float-right no-padding">
                        <div class="float-right">
                          <div class="input-group float-left">
                            <input class="min-width120 float-left" placeholder="搜索消息相关关键字"
                                   type="text" id="searchname">
	                          <span class="float-left ">
								  <a class="btn btn-xs btn-primary margin_right1" ng-click="searchBtn()">
                    <i class="icon-search icon-on-right bigger-110"></i>
                  </a>
							  </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--/操作栏-->
                  <div class="space-6 clearfix col-sm-12 floatnone"></div>
                  <div class="tabbable">
                    <ul class="nav nav-tabs" id="myActivityTab">
                      <li ng-class="{true: 'active'}[toggleIndex == 0]" style="display:none;"><a
                          isshow="true" ng-click="toggle(0)">众筹代领</a></li>
                      <li ng-class="{true: 'active'}[toggleIndex == 1]"><a isshow="false"
                                                                           ng-click="toggle(1)">众筹点赞</a>
                      </li>
                      <li ng-class="{true: 'active'}[toggleIndex == 2]"><a isshow="false"
                                                                           ng-click="toggle(2)">秒杀</a>
                      </li>
                      <li ng-class="{true: 'active'}[toggleIndex == 3]"><a isshow="false"
                                                                           ng-click="toggle(3)">微预约</a>
                      </li>
                      <li ng-class="{true: 'active'}[toggleIndex == 4]"><a isshow="false"
                                                                           ng-click="toggle(4)">红包</a>
                      </li>
                      <li ng-class="{true: 'active'}[toggleIndex == 5]"><a isshow="false"
                                                                           ng-click="toggle(5)">大转盘</a>
                      </li>
                      <li ng-class="{true: 'active'}[toggleIndex == 6]"><a isshow="false"
                                                                           ng-click="toggle(6)">砸金蛋</a>
                      </li>
                      <li ng-class="{true: 'active'}[toggleIndex == 7]"><a isshow="false"
                                                                           ng-click="toggle(7)">卡券</a>
                      </li>
                        <li ng-class="{true: 'active'}[toggleIndex == 8]"><a isshow="false"
                                                                             ng-click="toggle(8)">拼团</a>
                        </li>
                    </ul>
                    <div class="tab-content col-sm-12 clearfix" id="tabPane">
                      <div class="clearfix">
                        <div
                          ng-class="{true: 'tab-pane active clearfix', false: 'tab-pane'}[toggleIndex == 0]"
                          style="display:block;" ng-show="toggleIndex == 0">
                          <!--众筹代领-->
                          <ul class="dtw">
                            <li ng-repeat="list in listsArray[0] track by $index"
                                ng-click="receiveClick($index, list.id)"
                                ng-class="{true: 'outline_1_red'}[receiveIndex == list.id]">
                              <h3 class="sc_titles2" ng-bind="list.name"></h3>
                              <span class="text-muted">{{list.start_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}} 至 {{list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}}</span>
                              <img ng-src="{{list.cdn_path}}" width="800" height="355">

                              <p ng-bind-html="list.rule | limitTo: 45 | trust: 'html'"></p>
                            </li>
                          </ul>
                          <!--/众筹代领-->
                        </div>
                        <div
                          ng-class="{true: 'tab-pane active clearfix', false: 'tab-pane'}[toggleIndex == 1]"
                          style="display:block;" ng-show="toggleIndex == 1">
                          <!--众筹点赞-->
                          <ul class="dtw">
                            <li ng-repeat="list in listsArray[1]"
                                ng-click="zanClick($index, list.id)"
                                ng-class="{true: 'outline_1_red'}[zanIndex == list.id]">
                              <h3 class="sc_titles2" ng-bind="list.name"></h3>
                              <span class="text-muted">{{list.start_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}} 至 {{list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}}</span>

                              <div class="imgbox95">
                                <img ng-src="{{list.cdn_path}}" class="imgthd">
                              </div>
                              <p class="sc_desc"
                                 ng-bind-html="list.rule | limitTo: 30 | trust: 'html'"></p>
                            </li>
                          </ul>
                          <!--/众筹点赞-->
                        </div>
                        <div
                          ng-class="{true: 'tab-pane active clearfix', false: 'tab-pane'}[toggleIndex == 2]"
                          style="display:block;" ng-show="toggleIndex == 2">
                          <!--秒杀-->
                          <ul class="dtw ">
                            <li ng-repeat="list in listsArray[2]"
                                ng-click="secondClick($index, list.id)"
                                ng-class="{true: 'outline_1_red'}[secondIndex == list.id]">
                              <h3 class="sc_title" ng-bind="list.name"></h3>
                              <span class="text-muted">{{list.start_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}} 至 {{list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}}</span>

                              <div class="imgbox95">
                                <img ng-src="{{list.cdn_path}}" class="imgthd">
                              </div>
                              <p class="sc_desc"
                                 ng-bind-html="list.rule | limitTo: 30 | trust: 'html'"></p>
                            </li>
                          </ul>
                          <!--/秒杀-->
                        </div>
                        <div
                          ng-class="{true: 'tab-pane active clearfix', false: 'tab-pane'}[toggleIndex == 3]"
                          style="display:block;" ng-show="toggleIndex == 3">
                          <!--预约-->
                          <ul class="dtw">
                            <li ng-repeat="list in listsArray[3]"
                                ng-click="reserveClick($index, list.id)"
                                ng-class="{true: 'outline_1_red'}[reserveIndex == list.id]">
                              <h3 class="sc_title" ng-bind="list.name"></h3>
                              <span class="text-muted">{{list.start_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}} 至 {{list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}}</span>

                              <div class="imgbox95">
                                <img ng-src="{{list.cdn_path}}" class="imgthd">
                              </div>
                            </li>
                          </ul>
                          <!--/预约-->
                        </div>
                        <div
                          ng-class="{true: 'tab-pane active clearfix', false: 'tab-pane'}[toggleIndex == 4]"
                          style="display:block;" ng-show="toggleIndex == 4">
                          <!--红包-->
                          <ul class="dtw">
                            <li ng-repeat="list in listsArray[4]"
                                ng-click="redpackClick($index, list.id)"
                                ng-class="{true: 'outline_1_red'}[redpackIndex == list.id]">
                              <h3 class="sc_title" ng-bind="list.name"></h3>
                              <span class="text-muted">{{list.start_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}} 至 {{list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}}</span>

                              <div class="imgbox95">
                                <img ng-src="{{list.cdn_path}}" class="imgthd">
                              </div>
                              <p class="sc_desc"
                                 ng-bind-html="list.rule | limitTo: 45 | trust: 'html'"></p>
                            </li>
                          </ul>
                          <!--/红包-->
                        </div>
                        <div
                          ng-class="{true: 'tab-pane active clearfix', false: 'tab-pane'}[toggleIndex == 5]"
                          style="display:block;" ng-show="toggleIndex == 5">
                          <!--大转盘-->
                          <ul class="dtw">
                            <li ng-repeat="list in listsArray[5]"
                                ng-click="marketClick($index, list.id)"
                                ng-class="{true: 'outline_1_red'}[marketIndex == list.id]">
                              <h3 class="sc_title" ng-bind="list.activity_name"></h3>
                              <span class="text-muted">{{list.start_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}} 至 {{list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}}</span>

                              <div class="imgbox95">
                                <img ng-src="{{list.cdn_path ? list.cdn_path : list.logo_img}}"
                                     class="imgthd">
                              </div>
                              <p class="sc_desc"
                                 ng-bind-html="list.activity_desc | limitTo: 45 | trust: 'html'"></p>
                            </li>
                          </ul>
                          <!--/大转盘-->
                        </div>
                        <div
                          ng-class="{true: 'tab-pane active clearfix', false: 'tab-pane'}[toggleIndex == 6]"
                          style="display:block;" ng-show="toggleIndex == 6">
                          <!--砸金蛋-->
                          <ul class="dtw">
                            <li ng-repeat="list in listsArray[6]"
                                ng-click="eggClick($index, list.id)"
                                ng-class="{true: 'outline_1_red'}[eggIndex == list.id]">
                              <h3 class="sc_title" ng-bind="list.activity_name"></h3>
                              <span class="text-muted">{{list.start_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}} 至 {{list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}}</span>

                              <div class="imgbox95">
                                <img ng-src="{{list.cdn_path ? list.cdn_path : list.logo_img}}"
                                     class="imgthd">
                              </div>
                              <p class="sc_desc"
                                 ng-bind-html="list.activity_desc | limitTo: 45 | trust: 'html'"></p>
                            </li>
                          </ul>
                          <!--/砸金蛋-->
                        </div>
                        <div
                            ng-class="{true: 'tab-pane active clearfix', false: 'tab-pane'}[toggleIndex == 7]"
                            style="display:block;" ng-show="toggleIndex == 7">
                          <!--卡券开始了-->
                          <ul class="dtw">
                            <li ng-repeat="list in listsArray[7]"
                                ng-click="cardClick($index, list.id)"
                                ng-class="{true: 'outline_1_red'}[cardIndex == list.id]">
                              <h3 class="sc_title" ng-bind="list.name"></h3>
                              <span class="text-muted">{{list.start_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}} 至 {{list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}}</span>
                              <div class="imgbox95">
                                <img ng-src="{{list.cdn_path}}" class="imgthd">
                              </div>
                              <p class="sc_desc" ng-bind="list.rule"></p>
                            </li>
                          </ul>
                          <!--卡券结束了-->
                        </div>

                          <div
                              ng-class="{true: 'tab-pane active clearfix', false: 'tab-pane'}[toggleIndex == 8]"
                              style="display:block;" ng-show="toggleIndex == 8">
                              <!--拼团开始了-->
                              <ul class="dtw">
                                  <li ng-repeat="list in listsArray[8]"
                                      ng-click="togetherBuyClick($index, list.id)"
                                      ng-class="{true: 'outline_1_red'}[togetherIndex == list.id]">
                                      <h3 class="sc_title" ng-bind="list.name"></h3>
                                      <span class="text-muted">{{list.start_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}} 至 {{list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'}}</span>
                                      <div class="imgbox95">
                                          <img ng-src="{{list.cdn_path}}" class="imgthd">
                                      </div>
                                      <p class="sc_desc" ng-bind="list.rule"></p>
                                  </li>
                              </ul>
                              <!--拼团结束了-->

                          </div>
                        <div ng-paginate options="options" page="page">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col -->
          </div>
        </div>
        <div class="modal-footer no-margin-top"><a class="btn btn-default"
                                                   data-dismiss="modal">取消</a> <a
            class="btn btn-primary" ng-click="getActivity()">确定</a></div>
      </div>
    </div>
  </div>
</div>
<script>

  var intArray = [1, 1, 1, 1, 1, 1, 1, 1, 1,1];//保存请求的分页数
  var pageArray = [];
  var urlArray = [];
  app.controller('activityController', function ($scope, $timeout, $rootScope, $http) {
    $rootScope.chooseActivityIndex = 0;
    $scope.toggleIndex = 1;
    $scope.page = {};
    $scope.listsArray = [];
    $scope.receiveIndex = $scope.zanIndex = $scope.secondIndex = $scope.reserveIndex = $scope.redpackIndex = $scope.marketIndex = $scope.eggIndex = $scope.cardIndex=$scope.togetherIndex  = -1;
    var searchname = '';  //搜索条件默认值
    urlArray = [
      '/collect-receive/list-ajax', //众筹代领
      '/collect-zan/list-ajax', //众筹点赞
      '/second-kill/list-ajax', //秒杀
      '/reserve/list-ajax', //预约
      '/redpack/list-ajax', //红包
      '/market-activity/list-ajax',  //大转盘
      '/market-activity/smashegg-list-ajax',  //砸金蛋
      '/card-coupons/receive-list-ajax',   //卡券直接领取
      '/together-buy/list-ajax'   //拼团
    ];
    $scope.type = -1;
    $scope.text = '';
    $scope.clickArray = [-1, -1, -1, -1, -1, -1, -1, -1];
    $scope.receiveClick = function (index, id) {
      $scope.receiveIndex = id;
      $scope.type = 0;
      $scope.text = '众筹代领';
      $scope.clickArray[0] = index;   //用于做验证用
    };
    $scope.zanClick = function (index, id) {
      $scope.zanIndex = id;
      $scope.type = 1;
      $scope.text = '众筹点赞';
      $scope.clickArray[1] = index;
    };
    $scope.secondClick = function (index, id) {
      $scope.secondIndex = id;
      $scope.type = 2;
      $scope.text = '秒杀';
      $scope.clickArray[2] = index;
    };
    $scope.reserveClick = function (index, id) {
      $scope.reserveIndex = id;
      $scope.type = 3;
      $scope.text = '微预约';
      $scope.clickArray[3] = index;
    };
    $scope.redpackClick = function (index, id) {
      $scope.redpackIndex = id;
      $scope.type = 4;
      $scope.text = '红包';
      $scope.clickArray[4] = index;
    };
    $scope.marketClick = function (index, id) {
      $scope.marketIndex = id;
      $scope.type = 5;
      $scope.text = '大转盘';
      $scope.clickArray[5] = index;
    };
    $scope.eggClick = function (index, id) {
      $scope.eggIndex = id;
      $scope.type = 6;
      $scope.text = '砸金蛋';
      $scope.clickArray[6] = index;
    };
    $scope.cardClick = function (index, id) {
      $scope.cardIndex = id;
      $scope.type = 7;
      $scope.text = '卡券';
      $scope.clickArray[7] = index;
    };
      $scope.togetherBuyClick = function (index, id) {
          $scope.togetherIndex = id;
          $scope.type = 8;
          $scope.text = '拼团';
          $scope.clickArray[8] = index;
      };
    function getActivityData(int) {
      $http.post(urlArray[$scope.toggleIndex], {
        '_page': int,
        '_page_size': 10,
        '_name': searchname,
        'deleted': 1
      })
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.listsArray[$scope.toggleIndex] = msg.errmsg.data;
//            console.log('ffff', $scope.listsArray[$scope.toggleIndex]);
            //寻找图片
            $.each($scope.listsArray[$scope.toggleIndex], function (i, e) {
              if (e.wxImagetxtReply) {
                if ($.isArray(e.wxImagetxtReply.wxImagetxtReplyItems)) {

                  if (e.wxImagetxtReply.wxImagetxtReplyItems.length) {

                    if (e.wxImagetxtReply.wxImagetxtReplyItems[0].documentLib) {

                      e.cdn_path = e.wxImagetxtReply.wxImagetxtReplyItems[0].documentLib.file_cdn_path;
                    }
                  }
                }
              }
              if (e.news) {
                if ($.isArray(e.news.wxImagetxtReplyItems)) {

                  if (e.news.wxImagetxtReplyItems.length) {

                    if (e.news.wxImagetxtReplyItems[0].documentLib) {

                      e.cdn_path = e.news.wxImagetxtReplyItems[0].documentLib.file_cdn_path;
                    }
                  }
                }
              }
              if($scope.toggleIndex == 3){
                if(e.title){
                  e.name = e.title;
                }
              }
              if ($scope.toggleIndex == 5) {
                if (e.startImageTxt) {
                  if (e.startImageTxt.wxImagetxtItem) {
                    if (e.startImageTxt.wxImagetxtItem.documentLib) {
                      e.cdn_path = e.startImageTxt.wxImagetxtItem.documentLib.file_cdn_path;
                    }
                  }
                }
              }
              if ($scope.toggleIndex == 6) {
                if (e.startImageTxt) {
                  if (e.startImageTxt.wxImagetxtItem) {
                    if (e.startImageTxt.wxImagetxtItem.documentLib) {
                      e.cdn_path = e.startImageTxt.wxImagetxtItem.documentLib.file_cdn_path;
                    }
                  }
                }
              }
              if($scope.toggleIndex == 7){
                if(e.news){
                  e.name = e.news.title;
                }
                e.start_time = e.begin_time;
                if(e.cardTypeInfo){
                  e.cdn_path = e.cardTypeInfo.logo_url;
                  if(e.cardTypeInfo.wx_card_type == 1){
                    if(e.cardTypeInfo.cardTypeInfoProduct.length > 0){
                      e.rule = '指定商品代金券';
                    }else{
                      e.rule = '全场通用代金券';
                    }
                  }else if(e.cardTypeInfo.wx_card_type == 2){
                    if(e.cardTypeInfo.cardTypeInfoProduct.length > 0){
                      e.rule = '指定商品折扣券';
                    }else{
                      e.rule = '全场通用折扣券';
                    }
                  }else{
                    e.rule = '礼品券';
                  }
                }
              }
              if (e.desc && !e.rule) {
                e.rule = e.desc;
              }
              if (e.summary && !e.rule) {
                e.rule = e.summary;
              }
            });
            $scope.page = msg.errmsg.page;
            pageArray[$scope.toggleIndex] = msg.errmsg.page;
          });
        })
    }

    $scope.options = {callback: getActivityData};
    getActivityData(1);
    $scope.toggle = function (index) {
      $('#searchname').val('');
      searchname = '';
      $scope.receiveIndex = $scope.zanIndex = $scope.secondIndex = $scope.reserveIndex = $scope.redpackIndex = $scope.marketIndex = $scope.eggIndex=$scope.togetherIndex = -1;
      $scope.toggleIndex = index;
      getActivityData(1);

//			if ($('#myActivityTab').find('a').eq(index).attr('isshow') != 'true') {
//				getActivityData(1, urlArray[index], searchname, index);
//				$('#myActivityTab').find('a').eq(index).attr('isshow', 'true');
//			} else {
//				$scope.page = pageArray[index] ? pageArray[index] : {};
//			}
    };

    //搜索
    $scope.searchBtn = function () {
      searchname = $('#searchname').val();
      getActivityData(1);
    }

    //获取活动
    $scope.obj = {};
    $scope.getActivity = function () {
      var int = $scope.clickArray[$scope.toggleIndex];
      if (int == -1) return alert('请选择关联活动');
      $scope.obj = $scope.listsArray[$scope.toggleIndex][int];
      if ($scope.toggleIndex == 5 || $scope.toggleIndex == 6) { //大转盘和砸金蛋
        $scope.obj.name = $scope.obj.activity_name;
      }
      $rootScope.$broadcast('chooseActivity', $scope.obj, $scope.type); //活动模板事件
      $('#activityModal').modal('toggle');
    };
    $('#activityModal').on('shown.bs.modal', function () {
      //if($rootScope.chooseActivityIndex == 0) $rootScope.chooseActivityIndex = 1;
      //$scope.toggle($rootScope.chooseActivityIndex);
    });
  });
</script>
