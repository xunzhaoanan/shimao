<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '派发管理';
?>


<div class="main-container" id="main-container" ng-controller="mainController">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/marketing.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>派发管理</li>
        </ul>
      </div>
      <div class="page-content" ng-cloak>
        <div class="row">
          <div class="col-xs-12">
            <div class="space-10"></div>

            <div class="weileft col-sm-push-1 col-sm-3">
              <div class="weileftda wbsc" id="phone_page" style="width:281px;">
                <div class="wcright">
                  <h3 ng-bind="model.news.title?model.news.title:'卡券标题'"
                      style="white-space:nowrap; overflow:hidden;text-overflow:ellipsis;">卡券~</h3>

                  <div class="text-muted" id="timephone" ng-bind="time">2016-01-05 16:01:00</div>
                  <img
                      ng-src="{{model.news.imgsrc?model.news.imgsrc:'http://imgcache.vikduo.com/static/0588736e9978930d277c9f3be7366984.png'}}"
                      width="212" height="103"
                      src="http://imgcache.vikduo.com/static/0588736e9978930d277c9f3be7366984.png">

                  <div class="margin-bottom5"
                       ng-bind="model.news.description?model.news.description:'亲，点击进入商城，领取活动卡券！'"
                       style="white-space:nowrap; overflow:hidden;text-overflow:ellipsis;">
                    亲，点击进入商城，领取活动卡券！
                  </div>
                  <div class="yue ">查看全文<span><i class="icon-angle-right bigger-110"></i></span>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-sm-push-1 col-sm-7">
              <form class="form-horizontal" name="myform" role="form">

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">卡券标题：</label>

                  <div class="col-sm-10">
                    <input type="text" class="col-sm-8" name="title" ng-model="model.news.title"
                           required placeholder="最多不超过20个汉字" maxlength="20">
                                    <span class="red"
                                          ng-show="myform.title.$error.required && isSubmit">必填项</span>
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">图片：</label>

                  <div class="col-sm-10">
                    <div class="ace-file-input col-sm-8">
                      <a data-toggle="modal" data-target="#myModalImage">
                        <label class="file-label" data-title="选择">
                                                <span class="file-name file-name2"
                                                      data-title="点击上传图片...">
                                                    <i class="icon-upload-alt"></i>

                                                </span>

                        </label>
                      </a>

                    </div>
                    <span class=" red" ng-show="!model.news.imgsrc && isSubmit">请选择图片</span>
                  </div>
                </div>

                <div class="form-group clearfix" ng-show="model.news.imgsrc" ng-cloak>
                  <label class="col-sm-2 control-label"></label>

                  <div class="col-sm-10">
                    <img ng-src="{{model.news.imgsrc}}" ng-if="model.news.imgsrc" class="img-thumb"
                         required/>
                    <span class="block red" ng-show="isRequiredImg">请选择图片</span>

                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">开始时间：</label>

                  <div class="col-sm-10" ng-cloak>
                    <div class="input-group col-sm-8 no-padding">
                      <input type="text" name="start" id="start_time"
                             class="Wdate form-control hasDatepicker"
                             onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{$dp.$D(\'start_time\')}', minDate:'%y-%M-#{%d}'});"
                             value=""/>
                      <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                    </div>
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2  control-label"> 结束时间：</label>

                  <div class="col-sm-10">
                    <div class="input-group col-sm-8 no-padding" ng-cloak>
                      <input type="text" name="start" id="end_time"
                             class="Wdate form-control hasDatepicker"
                             onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}',maxDate:'#F{$dp.$D(\'end_time\')}'});"

                             value=""/>
                      <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                    </div>
                  </div>
                </div>
                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">活动类型：</label>
                  <div class="col-sm-9">
                    <p>
                      <label>
                        <input name="offline" type="radio" class="ace" value="1"
                               ng-model="model.share_type" >
                        <span class="lbl"> 开放性活动 </span>（可在惊喜页列表中显示，允许分享）
                      </label>
                    </p>

                    <p>
                      <label>
                        <input name="offline" type="radio" class="ace" value="2"
                               ng-model="model.share_type">
                        <span class="lbl"> 线下分享活动 </span>（不在惊喜页列表中显示，允许分享）
                      </label>
                    </p>

                    <p>
                      <label>
                        <input name="offline" type="radio" class="ace" value="3"
                               ng-model="model.share_type">
                        <span class="lbl"> 线下活动 </span>（不在惊喜页列表中显示，禁止分享）
                      </label>
                    </p>
                  </div>
                </div>
                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">关联卡券：</label>

                  <div class="col-sm-10">

                                    <span type="submit" data-toggle="modal" data-target="#cardModal"
                                          class="btn btn-xs btn-primary" ng-show="!model.title">
                                                   选择卡券
                                                </span>

                    <p class="form-control-static pointer" ng-show="model.title" name="cardTitle">
                      <span ng-bind="model.title"></span><a href="javascript:void(0);" class="inline margin-left10"
                                        data-toggle="modal" data-target="#cardModal">重新选择</a></p>

                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">信息摘要：</label>

                  <div class="col-sm-10">
                    <textarea class="col-sm-8" name="description" ng-model="model.news.description"
                            required maxlength="150"
                              style=" height: 141px;"></textarea>
                    <span class="red"
                          ng-show="myform.description.$error.required && isSubmit">必填项</span>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>

        <div class="space-32"></div>
        <!-- 确定 -->
        <div class="modal-footer margin-auto" id="modal-footer">
          <a id="post" ng-click="save()" href="" class="btn btn-primary"> 保存 </a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
