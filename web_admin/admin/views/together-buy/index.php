<div class="bootbox modal fade in" id="productModal" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="productController">
    <div class="modal-dialog modal-dialog6">
        <div class="modal-content">
            <div class="modal-header modal-header2"><a class="bootbox-close-button close" data-dismiss="modal">×</a>
                <h4 class="modal-title">商品列表</h4>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <div class="tabbable ">
                        <div class="tab-content clearfix">
                            <!--商品-->
                            <div id="product" class="tab-pane in active">
                                <div class="table-responsive pre-scrollable">
                                    <div class="margin-bottom10 text-right">
                                        商品分类:
                                        <select down-select options="options" class="width120"
                                                ng-model="options.dataBack[0]"
                                                ng-options="o.{{options.dataName}} as o.name for o in options.dataOptions.firstOption">
                                        </select>
                                        <select class="width120 margin-left10" ng-model="options.dataBack[1]"
                                                ng-options="o.{{options.dataName}} as o.name for o in options.dataOptions.secondOption"
                                                ng-disabled="options.dataBack[0] == -1">
                                        </select>
                                        <select class="width120 margin-left10" ng-model="options.dataBack[2]"
                                                ng-options="o.{{options.dataName}} as o.name for o in options.dataOptions.thirdOption"
                                                ng-disabled="options.dataBack[0] == -1">
                                        </select>
                                        <input class="inline text-muted width-250px" placeholder="搜索相关关键字或商品名称或商品编码"
                                               type="text" value="" ng-model="searchCode">
                                        <span class="inline align-top"> <a ng-click="search()"
                                                                           class="btn btn-xs btn-primary align-top"><i
                                                    class="icon-search icon-on-right bigger-100"></i></a> </span>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-width">
                                        <thead>
                                        <tr>
                                            <th width="4%"></th>
                                            <th width="12%">商品图片</th>
                                            <th width="35%">商品名称</th>
                                            <th width="16%">商品分类</th>
                                            <th width="8%">库存</th>
                                            <th width="12%">销售价</th>
                                            <th width="12%"></th>
                                        </tr>
                                        </thead>
                                        <tbody ng-repeat="list in productLists">
                                        <tr class="products" ng-click="showChild(list, $index)">

                                            <td><i class="icon-ok bigger-120 green" ng-show="list.isshow"></i></td>

                                            <!--<td ng-bind="list.product_no"></td>-->
                                            <td><img class="goods-item-pic" ng-src="{{list.covers.file_cdn_path}}"
                                                     width="100%"></td>
                                            <td ng-bind="list.name">上装韩版宽松长袖t恤女款大码打底袖t恤</td>
                                            <td ng-bind="list.productCategory.name">分类一</td>
                                            <td ng-bind="list.reserves">23</td>
                                            <td ng-bind="list.show_price/100 | number: 2"></td>
                                            <td></td>
                                        </tr>
                                        <tr class="products_sku" ng-show="list.isshow">
                                            <td colspan="7" class="no-padding" width="100%">
                                                <table class="table table-striped table-hover table-width skuList">
                                                    <tbody>
                                                    <tr>
                                                        <!--<td width="3%" class="lt-width3 text-center"><label>
                                                            <input type="checkbox" class="ace" ng-model="list.ischeckAll" ng-change="checkAll(list)">
                                                            <span class="lbl"></span> </label></td>-->
                                                        <td width="3%">&nbsp;</td>
                                                        <td width="12%">商品编号</td>
                                                        <td width="35%">商品名称</td>
                                                        <td width="16%">库存</td>
                                                        <td width="20%">规格</td>
                                                        <td width="">零售价</td>
                                                    </tr>
                                                    <tr ng-repeat="listChild in list.productSkus"
                                                        ng-click="checkTr(listChild,list)"
                                                        ng-hide="listChild.ischoose || listChild.status != 1">
                                                        <td width="29">
                                                            <label>
                                                                <input type="radio" ng-model="prodSelected.id"
                                                                       ng-value="listChild.id"
                                                                       ng-disabled="listChild.reserves === 0">
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>
                                                        <td ng-bind="listChild.sku_no"> 20140829</td>
                                                        <td ng-bind="listChild.name"></td>
                                                        <td ng-bind="listChild.reserves">23</td>
                                                        <td><span ng-repeat="kind in listChild.kinds"> {{kind.name}}:{{listChild.kindValues[$index].name}} </span>
                                                        </td>
                                                        <td ng-bind="listChild.retail_price/100 | number: 2">150</td>
                                                    </tr>
                                                    <tr ng-repeat="listChild in list.productSkus"
                                                        ng-show="listChild.ischoose || listChild.status != 1">
                                                        <td colspan="6" class="text-center">规格下架或者已选中</td>
                                                    </tr>
                                                    </tbody>

                                                </table>
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>
                                    <p ng-show="!productLists.length" class="red text-center">暂无数据</p>
                                </div>
                                <div ng-paginate options="optionss" page="page"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"><a data-dismiss="modal" class="btn btn-default">取消</a> <a class="btn btn-primary"
                                                                                                ng-click="save()">确定</a>
            </div>
        </div>
    </div>
