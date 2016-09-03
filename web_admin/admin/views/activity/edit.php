<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = $title;
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">
<div class="main-container" id="main-container" ng-controller="mainController">
  <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/marketing.php');?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>
        <ul class="breadcrumb">
          <li><?=$title?></li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="leader clearfix">
              <div class="col-sm-12 margin-bottom10"><span
                  class="label label-light  no-padding center"><b class="red">提示：活动一旦开启就不能再进行任何改动 </b> </span></div>
              <div class=" col-sm-6"> <span class="label label-lg label-success arrowed-right no-padding">1 设置图文</span> </div>
              <div class=" col-sm-6"> <span class="label label-lg label-light arrowed-in no-padding">2 活动规则</span> </div>
            </div>
            <div class="tabbable clearfix">
              <div id="home" class="tab-pane active ruleCont margin-top20">

                <!--左边的手机区域开始了-->
                <div class="weileft col-sm-push-1 col-sm-3">
                  <div class="weileftda" id="phone_page">
                    <div class="wcright">
                      <h3 ng-bind="wxImagetxtReplyItems.title"></h3>
                      <div class="text-muted" id="newDate"></div>
                      <img ng-cloak ng-show="wxImagetxtReplyItems.documentLib.file_cdn_path" ng-src="{{wxImagetxtReplyItems.documentLib.file_cdn_path}}" width="212" height="103">
                      <div class="margin-bottom5" ng-bind="wxImagetxtReplyItems.description"></div>
                      <div class="yue">阅读全文<span><i class="icon-angle-right bigger-110"></i></span></div>
                    </div>
                  </div>
                </div>
                <!--左边的手机区域结束了-->

                <!--左边的内容开始了-->
                <div class="col-sm-push-1 col-sm-7">
                  <form class="form-horizontal" name="myform" novalidate="novalidate">

                    <div class="form-group clearfix">
                      <label class="col-sm-2 control-label"> <strong class="red verg_mid">*</strong>图文标题：</label>
                      <div class="col-sm-10">
                        <input type="text" class="col-sm-5" name="tilte" ng-model="wxImagetxtReplyItems.title"  reg-char-len="60" prompt-msg="titleMsg" prompt-type="1" ng-trim="false" diff-zh="true" required>
                        <span class="inline padding5" ng-class="{'red':myform.title.$error.exceed}" ng-bind="titleMsg"></span>
                        <span class="red" ng-show="myform.title.$error.required && isSubmit" ng-cloak>必填项</span> </div>
                    </div>

                    <div class="form-group margin-bottom20 clearfix">
                      <label class="col-sm-2 control-label"> <strong class="red verg_mid">*</strong>摘要内容：</label>
                      <div class="col-sm-10">
                        <textarea class="col-sm-5 padding5" style="height: 250px" id="form-field-8" name="description" ng-model="wxImagetxtReplyItems.description" required reg-char-len="120" prompt-msg="descMsg" prompt-type="1" ng-trim="false" diff-zh="true"></textarea>
                        <span class="inline padding5" ng-class="{'red':myform.description.$error.exceed}" ng-bind="descMsg"></span>
                        <span class="red" ng-show="myform.description.$error.required && isSubmit" ng-cloak>必填项</span> </div>
                    </div>

                    <div class="form-group clearfix">
                      <label class="col-sm-2 control-label"> <strong class="red verg_mid">*</strong>活动图片：</label>
                      <div class="col-sm-10">
                        <div class="ace-file-input col-sm-4 margin-right10 clearfix">
                          <a data-toggle="modal" data-target="#myModalImage">
                          <label class="file-label" data-title="选择"> <span class="file-name file-name2 " data-title="点击上传图片..."> <i class="icon-upload-alt"></i> </span> </label>

                          </a>

                        </div>
                        <span class="grey padding5">(建议尺寸像素：360*200或等比例图片)</span>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <label class="col-sm-2 control-label"></label>
                      <div class="col-sm-10">
                        <img ng-cloak ng-show="wxImagetxtReplyItems.documentLib.file_cdn_path" ng-src ="{{wxImagetxtReplyItems.documentLib.file_cdn_path}}" class="img-thumb3" />
                      </div>
                    </div>

                  </form>
                </div>
                <!--右边的内容结束了-->

              </div>

            </div>
          </div>
        </div>

        <div class="space-32"></div>
        <!-- 按钮开始了 -->
        <div class="modal-footer margin-auto" id="modal-footer">
            <a class="btn btn-infor" href="list"> 返回列表 </a>
            <a id="btnConfirm" class="btn btn-primary" ng-click="nextBtn()"> <i class="icon-ok bigger-110"></i> 下一步 </a>
        </div>
        <!-- 按钮结束了 -->

      </div>
    </div>
  </div>
