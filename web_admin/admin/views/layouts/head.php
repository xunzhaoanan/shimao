<?php
use yii\helpers\Url;
use common\cache\Session;

?>

<!-- div -->
<div class="navbar navbar-default ng-scope navbar-fixed-top clearfix black" id="navbar"
     ng-controller="headController">

  <div class="navbar-container" id="shanghu_head" style="display: none">
    <div class="navbar-header pull-left"><a href="/shop/index" class="navbar-brand">
        <small> 世贸地产后台管理系统</small>
      </a>
    </div>
    <div class="navbar-header pull-left top-nav">
      <ul id="headactive">
        <li ng-repeat="list in $root.headList" ng-style="checkByHref(list.href)" ng-if="list.href">
          <a ng-href="{{list.href}}" ng-bind="list.text"></a></li>
        <!--
        <li ng-if="$root.hasPermission('application/list')"><a
            style="background-color:transparent; border: none; " href="/application/list"
            class="dropdown-toggle" title="应用中心">应用中心</a></li>
        -->
      </ul>
    </div>
    <div class="navbar-header pull-right" role="navigation">
      <ul class="nav ace-nav">
        <li id="wpa" style="padding: 6px;">
          <script charset="utf-8" type="text/javascript" src="http://wpa.b.qq.com/cgi/wpa.php?key=XzkzODA1MTM5NV8zNzM2OTZfNDAwODAwMDIxMl8"></script>
        </li>
        <li class="green"><a href="<?= getMobileSite() . '/mall/index'; ?>" target="_blank"
                             class="dropdown-toggle" title="浏览首页"><i class="icon-home"></i></a></li>
        <li class="light-blue" id="dropdown"><a data-toggle="dropdown" href="#"
                                                class="dropdown-toggle"> <i class="icon-user"></i>
          </a>
          <ul
            class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
            <li><a href="#"> <?= Session::get(Session::SESSION_KEY_MANAGER)['name'] ?>,您好！</a></li>
            <li class="divider"></li>
            <li><a href="/help/notice-list"> <i class="icon-envelope "></i> 公告列表 </a></li>
            <li><a href="/help/feedback-list"> <i class="icon-user"></i> 意见反馈 </a></li>
            <li class="divider"></li>
            <li><a href="<?= Url::to('/login/logout') ?>"> <i class="icon-off"></i> 退出 </a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <div class="col-xs-12" id="terminal_head" style="display: none">
    <div class="col-sm-5 margin-left30">
      <div class="row">
        <div class="col-xs-12 white">
          <h4 class="inline" ng-bind="$root.franchiseeInfo.name">深圳市代理商</h4>

          <p>联系电话：<span class="margin-left10" ng-bind="$root.franchiseeInfo.phone">Kelly</span></p>

          <p>店铺地址：<span class="margin-left10"
                        ng-bind="$root.franchiseeInfo.address">15019256053</span></p>
        </div>
      </div>
    </div>
    <div class="col-sm-3 ">
      <div class="row">
        <div class="col-xs-12 padding5 margin10 white">
          <div class="col-xs-12 padding5 ">

            <p>店铺员工：<span class="margin-left10"
                          ng-bind="$root.franchiseeInfo.staff_total_count + '人'"></span></p>

            <p>店铺推广员：<span class="margin-left10"
                           ng-bind="$root.franchiseeInfo.fx_member_count+ '人'"></span></p>

            <p>所属代理商：<span class="margin-left10" ng-bind="$root.franchiseeInfo.agent_name"></span>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-3 ">
      <div class="row">
        <div class="col-xs-12 text-center white">
          <div class="space-4"></div>
          <p>
            <img ng-src="{{srcImg}}" width="80" height="80"></p>
        </div>
      </div>
    </div>
  </div>
  <div id="agent_head" class="row" style="display: none">
    <div class="col-xs-12">
      <div id="ag" style="display: block">
        <div class="col-md-4 margin-left30 ">
          <div class="row">
            <div class="col-xs-12 white">
              <h4 class="inline" ng-bind="$root.agentInfo.agent_name">深圳市代理商</h4>

              <div class="inline font-size14 margin-left10"><strong>ID</strong><span
                  ng-bind="' ' + $root.agentInfo.id"> </span></div>
              <p>负责人姓名：<span class="margin-left10" ng-bind="$root.agentInfo.real_name"></span></p>

              <p>负责人电话：<span class="margin-left10" ng-bind="$root.agentInfo.mobile"></span></p>
            </div>
          </div>
        </div>
        <div class="col-md-3 ">
          <div class="row">
            <div class="col-xs-12 padding5 margin10 white">
              <div class="col-xs-12 padding5 ">
                <div class="space-12"></div>
                <p>所属代理商：<span ng-loak class="margin-left10"
                               ng-bind="$root.parentAgentInfo.agent_name"></span></p>

                <p>负 责 区 域：<span class="margin-left10" ng-bind="$root.agentInfo.area"></span></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 ">
          <div class="row">
            <div class="col-xs-12 padding5 margin10 white">
              <div class="col-xs-12 padding5 ">
                <div class="space-12"></div>
                <p>加 盟 店 数：<span class="margin-left10" ng-bind="$root.countTerminal"></span></p>

                <p ng-show="$root.isHaveChild">下级代理商数：<span class="margin-left10"
                                                            ng-bind="$root.countAgent"></span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--<script src="/ace/js/membersWizard/membersWizard.js"></script>-->
