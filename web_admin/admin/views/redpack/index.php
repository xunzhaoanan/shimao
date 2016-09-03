<div class="bootbox modal fade in" id="redPackModal" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="redPackController">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
      <form name="myform" novalidate="novalidate">
        <div class="modal-header"><a class="bootbox-close-button close" data-dismiss="modal">×</a>
          <h4 class="modal-title">选择红包</h4>
        </div>
        <div class="modal-body" id="redPaceModal">
          <div class="bootbox-body">

            <div class="table-responsive pre-scrollable clearfix">
              <div class="input-group float-right margin-bottom10">
                <input class="float-left" placeholder="请输入红包名称" type="text" ng-model="searchName">
                <a ng-click="search()" class="btn btn-xs btn-primary margin-left10"><i
                    class="icon-search icon-on-right bigger-110"></i></a>
              </div>
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                <tr>
                  <th width="3%" class="lt-width3 text-center"></th>
                  <th width="8%">红包名称</th>
                  <th width="8%">红包金额</th>
                  <th width="8%">订单限额</th>
                  <th width="8%">红包类型</th>
                  <th width="25%" class="text-center">使用时间</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="list in redPackLists" ng-click="checkPro(list, $index)">
                  <td class="lt-width3 text-center"><label>
                      <input index="{{$index}}" type="radio" class="ace" value="{{$index}}"
                             name="redPackRadio" ng-checked="list.ischeck" ng-model="list.ischeck"
                             ng-click="checkPro(list, $index)">
                      <span class="lbl"></span> </label></td>
                  <td ng-bind="list.name">123</td>
                  <td ng-bind="list.total_amount | price: 2">100.00</td>
                  <td ng-bind="list.order_limit | price: 2">100.00</td>
                  <td ng-bind="list.type == 1 ? '商城红包' : '现金红包'">商城红包</td>
                  <td><span ng-bind="list.start_time * 1000 | date:'yyyy-MM-dd HH:mm:ss'"></span> 至
                    <span ng-bind="list.end_time * 1000 | date:'yyyy-MM-dd HH:mm:ss'"></span></td>
                </tr>
                <tr>
                  <td colspan="6" ng-show="!redPackLists.length" class="red text-center" ng-cloak>
                    暂无数据
                  </td>
                </tr>
                </tbody>
              </table>

              <!-- 程序增加分页 -->
              <div ng-paginate options="options" page="page"></div>
            </div>
          </div>
        </div>

      </form>
      <div class="modal-footer"><a class="btn btn-default" data-dismiss="modal">取消</a> <a
          class="btn btn-primary" ng-click="btnConfirm()">确定</a></div>
    </div>
  </div>
</div>
<script>
  app.controller('redPackController', function ($scope, $rootScope) {
    $scope.searchName = null;
    //分页
    $scope.options = {callback: getRedPack};
    function getRedPack(int) {
      $.post('/redpack-manage/unexpired-list-ajax', {
        'name': $scope.searchName,
        '_page': int,
        '_page_size': 10
      }, function (msg) {
        wsh.successback(msg, '', false, function () {
          $scope.redPackLists = msg.errmsg.data;
          angular.forEach($scope.redPackLists, function (e) {
            if (e && e.id == $scope.selectedRedPackId) {
              e.ischeck = true;
            }
          });
          $scope.page = msg.errmsg.page;
          $scope.$apply();
          $('input[type="radio"]').eq(0).attr('checked', 'checked');
        });
      }, 'json');
    }

    $scope.checkPro = function (list) {
      $.each($scope.redPackLists, function (a, b) {
        b.ischeck = false;
      });
      list.ischeck = true;
    };
    //确定
    $scope.btnConfirm = function () {
      var ii = -1;
      $('#redPackModal input[type="radio"]').each(function (i, e) {
        if (e.checked) ii = i;
      });


      if ($scope.redPackLists.length == 0) {
        return alert('当前没有红包，请先添加！'), $('#redPackModal').modal('toggle');
      } else {
        if (ii == -1) return alert('您还未选择红包');
      }
      $rootScope.$broadcast('chooseRedPack', $scope.redPackLists[ii]);
      $('#redPackModal').modal('toggle');
    };

    $('#redPackModal').on('shown.bs.modal', function (e) {
      getRedPack(1);

    });
    $scope.$on('selectedRedPackId', function (e, json) {
      $scope.selectedRedPackId = json;
    });
    //查询
    $scope.search = function () {
      getRedPack(1);
    };
    $('#redPackModal').on('hidden.bs.modal', function (e) {
      $scope.page = {};
    });

  });
</script>