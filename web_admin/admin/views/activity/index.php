<div class="main-container"  id="main-container" ng-controller="childController">
  <script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
  <div class="main-container-inner">
    <div class="page-content"> 
      <!-- /.page-header --> 
      <!-- PAGE CONTENT BEGINS -->
      <div class="row">
        <div class="col-xs-12"> 
          <!--操作栏-->
          <div class="clearfix no-padding">
            <div class="col-sm-7 no-padding"> </div>
            <div class="col-sm-5 no-padding">
              <div class="col-sm-12 float-right no-padding">
                <div class="float-right">
                  <div class="input-group float-left">
                    <input class="min-width120 float-left" placeholder="搜索消息相关关键字" type="text">
                    <span class="float-left"> <a class="btn btn-xs btn-primary margin_right1"><i class="icon-search icon-on-right bigger-110"></i></a> </span> </div>
                </div>
              </div>
            </div>
          </div>
          <!--/操作栏-->
          <div class="space-6 clearfix col-sm-12 floatnone"></div>
          <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
              <li ng-class="{true: 'active'}[toggleIndex == 0]"><a isshow="true">活动模块</a> </li>
            </ul>
            <div class="tab-content col-sm-12 clearfix" style="min-height:510px;">
              <div ng-class="{true: 'tab-pane active clearfix', false: 'tab-pane'}[toggleIndex == 0]" style="display:block;" ng-show="toggleIndex == 0"> 
                <!--活动模块-->
                <ul class="dtw xzs">
                  <li ng-repeat="list in productLists" ng-click="activeClick($index)" ng-class="{true: 'outline_1_red'}[activeIndex == $index]">
                    <h3 ng-bind="list.name"></h3>
                    <span class="text-muted" ng-bind="list.modified*1000 | date: 'yyyy-mm-dd hh:mm:ss'">2014-11-03</span> <img  ng-cloak ng-src="{{list.covers.file_cdn_path}}" width="800" height="355">
                    <p>我就是内容内容我就是内容内容我就是内容内容我就是内容内容我就是内容内容</p>
                  </li>
                </ul>
                <!--/商品模块--> 
              </div>
              <div ng-paginate options="options" page="page"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.col --> 
</div>
<!-- /.main-container-inner --> 

<script>
app.controller('childController', function($scope, $http, $rootScope) {
	$scope.toggleIndex = 0;
	$scope.activeIndex = -1;
	function getActive(int, size) {
		$.post('/product/list-ajax', {
			'_page': int,
			'_page_size': size
		}, function(msg) {
			wsh.successback(msg, '', false, function() {
				$scope.activeLists = msg.errmsg.data;
				$scope.page = msg.errmsg.page;
				$scope.$apply();
			});
		}, 'json');
	}
	$rootScope.activeObj = {};
	$scope.activeClick = function(index) {
		$scope.activeIndex = index;
		$rootScope.activeObj = $scope.activeLists[index];
	};
	getActive(1, 10);
	//右上侧搜索设置
	$scope.searchText = '';
	$scope.searchList = function() {
		$scope.searchText = '';
	};
	$('#insertMaterial').on('shown.bs.modal', function(e){
		if(isgrid) $("#active-grid-pager").update();
	});

  //分页
  $scope.options = {callback: getData};
});
</script> 
