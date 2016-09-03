<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '推送管理';
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">
<link rel="stylesheet" href="/ace/style/dingshi.css">
<div class="main-container" id="main-container" ng-controller="mainController"> 
  <script type="text/javascript">
					try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	</script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/weixin_setting.php');?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs"> 
        <script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
        <ul class="breadcrumb">
          <li>推送管理</li>
        </ul>
        <!-- .breadcrumb --> 
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="tabbable">
              <ul class="nav nav-tabs" id="myTab">
                <li class="active"> <a data-toggle="tab" href="#info">群发消息</a> </li>
                <li> <a data-toggle="tab" href="#sent">已发送</a> </li>
              </ul>
              <div class="tab-content">
                <div id="info" class="tab-pane in active">
                  <form class="form-horizontal" ro;e="form">
                    <div class="space-6"></div>
                    <div class=" alert alert-block label-yellow yellow-border">
                      <button type="button" class="close" data-dismiss="alert"> <i class="icon-remove"></i> </button>
                      <i class="icon-warning-sign"></i> 为保障用户体验，微信公众平台严禁恶意营销以及诱导分享朋友圈，严禁发布色情低俗、暴力血腥、政治谣言等各类违反法律法规及相关政策规定的信息。一旦发现，我们将严厉打击和处理。 </div>
                    <div class="space-12"></div>
                    <div class="form-group margin-bottom10 clearfix">
                      <div class="col-sm-12">
                        <label> <span class="lbl"> 群发用户 </span>&nbsp;
                          <select class="width150 margin-right4 clearfix">
                            <option placeholder="全部用户">全部用户</option>
                            <option placeholder="未分组">未分组</option>
                            <option placeholder="星标组">星标组</option>
                            <option placeholder="新建分组1">新建分组1</option>
                            <option placeholder="星标组">黑名单</option>
                          </select>
                          &nbsp;&nbsp; </label>
                        <label> <span class="lbl"> 性别 </span>&nbsp;
                          <select class="width150 margin-right4 clearfix">
                            <option placeholder="全部">全部</option>
                            <option placeholder="男">男</option>
                            <option placeholder="女">女</option>
                          </select>
                          &nbsp;&nbsp; </label>
                        <label> <span class="lbl"> 群发地区 </span>&nbsp;
                          <select class="width150 margin-right4 clearfix">
                            <option placeholder="请选择">请选择</option>
                            <option placeholder="广东省">广东省</option>
                            <option placeholder="广西省">广西省</option>
                          </select>
                          <select class="width150 margin-right4 clearfix">
                            <option placeholder="请选择">请选择</option>
                            <option placeholder="广东省">广东省</option>
                            <option placeholder="广西省">广西省</option>
                          </select>
                          <select class="width150 margin-right4 clearfix">
                            <option placeholder="请选择">请选择</option>
                            <option placeholder="广东省">广东省</option>
                            <option placeholder="广西省">广西省</option>
                          </select>
                          &nbsp;&nbsp; </label>
                      </div>
                    </div>
                    <div class="space-10"></div>
                    <div>已选择 <span class="dashbd-figure">星标组 222位粉丝</span> 给他们发送消息</div>
                    <div class="space-10"></div>
                    <div class="form-group clearfix">
                      <div class="col-xs-12">
                        <div id="show" class="col-sm-10 sucai"> <a href=""  data-toggle="modal" data-target="#insert-material">插入素材</a> <a href=""  data-toggle="modal" data-target="#insert-material" title="单图文素材"><i class="icon-comment align-top icon-only"></i></a> <a href=""  data-toggle="modal" data-target="#insert-material" title="多图文素材"><i class="icon-comments align-top icon-only"></i></a> <a href=""  data-toggle="modal" data-target="#insert-material" title="文本素材"><i class="icon-file-text  align-top icon-only"></i></a> <a href=""  data-toggle="modal" data-target="#insert-material" title="图片素材"><i class="icon-picture align-top icon-only"></i></a> <a href="" data-toggle="modal" data-target="#insert-material" title="语音素材"><i class="icon-bell-alt align-top icon-only"></i></a> <a href="" data-toggle="modal" data-target="#insert-material" title="视频素材"><i class="icon-facetime-video align-top icon-only"></i></a> </div>
                        <div class="comment col-sm-10 no-padding">
                          <div class="com_form">
                            <textarea class="input" id="saytext" name="saytext"></textarea>
                            <div class="face-box col-sm-12"> <span class="emotion float-left"></span> <span class="dropdown "><a href="#" data-toggle="dropdown" class="material" id="topSearch3" title="插入链接"> <i class="icon-link bigger-130"></i> </a>
                              <div id="topSearch_cont3" class="pull-left dropdown-menu dropdown-yellow dropdown-caret dropdown-close width300px no-padding-bottom" style="display: none;">
                                <div class="col-sm-12 no-padding-right form-group clearfix"><a href="#" id="closeAn3" class="bootbox-close-button close">×</a></div>
                                <div class="clearfix col-sm-12 font-size12px">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                      <tr>
                                        <td align="right"><input type="text" class="col-sm-12" placeholder="http://"></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="modal-footer float-left clearfix width100 no-padding-left"> <a href="#" data-bb-handler="cancel" class="btn btn-xs btn-default">取消</a> <a href="#" data-bb-handler="confirm" class="btn btn-xs btn-primary">确定</a> </div>
                              </div>
                              </span> <span class="text-hint float-right">还可以输入600字</span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="space-12"></div>
                    <div class="form-group margin-bottom10 clearfix">
                      <div class="col-sm-9 margin-left10 clearfix"> 
                        <a href="#" class="btn btn-primary" > <i class="icon-ok bigger-110"></i> 群发 </a> 
                        <a href="javascript:void(0)" class="btn btn-primary" data-loading-text="正在新建定时任务..." id="btnTimeSend"> <i class="icon-ok bigger-110"></i>定时群发</a> 
                      </div>
                      <!-- 定时发送 -->
                      <div class="ui-popover right-center">
                        <div class="ui-popover-inner clearfix">
                          <div class="input-group width300">
                            <input type="text" class="width180" style="height:28px; border-right:none"  onfocus="WdatePicker({minDate:'', dateFmt:'yyyy-MM-dd HH:mm:ss'})"><span class="input-group-addon">
                                    <i class="icon icon-clock-o bigger-110 "></i>
                             </span>
                            <span class="margin-left10">
                              <a href="javascript:;" class="btn btn-xs btn-primary">确定</a> 
                              <a href="javascript:;" class="btn btn-xs btn-default">取消</a>
                            </span>
                          </div>
                      </div>
                        <div class="arrow"></div>
                      </div>
                    </div>
                  </form>
                </div>
                <div id="sent" class="tab-pane">
                  <form class="form-horizontal" ro;e="form">
                    <div class="no-padding margin-bottom10 clearfix">
                      <div class="col-sm-7 no-padding">
                        <ul class="listli left-space1 btn-primary">
                          <li> <a href="#" class="btn btn-xs btn-danger">删除</a> </li>
                        </ul>
                      </div>
                      <div class="col-sm-5 no-padding">
                        <div class="col-sm-12 float-right no-padding">
                          <div class="float-right">
                            <div class="input-group float-left">
                              <input class="min-width120 float-left" placeholder="搜索消息相关关键字" type="text">
                              <span class="float-left "> <a href="#" class="btn btn-xs btn-primary margin_right1"><i class="icon-search icon-on-right bigger-110"></i></a> </span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive clearfix">
                      <table class="table table-striped table-bordered table-hover no-margin">
                        <thead>
                          <tr>
                            <th class="lt-width text-center"> <label>
                                <input type="checkbox" class="ace">
                                <span class="lbl"></span></label>
                            </th>
                            <th width="10%">操作</th>
                            <th>内容</th>
                            <th width="7%">消息类型</th>
                            <th width="7%">发送状态</th>
                            <th width="7%">发送对象</th>
                            <th width="17%">发送时间</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="lt-width text-center"><label>
                                <input type="checkbox" class="ace">
                                <span class="lbl"></span></label></td>
                            <td class="visible-md visible-lg hidden-sm hidden-xs action-buttons"><a class="success" href="#" title="再次发送"> <i class="icon-share-alt bigger-130"></i> </a> <a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i></a></td>
                            <td><img src="/ace/images/goods-pic.jpg" width="60" height="60"></td>
                            <td>单图文</td>
                            <td>已发送</td>
                            <td>星标组</td>
                            <td>2014-08-19 15:15:05</td>
                          </tr>
                          <tr>
                            <td class="lt-width text-center"><label>
                                <input type="checkbox" class="ace">
                                <span class="lbl"></span></label></td>
                            <td class="visible-md visible-lg hidden-sm hidden-xs action-buttons"><a class="success" href="#" title="再次发送"> <i class="icon-share-alt bigger-130"></i> </a> <a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i></a></td>
                            <td>“APEC蓝”让督查人员想哭：1公里路喊了4次停</td>
                            <td>视频</td>
                            <td>已发送</td>
                            <td>未分组用户</td>
                            <td>2014-08-19 15:15:05</td>
                          </tr>
                          <tr>
                            <td class="lt-width text-center"><label>
                                <input type="checkbox" class="ace">
                                <span class="lbl"></span></label></td>
                            <td class="visible-md visible-lg hidden-sm hidden-xs action-buttons"><a class="success" href="#" title="再次发送"> <i class="icon-share-alt bigger-130"></i> </a> <a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i></a></td>
                            <td>深圳一小学班主任因买房缺钱向多名家长借钱,深圳一小学班主任因买房缺钱向多名家长借钱</td>
                            <td>语音</td>
                            <td>已发送</td>
                            <td>全部用户</td>
                            <td>2014-08-19 15:15:05</td>
                          </tr>
                          <tr>
                            <td class="lt-width text-center"><label>
                                <input type="checkbox" class="ace">
                                <span class="lbl"></span></label></td>
                            <td class="visible-md visible-lg hidden-sm hidden-xs action-buttons"><a class="success" href="#" title="再次发送"> <i class="icon-share-alt bigger-130"></i> </a> <a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i></a></td>
                            <td><img src="/ace/images/goods-pic.jpg" width="60" height="60"> <img src="/ace/images/goods-pic.jpg" width="60" height="60"></td>
                            <td>多图文</td>
                            <td>已发送</td>
                            <td>全部用户</td>
                            <td>2014-08-19 15:15:05</td>
                          </tr>
                          <tr>
                            <td class="lt-width text-center"><label>
                                <input type="checkbox" class="ace">
                                <span class="lbl"></span></label></td>
                            <td class="visible-md visible-lg hidden-sm hidden-xs action-buttons"><a class="success" href="#" title="再次发送"> <i class="icon-share-alt bigger-130"></i> </a> <a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i></a></td>
                            <td class="wpb"><div class="dtw_tu"></div>
                              <span>4"</span></td>
                            <td>语音</td>
                            <td>已发送</td>
                            <td>全部用户</td>
                            <td>2014-08-19 15:15:05</td>
                          </tr>
                          <tr>
                            <td class="lt-width text-center"><label>
                                <input type="checkbox" class="ace">
                                <span class="lbl"></span></label></td>
                            <td class="visible-md visible-lg hidden-sm hidden-xs action-buttons"><a class="success" href="#" title="再次发送"> <i class="icon-share-alt bigger-130"></i> </a> <a class="red" href="#" title="删除"> <i class="icon-trash bigger-130"></i></a></td>
                            <td><img src="/ace/images/goods-pic.jpg" width="60" height="60"></td>
                            <td>图片</td>
                            <td>已发送</td>
                            <td>全部用户</td>
                            <td>2014-08-19 15:15:05</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.main-container-inner --> 
  </div>
