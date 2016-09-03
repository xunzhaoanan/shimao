<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '短信账户';
?>

<style>

  .dx-cz-box {
    width: 100px;
    height: 70px;
    float: left;
    margin-right: 10px;
    display: table;
  }

  .dx-cz-box .table-cell {
    display: table-cell;
    vertical-align: middle;
  }

  .dx-cz-item {
    vertical-align: middle;
    text-align: center;
    border-width: 1px;
    border-style: solid;
    border-color: #6699ff;
    border-radius: 5px;
    cursor: pointer;
  }

  .dx-cz-item .dx-ts {
    font-size: 16px;
  }

  .dx-cz-item.blue {
    border-color: #6699ff
  }

  .dx-cz-item.blue .dx-ts {
    color: #6699ff
  }

  .dx-cz-item.red {
    border-color: #cc3300
  }

  .dx-cz-item.red .dx-ts {
    color: #cc3300
  }

  .dx-cz-item.yellow {
    border-color: #ff9900
  }

  .dx-cz-item.yellow .dx-ts {
    color: #ff9900
  }

  .dx-cz-item.green {
    border-color: #009933
  }

  .dx-cz-item.green .dx-ts {
    color: #009933
  }
</style>

<div class="main-container" id="main-container" ng-cloak>
  <script type="text/javascript">try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }</script>
  <div class="main-container-inner" ng-controller="mainController">
    <?php echo $this->render('@app/views/side/manage_setting.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }</script>
        <ul class="breadcrumb">
          <li>
            短信账户
          </li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">

            <div class=" dx-cz clearfix">
              <div class="dx-cz-box  align-middle">
                <div class="inline width101 " style="font-size: 18px;">充值:</div>
              </div>
              <div class="inline margin-left10">
                <div class="dx-cz-box dx-cz-item blue" ng-repeat="list in lists"
                     ng-click="searchImg(list.id)" ng-model="list.id" data-toggle="modal"
                     data-target="#query" ng-if="$root.hasPermission('sms/rechange-ajax')">
                  <div class="table-cell" ng-if="$root.hasPermission('sms/package-list-ajax')">
                    <div class="dx-ts"><a ng-bind="list.recharge_sms_num"></a>条</div>
                    <div class="dx-ts-jg"><span ng-bind="list.recharge_money | price"></span>元</div>
                    <div class="dx-zs-ts" ng-show="list.gift_sms_num != 0">另赠送<span
                        ng-bind="list.gift_sms_num"></span>条
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div ng-disabled="$root.hasPermission('sms/flow-list-ajax')">
              <div class="hr hr-20"></div>
              <h4 class="no-margin">充值流水：</h4>

              <div class="margin-top10 margin-bottom10 clearfix">
                <label class=" float-left text-right  clearfix" for="form-field-1"
                       style="line-height: 25px;">充值时间：</label>

                <div class="input-group  float-left no-padding margin-left10">
                  <input type="text" id="start_time" class="Wdate hasDatepicker width150"
                         onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'2030-10-01'})">
                </div>

                <span class="float-left padding5 ">至</span>

                <div class="input-group  float-left  no-padding">
                  <input type="text" id="end_time" class="Wdate hasDatepicker width150"
                         onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'start_time\')}',maxDate:'2030-10-01'});">
                </div>
                <div class="float-left margin-left10">
                  <label class=" float-left text-right  clearfix" for="form-field-1"
                         style="line-height: 25px;">充值单号：</label>

                  <div class="input-group  float-left no-padding margin-left10">
                    <input type="text" class="hasDatepicker width150" ng-model="order_no">
                  </div>
                </div>
                <div class="float-left margin-left10">
                  <label class=" float-left text-right  clearfix" for="form-field-1"
                         style="line-height: 25px;">充值类型：</label>
                  <select class="float-left margin-left10 margin-right10" ng-model="sourceType">
                    <option ng-repeat="source in sourceList" ng-bind="source.name" value="{{source.id}}"></option>
                  </select>
                </div>

                <div class="margin-bottom10">
                  <button class="btn btn-xs btn-primary margin_right1" ng-click="czSearch()">
                    搜索
                  </button>
                  <a class="inline align-middle blue hidden" ng-click="export()">导出搜索结果</a>
                </div>

              </div>
              <form class="form-horizontal">
                <table width="100%"
                       class="table table-striped table-bordered table-hover table-width action-buttons">
                  <thead>
                  <tr>
                    <th width="12%" class="text-center">充值时间</th>
                    <th width="12%" class="text-center">充值单号</th>
                    <th width="15%" class="text-center">充值类型</th>
                    <th width="20%" class="text-center">充值数量</th>
                    <th width="12%" class="text-center">套餐名称</th>

                  </tr>
                  </thead>
                  <tbody>
                  <tr ng-repeat="list in czLists">

                    <td class="text-center"
                        ng-bind="list.created*1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                    <td class="text-center" ng-bind="list.order_no"></td>
                    <td class="text-center" ng-if="list.recharge_type == 1">微信充值</td>
                    <td class="text-center" ng-if="list.recharge_type == 2">系统赠送</td>
                    <td class="text-center" ng-if="list.recharge_type == 2"
                        ng-bind="list.gift_sms_num"></td>
                    <td class="text-center" ng-if="list.recharge_type == 1"
                        ng-bind="list.recharge_sms_num+list.gift_sms_num"></td>

                    <td class="text-center" ng-bind="list.smsPackage.name"></td>


                  </tr>
                  <tr>
                    <td ng-show="!lists.length" colspan="5" class="red text-center">
                      暂时没有可展示的数据
                    </td>
                  </tr>
                  </tbody>
                </table>
              </form>
              <div ng-paginate options="options" page="page"></div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!--查看二维码的-->
    <div class="bootbox modal fade in" id="query" tabindex="-1" role="dialog" open-close-modal
         aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header"><a type="button" class="bootbox-close-button close"
                                       data-dismiss="modal">×</a>
            <h4 class="modal-title">查看充值二维码</h4>
          </div>
          <div class="modal-body">
            <div class="bootbox-body">
              <div class="center">
                <img class=" img-responsive margin-auto" style="width:430px" ng-src="{{wxLists}}">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script language="javascript" type="text/javascript"
        src="/ace/js/DatePicker/WdatePicker.js"></script>
