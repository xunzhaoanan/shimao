<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '对账结算模块使用手册';
?>
<div class="main-container" id="main-container">

  <div class="main-container-inner" ng-controller="mainController" ng-cloak>
      <script type="text/javascript">
          try {
              ace.settings.check('main-container', 'fixed')
          } catch (e) {
          }
      </script>
    <?php echo $this->render('@app/views/side/manage_setting.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }</script>
        <ul class="breadcrumb">
          <li>对账结算模块使用手册</li>
        </ul>
      </div>
      <div class="page-content">
          <div class="row">
              <div class="col-xs-12">

                  <div class="container_fluid CardVoucher">

                      <div class="cont_title">

                          <h3 class="margin-bottom20">对账结算模块使用手册  </h3>
                      </div>
                      <div class="content_form con_bg">
                          <div class="part_bg directory" >
                              <div class="first">
                                  <span><a href="#m_1"><strong>1、对账单设置</strong></a></span>
                                  <div class="second">
                                      <span><a href="#m_11"><em>1.1</em>收款账户设置</a></span>
                                      <div class="third">
                                          <span><a href="#m_111"><em>1.1.1</em>批量导入收款账户</a></span>
                                          <span><a href="#m_112"><em>1.1.2</em>直营店收款账户设置</a></span>
                                      </div>
                                      <span><a href="#m_12"><em>1.2</em>设置转账费率</a></span>
                                  </div>
                              </div>
                              <div class="first">
                                  <span><a href="#m_2"><strong>2、结算通知模版消息设置</strong></a></span>
                              </div>
                              <div class="first">
                                  <span><a href="#m_3"><strong>3、账单统计</strong></a></span>
                              </div>
                              <div class="first">
                                  <span><a href="#m_4"><strong>4、生成结算信息</strong></a></span>
                                  <div class="second">
                                      <span><a href="#m_41"><em>4.1</em>生产列表</a></span>
                                      <span><a href="#m_42"><em>4.2</em>导出表格</a></span>
                                      <span><a href="#m_43"><em>4.3</em>线下打款结算</a></span>
                                      <span><a href="#m_44"><em>4.4</em>生成打款记录</a></span>
                                  </div>
                              </div>
                              <div class="first">
                                  <span><a href="#m_5"><strong>5、发送打款消息</strong></a></span>
                                  <div class="second">
                                      <span><a href="#m_51"><em>5.1</em>编辑推送列表</a></span>
                                      <span><a href="#m_52"><em>5.2</em>推送打款消息</a></span>
                                      <span><a href="#m_53"><em>5.3</em>查看打款记录</a></span>

                                  </div>
                              </div>
                          </div>

                          <div class="c part_bg">
                              <h2>总体流程</h2>
                              <div class="hr hr-10"></div>
                              <div class=" margin-bottom10">
                                  <img src="http://imgcache.vikduo.com/static/9bdc048eeb3a43906330d1ec63b2aabd.png" alt=""/>
                              </div>
                              <p style="font-size: 16px;">
                                  对账单功能是提供给有直营店对账结算需求的商家使用，用于直营店线上支付，扫码支付和POS机收款的订单对账，方便商家对各个直营店的微信支付收款，扫码收款等线上支付的订单进行对账。结算完成之后，通过微信对直营店进行结算信息的推送。
                              </p>
                              <h2 >
                                对账单功能包含两个部分：
                              </h2>
                              <h3 class="margin-bottom10">一，直营店对账统计。</h3>
                              <h3>二，结算信息推送。</h3>
                              <div class="hr hr-10"></div>
                              <h5 id="m_1">1、 对账单设置</h5>
                              <p style="font-size: 16px; color:#666">在微商户后台管理系统中进入“运营设置 -> 对账单设置”页面</p>
                              <div id="m_11" style="font-size:15px; text-indent: 25px;">1.1 收款账户设置</div>
                              <p style="font-size: 14px; text-indent: 50px">收款账户设置是为了给直营店结算打款使用的，如果不需要给直营店进行打款，可以跳过这个步骤，不需要进行设置。</p>
                              <div id="m_111" style="font-size:15px; text-indent: 50px;">1.1.1批量导入收款账户</div>
                              <p style="font-size: 14px; text-indent: 75px">可以批量导入直营店收款账户，</p>
                              <div >
                                  <img src="http://imgcache.vikduo.com/static/e8cb8e2cf290ab98db919794d5ae4441.png" alt=""/>
                              </div>
                              <p style="font-size: 16px;">第一步 下载表格模版，表格模版中包含直营店信息以及已有的收款账户信息。</p>
                              <p style="font-size: 16px;">第二步 填写表格中的收款账户信息。</p>
                              <p style="font-size: 16px;">第三步，点击<a class="inline btn btn-sm btn-primary">批量导入收款帐户</a>，选择刚才的表格文件进行上传导入即可。</p>
                              <div style=" padding-left:15px">
                                  <img src="http://imgcache.vikduo.com/static/3710390601ee51e540938355a588e356.png" alt=""/>
                              </div>

                              <div id="m_112" style="font-size:15px; text-indent: 50px;">1.1.2直营店收款账户设置</div>
                              <p style="font-size: 14px; text-indent: 75px">通过终端店帐号登录或者在微分店直营店管理进入直营店管理后台设置收款账户。</p>
                              <div style=" padding-left:15px">
                                  <img src="http://imgcache.vikduo.com/static/f5d5afbfc15475d8cdc67f2485cabba6.png" alt=""/>
                              </div>

                              <div id="m_12" style="font-size:15px; text-indent: 25px;">1.2设置转账费率</div>
                              <p style="font-size: 14px; text-indent: 50px">转账费率设置是结算时向直营店收取的转账费率，如果不需要给直营店进行打款，可以跳过这个步骤，不需要进行设置。</p>
                              <div style=" padding-left:15px">
                                  <img src="http://imgcache.vikduo.com/static/61e540ef710178be28fe7a799097c19a.png" alt=""/>
                              </div>

                              <h5 id="m_2" class="margin-bottom10">3、结算通知模版消息设置</h5>
                              <p style="font-size: 14px;margin-bottom:0; line-height: 1.5">在微商户后台管理系统中进入“运营设置 -> 消息通知 -> 商家消息”页面</p>
                              <p style="font-size: 14px;margin-bottom: 0; line-height: 1.5">结算通知是用来在结算完成后，用微信或微商户消息对直营店进行结算消息推送，如果不需要进行结算，可以跳过这个步骤，不需要进行设置。</p>
                              <p style="font-size: 14px;margin-bottom: 0; line-height: 1.5">详见消息模版操作说明（链接）</p>

                              <h5 id="m_3" class="margin-bottom10">2、账单统计</h5>
                              <p style="font-size: 14px;margin-bottom:0; line-height: 1.5">在微商户后台管理系统中进入“微分店 -> 直营店对账结算 -> 账单统计”页面</p>
                              <p style="font-size: 14px;margin-bottom: 0; line-height: 1.5">选择统计的时间（以天为单位），勾选需要统计的支付方式（在线支付分为商家发货和门店发货）点击开始统计。</p>
                              <p style="font-size: 14px;margin-bottom: 0; line-height: 1.5">仅计算状态为已完成的订单。</p>
                              <div style=" padding-left:15px">
                                  <img src="http://imgcache.vikduo.com/static/d19b7a9a28677687a2e504bedffff28f.png" class="img-responsive" alt=""/>
                              </div>
                              <p style="font-size: 14px;margin-bottom:0; line-height: 1.5">订单总数：统计该直营店选定时间段内的完成订单总数</p>
                              <p style="font-size: 14px;margin-bottom: 0; line-height: 1.5">订单总额：统计该直营店选定时间段内的完成订单总额</p>
                              <p style="font-size: 14px;margin-bottom: 0; line-height: 1.5">应付款总额：完成订单总额 – 手续费</p>
                              <p style="font-size: 14px;margin-bottom: 0; line-height: 1.5">微信支付手续费：完成订单总额 X 转账费率（步骤1.2所设置）</p>
                              <p style="font-size: 14px;margin-bottom: 0; line-height: 1.5">在线支付总额：统计该直营店选定时间段内的在线订单总额</p>
                              <p style="font-size: 14px;margin-bottom: 0; line-height: 1.5">POS支付总额：统计该直营店选定时间段内的在线订单总额</p>
                              <p style="font-size: 14px;margin-bottom: 0; line-height: 1.5">扫码支付总额：统计该直营店选定时间段内的在线订单总额</p>
                              <p style="font-size: 14px;margin-bottom: 0; line-height: 1.5">操作点击查看详细订单列表。</p>
                              <div style=" padding-left:15px">
                                  <img src="http://imgcache.vikduo.com/static/df61c74fbc146dbf466d94ccc6c6fc11.png" class="img-responsive" alt=""/>
                              </div>

                              <h5 id="m_4" class="margin-bottom10">4、账单统计</h5>
                              <p style="font-size: 14px;color:#666">在微商户后台管理系统中进入“微分店 -> 直营店对账结算 -> 生成结算信息”页面</p>
                              <div id="m_41" style="font-size:15px; text-indent: 50px;">4.1生成列表</div>
                              <p style="font-size: 14px; text-indent: 75px">选择统计的时间（以天为单位），勾选需要统计的支付方式（在线支付分为商家发货和门店发货）点击生成列表。</p>
                              <div style=" padding-left:15px">
                                  <img src="http://imgcache.vikduo.com/static/e4572f7926cee344e15bcb16162cdf6f.png" class="img-responsive" alt=""/>
                              </div>
                              <p style="font-size: 14px; text-indent: 75px">收款人：终端店收款账户设置的收款人姓名（1.1.2中所设置的收款人姓名）</p>
                              <p style="font-size: 14px; text-indent: 75px">打款总额：订单总额 – 手续费</p>
                              <p style="font-size: 14px; text-indent: 75px">手续费：完成订单总额 X 转账费率（步骤1.2所设置）</p>
                              <p style="font-size: 14px; text-indent: 75px">收款帐号：终端店收款账户设置的收款帐号（1.1.2中所设置的收款帐号）</p>
                              <p style="font-size: 14px; text-indent: 75px">收款银行：终端店收款账户设置的收款银行（1.1.2中所设置的收款银行）</p>
                              <p style="font-size: 14px; text-indent: 75px">结算时间：所选择的结算时间</p>
                              <p style="font-size: 14px; text-indent: 75px">接收信息微信帐号：结算通知模版消息中设置的接受人员所绑定的微信帐号</p>

                              <div id="m_42" style="font-size:15px; text-indent: 50px;">4.2导出表格</div>
                              <p style="font-size: 14px; text-indent: 75px">确认无误后点击导出表格。</p>
                              <div style=" padding-left:15px">
                                  <img src="http://imgcache.vikduo.com/static/072bbda1b884c49cab0b959587329e7f.png" class="img-responsive" alt=""/>
                              </div>

                              <div id="m_43" style="font-size:15px; text-indent: 50px;">4.3线下打款结算</div>
                              <p style="font-size: 14px; text-indent: 75px">财务根据结算表线下打款结算。</p>
                              <div id="m_43" style="font-size:15px; text-indent: 50px;">4.4生成打款记录</div>
                              <p style="font-size: 14px; text-indent: 75px">点击<a class="inline btn btn-sm btn-primary">生成打款记录</a>根据结算表格生成一条打款记录，可以在“发送打款消息”页面查看。</p>


                              <h5 id="m_5" class="margin-bottom10">5、发送打款消息</h5>
                              <p style="font-size: 14px;color:#666">在微商户后台管理系统中进入“微分店 -> 直营店对账结算 -> 发送打款消息”页面</p>
                              <div style=" padding-left:15px">
                                  <img src="http://imgcache.vikduo.com/static/0d4e32890b79130634ab1dbd6a55831c.png" class="img-responsive" alt=""/>
                              </div>
                              <p style="font-size: 14px; text-indent: 50px">结算时间：所选择的结算时间</p>
                              <p style="font-size: 14px; text-indent: 50px">打款时间：步骤4.4中点击<a class="inline btn btn-sm btn-primary">生成打款记录</a>时的系统时间。</p>
                              <p style="font-size: 14px; text-indent: 50px">成功数量/推送总数：发送成功的数量和总共推送的数量</p>
                              <p style="font-size: 14px; text-indent: 50px">推送时间：点击“推送”的时间。</p>
                              <p style="font-size: 14px; text-indent: 50px">操作：“编辑”编辑推送列表，“推送”推送打款消息，“推送记录”查看推送详细信息。</p>

                              <div id="m_51" style="font-size:15px; text-indent: 50px;">5.1编辑推送列表</div>
                              <p style="font-size: 14px; text-indent: 75px">点击“编辑”进入推送列表编辑页面</p>
                              <div style=" padding-left:15px">
                                  <img src="http://imgcache.vikduo.com/static/48e77662eb4a5b6305268aca33bb078d.png" class="img-responsive" alt=""/>
                              </div>
                              <p style="font-size: 14px; text-indent: 75px">可以对列表数据状态进行设置，状态为 “推送” 即推送该条结算信息，状态为 “不推送” 则不推送该条结算信息。</p>
                              <div style=" padding-left:15px">
                                  <img src="http://imgcache.vikduo.com/static/fdaa269d15516df97f168c2a4620605d.png" class="img-responsive" alt=""/>
                              </div>

                              <div id="m_52" style="font-size:15px; text-indent: 50px;">5.2推送打款消息</div>
                              <p style="font-size: 14px; text-indent: 75px">点击打款记录列表中的“推送”按钮即推送本次结算消息。</p>
                              <div style=" padding-left:15px">
                                  <img src="http://imgcache.vikduo.com/static/091bb84bccc31c06e8b0d32583e9fd42.png" class="img-responsive" alt=""/>
                              </div>
                              <p style="font-size: 14px; text-indent: 75px">终端店收款人绑定的微信帐号就会收到结算信息推送</p>
                              <div style=" padding-left:15px">
                                  <img src="http://imgcache.vikduo.com/static/299846984849b07562ecff633dc2dc0d.png" class="img-responsive" alt=""/>
                              </div>

                              <div id="m_53" style="font-size:15px; text-indent: 50px;">5.3查看打款记录</div>
                              <p style="font-size: 14px; text-indent: 75px">推送成功的打款记录就可以点击“推送记录”查看推送详细信息。</p>
                              <div style=" padding-left:15px">
                                  <img src="http://imgcache.vikduo.com/static/32fa76e9c78052a3e04d30bc17b19e13.png" class="img-responsive" alt=""/>
                              </div>
                              <p style="font-size: 14px; text-indent: 75px">进入推送消息记录页面。</p>
                              <div style=" padding-left:15px">
                                  <img src="http://imgcache.vikduo.com/static/5d1ec96c1cb26fcd0a3445328c7d4a39.png" class="img-responsive" alt=""/>
                              </div>
                              <p style="font-size: 14px; text-indent: 75px">发送成功：推送消息成功</p>
                              <p style="font-size: 14px; text-indent: 75px">发送中：正在发送</p>
                              <p style="font-size: 14px; text-indent: 75px">发送失败：推送消息但失败</p>
                              <div style=" padding-left:15px">
                                  <img src="http://imgcache.vikduo.com/static/c4800e0576dd2aa5212087383994d688.png" class="img-responsive" alt=""/>
                              </div>
                              <p style="font-size: 14px; text-indent: 75px">可以通过选择批量发送消息，也可以对单条信息进行发送操作。</p>
                              <div style=" padding-left:15px">
                                  <img src="http://imgcache.vikduo.com/static/9823bb6438986719864d4dcde3dd692f.png" class="img-responsive" alt=""/>
                              </div>










                          </div>

                      </div>
                  </div>

                  <div id="tbox">
                      <span><a id="gotop" href="javascript:void(0)" title="回到顶部"></a></span>
                  </div>


              </div>
          </div>
      </div>
    </div>
</div>

    <script src="/ace/js/terminal.js"></script>
    <script>
      app.controller("mainController", function ($scope, $timeout, $rootScope, $http) {
          $timeout(function () {
              $rootScope.$broadcast('leftMenuChange', 'aa');
          }, 100);

          $(window).scroll(function(){
              var scrolltop=$(this).scrollTop();
              if(scrolltop>=200){
                  $("#tbox").show();
              }else{
                  $("#tbox").hide();
              }
          });
          $("#gotop").click(function(){
              $("html,body").animate({scrollTop: 0}, 500);
          });
      });
    </script>

