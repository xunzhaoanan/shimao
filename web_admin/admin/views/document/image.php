<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '图库管理';
?>
<link rel="stylesheet" href="/ace/css/colorbox.css"/>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div
      class="main-container-inner"> <?php echo $this->render('@app/views/side/manage_setting.php');
    ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>图库管理</li>
        </ul>
        <!-- .breadcrumb -->
        <!-- #nav-search -->
      </div>
      <div class="page-content library_management no-padding clearfix">
        <div class="wrapper">
          <div class="col-xs-12 clearfix">
            <!--操作栏-->
            <div class="float-left">
              <a class="btn btn-sm btn-primary margin-right10" data-toggle="modal"
                 data-target="#myModalImage"
                 ng-if="$root.hasPermission('document/doc-upload')">上传图片</a>
              <a ng-class="{true: 'btn-primary ', false: ' btn-light'}[isActive]"
                 class="btn btn-sm margin-right10" id="move" ng-click="moveList(1)"
                 ng-if="$root.hasPermission('document/multi-update-doc-category-ajax')">移动分组</a>
              <a ng-class="{true: 'btn-danger ', false: 'btn-light'}[isActive]"
                 class="btn btn-sm  margin-right10" id="del" ng-click="delMore()"
                 ng-if="$root.hasPermission('document/multi-delete-ajax')">删除</a>
            </div>
            <div class="float-right">
              <div class="input-group float-left">
                <input class="min-width120 float-left" placeholder="搜索图片名" type="text"
                       ng-model="searchText">
                                <span class="float-left"> <a ng-click="searchList()"
                                                             class="btn btn-xs btn-primary margin_right1">
                                  <i class="icon-search icon-on-right bigger-110"></i></a> </span>
              </div>
            </div>
          </div>
          <!--/操作栏-->
          <div class="space-6 clearfix col-sm-12 floatnone"></div>
          <div class="tabbable">
            <ul class="listBox  clearfix">
              <li class="list" ng-repeat="list in lists">
                <div class="pic">
                  <a href="{{list.file_cdn_path}}" ng-click="open($event)" data-rel="colorbox">
                    <div class="imgthumb">
                      <img class="img-responsive margin-auto" ng-src="{{list.file_cdn_path}}"
                           style="max-height:100%;">
                    </div>
                  </a>
                </div>
                <div class="number text-overflow">
                  <em ng-class="{true: 'choose ', false: ''}[list.isclick]"
                      class="icon_library circle_icon " ng-model="list.isclick"
                      ng-click="changeCheck(list)"></em>
                  <strong class="inline width80 text-overflow" ng-bind="list.name"></strong>
                </div>
                <div class="operate">
                        	        <span class="cell" data-toggle="modal" data-target="#imgedit"
                                        ng-if="$root.hasPermission('document/edit-ajax')"
                                        class="pointer "
                                        title="编辑图片名称"
                                        ng-click="pictureEdit(list.name,list.id,list.file_type)">
                            	   <em class="icon_library icon_library_1"></em>
                                  </span>
                                 <span class="cell pointer" title="移动分组"
                                       ng-click="moveList(2, list.id, list.category_id)"
                                       ng-if="$root.hasPermission('document/multi-update-doc-category-ajax')">
                            	   <em class="icon_library icon_library_2"></em>
                                 </span>

                            <span class="cell" title="删除" ng-click="pictureDelete(list.id)"
                                  ng-if="$root.hasPermission('document/multi-delete-ajax')">
                            	<em class="icon_library icon_library_3"></em>
                            </span>
                </div>
              </li>
            </ul>

            <div ng-paginate options="options" page="page">
            </div>
          </div>
          <!--右侧栏-->
          <div class="rightsidebar  sidebar-fixed">
            <div class="title clearfix">
              <span class="float-left">图片分组</span>
              <button type="button" class=" float-right margin-top10 btn btn-sm btn-primary"
                      data-toggle="modal" data-target="#myModal" ng-click="addList()"
                      ng-if="$root.hasPermission('document/create-category-ajax')">添加
              </button>
            </div>
            <dl class="my_pictures no-margin">
              <dt><a class="item block" ng-click="imageSearch()" id="all_img">全部图片</a></dt>
              <dd>
                <li class="item" ng-click="imageSearch(0)" id="default_category">默认分组</li>

                <ul>
                  <li ng-repeat="list in groupList" class="item  clearfix"
                      ng-class="{true: 'choose', flase: ''}[isColor==$index]"
                      ng-mouseenter="list.ishover=true" ng-mouseleave="list.ishover=false">
                    <!--<i class="inline icon-wenjiaguanli bigger-130 align-middle" ng-click="imageSearch(list.id)"></i>-->
                    <span class="inline align-middle margin-bottom10 width200"
                          ng-click="imageSearch(list.id, $index)">{{list.name}}</span>

                    <div class="float-right action-buttons">
                      <a href="" class="pointer blue align-middle" title="编辑" ng-show="list.ishover"
                         data-toggle="modal" data-target="#myModal"
                         ng-click="editList($index, list)"
                         ng-if="$root.hasPermission('document/update-category-ajax')">
                        <i class="icon icon-bianji bigger-130"></i>
                      </a>
                      <a href="" class="pointer red align-middle" title="删除" ng-show="list.ishover"
                         ng-click="deleteList($index, list)"
                         ng-if="$root.hasPermission('document/delete-category-ajax')">
                        <i class="icon icon-shanchu bigger-130"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </dd>
            </dl>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!--编辑图片名称-->
