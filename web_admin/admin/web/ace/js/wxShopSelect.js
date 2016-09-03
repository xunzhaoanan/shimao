//关联活动
app.directive('wxShop', function($rootScope, $http, userInfo){
	return {
		restrict: 'E',
		scope: {
			wxshop: '=wxshop'
		},
		template: '<div class="col-xs-9">' +
          		'<select class="col-sm-1" id="wxShopFirstId" ng-model="wxshop[0].id" my-select ng-options="o.id as o.name for o in wxFirstSelect" ng-change="changeFirst(wxshop[0].id)"></select>' +
                 '<select class="col-sm-1 margin-left10" id="wxShopSecondId" ng-disabled="wxshop[0].id == -1" my-select ng-model="wxshop[1].id" ng-options="o.id as o.name for o in wxSecondSelect" ng-change="changeSecont(wxshop[1].id)"></select>' +
                 '<select class="col-sm-1 margin-left10" id="wxShopThirdId" ng-disabled="wxshop[0].id == -1" my-select ng-model="wxshop[2].id" ng-options="o.id as o.name for o in wxThirdSelect" ng-change="changeThird(wxshop[2].id)"></select>' +
        '</div>',
		replace: true,
		link: function(scope, elem, attr){
			var length = 3 - scope.wxshop.length;
			for(var i = 0; i < length; i++){
				scope.wxshop.push({});
			}
			scope.changeFirst = function(a) {
				$.extend(scope.wxshop[0], a);//console.log('aafadfa', scope.wxshop, scope.wxFirstSelect);
				if(a.id == -1) return;
				getAddress('first', a.id, setSecond);
			};
			scope.changeSecont = function(a){
				scope.wxshop[1] = a;
				if(a.id == -1) return;
				getAddress('second', a.id, setThird);
			};
			scope.changeThird = function(a){
				scope.wxshop[2] = a;
			};
			var aa = userInfo.wxShopList();
			aa.then(function(data){
				scope.wxFirstSelect = data;
				scope.wxFirstSelect.unshift({id: -1, name: '请选择一级分类'});
				if(scope.wxshop[0].id){
					scope.wxshop[0].id = +scope.wxshop[0].id;
					getAddress('first', scope.wxshop[0].id, setSecond, true);
				}else{
					scope.wxshop[0].id = -1;
					scope.wxSecondSelect = [{id: -1, name: '请选择二级分类'}];
					scope.wxshop[1].id = -1;
					scope.wxThirdSelect = [{id: -1, name: '请选择三级分类'}];
					scope.wxshop[2].id = -1;
				}
			});
			function setSecond(data, isfirst) {
				scope.wxSecondSelect = data.length ? data : [{id: -1, name: '请选择城市'}];
				if(isfirst){
					scope.wxshop[1].id = scope.wxshop[1].id ? +scope.wxshop[1].id : - 1;
				}else{
					if(data.length){
						scope.wxshop[1] = data[0];
					}else{
						scope.wxshop[1].id = -1;
					}
				}
			}
			function setThird(data, isfirst) {
				scope.wxThirdSelect = data.length ? data : [{id: -1, name: '请选择区'}];
				if(isfirst){
					scope.wxshop[2].id = scope.wxshop[2].id ? +scope.wxshop[2].id : - 1;
				}else{
					if(data.length){
						scope.wxshop[2] = data[0];
					}else{
						scope.wxshop[2].id = -1;
					}
				}
			}
			function getAddress(string, id, callback, isfirst) {
				$http.post('/common/find-wxshop-category-ajax', {pid: id})
                    .success(function(data) {
                        if (data.errcode == 0) {
                            isfirst ? callback.call(this, data.errmsg, isfirst) : callback.call(this, data.errmsg);
                            if (string == 'first') {
                                getAddress('second', scope.wxshop[1].id, setThird);
                            }
                        }
                    })
			}
		}
	};
});