//关联活动
app.directive('province', function ($rootScope, userInfo, $http) {
  return {
    restrict: 'E',
    scope: {
      province: '=province',
      city: '=city',
      district: '=district',
      circle: '=circle'
    },
    template: '<div class="col-sm-10">' +
    '<select class="col-sm-1" id="provinceId" ng-model="province" ng-change="changeProvince(province)"><option value="{{o.id}}" ng-repeat="o in provincedOption" ng-bind="o.name" ng-selected="o.id==province"></option></select>' +
    '<select class="col-sm-1 margin-left10" id="cityId" ng-disabled="province == -1" ng-model="city" ng-change="changeCityId(city)"><option value="{{o.id}}" ng-repeat="o in cityIdOption" ng-bind="o.name" ng-selected="o.id==city"></option></select>' +
    '<select class="col-sm-1 margin-left10" id="districtId" ng-disabled="province == -1" ng-model="district" ng-change="changeDistrictId(district)"><option value="{{o.id}}" ng-repeat="o in districtIdOption" ng-bind="o.name" ng-selected="o.id==district"></option></select>' +
    '<select class="col-sm-1 margin-left10" id="circleId" ng-disabled="province == -1" ng-model="circle"><option value="{{o.id}}" ng-repeat="o in circleIdOption" ng-bind="o.name" ng-selected="o.id==circle"></option></select>' +
    '</div>',
    replace: true,
    link: function (scope, elem, attr) {
      var aa = userInfo.provinceList();
      aa.then(function (data) {
        scope.provincedOption = data;
        scope.provincedOption.unshift({id: -1, name: '请选择省'});
        if (scope.province) {
          scope.province = +scope.province;
          getAddress('province', 'city', +scope.province, setProvince, true);
        } else {
          scope.province = -1;
          scope.cityIdOption = [{id: -1, name: '请选择城市'}];
          scope.city = -1;
          scope.districtIdOption = [{id: -1, name: '请选择区'}];
          scope.district = -1;
          scope.circleIdOption = [{id: -1, name: '请选择商区'}];
          scope.circle = -1;
        }
      });

      scope.changeProvince = function (a) {
        if (a == -1) {
          scope.province = -1;
          scope.cityIdOption = [{id: -1, name: '请选择城市'}];
          scope.city = -1;
          scope.districtIdOption = [{id: -1, name: '请选择区'}];
          scope.district = -1;
          scope.circleIdOption = [{id: -1, name: '请选择商区'}];
          scope.circle = -1;
          return;
        }
        getAddress('province', 'city', a, setProvince);
      };
      scope.changeCityId = function (a) {
        if (a == -1) return;
        getAddress('city', 'district', a, setCity);
      };
      scope.changeDistrictId = function (a) {
        if (a == -1) return;
        getAddress('district', 'circle', a, setDistrict);
      };

      function setProvince(data, isfirst) {
        scope.cityIdOption = data.length ? data : [{id: -1, name: '请选择城市'}];
        if (isfirst) {
          scope.city = scope.city ? +scope.city : -1;
        } else {
          if (data.length) {
            scope.city = data[0].id;
          } else {
            scope.city = -1;
          }
        }
      }

      function setCity(data, isfirst) {
        scope.districtIdOption = data.length ? data : [{id: -1, name: '请选择区'}];
        if (isfirst) {
          scope.district = scope.district ? +scope.district : -1;
        } else {
          if (data.length) {
            scope.district = data[0].id;
          } else {
            scope.district = -1;
          }
        }
      }

      function setDistrict(data, isfirst) {
        scope.circleIdOption = data.length ? data : [{id: -1, name: '请选择商区'}];
        if (isfirst) {
          scope.circle = scope.circle ? +scope.circle : -1;
        } else {
          if (data.length) {
            scope.circle = data[0].id;
          } else {
            scope.circle = -1;
          }
        }
      }

      function getAddress(string, str, id, callback, isfirst) {
        $http.post('/common/find-' + str + '-ajax', {id: id})
          .success(function (data) {
            if (data.errcode == 0) {
              isfirst ? callback.call(this, data.errmsg, isfirst) : callback.call(this, data.errmsg);
              if (string == 'province') {
                getAddress('city', 'district', scope.city, setCity, isfirst);
              }
              if (string == 'city') {
                getAddress('district', 'circle', scope.district, setDistrict, isfirst);
              }
            }
          })
      }
    }
  };
});