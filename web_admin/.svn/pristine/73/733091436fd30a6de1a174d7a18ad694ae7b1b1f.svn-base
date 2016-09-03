<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '编辑操作员';
?>
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>
    <div class="main-container-inner" ng-controller="mainController" ng-cloak>
        <?php echo $this->render('@app/views/side/manage_setting.php'); ?>
        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">try {
                        ace.settings.check('breadcrumbs', 'fixed')
                    } catch (e) {
                    }</script>
                <ul class="breadcrumb">
                    <li>编辑操作员</li>
                </ul>
                <!-- .breadcrumb -->
            </div>
            <div class="page-content">
                <!-- /.page-header -->
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="space-10"></div>
                        <form class="form-horizontal" role="form" novalidate="novalidate" name="myform">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label" for="form-field-1"><span
                                        class="red">*</span>账号：</label>

                                <div class="col-sm-10">
                                    <input placeholder="" class="col-sm-3 no-float" type="text" name="qq"
                                           ng-model="model.qq" required="required"
                                           ng-readonly="model.is_default != 1 ? false : true">
                                    <span class="red" ng-show="myform.qq.$error.required && istrue">必填项</span>
                                    <span class="red"
                                          ng-show="myform.qq.$error.pattern && istrue">登录名格式错误</span>
                                </div>
                            </div>

                            <!--<div class="form-group clearfix">
                                <label class="col-sm-2 control-label" for="form-field-1">密码：</label>

                                <div class="col-sm-10">
                                    <input placeholder="" class="col-sm-3 no-float" type="password" name="password"
                                           ng-model="model.password" required="required" ng-minlength="6">
                                    <span style="color:gray;" ng-show="!istrue">密码不可少于6位数</span>
                                    <span class="red"
                                          ng-show="myform.password.$error.required && istrue">必填项</span>
                                    <span class="red" ng-show="myform.password.$error.minlength && istrue">密码格式错误</span>
                                </div>
                            </div>-->
                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label" for="form-field-1"><span
                                        class="red">*</span>姓名：</label>

                                <div class="col-sm-10">
                                    <input placeholder="" class="col-sm-3 no-float" type="text" name="name"
                                           ng-model="model.name" required="required"
                                           ng-pattern="/^[\u2E80-\u9FFF]{2,5}$/">
                                    <span style="color:gray;" ng-show="!istrue">(请输入2-5个汉字)</span>
                                    <span class="red" ng-show="myform.name.$error.required && istrue">必填项</span>
                                    <span class="red"
                                          ng-show="myform.name.$error.pattern && istrue">姓名验证错误</span>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label" for="form-field-1"><span class="red">*</span>
                                    <strong>性别：</strong> </label>

                                <div class="col-sm-10" id="radio">
                                    <label>
                                        <input name="form-field-radio" type="radio" class="ace"
                                               ng-checked="model.sex == 2 ? true : false">
                                        <span class="lbl inline margin-top5"> 女</span> </label>
                                    <label>
                                        <input name="form-field-radio" type="radio" class="ace"
                                               ng-checked="model.sex == 1 ? true : false">
                                        <span class="lbl inline margin-top5"> 男</span></label>
                                </div>
                            </div>
                            <div class="form-group clearfix" ng-if="model.is_default != 1">
                                <label class="col-sm-2 control-label" for="form-field-1"><span class="red">*</span>
                                    <strong>角色：</strong> </label>

                                <div class="col-sm-10">
                                    <select class="col-sm-3 no-float" name="role_id" ng-model="model.role_id"
                                            ng-options="list.id as list.title for list in roleLists">
                                    </select>
                                    <span class="red" ng-show="isSelectRole">请选择角色</span>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label" for="form-field-1"><span class="red">*</span>Email：</label>

                                <div class="col-sm-10">
                                    <input placeholder="" class="col-sm-3 no-float" type="text" name="email"
                                           ng-model="model.email" required="required"
                                           ng-pattern="/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/">
                                    <span class="red" ng-show="myform.email.$error.required && istrue">必填项</span>
                                    <span class="red" ng-show="myform.email.$error.pattern && istrue">邮箱验证错误</span>
                                </div>
                            </div>
                            <div class="form-group margin-bottom10 clearfix">
                                <label class="col-sm-2 control-label" for="form-field-1"><span
                                        class="red">*</span>电话：</label>

                                <div class="col-sm-10">
                                    <input placeholder="" class="col-sm-3 no-float" type="text" name="phone"
                                           ng-model="model.phone" required="required"
                                           ng-pattern="" reg-mobile>
                                    <span style="color:gray;" ng-show="!istrue">请输入手机号码或座机号（如0245-2565878）或400电话（如400-856-7895）</span>
                                    <span class="red" ng-show="myform.phone.$error.required && istrue">必填项</span>
                                    <span class="red" ng-show="myform.phone.$error.pattern && istrue">号码验证错误</span>
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label" for="form-field-1"></label>

                                <div class="col-sm-10">
                                    <a type="button" class="btn btn-primary" ng-click="save()"> 确定 </a>
                                    <a type="button" class="btn btn-primary"
                                       ng-href="{{'edit-manager-pwd?id=' + model.id}}"> 修改密码 </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        app.controller("mainController", function ($scope, $http, $rootScope, $timeout) {
            $timeout(function () {
                $rootScope.$broadcast('leftMenuChange', 'ad');
            }, 100);
            $scope.model ={};
            $scope.model = JSON.parse('<?= addslashe(json_encode($model)); ?>');

            console.log($scope.model);
            //获取角色
            $scope.model.role_id = $scope.model.role_id ? $scope.model.role_id : -1;
            $scope.roleLists = [{id: -1, title: '请选择角色'}];
            $http.post("/role/list-ajax", {"_page_size":1000})
                .success(function (msg) {
                    wsh.successback(msg, '', false, function () {
                        $scope.roleLists = $scope.roleLists.concat(msg.errmsg.data);
                        console.log('$scope.roleLists', $scope.roleLists);
                    });
                });

            $scope.istrue = false;
            $scope.save = function () {
                if ($scope.myform.$invalid) {
                    $scope.istrue = true;
                    return $timeout(function () {
                        $scope.istrue = false;
                    }, 3000);
                }
                if ($scope.model.role_id == -1 && $scope.model.is_default != 1) {
                    $scope.isSelectRole = true;
                    return $timeout(function () {
                        $scope.isSelectRole = false;
                    }, 3000);
                }
                $scope.model.sex = $('#radio').find('input[type="radio"]').eq(1).prop('checked') ? 1 : 2;
                $http.post("/shop/manager-edit-ajax", $scope.model)
                    .success(function (msg) {
                        wsh.successback(msg, '修改成功', false, function () {
                            window.location.href = 'manager-list';
                        });
                    })
            }
        });
    </script>
</div>
