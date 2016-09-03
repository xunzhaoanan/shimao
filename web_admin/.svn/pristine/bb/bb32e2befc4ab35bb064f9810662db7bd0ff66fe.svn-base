<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '新建音乐素材';
?>

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
          <li>新建音乐素材</li>
        </ul>
        <!-- .breadcrumb --> 
        <!-- #nav-search --> 
      </div>
      <div class="page-content"> 
        <!-- /.page-header --> 
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="space-10"></div>
          <div class="col-sm-12 floatnone">
            <div class="weileft float-left margin-left30">
              <div class="weileftda">
                <ul class="wbsc slim-scroll"  data-height="455">
                  <li> <img src="/ace/images/gallery/image-1.jpg" class="stou" width="605" height="500">
                    <div class="sjyy">
                      <div class="dtw_tu"></div>
                      <span>4"</span> </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="tabbable float-left margin-left32 col-sm-7">
              <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#home">素材编辑</a> </li>
                <li><a data-toggle="tab" href="#pro">关键词回复</a> </li>
              </ul>
              <div class="tab-content col-sm-12 clearfix">
                <div id="home" class="tab-pane active">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="weiright-td ">
                    <tr>
                    <tr>
                      <td class="width91" align="right" valign="top"><span class="red">*</span> 标题</td>
                      <td><input type="text" class="col-sm-4">
                        &nbsp; <span class="text-muted">标题文字长度不超过64个字，默认只显示一排</span></td>
                    </tr>
                    
                      <td align="right" valign="top">消息内容</td>
                      <td><div class="col-sm-12 no-padding floatnone"><a href="#" class="btn btn-sm btn-info "> 重新选择 </a>&nbsp;&nbsp; <span class="text-muted">大小: 不超过5M,    长度: 不超过60s,&nbsp;&nbsp;格式: mp3, wma, wav, amr</span></div>
                        <div class="col-sm-12 padding-bottom10 padding-top10 padding-left0  clearfix floatnone">
                          <div class="sjyy no-padding no-margin">
                            <div class="dtw_tu"></div>
                            <span>4"</span></div>
                        </div></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">排序</td>
                      <td><input type="text" class="col-sm-3"></td>
                    </tr>
                  </table>
                </div>
                <div id="pro" class="tab-pane">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="weiright-td ">
                    <tr>
                      <td class="width91" align="right" valign="top"><span class="red">*</span> 规则名</td>
                      <td><input type="text" class="col-sm-4">
                        &nbsp; <span class="text-muted">规则文字长度不超过60个字</span></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><span class="red">*</span> 关键词</td>
                      <td><div class="dropdown margin-bottom10"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" id="topSearch2" href="#"> 添加关键词 <i class="icon-caret-down"></i> </a>
                          <div id="topSearch_cont2" class="pull-left dropdown-menu dropdown-yellow dropdown-caret dropdown-close width300px no-padding-bottom">
                            <div class="form-group clearfix"><a href="#" id="closeAn2" class="bootbox-close-button close margin-right10">×</a></div>
                            <div class="clearfix col-sm-12 font-size12px">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                  <tr>
                                    <td align="right"><span class="red">*</span> 关键词</td>
                                    <td><input type="text" id="saytext" name="saytext" class="col-sm-10">
                                      <span class="emotion" title="表情"></span></td>
                                  </tr>
                                  <tr>
                                    <td align="right"><span class="red">*</span> 规则</td>
                                    <td><label>
                                        <input name="form-field-radio01" type="radio" class="ace">
                                        <span class="lbl"> 已全匹配</span> </label>
                                      <label>
                                        <input name="form-field-radio01" type="radio" class="ace">
                                        <span class="lbl"> 未全匹配</span> </label></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="modal-footer float-left clearfix width100 no-padding-left"> <a href="#" data-bb-handler="cancel" class="btn btn-xs btn-default">取消</a> <a href="#" data-bb-handler="confirm" class="btn btn-xs btn-primary">确定</a> </div>
                          </div>
                        </div>
                        <span class="label ggzmain_all margin-right3">你不好<span class="close font-size14px pipeic"  data-dismiss="alert"> × </span></span><span class="label ggzmain margin-right3"> 你好<span class="close font-size14px pipeic"  data-dismiss="alert"> × </span></span></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><span class="red">*</span> 发送方式</td>
                      <td><select>
                          <option value="随机发送一条" selected="">随机发送一条</option>
                          <option value="全部发送">全部发送</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td align="right"  valign="top">排序</td>
                      <td><input type="text" class="col-sm-3"></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer margin-auto" id="modal-footer"> <a href="#" class="btn btn-primary"> 确定 </a> <a href="#" class="btn btn-danger"> 关闭 </a> </div>
        </div>
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.main-container-inner --> 
  </div>
</div>
<script type="text/javascript">   
app.controller('mainController', function($scope, $http, $rootScope, $timeout){
      $timeout(function(){$rootScope.$broadcast('leftMenuChange', 1);}, 100);
      });   
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
</script> 
<?php echo $this->render('@app/views/uploadImg/index.php'); ?>