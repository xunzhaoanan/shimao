<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = $title;
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
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
              <div class="col-sm-6">
                  <span class="label label-lg label-success arrowed-right no-padding">1 设置图文</span>
              </div>
              <div class="col-sm-6">
                  <span class="label label-lg label-light arrowed-in no-padding">2 活动规则</span>
              </div>
            </div>
            <div class="tabbable clearfix">
              <div id="home" class="tab-pane active ruleCont margin-top20 clearfix">

                  <!--左边的手机区域开始了-->
                  <div class="weileft col-sm-push-1 col-sm-3">
                      <div class="weileftda" id="phone_page">
                        <div class="wbsc slim-scroll">
                          <div class="wcright">
                              <h3 ng-bind="news.title"></h3>
                              <img ng-src="{{news.imgsrc}}" width="212" height="103">
                              <div class="margin-bottom5" ng-bind="news.description"></div>
                              <div class="yue margin-top5">阅读全文<span><i class="icon-angle-right bigger-110"></i></span></div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <!--左边的手机区域结束了-->

                  <!--左边的内容开始了-->
                <div class="col-sm-push-1 col-sm-7">
                <form class="form-horizontal" name="myform" novalidate="novalidate">
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">
                        <strong class="red verg_mid">*</strong> 图文标题:
                    </label>
                    <div class="col-sm-10">
                      <input type="text" class="col-sm-5" name="title" ng-model="news.title"  reg-char-len="60" prompt-msg="titleMsg" prompt-type="1" ng-trim="false" diff-zh="true" required>
                      <span class="inline padding5" ng-class="{'red':myform.title.$error.exceed}" ng-bind="titleMsg"></span>
                      <span class="inline padding5 red" ng-show="myform.title.$error.required && isSubmit" ng-cloak>必填项</span>
                    </div>
                  </div>

                  <div class="form-group margin-bottom20 clearfix">
                    <label class="col-sm-2 control-label">
                        <strong class="red verg_mid">*</strong> 摘要内容:
                    </label>
                    <div class="col-sm-10">
                      <textarea class="col-sm-5 padding5" style="height: 250px" id="form-field-8"  name="description" ng-model="news.description" reg-char-len="120" prompt-msg="descMsg" prompt-type="1" ng-trim="false" diff-zh="true"  required></textarea>
                      <span class="inline padding5" ng-class="{'red':myform.description.$error.exceed}" ng-bind="descMsg"></span>
                        <span class="inline padding5 red" ng-show="myform.description.$error.required && isSubmit" ng-cloak>必填项</span>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">
                        <strong class="red verg_mid">*</strong> 活动图片:
                    </label>
                    <div class="col-sm-10 ">
                      <div class="ace-file-input col-sm-4 clearfix">
                          <a data-toggle="modal" data-target="#myModalImage">
                            <label class="file-label" data-title="选择">
                                <span class="file-name file-name2 " data-title="点击上传图片...">
                                    <i class="icon-upload-alt"></i>
                                </span>

                            </label>
                          </a>
                      </div>
                      <span class="inline padding5 grey">（建议尺寸像素：360*200像素或等比例图片）</span>
                      <span class="inline padding5 red" ng-show="isRequiredImg" ng-cloak>请选择活动图片</span>
                    </div>
                  </div>

                  <div class="form-group clearfix" ng-show="news.imgsrc">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10" ng-cloak>
                      <img  ng-src ="{{news.imgsrc}}"  class="img-thumb3" />
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
            <a id="btnConfirm" class="btn btn-primary" ng-click="nextBtn()">
                <i class="icon-ok bigger-110"></i> 下一步 </a>
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
    app.controller('mainController',function($scope, $rootScope, $timeout, $http){
        $scope.leftMenuLevel = "<?= $leftMenuLevel?>";
        $timeout(function(){$rootScope.$broadcast('leftMenuChange', $scope.leftMenuLevel);}, 100);

        var addUrl = "<?php echo $addUrl;?>", redirectUrl = "<?php echo $redirectUrl;?>";
        $scope.news = JSON.parse('<?= addslashe(json_encode($news)); ?>');

        //选择图片后，确定按钮
        $scope.isRequiredImg = false;

        $rootScope.isuploadOne = false;
        $scope.$on('ImageListChange', function(e, json){
            for(var i = 0; i<json.length;i++)
            {
                 $scope.news.document_id = json[i]["id"];
                 $scope.news.imgsrc = json[i]["file_cdn_path"];
            }
          
        });
        $scope.$on('ImageChoose', function(e, json){
            $scope.news.document_id = json[0]["id"];
            $scope.news.imgsrc = json[0]["file_cdn_path"];
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
            if(!$scope.news.imgsrc){
                $scope.isRequiredImg = true;
                return $timeout(function(){
                    $scope.isRequiredImg = false;
                },2000);
            }
            $('#btnConfirm').attr('disabled', 'disabled');
            $http.post(addUrl, {news:{"title": $scope.news.title, "description": $scope.news.description, "document_id": $scope.news.document_id}})
                    .success(function(msg){
                        $('#btnConfirm').removeAttr('disabled');
                        wsh.successback(msg, '', false, function(){
                            window.location.href = redirectUrl + "?id=" + msg["errmsg"]["id"];
                        });
                    })
                    .error(function(msg){
                        $('#btnConfirm').removeAttr('disabled');
                        wsh.successback(msg);
                    });
        }
    });
</script>