<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '添加加盟店';
?>

<!-- /.page-header -->
<!-- PAGE CONTENT BEGINS -->

<div class="row" ng-controller="mainController" ng-cloak xmlns="http://www.w3.org/1999/html">
  <div class="col-xs-12">
    <div class="space-10"></div>
    <form novalidate name="myform">
      <div class="form-group margin-bottom10 clearfix">
        <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <span class="red">*</span><strong>终端店分类:</strong> </label>
        <div class="col-xs-9">
            <select class="col-sm-1">
                <option value="1" label="直营店">直营店</option>
            </select>
        </div>
      </div>
      <div class="form-group margin-bottom10 clearfix">
        <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <span class="red">*</span><strong>终端店名称:</strong> </label>
        <div class="col-xs-9">
          <input  type="text" class="css col-sm-3" ng-readonly="isnew" required name="name"  ng-maxlength="10">
        </div>
      </div>
      <div class="form-group margin-bottom10 clearfix">
        <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <span class="red">*</span><strong>终端店帐号:</strong> </label>
        <div class="col-xs-9">
          <input  type="text" class="css col-sm-3" ng-readonly="isnew" required name="name"  ng-maxlength="10">
          <span>@shangjiahouzuiming</span> </div>
      </div>
      <div class="form-group margin-bottom10 clearfix">
        <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><span class="red">*</span> <strong>登录密码:</strong> </label>
        <div class="col-xs-9">
          <input  type="text" class="css col-sm-3" ng-readonly="isnew" required name="name"  ng-maxlength="10">
        </div>
      </div>
      <div class="form-group margin-bottom10 clearfix">
        <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><span class="red">*</span> <strong>所属分类:</strong> </label>
        <div class="col-xs-9">
          <select class="col-sm-1" name="shopInfo[province_id]" ng-model="provinceId" ng-options="o.id as o.name for o in provincedOption" ng-change="changeProvince(provinceId)">
          </select>
          <select class="col-sm-1 margin-left10" ng-disabled="provinceId.id == '-1'" name="shopInfo[city_id]" ng-model="cityId" ng-options="o.id as o.name for o in cityIdOption" ng-change="changeCityId(cityId)">
          </select>
          <select class="col-sm-1 margin-left10" ng-disabled="cityId.id == '-1'" name="shopInfo[district_id]" ng-model="districtId" ng-options="o.id as o.name for o in districtIdOption" ng-change="changeDistrictId(districtId)">
          </select>
        </div>
      </div>
      <div class="form-group margin-bottom10 clearfix">
        <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><span class="red">*</span> <strong>所属商圈:</strong> </label>
        <province model="model"></province>
        <!--<div class="col-xs-9">
          <select class="col-sm-1" name="shopInfo[province_id]" ng-model="provinceId" ng-options="o.id as o.name for o in provincedOption" ng-change="changeProvince(provinceId)">
          </select>
          <select class="col-sm-1 margin-left10" ng-disabled="provinceId.id == '-1'" name="shopInfo[city_id]" ng-model="cityId" ng-options="o.id as o.name for o in cityIdOption" ng-change="changeCityId(cityId)">
          </select>
          <select class="col-sm-1 margin-left10" ng-disabled="cityId.id == '-1'" name="shopInfo[district_id]" ng-model="districtId" ng-options="o.id as o.name for o in districtIdOption" ng-change="changeDistrictId(districtId)">
          </select>
          <select class="col-sm-1 margin-left10" ng-disabled="districtId.id == '-1'" name="shopInfo[circle_id]" ng-model="circleId" ng-options="o.id as o.name for o in circleIdOption" ng-change="changeCircleId(circleId)">
          </select>
        </div>-->
      </div>
      <div class="form-group margin-bottom10 clearfix">
        <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><span class="red">*</span> <strong>详细地址:</strong> </label>
        <div class="col-xs-9">
          <input type="text" class="col-sm-3" ng-model="model.shopInfo.address" name="address" maxlength="50" required>
          <span ng-show="myform.address.$error.required && istrue" style="color:#f00;">必填项</span> </div>
      </div>
      <div class="form-group margin-bottom10 clearfix">
        <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><span class="red">*</span> <strong>营业时间:</strong> </label>
        <div class="col-xs-9">
          <input type="text" class="col-sm-3" ng-model="model.shopInfo.businesshour" name="businesshour" placeholder="09:00-21:00" required ng-pattern="/^[\d]{2,2}:00-[\d]{2,2}:00$/">
          <span ng-show="(myform.businesshour.$invalid || myform.businesshour.$error.required) && istrue" style="color:#f00;">输入有误</span> <span ng-show="myform.businesshour.$error.required && istrue" style="color:#f00;">必填项</span> </div>
      </div>
      <div class="form-group margin-bottom10 clearfix">
        <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><span class="red">*</span> <strong>电话:</strong> </label>
        <div class="col-xs-9">
          <input type="text" class="col-sm-3" ng-model="model.shopInfo.phone" name="phone" placeholder="13800138000" required ng-pattern="/^(1[3|4|5|8]\d{9}|0755[\d]{7,8}|400[\d]{7})$/">
          <span ng-show="myform.phone.$invalid && istrue" style="color:#f00;">请输入正确的电话号码</span> <span ng-show="myform.phone.$error.required && istrue" style="color:#f00;">必填项</span> </div>
      </div>
      <div class="form-group margin-bottom10 clearfix">
        <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <span class="red">*</span><strong>网址:</strong> </label>
        <div class="col-xs-9">
          <input type="text" class="col-sm-3" ng-model="model.shopInfo.url" name="url" required placeholder="http://www.baidu.com" ng-pattern="/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/">
          <span ng-show="myform.url.$invalid && istrue" style="color:#f00;">请填写正确的链接</span> <span ng-show="myform.url.$error.required && istrue" style="color:#f00;">必填项</span> </div>
      </div>
      <div class="form-group margin-bottom10 clearfix">
        <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <span class="red">*</span><strong>商家描述:</strong> </label>
        <div class="col-sm-10">
          <textarea class="form-control ng-pristine ng-valid ng-valid-maxlength ng-touched" name="shopInfo[description]" ng-model="model.shopInfo.description" style="width:500px; height:120px;" ng-maxlength="100" placeholder="在此输入描述"></textarea>
        </div>
      </div>
      <div class="form-group margin-bottom10 clearfix">
        <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><span class="red">*</span> <strong>门店地图定位:</strong> </label>
        <div class="col-xs-9">
          <input type="text" class="width180" placeholder="请输入地址" ng-model="searchAddress"/>
          <a type="button" class="btn btn-primary" ng-click="search(searchAddress)">搜索</a></div>
      </div>
      <div class="form-group margin-bottom10 clearfix">
        <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong></strong> </label>
        <div class="col-xs-9"> <span>注意：这个只是模糊定位，准确位置请地图上标注!</span>
          <div id="l-map" style="width:605px; height:320px; margin:10px 0 0 0;" > <i class="icon-spinner icon-spin icon-large"></i> 地图加载中... </div>
          <div id="r-result">
            <input type="text" name="shopSub[lat]" ng-model="model.lat">
            <input type="text" name="shopSub[lng]" ng-model="model.lng">
          </div>
        </div>
      </div>
      <div class="space-6"></div>
      <div class="form-group margin-bottom10 clearfix">
        <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"></label>
        <div class="col-xs-9">
          <button class="btn btn-primary" ng-click="save()" id="submit">保存</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp&key=TDCBZXVQ34XQFUEDG6F37SBHT42FU5"></script>