echo $this->render('@app/views/card-coupons/card-connect.php');
?>
<?php
echo $this->render('@app/views/uploadImg/imageIndex.php');
?>
<script type="text/javascript" src="/ace/js/DatePicker/WdatePicker.js"></script>
<script>
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ec');
    }, 100);


    var date = new Date;
    var month = date.getMonth() + 1;
    var day = date.getDate();
    if (month < 10) {
      month = "0" + month
    }
    if (day < 10) {
      day = "0" + day
    }
    $scope.time = month + "月" + day + '日';

    $scope.model = {};
    //选择图片后，确定按钮
    $scope.isRequiredImg = false;
    $rootScope.isuploadOne = false;
    $scope.model.news = {};
    $scope.model.share_type = 1;
      $scope.model.news.description='亲，点击进入商城，领取活动卡券!';
    $scope.$on('ImageListChange', function (e, json) {
      for (var i = 0; i < json.length; i++) {
        $scope.model.news.document_id = json[i]["id"];
        $scope.model.news.imgsrc = json[i]["file_cdn_path"];
      }

    });
    $scope.$on('ImageChoose', function (e, json) {
      $scope.model.news.document_id = json[0]["id"];
      $scope.model.news.imgsrc = json[0]["file_cdn_path"];
    });
    $scope.$on('chooseCard', function (e, json) {
      $scope.model.title = json.title;
      $scope.model.card_type_id = json.id;
    });
    $scope.isSubmit = false;
    $scope.save = function () {
      if ($scope.myform.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
//      if (!$scope.model.news.imgsrc) {
//        alert("请选择图片");
//        $scope.isRequiredImg = true;
//        return $timeout(function () {
//          $scope.isRequiredImg = false;
//        }, 2000);
//      }
      if (!$scope.model.title) {
        alert("请选择卡券");

        return $timeout(function () {

        }, 2000);
      }
      var starttime = $("#start_time").val(),
          endtime = $("#end_time").val(),
          start = +new Date(starttime) / 1000,
          end = +new Date(endtime) / 1000;

      if (starttime == "" || starttime == undefined) {
        return alert("开始时间不能为空！");
      }
      if (endtime == "" || endtime == undefined) {
        return alert("结束时间不能为空！");
      }
      if (start >= end) {
        return alert('结束时间不能小于开始时间');
      }
      if (!$scope.model.share_type) {
        alert("请选择活动类型");

        return $timeout(function () {

        }, 2000);
      }
      $scope.model.begin_time = start;
      $scope.model.end_time = end;

      $('#btnConfirm').attr('disabled', 'disabled');
      //添加
      $http.post(wsh.url + "receive-add-ajax", $scope.model)
          .success(function (msg) {
            wsh.successback(msg, '添加成功', false, function () {

              window.location.href = 'receive-list';
            })
          }).
          error(function (msg) {
            $scope.isDisable = false;
          });

    }
  });

</script> 
