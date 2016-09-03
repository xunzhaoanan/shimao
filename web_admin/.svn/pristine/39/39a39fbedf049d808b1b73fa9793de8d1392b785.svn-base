//(function () {
//
//  'use strict';
//
//  function init() {
//    var div = document.createElement("div");
//    div.innerHTML ='<div class="main-container" id="main-container" ng-controller="guideController" ng-cloak><div><div class="modal fade in" style="display: block;"><div class="modal-dialog" style="width:1200px;"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button><a type="button" class="bootbox-close-button close" data-dismiss="modal" ng-click="eventModalFun()">×</a><h4 class="modal-title">微会员设置向导</h4></div><div class="modal-body"><div class="alert alert-block alert-success"><span class="inline align-middle margin-right5"><i class="icon icon-exclamation-circle bigger-200 orange "></i></span><span class="inline align-middle" style="font-size:14px; color: #464646;">为保证微会员模块正常运行，请先按照设置向导进行会员卡相关模块设置</span></div><div class="hy-cs-sz text-center"><ul class="hy-cs-items clearfix"><li class="hy-cs-item" ng-class="{true: \'on\', false: \'\'}[list.init_progress>0]"><div class="num">1</div><div class="text">初始化会员卡</div><span class="icon" ng-class="{true: \'ok\', false: \'no\'}[list.init_progress>0]"></span><a href="../members/init-card" class="hy-cs-link" ng-class="{true: \'show\', false: \'hide\'}[list.init_progress==0]">去设置</a></li><li class="hy-cs-item" ng-class="{true: \'on\', false: \'\'}[list.init_progress>1]"><div class="num">2</div><div class="text">开卡优惠设置</div><span class="icon" ng-class="{true: \'ok\', false: \'no\'}[list.init_progress>1]"></span><a href="../members/init-gift" class="hy-cs-link" ng-class="{true: \'show\', false: \'hide\'}[list.init_progress==1]">去设置</a></li><li class="hy-cs-item" ng-class="{true: \'on\', false: \'\'}[list.init_progress>2]"><div class="num">3</div><div class="text">成长值设置</div><span class="icon" ng-class="{true: \'ok\', false: \'no\'}[list.init_progress>2]"></span><a href="../members/init-growth" class="hy-cs-link" ng-class="{true: \'show\', false: \'hide\'}[list.init_progress==2]">去设置</a></li><li class="hy-cs-item" ng-class="{true: \'on\', false: \'\'}[list.init_progress>3]"><div class="num">4</div><div class="text">等级设置</div><span class="icon" ng-class="{true: \'ok\', false: \'no\'}[list.init_progress>3]"></span><a href="../members/init-grade" class="hy-cs-link" ng-class="{true: \'show\', false: \'hide\'}[list.init_progress==3]">去设置</a></li><li class="hy-cs-item" ng-class="{true: \'on\', false: \'\'}[list.init_progress>4]"><div class="num">5</div><div class="text" style="width: 66px;">初始会员通知设置</div><span class="icon" ng-class="{true: \'ok\', false: \'no\'}[list.init_progress>4]"></span><a href="../members/init-notice" class="hy-cs-link" ng-class="{true: \'show\', false: \'hide\'}[list.init_progress==4]">去设置</a></li><li class="hy-cs-item" ng-class="{true: \'on\', false: \'\'}[list.init_progress>5]"><div class="num">6</div><div class="text">折扣设置</div><span class="icon" ng-class="{true: \'ok\', false: \'no\'}[list.init_progress>5]"></span><a href="../members/init-discount" class="hy-cs-link" ng-class="{true: \'show\', false: \'hide\'}[list.init_progress==5]">去设置</a></li></ul><div class="space-32"></div><div class="text-center" ng-show="list.init_progress==6"><a class="btn btn-primary" href="../members/delivery">去投放会员卡</a></div><div class="space-20"></div></div></div></div></div></div></div></div><div class="modal-backdrop fade in"></div>';
//    div.id = 'checkBrowserModalId';
//    document.body.appendChild(div);
//  }
//  app.controller('guideController', function ($scope,$rootScope, $http) {
//    $rootScope.checkBrowserModal=2;
//    $scope.data = function () {
//      $http.post('/members/guide-detail-ajax', {})
//        .success(function (msg) {
//          wsh.successback(msg, '', false, function () {
//            $scope.list=msg.errmsg;
//            console.log($scope.list)
//            if(($rootScope.checkBrowserModal==2) && ($scope.list.init_progress==6)){
//              $('#checkBrowserModalId').hide();
//            }else if(($scope.list.init_progress!=6) && ($rootScope.checkBrowserModal==1)){
//              $('#checkBrowserModalId').show();
//            }
//          });
//        });
//    };
//    $scope.$watch('checkBrowserModal', function() {
//      if($rootScope.checkBrowserModal!=3){
//        $scope.data();
//      }
//    });
//    $scope.eventModalFun=function(){
//      $('#checkBrowserModalId').hide();
//    };
//  });
//  if((window.location.href.indexOf("/members/"))>0){
//    var fileref = document.createElement('link');
//    fileref.setAttribute("rel", "stylesheet");
//    fileref.setAttribute("type", "text/css");
//    fileref.setAttribute("href", '/ace/js/membersWizard/membersWizard.css');
//    document.getElementsByTagName("head")[0].appendChild(fileref);
//    init();
//    $('#checkBrowserModalId').hide();
//  }
//})();
//
