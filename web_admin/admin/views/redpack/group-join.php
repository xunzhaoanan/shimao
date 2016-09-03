<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '群红包活动参与人员';
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
                    <li>群红包活动参与人员</li>
                </ul>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="clearfix no-padding">
                            <div class="col-sm-7 no-padding">
                                <ul class="listli left-space1 btn-primary bune">
                                    <li><a target="_blank" class="btn btn-xs btn-primary" ng-href="{{'/export/redpack?id=' + modelId}}">导出参与人员</a></li>
                                </ul>
                            </div>
                            <div class="inline float-right margin-left10">
                                <input placeholder="搜索发起人" type="text" ng-model="searchName" class="inline align-top">
											<span  ng-click="normalSearch()">
												<a class="btn btn-xs btn-primary align-top" style="margin-left:-4px;">
                            <i class="icon-search icon-on-right bigger-90">
                            </i>
                        </a>
											</span>
                            </div>
                        </div>

                        <div class="space-6 clearfix col-sm-12"></div>
                        <div class="table-responsive clearfix">
                            <table class="table table-striped table-bordered table-hover table-width">
                                <thead>
                                <tr>
                                    <th width="10%" class="text-center">用户ID</th>
                                    <th width="10%" class="text-center">发起人</th>
                                    <th width="8%" class="text-center">参与人数</th>
                                    <th width="10%" class="text-center">发起时间</th>
                                    <th width="15%" class="text-center">领完状态</th>
                                    <th width="7%" class="text-center">操作</th>
                                </tr>
                                </thead>
                                <tbody ng-cloak>
                                <tr ng-repeat="list in lists">
                                    <td class="lt-width3 text-center" ng-bind="list.start_uid"></td>
                                    <td class="text-center" ng-bind="list.startWxUserInfo.nickname"></td>
                                    <td class="text-center" ng-bind="list.people_num"></td>
                                    <td class="text-center" ng-bind="list.start_time * 1000 | date:'yyyy-MM-dd HH:mm:ss'" >发起时间</td>
                                    <td class="text-center" ng-if="list.status == 2">正在瓜分中</td>
                                    <td class="text-center" ng-if="list.status == 3">已瓜分完成</td>
                                    <td class="text-center">
                                        <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                                            <a class="blue" data-toggle="modal" data-target="#myModal" title="管理"
                                               ng-click="whoGroup(list.id)">
                                                <i class="icon-user bigger-130"></i> </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr ng-show="!lists.length || !lists" class="center">
                                    <td colspan="6">暂无数据</td>
                                </tr>
                                </tbody>
                            </table>
                            <div ng-paginate options="options" page="page"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--列表-->
<div class="bootbox modal fade in" id="myModal" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog2">
        <div class="modal-content">
            <div class="modal-header"><a href="#" type="button" class="bootbox-close-button close" data-dismiss="modal">×</a>
                <h4 class="modal-title">群红包领取人员</h4>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <div id="home" class="tab-pane in active row">
                        <div class="table-responsive clearfix">
                            <table class="table table-striped table-bordered table-hover table-width">
                                <thead>
                                <tr>
                                    <th width="10%" class="text-center">用户ID</th>
                                    <th width="10%" class="text-center">昵称</th>
                                    <th width="8%" class="text-center">手机号</th>
                                    <th width="15%" class="text-center">领取金额</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="listpop in listspops">
                                    <td class="lt-width3 text-center" ng-bind="listpop.uid"></td>
                                    <td class="text-center" ng-bind="listpop.wxUserInfo.nickname"></td>
                                    <td class="text-center" ng-bind="listpop.wxUserInfo.mobile"></td>
                                    <td class="text-center" ng-bind="listpop.amount/100"></td>
                                </tr>
                                </tbody>
                            </table>
                            <div ng-paginate options="optionss" page="pages"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a data-bb-handler="confirm" class="btn btn-primary" data-dismiss="modal">确定</a>
            </div>
        </div>
    </div>
</div>

<script>
    app.controller('mainController', function ($scope, $rootScope, $timeout) {
        $timeout(function () {
            $rootScope.$broadcast('leftMenuChange', 'ec');
        }, 100);
        $scope.modelId = JSON.parse('<?= addslashe(json_encode($id)); ?>');  //活动ID
        $scope.redpackId;  //红包ID
        $scope.options = {callback: getData};
        var int = 1;
        getData(int);
        function getData(int) {
            $.ajax({
                type: "POST",
                url: "<?= Url::to(['redpack/find-group-item-list-ajax']);?>",
                dataType: "JSON",
                data: {"_page": int, "_page_size": 10, "id": $scope.modelId,
                    "nickname":$scope.searchName ? $scope.searchName : ''
                },
                success: function (msg) {
                    wsh.successback(msg, '', false, function () {
                        $scope.lists = msg.errmsg.data;
                        $scope.page = msg.errmsg.page;
                        $scope.$apply();
                        console.log("getData",  $scope.lists);
                    });
                }
            });
        }

        $scope.normalSearch = function(){
            getData(1)
        }
        $scope.optionss = {callback: getDataPop};
        function getDataPop(int, redpackId, activeId) {
            $.ajax({
                type: "POST",
                url: "<?= Url::to(['redpack/find-group-log-ajax']);?>",
                dataType: "JSON",
                data: {
                    "red_packet_event_id": activeId,
                    "red_package_item_id": redpackId,
                    "_page": int,
                    "_page_size": 10
                },
                success: function (msg) {
                    $rootScope.listspops = msg.errmsg.data;
                    $rootScope.pages = msg.errmsg.page;
                    $scope.$apply();
                    console.log("getDataPop", msg);
                }
            });
        }

        $scope.download = function () {
            $.ajax({
                type: "POST",
                url: "<?= Url::to(['export/redpack']);?>",
                dataType: "JSON",
                data: {
                    "id": $scope.modelId
                },
                success: function (msg) {

                }
            });
        }
        $scope.whoGroup = function (redpackId) {
            $scope.redpackId = redpackId;
            getDataPop(int, redpackId, $scope.modelId);
        }



    });
</script>
