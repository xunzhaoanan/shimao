<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '添加操作员';
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
                    <li>添加操作员</li>
                </ul>
                <!-- .breadcrumb -->
            </div>
            <div class="page-content">
                <!-- /.page-header -->
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="space-10"></div>
                        <form class="form-horizontal " role="form" novalidate="novalidate" name="myform">

                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label" for="form-field-1"><span class="red">*</span>
                                    <strong>账号：</strong> </label>

                                <div class="col-sm-10">
                                    <input placeholder="" class="col-sm-3 no-float" type="text" name="qq"
                                           ng-model="model.qq" required="required" ng-pattern="/^\d{5,10}$/">
                                    <span class="red" ng-cloak ng-show="myform.qq.$error.required && istrue">必填项</span>
                                    <span class="red" ng-cloak ng-show="myform.qq.$error.pattern">账号格式错误，请输入5-10位纯数字的账号</span>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label" for="form-field-1"><span class="red">*</span>
                                    <strong>密码：</strong></label>

                                <div class="col-sm-10">
                                    <input placeholder="" class="col-sm-3 no-float" type="password" name="password"
                                           ng-model="model.password" required="required" ng-minlength="6" ng-maxlength="15">
<!--                                    <span style="color:gray;" ng-cloak ng-show="!istrue">(密码不可少于6位数)</span>-->
                                    <span class="red" ng-cloak
                                          ng-show="myform.password.$error.required && istrue">必填项</span>
                                    <span ng-show="myform.password.$error.minlength && istrue" class="red">密码长度不得小于6位</span>
                                    <span ng-show="myform.password.$error.maxlength && istrue" class="red">密码长度不得大于15位</span>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label" for="form-field-1"><span class="red">*</span>
                                    <strong>姓名：</strong> </label>

                                <div class="col-sm-10">
                                    <input placeholder="" class="col-sm-3 no-float" type="text" name="name"
                                           ng-model="model.name" required="required"
                                           ng-pattern="/^[\u2E80-\u9FFF]{2,5}$/">
                                    <span style="color:gray;" ng-show="!istrue">建议输入2-5个字符</span>
                                    <span class="red" ng-show="myform.name.$error.required && istrue">必填项</span>
                                    <span class="red" ng-show="myform.name.$error.pattern && istrue">姓名验证错误</span>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label" for="form-field-1"><span class="red">*</span>
                                    <strong>性别：</strong> </label>

                                <div class="col-sm-10" id="radio">
                                    <label>
                                        <input name="form-field-radio" type="radio" class="ace" checked="">
                                        <span class="lbl inline margin-top5"> 女</span> </label>
                                    <label>
                                        <input name="form-field-radio" type="radio" class="ace">
                                        <span class="lbl inline margin-top5"> 男</span></label>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label" for="form-field-1"><span class="red">*</span>
                                    <strong>角色：</strong> </label>

                                <div class="col-sm-10">
                                    <select class="col-sm-3 no-float" name="role_id" ng-model="model.role_id"
                                            ng-options="list.id as list.title for list in roleLists">
                                    </select>
                                    <span class="red" ng-show="isSelectRole">请选择角色</span>
                                    <a  class=" btn btn-primary" value="添加新角色"  data-toggle="modal" data-target="#roleAdd" data-statu="0" ng-click="addRole($event)"  ng-if="$root.hasPermission('role/add')"> 添加新角色</a>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label" for="form-field-1"><span class="red">*</span>
                                    <strong>Email：</strong> </label>

                                <div class="col-sm-10">
                                    <input placeholder="" class="col-sm-3 no-float" type="text" name="email"
                                           ng-model="model.email" required="required"
                                           ng-pattern="/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/">
                                    <span class="red" ng-show="myform.email.$error.required && istrue">必填项</span>
                                    <span class="red" ng-show="myform.email.$error.pattern && istrue">邮箱验证错误</span>
                                </div>
                            </div>
                            <div class="form-group margin-bottom10 clearfix">
                                <label class="col-sm-2 control-label" for="form-field-1"><span class="red">*</span>
                                    <strong>电话：</strong> </label>

                                <div class="col-sm-10">
                                    <input placeholder="" class="col-sm-3 no-float" type="text" name="phone"
                                           ng-model="model.phone" required="required"
                                           ng-pattern="" reg-mobile>
                                    <!--<span style="color:gray;" ng-show="!istrue">请输入手机号码或座机号（如0245-2565878）或400电话（如400-856-7895）</span>-->
                                    <span class="red" ng-show="myform.phone.$error.required && istrue">必填项</span>
                                    <span class="red" ng-show="myform.phone.$error.pattern && istrue">号码验证错误</span>
                                </div>
                            </div>
                            <div class="form-group margin-bottom10 clearfix">
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

        <!--添加新角色-->
        <div class="modal fade" id="roleAdd" tabindex="-1" role="dialog" aria-labelledby="imgeditLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="roleAdda" ng-click="addRole($event)">添加新角色</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" name="roleform" novalidate="novalidate">
                            <div class="form-group">
                                <label class="col-sm-2 control-label " name="name">角色名称：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control " id="roleAddb" required="required" name="title" ng-maxlength="50" placeholder="输入字符数不大于50" ng-model="title">
                                    <span class="inline padding5 red" ng-show="roleform.title.$error.required && $root.submit">必填项</span>
                                    <span class="inline padding5 red" ng-show="roleform.title.$error.maxlength" ng-cloak>字符个数不大于50</span><br>
                                    <span>- 创建的新角色将拥有所有默认权限</span><br>
                                    <span>- 如需修改请在“角色管理-修改”中操作</span>
                                </div>
                                <div class="col-sm-3 across-space1 margin-top2"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" ng-click="btnConfirm()" id="btnConfirm" >确定
                        </button>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <script>
        app.controller("mainController", function ($scope, $rootScope, $timeout, $http) {
            $timeout(function () { $rootScope.$broadcast('leftMenuChange', 'ad');  }, 100);
            $scope.istrue = false;
            $scope.model = {};

            //获取角色
            $scope.model.role_id = -1;
            $scope.roleLists = [{id: -1, title: '请选择角色'}];
            $http.post("/role/list-ajax", {"_page_size": 1000})
                .success(function (msg) {
                    wsh.successback(msg, '', false, function () {
                        $scope.roleLists = [{id: -1, title: '请选择角色'}];
                        $scope.roleLists =  $scope.roleLists.concat(msg.errmsg.data);
                    });
                });

           //添加新角色
            $scope.objects = {};
            $scope.statues;
            $scope.addRole = function(event){
                $scope.statues = $(event.target).attr("data-statu");
                $scope.objects = {};
            }


            //保存
            $scope.globalChoose = false;
            $rootScope.submit = false;
            $scope.btnConfirm = function() {
                //表单验证
                if ($scope.roleform.$invalid) {
                    $rootScope.submit = true;
                    return $timeout(function () {
                        $rootScope.submit = false;
                    }, 2000);
                }
                 $('#btnConfirm').attr('disabled', 'disabled');
                  $.ajax({type: "post", url: "/role/add-ajax", data: {'title': $scope.title}, dataType: "json", success: function (msg) {
                  $('#btnConfirm').removeAttr('disabled');
                  wsh.successback(msg, '添加成功', false, function () {
                    $('#roleAdd').modal('hide');
                      console.log(msg.errmsg.data);
                      $http.post("/role/list-ajax", {"_page_size": 1000})
                          .success(function (msg) {
                              wsh.successback(msg, '', false, function () {
                                  $scope.model.role_id = -1;
                                  $scope.roleLists = [];
                                  $scope.roleLists = [{id: -1, title: '请选择角色'}];
                                  $scope.roleLists =  $scope.roleLists.concat(msg.errmsg.data);
                              });
                          });
                 });
              },
               error: function (msg) {
                $('#btnConfirm').removeAttr('disabled');
               wsh.successback(msg);
              }
             });
            }



            var is_ajax = false;
            $scope.save = function () {
                if ($scope.myform.$invalid) {
                    $scope.istrue = true;
                    return $timeout(function () {
                        $scope.istrue = false;
                    }, 3000);
                }
                if ($scope.model.role_id == -1) {
                    $scope.isSelectRole = true;
                    return $timeout(function () {
                        $scope.isSelectRole = false;
                    }, 3000);
                }
                if (is_ajax) {
                    return false;
                }
                is_ajax = true;
                $scope.model.sex = $('#radio').find('input[type="radio"]')[0].checked ? 1 : 2;
                $http.post("/shop/manager-add-ajax", $scope.model)
                    .success(function (msg) {
                        wsh.successback(msg, '添加成功', false, function () {
                            window.location.href = 'manager-list';
                        });
                        is_ajax = false;
                    });
            }
        });
    </script>
</div>