<div class="modal fade" id="imgedit" tabindex="-1" role="dialog" aria-labelledby="imgeditLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel1" ng-click="imageEdit($index)">编辑名称</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" name="groupForm">
          <div class="form-group">
            <label class="col-sm-2 control-label " name="name">名称：</label>

            <div class="col-sm-6">
              <input type="email" class="form-control " id="inputimgname_ng" placeholder="名称">
              <!--<span class="inline padding5 red" ng-show="groupForm.name.$error.required && istrue">必填项</span>
              <span class="red" ng-show="groupForm.name.$error.pattern">{{$root.regChineseText}}</span>
              <span class="red" ng-show="groupForm.name.$error.minlength">至少输入两个汉字</span></div>-->
            </div>
            <div class="col-sm-3 across-space1 margin-top2"></div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" ng-click="btnConfirm()" id="btnConfirm">确定
        </button>
      </div>
    </div>
  </div>
</div>
<!--移动分组-->
<div class="modal fade" id="imgcategory" tabindex="-1" role="dialog"
     aria-labelledby="imgcategoryLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel21" ng-bind="$root.isadd ? '移动分组' : '移动分组'"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label ">分组：</label>

            <div class="col-sm-8">
              <select name="" class="form-control" ng-model="$root.categoryId"
                      ng-options="o.id as o.name for o in $root.groupOptiosaaa"
                      ng-change="$root.change(categoryId)">
              </select>
            </div>

          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" ng-click="$root.btnFen()">确定</button>
      </div>
    </div>
  </div>
</div>

<!--图片分组-->
<div class="bootbox modal fade in" id="myModal" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><a class="bootbox-close-button close" data-dismiss="modal">×</a>
        <h4 class="modal-title" ng-bind="$root.isadd ? '添加分组' : '编辑分组'"></h4>
      </div>
      <div class="modal-body">
        <div class="bootbox-body">
          <form class="form-horizontal" name="myform" novalidate="novalidate">
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group clearfix">
                  <label class="col-sm-4 control-label">分组名称：</label>

                  <div class="col-sm-8">
                    <input type="text" class="col-sm-8" name="name" required="required"
                           ng-maxlength="50" maxlength="10" ng-model="$root.obj.name">
                    <span class="inline padding5 red"
                          ng-show="myform.name.$error.required && $root.istrue" ng-cloak>必填项</span>
                    <span class="inline padding5 red"
                          ng-show="myform.name.$error.maxlength && $root.istrue"
                          ng-cloak>字符过多</span></div>
                </div>

              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer"><a class="btn btn-default" data-dismiss="modal">取消</a> <a
          class="btn btn-primary" ng-click="$root.btnNulv()">确定</a></div>
    </div>
  </div>
