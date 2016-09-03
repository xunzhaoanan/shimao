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
                                <label class="col-sm-2 control-label" for="form-field-1"><span class="red">*</span>账号：</label>

                                <div class="col-sm-10">
                                    <input placeholder="" class="col-sm-3 no-float" type="text" name="qq"
                                           ng-model="model.qq" required="required">
                                    <span class="red" ng-show="myform.qq.$error.required && istrue">必填项</span>
                                    <span class="red"
                                          ng-show="myform.qq.$error.pattern && istrue">登录名格式错误</span>
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label" for="form-field-1"><span class="red">*</span>密码：</label>

                                <div class="col-sm-10">
                                    <input placeholder="" class="col-sm-3 no-float" type="password" name="password"
                                           ng-model="model.password" required="required" ng-minlength="6" ng-maxlength="15">
<!--                                    <span style="color:gray;" ng-show="!istrue">密码不可少于6位数</span>-->
                                    <span class="red"
                                          ng-show="myform.password.$error.required && istrue">必填项</span>
                                    <span ng-show="myform.password.$error.minlength && istrue" class="red">密码长度不得小于6位</span>
                                    <span ng-show="myform.password.$error.maxlength && istrue" class="red">密码长度不得大于15位</span>
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label" for="form-field-1"></label>

                                <div class="col-sm-10">
                                    <a type="button" class="btn btn-primary" ng-click="save()"> 确定 </a>
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
            $timeout(function () { $rootScope.$broadcast('leftMenuChange', 'ad');  }, 100);
            $scope.model = JSON.parse('<?= addslashe(json_encode($model)); ?>');

            $scope.istrue = false;
            $scope.save = function () {
                if ($scope.myform.$invalid) {
                    $scope.istrue = true;
                    return $timeout(function () {
                        $scope.istrue = false;
                    }, 3000);
                }
                console.log('$scope.model',  $scope.model);
                $http.post("/shop/edit-manager-pwd-ajax", $scope.model)
                        .success(function (msg) {
                            wsh.successback(msg, '修改成功', false, function () {
                                window.location.href = 'manager-list';
                            });
                        })
            }
        });
    </script>
</div>
