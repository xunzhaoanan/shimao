<!-- 选择图片 -->
<div class="bootbox modal fade in" id="insertImageMaterial" style="z-index: 1700 !important;"
     tabindex="-1" role="dialog" open-close-modal aria-hidden="true"
     ng-controller="childController">
  <div class="modal-dialog modal-dialog2" style="z-index: 1600 !important;">
    <div class="modal-content">
      <div class="modal-header modal-header2"><a href="#" class="bootbox-close-button close"
                                                 data-dismiss="modal">×</a>
        <h4 class="modal-title">选择图片</h4>
      </div>
      <div class="modal-body " id="aa">
        <div class="row">
          <div class="col-xs-12">
            <!--/操作栏-->
            <div class="tabbable">
              <ul class="nav nav-tabs" id="myWxmaterialTab">
                <li ng-class="{'active':tabIndex===0}" ng-click="tabIndex=0;"
                    style="cursor: pointer;"><a>图片素材</a></li>
                <li ng-class="{'active':tabIndex===1}" ng-click="tabIndex=1;"
                    style="cursor: pointer;"><a>本地上传</a></li>
              </ul>
              <div class=" tab-content margin-bottom10 clearfix" id="mytabPane">
                <!--操作栏-->
                <div class="form-group clearfix margin-bottom10 tab-pane" style="min-height: 0;" ng-class="{'active':tabIndex===0}">
                  <div class="col-sm-7"></div>
                  <div class="col-sm-5 no-padding-right">
                    <div class="input-group float-right">
                      <input class="min-width120 float-left" placeholder="搜索消息相关关键字" type="text"
                             ng-model="searchText">
                    <span class="float-left " ng-click="changeQuer()">
                      <a class="btn btn-xs btn-primary margin_right1">
                        <i class="icon-search icon-on-right bigger-110"></i>
                      </a>
                    </span>
                    </div>
                  </div>
                </div>
                <div class="tab-pane width100 height300 img-storeroom-list margin-bottom10"
                     ng-class="{'active':tabIndex===0}">
                  <!--图片素材-->
                  <ul class="clearfix ul_pic">
                    <li class="pic_list"
                        ng-repeat="list in imageLists"
                        ng-click="imageClick($index)"
                        ng-class="{true: 'outline_1_red'}[imageIndex == $index]">
                      <!-- <p ng-bind="list.title | limitTo: 20" title="{{list.title}}"></p> -->
                      <img ng-src="{{list.cdn_path}}" width="150" height="150"
                           class=" no-margin">

                      <div ng-bind="list.title" class="pic_name ng-binding"></div>
                    </li>
                  </ul>
                  <!--/图片素材-->
                </div>
                <div ng-paginate options="options" page="page" class="tab-pane"
                     style="min-height: 0;" ng-class="{'active':tabIndex===0}">
                </div>
                <div class="tab-pane" ng-class="{'active':tabIndex===1}">
                  <!--新增素材-->
                  <form novalidate="novalidate" name="myform">
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="control-label">标题<span
                          class="red">*</span></label>

                      <div class="frm_input_box with_counter counter_in append count">
                        <input ng-maxlength="30" type="text" class="form-control"
                               placeholder="请输入标题" ng-model="model.title"
                               required="required"
                               name="title">
                        <!--   <em class="frm_input_append frm_counter">0/30</em> -->
                            <span class="block red"
                                  ng-show="myform.title.$error.maxlength">字符过多</span>
                            <span class="block red"
                                  ng-show="myform.title.$error.required && istrue">必填项</span>
                        <span class="block grey">标题文字长度不超过30个字，默认只显示两排</span>
                      </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="control-label">图片<span
                          class="red">*</span></label>

                      <div class="frm_input_box with_counter counter_in append count">
                        <div class="position-relative">
                          <a class="btn btn-sm btn-info"
                             ng-bind="model.img_src ? '重新选择' : '选择图片'"></a>

                          <div id="chooseImage"></div>
                        </div>
                            <span
                              class="block grey verg_mid">不超过2M，格式:  png, jpeg, jpg, gif</span>

                        <div class="upload_preview ">
                          <div style="font-size: 36px;" ng-if="loading">
                            <i
                              class="ace-icon icon icon-spinner icon-spin blue bigger-125"></i>
                          </div>
                          <img ng-show="model.cdn_path"
                               ng-src="{{model.cdn_path}}"
                               style="width: 240px !important; height: auto !important; max-width: none !important; max-height: none !important;">
                        </div>
                        <span class="block red" ng-show="!model.cdn_path && istrue">必填项</span>
                      </div>
                    </div>
                  </form>
                  <!--新增素材-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="modal-footer no-margin-top"><a class="btn btn-default" data-dismiss="modal">取消</a>
        <a class="btn btn-primary" ng-click="getWxmaterials()">确定</a></div>
    </div>
  </div>
