<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '预约签到人员';
?>
<div class="main-container" id="main-container" ng-controller="mainController">
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
          <li>[{{model.title}}]预约签到人员</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class=" clearfix no-padding">
              <div class="col-sm-7 no-padding">
                <ul class="listli left-space1 btn-primary bune">
                  <li><a class="btn btn-xs btn-primary"
                         ng-href="{{'/export/reserve-join-user?id=' + model.id}}">下载预约名单</a></li>
                  <li><a class="btn btn-xs btn-primary"
                         ng-href="{{'/export/reserve-join-user?id=' + model.id + '&_status=2'}}">下载签到名单</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="space-6 clearfix col-sm-12"></div>
            <div class="table-responsive clearfix">
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                <tr ng-cloak>
                  <th width="10%" class="text-center">昵称</th>
                  <th width="10%" ng-repeat="list in head"
                      ng-bind="list.name" class="text-center"></th>
                  <th width="7%" class="text-center">状态</th>
                  <th width="7%" class="text-center">操作</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="userdata in userdatas" ng-cloak>
                  <td class="text-center" ng-bind="userdata[0].nickname"></td>
                  <td class="text-center" ng-repeat="u in userdata track by $index"
                      ng-bind="showText(u)"></td>
                  <td class="text-center" ng-bind="userStatus(userdata[0].status)">已预约</td>
                  <td class="text-center">
                    <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                      <a class="blue" data-toggle="modal"
                         title="编辑" ng-if="$root.hasPermission('reserve/join-user-ajax')"
                         ng-click="edit(userdata[0].id)">
                        <i class="icon-pencil bigger-130"></i>
                      </a>
                      <a class="blue" title="拒绝" ng-if="userdata[0].status == 1"
                         ng-click="oneRefuse(userdata[0].id)" href="javascript:void(0);">拒绝</a>
                      <a class="blue" title="通过" ng-if="userdata[0].status == 3"
                         ng-click="threePass(userdata[0].id)" href="javascript:void(0);">通过</a>
                      <a class="blue" ng-if="userdata[0].status == 2"
                         href="javascript:void(0);"></a>
                    </div>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
            <div ng-paginate options="options" page="page"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--编辑-->
<div class="bootbox modal fade in" id="myModal" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel"
     aria-hidden="true">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
      <div class="modal-header"><a href="#" type="button" class="bootbox-close-button close"
                                   data-dismiss="modal">×</a>
        <h4 class="modal-title">修改预约名单信息</h4>
      </div>
      <div class="modal-body">
        <div class="bootbox-body">
          <form class="form-horizontal">
            <div id="home" class="tab-pane in active row">

              <div class="form-group clearfix" ng-repeat="item in $root.newArray">
                <label class="col-sm-2 col-sm-offset-2 control-label"><span
                    ng-bind="item.key"></span>：</label>

                <div class="col-sm-8">
                  <input ng-if="item.type == 'text'" type="text" class="col-xs-8" name="sort"
                         ng-model="item.fillvalue" required>
                  <textarea class="form-control width90" style="height:160px"
                            ng-if="item.type == 'textarea'" ng-model="item.fillvalue"></textarea>
                  <input class="col-xs-8 datatime" ng-if="item.type == 'calendar'" type="text"
                         name="start" id="start_time"
                         onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'#F{$dp.$D(\'start_time\')}',maxDate:'2030-10-01'});"/>
                  <select class="col-xs-8" ng-if="item.type == 'select'" ng-model="item.fillvalue"
                          ng-options="o.title as o.title for o in select[$index]"
                          ng-change="$root.selectOption(item.fillvalue, $index, item.selectnum)">
                  </select>
                </div>
              </div>

            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <a data-bb-handler="confirm" class="btn btn-primary" ng-click="$root.saveBtn()"
           id="saveBtn">确定</a>
      </div>
    </div>
  </div>
</div>
<script language="javascript" type="text/javascript"
        src="/ace/js/DatePicker/WdatePicker.js"></script>
