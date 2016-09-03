<link href="/ace/uploadify/uploadify.css" rel="stylesheet" />
<div class="bootbox modal fade in"  id="myModalMusic" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="musicController">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
      <div class="modal-header modal-header2"> <a href="#" class="bootbox-close-button close" data-dismiss="modal">×</a>
        <h4 class="modal-title">上传音乐</h4>
      </div>
      <div class="modal-body">
        <div class="bootbox-body">
          <div class="tab-pane in active row">
            <div class="tabbable">
              <ul class="nav nav-tabs" id="myTab">
                <li ng-class="{true: 'active'}[musicIndex == 0]" ng-click="musicClick(0)"> <a>上传本地音乐</a> </li>
                <li ng-class="{true: 'active'}[musicIndex == 1]" ng-click="musicClick(1)"><a>添加网络音乐</a> </li>
                <li ng-class="{true: 'active'}[musicIndex == 2]" ng-click="musicClick(2)" ng-show="!isMusicManage"><a>从音乐库选择</a> </li>
              </ul>
            </div>
          </div>
          <div class="tab-content row">
            <div id="bdimg" class="tab-pane active row" style="min-height: 200px;">
              <form class="form-horizontal" name="myform" novalidate="novalidate">
                <div class="form-group clearfix">
                  <div class="col-sm-12">
                    <p class="width121 float-left text-center margin-left20 clearfix" >选择本地音乐</p>
                    <a class="btn btn-sm btn-info" style="margin-left:-65px;">选择音乐</a>
                    <div id="chooseImage"></div>
                  </div>
                </div>
                <div class="form-group no-margin-left no-margin-right margin-bottom10 clearfix">
                  <label class="width150 float-left text-center margin-left5 clearfix" for="form-field-1">常用标签，可选择使用</label>
                  <div class="col-sm-8 across-space1"> <a href="#" class="btn btn-sm btn-info" >牧野</a> <a href="#" class="btn btn-sm btn-info" >后来者</a> </div>
                </div>
                <div class="form-group no-margin-left no-margin-right margin-bottom10 clearfix">
                  <label class="width81 float-left text-center margin-left5 clearfix" for="form-field-1">标签名称</label>
                  <div class="col-sm-7 no-padding">
                    <input type="text" class="col-xs-10 col-sm-6" name="name" ng-model="name" required="required">
                    <span class="red" ng-show="myform.name.$error.required"></span> </div>
                </div>
              </form>
            </div>
            <div id="wlimg" class="tab-pane">
              <form name="wlform" novalidate="novalidate">
                <div class="form-group margin-bottom5 clearfix">
                  <div class="col-sm-12">
                    <label class="form-group no-margin-left no-margin-right clearfix" for="form-field-1">网络音乐地址</label>
                  </div>
                </div>
                <div class="form-group no-margin-left no-margin-right margin-bottom10 clearfix">
                  <div class="col-sm-12">
                    <input type="text" class="col-xs-11"  value="" placeholder="http://">
                  </div>
                </div>
                <div class="form-group no-margin-left no-margin-right margin-bottom10 clearfix">
                  <label class="width150 float-left text-left margin-left10 clearfix" for="form-field-1">常用标签，可选择使用</label>
                  <div class="col-sm-8 across-space1" style="margin-left:-20px;"> <a href="#" class="btn btn-sm btn-info" >牧野</a> <a href="#" class="btn btn-sm btn-info" >后来者</a> </div>
                </div>
                <div class="form-group no-margin-left no-margin-right margin-bottom10 clearfix">
                  <label class="width71 float-left text-left margin-left10 clearfix" for="form-field-1">标签名称</label>
                  <div class="col-sm-7 no-padding" style="margin-left:-10px;">
                    <input type="text" class="col-sm-6" name="wlname" ng-model="wlname" required="required">
                    <span class="red"></span> </div>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="pics">
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
      <div class="modal-footer"> <a data-bb-handler="cancel" class="btn btn-default" data-dismiss="modal">取消</a> <a data-bb-handler="confirm" class="btn btn-primary">确定</a> </div>
    </div>
  </div>
