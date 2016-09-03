<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '核销管理';
?>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>
    <div class="main-container-inner"> <?php echo $this->render('@app/views/side/manage_setting.php'); ?>
        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">try {
                        ace.settings.check('breadcrumbs', 'fixed')
                    } catch (e) {
                    }</script>
                <ul class="breadcrumb">
                    <li>核销记录</li>
                </ul>
                <!-- .breadcrumb -->
            </div>
            <div class="page-content">
                <!-- /.page-header -->
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="alert alert-block alert-success" ng-if="isshow">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="ace-icon icon-times"></i>
                                    </button>
                                    <p><i class="ace-icon icon-check green"></i> 1.只有员工绑定的微信号正常，才能进行核销。</p>

                                    <p><i class="ace-icon icon-check green"></i> 2.员工绑定微信号请到“员工管理”页面进行绑定</p>
                                </div>
                            </div>
                        </div>

                        <div class="tabbable">
                            <ul class="nav nav-tabs tab-color-blue " id="myTab" ng-if="isshow">
                                <li><a ng-if="$root.hasPermission('terminal/write-off')"
                                       ng-href="/terminal/write-off{{$root.getSearchUrl}}">绑定核销员</a></li>
                                <li><a ng-if="$root.hasPermission('terminal/write-off-web')"
                                       ng-href="/terminal/write-off-web{{$root.getSearchUrl}}">网页核销</a></li>
                                <li class="active"><a ng-if="$root.hasPermission('terminal/write-off-records')"
                                                      ng-href="/terminal/write-off-records{{$root.getSearchUrl}}">核销记录</a>
                                </li>
                                <li><a ng-if="$root.hasPermission('terminal/write-off-shop')"
                                       ng-href="/terminal/write-off-shop{{$root.getSearchUrl}}">核销门店排行榜</a></li>
                                <li><a ng-if="$root.hasPermission('terminal/write-off-staff')"
                                       ng-href="/terminal/write-off-staff{{$root.getSearchUrl}}">核销员排行榜</a></li>
                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane active">
                                    <div class="row margin-bottom10 padding-left10 float-right clearfix">
                                        <div class=" no-padding-left ">
                                            <div class="input-group  float-left no-padding  ">
                                                <label class="float-left padding5" for="form-field-1">来源：</label>
                                                <select class="float-left margin-left10 margin-right10"
                                                        ng-model="sourceGet">
                                                    <option ng-repeat="o in sourceOption" ng-bind="o.title"
                                                            value="{{o.id}}"></option>
                                                </select>

                                                <label class="float-left padding5" for="form-field-1">门店：</label>

                                                <select class="float-left margin-left10 margin-right10"
                                                        ng-model="typeStore">
                                                    <option value="" selected>全部门店</option>
                                                    <option ng-repeat="list in terminalList"
                                                            ng-bind="list.shopInfo.name" value="{{list.id}}"></option>
                                                </select>
                                                <label class="float-left text-right padding5 "
                                                       for="form-field-1">时间：</label>

                                                <div class="input-group  float-left no-padding">
                                                    <input type="text" id="start_time"
                                                           class="Wdate form-control hasDatepicker"
                                                           onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{$dp.$D(\'end_time\')}'});"
                                                           value=""/>
                                                </div>
                                                <span class="float-left padding5 "> 至 </span>

                                                <div class="input-group  float-left  no-padding">
                                                    <input type="text" id="end_time"
                                                           class="Wdate form-control hasDatepicker"
                                                           onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'start_time\')}',maxDate:'2030-10-01'});"
                                                           value=""/>
                                                </div>
                                            </div>
                                            <div class="input-group no-padding-left margin-right10  float-left ">
                                                <label class="float-left padding5" for="form-field-1"></label>
                                                <input class="text marginleft1" type="text" placeholder="搜索核销码"
                                                       ng-model="cancelCode">
                                            </div>
                                            <span class="float-left margin-right10 " ng-click="recordSearch()"><a
                                                    class="btn btn-xs btn-primary">搜索</a></span>

                                        </div>

                                    </div>

                                    <div class=" space-6"></div>
                                    <table width="100%"
                                           class="table table-striped table-bordered table-hover table-width">
                                        <thead>
                                        <tr>
                                            <th width="10%" class="text-center">时间</th>
                                            <th width="14%" class="text-center">核销码</th>
                                            <th width="8%" class="text-center">来源</th>
                                            <th width="16%" class="text-center">门店</th>
                                            <th width="10%" class="text-center">核销员</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="record in records">
                                            <td class="text-center"
                                                ng-bind="record.created*1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                                            <td class="text-center" ng-bind="record.code"></td>
                                            <td class="text-center" ng-bind="record.cancel_type | cancelStatus"></td>
                                            <td class="text-center"
                                                ng-bind="record.shopInfo.name?record.shopInfo.name:''"></td>
                                            <td class="text-center"
                                                ng-bind="record.shopStaff.real_name ? record.shopStaff.real_name : ''"></td>
                                        </tr>
                                        <tr ng-show="!records.length">
                                            <td colspan="5" class="red text-center">暂时没有可显示的数据</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div ng-paginate options="options" page="page">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/ace/js/DatePicker/WdatePicker.js"></script>
    <script>
        app.filter('cancelStatus', function () {
            return function (val) {
                switch (val) {
                    case 0:
                        return '全部';
                        break;
                    case 1:
                        return '卡券';
                        break;
                        break;
                    case 2:
                        return '抽奖活动';
                        break;
                    case 3:
                        return '提货码';
                        break;
                    case 4:
                        return '众筹';
                        break;
                }
            };
        });
        app.controller("mainController", function ($scope, $http, $rootScope, $timeout) {
            $timeout(function () {
                $rootScope.$broadcast('leftMenuChange', 'ae');
            }, 100);

            $scope.isshow = false;
            if (wsh.getHref("terminal_id")) {
                $scope.isshow = true;
            }


            var start = undefined, end = undefined, code = undefined;
            var int = 1;
            $scope.sourceGet = 0;
            $scope.options = {callback: pageList};
            //获取门店信息的
            getData(1);

            function getData(int) {
                $http.post('../terminal/list-ajax', {
                    "_page": int,
                    "_page_size": 999
                })
                    .success(function (msg) {
                        wsh.successback(msg, "", false, function () {
                            $scope.terminalList = msg.errmsg.data;
                            console.log(msg.errmsg.data);

                        });
                    });
            }

            pageList(1);
            function pageList(int) {
                $http.post(wsh.url + 'cancel-record-list-ajax', {
                    '_page': int,
                    '_page_size': 10,
                    'code': code,
                    'createStart': start,
                    'createEnd': end,
                    'cancel_type': $scope.sourceGet > 0 ? $scope.sourceGet : null,
                    'shop_sub_id': $scope.typeStore > 0 ? $scope.typeStore : null,
                    'auto_get_params': 1

                })
                    .success(function (msg) {
                        wsh.successback(msg, '', false, function () {
                            $scope.records = msg.errmsg.data;
                            $scope.records.forEach(function (i, e) {
                                var remark = i.remark ? i.remark : '';
                                if (remark.indexOf("StaffOpenId") < 0) {
                                    i.shopInfo.name = (i.shopInfo.name) ? i.shopInfo.name : "总店";
                                    i.shopStaff.real_name = (i.shopStaff.real_name) ? i.shopStaff.real_name : "管理员";
                                }
                            });
                            $scope.page = msg.errmsg.page;
                        });
                    })

            }

            //来源
            $scope.sourceOption = [{"id": 0, "title": "全部"}, {"id": 1, "title": "卡劵"}, {
                "id": 2,
                "title": "抽奖活动"
            }, {"id": 3, "title": "提货码"} , {"id": 4, "title": "众筹"}];
            //门店
            //$scope.doorOption = [{"id": 0, "title": "全部"}, {"id": 1, "title": "总店"}, {"id": 2, "title": "分店1"}, {"id": 3, "title": "分店2"}, {"id": 4, "title": "分店3"}];
            //核销记录查询
            $scope.recordSearch = function () {
                start = (!isNaN(new Date($("#start_time").val()) / 1000)) ? new Date($("#start_time").val()) / 1000 : null;
                end = (!isNaN(new Date($("#end_time").val()) / 1000)) ? new Date($("#end_time").val()) / 1000 : null;
                code = $scope.cancelCode;
                pageList(1);
            };
        });

    </script>
