<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '确认核销';
?>
<link rel="stylesheet" href="/ace/css/colorbox.css"/>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner">
    <?php echo $this->render('@app/views/side/manage_setting.php'); ?>
    <div>
      <div class="main-content">
        <div class="breadcrumbs" id="breadcrumbs">
          <script type="text/javascript">
            try {
              ace.settings.check('breadcrumbs', 'fixed')
            } catch (e) {
            }
          </script>
          <ul class="breadcrumb">
            <li>确认核销</li>
          </ul>
        </div>
        <div class="page-content">
          <div class="space-8"></div>
          <div class="row">
            <div class="col-xs-12">

                <div class="tab-content">
                  <div class="">
                    <h4>订单信息</h4>
                    <div class="margin-bottom20">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="col-sm-8 margin-left10">
                            <form class="form-horizontal" role="form" >
                              <div class="form-group margin-bottom10 clearfix">
                                <div class="col-sm-2 width120 control-label">
                                  <span class="inline align-top"><strong>订单编号：</strong></span>
                                </div>
                                <div class="col-sm-8 margin-bottom5">
                                  <label class="inline align-top" ng-bind="order.order_no"></label>
                                </div>
                              </div>
                              
                              <div class="form-group margin-bottom10 clearfix">
                                <div class="col-sm-2 width120 control-label">
                                  <span class="inline align-top"><strong>付款方式：</strong></span>
                                </div>
                                <div class="col-sm-8 margin-bottom5">
                                  <span class="inline align-top" ng-bind="order.orderPayText" >

                                  </span>
                                </div>
                              </div>

                              <div class="form-group margin-bottom10 clearfix">
                                <div class="col-sm-2 width120 control-label">
                                  <span class="inline align-top"><strong>买家：</strong></span>
                                </div>
                                <div class="col-sm-8 margin-bottom5">
                                  <span class="inline align-top" ng-bind="order.user_name"></span>
                                </div>
                              </div>

                              <div class="form-group margin-bottom10 clearfix">
                                <div class="col-sm-2 width120 control-label">
                                  <span class="inline align-top"><strong>配送方式：</strong></span>
                                </div>
                                <div class="col-sm-8 margin-bottom5">
                                  <span class="inline align-top"  ng-if="order.pickup_type == 2">到店自提</span>
                                </div>
                              </div>

                              <div class="form-group margin-bottom10 clearfix">
                                <div class="col-sm-2 width120 control-label">
                                  <span class="inline align-top"><strong>提货门店：</strong></span>
                                </div>
                                <div class="col-sm-8 margin-bottom5">
                                  <span class="inline align-top" ng-bind="order.shopSub.shopInfo.name"></span>
                                </div>
                              </div>

                              <div class="form-group margin-bottom10 clearfix">
                                <div class="col-sm-2 width120 control-label">
                                  <span class="inline align-top"><strong>提货人：</strong></span>
                                </div>
                                <div class="col-sm-8 margin-bottom5">
                                  <span class="inline align-top" ng-bind="order.pickup_name"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                  <span class="inline align-top" ng-bind="order.pickup_phone"></span>
                                </div>
                              </div>

                              <div class="form-group margin-bottom10 clearfix">
                                <div class="col-sm-2 width120 control-label">
                                  <span class="inline align-top"><strong>提货时间：</strong></span>
                                </div>
                                <div class="col-sm-8 margin-bottom5">
                                  <span class="inline align-top" ng-bind="order.pickup_date * 1000 | date:'yyyy-MM-dd HH:mm'"></span>--
                                  <span ng-bind="(order.pickup_date+1800) * 1000 | date:'HH:mm'"></span>
                                </div>
                              </div>

                              <div class="form-group margin-bottom10 clearfix">
                                <div class="col-sm-2 width120 control-label">
                                  <span class="inline align-top"><strong>买家留言：</strong></span>
                                </div>
                                <div class="col-sm-8 margin-bottom5">
                                  <span class="inline align-top" ng-bind="order.customer_mark"></span>
                                </div>
                              </div>
                              
                              <div class="form-group margin-bottom10 clearfix">
                                <div class="col-sm-2 width120 control-label">&nbsp;</div>
                                <div class="col-sm-8 margin-bottom5">
                                  <table class="table table-striped table-bordered table-hover table-width action-buttons margin-bottom10">
                                    <thead>
                                      <tr>
                                        <td width="10%" class="text-center">序号</td>
                                        <td width="20%" class="text-center">商品编号</td>
                                        <td width="50%" class="text-center" style="width:280px;">商品/规格</td>
                                        <td width="20%" class="text-center">数量</td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td width="10%" class="text-center" ng-bind="$index+1"></td>
                                        <td width="10%" class="text-center" ng-bind="order.orderDetails[0].product_sku_id"></td>
                                        <td>
                                          <span class="block" ng-repeat="(kindKey , kindValue) in order.orderDetails[0].kinds">
                                            <span ng-bind="kindKey">
                                            </span>&nbsp;&nbsp;:&nbsp;&nbsp;<span ng-bind="kindValue"></span>
                                            </span>
                                          <span class="block">SKU码：
                                            <span ng-bind="order.orderDetails[0].sku_no"></span>
                                          </span>

                                        </td>
                                        <td width="10%" class="text-center" ng-bind="order.orderDetails[0].num"></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>

                              <!--<div class="form-group margin-bottom10 clearfix">
                                <div class="col-sm-2 width120 control-label">
                                  <span class="inline align-top"><strong>商家备注：</strong></span>
                                </div>
                                <div class="col-sm-8 margin-bottom5">
                                  <textarea name="" id="" class="form-control" style="height:120px;" maxlength="150" placeholder="请输入备注（选填），最多可输入150个字"></textarea>
                                </div>
                              </div>-->

                              <div class="form-group margin-bottom10 clearfix">
                                <div class="col-sm-2 width120 control-label">&nbsp;</div>
                                <div class="col-sm-8 margin-bottom5">
                                  <button class="btn btn-primary" ng-click="conVer()">确认核销</button><br>
                                  <span class="grey">订单核销后不可撤销</span>
                                </div>

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
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
  app.controller('mainController', function ($scope, $rootScope, $timeout,$http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'cc');
    }, 100);
//获取核销后的订单信息
    var cancelPickupCode = wsh.getHref('pickupCode') || '';
    getData(1);
      function getData(){
       $http.post('/order/get-self-pickup-order-ajax',{
         'pickup_code':cancelPickupCode,
       }).success(function(msg){
         wsh.successback(msg,'',false,function(){
           $scope.order = msg.errmsg;
         });
       });
      }
    //确认核销
    $scope.conVer = function(id){
      $http.post('/order/self-pickup-confirm-ajax',{
        'pickup_code':cancelPickupCode,
        'order_id':$scope.order.id
      }).success(function(msg){
        wsh.successback(msg,'核销成功',false,function(){
          window.location.href = '../terminal/write-off-web';
        });
      });
    }



  });
</script>
