<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '派发管理';
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/marketing.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>手动派发</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="tabbable">

              <ul class="nav nav-tabs tab-color-blue " id="myTab4">
                <li class=""><a ng-if="$root.hasPermission('cash-redpack/list')"
                                href="/cash-redpack/list">现金红包 </a></li>
                <li class=""><a ng-if="$root.hasPermission('cash-redpack/policy-list')"
                                href="/cash-redpack/policy-list">赠送策略</a></li>
                <li class="active"><a ng-if="$root.hasPermission('cash-redpack/send-list')"
                                      href="/cash-redpack/send-list">手动派发</a></li>
              </ul>

              <div class="tab-content">
                <div class="tab-pane active">
                  <div class="clearfix no-padding">
                    <a href="/cash-redpack/send" ng-if="$root.hasPermission('cash-redpack/send')"
                       class="btn btn-xs btn-primary float-left">派送红包</a>
                    <select class="width120 float-right" ng-model="send"
                            ng-options="o.id as o.name for o in sendOption"
                            ng-change="change(send)">
                    </select>
                  </div>
                  <!--查询-->
                  <div class="clearfix no-padding margin-top10 ">
                    <div class="input-group  float-left margin-right10 ">
                      <label class="float-left padding5" for="form-field-1">红包类型：</label>
                      <select class="width120" ng-model="singleType"
                              ng-options="o.id as o.title for o in redpackOption">
                      </select>
                    </div>
                    <div class="input-group  float-left margin-right10 " ng-show="send == 1">
                      <label class="float-left padding5" for="form-field-1">状态：</label>
                      <select class="width81" ng-model="singleStatuss"
                              ng-options="o.id as o.title for o in statusOption">
                      </select>
                    </div>
                    <div class="input-group col-md-5 float-left no-padding">
                      <label class="float-left text-right padding5 "
                             for="form-field-1">派发时间： </label>

                      <div class="input-group col-md-4 float-left no-padding">
                        <input type="text" id="start_time" class="Wdate form-control hasDatepicker"
                               value=""
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});">
                      </div>
                      <span class="float-left padding5 "> 至 </span>

                      <div class="input-group col-md-4 float-left  no-padding">
                        <input type="text" id="end_time" class="Wdate form-control hasDatepicker"
                               value=""
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});">
                      </div>
                    </div>
                    <div class="input-group  float-left ">
                      <input class="text marginleft1 ng-pristine ng-untouched ng-valid" type="text"
                             ng-model="singleSearchName" placeholder="红包名称、昵称" value=""
                             ng-show="send == 1">
                      <input class="text marginleft1 ng-pristine ng-untouched ng-valid" type="text"
                             ng-model="singleSearchName" placeholder="红包名称、群组名称" value=""
                             ng-show="send == 2">
                        <span ng-click="normalSearch()">
                          <a class="btn btn-xs btn-primary align-top" style="margin-left:-4px;">
                            <i class="icon-search icon-on-right bigger-90"> </i>
                          </a>
                        </span>
                    </div>
                  </div>
                  <form class="form-horizontal" ng-show="send == 1">
                    <table width="100%"
                           class="table table-striped table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th width="5%" class="text-center">选择</th>
                        <th width="15%" class="text-center">红包名称</th>
                        <th width="10%" class="text-center">红包类型</th>
                        <th width="10%" class="text-center">红包金额</th>
                        <th width="8%" class="text-center">昵称</th>
                        <th width="15%" class="text-center">派送时间</th>
                        <th width="15%" class="text-center">状态</th>
                        <th width="7%" class="text-center">操作</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr ng-repeat="list in lists" ng-cloak>
                        <td class="text-center">
                          <label>
                            <input type="checkbox" class="ace ng-pristine ng-valid ng-touched"
                                   ng-model="list.ischoose" ng-click="choose(list)">
                            <span class="lbl"></span>
                          </label>
                        </td>
                        <td class="text-center" ng-bind="list.cashRedpack_act_name">红包名称</td>
                        <td class="text-center" ng-if="list.cashRedpack_type ==1">微信定额红包</td>
                        <td class="text-center" ng-if="list.cashRedpack_type ==2">微信随机红包</td>
                        <td class="text-center" ng-if="list.cashRedpack_type ==3">裂变红包</td>
                        <td class="text-center" ng-show="list.cashRedpack_type == 1"
                            ng-bind="(list.cashRedpack_min_value/100) | number:2"></td>
                        <td class="text-center" ng-show="list.cashRedpack_type == 2">
                          <span ng-bind="(list.cashRedpack_min_value/100) | number:2"></span> ~
                          <span ng-bind="(list.cashRedpack_max_value /100) | number:2"></span>
                        </td>
                        <td class="text-center" ng-show="list.cashRedpack_type == 3"
                            ng-bind="(list.cashRedpack_min_value/100) | number:2"></td>
                        <td class="text-center" ng-bind="list.nickname">昵称</td>
                        <td class="text-center"
                            ng-bind="list.send_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                        <td class="text-center" ng-bind="$root.showStatus(list)">已领取</td>
                        <td class="text-center">
                          <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                            <a class="grey pointer" title="更新状态"
                               ng-click="$root.updateStatus('S', list)"
                               ng-if="$root.hasPermission('cash-redpack/update-user-data-status-ajax')">
                              <i
                                  class="icon-refresh bigger-130"></i> </a>
                            <a class="pointer" title="重新发送" ng-click="$root.resend('S', list)"
                               ng-show="$root.isResend(list)"
                               ng-if="$root.hasPermission('cash-redpack/resend-ajax')"> <i
                                class=" icon-send bigger-130"></i> </a>
                          </div>
                        </td>
                      </tr>
                      <tr ng-show="lists.length">
                        <td class="text-center">
                          <label>
                            <input type="checkbox" class="ace ng-pristine ng-valid ng-touched"
                                   ng-model="isAll" ng-change="changeAllCheck(isAll)">
                            <span class="lbl"></span>
                          </label>
                        </td>
                        <td colspan="6"></td>
                        <td class="text-center">
                          <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                            <a class="grey pointer" title="批量更新状态"
                               ng-click="$root.updateStatus('B', uids)"> <i
                                class="icon-refresh bigger-130"
                                ng-if="$root.hasPermission('cash-redpack/update-user-data-status-ajax')"></i>
                            </a>
                            <a class="pointer" title="批量重新发送" ng-click="$root.resend('B', uids)"> <i
                                class=" icon-send bigger-130"
                                ng-if="$root.hasPermission('cash-redpack/resend-ajax')"></i> </a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="8" ng-show="!lists.length" class="red text-center" ng-cloak>
                          暂无数据
                        </td>
                      </tr>
                      </tbody>
                    </table>
                    <div ng-paginate options="options" page="page"></div>
                  </form>

                  <form class="form-horizontal" ng-show="send == 2">
                    <table width="100%"
                           class="table  margin-top15 table-striped table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th width="15%" class="text-center">红包名称</th>
                        <th width="10%" class="text-center">红包类型</th>
                        <th width="15%" class="text-center">红包金额</th>
                        <th width="10%" class="text-center">群组</th>
                        <th width="15%" class="text-center">派送时间</th>
                        <th width="8%" class="text-center">已领取数</th>
                        <th width="8%" class="text-center">未领取数</th>
                        <th width="8%" class="text-center">发送失败数</th>
                        <th width="8%" class="text-center">已退款数</th>
                        <th width="7%" class="text-center">操作</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr ng-repeat="glist in glists" ng-cloak>
                        <td class="text-center" ng-bind="glist.act_name">红包名称</td>
                        <td class="text-center" ng-if="glist.type ==1">微信定额红包</td>
                        <td class="text-center" ng-if="glist.type ==2">微信随机红包</td>
                        <td class="text-center" ng-if="glist.type ==1"
                            ng-bind="(glist.min_value * glist.quantity / 100)| number:2"></td>
                        <td class="text-center" ng-if="glist.type ==2"><span
                            ng-bind="(glist.min_value * glist.quantity / 100)| number:2"></span> ~
                          <span
                              ng-bind="(glist.max_value * glist.quantity / 100)  | number:2"></span>
                        </td>
                        <td class="text-center"><span ng-bind="glist.group_name"></span>(<span
                            ng-bind="glist.group_count"></span>)
                        </td>
                        <td class="text-center"
                            ng-bind="glist.send_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                        <td class="text-center" ng-bind="glist.received_num"></td>
                        <td class="text-center" ng-bind="glist.not_received_num"></td>
                        <td class="text-center" ng-bind="glist.failed_num"></td>
                        <td class="text-center" ng-bind="glist.refunded_num"></td>
                        <td class="text-center">
                          <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                            <a class="grey pointer" title="查看详细" data-toggle="modal"
                               data-target="#detailModal" ng-click="showJoinUser($index, glist)"
                               ng-if="$root.hasPermission('cash-redpack/join-user-list-ajax')"> <i
                                class="icon-mingchengpaixu bigger-130"></i> </a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="10" ng-show="!glists.length" class="red text-center" ng-cloak>
                          暂无数据
                        </td>
                      </tr>
                      </tbody>
                    </table>
                    <div ng-paginate options="goptions" page="gpage"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
    echo $this->render('@app/views/cash-redpack/detail.php');
