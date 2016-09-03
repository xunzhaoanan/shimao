<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '新增文本素材';
?>

<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak> 
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
          <li>新增文本素材</li>
        </ul>
        <!-- .breadcrumb --> 
        <!-- #nav-search --> 
      </div>
      <div class="page-content"> 
        <!-- /.page-header --> 
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <div class="space-10"></div>

            <div class="weileft col-sm-push-2 col-sm-3">
              <div class="weileftda">
                <ul class="wbsc slim-scroll"  data-height="455">
                  <li>
                    <div class="wcright table-width" >
                      <h3 ng-bind="model.title"></h3>
                       <h3 ng-if="!model.title">标题</h3>
                      <div  class="hr solid hr-6" ></div>
                      <p ng-bind="model.reply_content"></p>
                        <p ng-show="!model.reply_content">消息内容</p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>

            <div class="media_edit_area col-sm-push-2 col-sm-6">
              <div class="js_appmsg_editor clearfix">
                <form novalidate="novalidate" name="myform">
                  <div class="appmsg_editor active">
                      <div class="inner"> 

                          <div class="form-group margin-bottom10 clearfix">
                            <label class="control-label">消息标题<span class="red">*</span></label>
                              <div class="frm_input_box with_counter counter_in append count">
                                <input type="text" class="form-control" style="padding-right:60px;" maxlength="30"  placeholder="请输入标题" required="required" name="title" ng-model="model.title">
                           <!--      <em class="frm_input_append frm_counter">0/30</em> -->
                               <span class="block red" ng-show="myform.title.$error.required && istrue">必填项</span>
                                <span class="block  grey">标题文字长度不超过30个字，默认只显示两排</span>
                                <!-- <span class="block grey">标题文字长度不超过30个字</span> -->
                              </div>
                          </div>

                          <div class="form-group margin-bottom10 clearfix">
                            <label class="control-label">消息内容<span class="red">*</span></label>
                            <div class="frm_textarea_box with_counter counter_out counter_in append count com_form">
                              <div class="face-box"> 
                                <span class="block text-hint text-right">
                                  {{'还可以输入' + (model.reply_content.length ? (300 - model.reply_content.length) : 300) + '字'}}
                                </span>
                              </div>
                               <textarea class="input form-control" resize style="height:160px;resize:none;" id="saytext" name="reply_content" ng-model="model.reply_content" required="required" maxlength="300" ></textarea>
                               <span class="block red" ng-show="myform.reply_content.$error.required && istrue">必填项</span>
                            </div>
                          </div> 
                    </div>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>

        <div class="space-32"></div>
        <div class="modal-footer margin-auto" id="modal-footer"> <a ng-click="save()" class="btn btn-primary" id="submit">保存</a> </div>
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.main-container-inner --> 
  </div>
</div>
<script>
app.controller('mainController', function($scope, $http, $rootScope, $timeout){
    $timeout(function(){
        $rootScope.$broadcast('leftMenuChange', 'ba');
    }, 100);
	$scope.istrue = false;
	$scope.model = {};
	//确定
	$scope.save = function(){
		if($scope.myform.$invalid){
			$scope.istrue = true;
			return $timeout(function(){$scope.istrue = false;}, 3000);
		}
		$('#submit').attr('disabled', 'disabled');
        $http.post("/wxmaterial/text-add-ajax", $scope.model)
            .success(function(msg){
                $('#submit').removeAttr('disabled');
                wsh.successback(msg, '提交成功', false, function(){
                    window.location.href = 'text-list';
                });
            })
	};
});
</script> 