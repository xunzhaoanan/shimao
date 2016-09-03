<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '短信账户';
?>
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
          <div class="inline margin-left12 margin-right10" ng-if="$root.hasPermission('sms/count-ajax')">
            <h4>短信数量 </h4>
            <form name="myform" novalidate="novalidate">
              <div class="infobox infobox-green" style="margin-left:-5px;">
                <div class="infobox-data">
                  <div class="infobox-content">短信余量</div>
                  <span class="infobox-data-number red "
                        style="font-size:14px; font-weight: normal"
                        ng-bind="dxlists.balance_num"></span>
                </div>
              </div>
              <div class="infobox infobox-green no-border">
                <div class="infobox-data">
                  <div class="infobox-content">待领取数量</div>
                  <a class="infobox-data-number pointer"
                     style="font-size:14px; font-weight: normal;margin-left:10px;padding:0;border-bottom: 1px solid #428bca" ng-href="/sms/seller-info"
                     ng-bind="dxlists.un_receive_gift_sms_num"></a>
                </div>
              </div>
            </form>
          </div>
          <a class="btn btn-sm btn-primary" ng-href="/sms/recharge" ng-if="$root.hasPermission('sms/recharge')">充值</a>
        </div>

        <div class="row" ng-show="$root.hasPermission('sms/list-ajax')">
          <div class="col-xs-12">
            <h4 class="margin-top20">发送统计</h4>

            <form novalidate="novalidate" class="form-horizontal " name="myform">
              <div class="margin-bottom10 clearfix">
                <label class=" float-left text-right  clearfix" for="form-field-1"
                       style="line-height: 25px;">发送时间：</label>

                <div class="input-group  float-left no-padding margin-left10">
                  <input type="text" id="start_time" class="Wdate hasDatepicker width150"
                         onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'2030-10-01'})">
                </div>

                <span class="float-left padding5 ">至</span>

                <div class="input-group  float-left  no-padding">
                  <input type="text" id="end_time" class="Wdate hasDatepicker width150"
                         onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'start_time\')}',maxDate:'2030-10-01'});">
                </div>

                <div class="margin-left20 float-left">
                  <label class=" float-left text-right  clearfix" for="form-field-1"
                         style="line-height: 25px;">接收号码：</label>

                  <div class="input-group  float-left no-padding margin-left10">
                    <input type="text" class="col-sm-3 no-float width150" name="phone"
                           ng-model="phone" placeholder="" required="required" ng-pattern="">
                    <!--<span ng-show="myform.phone.$error.pattern" class="red">{{$root.regMobileText}}</span>
                    <span ng-show="myform.phone.$error.required && istrue" class="red">必填项</span>-->

                  </div>
                </div>

                <div class="margin-left20 float-left">
                  <label class=" float-left text-right  clearfix" for="form-field-1"
                         style="line-height: 25px;">发送结果：</label>
                  <select class="margin-left10 width81"
                          ng-options="o.id as o.title for o in statusOption" ng-model="status">
                  </select>
                </div>

                <div class="margin-left20 float-left">
                  <a class="btn btn-xs btn-primary margin_right1" ng-click="seachSent()">搜索</a>
                </div>

                <form class="form-horizontal">
                  <table width="100%"
                         class="table table-striped table-bordered table-hover table-width action-buttons">
                    <thead>
                    <tr>
                      <th width="12%" class="text-center">发送时间</th>
                      <th width="12%" class="text-center">接收号码</th>
                      <th width="15%" class="text-center">发送场景</th>
                      <th width="20%" class="text-center">发送内容</th>
                      <th width="12%" class="text-center">计费数量</th>
                      <th width="12%" class="text-center">发送结果</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="list in lists">
                      <td class="text-center"><span ng-if="list.send_time" ng-bind="list.send_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></span></td>
                      <td class="text-center" ng-bind="list.mobile"></td>
                      <td class="text-center"
                          ng-bind="list.bossMessageType.name ? list.bossMessageType.name : ''"></td>
                      <td class="text-center blue pointer" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap" data-toggle="modal" data-target="#query"
                          ng-bind="list.send_content"
                          ng-click="textTook(list.send_content)"></td>
                      <td class="text-center" ng-bind="list.send_sms_num"></td>
                      <td class="text-center" ng-if="list.status == 1">发送成功</td>
                      <td class="text-center" ng-if="list.status == 2">发送失败（短信余量不足）</td>
                      <td class="text-center" ng-if="list.status == 3">发送失败（系统发送失败）</td>
                      <td class="text-center" ng-if="list.status == 4">发送中</td>
                    </tr>
                    <tr>
                      <td ng-show="!lists.length" colspan="6" class="red text-center">
                        暂时没有可展示的数据
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </form>
              </div>
            </form>

            <div ng-paginate options="options" page="page"></div>
          </div>
        </div>
      </div>
    </div>
    <!--发送内容的弹框-->
    <div class="bootbox modal fade in" id="query" tabindex="-1" role="dialog" open-close-modal
         aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header"><a type="button" class="bootbox-close-button close"
                                       data-dismiss="modal">×</a>
            <h4 class="modal-title">发送内容</h4>
          </div>
          <div class="modal-body">
            <div class="bootbox-body">
              <div>
                <div class="blcok width100"
                     style="height: 200px; border:1px solid #c0c0c0; padding: 5px;"
                     ng-bind="sentText" name="text"></div>
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
    $scope.model = [];
    $scope.status = 0;
    $scope.statusOption = [{"id": 0, "title": "全部"}, {"id": 1, "title": "成功"}, {
      "id": [2, 3],
      "title": "失败"
    }];
    var orderStart = '', orderEnd = '';

    getData(1);
    function getData(int) {
      $http.post(wsh.url + "list-ajax", {
          "_page": int,
          "_page_size": 15,
          "createStart": orderStart,
          "createEnd": orderEnd,
          "mobile": $scope.phone,
          "status": $scope.status
        })
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.lists = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
          });
        })
    }

    //分页
    $scope.options = {callback: getData};

    //短信消息
    getDxData(1);
    function getDxData() {
      $http.post(wsh.url + "count-ajax", {})
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.dxlists = msg.errmsg;
          });
        })
    }

    //查看内容的
    $scope.textTook = function (send_content) {
      //console.log(1111111,send_content)
      $scope.sentText = send_content;

    }

    //搜索

    $scope.seachSent = function () {
      orderStart = $('#start_time').val() ? new Date($('#start_time').val()) / 1000 : orderStart;
      orderEnd = $('#end_time').val() ? new Date($('#end_time').val()) / 1000 : orderEnd;
      getData(1);
    }
  });

</script>