</div>

<!-- /.main-container-inner -->
<script src="/ace/uploadify/jquery.uploadify.min.js"></script>
<script>
  app.controller('childController', function ($scope, $http, $rootScope, $parse, $timeout) {
    var mainArray, clickArray = [1, 1, 1, 1, 1, 1], pageArr = [],title = '';
    $scope.toggleIndex = 0;
    $scope.tabIndex = 0;
    $scope.page = {};
    $scope.newsIndex = $scope.textIndex = $scope.imageIndex = $scope.voiceIndex = $scope.videoIndex = $scope.musicIndex = -1;
    getImage(1, 15);
    function getImage(int) {
      $http.post("/wxmaterial/image-list-ajax", {'_page': int, '_page_size': 15,title : title || ''})
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.imageLists = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
          });
        })
    };
    $scope.imageClick = function (index) {
      $scope.imageIndex = index;
    };
    $scope.options = {page: 'page', callback: getImage, display: 5};
    //右上侧搜索设置
    $scope.searchText = '';
    $scope.searchList = function () {
      $scope.searchText = '';
    };
    $scope.changeQuer = function (id) {
      title = $scope.searchText;
      getImage(1, 15);
    };
    //获取图片
    $scope.getWxmaterials = function () {
      if ($scope.tabIndex === 1) {
        $scope.save();
      } else {
        if ($scope.imageIndex == -1) return alert('请选择图片');
        $rootScope.$broadcast('chooseImageWxmaterials', $scope.imageLists[$scope.imageIndex]);
        $('#insertImageMaterial').modal('toggle');
      }
      $scope.searchText = '',
        title = '';
    };
    var GridPager;
    $('#insertImageMaterial').on('shown.bs.modal', function () {
      getImage(1, 15);
    });
    $('#insertImageMaterial').on('hidden.bs.modal', function () {
      $scope.data = $scope.model = {};
      $scope.tabIndex = 0;
      $scope.newsIndex = $scope.textIndex = $scope.imageIndex = $scope.voiceIndex = $scope.videoIndex = $scope.musicIndex = -1;
    });


    $('#chooseImage').uploadify({
      'fileTypeDesc': '不超过300kb的图片 (*.gif;*.jpg;*.png)',
      'fileTypeExts': '*.gif;*.jpg;*.jpeg;*.png',
      'fileSizeLimit': '2MB',
      'swf': '/ace/uploadify/uploadify.swf',
      'uploader': '/wxmaterial/upload-ajax',
      'buttonClass': 'btn btn-sm btn-info',
      'buttonText': '上传图片',
      'width': 74,
      'height': 23,
      'opacity': 0,
      'background': '#428bca',
      '-webkit-border-radius': 0,
      'border-radius': 0,
      'border': 0,
      'multi': false,
      'removeTimeout': 0.1,
      'queueID': 'some_file_queue',
      'onFallback': function () {
        alert("您未安装FLASH控件，无法上传图片！请安装FLASH控件后再试。");
      },
      'onUploadStart': function () {
        $scope.loading = true;
        wsh.quickDialog('上传中...,请稍候!!');
      },
      'onUploadSuccess': function (file, data) {
        $scope.loading = false;
        try {
          data = $parse(data)($scope);
        } catch (e) {
          console.log(e.name);
        }
        wsh.successback(data, undefined, false, function () {
          wsh.quickDialog('上传成功!!');
          $scope.model.cdn_path = data.errmsg.cdn_path;
          $scope.model.media_id = data.errmsg.media_id;
          $scope.model.wx_url = data.errmsg.wx_url;
          $scope.$apply();
        });
      }
    });
    $('#chooseImage').css({'margin-top': '-23px', 'opacity': '0', 'margin-bottom': '0'});

    $scope.data = $scope.model = {};
    $scope.save = function () {
      if ($scope.myform.$invalid) {
        $scope.istrue = true;
        return $timeout(function () {
          $scope.istrue = false;
        }, 3000);
      }
      if (!$scope.model.cdn_path) return alert('请选择图片!');
      $('#submit').attr('disabled', 'disabled');
      $http.post("/wxmaterial/image-add-ajax", $scope.model)
        .success(function (msg) {
          $('#submit').removeAttr('disabled');
          wsh.successback(msg, undefined, false, function () {
            $('#insertImageMaterial').modal('hide');
            $rootScope.$broadcast('chooseImageWxmaterials', $scope.model);
          });
        })
    };
  });
</script>
