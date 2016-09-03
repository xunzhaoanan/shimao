<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '修改终端店信息';
?>
<div class="main-container" id="main-container">
  <script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>
  <div class="main-container-inner">
    <?php
    echo $this->render('@app/views/side/mall.php');
    ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs"> 
        <script type="text/javascript">
              try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>
        <ul class="breadcrumb">
          <li>修改终端店信息</li>
        </ul>
        <!-- .breadcrumb --> 
        <!-- #nav-search --> 
      </div>
      <div class="page-content"> 
        <!-- /.page-header --> 
        <!-- PAGE CONTENT BEGINS -->
        
        <div class="row" ng-controller="mainController">
          <div class="col-xs-12">
            <div class="space-10"></div>
            <form novalidate name="myform">
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong>分店名称:</strong> </label>
                <div class="col-xs-9">
                  <input  type="text" class="css col-sm-3" ng-readonly="isnew" required name="name"  ng-maxlength="10">
                </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong>商品分类:</strong> </label>
                <div class="col-xs-9"> <span>文化玩乐</span> </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><span class="red">*</span> <strong>所属商圈:</strong> </label>
                <div class="col-xs-9">
                  <select class="col-sm-1" name="shopInfo[province_id]" ng-model="provinceId" ng-options="o.id as o.name for o in provincedOption" ng-change="changeProvince(provinceId)">
                  </select>
                  <select class="col-sm-1 margin-left10" ng-disabled="provinceId.id == '-1'" name="shopInfo[city_id]" ng-model="cityId" ng-options="o.id as o.name for o in cityIdOption" ng-change="changeCityId(cityId)">
                  </select>
                  <select class="col-sm-1 margin-left10" ng-disabled="cityId.id == '-1'" name="shopInfo[district_id]" ng-model="districtId" ng-options="o.id as o.name for o in districtIdOption" ng-change="changeDistrictId(districtId)">
                  </select>
                  <select class="col-sm-1 margin-left10" ng-disabled="districtId.id == '-1'" name="shopInfo[circle_id]" ng-model="circleId" ng-options="o.id as o.name for o in circleIdOption" ng-change="changeCircleId(circleId)">
                  </select>
                </div>
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
                  <input type="text" class="col-sm-3" ng-model="model.shopInfo.businesshour" name="businesshour" placeholder="09:00-21:00" required ng-pattern="/^[\d]{2,2}:00-[\d]{2,2}:00$/" >
                  <span ng-show="(myform.businesshour.$invalid || myform.businesshour.$error.required) && istrue" style="color:#f00;">输入有误</span> <span ng-show="myform.businesshour.$error.required && istrue" style="color:#f00;">必填项</span> </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><span class="red">*</span> <strong>电话:</strong> </label>
                <div class="col-xs-9">
                  <input type="text" class="col-sm-3" ng-model="model.shopInfo.phone" name="phone" placeholder="13800138000" required ng-pattern="" reg-mobile>
                  <span ng-show="myform.phone.$invalid && istrue" style="color:#f00;">{{$root.regMobileText}}</span> <span ng-show="myform.phone.$error.required && istrue" style="color:#f00;">必填项</span> </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong>网址:</strong> </label>
                <div class="col-xs-9">
                  <input type="text" class="col-sm-3" ng-model="model.shopInfo.url" name="url" required placeholder="http://www.baidu.com" ng-pattern="" reg-url>
                  <span ng-show="myform.url.$invalid && istrue" style="color:#f00;">{{$root.regUrlText}}</span> <span ng-show="myform.url.$error.required && istrue" style="color:#f00;">必填项</span> </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>兑换密码:</strong></label>
                <div class="col-xs-9">
                  <input type="text" class="col-sm-3"  required="required" >
                  (兑换优惠券、奖品使用) </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><span class="red">*</span> <strong>特色服务:</strong> </label>
                <div class="col-xs-9">
                  <textarea class="form-control" name="shopInfo[description]" ng-model="model.shopInfo.description" style="width:500px; height:120px;" ng-maxlength="100" placeholder="在此输入描述"></textarea>
                  （如：免费停车、免费甜点） </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>人均消费:</strong></label>
                <div class="col-xs-9">
                  <input type="text" class="col-sm-3"  required="required" >
                </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong>店铺图片:</strong> </label>
                <div class="col-sm-9">
                  <div class="ace-file-input col-sm-2 margin-right10 clearfix">
                    <label class="file-label" data-title="选择"> <a data-toggle="modal" data-target="#myModal" > <span class="file-name file-name2" data-title="点击上传图片..."> <i class="icon-upload-alt"></i> </span> </a> </label>
                  </div>
                  <span name="easyTip"> (上传店铺展示图片，建议选择640*340的图片，用户回复当前LBS位置时，默认显示附近门店相册的封面图片)</span> </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong></strong> </label>
                <div class="col-xs-9"> <img ng-src="{{model.shopInfo.bg_img}}" width="70" height="105" ng-show="model.shopInfo.bg_img"/> </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong>是否显示LBS:</strong> </label>
                <div class="col-xs-9">
                  <label>
                    <input type="checkbox" class="ace ace-switch ace-switch-6" name="shopInfo[lbs]" ng-model="islbs">
                    <span class="lbl"></span> </label>
                </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong>官网背景:</strong> </label>
                <div class="col-sm-9">
                  <div class="ace-file-input col-sm-2 margin-right10 clearfix">
                    <label class="file-label" data-title="选择"> <a data-toggle="modal" data-target="#myModal" > <span class="file-name file-name2" data-title="点击上传图片..."> <i class="icon-upload-alt"></i> </span> </a> </label>
                  </div>
                  <span name="easyTip">建议选择640*960图片</span> </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong></strong> </label>
                <div class="col-xs-9"> <img ng-src="{{model.shopInfo.bg_img}}" width="70" height="105" ng-show="model.shopInfo.bg_img"/> </div>
              </div>
              <!--  <div class="form-group margin-bottom10 clearfix">
        <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong>惊喜顶部图片:</strong> </label>
        <div class="col-sm-9">
          <div class="ace-file-input col-sm-2 margin-right10 clearfix">
            <label class="file-label" data-title="选择"> <a data-toggle="modal" data-target="#myModal" > <span class="file-name file-name2" data-title="点击上传图片..."> <i class="icon-upload-alt"></i> </span> </a> </label>
          </div>
          <span name="easyTip">建议选择640*320图片</span>
        </div>
      </div>
       <div class="form-group margin-bottom10 clearfix">
        <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong></strong> </label>
        <div class="col-xs-9"> <img ng-src="{{model.shopInfo.bg_img}}" width="70" height="105" ng-show="model.shopInfo.bg_img"/> </div>
      </div> -->
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"> <strong>商家描述:</strong> </label>
                <div class="col-xs-9">
                  <textarea class="form-control" name="shopInfo[description]" ng-model="model.shopInfo.description" style="width:500px; height:120px;" ng-maxlength="100" placeholder="在此输入描述"></textarea>
                </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><span class="red">*</span> <strong>门店地图定位:</strong> </label>
                <div class="col-xs-9">
                  <input type="text" class="width180" placeholder="请输入地址" ng-model="searchAddress"/>
                  <a type="button" class="btn btn-primary" ng-click="search(searchAddress)">搜索</a> <span>(用户回复当前LBS位置时显示最近分店的位置)</span> </div>
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
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>分享标题:</strong></label>
                <div class="col-xs-9">
                  <input type="text" class="col-sm-3"  required="required" >
                  (建议少于36个字) </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>分享内容:</strong></label>
                <div class="col-xs-9">
                  <input type="text" class="col-sm-3"  required="required" >
                  (建议少于50个字) </div>
              </div>
              <div class="form-group margin-bottom10 clearfix">
                <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>分享图片:</strong></label>
                <div class="col-xs-9"> <img class="share_pic_img" src="" style="width: 40px;height: 40px;" alt="分享logo">
                  <input type="hidden" class="hide" name="data[ShareManage][pic]" value="">
                  <div class="ace-file-input col-sm-2 margin-right10 clearfix">
                    <label class="file-label" data-title="选择"> <a data-toggle="modal" data-target="#myModal" > <span class="file-name file-name2" data-title="点击上传图片..."> <i class="icon-upload-alt"></i> </span> </a> </label>
                  </div>
                  <span name="easyTip" class="">（建议尺寸：200 × 200）</span> </div>
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
      </div>
    </div>
  </div>
