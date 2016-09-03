//关联活动
app.directive('terminal', function ($rootScope, $filter, $parse, $compile) {
  return {
    restrict: 'EA',
    template: '<div class="col-sm-12"  id="terminal">' +

    '<div class="col-sm-5 margin-bottom10">' +
    '<label class=" float-left text-right  clearfix" for="form-field-1">时 间：</label>' +

    '<div class="input-group col-md-3 float-left no-padding margin-left10">' +
    '<input type="text" id="start_time" class="Wdate hasDatepicker width150">' +
    '</div>' +
    '<span class="float-left padding5 "> 至 </span>' +

    '<div class="input-group col-md-3 float-left  no-padding">' +
    '<input type="text" id="end_time" class="Wdate hasDatepicker width150">' +
    '</div>' +
    '</div>' +


    /*'<div class="col-sm-2 margin-bottom10" ng-show="showDelivery===\'true\'">' +
    '<label class="float-left text-right clearfix" for="form-field-1">配送方式：</label>' +
    '<div class="col-sm-7">' +
    '<select class="form-control margin-bottom10" ng-model="deliveryMethod">' +
    '<option ng-repeat="delivery in deliveryList" ng-bind="delivery.name" value="{{delivery.id}}"></option>' +
    '</select>' +
    '</div>' +
    '</div>' +*/


    '<div class="col-sm-5 margin-bottom10">' +
    '<a class="btn btn-xs  btn-light  margin-right10" ng-click="date = 3600 * 24 * 7"> 最近7天</a>' +
    '<a class="btn btn-xs  btn-light margin-right10" ng-click="date = 3600 * 24 * 30"> 最近30天</a>' +
    '<a class="btn btn-xs  btn-light margin-right10" ng-click="date = 3600 * 24 * 90"> 最近90天</a>' +
      //'<a class="btn btn-xs  btn-light margin-left10" ng-click="date = 3600 * 24 * 700"> 全部</a>' +

    '<div class="float-right margin-bottom10">' +
    '<a class="btn btn-xs btn-primary margin_right1" ng-click="startTerminal()"> 开始统计</a>' +
    '</div>' +
    '</div>' +
    '</div>',
    replace: false,
    scope: {
      showDelivery: '@'
    },
    link: function (scope, elem, attr) {
      //scope.deliveryMethod = scope.deliveryMethod || '';
      scope.array = [];
      scope.ids = [];
      /*scope.deliveryList = [
        {name: '全部', id: ''},
        {name: '快递配送', id: '1'},
        {name: '到店自提', id: '2'}
      ];*/
      var isSearch = $parse(attr.terminal)(scope);
      var aa = wsh.getHref('start') ? wsh.getHref('start') : 0, bb = wsh.getHref('end') ? wsh.getHref('end') : 0;
      if (bb > 0) {
        $('#end_time').val(wsh.getdate(bb));
      }

      if (aa > 0) {
        $('#start_time').val(wsh.getdate(aa));
      }

      if (isSearch) {
        var agent = '<div class="col-sm-12 float-left margin-bottom10">' +
          '<label class=" float-left text-right  clearfix" for="form-field-1">代理商：</label>' +
          '<div class=" col-sm-7 float-left no-padding">' +
          '<input type="text" class="col-sm-7" ng-click="$root.agentChoose = array" ng-model="agent" data-toggle="modal" data-target="#agentModal" readonly="true">' +
          '</div>' +
          '</div>';
        var template = angular.element(agent);
        var mobileDialogElement = $compile(template)(scope);
        angular.element(document.getElementById('terminal')).prepend(mobileDialogElement);

      }
      scope.date;
      $('#start_time').bind('focus', function () {
        return WdatePicker({dateFmt: "yyyy-MM-dd HH:mm:ss", maxDate: "#F{$dp.$D(\'end_time\')}"});
      })
      $('#end_time').bind('focus', function () {
        return WdatePicker({
          dateFmt: "yyyy-MM-dd HH:mm:ss",
          minDate: "#F{$dp.$D(\'start_time\')}",
          maxDate: "2030-10-01"
        });
      })

      scope.$watch('date', function (a) {
        if (a) {
          var startDate = $rootScope.nowTime - scope.date;
          $("#start_time").val($filter('date')(startDate * 1000, 'yyyy-MM-dd HH:mm:ss'));
          $("#end_time").val($rootScope.nowDate);
        }
      })

      scope.startTerminal = function () {
        if (isSearch && !scope.ids.length) return alert('请选择代理商');
        var start = $("#start_time").val(), end = $("#end_time").val();
        if (start && end) {
          start = Math.floor(+new Date(start) / 1000);
          end = Math.floor(+new Date(end) / 1000);
          if (start >= end) {
            return alert('开始时间不能大于结束时间');
          }
          $rootScope.$broadcast('changeTerminal', start, end, scope.ids, scope.deliveryMethod);
        } else {
          return alert('请选择正确的时间');
        }
      }

      scope.$on('chooseAgent', function (e, json) {
        scope.array = [];
        $.each(json, function (i, e) {
          if (e) {
            scope.array = scope.array.concat(e);
          }
        });
        scope.array = wsh.unique(scope.array, 'id');
        scope.agent = '';
        scope.ids = [];
        $.each(scope.array, function (i, e) {
          scope.agent += e.agent_name + ',';
          scope.ids.push(e.id);
        })
        scope.agent = scope.agent.replace(/\,$/, '');
      });

    }
  };
});