</div>
<!-- /.main-container-inner -->

<script type="text/javascript" src="/ace/js/downSelect.js"></script>
<script>
    app.controller('productController', function ($scope, $http, $rootScope) {
        $scope.options = {
            count: 3, //下拉框的数量
            urlArray: ['/product/category-list-ajax', '/product/category-list-ajax', '/product/category-list-ajax'], //每个下拉框对应的请求地址
            searchName: 'pid',
            dataName: 'id', //绑定的值
            data: {}, //第一次请求时发送的数据
            optionNames: ['请选择一级分类', '请选择二级分类', '请选择三级分类'], //默认文字
            notFindNames: ['该分类下没有数据', '该分类下没有数据'], //拿不到数据时显示的文字
            dataOptionName: 'name', //绑定的
            dataBack: [-1, -1, -1], //添加时传递 -1
            backDataName: true, // true errmsg.data || false errmsg
            dataOptions: {firstOption: [], secondOption: [], thitdOption: []}
        }
        var code, path;

        //保存选中的商品id
        $scope.prodSelected = {
            id: 0
        };
        $scope.checkTr = function (list,obj) {
            if (list.reserves === 0) {
                return false;
            }
            $scope.prodSelected.id = list.id;
            $scope.productArray = [];
            $scope.productArray.push(list);
            $scope.productArray[0].productName=obj.productCategory.name
        }
        $scope.search = function () {
            $scope.productArray = [];
            if ($scope.options.dataBack[2] == -1) {
                if ($scope.options.dataBack[1] == -1) {
                    if ($scope.options.dataBack[0] == -1) {
                        path = null;
                    } else {
                        path = $scope.options.dataBack[0];
                    }
                } else {
                    path = $scope.options.dataBack[1]
                }
            } else {
                path = $scope.options.dataBack[2]
            }
            code = $scope.searchCode;
            getProduct(1, 10, code, path);
        };
        var int = 1, productPaginate = null;

        //分页
        $scope.optionss = {callback: getProduct};
        getProduct(1, 10);
        $scope.page = {};
        $scope.productArray = [];

        function getProduct(int, size, searchCode, categoryId) {
            $http.post('/product/list-ajax', {
                '_page': int,
                '_page_size': size,
                'status': 1,
                'name': searchCode,
                'product_category_id': categoryId,
                'is_search': true,
                'sale_scope':[1,3]
            })
                .success(function (msg) {
                    wsh.successback(msg, '', false, function () {
                        $scope.productLists = msg.errmsg.data;
                        $scope.page = msg.errmsg.page;
                        if($scope.productLists.length > 0)
                        {
                            $scope.prodSelected.id = $scope.productLists[0].id
                        }

                    });
                })
        }


        //展示规格分类
        $scope.showChild = function (obj) {
            if (obj.isshow) {
                obj.isshow = false;
            } else {
                angular.forEach($scope.productLists, function (val) {
                    val.isshow = false;
                });
                obj.isshow = true;
            }
        };
        //确定函数

        $scope.save = function () {
            if (!$scope.productArray.length) return alert('请选择商品！');

            $rootScope.$broadcast('chooseProduct', $scope.productArray);
            $('#productModal').modal('toggle');
        };
        $('#productModal').on('shown.bs.modal', function (e) {
            getProduct(1, 10);

        });


        $('#productModal').on('hidden.bs.modal', function (e) {

        });

    });
</script> 