?>
<script language="javascript" type="text/javascript"
        src="/ace/js/DatePicker/WdatePicker.js"></script>
<script>
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'eb');
    }, 100);
    var int = 1;
    //派发模式
    if (wsh.getHref('group')) {
      $scope.send = 2;
    } else {
      $scope.send = 1;
    }
    $scope.sendOption = [
      {"id": 1, "name": "单用户派发"}, {"id": 2, "name": "群组派发"}
    ];

    //切换派发
    $scope.change = function (id) {
      $scope.singleType = -1;
      $scope.singleStatuss = -1;
      $("#start_time").val("");
      $("#end_time").val("");
      $scope.singleSearchName = "";
      $scope.model = {"_page_size": 15};
      if ($scope.send == 1) {
        $scope.getData(1);
      } else {
        $scope.groupJoinUserList(1);
      }
      $scope.send = id;
    };
    $scope.model = {"_page_size": 15};
    $scope.getData = function (int) {
      $scope.model._page = int;
      $scope.model.group_id = 0; //单用户派发
      $http.post(wsh.url + 'send-list-ajax', $scope.model)
          .success(function (msg) {
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
            })
          }).error(function () {
            alert('网络忙！')
          });
    };

    //群组派发列表
    $scope.groupJoinUserList = function (int) {
      $scope.model._page = int;
      $http.post(wsh.url + 'group-join-user-list-ajax', $scope.model)
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              $scope.glists = msg.errmsg.data;
              $scope.gpage = msg.errmsg.page;
            })
          }).error(function () {

          });
    };
    $scope.getData(1);
    $scope.groupJoinUserList(1);
    $scope.options = {callback: $scope.getData};
    $scope.goptions = {callback: $scope.groupJoinUserList};
    $rootScope.objects = {};
    $scope.popfun = true;

    //规则类型
    $scope.singleType = -1;
    $scope.redpackOption = [
      {"id": -1, "title": "全部"}, {"id": 1, "title": "微信固定金额红包"}, {"id": 2, "title": "微信随机金额红包"}
    ];
    //状态
    $scope.singleStatuss = -1;
    $scope.statusOption = [
      {"id": -1, "title": "全部"}, {"id": 1, "title": "发放失败"}, {"id": 2, "title": "未领取"}, {
        "id": 3,
        "title": "已领取"
      }, {"id": 4, "title": "已退款"}, {"id": 5, "title": "发放中"}
    ];

    //显示发放状态
    $rootScope.showStatus = function (list) {
      var statusName = '', errName;
      switch (parseInt(list.status)) {
        case 1:
          switch (list.fail_code) {
            case 'QUANTITY_LIMIT':
              errName = '(数量不足)';
              break;
            case 'SENDNUM_LIMIT':
              errName = '(超过上限)';
              break;
            case 'FREQ_LIMIT':
              errName = '(频率限制)';
              break;
            case 'NOTENOUGH':
              errName = '(余额不足)';
              break;
            default :
              errName = '(系统原因)';
              break;
          }
          statusName = '发放失败' + errName;
          break;
        case 2:
          statusName = '未领取';
          break;
        case 3:
          statusName = '已领取(' + list.send_amount / 100 + '元)';
          break;
        case 4:
          statusName = '已退款(' + list.send_amount / 100 + '元)';
          break;
        case 5:
          statusName = '发放中';
          break;
        default :
          statusName = '';
          break;
      }
      return statusName;
    }
    //搜索
    $scope.normalSearch = function () {
      $scope.model.type = $scope.singleType != -1 ? $scope.singleType : '';
      //派发时间
      var start = $("#start_time").val(), end = $("#end_time").val();
      start = Math.floor(+new Date(start) / 1000);
      end = Math.floor(+new Date(end) / 1000);
      if (start >= end) {
        return alert('开始时间不能大于结束时间');
      }
      if (start && !end || !start && end) {
        return alert('开始时间和结束时间必须同时选择');
      }
      $scope.model.createStart = isNaN(start) ? null : start;
      $scope.model.createEnd = isNaN(end) ? null : end;
      if ($scope.send == 1) {
        $scope.model.keyword = $scope.singleSearchName ? $scope.singleSearchName : ''; //红包名称和昵称
        $scope.model.status = $scope.singleStatuss != -1 ? $scope.singleStatuss : '';
        $scope.getData(1);
      } else {
        $scope.model.keyword = $scope.singleSearchName ? $scope.singleSearchName : ''; //红包名称和群组名称
        $scope.groupJoinUserList(1);
      }
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
    };
    //是否可重新派发 数量不足不予重派
    $rootScope.isResend = function (obj) {
      return obj.status == 4 || (obj.status == 1 && obj.fail_code != 'QUANTITY_LIMIT');
    };
    //更新状态  （和弹层公用）
    var is_update_ajax = false;
    $rootScope.updateStatus = function (type, list) {
      if (type == 'B') { //批量更新
        var id = [];
        $.each(list, function (i, e) {
          id.push(i);
        });
      } else {
         id = list.id;
      }
      if (!id.length) {
        alert("请选择用户");
        return false;
      }
      if (is_update_ajax) return false;
      is_update_ajax = true;
      $http.post(wsh.url + 'update-user-data-status-ajax', {
        "id": id
      }).success(function (msg) {
        wsh.successback(msg, '更新状态成功', false, function () {
          var extUrl = '';
          if ($scope.send == 2) {
            extUrl = '?group=1';
          }
          window.location.href = '../cash-redpack/send-list' + extUrl;
        });
        is_update_ajax = false;
      }).error(function (msg) {
        is_update_ajax = false;
        alert('服务器忙！');
      });
    };

    //重新发送 （和弹层公用）
    var is_resend_ajax = false;
    $rootScope.resend = function (type, list) {
      if (type == 'B') { //批量发送
        var id = [], isSend = false;
        $.each(list, function (i, e) {
          //状态为
          if (!$scope.isResend(e)) {
            isSend = true;
            return false;
          } else {
            id.push(i);
          }
        });
        if (isSend) {
          alert('含有不可重发的用户,请重新选择！');
          return false;
        }
      } else {
         id = list.id;
      }
      if (!id.length) {
        alert("请选择用户");
        return false;
      }
      if (is_resend_ajax) return false;
      is_resend_ajax = true;
      $http.post(wsh.url + 'resend-ajax', {
        "id": id
      }).success(function (msg) {
        var txt = '';
        if (msg.errcode == 0) {
          switch (msg.errmsg.flag) {
            case 'ALLSUCCESS':
              txt = '派发成功';
              break;
            case 'ALLFAIL':
              txt = '派发失败';
              break;
            case 'PARTSUCCESS':
              txt = '部分派发成功';
              break;
          }
        }
        wsh.successback(msg, txt, false, function () {
          var extUrl = '';
          if ($scope.send == 2) {
            extUrl = '?group=1';
          }
          window.location.href = '../cash-redpack/send-list' + extUrl;
        });
        is_resend_ajax = false;
      }).error(function (msg) {
        is_resend_ajax = false;
        alert('服务器忙！');
      });
    };
    //参与人员
    $scope.showJoinUser = function (index, list) {
      $rootScope.$broadcast('detailModal', list);
    };

  });
</script> 
