 /*
 * andy 2015.04.16
 */
//全局变量obj
var wsh = wsh || {};
wsh.uploadImgName = '';  //判断点击的是三个上传图片的哪一个  取name值
wsh.saveObj = {};  //将此值做保存函数的传递数据
wsh.musicList = null; //保存内置的音乐列表  此值会带到 web.imgstore.js 中使用
wsh.shareDesc = $("#share-desc");//分享描述
wsh.shareLogo = $("#share-logo");//分享Logo
wsh.imgUrl = $("#share-cover");//杂志封面
wsh.musicUrl = $('form.upload-music audio.music');//音乐url
wsh.category_id = $("#app-category");//id值
wsh.musicName = $('#upfileResults .upload-tips');//音乐名称
wsh.contant = $('.pages');//内容
wsh.playMusic = $('form.upload-music i.fa-play');//播放音乐
wsh.cancelMusic = $('form.upload-music i.music-cancel');//删除音乐
wsh.pauseMusic = $('form.upload-music i.fa-pause');//暂停音乐
wsh.url = window.location.href.match(/^.+\//)[0]; //ajax 或 $http 地址管理
wsh.element = null; //手机区域中选中的对象
wsh.pageMenuTarget = null; //保存底图右键时的对象
wsh.createMenuTarget = null; //保存手机区域右键时的对象
wsh.dummyStyle = document.createElement('div').style; //返回浏览器类型
wsh.style = (function() {
	var vendors = ['webkitT', 'MozT', 'msT', 'OT', 't'],
	t,
	i = 0,
	l = vendors.length;
	for (; i < l; i++) {
		t = vendors[i] + 'ransform';
		if (t in wsh.dummyStyle) {
			return vendors[i].substr(0, vendors[i].length - 1);
		}
	}
	return false;
})();
wsh.style = '-' + wsh.style + '-';
wsh.successback = function(msg, text, isreload, callback){
	if(msg.errcode == 0){
		text ? window.alert(text) : void 0;
		isreload ? window.location.reload() : void 0;
		if(typeof callback == 'function'){
			callback.call(this);
		}
	}else{
		alert(msg.errmsg);
	}
};
wsh.setDialog = function(title, content, url, data, callback, text){
	return dialog({
		zIndex: 9999998,
		title: title,
		content: content,
		okValue: "确定",
		ok: function() {
            wsh.http.post(url, data)
                .success(function(msg) {
                    wsh.successback(msg, text, false, function () {
                        if (typeof callback == 'function') callback.call(this);
                    });
                })
		},
		otherBtnValue: "取消",
		otherBtn: function() {}
	}).width(320).showModal();
};
wsh.setNoAjaxDialog = function(title, content, callback){
	return dialog({
		zIndex: 9999998,
		title: title,
		content: content,
		okValue: "确定",
		ok: function() {
			if(typeof callback == 'function') callback.call(this);
		},
		otherBtnValue: "取消",
		otherBtn: function() {}
	}).width(320).showModal();
}
//封装快速弹框函数
wsh.dialog = null; //弹框全局变量
wsh.dialogFun = function(args) {
	return dialog(args);
};
wsh.quickDialog = function(text){
	if(!wsh.dialog){
		wsh.dialog = wsh.dialogFun({
			content: text,
			quickClose: true
		});
		wsh.dialog.showModal();
		var closeFun = function() {
			wsh.dialog.close().remove();
			wsh.dialog = null;
		};
		setTimeout(closeFun, 1000);
	}
};
//自动保存
wsh.autoSave = null;
wsh.isAutoSave = false;
//记录是不是从新手向导进来
wsh.isIntroudction = false;
wsh.isFirst = false;
//历史记录最大步数
wsh.id = null; // 保存微杂志的id值 
wsh.dataFirst = {}; //保存微杂志最初的记录
wsh.historyArray = []; //保存历史记录的数组
wsh.historyCount = 50;
wsh.index = null; //记录点击我的杂志列表中的$index索引值
//历史记录获取时间
wsh.getdate = function(){
	var aa = new Date();
	var hours = aa.getHours();  
	var minutes = aa.getMinutes(); 
	var seconds = aa.getSeconds(); 
	var date = aa.getDate(); 
	var month = aa.getMonth()+1;
	return month + '月' + date + '日  ' + hours + ':' + minutes + ':' + seconds;  
};
//获取底图的宽度
wsh.editWidth = $('.edit_introduction').width();
//wsh.editLeft = $('.edit_introduction').offset().left;
(function(){
	var q, s;
	q = colorjoe.rgb("backgroundColorPicker", "#772d90", ["currentColor", "hex", "text", ["text",
			{
				text: "param demo"
			}]]);
	s = colorjoe.rgb("backgroundSelect", "#772d90", ["currentColor", "hex", "text", ["text",
			{
				text: "param demo"
			}]]);
	var app = angular.module("myapp", []);
	app.controller("headController", function($scope, $rootScope, $element, $http, $window) {
		//新手向导设置
		$rootScope.guideArray = [{className : 'intro-img intro-step1'}, 
								 {className : 'intro-img intro-step2'}, 
							 	 {className : 'intro-img intro-step3'}, 
								 {className : 'intro-img intro-step4'}, 
								 {className : 'intro-img intro-step5'}, 
								 {className : 'intro-img intro-step6'}, 
								 {className : 'intro-img intro-step7'}, 
								 {className : 'intro-img intro-step8'}];
		$rootScope.guideIndex = -1;
		//mask 层
		$scope.maskShow = false;
		$scope.maskText = '恢复数据中...';
		//历史记录数组
		$rootScope.historyArray = [];
		$scope.appId = null;
		$rootScope.mainCreate = false;
		getAppList();
		function getAppList(){
			$http.post(wsh.url + 'list-ajax').success(function(msg){
				$scope.appList = msg.errmsg.data;
			});	
		};
		//读取是否为第一次进入 并读取是否是从登陆的编辑按纽进来
		if (!($.cookie('isIntroudction') === 'true')) {
			wsh.isFirst = true;
			$.removeCookie('App Id', {
				path: '/'
			});
			$.cookie('isIntroudction', 'true', {
				expires: 10 * 365,
				path: '/'
			});
			$('.introduction').show();
			$rootScope.guideIndex = 0;
			$rootScope.guideShow = true;
		}else{
			if(location.hash != ""){
				var hash = location.hash;
				if(hash.indexOf('#') != -1){
					$scope.appId = location.hash.replace('#', '');
				}
			}
		}	
		$rootScope.appTopList = false; //我的杂志列表
		$scope.myMagazine = true;// 显示或者隐藏我的杂志
		$scope.caretDown = function(eve){
			if(!$rootScope.appTopList){
				var number = $("#app-list ul").find("li").length;
				if(number > 5){
					$("#app-list").css({"height":"237px", 'overflow-y': 'auto', 'overflow-x': 'hidden'});
				}else{
					$("#app-list").css("height",( 47*number + 2)+"px");
				}
			}
			$rootScope.appTopList = !$rootScope.appTopList;
		};
		//我的杂志点击跳转杂志
		$scope.activeApp = function(eve, index){
			//需要跳转到别的微杂志
			if(location.hash != "#add" && location.hash != "" && !$rootScope.guideShow){
				if(index == 0){
					wsh.quickDialog('不能跳转自身');
				}else{
					wsh.index = index;
					saveMethods(index);
				}
			}else{
				wsh.index = index;
				var id = $scope.appList[index].id;
				$scope.$broadcast('app Id', id);
			}
		};

		//提示离开当前微杂志所做的保存选择  index 为我的杂志里的杂志的索引值 新建按纽 isNew = true; else isNew = false;
		function saveMethods(index, isNew){
			var callback;
			if(isNew){
				callback = function(){
					$window.location.href="/shanghu/magazine/index";
				};
			}else{
				callback = function(){
					var id = $scope.appList[index]._id;
					$scope.$broadcast('app Id', id, false, function(){
						$scope.maskShow = false;
						$scope.maskText = '恢复数据中...';
					});
				};
			}
			wsh.setNoAjaxDialog('离开页面提示', '离开之前需要保存当前微杂志!', function(){
					if(index != 0){
						$scope.maskShow = true;
						$scope.maskText = '跳转至别的微杂志中...';
					}
					$scope.$broadcast('save app data', null, callback);
			});	
		}
		//我的杂志内的删除按纽
		$scope.deleteApp = function(eve, index){
			eve.stopPropagation();
			var content = "<p>您是否要删除当前名为 <span class=txt_blue>" + $scope.appList[index].name + "</span>的微杂志</p>删除后数据不可恢复？";
			wsh.setNoAjaxDialog('删除微杂志', content, function(){
				return this.title("提交中…"), $.ajax({url: wsh.DATA_BASE+ "/del/" + $scope.appList[index]._id,type: "DELETE",data: {},success: function() {
						$.removeCookie("App Id", {path: "/"});
						return $window.location.href="/shanghu/magazine/index"

				}}), !0
			})
		};
		//读取历史记录
		$scope.restoreHistory = function(eve, index){
			var content = '<p>您是否要读取时间为 <span class=txt_blue>' + $rootScope.historyArray[index].time + '</span>的数据</p>';
			wsh.setNoAjaxDialog('读取历史保存状态!', content, function(){
				$scope.$broadcast('app Activated', wsh.historyArray[index], false, function(){}, true);
			})
		};
		//删除历史记录
		/*$scope.deleteHistory = function(eve, index){
			eve.stopPropagation();
		};*/
		//历史记录的显示 隐藏
		$rootScope.appHistoryShow = false;
		$scope.Topmenu = function(int){

			switch(int){
				case 1:
				//新建按纽
				saveMethods(0, true);
				break;
				// case 2:
				// //动画按纽
				// $scope.$broadcast('show effects');
				// break;
				case 3:
				//保存按纽
				$scope.$broadcast('save app data');
				break;
				case 4:
				//预览按纽
				$scope.$broadcast('save app data', false, function(){
					
					//$window.open("http://" + $window.location.host + wsh.DATA_BASE + "/preview/" + $window.location.hash.replace('#', ''));
				});
				$window.open("http://" + $window.location.host + wsh.DATA_BASE + "/preview/" + $window.location.hash.replace('#', ''));
				break;
				case 5:
				//历史记录
				if(!$rootScope.appHistoryShow){
					var number = $("#app-history ul").find("li").length;
					if(number > 5){
						$("#app-history").css({"height":"237px", 'overflow-y': 'auto'});
					}else{
						$("#app-history").css("height",( 47*number + 2)+"px");
					}
				}
				$rootScope.appHistoryShow = !$rootScope.appHistoryShow;
				break;
			}
		};
		//头部新手引导按纽
		$scope.gotoGuide = function(){
			if(window.location.hash == '' || window.location.hash == '#add'){
				window.location.hash = '#add';
				$('.introduction').show();
				$rootScope.guideIndex = 0;
				$rootScope.guideShow = true;
			}else{
				saveMethods(0, true);
			}
		}
		//页面按下事件
		$scope.downAll = function(e){
			if(!$(e.target).parents().is('#nav-weza-list') && !$(e.target).parents().is('#history')){
				$scope.$broadcast('downAll', e.target, e.clientX, e.clientY);
			} 
		}
		//接收历史记录事件
		$scope.$on('appHistory', function(eve, data){
			wsh.historyArray.unshift(data);
			$scope.historyArray.unshift({time: wsh.getdate()});
			if($rootScope.historyArray.length > wsh.historyCount){
				$rootScope.historyArray.splice(wsh.historyCount, 1);
			} 
		});
		//接收页面开始事件
		$scope.$on('app Activated', function(event, data, isfirst, callback, ishistory){
			$rootScope.mainCreate = true;
			if(wsh.isIntroudction){
				var obj = {};
				obj._id = data._id;
				obj.title = data.title;
				$scope.appList.unshift(obj);
			}else{
				var obj = null, index = null;
				if($scope.appList){
					if(!ishistory){
						appList();
					}
				}else{
					var timer = setInterval(function(){
						if($scope.appList){
							appList();
							clearInterval(timer);
						}
					}, 20);
				}
				function appList(){
					$scope.appList.forEach(function(i, e){
						if(i._id == $.cookie('App Id')){
							obj = i;
							index = e;
						}
					});
					//表示所点击的微杂志很靠后
					if(index == null){
						var obj = {};
						obj._id = data._id;
						obj.title = data.title;
						$scope.appList.unshift(obj);
						return;
					}
					if(index != 0){
						$scope.appList.splice(index, 1);
						$scope.appList.unshift(obj);
					}
				}
			}
			wsh.index = null;
		});
		//页面离开事件
		$(window).unload(function(){
			$.removeCookie("App Id", {path: "/"});
		});
	});
	app.controller("mainController", function($scope, $rootScope, $element, $http, $sce) {
		$('#history').add('#nav-weza-list').add('#createMask').removeClass('hide');
		$scope.AlignShow = false;
		$scope.isForm = true;
		$scope.elementCount = 0;
		//新手的下一步操作
		$rootScope.nextStep = function(index){
			if(index == 0){
				$('.introduction').hide();
				$rootScope.guideIndex = -1;
			}else{
				if(index != 7){
					$rootScope.guideIndex = index + 1;
					index == 2 ? ($scope.showMenu = 17, $('.create-toolbars').add('#animation-editor').css('z-index', 10001)) : void 0;
					index == 3 ? ($('.create-toolbars').add('#animation-editor').css('z-index', 200), $('.phone-bg').css('z-index', 10001)) : void 0;
					index == 4 ? ($('.phone-bg').css('z-index', 200), $('.intro-step6-show').css('z-index', 10001)) : void 0;
					index == 5 ? ($('.intro-step6-show').css('z-index', 0), $('.intro-step7-show').css('z-index', 10001)) : void 0;
					index == 6 ? ($('.intro-step7-show').css('z-index', 200)) : void 0;
				}else{
					$('.introduction').hide();
					$rootScope.guideIndex = -1;
				}
			}
		};

		//预览时浏览的点是否显示
		$scope.whiteLists = [];
		$scope.changeCheck = function(){
			$scope.chk = !$scope.chk;
			$scope.chk ? wsh.quickDialog('页面标识显示') : wsh.quickDialog('页面标识隐藏');
			$scope.$emit('sync');
		}

		$scope.copyElement = null;//  记录复制来的元素
		//底图和手机区域的右键菜单 显示 或 隐藏 及样式的计算
		$scope.pageMenu = false;
		$scope.createMenu = false;
		$scope.pageMenuOffset = {left: 0, top: 0};
		$scope.createMenuOffset = {left: 0, top: 0};
		//公共属性 并会赋值给手机区域选中的对象
		$scope.public = {width : 160, height: 28, opacity: 100, rotate: 0, left: 0, top: 0};
		//复选框  先默认为false;
		$scope.checkScale = false;
		$scope.checkRound = false;
		//选择页面过渡效果  暂时没做效果
		$scope.slideArray = [{slide: 'cover', text: '缩放'}, {slide: 'easy', text: '普通'}, {slide: 'fade', text: '翻转'}, {slide: 'glue', text: '旋转'}];
		$scope.slideIndex = 1; 
		$scope.changeSlide = function(int){
			$scope.slideIndex = int;
			wsh.quickDialog('已选择' +$scope.slideArray[int].text+ '效果过渡');
			$('.pages').children().attr('data-slide', $scope.slideArray[int].slide);
		}
		//虚线框框显示设置
		$scope.frameShow = false;
		//改变宽度
		$scope.changeWidth = function(a){
			if(wsh.element && a){
				wsh.element.css('width', a.toFixed(0) + 'px');
				if($scope.checkScale && wsh.element.is('.image')){
					wsh.element.css('height', (a * wsh.scale).toFixed(0) + 'px'); 
					//$scope.public.height = (a * wsh.scale).toFixed(0);
				}
				$scope.$emit('sync');
			}
		};
		//改变高度
		$scope.changeHeight = function(a){
			if(wsh.element && a){
				wsh.element.css('height', a.toFixed(0) + 'px');
				if($scope.checkScale && wsh.element.is('.image')){
					wsh.element.css('width', (a/wsh.scale).toFixed(0) + 'px'); 
				    //$scope.public.width = (a/wsh.scale).toFixed(0);
				}
				$scope.$emit('sync');
			}
		};
		//改变透明度
		$scope.changeOpacity = function(a){
			if(wsh.element && a){
				wsh.element.css('opacity', (a/100).toFixed(2));
				wsh.element.attr('opacity', (a/100).toFixed(2));
				$scope.$emit('sync');
			}
		};
		//改变旋转度
		$scope.changeRotate = function(a){
			if(wsh.element && a > -1){
				wsh.element.css(wsh.style + 'transform', 'rotateZ(' +a.toFixed(0)+ 'deg)');
				wsh.element.attr('rotateZ', a.toFixed(0));
				$scope.$emit('sync');
			}
		};
		//字体选择属性
		$scope.fontFamily = [{font: '华文细黑'}, {font: '宋体'}, {font: '黑体'}, {font: 'Cuisive'}, {font: 'Fantasy'}, {font: 'Helvetica'}, {font: 'Monospace'}, {font: 'Serif'}, {font: 'Sans-serif'}];
		$scope.fontFamilySelecd = $scope.fontFamily[2];
		$scope.changeFontFamily = function(a){
			if(wsh.element){
				wsh.element.css('font-family', a.font);
				$scope.$emit('sync');
			}
		}
		//字号选择属性
		$scope.fontSize = [{size: '12'}, {size: '14'}, {size: '16'}, {size: '18'}, {size: '24'}, {size: '30'}, {size: '36'}, {size: '48'}, {size: '60'}, {size: '72'}];
		$scope.fontSizeSelecd = $scope.fontSize[0];
		$scope.changeFontSize = function(a){
			if(wsh.element){
				wsh.element.css('font-size', a.size + 'px');
				$scope.$emit('sync');
			}
		}
		//字体样式的选择属性
		$scope.fontStyle = [{className: 'menu enlarge', iClass: 'fa fa-font', title: '增大字号'},
							{className: 'menu shrink', iClass: 'fa fa-font', title: '减小字号'},
							{className: 'menu bold', iClass: 'fa fa-bold', title: '加粗'},
							{className: 'menu italic', iClass: 'fa fa-italic', title: '倾斜'},
							{className: 'menu underline', iClass: 'fa fa-underline', title: '下划线'},
							{className: 'menu distributed', iClass: 'fa fa-align-center', title: '居中对齐'},
							{className: 'menu leftAligned', iClass: 'fa fa-align-left', title: '左对齐'},
							{className: 'menu rightAligned', iClass: 'fa fa-align-right', title: '右对齐'}];
		//字体菜单函数
		$scope.fontMenu = function(eve, index){
			if(wsh.element){
				var text;
				switch(index){
					case 0:
					var index = $scope.fontSize.indexOf($scope.fontSizeSelecd);
					if(index == ($scope.fontSize.length - 1)){
						text = '字体已经是最大!';
					}else{
						$scope.fontSizeSelecd = $scope.fontSize[index + 1];
						wsh.element.css('font-size', $scope.fontSize[index + 1].size + 'px');
						text = '已选择' +$scope.fontSize[index + 1].size+'号字体';
					}
					break;
					case 1:
					var index = $scope.fontSize.indexOf($scope.fontSizeSelecd);
					if(index == 0){
						text = '字体已经是最小!';
					}else{
						$scope.fontSizeSelecd = $scope.fontSize[index - 1];
						wsh.element.css('font-size', $scope.fontSize[index - 1].size + 'px');
						text = '已选择' +$scope.fontSize[index - 1].size+'号字体';
					}
					break;
					case 2:
					if(wsh.element.css('font-weight') != 'bold'){
						wsh.element.css('font-weight', 'bold');
						text = '已选择添加粗体样式';
					}else{
						wsh.element.css('font-weight', 'normal');
						text = '已选择取消粗体样式';
					}
					break;
					case 3:
					if(wsh.element.css('font-style') == 'normal'){
						wsh.element.css('font-style', 'italic');
						text = '已选择添加斜体样式';
					}else{
						wsh.element.css('font-style', 'normal');
						text = '已选择取消斜体样式';
					}
					break;
					case 4:
					if(wsh.element.css('text-decoration') == 'underline'){
						wsh.element.css('text-decoration', 'none');
						text = '已选择取消下划线';
					}else{
						wsh.element.css('text-decoration', 'underline');
						text = '已选择添加下划线';
					}
					break;
					case 5:
					wsh.element.css('text-align', 'center');
					text = '已选择居中对齐';
					break;
					case 6:
					wsh.element.css('text-align', 'start');
					text = '已选择向左对齐';
					break;
					case 7:
					wsh.element.css('text-align', 'end');
					text = '已选择向右对齐';
					break;
				}
				wsh.quickDialog(text);
				$scope.$emit('sync');
			}
		};
		//行高设置函数
		$scope.changeLineHeight = function(a){
			if(wsh.element){
				wsh.element.css('line-height', a + 'px');
				$scope.$emit('sync');
			}
		};
		//图形文本链接
		$scope.btnshapeText = '';
		$scope.changeBtnshapeText = function(a){
			if(wsh.element){
				wsh.element.text(a);
				$scope.$emit('sync');
			}
		};
		//边框设置函数
		$scope.borderWidth = [{Border: 0},{Border: 1},{Border: 2},{Border: 3},{Border: 4}];
		$scope.borderWidthSelecd = $scope.borderWidth[0];
		$scope.changeBorderWidth = function(a){
			if(wsh.element){
				wsh.element.css('border-width', a.Border + 'px');
				$scope.$emit('sync');
			}
		};
		//圆角设置函数
		$scope.roundCorner = [{Round: 0},{Round: 1},{Round: 2},{Round: 3},{Round: 4},{Round: 6},{Round: 8},{Round: 10}];
		$scope.roundCornerSelecd = $scope.roundCorner[0];
		$scope.changeRoundCorner = function(a){
			if(wsh.element){
				wsh.element.css('border-radius', a.Round + 'px');
				$scope.$emit('sync');
			}
		};
		//内链与外链
		$scope.Links = [{Link: '内部链接'},{Link: '外部链接'}];
		$scope.linkSelecd = $scope.Links[0];
		//内链的选择框
		$scope.innerLinks = [{Link: '清除内链属性'}];
		$scope.innerLinkSelecd = $scope.innerLinks[0];
		$scope.changeInnerLink = function(a){
			if(wsh.element){
				if(a.Link == '清除内链属性'){
					wsh.element.removeAttr('data-page');
				}else{
					wsh.element.attr('data-page', a.Link);
				}
				wsh.element.removeAttr('link');
				$scope.outLink = '';
			}
		};
		//外链输入文本函数
		$scope.outLink = '';
		$scope.changeOutLink = function(a){
			if(wsh.element){
				wsh.element.attr('link', a);
				wsh.element.removeAttr('data-page');
				$scope.innerLinkSelecd = $scope.innerLinks[0];
			}
		};
		//联系中文本及号码的设置
		$scope.btnText = '';
		$scope.btnLink = '';
		$scope.changeBtnText = function(a){
			if(wsh.element){
				wsh.element.text(a);
				$scope.$emit('sync');
			}
		};
		$scope.changeBtnLink = function(a){
			if(wsh.element){
				wsh.element.attr('href', a);
				if(typeof a == 'string'){
					a.length >= 11 ? (/^(1[3|4|5|8]\d{9}|0755[\d]{7,8}|400[\d]{7})$/).test(a) ? void 0 : alert('电话号码错误') : void 0;
				}
				$scope.$emit('sync');
			}
		};
		//颜色属性数组  一般的文本  字体  填充  边框都是用此数组
		$scope.textColorIndex = -1;
		$scope.textColors = [{className: 'color color-picker-none', color: 'none'},
							 {className: 'color color-picker-white', color: '#fff'},
							 {className: 'color color-picker-darkgray', color: '#a9a9a9'},
							 {className: 'color color-picker-gray', color: '#808080'},
							 {className: 'color color-picker-black', color: '#000'},
							 {className: 'color color-picker-pink', color: '#f25c93'},
							 {className: 'color color-picker-lightblue', color: '#71a8d9'},
							 {className: 'color color-picker-red', color: '#b60927'},
							 {className: 'color color-picker-orange', color: '#da5525'},
							 {className: 'color color-picker-yellow', color: '#f59c00'},
							 {className: 'color color-picker-green', color: '#01a187'},
							 {className: 'color color-picker-blue', color: '#217fbc'},
							 {className: 'color color-picker-indigo', color: '#334960'},
							 {className: 'color color-picker-purple', color: '#913eb0'}];
		//背景颜色属性数组
		$scope.backgroundColorIndex = -1;
		$scope.backgroundColors = [{className: 'color color-picker-none', color: 'none'},
								   {className: 'color color-picker-white', color: '#fff'},
								   {className: 'color color-picker-darkgray', color: '#a9a9a9'},
								   {className: 'color color-picker-gray', color: '#808080'},
								   {className: 'color color-picker-black', color: '#000'},
								   {className: 'color color-picker-pink', color: '#f25c93'},
								   {className: 'color color-picker-lightblue', color: '#71a8d9'},
								   {className: 'color color-picker-red', color: '#b60927'},
								   {className: 'color color-picker-orange', color: '#da5525'},
								   {className: 'color color-picker-yellow', color: '#f59c00'},
								   {className: 'color color-picker-green', color: '#01a187'},
								   {className: 'color color-picker-blue', color: '#217fbc'},
								   {className: 'color color-picker-indigo', color: '#334960'},
								   {className: 'color color-picker-purple', color: '#913eb0'},
								   {className: 'color color-picker-light-red', color: '#ff6a66'},
								   {className: 'color color-picker-dark-orange', color: '#dd8472'},
								   {className: 'color color-picker-dark-yellow', color: '#ceb082'},
								   {className: 'color color-picker-light-green', color: '#2ad1bb'},
								   {className: 'color color-picker-light-indigo', color: '#657d9f'},
								   {className: 'color color-picker-light-purple', color: '#aba4f4'},
								   {className: 'color color-picker-dark-purple', color: '#4e2961'},];
		//文本颜色选择函数
		$scope.textColorChoose = function(eve, index){
			var color = $scope.textColors[index].color;
			if(wsh.element){
				wsh.element.css('color', color);
				$scope.$emit('sync');
			}
		};
		//背景填充色选择函数
		$scope.backColorChoose = function(eve, index){
			var color = $scope.textColors[index].color;
			if(wsh.element){
				wsh.element.css('background-color', color);
				$scope.$emit('sync');
			}
		};
		//边框颜色选择函数
		$scope.borderColorChoose = function(eve, index){
			var color = $scope.textColors[index].color;
			if(wsh.element){
				wsh.element.css('border-color', color);
				$scope.$emit('sync');
			}
		};
		//背景面板 背景色块的点击函数
		$scope.changeBackground = function(index){
			$('.pages').children().eq($scope.childPageActive).css('background-color', $scope.backgroundColors[index].color);
			$scope.$emit('sync');
		};
		//行高选择属性
		$scope.lineHeight = 28;
		$scope.changeLineHeight = function(a){
			if(wsh.element){
				wsh.element.css('line-height', a + 'px');
				$scope.$emit('sync');
			}
		};
		//图片配置中的 预览图片
		$scope.previewSrc = 'http://imgcache.vikduo.com/static/4c4552dbbe45c2af0a3ed4da4bd8da87.png';
		//动画持续时间设置
		$scope.duration = 1;
		$scope.changeDuration = function(a){
			if(wsh.element){
				wsh.element.attr('data-duration', a);
			}
		};
		//动画延时时间设置
		$scope.delay = 1;
		$scope.changeDelay = function(a){
			if(wsh.element){
				wsh.element.attr('data-delay', a);
			}
		};
		//配置点击
		$scope.showMenu = -1;
		$scope.items = [{title: '修改杂志配置', dataTitle: '配置', className: 'fa-left fa-cog'},
						{title: '点击生成文本', dataTitle: '文本', className: 'fa-left fa-text-width'},
						{title: '修改背景', dataTitle: '背景', className: 'fa-left fa-image'},
						{title: '点击生成图片', dataTitle: '图片', className: 'fa-left fa-image'},
						{title: '点击生成图形', dataTitle: '图形', className: 'fa-left fa-th-large'},
						{title: '点击生成特效', dataTitle: '特效', className: 'fa-left fa-magic'},
						{title: '点击生成表单', dataTitle: '表单', className: 'fa-left fa-file-text'},
						{title: '联系', dataTitle: '联系', className: 'fa-left fa-phone-square'}];

		//动画选择
		$scope.effectsIndex = -1;
		$scope.effects = [{effectname: '清除动画', effect: 'effectclear', effShow: true},
						  {effectname: '从左飞入', effect: 'fromleft', effShow: true},
						  {effectname: '从下飞入', effect: 'frombottom', effShow: true},
						  {effectname: '从右飞入', effect: 'fromright', effShow: true},
						  {effectname: '从上飞入', effect: 'fromtop', effShow: true},
						  {effectname: '淡出', effect: 'fade', effShow: true},
						  {effectname: '旋转', effect: 'rotation', effShow: true},
						  {effectname: '旋转2D', effect: 'rotation2d', effShow: true},
						  {effectname: '跳跃', effect: 'bounceIn', effShow: true},
						  {effectname: '雨滴', effect: 'rainy', effShow: false},
						  {effectname: '从大到小', effect: 'show', effShow: true},
						  {effectname: '从小到大', effect: 'small2big', effShow: true},
						  {effectname: '擦除', effect: 'erase', effShow: false},
						  {effectname: '抖动', effect: 'jitter', effShow: true},
						  {effectname: '闪烁', effect: 'light', effShow: true},
						  {effectname: '从左淡出', effect: 'fadeFromLeft', effShow: true},
						  {effectname: '从下淡出', effect: 'fadeFromBottom', effShow: true},
						  {effectname: '从右淡出', effect: 'fadeFromRight', effShow: true},
						  {effectname: '从上淡出', effect: 'fadeFromTop', effShow: true}];	
		$scope.$on('show effects', function(e){
			$scope.showMenu = 17;
		});	
		//接收显示虚线框事件
		$scope.$on('show line', function(event, ele){
			event.stopPropagation();
			//公共属性
			$scope.public.left = ele.offset().left;
			$scope.public.top = ele.offset().top;
			$scope.public.width = ele.width() + +ele.css('padding-left').replace('px', '') + +ele.css('padding-right').replace('px', '');
			$scope.public.height = ele.height() + +ele.css('padding-top').replace('px', '') + +ele.css('padding-bottom').replace('px', '');
			$scope.public.opacity = ele.css('opacity') ? ((+ele.css('opacity')).toFixed(2) * 100) : 100;
			$scope.public.rotate = ele.attr('rotatez') ? parseInt(ele.attr('rotatez')) : 0;
			$scope.frameShow = true;
			//回传选中手机区域的 .component 并判断左侧配置需要显示的对象
			$(".create-toolbar-list").find(".tool").eq(6).removeClass("active");
			if(ele.is('.text')){
				$scope.showMenu = 1;
				//字体大小
				setFont(ele);
				setLink(ele);
			}
			if(ele.is('.btn')){
				$scope.showMenu = 4;
				setBtnText(ele);
				setBorder(ele);
				setLink(ele);
			}
			if(ele.is('.btnC')){
				$scope.showMenu = 7;
				setContactText(ele);
				setFont(ele);
			}
			if(ele.is('.form')){
				$scope.showMenu = 16;
				$(".create-toolbar-list").find(".tool").eq(6).addClass("active");
			}
			if(ele.is('img')){
				$scope.showMenu = 3;
				setLink(ele);
				setPicture(ele);
			}
			setAnimate(ele);
		});
		//接收隐藏虚线框事件
		$scope.$on('hide line', function(event){
			event.stopPropagation();
			$scope.frameShow = false;
		});
		//回传的图片 src 地址
		function setPicture(ele){
			$scope.previewSrc = ele.attr('src');
		}
		//回传动画属性
		function setAnimate(ele){
			$scope.duration = ele.attr('data-duration') ? +ele.attr('data-duration') : void 0;
			$scope.delay = ele.attr('data-delay') ? +ele.attr('data-delay') : void 0;
			if(!ele.attr('data-animation')){
				$scope.effectsIndex = -1;
				return;
			} 
			wsh.animation = ele.attr('data-animation');
			$scope.effects.forEach(function(i, e){
				if(i.effect == wsh.animation){
					$scope.effectsIndex = e;
					return;
				}
			});
		}
		//回传的联系文字 及号码
		function setContactText(ele){
			//文字
			$scope.btnText = ele.text();
			$scope.btnLink = ele.attr('href');
		}
		//回传的图形文字
		function setBtnText(ele){
			$scope.btnshapeText = ele.text() ? ele.text() : '';
		}
		//回传的边框 圆角 属性
		function setBorder(ele){
			//边框
			wsh.border = ele.css('border-width') ? +(ele.css('border-width').replace('px', '')) : 0;
			$scope.borderWidth.forEach(function(i, e){
				if(i.Border == wsh.border){
					wsh.borderIndex = e;
					return;
				}
			});
			$scope.borderWidthSelecd = $scope.borderWidth[wsh.borderIndex];
			//圆角
			wsh.radius = ele.css('border-width') ? +(ele.css('border-radius').replace('px', '')) : 0;
			$scope.roundCorner.forEach(function(i, e){
				if(i.Round == wsh.radius){
					wsh.radiusIndex = e;
					return;
				}
			});
			$scope.roundCornerSelecd = $scope.roundCorner[wsh.radiusIndex];
		}
		//回传的内链 外链 设置
		function setLink(ele){
			wsh.innerLink = ele.attr('data-page');
			wsh.outLink = ele.attr('link');
			if(wsh.innerLink){
				//内链
				$scope.linkSelecd = $scope.Links[0];
				$scope.innerLinks.forEach(function(i, e){
					if(i.Link == wsh.innerLink){
						wsh.innerLinksIndex = e;
						return;
					}
				});
				$scope.innerLinkSelecd = wsh.innerLinksIndex == -1 ?$scope.innerLinks[0] : $scope.innerLinks[wsh.innerLinksIndex];
				$scope.outLink = '';
			}else if(wsh.outLink){
				//外链
				$scope.linkSelecd = $scope.Links[1];
				$scope.outLink = wsh.outLink;
				$scope.innerLinkSelecd = $scope.innerLinks[0];
			}else{
				//内外链都没有的情况
				$scope.linkSelecd = $scope.Links[0];
				$scope.innerLinkSelecd = $scope.innerLinks[0];
				$scope.outLink = '';
			}
		}
		//回传的字体样式设置
		function setFont(ele){
			wsh.size = ele.css('font-size') ? ele.css('font-size').replace('px','') : 12;
			$scope.fontSize.forEach(function(i, e){
				if(i.size == wsh.size){
					wsh.sizeIndex = e;
					return;
				}
			});
			$scope.fontSizeSelecd = wsh.sizeIndex == -1 ?$scope.fontSize[2] : $scope.fontSize[wsh.sizeIndex];
			//字体样式
			wsh.font = ele.css('font-family') ? ele.css('font-family') : '黑体';
			$scope.fontFamily.forEach(function(i, e){
				if(i.font == wsh.font){
					wsh.fontIndex = e;
					return;
				}
			});
			$scope.fontFamilySelecd = wsh.fontIndex == -1 ?$scope.fontFamily[0] : $scope.fontFamily[wsh.fontIndex];
			//行高
			$scope.lineHeight = ele.css('line-height') ? parseInt(ele.css('line-height').replace('px', '')) : 28;
		}
		//底图数组
		$scope.pages = [];
		$scope.childPageActive = -1;
		//接收应用开始事件 isfirst 表示是否为第一次进入微杂志所做标识  为做历史记录
		$scope.$on('app Activated', function(event, data, isfirst, callback, ishistory){console.log(data);
			$scope.childPageActive = -1;
			data.musicName = !data.musicName ? '请选择MP3格式(≤3MB)的文件。' : data.musicName;
			data.imgUrl = !data.imgUrl ? 'http://imgcache.vikduo.com/static/4c4552dbbe45c2af0a3ed4da4bd8da87.png' : data.imgUrl;
			data.shareLogo = data.shareLogo == '' ? 'http://imgcache.vikduo.com/static/4c4552dbbe45c2af0a3ed4da4bd8da87.png' : data.shareLogo;
			data.content = !data.content ? MainHtml() : data.content;
			$scope.data = data;
			$scope.data.musicStr = data.musicName.substr(0, 8) + '...';
			$scope.data.musicUrl = ishistory ? $scope.data.musicUrl : $sce.trustAsResourceUrl($scope.data.musicUrl);
			if(data.is_show_icon == 1){
				$scope.chk = true;
			}else{
				$scope.chk = false;
			}
			// 加载音乐  
			if(data.musicUrl != ''){
				var audio = $('#upfileResults').find('audio')[0];
				audio.load();
				audio.oncanplaythrough = function(){
					audio.play();
					wsh.pauseMusic.show();
					wsh.cancelMusic.show();
				}
			}
			//分类设置
			$('#app-category').find('option').each(function(i, e) {
                var value = $(e).val();
				if(value == data.category_id){
					$(e).attr('selected', 'selected');
				}
            });
			$scope.$emit('sync', data.content, null, ishistory);
			isfirst ? (wsh.dataFirst = data, wsh.historyArray = [], wsh.historyArray.push(data), $rootScope.historyArray = [], $rootScope.historyArray[0] = {}, $rootScope.historyArray[0].time = wsh.getdate()) : void 0;
			wsh.musicList = data.musicList;
			$scope.showMenu = 0;
			// 新手引导功能 的展示
			if((wsh.isFirst || window.location.hash == '#add') && wsh.isIntroudction){
				$('.introduction').show();
				$rootScope.guideIndex = 1; //用于显示新手引导
			}
			if(typeof callback == 'function'){
				callback.call(this);
			}
		});
		function MainHtml(){
			var str = '';
			str += '<section class="page" data-direction="vertical" version="andy"></section>';
			return str;
		}
		//接收保存事件 wsh.saveObj 接收保存而来的参数设置 
		$scope.$on('save app data', function(eve, obj, callback){
			wsh.saveObj._id = obj ? obj._id : $scope.data._id;
			wsh.saveObj.category_id = obj ? obj.category_id : $('#app-category option:selected').val();
			wsh.saveObj.shareDesc = obj ? obj.shareDesc : $scope.data.shareDesc;
            wsh.saveObj.shareLogo = obj ? obj.shareLogo : $scope.data.shareLogo ? $scope.data.shareLogo : '';
			wsh.saveObj.face = obj ? obj.imgUrl : $scope.data.imgUrl;
			wsh.saveObj.content = obj ? obj.content : $('.pages').html();
			wsh.saveObj.musicUrl = obj ? obj.musicUrl : wsh.musicUrl.attr('src');
			wsh.saveObj.musicName = obj ? obj.musicName : wsh.musicName.attr('title');
			wsh.saveObj.title = obj ? obj.title : $scope.data.title;
			wsh.saveObj.is_show_icon = obj ? obj.is_show_icon : $scope.chk == true ? 1 : 0;
			wsh.saveObj.version = '2.1.8';
			sendAppData(wsh.saveObj, callback);
			
			wsh.saveObj = {};
			//  开启自动保存   自动保存了一次之后 将会暂时冻结  直到手动点击保存之后才会激活
			wsh.autoSave = null;
			wsh.isAutoSave ? void 0 :
			wsh.autoSave = setTimeout(function(){
				wsh.isAutoSave = true;
				$scope.$emit('save app data', null, function(){
					wsh.isAutoSave = false;
				});
			}, 6e5);
		});
		//保存函数  发送$http 请求
		function sendAppData(data, callback){
			$("#nav-save-weza").text("保存中");
			$http.post(wsh.DATA_BASE + '/save/' + data._id, data).success(function(Data){
				var a, b, tips;
				if (Data && Data.result === "OK") {
					tips = "已保存";
					$scope.$emit('appHistory', data);
				} else {
					tips = "保存失败";
					alert("保存失败");
				}
				if(typeof callback == 'function'){
					callback.call(this);
				}
				return b = function() {
					return $("#nav-save-weza").text(tips)
				}, setTimeout(b, 1e3), a = function() {
					return $("#nav-save-weza").html('<i class="fa fa-floppy-o"></i><span>保存</span>')
				}, setTimeout(a, 1500)
			}).error(function(data, state){
				alert("保存失败");
				var tips = "保存失败";
				if(typeof callback == 'function'){
					callback.call(this);
				}
				return b = function() {
					return $("#nav-save-weza").text(tips)
				}, setTimeout(b, 1e3), a = function() {
					return $("#nav-save-weza").html('<i class="fa fa-floppy-o"></i><span>保存</span>')
				}, setTimeout(a, 1500);
			});
		}
	}).directive('pages', function($sce, $http, $compile, $rootScope){
		//手机区域的自定义指令
		return {
			restrict: 'AE',
			replace: true,
			template: '<div class="pages"></div>',
			link: function(scope, elem, attrs) {
				var that = scope;
				scope.$on('sync', function(eve, content, callback, ishistory){
					sync(content, callback, ishistory);
				});
				//同步手机区域及底图的代码
				function sync(a, callback, ishistory){
					if(a){
						a = changeData.change(a);
						$(elem).html(a);
					}
					scope.pages = [];
					scope.innerLinks = []
					
					$(elem).find('.page').each(function(i, e){
						$(e).css({'height': '100%', 'width': '100%'});
						scope.pages[i] = {};
						//同步内链属性
						scope.innerLinks[i + 1] = {Link: (i + 1)};
						scope.pages[i].html = $sce.trustAsHtml(restorHTML(e.outerHTML));
						scope.pages[i].isEffect = $(e).attr('iseffect') == 'true';
						if(a){
							scorllBefore($(e));
						}
						scope.chk ? $(e).attr('data-chk', 'true') : $(e).attr('data-chk', 'false');
						
					});
					$('#page_total').css('width', 110 * scope.pages.length + 'px');
					a ? that.gotoPage(null, 0) : void 0;
					ishistory ? scope.$apply() : void 0;
					if(typeof callback == 'function'){
						callback.call(this);
					}
				}
				function restorHTML(string){
					var div = $(string);
					div.css('top', 0);
					div.children().each(function(i, e){
						$(e).css('opacity', $(e).attr('opacity'));
						var rotateZ = 0;
						if($(e).attr('rotatez')){
							rotateZ	= +$(e).attr('rotatez');
						}else{
							$(e).attr('rotatez', 0);
						}
						setAnimateStyle($(e), rotateZ);
					});
					return div[0].outerHTML;
				}
				//离开之前所做的提示框框
				/*window.onbeforeunload = function() {
					if (location.hash != "#add" && location.hash != "") {
						return "离开此页将可能丢失您未保存的数据？";
					}
				}*/
				//右键菜单 显示 或者 隐藏
				$(document).bind("contextmenu", '#page_total li, .pages .component', function(a){
					if($(a.target).parents().is('.pages') && !$(a.target).is('section')){
						a.preventDefault();
						wsh.createMenuTarget = $(a.target);
						scope.createMenuOffset.left = a.clientX;
						scope.createMenuOffset.top = a.clientY;
						scope.isForm = true;
						if($(a.target).is('.form')){
							scope.isForm = false;
						}
						scope.createMenu = true;
					}else if($(a.target).parents().is('#page_total')){
						a.preventDefault();
						wsh.pageMenuTarget = $(a.target);
						scope.pageMenuOffset.left = a.clientX;
						scope.pageMenuOffset.top = scope.copyElement ? a.clientY - (30 * 4) : a.clientY - (30 * 3) ;
						scope.pageMenu = true;
					}else{
						wsh.createMenuTarget = wsh.pageMenuTarget = null;
						scope.createMenu = scope.pageMenu = false;
					}
					scope.$apply();
				});
				//表单属性设置 取消按纽
				scope.closeForm = function(){
					scope.showMenu = -1;
					$('.form-container').find('input[type="text"]').val('');
					var text_length = $('.form-container').find('input[type="text"]').length;
					if(text_length > 4){  //remove p
						for(var h = 2; h < text_length - 2; h++){
							$('.form-container').find('p').eq(2).remove();
						}
						$('.form-container').find('p').eq(2).find('span').text('第2行标题');
					}else if(text_length == 3){  //append p
						var str = '<p><span>第2行标题</span><input type="text" class="line-title" placeholder="行标题最多5个文字" ng-maxlength="5"/><i class="fa fa-trash-o" title="删除行" ng-click="deleteRow($event)"></i></p>';
						var delete_compile = $compile(angular.element(str))(scope);
						angular.element($('.form-container').find('p').eq(1)).after(delete_compile);
					}else{
						console.log("已经是初始状态了，不用做其他操作！");
					}
				};
				//表单确认 发送$http请求
				scope.confirmForm = function(){
					var array = [], isOk = true;  //isOK点击确定按钮是否提交
					var count = $('.form-container').find('input[type="text"]').length;
					var j = null, d = [], b = null, form = $('<div id="currentForm" class="component form form_p" style="width: 320px; min-height: 120px; opacity: 0.8;"></div>'), str = '';
					$('.form-container').find('input[type="text"]').each(function(i, e) {
						if(i == 0){
							if($(e).val() == '' || $(e).val().length > 20){
								isOk = false;
								return;
							}else{
								j = $(e).val();
								str += '<p class="component title form_p">' +j+ '</p>';
							}
						}else{
							if($(e).val() == '' || $(e).val().length > 5){
								isOk = false;
								return;
							}else{
								if(i != count - 1){
									d[i-1] = {};
									d[i-1].name = 'p' + i; 
									d[i-1].label = $(e).val();
									str += '<p class="component form-row form_p"><input type="text" class="component form_p" name=p' +(i)+ '><span class="form_p">' +$(e).val()+ ':</span></p>';
								}else{
									b = $(e).val();
									str += '<a class="form-btn component form_p">' +$(e).val()+ '</a>'
								}
							}
						}
					});
					if(isOk){
						var obj = {
							struct: JSON.stringify({
								title: j, 
								content: d, 
								button: b, 
								mid: $.cookie('App Id')
							})
						};
						// ajax请求
						$.ajax({
							url: wsh.DATA_BASE + "/createForm",
							type: "POST",
							data: obj,
							dataType: "json",
							success: function(a) {
								if(scope.pages.length){
									form.html(str);
									form.attr('id', a._id);
									setAnimateStyle(form);
									$(elem).find('.page').eq(scope.childPageActive).append(form);
									var count = $(elem).find('.page').eq(scope.childPageActive).children().length;
									form.css('z-index', count);
									showLine(form);
									getBorderElement();
									scope.$emit('save app data');
									scope.$apply();
									sync();
								}else{
									alert('请新建页面，再继续操作');
								}
							}
						});
					}else{
						alert("请把信息填写完整！");
						return;
					}

					scope.showMenu = -1;
					$('.form-container').find('input[type="text"]').val('');
					var text_length = $('.form-container').find('input[type="text"]').length;
					if(text_length > 4){  //remove p
						for(var h = 2; h < text_length - 2; h++){
							$('.form-container').find('p').eq(2).remove();
						}
						$('.form-container').find('p').eq(2).find('span').text('第2行标题');
					}else if(text_length == 3){  //append p
						var str = '<p><span>第2行标题</span><input type="text" class="line-title" placeholder="行标题最多5个文字" ng-maxlength="5"/><i class="fa fa-trash-o" title="删除行" ng-click="deleteRow($event)"></i></p>';
						var delete_compile = $compile(angular.element(str))(scope);
						angular.element($('.form-container').find('p').eq(1)).after(delete_compile);
					}else{
						console.log("已经是初始状态了，不用做其他操作！");
					}
				};
				//增加行数
				scope.addRow = function(eve){
					var count = $('.form-container').find('input[type="text"]').length;
					if(count < 7 && count != 3){
						var element = $(eve.target).parents('p');
						var copy = element.clone();
						copy.find('span').text('第' +(count - 2)+ '行标题');
						copy.find('i').remove();
						$('.form-container').find('p').eq(count - 3).after(copy);
						if($('.form-container').find('i').eq(1).length == 1){   //如果有删除按钮
							$('.form-container').find('i').eq(1).parents('p').find('span').text('第' +(count-1)+ '行标题');   //改变删除按钮的标题
							$('.form-container').css('margin-top', -($('.form-container').height()/2) + 'px');
						}
					}else if(count == 3){
						var element = $(eve.target).parents('p');
						var copy = element.clone();
						copy.find('span').text('第2行标题');
						copy.find('i').remove();
						$('.form-container').find('p').eq(1).after(copy);
						if($('.form-container').find('i').eq(1).length == 0){
							var delete_str = '<i class="fa fa-trash-o" title="删除行" ng-click="deleteRow($event)"></i>';
							var delete_compile = $compile(angular.element(delete_str))(scope);
							angular.element($('.form-container').find('p').eq(2)).append(delete_compile);
						}
						$('.form-container').css('margin-top', -($('.form-container').height()/2) + 'px');
					}else{
						alert("标题最多可以添加5行");
					}
				};
				//删除行数
				scope.deleteRow = function(eve){
					var count = $('.form-container').find('input[type="text"]').length;
					var element = $(eve.target).parents('p');
					if(count > 4){
						element.find('span').text('第' +(count - 3)+ '行标题');
						$('.form-container').find('p').eq(count - 3).remove();
					}else if(count = 4){
						$('.form-container').find('p').eq(count - 2).remove();
					}
					$('.form-container').css('margin-top', -($('.form-container').height()/2) + 'px');
				};
				//右键菜单的点击函数
				scope.pageMenuClick = function(index){
					switch(index){
						case 0:
						//上移一页
						var ii = +(wsh.pageMenuTarget.parents('li').find('.page-num').text()) - 1;
						if(ii == 0){
							wsh.quickDialog('已经是第一页');
						}else{
							var element = $(elem).find('.page').eq(ii);
							var ele = $(elem).find('.page').eq(ii - 1);
							ele.before(element);
							sync(null, function(){
								scorllBefore(element, function(){
									that.gotoPage(null, ii - 1);
								});
							});
						} 
						break;
						case 1:
						//下移一页
						var ii = +(wsh.pageMenuTarget.parents('li').find('.page-num').text()) - 1;
						if(ii == scope.pages.length - 1){
							wsh.quickDialog('已经是最后一页');
						}else{
							var element = $(elem).find('.page').eq(ii);
							var ele = $(elem).find('.page').eq(ii + 1);
							ele.after(element);
							sync(null, function(){
								scorllBefore(element, function(){
									that.gotoPage(null, ii + 1);
								});
							});
						}
						
						break;
						case 2:
						//复制一页
						var ii = +(wsh.pageMenuTarget.parents('li').find('.page-num').text()) - 1;
						var element = $(elem).find('.page').eq(ii);
						element.after(element.clone(true));
						sync(null, function(){
							that.gotoPage(null, ii + 1);
						});
						break;
						case 3:
						//粘贴至页面
						wsh.setNoAjaxDialog('粘贴提示', '确实要将该元素粘贴至该页面吗?', function(){
							var ii = +(wsh.pageMenuTarget.parents('li').find('.page-num').text()) - 1;
								$(elem).find('.page').eq(ii).append(scope.copyElement);
								var count = $(elem).find('.page').eq(ii).children().length;
								scope.copyElement.css('z-index', count);
								setAnimateStyle(scope.copyElement);
								that.gotoPage(null, ii);
								sync();
						});
						break;
					}
					scope.createMenu = scope.pageMenu = false;
				}
				$(document).on('keydown', function(e){
					//复制组合键
					if(e.keyCode == 67 && e.ctrlKey){
						if(wsh.element){
							that.createMenuClick(5);
						}
						return;
					}
					//粘贴组合键
					if(e.keyCode == 86 && e.ctrlKey){
						if(scope.copyElement){
							wsh.setNoAjaxDialog('粘贴提示', '确实要将该元素粘贴至该页面吗?', function(){
								var element = scope.copyElement.clone(true);
								var left = element.css('left') == 'auto' ? 0 : +(element.css('left').replace('px', ''));
								var top = element.css('top') == 'auto' ? 0 : +(element.css('top').replace('px', ''));
								element.css({'left': (left + 10) + 'px', 'top': (top + 10) + 'px'});
								$(elem).find('.page').eq(scope.childPageActive).append(element);
								var count = $(elem).find('.page').eq(scope.childPageActive).children().length;
								element.css('z-index', count);
								setAnimateStyle(element);
								sync();
							});
						}
						return;
					}
					var moveDistance = 1;
					if(e.shiftKey){
						moveDistance = 10;		
					}
					if(wsh.element){
						switch(e.keyCode){
							case 37:
							//左
							var left = wsh.element.css('left') == 'auto' ? 0 : +(wsh.element.css('left').replace('px', ''));
							wsh.element.css('left', (left - moveDistance) + 'px');
							scope.public.left -= moveDistance;
							break;
							case 39:
							//右
							var left = wsh.element.css('left') == 'auto' ? 0 : +(wsh.element.css('left').replace('px', ''));
							wsh.element.css('left', (left + moveDistance) + 'px');
							scope.public.left += moveDistance;
							break;
							case 38:
							//上
							var top = wsh.element.css('top') == 'auto' ? 0 : +(wsh.element.css('top').replace('px', ''));
							wsh.element.css('top', (top - moveDistance) + 'px');
							scope.public.top -= moveDistance;
							break;
							case 40:
							//下
							var top = wsh.element.css('top') == 'auto' ? 0 : +(wsh.element.css('top').replace('px', ''));
							wsh.element.css('top', (top + moveDistance) + 'px');
							scope.public.top += moveDistance;
							break;
						}
						scope.$apply();
					}
				});
				scope.createMenuClick = function(index){
					switch(index){
						//置于顶层
						case 0:
						var ii = +wsh.createMenuTarget.css('z-index');
						var length = wsh.createMenuTarget.parents('.page').children().length;
						if(ii == length){
							wsh.quickDialog('已经是最顶层了');
						}else{
							wsh.createMenuTarget.parents('.page').children().each(function(i, e){
								var iii = +$(e).css('z-index');
								if(iii > ii){
									$(e).css('z-index', iii - 1);
								}
							});
							wsh.element.css('z-index', length);
						}
						break;
						//上移一层 z-index 属性值会加1  对应的上层对象 z-index属性会减1
						case 1:
						var ii = +wsh.createMenuTarget.css('z-index');
						var length = wsh.createMenuTarget.parents('.page').children().length;
						if(ii == length){
							wsh.quickDialog('已经是最顶层对象，无法上移');
						}else{
							var element = getIndex(wsh.createMenuTarget.parents('.page'), ii + 1);
							wsh.createMenuTarget.css('z-index', ii + 1);
							element ? element.css('z-index', ii) : void 0;
						}
						break;
						//下移一层  z-index 属性值会减1  对应的上层对象 z-index属性会加1
						case 2:
						var ii = +(wsh.createMenuTarget.css('z-index'));
						if(ii == 1){
							wsh.quickDialog('已经是最底层对象，无法下移');
						}else{
							var elem = getIndex(wsh.createMenuTarget.parents('.page'), ii - 1);
							wsh.createMenuTarget.css('z-index', ii - 1);
							elem ? elem.css('z-index', ii) : void 0;
						}
						break;
						//置于底层
						case 3:
						var ii = +wsh.createMenuTarget.css('z-index');
						if(ii == 1){
							wsh.quickDialog('已经是最底层了');
						}else{
							wsh.createMenuTarget.parents('.page').children().each(function(i, e){
								var iii = +$(e).css('z-index');
								if(iii < ii){
									$(e).css('z-index', iii + 1);
								}
							});
							wsh.element.css('z-index', 1);
						}
						break;
						//对齐功能
						case 4:
						//定义在eff.js这个动画js内
						//eff.Align(wsh.element.parents('.page'), wsh.element);
						//wsh.quickDialog('请单击选择同一页面内的对齐参照元素');
						break;
						//复制 复制到底图功能
						case 5:
						scope.copyElement = wsh.element.clone(true);
						wsh.quickDialog('已将该元素复制到粘贴板');
						break;
						case 6:
						
						break;
						//删除
						case 7:
						wsh.setNoAjaxDialog('组件删除提示', '确实要删除该组件吗?', function(){
							scope.elementCount--;
							wsh.createMenuTarget.remove();
							scope.$emit('hide line');
							sync();
							scope.$emit('save app data');
						});
						break;
					}
					scope.createMenu = scope.pageMenu = false;
				};
				//用z-index属性去获取对象的方法 ele为需要遍历的元素 index 为 z-index 的索引值
				function getIndex(ele, index){
					var element;
					ele.children().each(function(i, e) {
                        var ii = $(e).css('z-index') ? +$(e).css('z-index') : 0;
						if(ii == index){
							element = $(e);
						}
                    });
					return element;
				}
				//特效点击 
				scope.pageEffect = function(index){
					var data = { tx: index };
					getPage(data, true);
				};
				//右侧模板点击函数
				scope.pageTemplete = function(eve){
					var data = {pid: $(eve.target).attr('page-id')};
					getPage(data);
				};
				//发送 $http 请求页面函数
				function getPage(data, boo){
					$.ajax({
						url: wsh.DATA_BASE + '/getPage',
						type: 'POST',
						dataType: 'json',
						data: data,
						success: function(a){
							if(a.success == 1){
								that.pageAdd(changeData.changeOne(a.msg.content, boo));
							}
						}
					})
				};
				//底部添加页面点击函数
				scope.pageAdd = function(string, str){
					if(!string){
						var white = 0;
						string = string ? string : '<section class="page" version="andy"></section>';
						//删除空白页面
						$(elem).children().each(function(i, e) {
							if(!$(e).children().length && $(e).css('background-image') == 'none'){
								//that.deletePage(i, true);
								white++;
							}
						});
						if(white){
							wsh.quickDialog('存在空白页面，请向空白页面添加组件，否则无法继续添加页面');
							return;
						}
					}
					$(elem).append(string);
					var length = $(elem).children().length;
					if(110 * length > wsh.editWidth){
						$('#page_total').animate({left: (wsh.editWidth - 110 * length) + 'px'}, 1000);
					}
					//同步页面并回调函数
					sync(null, function(){
						var length = scope.pages.length;
						if(str) scope.pages[length - 1].isEffect = true;
						that.gotoPage(null, length - 1);
					});
					scope.$emit('save app data');
				};
				//底部删除页面 boo 用来判断是否需要弹框删除
				scope.deletePage = function(index, boo){
					if(boo){
						$(elem).children().eq(index).remove();
						var length = $(elem).children().length;
						sync();
						if(110 * length > wsh.editWidth){
							$('#page_total').animate({left: (wsh.editWidth - 110 * length) + 'px'}, 1000);
						}
						that.gotoPage(null, index - 1);
						scope.$emit('save app data'); 
					}else{
						var content = "<p>您是否确认删除第<span class=txt_blue>[" + (index + 1) + "]</span>页的内容？</p>";
						wsh.setNoAjaxDialog('删除提示', content, function(){
							scope.innerLinks.splice(index + 1, 1);
							var element = $(elem).children().eq(scope.childPageActive);
							$(elem).children().eq(index).remove();
							var length = $(elem).children().length;
							sync();
							if(110 * length > wsh.editWidth && index == scope.pages.length - 1){
								$('#page_total').animate({left: (wsh.editWidth - 110 * length) + 'px'}, 1000);
							}
							index != 0 ? that.gotoPage(null, index - 1, element) : void 0;
							scope.$emit('save app data'); 
						})
					}
				};
				//底图点击函数
				scope.gotoPage = function(eve, index, element){
					if(index != scope.childPageActive){
						if($('#pageStyle').length){
							$('#pageStyle').text('');
						}
						var ele, element, string, top;
						if(scope.childPageActive != -1){
							ele = element ? element : $(elem).find('.page').eq(scope.childPageActive);
						}
						scope.childPageActive = index;
						scope.elementCount = $(elem).find('.page').eq(scope.childPageActive).children().length;
						//scope.$apply();
						element = $(elem).find('.page').eq(index);
						//string = scope.slideArray[scope.slideIndex].slide;
						//页面过渡效果设置   定义在 eff.js 中
						/*translatePage.gotoPage({
							currentElement: element,
							prevElement: ele,
							slideString: string,
							complete: function(){
								element.siblings().css('z-index', 0);
								element.css('z-index', 1);
								
								scorllAfter(element);
								ele ? scorllBefore(ele) : void 0;
							}
						});*/
						if(ele && ele.index() > element.index()){
							top = -504;
						}else{
							top = 504;
						}
						
						element.css({'top': top + 'px', 'z-index': 2});
						
						element.animate({top : 0}, 300, function(){
							element.siblings().css('z-index', 0);
							element.css('z-index', 1);
							scorllAfter(element);
							ele ? scorllBefore(ele) : void 0;
						});
						if(eve){
							var left = +($('#page_total').css('left').replace('px' ,''));
							left = left ? left : 0;
							var x = (eve.clientX - wsh.editLeft) - wsh.editWidth/2;
							if(x > 110){
								x = Math.floor(x/110) * 110;
								var maxLeft = scope.pages.length * 110 - wsh.editWidth + left;
								x = x > maxLeft ? maxLeft : x;
								x > 0 ? $('#page_total').animate({left: '-=' + x + 'px'}, 1000) : void 0;
							}else if(x < -110){
								x = Math.ceil(x/110) * 110;
								x = x > left ? x : left;
								x != 0 ? $('#page_total').animate({left: '+=' + Math.abs(x) + 'px'}, 1000) : void 0;
							}
						}
					}
				};
				//加载动画函数
				function scorllAfter(ele){
					ele.children().each(function(i, e) {
                        var obj = {};
						obj.rotateZ = $(e).attr('rotateZ') ? +$(e).attr('rotateZ') : 0;
						obj.animation = $(e).attr('data-animation');
						obj.duration = $(e).attr('data-duration') ? +$(e).attr('data-duration') : 1;
						obj.delay = $(e).attr('data-delay') ? +$(e).attr('data-delay') : 0.2;
						obj.opacity = parseFloat($(e).attr('opacity'));
						obj.animate = 'page' + scope.childPageActive + i;
						if(obj.animation == 'rotation2d' || obj.animation == 'bounceIn' || obj.animation == 'jitter' || obj.animation == 'light'){
							eff.setHeadStyle(obj.animate, obj.animation, obj.rotateZ, obj.opacity);
						}
						var index = eff.animateName.indexOf(obj.animation);
						if(index != -1) eff.animateArray[index]($(e), obj.rotateZ, obj);
						obj = {};
                    });
				};
				//清除动画函数
				function scorllBefore(ele, callback){
					ele.children().each(function(i, e) {
						var animate = $(e).attr('data-animation');
						var rotateZ = $(e).attr('rotateZ') ? +$(e).attr('rotateZ') : 0;
						var index = eff.animateName.indexOf(animate);
						if(index != -1) eff.animateArray[index]($(e), rotateZ);
                    });
					if(typeof callback == 'function'){
						callback.call(this);
					}
				};
				//配置点击函数
				scope.menu = function(eve, index){
					var isShow = true;
					switch(index){
						case 0:
						
						break;
						case 1:
						//文本点击函数
						if(scope.pages.length){
							if(scope.pages[scope.childPageActive].isEffect){
								return wsh.quickDialog('特效页面暂时不可添加组件');
							}
							var text = $('<article class="component text" style="font-family: 黑体; font-size: 12px;" rotatez="0" opacity="1">文字 (双击编辑文字)</article>');
							$(elem).find('.page').eq(scope.childPageActive).append(text);
							var count = $(elem).find('.page').eq(scope.childPageActive).children().length;
							text.css('z-index', count);
							setAnimateStyle(text);
							showLine(text);
							scope.elementCount++;
						}else{
							isShow = false;
							alert('请新建页面，再继续操作');
						}
						break;
						case 2:
						
						break;
						case 3:
						//图片点击函数
						if(scope.pages.length){
							if(scope.pages[scope.childPageActive].isEffect){
								return wsh.quickDialog('特效页面暂时不可添加组件');
							}
							var seed, img_url = "http://imgcache.vikduo.com/static/4c4552dbbe45c2af0a3ed4da4bd8da87.png";
							var img = $('<img class="component image" src="' + img_url + '" rotatez="0" opacity="1">');
							setAnimateStyle(img);
							$(elem).find('.page').eq(scope.childPageActive).append(img);
							var count = $(elem).find('.page').eq(scope.childPageActive).children().length;
							img.css('z-index', count);
							seed = Math.floor(img.height() / img.width());
							img.css({width: 300, height: seed * 300});
							showLine(img);
							scope.elementCount++;
						}else{
							isShow = false;
							alert('请新建页面，再继续操作');
						}
						break;
						case 4:
						//图形点击函数
						if(scope.pages.length){
							if(scope.pages[scope.childPageActive].isEffect){
								return wsh.quickDialog('特效页面暂时不可添加组件');
							}
							var button = $('<button type="button" class="component btn" style="width: 130px; height: 32px; text-align: center; border: 1px solid rgb(255, 255, 255); border-radius: 3px; color: rgb(255, 255, 255); background-color: rgb(1, 161, 135); -webkit-box-sizing: border-box; box-sizing: border-box; display: block; padding:0;" rotatez="0" opacity="1"></button>');
							setAnimateStyle(button);
							$(elem).find('.page').eq(scope.childPageActive).append(button);
							var count = $(elem).find('.page').eq(scope.childPageActive).children().length;
							button.css('z-index', count);
							showLine(button);
							scope.elementCount++;
						}else{
							isShow = false;
							alert("请新建页面，再继续操作");
						}
						break;
						case 5:
						
						break;
						case 6:
						//表单点击函数
						if(scope.pages.length){
							if(scope.pages[scope.childPageActive].isEffect){
								return wsh.quickDialog('特效页面暂时不可添加组件');
							}
						}else{
							isShow = false;
							alert("请新建页面，再继续操作");
						}
						break;
						case 7:
						//联系点击函数
						if(scope.pages.length){
							if(scope.pages[scope.childPageActive].isEffect){
								return wsh.quickDialog('特效页面暂时不可添加组件');
							}
							var btnC = $('<div href="" class="component btnC" style="font-family: 黑体;width:100px;height:30px;text-align:center;line-height:28px;font-size:12px;" rotatez="0" opacity="1">一键拨号</div>');
							setAnimateStyle(btnC);
							$(elem).find('.page').eq(scope.childPageActive).append(btnC);
							var count = $(elem).find('.page').eq(scope.childPageActive).children().length;
							btnC.css('z-index', count);
							showLine(btnC);
							scope.elementCount++;
						}else{
							isShow = false;
							alert("请新建页面，再继续操作");
						}
						break;
					}
					getBorderElement();
					if(isShow){
						scope.showMenu = index;
						scope.$emit('save app data');
					}
					sync();
				};

				//底部缩略滑动
				$(document).on('click',"#thumbnailSlide",function(){
					var bottom = $("#createPages").css("bottom");
					if(bottom == "0px"){
						$("#createPages").animate({bottom:"-150px"},800);
						$(this).find("i").removeClass("fa-chevron-down");
						$(this).find("i").addClass("fa-chevron-up");
					}else{
						$(this).find("i").removeClass("fa-chevron-up");
						$(this).find("i").addClass("fa-chevron-down");
						$("#createPages").animate({bottom:"0px"},800);
					}
				});

				//模板页面
				$(document).on('click', '#tpl_tab li a', function(e){
					$(this).parent().addClass('active').siblings().removeClass('active');
                    $(".tempate-cases-more").show();

                    var href = $(this).attr('gohref');
                    var targetElem = $(href);
                    var catId = $(this).attr('data');

                    if(!targetElem.length)
                    {
                        var newTabContent = '<div id="' + href.substr(1) + '" class="tab_body clearfix"><ul id="page-template">';
                       $.ajax({
                            url: wsh.DATA_BASE + '/getPage',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                cat: catId
                            }
                        })
                        .done(function(data) {
                            if (data.success = 1) {
                                var tpl_html = "";
                                if(data.msg.length <= 0){
                                    $(".tempate-cases-more").hide();
                                }
                                else{
                                    $(".tempate-cases-more").show();
                                    for (var i = 0; i < data.msg.length; i++) {
                                        var d = data.msg[i].magazine_page;
                                        newTabContent += '<li><a><img ng-click="pageTemplete($event)" page-id="'+ d.id +'" src="' + d.face + '" class="mCS_img_loaded"></a></li>';
                                    };
								}
								newTabContent += '</ul></div>';
								var templete = $compile(angular.element(newTabContent))(scope);
								angular.element(document.querySelector('#tpl_content')).append(templete);
								$('#tpl_content').children().removeClass('active');
								templete.addClass('active'); 
                            } else {
                                alert(data.msg);
                            }
                        })
                        .fail(function() {
                            console.log("error");
                        });
                    }else{
						$(href).addClass('active').siblings().removeClass('active');
					}
				});
				//更多模板
				scope.tempateMore = function(){
					var index, element;
					$('#tpl_tab').find('li').each(function(i, e) {
                        if($(e).is('.active')){
							index = i;
							element = $(e);
							return;
						} 
                    });
					var data = element.find('a').attr('data');
					var gohref = element.find('a').attr('gohref');
					var count = $(gohref).find('li').length;
					if(count/14 > 0 && count%14 == 0){
						$.ajax({
                            url: wsh.DATA_BASE + '/getPage',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                cat: data,
								page: (count/14 + 1)
                            }
                        }).done(function(data) {
							if (data.success = 1) {
								if(!data.msg.length){
									wsh.quickDialog('该列表下已经没有更多的模板了');
								}else{
									///更多模板   没法做了  没有模板了
									var newTabContent = '';
									for (var i = 0; i < data.msg.length; i++) {
                                        var d = data.msg[i].magazine_page;
                                        newTabContent += '<li><a><img ng-click="pageTemplete($event)" page-id="'+ d.id +'" src="' + d.face + '" class="mCS_img_loaded"></a></li>';
                                    };
									var templete = $compile(angular.element(newTabContent))(scope);
									angular.element(document.querySelector(gohref)).append(templete);
									//$('#tpl_content').children().removeClass('active');
									//templete.addClass('active'); 
								}
							}
						})
					}else{
						wsh.quickDialog('该列表下已经没有更多的模板了');
					}
				};
				//选择动画函数
				scope.chooseAnimate = function(eve, index){
					eve.stopPropagation();
					scope.effectsIndex = index;
					if(wsh.element){
						var text = '已选择' + scope.effects[index].effectname + '动画';
						wsh.element.attr('data-animation', scope.effects[index].effect);
					}else{
						var text = '请选择动画组件';
					}
					wsh.quickDialog(text);
				}
				
				$(document).bind('mousedown', function(a){
					var ele = getRPComponent($(a.target));
					if(
					(ele.is(".component") && !$(a.target).parents().is('#page_total')) || 
					$(a.target).is('.size-hd')){
						if(!$(a.target).is('.text')){
							a.preventDefault();
						}
						if(!$(a.target).is('.size-hd')){
							wsh.isEleDown = true;
						}else{
							wsh.isLineDown = true;
							if($(a.target).is('.size-n')){
								wsh.string = 'n';
							}
							if($(a.target).is('.size-s')){
								wsh.string = 's';
							}
							if($(a.target).is('.size-e')){
								wsh.string = 'e';
							}
							if($(a.target).is('.size-w')){
								wsh.string = 'w';
							}
							if($(a.target).is('.size-nw')){
								wsh.string = 'nw';
							}
							if($(a.target).is('.size-ne')){
								wsh.string = 'ne';
							}
							if($(a.target).is('.size-se')){
								wsh.string = 'se';
							}
							if($(a.target).is('.size-sw')){
								wsh.string = 'sw';
							}
						}
						wsh.startX = a.pageX;
						wsh.startY = a.pageY;
					}
					$(document).bind('mousemove', function(a){
						//if(wsh.istextDblclick) return;
						//a.preventDefault();
						var startX = a.pageX;
						var startY = a.pageY;
						//虚线框框事件
						wsh.startX = wsh.startX ? wsh.startX : startX;
						wsh.startY = wsh.startY ? wsh.startY : startY;
						if(wsh.isLineDown){
							//上
							switch(wsh.string){
								case 'n':
								wsh.string = 'n';
								if(startY > wsh.parentOffset.top && startY < (wsh.parentOffset.top + wsh.eleTop + wsh.height)){
									var moveY = startY - wsh.startY;
									scope.public.height = wsh.height - moveY;
									scope.public.top = wsh.top + moveY;
									if(wsh.element){
										wsh.element.css({'height': scope.public.height + 'px', 'top': wsh.eleTop + moveY + 'px'});
									}
								}
								break;
								case 's':
								wsh.string = 's';
								if(startY > (wsh.parentOffset.top + wsh.eleTop) && startY < (wsh.parentOffset.top + wsh.parentHeight)){
									var moveY = startY - wsh.startY;
									scope.public.height = wsh.height + moveY;
									if(wsh.element){
										wsh.element.css('height', scope.public.height + 'px');
									}
								}
								break;
								case 'e':
								wsh.string = 'e';
								if(startX > wsh.parentOffset.left && startX < (wsh.parentOffset.left + wsh.width + wsh.eleLeft)){
									var moveX = startX - wsh.startX;
									scope.public.width = wsh.width - moveX;
									scope.public.left = wsh.left + moveX;
									if(wsh.element){
										wsh.element.css({'width': scope.public.width + 'px', 'left': wsh.eleLeft + moveX + 'px'});
									}
								}
								break;
								case 'w':
								wsh.string = 'w';
								if(startX > (wsh.parentOffset.left + wsh.eleLeft) && startX < (wsh.parentOffset.left + wsh.parentWidth)){
									var moveX = startX - wsh.startX;
									scope.public.width = wsh.width + moveX;
									if(wsh.element){
										wsh.element.css({'width': scope.public.width + 'px'});
									}
								}
								break;
								case 'nw':
								wsh.string = 'nw';
								if(startX > wsh.parentOffset.left && startX < (wsh.parentOffset.left + wsh.width + wsh.eleLeft) && 
								startY > wsh.parentOffset.top && startY < (wsh.parentOffset.top + wsh.eleTop + wsh.height)){
									var moveY = startY - wsh.startY;
									var moveX = startX - wsh.startX;
									scope.public.width = wsh.width - moveX;
									scope.public.height = wsh.height - moveY;
									scope.public.left = wsh.left + moveX;
									scope.public.top = wsh.top + moveY;
									if(wsh.element){
										wsh.element.css({'width': scope.public.width + 'px',
														 'height': scope.public.height + 'px',
														 'left': wsh.eleLeft + moveX + 'px',
														 'top': wsh.eleTop + moveY + 'px'
														 });
									}
								}
								break;
								case 'ne':
								wsh.string = 'ne';
								if(startX > (wsh.parentOffset.left + wsh.eleLeft) && startX < (wsh.parentOffset.left + wsh.parentWidth) && 
								startY > wsh.parentOffset.top && startY < (wsh.parentOffset.top + wsh.eleTop + wsh.height)){
									var moveY = startY - wsh.startY;
									var moveX = startX - wsh.startX;
									scope.public.width = wsh.width + moveX;
									scope.public.height = wsh.height - moveY;
									scope.public.top = wsh.top + moveY;
									if(wsh.element){
										wsh.element.css({'width': scope.public.width + 'px',
														 'height': scope.public.height + 'px',
														 'top': wsh.eleTop + moveY + 'px'
														 });
									}
								}
								break;
								case 'se':
								wsh.string = 'se';
								if(startX > (wsh.parentOffset.left + wsh.eleLeft) && startX < (wsh.parentOffset.left + wsh.parentWidth) && 
								startY > (wsh.parentOffset.top + wsh.eleTop) && startY < (wsh.parentOffset.top + wsh.parentHeight)){
									var moveY = startY - wsh.startY;
									var moveX = startX - wsh.startX;
									scope.public.width = wsh.width + moveX;
									scope.public.height = wsh.height + moveY;
									if(wsh.element){
										wsh.element.css({'width': scope.public.width + 'px',
														 'height': scope.public.height + 'px'
														 });
									}
								}
								break;
								case 'sw':
								wsh.string = 'sw';
								if(startX > wsh.parentOffset.left && startX < (wsh.parentOffset.left + wsh.width + wsh.eleLeft) && 
								startY > (wsh.parentOffset.top + wsh.eleTop) && startY < (wsh.parentOffset.top + wsh.parentHeight)){
									var moveY = startY - wsh.startY;
									var moveX = startX - wsh.startX;
									scope.public.width = wsh.width - moveX;
									scope.public.height = wsh.height + moveY;
									scope.public.left = wsh.left + moveX;
									if(wsh.element){
										wsh.element.css({'width': scope.public.width + 'px',
														 'height': scope.public.height + 'px',
														 'left': wsh.eleLeft + moveX + 'px'
														 });
									}
								}
								break;
							}
							scope.$apply();
						}else if(wsh.isEleDown){
							//手机区域内移动事件
							if(startX > wsh.parentOffset.left && startX < (wsh.parentOffset.left + wsh.parentWidth) && 
								startY > wsh.parentOffset.top && startY < (wsh.parentOffset.top + wsh.parentHeight)){
								var moveX = startX - wsh.startX;
								var moveY = startY - wsh.startY;
								scope.public.left = wsh.left + moveX;
								scope.public.top = wsh.top + moveY;
								wsh.element.css({'left': wsh.eleLeft + moveX + 'px', 'top': wsh.eleTop + moveY + 'px'});
								scope.$apply();	
							}
						}
					});
					$(document).bind('mouseup', function(a){
						$(document).unbind('mousemove');
						wsh.isEleDown = false;
						wsh.isLineDown = false;
						wsh.istextDblclick = false;
						if($(a.target).is('.border') || $(a.target).is('.size-hd')){
							if(scope.checkScale && wsh.element && wsh.element.is('.image')){
								if(wsh.string == 'n' || wsh.string == 's'){
									scope.public.width = scope.public.height/wsh.scale;
									wsh.element ? wsh.element.css('width', scope.public.width + 'px') : void 0;
								}else{
									scope.public.height = scope.public.width * wsh.scale;
									wsh.element ? wsh.element.css('height', scope.public.height + 'px') : void 0;
								}
								scope.$apply();
							}
							wsh.startX = wsh.startY = wsh.string = null;
							sync();
						}
						$(document).unbind('mouseup');
					});
				});
				
				scope.$on('downAll', function(eve, a, startX, startY){
					$rootScope.appTopList = false;
					$rootScope.appHistoryShow = false;
					var ele = getRPComponent($(a));
					if(
					(ele.is(".component") && !$(a).parents().is('#page_total')) || 
					($(a).is('.size-hd'))){
						if(!$(a).is('.size-hd')){
							showLine(ele);
							wsh.isEleDown = true;
						}else{
							wsh.isLineDown = true;
						}
						getBorderElement();
						//wsh.isDown = true;
						wsh.startX = startX;//保存点击坐标
						wsh.startY = startY;//保存点击坐标
					}else{
						if($(a).is('section.page') && $(a).parents().is('.pages')){
							//点击手机区域的背景图
							wsh.element = $(a);
							scope.showMenu = 2;
							$(elem).find('.border').removeClass('border');
							if(scope.frameShow){
								scope.$emit('hide line');
							}
						}else if(
						!$(a).parents().is('ul.create-toolbar-list') && 
						!$(a).parents().is('#mCSB_4') && 
						!$(a).parents().is('#mCSB_5') && 
						!$(a).parents().is('.form-container') && 
						!$(a).parents().is('.imgstore_main') && 
						!$(a).parents().is('#animation-editor')){
							//隐藏动画等面板
							if(!$(a).is('.page-menu li') && !$(a).is('.create-menu li')){
								scope.createMenu = scope.pageMenu = false;
								$(elem).find('.border').removeClass('border');
								wsh.element = null;
								scope.showMenu = -1;
								$(".create-toolbar-list").find(".tool").eq(6).removeClass("active");
								if(scope.frameShow){
									scope.$emit('hide line');
								}
							} 
						}
					}
				});
				wsh.parentOffset = $('.pages').offset();
				wsh.parentWidth = $('.pages').width();
				wsh.parentHeight = $('.pages').height();
				//双击文本框事件
				$(document).on('dblclick', function(e){
					if($(e.target).is('.text')){
						$(e.target).attr('contenteditable', !0);
						$(e.target).addClass('text-contenteditable');
						wsh.istextDblclick = true;
						
					}
				});
				//失去焦点事件
				$(document).on('blur', '.text', null, function(a){
					wsh.istextDblclick = false;
					var b;
					$(a.target).removeAttr('contenteditable');
					$(a.target).removeClass('text-contenteditable');
					b = a.target.innerText.replace(/\n/g, '<br>');
					if (b == '') {
						b = '文字 (双击编辑文字)';
					}
					a.target.innerHTML = b;
				});
				//显示虚线框框
				function showLine(ele){
					$(elem).find('.border').removeClass('border');
					ele.addClass('border');
					var opacity = (+ele.attr('opacity')).toFixed(2);
					ele.css(wsh.style + 'transition', 'none');
					ele.css(wsh.style + 'animation', 'none'); 
					ele.css('opacity', opacity);
					scope.$emit('show line', ele);
				}
				//获取选中元素的信息
				function getBorderElement(){
					if(!$(elem).find('.border').length) return;
					wsh.element = $(elem).find('.border');
					wsh.left = wsh.element.offset().left;//保存选中物体的左边距值
					wsh.top = wsh.element.offset().top;//保存选中物体的上边距值
					wsh.width = wsh.element.width();//保存选中物体的宽度
					wsh.height = wsh.element.height();//保存选中物体的调试
					wsh.eleTop = +(wsh.element.css('top').replace('px', ''));//保存选中在其父级中的left 值
					wsh.eleTop = wsh.eleTop ? wsh.eleTop : 0;
					wsh.eleLeft = +(wsh.element.css('left').replace('px', ''));//保存选中在其父级中的top 值
					wsh.eleLeft = wsh.eleLeft ? wsh.eleLeft : 0;
					//保存选中物体的宽高比例
					wsh.scale = (wsh.height/wsh.width);
				}
				//添加动画样式信息
				function setAnimateStyle(ele, rotateZ){
					rotateZ = rotateZ == null ? 0 : rotateZ;
					ele.css(wsh.style + 'transform', 'translateX(0px) translateY(0px) translateZ(0px) scaleX(1) scaleY(1) scaleZ(1) rotateX(0deg) rotateY(0deg) rotateZ(' +rotateZ+ 'deg)');
					ele.css(wsh.style + 'transition', 'none');
					ele.css(wsh.style + 'animation', 'none');
				}
				//背景图片信息
				$(document).on('click', '.imgselectshow', function(e){
					var name = $(this).attr('name');
					wsh.uploadImgName = name;
				});
				$(document).on('click', '#backgroundColorPicker .twod, #backgroundSelect .twod', function(e){
					if($(e.target).parents().is('#backgroundSelect')){
						var value = $('#backgroundSelect').find('input[type="text"]').val();
						$(elem).children().eq(scope.childPageActive).css('background-color', value);
					}else{
						var value = $('#backgroundColorPicker').find('input[type="text"]').val();
						wsh.element ? wsh.element.css('color', value) : void 0;
					}
					sync();
				});
				$(document).on('click', '.imgstore_img', function(a){
					if(wsh.uploadImgName == 'uploadBackground'){
						var src = $(this).attr('src');
						if($(elem).find('.border').length){
							//上传图片
							$(elem).find('.border').attr('src', src);
						}else{
							//背景图片
							$(elem).children().eq(scope.childPageActive).css('background-image', 'url(' + src + ')');
						}
						sync();
					}
					if(wsh.uploadImgName == 'wshlogo'){
						var src = $(this).attr('src');
						scope.data.imgUrl = src;
					}
					if(wsh.uploadImgName == 'wshdeso'){
						var src = $(this).attr('src');
						scope.data.shareLogo = src;
					}
					scope.$emit('save app data');
				});
				//获取手机区域中的  .component 对象
				function getRPComponent(a) {
					var b, c, d, e;
					for (e = a.parents(), c = 0, d = e.length; d > c; c++)
						b = e[c], $(b).is(".form.component") && (a = $(b)), $(b).is(".text.component") && (a = $(b)), $(b).is(".btn.component") && (a = $(b)), $(b).is(".image.component") && (a = $(b));
					return a
				}
			}
		};
	});
	app.controller("templateController", function($scope, $rootScope, $element, $http) {
		$rootScope.isoldVersion = false;
		$rootScope.TemplateShow = true;
		$('#tpl_box1 a').bind('click', function(e){
			var id = $(e.target).parents('a').attr('template-id');
			//创建应用
			createOrget({mid: id}, true);
		});
		$scope.$on('app Id', function(eve, id, iscreate, callback){
			//获取应用
			createOrget(id, false, callback);
		});
		if($scope.appId != null){
			createOrget($scope.appId, false);
		}
		function createOrget(obj, iscreate, callback){
			if(iscreate){
				//创建应用
				wsh.isIntroudction = true;
				$http.post(wsh.DATA_BASE + '/create', obj).success(function(data){
					wsh.id = data._id;
					$.cookie("App Id", data._id, {expires: 1, path: "/"});
					window.location.hash = '#' + data._id;
					$scope.$emit('app Activated', data, true);
					$rootScope.TemplateShow = false;
					if(typeof callback == 'function'){
						callback.call(this);
					}
				});
			}else{
				//获取应用
				$http.post(wsh.url + 'detail-ajax', {id: obj})
					.success(function(msg){
						wsh.id = msg.errmsg.id;
						$.cookie("App Id", msg.errmsg.id, {expires: 1, path: "/"});
						window.location.hash = '#' + msg.errmsg.id;
						$scope.$emit('app Activated', msg.errmsg, true);
						$rootScope.TemplateShow = false;
						if(msg.errmsg.version == '2.1.7'){
							$rootScope.isoldVersion = true;
						} 
						if(typeof callback == 'function'){
							callback.call(this);
						}
					});
			}
		}
	});
})();
