<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '新增图片素材';
?>

<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak> 
  <script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/weixin_setting.php');?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs"> 
        <script type="text/javascript">try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}</script>
        <ul class="breadcrumb">
          <li>新增图片素材</li>
        </ul>
        <!-- .breadcrumb --> 
      </div>
      <div class="page-content"> 
        <!-- /.page-header --> 
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <div class="space-10"></div>

            <form  novalidate="novalidate" name="myform">

              <div class="weileft col-sm-push-2 col-sm-3">
                <div class="weileftda">
                  <ul class="wbsc slim-scroll"  data-height="455">
                    <li>
                      <div class="wcright table-width">
                        <h3 ng-bind="model.title"></h3>
                        <h3  ng-if="!model.title">标题</h3>
                        <div  class="hr solid hr-6" ></div>
                        <img ng-src="{{model.cdn_path}}" ng-show="model.cdn_path" height="135" class="no-margin">
                        <img ng-src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPEAAACHCAIAAABI0iiCAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDY3IDc5LjE1Nzc0NywgMjAxNS8wMy8zMC0yMzo0MDo0MiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjk4REEzRUUxMjdERDExRTY5NUI2Qzg1QUJGOTJEOEMwIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjk4REEzRUUyMjdERDExRTY5NUI2Qzg1QUJGOTJEOEMwIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6OThEQTNFREYyN0REMTFFNjk1QjZDODVBQkY5MkQ4QzAiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6OThEQTNFRTAyN0REMTFFNjk1QjZDODVBQkY5MkQ4QzAiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6RmwzXAAAPl0lEQVR42uyd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"  ng-show="!model.cdn_path" height="135" placeholder="建议尺寸像素，200*200，不超过2M，格式:  png, jpg，jpeg, gif">
                        <!--<span class="block grey verg_mid">建议尺寸像素，200*200，不超过2M，格式:  png, jpg，jpeg, gif</span>-->
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              
              <div class="media_edit_area col-sm-push-2 col-sm-6">

                <div class="appmsg_editor active">
                  <div class="inner"> 

                    <div class="form-group margin-bottom10 clearfix">
                        <label class="control-label">标题<span class="red">*</span></label>
                        <div class="frm_input_box with_counter counter_in append count">
                          <input ng-maxlength="30" type="text" class="form-control" placeholder="请输入标题" ng-model="model.title"  name="title" reg-char-len="30" prompt-msg="promptMsg" prompt-type="1" ng-trim="false" diff-zh="true" required>
                        <!--   <em class="frm_input_append frm_counter">0/30</em> -->
                          <span class="block red" ng-show="myform.title.$error.maxlength">字符过多</span> 
                          <span class="block red" ng-show="myform.title.$error.required && istrue">必填项</span>
                          <span class="inline padding5" ng-class="{'red':namemy.title.$error.exceed}" ng-bind="promptMsg"></span>
                          <span>,默认只显示两排</span>
                        </div>
                    </div>  

                    <div class="form-group margin-bottom10 clearfix"> 
                      <label class="control-label">图片<span class="red">*</span></label>
                      <div class="frm_input_box with_counter counter_in append count">
                        <div class="position-relative">
                        <a class="btn btn-sm btn-info" ng-bind="model.img_src ? '重新选择' : '选择图片'"></a> 
                        <div id="chooseImage"></div>
                        </div>
                        <!--<span class="block grey verg_mid">建议尺寸像素，200*200，不超过2M，格式:  png, jpg，jpeg, gif</span>-->
                        <div class="upload_preview ">
                          <img ng-show="model.cdn_path" ng-src="{{model.cdn_path}}" class="width101">
                        </div>
                        <span class="block red" ng-show="myform.model.img_src && istrue">必填项</span>
                      </div> 
                    </div> 
                    
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="space-32"></div>
        <div class="modal-footer margin-auto" id="modal-footer"> <a class="btn btn-primary" ng-click="save()" id="submit">保存并关闭 </a> </div>
      </div>
    </div>
  </div>
</div>
<link href="/ace/uploadify/uploadify.css" rel="stylesheet" />
<script src="/ace/uploadify/jquery.uploadify.min.js"></script> 
<script>
app.controller('mainController', function($scope, $http, $rootScope, $timeout, $parse){
  $timeout(function(){
    $rootScope.$broadcast('leftMenuChange','ba');
  },100);
	$('#chooseImage').uploadify({
		'fileTypeDesc': '不超过300kb的图片 (*.gif;*.jpg;*.png)',
		'fileTypeExts': '*.gif;*.jpg;*.jpeg;*.png',
		'fileSizeLimit': '2MB',
		'swf': '/ace/uploadify/uploadify.swf',
		'uploader': '/wxmaterial/upload-ajax',
		'buttonClass': 'btn btn-sm btn-info',
		'buttonText': '上传图片',
		'width': 74,
		'height': 23,
		'opacity': 0,
		'background': '#428bca',
		'-webkit-border-radius': 0,
		'border-radius': 0,
		'border': 0,
		'multi': false,
		'removeTimeout': 0.1,
		'queueID': 'some_file_queue',
        'onFallback':function(){
            alert("您未安装FLASH控件，无法上传图片！请安装FLASH控件后再试。");
        },
		'onUploadStart': function(file){
			wsh.quickDialog('上传中...,请稍候!!')
		},
		'onUploadSuccess': function(file, data, response) {
			try{
				//data = JSON.parse(data);
				data = $parse(data)($scope);
			}catch(e){
				console.log(e.name);
			};
			wsh.successback(data, '上传成功', false, function(){
				$scope.model.cdn_path = data.errmsg.cdn_path;
				$scope.model.media_id = data.errmsg.media_id;
                $scope.model.wx_url = data.errmsg.wx_url;
				$scope.$apply();
			});
		}
	});
	$('#chooseImage').css({'margin-top': '-23px', 'opacity': '0','margin-bottom':'0'});

	$scope.data = $scope.model = {};
	$scope.save = function(){
		if($scope.myform.$invalid){
			$scope.istrue = true;
			return $timeout(function(){$scope.istrue = false;}, 3000);
		}
		if(!$scope.model.cdn_path) return alert('请选择图片!');
		$('#submit').attr('disabled', 'disabled');
        $http.post("/wxmaterial/image-add-ajax", $scope.model)
            .success(function(msg){
                $('#submit').removeAttr('disabled');
                wsh.successback(msg, '提交成功', false, function(){window.location.href = 'image-list';});
            })
	};
});
</script>