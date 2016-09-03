<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '操作员帐号授权';
?>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
	<script type="text/javascript">try {
	ace.settings.check('main-container', 'fixed')
} catch (e) {}</script>
	<div class="main-container-inner">
		<?php
		echo $this -> render('@app/views/side/manage_setting.php');
		?>
		<div class="main-content">
			<div class="breadcrumbs" id="breadcrumbs">
				<script type="text/javascript">try {
	ace.settings.check('breadcrumbs', 'fixed')
} catch (e) {}</script>
				<ul class="breadcrumb">
					<li>
				 商家帐号绑定
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
						<div class="clearfix">
							<div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="ace-icon icon icon-times">
									</i>
								</button>
								<h4 class="black">
									操作方法:
								</h4>
								<ul class="alert-success">
									<li>
										1、被选中的帐号会获得权限，通过公众号收到消息推送；
									</li>
									<li>
										2、一个操作员账号只能绑定一个微信号，同一个门店下允许多个操作员获得权限
									</li>
								</ul>
								
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-6 across-space1 margin-bottom10" ng-click="add()">
									<a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#operatorModal">
										选择操作员
									</a>
									<!--<a href="" class="btn btn-sm btn-primary margin-left10" data-toggle="modal" data-target="#myModal2">-->
										<!--选择员工-->
									<!--</a>-->
								</div>
							</div>
						</div>
						<div class="space-6"></div>
						<div class="row">
							<div class="col-xs-12">
								<div class="table-responsive action-buttons">
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th width="10%" class="text-center">
													编号
												</th>
												<th width="15%" class="text-center">
													类型
												</th>
												<th width="15%" class="text-center">
													名称
												</th>
												<th width="15%" class="text-center">
													昵称
												</th>
												<th width="10%" class="text-center">
													操作
												</th>
											</tr>
										</thead>
										<tbody>
											<!-- ngRepeat: list in listData -->
											<tr ng-repeat="list in lists">
												<td class="center "  ng-bind="list.id">1</td>
												<td class="center ">操作员</td>
												<td class="center " ng-bind="list.real_name"></td>
												<td class="center" ng-bind="list.user_name" ></td>
												<td class="center"  ng-show="list.deleted == 2" >
													<a href="" class="pointer blue" title="授权"  ng-click="oauth(list)">
														<i class="icon-jiedong bigger-130">
														</i>
													</a>

												</td>
												<td class="center"  ng-show="list.deleted == 1">
													<a href="" class="pointer blue" title="取消授权" ng-click="cancelOauth(list)">
														<i class="icon-quanxiandongjie bigger-130">
														</i>
													</a>

												</td>
											</tr>
											<tr ng-cloak ng-show="!lists.length || !lists" class="center red">
												<td colspan="5" >	暂时没有可显示的数据</td>
											</tr>
											<!-- end ngRepeat: list in listData -->
										</tbody>
									</table>
									<div ng-paginate options="options" page="page"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- PAGE CONTENT BEGINS -->
				<!-- /.page-header -->
			</div>
		</div>
	</div>
</div>
	<?php echo $this -> render('@app/views/wx-msg-tpl/option-operator.php'); ?>

<script>
	app.controller("mainController", function($scope, $timeout, $rootScope,$http) {
		$timeout(function(){$rootScope.$broadcast('leftMenuChange', 'ag');}, 100);
		$scope.page = {};
		getData(1);
		function getData(int) {
			$http.post(wsh.url + "get-default-staff-list", {"_page": int, "_page_size": 20})
					.success(function (msg) {
						wsh.successback(msg, '', false, function () {
							$scope.lists = msg.errmsg.data;
							$scope.page = msg.errmsg.page;

							console.log($scope.lists );
						});
					})
		}
		$scope.options = {page: 'page', callback: getData};
		$scope.sellerOptionTpl = [];
		$scope.$on('chooseOptionOperator', function(e, json){
			getData(1);
		})



		$scope.oauth = function(obj){
			console.log(11)
			$.post(wsh.url + 'update-default-staff-status', {id: obj.id,deleted:1}, function(msg){
				wsh.successback(msg, '授权成功', false, function(){
					obj.deleted = 1;

				});
			}, 'json');
		}
		$scope.cancelOauth = function(obj){
			$.post(wsh.url + 'update-default-staff-status', {id: obj.id,deleted:2}, function(msg){
				wsh.successback(msg, '取消授权成功', false, function(){
					obj.deleted = 2;
				});
			}, 'json');
		}
	});
	</script>