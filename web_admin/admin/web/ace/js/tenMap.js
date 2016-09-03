//关联活动
app.directive('tenMap', function ($rootScope, userInfo) {
  return {
    restrict: 'EA',
    scope: {
      lat: '@lat',
      lng: '@lng'
    },
    template: '<div class="form-group clearfix">' +
    '<label class="col-sm-2 control-label"><span class="red">*</span> <strong>门店地图定位:</strong> </label>' +
    '<div class="col-sm-10">' +
    '<input type="text" class="width180" placeholder="请输入地址" id="suggestId"/>' +
    '<a type="button" class="btn btn-xs align-top btn-primary" id="positioning">搜索</a> <span>(用户在微信上发送"位置"时，显示当前门店的位置)</span> </div>' +
    '</div>' +
    '<div class="form-group margin-bottom10 clearfix">' +
    '<label class="col-sm-2 control-label"> <strong></strong> </label>' +
    '<div class="col-sm-10"> <span>注意：这个只是模糊定位，准确位置请地图上标注!</span>' +
    '<div id="l-map" style="width:605px; height:320px; margin:10px 0 0 0;"> <i class="icon-spinner icon-spin icon-large"></i> 地图加载中... </div>' +
    '<div id="r-result" class="margin-top5">' +
    '<input type="text" name="shopSub[lat]" id="lat">' +
    '<input type="text" name="shopSub[lng]" id="lng">' +
    '</div>' +
    '</div>' +
    '</div>',
    replace: false,
    link: function (scope, elem, attr) {
      tencent_map({
        lat: scope.lat ? parseFloat(scope.lat) : 39.916527,
        lng: scope.lng ? parseFloat(scope.lng) : 116.397128
      });

      function tencent_map(data) {
        $("#lat").val(data.lat.toFixed(12));
        $("#lng").val(data.lng.toFixed(12));
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
        codeLatLng(lat, lng);

        //拖动地图
        var prevlat = undefined;
        var currlat = undefined;
        var prevlng = undefined;
        var currlng = undefined;
        qq.maps.event.addListener(map, 'center_changed', function () {
          currlat = map.getCenter().lat;
          currlng = map.getCenter().lng;
          loadMap(currlat, currlng);
          //拖动地图，移动经过的点都会请求接口，请求太频繁，接口访问受限
          //codeLatLng(map.getCenter().lat, map.getCenter().lng);
        });
        setInterval(function () {
          if (currlat !== prevlat || currlng !== prevlng) {
            prevlat = currlat;
            prevlng = currlng;
            codeLatLng(prevlat, prevlng);
          }
        }, 2000);

        //移动标记
        qq.maps.event.addListener(marker, 'dragging', function () {
          $("#lat").val(marker.getPosition().lat.toFixed(12));
          $("#lng").val(marker.getPosition().lng.toFixed(12));

        });

        //移动标记结束（显示到地图中心）
        qq.maps.event.addListener(marker, 'dragend', function () {
          loadMap(marker.getPosition().lat, marker.getPosition().lng);
          codeLatLng(marker.getPosition().lat, marker.getPosition().lng);
        });

        //点击事件
        qq.maps.event.addListener(map, 'click', function (event) {
          loadMap(event.latLng.getLat(), event.latLng.getLng());
          codeLatLng(event.latLng.getLat(), event.latLng.getLng());
        });

        //搜索
        $("#positioning").on('click', function () {
          address = $("#suggestId").val();
          geocoder.getLocation(address);
          geocoder.setComplete(function (result) {
            loadMap(result.detail.location.lat, result.detail.location.lng);
          });
          geocoder.setError(function () {
            alert('出错了，请输入正确的地址！！！');
          });
        });

        function loadMap(lat, lng) {
          $("#lat").val(lat.toFixed(12));
          $("#lng").val(lng.toFixed(12));
          marker.setPosition(new qq.maps.LatLng(lat, lng));
          map.panTo(new qq.maps.LatLng(lat, lng));

        }

        //地址反解析
        function codeLatLng(lat, lng) {
          geocoder.getAddress(new qq.maps.LatLng(lat, lng));
          geocoder.setComplete(function (result) {
            $("#suggestId").val(result.detail.address);
          });
        }
      }

    }
  };
});