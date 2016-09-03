<div class="bootbox modal fade in" id="productModal" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="productController">
  <div class="modal-dialog modal-dialog6">
    <div class="modal-content">
      <div class="modal-header modal-header2"><a class="bootbox-close-button close"
                                                 data-dismiss="modal">×</a>
        <h4 class="modal-title">商品列表</h4>
      </div>
      <div class="modal-body" id="productBody">
        <div class="bootbox-body">
          <div class="tabbable ">
            <div class="tab-content clearfix">
              <!--商品-->
              <div id="product" class="tab-pane in active">
                <div class="table-responsive pre-scrollable">
                  <table class="table table-striped table-bordered table-hover table-width">
                    <thead>
                    <tr ng-click="chooseAll(ischooseAll)">
                      <th width="3%"><label>
                          <input type="checkbox" class="ace" ng-model="ischooseAll"
                                 ng-click="chooseAll(ischooseAll,$event)">
                          <span class="lbl"></span> </label></th>
                      <th width="12%">商品图片</th>
                      <th width="35%">商品名称</th>
                      <th width="16%">商品分类</th>
                      <th width="8%">库存</th>
                      <th width="12%">销售价</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-click="choose(list)" class="products" ng-repeat="list in lists"
                        ng-show="!list.isshow">
                      <td class="position-relative">
                        <label>
                          <input type="checkbox" class="ace" ng-model="list.ischeck"
                                 ng-click="choose(list,$event)" ng-disabled="!list.reserves">
                          <span class="lbl"></span>
                        </label>
                      </td>
                      <td><img ng-src="{{list.covers.file_cdn_path}}" height="50"/></td>
                      <td ng-bind="list.name">上装韩版宽松长袖t恤女款大码打底袖t恤</td>
                      <td ng-bind="list.productCategory.name">分类一</td>
                      <td ng-bind="list.reserves">23</td>
                      <td ng-bind="list.show_price/100 | number: 2"></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <div ng-paginate options="options" page="page">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer"><a data-dismiss="modal" class="btn btn-default">取消</a> <a
            class="btn btn-primary" ng-click="save()">确定</a></div>
      </div>
    </div>
  </div>
</div>
<script>
  app.controller('productController', function ($scope, $http, $rootScope) {

    $scope.page = {};
    $scope.productArray = [];
    function check(list, obj) {
      var index = -1;
      list.map(function (o, i) {
        if (o.id === obj.id) {
          index = i;
        }
      });
      if (obj.ischeck && index < 0) {//如果是选中 并且不存在于List中就添加
        list.push({id: obj.id, name: obj.name});
      } else if (!obj.ischeck && index >= 0) {//如果是取消 并且存在于List中就移除
        list.splice(index, 1);
      }
    }

    $scope.chooseAll = function (isAll, e) {
      if (e) {
        e.stopPropagation();
      } else {
        $scope.ischooseAll = isAll = !isAll;
      }
      $.each($scope.lists, function (a, b) {
        if (b.reserves != 0) {
          b.ischeck = isAll;
          check($scope.productArray, b);
        }

      });
    };

    $scope.choose = function (list, e) {
      e ? e.stopPropagation() : list.ischeck = !list.ischeck;
      check($scope.productArray, list);
    };

    function getProduct(int) {
      $http.post('/product/list-ajax', {
        '_page': int,
        '_page_size': 10,
        'status': 1
      })
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.lists = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
            complite();
          });
        });
    }

    //确定
    $scope.save = function () {
      if (!$scope.productArray.length) return alert('请选择商品！');
      $rootScope.$broadcast('chooseProduct', $scope.productArray);
      $('#productModal').modal('hide');
    };

    $('#productModal').on('shown.bs.modal', function () {
      getProduct(1, 10);
      $scope.productArray = angular.copy($rootScope.productObj) || [];
    });

    function complite() {
      var cnt = 0;
      if (!$scope.productArray.length) return;
      for (var i in $scope.lists) {
        $scope.lists[i].isshow = false;
        start : for (var j in $scope.productArray) {
          if ($scope.lists[i].id == $scope.productArray[j].id) {
            $scope.lists[i].ischeck = true;
            ++cnt;
            break start;
          }
        }
      }
      $scope.ischooseAll = cnt === $scope.lists.length;
    }

    $scope.options = {callback: getProduct};
  });
</script>
