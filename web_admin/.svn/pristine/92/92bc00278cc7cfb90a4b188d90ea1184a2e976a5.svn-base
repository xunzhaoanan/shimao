<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '终端店信息';
?>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>
    <div class="main-container-inner">
        <?php echo $this->render('@app/views/side/terminal.php'); ?>
        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try {
                        ace.settings.check('breadcrumbs', 'fixed')
                    } catch (e) {
                    }
                </script>
                <ul class="breadcrumb">
                    <li>终端店信息-修改密码</li>
                </ul>
                <!-- .breadcrumb -->
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="tabbable">
                            <div id="home" class="tab-pane in active">
                                <form novalidate class="form-horizontal ng-pristine ng-valid" name="myform">
                                    <div class="space-6"></div>
                                    <div class="form-group margin-bottom10 clearfix">
                                        <label class="width120 float-left text-right margin-right10 clearfix"
                                               for="form-field-1"><strong>登录帐号:</strong></label>

                                        <div class="col-sm-9">
                                            <label class="width120 float-left text-left margin-right10 clearfix"
                                                   for="form-field-1"
                                                   ng-bind="model.user_name + '@' + wxInfo.account"></label>
                                        </div>
                                    </div>

                                    <div class="form-group margin-bottom10 clearfix">
                                        <label class="width120 float-left text-right margin-right10 clearfix"
                                               for="form-field-1"><span
                                                class="red">*</span><strong>新密码:</strong></label>

                                        <div class="col-sm-9">
                                            <input type="password" ng-model="model.new_pwd" name="new_pwd" required
                                                   ng-minlength="6" ng-maxlength="18">
                                            <span ng-show="myform.new_pwd.$error.required && isSubmit"
                                                  class="red">必填项</span>
                                            <span ng-show="myform.new_pwd.$error.minlength && isSubmit" class="red">密码长度不得小于6位</span>
                                            <span ng-show="myform.new_pwd.$error.maxlength && isSubmit" class="red">密码长度不得大于15位</span>
                                        </div>
                                    </div>

                                    <div class="form-group margin-bottom10 clearfix">
                                        <label class="width120 float-left text-right margin-right10 clearfix"
                                               for="form-field-1"></label>

                                        <div class="col-sm-9"><a ng-click="save()" class="btn btn-primary"> <i
                                                    class="icon-ok bigger-110"></i> 确认提交 </a></div>
                                    </div>
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
<script type="text/javascript">
    app.controller("mainController", function ($scope, $timeout, $http, $rootScope) {
        $scope.model = JSON.parse('<?= addslashe(json_encode($model)); ?>');
        console.log($scope.model);
        $scope.wxInfo = JSON.parse('<?= addslashe(json_encode($wxInfo)); ?>');
        $scope.isSubmit = false;
        var issave = false;
        $scope.save = function () {
            if ($scope.myform.$invalid) {
                $scope.isSubmit = true;
                return $timeout(function () {
                    $scope.isSubmit = false;
                }, 2000);
            }
            if (issave) {
                return;
            }
            issave = true;
            $http.post('/terminal/terminal-edit-pwd-ajax', $scope.model)
                .success(function (msg) {
                    issave = false;
                    wsh.successback(msg, '提交成功', false, function () {
                        window.location.href = '/terminal/detail' + $rootScope.getSearchUrl;
                    });
                });
        };
    });

</script>

