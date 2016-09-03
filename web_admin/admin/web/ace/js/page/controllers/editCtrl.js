/**
 * author 陈吉
 */
;
(function () {
  'use strict';

  app.requires.push('ngTouch');
  app.requires.push('angular-carousel');
  app.requires.push('ng-sortable');

  app.controller('editCtrl', editCtrl);

  function editCtrl($scope, $timeout, $rootScope, $http, pageEditServ) {

    $scope.clickVal = 4;
    var doc = $('body');
    //拖拽配置
    $scope.options = {
      animation: 150,
      draggable: '.app-module'
    };

    //选中二级菜单
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ca')
    }, 100);

    var i = -1;
    var delIndex = 0;
    var id = wsh.getHref('id');

    $scope.$on('addPageModule', function (event, param) {
      angular.forEach($scope.page.items, function (obj) {
        obj.isEdit = false;
      });
      var module = {type: param[0], isInit: true, isEdit: true};
      if (module.type === 'home') {
        module.shopInfo = pageEditServ.shopInfo;
      }
      if (param.length <= 1) {
        $scope.page.items.push(module);
      } else {
        $scope.page.items.splice(param[1] + 1, 0, module);
      }
    });

    $scope.$on('moduleBuildSuccess', function (obj, param) {
      if (i === -1) {
        $scope.module = $scope.page.items[$scope.page.items.length - 1];
      } else {
        $scope.module = $scope.page.items[i + 1];
      }
      $scope.module.offsetTop = {'margin-top': 70 + param[0] + 'px'};
      i = -1;
      $scope.closeDelPanel();
      doc.animate({scrollTop: param[0] + 'px'}, 500);
    });

    //选中标题
    $scope.selectedHead = function (event, validation) {
      $scope.module = $scope.page;
      $scope.module.type = 'title';
      $scope.module.validation = validation;
      $scope.module.offsetTop = {'margin-top': 70 + (event ? event.currentTarget.offsetTop : 0) + 'px'};
      angular.forEach($scope.page.items, function (obj) {
        obj.isEdit = false;
      });
      doc.animate({scrollTop: $('.app-body').offset().top - 186 + 'px'}, 500);
    };

    function filterGoods(page) {
      var params = angular.copy(page);
      angular.forEach(params.items, function (obj) {
        if (obj.type === 'goods') {
          var goodsList = [];
          angular.forEach(obj.goodsList, function (goods) {
            goodsList.push({id: goods.id});
          });
          obj.goodsList = goodsList;
        }
      });
      return params;
    }

    //预览
    $scope.preview = function (event) {
      if (validation()) {
        event.target.disabled = true;
        $http.post(wsh.url + 'edit-ajax', filterGoods($scope.page))
          .success(function (msg) {
            wsh.successback(msg, '', false, function (data) {
              var newTab = window.open('about:blank');
              $.ajax({
                success: function () {
                  event.target.disabled = false;
                  newTab.location.href = wsh.url + 'preview?id=' + data.errmsg.id;
                }
              });
            }, function () {
              event.target.disabled = false;
            });
          });
      }
    };

    //保存
    $scope.save = function (event) {
      if (validation()) {
        event.target.disabled = true;
        $http.post(wsh.url + 'edit-ajax', filterGoods($scope.page))
          .success(function (msg) {
            wsh.successback(msg, '保存成功！');
            event.target.disabled = false;
          });
      }
    };

    //发布
    $scope.release = function (event) {
      if (validation()) {
        event.target.disabled = true;
        $http.post(wsh.url + 'edit-ajax', filterGoods($scope.page))
          .success(function (msg) {
            wsh.successback(msg, '', false, function (data) {
              //修改时点击发布后调用开启发布状态。
              $http.post("open-ajax", {'id': data.errmsg.id})
                .success(function (msg) {
                  wsh.successback(msg, '发布成功！', false, function () {
                    location.href = './list';
                  }, function () {
                    event.target.disabled = false;
                  });
                });
            }, function () {
              event.target.disabled = false;
            });
          });
      }
    };

    $scope.page = pageEditServ.page;
    angular.forEach($scope.page.items, function (obj) {
      if (obj.type === 'home') {
        obj.shopInfo = pageEditServ.shopInfo;
      }
    });
    $scope.selectedHead();

    $scope.closeDelPanel = function () {
      angular.forEach($scope.page.items, function (obj) {
        obj.showDelPanel = false;
      });
    };

    //选中子模块
    $scope.selectedModule = function (index, event) {
      event.preventDefault();
      event.stopPropagation();
      $scope.module = $scope.page.items[index];
      $scope.module.offsetTop = {'margin-top': 70 + event.currentTarget.offsetTop + 'px'};
      angular.forEach($scope.page.items, function (obj, idx) {
        obj.isEdit = idx === index;
      });
      doc.animate({scrollTop: $('.app-module').eq(index).offset().top - 186 + 'px'}, 500);
    };

    $scope.edit = function (index, event) {
      event.preventDefault();
      event.stopPropagation();
      $scope.closeDelPanel();
      var a = $('.app-module')[index];
      $scope.module = $scope.page.items[index];
      $scope.module.offsetTop = {'margin-top': 70 + a.offsetTop + 'px'};
      angular.forEach($scope.page.items, function (obj, idx) {
        obj.isEdit = idx === index;
      });
      doc.animate({scrollTop: $('.app-module').eq(index).offset().top - 186 + 'px'}, 500);
    };

    $scope.add = function (index, event) {
      event.preventDefault();
      event.stopPropagation();
      $scope.closeDelPanel();
      i = index;
      $scope.module = {type: 'add', index: index};
      $scope.module.offsetTop = {'margin-top': 70 + $('.app-module')[index].offsetTop + 'px'};
      doc.animate({scrollTop: $('.app-module').eq(index).offset().top - 186 + 'px'}, 500);
    };

    $scope.del = function (index, event) {
      event.preventDefault();
      event.stopPropagation();
      $scope.closeDelPanel();
      angular.forEach($scope.page.items, function (obj) {
        obj.isEdit = false;
      });
      $scope.page.items[index].isEdit = true;
      delIndex = index;
      $scope.page.items[index].showDelPanel = true;
    };

    $scope.ok = function (event) {
      event.preventDefault();
      event.stopPropagation();
      $scope.page.items[delIndex].showDelPanel = false;
      angular.forEach($scope.page.items, function (obj) {
        obj.isEdit = false;
      });
      if (delIndex >= 1) {
        var a = $('.app-module')[delIndex - 1];
        var module = $scope.page.items[delIndex - 1];
        module.offsetTop = {'margin-top': 70 + a.offsetTop + 'px'};
        $scope.module = module;
        $scope.module.isEdit = true;
        doc.animate({scrollTop: $('.app-module').eq(delIndex - 1).offset().top - 186 + 'px'}, 500);
      } else {
        $scope.selectedHead();
      }
      $scope.page.items.splice(delIndex, 1);
    };

    $scope.cancel = function (event) {
      event.preventDefault();
      event.stopPropagation();
      $scope.page.items[delIndex].showDelPanel = false;
    };

    function validationModule(index) {
      var temp = $('.app-module').eq(index);
      $scope.module = $scope.page.items[index];
      $scope.module.validation = true;
      $scope.module.offsetTop = {'margin-top': 70 + temp[0].offsetTop + 'px'};
      angular.forEach($scope.page.items, function (obj, idx) {
        obj.isEdit = idx === index;
      });
      doc.animate({scrollTop: temp.offset().top - 186 + 'px'}, 500);
    }

    //验证
    function validation() {
      //校验页面信息
      var sort = parseInt($scope.page.sort);
      if (!$scope.page.title || !$scope.page.title.trim() || wsh.getLength($scope.page.title) > 60 || !$scope.page.cp_category_id || sort !== $scope.page.sort || sort < 1 || sort > 999) {
        $scope.selectedHead(undefined, true);
        return false;
      }
      //检验模块个数
      if ($scope.page.items.length < 1) {
        $scope.selectedHead(undefined, true);
        alert('请至少添加一个模块');
        return false;
      }
      var result = true;
      //校验模块
      $.each($scope.page.items, function (index, obj) {
        switch (obj.type) {
          case 'goods':
            var i = 0;
            angular.forEach(obj.goodsList, function (good) {
              if (good.id) ++i;
            });
            if (i === 0) {
              alert('商品模块为空，请选择商品');
              validationModule(index);
              result = false;
              return false;
            }
            break;
          case 'image-ads':
            var i = 0;
            if (obj.adsList.length === 0) {
              alert('请至少添加一个图片广告');
              ++i;
            }
            angular.forEach(obj.adsList, function (ads) {
              if (wsh.getLength(ads.text) > 60 || !ads.link) {
                ++i;
              }
            });
            if (i > 0) {
              validationModule(index);
              result = false;
              return false;
            }
            break;
          case 'text-nav':
            var i = 0;
            if (obj.navList.length === 0) {
              alert('请至少添加一个文本导航');
              ++i;
            }
            angular.forEach(obj.navList, function (nav) {
              if (!nav.text || wsh.getLength(nav.text) > 60 || !nav.link) {
                ++i;
              }
            });
            if (i > 0) {
              validationModule(index);
              result = false;
              return false;
            }
            break;
          case 'image-nav':
            var i = 0;
            angular.forEach(obj.imageList, function (image) {
              if (!image.file_cdn_path || wsh.getLength(image.text) > 10 || !image.link) {
                ++i;
              }
            });
            if (i > 0) {
              validationModule(index);
              result = false;
              return false;
            }
            break;
          case 'notice':
            if (!obj.content || wsh.getLength(obj.content) > 128 || obj.isInit) {
              validationModule(index);
              result = false;
              return false;
            }
            break;
          case 'richtext':
            if (obj.isInit) {
              validationModule(index);
              result = false;
              return false;
            }
            break;
        }
      });
      return result;
    }
  }

  editCtrl.$inject = ['$scope', '$timeout', '$rootScope', '$http', 'pageEditServ'];
})();