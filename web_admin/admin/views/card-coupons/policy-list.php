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
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/marketing.php');?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>卡券管理</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="tabbable">


              <ul class="nav nav-tabs tab-color-blue " id="myTab4">
                <li class=""><a href="/card-coupons/list">卡券列表 </a></li>
                <li class=""><a href="/card-coupons/receive-list">直接领取 </a></li>
                <li class="active"><a href="/card-coupons/policy-list">赠送策略</a></li>
                <li class=""><a href="/card-coupons/send-list">手动派发</a></li>
              </ul>

              <div class="tab-content">
                <div class="tab-pane active">
                  <div class="clearfix no-padding">
                    <div class="col-sm-7 no-padding">
                      <ul class="listli left-space1 btn-primary bune">
                        <li><a href="/card-coupons/policy-add"
                               ng-if="$root.hasPermission('card-coupons/policy-add')"
                               class="btn btn-xs btn-primary">新增赠送策略</a></li>
                      </ul>
                    </div>
                  </div>
                  <form class="form-horizontal">
                    <table width="100%"
                           class="table  margin-top15 table-striped table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th width="10%" class="text-center">规则名称</th>
                        <th width="10%" class="text-center">规则类型</th>
                        <th width="8%" class="text-center">规则内容</th>
                        <th width="15%" class="text-center">关联的卡券</th>
                          <th width="15%" class="text-center">订单限制</th>
                        <th width="7%" class="text-center">操作</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr ng-repeat="list in lists" ng-cloak>
                        <td class="text-center" ng-bind="list.name"></td>
                        <td class="text-center" ng-bind="typeOptions(list.type)">消费指定金额</td>
                        <td class="text-center"
                            ng-bind="list.type == 1?'消费金额'+list.amount/100+'元':'购买指定商品'"></td>
                        <td class="text-center" ng-bind="list.cardTypeInfo.title">微商户卡劵</td>
                          <td class="text-center" ng-bind="showOrderLimit(list.order_limit)"></td>
                        <td class="text-center">
                          <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                            <a class="blue pointer"
                               ng-if="$root.hasPermission('card-coupons/policy-edit')"
                               ng-href="{{'/card-coupons/policy-edit?id='+list.id}}" title="编辑">
                              <i class="icon-bianji bigger-130"></i>
                            </a>
                            <a class="red pointer" title="删除" ng-click="delete(list.id)">
                              <i class="icon-shanchu bigger-140"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="6" ng-show="!lists.length" class="red text-center" ng-cloak>
                          暂无数据
                        </td>
                      </tr>
                      </tbody>
                    </table>

                    <div ng-paginate options="options" page="page"></div>

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


<script>
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ec');
    }, 100);
    //分页
    $scope.options = {callback: getData};
    var int = 1;
    getData(int);
    function getData(int) {
      $http.post(wsh.url + 'policy-list-ajax', {"_page": int, "_page_size": 15})
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              $scope.lists = msg.errmsg.data;
              $scope.page = msg.errmsg.page;
              console.log($scope.page);
            })
          })
    }
    $scope.showOrderLimit =function(id) {
        switch (id) {
            case 1:
                return '适用于所有订单';
                break;
            case 2:
                return '适用于未使用卡券的订单';
                break;
            default :
                return '';
        }
    };
    //赠送策略
    $scope.typeOptions = function (id) {
      switch (id) {
        case 1:
          return '消费指定金额';
          break;
        case 2:
          return '购买指定商品';
          break;
        default :
          return '';
      }
    };

    $scope.delete = function (id) {
      wsh.setDialog('删除提示', '确定要删除吗', wsh.url + 'policy-del-ajax', {'id': id}, function () {
        getData(1);
      }, '删除成功！');
    };

  });

</script> 
