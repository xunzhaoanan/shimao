<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '编辑赠送策略';
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">
<!-- 关指定商品示例样式 -->
<link rel="stylesheet" href="/ace/js/selectize/orgsinfo.select.css"/>
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
                    <li>编辑赠送策略</li>
                </ul>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="space-10"></div>

                        <form class="form-horizontal" role="form" name="myform">

                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label">规则名称：</label>

                                <div class="col-sm-10">
                                    <input type="text" class="col-sm-4" name="name" ng-model="model.name"
                                           placeholder="" required="required">
                                    <span class="red" ng-show="myform.name.$error.required && isSubmit">必填项</span>
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label">赠送策略：</label>

                                <div class="col-sm-10" id="radio">
                                    <label>
                                        <input name="radio_money" type="radio" class="ace" id="radio1"
                                               ng-model="model.type" ng-change="changeType()" value="1">
                                        <span class="lbl" for="amount_trigger">消费指定金额 </span> </label>

                                    <label>
                                        <input name="radio_money" type="radio" class="ace" id="radio2"
                                               ng-model="model.type" ng-change="changeType()" value="2">
                                        <span class="lbl" for="goods_trigger"> 购买指定商品 </span>
                                    </label>

                                </div>
                            </div>

                            <div class="form-group clearfix" id="amount" ng-show="model.type == 1">
                                <label class="col-sm-2 control-label">消费金额：</label>

                                <div class="col-sm-10">
                                    <input type="text" ng-model="amountaa" name="amount" class="col-sm-4"
                                            id="amountVal" ng-pattern="" reg-money>
                                    <span class="red" ng-show="isAmout">必填项</span>
                                     <span class="red"
                                           ng-show="myform.amount.$error.pattern" ng-bind="$root.regMoneyText"></span>
                                </div>
                            </div>

                            <div class="form-group clearfix" id="goods_select" ng-show="model.type == 2">

                                <label class="col-sm-2 control-label">关联指定商品：</label>

                                <div class="col-sm-10 mar_b10"><a data-toggle="modal" data-target="#productModal"
                                                                  ng-click="$root.productObj = productLists"
                                                                  class="btn btn-xs btn-primary"> 选择商品 </a></div>
                                <div class="col-sm-8 table-responsive clearfix ">
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
                                                <div class="action-buttons"><a class="success pointer"
                                                                               ng-click="edit($index, list)"
                                                                               ng-show="list.isShowEdit" ng-cloak> <i
                                                            class="icon-pencil bigger-130"></i> </a> <a
                                                        class="red pointer"
                                                        ng-click="deleteProduct($index, list)"><i
                                                            class="icon-remove bigger-130"></i> </a></div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label">关联卡券：</label>

                                <div class="col-sm-10">
                                    <div class="col-sm-7 no-padding">
                                        <span class="form-control-static" name="cardTitle">
                                            <span ng-bind="model.cardTypeInfo.title"></span><a
                                                class="inline margin-left10 pointer"
                                                data-toggle="modal" data-target="#cardModal"
                                                ng-click="$root.$broadcast('selectedCardId', model.card_type_id)">重新选择</a>
                                        </span>


                                    </div>

                                </div>
                                <div class="text-left  margin-bottom10  margin-top20  text-warning orange font-size12">
                                    <i class="icon-exclamation-triangle "></i>
                                    提示：如果用户领取该卡券超过数量限制，赠送策略不会生效
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label">订单限制：</label>

                                <div class="col-sm-10">
                                    <select class="col-sm-3" ng-model="model.order_limit"
                                            ng-options="o.type as o.name for o in orderList"
                                            ng-change="changeStaue(typeId)"></select>
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
echo $this->render('@app/views/card-coupons/card-connect.php');
?>
<?php
echo $this->render('@app/views/card-coupons/card-product-index.php');
?>
<script>
    app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
        $timeout(function () {
            $rootScope.$broadcast('leftMenuChange', 'ec');
        }, 100);
        $scope.model = JSON.parse('<?= addslashe(json_encode($model))?>');
        console.log($scope.model);
        $scope.amountaa = $scope.model.amount / 100;
        $rootScope.choose_card_id = $scope.model.card_type_id;
        $scope.productLists = [];
        angular.forEach($scope.model.cardStrategyProducts, function (obj) {
            var products = {"id": obj.product_id, "name": obj.product.name};
            $scope.productLists.push(products);
        });

        $scope.orderList = [{type: 1, name: '适用于所有订单'}, {type: 2, name: '适用于未使用卡券的订单'}];
        $scope.changeStaue = function (id) {
            $scope.typeId = id;
        }
        if ($scope.model.type == 1) {
            $scope.productLists = [];
        } else {
            $scope.amountaa = '';
        }
        $scope.changeType = function () {
            if ($scope.model.type == 1) {
                $scope.productLists = [];
            } else {
                $scope.amountaa = '';
            }
        };
        $scope.saveBtn = function () {
            if ($scope.myform.$invalid) {
                $scope.isSubmit = true;
                return $timeout(function () {
                    $scope.isSubmit = false;
                }, 2000);
            }

            if ($scope.model.type == 1) {
                if (!$scope.amountaa) {
                    $scope.isAmout = true;

                    return $timeout(function () {
                        $scope.isAmout = false;
                    }, 2000);
                }
                if (!$scope.model.cardTypeInfo.title) return alert("请选择卡券!");
                $http.post(wsh.url + 'policy-edit-ajax', {
                    "id": $scope.model.id,
                    "name": $scope.model.name,
                    "type": $scope.model.type,
                    "amount": parseInt($scope.amountaa * 100),
                    "card_type_id": $scope.model.card_type_id,
                    'order_limit': $scope.model.order_limit
                }).success(function (msg) {
                    wsh.successback(msg, '编辑成功', false, function () {
                        window.location.href = "/card-coupons/policy-list";
                    })
                })
            } else {
                if ($scope.productLists.length == 0) return alert("请选择指定商品!");
                if (!$scope.model.cardTypeInfo.title) return alert("请选择卡券!");
                $http.post(wsh.url + 'policy-edit-ajax', {
                    "id": $scope.model.id,
                    "name": $scope.model.name,
                    "type": $scope.model.type,
                    "card_type_id": $scope.model.card_type_id,
                    "product_ids": $scope.product_id,
                    'order_limit': $scope.model.order_limit
                }).success(function (msg) {
                    wsh.successback(msg, '编辑成功', false, function () {
                        window.location.href = "/card-coupons/policy-list";
                    })
                })
            }
        };
        //选择卡券，与插件交互
        $scope.$on('chooseCard', function (e, json) {
//      $scope.title = json.title;
            $scope.model.cardTypeInfo.title = json.title;
            $scope.model.card_type_id = json.id;
        });
        //选择的商品  与插件交互
        $scope.product_id = [];
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
            console.log($scope.productLists)
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
