<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '消息通知';
?>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
    <script type="text/javascript">try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }</script>
    <div class="main-container-inner">
        <?php
        echo $this->render('@app/views/side/manage_setting.php');
        ?>
        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">try {
                        ace.settings.check('breadcrumbs', 'fixed')
                    } catch (e) {
                    }</script>
                <ul class="breadcrumb">
                    <li>
                        消息编辑
                    </li>
                </ul>
                <!-- .breadcrumb -->
                <!-- #nav-search -->
            </div>
            <div class="page-content">
                <!-- /.page-header -->
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="width86 margin-auto"
                             style="border-left:5px solid #CC9900; text-align:left;">
                            <div class="alert alert-block alert-info">
                                <h4><span ng-bind="model.type.name"></span></h4>

                                <p><span ng-bind="model.type.remark"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-10"></div>
                <div class="row">
                    <!--左侧手机端-->
                    <div class="weileft col-sm-push-1 col-sm-3">
                        <div class="weileftda margin-top10" id="phone_page1">
                            <div class="wcright table-width">
                                <h3 class="margin-bottom5" ng-cloak>{{model.type.name}}</h3>

                                <div class="grey font-size12" ng-bind="model.created*1000 | date:'MM月dd日'"></div>
                                 <div class="margin-top10 margin-bottom20">
                                    {{model.header}}
                                </div>
                                <div class="" ng-repeat="arr in model.bodySplit">
                                    <span ng-bind="arr | trim"></span>
                                </div>
                                <div class="space-6"></div>
                                <div class="margin-bottom5" ng-bind-html="model.body | trust:'html'">
                                </div>
                                <div class="space-6"></div>
                                <div class="margin-bottom5">
                                    {{model.footer}}
                                </div>
                                <div class="hr solid hr-6"></div>
                                <span class="blue">详情</span>
                            </div>
                        </div>
                    </div>
                    <!--右侧内容-->
                    <div class="tabbable col-sm-push-1 col-sm-8">
                        <div class="box-border clearfix">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">公众号消息设置</h4>
                            </div>
                            <div class="modal-body">

                                <div id="points_count">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-12">

                                                <form class="form-horizontal" name="myform">
                                                    <h5>勾选需要接收消息的员工</h5>

                                                    <div class="form-group padding-left10"
                                                         ng-show="operatior_isshow == 1">
                                                        <label>
                                                            <input type="checkbox" class="ace"
                                                                      ng-model="model.shopReceiver.send_to_operator" my-check-box>
                                                            <span class="lbl">操作员</span>
                                                        </label>
                                                        <span class="grey">（操作员可以通过公众号，接收到这个场景下所有消息）</span>

                                                        <div selec-operator people-list="list" class="show-tab"
                                                             ng-show="model.shopReceiver.send_to_operator == 1"
                                                             default-selected="defaultVal"></div>
                                                    </div>

                                                    <div class="form-group padding-left10" ng-show="staff_isshow == 1">
                                                        <label><input type="checkbox" class="ace"
                                                                      ng-model="model.shopReceiver.send_to_staff" my-check-box>
                                                            <span class="lbl">门店员工</span>
                                                        </label>
                                                        <span class="grey">（被指定的员工，可以通过公众号接收到消息）</span>

                                                        <div choose-member people-list="member" class="show-tab"
                                                             ng-show="model.shopReceiver.send_to_staff == 1"
                                                             default-selected="staffVal"></div>
                                                        <div ng-show="model.shopReceiver.send_to_staff == 1">
                              <span> 二维码关联：点击
                                <a class="blue" style="cursor:pointer"
                                   ng-model="list.id"
                                   ng-click="getQrcode(list.id)"
                                   data-toggle="modal"
                                   data-target="#query">查看二维码</a>，
                                员工扫码关联成功后，可以自动被加入列表</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group padding-left10"
                                                         ng-show="belong_to_staff == 1">
                                                        <label><input type="checkbox" class="ace"
                                                                      ng-model="model.shopReceiver.send_to_belong_to_staff" my-check-box>
                                                            <span class="lbl">归属员工</span>
                                                        </label>
                                                        <span class="grey">（推送消息给发生相关操作的员工）</span>
                                                    </div>


                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" ng-click="save()">
                                    保存
                                </button>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><a type="button" class="bootbox-close-button close"
                                             data-dismiss="modal">×</a>
                    <h4 class="modal-title">门店员工绑定二维码</h4>
                </div>
                <div class="modal-body">
                    <div class="bootbox-body">
                        <div class="center"><img ng-src="{{$root.srcImg}}"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    app.controller("mainController", function ($scope, $timeout, $rootScope, $http) {
        $timeout(function () {
            $rootScope.$broadcast('leftMenuChange', 'ag');
        }, 100);
        $scope.list = [];
        $scope.member = [];
        $scope.model = {};
        $scope.ipmodel = {};
        $scope.model.bodySplit = [];
        var id = wsh.getHref('id');
        var type_id = wsh.getHref('type_id');
        var people_ids = [];
        var store_ids = [];

        getData(id, type_id);
        function getData(id, type_id) {
            $http.post(wsh.url + "get-msg-detail", {"id": id, "type_id": type_id})
                .success(function (msg) {
                    wsh.successback(msg, '', false, function () {
                        $scope.model = msg.errmsg;
                        console.log('asdgad', $scope.model);
                        msg.errmsg.type.receiveSetting.map(function (obj) {
                            if (obj.entryway === msg.errmsg.send_type) {
                                $scope.operatior_isshow = obj.send_to_operator;
                                //console.log('00000', $scope.operatior_isshow);
                                $scope.staff_isshow = obj.send_to_staff;
                                $scope.belong_to_staff = obj.send_to_belong_to_staff;
                            }
                            if ($scope.model.send_type == 1) {
                                $scope.use_points = 1;
                                $scope.model.header = $scope.model.type.header_wsh;
                                $scope.model.footer = $scope.model.type.footer_wsh;
                                $scope.model.body = $scope.model.type.body_wsh;
                            } else {
                                $scope.use_points = 2;
                                $scope.model.header = $scope.model.header;
                                $scope.model.footer = $scope.model.footer;
                                $scope.model.body = $scope.model.type.body;
                            }

                            $scope.ipmodel.name = $scope.model.type.name;
                            $scope.ipmodel.created = $scope.model.created;
                            $scope.ipmodel.header = $scope.model.header;
                            $scope.ipmodel.body = $scope.model.body;
                            $scope.ipmodel.footer = $scope.model.footer;
                        });
                        msg.errmsg.shopReceiver = msg.errmsg.shopReceiver || {};
                        $scope.send_to_operator_check = msg.errmsg.shopReceiver.send_to_operator == '1';
                        $scope.send_to_staff_check = msg.errmsg.shopReceiver.send_to_staff == '1';
                        $scope.belong_to_staff_check = msg.errmsg.shopReceiver.send_to_belong_to_staff == '1';
                        // 清空session
                        sessionStorage.removeItem('peopleList');
                        sessionStorage.removeItem('storeList');

                        // 获取数据
                        var dat = msg.errmsg.shopReceiver;

                        if (dat.send_to_operator === '1') {
                            // 获取数据判断是否选中
                            // 拿到选中的员工ID集合
                            $scope.send_to_operator_check = true;
                            $scope.defaultVal = dat.operator_ids.split(',');
                        } else {
                            $scope.defaultVal = [];
                        }
                        if (dat.send_to_staff === '1') {
                            $scope.send_to_staff_check = true;
                            $scope.staffVal = dat.staff_ids.split(',');
                        } else {
                            $scope.staffVal = [];
                        }
                })
        })
        }
        //保存
        $scope.save = function () {
            var href = location.href.split('?');
            var id = href[1].split('=');
            var _id = id[1].split('&');
//            var storeList, send_to_staff = '1';

            // 获取勾选对象
            people_ids = [];
            $.each($scope.list, function (idx, obj) {
                if (obj.checked) {
                    people_ids.push(obj.id != undefined ? obj.id : obj._id);
                }
            });

            store_ids = [];
                $.each($scope.member, function (idx, obj) {
                    if (obj.checked) {
                        store_ids.push(obj.id != undefined ? obj.id : obj._id);
                    }
                });

            $http.post(wsh.url + "set-receive", {
                "id": _id[0],
                "send_to_operator": $scope.model.shopReceiver.send_to_operator == 1 ? 1 : 2,
                "send_to_staff": $scope.model.shopReceiver.send_to_staff == 1 ? 1 : 2,
                "send_to_belong_to_staff": $scope.model.shopReceiver.send_to_belong_to_staff == 1 ? 1 : 2,
                "operator_ids": JSON.stringify(people_ids),
                "staff_ids": JSON.stringify(store_ids),
                "belong_to_staff_ids": ''
            }).success(function (msg) {
                wsh.successback(msg, '保存成功', false, function () {
                   window.location.href = "/wx-msg-tpl/seller-index";
                });
            })
        }

        //查看二维码
        $scope.getQrcode = function () {
            $http.post("/wx-msg-tpl/get-add-shop-receive-qrcode", {"id": id})
                .success(function (msg) {
                    wsh.successback(msg, '', false, function () {
                        $rootScope.srcImg = msg["errmsg"];
                    });
                })
        };
    });
</script>
