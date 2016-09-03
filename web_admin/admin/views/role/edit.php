<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '角色编辑';
?>
<link rel="stylesheet" href="/ace/ztree/css/demo.css"/>
<link rel="stylesheet" href="/ace/ztree/css/zTreeStyle.css"/>
<script type="text/javascript" src="/ace/ztree/js/jquery.ztree.core-3.5.js"></script>
<script type="text/javascript" src="/ace/ztree/js/jquery.ztree.excheck-3.5.js"></script>
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>
    <div class="main-container-inner" ng-controller="mainController">
        <?php echo $this->render('@app/views/side/manage_setting.php'); ?>
        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">try {
                        ace.settings.check('breadcrumbs', 'fixed')
                    } catch (e) {
                    }</script>
                <ul class="breadcrumb">
                    <li>角色编辑</li>
                </ul>
                <!-- .breadcrumb -->
            </div>
            <div class="page-content">
                <!-- /.page-header -->
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="space-10"></div>
                        <form class="form-horizontal" name="myform" novalidate="novalidate">
                            <div class="form-group margin-bottom10 clearfix">
                                <label class="width120 float-left text-right margin-right10 clearfix"
                                       for="form-field-1">
                                    <strong class="red verg_mid">*</strong>角色名称
                                </label>

                                <div class="col-xs-9">
                                    <input placeholder="输入字符数不大于50" class="col-sm-3" type="text" ng-model="model.title"
                                           name="title" required ng-maxlength="50">
                                    <span class="inline padding5 red" ng-show="myform.title.$error.required && isSubmit"
                                          ng-cloak>必填项</span>
                                    <span class="inline padding5 red" ng-show="myform.title.$error.maxlength" ng-cloak>字符个数不大于50</span>
                                </div>
                            </div>

                          <div class="content_wrap" style="padding-left: 130px;">
                            <ul id="treeDemo" class="ztree"></ul>
                          </div>

                            <div class="space-6"></div>
                            <div class="form-group margin-bottom10 clearfix">
                                <label class="width120 float-left text-right margin-right10 clearfix"
                                       for="form-field-1"></label>

                                <div class="col-xs-9">
                                    <a type="button" class="btn btn-primary" ng-click="btnSave()" id="btnSve"> 保存 </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    app.controller("mainController", function ($scope, $http, $rootScope,$timeout) {
        $timeout(function(){$rootScope.$broadcast('leftMenuChange', 'ad');},100);
        var zNodes = JSON.parse('<?= addslashe(json_encode($menu)); ?>');
        $scope.model = JSON.parse('<?= addslashe(json_encode($model)); ?>');
        console.log($scope.model);

        $scope.isSubmit = false;
        $scope.btnSave= function(){
            if($scope.myform.$invalid){
                $scope.isSubmit = true;
                return $timeout(function(){
                    $scope.isSubmit = false;
                },2000);
            }
            $('#btnSave').attr('disabled','disabled');
            $.ajax({
                type: "post",
                url: wsh.url+ "edit-ajax",
                data: {
                    'id': $scope.model.id,
                    'title': $scope.model.title
                },
                dataType: "json",
                success: function(msg){
                    $('#btnSave').removeAttr('disabled');
                    wsh.successback(msg, '', false, function(){
//                        window.location = 'list';
                      $scope.editRole();
                    });
                },
                error: function(msg){
                    $('#btnSave').removeAttr('disabled');
                    wsh.successback(msg);
                }
            });
        }


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
        console.log(zNodeArray)
        $.fn.zTree.init($("#treeDemo"), setting, zNodeArray);
      });

      $scope.editRole = function(){
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
                        window.location.href = '../role/list' + $rootScope.getSearchUrl;
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
