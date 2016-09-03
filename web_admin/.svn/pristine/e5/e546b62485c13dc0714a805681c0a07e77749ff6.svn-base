<div class="bootbox modal fade in" id="detailModal" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="userController" ng-cloak>
  <div class="modal-dialog modal-dialog5">
    <div class="modal-content">
      <form name="myform" novalidate="novalidate">
        <div class="modal-header"><a class="bootbox-close-button close" data-dismiss="modal">×</a>
          <h4 class="modal-title">查看明细</h4>
        </div>
        <div class="modal-body" id="userBody">
          <div class="clearfix" style="margin-bottom: 10px;">


            <div class="clearfix float-right" style="margin-bottom: 10px;">
              <div class="inline float-right margin-left10">
                <input placeholder="昵称/电话/ID" type="text" ng-model="searchName">
              <span ng-click="btnSearch()">
                  <a class="btn btn-xs btn-primary" style="vertical-align:bottom;">
                    <i class="icon-search icon-on-right bigger-110"></i>
                  </a>
              </span>
              </div>

              <div class="inline float-right margin-left10">
                <label>状态：</label>

                <div class="inline float-right margin-left10">
                  <select class="width110" ng-options="o.id as o.title for o in statusList"
                          ng-model="status"> </select>
                </div>
              </div>
            </div>
            <table
                class="table table-striped table-bordered table-hover table-width table-responsive pre-scrollable">
              <thead>
              <tr>
                <th width="8%" class="text-center">选择</th>
                <th width="12%" class="text-center">用户ID</th>
                <th width="20%" class="text-center">微信昵称</th>
                <th width="15%" class="text-center">手机号</th>
                <th width="20%" class="text-center">状态</th>
                <th width="10%" class="text-center">操作</th>
              </tr>
              </thead>
              <tbody>
              <tr ng-repeat="list in lists" ng-show="lists.length">
                <td class="text-center">
                  <label>
                    <input type="checkbox" class="ace ng-pristine ng-valid ng-touched"
                           ng-model="list.ischoose" ng-click="choose(list)">
                    <span class="lbl"></span>
                  </label>
                </td>
                <td class="text-center" ng-bind="list.uid"></td>
                <td class="text-center" ng-bind="list.nickname"></td>
                <td class="text-center" ng-bind="list.mobile"></td>
                <td class="text-center" ng-bind="$root.showStatus(list)"></td>
                <td class="text-center">
                  <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                    <a class="grey pointer" title="更新状态" ng-click="updateStatus('S', list)"
                       ng-if="$root.hasPermission('cash-redpack/update-user-data-status-ajax')"> <i
                        class="icon-refresh bigger-130"></i> </a>
                    <a class="pointer" title="重新发送" ng-click="resend('S', list)"
                       ng-show="$root.isResend(list)"
                       ng-if="$root.hasPermission('cash-redpack/resend-ajax')">
                      <i class=" icon-send bigger-130"></i> </a>
                  </div>
                </td>
              </tr>
              <tr ng-show="lists.length">
                <td class="text-center"><label>
                  <input type="checkbox" class="ace ng-pristine ng-valid ng-touched"
                         ng-model="isAll" ng-change="changeAllCheck(isAll)">
                  <span class="lbl"></span>
                </label></td>
                <td colspan="4" class="text-center"></td>
                <td class="text-center">
                  <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                    <a class="grey pointer" title="批量更新状态" ng-click="$root.updateStatus('B', uids)">
                      <i class="icon-refresh bigger-130"
                         ng-if="$root.hasPermission('cash-redpack/update-user-data-status-ajax')"></i>
                    </a>
                    <a class="pointer" title="重新发送" ng-click="$root.resend('B', uids)"> <i
                        class=" icon-send bigger-130"
                        ng-if="$root.hasPermission('cash-redpack/resend-ajax')"></i> </a>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="6" ng-show="!lists.length" class="red text-center" ng-cloak>暂无数据</td>
              </tr>
              </tbody>
            </table>
            <!-- 程序增加分页 -->
            <div ng-paginate options="options" page="page"></div>
          </div>
          <div class="modal-footer"><a class="btn btn-default" data-dismiss="modal">取消</a></div>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="/ace/js/DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
  app.controller("userController", function ($scope, $timeout, $rootScope, $http) {
    //红包来源初始获取方式
    $scope.source = -1;
    $scope.sourceList = [{'id': -1, 'title': "全部"}, {'id': 2, 'title': '手动派发'}, {
      'id': 4,
      'title': '消费策略'
    }, {'id': 6, 'title': '其他活动'}];
    //发送状态初始获取方式
    $scope.status = -1;
    $scope.statusList = [{'id': -1, 'title': "全部"}, {'id': 3, 'title': '已领取'}, {
      'id': 2,
      'title': '未领取'
    }, {'id': 1, 'title': '发送失败'}, {'id': 4, 'title': '已退款'}];

    //参与人员
    $scope.joinUser = function (int) {
      $http.post(wsh.url + 'join-user-list-ajax', {
        "_page": int,
        "_page_size": 6,
        "group_id": $scope.group_id,
        "wx_keyword": $scope.searchName ? $scope.searchName : '',
        "status": $scope.status && $scope.status != -1 ? $scope.status : ''
      }).success(function (msg) {
        wsh.successback(msg, '', false, function () {
          $scope.lists = msg.errmsg.data;
          $scope.page = msg.errmsg.page;
          $scope.isAll = true;
          $scope.curChooseNum = 0; //当前页选择个数
          //获取不到昵称，则显示为 (游客)
          $scope.lists.forEach(function (e, i) {
            if (!$scope.uids[e.id]) {
              e.ischoose = false;
              $scope.isAll = false;
            } else {
              e.ischoose = true;
              $scope.curChooseNum++;
            }
            e.nickname = (e.nickname == false) ? "(游客)" : e.nickname;
          });
        });
      });
    };
    //分页
    $scope.options = {page: 'page', callback: $scope.joinUser};
    //显示获取方式
    $scope.showSource = function (source) {
      var typeName = '';
      switch (parseInt(source)) {
        case 1:
          typeName = '扫码领取';
          break;
        case 2:
          typeName = '手动派送';
          break;
        case 3:
          typeName = '抽奖活动';
          break;
        case 4:
          typeName = '购物赠送';
          break;
        case 5:
          typeName = '游戏奖励';
          break;
        case 6:
          typeName = '平台发放';
          break;
        default :
          typeName = '未知来源';
          break;
      }
      return typeName;
    };

    //初始列表
    $('#detailModal').on('shown.bs.modal', function () {
      $scope.status = -1;
      $scope.searchName = '';
      $scope.joinUser(1);
    });
    $scope.$on('detailModal', function (e, list) {
      $scope.group_id = list.id;
    });
    //搜索
    $scope.btnSearch = function () {
      $scope.joinUser(1);
    };

    //全选
    $scope.isAll = false, $scope.uids = {};
    $scope.changeAllCheck = function (isAll) {
      $.each($scope.lists, function (a, b) {
        b.ischoose = isAll;
        if (isAll) {
          if (!$scope.uids[b.id])
            ++$scope.curChooseNum;
          $scope.uids[b.id] = b;
        } else {
          delete $scope.uids[b.id];
          --$scope.curChooseNum;
        }
      });
    };

    //选择
    $scope.choose = function (list) {
      if (list.ischoose) {
        $scope.uids[list.id] = list;
        ++$scope.curChooseNum;
      } else {
        $.each($scope.uids, function (i, e) {
          if (e && e.id == list.id) {
            delete $scope.uids[list.id];
            --$scope.curChooseNum;
            return true;
          }
        });
      }
      //选中个数小于 当前页个数
      if ($scope.curChooseNum < $scope.lists.length) {
        $scope.isAll = false;
      } else {
        $scope.isAll = true;
      }
    }
  });

</script>

