<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '消息回复';
?>
<div class="main-container" id="main-container"> 
    <script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
    <div class="main-container-inner">
         <?php echo $this->render('@app/views/side/weixin_setting.php');?>
        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs"> 
                <script type="text/javascript">
          try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>
                <ul class="breadcrumb">
                    <li>消息回复</li>
                </ul>
                <!-- .breadcrumb --> 
                <!-- #nav-search --> 
            </div>
            <div class="page-content"> 
                <!-- /.page-header --> 
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="space-6"></div>
                        <div class="form-group margin-bottom10 clearfix">
                            <div class="col-xs-9">
                                <div class="form-group margin-bottom10 clearfix">
                                <div class="col-sm-12 no-padding floatnone"> <b>与 <b class="red">午夜阳光</b> 聊天</b></div>
                                <div class="space-6 clearfix floatnone"></div>
                                    <div class="col-xs-12 no-padding">
                                        <div id="show" class="col-sm-12 sucai">
                                        
                                        
                                       <div > <a href=""  data-toggle="modal" data-target="#insert-material">插入素材</a>
                                                    <a href=""  data-toggle="modal" data-target="#insert-material" title="单图文素材"><i class="icon-comment align-top icon-only"></i></a>
                                                    <a href=""  data-toggle="modal" data-target="#insert-material" title="多图文素材"><i class="icon-comments align-top icon-only"></i></a>
                                                    <a href=""  data-toggle="modal" data-target="#insert-material" title="文本素材"><i class="icon-file-text  align-top icon-only"></i></a>
                                                    <a href=""  data-toggle="modal" data-target="#insert-material" title="图片素材"><i class="icon-picture align-top icon-only"></i></a>
                                                    <a href="" data-toggle="modal" data-target="#insert-material" title="语音素材"><i class="icon-bell-alt align-top icon-only"></i></a>
                                                    <a href="" data-toggle="modal" data-target="#insert-material" title="视频素材"><i class="icon-facetime-video align-top icon-only"></i></a></div>
                                        
                                        </div>
                                        <div class="col-xs-12 liaotian">
                                            <div class="xbmh"> <span class="label label-sm label-primary margin-right5 weibq">单图文</span>我是一条开心店铺主页的</div>
                                            <div class="xbmh"> <span class="label label-sm float-left label-primary margin-right5 weibq">图片素材</span> <img src="/ace/images/gallery/image-1.jpg" class="stou" width="45" height="45"></div>
                                        </div>
                                        <div class="comment col-sm-12 no-padding">
                                            <div class="com_form">
                                                <textarea class="input" id="saytext" name="saytext"></textarea>
                                                <div class="face-box col-sm-12"> <span class="emotion float-left"></span> <span class="dropdown "><a href="#" data-toggle="dropdown" class="material" id="topSearch3" title="插入链接"> <i class="icon-link bigger-130"></i> </a>
                                                    <div id="topSearch_cont3" class="pull-left dropdown-menu dropdown-yellow dropdown-caret dropdown-close width300px no-padding-bottom" style="display: none;">
                                                        <div class="form-group clearfix"><a href="#" id="closeAn3" class="bootbox-close-button close margin-right10">×</a></div>
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
                                <div class="form-group margin-bottom10 clearfix">
                                    <div class="col-sm-12 no-padding-right"> <a href="#" class="btn btn-primary float-right"> <i class="icon-ok bigger-110"></i> 发送 </a> </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group clearfix">
                                    <div class="col-sm-12 no-padding-right">
                                        <h5 class="details-data no-margin">详细资料</h5>
                                    </div>
                                </div>
                                <div class="form-group margin-bottom10 clearfix">
                                    <div class="col-sm-12 no-padding-right clearfix"> <span class="portrait margin-right10 col-sm-3 no-padding-left"> <img src="/ace/images/tu1_03.jpg"> </span> <span class="pet-name float-left col-sm-8">午夜阳光</span> <span class="gender  float-left col-sm-8">女</span> </div>
                                </div>
                                <div class="space-6"></div>
                                <div class="form-group margin-bottom5 clearfix">
                                    <label class="width-85px float-left padding-left10">签 名:</label>
                                    <div class="col-sm-8 no-padding-right clearfix">
                                        <label>我是微信签名我是微信签名</label>
                                    </div>
                                </div>
                                <div class="form-group margin-bottom5 clearfix">
                                    <label class="width-85px float-left padding-left10">地 区:</label>
                                    <div class="col-sm-8 no-padding-right clearfix">
                                        <label>中国 浙江 杭州</label>
                                    </div>
                                </div>
                          
                                <div class="form-group margin-bottom5 clearfix">
                                    <label class="width-85px float-left padding-left10">分 组:</label>
                                    <div class="col-sm-8 no-padding-right clearfix">
                                        <label>新建分组1</label>
                                    </div>
                                </div>
                               
                                <div class="form-group margin-bottom5 clearfix">
                                    <label class="width-85px float-left padding-left10">关注时间:</label>
                                    <div class="col-sm-8 no-padding-right clearfix">
                                        <label>2014-08-18 15：39：22</label>
                                    </div>
                                </div>
                                <div class="form-group margin-bottom5 clearfix">
                                    <label class="width-85px float-left padding-left10">备 注:</label>
                                    <div class="col-sm-8 no-padding-right clearfix">
                                        <label class="blue">备注备注</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        
                        <div class="col-xs-12">
                            <div class="clearfix ltjl mpdx">
                                <div class="slim-scroll" data-height="380">
                              
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td><span class="blue">午夜阳光</span><span class="text-muted padding-left10">2014-11-15 16：22：36</span></td>
                                        </tr>
                                        <tr>
                                            <td class="ltjlw">"APEC蓝"让督查人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路喊了4次停</td>
                                        </tr>
                                        <tr>
                                            <td><span class="blue">午夜阳光</span><span class="text-muted padding-left10">2014-11-15 16：22：36</span></td>
                                        </tr>
                                        <tr>
                                            <td class="ltjlw"><img src="/ace/images/mkdt_03.jpg" width="60" height="60"> "APEC蓝"让督查人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路喊了4次停</td>
                                        </tr>
                                        <tr>
                                            <td><span class="blue">午夜阳光</span><span class="text-muted padding-left10">2014-11-15 16：22：36</span></td>
                                        </tr>
                                        <tr>
                                            <td class="ltjlw">人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路喊了4次停</td>
                                        </tr>
                                         <tr>
                                            <td><span class="blue">午夜阳光</span><span class="text-muted padding-left10">2014-11-15 16：22：36</span></td>
                                        </tr>
                                        <tr>
                                            <td class="ltjlw"><img src="/ace/images/mkdt_03.jpg" width="60" height="60"> "APEC蓝"让督查人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路喊了4次停</td>
                                        </tr>
                                        <tr>
                                            <td><span class="blue">午夜阳光</span><span class="text-muted padding-left10">2014-11-15 16：22：36</span></td>
                                        </tr>
                                        <tr>
                                            <td class="ltjlw">人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路人员想哭：1公里路喊了4次停"APEC蓝"让督查人员想哭：1公里路喊了4次停</td>
                                        </tr>
                                    </table>
                              
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
<!-- 插入素材 -->
<div class="bootbox modal fade in"  id="insert-material" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog width90">
        <div class="modal-content">
            <div class="modal-header modal-header2"> <a href="#" class="bootbox-close-button close" data-dismiss="modal">×</a>
                <h4 class="modal-title">选择素材</h4>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <div class="form-group margin-bottom10 clearfix">
                        <div class="col-sm-7 no-padding">
                             <ul class="listli left-space1 btn-primary bune float-left">
                                      <li><a href="#" class="btn btn-xs btn-primary tian">添加素材</a></li>
                                </ul>
                                
                                <ul class="jiasucai">
                                <li><a href="dan.php" target="_blank" >单图文&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>
                                <li><a href="duo.php" target="_blank">多图文&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>
                                <li><a href="wen.php" target="_blank">文本素材&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>
                                <li><a href="tu.php" target="_blank">图片素材&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>
                                <li><a href="yu.php" target="_blank">语音素材&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>
                                <li><a href="shi.php" target="_blank">视频素材&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>
                                </ul>
                        </div>
                        <div class="col-sm-5 no-padding">
                            <div class="col-sm-12 float-right no-padding">
                                <div class="float-right">
                                    <div class="input-group float-left">
                                        <input class="min-width120 float-left" placeholder="搜索消息相关关键字" type="text">
                                        <span class="float-left "> <a href="#" class="btn btn-xs btn-primary margin_right1"> <i class="icon-search icon-on-right bigger-110"></i> </a> </span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tabbable">
                       
                        <script type="text/javascript">
          $(document).ready(function(){
          $(".tian").click(function(){
          $(".jiasucai").toggle(0);
          });
          });
        </script>
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a data-toggle="tab" href="#home">单图文&nbsp;&nbsp;<span class="badge badge-danger">211</span></a> </li>
                            <li><a data-toggle="tab" href="#pro">多图文&nbsp;&nbsp;<span class="badge badge-danger">12</span></a> </li>
                            <li><a data-toggle="tab" href="#fa">文本素材&nbsp;&nbsp;<span class="badge badge-danger">12</span></a> </li>
                            <li><a data-toggle="tab" href="#wan">图片素材&nbsp;&nbsp;<span class="badge badge-danger">12</span></a> </li>
                            <li><a data-toggle="tab" href="#kuan">语音素材&nbsp;&nbsp;<span class="badge badge-danger">12</span></a> </li>
                            <li><a data-toggle="tab" href="#tui">视频素材&nbsp;&nbsp;<span class="badge badge-danger">12</span></a> </li>
                        </ul>
                        <div class="tab-content col-sm-12 clearfix">
                            <div id="home" class="tab-pane active"> 
                                <!--单图文-->
                                <ul class="dtw">
                                    <li>
                                        <h3>我是标题啊啊</h3>
                                        <span class="text-muted">03月1日</span> <img src="assets/images/use01.jpg" width="800" height="355">
                                        <p>我就是内容内容</p>
                                    </li>
                                    <li>
                                        <h3>我是标题啊啊</h3>
                                        <span class="text-muted">03月1日</span> <img src="assets/images/use01.jpg" width="800" height="355">
                                        <p>我就是内容内容</p>
                                    </li>
                                </ul>
                                <!--/单图文--> 
                            </div>
                            <div id="pro" class="tab-pane"> 
                                <!--多图文-->
                                <div id="main" role="main">
                                    <ul id="tiles">
                                        <!-- These are our grid blocks -->
                                        <li style="display: list-item;"><img src="assets/images/use01.jpg">
                                            <h3>我就是标题</h3>
                                            <div class="dws">
                                                <p>我是小小的标题我是小小的标题我是小小的标题我是小小的标题</p>
                                                <img src="assets/images/gallery/image-1.jpg" width="605" height="500"> </div>
                                            <div class="dws">
                                                <p>我是小小的标题我是小小的标题我是小小的标题我是小小的标题</p>
                                                <img src="assets/images/gallery/image-1.jpg" width="605" height="500"> </div>
                                        </li>
                                        <li style="display: list-item;"><img src="assets/images/use01.jpg">
                                            <h3>我就是标题</h3>
                                            <div class="dws">
                                                <p>我是小小的标题我是小小的标题我是小小的标题我是小小的标题</p>
                                                <img src="assets/images/gallery/image-1.jpg" width="605" height="500"> </div>
                                        </li>
                                        <li style="display: list-item;"><img src="assets/images/use01.jpg">
                                            <h3>我就是标题</h3>
                                            <div class="dws">
                                                <p>我是小小的标题我是小小的标题我是小小的标题我是小小的标题</p>
                                                <img src="assets/images/gallery/image-1.jpg" width="605" height="500"> </div>
                                            <div class="dws">
                                                <p>我是小小的标题我是小小的标题我是小小的标题我是小小的标题</p>
                                                <img src="assets/images/gallery/image-1.jpg" width="605" height="500"> </div>
                                        </li>
                                        <li style="display: list-item;"><img src="assets/images/use01.jpg">
                                            <h3>我就是标题</h3>
                                            <div class="dws">
                                                <p>我是小小的标题我是小小的标题我是小小的标题我是小小的标题</p>
                                                <img src="assets/images/gallery/image-1.jpg" width="605" height="500"> </div>
                                        </li>
                                        <li><img src="assets/images/use01.jpg" >
                                            <h3>我就是标题</h3>
                                            <div class="dws">
                                                <p>我是小小的标题我是小小的标题我是小小的标题我是小小的标题</p>
                                                <img src="assets/images/gallery/image-1.jpg" width="605" height="500"> </div>
                                        </li>
                                        <li><img src="assets/images/use01.jpg" >
                                            <h3>我就是标题</h3>
                                            <div class="dws">
                                                <p>我是小小的标题我是小小的标题我是小小的标题我是小小的标题</p>
                                                <img src="assets/images/gallery/image-1.jpg" width="605" height="500"> </div>
                                            <div class="dws">
                                                <p>我是小小的标题我是小小的标题我是小小的标题我是小小的标题</p>
                                                <img src="assets/images/gallery/image-1.jpg" width="605" height="500"> </div>
                                        </li>
                                        <li><img src="assets/images/use01.jpg" >
                                            <h3>我就是标题</h3>
                                            <div class="dws">
                                                <p>我是小小的标题我是小小的标题我是小小的标题我是小小的标题</p>
                                                <img src="assets/images/gallery/image-1.jpg" width="605" height="500"> </div>
                                        </li>
                                        <li style="display: list-item;"><img src="assets/images/use01.jpg">
                                            <h3>我就是标题</h3>
                                            <div class="dws">
                                                <p>我是小小的标题我是小小的标题我是小小的标题我是小小的标题</p>
                                                <img src="assets/images/gallery/image-1.jpg" width="605" height="500"> </div>
                                            <div class="dws">
                                                <p>我是小小的标题我是小小的标题我是小小的标题我是小小的标题</p>
                                                <img src="assets/images/gallery/image-1.jpg" width="605" height="500"> </div>
                                        </li>
                                    </ul>
                                </div>
                                <!--/多图文--> 
                            </div>
                            <div id="fa" class="tab-pane"> 
                                <!--文本素材-->
                                <ul class="dtw">
                                    <li>
                                        <p> 我是一条开心的图文，我是一条开心的图文，我是一条开心的图文<br>
                                            <a href="#">我是一条开心的图文</a><br>
                                            我是一条开心的图文，我是一条开心的图文，哈哈哈。 </p>
                                    </li>
                                </ul>
                                <!--/文本素材--> 
                            </div>
                            <div id="wan" class="tab-pane"> 
                                <!--图片素材-->
                                <ul class="dtw">
                                    <li> <img src="assets/images/use01.jpg" width="800" height="355" class=" no-margin">
                                        <div class="space-6"></div>
                                    </li>
                                </ul>
                                <!--/图片素材--> 
                            </div>
                            <div id="kuan" class="tab-pane"> 
                                <!--语音素材-->
                                <ul class="dtw">
                                    <li>
                                        <div class="dtwcont">
                                            <div class="dtw_tu"></div>
                                            <span>4"</span> </div>
                                        <p class="dtwtitle">我是名称或备注...<span class="float-right light-grey">15K</span></p>
                                    </li>
                                    <li>
                                        <div class="dtwcont">
                                            <div class="dtw_tu"></div>
                                            <span>4"</span> </div>
                                        <p class="dtwtitle">我是名称或备注...<span class="float-right light-grey">15K</span></p>
                                    </li>
                                </ul>
                                <!--/语音素材--> 
                            </div>
                            <div id="tui" class="tab-pane"> 
                                <!--视频素材-->
                                <ul class="dtw">
                                    <li>
                                        <h3>我是标题啊啊</h3>
                                        <span class="text-muted">2014-11-03</span> <img src="assets/images/use01.jpg" width="800" height="355">
                                        <p>我就是内容内容我就是内容内容我就是内容内容我就是内容内容我就是内容内容</p>
                                    </li>
                                </ul>
                                <!--/视频素材--> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer no-margin-top"> <a href="#" data-bb-handler="cancel" class="btn btn-default">取消</a> <a href="#" data-bb-handler="confirm" class="btn btn-primary">确定</a> </div>
        </div>
    </div>
</div>

<!-- 表情 --> 
<script type="text/javascript" src="assets/js/jquery.qqFace.js"></script> 
<script type="text/javascript">
$(function(){
  $('.emotion').qqFace({
    id : 'facebox', 
    assign:'saytext', 
    path:'assets/arclist/'  //表情存放的路径
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

<!-- 浏览记录 --> 
<script type="text/javascript">
      jQuery(function($) {

        var agent = navigator.userAgent.toLowerCase();
        if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
          $('#tasks').on('touchstart', function(e){
          var li = $(e.target).closest('#tasks li');
          if(li.length == 0)return;
          var label = li.find('label.inline').get(0);
          if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
        });
      
        $('#tasks').sortable({
          opacity:0.8,
          revert:true,
          forceHelperSize:true,
          placeholder: 'draggable-placeholder',
          forcePlaceholderSize:true,
          tolerance:'pointer',
          stop: function( event, ui ) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
            $(ui.item).css('z-index', 'auto');
          }
          }
        );
        //$('#tasks').disableSelection();
//        $('#tasks input:checkbox').removeAttr('checked').on('click', function(){
//          if(this.checked) $(this).closest('li').addClass('selected');
//          else $(this).closest('li').removeClass('selected');
//        });
          // scrollables
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

