<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '素材管理';
?>

<div class="main-container" id="main-container" ng-controller="mainController"> 
  <script type="text/javascript">
					try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	</script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/weixin_setting.php');?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs"> 
        <script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
        <ul class="breadcrumb">
          <li>素材管理</li>
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
            <div class="clearfix no-padding">
              <div class="col-sm-7 no-padding">
                <ul class="listli left-space1 btn-primary bune float-left">
                  <li><a href="javascript:;" class="btn btn-xs btn-primary tian">添加素材</a></li>
                </ul>
                <ul class="jiasucai">
                  <li><a href="<?= Url::to(['wxmaterial/news-add']);?>" target="_blank" >图文素材&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>
                  <li><a href="<?= Url::to(['wxmaterial/text-add']);?>" target="_blank">文本素材&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>
                  <li ><a href="<?= Url::to(['wxmaterial/image-add']);?>" target="_blank">图片素材&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>
                  <li><a href="<?= Url::to(['wxmaterial/voice-add']);?>" target="_blank">语音素材&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>
                  <li><a href="<?= Url::to(['wxmaterial/music-add']);?>" target="_blank">音乐素材&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>
                  <li><a href="<?= Url::to(['wxmaterial/video-add']);?>" target="_blank">视频素材&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>
                </ul>
                <script type="text/javascript">
					$(document).ready(function(){
					    $(".tian").click(function(){
					  	   $(".jiasucai").toggle();
					    });
					});
              </script> 
              </div>
              <div class="col-sm-5 no-padding">
                <div class="col-sm-12 float-right no-padding">
                  <div class="float-right">
                    <div class="input-group float-left">
                      <input class="min-width120 float-left" placeholder="搜索消息相关关键字" type="text" ng-model="searchText">
                      <span class="float-left "> <a ng-click="searchList()" class="btn btn-xs btn-primary margin_right1"><i class="icon-search icon-on-right bigger-110"></i></a> </span> </div>
                  </div>
                </div>
              </div>
            </div>
            <!--/操作栏-->
            <div class="space-6 clearfix col-sm-12 floatnone"></div>
            <div class="tabbable">
              <ul class="nav nav-tabs" id="myTab">
                <li style="cursor:pointer;"><a href="/wxmaterial/news-list">图文素材</a> </li>
                <li class="active" style="cursor:pointer;"><a href="/wxmaterial/music-list">音乐素材</a> </li>
                <li style="cursor:pointer;"><a href="/wxmaterial/text-list">文本素材</a> </li>
                <li style="cursor:pointer;"><a href="/wxmaterial/image-list">图片素材</a> </li>
                <li style="cursor:pointer;"><a href="/wxmaterial/voice-list">语音素材</a> </li>
                <li style="cursor:pointer;"><a href="/wxmaterial/video-list">视频素材</a> </li>
              </ul>
              <div class="tab-content col-sm-12 clearfix">
                <div class="tab-pane active"> 
                  <!--多图文-->
                  <ul class="dtw clearfix">
                    <!-- These are our grid blocks -->
                    <li ng-repeat="list in musicList">
                      <div class="dtwcont">
                        <div class="dtw_tu"></div>
                        <span>4"</span> </div>
                      <p class="dtwtitle" ng-bind="list.description"><span class="float-right light-grey">15K</span></p>
                      <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons weicb weicbx"> <a class="blue" href="{{'/wxmaterial/music-edit?id=' + list.id}}" title="编辑"> <i class="icon-pencil bigger-130"></i> </a> <a class="green" title="下载"> <i class="icon-download-alt bigger-130"></i> </a> <a class="red" ng-click="deleteMusic($index)" title="删除"> <i class="icon-trash bigger-130"></i> </a> </div>
                    </li>
                  </ul>
                  <!--/多图文--> 
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
<script>
app.controller('mainController', function($scope, $http, $rootScope){
	
	getMusic(1);
	//获取音乐素材
	function getMusic(int){
		$.post('<?= Url::to(['/wxmaterial/music-list-ajax']);?>', {'_page': int, '_page_size': 10}, function(msg){
			$scope.musicList = msg.errmsg.data;
			$scope.page = msg.errmsg.page;
			console.log(msg);
			$scope.$apply();
		}, 'json');
	}
	$scope.deleteMusic = function(index){
		dialog({
			zIndex: 9999998,
			title: "删除提示",
			content: '确定删除此音乐素材',
			okValue: "删除",
			ok: function() {
				$.post('/wxmaterial/music-del-ajax', {id: $scope.musicList[index].id}, function(msg){
					if(msg.errcode == 0){
						getMusic(1, 10);
					}
				}, 'json');
			},
			otherBtnValue: "取消",
			otherBtn: function() {
			}
		}).width(320).showModal()
	};
	//弹层封装
	function setDialog(content, url, callback){
		dialog({
			zIndex: 9999998,
			title: "删除提示",
			content: content,
			okValue: "删除",
			ok: function() {
				$.get(url)
				.done(function(data){
					if(data.errcode == 0 && typeof callback == 'function'){
						callback.call(this, 1, 10);
					}
				});
			},
			otherBtnValue: "取消",
			otherBtn: function() {
			}
		}).width(320).showModal()
	}
	//右上侧搜索设置
	$scope.searchText = '';
	$scope.searchList = function(){
		$scope.searchText = '';
	};
  //分页
  $scope.options = {callback: getMusic};
	function getDate(tm){
		var tt=new Date(parseInt(tm) * 1000).toLocaleString();
		return tt;
	}
});
</script> 
