<div class="bootbox modal fade in" id="cardUserModal" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="userController" ng-cloak>
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
      <form name="myform" novalidate="novalidate">
        <div class="modal-header"><a class="bootbox-close-button close" data-dismiss="modal">×</a>
          <h4 class="modal-title">选择用户</h4>
        </div>
        <div class="modal-body" id="userBody">

          <div class="clearfix" style="margin-bottom: 10px;">

            <div class="inline float-right margin-left10">
              <input placeholder="搜索客户名称" type="text" ng-model="searchName">
              <span ng-click="normalSearch()"> <a class="btn btn-xs btn-primary"
                                                  style="vertical-align:bottom;"><i
                  class="icon-search icon-on-right bigger-110"></i></a> </span>
            </div>

            <div class="inline float-right margin-left10">
              <div class="inline float-right margin-left10">
                <select class="width110" ng-options="o.id as o.real_name for o in staffList"
                        ng-model="staff_id" ng-change="staffChange(staff_id)">
                </select>
              </div>
            </div>

            <div class="inline float-right margin-left10">
              <div class="inline float-right margin-left10">
                <select class="width110" ng-options="o.id as o.shopInfo.name for o in shopList"
                        ng-model="shop_id" ng-change="shopChange(shop_id)">
                </select>
              </div>
            </div>

            <div class="inline float-right margin-left10">
              <select class="width110" ng-options="o.id as o.agent_name for o in agentList"
                      ng-model="agent_id" ng-change="agentChange(agent_id)">
              </select>
            </div>

            <!--分组-->
            <div class="inline float-right margin-left10">
              <select class="width110" ng-options="o.id as o.group_name for o in groupList"
                      ng-model="group_id" ng-change="groupChange(group_id)">
              </select>
            </div>

          </div>


          <table class="table table-striped table-bordered table-hover table-width ">
            <thead>
            <tr>
              <th width="3%" class="lt-width3 text-center"><label>
                <input type="checkbox" class="ace ng-pristine ng-valid ng-touched"
                       ng-model="isAll" ng-change="changeAllCheck(isAll)">
                <span class="lbl"></span> </label></th>
              <th width="15%" class="text-center">昵称</th>
              <th width="20%" class="text-center">所属代理商</th>
              <th width="20%" class="text-center">所属员工</th>
              <th width="20%" class="text-center">所属终端店</th>
              <th width="20%" class="text-center">所属分组</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="list in lists" ng-show="!list.isShow">
              <td class="text-center">
                <label>
                  <input type="checkbox" class="ace ng-pristine ng-valid ng-touched"
                         ng-model="list.ischoose"
                         ng-click="choose(list, 0)">
                  <span class="lbl"></span>
                </label>
              </td>
              <td class="text-center" ng-bind="list.nickname" ng-click="choose(list, 1)"></td>
              <td class="text-center" ng-bind="list.shopAgent.agent_name"
                  ng-click="choose(list, 1)"></td>
              <td class="text-center" ng-bind="list.belongStaff.real_name"
                  ng-click="choose(list, 1)"></td>
              <td class="text-center" ng-bind="list.shopInfo.name" ng-click="choose(list, 1)"></td>
              <td class="text-center" ng-bind="list.group_name" ng-click="choose(list, 1)"></td>
            </tr>
            <tr>
              <td colspan="7" ng-show="!lists.length" class="red text-center" ng-cloak>暂无数据</td>
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
  app.controller("userController", function ($scope, $timeout, $rootScope, $http) {
    //全选
    $scope.page = {};
    $scope.isAll = false;
    $scope.changeAllCheck = function (isAll) {
      $.each($scope.lists, function (a, b) {
        b.ischoose = isAll;
        if (isAll) {
          if ($rootScope.userList.indexOf(b) == -1)
            $rootScope.userList.push(b);
        } else {
          var ii = $rootScope.userList.indexOf(b);
          $rootScope.userList.splice(ii, 1);
        }
      });
    };
    $scope.choose = function (list, falg) {
      if (falg) {
        list.ischoose = !list.ischoose;
      }
      if (list.ischoose) {
        $rootScope.userList.push(list);
      } else {
        $.each($rootScope.userList, function (i, e) {
          if (e && e.id == list.id) {
            $rootScope.userList.splice(i, 1);
            return true;
          }
        })
      }
    };

    //选择用户
    function cardUserList(int) {
      $http.post("/member/list-ajax", {
        "_page": int,
        "_page_size": 10,
        "nickname": $scope.searchName ? $scope.searchName : '',
        "group_id": $scope.group_id ? $scope.group_id : '',
        "staff_id": $scope.staff_id ? $scope.staff_id : '',
        "shop_sub_id": $scope.shop_id ? $scope.shop_id : '',
        "agent_id": $scope.agent_id ? $scope.agent_id : ''
      }).success(function (msg) {
        $scope.lists = msg.errmsg.data;
        $scope.page = msg.errmsg.page;
        $scope.isAll = false;
        //获取不到昵称，则显示为 (游客)
        $scope.lists.forEach(function (i, e) {
          i.nickname = (i.nickname == false) ? "(游客)" : i.nickname;
        });
        complite();
      });
    };

    //确定
    $scope.btnConfirm = function () {
      if (!$rootScope.userList.length) return alert('请选择用户');
      $rootScope.userList = wsh.unique($rootScope.userList, 'id');

      $rootScope.$broadcast('chooseDlist', $rootScope.userList);
      $('#cardUserModal').modal('hide');
      $scope.isAll = false;
    };

    function complite() {
      if (!$rootScope.userList.length) return;
      for (var i in $scope.lists) {
        $scope.lists[i].ischoose = false;
        start : for (var j in $rootScope.userList) {
          if ($scope.lists[i].id == $rootScope.userList[j].id) {
            $scope.lists[i].ischoose = true;
            break start;
          }
        }
      }
    }

    $scope.shopList = null;
    $scope.agentList = null;
    SList(1);
    function SList(int) {
      $http.post('/terminal/list-ajax', {"_page_size": 100})
          .success(function (msg) {
            if (msg.errcode == "-503") {
              $scope.shopList = [{"id": 0, "shopInfo": {"name": "终端店没有权限"}}];
            }
            wsh.successback(msg, '', false, function () {
              $scope.shopList = msg.errmsg.data;
              $scope.shopList.unshift({"id": 0, "shopInfo": {"name": "所属终端店"}});
            });
          });
    }

    AList(1);
    function AList(int) {
      $http.post('/agent/list-ajax', {'nopid': true, "_page_size": 100})
          .success(function (msg) {
            if (msg.errcode == "-503") {
              $scope.agentList = [{"id": 0, "agent_name": "代理商没有权限"}];
            }
            wsh.successback(msg, '', false, function () {
              $scope.agentList = msg.errmsg.data;
              $scope.agentList.unshift({"id": 0, "agent_name": "所属代理商"})
            });
          });
    }

    //获取分组信息
    GList();
    function GList() {
      $http.post('/member/find-group')
          .success(function (msg) {
            if (msg.errcode == "-503") {
              $scope.groupList = [{"id": 0, "group_name": "全部分组"}];
            }
            wsh.successback(msg, '', false, function () {
              $scope.groupList = msg.errmsg ? msg.errmsg : [];
              $scope.groupList.unshift({"id": 0, "group_name": "所属分组"})
            });
          });
    }

    //获取员工列表
    StaffList();
    function StaffList() {
      $http.post('/staff/list-ajax', {'terminal_id': $scope.shop_id, "_page_size": 100})
          .success(function (msg) {
            if (msg.errcode == "-503") {
              $scope.staffList = [{"id": 0, "real_name": "全部员工"}];
            }
            wsh.successback(msg, '', false, function () {
              $scope.staffList = msg.errmsg.data;
              $scope.staffList.unshift({"id": 0, "real_name": "所属员工"})
            });
          });
    }

    $scope.staff_id = 0;
    $scope.staffChange = function (id) {
      $scope.staff_id = id;
    };

    $scope.group_id = 0;
    $scope.groupChange = function (id) {
      $scope.group_id = id;
    };

    $scope.shop_id = 0;
    $scope.shopChange = function (id) {
      $scope.shop_id = id;
      $scope.staff_id = 0;
      StaffList();
    };

    $scope.agent_id = 0;
    $scope.agentChange = function (id) {
      $scope.agent_id = id;
      $http.post('/member/shop-by-agent-ajax', {
        'agent_id': id == 0 ? '' : id
      }).success(function (msg) {
        wsh.successback(msg, '', false, function () {
          $scope.shopList = msg.errmsg.data;
          $scope.shopList.unshift({"id": 0, "shopInfo": {"name": "所属终端店"}})
        });
      });

      $scope.shop_id = 0;
      $scope.staff_id = 0;
      //重新获取所有员工
      StaffList();
    };
    var isGroupComplete = isListComplete = false;
    $scope.$watch('groupList', function (a) {
      if (a) {
        isGroupComplete = true;
        setGroupName()
      }
    });
    $scope.$watch('lists', function (a) {
      if (a) {
        isListComplete = true;
        setGroupName()
      }
    });
    function setGroupName() {
      if (isGroupComplete && isListComplete) {
        for (var i in $scope.lists) {
          for (var j in $scope.groupList) {
            var e = $scope.groupList[j];
            if (e.id != 0 && e.id == $scope.lists[i].group_id) {
              $scope.lists[i].group_name = e.group_name;
              continue;
            }
          }
        }
      }
    }

    //普通查询
    $scope.normalSearch = function () {
      cardUserList(1);
    };

    $('#cardUserModal').on('shown.bs.modal', function () {
      cardUserList(1);
    });

    $scope.options = {callback: cardUserList};
    cardUserList(1);

  });

</script>

