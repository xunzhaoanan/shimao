/*
   使用方法：
  <div choose-image options="options" fn="fn"></div>
  @options --> {btnId : 'XXX',isuploadOne : true}
  @btnId --> 选择图片的按钮id
  @isuploadOne --> 是否只能上传一张图片
  @fn --> $scope.fn(array) 传入回调函数用于接收及处理图片数组，需在使用指令的页面定义并实现内部逻辑
  引用声明：
  需在页面上引用如下文件以及当前指令js：
 <link href="/ace/uploadify/uploadify.css" rel="stylesheet"/>
 <script src="/ace/uploadify/jquery.uploadify.min.js"></script>
 */

app.directive('chooseImage', function ($rootScope, $timeout, $http, $parse) {
  return {
    restrict: 'A',
    template: '<div class="bootbox modal fade in" id="myModalImage" tabindex="-1" role="dialog" open-close-modal ' +
    'aria-labelledby="myModalLabel" open-close-modal aria-hidden="true" style="z-index: 1700 !important;">' +
    '<div class="modal-dialog modal-dialog2" style="z-index: 1600 !important;">' +
    '<div class="modal-content" id="imagewidth">' +
    '<div class="modal-header modal-header2">' +
    '<a class="bootbox-close-button close" data-dismiss="modal">×</a>' +
    '<h4 class="modal-title">图片管理器</h4>' +
    '</div>' +
    '<div class="modal-body">' +
    '<div class="bootbox-body">' +
    '<div class="tabbable">' +
    '<div class="tab-pane in active">' +
    '<ul class="nav nav-tabs" id="myTab">' +
    '<li ng-class="{true: \'active\'}[imageIndex == 0]" ng-if="$root.hasPermission(document/create-ajax)" ' +
    'ng-hide="clickVal==3" ng-click="imageClick(0)"><a>上传本地图片</a>' +
    '</li>' +
    '<li ng-class="{true: \'active\'}[imageIndex == 2]"' +
    'ng-if="$root.hasPermission(document/image-ajax)" ng-click="imageClick(2)"><a>从图库选择</a>' +
    '</li>' +
    '<li ng-class="{true: \'active\'}[imageIndex == 3]" ng-click="imageClick(3)" ng-show="clickVal===4">' +
    '<a>内置图标</a>' +
    '</li>' +
    '</ul>' +
    '</div>' +
    '<div class="tab-content">' +
    '<div id="bdimg" class="tab-pane active" style="min-height: 200px; display:block;" ng-show="imageIndex == 0">' +
    '<form class="form-horizontal" name="myform" novalidate="novalidate">' +
    '<div class="slim-scroll">' +
    '<div class="position-relative margin-bottom10 clearfix">' +
    '<span class="inline margin-right10">选择上传分组</span> ' +
    '<select name="" id="" class="width160" ng-model="groupId" ng-change="groupChange(groupId)">' +
    '<option value="">全部分组</option>' +
    '<option value="0">默认分组</option>' +
    '<option value="{{i.id}}" ng-repeat="i in groupOptions">{{i.name}}</option>' +
    '</select>' +
    '</div>' +
    '<div class="position-relative clearfix">' +
    '<span class="margin-right10 align-top">可选择多张图片批量上传</span> ' +
    '<span class="inline align-top "> <a class="btn btn-sm btn-info ">选择图片</a> </span> ' +
    '<span class="inline align-top margin-top3">(只支持上传大小不超过300KB且文件格式为jpg,png,gif的图片)</span>' +
    '<div id="chooseImage" class="position-absolute"></div>' +
    '</div>' +
    '<div class="width100 margin-top10 margin-bottom10 clearfix">' +
    '<ul class="ace-thumbnails padding5 clearfix">' +
    '<li class="img-thumbnail position-relative margin2"' +
    'ng-repeat="list in imgLists"' +
    'ng-class="{true: \'outline_1_red inline\', false: inline}[$index == imgListIndex]">' +
    '<img ng-src="{{list.file_cdn_path}}" ng-click="clickImg($index)"' +
    'style="width: 240px !important; height: auto !important; max-width: none !important; max-height: none !important;">' +
    '<div class="tools tools-bottom text-center">' +
    '<a ng-click="deleted($index)">' +
    '<i class="ace-icon icon-trash red"></i>' +
    '</a>' +
    '</div>' +
    '</li>' +
    '</ul>' +
    '</div>' +
    '</div>' +
    '</form>' +
    '</div>' +
    '<div class="tab-pane" ng-show="imageIndex === 2 || imageIndex === 3" style="display:block;">' +
    '<div class="form-group clearfix" style="margin-bottom: 10px;" ng-hide="clickVal==3">' +
    '<div class="col-sm-7"></div>' +
    '<div class="col-sm-12 no-padding-right">' +
    '<div class="input-group float-right">' +
    '<select ng-hide="imageIndex === 3" class="width160 float-left" ng-model="groupId"' +
    'style="border: 1px solid #d5d5d5;" ng-change="groupChange(groupId)">' +
    '<option value="">全部分组</option>' +
    '<option value="0">默认分组</option>' +
    '<option value="{{i.id}}" ng-repeat="i in groupOptions">{{i.name}}</option>' +
    '</select>' +
    '<input class="min-width120 float-left" placeholder="搜索消息相关关键字" ng-model="searchText" type="text">' +
    '<span class="float-left" ng-click="changeQuery(groupId)">' +
    '<a class="btn btn-xs btn-primary margin_right1">' +
    '<i class="icon-search icon-on-right bigger-110" style="color: #fff;"></i>' +
    '</a>' +
    '</span>' +
    '</div>' +
    '</div>' +
    '</div>' +
    '<form name="allform" id="select_ajax_form" novalidate="novalidate">' +
    '<div class="form-group margin-bottom10 clearfix hide">' +
    '<label class="col-sm-1 text-left no-padding-right login-text2 margin-right10"' +
    'for="form-field-1">标签</label>' +
    '<input name="tags" type="text" class="col-xs-10 col-sm-4"' +
    'style="margin-left:-20px" ng-model="searchText">' +
    '<button class="btn btn-sm btn-info" type="button"' +
    'ng-click="searchForm(searchText);">搜索' +
    '</button>' +
    '</div>' +
    '<div class="form-group margin-bottom10 clearfix hide">' +
    '<label class="col-sm-2 text-left" for="form-field-1">按标签查找</label>' +
    '<div class="col-sm-10" style="margin-left:-40px;">' +
    '<a onclick="" class="btn btn-sm btn-info">微杂志</a>' +
    '</div>' +
    '</div>' +
    '<div class="form-group margin-bottom10 clearfix">' +
    '<div class="width100 height300 img-storeroom-list">' +
    '<ul class="ul_pic clearfix">' +
    '<li class="pic_list" ng-repeat="list in imageLists">' +
    '<a class="bbb" ng-click="imageChoose($index, list)">' +
    '<img ng-src="{{list.file_cdn_path}}"><br>' +
    '<label> <i class="on" ng-show="list.ischoose"></i> </label>' +
    '</a>' +
    '<div ng-bind="list.name" class="pic_name"></div>' +
    '</li>' +
    '</ul>' +
    '</div>' +
    '</div>' +
    '</form>' +
    '<div ng-paginate options="options" page="page"></div>' +
    '</div>' +
    '</div>' +
    '</div>' +
    '</div>' +
    '</div>' +
    '<div class="modal-footer">' +
    '<a class="btn btn-default" data-dismiss="modal">取消</a>' +
    '<a class="btn btn-primary" ng-click="save()" id="submitImage">确定</a>' +
    '</div>' +
    '</div>' +
    '</div>' +
    '</div>',
    replace: true,
    scope: {
      options: '=options', //配置信息
      fn : '&fn' //确定后执行的方法
    },
    link: function (scope) {

      (function ($) {
        $('.slim-scroll').slimScroll({
          height: '466px'
        });
      })(jQuery);

      var Once = true, imageArray = [];
      scope.istrue = scope.iswltrue = scope.isalltrue = false;
      var selectId = '',
          name = '';
      scope.groupId = '';
      scope.searchText = '';

      //全局  头部点击切换
      scope.imageClick = function (index) {
        scope.searchText = '';
        scope.groupId = '';
        selectId = name = '';
        scope.imageIndex = index;
        if (index === 2 || index === 3) {
          getData(1);
        }
      };

      //显示模态框
      $('#' + scope.options.btnId).on('click', function() {
        $('#myModalImage').modal('show');
      });

      //本地上传选择分组
      scope.groupChange = function (id) {
        scope.groupId = id;
      };

      $http.post("/document/find-category-ajax")
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            scope.groupOptions = msg.errmsg;
          });
        });

      scope.name = '';
      scope.imgListIndex = -1;
      scope.imgLists = [];

      scope.clickImg = function (index) {
        scope.imgListIndex = index;
        scope.name = scope.imgLists[index].name;
      };
      scope.deleted = function (index) {
        wsh.setNoAjaxDialog('删除提示', '确定要删除该图片吗?', function () {
          scope.imgLists.splice(index, 1);
          scope.$apply();
        });
      };

      $('#chooseImage').uploadify({
        'fileTypeDesc': '不超过300kb的图片 (*.gif;*.jpg;*.png)',
        'fileTypeExts': '*.gif;*.jpg;*.jpeg;*.png',//
        'fileSizeLimit': '300kb',
        'swf': '/ace/uploadify/uploadify.swf',
        'uploader': '/document/upload-ajax',
        'buttonClass': 'btn btn-sm btn-info',
        'buttonText': '上传图片',
        'width': 74,
        'height': 23,
        'opacity': 0,
        'background': '#428bca',
        '-webkit-border-radius': 0,
        'border-radius': 0,
        'border': 0,
        'multi': scope.options.isuploadOne ? false : true,
        'removeTimeout': 0.1,
        'onUploadStart': function (file) {

        },
        'onFallback': function () {
          alert("您未安装FLASH控件，无法上传图片！请安装FLASH控件后再试。");
        },
        'onUploadSuccess': function (file, data) {
          data = $parse(data)(scope);
          if (data.errcode == 0) {
            scope.imgLists.push(data.errmsg);
            scope.imgLists[scope.imgLists.length - 1].tag_id = 1;
            scope.clickImg(scope.imgLists.length - 1);
            scope.$apply();
          }
        }
      });
      $('#chooseImage').css({
        'position': 'absolute',
        'top': '0',
        'left': '147px',
        'width': '74',
        'height': '23',
        'opacity': '0'
      });

      //按分组条件搜索图片库
      scope.groupChange = function (id) {
        name = '';
        scope.searchText = '';
        selectId = parseInt(id);
        getData(1);
      };
      scope.changeQuery = function (id) {
        name = scope.searchText;
        selectId = parseInt(id);
        getData(1);
      };

      //图片管理器
      scope.imageLists = [];
      function getData(int) {
        if (scope.clickVal == 3) {
          //微立得选择素材模板
          scope.urlName = '/hardware/materials-ajax'
        } else {
          //微商户后台图片
          scope.urlName = '/document/image-ajax'
        }
        var tagId = scope.imageIndex === 3 ? -1 : undefined;
        $http.post(scope.urlName, {
            '_page': int,
            '_page_size': 15,
            tag_id: tagId,
            "category_id": selectId,
            "name": name
          })
          .success(function (msg) {
            if (msg.errcode == 0) {
              scope.imageLists = msg.errmsg.data;
              scope.page = msg.errmsg.page;
              $.each(scope.imageLists, function (i, e) {
                e.ischoose = false;
              });
            }
          })
      };

      //分页
      scope.options = {callback: getData};

      scope.imageChoose = function (index, obj) {
        obj.ischoose = !obj.ischoose;
        if (obj.ischoose) {
          $.each(scope.imageLists, function (i, e) {
            if (i != index) e.ischoose = false;
          });
        }
      };

      //页面跳转显示那个tab
      $('#myModalImage').on('shown.bs.modal', function () {
        scope.imageClick(2);
        scope.groupChange();
        scope.$apply();
      });

      function check() {
        imageArray = [];
        scope.imageLists.forEach(function (e, i) {
          if (e.ischoose && Once) {
            imageArray.push(scope.imageLists[i]);
          }
          e.ischoose = false;
        });
        if (!imageArray.length) return alert('请选择图片');
        $('#submitImage').attr('disabled', 'disabled');
        scope.fn()(imageArray);
        setTimeout(function () {
          imageArray = [];
        }, 1000);
        $('#submitImage').removeAttr('disabled');
        $('#myModalImage').modal('toggle');
      };

      //图片保存方法
      scope.save = function () {
        switch (scope.imageIndex) {
          case 0:
            if (scope.myform.$invalid) {
              scope.istrue = true;
              return $timeout(function () {
                scope.istrue = false;
              }, 3000);
            }
            if (!scope.imgLists.length) return alert('请上传图片');
            $.each(scope.imgLists, function (i, e) {
              scope.imgLists[i].category_id = scope.groupId;
            });
            $('#submitImage').attr('disabled', 'disabled');
            $.ajax({
              type: "POST",
              url: "/document/create-ajax",
              data: {list: scope.imgLists},
              dataType: "json",
              success: function (msg) {
                $('#submitImage').removeAttr('disabled');
                wsh.successback(msg, '图片上传成功', false, function () {
                  var array = [];
                  for (var i = 0; i < msg.errmsg.length; i++) {
                    array.push(msg.errmsg[i]);
                  }
                  scope.fn()(array);
                  $('#myModalImage').modal('toggle');
                  $timeout(function () {
                    scope.imgLists = [];
                    scope.name = '';
                  }, 1000);
                });
              },
              error: function () {
                $('#submitImage').removeAttr('disabled');
                alert('服务器忙');
              }
            });
            break;
          case 2:
            check();
            break;
          case 3:
            check();
            break;
        }
      };
    }
  }
});