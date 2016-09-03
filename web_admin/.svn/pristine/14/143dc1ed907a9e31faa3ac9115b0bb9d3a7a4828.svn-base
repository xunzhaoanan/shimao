<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '编辑终端店';
?>

<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/terminal.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }</script>
        <ul class="breadcrumb">
          <li>编辑终端店</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-sm-12">
            <div class="space-10"></div>
            <form novalidate="novalidate" class="form-horizontal" name="myform">
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"> <span class="red">*</span><strong>终端店分类:</strong> </label>

                <div class="col-xs-9">
                  <select ng-model="model.shop_type" class="col-sm-1" ng-options="o.shop_type as o.name for o in shoptypeList"></select>
                </div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"> <span class="red">*</span><strong>终端店名称:</strong> </label>

                <div class="col-xs-9">
                  <input type="text" class="css col-sm-3" required="required" ng-model="model.shopInfo.name" name="name" reg-char-len="20" prompt-msg="nameMsg" prompt-type="1" ng-trim="false" diff-zh="true" ng-disabled="model.shopInfo.available_status==3">
                  <span class="inline padding5" ng-class="{'red':myform.name.$error.exceed}" ng-bind="nameMsg"></span>
                  <span ng-show="myform.name.$error.required && istrue" class="red inline padding5">必填项</span></div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"><span class="red">*</span> <strong>微信店铺分类:</strong> </label>
                <!--微信店铺-->
                <div class="col-xs-9">
                  <select class="col-sm-1" id="wxShopFirstId" ng-model="wxshopFirst" ng-change="changeFirst(wxshopFirst)">
                    <option value="">请选择</option>
                    <option value="{{i.id}}" ng-repeat="i in wxFirstSelect" ng-bind="i.name" ng-selected="i.id == wxshopFirst"></option>
                  </select>
                  <select class="col-sm-1 margin-left10" id="wxShopSecondId" ng-model="wxshopSecont" ng-change="changeSecont(wxshopSecont)">
                    <option value="">请选择</option>
                    <option value="{{i.id}}" ng-repeat="i in wxSecondSelect" ng-bind="i.name" ng-selected="i.id == wxshopSecont"></option>
                  </select>
                  <select class="col-sm-1 margin-left10" id="wxShopThirdId" ng-model="wxshopThird">
                    <option value="">请选择</option>
                    <option value="{{i.id}}" ng-repeat="i in wxThirdSelect" ng-bind="i.name" ng-selected="i.id == wxshopThird"></option>
                  </select>
                </div>
                <!-- 微信店铺-->
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"><span class="red">*</span> <strong>所属商圈:</strong> </label>
                <!--商圈-->
                <province province="model.shopInfo.province_id" city="model.shopInfo.city_id" district="model.shopInfo.district_id" circle="model.shopInfo.circle_id"></province>
                <!-- 商圈-->
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"><span class="red">*</span> <strong>营业时间:</strong> </label>

                <div class="col-sm-10">
                  <input type="time" class="col-sm-1 no-float" name="start" ng-model="start" required>
                  <span>至</span>
                  <input type="time" class="col-sm-1 no-float" name="end" ng-model="end" required>
                  <span ng-show="(myform.start.$error.required || myform.end.$error.required || myform.start.$error.time || myform.end.$error.time) && istrue" class="red inline padding5">必填项</span>
                </div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"><span class="red">*</span> <strong>电话:</strong> </label>

                <div class="col-sm-10">
                  <input type="text" class="col-sm-3 no-float" ng-model="model.shopInfo.phone" ng-blur="checkText(myform.phone.$error.pattern, '手机号码输入错误')" name="phone" placeholder="13800138000" required="required" ng-pattern="" reg-mobile>
                  <span ng-show="myform.phone.$error.pattern" class="red inline padding5">{{$root.regMobileText}}</span>
                  <span ng-show="myform.phone.$error.required && istrue" class="red inline padding5">必填项</span></div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"><span class="red">*</span> <strong>网址:</strong> </label>

                <div class="col-sm-10">
                  <input type="text" class="col-sm-3 no-float" ng-model="model.shopInfo.url" ng-blur="checkText(myform.url.$error.pattern, '链接输入错误')" name="url" required="required" placeholder="http://www.baidu.com" ng-pattern="" reg-url>
                  <span ng-show="myform.url.$error.pattern" class="red inline padding5">{{$root.regUrlText}}</span>
                  <span ng-show="myform.url.$error.required && istrue" class="red inline padding5">必填项</span></div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"><span class="red">*</span> <strong>店铺背景:</strong> </label>

                <div class="col-sm-10">
                  <div class="ace-file-input col-sm-2 no-float margin-right10 clearfix">
                    <a data-toggle="modal" data-target="#myModalImage" ng-click="chooseImageIndex = 0">
                      <label class="file-label" data-title="选择">
                        <span class="file-name file-name2" data-title="点击上传图片..."> <i class="icon-upload-alt"></i> </span>
                      </label>
                    </a>
                  </div>
                  <span name="easyTip">建议尺寸像素：640*960</span>

                  <div class="margin-bottom20"><img ng-src="{{model.shopInfo.bg_img}}" width="70" ng-show="model.shopInfo.bg_img"/></div>
                </div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"><span class="red">*</span> <strong>人均消费:</strong> </label>

                <div class="col-sm-10">
                  <input type="text" class="col-sm-3 no-float" ng-model="model.shopInfo.avg_price" name="avgPrice" required="required" ng-pattern="" reg-int>
                  <span ng-show="myform.avgPrice.$error.pattern" class="red inline padding5">{{$root.regIntText}}</span>
                  <span ng-show="myform.avgPrice.$error.required && istrue" class="red inline padding5">必填项</span>
                </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="col-sm-2 control-label"><span class="red">*</span><strong>特色推荐:</strong> </label>

                <div class="col-sm-10">
                  <textarea class="form-control" name="shopInfoRecommend" required="required" ng-model="model.shopInfo.recommend" style="width:500px; height:120px;" placeholder="在此输入描述"
                            reg-char-len="200" prompt-msg="shopInfoRecommendMsg" prompt-type="1" ng-trim="false" diff-zh="true" required></textarea>
                  <span class="inline padding5" ng-class="{'red':myform.shopInfoRecommend.$error.exceed}" ng-bind="shopInfoRecommendMsg"></span>
                  <span class="red inline padding5" ng-show="myform.shopInfoRecommend.$error.required && istrue">必填项</span>
                </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="col-sm-2 control-label"><span class="red">*</span><strong>特色服务:</strong> </label>

                <div class="col-sm-10">
                  <textarea class="form-control" name="shopInfoSpecial" required="required" ng-model="model.shopInfo.special" style="width:500px; height:120px;" placeholder="在此输入描述"
                            reg-char-len="200" prompt-msg="shopInfoSpecialMsg" prompt-type="1" ng-trim="false" diff-zh="true" required></textarea>
                  <span class="inline padding5" ng-class="{'red':myform.shopInfoSpecial.$error.exceed}" ng-bind="shopInfoSpecialMsg"></span>
                  <span class="red inline padding5" ng-show="myform.shopInfoSpecial.$error.required && istrue">必填项</span>
                </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="col-sm-2 control-label"><span class="red">*</span><strong>商家描述:</strong> </label>

                <div class="col-sm-10">
                  <textarea class="form-control" name="shopInfoDescription" required="required" ng-model="model.shopInfo.description" style="width:500px; height:120px;" placeholder="在此输入描述"
                            reg-char-len="250" prompt-msg="shopInfoDescriptionMsg" prompt-type="1" ng-trim="false" diff-zh="true" required></textarea>
                  <span class="inline padding5" ng-class="{'red':myform.shopInfoDescription.$error.exceed}" ng-bind="shopInfoDescriptionMsg"></span>
                  <span class="red inline padding5" ng-show="myform.shopInfoDescription.$error.required && istrue">必填项</span></div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label"><span class="red">*</span> <strong>详细地址:</strong> </label>

                <div class="col-sm-10">
                  <input type="text" class="col-sm-3 no-float" ng-model="model.shopInfo.address" name="address" reg-char-len="50" prompt-msg="addressMsg" prompt-type="1" ng-trim="false" diff-zh="true" required>
                  <span class="inline padding5" ng-class="{'red':myform.address.$error.exceed}" ng-bind="addressMsg"></span>
                  <span ng-show="myform.address.$error.required && istrue" class="red inline padding5">必填项</span></div>
              </div>
              <!--腾迅地图-->
              <ten-map lat="{{model.lat}}" lng="{{model.lng}}" ng-hide="model.shopInfo.available_status==3"></ten-map>
              <!--腾迅地图-->
              <div class="form-group margin-bottom10 clearfix">
                <label class="col-sm-2 control-label"></label>

                <div class="col-sm-10">
                  <button class="btn btn-primary" ng-click="save()" ng-disabled="issave">保存</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->render('@app/views/uploadImg/imageIndex.php'); ?>
