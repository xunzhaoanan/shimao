<link href="/ace/uploadify/uploadify.css" rel="stylesheet" />
<div class="bootbox modal fade in"  id="myModalVideo" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="videoController">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
      <div class="modal-header modal-header2"> <a  class="bootbox-close-button close" data-dismiss="modal">×</a>
        <h4 class="modal-title">上传视频</h4>
      </div>
      <div class="modal-body">
        <div class="bootbox-body">
          <div class="tab-pane in active row">
            <div class="tabbable">
              <ul class="nav nav-tabs" id="myTab">
                <li ng-class="{true: 'active'}[videoIndex == 0]" ng-click="videoClick(0)"> <a>上传本地视频</a> </li>
                <!--<li ng-class="{true: 'active'}[videoIndex == 1]" ng-click="videoClick(1)"><a>添加网络视频</a> </li>-->
                <li ng-class="{true: 'active'}[videoIndex == 2]" ng-click="videoClick(2)" ng-show="!isVideoManage"><a>从视频库选择</a> </li>
              </ul>
            </div>
          </div>
          <div class="tab-content  row">
            <div id="bdimg" class="tab-pane active row" ng-show="videoIndex == 0" style="min-height: 200px;">
              <form name="myform" novalidate="novalidate">
                <div class="form-group clearfix">
                  <div class="col-sm-12">
                    <p class="width121 float-left text-center margin-left10 clearfix" >选择本地视频</p>
                    <a class="btn btn-sm btn-info">选择视频</a>
                    <div id="chooseVide"></div>
                  </div>
                </div>
                <ul class="col-sm-10 clearfix" style="margin-left:20px;" id="listUl">
                  <li ng-repeat="list in videoLists" ng-class="{true: 'outline_1_red float-left margin-right10', false: 'float-left margin-right10'}[$index == videoListIndex]">
                  <div style="width:81px; height:48px; background:#86b558;" ng-click="clickVideo($index, $event)">
                  	<div class="dtw_tu"></div>
                  </div> </li>
                </ul>
                <audio style="display:none;" autoplay="autoplay" id="audio"></audio>
                <!--<div class="form-group no-margin-left no-margin-right margin-bottom10 clearfix">
                  <label class="width150 float-left text-center margin-left5 clearfix" for="form-field-1">常用标签，可选择使用</label>
                  <div class="col-sm-8 across-space1"> <a  class="btn btn-sm btn-info" >牧野</a> <a  class="btn btn-sm btn-info" >后来者</a> </div>
                </div>-->
               <!-- <div class="form-group no-margin-left no-margin-right margin-bottom10 clearfix">
                  <label class="width81 float-left text-center margin-left5 clearfix" for="form-field-1">标签名称</label>
                  <div class="col-sm-7 no-padding">
                    <input type="text" class="col-xs-10 col-sm-6" name="name" ng-model="name" required="required">
                    <span class="red" ng-show="myform.name.$error.required"></span> </div>
                </div>-->
              </form>
            </div>
            <div id="wlimg" class="tab-pane">
              <form name="wlform" id="select_ajax_form">
                <div class="form-group margin-bottom5 clearfix">
                  <div class="col-sm-12">
                    <label class="form-group no-margin-left no-margin-right clearfix" for="form-field-1">网络视频地址</label>
                  </div>
                </div>
                <div class="form-group margin-bottom10 clearfix">
                  <div class="col-sm-12">
                    <input type="text" class="col-xs-11"  value="" placeholder="http://">
                  </div>
                </div>
                <div class="form-group no-margin-left no-margin-right margin-bottom10 clearfix">
                  <label class="width150 float-left text-left margin-left10 clearfix" for="form-field-1">常用标签，可选择使用</label>
                  <div class="col-sm-8 across-space1" style="margin-left:-20px;"> <a  class="btn btn-sm btn-info" >牧野</a> <a  class="btn btn-sm btn-info" >后来者</a> </div>
                </div>
                <div class="form-group no-margin-left no-margin-right margin-bottom10 clearfix">
                  <label class="width71 float-left text-left margin-left10 clearfix" for="form-field-1">标签名称</label>
                  <div class="col-sm-7 no-padding" style="margin-left:-10px;">
                    <input type="text" class="col-sm-6" name="wlname" ng-model="wlname" required="required">
                    <span class="red"></span> </div>
                </div>
              </form>
            </div>
            <div class="tab-pane" ng-show="videoIndex == 2" id="pics" style="display:block;">
              <form name="allform" id="select_ajax_form">
                <div class="form-group margin-bottom10 clearfix">
                  <label class="col-sm-1 text-left no-padding-right login-text2 margin-right10" for="form-field-1">标签</label>
                  <input name="tags" id="dataEPictureTags" type="text" class="col-xs-10 col-sm-4" style="margin-left:-20px" value="" >
                  <button class="btn btn-sm btn-info" type="button" ng-click="searchForm();">搜索</button>
                </div>
                <div class="form-group margin-bottom10 clearfix">
                  <label class="col-sm-2 text-left" for="form-field-1">按标签查找</label>
                  <div class="col-sm-10" style="margin-left:-40px;"> <a onclick="" class="btn btn-sm btn-info">微杂志</a> </div>
                </div>
                <div class="space-10"></div>
                <div class="form-group border-bottom clearfix no-margin"></div>
                <div class="space-10"></div>
                <div class="form-group margin-bottom10 clearfix">
                  <div class="col-sm-12 img-storeroom-list">
                    <ul class="col-sm-12 margin-left5 ul_pic">
                      <li class="pic_list"> <a class="bbb" href="javascript:;"> <img src="http://imgcache.vikduo.com/static/3a245381466ac6d18f0e3984f0a00972.jpg" ><br>
                        <label>
                          <input type="checkbox" style="display:none;" class="ace" value="">
                          <span class="lbl"  style="display:none;" ></span> <i class="on" style="display:none"></i> </label>
                        </a> </li>
                      <li class="pic_list"> <a class="bbb" href="javascript:;"> <img src="http://imgcache.vikduo.com/static/3a245381466ac6d18f0e3984f0a00972.jpg" ><br>
                        <label>
                          <input type="checkbox" style="display:none;" class="ace" value="">
                          <span class="lbl"  style="display:none;" ></span> <i class="on" style="display:none"></i> </label>
                        </a> </li>
                      <li class="pic_list"> <a class="bbb" href="javascript:;"> <img src="http://imgcache.vikduo.com/static/3a245381466ac6d18f0e3984f0a00972.jpg" ><br>
                        <label>
                          <input type="checkbox" style="display:none;" class="ace" value="">
                          <span class="lbl"  style="display:none;" ></span> <i class="on" style="display:none"></i> </label>
                        </a> </li>
                      <li class="pic_list"> <a class="bbb" href="javascript:;"> <img src="http://imgcache.vikduo.com/static/3a245381466ac6d18f0e3984f0a00972.jpg" ><br>
                        <label>
                          <input type="checkbox" style="display:none;" class="ace" value="">
                          <span class="lbl"  style="display:none;" ></span> <i class="on" style="display:none"></i> </label>
                        </a> </li>
                      <li class="pic_list"> <a class="bbb" href="javascript:;"> <img src="http://imgcache.vikduo.com/static/3a245381466ac6d18f0e3984f0a00972.jpg" ><br>
                        <label>
                          <input type="checkbox" style="display:none;" class="ace" value="">
                          <span class="lbl"  style="display:none;" ></span> <i class="on" style="display:none"></i> </label>
                        </a> </li>
                      <li class="pic_list"> <a class="bbb" href="javascript:;"> <img src="http://imgcache.vikduo.com/static/5bb39e038145ef2e03d717e135a8add7.jpg" ><br>
                        <label>
                          <input type="checkbox" style="display:none;" class="ace" value="">
                          <span class="lbl"  style="display:none;" ></span> <i class="on" style="display:none"></i> </label>
                        </a> </li>
                    </ul>
                  </div>
                </div>
                <div class="form-group margin-bottom10 clearfix">
                  <table align="center">
                    <tbody>
                      <tr>
                        <td><div></div></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer"> <a class="btn btn-default" data-dismiss="modal">取消</a> <a ng-click="save()" data-bb-handler="confirm" class="btn btn-primary">确定</a> </div>
    </div>
  </div>
