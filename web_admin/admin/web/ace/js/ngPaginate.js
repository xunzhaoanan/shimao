app.directive('ngPaginate', function ($timeout, $rootScope) {
  return {
    restrict: 'A',
    template: '<div class="text-center relative_js" style="height: 36px;" ng-show="options.self.total_page > 1" >' +
    '<div class="jPaginate" style="margin: 0 auto; position: relative;" ng-style="options.width">' +
    '<div class="jPag-control-back">' +
    '<a class="jPag-first" ng-mouseover="options.firstHover = true" ng-mouseout="options.firstHover = false" ng-style="options.firstHover && options.hover_style || options.style" ' +
    'ng-bind="options.first" ng-click="options.normal(1)"></a>' +
    '<span class="jPag-sprevious" style="color: rgb(34, 131, 197);" ' +
    'ng-mouseover="options.over(1)" ng-mouseout="options.out(1)" ng-mousedown="options.down(1)" ng-mouseup="options.up(1)">«</span>' +
    '</div>' +
    '<div id="scorll" style="overflow: hidden; height: 34px; float: left; position: relative;" ng-style="options.divWidth">' +
    '<ul class="jPag-pages" style="height: 34px;" ng-style="options.ulWidth">' +
    '<li ng-repeat="list in options.pages track by $index" style="width: 42.5px">' +
    '<span ng-if="options.self.current_page == $index" class="jPag-current" ' +
    'ng-style="options.hover_style" ng-bind="$index + 1">1</span>' +
    '<a ng-mouseover="list.isHover = true" ng-mouseout="list.isHover = false" ' +
    'ng-if="options.self.current_page != $index" ' +
    'ng-style="list.isHover && options.hover_style || options.style" ng-click="options.goPage($index)"' +
    'ng-bind="$index + 1">2</a>' +
    '</li>' +
    '</ul>' +
    '</div>' +
    '<div class="jPag-control-front">' +
    '<span class="jPag-snext" style="color: rgb(34, 131, 197);" ' +
    'ng-mouseover="options.over(2)" ng-mouseout="options.out(2)" ng-mousedown="options.down(2)" ng-mouseup="options.up(2)">»</span>' +
    '<a class="jPag-last" ' +
    'ng-mouseover="options.lastHover = true" ng-mouseout="options.lastHover = false"' +
    'ng-style="options.lastHover && options.hover_style || options.style" ' +
    'ng-bind="options.last" ng-click="options.normal(2)">末页</a>' +
    '</div>' +
    '<input ng-if="options.search" ng-model="options.input_text" type="text" style="width: 40px; height: 31px; float: left; margin-top: 3px; border: 1px solid rgb(34, 131, 197);" ng-keypress="go($event)">' +
    '<button ng-if="options.search" ng-click="options.goSearch()" style="min-width: 90px; height: 31px; float: left; margin-top: 3px; color: rgb(255, 255, 255); background: rgb(34, 131, 197);" ng-bind="options.button_text"></button>' +
    '<div style="display: inline-block; line-height: 36px; font-size: 12px;">共{{page.total_count}}条</div>' +
    '</div>' +
    '</div>',
    replace: true,
    scope: {
      options: '=options',
      page: '=page'
    },
    link: function (scope, elem) {

      var w, length, divWidth, ulWidth, timer = null, min = 1, max = 3;
      var defaults = {
        display: 6,
        isSearch: true,
        border: true,
        border_color: '#fff',
        text_color: '#fff',
        background_color: '#2283c5',
        border_hover_color: '#ccc',
        text_hover_color: '#000',
        background_hover_color: '#fff',
        mouse: 'press',
        page: 'page'
      };

      scope.options = $.extend(defaults, scope.options);

      scope.options.style = {
        color: scope.options.text_color,
        background_color: scope.options.background_color,
        border: '1px solid' + scope.options.border_color
      };
      scope.options.hover_style = {
        color: scope.options.text_hover_color,
        background_color: scope.options.background_hover_color,
        border: '1px solid' + scope.options.border_hover_color
      };
      scope.go = function (event) {
        //当键入回车 阻止默认事件、事件传播 并调用查询方法
        if (event.keyCode === 13 || event.charCode === 13) {
          event.stopPropagation();
          event.preventDefault();
          scope.options.goSearch();
        }
      };
      if (scope.options.isRoot) {
        $rootScope[scope.options.page] = $rootScope[scope.options.page] || {};
      } else {
        scope[scope.options.page] = scope[scope.options.page] || {};
      }
      scope.options.pages = [];
      scope.options.first = '首页';
      scope.options.last = '末页';
      var page = scope.options.isRoot ? '$root.' + scope.options.page : scope.options.page;
      scope.$watch(page, function (a) {
        if (a.current_page !== undefined) {
          scope.options.self = a;
          if (a.total_page > 1) {
            scope.options.pages = [];
            for (var i = 0; i < a.total_page; i++) {
              scope.options.pages.push({});
            }
            length = scope.options.pages.length > scope.options.display && scope.options.display || scope.options.pages.length;
            divWidth = length * 42.5 + 2;

            ulWidth = scope.options.pages.length * 42.5 + 2;
            scope.options.divWidth = {'width': divWidth + 'px'};
            scope.options.ulWidth = {'width': ulWidth + 'px'};
            scope.options.button_text = '共' + scope.options.pages.length + '页/搜索';
            w = 70 * 2 + length * 42.5 + 2 + 94;
            if (scope.options.pages.length > scope.options.display && scope.options.isSearch) {
              scope.options.search = true;
              w += 130;
            } else {
              scope.options.search = false;
            }
            scope.options.width = {'width': w + 'px'};
          }
          if (a.current_page === 0) {
            $('#scorll').scrollLeft(0);
          }
        }
      });

      scope.options.goPage = function (index) {
        if (scope.options.self.current_page == index) return;
        if (scope.options.search) {
          var left = ($(elem).find('li')[index].offsetLeft) / 2;
          var tmp = left - (70 / 2);
          $(elem).find('#scorll').animate({scrollLeft: left + tmp - 110 + 'px'});
        }
        if (typeof scope.options.callback == 'function') {
          scope.options.callback.call(this, index + 1);
        }
      };

      scope.options.normal = function (string) {
        var int = string == 1 ? 0 : scope.options.pages.length - 1;
        scope.options.goPage(int)
      };

      scope.options.goSearch = function () {
        if (/^\d+$/.test(scope.options.input_text)) {
          var goPage = parseInt(scope.options.input_text) - 1;
          if (goPage === scope.options.self.current_page) {
            //alert('无法跳转至当前页');
            scope.options.input_text = '';
          } else if (goPage < 0 || goPage > scope.page.total_page - 1) {
            alert('无法跳转至目标页');
            scope.options.input_text = '';
          } else {
            scope.options.goPage(goPage);
          }
        } else {
          scope.options.input_text = '';
        }
      };

      scope.options.over = function (int) {
        var left = $(elem).find('#scorll').scrollLeft()
        if (int == 1) {
          if (left && scope.options.search) {
            clearInterval(timer);
            timer = setInterval(function () {
              var l = $(elem).find('#scorll').scrollLeft();
              l -= min;
              $(elem).find('#scorll').scrollLeft(l)
              if (!l) clearInterval(timer);
            }, 20);
          }
        } else {
          if (left < ulWidth - divWidth) {
            clearInterval(timer);
            timer = setInterval(function () {
              var l = $(elem).find('#scorll').scrollLeft();
              l += min;
              $(elem).find('#scorll').scrollLeft(l)
              if (l >= scope.options.ulWidth - scope.options.divWidth) clearInterval(timer);
            }, 20);
          }
        }
      };

      scope.options.out = function () {
        clearInterval(timer);
      };

      scope.options.down = function (int) {
        var left = $(elem).find('#scorll').scrollLeft()
        if (int == 1) {
          if (left && scope.options.search) {
            clearInterval(timer);
            timer = setInterval(function () {
              var l = $(elem).find('#scorll').scrollLeft();
              l -= max;
              $(elem).find('#scorll').scrollLeft(l)
              if (!l) clearInterval(timer);
            }, 20);
          }
        } else {
          if (left < ulWidth - divWidth && scope.options.search) {
            clearInterval(timer);
            timer = setInterval(function () {
              var l = $(elem).find('#scorll').scrollLeft();
              l += max;
              $(elem).find('#scorll').scrollLeft(l)
              if (l >= scope.options.ulWidth - scope.options.divWidth) clearInterval(timer);
            }, 20);
          }
        }
      };

      scope.options.up = function () {
        clearInterval(timer);
      };
    }
  };
});