</div>

<script language="javascript" type="text/javascript" src="/ace/js/DatePicker/WdatePicker.js"></script> 
<script>
app.controller('mainController', function($scope, $rootScope){

});
</script>
<script type="text/javascript">
      $(".dtw_tu").click(function(){
        $(this).addClass("dtwplay");
        setTimeout(function(){
          $(".dtw_tu").removeClass("dtwplay");
        },5000);
      });
   </script> 
<script type="text/javascript">
      jQuery(function($) {

        $('.slim-scroll').each(function () {
          var $this = $(this);
          $this.slimScroll({
            height: $this.data('height') || 100,
            railVisible:true
          });
        });

      })
$(function(){
  $("#topSearch").click(function(){
    $("#topSearch").parent().addClass("open");
    $("#topSearch_cont").css("display","block");
  })
  $("#closeAn").click(function(){
    $("#topSearch").parent().remove("open");
    $("#topSearch_cont").css("display","none");
  })
  $("#topSearch2").click(function(){
    $("#topSearch2").parent().addClass("open");
    $("#topSearch_cont2").css("display","block");
  })
  $("#closeAn2").click(function(){
    $("#topSearch2").parent().remove("open");
    $("#topSearch_cont2").css("display","none");
  })
  $("#topSearch3").click(function(){
    $("#topSearch3").parent().addClass("open");
    $("#topSearch_cont3").css("display","block");
  })
  $("#closeAn3").click(function(){
    $("#topSearch3").parent().remove("open");
    $("#topSearch_cont3").css("display","none");
  })
})
</script> 
<script type="text/javascript" src="/ace/js/jquery.qqFace.js"></script> 
<script type="text/javascript">
$(function(){
	$('.emotion').qqFace({
		id : 'facebox',
		assign:'saytext',
		path:'/ace/arclist/'	//表情存放的路径
	});
	$(".sub_btn").click(function(){
		var str = $("#saytext").val();
		$("#show").html(replace_em(str));
	});
});
//查看结果
function replace_em(str){
	str = str.replace(/\</g,'&lt;');
	str = str.replace(/\>/g,'&gt;');
	str = str.replace(/\n/g,'<br/>');
	str = str.replace(/\[em_([0-9]*)\]/g,'<img src="arclist/$1.gif" border="0" />');
	return str;
}

       //定时发送
$("#btnTimeSend").click(function(event) {
    /* Act on the event */
    console.log(111);

    $(".ui-popover").show();
    $(".ui-popover").css({"margin-left":"175px","margin-top":"-10px"});
});
$(".js-save").click(function(event) {
    /* Act on the event */
     $(".ui-popover").hide();
     window.location.href="http://backend.cxm/site/view?u=/weixin/dingshi";
});
$(".js-cancel").click(function(event) {
    /* Act on the event */
     $(".ui-popover").hide();
});
 </script> 
