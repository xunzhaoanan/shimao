<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '卡券使用手册';
?>
<div class="main-container" id="main-container" ng-controller="mainController">
  <script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/marketing.php');?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs"> 
        <script type="text/javascript">
              try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>
        <ul class="breadcrumb">
          <li>卡券列表</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">

           <div class="container_fluid CardVoucher">
        <div class="cont_title">
            <h3 class="margin-bottom20">卡券使用手册</h3>
					</div>
        <div class="content_form con_bg">
			<div class="part_bg directory">
				<div class="first">
					<span><a href="#card_01"><strong>1、申请微信卡券功能</strong></a></span>
					<div class="second">
						<span><a href="#card_02"><em>1.1</em>申请开通</a></span>
						<span><a href="#card_03"><em>1.2</em>配置权限</a></span>
					</div>
				</div>
				<div class="first">
					<span><a href="#card_1"><strong>2、创建卡券</strong></a></span>
					<div class="second">
						<span><a href="#card_2"><em>2.1</em>同步门店</a></span>
						<span><a href="#card_3"><em>2.2</em>新增卡券</a></span>
						<div class="third">
							<span><a href="#card_4"><em>2.2.1</em>基础信息设置</a></span>
							<span><a href="#card_5"><em>2.2.2</em>销券设置</a></span>
							<span><a href="#card_6"><em>2.2.3</em>优惠券详情</a></span>
							<span><a href="#card_7"><em>2.2.4</em>适用门店</a></span>
							<span><a href="#card_8"><em>2.2.5</em>卡券审核与修改</a></span>
						</div>
					</div>
				</div>
				<div class="first">
					<span><a href="#card_9"><strong>3、发放卡券</strong></a></span>
					<div  class="second">
						<span><a href="#card_10"><em>3.1</em>直接领取</a></span>
						<span><a href="#card_11"><em>3.2</em>赠送策略</a></span>
						<span><a href="#card_12"><em>3.3</em>手动派送</a></span>
						<span><a href="#card_13"><em>3.4</em>营销活动</a></span>
					</div>
				</div>
				<div class="first">
					<span><a href="#card_14"><strong>4、卡券核销</strong></a></span>
					<div  class="second">
						<span><a href="#card_15"><em>4.1</em>绑定核销员</a></span>
						<span><a href="#card_16"><em>4.2</em>二维码核销</a></span>
						<span><a href="#card_17"><em>4.3</em>网页核销（序列号）</a></span>
						<span><a href="#card_18"><em>4.4</em>核销记录查询</a></span>
						<span><a href="#card_19"><em>4.5</em>核销门店</a></span>
						<span><a href="#card_20"><em>4.6</em>核销人员</a></span>
					</div>
				</div>
				<div class="first">
					<span><a href="#card_21"><strong>5、营销活动</strong></a></span>
					<div  class="second">
						<span><a href="#card_22"><em>5.1</em>抽奖活动送卡券</a></span>
						<span><a href="#card_23"><em>5.2</em>微游戏赢卡券</a></span>
					</div>
				</div>
				<div class="first">
					<span><a href="#card_24"><strong>6、其他</strong></a></span>
				</div>
			</div>
			<div class="c part_bg">
				<h3 id="card_01">申请微信卡券功能</h3>
				<div class="item">
 					<h4 id="card_02">1.1 申请开通</h4>
					<p>登录微信公众平台（<a href="http://mp.weixin.qq.com" target="_blank" >http://mp.weixin.qq.com</a>）</p>
					<div><img src="http://imgcache.vikduo.com/static/f954859d9e5ecae87aae91ba54611257.jpg" /></div>
					<p>在添加功能插件里面进入到卡券功能申请页</p>
					<div><img src="http://imgcache.vikduo.com/static/8b81fc2b03dad2452783dcfc6d50a872.jpg" /></div><br>
					<div><img src="http://imgcache.vikduo.com/static/82bd379ec5029817affdc1298d7a452e.jpg" /></div>
					<p>根据提醒进行申请开通，商户名称和商户LOGO请保持与公众号一致</p>
					<div><img src="http://imgcache.vikduo.com/static/fc913a2706b5e5b7d07e80fe34ed9bae.jpg" /></div>
					<h4 id="card_03">1.2 配置权限</h4>
					<p>通过添加功能插件->卡券功能->申请详情页面</p>
					<div><img src="http://imgcache.vikduo.com/static/71f6ce2d4befda5d57697e0c6b0871c8.jpg" /></div>
					<p>对接口商户高级权限进行配置</p>
					<div><img src="http://imgcache.vikduo.com/static/80ab9866fce0591f501de78ff77efec1.jpg" /></div>
					<p>配置域名和开通自定义SN（配置域名为后台当前显示的域名，例：wsh.gaopeng.com）</p>
					<div><img src="http://imgcache.vikduo.com/static/b50e108b8b0169dcff38b55ba783ea9c.jpg" /></div>
				</div>
			</div>
			<div class="c part_bg">
				<h3 id="card_1">2、创建卡券</h3>
				<div class="item">
					<p>在微商户后台管理系统中进入“卡券 -> 卡券列表”页面，</p>
					<div><img src="http://imgcache.vikduo.com/static/6dae562691fc4e20b1b1a4adf265186c.jpg" alt="" /></div>
					<h4 id="card_2">2.1同步门店</h4>
					<p>系统中支持微商户卡券和微信卡券两种，若要使用微信卡包功能，则需要将门店信息同步到微信公众平台中，否则微信公众平台中无法得到门店信息，故无法进行卡券审核。点击<a class="btn">同步门店</a>按钮，完成门店信息同步。若不使用微信卡包，即发放微商城卡券则无需进行门店同步操作，详情参见后续<a href="#synchronization"><u>2.2.2.3同步设置</u></a>章节。</p>
					<h4 id="card_3">2.2 新增卡券</h4>
					<p>点击<a class="btn mrb">新增卡券</a>创建卡券，</p>
					<p><strong>卡券说明：</strong>提供低扣现金折扣服务，支持线上和线下两种核销方式</p>
					<div class="t">
						<h5 id="card_4">2.2.1 基础信息设置</h5>
						<p>进入卡券设置页面时，首先需进行基础信息设置，</p>
						<div><img src="http://imgcache.vikduo.com/static/37caa0f72cfe1062fff698946a4ee7b4.jpg" alt="" /></div>
						<p><strong>卡券名称：</strong>支持输入9个字符（汉字、字母、数字等），建议使用“满200减50”、“双十二大礼包”等类型名称；</p>
						<p><strong>卡券LOGO：</strong>卡券LOGO建议和商户工作号LOGO一致；</p>
						<p><strong>卡券颜色：</strong>点击卡券颜色框，在弹出的颜色板中选择颜色，如下图所示，</p>
						<p><img src="http://imgcache.vikduo.com/static/634b5e38eaa8cf119f5ff39150bdb1c0.jpg" alt="" /></p>
						<p><strong>减免金额与金额限制：</strong>即消费金额达到“金额限制”数目后，减免“减免金额”所对应的数额；</p>
						<p><strong>有效期：</strong>设置卡券使用的有效期限，固定日期为一段时间区间内卡券有效，也可以点选下方“领取后”选项，设置以某一天为起点的时间区间；</p>
						<h5 id="card_5">2.2.2 销券设置</h5>
						<p>完成基础信息设置后点击设置页面左侧的“销券设置”进行高级设置，</p>
						<div><img src="http://imgcache.vikduo.com/static/ac0c228e75cc6222f2e858beae53f59e.jpg" alt="" /></div>
						<div><strong>2.2.2.1 领券设置：</strong></div>
						<p><img src="http://imgcache.vikduo.com/static/bddcce2c402b6a8db72eca93b5a10ba7.jpg" alt="" /></p>
						<p><strong>生成数量：</strong>填写要发放的卡券总数量；</p>
						<p><strong>领取限制：</strong>设置每个用户的领取限制，例如每一个只可以领取一次，则设置为1；</p>
						<p><strong>转赠好友：</strong>勾选下方“用户领券后可转赠其他好友”，则允许将领取到的卡券赠送给自己的好友，赠送后卡券在本端消失，转移到好友账户。</p>
						<div><strong>2.2.2.2 销券设置</strong></div>
						<p>系统支持三种销券方式：二维码、序列号、条形码（即将上线）。</p>
						<div><img src="http://imgcache.vikduo.com/static/7742269be8085622449ffbca294dc28a.jpg" alt="" /></div>
						<p>在引导提示中写入简要的卡券使用说明，用于引导用户使用卡券进行消费。</p>
						<p><strong>补充说明：</strong>当前系统版本暂不支持条形码形式，详细的核销方式参见章节<a href="#card_14"><u>4.卡券核销</u></a>。</p>
						<div id="synchronization"><strong>2.2.2.3 同步设置</strong></div>
						<p><img src="http://imgcache.vikduo.com/static/8107e656ac79e8987bee48dd758f1410.jpg" alt="" /></p>
						<p>若用户开通了微信平台的卡券功能，通过勾选该功能，客户领取的卡券将会存入微信卡包中；若尚未开通微信卡券功能则无法使用该功能。</p>
						<p><strong>补充说明：</strong><font color="red">若勾选同步后，需要保证商家的名称以及 logo 和微信公众平台中的名称 logo 一致，否则微信平台将不予通过。</font></p>
						<p><font color="red">要同步到微信卡包，需要开通卡券领取页面JS API和自定义SN权限，否则创建微信卡券的时候会提示43009错误</font>
						</p>
						<h5 id="card_6">2.2.3 优惠券详情</h5>
						<p>点击设置页面左侧的<strong>“优惠券详情”</strong>，设置所发放卡券的使用详细说明，</p>
						<div><img src="http://imgcache.vikduo.com/static/6ad085f856188a06bb7446d2b4f86610.jpg" alt="" /></div>
						<p><strong>使用须知：</strong>填写具体的卡券活动介绍；</p>
						<p><strong>客服电话：</strong>填写手机或固话作为客服电话。</p>
						<h5 id="card_7">2.2.4 适用门店</h5>
						<p>点击设置页面左侧的<strong>“适用门店”</strong>，设置卡券的使用范围，</p>
						<div><img src="http://imgcache.vikduo.com/static/915ab84d0950cdabcf76cbc9d1a34cfe.jpg" alt="" /></div>
						<p><strong>指定门店适用：</strong>若所创建的卡包为微信平台卡包，则在指定门店之前需要进行门店信息同步（参见<u><a href="#card_2">2.1同步门店</a></u>），否则在门店列表中无法得到门店信息，不能完成适用门店指定操作。</p>
						<div><img src="http://imgcache.vikduo.com/static/0fde8712e10d9049a1ddb597a19589c7.jpg" /></div>
						<h5 id="card_8">2.2.5 卡券审核与修改</h5>
						<p>完成卡券设置后，点击下方<a class="color_gray">提交</a> 按钮提交卡券，卡券信息显示在卡券首页的卡券列表中，</p>
						<div><img src="http://imgcache.vikduo.com/static/c9e720771bb084af331e30cf675d5680.jpg" alt="" /></div>
						<p><i>1</i>微信审核中：经由微信公众平台进行审核，处于正在审核状态。</p>
						<p><i>2</i>审核通过：经由微信公众平台进行审核，已通过审核可正常使用。</p>
						<p><i>3</i>正常使用：由微商户平台进行审核，立即通过可正常使用。</p>
						<p><i>4</i>点击查看卡券领取记录。</p>
						<p><i>5</i>卡券修改：提交后可再次修改卡券的部分内容信息，可更改选项为：卡券颜色、卡券LOGO、好友转赠、引导提示、领取次数限制、使用须知、客服电话、适用门店。</p>
						<p><i>6</i>删除卡券。</p>
						<p><i>7</i>微商户平台和微信平台现实区分：微商户平台卡券显示为已核销数目，微信平台卡券不显示核销数目。</p>
						<p><strong>规则说明：</strong></p>
						<p>1.提交的卡券需要审核才可发放，在卡券设置中若不勾选“用户领取后同步到微信卡包”（参见<a href="#synchronization"><u>2.2.2.3同步设置</u></a>章节），即为微商户系统卡券，系统会立即通过审核；</p>
						<p>2.若勾选了同步卡包，则需要微信公众平台进行审核，审核通过后方可进行发放；</p>
						<p>3.若经由微信平台进行审核，若未能通过，微商户系统中不会显示未通过的原因，需进入微信公众平台查询。该卡券需要重新创建新卡券条目后再次提交审核，不可在当前未通过条目基础上修改后直接提交审核。</p>
						<p>4.若卡券已经通过微信平台审核，但需要进行卡券的修改，此时修改后的卡券会重新进入审核流程。</p>
				</div>
				</div>
			</div>
			<div class="c part_bg">
				<h3 id="card_9">3、发放卡券</h3>
				<div class="item">
					<p>系统提供四种卡券发放方式：直接领取、附加赠送（赠送策略）、手动派送、营销活动（详细参见<a href="#card_21"><u>4.营销活动</u></a>）。</p>
					<p>点击卡券菜单进入<strong>“卡券 -> 派发管理”</strong>页面，</p>
					<div><img src="http://imgcache.vikduo.com/static/0e6fde98720edcf0f284861164ebf56d.jpg" alt="" /></div>
					<h4 id="card_10">3.1 直接领取</h4>
					<p>直接领取模式是通过用户扫面二维码，将关联的卡券推送给用户，客户接收到推送消息后点击直接进行领取。</p>
					<p>点击菜单中的<strong>“直接领取”</strong>标签页，</p>
					<div><img src="http://imgcache.vikduo.com/static/8614e469175493de3e409838ae5d8244.jpg" alt="" /></div>
					<p>点击<a class="btn">添加</a>按钮设置推送消息内容，如下图所示，</p>
					<div><img src="http://imgcache.vikduo.com/static/fb146806d65ca5acbc606257c3e1bd5a.jpg" alt="" /></div>
					<p><strong>消息标题：</strong>输入20个字以内的名称。</p>
					<p><strong>图片：</strong>推送消息的背景图片。</p>
					<p><strong>开始时间与结束时间：</strong>推送卡券的有效领取时间。</p>
					<p><strong>关联卡券：</strong>在下拉框中选择已建好的卡券，实现绑定推送。</p>
					<p><strong>信息摘要：</strong>消息的内容摘要。</p>
					<p>点击操作栏中的<span class="icon-qrcode"></span> 查看二维码，</p>
					<div><img src="http://imgcache.vikduo.com/static/e8be1497a18a9157126c9640081ee06b.jpg" alt="" /></div>
					<p>列表显示不同门店下的优惠券二维码，商家提供该二维码给用户，扫描后便可以收到卡券推送消息，点击领取卡券。</p>
					<p>如下所示为扫码后直接领取卡券的推送消息，</p>
					<p><strong>微商户平台卡券：</strong></p>
					<p><img src="http://imgcache.vikduo.com/static/3aa1ce2679959a8ee04b18c267249c97.jpg" alt="" /></p>
					<p><strong>微信平台卡券：</strong></p>
					<p><img src="http://imgcache.vikduo.com/static/b2e21fa774fa849274ca3b6eb9af5476.jpg" alt="" /></p>
					<p><strong>规则描述：</strong></p>
					<p>1.微商户平台的卡券领取后在客户中心中查看使用；</p>
					<p>2.微信平台的卡券则在微信客户端中的卡包中查看使用。</p>
					<h4 id="card_11">3.2 赠送策略</h4>
					<p>通过赠送策略功能，指定消费规则进行卡券优惠赠送，例如消费满200元赠送50元卡券的促销活动。</p>
					<p>点击菜单中的<strong>“赠送策略”</strong>标签页，</p>
					<div><img src="http://imgcache.vikduo.com/static/de82f2b013ca390f3b51450c50496538.jpg" alt="" /></div>
					<p>点击<a class="btn">新增赠送策略</a>按钮添加优惠赠送策略，系统支持消费指定金额和购买指定商品两种赠送模式，如下图为消费金额模式，</p>
					<p><img src="http://imgcache.vikduo.com/static/8386245f69f7352e9a3760600ff6314d.jpg" alt="" /></p>
					<p>消费指定金额模式</p>
					<p><img src="http://imgcache.vikduo.com/static/46f5129183c9f364252d398df0f212b8.jpg" alt="" /></p>
					<p>购买指定商品模式</p>
					<p><strong>规则名称：</strong>填写赠送规则名称。</p>
					<p><strong>赠送策略：</strong>支持消费指定金额和购买指定商品两种模式。</p>
					<p><strong>消费金额：</strong>填写满足赠送规则的消费金额。</p>
					<p><strong>指定商品：</strong>在选择框中选择要关联的商品，支持多选和关键字搜索功能。</p>
					<p><strong>关联卡券：</strong>在选择框中选择要关联的卡券，可通过搜索功能进行快速查找，点击提交按钮完成添加。</p>
					<p><strong>规则描述：</strong></p>
					<p>1.消费指定金额模式下采取金额最大优先，例如同时满足100元和200元优惠条件时，只按200元优惠发放。</p>
					<p>2.购买指定商品模式下选择多个商品时，即表示所选的商品均在活动内，只要购买其中任一产品均会进行赠送。</p>
					<p>3.当同时满足两种模式时，优先赠送商品。</p>
					<h4 id="card_12">3.3 手动派送</h4>
					<p>通过手动派送功能，将卡券赠送给客户。点击卡券菜单中的<strong>“手动派送”</strong>，</p>
					<div><img src="http://imgcache.vikduo.com/static/8ec889cfba5d041a2db4e25b4956c315.jpg" alt="" /></div>
					<p>点击<a class="btn">派送卡券</a>按钮进行卡券派送设置，</p>
					<div><img src="http://imgcache.vikduo.com/static/42bf07b5f426e670a92dcbcfce1b1411.jpg" alt="" /></div>
					<p><strong>指定用户：</strong>搜索商户下的客户名称，选定赠送对象。</p>
					<p><strong>关联卡券：</strong>搜索并选定要赠送的卡券。</p>
					<p>点击提交按钮完成派送，客户收到推送消息后点击便可领取卡券，</p>
					<p><img src="http://imgcache.vikduo.com/static/13417fae48f023c5b46ae519bf5075fc.jpg" alt=""  /></p>
					<p><strong>规则描述：</strong></p>
					<p>1.所赠送的卡券若为微信平台卡券，则客户需要在微信推送消息页面进行领取，领取后存入微信卡包中；</p>
					<p>2.所赠送的卡券若为微商户平台卡券，则默认自动领取存入客户中心中，客户会看到赠送卡券的推送详情。</p>
					<p>3.由于微信平台推送限制，客户在商家公众号中发送最后一条文字消息超过48小时后，商家将无法推送消息，即无法赠送微信平台卡券给用户，但仍可赠送微商户平台卡券（无推送消息提醒，自动将卡券存入用户客户中心）。</p>
					<h4 id="card_13">3.4 营销活动</h4>
					<p>参见<a href="#card_21"><u>5.营销活动</u></a>。</p>
				</div>
			</div>
			<div class="c part_bg">
				<h3 id="card_14">4、卡券核销</h3>
				<div class="item">
					<h4 id="card_15">4.1 绑定核销员</h4>
					<p>点击菜单中的<strong>“绑定核销员”</strong>标签页，</p>
					<div><img src="http://imgcache.vikduo.com/static/cca149b1a10862964dd306df2eab9c4f.jpg" alt="" /></div>
					<p><strong>微商户卡券核销员绑定方法：</strong></p>
					<p>方法一：门店员工使用员工账号对应的微信客户端扫描微商户后台管理系统中的“绑定核销员”二维码，</p>
					<p><img src="http://imgcache.vikduo.com/static/5a5eb9ab92cfe918f0f08163b6d78e42.jpg" /></p>
					<p>输入员工账号和密码，点击绑定按钮完成核销员绑定。只有已在门店中注册过的员工才可以进行核销绑定。</p>
					<p>方法二：当已经进行过以此扫描绑定后，核销人员信息会出现在下方的核销员列表中，此时可通过核销员列表快速进行授权和取消授权操作。</p>
					<p><strong>微信公众平台卡券核销员绑定方法：</strong></p>
					<p>微信平台的卡券需要在微信公众平台进行核销人员绑定，</p>
					<p><img src="http://imgcache.vikduo.com/static/50c4851c89d3fa01177ee19bb1f1fd14.jpg" alt="" /></p>
					<p>点击<a class="btn">+添加核销员</a>添加核销员，</p>
					<p><img src="http://imgcache.vikduo.com/static/a7e96f747d80e1f8eb68b2ea56f884b8.jpg" alt="" /></p>
					<p>点击<a class="btn">下一步</a>按钮，</p>
					<p><img src="http://imgcache.vikduo.com/static/f32f72183ec97067d965434a5346420e.jpg" alt="" /></p>
					<p>勾选核销员所在的门店，也可以勾选下方“不指定门店”不限制核销员所属。</p>
					<h4 id="card_16">4.2 二维码核销</h4>
					<p>核销员通过员工账号微信的扫一扫功能，扫描客户提供的卡券二维码，完成核销。门店员工进行一次核销员绑定操作后，无需重复绑定即可通过微信扫一扫进行核销操作。</p>
					<p>核销人员核对客户提供的卡券的信息，确认无误后扫描卡券二维码，之后会跳转到手机核销页面，</p>
					<p><img src="http://imgcache.vikduo.com/static/e352a00661b73af7473f6068c3ff8144.jpg" alt="" /></p>
					<p>点击<a class="btn orange">确认核销</a>完成核销。</p>
					<h4 id="card_17">4.3 网页核销（序列号）</h4>
					<div><img src="http://imgcache.vikduo.com/static/f6317dfd1aa8b104cc7b786ddc92a38e.jpg" alt="" /></div>
					<p>点击<strong>“网页核销”</strong>标签页，在卡券号输入框中输入客户提供的卡券序列号，点击<a class="btn">提交</a>完成卡券核销，</p>
					<div><img src="http://imgcache.vikduo.com/static/fd92eef010cf428ffcb38781fef585a8.jpg" alt="" /></div>
					<p>在核销页面可以查看当前卡券的商家名称、卡券标题、卡券使用的门店等信息，确认无误后，点击<a class="btn">核销该卡券</a>进行核销。</p>
					<h4 id="card_18">4.4 核销记录查询</h4>
					<p>通过菜单中的<strong>“核销记录”</strong>功能查询卡券的核销记录，</p>
					<div><img src="http://imgcache.vikduo.com/static/d761dac0c70449cc344fb75bf84727ec.jpg" alt="" /></div>
					<p>在卡券号输入框中输入指定卡券号码，点击<a class="btn">搜索</a>进行查询。在下方列表中显示核销记录的详细时间、卡券号、门店、核销员等信息。</p>
					<h4 id="card_19">4.5 核销门店</h4>
					<p>点击<strong>“核销门店”</strong>标签页，查看门店核销次数和排名，</p>
					<div><img src="http://imgcache.vikduo.com/static/d761dac0c70449cc344fb75bf84727ec.jpg" alt="" /></div>
					<p>在日期中输入统计时间范围，点击<a class="btn">搜索</a>按钮，在下方列表中将会显示当前时间段中各个核销人员的核销次数明细。</p>
					<h4 id="card_20">4.6 核销人员</h4>
					<p>点击<strong>“”</strong>标签页，查看核销员的核销次数和排名，</p>
					<div><img src="http://imgcache.vikduo.com/static/8d77700211cfe835025820763f9748b8.jpg" alt="" /></div>
					<p>在日期中输入统计时间范围，点击<a class="btn">搜索</a>按钮，在下方列表中将会显示当前时间段中各个核销人员的核销次数明细。</p>
				</div>
			</div>
			<div class="c part_bg">
				<h3 id="card_21">5、营销活动</h3>
				<div class="item">
					<h4 id="card_22">5.1 抽奖活动送卡券</h4>
					<p>系统提供大转盘、刮刮卡、翻翻乐、砸金蛋四种抽奖活动，抽奖所得奖品可以设置为卡券，客户在进行抽奖活动时将有机会赢得卡券。</p>
					<p>如下图示，在活动奖励设置中设置奖品类型为卡券，在奖品选择框中关联指定卡券作为奖品，完成设置后便可进行抽奖送卡券活动。</p>
					<div><img src="http://imgcache.vikduo.com/static/08b6ad277d8d6f4df2e7c4a3ca24bb62.jpg" alt="" /></div>
					<h4 id="card_23">5.2 微游戏赢卡券</h4>
					<p>系统提供步步高、指尖上的世界杯、打地鼠三种游戏，玩家在游戏过程中通过获得更多的游戏积分兑换对应的奖品，如下所示在游戏称号设置中的最后一项中关联卡券，这样在玩家获得一定分数后便可以兑换对应的卡券奖品。</p>
					<p><img src="http://imgcache.vikduo.com/static/052cc9029fb9aa9a1e12ca9649d5fe8b.jpg" alt="" /></p>
				</div>
			</div>
			<div class="c part_bg">
				<h3 id="card_24">6、其他</h3>
				<div class="item">
					<p>以上为微商户后台管理系统卡券功能使用手册全部内容，若有任何使用上的疑问请与我们联系。</p>
				</div>
			</div>
		</div>
</div>
<div id="tbox">
	<span><a id="gotop" href="javascript:void(0)" title="回到顶部"></a></span>
</div>
            <div class="text-center" id="center" >
              <div id="grid-pager"></div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--查看二维码-->
<div class="bootbox modal fade in"  id="query" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
      <div class="modal-header"> <a href="#" type="button" class="bootbox-close-button close" data-dismiss="modal">×</a>
        <h4 class="modal-title">查看商品二维码</h4>
      </div>
      <div class="modal-body bjge3 no-padding-bottom">
        <div class="bootbox-body">
          <img ng-src="{{$root.srcImg}}">
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  app.controller('mainController',function($scope, $rootScope, $timeout){
   $timeout(function(){$rootScope.$broadcast('leftMenuChange', 2);}, 100);
  });
</script> 
