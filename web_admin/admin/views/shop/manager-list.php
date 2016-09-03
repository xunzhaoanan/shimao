<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '操作员管理';
?>
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>
    <div class="main-container-inner" ng-controller="mainController" ng-cloak> <?php echo $this->render('@app/views/side/manage_setting.php');?>
        <div class="main-content">
            <div class="bootbox modal fade in"  id="query2" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"> <a  type="button" class="bootbox-close-button close" data-dismiss="modal">×</a>
                            <h4 class="modal-title">查看绑定二维码</h4>
                        </div>
                        <div class="modal-body">
                            <div class="bootbox-body">
                                <div class="center">
                                    <img src="../qrcode/image?url=<?= getMobileSite() ?>/user/bind-manager" width="380" height="380">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs" id="breadcrumbs" >
                <script type="text/javascript">try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}</script>
                <ul class="breadcrumb">
                    <li>操作员管理</li>
                </ul>
                <!-- .breadcrumb -->
            </div>
            <div class="page-content">
                <!-- /.page-header -->
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="tabbable">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"> <a href="/shop/manager-list">操作员列表</a> </li>
                                <li > <a  href="/role/list">角色管理</a> </li>
                            </ul>
                            <div class="tab-content">
                                <div class=" space-6"> </div>
                                <div id="home" class="tab-pane active"> <a href="#" data-toggle="modal" data-target="#query2"  class="btn btn-xs btn-primary">微信绑定</a>
                                    <a ng-if="$root.hasPermission('shop/manager-add')" href="/shop/manager-add"  class="btn btn-xs btn-primary">添加操作员</a>
                                    <div class=" space-6"> </div>

                                    <form class="form-horizontal" role="form">
                                        <table width="100%" class="table table-striped table-bordered table-hover table-width">
                                            <thead>
                                            <tr>

                                                <th width="9%" class="text-center">操作员姓名</th>
                                                <th width="21%" class="text-center">联系电话</th>
                                                <th width="21%" class="text-center">角色</th>
                                                <th width="16%" class="text-center">微信绑定</th>
                                                <th width="16%" class="text-center">最后登录时间</th>
                                                <!--<th width="16%" class="text-center">状态</th>-->
                                                <th width="19%" class="text-center">操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="list in lists">
                                                <td class="text-center" ng-bind="list.name"></td>
                                                <td class="text-center" ng-bind="list.phone"></td>
                                                <td class="text-center" ng-bind="list.authRole.title"></td>
                                                <td class="text-center" ng-bind="list.shopStaff.is_bind == 1 ? '已绑定' : '未绑定'">已绑定</td>
                                                <td class="text-center" ng-bind="list.modified * 1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                                                <!--<td class="text-center"><label>
                                                    <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox" ng-model="list.deleted" ng-disabled="list.isdisable" ng-change="change($index)">
                                                    <span class="lbl"></span> </label></td>-->
                                                <td class="text-center action-buttons">
                                                    <a ng-if="$root.hasPermission('shop/manager-edit')" href="{{'/shop/manager-edit?id=' + list.id}}" class="blue pointer" data-rel="tooltip" title="修改"><i class="icon-bianji bigger-130"></i></a>
                                                    <a  ng-if="$root.hasPermission('shop/manage-del-ajax')"  class="red pointer" data-rel="tooltip" title="删除" ng-click="btnDelete(list.id)"><i class="icon-shanchu bigger-130"></i></a>
                                                    <a style="cursor: pointer;" ng-click="btnDisable(list.shopStaff.id)" ng-show="list.shopStaff.is_bind == 1">微信解绑</a>
                                                </td>
                                            </tr>
                                            <tr ng-show="!lists.length" ng-cloak>
                                                <td colspan="6" class="red text-center">暂时没有可显示的数据</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div ng-paginate options="options" page="page">
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
<script>
    app.controller("mainController", function($scope, $timeout, $rootScope, $http) {
        $timeout(function () { $rootScope.$broadcast('leftMenuChange', 'ad');  }, 100);
        var int = 1;

        $scope.options = {callback:getData};
        getData(int);
        function getData(int) {
            $http.post('/shop/manager-list-ajax', {'_page': int, '_page_size': 10})
                .success(function(msg){
                    wsh.successback(msg, '', false, function(){
                        $scope.lists = msg.errmsg.data;
                        $scope.page = msg.errmsg.page;
                    });
                })

        }
        $scope.change = function(index){
            $scope.lists[index].isdisable = true;
            if (!$scope.lists[index].deleted) {
                $http.post('/shop/manager-close-ajax', {id: $scope.lists[index].id})
                    .success(function(msg) {
                        wsh.successback(msg, '禁用成功', false, function(){
                            $scope.lists[index].isdisable = false;
                        });
                    })
            } else {
                $http.post('/shop/manager-open-ajax', {id: $scope.lists[index].id})
                    .success(function(msg) {
                        wsh.successback(msg, '启用成功', false, function(){
                            $scope.lists[index].isdisable = false;
                        });
                    })
            }
        };

        //查看二维码
        $scope.getQrcode = function(id) {
            $http.post('/weixin/qrcode-detail-ajax', {"model": "staff","model_id": id})
                .success(function(msg) {
                    wsh.successback(msg, '', false, function(){
                        $rootScope.srcImg = msg["errmsg"];
                    });
                })
        }

        //解绑
        $scope.btnDisable = function(id){
            $http.post('/mall/disable-staff-ajax', {"id": id})
                .success(function(msg) {
                    wsh.successback(msg, '解绑成功', true, function(){

                    });
                })
        }
        //删除
        $scope.btnDelete = function(id){
            wsh.setDialog('删除提示', '确定要删除此记录吗?', '/shop/manage-del-ajax', {"id": id}, function(){
                getData(parseInt($scope.page.current_page) + 1);
            }, '删除成功')
        }

        $scope.btnDisable = function (id) {
            $.ajax({
                type: "POST",
                url: "<?= Url::to(['/staff/disable-ajax']);?>",
                dataType: "JSON",
                data: {"id": id},
                success: function (msg) {
                    console.log(msg);
                    wsh.successback(msg, '解绑成功', true, function () {
                    });
                }
            });

        };
    });
</script>
