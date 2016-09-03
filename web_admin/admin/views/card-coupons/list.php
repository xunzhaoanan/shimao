<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '卡券列表';
?>

<div class="main-container" id="main-container" ng-controller="mainController">
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
          <li>卡券列表</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="tabbable">

              <ul class="nav nav-tabs tab-color-blue " id="myTab4">
                <li class="active"><a href="/card-coupons/list">卡券列表 </a></li>
                <li class=""><a href="/card-coupons/receive-list">直接领取 </a></li>
                <li class=""><a href="/card-coupons/policy-list">赠送策略</a></li>
                <li class=""><a href="/card-coupons/send-list">手动派发</a></li>
              </ul>

              <div class="tab-content">
                <div class="tab-pane active">
                  <div class="clearfix">
                    <a href="/card-coupons/add" ng-if="$root.hasPermission('card-coupons/add')"
                       class="btn btn-xs btn-primary float-left">新增卡券</a>
                    <a href="/card-coupons/card-voucher" target="_blank"
                       class="btn btn-xs btn-primary float-right">卡券帮助</a>
                  </div>
                  <div class="space-6"></div>
                  <form class="form-horizontal">
                    <table class="table table-striped table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th width="20%" class="text-center">卡券名称</th>
                        <th width="10%" class="text-center">卡券类型</th>
                        <th width="10%" class="text-center">所属平台</th>
                        <th width="35%" class="text-center">有效期</th>
                        <th width="15%" class="text-center">库存数</th>
                        <th width="15%" class="text-center">已发放</th>
                        <th width="15%" class="text-center">已核销</th>
                        <th width="10%" class="text-center">审核状态</th>
                        <th width="15%" class="text-center">操作</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr ng-repeat="list in lists" ng-cloak>
                        <td class="lt-width3 text-center" ng-bind="list.title"></td>
                        <td class="text-center" ng-bind="wxCardType(list.wx_card_type)"></td>
                        <td class="text-center" ng-bind="list.card_type == 1 ? '微商户': '微信'"></td>
                        <td class="text-center" ng-if="list.date_info_type==1">
                          <span ng-bind="list.begin*1000 | date:'yyyy-MM-dd'"></span>至
                          <span ng-bind="list.end*1000 | date:'yyyy-MM-dd'"></span>

                        </td>
                        <td class="text-center" ng-if="list.date_info_type==2">领取后<span ng-bind="list.begin == 0
                          ? '当' : list.begin"></span>天生效,<span ng-bind="list.end"></span>天有效
                        </td>
                        <td class="text-center" ng-bind="list.stock"></td>
                        <td class="text-center" ng-bind="giveOut(list.quantity, list.stock)"></td>
                        <td class="text-center" ng-bind="list.cancel_number"></td>
                        <td class="text-center" ng-bind="examineType(list.examine_type)"></td>
                        <td class="text-center">
                          <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                            <a class="grey" ng-href="{{'/card-coupons/card-record?id='+ list.id}}"
                               title="领取记录">
                              <i class="icon-renyuanjieshao bigger-130"></i> </a>
                            <a class="blue pointer" ng-if="$root.hasPermission('card-coupons/edit')"
                               title="编辑" ng-href="{{'/card-coupons/edit?id='+list.id}}">
                              <i class="icon-bianji bigger-130"></i>
                            </a>
                            <a class="red pointer" title="删除" ng-click="delete(list.id)">
                              <i class="icon-shanchu bigger-140"></i>
                            </a>

                          </div>
                        </td>
                      </tr>
                      <td colspan="9" ng-show="!lists.length" class="red text-center" ng-cloak>
                        暂无数据
                      </td>
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

<!--查看二维码-->
<div class="bootbox modal fade in" id="query" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
      <div class="modal-header"><a href="#" type="button" class="bootbox-close-button close"
                                   data-dismiss="modal">×</a>
        <h4 class="modal-title">查看商品二维码</h4>
      </div>
      <div class="modal-body bjge3 no-padding-bottom">
        <div class="bootbox-body">
          <img ng-src="{{$root.srcImg}}">
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
      $http.post('/card-coupons/list-ajax', {"_page": int, "_page_size": 15}).
          success(function (msg) {
            wsh.successback(msg, "", false, function () {
              $scope.lists = msg.errmsg.data;
              $scope.page = msg.errmsg.page;
              console.log($scope.lists);
            })
          }).
          error(function (msg) {
            console.log(msg);
          });
    }
   //卡券类型
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
     //审核状态
    $scope.examineType = function (type) {
      switch (type) {
        case 1:
          return '正常使用';
          break;
        case 2:
          return '审核中';
          break;
        case 3:
          return '审核失败';
          break;
        default :
          return '没有状态';
      }
    };

    $scope.giveOut = function (quantity, stock) {
      return quantity - stock;
    };

    //删除
    $scope.delete = function (id) {
      wsh.setDialog('删除提示', '确定要删除此卡券吗', '/card-coupons/del-ajax', {'id': id}, function () {
        getData(1);
      }, '删除成功！');
    };



  });

</script> 
