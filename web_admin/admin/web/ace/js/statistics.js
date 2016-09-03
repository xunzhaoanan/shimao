app.directive('statistics', function ($rootScope, $filter, $parse) {
  return {
    restrict: 'EA',
    template: '' +
    '<div class="float-left margin-right20 margin-bottom10">' +
    '<a class="btn btn-xs  btn-light margin-right10" ng-click="date = 3600 * 24 * 7"> 最近7天</a>' +
    '<a class="btn btn-xs  btn-light margin-right10" ng-click="date = 3600 * 24 * 14"> 最近14天</a>' +
    '<a class="btn btn-xs  btn-light margin-right10" ng-click="date = 3600 * 24 * 30"> 最近30天</a>' +
    '</div>' +

    '<div class="float-left margin-bottom10 margin-right20">' +
      //'<span class=" float-left margin-top3">时 间：</span>' +

    '<div class="input-group width180 float-left no-padding">' +
      //'<input type="text" id="start_time" class="Wdate hasDatepicker width150">' +
    '<input type="text" id="start_time" class="Wdate hasDatepicker width150" onfocus="WdatePicker({dateFmt:\'yyyy-MM-dd\',maxDate:\'#F{$dp.$D(\'end_time\')}\'})">' +
    '</div>' +
    '<span class="float-left margin-top3"> 至 </span>' +

    '<div class="input-group width180 float-left  no-padding margin-left30">' +
      //'<input type="text" id="end_time" class="Wdate hasDatepicker width150">' +
    '<input type="text" id="end_time" class="Wdate hasDatepicker width150" onfocus="WdatePicker({dateFmt:\'yyyy-MM-dd\',minDate:\'#F{$dp.$D(\'start_time\')}\',maxDate:\'2030-10-01\'});">' +
    '</div>' +
    '<span ng-click="startTerminal();"><i class="icon-search font-16 cursor color"></i></span>' +
    '</div>',
    replace: false,
    link: function (scope) {

      scope.date;

      $("#start_time").val($filter('date')(new Date((Math.round(new Date().getTime())) - (3600 * 24 * 7) * 1000), 'yyyy-MM-dd'));
      $("#end_time").val($filter('date')(new Date(Math.round(new Date().getTime())), 'yyyy-MM-dd'));

      var start_time = wsh.getHref('start') ? wsh.getHref('start') : 0, end_time = wsh.getHref('end') ? wsh.getHref('end') : 0;
      if (end_time > 0) $('#end_time').val(wsh.getdate(end_time));
      if (start_time > 0) $('#start_time').val(wsh.getdate(start_time));

      $('#start_time').bind('focus', function () {
        return WdatePicker({dateFmt: "yyyy-MM-dd", maxDate: "#F{$dp.$D(\'end_time\')}"});
      });

      $('#end_time').bind('focus', function () {
        return WdatePicker({
          dateFmt: "yyyy-MM-dd",
          minDate: "#F{$dp.$D(\'start_time\')}",
          maxDate: "2030-10-01"
        });
      });

      scope.$watch('date', function (value) {
        if (value) {
          var startDate = $rootScope.nowTime - scope.date;
          $("#start_time").val($filter('date')(startDate * 1000, 'yyyy-MM-dd'));
          $("#end_time").val($filter('date')(new Date().getTime(), 'yyyy-MM-dd'));
        }
      });

      // 搜索
      scope.startTerminal = function () {
        var start = $("#start_time").val(), end = $("#end_time").val();
        if (start && end) {
          start = new Date(start + ' 00:00:00').getTime() / 1000;
          end = new Date(end + ' 23:59:59').getTime() / 1000;
          $rootScope.$broadcast('changeTerminal', start, end);
        } else {
          return alert('请选择时间');
        }
      }


    }
  };
});