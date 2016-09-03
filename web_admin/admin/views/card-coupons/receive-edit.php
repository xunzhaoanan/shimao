<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '派发管理';
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">

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
                  <h3 ng-bind="news.title?news.title:'卡券标题'"
                      style="white-space:nowrap; overflow:hidden;text-overflow:ellipsis;">卡券~</h3>

                  <div class="text-muted" id="timephone">2016-01-05 16:01:00</div>
                  <img
                      ng-src="{{news.documentLib.file_cdn_path?news.documentLib.file_cdn_path:'http://imgcache.vikduo.com/static/0588736e9978930d277c9f3be7366984.png'}}"
                      width="212" height="103"
                      src="http://imgcache.vikduo.com/static/0588736e9978930d277c9f3be7366984.png">

                  <div class="margin-bottom5"
                       ng-bind="news.description?news.description:'亲，点击进入商城，领取活动卡券！' "
                       style="white-space:nowrap; overflow:hidden;text-overflow:ellipsis;">
                    亲，点击进入商城，领取活动卡券！
                  </div>
                  <div class="yue ">阅读全文<span><i class="icon-angle-right bigger-110"></i></span>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-sm-push-1 col-sm-7">
              <ng-form name="form1" class="form-horizontal" role="form">

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">卡券标题：</label>

                  <div class="col-sm-10" ng-cloak>
                    <input type="text" class="col-sm-8" name="title" ng-model="news.title" required
                           maxlength="50">
                    <span class="red" ng-show="form1.title.$error.required && isSubmit">必填项</span>
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
                  </div>
                </div>

                <div class="form-group margin-bottom10 clearfix">
                  <label class="col-sm-2 control-label"></label>

                  <div class="col-sm-10">
                    <div class="img_thumb">
                      <img ng-src="{{news.documentLib.file_cdn_path}}" class="img-thumb">
                    </div>
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">开始时间：</label>

                  <div class="col-sm-10" ng-cloak>
                    <div class="input-group col-sm-8 no-padding">
                      <input type="text" name="start" id="start_time"
                             class="Wdate form-control hasDatepicker"
                             onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}', maxDate:'#F{$dp.$D(\'end_time\')}'});"/>
                      <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                    </div>
                    <span class="red" ng-show="isTime1">{{$root.regRequiredText}}</span>
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2  control-label"> 结束时间：</label>

                  <div class="col-sm-10" ng-cloak>
                    <div class="input-group col-sm-8 no-padding">
                      <input type="text" name="start" id="end_time"
                             class="Wdate form-control hasDatepicker"
                             onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'start_time\')}'});"/>
                      <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                    </div>
                    <span class="red" ng-show="isTime2">{{$root.regRequiredText}}</span>
                  </div>
                </div>
                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">活动类型：</label>

                  <div class="col-sm-9">
                    <p>
                      <label>
                        <input name="offline" type="radio" class="ace" value="1"
                               ng-model="model.share_type" checked="checked">
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

                    <p class="form-control-static pointer" name="cardTitle">
                     <span ng-bind="model.cardTypeInfo.title"></span>
                      <a class="inline margin-left10" data-toggle="modal" data-target="#cardModal"
                         ng-click="$root.$broadcast('selectedCardId', model.card_type_id)">重新选择</a>
                    </p>

                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">信息摘要：</label>

                  <div class="col-sm-10">
                    <textarea class="col-sm-8" name="remark" ng-model="news.description"
                            maxlength="150" required
                            style=" height: 141px;"></textarea>
                    <span class="red" ng-show="form1.remark.$error.required && isSubmit">必填项</span>
                  </div>
                </div>

              </ng-form>
            </div>
          </div>
        </div>

        <div class="space-32"></div>
        <!-- 确定 -->
        <div class="modal-footer margin-auto" id="modal-footer">
          <a id="post" class="btn btn-primary" ng-click="saveBtn()" ng-disabled="isDisable">
            保存并关闭 </a>
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
<script language="javascript" type="text/javascript"
        src="/ace/js/DatePicker/WdatePicker.js"></script>
<script>
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http, $filter) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ec');
    }, 100);
    $scope.model = JSON.parse('<?= addslashe(json_encode($model))?>');
    $rootScope.choose_card_id = $scope.model.card_type_id;
    if (!$scope.model.news) {
      $scope.model.news = {};
    }
    if (!$scope.model.news.wxImagetxtReplyItems) {
      $scope.model.news.wxImagetxtReplyItems = [];
    }
    $scope.news = $scope.model.news.wxImagetxtReplyItems[0];
    var data = $filter('date');//获取日期
    setTimeout(function () {
      $('#start_time').val(data($scope.model.begin_time * 1000, 'yyyy-MM-dd HH:mm:ss'));
      $('#end_time').val(data($scope.model.end_time * 1000, 'yyyy-MM-dd HH:mm:ss'));
    }, 1000);

    $scope.$on('ImageListChange', function (e, json) {
      for (var i = 0; i < json.length; i++) {
        $scope.news.documentLib.file_cdn_path = json[i]["file_cdn_path"];
        $scope.news.document_id = json[i]["id"];
      }

    });
    $scope.$on('ImageChoose', function (e, json) {
      $scope.news.documentLib.file_cdn_path = json[0]["file_cdn_path"];
      $scope.news.document_id = json[0]["id"];
    });
    $scope.$on('chooseCard', function (e, json) {
      $scope.model.cardTypeInfo.title = json.title;
      $scope.model.card_type_id = json.id;
    });

    $scope.isSubmit = $scope.isDisable = $scope.isTime1 = $scope.isTime2 = false;
    var array = [];
    $scope.saveBtn = function () {

      if ($scope.form1.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 1000);
      }
      if (!$('#start_time').val()) {
        $scope.isTime1 = true;
        return $timeout(function () {
          $scope.isTime1 = false;
        }, 1000);
      }
      if (!$('#end_time').val()) {
        $scope.isTime2 = true;
        return $timeout(function () {
          $scope.isTime2 = false;
        }, 1000);
      }
      var begintime = +new Date($('#start_time').val()) / 1000;
      var endtime = +new Date($('#end_time').val()) / 1000;
      $scope.model.news = $scope.news;
      $scope.model.begin_time = begintime;
      $scope.model.end_time = endtime;
      $scope.isDisable = true;
      $http.post(wsh.url + 'receive-edit-ajax', $scope.model).
          success(function (msg) {
            wsh.successback(msg, '保存成功！', false, function () {
              window.location.href = 'receive-list';
            });
            $scope.isDisable = false;
          }).
          error(function (msg) {
            $scope.isDisable = false;
          });
    };

  });

</script> 