</div>
<?php echo $this->render('@app/views/uploadImg/index.php'); ?> 
<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp&key=TDCBZXVQ34XQFUEDG6F37SBHT42FU5"></script> 
<script type="text/javascript">
  app.controller("mainController", function($scope, $http, $timeout, $rootScope){

    $scope.istrue = false;

    console.log($scope.model);
 
  $scope.cityIdOption = [];
    $scope.districtIdOption = [];
    $scope.circleIdOption = [];
    //请求省份
    $scope.provincedOption.unshift({id: -1, name: '请选择省'});
    $scope.provinceId = -1
    $scope.provincedOption.forEach(function(e, i){
      if(e.id == $scope.model.shopInfo.province_id){
        $scope.provinceId = e.id;
        return;
      }
    });
    $scope.changeProvince = function(a){
      if(a == -1) return;
      $scope.model.shopInfo.province_id = a;
      getAddress('province', 'city', a, setProvince);
    };
    function setProvince(data, isfirst){
      $scope.cityIdOption = data;
      $scope.cityId = isfirst ? $scope.model.shopInfo.city_id : data[0].id;
      isfirst ? $scope.model.shopInfo.city_id = data[0].id : void 0;
    }
    function setCity(data, isfirst){
      $scope.districtIdOption = data;
      $scope.districtId = isfirst ? $scope.model.shopInfo.district_id : data[0].id;
      isfirst ? $scope.model.shopInfo.district_id = data[0].id : void 0;
    }
    function setDistrict(data, isfirst){
      $scope.circleIdOption = data;
      $scope.circleId = isfirst ? $scope.model.shopInfo.circle_id : data[0].id;
      isfirst ? $scope.model.shopInfo.circle_id = data[0].id : void 0;
    }
    function getAddress(string, str, id, callback, isfirst){
      $.post('/common/find-' + str + '-ajax', {id: id}, 
      function(data){
      if(data.errcode == 0){
        isfirst ? callback.call(this, data.errmsg, isfirst) : 
       callback.call(this, data.errmsg);
       $scope.$apply();   
      if(string == 'province'){
        getAddress('city', 'district', $scope.cityId, setCity);
      }
      if(string == 'city'){
        getAddress('district', 'circle', $scope.districtId, setDistrict);
      }
      }
      }, 'json');
    }
    //城市地址的选择
    $scope.cityIdOption.unshift({id: -1, name: '请选择城市'});
    $scope.cityId = -1;
    $scope.cityIdOption.forEach(function(e, i){
      if(e.id == $scope.model.shopInfo.city_id){
        $scope.cityId = e.id;
        return;
      }
    });
    $scope.changeCityId = function(a){  
      if(a.id == -1) return;
      getAddress('city', 'district', a, setCity);
    }
    //区地址的选择
    $scope.districtIdOption.unshift({id: -1, name: '请选择区'});
    $scope.districtId = -1;
    $scope.districtIdOption.forEach(function(e, i){
      if(e.id == $scope.model.shopInfo.district_id){
        $scope.districtId = e.id;
        return;
      }
    }); 
    $scope.changeDistrictId = function(a){ 
      if(a.id == -1) return;
      getAddress('district', 'circle', a, setDistrict);
    }
    //城市地址的选择
    $scope.circleIdOption.unshift({id: -1, name: '请选择商区'});
    $scope.circleId = -1;
    $scope.circleIdOption.forEach(function(e, i){
      if(e.id == $scope.model.shopInfo.circle_id){
        $scope.circleId = e.id;
        return;
      }
    });
    $scope.changeCircleId = function(a){
      
    }
   //判断是新增页面  还是编辑页面  编辑页面  名称 加只读属性
    if((/edit/).test(window.location.href)){
    if($scope.provinceId != -1){
      getAddress('province', 'city', $scope.provinceId, setProvince);
    } 
    $scope.isnew = true;
  }
    //$scope.syncSetting = $scope.model.sync_setting == 1 ? 1 : 
    //是否lbs
    $scope.islbs = $scope.model.shopInfo.lbs == 1;
    var map = new BMap.Map("l-map"); 
    $scope.model.lat = $scope.model.lat ? $scope.model.lat : 117.10;
    $scope.model.lng = $scope.model.lng ? $scope.model.lng : 40.13;
    map.centerAndZoom(new BMap.Point($scope.model.lng, $scope.model.lat), 11); 
    map.addControl(new BMap.NavigationControl()); 
    map.addControl(new BMap.ScaleControl({anchor: BMAP_ANCHOR_BOTTOM_LEFT})); 
    map.addControl(new BMap.OverviewMapControl()); 
    var pointMarker = new BMap.Point($scope.model.lng, $scope.model.lat); // 创建标注的坐标 
    addMarker(pointMarker); 
    $('#l-map').find('.BMap_Marker div').css('overflow', 'visible');
    //搜索地址
    $scope.search = function(text){
      // 创建地址解析器实例 
      var myGeo = new BMap.Geocoder(); 
      // 将地址解析结果显示在地图上，并调整地图视野 
      myGeo.getPoint(text, function (point) { 
        if (point) { 
          map.centerAndZoom(point, 16); 
          $scope.model.lat = point.lat; 
          $scope.model.lng = point.lng; 
          var pointMarker = new BMap.Point($scope.model.lng, $scope.model.lat); 
          geocodeSearch(pointMarker); 
          map.addOverlay(new BMap.Marker(point));
          $scope.$apply();
        } 
        else{
          alert("搜索不到结果"); 
        }   
      }, "全国"); 
    } 
    map.enableScrollWheelZoom(); 
    map.addEventListener("click", function (e) { 
      $scope.model.lat = e.point.lat; 
      $scope.model.lng = e.point.lng; 
      map.clearOverlays(); 
      var pointMarker = new BMap.Point(e.point.lng, e.point.lat); // 创建标注的坐标 
      addMarker(pointMarker); 
      geocodeSearch(pointMarker); 
      $('#l-map').find('.BMap_Marker div').css('overflow', 'visible');
      $scope.$apply(); 
    }); 
    
    function addMarker(point) { 
      var myIcon = new BMap.Icon("/ace/images/mk_icon.png", new BMap.Size(21, 25), 
      { offset: new BMap.Size(21, 21), 
        imageOffset: new BMap.Size(0, 0) 
      }); 
      var marker = new BMap.Marker(point, { icon: myIcon }); 
      map.addOverlay(marker); 
    } 
    function geocodeSearch(pt) { 
      var myGeo = new BMap.Geocoder(); 
      myGeo.getLocation(pt, function (rs) { 
        var addComp = rs.addressComponents; 
      }); 
    }
    $scope.save = function(){
      if($scope.myform.$invalid){
        $scope.istrue = true;
        return $timeout(function(){$scope.istrue = false;}, 3000);
      }
      $scope.model.shopInfo.lbs = $scope.islbs ? 1 : 2;
      $.ajax({
       type: "POST",
       url: "/shop/edit-ajax",
       data: $scope.model,
       success: function(data){
       alert('提交成功');
       //window.location = '/shop/list';
       },
       error: function(){
        alert('服务器忙');    
       }
    });
    };
  });
</script>