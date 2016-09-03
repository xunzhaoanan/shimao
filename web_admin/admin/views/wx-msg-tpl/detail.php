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
if (isset($_GET['members'])) {
    echo $this->render('@app/views/side/customer.php');
} else {
    echo $this->render('@app/views/side/manage_setting.php');
}
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
                    <h4><span>{{model.type.name}}</span></h4>

                    <p><span>{{model.type.remark}}</span></p>
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
                    <h3 class="margin-bottom5" ng-cloak>{{ipmodel.name}}</h3>

                    <div class="grey font-size12" ng-bind="ipmodel.created*1000 | date:'MM月dd日'"></div>
                    <div class="margin-top10 margin-bottom20">
                        {{ipmodel.header}}
                    </div>
                    <div class="" ng-repeat="arr in model.bodySplit">
                        <span ng-bind="arr | trim"></span>
                    </div>
                    <div class="space-6"></div>
                    <div class="margin-bottom5" ng-bind-html="ipmodel.body | trust:'html'"></div>
                    <div class="space-6"></div>
                    <div class="margin-bottom5">
                        {{ipmodel.footer}}
                    </div>
                    <div class="hr solid hr-6"></div>
                    <span class="blue">详情</span>
                </div>
            </div>
        </div>
        <!--右侧内容-->
        <div class="tabbable  col-sm-push-1 col-sm-6">
            <div class="box-border clearfix">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">消息设置</h4>
                </div>
                <!--ng-show="sendWay"-->
                <div class="modal-body">

                    <div class="clearfix" ng-show="sendWay">
                        <form class="form-horizontal" name="myform">
                            <div class="from-group  clearfix">
                                <label class="pull-left width101 control-label">公众号发送方式：</label>

                                <div class="col-sm-8">
                                    <select class="width200" ng-model="use_points"
                                            ng-options="o.id as o.name for o in useOption"
                                            ng-change="useChange(use_points)"></select>
                                </div>
                            </div>

                            <div class="form-group clearfix" ng-show="use_points == 1" id="points_countb">
                                <div class="col-sm-8 margin-bottom10 clearfix" style="margin-left:112px;">
                                    <span class="blue"> 您已选择“微商户消息通知”，发送样式如图</span></br>
                                    <span class="blue">如果用户与公众号超过48小时未产生互动，用户将无法接收到消息</span></br>
                                    <span class="blue">如需避免请选择使用“微信消息通知”</span>
                                </div>
                            </div>
                        </form>
                        <div ng-show="use_points == 2" id="points_count">
                            <div class="col-sm-8 margin-bottom10 clearfix" style="margin-left:100px;">
                                <span class="blue"> 您已选择“微信消息通知”，发送样式如图</span></br>
                                <span class="blue">您可以配置模板抬头、结语，以展示更多信息</span>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form class="form-horizontal" name="myform">

                                            <div class="form-group margin-bottom5">
                                                <label class="pull-left width101  control-label"
                                                       style="padding-bottom: 5px;">模版名称：</label>

                                                <div class="col-sm-3">
                                                    <p class="form-control-static no-padding">
                                                        {{model.type.template_name}}</p>
                                                </div>
                                            </div>

                                            <div class="form-group margin-bottom5">
                                                <label class="pull-left width101  control-label"
                                                       style="padding-bottom: 5px;">模版编号：</label>

                                                <div class="col-sm-3 ">
                                                    <p class="form-control-static no-padding">
                                                        {{model.type.template_no}}</p>
                                                </div>
                                            </div>
                                            <div class="form-group margin-bottom5">
                                                <label class="pull-left width101  control-label"
                                                       style="padding-bottom: 5px;">模版抬头：</label>

                                                <div class="col-sm-8 ">
                                                    <input type="text" class="form-control" name="header"
                                                           value="您的订单已经完成付款，商家即将为您发货。" ng-model="ipmodel.header">
                                                </div>
                                                <div class="col-sm-5 across-space1">
                              <span class="inline padding5 red"
                                    ng-show="myform.header.$error.required && isSubmit"
                                    ng-cloak>必填项</span>
                                                </div>
                                            </div>
                                            <div class="form-group margin-bottom5">
                                                <label class="pull-left width101 control-label"
                                                       style="padding-bottom: 5px;">模版结语：</label>

                                                <div class="col-sm-8 ">
                                                    <input type="text" class="form-control" name="footer"
                                                           value="如有疑问请及时和我们联系。" ng-model="ipmodel.footer">
                                                </div>
                                                <div class="col-sm-5 across-space1">
                              <span class="inline padding5 red"
                                    ng-show="myform.footer.$error.required && isSubmit"
                                    ng-cloak>必填项</span>
                                                </div>
                                            </div>
                                            <div class="form-group margin-bottom20">
                                                <label class="pull-left width101 control-label"
                                                       style="padding-bottom: 5px;">模版ID：</label>

                                                <div class="col-sm-5 ">
                                                    <input type="text" class="form-control"
                                                           ng-model="model.mp_id">
                                                </div>
                                                <div class="float-left across-space1">
                              <span class="inline padding5 red"
                                    ng-show="myform.mb_id.$error.required && isSubmit"
                                    ng-cloak>必填项</span>
                                                </div>
                                                <div class="float-left across-space1 hide ">
                                                    <a class=" blue pointer inline padding5 "
                                                       title="获取模板ID"
                                                       ng-click="getMessage(model.type.template_no)">获取模板ID</a>
                                                </div>
                                            </div>
                                            <!--<div class="form-group">
                                              <label  class="col-sm-2 control-label">使用备注：</label>
                                              <div class="col-sm-10 across-space2">
                                                <input type="text" class="form-control" name="remark" value="当订单完成支付时，推送给买家。" ng-model="model.remark" required="required">
                                              </div>
                                              <div class="col-sm-5 across-space1">
                                                 <span class="inline padding5 red" ng-show="myform.remark.$error.required && isSubmit" ng-cloak>必填</span>
                                              </div>
                                            </div>-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--短信发送方式-->
                    <div class="container" id="sms">
                        <form class="form-horizontal" name="myform">
                            <div class="form-group">
                                <label class="pull-left width101 control-label">短信发送方式：</label>

                                <div class="col-sm-8">
                                    <select class="width200 margin-bottom10"
                                            ng-model="model.send_by_sms"
                                            ng-options="o.id as o.name for o in smsSent"
                                            ng-change="useChangeSms(model.send_by_sms)">
                                    </select>

                                    <div class=" float-left width100 margin-bottom20">
                                        <span class="blue">发送短信将消耗短信余量1条/次</span></br>
                                        <span class="blue">如果短信余量不足将发送失败，请及时充值</span></br>
                                        <span class="blue">短信发送内容示例：<a ng-bind="model.type.sms_content"></a></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="modal-footer" style="margin-top:-1px;">
                <button type="button" class="btn btn-primary" ng-click="save()">保存</button>
            </div>

            <div class="space-14"></div>
            <p style="margin-left:25px;" ng-if="!model.type.tips ==''">
                <strong class="orange margin-right5"><i class="icon-exclamation-triangle "></i> 提示说明:</strong>
                <span class="text-warning orange" ng-bind="model.type.tips">消息说明</span>
            </p>

        </div>
    </div>

