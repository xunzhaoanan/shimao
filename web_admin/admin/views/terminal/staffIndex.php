<div class="bootbox modal fade in" id="staffModal" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="staffController">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
      <div class="modal-header"><a type="button" class="bootbox-close-button close"
                                   data-dismiss="modal">×</a>
        <h4 class="modal-title">新增核销员(只有员工绑定的微信账号正常，才能进行核销)</h4>
      </div>
      <div class="modal-body">
        <div class="bootbox-body">
          <div class="table-responsive clearfix" id="staffTable">
            <table class="table table-striped table-bordered table-hover table-width">
              <thead>
              <th width="3%" class="lt-width3 text-center"><label>
                  <input type="checkbox" class="ace" ng-model="ischooseAll"
                         ng-click="chooseAll(ischooseAll)">
                  <span class="lbl"></span> </label>
              </th>
              <th width="15%">员工姓名</th>
              <th width="20%">所属店铺</th>
              <th width="20%">联系电话</th>
              <th width="20%">绑定微信</th>
              </thead>
              <tbody>
              <tr ng-repeat="list in lists" ng-show="!list.isshow">
                <td class="lt-width3 text-center"><label>
                    <input type="checkbox" class="ace" ng-model="list.ischoose"
                           ng-click="choose(list, 2)">
                    <span class="lbl"></span> </label></td>
                <td ng-bind="list.real_name" ng-click="choose(list, 1)">123</td>
                <td ng-bind="list.shopSub.shopInfo.name" ng-click="choose(list, 1)">美丽</td>
                <td ng-bind="list.mobile" ng-click="choose(list, 1)">北京市门头沟区所属</td>
                <td ng-bind="list.is_bind == 1 ? '已绑定' : '未绑定'" ng-click="choose(list, 1)">已绑定</td>
              </tr>
              </tbody>
            </table>
            <div ng-paginate options="options" page="page"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer"><a class="btn btn-default" data-dismiss="modal">取消</a> <a
          class="btn btn-primary" ng-click="btnConfirm()">确定</a></div>
    </div>
  </div>
</div>
<script>
  app.controller("staffController", function ($scope, $http, $rootScope) {
    var int = 1;
    $scope.options = {callback: getStaff};
    $scope.staffLists = [];
    function getStaff(int) {
      $.post('/terminal/cancel-staff-list-ajax', {
        '_page': int,
        '_page_size': 10,
        'is_cancel': 2
      }, function (msg) {
        if (msg.errcode == -505) {
          document.querySelector('[data-dismiss="modal"]').click();
        }
        wsh.successback(msg, '', false, function () {
          $scope.lists = msg.errmsg.data;
          $scope.page = msg.errmsg.page;
          compile();
        });
      }, 'json');
    }

    $scope.chooseAll = function (val) {
      $scope.staffLists[int - 1] = [];
      $.each($scope.lists, function (i, e) {
        e.ischoose = val;
        if (val) $scope.staffLists[int - 1].push(e);
      });
    };
    $scope.choose = function (obj, index) {
      if (index == 1) obj.ischoose = !obj.ischoose;
      if (obj.ischoose) {
        $scope.staffLists[int - 1] = $scope.staffLists[int - 1] || [];
        $scope.staffLists[int - 1].push(obj);
      } else {
        var ii = $scope.staffLists[int - 1].indexOf(obj);
        $scope.staffLists[int - 1].splice(ii, 1);
      }
    };
    $('#staffModal').on('shown.bs.modal', function () {
      $scope.staffLists = [];
      $scope.ischooseAll = false;
      getStaff(1);
    });
    function compile() {
      $.each($scope.lists, function (i, e) {
        e.isshow = e.ischoose = false;
      });
      if (!$rootScope.staffList.length) return;
      for (var i in $rootScope.staffList) {
        for (var j in $scope.lists) {
          if ($rootScope.staffList[i].staff_id == $scope.lists[j].id) {
            $scope.lists[j].isshow = true;
            continue;
          }
        }
      }
      $scope.$apply();
    };
    $scope.btnConfirm = function () {
      var int = 0;
      var list = [];
      $.each($scope.staffLists, function (i, e) {
        //数组空判断
        if (e && e.length) {
          list.push(e);
          $.each(e, function (a, b) {
            if (b) int++;
          });
        }
      });
      if (!int) return alert('请选择员工');
      $rootScope.$broadcast('chooseStaff', list);
      $('#staffModal').modal('hide');
    };
  });
</script>