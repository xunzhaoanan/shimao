app.directive('orderSearch', function ($rootScope, userInfo, $http, $parse, $filter) {
  return {
    restrict: 'A',
    template: '<div class="row">' +
    '<div class="col-xs-12 margin-bottom10">' +
    '<div class="input-group across-space1 float-left margin-right20" >' +
    '<select  ng-model="searchObj.typeSelect" ng-options="o.id as o.name for o in searchType">' +
    '</select>' +
    '<input class="text marginleft1 width160 " type="text" ng-model="searchObj.typeText" >' +
    '</div>' +
    '<div class="input-group float-left margin-right10">' +
    '<label class="float-left margin-top3 margin-right5" for="form-field-1" ng-show="isShow">选择代理商</label>' +
    '<select class="float-left width120" ng-show="isShow" ng-model="searchObj.agent_id" ng-change="agentChange()">' +
    '<option value="{{o.id}}" ng-bind="o.agent_name" ng-repeat="o in searchAgent"></option>' +
    '</select>' +
    '</div>' +
    '<div class="input-group float-left margin-right10  ">' +
    '<label class="float-left margin-top3 margin-right5" for="form-field-1" ng-show="isShow">选择终端店</label>' +
    '<select class="float-left width120" ng-show="isShow" ng-model="searchObj.terminal_id">' +
    '<option value="{{o.id}}" ng-bind="o.shopInfo.name" ng-repeat="o in searchTer"></option>' +
    '</select>' +
    '</div>' +
    '<div class="input-group float-left margin-right10">' +
    '<label class="float-left margin-top3 margin-right5">支付方式</label>' +
    '<select class="float-left width120" ng-model="searchObj.pay_type" ng-options="o.id as o.name for o in payType">' +
    '</select>' +
    '</div>' +
    '<div class="input-group float-left clearfix margin-right10">' +
    '<label class="float-left  margin-top3 margin-right5">订单类型</label>' +
    '<select class="float-left width120" ng-model="searchObj.order_type" ng-options="o.id as o.name for o in orderType">' +
    '</select>' +
    '</div>' +
    '<div class="input-group float-left  clearfix margin-right10 hide">' +
    '<label class="float-left margin-top3 margin-right5" for="form-field-1">选择门店</label>' +
    '<select class="float-left width120">' +
    '<option data-level-index="">所有门店</option>' +
    '<option >微商户门店</option>' +
    '</select>' +
    '</div>' +
    '</div>' +
    '<div class="col-xs-12">' +
    '<div class="input-group float-left across-space1 margin-right20" >' +
    '<label class="float-left padding5 no-padding-left" for="form-field-1">下单时间 </label>' +
    '<div class="input-group width200 float-left across-space1" >' +
    '<input type="text" id="start_time" class="Wdate form-control hasDatepicker" value=""/>' +
    '</div>' +
    '<span class="float-left padding5 "> 至 </span>' +
    '<div class="input-group width200 float-left  across-space1">' +
    '<input type="text" id="end_time" class="Wdate form-control hasDatepicker" value=""/>' +
    '</div>' +
    '</div>' +
    '<div class="float-left">' +
    '<a class="btn btn-xs  btn-light  margin-right10" ng-click="date = 3600 * 24 * 7">最近7天' +
    '</a>' +
    '<a class="btn btn-xs  btn-light  margin-right10" ng-click="date = 3600 * 24 * 30">最近30天' +
    '</a>' +
    '<a class="btn btn-xs  btn-light  margin-right10" ng-click="date = 3600 * 24 * 90">最近90天' +
    '</a>' +
    '</div>' +
    '<span class="float-left"><a class="btn btn-xs btn-primary" ng-click="search(1)"> 搜索 </a></span> </div>' +
    '</div>',
    replace: true,
    link: function (scope) {

      var agentId = wsh.getHref('agent_id') || '', terminalId = wsh.getHref('terminal_id') || '';

      //搜索类型
      scope.searchType = [
        {id: 0, name: '订单号'},
        {id: 1, name: '收货人'},
        {id: 2, name: '收货人电话'}
      ];

      //、3.货到付款、、5.新微信支付、6.现金支付、8.手Q扫码支付
      scope.payType = [
        {id: '', name: '所有类型'},
        {id: 3, name: '货到付款'},
        {id: 6, name: '现金支付'},
        {id: 5, name: '微信支付'},
        {id: 7, name: '微信刷卡支付'},
        {id: 8, name: '手Q刷卡支付'}
      ];

      //搜索订单类型
      scope.orderType = [
        {id: '', name: '所有类型'},
        {id: 1, name: '普通订单'},
        {id: 2, name: '秒杀订单'},
        {id: 4, name: 'pos收银'},
        {id: 5, name: 'pos订单'},
        {id: 7, name: '扫码订单'},
        {id: 8, name: '拼团订单'}
      ];

      //代理商下的终端店关联
      scope.agentChange = function () {
        $http.post('/member/shop-by-agent-ajax', {
          'agent_id': scope.searchObj.agent_id,
          count: 1000
        }).success(function (msg) {
          wsh.successback(msg, '', false, function () {
            msg.errmsg.data.unshift({"id": '', "shopInfo": {"name": "所属终端店"}});
            scope.searchTer = msg.errmsg.data;
            scope.searchObj.terminal_id = terminalId;
          });
        });
      };

      scope.$watch('date', function (newV) {
        if (newV) {
          $("#start_time").val($filter('date')(($rootScope.nowTime - newV) * 1000, 'yyyy-MM-dd HH:mm:ss'));
          $("#end_time").val($rootScope.nowDate);
        }
      });

      scope.$watch('toggleIndex', function () {
        scope.date = '';
      });

      $('#start_time').bind('focus', function () {
        return WdatePicker({
          dateFmt: "yyyy-MM-dd HH:mm:ss",
          maxDate: "#F{$dp.$D(\'end_time\')}"
        });
      });

      $('#end_time').bind('focus', function () {
        return WdatePicker({
          dateFmt: "yyyy-MM-dd HH:mm:ss",
          minDate: "#F{$dp.$D(\'start_time\')}",
          maxDate: "2030-10-01"
        });
      });

      //搜索代理商
      $http.post('/agent/list-ajax', {count: 100})
        .success(function (msg) {
          if (msg.errcode == "-503") {
            scope.searchAgent = [{"id": '', "agent_name": "代理商没有权限"}];
          }
          wsh.successback(msg, '', false, function () {
            msg.errmsg.data.unshift({"id": agentId, "agent_name": "所属代理商"});
            scope.searchAgent = msg.errmsg.data;
            scope.searchObj.agent_id = agentId;
            scope.agentChange(agentId);
          });
        });
    }
  };
});