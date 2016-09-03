<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '编辑图片素材';
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
          <li>编辑图片素材</li>
        </ul>
        <!-- .breadcrumb --> 
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="space-10"></div>
            <form novalidate="novalidate" name="myform">
              <div class="page-content">
                <div class="row">
                  <div class="space-10"></div>
                  <div class="col-xs-12 ">

                    <div class="weileft col-sm-push-2 col-sm-3">
                      <div class="weileftda">
                        <ul class="wbsc slim-scroll"  data-height="455">
                          <li>
                            <div class="wcright table-width">
                              <h3 ng-bind="model.title"></h3>
                                 <h3 ng-if="!model.title">标题</h3>
                              <div  class="hr solid hr-6" ></div>
                              <img ng-src="{{model.cdn_path}}" ng-show="model.cdn_path" width="212" height="103" class="no-margin" ng-cloak>
                                <span class="appmsg_thumb default" ng-show="!model.cdn_path">封面图片</span> 
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
                            <input type="text" class="form-control" ng-model="model.title" required="required" name="title"
                                   reg-char-len="30"
                                   prompt-msg="promptMsg" prompt-type="1" ng-trim="false" diff-zh="true">
                            <span class="inline padding5" ng-class="{'red':namemy.title.$error.exceed}" ng-bind="promptMsg"></span>

                          </div>
                        </div>

                        <div class="form-group margin-bottom10 clearfix"> 
                          <label class="control-label">图片<span class="red">*</span> <span class="grey"></label>
                          <div class="frm_input_box with_counter counter_in append count">
                            <div class="position-relative">
                              <a class="btn btn-sm btn-info" ng-bind="model.img_src ? '重新选择' : '选择图片'"></a>
                              <div id="chooseImage"></div> 
                            </div>
                            <span class="inline padding5 red" ng-show="myform.model.img_src && istrue">必填项</span>
                            <div class="upload_preview ">
                              <img ng-show="model.cdn_path" ng-src="{{model.cdn_path}}" class="width101 margin-top5">
                            </div>
                            
                          </div>
                        </div>

                  </div>
                </div>
              </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="space-32"></div>
          <div class="modal-footer margin-auto" id="modal-footer"> <a class="btn btn-primary" ng-click="save()" id="submit">保存</a> </div>
        </div>
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
	$scope.model = JSON.parse('<?= json_encode($model); ?>');
	$scope.save = function(){
		if($scope.myform.$invalid){
			$scope.istrue = true;
			return $timeout(function(){$scope.istrue = false;}, 3000);
		}
		if(!$scope.model.cdn_path) return alert('请选择图片!');
		$('#submit').attr('disabled', 'disabled');
        $http.post("/wxmaterial/image-edit-ajax", $scope.model)
            .success(function(msg){
                $('#submit').removeAttr('disabled');
                wsh.successback(msg, '提交成功', false, function(){window.location.href = 'image-list';});
            })
	};
});
</script>