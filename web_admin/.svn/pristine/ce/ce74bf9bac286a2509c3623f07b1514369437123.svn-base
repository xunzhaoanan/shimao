<div class="bootbox modal fade in" id="redCashPackModal" tabindex="-1" role="dialog"
     open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="cashRedPackController">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
      <form name="myform" novalidate="novalidate">
        <div class="modal-header"><a class="bootbox-close-button close" data-dismiss="modal">×</a>
          <h4 class="modal-title">选择现金红包</h4>
        </div>
        <div class="modal-body">
          <div class="bootbox-body">
            <div class="table-responsive pre-scrollable clearfix">
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                <tr>
                  <th class="lt-width3 text-center">选择</th>
                  <th width="7%" class="text-center">红包名称</th>
                  <th width="7%" class="text-center">红包剩余数量</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="list in redCashPackList" ng-show="!list.isShow"
                    ng-click="checkList(list,$index)">
                  <td class="text-center"><label>
                    <input index="{{$index}}" type="radio" class="ace" name="Radio"
                           value="{{$index}}" ng-checked="list.ischeck" ng-model="list.ischeck"
                           ng-click="checkList(list,$index)">
                    <span class="lbl"></span> </label></td>
                  <td class="text-center" ng-bind="list.act_name"></td>
                  <td class="text-center" >{{list.quantity - list.send_num}}</td>

                </tr>
                <tr>
                  <td colspan="3" ng-show="!redCashPackList.length" class="red text-center"
                      ng-cloak>
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
        <div class="modal-footer"><a class="btn btn-default" data-dismiss="modal">取消</a> <a
            class="btn btn-primary" ng-click="btnRedPackSave()">确定</a></div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  app.controller("cashRedPackController", function ($scope, $timeout, $rootScope, $http) {
    $scope.page = {};
    $scope.options = {page: 'page', callback: selectRedPack};
    //选择f分组
    function selectRedPack(int) {
      $http.post("/cash-redpack/list-ajax", {"_page": int, "_page_size": 5, "valid": true})
          .success(function (msg) {
            $scope.redCashPackList = msg.errmsg.data;
            angular.forEach($scope.redCashPackList, function (e) {
              if (e && e.id == $scope.selectCashRedPackId) {
                e.ischeck = true;
              }
            });
            $scope.page = msg.errmsg.page;
            $('#redCashPackModal input[type="radio"]').eq(0).attr('checked', 'checked');
          });
    }
    //选择红包
    $scope.checkList = function (list) {
      $.each($scope.redCashPackList, function (a, b) {
        b.ischeck = false;
      });
      list.ischeck = true;
    };
    $scope.$on('selectCashRedPackId', function (e, json) {
      $scope.selectCashRedPackId = json;
    });
    //确定
    $rootScope.btnRedPackSave = function () {
      var ii = -1;
      $('#redCashPackModal input[type="radio"]').each(function (i, e) {
        if (e.checked) ii = i;
      });
      if (ii == -1) return alert('当前没有数据，请先添加！');
      $rootScope.$broadcast('chooseCashRedPack', $scope.redCashPackList[ii]);
      $('#redCashPackModal').modal('toggle');
    };
    $('#redCashPackModal').on('show.bs.modal', function () {
      selectRedPack(1);
      complite();
    });
    function complite() {
      for (var i in $scope.redCashPackList) {
        $scope.redCashPackList[i].ischoose = false;
        start : for (var j in $rootScope.shopList) {
          if ($scope.redCashPackList[i].id == $rootScope.shopList[j].id) {
            $scope.redCashPackList[i].isShow = true;
            break start;
          }
        }
      }
    }
  });

</script>

