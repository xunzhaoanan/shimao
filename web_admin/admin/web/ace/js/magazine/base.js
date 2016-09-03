$(document).ready(function() {
    $('.tempate-more-tags').bind('click',function(){
        $('.tempate-more-tags').addClass('active');
        $('.tempate-more-tags dl').slideToggle('slow')
    })

    $('.music_btn').click(function(){
        $('.music_list').slideToggle();
    });

    $("#yemian").hover(
        function(){
            $("#yemianhover").show();
        },function(){
            $("#yemianhover").hide();
        }
    );

    $("#zujian").hover(
        function(){
            $("#zujianhover").show();
        },function(){
            $("#zujianhover").hide();
        }
    );

});

(function($){
    $(window).load(function(){
        //更多模版
        //工具条
        //展示列表
        // $(".templateList, .tool-attributes, #animation-control-style, #app-list,#app-history, .custom-scrollbar").mCustomScrollbar({
        //     keyboard:{scrollType:"stepped"},
        //     autoExpandScrollbar:true
        // });
    });
	wsh.phoneHeight = $('#phone').height();
	wsh.createPagesHeight = $('#createPages').height();
	phoneCenter();
	setInterval('autoScroll("#scroll")',3000);
	$(window).bind('resize', function(){
		phoneCenter();
	});
})(jQuery);
//手机编辑区域的居中处理
function phoneCenter(){
	var height = $('#mainContant').height();
	var top = (height - 45 - wsh.phoneHeight - wsh.createPagesHeight)/2;
	top = top < 0 ? 0 : top;
	$('#phone').css('top', top + 'px');
}
/**
* 文字逐行向上滚动
*/
function autoScroll(obj){
    $(obj).find(".list").animate({
        marginTop : "-25px"
    },500,function(){
        $(this).css({marginTop : "0px"}).find("li:first").appendTo(this);
    })
}