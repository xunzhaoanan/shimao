/**
 * author 陈吉
 */
;
(function () {
  'use strict';

  app.controller('listCtrl', listCtrl);

  function listCtrl($scope, $timeout, $rootScope, $http) {

    $scope.pageId = 1;
    $scope.home = null;//主页
    $scope.website = null;//官网

    //选中二级菜单
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ca')
    }, 100);

    //初始化页面分类下拉框
    $http.post(wsh.url + 'category-list-ajax', {_page: 1, _page_size: 1000})
      .success(function (msg) {
        wsh.successback(msg, '', false, function () {
          $scope.categoryList = msg.errmsg.data;
        });
      });

    //初始化页面主页
    function getHome() {
      $http.post(wsh.url + 'list-ajax', {is_shop: 1})
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.home = msg.errmsg.data[0];
          });
        });
    }

    //初始化页面官网
    function getWebsite() {
      $http.post(wsh.url + 'list-ajax', {is_website: 1})
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.website = msg.errmsg.data[0];
          });
        });
    }

    var text = '';
    var lesectVal = undefined;

    $scope.search = function () {
      text = $("#title").val() ? $("#title").val().trim() : '';
      lesectVal = $scope.cp_category_id ? $scope.cp_category_id : undefined;
      $scope.query(1);
    };

    //查询页面列表
    $scope.query = function (currentPage) {
      $("#title").val(text);
      $http.post(wsh.url + 'list-ajax', {
        cp_category_id: lesectVal,
        title: text,
        _page: currentPage,
        _page_size: 20
      }).success(function (msg) {
        wsh.successback(msg, '', false, function () {
          $scope.pageList = msg.errmsg.data;
          $scope.page = msg.errmsg.page;
        });
      });
    };

    $scope.options = {callback: $scope.query};

    $scope.query(1);
    getHome();
    getWebsite();

    //发布
    $scope.status = function (status, id) {
      if (status == 1) {
        $http.post("open-ajax", {'id': id})
          .success(function (msg) {
            wsh.successback(msg, '发布成功', false, function () {

            });
          })
      } else {
        $http.post("close-ajax", {'id': id})
          .success(function (msg) {
            wsh.successback(msg, '禁用成功', false, function () {

            });
          })
      }
    };

    //删除
    $scope.delete = function (id) {
      wsh.setDialog('删除提示', '是否要删除该页面，删除后不可恢复', "del-ajax", {'id': id}, function () {
        $scope.query();
      }, '删除成功');
    };

    //选中页面
    $scope.checkedPage = function (index) {
      angular.forEach($scope.pageList, function (obj, idx) {
        obj.checked = index === idx;
      });
    };

    //设置主页
    $scope.setHome = function () {
      var selectedPage = $scope.pageList.filter(function (obj) {
        if (obj.checked) {
          return obj;
        }
      })[0];
      if (!selectedPage) {
        alert('未关联页面，请选择一个页面为店铺主页');
        return false;
      }
      $http.post(wsh.url + 'setmall-ajax', {
        id: selectedPage.id
      }).success(function (msg) {
        wsh.successback(msg, '设置成功', false, function () {
          getHome();
        });
      });
    };

    //设置官网
    $scope.setWebsite = function () {
      var selectedPage = $scope.pageList.filter(function (obj) {
        if (obj.checked) {
          return obj;
        }
      })[0];
      if (!selectedPage) {
        alert('未关联页面，请选择一个页面为官网主页');
        return false;
      }
      $http.post(wsh.url + 'sethome-ajax', {
        id: selectedPage.id
      }).success(function (msg) {
        wsh.successback(msg, '设置成功', false, function () {
          getWebsite();
        });
      });
    };

    //复制
    $scope.copy = function (id) {
      $http.post(wsh.url + 'copy-ajax', {
        id: id
      }).success(function (msg) {
        wsh.successback(msg, '复制成功', false, function () {
          $scope.query();
        });
      });
    };

    //编辑
    $scope.edit = function (id) {
      location.href = './edit?id=' + id;
    };

    //扫码
    $scope.scanCode = function (id) {
      $scope.pageId = id;
      $('#query').modal('show');
    };

    //新增页面防止模态框点击其它地方消失。
    $scope.addPage=function(){
      $('#NewMode').modal({backdrop: 'static', keyboard: true});//阻止模态框点击其它地方关闭
    };
  }

  listCtrl.$inject = ['$scope', '$timeout', '$rootScope', '$http'];
})();