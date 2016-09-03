(function () {

  'use strict';
  angular.module('myapp')
    .directive('chooseArea', chooseArea);//选择地区


  /**
   * @desc 选择地区
   * @example
   * <button id="area">选择地区</button>
   * <div choose-area="area" area-list="areaList" show-text="showText"></div> 避免样式冲突，最好将此处添加至最外层div下
   */

  function chooseArea($http) {
    return {
      restrict: 'A',
      scope: {
        areaList: '=',
        showText: '&'
      },
      replace: true,
      template: '<div class="bootbox modal fade in" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog2"><div class="modal-content">' +
      '<div class="modal-header"><a type="button" class="bootbox-close-button close" data-dismiss="modal">×</a><h4 class="modal-title">选择配送地区</h4></div>' +
      '<div class="modal-body"><div class="bootbox-body">' +
      '<div class="table-responsive clearfix"><h5>已选择:</h5><div ng-bind="areaText"></div>' +
      '<table class="table table-striped table-bordered  table-width">' +
      '<thead><tr class="center"><td width="8%">省、直辖市、自治区</td><td width="20%">选择地区</td></tr></thead>' +
      '<tbody><tr>' +
      '<td class="no-padding center"><div class="distribution"><ul id="provinceUl">' +
      '<li ng-repeat="province in provinceList"><a class="pointer text-decoration" ng-bind="province.name" ng-click="getCity(province)"></a></li>' +
      '</ul></div></td>' +
      '<td valign="top" class="align-top">' +
      '<label class="margin-left10">' +
      '<input type="checkbox" class="ace ng-pristine ng-valid ng-touched" ng-model="ischooseAll" ng-change="chooseAll(ischooseAll)">' +
      '<span class="lbl">全部<span ng-bind="selectedProvince.name"></span></span>' +
      '</label>' +
      '<div class="border-bottom padding-top10 margin-bottom10"></div>' +
      '<label class="margin-left10 margin-bottom5" ng-repeat="city in cityList">' +
      '<input type="checkbox" ng-model="city.ischoose" class="ace ng-pristine ng-valid ng-touched margin-left5" ng-click="chooseCity(city)">' +
      '<span class="lbl" ng-bind="city.name"></span>' +
      '</label>' +
      '</td>' +
      '</tr></tbody>' +
      '</table>' +
      '</div><div class="modal-footer"><a class="btn btn-default" data-dismiss="modal">取消</a><a data-bb-handler="confirm" class="btn btn-info" ng-click="clearAll()">清空</a><a data-bb-handler="confirm" class="btn btn-primary" ng-click="btnConfirm()">确定</a></div>' +
      '</div></div>' +
      '</div></div></div>',
      link: function (scope, element, attrs) {

        scope.areaList = scope.areaList || [];
        var selectedArea = [];

        $('#' + attrs.chooseArea).bind('click', function () {
          $(element).modal('show');
          selectedArea = angular.copy(scope.areaList);//选中的地区
          scope.areaText = scope.showText()(selectedArea);//根据选择的地区来展示文本值
          //查询省
          $http.post('../common/find-province-ajax', {})
            .success(function (msg) {
              wsh.successback(msg, '', false, function () {
                scope.provinceList = msg.errmsg;
                scope.getCity(scope.provinceList[0]);
              });
            });
        });

        //全选全不选
        scope.chooseAll = function (val) {
          scope.cityList.map(function (obj) {
            obj.ischoose = val;
          });
          if (val) {
            var hasProvince = false;
            selectedArea.map(function (area) {
              //找到就覆盖该省下的所有市
              if (area.province.id === scope.selectedProvince.id) {
                area.cityList = scope.cityList;
              }
            });
            //没有找到当前省就push
            if (!hasProvince) {
              selectedArea.push({province: scope.selectedProvince, cityList: scope.cityList});
            }
          } else {
            //找到该省移除该省
            selectedArea = selectedArea.filter(function (area) {
              if (area.province.id !== scope.selectedProvince.id) {
                return area;
              }
            });
          }
          scope.areaText = scope.showText()(selectedArea);
        };

        //获取市
        scope.getCity = function (obj) {
          scope.selectedProvince = obj;//设置选中的省
          scope.ischooseAll = false;//选中状态初始化
          $http.post('/common/find-city-ajax', {id: obj.id})
            .success(function (msg) {
              wsh.successback(msg, '', false, function () {
                selectedArea.map(function (area) {
                  //找到对应的省
                  if (area.province.id === scope.selectedProvince.id) {
                    //找到对应的市 设置其选中状态
                    area.cityList.map(function (city) {
                      msg.errmsg.map(function (_city) {
                        if (city.id === _city.id) {
                          _city.ischoose = city.ischoose;
                        }
                      });
                    });
                    //如果选中的市和该省下所有市的长度相等 说明全部被选中了
                    scope.ischooseAll = msg.errmsg.length === area.cityList.length;
                  }
                });
                scope.cityList = msg.errmsg;
              });
            });
        };

        //选择市
        scope.chooseCity = function (city) {
          if (city.ischoose) {
            var hasProvince = false;
            selectedArea.map(function (area) {
              //找到对应的省
              if (area.province.id === scope.selectedProvince.id) {
                hasProvince = true;
                var has = false;
                area.cityList.map(function (_city) {
                  if (_city.id === city.id) {
                    has = true;
                  }
                });
                //在该省下添加市
                if (!has) {
                  area.cityList.push(city);
                }
              }
            });
            //没找到对应的省 就添加省、市
            if (!hasProvince) {
              selectedArea.push({province: scope.selectedProvince, cityList: [city]});
            }
          } else {
            //移除对应的省下的市
            selectedArea.map(function (area) {
              if (area.province.id === scope.selectedProvince.id) {
                area.cityList = area.cityList.filter(function (_city) {
                  if (_city.id !== city.id) {
                    return _city;
                  }
                });
              }
            });
          }
          scope.areaText = scope.showText()(selectedArea);
        }

        //确定按纽
        scope.btnConfirm = function () {
          if (!scope.areaText) return alert('请选择地区!!');
          scope.areaList = angular.copy(selectedArea);
          scope.clearAll();//清空
          $(element).modal('hide');
        };

        //清空按纽
        scope.clearAll = function () {
          scope.ischooseAll = false;//全选状态初始化
          //初始化该省下所有市的选中状态
          scope.cityList.map(function (city) {
            city.ischoose = false;
          });
          selectedArea = [];//清空选中的区
          scope.areaText = '';//清空选中的区文本
        };
      }
    };
  }

  chooseArea.$inject = ['$http'];
})();

