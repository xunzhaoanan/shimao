<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '文件管理';
?>
<style>
.dtw_tu {
	background: url(/ace/images/deful.png) no-repeat 2px;
	height: 100%;
}
.dtwplay {
	background: url(/ace/images/play.gif) no-repeat 2px;
}
</style>
<div class="main-container" id="main-container"  ng-controller="mainController" ng-cloak> 
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
            <div class="space-6"></div>
            <div class="tabbable">
              <ul class="nav nav-tabs">
                <li style="cursor:pointer;"><a href="/document/image">图片文件</a> </li>
                <li class="active" style="cursor:pointer;"><a href="/document/voice">语音文件</a> </li>
                <li style="cursor:pointer; display: none"><a href="/document/video">视频文件</a> </li>
              </ul>
              <div class="tab-content col-sm-12 clearfix">
                <div class="tab-pane active"> 
                  <!--单图文-->
                  <div class="form-group clearfix">
                    <a data-toggle="modal" data-target="#myModalMusic" class="btn btn-xs btn-primary">上传语音</a>
                  </div>
                  <div class="space-4"></div>
                  <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover table-width">
                      <thead>
                        <tr>
                          <th width="10%">语音名称</th>
                          <th width="10%">语音</th>
                          <!--<th width="10%">语音分类</th>-->
                          <th width="10%">更新时间</th>
                          <th width="10%">操作</th>
                        </tr>
                      </thead>
                      <tbody id="tbody">
                        <tr ng-repeat="list in lists">
                          <td ng-bind="list.name" class="voiceEdit" ng-class="{'outline_1_red': list.isclick}"></td>
                          <td ng-cloak>
                          	<div class="voice_item" ng-click="clickMusic($index)">
                              <div class="dtw_tu" style="background-size:50%"></div>
                            </div>
                          </td>
                          <!--<td>48号产品</td>-->
                          <td ng-bind="list.modified * 1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                          <td><div class="visible-md visible-lg hidden-sm hidden-xs action-buttons"> <a class="success" title="编辑" style="margin:0 6px;" ng-show="!list.isclick" ng-click="imageEdit($index, list)"> <i class="icon-pencil bigger-130"></i></a> <a class="red" title="保存" style="margin:0 6px;" ng-show="list.isclick" ng-click="imageSave($index, list)"><i class="icon-save bigger-130"></i></a> <a class="red" title="取消" style="margin:0 6px;" ng-show="list.isclick" ng-click="imageCancel($index, list)"><i class="icon-remove bigger-130"></i></a> </div></td>
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
<?php echo $this->render('@app/views/uploadImg/voice.php'); ?> 
<script>
var globalClick = false;
app.controller('mainController', function($scope, $timeout, $rootScope){
	$timeout(function(){$rootScope.$broadcast('leftMenuChange', 4);},100);
	$scope.globalChoose = false;
	$scope.changeChoose = function(val){
		$.each($scope.lists, function(i, e){
			e.ischoose = val;
		});
	};
	function getData(int){
		$.post('<?= Url::to(['/document/voice-ajax']);?>', {'_page': int, '_page_size': 10}, function(msg){
			console.log(msg);
			if(msg.errcode == 0){
				if(!$.isArray(msg.errmsg.data)){
					return $scope.empty = true, $scope.$apply();
				}
				$scope.lists = msg.errmsg.data;
				$scope.page = msg.errmsg.page;
				console.log($scope.lists);
				$scope.$apply();
			}
		}, 'json');
	};
	getData(1);
	//接收上传音乐事件
	$scope.$on('MusicListChange', function(e, json){
		if(!json.length) return;
		getData(1);
	});
	$scope.clickMusic = function(index){
		if(!$('#audio').get(0).paused){
			$('#audio').get(0).pause();
			$('#tbody').find('.dtw_tu').removeClass("dtwplay");
			return;
		}
		$('#audio').attr('src', $scope.lists[index].file_cdn_path);
		$('#audio').get(0).play();
		setMusic(index);
	};
	function setMusic(index){
		$('#audio').get(0).oncanplay = function(){
			$('#tbody').find('.dtw_tu').eq(index).addClass("dtwplay");
		}
		$('#audio').get(0).onended = function(){
			$('#tbody').find('.dtw_tu').eq(index).removeClass("dtwplay"); 
		}
	}
	//右上侧搜索设置
	$scope.searchText = '';
	$scope.searchList = function(){
		$scope.searchText = '';
	};
	//操作中的编辑 取消 保存
	$scope.imageEdit = function(index, obj){
		console.log("index", index, $scope.lists);
		if(globalClick) return alert('一次只能编辑一条数据');
		globalClick = true;
		$scope.lists[index].isclick = true;
		$('.voiceEdit').eq(index).attr('contenteditable', 'true').focus();
	};
	$scope.imageSave = function(index, obj){
		var name = $('.voiceEdit').eq(index).text();
		if(!name) return alert('名称不可为空');
		$.post('<?= Url::to(['/document/edit-ajax']);?>', {id: obj.id, name: name,file_type:2}, function(msg){
			wsh.successback(msg, '修改成功', false, function(){
				globalClick = false;
				$('.voiceEdit').eq(index).attr('contenteditable', 'false').blur();
				$scope.lists[index].isclick = false;
				$scope.$apply();
			});
		}, 'json');
	}
	$scope.imageCancel = function(index, obj){
		globalClick = false;
		$scope.lists[index].isclick = false;
		$('.voiceEdit').eq(index).text($scope.lists[index].name)
		$('.voiceEdit').eq(index).attr('contenteditable', 'false').blur();
	}

  //分页
  $scope.options = {callback: getData};
	function getDate(tm){
		var tt=new Date(parseInt(tm) * 1000).toLocaleString();
		return tt;
	}
});
</script> 
