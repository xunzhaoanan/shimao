<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '权限分配';
?>
<link rel="stylesheet" href="/ace/ztree/css/demo.css"/>
<link rel="stylesheet" href="/ace/ztree/css/zTreeStyle.css"/>
<script type="text/javascript" src="/ace/ztree/js/jquery.ztree.core-3.5.js"></script>
<script type="text/javascript" src="/ace/ztree/js/jquery.ztree.excheck-3.5.js"></script>
<div class="main-container" id="main-container" ng-controller="mainController">
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
                    <li>权限分配</li>
                </ul>
            </div>
            <div class="page-content">
                <!-- /.page-header -->
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <!--<div ng-repeat="list in menu.funcList">-->
                            <!--<h4 ng-bind="list.title"></h4>-->
                            <!--<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped table-bordered"-->
                                   <!--ng-show="!is_function_menu" ng-repeat="sub_level_1 in list.sub">-->
                                <!--<thead>-->
                                <!--<th>-->
                                    <!--<span ng-bind="sub_level_1.title"> </span>-->
                                    <!--<label class="margin-left10" ng-show="sub_level_1.rAuthFunctionAuthFunctionMenus.length !=0">-->
                                        <!--<input type="checkbox" class="ace" ng-model="sub_level_1.isAllCheck"-->
                                               <!--ng-click="chooseAll(sub_level_1.isAllCheck, sub_level_1.rAuthFunctionAuthFunctionMenus)">-->
                                        <!--<span class="lbl"> 全选</span>-->
                                    <!--</label>-->
                                <!--</th>-->
                                <!--</thead>-->
                                <!--<tbody>-->
                                <!--<tr ng-show="sub_level_1.is_function_menu">-->
                                    <!--<td ng-show="sub_level_1.rAuthFunctionAuthFunctionMenus.length !=0">-->
                                        <!--<label class="inline margin-right10 margin-top5" ng-repeat="function in sub_level_1.rAuthFunctionAuthFunctionMenus">-->
                                            <!--<input type="checkbox" class="ace" ng-model="function.isCheck" ng-click="singleCheck(function.isCheck, function.auth_function_id, function)">-->
                                            <!--<span class="lbl" ng-bind="function.authFunction.remark"> </span>-->
                                        <!--</label>-->
                                    <!--</td>-->
                                    <!--<td ng-show="sub_level_1.rAuthFunctionAuthFunctionMenus.length ==0">-->
                                        <!--<lable>暂时没有权限数据</lable>-->
                                    <!--</td>-->
                                <!--</tr>-->
                                <!--<tr ng-show="!sub_level_1.is_function_menu">-->
                                    <!--<td>-->
                                        <!--<div ng-repeat="sub_level_2 in sub_level_1.sub">-->
                                            <!--<div class="margin-top10">-->
                                                <!--<span class="red " ng-bind="sub_level_2.title"></span>-->
                                                <!--<label class="margin-left10" ng-show="sub_level_2.rAuthFunctionAuthFunctionMenus.length !=0">-->
                                                  <!--<input type="checkbox" class="ace" ng-model="sub_level_2.isAllCheck"-->
                                                         <!--ng-click="chooseAll(sub_level_2.isAllCheck, sub_level_2.rAuthFunctionAuthFunctionMenus)">-->
                                                  <!--<span class="lbl"> 全选</span>-->
                                              <!--</label>-->
                                            <!--</div>-->

                                            <!--<label class="inline margin-right10 margin-top5" ng-repeat="function in sub_level_2.rAuthFunctionAuthFunctionMenus">-->
                                                <!--<input type="checkbox" class="ace" ng-model="function.isCheck" ng-click="singleCheck(function.isCheck, function.auth_function_id, function)">-->
                                                <!--<span class="lbl" ng-bind="function.authFunction.remark"> </span>-->
                                            <!--</label>-->
                                            <!--<lable ng-show="sub_level_2.rAuthFunctionAuthFunctionMenus.length ==0">暂时没有权限数据</lable>-->
                                        <!--</div>-->
                                    <!--</td>-->
                                    <!--<td ng-show="sub_level_1.sub.length ==0">-->
                                        <!--<lable>暂时没有权限数据</lable>-->
                                    <!--</td>-->
                                <!--</tr>-->
                                <!--</tbody>-->
                            <!--</table>-->
                            <!--<hr>-->
                        <!--</div>-->

                        <div class="content_wrap">
                            <ul id="treeDemo" class="ztree"></ul>
                        </div>

                        <!--<div class="col-sm-12 space-5 clearfix"></div>-->
                        <div class="col-sm-12 marginauto2 text-center" style="margin-top: 30px;">
                            <!--<a class="btn btn-success"> 保存并关闭窗口 </a>-->
                            <a class="btn btn-primary" ng-click="btnSave()" id="btnSave">
                                <i class="icon-ok bigger-110"></i> 保存 </a>
                            <!--<a class="btn btn-danger"> 确定退出 </a>-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.main-container-inner -->
    </div>
</div>
<!-- /row -->
<div class="dd" id="nestable"></div>
<script type="text/javascript">
    app.controller("mainController", function ($scope, $rootScope, $timeout, $http) {
        $timeout(function () {
            $rootScope.$broadcast('leftMenuChange', 'ad');
        }, 100);
        var zNodes = JSON.parse('<?= addslashe(json_encode($menu)); ?>');
        var zNodeArray = [];



        
        for(var item in zNodes){
            var obj = zNodes[item];
            if(obj.title){
                obj.name = obj.title;
                obj.pId = obj.pid;
                zNodeArray.push(obj); 
            }
        }


        var setting = {
            check: {
                enable: true
            },
            data: {
                simpleData: {
                    enable: true
                }
            }
        };


        $(document).ready(function(){
            $.fn.zTree.init($("#treeDemo"), setting, zNodeArray);
        });

//        setTimeout(function(){
//            console.log($('#treeDemo span.button.ico_docu'));
//            $('#treeDemo span.button.ico_docu').parent('li').css({'display': 'inline-block'});
//        }, 1000)

//console.log($('.ico_docu').length);
//        $('#treeDemo span.button.ico_docu').parent('li').css({'display': 'inline-block'});

        $scope.btnSave = function(){
            var treeObj = $.fn.zTree.getZTreeObj("treeDemo");
            var nodes = treeObj.getCheckedNodes(true);
            var arrayId = []
            $(nodes).each(function(a, b){
                arrayId.push(b.id);
            });
            if(!arrayId.length){
                return alert('请选择权限分配！')
            }
            var roleId = parseInt(wsh.getHref('id'));

//            console.log(roleId);
            $('#btnSave').attr('disabled', 'disabled');
            $http.post("../role/save-role-function-ajax", {'ids': arrayId, 'auth_role_id': roleId})
                .success(function(msg){
                    $('#btnSave').removeAttr('disabled');
                    wsh.successback(msg, '修改成功！', false, function(){
                        window.location.href = '../role/list';
                    });
                })
                .error(function(msg){
                    $('#btnSave').removeAttr('disabled');
                    wsh.successback(msg);
                });
            console.log("chooseAll", arrayId);
        }

    });
</script>
