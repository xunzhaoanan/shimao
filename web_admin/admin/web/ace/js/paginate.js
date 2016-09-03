(function(){
	var paginate = function(options){
		var that = this;
		that.options = {
			self: null, //自身
			width: null, //宽度
			parent: null, //父级
			count: 5, //总个数
			start: 1, //开始个数
			display: 5, //显示个数
			isSearch: true, //显示搜索框
			border: true,
			border_color: '#fff',
			text_color: '#8cc59d',
			background_color: 'black',	
			border_hover_color: '#fff',
			text_hover_color: '#fff',
			background_hover_color: '#fff', 
			rotate: true,
			images: true,
			mouse: 'slide',
			onChange: null //函数
		}
		$.extend(that.options, options);
		that.init();
	}
	paginate.prototype = {
		init: function(){
			var that = this;
			var first = $('<a></a>').attr('class', 'jPag-first').text('首页');
			var leftdiv = $('<div></div>').attr('class', 'jPag-control-back');
			leftdiv.append(first);
			var last = $('<a></a>').attr('class', 'jPag-last').text('末页');
			var rightdiv = $('<div></div>').attr('class', 'jPag-control-front');
			
			if(that.options.rotate){
				var rotleft = $('<span></span>').attr('class', 'jPag-sprevious').css('color', that.options.background_color).html('&laquo;');	
				var rotright = $('<span></span>').attr('class', 'jPag-snext').css('color', that.options.background_color).html('&raquo;');	
				leftdiv.append(rotleft);
				rightdiv.append(rotright);
			}
			rightdiv.append(last);
			var middlediv = $('<div></div>').css({'float': 'left', 'overflow': 'hidden', 'position': 'relative'});
			var ul = $('<ul></ul>').attr('class', 'jPag-pages');
			middlediv.append(ul);
			that.options.self.append(leftdiv).append(middlediv).append(rightdiv);
			that.options.self.addClass('jPaginate');
			that.draw();
			
		},
		draw: function(boo){
			var that = this;
			that.options.self.find('ul').empty();
			if(that.options.display > that.options.count) that.options.display = that.options.count;
			for(var i = 1; i <= that.options.count; i++){
				if(i == that.options.start) var li = $('<li></li>').html('<span class="jPag-current">'+i+'</span>');
				else var li = $('<li></li>').html('<a>'+ i +'</a>');
				that.options.self.find('ul').append(li);
			}
			if(that.options.isSearch && that.options.count > that.options.display){
				var input = $('<input type="text">').css({'width': '40px', 'height': '31px', 'float': 'left', 'margin-top': '3px', 'border': '1px solid '+ that.options.background_color});
				var button = $('<button></button>').css({'width': '90px', 'height': '31px', 'float': 'left', 'margin-top': '3px', 'background': that.options.background_color, 'color': that.options.text_color}).text('共' +that.options.count+ '页/搜索');
				that.options.self.append(input).append(button);
			}else{
				if(that.options.self.find('input').length) that.options.self.find('input').remove();
				if(that.options.self.find('button').length) that.options.self.find('button').remove();
			}	
			//boo ? void 0 : that.eventFun();
			that.eventFun();
			that.setHeight(that.options);
		},
		setHeight: function(o){
			var that = this;
			if(!that.options.width) that.options.width = that.options.parent.width();
			var totalWidth = 0, ulWidth = 0;
			if(!o.border){
				if(o.background_color == 'none') var a_css 				= {'color':o.text_color};
				else var a_css 											= {'color':o.text_color,'background-color':o.background_color};
				if(o.background_hover_color == 'none')	var hover_css 	= {'color':o.text_hover_color};
				else var hover_css 										= {'color':o.text_hover_color,'background-color':o.background_hover_color};	
			}	
			else{
				if(o.background_color == 'none') var a_css 				= {'color':o.text_color,'border':'1px solid '+o.border_color};
				else var a_css 											= {'color':o.text_color,'background-color':o.background_color,'border':'1px solid '+o.border_color};
				if(o.background_hover_color == 'none')	var hover_css 	= {'color':o.text_hover_color,'border':'1px solid '+o.border_hover_color};
				else var hover_css 										= {'color':o.text_hover_color,'background-color':o.background_hover_color,'border':'1px solid '+o.border_hover_color};
			}
			o.self.find('a').css(a_css);
			o.self.find('span.jPag-current').css(hover_css);
			o.self.find('a').hover(
			function(){
				$(this).css(hover_css);
			},
			function(){
				$(this).css(a_css);
			}
			);
			that.options.self.find('ul li').each(function(i, e){
				if(i < that.options.display){
					totalWidth += e.offsetWidth;
				}
				ulWidth += e.offsetWidth;
			});
			//totalWidth += 2;
			that.options.self.find('ul').css('width', ulWidth + 'px');
			that.options.self.find('ul').parent().css('width', totalWidth + 'px');
			
			that.options.self.css('left', (that.options.width - that.options.self.width())/2 + 'px');
			var height = that.options.self.height() ? that.options.self.height() : 34;
			that.options.parent.css('height', height + 'px');
			
		},
		eventFun: function(){
			var that = this;
			var timer = null;
			if(that.options.rotate){
				//left
				that.options.self.find('.jPag-sprevious').hover(function(e){
					timer = setInterval(function(){
						var left = that.options.self.find('ul').parent().scrollLeft() - 2;
					    that.options.self.find('ul').parent().scrollLeft(left);
					}, 20);
				},
				function(){
					clearInterval(timer);
				});
				//right
				that.options.self.find('.jPag-snext').hover(function(e){
					timer = setInterval(function(){
						var left = that.options.self.find('ul').parent().scrollLeft() + 2;
					    that.options.self.find('ul').parent().scrollLeft(left);
					}, 20);
				},
				function(){
					clearInterval(timer);
				});
				if(that.options.mouse == 'press'){
					//left
					that.options.self.find('.jPag-sprevious').mousedown(function(e){
						e.stopPropagation();
						timer = setInterval(function(){
							var left = that.options.self.find('ul').parent().scrollLeft() - 5;
							that.options.self.find('ul').parent().scrollLeft(left);
						}, 20);
					}).mouseup(function(){
						clearInterval(timer);
						}
					);
					//right
					that.options.self.find('.jPag-snext').mousedown(function(e){
						e.stopPropagation();
						timer = setInterval(function(){
							var left = that.options.self.find('ul').parent().scrollLeft() + 5;
							that.options.self.find('ul').parent().scrollLeft(left);
						}, 20);
					}).mouseup(function(){
						clearInterval(timer);
						}
					);
				}
			}
			//li  点击事件
			that.options.self.find('li').bind('click', function(e, string){
				e.preventDefault();
				if($(this).find('span').length && !string) return;
				var selobj = that.options.self.find('.jPag-current').parent();
				selobj.html('<a>'+selobj.find('.jPag-current').html()+'</a>'); 
				var currval = parseInt($(this).find('a').html());
				$(this).html('<span class="jPag-current">'+currval+'</span>');
				if(typeof that.options.onChange == 'function'){
					that.options.onChange.call(this, parseInt(currval), string);
				}
				that.setHeight(that.options);
			});
			//first  点击事件
			that.options.self.find('.jPag-first').bind('click', function(){
				if(typeof that.options.onChange == 'function'){
					that.options.self.find('ul').parent().animate({scrollLeft: '0px'});
					that.options.self.find('ul li').eq(0).trigger('click', 'first');
				}
			});
			//last  点击事件
			that.options.self.find('.jPag-last').bind('click', function(){
				if(typeof that.options.onChange == 'function'){
					var width = that.options.self.find('ul').width() - that.options.self.find('ul').parent().width();
					that.options.self.find('ul').parent().animate({scrollLeft: width + 'px'});
					that.options.self.find('ul li').eq(that.options.count - 1).trigger('click', 'last');
				}
			});
			that.options.self.find('button').bind('click', function(){
				var input = that.options.self.find('input');
				var int = input.val();
				input.val('');
				if((/^[\d]+$/).test(int) && parseInt(int) <= o.count && parseInt(int) > 0){
					if(parseInt(int) == 1){
						that.options.self.find('ul li').eq(0).trigger('click', 'first');
					}else if(parseInt(int) == o.count){
						that.options.self.find('ul li').eq(o.count - 1).trigger('click', 'last');
					}else{
						that.options.self.find('ul li').eq(int - 1).trigger('click');
					}
				}else{
					alert('请正确输入页数');
				}
			})
		},
		update: function(options){
			var that = this;
			$.extend(that.options, options);
			that.draw(true);
		}
	}
	window.paginate = paginate;
})();