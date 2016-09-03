/*
 * andy 2015.03.23
 */
//页面过渡效果设置  $scope.slideArray = [{slide: 'cover', text: '缩放'}, {slide: 'easy', text: '普通'}, {slide: 'fade', text: '翻转'}, {slide: 'glue', text: '旋转'}];
var translatePage = translatePage || {};
translatePage.isMove = false;
translatePage.time = 500;
translatePage.scale = 0.7;
translatePage.parentHeight = $('.simulator').height();
translatePage.animateBack = function(element, type, callback){
	if(!element) throw new Error("传入的不是字符串或不存在");
	if(type == 'transfrom'){
		element.bind('webkitTransitionEnd',function(){
			callback.call(this);
		});
	}else if(type == 'animate'){
		element.bind('webkitAnimationEnd',function(){
			callback.call(this);
		});
	}
};
translatePage.gotoPage = function(obj){
	/*
	element.css({'top': '480px', 'z-index': 2});
						
						element.animate({top : 0}, 300, function(){
							element.siblings().css('z-index', 0);
							element.css('z-index', 1);
							scorllAfter(element);
							ele ? scorllBefore(ele) : void 0;
						});
						
						
	currentElement: element,
	prevElement: ele,
	slideString: string,
	complete: function(){
		element.siblings().css('z-index', 0);
		element.css('z-index', 1);
		scorllAfter(element);
		ele ? scorllBefore(ele) : void 0;
	}*/
	switch(obj.slideString){
		case 'cover':
		var ori, top;
		if(!obj.prevElement){
			top = translatePage.parentHeight;
			obj.currentElement.css({'top': top + 'px', 'z-index': 2});
			return obj.currentElement.animate({top : 0}, translatePage.time, function(){
					obj.complete.call(this);
				});
		}
		if(obj.prevElement.index() > obj.currentElement.index()){
			ori = '50% 100%';
			top = - translatePage.parentHeight;
		}else{
			ori = '50% 0%';
			top = translatePage.parentHeight;
		}
		obj.prevElement.css(wsh.style + 'transform-origin', ori);
		obj.currentElement.css({'top': top + 'px', 'z-index': 2});
		setTimeout(function(){
			obj.prevElement.css(wsh.style + 'transform', 'scale(0.7)');
			obj.prevElement.css(wsh.style + 'transition-duration', translatePage.time + 'ms');
			obj.currentElement.css('top', 0);
			obj.currentElement.css(wsh.style + 'transition-duration', translatePage.time + 'ms');
			translatePage.animateBack(obj.currentElement, 'transfrom', function(){
				obj.prevElement.css(wsh.style + 'transform', 'translate3d(0, 0, 0)');
				obj.prevElement.add(obj.currentElement).css(wsh.style + 'transition-duration', 0);
				obj.complete.call(this);
			});
		}, 100);
		break;
		case 'easy':
		var top;
		if(obj.prevElement && obj.prevElement.index() > obj.currentElement.index()){
			top = - translatePage.parentHeight;
		}else{
			top = translatePage.parentHeight;
		}
		setTimeout(function(){
			obj.currentElement.css({'top': top + 'px', 'z-index': 2});
			obj.currentElement.animate({top : 0}, translatePage.time, function(){
				obj.complete.call(this);
			});
		}, 100);
		break;
		case 'fade':
		
		break;
		case 'glue':
		
		break;
	}
};
//各组件的动画设置 
var eff = eff || {};
eff.animateName = ['fromleft', 'frombottom', 'fromright', 'fromtop', 'fade', 'rotation', 'rotation2d', 'bounceIn', 'show', 'small2big', 'jitter', 'light', 'fadeFromLeft', 'fadeFromBottom', 'fadeFromRight', 'fadeFromTop'];
eff.animateArray = [
					//obj.animate obj.duration obj.delay obj.opacity
					//fromleft
					function(el, rotateZ, obj){	
						if(arguments.length != 2){
							el.css(wsh.style + 'transform', 'translateX(0px) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'all ' + obj.duration + 's ' + obj.delay + 's');
						}else{
							el.css(wsh.style + 'transform', 'translateX(-500px) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'none');
						}
					},
					//frombottom
					function(el, rotateZ, obj){	
						if(arguments.length != 2){
							el.css(wsh.style + 'transform', 'translateY(0px) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'all ' + obj.duration + 's ' + obj.delay + 's');
						}else{
							el.css(wsh.style + 'transform', 'translateY(500px) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'none');
						}
					},
					//fromright
					function(el, rotateZ, obj){	
						if(arguments.length != 2){
							el.css(wsh.style + 'transform', 'translateX(0px) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'all ' + obj.duration + 's ' + obj.delay + 's');
						}else{
							el.css(wsh.style + 'transform', 'translateX(500px) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'none');
						}
					},
					//fromtop
					function(el, rotateZ, obj){	
						if(arguments.length != 2){
							el.css(wsh.style + 'transform', 'translateY(0px) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'all ' + obj.duration + 's ' + obj.delay + 's');
						}else{
							el.css(wsh.style + 'transform', 'translateY(-500px) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'none');
						}
					},
					//fade
					function(el, rotateZ, obj){	
						if(arguments.length != 2){
							obj.opacity = obj.opacity == 0 ? 1 : obj.opacity
							el.css('opacity', obj.opacity);
							el.css(wsh.style + 'transition', 'all ' + obj.duration + 's ' + obj.delay + 's');
						}else{
							el.css('opacity', 0);
							el.css(wsh.style + 'transition', 'none');
						}
					},
					//rotation
					function(el, rotateZ, obj){	
						if(arguments.length != 2){
							el.css(wsh.style + 'transform', 'rotateY(0deg) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'all ' + obj.duration + 's ' + obj.delay + 's');
						}else{
							el.css(wsh.style + 'transform', 'rotateY(180deg) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'none');
						}
					},
					//rotation2d
					function(el, rotateZ, obj){	
						if(arguments.length != 2){
							el.css(wsh.style + 'animation', obj.animate + ' ' + obj.duration + 's ' + obj.delay + 's linear infinite');
						}else{
							el.css('opacity', 0);
							el.css(wsh.style + 'animation', 'none');
						}
					},
					//bounceIn
					function(el, rotateZ, obj){	
						if(arguments.length != 2){
							el.css(wsh.style + 'animation', obj.animate + ' ' + obj.duration + 's ' + obj.delay + 's linear forwards');
						}else{
							el.css('opacity', 0);
							el.css(wsh.style + 'animation', 'none');
						}
					},
					//show
					function(el, rotateZ, obj){	
						if(arguments.length != 2){
							el.css('opacity', obj.opacity);
							el.css(wsh.style + 'transform', 'scaleX(1) scaleY(1) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'all ' + obj.duration + 's ' + obj.delay + 's');
						}else{
							el.css(wsh.style + 'transform', 'scaleX(2) scaleY(2) rotateZ(' +rotateZ+ 'deg)');
							el.css('opacity', 0);
							el.css(wsh.style + 'transition', 'none');
						}
					},
					//small2big
					function(el, rotateZ, obj){	
						if(arguments.length != 2){
							el.css('opacity', obj.opacity);
							el.css(wsh.style + 'transform', 'scaleX(1) scaleY(1) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'all ' + obj.duration + 's ' + obj.delay + 's');
						}else{
							el.css(wsh.style + 'transform', 'scaleX(0.5) scaleY(0.5) rotateZ(' +rotateZ+ 'deg)');
							el.css('opacity', 0);
							el.css(wsh.style + 'transition', 'none');
						}
					},
					//jitter
					function(el, rotateZ, obj){	
						if(arguments.length != 2){
							el.css(wsh.style + 'animation', obj.animate + ' ' + obj.duration + 's ' + obj.delay + 's linear both');
						}else{
							el.css('opacity', 0);
							el.css(wsh.style + 'animation', 'none');
						}
					},
					//light
					function(el, rotateZ, obj){	
						if(arguments.length != 2){
							el.css(wsh.style + 'animation', obj.animate + ' ' + obj.duration + 's ' + obj.delay + 's linear infinite');
						}else{
							el.css('opacity', 0);
							el.css(wsh.style + 'animation', 'none');
						}
					},
					//fadeFromLeft
					function(el, rotateZ, obj){	
						if(arguments.length != 2){
							el.css('opacity', obj.opacity);
							el.css(wsh.style + 'transform', 'translateX(0px) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'all ' + obj.duration + 's ' + obj.delay + 's');
						}else{
							el.css('opacity', 0);
							el.css(wsh.style + 'transform', 'translateX(-500px) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'none');
						}
					},
					//fadeFromBottom
					function(el, rotateZ, obj){	
						if(arguments.length != 2){
							el.css('opacity', obj.opacity);
							el.css(wsh.style + 'transform', 'translateY(0px) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'all ' + obj.duration + 's ' + obj.delay + 's');
						}else{
							el.css('opacity', 0);
							el.css(wsh.style + 'transform', 'translateY(500px) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'none');
						}
					},
					//fadeFromRight
					function(el, rotateZ, obj){	
						if(arguments.length != 2){
							el.css('opacity', obj.opacity);
							el.css(wsh.style + 'transform', 'translateX(0px) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'all ' + obj.duration + 's ' + obj.delay + 's');
						}else{
							el.css('opacity', 0);
							el.css(wsh.style + 'transform', 'translateX(500px) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'none');
						}
					},
					//fadeFromTop
					function(el, rotateZ, obj){	
						if(arguments.length != 2){
							el.css('opacity', obj.opacity);
							el.css(wsh.style + 'transform', 'translateY(0px) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'all ' + obj.duration + 's ' + obj.delay + 's');
						}else{
							el.css('opacity', 0);
							el.css(wsh.style + 'transform', 'translateY(-500px) rotateZ(' +rotateZ+ 'deg)');
							el.css(wsh.style + 'transition', 'none');
						}
					}];
					
eff.setHeadStyle = function(id, string, rotateZ, opacity){
	var style;
	//创建或者修改class类名
	if(!$('#pageStyle').length){
		style = $('<style></style>').attr('id', 'pageStyle');
		style.appendTo('head');
	} 
	else style = $('#pageStyle');
	
	var str = style.text();
	switch(string){
		case 'rotation2d':
		str += '@' +wsh.style+ 'keyframes ' + id + ' {0%{' +wsh.style+ 'transform:rotateZ(' +rotateZ+ 'deg); opacity:' + opacity + ';}100%{' +wsh.style+ 'transform:rotateZ(' +(rotateZ + 360)+ 'deg); opacity:' + opacity + ';}}';
		break;
		case 'bounceIn':
		str += '@' +wsh.style+ 'keyframes ' + id + ' {0%{' +wsh.style+ 'transform:scale3d(0.4,0.4,1) rotateZ(' +rotateZ+ 'deg); opacity:0;}80%{' +wsh.style+ 'transform:scale3d(1.2,1.2,1) rotateZ(' +rotateZ+ 'deg); opacity:1;}100%{' +wsh.style+ 'transform:scale3d(1,1,1) rotateZ(' +rotateZ+ 'deg); opacity:' + opacity + ';}}';
		break;
		case 'jitter':
		str += '@' +wsh.style+ 'keyframes ' + id + ' {0%{' +wsh.style+ 'transform: translate3d(0, 0, 0) rotateZ(' +rotateZ+ 'deg); opacity:' + opacity + ';}' +
												'2%{' +wsh.style+ 'transform:translate3d(-1px, 3px, 0) rotateZ(' +(rotateZ - 1.5)+ 'deg);}' + 
												'4%{' +wsh.style+ 'transform:translate3d(-4px, 5px, 0) rotateZ(' +(rotateZ - 1.5)+ 'deg);}' + 
												'6%{' +wsh.style+ 'transform:translate3d(-1px, 6px, 0) rotateZ(' +(rotateZ - 1.5)+ 'deg);}' + 
												'8%{' +wsh.style+ 'transform:translate3d(5px, -4px, 0) rotateZ(' +(rotateZ - 3.5)+ 'deg);}' + 
												'10%{' +wsh.style+ 'transform:translate3d(-7px, -5px, 0) rotateZ(' +(rotateZ - 3.5)+ 'deg);}' + 
												'12%{' +wsh.style+ 'transform:translate3d(-1px, 8px, 0) rotateZ(' +(rotateZ + 2.5)+ 'deg);}' + 
												'14%{' +wsh.style+ 'transform:translate3d(3px, -5px, 0) rotateZ(' +(rotateZ - 1.5)+ 'deg);}' + 
												'16%{' +wsh.style+ 'transform:translate3d(1px, 0, 0) rotateZ(' +(rotateZ + 2.5)+ 'deg);}' + 
												'18%{' +wsh.style+ 'transform:translate3d(-6px, -10px, 0) rotateZ(' +(rotateZ - 0.5)+ 'deg);}' + 
												'20%{' +wsh.style+ 'transform:translate3d(3px, -2px, 0) rotateZ(' +(rotateZ + 1.5)+ 'deg);}' + 
												'22%{' +wsh.style+ 'transform:translate3d(0, 0, 0) rotateZ(' +(rotateZ - 2.5)+ 'deg);}' + 
												'24%{' +wsh.style+ 'transform:translate3d(-5px, -4px, 0) rotateZ(' +(rotateZ + 1.5)+ 'deg);}' + 
												'26%{' +wsh.style+ 'transform:translate3d(-1px, 3px, 0) rotateZ(' +(rotateZ - 3.5)+ 'deg);}' + 
												'28%{' +wsh.style+ 'transform:translate3d(1px, 1px, 0) rotateZ(' +(rotateZ - 3.5)+ 'deg);}' + 
												'30%{' +wsh.style+ 'transform:translate3d(-4px, 8px, 0) rotateZ(' +(rotateZ + 1.5)+ 'deg);}' + 
												'32%{' +wsh.style+ 'transform:translate3d(-9px, 7px, 0) rotateZ(' +(rotateZ - 3.5)+ 'deg);}' + 
												'34%{' +wsh.style+ 'transform:translate3d(4px, -9px, 0) rotateZ(' +(rotateZ - 2.5)+ 'deg);}' + 
												'36%{' +wsh.style+ 'transform:translate3d(1px, -6px, 0) rotateZ(' +(rotateZ - 2.5)+ 'deg);}' + 
												'38%{' +wsh.style+ 'transform:translate3d(-4px, 0, 0) rotateZ(' +(rotateZ - 2.5)+ 'deg);}' + 
												'40%{' +wsh.style+ 'transform:translate3d(3px, -7px, 0) rotateZ(' +(rotateZ + 0.5)+ 'deg);}' + 
												'42%{' +wsh.style+ 'transform:translate3d(4px, 4px, 0) rotateZ(' +(rotateZ - 0.5)+ 'deg);}' + 
												'44%{' +wsh.style+ 'transform:translate3d(8px, -4px, 0) rotateZ(' +(rotateZ - 2.5)+ 'deg);}' + 
												'46%{' +wsh.style+ 'transform:translate3d(9px, 9px, 0) rotateZ(' +(rotateZ - 3.5)+ 'deg);}' + 
												'48%{' +wsh.style+ 'transform:translate3d(6px, -8px, 0) rotateZ(' +(rotateZ - 0.5)+ 'deg);}' + 
												'50%{' +wsh.style+ 'transform:translate3d(-1px, 4px, 0) rotateZ(' +(rotateZ - 3.5)+ 'deg);}' + 
												'52%{' +wsh.style+ 'transform:translate3d(4px, 6px, 0) rotateZ(' +(rotateZ - 1.5)+ 'deg);}' + 
												'54%{' +wsh.style+ 'transform:translate3d(9px, -3px, 0) rotateZ(' +(rotateZ + 2.5)+ 'deg);}' + 
												'56%{' +wsh.style+ 'transform:translate3d(8px, -2px, 0) rotateZ(' +(rotateZ - 3.5)+ 'deg);}' + 
												'58%{' +wsh.style+ 'transform:translate3d(-2px, -9px, 0) rotateZ(' +(rotateZ - 0.5)+ 'deg);}' + 
												'60%{' +wsh.style+ 'transform:translate3d(-1px, -5px, 0) rotateZ(' +(rotateZ + 2.5)+ 'deg);}' + 
												'62%{' +wsh.style+ 'transform:translate3d(-8px, 3px, 0) rotateZ(' +(rotateZ + 2.5)+ 'deg);}' + 
												'64%{' +wsh.style+ 'transform:translate3d(6px, -2px, 0) rotateZ(' +(rotateZ - 3.5)+ 'deg);}' + 
												'66%{' +wsh.style+ 'transform:translate3d(-5px, 9px, 0) rotateZ(' +(rotateZ - 1.5)+ 'deg);}' + 
												'68%{' +wsh.style+ 'transform:translate3d(3px, 1px, 0) rotateZ(' +(rotateZ - 0.5)+ 'deg);}' + 
												'70%{' +wsh.style+ 'transform:translate3d(6px, 4px, 0) rotateZ(' +(rotateZ - 1.5)+ 'deg);}' + 
												'72%{' +wsh.style+ 'transform:translate3d(-6px, -5px, 0) rotateZ(' +(rotateZ + 1.5)+ 'deg);}' + 
												'74%{' +wsh.style+ 'transform:translate3d(-8px, 0, 0) rotateZ(' +(rotateZ - 0.5)+ 'deg);}' + 
												'76%{' +wsh.style+ 'transform:translate3d(-5px, -8px, 0) rotateZ(' +(rotateZ + 1.5)+ 'deg);}' + 
												'78%{' +wsh.style+ 'transform:translate3d(5px, -3px, 0) rotateZ(' +(rotateZ - 1.5)+ 'deg);}' + 
												'80%{' +wsh.style+ 'transform:translate3d(-6px, -3px, 0) rotateZ(' +(rotateZ - 1.5)+ 'deg);}' + 
												'82%{' +wsh.style+ 'transform:translate3d(7px, 8px, 0) rotateZ(' +(rotateZ - 1.5)+ 'deg);}' + 
												'84%{' +wsh.style+ 'transform:translate3d(-6px, 9px, 0) rotateZ(' +(rotateZ + 0.5)+ 'deg);}' + 
												'86%{' +wsh.style+ 'transform:translate3d(1px, 8px, 0) rotateZ(' +(rotateZ - 3.5)+ 'deg);}' + 
												'88%{' +wsh.style+ 'transform:translate3d(-9px, -2px, 0) rotateZ(' +(rotateZ + 1.5)+ 'deg);}' + 
												'90%{' +wsh.style+ 'transform:translate3d(4px, -6px, 0) rotateZ(' +(rotateZ - 1.5)+ 'deg);}' + 
												'92%{' +wsh.style+ 'transform:translate3d(0, -1px, 0) rotateZ(' +(rotateZ + 0.5)+ 'deg);}' + 
												'94%{' +wsh.style+ 'transform:translate3d(2px, -9px, 0) rotateZ(' +(rotateZ + 2.5)+ 'deg);}' + 
												'96%{' +wsh.style+ 'transform:translate3d(-9px, 1px, 0) rotateZ(' +(rotateZ - 2.5)+ 'deg);}' + 
												'98%{' +wsh.style+ 'transform:translate3d(-9px, -5px, 0) rotateZ(' +(rotateZ - 3.5)+ 'deg);}' + 
												'100%{' +wsh.style+ 'transform:translate3d(0, 0, 0) rotateZ(' +rotateZ+ 'deg); opacity:' + opacity + ';}}';
		break;
		case 'light':
		str += '@' +wsh.style+ 'keyframes ' + id + ' {0%{opacity:0;}50%{opacity:' + opacity + ';}100%{opacity:0;}}';
		break;
	}
	style.text(str);
};