<script>

  app.controller('headController', function ($scope, $rootScope, $http, $q) {
    $scope.checkByHref = function (href) {
      if (window.location.pathname.indexOf(href) != -1) return {background: '#2b73b5'};
    };
    $rootScope.copy = function (a, b) {
      $rootScope[a] = angular.copy(b);
    };

    function isDevRuntime() {
      if (codeRuntime == 'local' || codeRuntime == 'dev') {
        return true;
      } else {
        return false;
      }
    }

    $rootScope.permissionJSON = <?= json_encode(Session::get(Session::SESSION_KEY_PERMISSION))  ?>;

    $rootScope.hasPermission = function (string) {
      if (isDevRuntime()) {
        return true;
      }
      if ($rootScope.permissionJSON.indexOf(string) == -1) {
        return false;
      } else {
        return true;
      }
    }
    $rootScope.setDisabled = function (val, string) {
      if ($rootScope.permissionJSON.indexOf(string) == -1) {
        return true;
      } else {
        if (val) {
          return true;
        } else {
          return false;
        }
      }
    }

    //  var ii = $rootScope.permissionJSON.indexOf('wx-msg-tpl/buyer-index');
    // $rootScope.permissionJSON.splice(ii , 1)
    var url = window.location.href, count = 0;
    for (var i in $rootScope.permissionJSON) {
      if (url.indexOf($rootScope.permissionJSON[i]) != -1) {
        count++;
      }
    }
    //if(!count) return window.location.href = '/errors/no-access';
    $rootScope.headList = {};
    $rootScope.headList.a = {
      href: '', text: '运营设置', isshow: false, key: 'a', child: [
        {
          href: '',
          text: '商家管理',
          class: 'icon-dailishang newicon-font',
          isshow: true,
          key: 'aa',
          child: [
            {href: '/shop/index', text: '商家信息', isshow: false, key: 'aaa'},
            {
              href: '/shop/payment-setting-list',
              text: '支付管理',
              class: 'icon-zhifuguanli newicon-font',
              isshow: false,
              key: 'aab'
            },
            {href: '/shop/scan-pay', text: '扫码支付', isshow: false, key: 'aad'},
            {href: '/shop/bill-setting', text: '对账单设置', isshow: false, key: 'aae'},
            {href: '/shop/wx-account', text: '微信账号设置', isshow: false, key: 'aac'},
          ]
        },
//                              {href: '/shop/payment-setting-list', text: '支付管理', class: 'icon-zhifuguanli newicon-font', isshow: false, key: 'ab'},
        {
          href: '/document/image',
          text: '图片管理',
          class: 'icon-wenjiaguanli newicon-font',
          isshow: false,
          key: 'ac'
        },
        {
          href: '/shop/manager-list',
          text: '操作员管理',
          class: 'icon-caozuoyuanguanli newicon-font',
          isshow: false,
          key: 'ad'
        },
        {
          href: '',
          text: '核销管理',
          class: 'icon-caozuoyuanguanli newicon-font',
          isshow: true,
          key: 'ae',
          child: [
            {
              href: '/terminal/write-off',
              text: '绑定核销员',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'aea'
            },
            {
              href: '/terminal/write-off-web',
              text: '网页核销',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'aeb'
            },
            {
              href: '/terminal/write-off-records',
              text: '核销记录',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'aec'
            },
            {
              href: '/terminal/write-off-shop',
              text: '核销门店排行榜',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'aed'
            },
            {
              href: '/terminal/write-off-staff',
              text: '核销员排行榜',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'aee'
            }
          ]
        },
        /* {href: '', text: '帮助中心', class: 'icon-bangzhu newicon-font', isshow: false, key: 'af', child:
         [
         {href: '/help/notice-list', text: '系统公告', key: 'afa'},
         {href: '/help/feedback-list', text: '意见反馈', key: 'afb'}
         ]
         },*/
        {
          href: '',
          text: '消息通知',
          class: 'icon-wenjiaguanli newicon-font',
          isshow: true,
          key: 'ag',
          child: [
            {href: '/wx-msg-tpl/buyer-index', text: '买家消息', key: 'aga'},
            {href: '/wx-msg-tpl/seller-index', text: '商家消息', key: 'agb'}
          ]
        },
        {
          href: '/sms/sms-account',
          text: '短信账户',
          class: 'icon-wenjiaguanli newicon-font',
          isshow: true,
          key: 'ai'

        },
        {
          href: '/shop/developer',
          text: '开发者模式',
          class: 'icon-caozuoyuanguanli newicon-font',
          isshow: true,
          key: 'ah'
        }
      ]
    };
    $rootScope.headList.b = {
      href: '', text: '微信设置', key: 'b', child: [
        {
          href: '',
          text: '素材管理',
          class: 'icon-sucai newicon-font',
          isshow: true,
          key: 'ba',
          child: [
            {
              href: '/wxmaterial/news-list',
              text: '图文素材',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'baa'
            },
            {
              href: '/wxmaterial/text-list',
              text: '文本素材',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'bab'
            },
            {
              href: '/wxmaterial/image-list',
              text: '图片素材',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'bac'
            }
          ]
        },
        {
          href: '',
          text: '回复管理',
          class: 'icon-huifu newicon-font',
          isshow: true,
          key: 'bb',
          child: [
            {href: '/weixin/keyword-reply-list', text: '关键词回复', key: 'bba'},
            {href: '/weixin/default-reply-edit', text: '默认回复', key: 'bbb'},
            {href: '/weixin/attention-reply-edit', text: '关注后回复', key: 'bbc'}
          ]
        },
        {
          href: '/weixin/diymenu',
          text: '自定义菜单',
          class: 'icon-zidingyicaidan newicon-font',
          isshow: false,
          key: 'bc'
        },
        {
          href: '/weixin/message-list',
          text: '消息管理',
          class: 'icon-huifu newicon-font',
          isshow: false,
          key: 'bd'
        },
      ]
    };

    /*$rootScope.headList.c = {
      href: '', text: '微店铺', key: 'c', child: [
        {
          href: '',
          text: '店铺管理',
          class: 'icon-dailishang newicon-font',
          isshow: true,
          key: 'ca',
          child: [
            {
              href: '/page/list',
              text: '页面管理',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'caa'
            },
            {
              href: '/page/category',
              text: '分类管理',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'cab'
            },
            {
              href: '/page/menu',
              text: '导航设置',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'cac'
            },
//                                  {href: '/mall/navigation-list', text: '导航菜单', class: 'icon-dailishang newicon-font', isshow: false, key: 'caa'},
//                                {href: '/mall/slide-list', text: '商城幻灯片', class: 'icon-dailishang newicon-font', isshow: false, key: 'cab'}
          ]
        },
        {
          href: '',
          text: '商品管理',
          class: 'icon-shangpin newicon-font',
          isshow: true,
          key: 'cb',
          child: [
            {
              href: '/product/list',
              text: '商品列表',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'cba'
            },
            {
              href: '/product/category-list',
              text: '商品分类',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'cbb'
            },
            {
              href: '/product/kind-list',
              text: '商品规格',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'cbc'
            },
            {
              href: '/product/comment-list',
              text: '商品评论',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'cbd'
            }
          ]
        },
        {
          href: '/order/list',
          text: '订单管理',
          class: 'icon-dingdan newicon-font',
          isshow: false,
          key: 'cc'
        },
        {
          href: '/order/refund-list',
          text: '售后订单管理',
          class: 'icon-shouhou newicon-font',
          isshow: false,
          key: 'cd'

        },
        {
          href: '',
          text: '物流管理',
          class: 'icon-fahuo newicon-font',
          isshow: true,
          key: 'ce',
          child:[
            {
              href: '/order/shipping-way',
              text: '配送方式',
              class:'icon-fahuo newicon-font',
              isshow: false,
              key: 'ceb'
            },
            {
              href: '/order/shippingmode',
              text: '邮费模板',
              class:'icon-fahuo newicon-font',
              isshow: false,
              key: 'cea'
            }
          ]
        },
        {
          href: '/order/order-shop',
          text: '订单统计',
          class: 'icon-dingdan newicon-font',
          isshow: false,
          key: 'cf'
        }
      ]
    };
    $rootScope.headList.d = {
      href: '', text: '微会员', key: 'd', child: [
        {
          href: '',
          text: '客户管理',
          class: 'icon-huiyuan newicon-font',
          isshow: true,
          key: 'da',
          child: [
            {
              href: '/member/list',
              text: '客户列表',
              class: 'icon-dailishang newicon-font',
              key: 'daa'
            },
            {
              href: '/member/group-list',
              text: '客户分组',
              class: 'icon-dailishang newicon-font',
              key: 'dab'
            }
          ]
        },
        {
          href: '',
          text: '会员管理',
          class: 'icon-signal',
          isshow: true,
          key: 'db',
          child: [
            {
              href: '/members/profile',
              text: '会员概况',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'dba'
            },
            {
              href: '/members/list',
              text: '会员列表',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'dbb'
            },
            {
              href: '',
              text: '分组和标签',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'dbc',
              child: [{href: '/members/group'}, {href: '/members/tag'}]
            },
            {
              href: '/members/consumption-record',
              text: '会员消费记录',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'dbd'
            }
          ]
        },
        {
          href: '',
          text: '会员卡设置',
          class: 'icon-credit-card newicon-font',
          isshow: true,
          key: 'dc',
          child: [
            {
              href: '/members/card',
              text: '会员卡设置',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'dca'
            },
            {
              href: '/members/card-gift',
              text: '开卡优惠设置',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'dcb'
            },
            {
              href: '/members/growth',
              text: '成长值管理',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'dcc'
            },
            {
              href: '/members/grade',
              text: '会员等级管理',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'dcd'
            },
            {
              href: '/members/notice',
              text: '会员通知',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'dce'
            }
          ]
        },
        {
          href: '',
          text: '会员卡投放',
          class: 'icon-sitemap',
          isshow: true,
          key: 'dd',
          child: [
            {
              href: '/members/delivery',
              text: '直接投放',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'dda'
            }
          ]
        },
        {
          href: '',
          text: '会员营销',
          class: 'icon-line-chart',
          isshow: true,
          key: 'de',
          child: [
            {
              href: '',
              text: '会员折扣',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'dea',
              child: [{href: '/members/discount'}, {href: '/members/discount-sub'}]
            }
          ]
        },
        {
          href: '',
          text: '积分管理',
          class: 'icon-briefcase',
          isshow: true,
          key: 'df',
          child: [
            {
              href: '/members/point-flow-record',
              text: '积分流水记录',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'dfa'
            }
          ]
        },
        {
          href: '',
          text: '数据统计',
          class: 'icon-pie-chart',
          isshow: true,
          key: 'dg',
          child: [
            {
              href: '/members/member-statistics',
              text: '会员趋势统计',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'dga'
            },
            {
              href: '/members/cons-statistics',
              text: '消费分层统计',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'dgb'
            },
            {
              href: '/members/member-card-statistics',
              text: '会员卡投放统计',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'dgc'
            }
          ]
        },
      ]
    };*/

    $rootScope.headList.e = {
      href: '', text: '微营销', key: 'e', child: [

        {
          href: '',
          text: '销售活动',
          class: 'icon-xiaoshou newicon-font',
          isshow: true,
          key: 'ea',
          child: [
            {
              href: '/second-kill/list',
              text: '秒杀活动',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'eab'
            },
            {
              href: '/together-buy/list',
              text: '拼团活动',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'eab'
            }
            ,
            {
              href: '/reduction/list',
              text: '满减包邮',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'eac'
            }
          ]
        },
        {
          href: '',
          text: '推广活动',
          class: 'icon-tuiguangguanli newicon-font',
          isshow: true,
          key: 'eb',
          child: [
            {
              href: '/collect-zan/list',
              text: '众筹活动',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'ebb'
            },
            {
              href: '/market-activity/list',
              text: '大转盘',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'ebc'
            },
            {
              href: '/market-activity/smashegg-list',
              text: '砸金蛋',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'ebc'
            },
            {
              href: '',
              text: '现金红包',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'ebd', child: [
              {href: '/cash-redpack/list'},
              {href: '/cash-redpack/policy-list'},
              {href: '/cash-redpack/send-list'}
            ]
            }
          ]
        },
        {
          href: '',
          text: '优惠活动',
          class: 'icon-tuiguangguanli newicon-font',
          isshow: true,
          key: 'ec',
          child: [
            {
              href: '',
              text: '积分活动',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'eaa',
              child: [
                {href: '/activity-points/list'}, {href: '/points-redeem/list'}
              ]
            },
            {
              href: '/redpack/list',
              text: '商城红包',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'eba',
              child: [
                {href: '/redpack-manage/list'}, {href: '/redpack/list'}
              ]
            },
            {
              href: '',
              text: '卡券活动',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'eba',
              child: [
                {href: '/card-coupons/list'},
                {href: '/card-coupons/receive-list'},
                {href: '/card-coupons/policy-list'},
                {href: '/card-coupons/send-list'}
              ]
            },

          ]
        },
        {
          href: '',
          text: '场景活动',
          class: 'icon-yingyongtuiguang newicon-font',
          isshow: true,
          key: 'ed',
          child: [
            {
              href: '/reserve/list',
              text: '预约活动',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'eda'
            },
            {
              href: '/tv-card-coupons/list',
              text: '摇电视',
              class: 'icon-yaodianshi newicon-font',
              isshow: false,
              key: 'edb'
            },
            {
              href: '/signin-setting/list',
              text: '签到活动',
              class: 'icon-yaodianshi newicon-font',
              isshow: false,
              key: 'edc'
            }
          ]
        }

      ]
    };
    /*
    $rootScope.headList.f = {
      href: '', text: '微杂志', key: 'f', child: [
        {
          href: '/magazine/list',
          text: '杂志管理',
          class: 'icon-yingyongtuiguang newicon-font',
          isshow: false,
          key: 'fa'
        },
        {
          href: '/magazine/category-list',
          text: '分类管理',
          class: 'icon-mingxi newicon-font',
          isshow: false,
          key: 'fb'
        },
        {
          href: '/magazine/form',
          text: '表单数据',
          class: 'icon-shuju newicon-font',
          isshow: false,
          key: 'fc'
        }
      ]
    };
    $rootScope.headList.g = {
      href: '', text: '微推广', isshow: false, key: 'g', child: [
        {
          href: '/fx/setting',
          text: '推广设置',
          class: 'icon-cogs newicon-font',
          isshow: false,
          key: 'ga'
        },
        {href: '/fx/level-list', text: '推广员等级', class: 'icon-cubes', isshow: false, key: 'gc'},
        {
          href: '',
          text: '推广员管理',
          class: 'icon-gonggaofuzhi newicon-font',
          isshow: true,
          key: 'gd',
          child: [
            {
              href: '/fx/member-list',
              text: '推广员列表',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'gda'
            },
            {
              href: '/fx/member-overage-log',
              text: '操作日志',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'gdb'
            },
          ]
        },
        {
          href: '', text: '推广策略', class: 'icon-dashboard ', isshow: true, key: 'gb', child: [
          {
            href: '/fx/policy-list',
            text: '推广策略',
            class: 'icon-dailishang newicon-font',
            isshow: false,
            key: 'gba'
          },
          {
            href: '/fx/strategy-log-list',
            text: '策略日志',
            class: 'icon-dailishang newicon-font',
            isshow: false,
            key: 'gbb'
          },
        ]
        },
        {
          href: '/fx/order-list',
          text: '推广订单',
          class: 'icon-dingdan newicon-font',
          isshow: false,
          key: 'ge'
        },
        {
          href: '', text: '推广结算', class: 'icon-calculator', isshow: true, key: 'gf', child: [
          {
            href: '/fx/member-overage-list',
            text: '账户余额',
            class: 'icon-dailishang newicon-font',
            isshow: false,
            key: 'gfa'
          },
          {
            href: '/fx/paysetting',
            text: '收款渠道',
            class: 'icon-dailishang newicon-font',
            isshow: false,
            key: 'gfb'
          },
          {
            href: '/fx/export',
            text: '导出打款明细',
            class: 'icon-dailishang newicon-font',
            isshow: false,
            key: 'gfc'
          },
          {
            href: '/fx/import',
            text: '导入支付明细',
            class: 'icon-dailishang newicon-font',
            isshow: false,
            key: 'gfd'
          },
          {
            href: '/fx/operation-log-list',
            text: '操作日志',
            class: 'icon-dailishang newicon-font',
            isshow: false,
            key: 'gfe'
          }

        ]
        }
      ]
    };
    $rootScope.headList.h = {
      href: '', text: '微分店', key: 'h', child: [
        {
          href: '/terminal/list',
          text: '直营店管理',
          class: 'icon-dailishang newicon-font',
          isshow: false,
          key: 'ha'
        },
        {
          href: '',
          text: '直营店数据统计',
          class: 'icon-dailishang newicon-font',
          isshow: true,
          key: 'hb',
          child: [
            {
              href: '', text: '订单统计', class: 'icon-line-chart', key: 'hba', child: [
              {href: '/data/order-shop'},
              {href: '/data/order-staff'}
            ]
            },
            {
              href: '', text: '客户统计', class: 'icon-pie-chart', key: 'hbb', child: [
              {href: '/data/member-shop'}, {href: '/data/member-staff'}
            ]
            },
            {
              href: '', text: '推广统计', class: 'icon-pie-chart', key: 'hbc', child: [
              {href: '/data/fx-shop'}, {href: '/data/fx-staff'}, {href: '/data/fx-member'}
            ]
            }
          ]
        },
        {
          href: '/agent/list',
          text: '代理商管理',
          class: 'icon-dailishang newicon-font',
          isshow: false,
          key: 'hc'
        },
        {
          href: '',
          text: '代理商数据统计',
          class: 'icon-shuju newicon-font',
          isshow: true,
          key: 'hd',
          child: [
            {
              href: '', text: '订单统计', class: 'icon-shopping-cart', key: 'hda', child: [
              {href: '/data/agent-order-agent'}, {href: '/data/agent-order-shop'}, {href: '/data/agent-order-staff'}
            ]
            },
            {
              href: '/data/agent-order-detail',
              text: '订单明细统计',
              class: 'icon-shopping-cart',
              key: 'hdb'
            },

            {
              href: '', text: '客户统计', class: 'icon-shopping-cart', key: 'hdc', child: [
              {href: '/data/agent-member-agent'}, {href: '/data/agent-member-shop'}, {href: '/data/agent-member-staff'}
            ]
            },
            {
              href: '/data/agent-member-detail',
              text: '客户明细统计',
              class: 'icon-shopping-cart',
              key: 'hdd'
            },
            {
              href: '', text: '推广统计', class: 'icon-shopping-cart', key: 'hde', child: [
              {href: '/data/agent-fx-agent'}, {href: '/data/agent-fx-shop'}, {href: '/data/agent-fx-staff'}, {href: '/data/agent-fx-member'}
            ]
            },
            {href: '/data/agent-fx-detail', text: '推广明细统计', class: 'icon-shopping-cart', key: 'hdf'}
          ]
        },


        {
          href: '',
          text: '员工码门店码管理',
          class: 'icon-shuju newicon-font',
          isshow: true,
          key: 'hi',
          child: [
            {
              href: '',
              text: '管理员工码推送策略', class: 'icon-shopping-cart', key: 'hib', child: [
              {href: '/employees-code/management-employee-policy'},
              {href: '/employees-code/edit-employee-policy'},
              {href: '/employees-code/contain-employee'}
            ]
            },
            {
              href: '', text: '管理门店码推送策略', class: 'icon-shopping-cart', key: 'hic', child: [
              {href: '/employees-code/management-stores-policy'},
              {href: '/employees-code/edit-stores-policy'},
              {href: '/employees-code/contain-stores'}
            ]
            }
          ]
        },

        {
          href: '',
          text: '收款码管理',
          class: 'icon-barcode newicon-font',
          isshow: true,
          key: 'he',
          child: [
            {
              href: '', text: '终端店收款码', class: 'icon-shopping-cart', key: 'hea', child: [
              {href: '/terminal/scan-pay'}
            ]
            },
            {
              href: '', text: '员工收款码', class: 'icon-shopping-cart', key: 'heb', child: [
              {href: '/staff/scan-pay'}
            ]
            },

          ]
        },
        {
          href: '',
          text: '直营店对账结算',
          class: 'icon-shuju newicon-font',
          isshow: true,
          key: 'hf',
          child: [
            {
              href: '/statement/bill-statistics-list',
              text: '账单统计',
              class: 'icon-shopping-cart',
              key: 'hfa'
            },
            {
              href: '/statement/generate-settlement-info',
              text: '生成结算信息',
              class: 'icon-shopping-cart',
              key: 'hfb'
            },
            {
              href: '/statement/send-pay-info',
              text: '发送打款信息',
              class: 'icon-shopping-cart',
              key: 'hfc'
            },

          ]
        },
      ]
    };
    $rootScope.headList.i = {
      href: '', text: '微硬件', key: 'i', child: [
        {
          href: '', text: '微WiFi', class: 'icon-wifi', isshow: true, key: 'ia', child: [
          {
            href: '/hardware/yeah-wifi-list',
            text: '微WiFi',
            class: 'icon-dailishang newicon-font',
            isshow: false,
            key: 'iaa'
          },
          {
            href: '/hardware/yeah-wifi-statistics',
            text: '数据统计',
            class: 'icon-dailishang newicon-font',
            isshow: false,
            key: 'iab'
          }
        ]
        },
        {
          href: '', text: '微立得', class: 'icon-camera-retro', isshow: true, key: 'ib', child: [
          {
            href: '/hardware/client-list',
            text: '设备管理',
            class: 'icon-dailishang newicon-font',
            isshow: false,
            key: 'iba'
          },
          {
            href: '/hardware/templates',
            text: '模版管理',
            class: 'icon-dailishang newicon-font',
            isshow: false,
            key: 'ibb'
          },
          {
            href: '/hardware/materials',
            text: '素材管理',
            class: 'icon-dailishang newicon-font',
            isshow: false,
            key: 'ibc'
          },
          {
            href: '/hardware/statistics',
            text: '数据统计',
            class: 'icon-dailishang newicon-font',
            isshow: false,
            key: 'ibd'
          }
        ]
        },
        {
          href: '',
          text: '微POS',
          class: 'icon-shop-m newicon-font',
          isshow: true,
          key: 'ic',
          child: [
            {
              href: '/hardware/pos-list',
              text: 'pos管理',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'ica'
            },
            {
              href: '/hardware/ad-list',
              text: '广告管理',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'icb'
            }
          ]
        },
        {
          href: '',
          text: '摇一摇',
          class: 'icon-shandianfahuo newicon-font',
          isshow: true,
          key: 'id',
          child: [
            {
              href: '/hardware/ibeacon-pages-list',
              text: '页面管理',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'ida'
            },
            {
              href: '/hardware/ibeacon-evices-list',
              text: '设备管理',
              class: 'icon-dailishang newicon-font',
              isshow: false,
              key: 'idb'
            }
          ]
        }
      ]
    };*/

    if (wsh.getHref("terminal_id")) {
      var childs = [
        {
          href: '', text: '终端店信息', class: 'icon-home', isshow: true, key: 'ha', child: [
          {
            href: '/terminal/detail?terminal_id=' + wsh.getHref("terminal_id"),
            text: '终端店信息',
            key: 'ha'
          },
          {
            href: '/terminal/statement?terminal_id=' + wsh.getHref("terminal_id"),
            text: '收款账户设置',
            key: 'ha'
          },
          {href: '/order/list?terminal_id=' + wsh.getHref("terminal_id"), text: '订单列表', key: 'cc'},
          {href: '/member/list?terminal_id=' + wsh.getHref("terminal_id"), text: '客户列表', key: 'da'},
          {
            href: '/fx/member-list?terminal_id=' + wsh.getHref("terminal_id"),
            text: '推广管理',
            key: 'ge'
          },
          {href: '/staff/list?terminal_id=' + wsh.getHref("terminal_id"), text: '员工列表', key: 'ha'},
          {
            href: '/terminal/write-off?terminal_id=' + wsh.getHref("terminal_id"),
            text: '核销管理',
            key: 'ae'
          },
        ]
        },
        {
          href: '', text: '收款码管理', class: 'icon-barcode', isshow: true, key: 'hc', child: [
          {
            href: '/terminal/scan-pay-detail?terminal_id=' + wsh.getHref("terminal_id"),  //这个地址需要修改
            text: '终端店收款码',
            key: 'hc',
            class: 'icon-shopping-cart'
          },
          {
            href: '/staff/scan-pay?terminal_id=' + wsh.getHref("terminal_id"),
            text: '员工收款码',
            key: 'cc'
          }
        ]
        },
        {
          href: '',
          text: '数据统计',
          class: 'icon-dailishang newicon-font',
          key: 'hb',
          isshow: true,
          child: [
            {
              href: '/data/order-shop?terminal_id=' + wsh.getHref("terminal_id"),
              text: '订单统计',
              class: 'icon-line-chart',
              key: 'hba'
            },
            {
              href: '/data/member-shop?terminal_id=' + wsh.getHref("terminal_id"),
              text: '客户统计',
              class: 'icon-pie-chart',
              key: 'hbb'
            },
            {
              href: '/data/fx-shop?terminal_id=' + wsh.getHref("terminal_id"),
              text: '推广统计',
              class: 'icon-pie-chart',
              key: 'hbc'
            },
          ]
        },
      ];
      $rootScope.headList.a = {href: '', text: '运营设置', key: 'a', child: childs};
      $rootScope.headList.b = {href: '', text: '微信设置', key: 'b', child: childs};
      $rootScope.headList.c = {href: '', text: '微店铺', key: 'c', child: childs};
      $rootScope.headList.d = {href: '', text: '微会员', key: 'd', child: childs};
      $rootScope.headList.g = {href: '', text: '微推广', key: 'g', child: childs};
      $rootScope.headList.h = {href: '', text: '微分店', key: 'h', child: childs}
    } else if (wsh.getHref("agent_id")) {

      var childs = [
        {
          href: '', text: '代理商信息', class: 'icon-reorder', isshow: true, key: 'hc', child: [
          {
            href: '/agent/detail?agent_id=' + wsh.getHref("agent_id"),
            text: '代理商信息',
            key: 'hc',
            class: 'icon-shopping-cart'
          },

        ]
        },
        {
          href: '', text: '他的加盟店', class: 'icon-bar-chart', isshow: true, key: 'hc', child: [
          {
            href: '/terminal/list?agent_id=' + wsh.getHref("agent_id"),
            text: '终端店列表',
            key: 'hc',
            class: 'icon-shopping-cart'
          },
          {href: '/order/list?agent_id=' + wsh.getHref("agent_id"), text: '订单列表', key: 'cc'},
          {href: '/member/list?agent_id=' + wsh.getHref("agent_id"), text: '客户列表', key: 'da'},
          {href: '/fx/member-list?agent_id=' + wsh.getHref("agent_id"), text: '推广管理', key: 'ge'},
        ]
        },
        {
          href: '', text: '收款码管理', class: 'icon-barcode', isshow: true, key: 'hc', child: [
          {
            href: '/terminal/scan-pay-agent?agent_id=' + wsh.getHref("agent_id"),
            text: '终端店收款码',
            key: 'hc',
            class: 'icon-shopping-cart'
          },
          {href: '/staff/scan-pay?agent_id=' + wsh.getHref("agent_id"), text: '员工收款码', key: 'cc'}
        ]
        },
        {
          href: '',
          text: '数据统计',
          class: 'icon-dailishang newicon-font',
          key: 'hb',
          isshow: true,
          child: [
            {
              href: '/data/order-shop?agent_id=' + wsh.getHref("agent_id"),
              text: '订单统计',
              class: 'icon-line-chart',
              key: 'hba'
            },
            {
              href: '/data/member-shop?agent_id=' + wsh.getHref("agent_id"),
              text: '客户统计',
              class: 'icon-pie-chart',
              key: 'hbb'
            },
            {
              href: '/data/fx-shop?agent_id=' + wsh.getHref("agent_id"),
              text: '推广统计',
              class: 'icon-pie-chart',
              key: 'hbc'
            },
          ]
        }
      ];

      $rootScope.headList.a = {href: '', text: '运营设置', key: 'a', child: childs}
      $rootScope.headList.c = {href: '', text: '微店铺', key: 'c', child: childs};
      $rootScope.headList.d = {href: '', text: '微会员', key: 'd', child: childs};
      $rootScope.headList.g = {href: '', text: '微推广', key: 'g', child: childs};
      $rootScope.headList.h = {href: '', text: '微分店', key: 'h', child: childs}
    }
    var codeRuntime = "<?= CODE_RUNTIME;?>";
    //测试、上线阶段，开启权限控制
    if (isDevRuntime()) {
      permissionLocal();
    } else {
      permissionOnline();
    }
    function permissionOnline() {
      $.each($scope.headList, function (i, e) {
        //二级
        for (var j in e.child) {

          if (!e.child[j].child) { //二级 没有子菜单了 只有二级
            var key = e.child[j].href.replace(/^\//, '');
            if ($rootScope.permissionJSON.indexOf(key) != -1) { //找到了 代表有权限
              e.child[j].hasPermission = true;  //设置二级可显示
              e.href = e.href && e.href || e.child[j].href; //设置一级菜单 href
            }
          } else {
            //三级
            for (var k in e.child[j].child) {
              var child = e.child[j].child[k].child;
              if (!child) { //三级 没有子菜单了 只有三级
                var key = e.child[j].child[k].href.replace(/^\//, '');
                if (key.indexOf('?') != -1) {
                  key = key.replace(/\?.*$/, '');
                }
                if ($rootScope.permissionJSON.indexOf(key) != -1) {  //找到了 代表有权限
                  e.child[j].hasPermission = true;  //设置二级可显示
                  e.child[j].child[k].hasPermission = true;  //设置三级可显示
                  e.href = e.href && e.href || e.child[j].child[k].href; //设置一级菜单 href
                }
              } else {
                //四级
                for (var l in e.child[j].child[k].child) {
                  var key = e.child[j].child[k].child[l].href.replace(/^\//, '');
                  if (key.indexOf('?') != -1) {
                    key = key.replace(/\?.*$/, '');
                  }
                  if ($rootScope.permissionJSON.indexOf(key) != -1) {
                    e.href = e.href && e.href || e.child[j].child[k].child[l].href; //设置一级菜单 href
                    e.child[j].hasPermission = true;
                    e.child[j].child[k].hasPermission = true; //设置三级可显示
                    e.child[j].child[k].href = e.child[j].child[k].href && e.child[j].child[k].href || e.child[j].child[k].child[l].href;
                  }
                }
              }
            }
          }
        }
      })
    }

    function permissionLocal() {
      //开发阶段，关闭权限控制
      $.each($scope.headList, function (i, e) {
        //二级
        for (var j in e.child) {

          if (!e.child[j].child) { //二级 没有子菜单了 只有二级
            var key = e.child[j].href.replace(/^\//, '');
            e.child[j].hasPermission = true;  //设置二级可显示
            e.href = e.href && e.href || e.child[j].href; //设置一级菜单 href
          } else {
            //三级
            for (var k in e.child[j].child) {
              var child = e.child[j].child[k].child;
              if (!child) { //三级 没有子菜单了 只有三级
                var key = e.child[j].child[k].href.replace(/^\//, '');
                if (key.indexOf('?') != -1) {
                  key = key.replace(/\?.*$/, '');
                }
                e.child[j].hasPermission = true;  //设置二级可显示
                e.child[j].child[k].hasPermission = true;  //设置三级可显示
                e.href = e.href && e.href || e.child[j].child[k].href; //设置一级菜单 href
              } else {
                //四级
                for (var l in e.child[j].child[k].child) {
                  var key = e.child[j].child[k].child[l].href.replace(/^\//, '');
                  if (key.indexOf('?') != -1) {
                    key = key.replace(/\?.*$/, '');
                  }
                  e.href = e.href && e.href || e.child[j].child[k].child[l].href; //设置一级菜单 href
                  e.child[j].hasPermission = true;
                  e.child[j].child[k].hasPermission = true; //设置三级可显示
                  e.child[j].child[k].href = e.child[j].child[k].href && e.child[j].child[k].href || e.child[j].child[k].child[l].href;
                }
              }
            }
          }
        }
      })
    }

    $rootScope.getSearchUrl = window.location.search;

    $scope.agent_id = wsh.getHref('agent_id');
    $scope.franchisee_id = wsh.getHref('terminal_id');

    var _start, _end;
    $scope.$on('changeTerminal', function (e, start, end) {
      _start = start;
      _end = end;
    });
    $rootScope.getDataHref = function (url, params) {
      if ($scope.agent_id || $scope.franchisee_id) {
        var getSearchUrl = $rootScope.getSearchUrl ? $rootScope.getSearchUrl + '&' : '?';
        return url + getSearchUrl + '&' + params + '&createStart=' + _start + '&createEnd=' + _end;
      }
      return url + '?' + params + '&createStart=' + _start + '&createEnd=' + _end;
    }

    $scope.getAgentInfo = function () {
      var deferred = $q.defer();
      $http.post('/agent/get-shop-agent-ajax', {"id": $scope.agent_id ? parseInt($scope.agent_id) : null})
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            deferred.resolve(msg.errmsg);
            $('#agent_head').show();
          });
        });
      return deferred.promise;
    }
    if ($scope.agent_id && !$scope.franchisee_id) {
      $('#navList').css('margin-top', '60px');
      var aa = $scope.getAgentInfo();
      aa.then(function (data) {
        $rootScope.agentInfo = data.agentInfo;//当前代理商信息
        $rootScope.parentAgentInfo = data.parentAgentInfo;//上级代理商信息
        $rootScope.countAgent = data.countAgent;//下级代理商数
        $rootScope.countTerminal = data.countTerminal;//加盟店数
        $rootScope.isHaveChild = (parseInt($rootScope.agentInfo.level) < 3);

        if ($rootScope.isHaveChild) {
          $('.submenu:first').append('<li class="ng-scope"><a href="/agent/list?agent_id=' + wsh.getHref("agent_id") + '" class="ng-binding">下级代理商</a></li>');
        }
      })
    }


    //查看二头部维码
    $scope.getQrcode = function () {
      $.ajax({
        type: "POST",
        url: "<?= Url::to(['weixin/qrcode-detail-ajax']);?>",
        dataType: "JSON",
        data: {
          "model": "terminal",
          "model_id": wsh.getHref("terminal_id") ? wsh.getHref("terminal_id") : ''
        },
        success: function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.srcImg = msg["errmsg"];
            $scope.$apply();
          });
        }
      });
    }

    $scope.getFranchiseeInfo = function () {
      var deferred = $q.defer();
      $http.post('/terminal/get-agent-franchisee-ajax', {"id": $scope.franchisee_id ? parseInt($scope.franchisee_id) : null})
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            deferred.resolve(msg.errmsg);
            $('#terminal_head').show();
            $scope.getQrcode();
          });
        });
      return deferred.promise;
    }

    if ($scope.franchisee_id) {
      $('#navList').css('margin-top', '60px');
      var aa = $scope.getFranchiseeInfo();
      aa.then(function (data) {
        $rootScope.franchiseeInfo = data.shopInfo;

      })
    }

    if (!$scope.franchisee_id && !$scope.agent_id) {
      $('#shanghu_head').show();
    } else {
      $('#main-container').css('margin-top', '60px');
    }

    //左侧菜单高亮
    $scope.hostname = location.host;
    $scope.splitame = location.href.split($scope.hostname)[1].split("?")[0];
    var setIntime = setInterval(function () {
      $.each($('#sidebar').find('a'), function () {
        var href = null;
        if ($(this).attr('href') != undefined) {
          href = $(this).attr('href');
          href = href.split("?")[0];
        }
        if (href == $scope.splitame) {
          $(this).parent().addClass('active');
          clearInterval(setIntime);
          return;
        }
      })
    }, 500);
  });
  $(".dropdown-menu").hide();
  $("#dropdown").hover(function () {
    $(this).children('.dropdown-menu').slideDown('fast');
  }, function () {
    $(this).children('.dropdown-menu').hide();

  })


</script>