<script>
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http, $filter) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ed');
    }, 100);
    $scope.model = JSON.parse('<?= addslashe(json_encode($model)); ?>');
    $scope.items = JSON.parse($scope.model.items);
    $rootScope.itemspop = JSON.parse($scope.model.items);
   

    $scope.userStatus = function (status) {
      switch (status) {
        case 1:
          return "已预约";
          break;
        case 2:
          return "已签到";
          break;
        case 3:
          return "已拒绝";
          break;
        default:
          return "没有状态";
      }
    };
    //分页
    $scope.options = {callback: getData};
    var int = 1;
    getData(int);
    //获取参与人员列表
    function getData(int) {
      $http.post("<?= Url::to(['reserve/join-user-ajax']);?>", {
        "_page": int,
        "_page_size": 10,
        "id": $scope.model.id
      })
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              $scope.userdatas = msg.errmsg.data ? msg.errmsg.data.data : [];
              var headobj = [];
              for (var i in msg.errmsg.data.head) {
                headobj.push({"name": msg.errmsg.data.head[i].name});
              }
              $scope.head = msg.errmsg.data ? headobj : [];
              $scope.page = msg.errmsg.page;
              console.log("userdatas", msg.errmsg);
            });
          });

    }

    //保存
    $rootScope.saveBtn = function () {
      var numselect = 0, numcalender = 0;
      $scope.ajaxArray = {}, $scope.ajaxSelect = {}, $scope.ajaxCalender = {};
      var formErrorMsg = 0, mobileErrorMsg = 0, idCardErrorMsg = 0;
      $($rootScope.newArray).each(function (a, b) {
        if (b.type == "select") {
          $scope.ajaxSelect[b.nametag] = $scope.optionTitle[numselect];
          numselect++;
        }
        if (b.type == "calendar") {
          $scope.canlenderArray = [];
          for (var j = 0; j < $('.datatime').length; j++) {
            if ($(".datatime").eq(j).val() == "" || $(".datatime").eq(j).val() == "undefined") {
              formErrorMsg++;
            }
            $scope.canlenderArray.push(new Date($(".datatime").eq(j).val()) / 1000);
          }
          $scope.ajaxCalender[b.nametag] = $scope.canlenderArray[numcalender];
          numcalender++;
        }
        if (b.type != "select" && b.type != "calendar") {
          if (b.fillvalue == "" || b.fillvalue == "undefined") {
            formErrorMsg++;
          }
          if (b.nametag == "mobile") {
            if (!(/^1[0-9]{10}$/).test(b.fillvalue)) {
              mobileErrorMsg++;
            }
          }
          if (b.nametag == "idCard") {
            if (!(/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/.test(b.fillvalue))) {
              idCardErrorMsg++;
            }
          }
          $scope.ajaxArray[b.nametag] = b.fillvalue;
        }
      });
      if (formErrorMsg > 0) {
        return alert('请填写完整的信息！');
      }
      if (mobileErrorMsg > 0) {
        return alert('请填写正确的手机号码！');
      }
      if (idCardErrorMsg > 0) {
        return alert('请填写正确的身份证号码！');
      }
      $scope.mergeArray = $.extend({}, $scope.ajaxArray, $scope.ajaxSelect, $scope.ajaxCalender);
      console.log("mergeArray", $scope.mergeArray);

      $scope.datas = {//向后台传递的参数
        "id": $scope.userData.id,
        "user_id": $scope.userData.user_id,
        "reserve_setting_id": $scope.model.id,
        "user_data": $scope.mergeArray
      };
      $('#btnSave').attr('disabled', 'disabled');
      $http.post("../reserve/edit-user-data-ajax", $scope.datas)
          .success(function (msg) {
            $('#btnSave').removeAttr('disabled');
            wsh.successback(msg, '修改成功！', false, function () {
              getData(1);
              $('#myModal').modal('hide');
            });
          })
          .error(function (msg) {
            $('#btnSave').removeAttr('disabled');
            wsh.successback(msg);
          });
    };

    //显示
    $scope.showText = function (list) {
      if (list.type == 'calendar') {
//        alert(data);
        var data = $filter('date');
        return data(list.name * 1000, 'yyyy-MM-dd');
      }
      return list.name;
    };
    $scope.userData;
    $scope.edit = function (id) {
      $scope.editId = id;
      $http.post("<?= Url::to(['reserve/get-user-data']);?>", {
        "id": id,
        "reserve_setting_id": $scope.model.id
      })
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              $('#myModal').modal('show');
              $scope.editinput = JSON.parse(msg.errmsg.user_data);
              $scope.userData = msg.errmsg;
              console.log(msg.errmsg);
              var int = 0, selectnum = 0;
              $rootScope.newArray = [];
              $rootScope.select = [];
              $scope.optionTitle = [];
              $scope.calenderArray = [];
              $($rootScope.itemspop).each(function (a, b) {
                if (b.check == "true") {
                  for (var i in $scope.editinput) {
                    if (b.nametag == i) {
                      b.fillvalue = $scope.editinput[i];
                    }
                  }
                  if (b.type == 'select') {
                    b.selectnum = selectnum;
                    $rootScope.select[int] = [];
                    var arr = b.value.split('|');
                    for (var i = 0; i < arr.length; i++) {
                      $rootScope.select[int][i] = {title: arr[i]};
                    }
                    $scope.optionTitle.push(b.fillvalue);
                    selectnum++;
                  }
                  int++;
                  if (b.type == 'calendar') {

                    $scope.calenderArray.push(b.fillvalue);

                  }
                  $scope.newArray.push(b);
                }
              });
              setTimeout(function () {
                if ($('.datatime').length > 0) {
                  for (var k = 0; k < $('.datatime').length; k++) {
                    var time = new Date($scope.calenderArray[k]* 1000);
                    $('.datatime').eq(k).val(time.getFullYear() + "-" + (time.getMonth()+1 < 10 ? '0'+(time.getMonth()+1) : time.getMonth()+1) + "-" + (time.getDate() < 10 ? '0'+(time.getDate()) : time.getDate()));
                  }
                }
              }, 500);
            });
          });
    };

    $rootScope.selectOption = function (title, index, selectnum) {
      $scope.optionTitle[selectnum] = title;
    };
 //签到失败
    $scope.oneRefuse = function (id) {
      $http.post("<?= Url::to(['reserve/reject-ajax']);?>", {"id": id})
          .success(function (msg) {
            wsh.successback(msg, '拒绝成功', false, function () {
              getData(parseInt($scope.page.current_page) + 1);
            });
          });
    };
  //签到成功
    $scope.threePass = function (id) {
      $http.post("<?= Url::to(['reserve/pass-ajax']);?>", {"id": id})
          .success(function (msg) {
            wsh.successback(msg, '通过成功', false, function () {
              getData(parseInt($scope.page.current_page) + 1);
            });
          });
    };

  });
</script>
