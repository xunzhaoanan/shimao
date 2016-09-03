<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '编辑视频素材';
?>
<div class="main-container" id="main-container" ng-controller="mainController"> 
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
                    <li>编辑视频素材</li>
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
                                <li><a data-toggle="tab" href="#pro">关键词回复</a> </li>
                            </ul>
                            <div class="tab-content col-sm-12 clearfix">
                                <div id="home" class="tab-pane active">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="weiright-td ">
                                        <tr>
                                            <td  align="right" valign="top" class="width91"><span class="red">*</span> 标题</td>
                                            <td ><input type="text" class="col-sm-4 hongguan">
                                                &nbsp; <span class="text-muted red">标题文字长度不超过64个字，默认只显示两排</span></td>
                                        </tr>
                                       
                                        <tr>
                                            <td align="right" valign="top"><span class="red">*</span> 视频</td>
                                            <td><a href="#" class="btn btn-sm btn-info "> 重新选择 </a>&nbsp;&nbsp; <span class="text-muted">大小: 不超过20M,    格式: rm, rmvb, wmv, avi, mpg, mpeg, mp4</span>
                                                <div class="col-sm-12 padding-bottom10 padding-top10 padding-left0 floatnone clearfix"><img src="/ace/images/use01.jpg" width="270" height="160" class="float-left margin-right10"><a href="#" class="btn btn-sm btn-danger" style="position:absolute; bottom:10px"> 删除 </a></div>
                                                </td>
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
                                            <td align="right" valign="top">链接类型</td>
                                            <td><select >
                                                    <option value="请选择" selected="">请选择</option>
                                                    <option value="A点击图文跳转外链">A点击图文跳转外链</option>
                                                    <option value="B点击阅读原文跳转外链">B点击阅读原文跳转外链</option>
                                                </select>&nbsp; 
                                                <span class="text-muted">A类点击图文跳转外链将不能用于群发</span></td>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="top">设置链接</td>
                                            <td><span class="dropdown"><a href="#" data-toggle="dropdown" id="topSearch3" >自定义外链</a>
                                                <div id="topSearch_cont3" class="pull-left dropdown-menu dropdown-yellow dropdown-caret dropdown-close width300px no-padding-bottom">
                                                    <div class="col-sm-12 form-group clearfix"><a href="#" id="closeAn3" class="bootbox-close-button close">×</a></div>
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
                                                </span> &nbsp;&nbsp; <a href="#" data-toggle="modal" data-target="#shang" >商品和分类</a> &nbsp;&nbsp; <a href="#" data-toggle="modal" data-target="#hua">画报和分类</a> &nbsp;&nbsp; <a href="#">店铺主页</a> &nbsp;&nbsp; <a href="#">客户主页</a> &nbsp;&nbsp; <span class="dropdown"> <a data-toggle="dropdown"  href="#">其它 <i class="icon-caret-down bigger-110 width-auto"></i></a>
                                                <ul class="pull-left dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                                    <li><a href="#">活动</a></li>
                                                    <li><a href="#">历史消息</a></li>
                                                </ul>
                                                </span>
                                                <div class="col-sm-12 floatnone space-4"></div>
                                                <div class="xbmh"> <span class="label label-sm label-primary margin-right5 weibq">店铺主页</span>我是一条开心店铺主页的</div>
                                                <div class="xbmh"> <span class="label label-sm label-primary margin-right5 weibq">客户主页</span>客户主页客户主页客户主页</div>
                                                <div class="xbmh"> <span class="label label-sm label-primary margin-right5 weibq">画报</span>客户主页客户主页客户主页</div>
                                                <div class="xbmh"> <span class="label label-sm label-primary margin-right5 weibq">商品</span>客户主页客户主页客户主页</div>
                                                <div class="xbmh"> <span class="label label-sm label-primary margin-right5 weibq">活动</span>大转盘</div>
                                                <div class="xbmh"> <span class="label label-sm label-primary margin-right5 weibq">商品分类</span><span class="label label-xlg label-warning margin-right5"> <a href="#" class="close" data-dismiss="alert"> × </a>商品大类A2-1</span></div>
                                                <textarea class="col-sm-12 padding5 zdywl floatnone" style="height:80px; display:none " placeholder="自定义外链"> </textarea>
                                                <div class="col-sm-12 floatnone space-4"></div></td>
                                        </tr>
                                        <tr>
                                            <td valign="top">&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="pro" class="tab-pane">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="weiright-td ">
                                        <tr>
                                            <td align="right" valign="top"  class="width91"><span class="red">*</span> 规则名</td>
                                            <td><input type="text" class="col-sm-4">
                                                &nbsp; <span class="text-muted">规则文字长度不超过60个字</span></td>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="top"><span class="red">*</span> 关键词</td>
                                            <td>
                                <div class="dropdown margin-bottom10"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" id="topSearch2" href="#"> 添加关键词 <i class="icon-caret-down"></i> </a>
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
                                
                                <span class="label ggzmain_all margin-right3">你不好<span class="close font-size14px pipeic"  data-dismiss="alert"> × </span></span><span class="label ggzmain margin-right3"> 你好<span class="close font-size14px pipeic"  data-dismiss="alert"> × </span></span>
                                
                                
                                
                                
                                
                                    </td>
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
                    <div class="modal-footer margin-auto" id="modal-footer">
					
							 <a href="#" class="btn btn-primary"> 确定 </a>
							 <a href="#" class="btn btn-danger"> 关闭 </a> 
							</div>
                </div>
            </div>
            <!-- /.col --> 
        </div>
        <!-- /.main-container-inner --> 
    </div>
