<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '新建视频素材';
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
          <li>新建视频素材</li>
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
                <ul class="idan slim-scroll" data-height="455">
                  <li>
                    <div class="weibian action-buttons"><a href="#" title="编辑"><i class="icon-pencil bigger-130"></i></a></div>
                    <div class="idanbg"></div>
                    <h3>我是标题啊啊</h3>
                    <span class="text-muted">2014-08-55</span> <img src="/ace/images/use01.jpg" width="800" height="355">
                    <div class="shi">我是视频介绍我是视频介绍我是视频介绍我是视频<br>
                      <b>查看全文</b></div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="tabbable float-left margin-left32 col-sm-7">
              <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#home">素材编辑</a> </li>
                <!--<li><a data-toggle="tab" href="#pro">关键词回复</a> </li>-->
              </ul>
              <div class="tab-content col-sm-12 clearfix">
                <div id="home" class="tab-pane active">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="weiright-td ">
                    <tr>
                      <td  align="right" valign="top" class="width91"><span class="red">*</span> 标题</td>
                      <td ><input type="text" class="col-sm-4">
                        &nbsp; <span class="text-muted">标题文字长度不超过64个字，默认只显示两排</span></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><span class="red">*</span> 视频</td>
                      <td><a href="#" class="btn btn-sm btn-info "> 重新选择 </a>&nbsp;&nbsp; <span class="text-muted">大小: 不超过20M,    格式: rm, rmvb, wmv, avi, mpg, mpeg, mp4</span>
                        <div class="col-sm-12 padding-bottom10 padding-top10 padding-left0 floatnone clearfix"><img src="/ace/images/use01.jpg" width="270" height="160" class="float-left margin-right10"><a href="#" class="btn btn-sm btn-danger" style="position:absolute; bottom:10px"> 删除 </a></div></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">介绍</td>
                      <td><textarea class="col-sm-12 padding5" style="height:60px;" placeholder=""></textarea>
                        <br>
                        <span class="text-muted">介绍文字长度不超过120个字</span></td>
                    </tr>
                    <tr>
                    <tr>
                      <td align="right" valign="top"><span class="red">*</span> 正文</td>
                      <td><textarea name="textarea" class="col-sm-12 padding5" style="height:120px;" placeholder="">程序员，我是编辑器</textarea></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">设置链接</td>
                      <td><input type="text" class="col-sm-4" name="url" ng-model="model.url" required="required" ng-pattern="/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/" />
                          <span class="red" ng-show="myform.url.$error.pattern && istrue">输入格式错误</span>
                          <span class="red" ng-show="myform.url.$error.required && istrue">必填项</span>
						  <span class="text-muted">请输入完整的http或https地址</span></td>
                    </tr>
                    <tr>
                      <td valign="top">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                </div>
                <div class="text-center"> <a class="btn btn-primary" ng-click="save()" id="submit">保存</a> </div>
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
<script type="text/javascript">
app.controller('mainController', function($scope, $http, $rootScope, $timeout){
      $timeout(function(){$rootScope.$broadcast('leftMenuChange', 1);}, 100);
      });
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
<script type="text/javascript">
//查看结果
function replace_em(str){
	str = str.replace(/\</g,'&lt;');
	str = str.replace(/\>/g,'&gt;');
	str = str.replace(/\n/g,'<br/>');
	str = str.replace(/\[em_([0-9]*)\]/g,'<img src="arclist/$1.gif" border="0" />');
	return str;
}
</script> 
<script type="text/javascript">
$(document).ready(function(){
  $(".tian").click(function(){
  $(".zdywl").toggle(100);
  });
});
</script> 
<?php echo $this->render('@app/views/uploadImg/video.php'); ?>