</div>
<script src="/ace/uploadify/jquery.uploadify.min.js"></script> 
<script>
var isfirstClick = false, Once = true;
app.controller('musicController', function($scope, $rootScope, $timeout){
	$scope.istrue = $scope.iswltrue = $scope.isalltrue = false;
	//通过url判断是否需要显示音乐管理器
	$scope.isMusicManage = (/document\/[voice|music]/).test(window.location.href);
	//全局  头部点击切换
	$scope.musicClick = function(index){
		$scope.musicIndex = index;
		if(index == 2 && !isfirstClick){
			isfirstClick = true;
			getData(1, 10);
		}
	};
	if(!$scope.isMusicManage){
		$scope.musicClick(2);
	}else{
		$scope.musicClick(0);
	}
	//上传图片  设置
	$scope.name = '';
	$scope.imgListIndex = -1;
	$scope.imgLists = [];
	$scope.clickImg = function(index){
		$scope.imgListIndex = index;
		$scope.name = $scope.imgLists[index].name;
	};
	$('#chooseImage').uploadify({
		'fileTypeDesc': '不超过3MB的音乐 (*.gif;*.jpg;*.png)',
		'fileTypeExts': '*.mp3',
		'fileSizeLimit': '3MB',
		'swf': '/ace/uploadify/uploadify.swf',
		'uploader': '/document/upload-ajax',
		'buttonClass': 'btn btn-sm btn-info',
		'buttonText': '上传图片',
		'width': 74,
		'height': 23,
		'opacity': 0,
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
			//$('#SWFUpload_0').attr('disabled', 'disabled');
			//ace.show('上传中...', 150000);
		},
		'onUploadSuccess': function(file, data, response) {
			try{
				data = JSON.parse(data);
			}catch(e){
				console.log(e.name);
			};
			console.log(data);
			if(data.errcode == 0){
				$scope.imgLists.push(data.errmsg);
				console.log($scope.imgLists);
				$scope.clickImg($scope.imgLists.length - 1);
				$scope.$apply();
			}
		}
	});
	$('#chooseImage').css({'float': 'left', 'opacity': '0'});
	$('#SWFUpload_0').css('margin-left', '30px');
	//网络图片
	$scope.wlurl = '';
	$scope.wlname = '';
	//图片管理器
	$scope.imageLists = [];
	function getData(int, size){
		$.post('/document/music-ajax', {'_page': int, '_page_size': size}, function(msg){
			if(msg.errcode == 0){
				$scope.imageLists = msg.errmsg.data;
				$scope.page = msg.errmsg.page;
				$.each($scope.imageLists, function(i, e){
					e.ischoose = false;
				});
				console.log(msg);
				$scope.$apply();
			}
		}, 'json');
	};
	$scope.imageChoose = function(index){
		$scope.imageLists[index].ischoose = !$scope.imageLists[index].ischoose;
	};  
	//保存方法
	$scope.save = function(){
		$('#submitImage').attr('disabled', 'disabled');
		switch($scope.imageIndex){
			case 0:
			if($scope.myform.$invalid){
				$scope.istrue = true;
				return $timeout(function(){$scope.istrue = false; $('#submitImage').removeAttr('disabled');}, 3000);
			}
			$.ajax({
			   type: "POST",
			   url: "/document/create-ajax",
			   data: {list: $scope.imgLists},
			   dataType:"json",
			   success: function(msg){
				   $('#submitImage').removeAttr('disabled');
				   wsh.successback(msg, '提交成功', false, function(){
				   });
				   console.log($scope.imgLists);
				   $rootScope.$broadcast('MusicListChange', $scope.imgLists);
			   },
			   error: function(){
				   $('#submitImage').removeAttr('disabled');
				   alert('服务器忙');    
			   }
			});
			$('#myModalImage').modal('toggle');
			$timeout(function(){
				$scope.imgLists = [];
				$scope.name = '';
			}, 1000);
			break;
			case 1:
			if($scope.wlform.$invalid){
				$scope.iswltrue = true;
				return $timeout(function(){$scope.iswltrue = false; $('#submitImage').removeAttr('disabled');}, 3000);
			}
			$rootScope.$broadcast('wlMusic', $scope.wlurl, $scope.wlname);
			$timeout(function(){$scope.wlurl = $scope.wlname = '';}, 1000);
			$('#submitImage').removeAttr('disabled');
			$('#myModalImage').modal('toggle');
			break;
			case 2:
			$scope.imageLists.forEach(function(e, i){
				if(e.ischoose && Once){
					//Once = false;
					$rootScope.$broadcast('MusicChoose', $scope.imageLists[i]);
				}
				e.ischoose = false;
			});
			//Once = true;
			$('#submitImage').removeAttr('disabled');
			$('#myModalImage').modal('toggle');
			break;
		}
	};
});	
</script>