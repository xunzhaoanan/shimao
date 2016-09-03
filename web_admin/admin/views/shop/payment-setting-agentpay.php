<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '代收款提款设置';
?>
<link rel="stylesheet" type="text/css" href="/ace/css/shop/payment-setting-collection.css">
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>
    <div class="main-container-inner">
        <?php
        echo $this->render('@app/views/side/manage_setting.php');
        ?>
        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try {
                        ace.settings.check('breadcrumbs', 'fixed')
                    } catch (e) {
                    }
                </script>
                <ul class="breadcrumb">
                    <li> 代收款提款设置</li>
                </ul>
                <!-- .breadcrumb -->
            </div>
            <div class="page-content">
                <!-- /.page-header -->
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <!--优惠券列表-->
                        <div class="leader">
                            <div class=" col-sm-4 no-padding"><span
                                    class="label label-lg label-success arrowed-right no-padding">1.填写帐号信息</span></div>
                            <div class=" col-sm-4 no-padding"><span
                                    class="label label-lg label-light arrowed-in no-padding">2.等待核实</span></div>
                            <div class=" col-sm-4 no-padding"><span
                                    class="label label-lg label-fin arrowed-in no-padding">3.审核完成</span></div>
                        </div>
                        <div class="tabbable padding10 clearfix col-sm-12">
                            <!--基本设置-->
                            <div id="home" class="tab-pane active ruleCont margin-top20">
                                <form class="form-horizontal" name="myform" novalidate="novalidate">
                                    <div class="form-group margin-bottom10 clearfix">
                                        <label class="width160 float-left text-right margin-right10 clearfix"
                                               for="form-field-1">支付方式名称</label>

                                        <div class="col-sm-9"><span
                                                class="label label-success arrowed-in-right  float-left"> 银行卡 </span><span>支持交易货币：人民币</span>
                                        </div>
                                    </div>
                                    <div class="form-group margin-bottom10 clearfix">
                                        <label class="width160 float-left text-right margin-right10 clearfix"
                                               for="form-field-1">支付类型</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="col-sm-2 margin-right10 clearfix" placeholder=""
                                                   name="type" ng-model="model" required="required">
                                            <span style="color:#f00;" ng-show="myform.type.$error.required && istrue">必填项</span>
                                        </div>
                                    </div>
                                    <div class="form-group margin-bottom10 clearfix">
                                        <label class="width160 float-left text-right margin-right10 clearfix"
                                               for="form-field-1">支付帐号</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="col-sm-2 margin-right10 clearfix" placeholder="">
                                            <span style="color:#f00;" ng-show="myform.type.$error.required && istrue">必填项</span>
                                        </div>
                                    </div>
                                    <div class="form-group margin-bottom10 clearfix">
                                        <label class="width160 float-left text-right margin-right10 clearfix"
                                               for="form-field-1">银行类型</label>

                                        <div class="col-sm-9">
                                            <select name="data[BankInfo][bank_type]">
                                                <option value="">--选择银行类型--</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group margin-bottom10 clearfix">
                                        <label class="width160 float-left text-right margin-right10 clearfix"
                                               for="form-field-1">真实姓名</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="col-sm-2 margin-right10 clearfix" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group margin-bottom10 clearfix">
                                        <label class="width160 float-left text-right margin-right10 clearfix"
                                               for="form-field-1">账户类型</label>

                                        <div class="col-sm-9">
                                            <label>
                                                <input name="form-field-radio01" type="radio" class="ace">
                                                <span class="lbl"> 个人账户</span></label>
                                            <label>
                                                <input name="form-field-radio01" type="radio" class="ace">
                                                <span class="lbl"> 公司账户</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group margin-bottom10 clearfix">
                                        <label class="width160 float-left text-right margin-right10 clearfix"
                                               for="form-field-1">开户地区</label>

                                        <div class="col-sm-9">
                                            <select name="data[BankInfo][bank_type]">
                                                <option value="">--选择开户地区--</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group margin-bottom10 clearfix">
                                        <label class="width160 float-left text-right margin-right10 clearfix"
                                               for="form-field-1">开户城市</label>

                                        <div class="col-sm-9">
                                            <select name="data[BankInfo][bank_type]">
                                                <option value="">--选择开户城市--</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group margin-bottom10 clearfix">
                                        <label class="width160 float-left text-right margin-right10 clearfix"
                                               for="form-field-1">支行名称</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="col-sm-2 margin-right10 clearfix" placeholder=""
                                                   name="bankName" required="required">
                                            <span style="color:#f00;"
                                                  ng-show="myform.bankName.$error.required && istrue">必填项</span></div>
                                    </div>
                                    <div class="form-group margin-bottom10 clearfix">
                                        <div class="col-sm-9">
                                            <input type="hidden" value="1" maxlength="80" name="data[BankInfo][verify]"
                                                   required="required"/>

                                            <p style="font-size:12px; color:#F30">备注：我们需要对您的银行资料信息
                                                进行核实后才能正常使用，请耐心等候。</p>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!--基本设置-->
                            <div id="rule" class="tab-pane active ruleCont"
                                 style="display:none;width: 650px;margin: 0 auto;padding-top:75px">
                                <form class="form-horizontal">
                                    <div class="form-group margin-bottom10 clearfix"><strong style="color:#F60">帐号信息提交成功，我们需要对帐号信息进行核对，请耐心等候...</strong><br/>
                                        <strong style="color:#F60">帐号信息提交成功，您的个人帐号需要授权审核才能使用...</strong><br/>
                                        请点击下载《<a href="/img/proxy.pdf"
                                                 target="_blank">个人账户收款授权书</a>》后，打印并签字盖章邮寄至服务商。<br/>
                                        服务地址：深圳市南山区高新科技园科研路9号比克科技大厦2101C (客服部收)<br/>
                                        服务热线：0755-36511728 (工作时间：周一至五9:00~18:00)<br/>
                                    </div>
                                    <div class="form-group margin-bottom10 clearfix"> 您所提交的帐号信息如下：<br>
                                        支付类型: 代收款（财付通）<br>
                                        支付帐号: <br>
                                        账户类型: <br>
                                        开户地区:广东省<br>
                                        开户城市: 深圳市<br>
                                        银行类型:招行<br>
                                        支行名称: 南山支行<br>
                                    </div>
                                </form>
                            </div>
                            <div id="fin" class="tab-pane active ruleCont" style="display:none;">
                                <form class="form-horizontal">
                                    <div class="form-group margin-bottom10 clearfix">
                                        <div style="padding: 200px 283px;"><strong
                                                style="color:#F60">你的账户已经审核成功...</strong><br/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer margin-auto" id="modal-footer"><a id="back" class="btn btn-primary"
                                                                                       style="display:none"> 上一步 </a> <a
                                    id="backOnce" class="btn btn-primary" style="display:none"> 上一步 </a> <a id="next"
                                                                                                            class="btn btn-primary">
                                    <i class="icon-ok bigger-110"></i> 下一步 </a> <a id="nextOnce" class="btn btn-primary"
                                                                                   style="display:none;"> <i
                                        class="icon-ok bigger-110"></i> 下一步 </a> <a id="post" class="btn btn-success">
                                    保存并关闭 </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
            $timeout(function () {
                  $rootScope.$broadcast('leftMenuChange', 'ab');
              }, 100);
            $scope.istrue = false;
            $scope.model = JSON.parse('<?= json_encode($model); ?>');
            console.log($scope.model);
            $scope.save = function () {
                if ($scope.myform.$invalid) {
                    $scope.istrue = true;
                    return $timeout(function () {
                        $scope.istrue = false;
                    }, 3000);
                }
                $http.post(wsh.url + 'payment-setting-wxpay', $scope.model)
                    .success(function(msg){
                        wsh.successback(msg, '提交成功', false, function () {
                            window.location.href = wsh.url + 'payment-setting-list';
                        });
                    })
            }
        });

    </script>
    <script type="text/javascript">

        $(function () {
            Ospan = $(".leader").find("span");
            $("#back").css("display", "none");
            $("#fin").css("display", "none");
            $("#next").click(function () {
                Ospan.eq(0).removeClass("label-success");
                Ospan.eq(0).addClass("label-light");
                Ospan.eq(1).removeClass("label-light");
                Ospan.eq(1).addClass("label-success");
                $("#home").css("display", "none");
                $("#rule").css("display", "block");
                $("#fin").css("display", "none");
                $("#next").css("display", "none");
                $("#nextOnce").css("display", "inline-block");
                $("#back").css("display", "inline-block");
            })
            $("#back").click(function () {
                Ospan.eq(0).removeClass("label-success");
                Ospan.eq(0).addClass("label-light");
                Ospan.eq(1).removeClass("label-light");
                Ospan.eq(1).addClass("label-success");
                Ospan.eq(2).removeClass("label-success");
                Ospan.eq(2).addClass("label-fin");
                $("#home").css("display", "none");
                $("#rule").css("display", "block");
                $("#fin").css("display", "none");
                $("#nextOnce").css("display", "none");
                $("#next").css("display", "inline-block");
                $("#backOnce").css("display", "inline-block");
                $("#back").css("display", "none");
            })
            $("#backOnce").click(function () {
                Ospan.eq(0).removeClass("label-light");
                Ospan.eq(0).addClass("label-success");
                Ospan.eq(1).removeClass("label-success");
                Ospan.eq(1).addClass("label-light");
                Ospan.eq(2).removeClass("label-success");
                Ospan.eq(2).addClass("label-fin");
                $("#home").css("display", "block");
                $("#rule").css("display", "none");
                $("#fin").css("display", "none");
                $("#nextOnce").css("display", "none");
                $("#next").css("display", "inline-block");
                $("#back").css("display", "none");
                $("#backOnce").css("display", "none");
            })


            $("#nextOnce").click(function () {
                Ospan.eq(0).removeClass("label-success");
                Ospan.eq(0).addClass("label-light");
                Ospan.eq(1).addClass("label-light");
                Ospan.eq(1).removeClass("label-success");
                Ospan.eq(2).removeClass("label-fin");
                Ospan.eq(2).addClass("label-success");

                $("#home").css("display", "none");
                $("#rule").css("display", "none");
                $("#fin").css("display", "block");
                $("#next").css("display", "none");
                $("#nextOnce").css("display", "none");
                $("#next").css("display", "none");
                $("#back").css("display", "inline-block");
            })
        })
    </script>