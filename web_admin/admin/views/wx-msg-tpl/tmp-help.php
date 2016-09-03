<?php
use yii\helpers\Url;
$this->title = '模版消息使用说明';
?>
<style>
    .CardVoucher .c p{
        font-size: 14px;
    }
    .CardVoucher .c dl{
        text-indent: 30px;
        margin: 0;
        padding: 0;
    }
    .CardVoucher .c img{
        max-width: 90%;
    }
</style>

<div class="main-container" id="main-container">
  <script type="text/javascript">
    try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
  <div class="main-container-inner" ng-controller="mainController">
    <?php
		echo $this -> render('@app/views/side/manage_setting.php');
    ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>
        <ul class="breadcrumb">
          <li>模版消息使用说明</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">

            <div class="container_fluid CardVoucher">

              <div class="cont_title">

                <h3 class="margin-bottom20">模板消息操作说明  </h3>
              </div>
              <div class="content_form con_bg">
                <div class="part_bg directory" style="display: none">
                  <div class="first">
                    <span><a href="#card_1"><strong>1、模板消息设置</strong></a></span>
                      <div class="second">
                          <span><a href="javascript:;"><em>1.1</em>在微信公众平台开通模板消息</a></span>
                          <span><a href="javascript:;"><em>1.2</em>在微商户中添加消息模板</a></span>
                          <span><a href="javascript:;"><em>1.3</em>设置模板ID与启用模板消息</a></span>
                          <div class="third">
                              <span><a href="#card_4"><em>1.3.1</em>如何获取模版名称和模版编号ID</a></span>
                              <span><a href="#card_5"><em>1.3.2</em>如何查找模版</a></span>
                              <span><a href="#card_6"><em>1.3.3</em>如何添加模版</a></span>
                              <span><a href="#card_7"><em>1.3.4</em>如何在列表中查看模版ID</a></span>
                              <span><a href="#card_8"><em>1.3.5</em>如何编辑模版</a></span>
                              <span><a href="#card_8"><em>1.3.5</em>如何保存或使用模版</a></span>
                          </div>
                          <span><a href="javascript:;"><em>1.4</em>商家模板设置</a></span>
                      </div>
                  </div>
                </div>

                  <div class="c part_bg">
                      <h3 id="card_1">模板消息是由商家进行设置的，当用户触发了某场景时，会使用模板给该用户发送消息</h3>
                      <h4 id="card_11">1、微商户现在提供更多的消息场景供商家选择使用，根据自身需要，将模板进行开启</h4>
                      <div class="item">
                          <p></p>
                          <img src="http://imgcache.vikduo.com/static/d6eeac41d5792a95d95398fd90bf1e44.jpg"  alt=""/>
                      </div>
                      <div class="hr dotted margin-top20 "></div>
                      <h4 id="card_12">2、每个场景都有微商户消息和微信消息可供商家使用</h4>
                      <div class="item">
                          <dl class="font-size14px margin-top10">
                              <dt ><span class="icon icon-circle bigger200 margin-right5"></span>微商户消息</dt>
                              <dd class="margin-left20"><span class="icon icon-square bigger200 margin-right5"></span>优点：不受模板消息数量限制，不用在MP后台设置；</dd>
                              <dd class="margin-left20"><span class="icon icon-square bigger200 margin-right5"></span>缺点：用户与公众号交互超过24小时，将无法接受到微商户消息</dd>
                              <dt class="margin-top10 "><span class="icon icon-circle bigger200 margin-right5"></span>微信消息</dt>
                              <dd class="margin-left20"><span class="icon icon-square bigger200 margin-right5"></span>优点：可随时给用户发送消息（用户已关注公众号时）；</dd>
                              <dd class="margin-left20"><span class="icon icon-square bigger200 margin-right5"></span>缺点：需要到MP后台进行设置，受模板消息数量限制</dd>
                          </dl>
                          <img src="http://imgcache.vikduo.com/static/368c28e7c1628dd94f0d2b87448f624f.jpg"  alt=""/>
                      </div>
                      <div class="hr dotted margin-top20 "></div>
                      <h4 id="card_13">3、使用微商户消息进行发送</h4>
                      <div class="item">
                          <p><span class="icon icon-circle bigger200 margin-right5"></span>如果商家没有做过任何操作，默认选择“微商户消息”发送，商户只需要点击“开启”即可，无需其他操作</p>
                          <p class="margin-top10"><img src="http://imgcache.vikduo.com/static/85c607743b4562ec6386d3f926cf4f09.jpg"  alt=""/></p>
                      </div>
                      <div class="hr dotted margin-top20 "></div>
                      <h4>4、使用微信消息进行发送</h4>
                      <div class="item">
                          <p><span class="icon icon-circle bigger200 margin-right5"></span>使用微信消息需要在微信公众平台中，提前申请开通“模板消息”功能</p>
                          <p ><img src="http://imgcache.vikduo.com/static/a6fa930774de950dfccffe836f85df13.jpg"  alt=""/></p>
                          <p><span class="icon icon-circle bigger200 margin-right5"></span>在行业中，主营行业选择“IT科技-互联网/电子商务”，副营行业选择“消费品-消费品”可以更有效率的使用微信消息</p>
                          <p ><img src="http://imgcache.vikduo.com/static/ca8eaa7be21637dc3ab62e1d41c8cd79.jpg"  alt=""/></p>
                          <p><span class="icon icon-circle bigger200 margin-right5"></span>回到微商户，进入场景编辑页面，选择“微信消息通知”查看模板名称与模板编号</p>
                          <p ><img src="http://imgcache.vikduo.com/static/e7034a9be00a5eb546da41033dc01752.jpg"  alt=""/></p>
                          <p><span class="icon icon-circle bigger200 margin-right5"></span>根据模版名称到微信后台查找该模板</p>
                          <p ><img src="http://imgcache.vikduo.com/static/0e21aeae51236ee267efe829a0f0909b.jpg"  alt=""/></p>
                          <p><span class="icon icon-circle bigger200 margin-right5"></span>进入模板详情，添加该模板至“我的模板”</p>
                          <p ><img src="http://imgcache.vikduo.com/static/d0be7d09f7eab8b53da75019cd4400bb.jpg"  alt=""/></p>
                          <p><span class="icon icon-circle bigger200 margin-right5"></span>在列表中查看模板ID</p>
                          <p ><img src="http://imgcache.vikduo.com/static/43127d7519e6045a3d221852062e2845.jpg"  alt=""/></p>
                          <p><span class="icon icon-circle bigger200 margin-right5"></span>将模板ID填到编辑页面；左边预览框中显示收到模板消息的样式，可以修改模板抬头与模板结语</p>
                          <p ><img src="http://imgcache.vikduo.com/static/393fb78175630335e30abd53a3a19c5e.jpg"  alt=""/></p>
                      </div>

                      <div class="hr dotted margin-top20 "></div>
                      <h4>5、商家消息现在可以指定发送给某个员工</h4>
                      <div class="item">
                          <p><span class="icon icon-circle bigger200 margin-right5"></span>进入“设置接收人员”进行设置</p>
                          <p ><img src="http://imgcache.vikduo.com/static/2f4bdb183aedb64f4bdc1efcb4ea1aa3.jpg"  alt=""/></p>
                          <dl class="font-size14px">
                              <dd ><span class="icon icon-circle bigger200 margin-right5"></span>商家可以选择“操作员”、“门店员工”或者“归属员工”作为消息接收者</dd>
                              <dd class="margin-left30 margin-top10"><span class="icon icon-square bigger200 margin-right5"></span>操作员：选择商户在后台配置的操作员作为接收者；</dd>
                              <dd class="margin-left30  margin-top10"><span class="icon icon-square bigger200 margin-right5"></span>设置操作员后，该场景下触发的所有消息都会发送给该操作员</dd>
                              <dd class="margin-left30  margin-top10"><span class="icon icon-square bigger200 margin-right5"></span>操作员可以选择多个的话，那么多个操作员都会收到消息</dd>
                              <dd class="margin-left30  margin-top10 " style="color: #f00"><span class="icon icon-square bigger200 margin-right5"></span>由于系统升级，原“模板消息”配置的接收操作员均重置，需要商家重新配置</dd>
                              <dd class="margin-left30 margin-top10"><img src="http://imgcache.vikduo.com/static/80529d5137fdcc9ddbb6a569b3c58a79.jpg"  alt=""/></dd>
                              <dd class="margin-left30  margin-top10"><span class="icon icon-square bigger200 margin-right5"></span>门店员工：选择门店员工作为接收者</dd>
                              <dd class="margin-left30  margin-top10"><span class="icon icon-square bigger200 margin-right5"></span>设置门店员工后，该员工可以收到该场景下，发生在自己门店的相关消息，不会收到其他门店的消息</dd>
                              <dd class="margin-left30 margin-top10"><img src="http://imgcache.vikduo.com/static/da59588ae5fc3088a435e1d8a3ec489f.jpg" alt=""/></dd>
                              <dd class="margin-left30  margin-top10"><span class="icon icon-square bigger200 margin-right5"></span>归属员工：推送消息给发生相关操作的员工</dd>
                              <dd class="margin-left30  margin-top10"><span class="icon icon-square bigger200 margin-right5"></span>当前归属员工只用于“商家消息-订单支付成功通知”这个场景</dd>
                              <dd class="margin-left30  margin-top10"><span class="icon icon-square bigger200 margin-right5"></span>在“商家消息-订单支付成功通知”这个场景下，勾选操作员工后用户扫员工收款码支付后，被扫码的员工会收到消息通知</dd>
                              <dd class="margin-left30 margin-top10"><img src="http://imgcache.vikduo.com/static/d7e3a0f83916253715dae0ae21dd57bd.jpg"  alt=""/></dd>

                          </dl>

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
</div>

<script>
  app.controller('mainController',function($scope, $rootScope, $timeout, $http){
    $timeout(function(){$rootScope.$broadcast('leftMenuChange', 'ag');}, 100);

  });
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
</script>