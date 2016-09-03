app.controller('musicController', function($scope, $rootScope, $routeParams, $location, $http, $parse, userInfo){
    $scope.options={page: 'page', callback: getData, isRoot: true};
   	var isfirst = 1, string, loaded;
   	$scope.musicHtml = '';
    $scope.imageToggle = 1;
    $scope.imgLists = [];
    $scope.loadMusic = function(){
    	$scope.musicMask = true;
    	$('#myModalMusic').css('top', '-100%');
    	$('#myModalMusic').animate({top: '0'}, 500, function(){
            $scope.$apply();
        });
    	loaded = true;
    	getData(1);
    	setUpload();
    }
    //接收图片开启事件
    $scope.$on('musicUpload', function(e){
    	if(isfirst){
    		$scope.musicHtml = '/magazine/music';
    		isfirst = 0;
    		return;
    	}else{
    		$scope.musicMask = true;
    		$('#myModalMusic').animate({top: '0'}, 500, function(){
                $scope.$apply();
            });
    	} 
    })
    //切换 tab
    $scope.toggle = function(index){
    	if(index == $scope.imageToggle) return;
    	$scope.imageToggle = index;
    	if(index == 1){
    		getData(1);
    	}
    	$('#myMusicAudio')[0].pause();
    }
    //图片点击
    $scope.clickImg = function(index){
    	$scope.musicModalSrc = $scope.imgLists[index].file_cdn_path;
    	if($('#audio').length){
    		if(!$('#audio')[0].paused){
    			$('#audio')[0].pause()
    			$rootScope.$broadcast('pausedMusic');
    		}
    	}
    	if($scope.imgListIndex != index){
    		$scope.imgListIndex = index;
    		$('#myMusicAudio')[0].play();
    	}else{
    		if($('#myMusicAudio')[0].paused){
    			$('#myMusicAudio')[0].play();
    		}else{
    			$('#myMusicAudio')[0].pause();
    		}
    	}

		//$scope.name = $scope.imgLists[index].name;
	};
	//图片删除
	$scope.deleted = function(index){
		wsh.setNoAjaxDialog('删除提示', '确定要删除该音乐吗?', function(){
			$scope.imgLists.splice(index, 1);
			$scope.$apply();
		});
	};
    function setUpload(){
    	$('#chooseMusic').uploadify({
			'fileTypeDesc': '不超过150kb的图片 (*.gif;*.jpg;*.png)',
			'fileTypeExts': '*.mp3',//
			'fileSizeLimit': '3MB',
			'swf': '/ace/uploadify/uploadify.swf',
			'uploader': '/document/upload-ajax',
			'buttonClass': 'btn btn-sm btn-info',
			'buttonText': '上传图片',
			'width': 100,
			'height': 23,
			'opacity': 0,
			'background': '#428bca',
			'-webkit-border-radius': 0,
			'border-radius': 0,
			'border': 0,
			'multi': $rootScope.isuploadOne ? false : true,
			'removeTimeout': 0.1,
			'onUploadStart': function(file){
				
			},
	        'onFallback':function(){
	            alert("您未安装FLASH控件，无法上传音乐！请安装FLASH控件后再试。");
	        },
			'onUploadSuccess': function(file, data, response) {
				try{
					data = $parse(data)($scope);
					if(data.errcode == 0){
						$scope.imgLists.push(data.errmsg);
						$scope.imgLists[$scope.imgLists.length - 1].tag_id = 1;
						$scope.clickImg($scope.imgLists.length - 1);
						$scope.$apply();
					}
				}catch(e){
					console.log(e.name);
				};
			}
		});
		$('#chooseMusic').css({ 'position':'absolute','top':'0','left':'147px','width':'100','height': '23','opacity': '0'});
    }
    function getData(int){
    	var aa = userInfo.getListAjax('/document/music-ajax', {'_page': int, '_page_size': 15});
    	aa.then(function(msg){
    		$rootScope.page = msg.errmsg.page;
    		$scope.lists = msg.errmsg.data;
    	})
    }
    //选择 图片
    $scope.choose = function(index, list){
    	list.ischoose = !list.ischoose;
		if(list.ischoose){
			if($('#audio').length){
	    		if(!$('#audio')[0].paused){
	    			$('#audio')[0].pause()
	    			$rootScope.$broadcast('pausedMusic');
	    		}
	    	}
	    	$scope.musicModalSrc = list.file_cdn_path;
            $('#myMusicAudio')[0].play();
			$.each($scope.lists, function(i, e){
				if(i != index) e.ischoose = false;
			});
		}else{
			$('#myMusicAudio')[0].pause();
		}
    }
    //关闭
    $scope.close = function(){
    	$('#myModalMusic').animate({top: '-100%'}, 500, function(){
    		$scope.musicMask = false;
    		$scope.$apply();
    	});
    	$.each($scope.lists, function(i, e){
			e.ischoose = false;
		});
    }
    //确定
    var iscon = false;
    $scope.confirm = function(){
    	if(iscon) return;
    	switch($scope.imageToggle){
    		//上传
    		case 0:
    		if(!$scope.imgLists.length) return alert('请上传音乐');
    		iscon = true;
    		var aa = userInfo.getListAjax('/document/create-ajax', {list: $scope.imgLists});
    		aa.then(function(msg){
    			$rootScope.$broadcast('MusicListChange', msg.errmsg);
    			$scope.imgLists = [];
    			iscon = false;
    			$scope.close()
    		})
    		$('#myMusicAudio')[0].pause();
    		break;
    		//选择
    		case 1:
    		iscon = true;
    		var imageArray = [];
    		$.each($scope.lists, function(i, e){
    			if(e.ischoose) imageArray.push(e);
    			e.ischoose = false;
    		})
    		if(!imageArray.length) return alert('请选择音乐');
			$rootScope.$broadcast('MusicChoose', imageArray);
			//$scope.page = {}
			iscon = false;
			$scope.close()
            $('#myMusicAudio')[0].pause();
    		break;
    	}
    }
});