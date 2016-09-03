//关联活动
app.directive('provinceSearch', function($rootScope, userInfo, $http, $parse, $compile){
	return {
		restrict: 'A',
		template:  '<div class="inline float-right margin-left10" style="margin-right:-1px;">' +
                     '<select class="width120" ng-model="district" ng-options="o.id as o.name for o in districtOption" ng-disabled="province == -1">' +
                     '</select>' +
                   '</div>' +
                  '<div class="inline float-right margin-left10" style="margin-right:-1px;">' +

                     '<select class="width120" ng-model="city" ng-options="o.id as o.name for o in cityOption" ng-disabled="province == -1">' +
                     '</select>' +
                   '</div>' +
                 '<div class="inline float-right" style="margin-right:-1px;">' +

                   '<select class="width120" ng-model="province" ng-options="o.id as o.name for o in provincedOption">' +
                   '</select>' +
                 '</div>',
		replace: false,
		link: function(scope, elem, attr){
			var aa = userInfo.provinceList();
            aa.then(function(data){
                scope.provincedOption = data;
                scope.provincedOption.unshift({id: -1, name: '请选择省'});
                scope.province = -1;
                scope.cityOption = [{id: -1, name: '请选择城市'}];
                scope.city = -1;
                scope.districtOption = [{id: -1, name: '请选择区'}];
                scope.district = -1;
            });
            var isSearch = $parse(attr.provinceSearch)(scope);
            if(isSearch){
                var search = '<div class="inline float-right margin-bottom10 margin-left10">' +
                    '<input class="min-width120 float-left" placeholder="" type="text" ng-model="searchText">' +
                    '<span class="float-left "> <a class="btn btn-xs btn-primary" ng-click="goSearch()"><i class="icon-search icon-on-right bigger-110"></i></a> </span>' +
                    '</div>';
                var template = angular.element(search);
                var mobileDialogElement = $compile(template)(scope);
                elem.prepend(mobileDialogElement);
            }
            scope.goSearch = function(){

            }
            scope.$watch('province', function(a){
                if(a != -1 && a){
                    getAddress('city', a, setCity)
                }else{
                    scope.cityOption = [{id: -1, name: '请选择城市'}];
                    scope.city = -1;
                    scope.districtOption = [{id: -1, name: '请选择区'}];
                    scope.district = -1;
                }
            })
            scope.$watch('city', function(a){
                if(a != -1 && a){
                    getAddress('district', a, setDistrict)
                }
            })
            scope.$watch('district', function(a){
                if(a != -1 && a){

                }
            })
            function setCity(data){
                if(data.length){
                    scope.cityOption = data;
                    scope.city = scope.cityOption[0].id;
                }
            }
            function setDistrict(data){
                if(data.length){
                    scope.districtOption = data;
                    scope.district = scope.districtOption[0].id;
                }
            }
            function getAddress(str, id, callback){
                $http.post('/common/find-' + str + '-ajax', {id: id})
                    .success(function(data){
                        if (data.errcode == 0) {
                            callback.call(this, data.errmsg);
                        }
                    })
            }
		}
	};
});