<script>
  app.controller("mainController", function ($scope, $timeout, $rootScope, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ai');
    }, 100);
    //分页
    $scope.options = {callback: getData};
    var orderStart = '', orderEnd = '', order_no = '';
    $scope.order_no = '';
    //充值
    getList(1);
    function getList() {
      $http.post(wsh.url + "package-list-ajax", {
          "_page": 1,
          "_page_size": 100,
          "status": 1,
          "type": 1
        })
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.lists = msg.errmsg.data;
          });
        })
    }


    /*//导出搜索结果(隐藏)
    $scope.export = function () {
      window.location.href = "/export/sms-flow-list?page=0&count=1000&order_no=" + $scope.order_no + "&createStart=" + orderStart + "&createEnd=" + orderEnd + "&recharge_type=" + $scope.type
    }
*/
    //充值类型
    $scope.sourceType = '';
    $scope.sourceList = [{"id": '', "name": "全部"}, {"id": 1, "name": "微信充值"}, {
      "id": 2,
      "name": "系统赠送"
    }];
    //订单充值流水下的
    getData(1);
    function getData(int) {
      $http.post(wsh.url + "flow-list-ajax", {
          "_page": int,
          "_page_size": 15,
          "createStart": orderStart,
          "createEnd": orderEnd,
          "order_no": $scope.order_no,
          "recharge_type": $scope.sourceType,
          "status": 2
        })
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.czLists = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
          });
        })
    }

    //查看充值的二维码
    $scope.searchImg = function (id) {
      $http.post(wsh.url + "rechange-ajax", {
        "id": id
      }).success(function (msg) {
        wsh.successback(msg, '', false, function () {
          $scope.wxLists = msg.errmsg;
        });
      })
    }
    //搜索
    $scope.czSearch = function () {
      orderStart = $('#start_time').val() ? new Date($('#start_time').val()) / 1000 : orderStart;
      orderEnd = $('#end_time').val() ? new Date($('#end_time').val()) / 1000 : orderEnd;
      getData(1);
    }

  });

</script>

