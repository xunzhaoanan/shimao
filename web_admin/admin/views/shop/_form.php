<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\forms\ShopForm;

?>

<!-- /.page-header -->
<!-- PAGE CONTENT BEGINS -->

<div class="row" ng-controller="mainController" ng-cloak>
  <div class="col-sm-12">
    <div class="space-10"></div>
    <form novalidate="novalidate" class="form-horizontal " name="myform">
      <div class="form-group  clearfix">
        <label class="col-sm-2 control-label"> <span class="red">*</span><strong>商家名称:</strong> </label>

        <div class="col-sm-10">
          <input type="text" class="css col-sm-3 no-float" required="required" name="name" ng-model="lists.name" ng-maxlength="30">
          <span ng-show="myform.name.$error.required && istrue" class="red">必填项</span>
          <span ng-show="myform.name.$error.maxlength && istrue" class="red">不能超过30个字符</span>
        </div>
      </div>
      <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><span class="red">*</span> <strong>商家logo:</strong> </label>

        <div class="col-sm-10">
          <div class="ace-file-input col-sm-2 no-float margin-right10 clearfix">
            <a data-toggle="modal" data-target="#myModalImage" ng-click="chooseImageIndex = 0">
              <label class="file-label" data-title="选择">
                <span class="file-name file-name2" data-title="点击上传图片..."> <i class="icon-upload-alt"></i> </span>

              </label>
            </a>
          </div>
          <span name="easyTip">建议尺寸像素，200*200</span>
          <span ng-show="picture" class="red">必选项</span>

          <div class="margin-bottom20"><img ng-src="{{lists.logo}}" width="70" ng-show="lists.logo"/></div>
        </div>
      </div>

      <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><span class="red">*</span> <strong>联系电话:</strong> </label>

        <div class="col-sm-10">
          <input type="text" class="col-sm-3 no-float" ng-model="lists.tel" name="phone" placeholder="13800138000" required="required" ng-pattern="" reg-mobile>
          <span ng-show="myform.phone.$error.pattern" class="red">{{$root.regMobileText}}</span>
          <span ng-show="myform.phone.$error.required && istrue" class="red">必填项</span>
        </div>
      </div>

      <!-- <div class="form-group clearfix hide">
        <label class="col-sm-2 control-label"><span class="red">*</span> <strong>商家网址:</strong> </label>
        <div class="col-sm-10">
          <input type="text" class="col-sm-3 no-float" ng-model="lists.website" name="url" ng-pattern="" reg-url required="required" maxlength="50">
          <span ng-show="myform.url.$error.pattern && istrue" class="red">{{$root.regUrlText}}</span>
          <span ng-show="myform.url.$error.required && istrue"  class="red">必填项</span>
        </div>
      </div> -->
      <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><span class="red">*</span> <strong>商家微信号:</strong> </label>

        <div class="col-sm-10">
          <input type="text" class="col-sm-3 no-float" ng-model="model.wxInfo.account" readonly>
        </div>
      </div>
      <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><span class="red">*</span> <strong>商城URL:</strong> </label>

        <div class="col-sm-10">
          <input type="text" readonly class="col-sm-4 no-float" value="<?= getMobileSite() . '/mall/index' ?>">
        </div>
      </div>
      <!-- <div class="form-group margin-bottom10 clearfix hide">
        <label class="col-sm-2 control-label"><span class="red">*</span><strong>官网背景:</strong> </label>
        <div class="col-sm-10">
          <div class="ace-file-input col-sm-2 no-float margin-right10 clearfix">
            <a data-toggle="modal" data-target="#myModalImage" ng-click="chooseImageIndex = 1">
              <label class="file-label" data-title="选择">
                <span class="file-name file-name2" data-title="点击上传图片..."> <i class="icon-upload-alt"></i> </span>
              </label>
          </a> </div>
          <span name="easyTip">建议选择640*960图片</span>
          <div><img ng-src="{{lists.bg_img}}" width="70" ng-show="lists.bg_img"/></div>
        </div>
      </div> -->
      <div class="form-group margin-bottom10 clearfix">
        <label class="col-sm-2 control-label"><span class="red"></span><strong>商家描述:</strong> </label>

        <div class="col-sm-10">
            <div style="width:500px;">
					<textarea  ng-model="lists.desc"  name="desc" style="width:500px; height:120px; resize: none"
                               reg-char-len="250" prompt-msg="promptMsg"
                               prompt-type="2"
                               ng-trim="false"
                               diff-zh="true"
                               required >
          </textarea>
            <div class="margin-top3 text-right" ng-class="{'red':namemy.tagname.$error.excees}" ng-bind="promptMsg"></div>
            </div>
        </div>


          <!--					<span class="red" ng-show="myform.shopInfoDescription.$error.required && istrue">必填项</span>-->

          <!--					<span class="margin-left10 onError red" ng-show="myform.shopInfoDescription.$error.maxlength" ng-cloak> 只能填写250个字 </span>-->

      </div>
      <!-- <div class="form-group clearfix hide">
        <label class="col-sm-2 control-label"><span class="red">*</span> <strong>详细地址:</strong> </label>
        <div class="col-sm-10">
          <input type="text" class="col-sm-3 no-float" ng-model="lists.addr" name="address" maxlength="50" required>
          <span class=" red inline padding5 grey">(只能填写30个字)</span>
          <span ng-show="myform.address.$error.required && istrue"  class="red">必填项</span>
          <span class="margin-left10 onError red" ng-show="myform.address.$error.maxlength" ng-cloak> 只能填写30个字 </span>
      </div> -->
  </div>
  <div class="form-group margin-bottom10 clearfix">
    <label class="col-sm-2 control-label"></label>

    <div class="col-sm-10">
      <button class="btn btn-primary" ng-click="save()" id="submit">保存</button>
    </div>
  </div>
  </form>
