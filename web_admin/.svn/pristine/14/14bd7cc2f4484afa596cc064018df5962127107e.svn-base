<div class="bootbox modal fade in" id="sellerModal" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="sellerOptionalTpl" ng-cloak>
  <div class="modal-dialog modal-dialog4">
    <div class="modal-content">
      <form name="myform" novalidate="novalidate">
        <div class="modal-header"><a class="bootbox-close-button close" data-dismiss="modal">×</a>
          <h4 class="modal-title">选择模版</h4>
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
              <th width="15%" class=" text-center">序号</th>
              <th width="25%" class="text-center">模版消息名称</th>
              <th width="25%" class="text-center">模版消息编号</th>
              <th width="25%" class="text-center">备注</th>
              <th width="10%" class="text-center">
                <label>
                  <input type="checkbox" class="ace ng-pristine ng-valid ng-touched"
                         ng-model="isCheckAll" ng-change="checkAllFun(isCheckAll)">
                <span class="lbl"></span> </label></th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="list in sellerOptionLists">
              <td  ng-click="choose(list, 1)" class="text-center" ng-bind="list.id"></td>
              <td ng-click="choose(list, 1)"  class="text-center" ng-bind="list.name"></td>
              <td ng-click="choose(list, 1)"  class="text-center" ng-bind="list.no"></td>
              <td ng-click="choose(list, 1)"  class="text-center" ng-bind="list.remark"></td>
              <td class="lt-width3 text-center"> <label>
                <input type="checkbox" class="ace" ng-model="list.isCheck"
                       ng-change="choose(list,0)">
                <span class="lbl"></span>
              </label></td>

            </tr>
            <tr>
              <td colspan="6" ng-show="!sellerOptionLists.length" class="red text-center" ng-cloak>
                暂无数据
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
<script language="javascript" type="text/javascript"
        src="/ace/js/DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
  app.controller("sellerOptionalTpl", function ($scope, $timeout, $rootScope, $http) {
    var int = 1;

    $scope.page = {};
    var arrayStory = [];

    //选择场景
    function tplList(int) {
      $http.post(wsh.url + "get-seller-optional-tpl-list", {
        "_page": int,
        "_page_size": 10
      }).success(function (msg) {
        $scope.isCheckAll = false;
        $scope.sellerOptionLists = msg.errmsg.data;
        $scope.page = msg.errmsg.page;
        complie();
      });
    };



    function complie() {
      if (!arrayStory.length) return;
      for (var i in $scope.sellerOptionLists) {
        for (var j in arrayStory) {
          if ($scope.sellerOptionLists[i].id == arrayStory[j]) {
            $scope.sellerOptionLists[i].isCheck = true;
            continue;
          }
        }
      }
    }


    $scope.isCheckAll = false;
    //单选
    $scope.choose = function (list,index) {
      if(index == 1)  list.isCheck = !list.isCheck;
      if (list.isCheck) {
        arrayStory.push(list.id);
      } else {
        var ii = arrayStory.indexOf(list.id);
        arrayStory.splice(ii, 1);
      }
    }
    //全选
    $scope.checkAllFun = function (allCheck) {
      $.each($scope.sellerOptionLists, function (a, b) {
        b.isCheck = allCheck;
        if (allCheck) {
          arrayStory.push(b.id);
        } else {
          var ii = arrayStory.indexOf(b.id);
          if (ii != -1) arrayStory.splice(ii, 1);
        }
      });
      arrayStory = wsh.unique(arrayStory);
    }

    //确定
    $rootScope.btnConfirm = function () {
      var int = 0;
      for (var i in $scope.sellerOptionLists) {
        if (!$scope.sellerOptionLists[i].isshow && $scope.sellerOptionLists[i].ischeck) {
          int = 1;
          continue;
        }
      }
      if (!arrayStory.length) return alert('请选择模版!!');
      $rootScope.$broadcast('chooseSellerOptionTpl', arrayStory);

      $('#sellerModal').modal('toggle');
    };

    //新增页面的分页
    $('#sellerModal').on('shown.bs.modal', function () {
      arrayStory = [];
      //页面关联
      tplList(1);

    });
    $scope.options = {page: 'page', callback: tplList};

  });

</script>

