<link href="/ace/uploadify/uploadify.css" rel="stylesheet"/>
<div class="bootbox modal fade in" id="myModalText" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" open-close-modal aria-hidden="true"
     ng-controller="textController" style="z-index: 1700 !important;">
  <div class="modal-dialog modal-dialog2" style="z-index: 1600 !important;">
    <div class="modal-content" id="imagewidth">
      <div class="modal-header modal-header2">
        <a class="bootbox-close-button close" data-dismiss="modal">×</a>
        <h4 class="modal-title">批量导入文件</h4>
      </div>

      <div class="modal-body">
        <div class="bootbox-body">
          <div class="tabbable">
            <div class="tab-pane in active">
              <ul class="nav nav-tabs" id="myTab">
                <li ng-if="$root.hasPermission('document/create-ajax')" ><a>上传收款账户文件</a></li>
                </li>
              </ul>
            </div>

            <!-- 本地上传 -->
            <div class="tab-content">
              <div id="bdimg" class="tab-pane active" style="min-height: 200px; display:block;">
                <div class="tab-content">
                  <form action="/shop/import-excel" id="form1" enctype="multipart/form-data"
                        method="post" accept-charset="utf-8">
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="col-sm-1 control-label"> <strong></strong> </label>
                      <div class="col-sm-9">
                        <input type="file" name="UploadForm[file]" id="text1" value="选择文件"
                               class="col-sm-6">
                        <input ng-if="$root.hasPermission('fx/import-csv')" type="submit"
                               ng-disabled="aa" value="导入" id="sub1"
                               class="btn btn-xs btn-primary">
                        <span class="inline align-top margin-top3">(只支持上传大小不超过1M且文件格式为xls的文件)</span>
                      </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      </div>

  </div>
</div>
<script src="/ace/uploadify/jquery.uploadify.min.js"></script>
<script src="/ace/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="/ace/js/jquery.colorbox-min.js"></script>

<script>
  var Once = true, textArray = [];
  app.controller('textController', function ($scope, $rootScope, $timeout, $http, $parse) {

    $rootScope.isuploadOne = true; //配置只能上传一张图片

    $scope.aa = true;
    var timer = window.setInterval(function (e) {
      if ($('#text1').val()) {
        return $scope.aa = false, $scope.$apply();
      } else {
        return $scope.aa = true, $scope.$apply();

      }
    }, 30);

    var code = wsh.getHref('code');
    switch (code) {
      case '1000':
        alert('收款账户导入成功！');
        break;
      case '1001':
        alert('导入文件格式非法！');
        break;
      case '1002':
        alert('导入文件没有任何数据！');
        break;
      case '1003':
        alert('导入文件格式非法！');
        break;
      case '1004':
        alert('您没有导入权限！');
        break;
      case '1005':
        var msg = getQueryString('msg') ? getQueryString('msg') : '导入失败！';
        alert(msg);
        break;
      case '1006':
        alert('导入失败');
        break;
    }
    function getQueryString(name) {
      var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
      var r = location.search.substr(1).match(reg);
      if (r != null) return unescape(decodeURI(r[2]));
      return null;
    }

    $('#chooseImage').uploadify({
      'fileTypeDesc': '不超过300kb的图片 (*.xlsx;*.xls)',
      'fileTypeExts': '*.xlsx;*.xls',
      'fileSizeLimit': '1MB',
      'swf': '/ace/uploadify/uploadify.swf',
      'uploader': '/wxmaterial/upload-ajax',
      'buttonClass': 'btn btn-sm btn-info',
      'buttonText': '上传文件',
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
      'onUploadStart': function (file) {
        wsh.quickDialog('上传中...,请稍候!!')
      },
      'onUploadSuccess': function (file, data, response) {
        try {
          data = $parse(data)($scope);
        } catch (e) {
          console.log(e.name);
        };
        wsh.successback(data, '上传成功', false, function () {
          $scope.model.cdn_path = data.errmsg.cdn_path;
          $scope.model.media_id = data.errmsg.media_id;
          $scope.model.wx_url = data.errmsg.wx_url;
          $scope.$apply();
        });
      }
    });
    $('#chooseImage').css({'margin-top': '-33px', 'opacity': '0'});
  });

</script>