</div>
</div>
<?php echo $this->render('@app/views/uploadImg/imageIndex.php'); ?>
<script type="text/javascript">
  app.controller("mainController", function ($scope, $http, $timeout, $rootScope) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'aa');
    }, 100);
    $scope.model = JSON.parse('<?= addslashe(json_encode($model)); ?>');
    $scope.lists = $scope.model.shop;
    $scope.wxInfo = $scope.model.wxInfo;
    console.log("asdfsd", $scope.model);

    $scope.istrue = false;

    $scope.chooseImageIndex = 0;

    $scope.$on('ImageChoose', function (e, json) {
      switch ($scope.chooseImageIndex) {
        case 0:
          $scope.lists.logo = json[0].file_cdn_path;
          break;
        case 1:
          $scope.lists.bg_img = json[0].file_cdn_path;
          break;
        case 2:

          break;
      }
    });

    //上传图片
    $scope.$on('ImageListChange', function (e, json) {
      switch ($scope.chooseImageIndex) {
        case 0:
          $scope.lists.logo = json[0].file_cdn_path;
          break;
        case 1:
          $scope.lists.bg_img = json[0].file_cdn_path;
          break;
        case 2:
          break;
      }
    });
    $scope.save = function () {
      if ($scope.myform.$invalid) {
        $scope.istrue = true;
        return $timeout(function () {
          $scope.istrue = false;
        }, 3000);
      }
      if(!$scope.lists.logo){
        $scope.picture = true;
        return $timeout(function () {
          $scope.picture = false;
        }, 3000);
      }
      $.ajax({
        type: "POST",
        url: wsh.url + "edit-ajax",
        data: $scope.lists,
        dataType: "json",
        success: function (msg) {
          wsh.successback(msg, '提交成功', false, function () {
            window.location.href = wsh.url + 'index';
          });
        },
        error: function () {
          alert('服务器忙');
        }
      });
    };
  });
</script>