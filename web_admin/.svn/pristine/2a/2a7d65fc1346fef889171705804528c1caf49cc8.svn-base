<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '拼团详情';
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">
<style type="text/css">
  .Bar {
    position: relative;
    width: 200px;
    /* 宽度 */
    border: 1px solid #B1D632;
    padding: 1px;
  }

  .Bar div, .Bars div {
    display: block;
    position: relative;
    background: #ccc; /* 进度条背景颜色 */
    color: #333333;
    height: 10px; /* 高度 */
    line-height: 10px;
    /* 必须和高度一致，文本才能垂直居中 */
  }

  .Bars div {
    background: #090
  }

  .Bar div span, .Bars div span {
    position: absolute;
    width: 200px;
    /* 宽度 */
    text-align: center;
    font-weight: bold;

  }

  .cent {
    margin: 0 auto;
    width: 300px;
    overflow: hidden
  }

  .tuanzhang {
    background: #52C522;
    display: inline-block;
    width: 70px;
    height: 19px;
    float: left;
    color: #fff;
  }

  .xuni {
    background: #c0c0c0;
    display: inline-block;
    width: 70px;
    height: 19px;
    float: left;
    color: #fff;
  }
</style>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner">
    <?php echo $this->render('@app/views/side/marketing.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>
            拼团详情
          </li>
        </ul>
        <!-- .breadcrumb -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <div class="tabbable">
              <h4>拼团商品</h4>

              <div class="tab-content margin-bottom20 ">
                <div class="clearfix">
                  <form class="form-horizontal" role="form">
                    <div class=s"pace-6">
                      <table class="table table-striped table-bordered table-hover table-width">
                        <thead>
                        <tr>
                          <th width="20%" class="text-center">商品名称</th>
                          <th width="15%" class="text-center">商品图片</th>
                          <th width="20%" class="text-center">规格</th>
                          <th width="15%" class="text-center">销售价</th>
                          <th width="10%" class="text-center">团购价</th>
                          <th width="10%" class="text-center">库存</th>
                          <th width="10%" class="text-center">配额</th>
                          <th width="15%" class="text-center">参团人数要求</th>
                          <th width="10%" class="text-center">每人限购</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-cloak>
                          <td class="text-center"><span ng-bind="togetherBuyGoods.product_name"></span></td>
                          <td class="text-center"><img class="goods-item-pic"
                                                       ng-src="{{product.covers.file_cdn_path}}">
                          </td>
                          <td class="text-center"><span ng-repeat="kind in productSku.kinds"> {{kind.name}}:{{findKindValues(kind.id)}} </span>
                          </td>
                          <td class="text-center" ng-bind="market_price | price"></td>
                          <td class="text-center" ng-bind="buy_price"></td>
                          <td class="text-center" ng-bind="productSku.reserves"></td>
                          <td class="text-center" ng-bind="togetherBuyGoods.quota"></td>
                          <td class="text-center" ng-bind="togetherBuyGoods.together_num"></td>
                          <td class="text-center" ng-bind="togetherBuyGoods.limit_buy"></td>
                        </tr>

                        </tbody>
                      </table>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <h4>
              拼团状态
            </h4>

            <div class="tab-content margin-bottom20 ">
              <div class="clearfix">
                <form class="form-horizontal" ro;e="form">
                  <div class=s"pace-6">
                  </div>
                  <div class="form-group padding5 clearfix">
                    <table
                      class="table table-striped table-bordered table-hover no-margin table-width">
                      <thead>
                      <tr>
                        <th width="20%" class="text-center">进度</th>
                        <th width="10%" class="text-center">状态</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr ng-cloak>
                        <td>
                          <div class="cent">
                            <div class="Bar float-left">
                              <div style="width: {{width}}%;">
                                <span>{{width}}%</span>
                              </div>
                            </div>
                            <div class="float-right">
                              <span ng-bind="model.joinCount">8</span>/<span
                                ng-bind="togetherBuyGoods.together_num">10</span>
                            </div>
                          </div>
                        </td>
                        <td class="text-center" ng-bind="showStatus(model.status,list.close_reason)">未满员</td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </form>
              </div>
            </div>


            <h4>拼团成员</h4>

            <div class="tab-content margin-bottom20 ">
              <div class="clearfix">
                <form class="form-horizontal" ro;e="form">
                  <div class=s"pace-6">
                    <table class="table table-striped table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th width="20%" class="text-center">微信昵称</th>
                        <th width="10%" class="text-center">团购件数</th>

                      </tr>
                      </thead>
                      <tbody>
                      <tr ng-repeat="list in lists" ng-cloak>
                        <td class="text-center">
                          <span class="tuanzhang" ng-show="list.is_head == 2">团长</span>
                          <span class="xuni" ng-show="list.uid == 0">虚拟团员</span>
                          <span class="margin-left15" ng-bind="list.userInfo.nickname"></span>
                        </td>
                        <td class="text-center" ng-bind="list.num"></td>
                      </tr>

                      <tr ng-cloak ng-show="!lists.length || !lists" class="center">
                        <td colspan="2">暂无数据</td>
                      </tr>

                      </tbody>
                    </table>
                  </div>
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


<script>
  app.controller("mainController", function ($scope, $http, $rootScope, $timeout) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'da');
    }, 100);
    $scope.model = JSON.parse('<?= addslashe(json_encode($model))?>');
    $scope.togetherBuyGoods = $scope.model.togetherBuyGoods;
    $scope.productSku = $scope.togetherBuyGoods.productSku ? $scope.togetherBuyGoods.productSku : [];//商品sku
    $scope.product = $scope.productSku.product ? $scope.productSku.product : '';//商品
    $scope.market_price = $scope.productSku ? $scope.productSku.market_price : 0;//销售价
    console.log($scope.model)
    $scope.buy_price = $scope.togetherBuyGoods.buy_price / 100;//团购价
    var joinCount = parseInt($scope.model.joinCount); //参加人数
    var togetherNum = parseInt($scope.togetherBuyGoods.together_num); //参团总人数
    $scope.width = (joinCount / togetherNum * 100).toFixed(3); //进度条宽度
    var id = wsh.getHref('id');//获取url的id
    //拼团成员列表
    var int = 1;
    getFindJoinByQueue(int);
    function getFindJoinByQueue(int) {//请求列表
      $http.post("<?= Url::to(['/together-buy/find-join-by-queue-ajax']);?>", {
          "_page": int,
          "_page_size": 15,
          "together_buy_queue_id": id
        })
        .success(function (msg) {
          wsh.successback(msg, "", false, function () {
            $scope.lists = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
          })
        });
    }

    //获取产品规格值
    $scope.findKindValues = function (kindId) {
      $.each($scope.productSku.kindValues, function (i, e) {
        if (kindId == e.product_kind_id) {
          $scope.kindName = e.name;
        }

      });
      return $scope.kindName;
    };
    //分页
    $scope.options = {callback: getFindJoinByQueue};

    //拼团状态
    $scope.showStatus = function (status, reason) {
      switch (status) {
        case 1:
          return '已创建未开启';
          break;
        case 2:
          return '进行中';
          break;
        case 3:
          return '拼团成功';
          break;
        case 4:
          if (!reason) {
            return '拼团失败';
          } else {
            return '操作员关闭';
          }
          break;
      }
    };

  });
</script>