<div class="bootbox modal fade in" id="cardGroupModal" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="groupController">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
      <form name="myform" novalidate="novalidate">
        <div class="modal-header"><a class="bootbox-close-button close" data-dismiss="modal">×</a>
          <h4 class="modal-title">选择分组</h4>
        </div>
        <div class="modal-body">
          <div class="bootbox-body">
            <div class="table-responsive pre-scrollable clearfix">
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                <tr>
                  <th class="lt-width3 text-center">选择</th>
                  <th width="7%" class="text-center">分组名称</th>
                  <th width="7%" class="text-center">总人数</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="list in groupLists" ng-show="!list.isShow"
                    ng-click="checkList(list,$index)">
                  <td class="text-center"><label>
                    <input index="{{$index}}" type="radio" class="ace" name="Radio"
                           value="{{$index}}" ng-model="checked" ng-click="checkList(list,$index)">
                    <span class="lbl"></span> </label></td>
                  <td class="text-center" ng-bind="list.group_name"></td>
                  <td class="text-center" ng-bind="list.user_num"></td>

                </tr>
                <tr>
                  <td colspan="3" ng-show="!groupLists.length" class="red text-center" ng-cloak>
                    暂无数据
                  </td>
                </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer"><a class="btn btn-default" data-dismiss="modal">取消</a> <a
            class="btn btn-primary" ng-click="btnSave()">确定</a></div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  app.controller("groupController", function ($scope, $timeout, $rootScope, $http) {
    $scope.page = {};
    $scope.options = {page: 'page', callback: selectGroup};
    //选择f分组
    function selectGroup(int, size) {
      $http.post("/member/find-group-ajax", {"_page": int, "_page_size": size})
          .success(function (msg) {
            $scope.groupLists = msg.errmsg;
            $('#cardGroupModal input[type="radio"]').eq(0).attr('checked', 'checked');
          });
    }

    $scope.checkList = function (list, index) {
      $scope.checked = index;
      list.ischeck = !list.ischeck;
    };

    //确定
    $rootScope.btnSave = function () {
      var ii = -1;
      $('#cardGroupModal input[type="radio"]').each(function (i, e) {
        if (e.checked) ii = i;
      });
      if (ii == -1) return alert('当前没有数据，请先添加！');
      $rootScope.$broadcast('chooseGroup', $scope.groupLists[ii]);
      $('#cardGroupModal').modal('toggle');
    };
    $('#cardGroupModal').on('show.bs.modal', function () {
      selectGroup(1, 5);
      complite();
    });
    function complite() {
      for (var i in $scope.groupLists) {
        $scope.groupLists[i].ischoose = false;
        start : for (var j in $rootScope.shopList) {
          if ($scope.groupLists[i].id == $rootScope.shopList[j].id) {
            $scope.groupLists[i].isShow = true;
            break start;
          }
        }
      }
    }


  });

</script>