</div>


<?php echo $this->render('@app/views/uploadImg/index.php'); ?>
<script src="/ace/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="/ace/js/jquery.colorbox-min.js"></script>

<script>
  app.controller('mainController', function ($scope, $timeout, $http, $rootScope) {
    var $overflow = '';
    var colorbox_params = {
      rel: 'colorbox',
      reposition: true,
      scalePhotos: true,
      scrolling: false,
      previous: '<i class="icon icon-arrow-left"></i>',
      next: '<i class="icon icon-arrow-right"></i>',
      close: '&times;',
      current: '{current} of {total}',
      maxWidth: '100%',
      maxHeight: '100%',
      onOpen: function () {
        $overflow = document.body.style.overflow;
        document.body.style.overflow = 'hidden';
      },
      onClosed: function () {
        document.body.style.overflow = $overflow;
      },
      onComplete: function () {
        $.colorbox.resize();
      }
    };
    $('.listBox [data-rel="colorbox"]').click(function () {
      alert('asdf');
    });
    $('.listBox [data-rel="colorbox"]').colorbox(colorbox_params);

    $("#cboxLoadingGraphic").html("<i class='icon icon-spinner orange icon-spin'></i>");
    $(document).one('ajaxloadstart.page', function (e) {
      $('#colorbox, #cboxOverlay').remove();
    });
    $scope.open = function (event) {
      event.preventDefault();
      $('.listBox [data-rel="colorbox"]').colorbox(colorbox_params);
    };
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ac');
    }, 100);

    $scope.is_search = false;
    var ids = [];
    getData(1);
    function getData(int) {
      var data = {
        '_page': int,
        '_page_size': 15,
        'name': name,
        'category_id': $scope.category_idSear,
        'is_search': Boolean(name)
      };
      $scope.searchText = name;
      $http.post('<?= Url::to(["/document/image-ajax"]);?>', data).
          success(function (msg) {
            wsh.successback(msg, '', false, function () {
              if (!$.isArray(msg.errmsg.data)) {
                return $scope.empty = true, $scope.$apply();
              }
              $scope.lists = msg.errmsg.data;
              $scope.page = msg.errmsg.page;
              $.each($scope.lists, function (i, e) {
                e.isclick = false;
              });
              complite();
              funImg();
            });
          });
    };
    //选择图片状态
    $scope.isActive = false;
    $scope.changeCheck = function (list, e) {
      e ? e.stopPropagation() : list.isclick = !list.isclick;
      check($scope.imageArray, list);

      /* if(list.isclick) {
       list.isclick = false;
       ids.splice(indexOfArry(ids, list.id), 1);
       } else {
       obj.isclick = true;
       ids.push(obj.id);
       }*/

    };
    function indexOfArry(arr, str) {
      if (arr && arr.indexOf) {
        return arr.indexOf(str);
      }
      var len = arr.length;
      for (var i = 0; i < len; i++) {
        if (arr[i] == str) {
          return i;
        }
      }
      return -1;
    }

    //选中后，分页查看的
    $scope.page = {};
    $scope.imageArray = [];
    function check(list, obj) {
      var index = -1;
      list.map(function (o, i) {
        if (o.id === obj.id) {
          index = i;
        }
      });
      if (obj.isclick && index < 0) {//如果是选中 并且不存在于List中就添加
        $scope.isActive = true;
        list.push({id: obj.id, name: obj.name});
        ids.push(obj.id);
      } else if (!obj.isclick && index >= 0) {//如果是取消 并且存在于List中就移除
        ids.splice(indexOfArry(ids, obj.id), 1);
        list.splice(index, 1);
        if ($scope.imageArray.length == 0) {
          $scope.isActive = false;
        }

      }
    }


