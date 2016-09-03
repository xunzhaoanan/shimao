<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '砸金蛋活动列表';
?>
<div class="main-container" id="main-container" ng-controller="mainController">
  <script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/marketing.php');?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs"> 
        <script type="text/javascript">
              try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>
        <ul class="breadcrumb">
          <li>砸金蛋活动列表</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="clearfix no-padding">
              <div class="col-sm-7 no-padding">
                <ul class="listli left-space1 btn-primary bune">
                  <li><a href="/market-activity/smashegg-add" ng-if="$root.hasPermission('market-activity/smashegg-add')" class="btn btn-xs btn-primary">新增活动</a></li>
                </ul>
              </div>
            </div>
            <div class="space-6 clearfix col-sm-12"></div>
            <div class="table-responsive clearfix">
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                  <tr>
                    <th width="10%" class="text-center">活动名称</th>
                    <th width="10%" class="text-center">活动类型</th>
                    <th width="15%" class="text-center">开始时间</th>
                    <th width="15%" class="text-center">结束时间</th>
                    <th width="10%" class="text-center">状态</th>
                    <th width="10%"  class="text-center">操作</th>
                  </tr>
                </thead>
                <tbody>
                  <tr ng-repeat="list in lists" ng-cloak>
                    <td class="lt-width3 text-center" ng-bind="list.activity_name"></td>
                    <td class="text-center"  ng-bind="shareType(list.share_type)"></td>
                    <td class="text-center" ng-bind="list.start_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                    <td class="text-center" ng-bind="list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                    <td class="text-center"><label>
                        <input name="switch-field-1"ng-disabled="!$root.hasPermission('market-activity/open-smashegg-ajax')" class="ace ace-switch ace-switch-6" ng-model="list.isDelete" type="checkbox" ng-click="btnStatus(list)">
                        <span class="lbl"></span> </label></td>
                    <td class="text-center"><div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                      <a target="_blank" ng-href="{{'/activity/qrcode?model=marketing_activity&model_id='+list.id}}" class="blue pointer "><i class="icon-erweima bigger-130 text-decoration"></i></a>
                      <a class="grey pointer "  ng-if="$root.hasPermission('market-activity/smashegg-winner-record')"  href="/market-activity/smashegg-winner-record?id={{list.id}}" title="中奖名单"><i class="icon-renyuanjieshao bigger-130 text-decoration"></i></a>
                      <a ng-href="{{'/market-activity/smashegg-edit?id=' + list.id}}" class="pointer" ng-if="$root.hasPermission('market-activity/smashegg-edit')" title="编辑"><i class="icon-bianji bigger-130 text-decoration"></i></a>
                   	<a class="red pointer" title="删除" ng-click="btnDelete(list)" ng-if="$root.hasPermission('market-activity/del-smashegg-ajax')"> <i class="icon-shanchu bigger-140"></i></a>

                    </div></td>
                  </tr>
                  <tr ng-cloak ng-show="!lists.length || !lists" class="center">
                    <td colspan="6">暂无数据</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div ng-paginate options="options" page="page"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
app.controller('mainController', function($scope, $rootScope, $timeout) {
	$timeout(function() {
		$rootScope.$broadcast('leftMenuChange', 'eb');
	}, 100);
	$scope.template = JSON.parse('<?= addslashe(json_encode($template))?>');
  //分页
  $scope.options = {callback:getData};
  var int = 1;
	getData(int);
	function getData(int) {
		$.ajax({
			type: "POST",
			url: "<?= Url::to(['market-activity/smashegg-list-ajax']);?>",
			dataType: "JSON",
			data: {
				"_page": int,
				"_page_size": 15
			},
			success: function(msg) {
				wsh.successback(msg, '', false, function() {
					$scope.lists = msg.errmsg.data;
					$($scope.lists).each(function(a, b) {
						b.isDelete = b.deleted == 1 ? true : false;
					});
					$scope.page = msg.errmsg.page;
					$scope.$apply();
					console.log(msg);
				});
			}
		});
	}
  //活动类型
  $scope.shareType = function(id){
    switch (id){
      case 1:
        return '开放性活动';
        break;
      case 2:
        return '线下分享活动';
        break;
      case 3:
        return '线下活动';
        break;
      default :
        return '没有活动类型';
    }
  };

	//状态
	$scope.btnStatus = function(list) {
		if (list.isDelete) {
			$.ajax({
				type: "POST",
				url: "<?= Url::to(['market-activity/open-smashegg-ajax']);?>",
				dataType: "JSON",
				data: {
					"id": list.id
				},
				success: function(msg) {
					wsh.successback(msg, '已开启', false, function() {

					});
				}
			});
		} else {
			$.ajax({
				type: "POST",
				url: "<?= Url::to(['market-activity/close-smashegg-ajax']);?>",
				dataType: "JSON",
				data: {
					"id": list.id
				},
				success: function(msg) {
					wsh.successback(msg, '已关闭', false, function() {

					});
				}
			});
		}
	};

	//删除
	$scope.btnDelete = function(list) {
		wsh.setDialog('活动删除提示', '确定要删除此活动吗?', '/market-activity/del-smashegg-ajax', {"id": list.id}, function(){getData(1)}, '删除成功');
	}


});
</script> 