<script charset="utf-8" src="/ace/js/txmap.js"></script>
<script src="/ace/js/provinceSelect.js"></script>
<script src="/ace/js/tenMap.js"></script>
<script type="text/javascript">
  app.controller("mainController", function ($scope, $http, $timeout, $rootScope, $filter) {
    $scope.wxaccount = JSON.parse('<?= addslashe(json_encode($wxAccount)); ?>');
    //分类
    $scope.model = JSON.parse('<?= addslashe(json_encode($model)); ?>');
    $scope.shoptypeList = JSON.parse('<?= addslashe(json_encode($shoptypeList)); ?>');
    console.log($scope.model);
    $scope.wxshop = $scope.model.shopInfo.wx_categories ? angular.copy($scope.model.shopInfo.wx_categories) : [];
    if ($scope.wxshop) {
      $scope.wxshopFirst = $scope.wxshop[0] ? $scope.wxshop[0].id : '';
      $scope.wxshopSecont = $scope.wxshop[1] ? $scope.wxshop[1].id : '';
      $scope.wxshopThird = $scope.wxshop[2] ? $scope.wxshop[2].id : '';
    } else {
      $scope.wxshopFirst = '';
      $scope.wxshopSecont = '';
      $scope.wxshopThird = '';
    }
    $scope.istrue = false;

    //检测输入是否合法
    $scope.checkText = function (val, text) {
      if (val) return alert(text);
    }
    //微信店铺分类 一级
    $scope.getAddress = function () {
      $http.post('/common/find-wxshop-category-ajax', {pid: 0})
        .success(function (data) {
          $scope.wxFirstSelect = data.errmsg || [];
        })
    }
    //微信店铺分类 二级
    $scope.changeFirst = function (wxshopFirst) {

      if (wxshopFirst == '') {
        $scope.wxshopSecont = '';
        $scope.wxshopThird = '';
        $scope.wxSecondSelect = [];
        $scope.wxThirdSelect = [];
      } else {
        $http.post('/common/find-wxshop-category-ajax', {pid: wxshopFirst})
          .success(function (data) {
            $scope.wxSecondSelect = data.errmsg || [];
            $scope.wxshopSecont = data.errmsg[0].id;
            $scope.changeSecont();
          })
      }
    }

    //微信店铺分类 三级
    $scope.changeSecont = function () {
      $scope.wxshopSeconts = $scope.wxshopSecont
      if ($scope.wxshopSeconts == '') {
        $scope.wxshopThird = '';
        $scope.wxThirdSelect = [];
      } else {
        $http.post('/common/find-wxshop-category-ajax', {pid: $scope.wxshopSeconts})
          .success(function (data) {
            $scope.wxThirdSelect = data.errmsg || [];
            if ($scope.wxThirdSelect.length > 0) {
              $scope.wxshopThird = $scope.wxThirdSelect[0].id;
            } else {
              $scope.wxshopThird = undefined;
            }
          })
      }
    }
    $scope.getAddress();
    //默认值
    $scope.initnum = function () {
      $http.post('/common/find-wxshop-category-ajax', {pid: $scope.wxshopFirst})
        .success(function (data) {
          $scope.wxSecondSelect = data.errmsg || [];
          if ($scope.wxSecondSelect.length > 0) {
          } else {
            $scope.wxshopThird = '';
          }
        })
      $http.post('/common/find-wxshop-category-ajax', {pid: $scope.wxshopSecont})
        .success(function (data) {
          $scope.wxThirdSelect = data.errmsg || [];
          if ($scope.wxThirdSelect.length > 0) {
          } else {
            $scope.wxshopThird = '';
          }
        })
    }
    $scope.initnum();

    //给时间默认值
    if ($scope.model.shopInfo.businesshour != null) {
      $scope.start = new Date("2000-01-01 " + $scope.model.shopInfo.businesshour.split("-")[0]);
      $scope.end = new Date("2000-01-01 " + $scope.model.shopInfo.businesshour.split("-")[1]);
    }
    //保存
    $scope.save = function () {
      $scope.model.shopInfo.businesshour = $("#businesshour1").val() + "-" + $("#businesshour2").val();
      if ($scope.myform.$invalid) {
        $scope.istrue = true;
        return $timeout(function () {
          $scope.istrue = false;
        }, 3000);
      }
      ;
      $scope.model.shopInfo.businesshour = $filter('date')($scope.start, 'HH:mm') + '-' + $filter('date')($scope.end, 'HH:mm');
      $scope.model.lat = $('#lat').val();
      $scope.model.lng = $('#lng').val();
      if ($scope.model.shop_type == -1) return alert('请选择终端店分类');
      if ($scope.provinceId == -1) return alert('请选择商圈');
      if ($scope.wxshopFirst == undefined || $scope.wxshopFirst == null || $scope.wxshopFirst == '') return alert('请选择微信店铺');
      getCategories();
      $scope.issave = true;

      $http.post(wsh.url + 'edit-ajax', $scope.model)
        .success(function (msg) {
          $scope.issave = false;
          wsh.successback(msg, '提交成功', false, function () {
            if (wsh.getHref('agent_id')) {
              window.location.href = wsh.url + 'list?agent_id=' + wsh.getHref('agent_id');
            }
            else if (wsh.getHref('terminal_id')) {
              window.location.href = '/terminal/detail' + $rootScope.getSearchUrl;
            } else {
              window.location.href = wsh.url + 'list';
            }

          });
        })
        .error(function () {
        });
    };
    $scope.chooseImageIndex = 0;
    $scope.$on('ImageChoose', function (e, json) {
      switch ($scope.chooseImageIndex) {
        case 0:
          $scope.model.shopInfo.bg_img = json[0].file_cdn_path;
          break;
        default :
          break;
      }
    });
    function getCategories() {
      angular.forEach($scope.wxFirstSelect, function (obj) {
        if (obj.id == $scope.wxshopFirst) {
          $scope.name1 = obj.name;
        }
      });
      angular.forEach($scope.wxSecondSelect, function (obj) {
        if (obj.id == $scope.wxshopSecont) {
          $scope.name2 = obj.name;
        }
      });
      angular.forEach($scope.wxThirdSelect, function (obj) {
        if (obj.id == $scope.wxshopThird) {
          $scope.name3 = obj.name;
        }
      });

      $scope.model.shopInfo.wx_categories = [];
      $scope.model.shopInfo.wx_categories[0] = {
        id: $scope.wxshopFirst,
        name: $scope.name1
      };
      if ($scope.wxshopSecont != undefined && $scope.wxshopSecont != null && $scope.wxshopSecont != '') {
        $scope.model.shopInfo.wx_categories[1] = {
          id: $scope.wxshopSecont,
          name: $scope.name2
        };
        if ($scope.wxshopThird != undefined && $scope.wxshopThird != null && $scope.wxshopThird != '') {
          $scope.model.shopInfo.wx_categories[2] = {
            id: $scope.wxshopThird,
            name: $scope.name3
          };
        }
      }
    };
  });
</script> 