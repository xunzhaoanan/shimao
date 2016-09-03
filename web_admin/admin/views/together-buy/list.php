<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '拼团活动管理';
?>
<div class="main-container" id="main-container" ng-controller="mainController">
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
                    <li>拼团活动管理</li>
                </ul>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="clearfix no-padding">

                            <a  ng-if="$root.hasPermission('together-buy/add')" href="/together-buy/add"
                                           class="btn btn-xs btn-primary float-left">添加活动</a>
                            <a   href="/together-buy/voucher"
                                            class="btn btn-xs btn-primary float-right">拼团活动使用说明</a>

                        </div>
                        <div class="space-6 clearfix col-sm-12"></div>
                        <div class="table-responsive clearfix">
                            <table class="table table-striped table-bordered table-hover table-width">
                                <thead>
                                <tr>
                                    <th width="10%" class="text-center">活动单元名称</th>
                                    <th width="10%" class="text-center">活动类型</th>
                                    <th width="10%" class="text-center">参团人数要求</th>
                                    <th width="15%" class="text-center">开始时间</th>
                                    <th width="15%" class="text-center">结束时间</th>
                                    <th width="10%" class="text-center">状态</th>
                                    <th width="20%" class="text-center">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="list in lists" ng-cloak>
                                    <td class="text-center" ng-bind="list.name"></td>
                                    <td class="text-center" ng-bind="shareType(list.share_type)"></td>
                                    <td class="text-center" ng-bind="showTogetherNum(list.togetherBuy)"></td>
                                    <td class="text-center"
                                        ng-bind="list.start_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                                    <td class="text-center"
                                        ng-bind="list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                                    <td class="text-center">
                                        <label>
                                            <input name="switch-field-1"  ng-disabled="!$root.hasPermission('together-buy/open-ajax')"
                                                   class="ace ace-switch ace-switch-6" ng-model="list.ischoose"
                                                   type="checkbox" ng-click="statues($index, list)">
                                            <span class="lbl"></span>
                                        </label>
                                    </td>

                                    <td class="text-center">
                                        <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

                                            <a title="参团详情" ng-if="$root.hasPermission('together-buy/tuxedo-detail')"
                                               ng-href="{{'/together-buy/tuxedo-detail?id=' + list.id}}"
                                               class="success pointer">
                                                <i class="icon-mingchengpaixu bigger-140 text-decoration">
                                                </i>
                                            </a>
                                            <a target="_blank"
                                               ng-href="{{'/activity/qrcode?model=togetherbuy&model_id='+list.id}}"
                                               class="ng-pristine ng-valid ng-touched" title="查看二维码">
                                                <i class="icon-erweima bigger-130"></i>
                                            </a>
                                            <a class="blue pointer" ng-if="$root.hasPermission('together-buy/edit-news')"
                                               title="编辑" ng-href="{{'/together-buy/edit-news?id=' + list.id}}">
                                                <i class="icon-bianji bigger-130"></i>
                                            </a>
                                            <a class="red pointer" ng-show="list.deletedFlag" ng-if="$root.hasPermission('together-buy/del-ajax')" title="删除" ng-click="delete(list.id)">
                                                <i class="icon-shanchu bigger-140"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                                <tr ng-cloak ng-show="!lists.length || !lists" class="center">
                                    <td colspan="7">暂无数据</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div ng-paginate options="options" page="page"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
        $timeout(function () {
            $rootScope.$broadcast('leftMenuChange', 'ea');
        }, 100);

        //分页
        $scope.options = {callback: getData};
        var int = 1;//第一页
        getData(int);
        function getData(int) {//请求列表
            $http.post("<?= Url::to(['/together-buy/list-ajax']);?>", {"_page": int, "_page_size": 15,deletedFlag:1})
                .success(function (msg) {
                    wsh.successback(msg, "", false, function () {
                        $scope.lists = msg.errmsg.data;
                        $scope.page = msg.errmsg.page;
                        $.each($scope.lists, function (a, b) {
                            b.ischoose = b.deleted == 1 ? true : false;  //deleted  1是开启，2是关闭
                        });

                    })
                });
        }

        //活动类型
        $scope.shareType = function (id) {
            switch (id) {
                case 1:
                    return '开放性活动';
                    break;
                case 2:
                    return '线下分享活动';
                    break;
                case 3:
                    return '线下活动';
                    break;
                default :
                    return '没有活动类型';
            }
        };

        //参团人数要求
        $scope.showTogetherNum = function (obj) {
            var arr;
            if (obj) {

                if (obj.togetherBuyGoods && obj.togetherBuyGoods.length > 0) {

                    arr = obj.togetherBuyGoods[0].together_num;
                } else {
                    arr = '未设置商品';
                }

            } else {
                arr = '未设置商品';
            }
            return arr;
        }

        //删除
        $scope.delete = function (id) {
            dialog({
                zIndex: 9999998,
                title: "活动删除提示",
                content: "确定要删除此活动吗?",
                okValue: "删除",
                ok: function () {
                    $http.post("<?= Url::to(['/together-buy/del-ajax']);?>", {"id": id})
                        .success(function (msg) {
                            wsh.successback(msg, '删除成功', false, function () {
                                getData(1);
                            });
                        });
                },
                otherBtnValue: "取消",
                otherBtn: function () {
                }
            }).width(320).showModal();
        };


        //状态
        $scope.statues = function (index, obj) {
           // obj.isdisabled = true;
            if (!obj.ischoose) { //关闭
                $http.post("<?= Url::to(['/together-buy/close-ajax']);?>", {"id": obj.id})
                    .success(function (msg) {
                        wsh.successback(msg, '活动已关闭', false, '',function () {
                            if (msg.errcode == 0) {
                                obj.isdisabled = false;
                            } else {
                                obj.ischoose = obj.ischoose == true ? false : true;
                            }
                        });
                    });
            } else { //开启

                $http.post("<?= Url::to(['/together-buy/open-ajax']);?>", {"id": obj.id})
                    .success(function (msg) {
                            wsh.successback(msg, '活动已开启', false,'' ,function () {
                                if (msg.errcode == 0) {
                                   obj.isdisabled = false;
                                } else {
                                    obj.ischoose = obj.ischoose == true ? false : true;
                                }
                            });

                    });
            }
        };


    });

</script> 
