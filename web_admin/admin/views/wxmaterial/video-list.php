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
                      <input class="min-width120 float-left" placeholder="搜索消息相关关键字" type="text">
                      <span class="float-left "> <a href="#" class="btn btn-xs btn-primary margin_right1"><i class="icon-search icon-on-right bigger-110"></i></a> </span> </div>
                  </div>
                </div>
              </div>
            </div>
            <!--/操作栏-->
            <div class="space-6 clearfix col-sm-12 floatnone"></div>
            <div class="tabbable">
              <ul class="nav nav-tabs" id="myTab">
                <li style="cursor:pointer;"><a href="/wxmaterial/news-list">图文素材</a> </li>
                <li style="cursor:pointer;"><a href="/wxmaterial/music-list">音乐素材</a> </li>
                <li style="cursor:pointer;"><a href="/wxmaterial/text-list">文本素材</a> </li>
                <li style="cursor:pointer;"><a href="/wxmaterial/image-list">图片素材</a> </li>
                <li style="cursor:pointer;"><a href="/wxmaterial/voice-list">语音素材</a> </li>
                <li class="active" style="cursor:pointer;"><a href="/wxmaterial/video-list">视频素材</a> </li>
              </ul>
              <div class="tab-content col-sm-12 clearfix">
                <div id="home" class="tab-pane active"> 
                  <!--图文素材-->
                  <form class="form-horizontal" ro;e="form">
                    <table width="100%" class="table table-striped table-bordered table-hover table-width">
                      <thead>
                        <tr>
                          <th width="9%">选择</th>
                          <th width="9%">关键词</th>
                          <th width="21%">回答内容</th>
                          <th width="9%">状态</th>
                          <th width="9%">操作</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><label>
                              <input type="checkbox" class="ace">
                              <span class="lbl"></span> </label></td>
                          <td>好 hi </td>
                          <td>你好!你的消息已收到，小灿看到会立即回复的。如果未能及时回复还请原谅哦~</td>
                          <td><label>
                              <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox">
                              <span class="lbl"></span> </label></td>
                          <td><a class="blue" href="/wxmaterial/news-edit " title="编辑"> <i class="icon-pencil bigger-130"></i> </a><a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i> </a></td>
                        </tr>
                        <tr>
                          <td><label>
                              <input type="checkbox" class="ace">
                              <span class="lbl"></span> </label></td>
                          <td>好 hi </td>
                          <td>你好!你的消息已收到，小灿看到会立即回复的。如果未能及时回复还请原谅哦~</td>
                          <td><label>
                              <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox">
                              <span class="lbl"></span> </label></td>
                          <td><a class="blue" href="/wxmaterial/news-edit" title="编辑"> <i class="icon-pencil bigger-130"></i> </a><a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i> </a></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>
                <!--音乐素材-->
                <div id="pro" class="tab-pane">
                  <form class="form-horizontal" ro;e="form">
                    <table width="100%" class="table table-striped table-bordered table-hover table-width">
                      <thead>
                        <tr>
                          <th width="9%">选择</th>
                          <th width="9%">关键词</th>
                          <th width="21%">回答内容</th>
                          <th width="9%">状态</th>
                          <th width="9%">操作</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><label>
                              <input type="checkbox" class="ace">
                              <span class="lbl"></span> </label></td>
                          <td>好 hi </td>
                          <td>你好!你的消息已收到，小灿看到会立即回复的。如果未能及时回复还请原谅哦~</td>
                          <td><label>
                              <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox">
                              <span class="lbl"></span> </label></td>
                          <td><a class="blue" href="/wxmaterial/music-edit" title="编辑"> <i class="icon-pencil bigger-130"></i> </a><a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i> </a></td>
                        </tr>
                        <tr>
                          <td><label>
                              <input type="checkbox" class="ace">
                              <span class="lbl"></span> </label></td>
                          <td>好 hi </td>
                          <td>你好!你的消息已收到，小灿看到会立即回复的。如果未能及时回复还请原谅哦~</td>
                          <td><label>
                              <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox">
                              <span class="lbl"></span> </label></td>
                          <td><a class="blue" href="/wxmaterial/music-edit" title="编辑"> <i class="icon-pencil bigger-130"></i> </a><a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i> </a></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>
                <div id="fa" class="tab-pane"> 
                  <!--文本素材-->
                  <form class="form-horizontal" ro;e="form">
                    <table width="100%" class="table table-striped table-bordered table-hover table-width">
                      <thead>
                        <tr>
                          <th width="9%">选择</th>
                          <th width="9%">关键词</th>
                          <th width="21%">回答内容</th>
                          <th width="9%">状态</th>
                          <th width="9%">操作</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><label>
                              <input type="checkbox" class="ace">
                              <span class="lbl"></span> </label></td>
                          <td>好 hi </td>
                          <td>你好!你的消息已收到，小灿看到会立即回复的。如果未能及时回复还请原谅哦~</td>
                          <td><label>
                              <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox">
                              <span class="lbl"></span> </label></td>
                          <td><a class="blue" href="/wxmaterial/text-edit" title="编辑"> <i class="icon-pencil bigger-130"></i> </a><a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i> </a></td>
                        </tr>
                        <tr>
                          <td><label>
                              <input type="checkbox" class="ace">
                              <span class="lbl"></span> </label></td>
                          <td>好 hi </td>
                          <td>你好!你的消息已收到，小灿看到会立即回复的。如果未能及时回复还请原谅哦~</td>
                          <td><label>
                              <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox">
                              <span class="lbl"></span> </label></td>
                          <td><a class="blue" href="/wxmaterial/text-edit" title="编辑"> <i class="icon-pencil bigger-130"></i> </a><a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i> </a></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                  <!--/文本素材--> 
                </div>
                <div id="wan" class="tab-pane"> 
                  <!--图片素材-->
                  <form class="form-horizontal" ro;e="form">
                    <table width="100%" class="table table-striped table-bordered table-hover table-width">
                      <thead>
                        <tr>
                          <th width="9%">选择</th>
                          <th width="9%">关键词</th>
                          <th width="21%">回答内容</th>
                          <th width="9%">状态</th>
                          <th width="9%">操作</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><label>
                              <input type="checkbox" class="ace">
                              <span class="lbl"></span> </label></td>
                          <td>好 hi </td>
                          <td>你好!你的消息已收到，小灿看到会立即回复的。如果未能及时回复还请原谅哦~</td>
                          <td><label>
                              <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox">
                              <span class="lbl"></span> </label></td>
                          <td><a class="blue" href="/wxmaterial/image-edit" title="编辑"> <i class="icon-pencil bigger-130"></i> </a><a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i> </a></td>
                        </tr>
                        <tr>
                          <td><label>
                              <input type="checkbox" class="ace">
                              <span class="lbl"></span> </label></td>
                          <td>好 hi </td>
                          <td>你好!你的消息已收到，小灿看到会立即回复的。如果未能及时回复还请原谅哦~</td>
                          <td><label>
                              <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox">
                              <span class="lbl"></span> </label></td>
                          <td><a class="blue" href="/wxmaterial/image-edit" title="编辑"> <i class="icon-pencil bigger-130"></i> </a><a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i> </a></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                  <!--/图片素材--> 
                </div>
                <div id="kuan" class="tab-pane"> 
                  <!--语音素材-->
                  <form class="form-horizontal" ro;e="form">
                    <table width="100%" class="table table-striped table-bordered table-hover table-width">
                      <thead>
                        <tr>
                          <th width="9%">选择</th>
                          <th width="9%">关键词</th>
                          <th width="21%">回答内容</th>
                          <th width="9%">状态</th>
                          <th width="9%">操作</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><label>
                              <input type="checkbox" class="ace">
                              <span class="lbl"></span> </label></td>
                          <td>好 hi </td>
                          <td>你好!你的消息已收到，小灿看到会立即回复的。如果未能及时回复还请原谅哦~</td>
                          <td><label>
                              <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox">
                              <span class="lbl"></span> </label></td>
                          <td><a class="blue" href="/wxmaterial/voice-edit" title="编辑"> <i class="icon-pencil bigger-130"></i> </a><a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i> </a></td>
                        </tr>
                        <tr>
                          <td><label>
                              <input type="checkbox" class="ace">
                              <span class="lbl"></span> </label></td>
                          <td>好 hi </td>
                          <td>你好!你的消息已收到，小灿看到会立即回复的。如果未能及时回复还请原谅哦~</td>
                          <td><label>
                              <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox">
                              <span class="lbl"></span> </label></td>
                          <td><a class="blue" href="/wxmaterial/voice-edit" title="编辑"> <i class="icon-pencil bigger-130"></i> </a><a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i> </a></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                  <!--/语音素材--> 
                </div>
                <div id="tui" class="tab-pane"> 
                  <!--视频素材-->
                  <form class="form-horizontal" ro;e="form">
                    <table width="100%" class="table table-striped table-bordered table-hover table-width">
                      <thead>
                        <tr>
                          <th width="9%">选择</th>
                          <th width="9%">关键词</th>
                          <th width="21%">回答内容</th>
                          <th width="9%">状态</th>
                          <th width="9%">操作</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><label>
                              <input type="checkbox" class="ace">
                              <span class="lbl"></span> </label></td>
                          <td>好 hi </td>
                          <td>你好!你的消息已收到，小灿看到会立即回复的。如果未能及时回复还请原谅哦~</td>
                          <td><label>
                              <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox">
                              <span class="lbl"></span> </label></td>
                          <td><a class="blue" href="/wxmaterial/video-edit" title="编辑"> <i class="icon-pencil bigger-130"></i> </a><a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i> </a></td>
                        </tr>
                        <tr>
                          <td><label>
                              <input type="checkbox" class="ace">
                              <span class="lbl"></span> </label></td>
                          <td>好 hi </td>
                          <td>你好!你的消息已收到，小灿看到会立即回复的。如果未能及时回复还请原谅哦~</td>
                          <td><label>
                              <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox">
                              <span class="lbl"></span> </label></td>
                          <td><a class="blue" href="/wxmaterial/video-edit" title="编辑"> <i class="icon-pencil bigger-130"></i> </a><a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i> </a></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                  <!--/视频素材--> 
                </div>
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
app.controller('mainController', function($scope, $timeout,$http, $rootScope){
     $timeout(function(){
         $rootScope.$broadcast('leftMenuChange','bb');
     },100);
	//获取视频素材
	function getVideo(int){
		$.get('/wx-material-video/list?_page=' + int + '&_page_size=' + 20)
		.success(function(data){
			$scope.videoList = data.data;
			$scope.videoList.forEach(function(e, i){
				e.modified = getDate(e.modified);
			});
			$scope.page = data.page;
			$scope.$apply();
		});
	}
	$scope.deleteImage = function(index){
		setDialog('确定删除此素材', '/wx-material-video/del?id=' + $scope.videoList[index].id, getVideo);
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
  $scope.options = {callback: getVideo};

	function getDate(tm){
		var tt=new Date(parseInt(tm) * 1000).toLocaleString();
		return tt;
	}
});
</script> 
