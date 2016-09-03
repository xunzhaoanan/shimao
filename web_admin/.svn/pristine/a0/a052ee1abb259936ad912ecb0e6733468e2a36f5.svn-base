/**
 * author 陈吉
 */
;
(function () {
  'use strict';

  app.directive('previewBuild', previewBuild)
    .directive('showBuild', showBuild)
    .directive('moduleBuild', moduleBuild)
    .directive('homeModule', homeModule)
    .directive('richtextModule', richtextModule)
    .directive('searchModule', searchModule)
    .directive('blankModule', blankModule)
    .directive('lineModule', lineModule)
    .directive('imageNavModule', imageNavModule)
    .directive('textNavModule', textNavModule)
    .directive('imageAdsModule', imageAdsModule)
    .directive('noticeModule', noticeModule)
    .directive('goodsModule', goodsModule);

  function showBuild($compile) {

    return {
      restrict: 'E',
      scope: {
        page: '='
      },
      link: function (scope, element) {
        angular.forEach(scope.page.items, function (obj) {
          obj.prefix = scope.page.prefix;
          obj.shopInfo = scope.page.shopInfo;
          obj.hide = (obj.type === 'goods' && obj.goodsList.length === 0);
        });
        var template = '<div class="app-body" style="background-color: {{page.bg_color}}; max-width: 640px; margin: 0 auto; min-height: {{screenHeight}}px;">' +
          '<div class="app-module" ng-repeat="item in page.items | filter:{hide:\'false\'}"><module-build item="item"></module-build></div>' +
          '</div>';
        element.html(template);
        $compile(element.contents())(scope);
        scope.screenHeight = $(document).height();
      }
    };
  }

  showBuild.$inject = ['$compile'];

  function previewBuild($compile, pageEditServ) {

    return {
      restrict: 'E',
      scope: {},
      link: function (scope, element) {
        scope.page = pageEditServ.page;
        angular.forEach(scope.page.items, function (obj) {
          obj.prefix = scope.page.prefix;
          obj.shopInfo = scope.page.shopInfo;
          obj.hide = (obj.type === 'goods' && obj.goodsList.length === 0);
        });
        var template = '<div class="app-container">' +
          '<div class="app-header"></div>' +
          '<div class="app-body" style="background-color: {{page.bg_color}}">' +
          '<div class="app-field"><span ng-bind="page.title"></span></div>' +
          '<div class="app-module" ng-repeat="item in page.items | filter:{hide:\'false\'}"><module-build item="item"></module-build></div>' +
          '</div>' +
          '<div class="app-foot"></div>' +
          '</div>' +
          '<div class="app-qrcode">' +
          '<p class="text-center shop-detail"><strong>手机扫码访问</strong></p>' +
          '<p class="text-center weixin-title">微信“扫一扫”分享到朋友圈</p>' +
          '<div class="app-erweima text-center"><img ng-src="{{page.qrcodeUrl}}" /></div>' +
          '</div>';
        element.html(template);
        $compile(element.contents())(scope);
      }
    };
  }

  previewBuild.$inject = ['$compile', 'pageEditServ'];

  function moduleBuild($compile) {

    return {
      restrict: 'E',
      scope: {
        item: '='
      },
      link: function (scope, element) {

        scope.$watch('item', function (v) {
          if (v) {
            element.html('<' + v.type + '-module module-data="item"></' + v.type + '-module>');
            $compile(element.contents())(scope);
          }
        });
      }
    };
  }

  moduleBuild.$inject = ['$compile'];

  //商品设置模块
  function goodsModule() {

    var goodsList = [];

    for (var i = 1; i <= 4; i++) {
      goodsList.push({
        name: '商品' + i,
        show_price: '0.00',
        productInfo: {description: '显示商品名称' + i},
        covers: {file_cdn_path: '/ace/images/page/goods' + i + '.jpg'},
        created: 1420070400,
        sales: 100,
        productSkus :[{
          market_price:10000

        }]
      });
    }

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      templateUrl: '/ace/js/page/directives/templates/goodsTmpl.html',
      link: function (scope, element) {

        if (scope.module.isInit === true || scope.module.goodsList === undefined) {
          if (scope.module.isInit) {
            scope.$emit('moduleBuildSuccess', [element.parent().parent()[0].offsetTop]);
          }
          scope.module.layoutType = scope.module.layoutType ? scope.module.layoutType : '2';
          scope.module.showGoodsName = true;
          scope.module.showGoodsPrice = true;
          scope.module.goodsList = goodsList;
          scope.module.priceType = 3;//商品设置单选默认值
          scope.module.isInit = true;
        }

        scope.$watch('module.layoutType', function () {
          if (scope.module.isInit) {
            if (scope.module.layoutType === '1') {
              scope.module.goodsList = [goodsList[0]];
            } else {
              scope.module.goodsList = goodsList;
            }
          }
        });

        scope.$watchCollection('module.goodsList', function (newV) {
          if (newV && newV.length === 0) {
            scope.module.isInit = true;
            if (scope.module.layoutType === '1') {
              scope.module.goodsList = [goodsList[0]];
            } else {
              scope.module.goodsList = goodsList;
            }
          }
        });
      }
    };
  }

  //富文本模块
  function richtextModule() {

    var temp = '<p>点此编辑『富文本』内容 ——&gt;</p><p>你可以对文字进行<strong>加粗</strong>、<em>斜体</em>、<span style="text-decoration: underline;">下划线</span>、<span style="text-decoration: line-through;">删除线</span>、文字<span style="color: rgb(0, 176, 240);">颜色</span>、<span style="background-color: rgb(255, 192, 0); color: rgb(255, 255, 255);">背景色</span>、以及字号<span style="font-size: 20px;">大</span><span style="font-size: 14px;">小</span>等简单排版操作。</p><p>还可以在这里加入表格了</p><table><tbody><tr><td width="93" valign="top" style="word-break: break-all;">中奖客户</td><td width="93" valign="top" style="word-break: break-all;">发放奖品</td><td width="93" valign="top" style="word-break: break-all;">备注</td></tr><tr><td width="93" valign="top" style="word-break: break-all;">猪猪</td><td width="93" valign="top" style="word-break: break-all;">内测码</td><td width="93" valign="top" style="word-break: break-all;"><em><span style="color: rgb(255, 0, 0);">已经发放</span></em></td></tr><tr><td width="93" valign="top" style="word-break: break-all;">大麦</td><td width="93" valign="top" style="word-break: break-all;">积分</td><td width="93" valign="top" style="word-break: break-all;"><a href="javascript: void(0);" target="_blank" draggable="false">领取地址</a></td></tr></tbody></table><p style="text-align: left;"><span style="text-align: left;">也可在这里插入图片、并对图片加上超级链接，方便用户点击。</span></p>';

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      templateUrl: '/ace/js/page/directives/templates/richTextTmpl.html',
      link: function (scope, element) {

        if (scope.module.isInit === true) {
          scope.module.content = temp;
          scope.isFull = false;
          scope.bgColor = '#FFFFFF';
          scope.$emit('moduleBuildSuccess', [element.parent().parent()[0].offsetTop]);
        }

        scope.$watch('module.content', function (newV, oldV) {
          if (newV !== oldV && !newV) {
            scope.module.isInit = true;
            scope.module.content = temp;
          }
        });
        setTimeout(function () {
          uParse('#app-body', {rootPath: '/ace/js/ueditor/'});
        }, 0);
      }
    };
  }

  //商品搜索模块
  function searchModule() {

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      templateUrl: '/ace/js/page/directives/templates/searchTmpl.html',
      link: function (scope, element) {
        if (scope.module.isInit === true) {
          scope.$emit('moduleBuildSuccess', [element.parent().parent()[0].offsetTop]);
        }
        scope.search = function () {
          window.location.href = scope.module.prefix + '/product/category?name=' + scope.name;
        };
      }
    };
  }

  //进入店铺模块
  function homeModule() {

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      templateUrl: '/ace/js/page/directives/templates/homeTmpl.html',
      link: function (scope, element) {
        if (scope.module.isInit === true) {
          scope.$emit('moduleBuildSuccess', [element.parent().parent()[0].offsetTop]);
        }
      }
    };
  }

  //公告设置
  function noticeModule() {

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      templateUrl: '/ace/js/page/directives/templates/noticeTmpl.html',
      link: function (scope, element) {

        if (scope.module.isInit === true) {
          scope.module.content = '请填写内容，如果过长，将会在手机上滚动显示';
          scope.$emit('moduleBuildSuccess', [element.parent().parent()[0].offsetTop]);
        }

        scope.$watch('module.content', function (newV, oldV) {
          if (newV !== oldV && !newV) {
            scope.module.isInit = true;
            scope.module.content = '请填写内容，如果过长，将会在手机上滚动显示';
          }
        });

      }
    };
  }

  //辅助空白模板插件
  function blankModule() {

    return {
      restrick: 'E',
      scope: {
        module: '=moduleData'
      },
      template: '<div style="height: {{module.blankHight}}px;"></div>',//设置空白区域的高度
      link: function (scope, element) {

        if (scope.module.isInit === true) {
          scope.module.blankHight = 30;
          scope.$emit('moduleBuildSuccess', [element.parent().parent()[0].offsetTop]);
        }

        scope.$watch('module.blankHight', function (newV, oldV) {
          if (newV !== oldV && !newV) {
            scope.module.isInit = true;
            scope.module.blankHight = 30;
          }
        });
      }
    }
  }

  //辅助线模块
  function lineModule() {

    return {
      restrick: 'E',
      scope: {
        module: '=moduleData'
      },
      template: '<div class="custom-hr clearfix"><hr class="line"/></div>',
      link: function (scope, element) {
        if (scope.module.isInit === true) {
          scope.$emit('moduleBuildSuccess', [element.parent().parent()[0].offsetTop]);
        }
      }
    }
  }

  //图片导航模块
  function imageNavModule() {

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      templateUrl: '/ace/js/page/directives/templates/imageNavTmpl.html',
      link: function (scope, element) {
        if (scope.module.isInit === true) {
          scope.module.editLength === 0;
          scope.module.imageList = [{}, {}, {}, {}];
          scope.$emit('moduleBuildSuccess', [element.parent().parent()[0].offsetTop]);
        }
      }
    };
  }

  //文本导航模块
  function textNavModule() {

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      templateUrl: '/ace/js/page/directives/templates/textNavTmpl.html',
      link: function (scope, element) {
        if (scope.module.isInit === true) {
          scope.module.navList = [];
          scope.$emit('moduleBuildSuccess', [element.parent().parent()[0].offsetTop]);
        }
      }
    };
  }

  //图片广告设置模块
  function imageAdsModule() {

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      templateUrl: '/ace/js/page/directives/templates/imageAdsTmpl.html',
      link: function (scope, element) {
        scope.carouselIndex = 0;
        scope.isLocked = true;
        if (scope.module.isInit === true) {
          scope.module.displayType = '1';
          scope.module.layoutType = '1';
          scope.module.adsList = [];
          scope.$emit('moduleBuildSuccess', [element.parent().parent()[0].offsetTop]);
        }
      }
    };
  }
})();