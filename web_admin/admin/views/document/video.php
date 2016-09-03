<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '文件管理';
?>

<div class="main-container" id="main-container"  ng-controller="mainController"> 
  <script type="text/javascript">
					try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	</script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/shop.php');?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs"> 
        <script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
        <ul class="breadcrumb">
          <li>文件管理</li>
        </ul>
        <!-- .breadcrumb --> 
        <!-- #nav-search --> 
      </div>
      <div class="page-content"> 
        <!-- /.page-header --> 
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12"> 
            <!--操作栏--> 
            
            <!--/操作栏-->
            <div class="space-6 clearfix col-sm-12 floatnone"></div>
            <div class="tabbable">
              <ul class="nav nav-tabs" id="myTab">
                <li style="cursor:pointer;"><a href="/document/image">图片文件</a> </li>
                <li style="cursor:pointer;"><a href="/document/voice">语音文件</a> </li>
                <li class="active" style="cursor:pointer;"><a href="/document/video">视频文件</a> </li>
              </ul>
              <div class="tab-content col-sm-12 clearfix">
                <div class="tab-pane active clearfix"> 
                  <!--单图文-->
                  <div class="form-group clearfix">
                    <div class="clearfix">
                      <ul class="listli left-space1 float-left col-sm-9 across-space1 no-margin-bottom margin-top3">
                        <li> <a data-toggle="modal" data-target="#myModalVideo" class="btn btn-xs btn-primary">上传视频</a> </li>
                      </ul>
                      <div class="input-group float-right col-sm-2 across-space2">
                        <input type="text" class="form-control search-query min-width120" placeholder="请输入图片标签" >
                        <span class="input-group-btn"><a  class="btn btn-xs btn-primary" ><i class="icon-search icon-on-right bigger-110"></i></a></span> </div>
                    </div>
                  </div>
                  <div class="space-4"></div>
                  <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover table-width">
                      <thead>
                        <tr >
                          <th width="6%" class="lt-width3 text-center"> <label>
                              <input type="checkbox" class="ace" ng-model="globalChoose" ng-change="changeChoose(globalChoose)">
                              <span class="lbl"></span> </label></th>
                          <th width="10%">图片名称</th>
                          <th width="10%">图片</th>
                          <th width="10%">图片尺寸px</th>
                          <th width="10%">图片分类</th>
                          <th width="10%">标签</th>
                          <th width="10%">更新时间</th>
                          <th width="10%">操作</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="list in lists">
                          <td class="lt-width3 text-center"><label>
                              <input type="checkbox" class="ace" ng-model="list.ischoose">
                              <span class="lbl"></span> </label></td>
                          <td ng-bind="list.name" class="videoEdit"> 382_m382_m382_m </td>
                          <td ng-cloak><img ng-src="{{list.file_cdn_path}}" width="30" height="30"></td>
                          <td> 650*758 </td>
                          <td>48号产品</td>
                          <td>详细页图片 </td>
                          <td ng-bind="list.time">2014-07-02 19:55:16</td>
                          <td><div class="visible-md visible-lg hidden-sm hidden-xs action-buttons"> <a data-toggle="modal" data-target="#myModal3" class="success" title="编辑" style="margin:0 6px;" ng-click="imageEdit($index)"> <i class="icon-pencil bigger-130"></i></a> <a class="red" title="保存" style="margin:0 6px;" ng-show="list.isclick" ng-click="imageSave($index)"><i class="icon-save bigger-130"></i></a> <a class="red" title="取消" style="margin:0 6px;" ng-show="list.isclick" ng-click="imageCancel($index)"><i class="icon-remove bigger-130"></i></a> <a class="red" title="删除" style="margin:0 6px;"><i class="icon-trash bigger-130"></i></a> </div></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!--/单图文--> 
                  <div ng-show="empty" class="text-center red" ng-cloak>暂时没有可显示的数据</div>
                </div>
                <div ng-paginate options="options" page="page"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.main-container-inner --> 
  </div>
</div>
<!-- /上传图片 --> 
<?php echo $this->render('@app/views/uploadImg/video.php'); ?> 
<script>
var globalClick = false;
app.controller('mainController', function($scope, $timeout, $rootScope){
	$timeout(function(){$rootScope.$broadcast('leftMenuChange', 5);},100);
	$scope.globalChoose = false;
	$scope.changeChoose = function(val){
		$.each($scope.lists, function(i, e){
			e.ischoose = val;
		});
	};
	function getData(int, size){
		$.post('<?= Url::to(['/document/video-ajax']);?>', {'_page': int, '_page_size': size}, function(msg){
			if(msg.errcode == 0){
				if(msg.errmsg.data.length == 0){
					return $scope.empty = true, $scope.$apply();
				}
				$scope.lists = msg.errmsg.data;
				$.each($scope.lists, function(i, e){
					e.ischoose = false;
					e.isclick = false;
				});
				$scope.page = msg.errmsg.page;
				console.log(msg);
				$scope.$apply();
			}
		}, 'json');
	};
	getData(1, 10);
	//右上侧搜索设置
	$scope.searchText = '';
	$scope.searchList = function(){
		$scope.searchText = '';
	};
	//操作中的编辑 取消 保存
	$scope.imageEdit = function(index){
		if(globalClick) return alert('一次只能编辑一张图片');
		globalClick = true;
		$scope.lists[index].isclick = true;
		$('.videoEdit').eq(index).attr('contenteditable', 'true').focus();
	};
	$scope.imageSave = function(index){
		$.post('<?= Url::to(['/document/edit-ajax']);?>', $scope.lists[index], function(msg){
			if(msg.errcode == 0){
				globalClick = false;
				$('.videoEdit').eq(index).attr('contenteditable', 'false').blur();
				$scope.lists[index].isclick = false;
			}
		}, 'json');
	}
	$scope.imageCancel = function(index){
		globalClick = false;
		$scope.lists[index].isclick = false;
		$('.videoEdit').eq(index).attr('contenteditable', 'false').blur();
	}

  //分页
  $scope.options = {callback: getData};
});
</script> 
