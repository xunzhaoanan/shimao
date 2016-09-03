<div class="bootbox modal fade in" id="operatorModal" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="optionalOperator" ng-cloak>
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
      <form name="myform" novalidate="novalidate">
        <div class="modal-header"><a class="bootbox-close-button close" data-dismiss="modal">×</a>
          <h4 class="modal-title">选择操作员</h4>
        </div>
        <div class="modal-body" id="aa">

          <!--<div class="input-group margin-bottom10 float-right">-->
          <!--<input class="col-sm-8 float-left" placeholder="请输入卡券名称" type="text" ng-model="searchName">-->
          <!--<a ng-click="search()" class="btn btn-xs btn-primary "><i-->
          <!--class="icon-search icon-on-right bigger-110"></i></a>-->
          <!--</div>-->
          <table class="table table-striped table-bordered table-hover table-width">
            <thead>
            <tr>
              <th width="15%" class=" text-center">名称</th>
              <th width="25%" class="text-center">电话</th>
              <th width="25%" class="text-center">角色</th>
              <th width="25%" class="text-center">昵称</th>
              <th width="10%" class="text-center">选择</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="list in opertorLists" ng-click="checkList(list,$index)">
              <td class="text-center" ng-bind="list.real_name"></td>
              <td class="text-center" ng-bind="list.mobile ? list.mobile : '无'">无</td>
              <td class="text-center">操作员</td>
              <td class="text-center" ng-bind="list.wxUserInfo ? (list.wxUserInfo.nickname ? list.wxUserInfo.nickname : '无') : '无'"></td>
              <td class="lt-width3 text-center"><label>
                <input index="{{$index}}" type="radio" class="ace" name="Radio" value="{{$index}}" ng-model="checked" ng-click="checkList(list,$index)">
                <span class="lbl"></span> </label></td>

            </tr>
            <tr>
              <td colspan="6" ng-show="!opertorLists.length" class="red text-center" ng-cloak>暂无数据
              </td>
            </tr>
            </tbody>
          </table>

          <!-- 程序增加分页 -->
          <div ng-paginate options="options" page="page"></div>

        </div>
        <div class="modal-footer"><a class="btn btn-default" data-dismiss="modal">取消</a> <a
            class="btn btn-primary" ng-click="btnConfirm()">确定</a></div>
      </form>
    </div>

  </div>
</div>

<script type="text/javascript">
  app.controller("optionalOperator", function ($scope, $timeout, $rootScope, $http) {

    $scope.page = {};
    //选择场景
    function tplList(int) {
      $http.post(wsh.url + "get-optional-default-staff-list", {
        "_page": int,
        "_page_size": 10
      }).success(function (msg) {
        $scope.opertorLists = msg.errmsg.data;
        $scope.page = msg.errmsg.page;
        console.log($scope.opertorLists)
        $('#operatorModal input[type="radio"]').each(function (i, e) {
          e.checked = false;
        });
        //complite();
      });
    };
    $scope.checkList = function(list,index){
      $scope.checked = index;
      list.ischeck = !list.ischeck;

    }
    //确定
    $rootScope.btnConfirm = function () {

      var ii = -1;
      $('#operatorModal input[type="radio"]').each(function (i, e) {
        if (e.checked) ii = i;
      });

      if (ii == -1) return alert('当前没有选中数据，请先选择！');
      $http.post(wsh.url + 'create-default-staff', {"staff_id": $scope.opertorLists[ii].id})
          .success(function (msg) {
            wsh.successback(msg, '添加成功', false, function () {

              $rootScope.$broadcast('chooseOptionOperator', '');
            });

          })

      $('#operatorModal').modal('toggle');
    };

    //新增页面的分页
    $('#operatorModal').on('shown.bs.modal', function () {
      //页面关联
      tplList(1);

    });
    $scope.options = {page: 'page', callback: tplList};

  });

</script>