//        $scope.options = {page: 'page', callback: getProduct};


    $rootScope.categoryId = 0;
    //移动分组
    $scope.moveList = function (isChoose, id, category_id) {
      $scope.isGroup = isChoose;
      if (isChoose == 1) {  //多选移动分组
        if ($scope.isActive) {
          $('#imgcategory').modal('show');
        }
      } else if (isChoose == 2) { //单选移动分组
        $('#imgcategory').modal('show');
        $scope.imgageId = id;
        $rootScope.categoryId = category_id;
      }
    };
    $scope.delmove = function (isChoose, id) {
      $scope.isGroup = isChoose;
      if (isChoose == 1) {  //多选移动分组删除
        if ($scope.isActive) {
          $('#imgcategory').modal('show');
        }
      } else if (isChoose == 2) { //单选移动分组删除
        $('#imgcategory').modal('show');
        $scope.imgageId = id;
      }
    };
    $rootScope.change = function (id) {
      $rootScope.categoryId = id;
    };
    //多选的删除
    $scope.delMore = function () {
      if ($("#del").hasClass("btn-light")) return;
      wsh.setDialog('删除提示', '确定要删除此图片吗?', '/document/multi-delete-ajax', {"ids": ids}, function () {
        location.reload();
      }, '删除成功');
    };

    //单个删除
    $scope.pictureDelete = function (id) {
      wsh.setDialog('删除提示', '确定要删除此图片吗?', '/document/delete-ajax', {"id": id}, function () {
        location.reload();
      }, '删除成功');
    };

    var name = ''

    //头部搜索设置
    $scope.searchList = function () {
      name = $scope.searchText ? $scope.searchText.trim() : '';
      getData(1);
    };

    //右侧目录搜索
    $rootScope.imageSearch = function (id, index) {
      name = '';
      $scope.category_idSear = id;
      $scope.isColor = index;
      if (id === 0) {
        $('#default_category').addClass('choose');
      } else {
        $('#default_category').removeClass('choose');
      }
      getData(1);
    };

    //编辑图片名称
    $scope.inputimgname = '';
    var c = document.querySelector('[ng-controller=mainController]');
    var s = angular.element(c).scope();
    var pictureId, pictureNanme;
    $scope.pictureEdit = function (name, id, type) {
      s.inputimgname = name;
      s.inputimgfiletype = type;
      pictureId = id;
      pictureNanme = name;
      $("#inputimgname_ng").val(name);
    };
    //编辑图片名称保存
    $rootScope.btnConfirm = function () {
      if (!$("#inputimgname_ng").val()) {
        return alert('名称不能为空');
      }
      if (!$scope.inputimgname == $("#inputimgname_ng").val()) {
        return alert('请填写名称');
      }
      $scope.inputimgname = $("#inputimgname_ng").val();
      $('#btnConfirm').attr('disabled', 'disabled');
      $http.post(wsh.url + "edit-ajax", {
        'id': pictureId,
        "name": $scope.inputimgname,
        "file_type": $scope.inputimgfiletype
      })
          .success(function (msg) {
            $('#btnConfirm').removeAttr('disabled');
            wsh.successback(msg, '修改成功', false, function () {
              $('#imgedit').modal('hide');
              //  getData($scope.page.current_page + 1);
              location.reload();
            });
          }).error(function (msg) {
            $('#btnConfirm').removeAttr('disabled');
          });
    };
    function complite() {
      var cnt = 0;
      if (!$scope.imageArray.length) return;
      console.log($scope.lists)
      for (var i in $scope.lists) {
        //$scope.lists[i].isshow = false;
        start : for (var j in $scope.imageArray) {
          if ($scope.lists[i].id == $scope.imageArray[j].id) {
            $scope.lists[i].isclick = true
            ++cnt;
            break start;
          }
        }
      }
      $scope.ischooseAll = cnt === $scope.lists.length;
    }


    $rootScope.groupOptiosaaa = [{"id": 0, "name": "默认分组"}];
    $rootScope.istrue = false;//判断输入是否合法
    //全部图片
    $http.post("/document/find-category-ajax")
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.groupList = msg.errmsg;
            if ($scope.groupList) {
              $.each($scope.groupList, function (i, e) {
                $rootScope.groupOptiosaaa.push(e);
              });
            }
          });
        });

    $rootScope.btnFen = function () {
      if ($scope.isGroup == 1) {  //多个
        $http.post(wsh.url + "multi-update-doc-category-ajax", {
          'category_id': $scope.categoryId,
          "ids": ids
        })
            .success(function (msg) {
              wsh.successback(msg, '移动分组成功', false, function () {
                $('#imgcategory').modal('toggle');
                location.reload();
              }, '');
            });
      } else if ($scope.isGroup == 2) {  //单个
        $http.post(wsh.url + "edit-ajax", {'category_id': $scope.categoryId, "id": $scope.imgageId})
            .success(function (msg) {
              wsh.successback(msg, '移动分组成功', false, function () {
                $('#imgcategory').modal('toggle');
                location.reload();
              }, '');
            });
      }
    };

    //图片分组
    $rootScope.isadd = false;//判断是添加还是编辑
    $rootScope.obj = {};
    //弹出层确定按纽
    $rootScope.btnNulv = function () {
      if ($rootScope.myform.$invalid) {
        $rootScope.istrue = true;
        return $timeout(function () {
          $rootScope.istrue = false;
        }, 2000);
      }
      if ($rootScope.isadd) {
        var obj = angular.copy($rootScope.obj);
        $http.post("/document/create-category-ajax", obj)
            .success(function (msg) {
              wsh.successback(msg, '添加成功', false, function () {
                $('#myModal').modal('toggle');
                $scope.groupList.push(msg.errmsg);
                location.reload();
              });
            })
      } else {
        var obj = angular.copy($rootScope.obj);
        $http.post("/document/update-category-ajax", obj)
            .success(function (msg) {
              wsh.successback(msg, '编辑成功', true, function () {
                $('#myModal').modal('toggle');
                location.reload();
              });
            })
      }
    };
    //添加
    $scope.addList = function (index, list) {
      $rootScope.isadd = true;
      $rootScope.obj = {};
    };
    //编辑
    $scope.index = 0;//保存索引值
    $scope.editList = function (index, list) {

      $rootScope.isadd = false;
      $scope.index = index;
      $rootScope.obj = angular.copy(list);
    };
    //删除
    $rootScope.deleteList = function (event) {
      wsh.setDialog('删除提示', '删除分组后，分组内图片将自动加入默认分组中。确定要删除此分组吗?', '/document/delete-category-ajax', {id: $scope.groupList[event].id}, function () {
        var tmp = [];
        for (var k in $scope.groupList) {
          if (k == event) continue;
          tmp.push($scope.groupList[k]);
        }
        $scope.groupList = tmp;
        location.reload();
      }, '删除成功')
    };
    //调整图片样式
    var time = 0;

    function funImg() {
      time = setInterval(function () {
        timeImg()
      }, 100);
    };
    function timeImg() {
      var timeadd = timeadd = ($(".imgthumb img").length);
      if (timeadd > 0) {
        imgload();
        //控制页面不同大小的图片显示
        function imgload() {
          $(".imgthumb img").one("load", function () {
            controlImgSize(this);
          }).each(function () {
            if (this.complete) {
              $(this).load();
            }
          });
        }

        function controlImgSize(img) {
          var oldHeiImg = $(img).height();
          var oldHeiDiv = $(img).parent().height();
          if (oldHeiDiv > oldHeiImg) { //垂直居中
            $(img).css({"margin-top": (oldHeiDiv - $(img).height()) / 2 + "px"});
          } else {//水平居中
            $(img).css({"height": "100%", "width": "auto"});
            $(img).parents(".imgthumb").css("text-align", "center");
          }
        }

        window.clearInterval(time);
      }
    };

    //分页
    $scope.options = {page: 'page', callback: getData};
  });
</script>