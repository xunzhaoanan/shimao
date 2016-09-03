//关联活动
app.directive('bill', function ($rootScope, $filter, $parse, $compile, userInfo) {
    return {
        restrict: 'EA',
        template: '<div class="float-left margin-bottom10 margin-right20">' +
        '<span class=" float-left margin-top3">时 间：</span>' +

        '<div class="input-group width180 float-left no-padding">' +
        '<input type="text" id="start_time" class="Wdate hasDatepicker width150">' +
        '</div>' +
        '<span class="float-left margin-top3 "> 至 </span>' +

        '<div class="input-group width180 float-left  no-padding margin-left20">' +
        '<input type="text" id="end_time" class="Wdate hasDatepicker width150">' +
        '</div>' +
        '</div>' +

        '<div class="float-left margin-right20 margin-bottom10">' +
        '<a class="btn btn-xs  btn-light  margin-right10" ng-click="date = yesterDate()"> 昨天</a>' +
        '<a class="btn btn-xs  btn-light margin-right10" ng-click="date = 3600 * 24 *7"> 最近7天</a>' +
        '<a class="btn btn-xs  btn-light margin-right10" ng-click="date = 3600 * 24 *30"> 最近30天</a>' +
        '</div>' + '</div>',
        replace: false,
        link: function (scope, elem, attr) {
            scope.array = [];
            scope.ids = [];

            var isSearch = $parse(attr.terminal)(scope);
            var aa = wsh.getHref('start') ? wsh.getHref('start') : 0, bb = wsh.getHref('end') ? wsh.getHref('end') : 0;
            if (bb > 0) {
                $('#end_time').val(wsh.getdate(bb));
            }

            if (aa > 0) {
                $('#start_time').val(wsh.getdate(aa));
            }

            scope.date;
            $('#start_time').bind('focus', function () {
                return WdatePicker({dateFmt: "yyyy-MM-dd", maxDate: "#F{$dp.$D(\'end_time\')}"});
            })
            $('#end_time').bind('focus', function () {
                return WdatePicker({
                    dateFmt: "yyyy-MM-dd",
                    minDate: "#F{$dp.$D(\'start_time\')}",
                    maxDate: "2030-10-01"
                });
            })

            scope.$watch('date', function (a) {
                if (a) {
                    var startDate = $rootScope.nowTime - scope.date;
                    $("#start_time").val($filter('date')(startDate * 1000, 'yyyy-MM-dd'));
                    $("#end_time").val($filter('date')(new Date().getTime(), 'yyyy-MM-dd'));
                }
            })
            scope.yesterDate = function () {
                var yDate = new Date();
                yDate.setDate(yDate.getDate() - 1);
                $("#start_time").val($filter('date')(yDate.getTime(), 'yyyy-MM-dd'));
                $("#end_time").val($filter('date')(yDate.getTime(), 'yyyy-MM-dd'));



            };
            scope.sevenDate = function () {

                scope.date = 3600 * 24 * 7


            };
            scope.startTerminal = function () {
                var start = $("#start_time").val(), end = $("#end_time").val();
                if (start && end) {

                    start = new Date(start + ' 00:00:00').getTime() / 1000;
                    end = new Date(end + ' 23:59:59').getTime() / 1000;
                    $rootScope.$broadcast('changeTerminal', start, end, scope.ids);
                } else {
                    return alert('请选择时间');
                }
            }


        }
    };
});