</div>
<!--商品-->
<div class="bootbox modal fade in"  id="shang" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog6">
        <div class="modal-content">
            <div class="modal-header modal-header2"> <a href="#" class="bootbox-close-button close" data-dismiss="modal">×</a>
                <h4 class="modal-title">商品和分类</h4>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <div class="tabbable relative">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"> <a data-toggle="tab" href="#product">商品</a> </li>
                            <li> <a data-toggle="tab" href="#photos">分类</a> </li>
                        </ul>
                        <div class="tab-content clearfix"> 
                            <!--商品-->
                            <div id="product" class="tab-pane in active">
                                <div class="table-responsive">
                                    <div class="margin-bottom10"> 商品编码
                                        <input type="text" class="margin-right10">
                                        商品分类
                                        <select name="select2" class="ui-pg-selbox margin-right10" role="listbox">
                                            <option>商品</option>
                                            <option>商品分类</option>
                                            <option>商品品牌</option>
                                        </select>
                                        <input class="text-muted width-250px" placeholder="" type="text" value="搜索相关关键字或商品名称">
                                        <span> <a href="#" class="btn btn-xs btn-primary margin_right1" ><i class="icon-search icon-on-right bigger-110"></i></a> </span> </div>
                                    <table  class="table table-striped table-bordered table-hover table-width">
                                        <thead>
                                            <tr>
                                                <th width="3%" class="lt-width3 text-center"></th>
                                                <th width="12%">商品编码</th>
                                                <th width="40%">商品名称</th>
                                                <th width="10%">商品分类</th>
                                                <th>库存</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="products">
                                                <td class="lt-width text-center"><label>
                                                        <input name="form-field-radio01" type="radio" class="ace">
                                                        <span class="lbl"> </span> </label></td>
                                                <td> 20140829</td>
                                                <td>上装韩版宽松长袖t恤女款大码打底袖t恤</td>
                                                <td>分类一</td>
                                                <td>23</td>
                                            </tr>
                                            <tr class="products">
                                                <td class="lt-width text-center"><label>
                                                        <input name="form-field-radio01" type="radio" class="ace">
                                                        <span class="lbl"> </span> </label></td>
                                                <td> 20140829</td>
                                                <td>上装韩版宽松长袖t恤女款大码打底袖t恤</td>
                                                <td>分类一</td>
                                                <td>23</td>
                                            </tr>
                                            <tr class="products">
                                                <td class="lt-width text-center"><label>
                                                        <input name="form-field-radio01" type="radio" class="ace">
                                                        <span class="lbl"> </span> </label></td>
                                                <td> 20140829</td>
                                                <td>上装韩版宽松长袖t恤女款大码打底袖t恤</td>
                                                <td>分类一</td>
                                                <td>23</td>
                                            </tr>
                                            <tr class="products">
                                                <td class="lt-width text-center"><label>
                                                        <input name="form-field-radio01" type="radio" class="ace">
                                                        <span class="lbl"> </span> </label></td>
                                                <td> 20140829</td>
                                                <td>上装韩版宽松长袖t恤女款大码打底袖t恤</td>
                                                <td>分类一</td>
                                                <td>23</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="grid-pager">
                                    <ul class="pagination">
                                        <li class="prev disabled"><a href="#"><i class="icon-chevron-left"></i></a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">…</a></li>
                                        <li><a href="#">21</a></li>
                                        <li><a href="#">22</a></li>
                                        <li><a href="#">23</a></li>
                                        <li class="next"><a href="#"><i class="icon-chevron-right"></i></a></li>
                                        <li class="grid-pager-go"> <span>
                                            <input type="text" class="ui-pg-input " size="2" maxlength="7" placeholder="5" role="textbox">
                                            </span> <a href="#" class="btn btn-sm btn-success ">页/跳转</a> </li>
                                    </ul>
                                </div>
                            </div>
                            <!--商品分类-->
                            <div id="photos" class="tab-pane">
                                <div class="table-responsive modal-height1">
                                    <div class="margin-bottom10">请选择商品分类,在同一级分类中，只能选择同级，不能上下级同选。</div>
                                    <div class="margin-bottom10 classifyBox">
                                        <div data-toggle="dropdown" class="selectRule relative"><span>请选择</span><i class="icon-caret-down public_floatrt"></i></div>
                                        <div class="selectRule_show absolute classify dropdown-menu">
                                            <ul>
                                                <li> <a href="#">商品大类A<i class="icon-angle-right public_floatrt"></i></a>
                                                    <ul>
                                                        <li><a href="#">商品大类A1</a></li>
                                                        <li> <a href="#">商品大类A2<i class="icon-angle-right public_floatrt"></i></a>
                                                            <ul>
                                                                <li><a href="#">商品大类A2-1</a></li>
                                                                <li><a href="#">商品大类A2-2</a></li>
                                                                <li><a href="#">商品大类A2-3</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="#">商品大类A3</a></li>
                                                        <li><a href="#">商品大类A4</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">商品大类B<i class="icon-angle-right public_floatrt"></i></a>
                                                    <ul>
                                                        <li><a href="#">商品大类B1</a></li>
                                                        <li><a href="#">商品大类B2</a></li>
                                                        <li><a href="#">商品大类B3</a></li>
                                                        <li><a href="#">商品大类B4</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">商品大类C</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div><span class="label label-xlg label-warning margin-right5"> <a href="#" class="close" data-dismiss="alert"> × </a>商品大类A2-1</span><span class="label label-xlg label-warning margin-right5"> <a href="#" class="close" data-dismiss="alert"> × </a>商品大类A2-2</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"> <a href="#" data-bb-handler="cancel" class="btn btn-default">取消</a> <a href="#" data-bb-handler="confirm" class="btn btn-primary">确定</a> </div>
        </div>
    </div>
