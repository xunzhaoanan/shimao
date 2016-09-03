<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '新增赠送策略';
?>

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
          <li>新增赠送策略</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="space-10"></div>

            <form class="form-horizontal" role="form" name="myform" novalidate="novalidate">

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">规则名称：</label>

                <div class="col-sm-10">
                  <input type="text" class="col-sm-4" name="name" ng-model="name" placeholder=""
                         required="required">
                  <span class="red" ng-show="myform.name.$error.required && isSubmit">必填项</span>
                </div>
              </div>

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">规则类型：</label>

                <div class="col-sm-10" id="radio">
                  <label>
                    <input name="radio_money" id="amount_trigger" type="radio" ng-model="radio_money" ng-change="changeType()" value="1" class="ace" checked>
                    <span class="lbl" for="amount_trigger">消费指定金额 </span> </label>

                  <label>
                    <input name="radio_money" id="goods_trigger" type="radio" ng-model="radio_money" ng-change="changeType()" value="2" class="ace">
                    <span class="lbl" for="goods_trigger"> 购买指定商品 </span>
                  </label>
                </div>
              </div>

              <div class="form-group clearfix" id="amount" ng-show="radio_money == 1">
                <label class="col-sm-2 control-label">消费金额：</label>

                <div class="col-sm-10">
                  <input type="text" ng-model="amount" name="amount" class="col-sm-4" maxlength="10"
                         id="amountVal"
                         ng-pattern="" reg-money>
                  <span class="red" ng-show="isAmout">必填项</span>
                  <span class="red"
                        ng-show="myform.amount.$error.pattern" ng-bind="$root.regMoneyText"></span>
                </div>
              </div>

              <div class="form-group clearfix" id="goods_select" ng-show="radio_money == 2">
                <label class="col-sm-2 control-label">关指定商品：</label>

                <div class="col-sm-10 mar_b10">
                  <a data-toggle="modal" data-target="#productModal" class="btn btn-xs btn-primary"
                     ng-click="$root.copy('productObj', productLists)"> 选择商品 </a>
                </div>
                <div class="col-sm-8 table-responsive clearfix margin-top10">
                  <table class="table table-striped table-bordered table-hover table-width"
                         ng-show="productLists.length" ng-cloak>
                    <thead>
                    <tr>
                      <th width="90%">商品名称</th>
                      <th width="10%">操作</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <tr ng-repeat="list in productLists">
                      <td ng-bind="list.name"></td>
                      <td>
                        <div class="action-buttons">
                          <a class="success pointer" ng-click="edit($index, list)"
                             ng-show="list.isShowEdit" ng-cloak>
                            <i class="icon-pencil bigger-130"></i>
                          </a>
                          <a class="red pointer" ng-click="deleteProduct($index, list)"><i
                              class="icon-remove bigger-130"></i> </a>
                        </div>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">关联红包：</label>

                <div class="col-sm-10">
                      <span type="submit" data-toggle="modal" data-target="#redCashPackModal"
                            class="btn btn-xs btn-primary" ng-show="!actName">
                                                   选择红包
                                                </span>

                  <p class="form-control-static pointer" ng-show="actName">
                    {{actName}}<a href="javascript:void(0);" class="inline margin-left10"
                                  data-toggle="modal" data-target="#redCashPackModal">重新选择</a></p>

                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="space-32"></div>
        <!-- 确定 -->
        <div class="modal-footer margin-auto" id="modal-footer">
          <a id="post" ng-click="saveBtn()" class="btn btn-primary"> 保存 </a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
    echo $this->render('@app/views/cash-redpack/index.php');
?>
<?php
echo $this->render('@app/views/card-coupons/card-product-index.php');
?>
<script>
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'eb');
    }, 100);
    $scope.isAmout = false;
    $scope.teAmout = false;
    $scope.isSubmit = false;
    var is_send_ajax = false;
    //保存
      $scope.radio_money = $('#radio').find('input[type="radio"]')[0].checked ? 1 : 2;
      $scope.changeType = function () {
          if ($scope.radio_money == 1) {
              $scope.productLists = [];
          } else {
              $scope.amount = '';
          }
      };
    $scope.saveBtn = function () {
      if (is_send_ajax) return false;

      if ($scope.myform.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }


      if ($scope.radio_money == 1) {
          if (!$scope.amount) {
              $scope.isAmout = true;
              return $timeout(function () {
                  $scope.isAmout = false;
              }, 2000);
          }

          if (!$scope.actName) return alert("请选择红包!");
        is_send_ajax = true;
        $http.post(wsh.url + 'policy-add-ajax', {
          "name": $scope.name,
          "type": $scope.radio_money,
          "amount": parseInt($scope.amount * 100),
          "cash_redpack_id": $scope.id
        }).success(function (msg) {
          wsh.successback(msg, '添加成功', false, function () {
            window.location.href = "/cash-redpack/policy-list";
          })
          is_send_ajax = false;
        }).error(function () {
          alert("服务器忙！");
          is_send_ajax = false;
        });
      } else {
        if ($scope.productLists.length == 0) return alert("请选择指定商品!");
        if (!$scope.actName) return alert("请选择红包!");
        is_send_ajax = true;
        $http.post(wsh.url + 'policy-add-ajax', {
          "name": $scope.name,
          "type": $scope.radio_money,
          "cash_redpack_id": $scope.id,
          "product_ids": $scope.product_id
        }).success(function (msg) {
          wsh.successback(msg, '添加成功', false, function () {
            window.location.href = "/cash-redpack/policy-list";
          })
          is_send_ajax = false;
        }).error(function () {
          alert("服务器忙！");
          is_send_ajax = false;
        });
      }
    };

    //红包
    $scope.$on('chooseCashRedPack', function (e, json) {
      $scope.actName = json.act_name;
      $scope.id = json.id;
    });

    //选择的商品  与插件交互
    $scope.product_id = [];
    //选择的商品  与插件交互
    $scope.productLists = [];

    $rootScope.productObj = [];
    $scope.$watch('productLists.length', function () {
      $scope.product_id = [];
      angular.forEach($scope.productLists, function (obj) {
        $scope.product_id.push(obj.id);
      });
    });

    $scope.$on('chooseProduct', function (e, json) {
      $scope.productLists = [];
      var array = angular.copy(json);
      $.each(array, function (i, e) {
        if (e) {

          $scope.productLists = $scope.productLists.concat(e);
        }
      });
      $scope.productLists = wsh.unique($scope.productLists, 'id')
    });
    //删除
    $scope.deleteProduct = function (index) {
      wsh.setNoAjaxDialog('删除提示', '确定要删除？', function () {
        $scope.productLists.splice(index, 1);
      })
    };
  });
  function isBlur() {
    var reg = /^\d+\.?\d{0,2}$/;
    var amount = $("#amountVal").val();
    if (reg.test(amount.toString())) {
      return true;
    }
    else {
      alert("请输入大于等于0的数，若是小数，最多保留2位小数");
      return false;
    }
  }

</script> 
