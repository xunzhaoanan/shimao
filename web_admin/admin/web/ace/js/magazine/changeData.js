/*
 * andy 2015.04.28
 */
var changeData = changeData || {};
changeData.change = function(string){
	var div = $('<div></div>');
	div.append(string);
	//处理过的代码会添加  version = andy
	if(div.find('.page').eq(0).attr('version') != 'andy'){
		div.children().each(function(i, e){
			$(e).attr('version', 'andy');
			$(e).css({'transform': '', 'height': '100%', 'width': '100%'});
			$(e).children().each(function(a, b) {
				var transform = b.style.transform, x, y, z, opacity, cache, zIndex, rotateZ = 0;
				if(transform != 'none'){
					x = +(transform.match(/translateX\(-?[\d]{0,}.?[\d]{0,}px\)/)[0].replace('translateX(','').replace('px)',''));
					y = +(transform.match(/translateY\(-?[\d]{0,}.?[\d]{0,}px\)/)[0].replace('translateY(','').replace('px)',''));
					rotateZ = +(transform.match(/rotateZ\(-?[\d]{0,}.?[\d]{0,}deg\)/)[0].replace('rotateZ(','').replace('deg)',''));
				}
				opacity = +$(b).css('opacity');
				cache = $(b).attr('data-style-cache') ? $(b).attr('data-style-cache') : void 0;
				zIndex = +$(b).css('z-index');
				if(cache){
					try{
						cache = JSON.parse(cache);
						x = cache.x ? cache.x : x;
						y = cache.y ? cache.y : y;
						opacity = cache.opacity ? cache.opacity : opacity;
						opacity = parseFloat(opacity) == 0 ? 1 : opacity;
						zIndex = cache.zIndex ? cache.zIndex : zIndex; 
					}catch(e){
						console.log(i + '==' + a);
					}
				}
				opacity = parseFloat(opacity) == 0 ? 1 : opacity;
				if(x < 0 || x > 320){
					x = x < 0 ? x + 200 : x;
					x = x > 320 ? x - 200 : x;
				}
				if(y < 0 || y > 480){
					y = y < 0 ? y + 200 : y;
					y = y > 480 ? y - 200 : y;
				}
				$(b).css(wsh.style + 'transform', 'translateX(0px) translateY(0px) translateZ(0px) scaleX(1) scaleY(1) scaleZ(1) rotateX(0deg) rotateY(0deg) rotateZ(' +rotateZ+ 'deg)');
				$(b).css({
					'transform': '',
					'left': x + 'px',
					'top': y + 'px',
					'width': ($(b).width()).toFixed(0),
					'height': ($(b).height()).toFixed(0),
					'opacity': opacity == 0 ? 1 : opacity,
					'z-index': zIndex > 100 ? zIndex - 199 : zIndex < -100 ? zIndex + 199 : zIndex
				});
				$(b).attr('rotateZ', rotateZ);
				$(b).attr('opacity', opacity);
				$(b).removeAttr('data-style-cache');
				var style = $(b).attr('style');
				style = style.replace('-webkit-perspective: 1000;', '');
				$(b).attr('style', style);
			});
		});
		var str = div.html();
		str = str.replace('&nbsp;', '');
		return str;
	}else{
		return string;
	}
}
changeData.changeOne = function(string, boo){
	var div = $('<div></div>');
	div.append(string);
	boo ? div.find('.page').eq(0).attr('iseffect', 'true') : void 0;
	if(div.find('.page').eq(0).attr('version') != 'andy'){
		div.find('.page').eq(0).attr('version', 'andy');
		div.find('.page').eq(0).css({'transform': '', 'height': '100%', 'width': '100%'});
		div.find('.page').eq(0).children().each(function(a, b){
			var transform = b.style.transform, x, y, z, opacity, cache, zIndex, rotateZ = 0;
			if(transform != 'none'){
				x = +(transform.match(/translateX\(-?[\d]{0,}.?[\d]{0,}px\)/)[0].replace('translateX(','').replace('px)',''));
				y = +(transform.match(/translateY\(-?[\d]{0,}.?[\d]{0,}px\)/)[0].replace('translateY(','').replace('px)',''));
				rotateZ = +(transform.match(/rotateZ\(-?[\d]{0,}.?[\d]{0,}deg\)/)[0].replace('rotateZ(','').replace('deg)',''));
			}
			opacity = +$(b).css('opacity');
			cache = $(b).attr('data-style-cache') ? $(b).attr('data-style-cache') : void 0;
			zIndex = +$(b).css('z-index');
			if(cache){
				try{
					cache = JSON.parse(cache);
					x = cache.x ? cache.x : x;
					y = cache.y ? cache.y : y;
					opacity = cache.opacity ? cache.opacity : opacity;
					opacity = parseFloat(opacity) == 0 ? 1 : opacity;
					zIndex = cache.zIndex ? cache.zIndex : zIndex; 
				}catch(e){
					console.log(a);
				} 
			}
			opacity = parseFloat(opacity) == 0 ? 1 : opacity;
			if(x < 0 || x > 320){
				x = x < 0 ? x + 200 : x;
				x = x > 320 ? x - 200 : x;
			}
			if(y < 0 || y > 480){
				y = y < 0 ? y + 200 : y;
				y = y > 480 ? y - 200 : y;
			}
			$(b).css(wsh.style + 'transform', 'translateX(0px) translateY(0px) translateZ(0px) scaleX(1) scaleY(1) scaleZ(1) rotateX(0deg) rotateY(0deg) rotateZ(' +rotateZ+ 'deg)');	
            $(b).css({
				'transform': '',
				'left': x + 'px',
				'top': y + 'px',
				'width': ($(b).width()).toFixed(0),
				'height': ($(b).height()).toFixed(0),
				'opacity': opacity == 0 ? 1 : opacity,
				'z-index': zIndex > 100 ? zIndex - 199 : zIndex < -100 ? zIndex + 199 : zIndex
			});
			$(b).attr('rotateZ', rotateZ);
			$(b).attr('opacity', opacity);
			$(b).removeAttr('data-style-cache');
			var style = $(b).attr('style');
			style = style.replace('-webkit-perspective: 1000;', '');
			$(b).attr('style', style);
		});
	}
	var str = div.html();
	str = str.replace('&nbsp;', '');
	return str;
}