</div>
</div>
</div>
</div>
<!--获取模板ID弹框-->
<div class="bootbox modal fade in" id="template" tabindex="-1" role="dialog"
     aria-labelledby="template">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header"><a type="button" class="bootbox-close-button close"
                                             data-dismiss="modal">×</a>
                    <h4 class="modal-title">获取失败</h4>
                </div>
                <div class="modal-body">
                    <div class="bootbox-body">
                        <form class="bootbox-form">
                            <div class="table-responsive clearfix">
                                <p> 无法获取模板相关参数，请前往<a href="http://mp.weixin.qq.com"
                                                     target="_blank"/>mp.weixin.qq.com</a>
                                    确认以下内容</p>

                                <p> 1.确认“模板消息”功能已开启</p>

                                <p> 2.确认已添加模板名称为【<span class="form-control-static">{{model.type.name}}</span>】，编号为【<span
                                        class="form-control-static">{{model.type.template_no}}</span>】的模板</p>

                                <p> 详细配置方法 <a href="####" target="_blank">点击查看</a></p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer"><a class="btn btn-primary pointer" ng-click="cancel()">关闭</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script>
app.controller("mainController", function ($scope, $timeout, $rootScope, $http) {

    //微会员，会员卡设置，会员通知
    var noticeMember = wsh.getHref('members');
    if (noticeMember) {
        $timeout(function () {
            $rootScope.$broadcast('leftMenuChange', 'dc');
        }, 100);
    } else {
        $timeout(function () {
            $rootScope.$broadcast('leftMenuChange', 'ag');
        }, 100);
    }

    $scope.model = {};
    $scope.ipmodel = {};
//	$scope.model.bodySplit = [];
    var id = wsh.getHref('id');
    var type_id = wsh.getHref('type_id');
    $scope.sendWay = true;

    getData(id, type_id);
    function getData() {
        $http.post(wsh.url + "get-msg-detail", {"id": id, "type_id": type_id})
            .success(function (msg) {
                wsh.successback(msg, '', false, function () {
                    $scope.model = msg.errmsg;
                    console.log('0000111', $scope.model.type.tips)
                    console.log('2222', $scope.model.type.send_by_sms)
//短信方式是否显示
                    msg.errmsg.type.receiveSetting.map(function (a, b) {
                        if ($scope.model.type.send_by_sms == 1 && $scope.model.type.receiveSetting[2].level == 1) {
                            $("#sms").show();
                        } else {
                            $("#sms").hide();
                        }
                    });


//左侧手机端的
                    if ($scope.model.send_type == 1) {
                        $scope.use_points = 1;
                        $scope.model.header = $scope.model.type.header_wsh;
                        $scope.model.footer = $scope.model.type.footer_wsh;
                        $scope.model.body = $scope.model.type.body_wsh;
                    } else if ($scope.model.send_type == 2) {
                        $scope.use_points = 2;
                        $scope.model.header = $scope.model.header;
                        $scope.model.footer = $scope.model.footer;
                        $scope.model.body = $scope.model.type.body;
                    } else {
                        $scope.use_points = 0;
                    }
                    $scope.ipmodel.name = $scope.model.type.name;
                    $scope.ipmodel.created = $scope.model.created;
                    $scope.ipmodel.header = $scope.model.header;
                    $scope.ipmodel.body = $scope.model.body;
                    $scope.ipmodel.footer = $scope.model.footer;

                    //发送方式的显示
                    if ($scope.model.type.send_by_wsh == 1 && $scope.model.type.send_by_wx == 1) {
                        $scope.sendWay = true;
                        $scope.useOption = [{"id": 1, "name": "微商户消息通知"}, {"id": 2, "name": "微信消息通知"}, {
                            "id": 0,
                            "name": "不发送"
                        }];
                    } else if ($scope.model.type.send_by_wsh == 2 && $scope.model.type.send_by_wx == 1) {
                        $scope.sendWay = true;
                        $scope.useOption = [{"id": 2, "name": "微信消息通知"}, {"id": 0, "name": "不发送"}];
                    } else if ($scope.model.type.send_by_wsh == 1 && $scope.model.type.send_by_wx == 2) {
                        $scope.sendWay = true;
                        $scope.useOption = [{"id": 1, "name": "微商户消息通知"}, {"id": 0, "name": "不发送"}];
                    } else if ($scope.model.type.send_by_wsh == 2 && $scope.model.type.send_by_wx == 2) {
                        $scope.sendWay = false;
                    }


                });
            })
    }


    /*//获取模板ID
     $scope.getMessage = function (no) {
     $http.post(wsh.url + "get-message-id", {"no": no})
     .success(function (msg) {
     if (msg.errcode === 0 && msg.errmsg.message_id) {
     $scope.model.mp_id = msg.errmsg.message_id;
     } else {
     $('#template').modal('show');
     }
     });
     };*/
    //模板关闭按钮
    $scope.cancel = function () {
        $('#template').modal('hide');
    };
    /*发送方式*/

//    $scope.useOption = [{"id": 1, "name": "微商户消息通知"}, {"id": 2, "name": "微信消息通知"},{"id":0,"name":"不发送"}];
    $scope.useChange = function (type) {
        console.log('asds', type);
        $scope.use_points = type;
        if (type == 1) {
            $scope.ipmodel.header = $scope.model.type.header_wsh;
            $scope.ipmodel.footer = $scope.model.type.footer_wsh;
            $scope.ipmodel.body = $scope.model.type.body_wsh;
        } else {
            $scope.ipmodel.header = $scope.model.header;
            $scope.ipmodel.footer = $scope.model.footer;
            $scope.ipmodel.body = $scope.model.type.body;
        }
    }
    //短信方式
    $scope.smsSent = [{"id": '1', "name": "发送"}, {"id": '2', "name": "不发送"}];


//保存
    $scope.save = function () {
        if ($scope.use_points == 1) {//微商户
            if ($scope.model.send_by_sms == 1) {//发送
                $http.post(wsh.url + "update-msg", {
                    "id": $scope.model.id,
                    "send_type": $scope.use_points,
                    "type_id": type_id,
                    'send_by_sms': $scope.model.send_by_sms
                })
                    .success(function (msg) {
                        wsh.successback(msg, '保存成功', false, function () {
                            history.go(-1);
                        });
                    })
            } else {//微商户  不发送
                $http.post(wsh.url + "update-msg", {
                    "id": $scope.model.id,
                    "send_type": $scope.use_points,
                    "type_id": type_id,
                    'send_by_sms': $scope.model.send_by_sms
                })
                    .success(function (msg) {
                        wsh.successback(msg, '保存成功', false, function () {
                            history.go(-1);
                        });
                    })
            }
        } else if ($scope.use_points == 2) {//微信
            if ($scope.model.send_by_sms == 1) {//发送
                $http.post(wsh.url + "update-msg", {
                    "id": $scope.model.id,
                    "send_type": $scope.use_points,
                    "type_id": type_id,
                    "template_id": $scope.model.template_id,
                    "header": $scope.ipmodel.header,
                    "footer": $scope.ipmodel.footer,
                    "mp_id": $scope.model.mp_id,
                    'send_by_sms': $scope.model.send_by_sms
                })
                    .success(function (msg) {
                        wsh.successback(msg, '保存成功', false, function () {
                            history.go(-1);
                        });
                    })
            } else {//微信  不发送
                $http.post(wsh.url + "update-msg", {
                    "id": $scope.model.id,
                    "send_type": $scope.use_points,
                    "type_id": type_id,
                    "template_id": $scope.model.template_id,
                    "header": $scope.ipmodel.header,
                    "footer": $scope.ipmodel.footer,
                    "mp_id": $scope.model.mp_id,
                    'send_by_sms': $scope.model.send_by_sms
                })
                    .success(function (msg) {
                        wsh.successback(msg, '保存成功', false, function () {
                            history.go(-1);
                        });
                    })
            }
        }
        else if ($scope.use_points == 0) {//发送方式为不发送
            if ($scope.model.send_by_sms == 1) {//短信为发送
                $http.post(wsh.url + "update-msg", {
                    "id": $scope.model.id,
                    "send_type": $scope.use_points,
                    "type_id": type_id,
                    'send_by_sms': $scope.model.send_by_sms
                })
                    .success(function (msg) {
                        wsh.successback(msg, '保存成功', false, function () {
                            history.go(-1);
                        });
                    })

            } else {//发送方式为不发送，短信为不发送
                $http.post(wsh.url + "update-msg", {
                    "id": $scope.model.id,
                    "send_type": $scope.use_points,
                    "type_id": type_id,
                    'send_by_sms': $scope.model.send_by_sms
                })
                    .success(function (msg) {
                        wsh.successback(msg, '保存成功', false, function () {
                            history.go(-1);
                        });
                    })
            }

        }
    }


});
</script>

