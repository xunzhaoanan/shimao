<link href="/ace/uploadify/uploadify.css" rel="stylesheet" />
<div class="bootbox modal fade in" id="myModalWxImage" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="imageController">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
      <div class="modal-header modal-header2"> <a class="bootbox-close-button close" data-dismiss="modal">×</a>
        <h4 class="modal-title">图片管理器</h4>
      </div>
      <div class="modal-body">
        <div class="bootbox-body">
          <div class="tab-pane in active row">
            <div class="tabbable">
              <ul class="nav nav-tabs" id="myTab">
                <li class="active"> <a>上传本地图片</a> </li>
              </ul>
            </div>
          </div>
          <div class="tab-content row">
            <div id="bdimg" class="tab-pane active row" style="min-height: 200px; display:block;">
              <form class="form-horizontal" name="myform" novalidate="novalidate">
                <div class="form-group clearfix">
                  <div class="col-sm-12">
                    <div class="form-group no-margin-left no-margin-right clearfix">
                      <p class="width121 float-left text-center margin-left20 clearfix" >可选择多张图片批量上传</p>
                      <a class="btn btn-sm btn-info" style="margin-left:-65px;">选择图片</a>
                      <div id="chooseImage" class="float-left"></div>
                    </div>
                  </div>
                  <ul class="col-sm-10 clearfix" style="margin-left:20px;">
                    <li ng-repeat="list in imgLists" ng-class="{true: 'outline_1_red float-left margin-right10', false: 'float-left margin-right10'}[$index == imgListIndex]"> <img ng-src="{{list.cdn_path}}" width="60" ng-click="clickImg($index)" /> </li>
                  </ul>
                </div>
                <div class="form-group no-margin-left no-margin-right margin-bottom10 clearfix">
                  <label class="width150 float-left text-center margin-left5 clearfix" for="form-field-1">常用标签，可选择使用</label>
                  <div class="col-sm-8 across-space1"> <a class="btn btn-sm btn-info">牧野</a> <a class="btn btn-sm btn-info">后来者</a> </div>
                </div>
                <div class="form-group no-margin-left no-margin-right margin-bottom10 clearfix">
                  <label class="width81 float-left text-center margin-left5 clearfix" for="form-field-1">标签名称</label>
                  <div class="col-sm-7 no-padding">
                    <input type="text" class="col-xs-10 col-sm-6" name="name" ng-model="name" required="required">
                    <span class="red" ng-show="myform.name.$error.required"></span> </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer"> <a data-bb-handler="cancel" class="btn btn-default" data-dismiss="modal">取消</a> <a data-bb-handler="confirm" class="btn btn-primary" ng-click="save()" id="submitImage">确定</a> </div>
    </div>
  </div>
</div>
<script src="/ace/uploadify/jquery.uploadify.min.js"></script> 
<script>
var isfirstClick = false, Once = true;
app.controller('imageController', function($scope, $rootScope, $timeout){
	$scope.istrue = false;
	//上传图片  设置
	$scope.name = '';
	$scope.imgListIndex = -1;
	$scope.imgLists = [];
	$scope.clickImg = function(index){
		$scope.imgListIndex = index;
		$scope.name = $scope.imgLists[index].name;
	};
	$('#chooseImage').uploadify({
		'fileTypeDesc': '不超过300kb的图片 (*.gif;*.jpg;*.png)',
		'fileTypeExts': '*.gif;*.jpg;*.jpeg;*.png',//
		'fileSizeLimit': '3MB',
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
        'onFallback':function(){
            alert("您未安装FLASH控件，无法上传图片！请安装FLASH控件后再试。");
        },
		'onUploadStart': function(file){
			
		},
		'onUploadSuccess': function(file, data, response) {
			console.log(data);
			try{
				data = JSON.parse(data);
			}catch(e){
				console.log(e.name);
			};
			console.log(data);
			if(data.errcode == 0){
				$scope.imgLists.push(data.errmsg);
				$scope.imgLists[$scope.imgLists.length - 1].tag_id = 1;
				$scope.clickImg($scope.imgLists.length - 1);
				$scope.$apply();
			}
		}
	});
	$('#chooseImage').css({'float': 'left', 'opacity': '0'});
	//保存方法
	$scope.save = function(){
		$('#submitImage').attr('disabled', 'disabled');
		if($scope.myform.$invalid){
			$scope.istrue = true;
			return $timeout(function(){$scope.istrue = false; $('#submitImage').removeAttr('disabled');}, 3000);
		}
        $http.post("/wxmaterial/create-ajax", {list: $scope.imgLists})
            .success(function(msg){
                wsh.successback(msg, '', false, function(){
                    $('#submitImage').removeAttr('disabled');
                    wsh.successback(msg, '提交成功', false, function(){
                        $rootScope.$broadcast('ImageListChange', $scope.imgLists);
                    });
                });
            })
		$('#myModalWxImage').modal('toggle');
		$timeout(function(){
			$scope.imgLists = [];
			$scope.name = '';
		}, 1000);
	};
});	
</script>