<script src="/ace/js/provinceSelect.js"></script>
<script type="text/javascript">
  app.controller("mainController", function($scope, $http, $timeout, $rootScope){

      /*********************微信小店分类********************/
      $scope.model.shopInfo.wx_categories = $.isArray($scope.model.shopInfo.wx_categories) ? $scope.model.shopInfo.wx_categories : [];
      $scope.wxShopList = JSON.parse('<?= json_encode($wxshopList); ?>');
      var length = $scope.model.shopInfo.wx_categories.length;
      switch (length) {
          case 0:
              $scope.wxShopList.unshift({
                  id: -1,
                  name: '请选择分店'
              });
              $scope.wxShopListSelect = $scope.wxShopList[0];
              $scope.wxShopListSecond = [{
                  id: -1,
                  name: '请选择二级分店'
              }];
              $scope.wxShopListSecondSelect = $scope.wxShopListSecond[0];
              $scope.wxShopListThird = [{
                  id: -1,
                  name: '请选择三级分店'
              }];
              $scope.wxShopListThirdSelect = $scope.wxShopListThird[0];
              break;
          case 1:
              $scope.wxShopList.unshift({
                  id: -1,
                  name: '请选择分店'
              });
              $scope.wxShopListSelect = +$scope.model.shopInfo.wx_categories[0].id;
              getShopList($scope.wxShopListSelect, 'a');
              break;
          case 2:
              $scope.wxShopList.unshift({
                  id: -1,
                  name: '请选择分店'
              });
              $scope.wxShopListSelect = +$scope.model.shopInfo.wx_categories[0].id;
              getShopList($scope.wxShopListSelect, 'a', +$scope.model.shopInfo.wx_categories[1].id);
              break;
          case 3:
              $scope.wxShopList.unshift({
                  id: -1,
                  name: '请选择分店'
              });
              $scope.wxShopListSelect = +$scope.model.shopInfo.wx_categories[0].id;
              getShopList($scope.wxShopListSelect, 'a', +$scope.model.shopInfo.wx_categories[1].id, +$scope.model.shopInfo.wx_categories[2].id);
              break;
      }

      $scope.changeShopList = function(id) {
          if (id == -1) return;
          getShopList(id, 'a');
      };
      $scope.changeSecondShopList = function(id) {
          if (id == -1) return;
          getShopList(id);
      };

      function getShopList(id, str, secondId, thirdId) {
          $.post('/common/find-wxshop-category-ajax', {
              pid: id
          }, function(msg) {
              wsh.successback(msg, '', false, function() {
                  if (str) {
                      //二级
                      if (msg.errmsg.length) {
                          $scope.wxShopListSecond = msg.errmsg;
                          if (secondId) {
                              $scope.wxShopListSecondSelect = secondId;
                              getShopList(secondId, '', '', thirdId);
                          } else {
                              $scope.wxShopListSecondSelect = $scope.wxShopListSecond[0].id;
                              getShopList($scope.wxShopListSecondSelect);
                          }
                      } else {
                          $scope.wxShopListSecond = [{
                              id: -1,
                              name: '请选择二级分店'
                          }];
                          $scope.wxShopListSecondSelect = -1;
                          $scope.wxShopListThird = [{
                              id: -1,
                              name: '请选择三级分店'
                          }];
                          $scope.wxShopListThirdSelect = -1;
                      }
                      $scope.$apply();
                  } else {
                      //三级
                      if (msg.errmsg.length) {
                          $scope.wxShopListThird = msg.errmsg;
                          $scope.wxShopListThirdSelect = thirdId ? thirdId : $scope.wxShopListThird[0].id;
                      } else {
                          $scope.wxShopListThird = [{
                              id: -1,
                              name: '请选择三级分店'
                          }];
                          $scope.wxShopListThirdSelect = -1;
                      }
                      $scope.$apply();
                  }
              });
          }, 'json');
      };
      /*********************微信小店分类********************/
      $scope.chooseImageIndex = 0;
      $scope.istrue = false;
      $scope.model.shopInfo.province_id = $scope.model.shopInfo.province_id ? +$scope.model.shopInfo.province_id : - 1;
      getAddress('province', 'city', $scope.model.shopInfo.province_id, setProvince, true);
      $scope.provincedOption = JSON.parse('<?= json_encode($provinceList); ?>');
      $scope.cityIdOption = [];
      $scope.districtIdOption = [];
      $scope.circleIdOption = [];
      //请求省份
      $scope.provincedOption.unshift({
          id: -1,
          name: '请选择省'
      });

      $scope.changeProvince = function(a) {
          if (a == -1) return;
          getAddress('province', 'city', a, setProvince);
      };
      $scope.changeCityId = function(a){
          if(a == -1) return;
          getAddress('city', 'district', a, setCity);
      };

      function setProvince(data, isfirst) {
          $scope.cityIdOption = data.length ? data : [{id: -1, name: '请选择城市'}];
          if(isfirst){
              $scope.model.shopInfo.city_id = $scope.model.shopInfo.city_id ? +$scope.model.shopInfo.city_id : - 1;
          }else{
              if(data.length){
                  $scope.model.shopInfo.city_id = data[0].id;
              }else{
                  $scope.model.shopInfo.city_id = -1;
              }
          }
      }

      function setCity(data, isfirst) {
          $scope.districtIdOption = data.length ? data : [{id: -1, name: '请选择区'}];
          if(isfirst){
              $scope.model.shopInfo.district_id = $scope.model.shopInfo.district_id ? +$scope.model.shopInfo.district_id : - 1;
          }else{
              if(data.length){
                  $scope.model.shopInfo.district_id = data[0].id;
              }else{
                  $scope.model.shopInfo.district_id = -1;
              }
          }
      }

      function setDistrict(data, isfirst) {
          $scope.circleIdOption = data.length ? data : [{id: -1, name: '请选择商区'}];
          if(isfirst){
              $scope.model.shopInfo.circle_id = $scope.model.shopInfo.circle_id ? +$scope.model.shopInfo.circle_id : - 1;
          }else{
              if(data.length){
                  $scope.model.shopInfo.circle_id = data[0].id;
              }else{
                  $scope.model.shopInfo.circle_id = -1;
              }
          }
      }

      function getAddress(string, str, id, callback, isfirst) {
          $.post('/common/find-' + str + '-ajax', {
              id: id
          }, function(data) {
              if (data.errcode == 0) {
                  isfirst ? callback.call(this, data.errmsg, isfirst) : callback.call(this, data.errmsg);
                  $scope.$apply();
                  if (string == 'province') {
                      getAddress('city', 'district', $scope.model.shopInfo.city_id, setCity);
                  }
                  if (string == 'city') {
                      getAddress('district', 'circle', $scope.model.shopInfo.district_id, setDistrict);
                  }
              }
          }, 'json');
      }

      $scope.changeDistrictId = function(a) {
          if (a == -1) return;
          getAddress('district', 'circle', a, setDistrict);
      }

      //检测输入是否合法
      $scope.checkText = function(val, text){
          if(val) return alert(text);
      }
      //是否lbs
      $scope.islbs = $scope.model.shopInfo.lbs == 1;
      //腾迅地图
      tencent_map({
          lat: parseFloat($scope.model.lat),
          lng: parseFloat($scope.model.lng)
      });

      function tencent_map(data) {
          $("#lat").val(data.lat.toFixed(6));
          $("#lng").val(data.lng.toFixed(6));
          var lat, lng, address;
          if (data) {
              lat = data.lat;
              lng = data.lng;
          } else {
              lat = 39.916527;
              lng = 116.397128;
          }

          //地图初始化
          var center = new qq.maps.LatLng(lat, lng);
          var map = new qq.maps.Map("l-map", {
              center: center,
              minZoom: 5,
              maxZoom: 16,
              zoom: 12
          });

          //标记初始化
          var marker = new qq.maps.Marker({
              position: center,
              map: map,
              draggable: true
          });

          //地址解析
          var geocoder = new qq.maps.Geocoder();

          //拖动地图
          var prevlat = undefined;
          var currlat = undefined;
          var prevlng = undefined;
          var currlng = undefined;
          qq.maps.event.addListener(map, 'center_changed', function() {
              currlat = map.getCenter().lat;
              currlng = map.getCenter().lng;
              loadMap(currlat, currlng);
              //拖动地图，移动经过的点都会请求接口，请求太频繁，接口访问受限
              //codeLatLng(map.getCenter().lat, map.getCenter().lng);
          });
          setInterval(function(){
              if(currlat!==prevlat||currlng!==prevlng){
                  prevlat = currlat;
                  prevlng = currlng;
                  codeLatLng(prevlat, prevlng);
              }
          },2000);

          //移动标记
          qq.maps.event.addListener(marker, 'dragging', function() {
              $("#lat").val(marker.getPosition().lat.toFixed(6));
              $("#lng").val(marker.getPosition().lng.toFixed(6));
          });

          //移动标记结束（显示到地图中心）
          qq.maps.event.addListener(marker, 'dragend', function() {
              loadMap(marker.getPosition().lat, marker.getPosition().lng);
              codeLatLng(marker.getPosition().lat, marker.getPosition().lng);
          });

          //点击事件
          qq.maps.event.addListener(map, 'click', function(event) {
              loadMap(event.latLng.getLat(), event.latLng.getLng());
              codeLatLng(event.latLng.getLat(), event.latLng.getLng());
          });

          //搜索
          $("#positioning").on('click', function() {
              address = $("#suggestId").val();
              geocoder.getLocation(address);
              geocoder.setComplete(function(result) {
                  loadMap(result.detail.location.lat, result.detail.location.lng);
              });
              geocoder.setError(function() {
                  alert('出错了，请输入正确的地址！！！');
              });
          });

          function loadMap(lat, lng) {
              $("#lat").val(lat.toFixed(6));
              $("#lng").val(lng.toFixed(6));
              marker.setPosition(new qq.maps.LatLng(lat, lng));
              map.panTo(new qq.maps.LatLng(lat, lng));
          }

          //地址反解析

          function codeLatLng(lat, lng) {
              geocoder.getAddress(new qq.maps.LatLng(lat, lng));
              geocoder.setComplete(function(result) {
                  $("#suggestId").val(result.detail.address);
              });
          }
      }
      //地图结束
      $scope.$on('ImageChoose', function(e, json) {
          switch ($scope.chooseImageIndex) {
              case 0:
                  $scope.model.shopInfo.ewm_img = json[0].file_cdn_path;
                  break;
              case 1:
                  $scope.model.shopInfo.bg_img = json[0].file_cdn_path;
                  break;
              case 2:

                  break;
          }
      });
      $scope.save = function() {
          if ($scope.myform.$invalid) {
              $scope.istrue = true;
              return $timeout(function() {
                  $scope.istrue = false;
              }, 3000);
          }
          $scope.model.shopInfo.lbs = $scope.islbs ? 1 : 2;
          $scope.model.lat = $('#lat').val();
          $scope.model.lng = $('#lng').val();
          if ($scope.provinceId == -1) return alert('请选择商圈');
          if ($scope.wxShopListSelect == -1) return alert('请选择微信店铺');
          getCategories();
          $.ajax({
              type: "POST",
              url: wsh.url + "edit-ajax",
              data: $scope.model,
              dataType: "json",
              success: function(msg) {
                  wsh.successback(msg, '提交成功', false, function() {
                      window.location.href = wsh.url + 'index';
                  });
              },
              error: function() {
                  alert('服务器忙');
              }
          });
      };

      function getCategories() {
          $scope.model.shopInfo.wx_categories = [];
          $scope.model.shopInfo.wx_categories[0] = {
              id: $scope.wxShopListSelect,
              name: $('#wxShopListSelect option:selected').attr('label')
          };
          if ($scope.wxShopListSecondSelect != -1) {
              $scope.model.shopInfo.wx_categories[1] = {
                  id: $scope.wxShopListSecondSelect,
                  name: $('#wxShopListSecondSelect option:selected').attr('label')
              };
              if ($scope.wxShopListThirdSelect != -1) {
                  $scope.model.shopInfo.wx_categories[2] = {
                      id: $scope.wxShopListThirdSelect,
                      name: $('#wxShopListThirdSelect option:selected').attr('label')
                  };
              }
          }
      };
  });
</script>