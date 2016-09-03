/**
 * author 陈吉
 */
;
(function () {
  'use strict';

  app.directive('moduleEdit', moduleEdit)
    .directive('richtextModuleEdit', richtextModuleEdit)
    .directive('titleModuleEdit', titleModuleEdit)
    .directive('searchModuleEdit', searchModuleEdit)
    .directive('blankModuleEdit', blankModuleEdit)
    .directive('homeModuleEdit', homeModuleEdit)
    .directive('lineModuleEdit', lineModuleEdit)
    .directive('imageNavModuleEdit', imageNavModuleEdit)
    .directive('textNavModuleEdit', textNavModuleEdit)
    .directive('imageAdsModuleEdit', imageAdsModuleEdit)
    .directive('noticeModuleEdit', noticeModuleEdit)
    .directive('pageLink', pageLink)
    .directive('addModuleEdit', addModuleEdit)
    .directive('goodsModuleEdit', goodsModuleEdit);

  function moduleEdit($compile) {

    return {
      restrict: 'E',
      scope: {
        module: '=selectedModule'
      },
      template: '<div class="app-setting-panel" ng-show="module.offsetTop"><div class="clearfix" ng-style="module.offsetTop"><div class="arrow"></div><form class="form-horizontal"></form></div></div>',
      link: function (scope, element) {

        scope.$watch('module', function (newV) {
          if (newV) {
            var template = '<' + newV.type + '-module-edit module-data="module"></' + newV.type + '-module-edit>';
            var ele = element.find('form');
            ele.html(template);
            $compile(ele.contents())(scope);
          }
        });
      }
    };
  }

  moduleEdit.$inject = ['$compile'];

  //添加内容菜单模块
  function addModuleEdit() {

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      template: '<div class="app-components clearfix" style="margin: 0; position: relative; border: 0; background-color: transparent;"><div ng-repeat="component in components" class="app-component" style="position: relative;"><a ng-bind="component.desc" ng-click="addModule(component.type)" ng-mouseover="showPreview($event)" ng-mouseout="hidePreview($event)" ></a><div class="hover-appimg" ng-if="component.imgsrc.length>0"><img ng-src="{{component.imgsrc}}"/></div></div></div>',
      link: function (scope) {

        //组件列表
        scope.components = [
          {
            desc: '富文本',
            type: 'richtext',
            imgsrc: 'http://imgcache.vikduo.com/static/0241169e4ff65d446a44f3fe1b12e09d.jpg'
          },
          {
            desc: '商品',
            type: 'goods',
            imgsrc: 'http://imgcache.vikduo.com/static/e953ce2359b280d704c0bb8852f4cf13.png'
          },
          {
            desc: '商品搜索',
            type: 'search',
            imgsrc: 'http://imgcache.vikduo.com/static/b5578bd3a89b7e4f46498ce85a0e5f90.jpg'
          },
          {
            desc: '进入店铺',
            type: 'home',
            imgsrc: 'http://imgcache.vikduo.com/static/116d1857901a16e61b80f3e5a5533afe.jpg'
          },
          {
            desc: '公告',
            type: 'notice',
            imgsrc: 'http://imgcache.vikduo.com/static/267341c926354ebc739534d1053875e5.jpg'
          },
          {
            desc: '图片广告',
            type: 'image-ads',
            imgsrc: 'http://imgcache.vikduo.com/static/f4e954654ee899ae85c8e1815612f09c.jpg'
          },
          {
            desc: '文本导航',
            type: 'text-nav',
            imgsrc: 'http://imgcache.vikduo.com/static/6093e355a5d1d71e164c11c53fb95515.jpg'
          },
          {
            desc: '图片导航',
            type: 'image-nav',
            imgsrc: 'http://imgcache.vikduo.com/static/5b0752281f211951acd37e90472f6c23.jpg'
          },
          {desc: '辅助线', type: 'line', imgsrc: ''},
          {desc: '辅助空白', type: 'blank', imgsrc: ''}
        ];

        scope.addModule = function (type) {
          var param = [type];
          scope.module && param.push(scope.module.index);
          scope.$emit('addPageModule', param);
        };

        scope.showPreview = function (e) {
          e.preventDefault();
          e.stopPropagation();
          $(e.target).siblings().show();
        };

        scope.hidePreview = function (e) {
          e.preventDefault();
          e.stopPropagation();
          $(e.target).siblings().hide();
        };
      }
    };
  }

  //富文本模块
  function richtextModuleEdit() {

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      templateUrl: '/ace/js/page/directives/templates/richTextEditTmpl.html',
      compile: function (element) {
        var ue = UE.getEditor('container');
        var colorpicker = $(element.find('input')[0]).colorpicker({
          customClass: 'colorpicker-2x', sliders: {
            saturation: {
              maxLeft: 200,
              maxTop: 200
            },
            hue: {
              maxTop: 200
            },
            alpha: {
              maxTop: 200
            }
          }
        });
        return function (scope, element) {
          ue.addListener("ready", function () {
            if (!scope.module.isInit) {
              ue.setContent(scope.module.content);
            }
          });
          ue.addListener('contentChange', function () {
            scope.$apply(function () {
              scope.module.content = ue.getContent() || ue.getContentTxt();
              if (scope.module.content) {
                scope.module.isInit = false;
              }
              setTimeout(function () {
                uParse('#app-body', {rootPath: '/ace/js/ueditor/'});
              }, 0);
            });
          });
          colorpicker.on('changeColor', function (event) {
            scope.$apply(function () {
              scope.module.bgColor = event.color.toHex();
            });
          });
          element.on('$destroy', function () {
            ue.destroy();
          });
        }
      }
    }
  }

  //页面设置插件控制
  function titleModuleEdit($http) {

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      templateUrl: '/ace/js/page/directives/templates/titleEditTmpl.html',
      compile: function () {
        var options = {
          animation: true,
          placement: 'bottom',
          title: '数字越小越靠前,例如数字1,如果填写数字一样,后创建者靠前'
        }
        $('.atip').tooltip(options);
        var colorpicker = $('#bg_color').colorpicker({
          customClass: 'colorpicker-2x', sliders: {
            saturation: {
              maxLeft: 200,
              maxTop: 200
            },
            hue: {
              maxTop: 200
            },
            alpha: {
              maxTop: 200
            }
          }
        });
        return function (scope) {
          colorpicker.on('changeColor', function (event) {
            scope.$apply(function () {
              scope.module.bg_color = event.color.toHex();
            });
          });
          $http.post(wsh.url + "category-list-ajax", {_page: 1, _page_size: 1000})
            .success(function (msg) {
              wsh.successback(msg, '', false, function () {
                scope.categoryList = msg.errmsg.data;
              });
            });
          scope.checkText = function (obj) {
            obj.textValid = wsh.getLength(obj.title) <= 60;
          };
          scope.module.textValid = wsh.getLength(scope.module.title) <= 60;
        };
      }
    };
  }

  titleModuleEdit.$inject = ['$http'];

  //商品设置模块
  function goodsModuleEdit($http, $compile) {

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      templateUrl: '/ace/js/page/directives/templates/goodsEditTmpl.html',
      link: function (scope, element) {

        var tempList = [];

        //查询一级
        $http.post('/product/category-list-ajax', {pid: 0})
          .success(function (msg) {
            if (msg.errmsg.data && msg.errmsg.data.length > 0) {
              scope.fCategorySelect = [{
                id: '',
                name: '全部一级分类'
              }].concat(msg.errmsg.data);
              scope.sCategorySelect = [{
                'id': '',
                'name': '全部二级分类'
              }];
              scope.tCategorySelect = [{
                'id': '',
                'name': '全部三级分类'
              }];
            } else {
              scope.fCategorySelect = scope.sCategorySelect = scope.tCategorySelect = [{
                'id': '',
                'name': '暂无下级分类'
              }];
            }
            scope.fCategory = scope.sCategory = scope.tCategory = '';
          }
        );

        //查询二级
        scope.getSecond = function () {
          $http.post('/product/category-list-ajax', {pid: scope.fCategory})
            .success(function (msg) {
              if (msg.errmsg.data && msg.errmsg.data.length > 0) {
                scope.sCategorySelect = [{
                  id: '',
                  name: '全部二级分类'
                }].concat(msg.errmsg.data);
                scope.tCategorySelect = [{
                  'id': '',
                  'name': '全部三级分类'
                }];
              } else {
                scope.sCategorySelect = scope.tCategorySelect = [{
                  'id': '',
                  'name': '暂无下级分类'
                }];
              }
              scope.sCategory = scope.tCategory = '';
            }
          );
        };

        //查询三级
        scope.getThree = function () {
          $http.post('/product/category-list-ajax', {pid: scope.sCategory})
            .success(function (msg) {
              if (msg.errmsg.data && msg.errmsg.data.length > 0) {
                scope.tCategorySelect = [{
                  id: '',
                  name: '全部三级分类'
                }].concat(msg.errmsg.data);
              } else {
                scope.tCategorySelect = [{
                  'id': '',
                  'name': '暂无下级分类'
                }];
              }
              scope.tCategory = '';
            }
          );
        };

        scope.selectedGoods = [];

        //拖拽配置
        scope.sortOptions = {
          animation: 150,
          draggable: '.goods-item',
          onSort: function () {
            scope.module.goodsList = angular.copy(scope.selectedGoods);
          }
        };

        function findIndex(list, item, key) {
          var index = -1;
          for (var i in list) {
            if (list[i][key] === item[key]) {
              index = i;
            }
          }
          return index;
        }

        element.on('$destroy', function () {
          scope.$$listeners = [];
        });

        scope.showGoodsList = function () {
          tempList = angular.copy(scope.selectedGoods);
          $('#goodsListPanel').modal('show');
          scope.query(1);
        };

        scope.isOk = function () {
          scope.module.isInit = tempList.length === 0;
          scope.selectedGoods = angular.copy(tempList);
          scope.module.goodsList = angular.copy(tempList);
          tempList = [];
          $('#goodsListPanel').modal('hide');
        };

        scope.delGoods = function (index) {
          scope.selectedGoods.splice(index, 1);
          scope.module.goodsList.splice(index, 1);
        };

        if (!scope.module.isInit) {
          scope.selectedGoods = angular.copy(scope.module.goodsList);
        }

        //查询
        scope.query = function (page) {
          var categoryId = scope.sCategory ? scope.sCategory : scope.fCategory;
          categoryId = scope.tCategory ? scope.tCategory : categoryId;
          $http.post(wsh.url.substring(0, wsh.url.indexOf('com') + 4) + 'product/list-ajax', {
            _page: page,
            _page_size: 10,
            status: 1,
            product_category_id: categoryId,
            name: scope.goodsName
          })
            .success(function (msg) {
              wsh.successback(msg, '', false, function () {
                angular.forEach(msg.errmsg.data, function (goods) {
                  goods.isSelected = findIndex(tempList, goods, 'id') >= 0;
                });
                scope.goodsList = msg.errmsg.data;
                scope.page = msg.errmsg.page;
              });
            });
        };

        scope.selectGoods = function (goods) {
          goods.isSelected = !goods.isSelected;
          var index = findIndex(tempList, goods, 'id');
          if (goods.isSelected && index < 0) {
            tempList.push(goods);
          } else if (!goods.isSelected && index >= 0) {
            tempList.splice(index, 1);
          }
        };

        scope.options = {callback: scope.query};

        var ele = angular.element(document.getElementById('pageListPager'));
        ele.html('<div ng-paginate options="options" page="page"></div>');
        $compile(ele.contents())(scope);
      }
    }
  }

  goodsModuleEdit.$inject = ['$http', '$compile'];

  //商品搜索模块
  function searchModuleEdit() {

    return {
      restrict: 'E',
      template: '<div class="padding10 clearfix">可随意插入任何页面和位置，方便粉丝快速搜索商品.</div>',
      scope: {
        module: '=moduleData'
      },
      link: function (scope) {
        scope.module.isInit = false;
      }
    }
  }

  //进入店铺模块
  function homeModuleEdit() {

    return {
      restrict: 'E',
      template: '<div class="padding10 clearfix">进入店铺</div>',
      scope: {
        module: '=moduleData'
      },
      link: function (scope) {
        scope.module.isInit = false;
      }
    }
  }

  //公告设置模块
  function noticeModuleEdit() {

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      templateUrl: '/ace/js/page/directives/templates/noticeEditTmpl.html',
      link: function (scope, element) {
        scope.$watch('contentText', function (newV, oldV) {
          if (newV !== oldV) {
            scope.module.isInit = false;
            scope.module.content = newV;
          }
        });
        if (!scope.module.isInit) {
          scope.contentText = scope.module.content;
        } else {
          scope.contentText = '';
        }
        element.on('$destroy', function () {
          scope.$$listeners = [];
        });
        scope.checkText = function () {
          scope.textValid = wsh.getLength(scope.contentText) <= 128;
        };
        scope.textValid = wsh.getLength(scope.contentText) <= 128;
      }
    }
  }

  //辅助空白模板模块
  function blankModuleEdit() {

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      templateUrl: '/ace/js/page/directives/templates/blankEditTmpl.html',
      compile: function () {
        var a = document.getElementById('sliderInput')
        noUiSlider.create(a, {
          start: 10,
          connect: 'lower',
          step: 1,
          range: {
            max: 70,
            min: 10
          }
        });
        return function (scope) {
          a.noUiSlider.on('change', function (value) {
            scope.$apply(function () {
              scope.module.blankHight = scope.blankHight = parseInt(value[0]);
              scope.module.isInit = false;
            });
          });
          scope.blankHight = scope.module.blankHight;
          a.noUiSlider.set(scope.module.blankHight);
        }
      }
    }
  }

  //辅助线模块
  function lineModuleEdit() {

    return {
      restrict: 'E',
      template: '<div class="padding10 clearfix">辅助线</div>',
      scope: {
        module: '=moduleData'
      },
      link: function (scope) {
        scope.module.isInit = false;
      }
    }
  }

  //图片导航模块
  function imageNavModuleEdit() {

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      templateUrl: '/ace/js/page/directives/templates/imageNavEditTmpl.html',
      compile: function () {
        var colorpicker = $("#color").colorpicker({
          customClass: 'colorpicker-2x', sliders: {
            saturation: {
              maxLeft: 200,
              maxTop: 200
            },
            hue: {
              maxTop: 200
            },
            alpha: {
              maxTop: 200
            }
          }
        });
        return function (scope, element) {
          colorpicker.on('changeColor', function (event) {
            scope.$apply(function () {
              scope.module.color = event.color.toHex();
            });
          });
          var imageIndex = -1;

          scope.showImageList = function (index) {
            imageIndex = index;
            $('#myModalImage').modal('show');
          };

          function check() {
            scope.module.editLength = scope.module.imageList.filter(function (obj) {
              if (obj.file_cdn_path) {
                return obj;
              }
            }).length;
          };

          check();

          scope.delImage = function (index) {
            scope.module.imageList[index] = {};
            scope.check();
          };

          element.on('$destroy', function () {
            scope.$$listeners = [];
          });

          scope.checkText = function (obj) {
            obj.textValid = wsh.getLength(obj.text) <= 10;
          };

          angular.forEach(scope.module.imageList, function (obj) {
            scope.checkText(obj);
          });

          //选择图片
          scope.$on('ImageChoose', function (e, imageList) {
            if (scope.module.isEdit === true) {
              scope.module.imageList[imageIndex].file_cdn_path = imageList[0].file_cdn_path;
              scope.module.isInit = false;
              check();
            }
          });

          //上传图片
          scope.$on('ImageListChange', function (e, json) {
          });
        }
      }
    }
  }

  //文本导航模块
  function textNavModuleEdit() {

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      templateUrl: '/ace/js/page/directives/templates/textNavEditTmpl.html',
      link: function (scope) {
        scope.addNav = function (index, event) {
          event.preventDefault();
          event.stopPropagation();
          scope.module.isInit = false;
          if (index !== undefined) {
            scope.module.navList.splice(index + 1, 0, {});
          } else {
            scope.module.navList.push({});
          }
        };
        scope.delNav = function (index, event) {
          event.preventDefault();
          event.stopPropagation();
          scope.module.navList.splice(index, 1);
        };
        scope.checkText = function (obj) {
          obj.textValid = wsh.getLength(obj.text) <= 60;
        };
        angular.forEach(scope.module.navList, function (obj) {
          scope.checkText(obj);
        });
      }
    }
  }

  //图片广告设置模块
  function imageAdsModuleEdit() {

    return {
      restrict: 'E',
      scope: {
        module: '=moduleData'
      },
      templateUrl: '/ace/js/page/directives/templates/imageAdsEditTmpl.html',
      link: function (scope, element) {

        var idx = -1;
        var optType = 'add';

        scope.delAds = function (index, event) {
          event.preventDefault();
          event.stopPropagation();
          scope.module.adsList.splice(index, 1);
        };

        scope.appendAds = function (index, event) {
          event.preventDefault();
          event.stopPropagation();
          idx = index;
          optType = 'append';
          $('#myModalImage').modal('show');
        };

        scope.checkText = function (obj) {
          obj.textValid = wsh.getLength(obj.text) <= 60;
        };

        angular.forEach(scope.module.adsList, function (obj) {
          scope.checkText(obj);
        });

        scope.changeAds = function (index, event) {
          event.preventDefault();
          event.stopPropagation();
          idx = index;
          optType = 'change';
          $('#myModalImage').modal('show');
        };

        scope.addAds = function () {
          idx = -1;
          optType = 'add';
          $('#myModalImage').modal('show');
        };

        //选择图片
        scope.$on('ImageChoose', function (e, imageList) {
          if (scope.module.isEdit === true) {
            if (optType === 'change') {
              scope.module.adsList[idx].file_cdn_path = imageList[0].file_cdn_path;
            } else if (optType === 'add') {
              scope.module.adsList.push({file_cdn_path: imageList[0].file_cdn_path});
            } else if (optType === 'append') {
              scope.module.adsList.splice(idx + 1, 0, {file_cdn_path: imageList[0].file_cdn_path});
            }
            scope.module.isInit = false;
          }
        });

        element.on('$destroy', function () {
          scope.$$listeners = [];
        });

        //上传图片
        scope.$on('ImageListChange', function (e, json) {
        });
      }
    }
  }

  imageAdsModuleEdit.$inject = ['$http', '$compile'];

  function pageLink($http, $compile) {
    return {
      restrict: 'E',
      scope: {
        link: '='
      },
      templateUrl: '/ace/js/page/directives/templates/pageLinkTmpl.html',
      link: function (scope, element) {

        scope.linkList = [
          {id: 1, name: '微商城首页', url: '/mall/index'},
          {id: 2, name: '微商城商品列表', url: '/product/category'},
          {id: 3, name: '微商城惊喜', url: '/surprise/index'},
          {id: 4, name: '微商城购物车', url: '/cart/index'},
          {id: 5, name: '微商城个人中心', url: '/user/home'},
          {id: 6, name: '微推广', url: '/fx/apply'},
          {id: 7, name: '微官网', url: '/mall/home'},
          {id: 10, name: '会员卡', url: '/member/member-card'},
          {id: 8, name: '自定义页面', url: ''},
          {id: 9, name: '外链接', url: ''}
        ];

        scope.page = {};

        //查询页面列表
        function query(currentPage) {
          $http.post(wsh.url + 'list-ajax', {
            _page: currentPage,
            _page_size: 10
          }).success(function (msg) {
            wsh.successback(msg, '', false, function () {
              scope.pageList = msg.errmsg.data;
              scope.page = msg.errmsg.page;
            });
          });
        };

        scope.linkHref = (scope.link && /^[A-Za-z][A-Za-z\d.+-]*:\/*(?:\w+(?::\w+)?@)?[^\s/]+(?::\d+)?(?:\/[\w#!:.?+=&%@\-/[\]$'()*,;~]*)?$/.test(scope.linkHref)) ? scope.link.url : '';

        scope.showLinkForm = false;

        scope.options = {page: 'page', callback: query};

        scope.selectedLink = function (l) {
          switch (l.id) {
            case 8:
              $(element[0]).find('.modal').modal('show');
              query(1);
              scope.linkHref = '';
              break;
            case 9:
              scope.showLinkForm = true;
              break;
            default :
              scope.link = l;
              scope.linkHref = '';
              break;
          }
        };

        var templink = '';
        scope.ok = function (event) {
          event.preventDefault();
          event.stopPropagation();
          if (/^[A-Za-z][A-Za-z\d.+-]*:\/*(?:\w+(?::\w+)?@)?[^\s/]+(?::\d+)?(?:\/[\w#!:.?+=&%@\-/[\]$'()*,;~]*)?$/.test(scope.linkHref)) {
            scope.link = {
              url: scope.linkHref,
              name: '外链接',
              isOut: true
            }
            templink = scope.linkHref;
            scope.linkError = false;
            scope.showLinkForm = false;
          } else {
            scope.linkError = true;
          }
        };

        scope.cancel = function (event) {
          event.preventDefault();
          event.stopPropagation();
          scope.linkHref = templink;
          scope.linkError = false;
          scope.showLinkForm = false;
        };

        scope.del = function (event) {
          event.preventDefault();
          event.stopPropagation();
          scope.link = null;
        };

        scope.selectedPage = function (page) {
          scope.link = {
            name: page.title,
            url: '/cppage/detail?id=' + page.id
          };
          $(element[0]).find('.modal').modal('hide');
        };

        element.on('$destroy', function () {
          scope.$$listeners = [];
        });

        var ele = $(element[0]).find('.pageListPager');
        ele.html('<div ng-paginate options="options" page="page"></div>');
        $compile(ele.contents())(scope);
      }
    }
  }

  pageLink.$inject = ['$http', '$compile'];
})();