<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '赠送策略';
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
                    <li>赠送策略</li>
                </ul>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="tabbable">


                            <ul class="nav nav-tabs tab-color-blue " id="myTab4">
                                <li class=""><a ng-if="$root.hasPermission('cash-redpack/list')"
                                                href="/cash-redpack/list">现金红包 </a></li>
                                <li class="active"><a ng-if="$root.hasPermission('cash-redpack/policy-list')"
                                                      href="/cash-redpack/policy-list">赠送策略</a></li>
                                <li class=""><a ng-if="$root.hasPermission('cash-redpack/send-list')"
                                                href="/cash-redpack/send-list">手动派发</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active">
                                    <div class="clearfix no-paddind ">
                                        <a href="/cash-redpack/policy-add"
                                           ng-if="$root.hasPermission('cash-redpack/policy-add')"
                                           class="btn btn-xs btn-primary float-left">新增赠送策略</a>

                                        <!--查询-->
                                        <div class="clearfix no-padding float-right">
                                            <div class="input-group  float-left margin-right10 ">
                                                <label class="float-left padding5" for="form-field-1">规则类型：</label>
                                                <select class="width120" ng-model="type"
                                                        ng-options="o.id as o.title for o in ruleType">
                                                </select>
                                            </div>
                                            <div class="input-group  float-left margin-right10 ">
                                                <label class="float-left padding5" for="form-field-1">状态：</label>
                                                <select class="width120"
                                                        ng-options="o.id as o.title for o in statusOption"
                                                        ng-model="status">
                                                </select>
                                            </div>
                                            <div class="input-group  float-left ">
                                                <input class="text marginleft1 ng-pristine ng-untouched ng-valid"
                                                       type="text"
                                                       ng-model="searchName" placeholder="搜索关键词">
                                              <span ng-click="normalSearch()">
                                                <a class="btn btn-xs btn-primary align-top"
                                                   style="margin-left:-4px;">
                                                    <i class="icon-search icon-on-right bigger-90">
                                                    </i>
                                                </a>
                                              </span>
                                            </div>
                                        </div>

                                        <form class="form-horizontal">
                                            <table width="100%"
                                                   class="table  margin-top15 table-striped table-bordered table-hover table-width">
                                                <thead>
                                                <tr>
                                                    <th width="10%" class="text-center">规则名称</th>
                                                    <th width="10%" class="text-center">规则类型</th>
                                                    <th width="8%" class="text-center">规则条件</th>
                                                    <th width="15%" class="text-center">关联红包</th>
                                                    <th width="15%" class="text-center">状态</th>
                                                    <th width="7%" class="text-center">操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr ng-repeat="list in lists" ng-cloak>
                                                    <td class="text-center" ng-bind="list.name"></td>
                                                    <td class="text-center" ng-bind="typeOptions(list.type)">消费指定金额</td>
                                                    <td class="text-center"
                                                        ng-bind="list.type == 1?'消费金额'+list.amount/100+'元':'购买指定商品'"></td>
                                                    <td class="text-center" ng-bind="list.redpack.act_name"></td>
                                                    <td class="text-center">
                                                        <label>
                                                            <input name="switch-field-1"
                                                                   class="ace ace-switch ace-switch-6 ng-pristine ng-valid ng-touched ng-scope"
                                                                   ng-change="changeRule($index, list)"
                                                                   ng-model="list.ischoose"
                                                                   type="checkbox"
                                                                   ng-disabled="!$root.hasPermission('cash-redpack/open-strategy-ajax')">
                                                            <span class="lbl"></span>
                                                        </label></td>
                                                    <td class="text-center">
                                                        <div
                                                            class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                                                            <a class="blue pointer"
                                                               ng-if="$root.hasPermission('cash-redpack/policy-edit')"
                                                               ng-href="{{'/cash-redpack/policy-edit?id='+list.id}}"
                                                               title="编辑">
                                                                <i class="icon-bianji bigger-130"></i>
                                                            </a>
                                                            <a class="red pointer" title="删除" ng-click="delete(list.id)"
                                                               ng-if="$root.hasPermission('cash-redpack/del-strategy-ajax')">
                                                                <i class="icon-shanchu bigger-140"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" ng-show="!lists.length" class="red text-center"
                                                        ng-cloak>
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
</div>

<script>
    app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
        $timeout(function () {
            $rootScope.$broadcast('leftMenuChange', 'eb');
        }, 100);

        var int = 1;
        $scope.model = {"_page_size": 15};
        getData(int);
        function getData(int) {
            $scope.model._page = int;
            $http.post(wsh.url + 'policy-list-ajax', $scope.model)
                .success(function (msg) {
                    wsh.successback(msg, '', false, function () {
                        $scope.lists = msg.errmsg.data;
                        $scope.page = msg.errmsg.page;
                        $.each($scope.lists, function (i, e) {
                            e.ischoose = e.deleted == 1 ? true : false;
                            e.isdisabled = false;
                        });
                    })
                })
        }

        //规则类型
        $scope.type = -1;
        $scope.ruleType = [
            {'id': -1, 'title': '全部'}, {'id': 1, 'title': '消费指定金额'}, {'id': 2, 'title': "购买指定商品"}
        ];
        //状态
        $scope.status = -1;
        $scope.statusOption = [
            {'id': -1, 'title': '全部'}, {'id': 1, 'title': '开启'}, {'id': 2, 'title': "关闭"}
        ];
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
            wsh.setDialog('删除提示', '确定要删除吗', wsh.url + 'del-strategy-ajax', {'id': id}, function () {
                getData(1);
            }, '删除成功！');
        };

        //分页
        $scope.options = {callback: getData};
        //搜索
        $scope.normalSearch = function () {
            $scope.model.deleted = $scope.status != -1 ? $scope.status : '';
            $scope.model.type = $scope.type != -1 ? $scope.type : '';
            $scope.model.name = $scope.searchName ? $scope.searchName : '';
            getData(1);
        };

        //开启和关闭
        $scope.changeRule = function (index, obj) {
            obj.isdisabled = true;

            if (obj.ischoose) {
                $http.post(wsh.url + 'open-strategy-ajax', {id: obj.id})
                    .success(function (msg) {
                        wsh.successback(msg, '开启成功', false, '', function () {
                            if (msg.errcode == 0) {
                                obj.isdisabled = false;
                            } else {
                                obj.ischoose = obj.ischoose == true ? false : true;
                            }
                        });

                    })
            } else {
                $http.post(wsh.url + 'close-strategy-ajax', {id: obj.id})
                    .success(function (msg) {
                        wsh.successback(msg, '关闭成功', false, '', function () {
                            if (msg.errcode == 0) {
                                obj.isdisabled = false;
                            } else {
                                obj.ischoose = obj.ischoose == true ? false : true;
                            }
                        });

                    })
            }
        };

    });

</script>