</div>

<!--画报-->
<div class="bootbox modal fade in"  id="hua" tabindex="-1" role="dialog" open-close-modal aria-labelledby="hua" aria-hidden="true" >
    <div class="modal-dialog modal-dialog6">
        <div class="modal-content">
            <div class="modal-header modal-header2"> <a href="#" class="bootbox-close-button close" data-dismiss="modal">×</a>
                <h4 class="modal-title">商品和分类</h4>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <div class="tabbable relative">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"> <a data-toggle="tab" href="#bao">画报</a> </li>
                            <li> <a data-toggle="tab" href="#lei">分类</a> </li>
                        </ul>
                        <div class="tab-content clearfix"> 
                            <!--画报-->
                            <div id="bao" class="tab-pane in active">
                                <div class="table-responsive">
                                 
                                 
                                 <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                  <tr>
                    <th width="3%" class="lt-width3 text-center"> 
                      <label><input type="checkbox" class="ace"><span class="lbl"></span> </label>
                    </th>
                    <th>画报标题</th>
                    <th width="15%">创建时间</th>
             
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="lt-width3 text-center">
                      <label><input type="checkbox" class="ace"><span class="lbl"></span> </label>
                    </td>
                 
                    <td>画报标题画报标题画报标题画报标题画报标题画报标题画报标题画报标题</td>
                  
                    <td>2014-08-26 10:36:36</td>
                  </tr>
                   <tr>
                    <td class="lt-width3 text-center">
                      <label><input type="checkbox" class="ace"><span class="lbl"></span> </label>
                    </td>
                 
                    <td>画报标题画报标题画报标题画报标题画报标题画报标题画报标题画报标题</td>
                  
                    <td>2014-08-26 10:36:36</td>
                  </tr>
                  
                </tbody>
              </table>
                                 
                                 
                                 
                                </div>
                                <div class="grid-pager">
                                    <ul class="pagination">
                                        <li class="prev disabled"><a href="#"><i class="icon-chevron-left"></i></a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">…</a></li>
                                        <li><a href="#">21</a></li>
                                        <li><a href="#">22</a></li>
                                        <li><a href="#">23</a></li>
                                        <li class="next"><a href="#"><i class="icon-chevron-right"></i></a></li>
                                        <li class="grid-pager-go"> <span>
                                            <input type="text" class="ui-pg-input " size="2" maxlength="7" placeholder="5" role="textbox">
                                            </span> <a href="#" class="btn btn-sm btn-success ">页/跳转</a> </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!--画报分类-->
                            <div id="lei" class="tab-pane">
                                <div class="table-responsive modal-height1">
                                    <div class="margin-bottom10">请选择画报分类,在同一级分类中，只能选择同级，不能上下级同选。</div>
                                    <div class="margin-bottom10 classifyBox">
                                        <div data-toggle="dropdown" class="selectRule relative"><span>请选择</span><i class="icon-caret-down public_floatrt"></i></div>
                                        <div class="selectRule_show absolute classify dropdown-menu">
                                            <ul>
                                                <li> <a href="#">商品大类A<i class="icon-angle-right public_floatrt"></i></a>
                                                    <ul>
                                                        <li><a href="#">商品大类A1</a></li>
                                                        <li> <a href="#">商品大类A2<i class="icon-angle-right public_floatrt"></i></a>
                                                            <ul>
                                                                <li><a href="#">商品大类A2-1</a></li>
                                                                <li><a href="#">商品大类A2-2</a></li>
                                                                <li><a href="#">商品大类A2-3</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="#">商品大类A3</a></li>
                                                        <li><a href="#">商品大类A4</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">商品大类B<i class="icon-angle-right public_floatrt"></i></a>
                                                    <ul>
                                                        <li><a href="#">商品大类B1</a></li>
                                                        <li><a href="#">商品大类B2</a></li>
                                                        <li><a href="#">商品大类B3</a></li>
                                                        <li><a href="#">商品大类B4</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">商品大类C</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div><span class="label label-xlg label-warning margin-right5"> <a href="#" class="close" data-dismiss="alert"> × </a>商品大类A2-1</span><span class="label label-xlg label-warning margin-right5"> <a href="#" class="close" data-dismiss="alert"> × </a>商品大类A2-2</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"> <a href="#" data-bb-handler="cancel" class="btn btn-default">取消</a> <a href="#" data-bb-handler="confirm" class="btn btn-primary">确定</a> </div>
        </div>
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
<script type="text/javascript">
$(document).ready(function(){
  $(".tian").click(function(){
  $(".zdywl").toggle(100);
  });
});
</script>

<?php echo $this->render('@app/views/uploadImg/index.php'); ?>