<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '操作员管理';
?>
<div class="main-container" id="main-container">
  <script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
  <div class="main-container-inner" ng-controller="mainController"> <?php echo $this->render('@app/views/side/manage_setting.php');?>
    <div class="main-content">
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
                    <li > <a ng-href="/shop/manager-list{{$root.getSearchUrl}}">操作员列表</a> </li>
                    <li class="active"> <a ng-href="/role/list{{$root.getSearchUrl}}">角色管理</a> </li>
                  </ul>
              <div class="tab-content">
              <div class=" space-6"> </div>
                <div id="role" class="tab-pane active">  <a ng-if="$root.hasPermission('role/add')" ng-href="/role/add{{$root.getSearchUrl}}" class="btn btn-xs btn-primary">添加角色</a>
                  <div class=" space-6"> </div>

                  <form class="form-horizontal" role="form">
                    <table width="100%" class="table table-striped table-bordered table-hover table-width">
                      <thead>
                        <tr>
                          <th width="9%" class="text-center">ID</th>
                          <th width="9%" class="text-center">角色</th>
                          <th width="9%" class="text-center">添加时间</th>
                          <th width="9%" class="text-center">修改时间</th>
                          <th width="19%" class="text-center">操作</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="list in lists" ng-cloak>
                          <td class="text-center" ng-bind="list.id"></td>
                          <td class="text-center" ng-bind="list.title"></td>
                          <td class="text-center" ng-bind="list.created * 1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                          <td class="text-center" ng-bind="list.modified * 1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                          <td class="text-center action-buttons">
                            <a ng-if="$root.hasPermission('role/edit')" ng-href="{{'/role/edit?id=' + list.id}}" class="blue pointer" title="修改"><i class="icon-bianji bigger-130"></i></a>
<!--                            <a class="red pointer " ng-click="btnDisable(list.id)" ng-if="$root.hasPermission('role/permission')" href="{{'/role/permission?id=' + list.id}}"><i class="icon-quanxiandongjie bigger-130"></i></a>-->
                             <a ng-if="$root.hasPermission('role/delete-ajax')" class="red pointer" title="删除" ng-click="btnDelete(list.id)"><i class="icon-shanchu bigger-130"></i></a>
                          </td>
                        </tr>
                        <tr ng-show="!lists.length">
                            <td colspan="5" class="red text-center">暂时没有可显示的数据</td>
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
  <script>
app.controller("mainController", function($scope, $timeout, $rootScope, $http) {
	$timeout(function(){$rootScope.$broadcast('leftMenuChange', 'ad');},100);
	var int = 1;
  $scope.options = {callback:getData};
	getData(int);
	function getData(int) {
		$http.post(wsh.url + 'list-ajax', {'_page': int, '_page_size': 10})
			.success(function(msg){
				wsh.successback(msg, '', false, function(){
					$scope.lists = msg.errmsg.data;
					$scope.page = msg.errmsg.page;
				});
			})
	}

    //删除
    $scope.btnDelete = function(id){
		wsh.setDialog('删除提示', '确定要删除此记录吗?', wsh.url + 'delete-ajax', {"id": id}, function(){
			getData(1);
		}, '删除成功');
    };
});
</script> 
</div>
