<div class="bootbox modal fade in" id="cardModal" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="cardConnect" ng-cloak>
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
      <form name="myform" novalidate="novalidate">
        <div class="modal-header"><a class="bootbox-close-button close" data-dismiss="modal">×</a>
          <h4 class="modal-title">关联卡券</h4>
        </div>
        <div class="modal-body">
          <div class="bootbox-body">
            <div class="table-responsive pre-scrollable clearfix">
              <div class="input-group margin-bottom10 float-right">
                <input class="col-sm-8 float-left" placeholder="请输入卡券名称" type="text"
                       ng-model="searchName">
                <a ng-click="search()" class="btn btn-xs btn-primary "><i
                    class="icon-search icon-on-right bigger-110"></i></a>
              </div>
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                <tr>
                  <td class="lt-width3 text-center"></td>
                  <th width="25%" class="text-center">卡券名称</th>
                  <th width="10%" class="text-center">卡券类型</th>
                  <th width="10%" class="text-center">使用平台</th>
                  <th width="27%" class="text-center">有效期</th>
                  <th width="8%" class="text-center">库存数</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="list in lists" ng-show="!list.isShow"
                    ng-click="checkList(list,$index)">
                  <td class="lt-width3 text-center" style="position: relative;"><label>
                    <input index="{{$index}}" type="radio" class="ace" name="Radio"
                           value="{{$index}}" ng-checked="list.ischeck" ng-model="list.ischeck"
                           ng-click="checkList(list,$index)">
                    <span class="lbl"></span> </label></td>
                  <td class="text-center" ng-bind="list.title"></td>
                  <td class="text-center" ng-bind="wxCardType(list.wx_card_type)"></td>
                  <td class="text-center" ng-bind="cardType(list.card_type)"></td>
                  <td class="text-center" ng-if="list.date_info_type==1">
                    <div ng-bind="list.begin*1000 | date:'yyyy-MM-dd HH:mm:ss'"></div>
                    至
                    <div ng-bind="list.end*1000 | date:'yyyy-MM-dd HH:mm:ss'"></div>
                  </td>
                  <td class="text-center" ng-if="list.date_info_type==2">
                    领取后<span ng-bind="list.begin == 0 ? '当' : list.begin"></span>天生效,<span ng-bind="list.end"></span>{{}}天有效
                  </td>
                  <td class="text-center" ng-bind="list.stock"></td>
                </tr>
                <tr>
                  <td colspan="6" ng-show="!lists.length" class="red text-center" ng-cloak>暂无数据</td>
                </tr>
                </tbody>
              </table>

              <!-- 程序增加分页 -->
              <div ng-paginate options="options" page="page"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer"><a class="btn btn-default" data-dismiss="modal">取消</a> <a
            class="btn btn-primary" ng-click="btnConfirm()">确定</a></div>
      </form>
    </div>

  </div>
</div>
<script type="text/javascript">
  app.controller("cardConnect", function ($scope, $timeout, $rootScope, $http) {
    $scope.page = {};
    $scope.options = {page: 'page', callback: cardList};
    $scope.searchName = null;
    $scope.search = function () {
      cardList(1);
    };
    $scope.page = {};
    $scope.checkList = function (list) {
      $.each($scope.lists, function (a, b) {
        b.ischeck = false;
      });
      list.ischeck = true;
    };
    //选择卡券
    function cardList(int) {
      $http.post("/card-coupons/list-ajax", {
        "_name": $scope.searchName,
        "_page": int,
        "_page_size": 5,
        "valid": true
      }).success(function (msg) {
        $scope.lists = msg.errmsg.data;
        angular.forEach($scope.lists, function (e) {
          if (e && e.id == $scope.selectedCardId) {
            e.ischeck = true;
          }
        });
        $scope.page = msg.errmsg.page;
      });
    };

    //确定
    $rootScope.btnConfirm = function () {
      var ii = -1;
      $('#cardModal input[type="radio"]').each(function (i, e) {
        if (e.checked) ii = i;
      });
      if (ii == -1) return alert('当前没有选中数据，请先选择！');
      $rootScope.$broadcast('chooseCard', $scope.lists[ii]);
      $('#cardModal').modal('toggle');
    };
    $('#cardModal').on('shown.bs.modal', function (e) {
      cardList(1);
      complite();
    });

    $scope.$on('selectedCardId', function (e, json) {
      $scope.selectedCardId = json;
    });

    function complite() {
      for (var i in $scope.lists) {
        $scope.lists[i].ischoose = false;
        start : for (var j in $rootScope.shopList) {
          if ($scope.lists[i].id == $rootScope.shopList[j].id) {
            $scope.lists[i].isShow = true;
            break start;
          }
        }
      }
    }

    $scope.wxCardType = function (id) {
      switch (id) {
        case 1:
          return '代金券';
          break;
        case 2:
          return '折扣券';
          break;
        case 3:
          return '礼品券';
          break;
        default :
          return '没有卡券类型';
      }
    };
    $scope.cardType = function (id) {
      switch (id) {
        case 1:
          return '微商户';
          break;
        case 2:
          return '微信';
          break;
        default :
          return '';
      }
    };



  });

</script>

