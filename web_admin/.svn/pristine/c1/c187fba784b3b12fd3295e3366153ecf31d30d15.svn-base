<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '回复管理';
?>

<div class="main-container" id="main-container" ng-controller="mainController">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner" style="margin-top:45px;">
    <?php echo $this->render('@app/views/side/weixin_setting.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>回复管理</li>
        </ul>
        <!-- .breadcrumb -->
        <!-- #nav-search -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <!--操作栏-->

            <div class="clearfix no-padding">
              <div class="col-sm-7 no-padding">
                <ul class="listli left-space1 btn-primary bune float-left">
                  <li><a href="/weixin/keyword-reply-add" class="btn btn-xs btn-primary tian">新建关键词回复</a>
                  </li>
                </ul>

                <script type="text/javascript">
                  $(document).ready(function () {
                    $(".tian").click(function () {
                      $(".jiasucai").toggle(0);
                    });
                  });
                </script>
              </div>
              作栏-->
              <div class="space-6 clearfix col-sm-12 floatnone"></div>
              <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                  <li><a data-toggle="tab" href="#home">关键词回复</a></li>
                  <li class="active"><a data-toggle="tab" href="#fa">默认回复</a></li>
                  <li><a data-toggle="tab" href="#pro">关注回复</a></li>
                </ul>
                <div class="tab-content col-sm-12 clearfix">
                  <div id="home" class="tab-pane">
                    <!--关键字回复-->
                    <div role="main2">
                      <ul class="tiles2">
                        <li>
                          <div class="wpb text-center"><b class="blue padding-right6 font-size14">规则名称</b>

                            <div class="float-right">
                              <label>
                                <input name="switch-field-1" class="ace ace-switch ace-switch-6"
                                       checked="" type="checkbox">
                                <span class="lbl"></span> </label>
                            </div>
                          </div>

                          <div class="wpb pibeibg">
                            <span class="label ggzmain_all margin3">你不好</span><span
                              class="label ggzmain margin3"> 你好</span><span
                              class="label ggzmain_all margin3">你就是不好</span><span
                              class="label ggzmain margin3"> 你就是不好</span>
                          </div>
                          <div class="wpb font-size14"><b>随机回复一条消息</b></div>
                          <div class="wpb"><span
                              class="label label-sm label-primary weibq margin-right5">文本</span>我是一条开心的<a
                              href="#">我是链接</a>

                          </div>
                          <div class="wpb"><span
                              class="label label-sm label-primary weibq margin-right5">图文</span>我是一条开心的
                          </div>
                          <div class="wpb"><span
                              class="label label-sm label-primary weibq float-left margin-right5">图片</span>
                            <img src="/ace/images/gallery/image-1.jpg" class="stou" width="45"
                                 height="45">
                          </div>
                          <div class="wpb"><span
                              class="label label-sm label-primary weibq float-left margin-right5">语音</span>

                            <div class="dtw_tu"></div>
                            <span>4"</span></div>
                          <div
                            class="visible-md visible-lg hidden-sm hidden-xs action-buttons weicb">
                            <a class="blue" href="/weixin/keyword-reply-edit" title="编辑"> <i
                                class="icon-pencil bigger-130"></i> </a><a class="red" href="#"
                                                                           title="删除"> <i
                                class="icon-trash bigger-130"></i> </a></div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div id="pro" class="tab-pane">
                    <!--关注回复-->
                    <div id="main1" role="main1">
                      <ul class="tiles1">
                        <li>
                          <div class="wpb text-center"><b class="blue padding-right6 font-size14">规则名称</b>

                            <div class="float-right">
                              <label>
                                <input name="switch-field-1" class="ace ace-switch ace-switch-6"
                                       checked="" type="checkbox">
                                <span class="lbl"></span> </label>
                            </div>
                          </div>
                          <div class="wpb font-size14"><b>随机回复一条消息</b></div>
                          <div class="wpb"><span class="label label-sm label-primary margin-right5">文本</span>我是一条开心的<a
                              href="#">我是链接</a>

                          </div>
                          <div class="wpb"><span class="label label-sm label-primary margin-right5">图文</span>我是一条开心的

                          </div>
                          <div class="wpb"><span
                              class="label label-sm label-primary float-left margin-right5">图片</span>
                            <img src="/ace/images/gallery/image-1.jpg" class="stou" width="45"
                                 height="45">

                          </div>
                          <div class="wpb"><span
                              class="label label-sm label-primary float-left margin-right5">语音</span>

                            <div class="dtw_tu"></div>
                            <span>4"</span></div>
                          <div class="text-center pibeibg"><a class="blue" id="default"
                                                              href="/weixin/attention-reply-edit"
                                                              title="编辑"> <i
                                class="icon-pencil bigger-130"></i> </a></div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div id="fa" class="tab-pane active">
                    <!--默认回复-->
                    <div id="main12" role="main2">
                      <ul class="tiles2">
                        <li>
                          <div class="wpb text-center"><b class="blue padding-right6 font-size14">规则名称</b>

                            <div class="float-right">
                              <label>
                                <input name="switch-field-1" class="ace ace-switch ace-switch-6"
                                       checked="" type="checkbox">
                                <span class="lbl"></span> </label>
                            </div>
                          </div>
                          <div class="wpb font-size14"><b>随机回复一条消息</b>

                          </div>
                          <div class="wpb"><span
                              class="label label-sm label-primary weibq margin-right5">文本</span>我是一条开心的<a
                              href="#">我是链接</a>

                          </div>
                          <div class="wpb"><span
                              class="label label-sm label-primary weibq margin-right5">图文</span>我是一条开心的

                          </div>
                          <div class="wpb"><span
                              class="label label-sm label-primary weibq float-left margin-right5">图片</span>
                            <img src="/ace/images/gallery/image-1.jpg" class="stou" width="45"
                                 height="45">

                          </div>
                          <div class="wpb"><span
                              class="label label-sm label-primary weibq float-left margin-right5">语音</span>

                            <div class="dtw_tu"></div>
                            <span>4"</span></div>
                          <div class="text-center pibeibg"><a class="blue"
                                                              href="/weixin/default-reply-edit"
                                                              title="编辑"> <i
                                class="icon-pencil bigger-130"></i> </a></div>
                        </li>
                      </ul>
                    </div>
                    <!--/文本素材-->
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
  <div class="bootbox modal fade in" id="insert-material" tabindex="-1" role="dialog"
       open-close-modal aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog6">
      <div class="modal-content">
        <div class="modal-header modal-header2"><a href="#" class="bootbox-close-button close"
                                                   data-dismiss="modal">×</a>
          <h4 class="modal-title">选择素材</h4>
        </div>
        <div class="modal-body">
          <iframe width="100%" height="600px" frameborder="0" scrolling="auto"
                  src="/wxmaterial/index"></iframe>
        </div>
        <div class="modal-footer no-margin-top"><a href="#" data-bb-handler="cancel"
                                                   class="btn btn-default">取消</a> <a href="#"
                                                                                     data-bb-handler="confirm"
                                                                                     class="btn btn-primary">确定</a>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  jQuery(function ($) {

    $('.slim-scroll').each(function () {
      var $this = $(this);
      $this.slimScroll({
        height: $this.data('height') || 100,
        railVisible: true
      });
    });

  })

</script>
<script type="text/javascript">
  $(".dtw_tu").click(function () {
    $(this).addClass("dtwplay");
    setTimeout(function () {
      $(".dtw_tu").removeClass("dtwplay");
    }, 5000);
  });

</script>
<script src="/ace/js/jquery.wookmark.js"></script>
<script src="/ace/js/jquery.imagesloaded.js"></script>
<script>
  $("#attention").click(function () {
    console.log(0000)
    $("#attentionedit").show();
  })
  app.controller('mainController', function ($scope, $http, $rootScope) {


  });
  (function ($) {
    $('.tiles').imagesLoaded(function () {
      // Prepare layout options.
      var options = {
        autoResize: true, // This will auto-update the layout when the browser window is resized.
        container: $('#main'), // Optional, used for some extra CSS styling
        offset: 10, // Optional, the distance between grid items
        itemWidth: 292, // Optional, the width of a grid item
        fillEmptySpace: true // Optional, fill the bottom of each column with widths of flexible height
      };

      // Get a reference to your grid items.
      var handler = $('.tiles li'),
        filters = $('#filters li');

      // Call the layout function.
      handler.wookmark(options);

    });
  })(jQuery);


  (function ($) {
    $('.tiles1').imagesLoaded(function () {
      // Prepare layout options.
      var options = {
        autoResize: true, // This will auto-update the layout when the browser window is resized.
        container: $('#main1'), // Optional, used for some extra CSS styling
        offset: 10, // Optional, the distance between grid items
        itemWidth: 292, // Optional, the width of a grid item
        fillEmptySpace: true // Optional, fill the bottom of each column with widths of flexible height
      };

      // Get a reference to your grid items.
      var handler = $('.tiles1 li'),
        filters = $('#filters li');

      // Call the layout function.
      handler.wookmark(options);

    });
  })(jQuery);


  (function ($) {
    $('.tiles2').imagesLoaded(function () {
      // Prepare layout options.
      var options = {
        autoResize: true, // This will auto-update the layout when the browser window is resized.
        container: $('#main2'), // Optional, used for some extra CSS styling
        offset: 10, // Optional, the distance between grid items
        itemWidth: 292, // Optional, the width of a grid item
        fillEmptySpace: true // Optional, fill the bottom of each column with widths of flexible height
      };

      // Get a reference to your grid items.
      var handler = $('.tiles2 li'),
        filters = $('#filters li');

      // Call the layout function.
      handler.wookmark(options);

    });
  })(jQuery);
</script>