</div>
<script src="/ace/uploadify/jquery.uploadify.min.js"></script>
<script src="/ace/uploadify/jquery.uploadify.min.js"></script>
<script>
var isfirstClick = false;
app.controller('videoController', function($scope, $rootScope){
	//通过url判断是否需要显示音乐管理器
	$scope.isVideoManage = (/document\/video/).test(window.location.href);
	//全局  头部点击切换
	$scope.videoClick = function(index){
		$scope.videoIndex = index;
		if(index == 2 && !isfirstClick){
			isfirstClick = true;
//			getData(1, 10);
		}
	};
	$scope.clickVideo = function(index){

	};
//	if(!$scope.isVideoManage){
//		$scope.videoClick(2);
//	}else{
//		$scope.videoClick(0);
//	}
	$('#chooseVide').uploadify({
		'fileTypeDesc': '不超过30MB的图片 (*.gif;*.jpg;*.png)',
		'fileTypeExts': '*.wmv;*.mp4',
		'fileSizeLimit': '30MB',
		'swf': '/ace/uploadify/uploadify.swf',
		'uploader': '/document/upload-ajax',
		'buttonClass': 'btn btn-sm btn-info',
		'buttonText': '上传图片',
		'width': 74,
		'height': 23,
		'opacity': 0,
		'margin-left': '30px',
		'background': '#428bca',
		'-webkit-border-radius': 0,
		'border-radius': 0,
		'border': 0,
		'multi': true,
		'removeTimeout': 0.1,
        'onFallback':function(){
            alert("您未安装FLASH控件，无法上传图片！请安装FLASH控件后再试。");
        },
		'onUploadStart': function(file){
			console.log(file);
		},
		'onUploadSuccess': function(file, data, response) {
			console.log(file);
			console.log(data);
			console.log(response);

		}
	});
	$('#chooseVide').css({ 'position':'absolute','top':'0','left':'100px','width':'74','height': '23','opacity': '0'});
//	$('#SWFUpload_0').css('margin-left', '30px');
});
</script>