</div>
<?php
    echo $this->render('@app/views/uploadImg/imageIndex.php');
?>
<script type="text/javascript">
    app.controller('mainController',function($scope, $rootScope, $timeout){
        $scope.leftMenuLevel = "<?= $leftMenuLevel?>";
        $timeout(function(){$rootScope.$broadcast('leftMenuChange', $scope.leftMenuLevel);}, 100);
        $scope.model = JSON.parse('<?= addslashe(json_encode($model))?>');
		    $scope.wxImagetxtReplyItems = $scope.model.news.wxImagetxtReplyItems[0];

        if(!$scope.wxImagetxtReplyItems){
            $scope.wxImagetxtReplyItems = {};
            $scope.wxImagetxtReplyItems.documentLib = {};
        }

        $scope.wxcopy = angular.copy($scope.wxImagetxtReplyItems);

        $("#newDate").html(wsh.getdate());

        var editUrl = "<?= $editUrl;?>", redirectUrl = "<?= $redirectUrl;?>",activitytype = "<?= $type;?>";
        //选择图片后，确定按钮
        $rootScope.isuploadOne = false;
        $scope.$on('ImageListChange', function(e, json){
                for(var i = 0; i<json.length;i++)
                 {
                   $scope.wxImagetxtReplyItems.document_id = json[i]["id"];
                   $scope.wxImagetxtReplyItems.documentLib.file_cdn_path = json[i]["file_cdn_path"];
                 }
        
        });
        $scope.$on('ImageChoose', function(e, json){
            $scope.wxImagetxtReplyItems.document_id = json[0]["id"];
            $scope.wxImagetxtReplyItems.documentLib.file_cdn_path = json[0]["file_cdn_path"];
        });

        //下一步按钮
        $scope.isSubmit = false;
        $scope.nextBtn = function(){
            if($scope.myform.$invalid){
                $scope.isSubmit = true;
                return $timeout(function(){
                    $scope.isSubmit = false;
                },2000);
            }
            if($scope.wxcopy.title == $scope.wxImagetxtReplyItems.title && $scope.wxcopy.description == $scope.wxImagetxtReplyItems.description && $scope.wxcopy.document_id == $scope.wxImagetxtReplyItems.document_id){
                return window.location.href = redirectUrl;
            }
            $('#btnConfirm').attr('disabled', 'disabled');
            $.ajax({
                type: "post",
                url: editUrl,
                data: {
                        activity: {
                            "id": $scope.model.activity ? $scope.model.activity.id : null,
                            "expire_type": $scope.model.activity ? $scope.model.activity.expire_type : null,
                            "start_time": $scope.model.activity ? $scope.model.activity.start_time : null,
                            "end_time": $scope.model.activity ? $scope.model.activity.end_time :null
                        },
                        news: {
                            "title": $scope.wxImagetxtReplyItems.title,
                            "description": $scope.wxImagetxtReplyItems.description,
                            "document_id": $scope.wxImagetxtReplyItems.document_id
                        },
                        activitytype:$scope.model[activitytype]
                     },
                dataType: "json",
                success: function(msg){
                    $('#btnConfirm').removeAttr('disabled');
                    wsh.successback(msg, '', false, function(){
                        window.location.href = redirectUrl;
                    });
                },
                error: function(msg){
                   $('#btnConfirm').removeAttr('disabled');
                    wsh.successback(msg);
                }
            });
        }
    });

</script>