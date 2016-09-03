//关联活动
app.directive('concat', function ($rootScope) {
	return {
		restrict: 'EA',
		scope: {
			model: '=model'
		},
		template: '<div class="form-group clearfix">' +
		'<label class="col-sm-2 control-label">关联活动：</label>' +
		'<div class="col-sm-10">' +
		'<select class="width120" ng-model="activitySelected" ng-disabled="hrefSelected" ng-options="o.id as o.name for o in activitySelect" ng-change="changeActivity(activitySelected)"></select>' +
		'</div>' +
		'</div><div class="form-group clearfix">' +
		'<label class="col-sm-2 control-label">关联链接：</label>' +
		'<div class="col-sm-10">' +
		'<input type="hidden" class="col-sm-6 no-float">' +
		'<select class="width120" ng-model="hrefSelected" ng-disabled="activitySelected" ng-options="o.id as o.name for o in hrefSelect" ng-change="changeHref(hrefSelected)"></select>' +
		'<input ng-show="hrefSelected == 8" type="text" class="col-sm-5 no-float" name="url" ng-blur="checkText(model.type_url)" ng-model="model.type_url" placeholder="请输入完整的url地址,例:http://">' +
		'</div>' +
		'</div>',
		replace: false,
		link: function (scope) {
			scope.checkText = function (val) {
				if (!(/^[A-Za-z][A-Za-z\d.+-]*:\/*(?:\w+(?::\w+)?@)?[^\s/]+(?::\d+)?(?:\/[\w#!:.?+=&%@\-/[\]$'()*,;~]*)?$/).test(val) || !val) {
					val ? alert('外部链接输入不合法') : alert('请输入外部链接');
					scope.model.errorText = true;
					return;
				} else {
					scope.model.errorText = false;
				}
			};
			scope.activitySelect = [{id: 0, name: '请选择类型'},
				//{id: 1, name: '代领众筹'},
				{id: 2, name: '点赞众筹'},
				{id: 3, name: '秒杀'},
				{id: 4, name: '微预约'},
				{id: 5, name: '红包'},
				{id: 6, name: '大转盘'},
				{id: 7, name: '砸金蛋'},
				{id: 8, name: '卡券'},
				{id: 9, name: '拼团'},
			];
			scope.activitySelected = 0;
			scope.changeActivity = function (id) {
				if (id) {
					$rootScope.chooseActivityIndex = id - 1;
					$('#activityModal').modal('toggle');
				} else {
					scope.model.model = '';
					scope.model.model_id = '';
				}
			};
			scope.$on('chooseActivity', function (e, obj, type) {
				scope.model.title = obj.name;
				scope.activitySelected = type + 1;
				switch (type) {
					//case 0:  //众筹代领
					//scope.model.model = '代领众筹';
					//scope.model.type_url = '/collect-receive/list?id=' + obj.id;
					//break;
					case 1:  //众筹点赞
						scope.model.model = '点赞众筹';
						scope.model.type_url = '/collect-zan/zan?id=' + obj.id;
						break;
					case 2:  //秒杀
						scope.model.model = '秒杀';
						scope.model.type_url = '/second-kill/list?id=' + obj.id;
						break;
					case 3:  //预约
						scope.model.model = '微预约';
						scope.model.type_url = '/reserve/detail?id=' + obj.id;
						break;
					case 4:  //红包
						if (obj.redPacketEvent.type == 1) { //群红包
							scope.model.model = '群红包';
							scope.model.type_url = '/grouppack/receive?id=' + obj.id;
						} else {  //接龙红包
							scope.model.model = '接龙红包';
							scope.model.type_url = '/transmit/receive?id=' + obj.id;
						}
						break;
					case 5: //大转盘
						scope.model.model = '大转盘';
						scope.model.type_url = '/market-activity/activity?id=' + obj.id;
						break;
					case 6: //砸金蛋
						scope.model.model = '砸金蛋';
						scope.model.type_url = '/market-activity/activity?id=' + obj.id;
						break;
					case 7: //卡券
						scope.model.model = '卡券';
						scope.model.type_url = '/card-coupons/card?id=' + obj.id;
						break;
					case 8: //拼团
						scope.model.model = '拼团';
						scope.model.type_url = '/together-buy/detail?id=' + obj.togetherBuy.togetherBuyGoods[0].id + '&act_id=' + obj.id;
						break;
				}
				scope.model.model_id = obj.id;
			});
			//链接关联
			scope.hrefSelect = [{id: 0, name: '请选择类型'},
				{id: 1, name: '微商城首页'},
				{id: 2, name: '微商城商品列表'},
				{id: 3, name: '微商城惊喜'},
				{id: 4, name: '微商城购物车'},
				{id: 5, name: '微商城个人中心'},
				{id: 6, name: '微推广'},
				{id: 7, name: '微官网'},
				{id: 8, name: '外链接'}];
			scope.hrefSelected = 0;
			var isEdit = (/edit\?id\=/).test(window.location.href);
			if (isEdit) {
				//初始化
				if (scope.model.model == '外链接') {
					scope.hrefSelected = 8;
					console.log(scope.model.type_url);
				} else {
					settype_url(scope.model.type_url);
				}
				function settype_url(url) {
					if ((/collect-receive/).test(url)) return scope.activitySelected = 1;
					if ((/collect-zan/).test(url)) return scope.activitySelected = 2;
					if ((/reserve/).test(url)) return scope.activitySelected = 4;
					if ((/(grouppack|transmit)/).test(url)) return scope.activitySelected = 5;
					if ((/second-kill/).test(url)) return scope.activitySelected = 3;
					if ((/market-activity/).test(url)) return scope.activitySelected = 6;
					if ((/card-coupons/).test(url)) return scope.activitySelected = 8;
					if ((/together-buy/).test(url)) return scope.activitySelected = 9;

					if ((/mall\/index/).test(url)) return scope.hrefSelected = 1;
					if ((/product\/category/).test(url)) return scope.hrefSelected = 2;
					if ((/surprise\/index/).test(url)) return scope.hrefSelected = 3;
					if ((/cart\/index/).test(url)) return scope.hrefSelected = 4;
					if ((/user\/home/).test(url)) return scope.hrefSelected = 5;
					if ((/fx\/apply/).test(url)) return scope.hrefSelected = 6;
					if ((/mall\/home/).test(url)) return scope.hrefSelected = 7;
				};
			}
			scope.changeHref = function (id) {
				if (id) {
					scope.model.title = '';
					switch (id) {
						case 1:
							scope.model.model = '微商城首页';
							scope.model.type_url = '/mall/index';
							scope.model.model_id = 1;
							break;
						case 2:
							scope.model.model = '微商城商品列表';
							scope.model.type_url = '/product/category';
							scope.model.model_id = 2;
							break;
						case 3:
							scope.model.model = '微商城惊喜';
							scope.model.type_url = '/surprise/index';
							scope.model.model_id = 3;
							break;
						case 4:
							scope.model.model = '微商城购物车';
							scope.model.type_url = '/cart/index';
							scope.model.model_id = 4;
							break;
						case 5:
							scope.model.model = '微商城个人中心';
							scope.model.type_url = '/user/home';
							scope.model.model_id = 5;
							break;
						case 6:
							scope.model.model = '微推广';
							scope.model.type_url = '/fx/apply';
							scope.model.model_id = '';
							break;
						case 7:
							scope.model.model = '微官网';
							scope.model.type_url = '/mall/home';
							scope.model.model_id = '';
							break;
						case 8:
							scope.model.model = '外链接';
							scope.model.model_id = '';
							scope.model.type_url = '';
							break;
					}
				} else {
					scope.model.model = '';
					scope.model.model_id = '';
				}
			};
		}
	};
});