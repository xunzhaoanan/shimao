<link href="/ace/uploadify/uploadify.css" rel="stylesheet" />
<div class="bootbox modal fade in" id="myModalImage" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="imageController">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
      <div class="modal-header modal-header2"> <a class="bootbox-close-button close" data-dismiss="modal">×</a>
        <h4 class="modal-title">图片管理器</h4>
      </div>
      <div class="modal-body">
        <div class="bootbox-body">
        	<div class="tabbable">
	          <div class="tab-pane in active">
	              <ul class="nav nav-tabs" id="myTab">
	                <li ng-class="{true: 'active'}[imageIndex == 0]" ng-click="imageClick(0)"  ng-if="$root.hasPermission('document/create-ajax')"  ng-show="isImageManage||imgopen==2"> <a>上传本地图片</a> </li>
	                <!--<li ng-class="{true: 'active'}[imageIndex == 1]" ng-click="imageClick(1)" ng-show="isImageManage"><a>添加网络图片</a> </li>-->
	                <li ng-class="{true: 'active'}[imageIndex == 2]" ng-click="imageClick(2)" ng-if="$root.hasPermission('document/image-ajax')" ng-show="!isImageManage"><a>从图库选择</a> </li>
	              </ul>
	          </div>

	          <div class="tab-content">

	            <div id="bdimg" class="tab-pane active" style="min-height: 200px; display:block;" ng-show="imageIndex == 0">
	              <form class="form-horizontal" name="myform" novalidate="novalidate">
		              <div  style="max-height: 500px;overflow: hidden;">
										<div class="position-relative margin-bottom10 clearfix">
											<span class="inline margin-right10">选择上传分组</span>
											<select name="" id="" class="width160" ng-model="groupId" ng-change="groupChange(groupId)">
												<option value="0">默认分组</option>
												<option value="{{i.id}}" ng-repeat="i in groupOptios">{{i.name}}</option>
											</select>
										</div>
	                  <div class="position-relative clearfix">
	                      <span class="margin-right10 align-top" >可选择多张图片批量上传</span>
	                      <span class="inline align-top ">
	                      	<a class="btn btn-sm btn-info ">选择图片</a>
	                      </span>
	                      	<div id="chooseImage" class="position-absolute"></div>
	                  </div>
	                  <div class="width100 margin-top10 margin-bottom10 clearfix">
		              <div class="slim-scroll">
	                  	<ul class="ace-thumbnails uploading_box clearfix">
	                    	<li class="img-thumbnail position-relative" ng-repeat="list in imgLists" ng-class="{true: 'outline_1_red inline', false: 'inline'}[$index == imgListIndex]">
													<div class="img-thumb11">
	                    			<img ng-src="{{list.file_cdn_path}}"  class="imgthd11" ng-click="clickImg($index)" />
													</div>
													<div class="tools tools-bottom text-center">
															<a ng-click="deleted($index)">
																	<i class="ace-icon icon-trash red"></i>
															</a>
													</div>

	                    	</li>
	                  </ul>
	                  </div> 
	                  </div>
		              </div>
	              </form>
	            </div>

	            <div ng-show="imageIndex == 1" class="tab-pane" style="display:block;">
	              <form name="wlform" novalidate="novalidate">
	                <div class="form-group clearfix">
	                  <div class="col-sm-12 margin-bottom10">
	                    <label class="form-group no-margin-left no-margin-right clearfix" for="form-field-1">网络图片地址</label>
	                  </div>
	                </div>
	                <div class="form-group no-margin-left no-margin-right margin-bottom10 clearfix">
	                  <div class="col-sm-12">
	                    <input type="text" class="col-xs-11"  value="" placeholder="http://" ng-model="wlurl" name="url" ng-pattern="/^http:\/\//" required="required">
	                    <span class="red" ng-show="myform.wlurl.$error.pattern && iswltrue">输入错误</span> <span class="red" ng-show="myform.wlurl.$error.required && iswltrue">必填项</span> </div>
	                </div>
	              </form>
	            </div>
	            
	            <!-- 图库选择 -->
	            <div class="tab-pane" ng-show="imageIndex == 2" style="display:block;">
	              <form name="allform" id="select_ajax_form" novalidate="novalidate">
	                <div class="form-group margin-bottom10 clearfix hide">
	                  <label class="col-sm-1 text-left no-padding-right login-text2 margin-right10" for="form-field-1">标签</label>
	                  <input name="tags" type="text" class="col-xs-10 col-sm-4" style="margin-left:-20px" ng-model="searchText" >
	                  <button class="btn btn-sm btn-info" type="button" ng-click="searchForm(searchText);">搜索</button>
	                </div>
	                <div class="form-group margin-bottom10 clearfix hide">
	                  <label class="col-sm-2 text-left" for="form-field-1">按标签查找</label>
	                  <div class="col-sm-10" style="margin-left:-40px;"> <a onclick="" class="btn btn-sm btn-info">微杂志</a> </div>
	                </div>
	                <div class="space-10"></div>

	                <div class="form-group margin-bottom10 clearfix">
	                  <div class="width100 height300 img-storeroom-list">
	                    <ul class="ul_pic clearfix">
	                      <li class="pic_list" ng-repeat="list in imageLists"> <a class="bbb" ng-click="imageChoose($index, list)"> 
	                      	<img ng-src="{{list.file_cdn_path}}" ><br>
	                        <label> <i class="on" ng-show="list.ischoose"></i> </label>
	                        </a>
	                        <div ng-bind="list.name" class="pic_name" ></div>
	                      </li>
	                    </ul>
	                  </div>
	                </div>
	              </form>
	              <div class="text-center clearfix" id="imageCenter" style="position:relative;">
	                <div id="imagePager"></div>
	              </div>
	            </div>
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
var isfirstClick = false, Once = true, imageArray = [];
app.controller('imageController', function($scope, $rootScope, $timeout, $http, $parse){
	$scope.istrue = $scope.iswltrue = $scope.isalltrue = false;
	$scope.page = {};
	//通过url判断是否需要显示图片管理器
	$scope.isImageManage = (/document\/image/).test(window.location.href);
	//全局  头部点击切换
	$scope.imageClick = function(index){
		$scope.imageIndex = index;
		if(index == 2 && !isfirstClick){
			isfirstClick = true;
			getData(1, 10);
		}
	};
	if(!$scope.isImageManage){
		$scope.imageClick(2);
	}else{
		$scope.imageClick(0);
	};
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
		'fileSizeLimit': '300kb',
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
			
		},
		'onUploadSuccess': function(file, data, response) {
			console.log(typeof data);
			try{
				//data = JSON.parse(data);
				data = $parse(data)($scope);
			}catch(e){
				console.log(e.name);
			};
			//data = JSON.parse(data);
			console.log(data);
			if(data.errcode == 0){
				$scope.imgLists.push(data.errmsg);
				$scope.imgLists[$scope.imgLists.length - 1].tag_id = 1;
				$scope.clickImg($scope.imgLists.length - 1);
				$scope.$apply();
			}
		}
	});
	$('#chooseImage').css({ 'position':'absolute','top':'0','left':'147px','width':'74','height': '23','opacity': '0'});
	//网络图片
	$scope.wlurl = '';
	$scope.wlname = '';
	//图片管理器
	$rootScope.groupId = 0;
    $scope.groupChange = function (id) {
        $rootScope.groupId = id;
    }
	$rootScope.groupOptios=[];
	$scope.imageLists = [];
	function getData(int, size){
        $http.post("/document/image-ajax", {'_page': int, '_page_size': size})
            .success(function(msg){
                wsh.successback(msg, '', false, function(){
                    $scope.imageLists = msg.errmsg.data;
                    $scope.page = msg.errmsg.page;
                    $.each($scope.imageLists, function(i, e){
                        e.ischoose = false;
                    });
                });
            })
	};
	$scope.deleted = function(index){
		wsh.setNoAjaxDialog('删除提示', '确定要删除该图片吗?', function(){
			$scope.imgLists.splice(index, 1);
			$scope.$apply();
		});
	};
	$scope.imageChoose = function(index, obj){
		obj.ischoose = !obj.ischoose;
		if($rootScope.ischooseOne){
			if(obj.ischoose){
				$.each($scope.imageLists, function(i, e){
					if(i != index) e.ischoose = false;
				});
			}
		}
	};  
    //选择上传分组
	$http.post("/document/find-category-ajax" )
			.success(function(msg){
				wsh.successback(msg, '', false, function(){
					$scope.groupList = msg.errmsg;
					$.each($scope.groupList,function(i,e){
						$scope.groupOptios.push(e);
					})
				});
			})

	//保存方法
	$scope.save = function(){
		switch($scope.imageIndex){
			case 0:
            console.log('aaa', $rootScope.groupId);
			if($scope.myform.$invalid){
				$scope.istrue = true;
				return $timeout(function(){$scope.istrue = false;}, 3000);
			}
            if(!$scope.imgLists.length) return alert('请上传图片');
                $.each($scope.imgLists,function(i,e){
                    $scope.imgLists[i].category_id = $rootScope.groupId;
                })
            $('#submitImage').attr('disabled', 'disabled');
			$.ajax({
			   type: "POST",
			   url: "/document/create-ajax",
			   data: {list: $scope.imgLists},
			   dataType:"json",
			   success: function(msg){
				   $('#submitImage').removeAttr('disabled');
				   wsh.successback(msg, '图片上传成功', false, function(){
					   $rootScope.$broadcast('ImageListChange', msg.errmsg);
                       if(location.href.indexOf('document/image') > 0){
                           location.reload();
                       }
				   });
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
			$rootScope.$broadcast('wlImage', $scope.wlurl, $scope.wlname);
			$timeout(function(){$scope.wlurl = $scope.wlname = '';}, 1000);
			$('#submitImage').removeAttr('disabled');
			$('#myModalImage').modal('toggle');
			break;
			case 2:
			imageArray = [];
			$scope.imageLists.forEach(function(e, i){
				if(e.ischoose && Once){
					imageArray.push($scope.imageLists[i]);
				}
				e.ischoose = false;
			});
            if(!imageArray.length) return alert('请选择图片');
            $('#submitImage').attr('disabled', 'disabled');
			$rootScope.$broadcast('ImageChoose', imageArray);
			setTimeout(function(){imageArray = [];}, 1000);
			$('#submitImage').removeAttr('disabled');
			$('#myModalImage').modal('toggle');
			break;
		}
	};
});	
</script>