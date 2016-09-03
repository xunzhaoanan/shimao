<link rel="stylesheet" type="text/css" href="/ace/style/wx_menu/wxmenu.css">
<div class="main-container" id="main-container" ng-controller="mainController">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div
    class="main-container-inner"> <?php echo $this->render('@app/views/side/weixin_setting.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li> 自定义菜单</li>
        </ul>
        <!-- .breadcrumb -->
        <!-- #nav-search -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <div class="space-6 clearfix col-sm-12 floatnone"></div>
            <div class="weixinmenu_top">
              <!-- <div class="weixinmenu_orper"></div> -->
              <span class="wxicon unlock"> </span>

              <div>
                <h4 class="wxmenu_title">已开启自定义菜单</h4>

                <p class="wxmenu_sm"> 通过编辑和发布自定义菜单来进行便携管理，如具备开发能力，可更灵活地使用该功能。<a href=""
                                                                                data-toggle="modal"
                                                                                data-target="#myModal2">查看详情</a>
                  <a href="" class="btn btn-danger margin-left10" data-toggle="modal"
                     data-target="#myModal3">停用</a> <a href="" data-toggle="modal"
                                                       data-target="#myModal4"
                                                       class="btn btn-success margin-left10"
                                                       style="display:none;">启用</a></p>
              </div>
            </div>
            <div class="space-6 clearfix col-sm-12 floatnone"></div>
            <div class="clearfix col-sm-12 floatnone">可创建最多3个一级菜单，每个一级菜单下可创建最多5个二级菜单。</div>
            <div class="space-6 clearfix col-sm-12 floatnone"></div>
            <!--商品活动列表-->
            <div class="table-responsive wxmenumain clearfix">
              <div class="wxmenu_cont clearfix">
                <div class="wxmenu_left">
                  <h1>菜单管理<i class="icon-list"></i><i class="icon-plus wxsort"></i></h1>

                  <div>
                    <dl>
                      <dt class="selectwx"><a href=""><em class="icon-caret-right"></em> 4个汉字或8个字母<i
                            class="icon-pencil"></i><i class="icon-trash"></i><i
                            class="icon-plus"></i></a></dt>
                      <dd><a href="">8个汉字或16个字母<i class="icon-pencil"></i><i class="icon-trash"></i></a>
                      </dd>
                      <dd><a href="">微商城子菜单2<i class="icon-pencil"></i><i
                            class="icon-trash"></i></a></dd>
                      <dd><a href="">微商城子菜单<i class="icon-pencil"></i><i class="icon-trash"></i></a>
                      </dd>
                    </dl>
                    <dl>
                      <dt><a href=""><em class="icon-caret-right"></em> 微商城1<i
                            class="icon-pencil"></i><i class="icon-trash"></i><i
                            class="icon-plus"></i></a></dt>
                      <dd><a href="">微商城子菜单1<i class="icon-pencil"></i><i
                            class="icon-trash"></i></a></dd>
                      <dd><a href="">微商城子菜单2<i class="icon-pencil"></i><i
                            class="icon-trash"></i></a></dd>
                      <dd><a href="">微商城子菜单<i class="icon-pencil"></i><i class="icon-trash"></i></a>
                      </dd>
                    </dl>
                    <dl>
                      <dt><a href=""><em class="icon-caret-right"></em> 微商城1<i
                            class="icon-pencil"></i><i class="icon-trash"></i><i
                            class="icon-plus"></i></a></dt>
                      <dd><a href="">微商城子菜单1<i class="icon-pencil"></i><i
                            class="icon-trash"></i></a></dd>
                      <dd><a href="">微商城子菜单2<i class="icon-pencil"></i><i
                            class="icon-trash"></i></a></dd>
                      <dd><a href="">微商城子菜单<i class="icon-pencil"></i><i class="icon-trash"></i></a>
                      </dd>
                    </dl>
                    <!-- 新增一二级菜单时，超出则提"一级菜单最多只能三个" "二级菜单最多只能5个" -->
                  </div>
                </div>
                <div class="wx_r_box menuset_bg wx_media_r">
                  <div class="wx_r_box2">
                    <div class="wx_test_box">
                      <div class="index_main_box">
                        <div class="title"><span class="fl">当前选中： </span></div>
                        <div class="table_box">
                          <dl class="dl-horizontal control_group">
                            <dt>菜单名称：</dt>
                            <dd>
                              <input type="text" maxlength="6" name="menuname" value="">
                            </dd>
                            <dt>关键词：</dt>
                            <dd>
                              <input type="text" id="keyword" name="keyword" readonly="readonly"
                                     value="">
                              <input type="button" value="关联" id="guanlian"
                                     class="btn_key btn btn-success width-80px"/>
                            </dd>
                            <dt> 回复类型：</dt>
                            <dd>
                              <input type="hidden" id="typeurl" name="typeurl" value="">
                              <select name="website_reply_categories_id" id="replyType">
                                <option value="0">请选择</option>
                              </select>
                            </dd>
                          </dl>
                          <div class="inputbox_group">
                            <p class="red">提示:</p>

                            <p>①：当回复类型的下拉框不选择的时候，会自动使用关键词关联(必需是完全匹配关键词)；</p>

                            <p>②：当回复类型的下拉框选择了类型的时候，会优先使用回复类型；</p>

                            <p>③：菜单可以上下拖动，以变更顺序；</p>

                            <p>④：菜单名称不得超过6个字符。</p>

                            <p>⑤：微信菜单发布需24小时后生效，建议在生成微信菜单前，取消关注公众号，生成后，再重新关注即可看到最新菜单效果。</p>
                            <br/>

                            <div class="wx_foot wx_test_box">
                              <input type="submit" class="btn_key btn btn-success width-80px"
                                     value="保存">
                              <button class="btn_key btn btn-success width-150px" type="button"
                                      id="publish">微信菜单发布
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="wxmeun_bot">
                <p class="menu_msg red">菜单未发布</p>

                <p class="menu_msg red" style="display:none">待发布(还有13小时)</p>

                <p class="menu_msg green" style="display:none">菜单正在使用中</p>

                <p class="menu_tips">编辑中的菜单需要进行发布才能更新到用户手机上</p>
              </div>
            </div>
            <div class="text-center margin-top20"><a id="post" href="#"
                                                     class="btn btn-success width-160px">发布</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.main-container-inner -->
  </div>
</div>
<!--弹窗-->
<div class="bootbox modal fade in" id="myModal2" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog3">
    <div class="modal-content">
      <div class="modal-header modal-header2"><a href="#" class="bootbox-close-button close"
                                                 data-dismiss="modal">×</a>
        <h4 class="modal-title">温馨提示</h4>
      </div>
      <div class="modal-body">
        <div class="bootbox-body">
          <div class="showinfor hintmain">
            <h2>该项需要有开发能力才能进行</h2>

            <p class="grey">开发者需要完成以下两步，来进行自动回复的开发</p>
            1. 阅读自定义菜单接口文档，并在开发者中心获取AppID和AppSecret<br>
            2. 通过自定义菜单接口，创建、修改和删除自定义菜单<br>
            3. 阅读接入指南接口文档，并在开发者中心设置回调URL和Token,以接收自定义菜单的开发者事件推送
          </div>
        </div>
      </div>
      <div class="modal-footer"><a href="#" data-bb-handler="cancel"
                                   class="btn btn-success">我知道了</a></div>
    </div>
  </div>
</div>
<!--选择素材-->

<div class="bootbox modal fade in" id="myModal5" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog width90">
    <div class="modal-content">
      <div class="modal-header modal-header2"><a href="#" class="bootbox-close-button close"
                                                 data-dismiss="modal">×</a>
        <h4 class="modal-title">选择素材</h4>
      </div>
      <div class="modal-body">
        <iframe width="100%" height="600px" frameborder="0" scrolling="auto"
                src="sucai.php"></iframe>
      </div>
      <div class="modal-footer no-margin-top"><a href="#" data-bb-handler="cancel"
                                                 class="btn btn-default">取消</a> <a href="#"
                                                                                   data-bb-handler="confirm"
                                                                                   class="btn btn-primary">确定</a>
      </div>
    </div>
  </div>
</div>
<script>
  app.controller('mainController', function ($scope, $timeout, $rootScope, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'fc');
    }, 100);
    function getMenu() {
      $.get('/wx-menu/list')
        .success(function (data) {
          $scope.lists = data.data;
          console.log(data);
          $scope.$apply();
        });
    }

    getMenu();
    $scope.DeleteMenu = function (index) {
      dialog({
        zIndex: 9999998,
        title: "删除商家提示",
        content: "确定要删除该商家吗？",
        okValue: "删除",
        ok: function () {
          $.post('/wx-menu/del?id=' + $scope.lists[index].id, {})
            .success(function (data) {
              getMenu();
            });
        },
        otherBtnValue: "取消",
        otherBtn: function () {
        }
      }).width(320).showModal()
    };
  });
</script>