(function () {

  'use strict';

  angular.module('myapp')
    .directive('chooseCard', chooseCard)//选择卡券，多选，最多选择10条数据
    .directive('chooseFitstore', chooseFitstore)//适用门店
    .directive('chooseLevel', chooseLevel)//选择等级
    .directive('chooseGroup', chooseGroup)//选择分组
    .directive('chooseTag', chooseTag)//选择标签
    .directive('chooseArea', chooseArea)//选择地区
    .directive('chooseGoods', chooseGoods)//商品
    .directive('sinceStore', sinceStore);//自提门店

  function sinceStore($http) {
    return {
      restrict: 'A',
      scope: {
        //stroelists: '=stroelists',
        //pageoption: '=pageoption'
      },
      replace: true,
      template: '<div class="modal fade newmode" id="newstore" tabindex="-1" role="dialog"             aria-labelledby="query"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button style="line-height: 24px !important;" type="button"                        class="bootbox-close-button close"                        data-dismiss="modal">&times;</button><h4 style="line-height: 24px !important;" class="modal-title"><span>添加自提门店</span><small class="white">(只能设置直营店为自提门店)</small></h4></div><div class="modal-body "><div class="row margin-bottom10 margin-left10"><div class="pull-right"><div class="inline float-right margin-bottom10 margin-left10"><input class="min-width120 float-left" placeholder="按自提店名称搜索" type="text"                             ng-model="searchText"><span class="float-left "><a class="btn btn-xs btn-primary"   ng-click="searchBtn()"><i   class="icon-search icon-on-right bigger-110"></i></a></span></div><div class="inline float-right margin-left10" style="margin-left:-1px;"><select class="width120" ng-model="district"                              ng-options="o.id as o.name for o in districtOption"                              ng-disabled="province == -1"></select></div><div class="inline float-right margin-left10" style="margin-left:-1px;"><select class="width120" ng-model="city"                              ng-options="o.id as o.name for o in cityOption"                              ng-disabled="province == -1"></select></div><div class="inline float-right" style="margin-left:-1px;"><select class="width120" ng-model="province"                              ng-options="o.id as o.name for o in provincedOption"></select></div></div></div><form class="form-horizontal"><table                      class="table table-striped table-bordered table-hover table-width action-buttons margin-bottom10"><thead><tr><th width="10%" class="text-center"><label class="pos-rel"><input class="ace ng-valid ng-dirty ng-valid-parse ng-touched"              type="checkbox"  ng-model="ischooseAll"  ng-click="chooseAll(ischooseAll)"/><span class="lbl"></span></label></th><th width="20%" class="text-center">自提门店名称</th><th width="50%" class="text-center" style="width:280px;">自提门店地址</th><th width="20%" class="text-center">联系电话</th></tr></thead><tbody><tr ng-repeat="list in cardLists" ng-show="!list.isshow"><td width="10%" class="text-center"><label class="pos-rel"><input class="ace " type="checkbox" ng-model="list.ischeck"                                 ng-click="checkSingle(list,1)"/><span class="lbl"></span></label></td><td width="10%" class="text-center" ng-bind="list.shopInfo.name"                          ng-click="checkSingle(list,2)"></td><td width="10%" class="text-center" ng-bind="list.shopInfo.address"                          ng-click="checkSingle(list,2)"></td><td width="10%" class="text-center" ng-bind="list.shopInfo.phone"                          ng-click="checkSingle(list,2)"></td></tr><tr><td colspan="4" ng-show="!cardLists.length" class="text-center red">                        暂时没有可显示的数据</td></tr></tbody></table></form><div ng-paginate options="options" page="page"></div></div><div class="modal-footer"><a ng-click="cancelBtn()" class="btn btn-default" data-dismiss="modal">取消</a><a class="btn btn-primary" ng-click="cardBtn()">确定</a></div></div></div></div>',
      link: function (scope, element, attrs) {

        scope.cardArray = {
          add: [],
          del: []
        };
        $('#' + attrs.sinceStore).bind('click', function () {
          cardList(1);
          scope.options = {page: 'page', callback: cardList};
          $(element).modal('show');
        });

        $http.post('/common/find-province-ajax')
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              scope.provincedOption = [];
              scope.province = -1;
              scope.provincedOption = msg.errmsg;
              scope.provincedOption.unshift({id: -1, name: '请选择省'});
            });
          });
        scope.cityOption = [{id: -1, name: '请选择城市'}];
        scope.city = -1;
        scope.districtOption = [{id: -1, name: '请选择区'}];
        scope.district = -1;
        scope.$watch('province', function (a) {
          if (a != -1 && a) {
            getAddress('city', a, setCity)
          } else {
            scope.cityOption = [{id: -1, name: '请选择城市'}];
            scope.city = -1;
            scope.districtOption = [{id: -1, name: '请选择区'}];
            scope.district = -1;
          }
        })
        scope.$watch('city', function (a) {
          if (a != -1 && a) {
            getAddress('district', a, setDistrict)
          }
        })
        scope.$watch('district', function (a) {
          if (a != -1 && a) {

          }
        })
        function setCity(data) {
          if (data.length) {
            scope.cityOption = data;
            scope.city = scope.cityOption[0].id;
          }
        }

        function setDistrict(data) {
          if (data.length) {
            scope.districtOption = data;
            scope.district = scope.districtOption[0].id;
          }
        }

        function getAddress(str, id, callback) {
          $http.post('/common/find-' + str + '-ajax', {id: id})
            .success(function (data) {
              if (data.errcode == 0) {
                callback.call(this, data.errmsg);
              }
            })
        }


        scope.ischooseAll = false;

        //单选
        scope.checkSingle = function (obj, index) {
          if (index == 2) {
            obj.ischeck = obj.ischeck;
          } else {
            obj.ischeck = !obj.ischeck;
          }
          if (obj.ischeck) {
            if (scope.cardArray.add.indexOf(obj.id) > -1) {
              scope.cardArray.add.splice(scope.cardArray.add.indexOf(obj.id), 1);
            } else {
              scope.cardArray.del.push(obj.id);
            }
          } else {
            if (scope.cardArray.del.indexOf(obj.id) > -1) {
              scope.cardArray.del.splice(scope.cardArray.del.indexOf(obj.id), 1);
            } else {
              scope.cardArray.add.push(obj.id);
            }
          }
          obj.ischeck = !obj.ischeck;
        }

        //全选
        scope.chooseAll = function (check) {
          $.each(scope.cardLists, function (i, obj) {
            if (obj.ischeck != check) {
              scope.checkSingle(obj, 2);
            }
          });
        }
        scope.cancelBtn = function () {
          scope.cardArray = {
            add: [],
            del: []
          };
          $(element).modal('toggle');
        }
        scope.cardBtn = function () {
          var flag = 1;
          if (scope.cardArray.add.length || scope.cardArray.del.length) {
            if (scope.cardArray.add.length) {
              $http.post('/shop/create-self-pickup-sub-ajax', {
                "shop_sub_id": scope.cardArray.add
              })
                .success(function (msg) {
                  wsh.successback(msg, '', false, function () {
                    scope.cardArray.add = [];
                    if (flag == 1) {
                      $(element).modal('toggle');
                      flag++;
                      //getData(1);
                      window.location.reload();
                    }
                  });
                });
            }
            if (scope.cardArray.del.length) {
              $http.post('/shop/del-self-pickup-sub-ajax', {
                "shop_sub_id": scope.cardArray.del
              })
                .success(function (msg) {
                  wsh.successback(msg, '', false, function () {
                    scope.cardArray.del = [];
                    if (flag == 1) {
                      $(element).modal('toggle');
                      flag++;
                      window.location.reload();
                      //getData(1);
                    }
                  });
                });
            }
          } else {
            $(element).modal('toggle');
            window.location.reload();
          }
        }
        scope.searchBtn = function () {
          cardList(1);
        }

        //function getData(int) {
        //  $http.post('/shop/find-self-pickup-sub-ajax', {
        //    "_page": int,
        //    "_page_size": 10
        //  })
        //    .success(function (msg) {
        //      wsh.successback(msg, '', false, function () {
        //        scope.stroelists = msg.errmsg.data;
        //        scope.pageoption = msg.errmsg.page;
        //      });
        //    });
        //};

        function cardList(int) {
          $http.post("/terminal/list-ajax", {
            "_page": int,
            "_page_size": 10,
            "province_id": scope.province,
            "city_id": scope.city,
            "district_id": scope.district,
            "name": scope.searchText,
            "is_search": true
          }).success(function (msg) {
            scope.cardLists = msg.errmsg.data;
            scope.page = msg.errmsg.page;


            for (var i in scope.cardLists) {
              scope.cardLists[i].ischeck = true;
              if (JSON.stringify(scope.cardLists[i].shopSelfPickupSub) == '[]') {
                scope.cardLists[i].ischeck = false;
              }
              if (scope.cardArray.add.indexOf(scope.cardLists[i].id) > -1) {
                scope.cardLists[i].ischeck = true;
              }
              if (scope.cardArray.del.indexOf(scope.cardLists[i].id) > -1) {
                scope.cardLists[i].ischeck = false;
              }

            }

          });
        };
      }
    };
  }

  sinceStore.$inject = ['$http'];


  /**
   * @desc 选择等级
   * @example
   * <button id="level">选择等级</button>
   * <div choose-level="level" list="levelList"></div> 避免样式冲突，最好将此处添加至最外层div下
   */
  function chooseLevel($http) {
    return {
      restrict: 'A',
      scope: {
        list: '='
      },
      replace: true,
      template: '<div class="bootbox modal fade in" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog1"><div class="modal-content"><div class="modal-header"><a type="button" class="bootbox-close-button close" data-dismiss="modal">×</a><h4 class="modal-title">选择等级</h4></div><div class="modal-body"><div class="clearfix"><div class="table-responsive col-sm-12 no-padding ddlb">' +
      '<table class="table table-striped table-bordered table-hover df">' +
      '<thead><tr><th width="3%" class="text-center"><label><input type="checkbox" class="ace" ng-model="checked" ng-click="checkAll()"><span class="lbl"></span></label></th><th class="text-align" width="7%">序号</th><th class="text-align" width="10%">等级名称</th><th class="text-align" width="5%">等级图片</th></tr></thead>' +
      '<tr ng-repeat="grade in gradeLists" ng-show="gradeLists.length" ng-click="check(grade)"><td class="text-align"><label><input type="checkbox" class="ace" ng-model="grade.checked" ng-click="check(grade,false,$event)"><span class="lbl"></span></label></td><td class="text-align" ng-bind="$index+1"></td><td class="text-align" ng-bind="grade.name"></td><td class="text-align"><img ng-src="{{grade.face.file_cdn_path}}" style="height: 50px; width: 50px;"></td></tr><tr><td colspan="4" ng-show="!gradeLists.length" class="red text-center">暂时没有可展示的数据</td></tr></table>' +
      '<div ng-paginate options="gradeoptions" page="gradePage"></div></div></div></div><div class="modal-footer"><a type="button" class="btn btn-default" ng-click="cancel()">取消</a><a type="button" class="btn btn-primary" ng-click="confirm()">确定</a></div></div></div></div>',
      link: function (scope, element, attrs) {

        var list = [];//选中的值
        scope.list = scope.list || [];

        $('#' + attrs.chooseLevel).bind('click', function () {
          list = angular.copy(scope.list);
          search(1);
          $(element).modal('show');
        });

        //查询
        function search(page) {
          $http.post('../members/find-grade-ajax', {
            _page: page,
            _page_size: 10,
            name: ''
          }).success(
            function (msg) {
              wsh.successback(msg, '', false, function () {
                var cnt = 0;
                msg.errmsg.data.map(function (d) {
                  list.map(function (l) {
                    if (l.id === d.id) {
                      d.checked = l.checked;
                      cnt++;
                    }
                  });
                });
                scope.checked = msg.errmsg.data.length === cnt;
                scope.gradeLists = msg.errmsg.data;
                scope.gradePage = msg.errmsg.page;
              });
            }
          );
        };

        //分页配置项
        scope.gradeoptions = {callback: search};

        //选中全部
        scope.checkAll = function () {
          scope.gradeLists.map(function (obj) {
            obj.checked = scope.checked;
            scope.check(obj, true);
          });
        };

        //选中
        scope.check = function (obj, checkAll, event) {
          if (event) {
            event.stopPropagation();
          } else if (!checkAll) {
            obj.checked = !obj.checked;
          }
          if (obj.checked) {
            var temp = list.filter(function (_obj) {
              if (_obj.id === obj.id) {
                return _obj;
              }
            });
            //如果没有找到就添加
            if (!temp.length) {
              list.push(obj);
            }
          } else {
            //过滤取消的值
            list = list.filter(function (_obj) {
              if (_obj.id !== obj.id) {
                return _obj;
              }
            });
          }
          //如果不是全选按钮调用的
          if (!checkAll) {
            //如果当前页的数据都被选中 则自动选中全选按钮
            scope.checked = scope.gradeLists.length === scope.gradeLists.filter(function (obj) {
                if (obj.checked) {
                  return obj;
                }
              }).length;
          }
        };

        //确定
        scope.confirm = function () {
          scope.list = angular.copy(list);
          $(element).modal('hide');
        };

        //取消
        scope.cancel = function () {
          scope.checked = false;
          scope.gradeLists.map(function (obj) {
            obj.checked = false;
          });
          $(element).modal('hide');
        };
      }
    };
  }

  chooseLevel.$inject = ['$http'];


  /**
   * @desc 门店
   * @example
   * <span id="storeBtn" class="btn btn-xs btn-primary">选择门店</span>
   * <div choose-card="card"></div>
   */
  function chooseFitstore($http) {
    return {
      restrict: 'A',
      scope: {
        optionstore: '=optionstore',
        cardData: '=cardData'
      },
      replace: true,
      template: '<div class="bootbox modal fade in" id="cardModal" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true" ng-cloak><div class="modal-dialog modal-dialog2"><div class="modal-content"><form name="myform" novalidate="novalidate"><div class="modal-header"><a class="bootbox-close-button close" data-dismiss="modal">×</a><h4 class="modal-title">适用门店</h4></div><div class="modal-body"><div class="bootbox-body"><div class="table-responsive pre-scrollable clearfix"><div class="input-group margin-bottom10 float-right"><input class="col-sm-8 float-left" placeholder="请输入门店名称" type="text" ng-model="searchName"><a ng-click="searchBtn()" class="btn btn-xs btn-primary "><i class="icon-search icon-on-right bigger-110"></i></a></div><table class="table table-striped table-bordered table-hover table-width"><thead><tr><td class="lt-width3 text-center"><label><input type="checkbox" class="ace" ng-model="ischooseAll" ng-click="chooseAll(ischooseAll)"><span class="lbl"></span></label></td><th width="25%" class="text-center">门店名称</th><th width="10%" class="text-center">地址</th></tr></thead><tbody><tr ng-repeat="list in cardLists" ng-show="!list.isShow" ng-click="checkList(list,$index)"><td class="lt-width3 text-center" style="position: relative;"><label><input type="checkbox" class="ace"  ng-model="list.ischeck"  ng-click="checkSingle(list,1)"><span  class="lbl"></span></label></td><td class="text-center" ng-click="checkSingle(list,2)"  ng-bind="list.shopInfo.name"></td><td class="text-center" ng-click="checkSingle(list,2)" ng-bind="list.shopInfo.address"></td></tr><tr><td colspan="3" ng-show="!cardLists.length"  class="red text-center" ng-cloak>暂无数据</td></tr></tbody></table><div ng-paginate options="options" page="page"></div></div></div></div><div class="modal-footer"><a class="btn btn-default"  data-dismiss="modal">取消</a><a  class="btn btn-primary" ng-click="cardBtn()">确定</a></div></form></div></div></div>',
      link: function (scope, element, attrs) {

        scope.cardArray = [];

        $('#' + attrs.chooseFitstore).bind('click', function () {
          scope.cardArray = angular.copy(scope.cardData);
          cardList(1);
          scope.options = {page: 'page', callback: cardList};
          $(element).modal('show');

        });

        scope.ischooseAll = false;

        //单选
        scope.checkSingle = function (obj, index) {
          if (index == 2)
            obj.ischeck = !obj.ischeck;
          if (obj.ischeck) {
            scope.cardArray.push(obj);
          } else {
            $.each(scope.cardArray, function (a, b) {
              if (b) {
                if (b.id == obj.id) {
                  scope.cardArray.splice(a, 1);
                }
              }
            });
          }
        }
        //全选
        scope.chooseAll = function (check) {
          if (check) {
            $.each(scope.cardLists, function (i, e) {
              e.ischeck = check;
              scope.cardArray.push(e);
            });
          } else {
            for (var i in scope.cardArray) {
              for (var j in scope.cardLists) {
                if (scope.cardArray[i].id == scope.cardLists[j].id) {
                  scope.cardLists[j].ischeck = check;
                  scope.cardArray.splice(i, 1);
                }
              }
            }
          }
          scope.cardArray = wsh.unique(scope.cardArray, 'id');
        }
        scope.cardBtn = function () {
          if (!scope.cardArray.length) return alert('请选择门店!');
          scope.cardData = angular.copy(scope.cardArray);
          scope.optionstore.cardSave(scope.cardData);
          $(element).modal('toggle');
        }
        scope.searchBtn = function () {
          cardList(1);
        }
        function cardList(int) {
          $http.post("/card-coupons/shop-sub-list-ajax", {
            "name": scope.searchName,
            "_page": int,
            "_page_size": 5
          }).success(function (msg) {
            scope.cardLists = msg.errmsg.data;
            scope.page = msg.errmsg.page;

            for (var i in scope.cardLists) {
              for (var j in scope.cardArray) {
                if (scope.cardLists[i].id == scope.cardArray[j].id) {
                  scope.cardLists[i].ischeck = true;
                  continue;
                }
              }
            }
            scope.ischooseAll = false;
          });
        };
      }
    };
  }

  chooseFitstore.$inject = ['$http'];


  /**
   * @desc 选择卡券
   * @example
   * <span id="card" class="btn btn-xs btn-primary">选择卡券</span>
   * <div choose-card="card"></div>
   */
  function chooseCard($http) {
    return {
      restrict: 'A',
      scope: {
        optionscard: '=optionscard',
        cardData: '=cardData'
      },
      replace: true,
      template: '<div class="bootbox modal fade in" id="cardModal" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true" ng-cloak><div class="modal-dialog modal-dialog2"><div class="modal-content"><form name="myform" novalidate="novalidate"><div class="modal-header"><a class="bootbox-close-button close" data-dismiss="modal">×</a><h4 class="modal-title">关联卡券</h4></div><div class="modal-body"><div class="bootbox-body"><div class="table-responsive pre-scrollable clearfix"><div class="input-group margin-bottom10 float-right"><input class="col-sm-8 float-left" placeholder="请输入卡券名称" type="text" ng-model="searchName"><a ng-click="searchBtn()" class="btn btn-xs btn-primary "><i class="icon-search icon-on-right bigger-110"></i></a></div><table class="table table-striped table-bordered table-hover table-width"><thead><tr><td class="lt-width3 text-center"><label><input type="checkbox" class="ace" ng-model="ischooseAll" ng-click="chooseAll(ischooseAll)"><span class="lbl"></span></label></td><th width="25%" class="text-center">卡券名称</th><th width="10%" class="text-center">卡券类型</th><th width="10%" class="text-center">使用平台</th><th width="27%" class="text-center">有效期</th><th width="8%" class="text-center">库存数</th></tr></thead><tbody><tr ng-repeat="list in cardLists" ng-show="!list.isShow" ng-click="checkList(list,$index)"><td class="lt-width3 text-center" style="position: relative;"><label><input type="checkbox" class="ace" ng-model="list.ischeck" ng-click="checkSingle(list,1)"><span class="lbl"></span></label></td><td class="text-center" ng-click="checkSingle(list,2)" ng-bind="list.title"></td><td class="text-center" ng-click="checkSingle(list,2)" ng-bind="wxCardType(list.wx_card_type)"></td><td class="text-center" ng-click="checkSingle(list,2)" ng-bind="cardType(list.card_type)"></td><td class="text-center" ng-click="checkSingle(list,2)" ng-if="list.date_info_type==1"><div ng-bind="list.begin*1000 | date:\'yyyy-MM-dd HH:mm:ss\'"></div>                      至<div ng-bind="list.end*1000 | date:\'yyyy-MM-dd HH:mm:ss\'"></div></td><td class="text-center" ng-click="checkSingle(list,2)" ng-if="list.date_info_type==2"> 领取后<span ng-bind="list.begin == 0 ? \'当\' : list.begin"></span>天生效,<span ng-bind="list.end"></span>{{}}天有效</td><td class="text-center" ng-click="checkSingle(list,2)" ng-bind="list.stock"></td></tr><tr><td colspan="6" ng-show="!cardLists.length" class="red text-center" ng-cloak>暂无数据</td></tr></tbody></table><div ng-paginate options="options" page="page"></div></div></div></div><div class="modal-footer"><a class="btn btn-default" data-dismiss="modal">取消</a><a class="btn btn-primary" ng-click="cardBtn()">确定</a></div></form></div></div></div>',
      link: function (scope, element, attrs) {

        scope.cardArray = [];
        $('#' + attrs.chooseCard).bind('click', function () {
          scope.cardArray = angular.copy(scope.cardData);
          cardList(1);
          scope.options = {page: 'page', callback: cardList};
          $(element).modal('show');
        });

        scope.ischooseAll = false;

        //单选
        scope.checkSingle = function (obj, index) {
          if (index == 2)
            obj.ischeck = !obj.ischeck;
          if (obj.ischeck) {
            scope.cardArray.push(obj);
          } else {
            $.each(scope.cardArray, function (a, b) {
              if (b) {
                if (b.id == obj.id) {
                  scope.cardArray.splice(a, 1);
                }
              }
            });
          }
        }
        //全选
        scope.chooseAll = function (check) {
          if (check) {
            $.each(scope.cardLists, function (i, e) {
              e.ischeck = check;
              scope.cardArray.push(e);
            });
          } else {
            for (var i in scope.cardArray) {
              for (var j in scope.cardLists) {
                if (scope.cardArray[i].id == scope.cardLists[j].id) {
                  scope.cardLists[j].ischeck = check;
                  scope.cardArray.splice(i, 1);
                }
              }
            }
          }
          scope.cardArray = wsh.unique(scope.cardArray, 'id');
        }
        scope.cardBtn = function () {
          if (!scope.cardArray.length) return alert('请选择卡券!');
          scope.cardData = angular.copy(scope.cardArray);
          scope.optionscard.cardSave(scope.cardData);
          $('#cardModal').modal('toggle');
        }
        scope.searchBtn = function () {
          cardList(1);
        }
        function cardList(int) {
          $http.post("/card-coupons/list-ajax", {
            "_name": scope.searchName,
            "_page": int,
            "_page_size": 5,
            "valid": true
          }).success(function (msg) {
            scope.cardLists = msg.errmsg.data;
            scope.page = msg.errmsg.page;

            for (var i in scope.cardLists) {
              for (var j in scope.cardArray) {
                if (scope.cardLists[i].id == scope.cardArray[j].id) {
                  scope.cardLists[i].ischeck = true;
                  continue;
                }
              }
            }
            scope.ischooseAll = false;
          });
        };
        scope.wxCardType = function (id) {
          switch (id) {
            case 1:
              return '代金券';
              break;
            case 2:
              return '折扣券';
              break;
            case 3:
              return '礼品券';
              break;
            default :
              return '没有卡券类型';
          }
        };
        scope.cardType = function (id) {
          switch (id) {
            case 1:
              return '微商户';
              break;
            case 2:
              return '微信';
              break;
            default :
              return '';
          }
        };
      }
    };
  }

  chooseCard.$inject = ['$http'];

  /**
   * @desc 选择分组
   * @example
   * <button id="group">选择分组</button>
   * <div choose-group="group" list="groupList"></div> 避免样式冲突，最好将此处添加至最外层div下
   */
  function chooseGroup($http) {
    return {
      restrict: 'A',
      scope: {
        list: '='
      },
      replace: true,
      template: '<div class="bootbox modal fade in" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog1"><div class="modal-content"><div class="modal-header"><a type="button" class="bootbox-close-button close" data-dismiss="modal">×</a><h4 class="modal-title">分组</h4></div><div class="modal-body"><div class="clearfix"><div class="table-responsive col-sm-12 no-padding ddlb"><div class="inline float-right margin-bottom10 margin-left10"><input class="min-width120 float-left ng-pristine ng-valid ng-touched" placeholder="搜索分组" type="text" ng-model="groupName"><span class="float-left" ng-click="querySearch()"><a class="btn btn-xs btn-primary"><i class="icon-search icon-on-right bigger-110"></i></a></span></div>' +
      '<table class="table table-striped table-bordered table-hover df">' +
      '<thead><tr><th width="3%" class="text-center"><label><input type="checkbox" class="ace" ng-model="checked" ng-click="checkAll()"><span class="lbl"></span></label></th><th class="text-align" width="10%">分组名称</th><th class="text-align" width="5%">会员数</th></tr></thead>' +
      '<tr ng-repeat="group in groupLists"><td class="text-align" ng-click="check(group)"><label><input type="checkbox" class="ace" ng-model="group.checked" ng-click="check(group,false,$event)"><span class="lbl"></span></label></td><td class="text-align" ng-bind="group.name"></td><td class="text-align" ng-bind="group.member_count"></td></tr><tr><td colspan="4" ng-show="!groupLists.length" class="red text-center">暂时没有可展示的数据</td></tr></table>' +
      '<div ng-paginate options="groupoptions" page="groupPage"></div></div></div></div><div class="modal-footer"><a type="button" class="btn btn-default" ng-click="cancel()">取消</a><a type="button" class="btn btn-primary" ng-click="confirm()">确定</a></div></div></div></div>',
      link: function (scope, element, attrs) {

        var list = [];//选中的值
        var groupName = '';
        scope.list = scope.list || [];

        $('#' + attrs.chooseGroup).bind('click', function () {
          list = angular.copy(scope.list);
          scope.groupName = '';
          groupName = '';
          search(1);
          $(element).modal('show');
        });

        scope.querySearch = function () {
          groupName = scope.groupName;
          search(1);
        };
        //查询
        function search(page) {
          $http.post('../members/find-group-ajax', {
            _page: page,
            _page_size: 10,
            name: groupName
          }).success(
            function (msg) {
              wsh.successback(msg, '', false, function () {
                var cnt = 0;
                msg.errmsg.data.map(function (d) {
                  list.map(function (l) {
                    if (l.id === d.id) {
                      d.checked = l.checked;
                      cnt++;
                    }
                  });
                });
                scope.checked = msg.errmsg.data.length === cnt;
                scope.groupLists = msg.errmsg.data;
                scope.groupPage = msg.errmsg.page;
              });
            }
          );
        };

        //分页配置项
        scope.groupoptions = {callback: search};

        //选中全部
        scope.checkAll = function () {
          scope.groupLists.map(function (obj) {
            obj.checked = scope.checked;
            scope.check(obj, true);
          });
        };

        //选中
        scope.check = function (obj, checkAll, event) {
          if (event) {
            event.stopPropagation();
          } else if (!checkAll) {
            obj.checked = !obj.checked;
          }
          if (obj.checked) {
            var temp = list.filter(function (_obj) {
              if (_obj.id === obj.id) {
                return _obj;
              }
            });
            //如果没有找到就添加
            if (!temp.length) {
              list.push(obj);
            }
          } else {
            //过滤取消的值
            list = list.filter(function (_obj) {
              if (_obj.id !== obj.id) {
                return _obj;
              }
            });
          }
          //如果不是全选按钮调用的
          if (!checkAll) {
            //如果当前页的数据都被选中 则自动选中全选按钮
            scope.checked = scope.groupLists.length === scope.groupLists.filter(function (obj) {
                if (obj.checked) {
                  return obj;
                }
              }).length;
          }
        };

        //确定
        scope.confirm = function () {
          scope.list = angular.copy(list);
          $(element).modal('hide');
        };

        //取消
        scope.cancel = function () {
          scope.checked = false;
          scope.groupLists.map(function (obj) {
            obj.checked = false;
          });
          $(element).modal('hide');
        };
      }
    };
  }

  chooseGroup.$inject = ['$http'];

  /**
   * @desc 选择标签
   * @example
   * <button id="tag">选择标签</button>
   * <div choose-tag="tag" list="tagList"></div> 避免样式冲突，最好将此处添加至最外层div下
   */
  function chooseTag($http) {
    return {
      restrict: 'A',
      scope: {
        list: '='
      },
      replace: true,
      template: '<div class="bootbox modal fade in" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog1"><div class="modal-content"><div class="modal-header"><a type="button" class="bootbox-close-button close" data-dismiss="modal">×</a><h4 class="modal-title">标签</h4></div><div class="modal-body"><div class="clearfix"><div class="table-responsive col-sm-12 no-padding ddlb"><div class="inline float-right margin-bottom10 margin-left10"><input class="min-width120 float-left ng-pristine ng-valid ng-touched" placeholder="搜索标签" type="text" ng-model="tagName"><span class="float-left" ng-click="querySearch()"><a class="btn btn-xs btn-primary"><i class="icon-search icon-on-right bigger-110"></i></a></span></div>' +
      '<table class="table table-striped table-bordered table-hover df">' +
      '<thead><tr><th width="3%" class="text-center"><label><input type="checkbox" class="ace" ng-model="checked" ng-click="checkAll()"><span class="lbl"></span></label></th><th class="text-align" width="10%">标签名称</th><th class="text-align" width="5%">会员数</th></tr></thead>' +
      '<tr ng-repeat="tag in tagLists" ng-click="check(tag)"><td class="text-align"><label><input type="checkbox" ng-model="tag.checked" class="ace" ng-click="check(tag,false,$event)"><span class="lbl"></span></label></td><td class="text-align" ng-bind="tag.name"></td><td class="text-align" ng-bind="tag.member_count"></td></tr><tr><td colspan="4" ng-show="!tagLists.length" class="red text-center">暂时没有可展示的数据</td></tr></table>' +
      '<div ng-paginate options="tagoptions" page="tagPage"></div></div></div></div><div class="modal-footer"><a type="button" class="btn btn-default" ng-click="cancel()">取消</a><a type="button" class="btn btn-primary" ng-click="confirm()">确定</a></div></div></div></div>',
      link: function (scope, element, attrs) {

        var list = [];//选中的值
        var tagName = '';
        scope.list = scope.list || [];

        $('#' + attrs.chooseTag).bind('click', function () {
          list = angular.copy(scope.list);
          tagName = '';
          scope.tagName = '';
          search(1);
          $(element).modal('show');
        });

        scope.querySearch = function () {
          tagName = scope.tagName;
          search(1);
        };
        //查询
        function search(page) {
          $http.post('../members/find-tag-ajax', {
            _page: page,
            _page_size: 10,
            name: scope.tagName
          }).success(
            function (msg) {
              wsh.successback(msg, '', false, function () {
                var cnt = 0;
                msg.errmsg.data.map(function (d) {
                  list.map(function (l) {
                    if (l.id === d.id) {
                      d.checked = l.checked;
                      cnt++;
                    }
                  });
                });
                scope.checked = msg.errmsg.data.length === cnt;
                scope.tagLists = msg.errmsg.data;
                scope.tagPage = msg.errmsg.page;
              });
            }
          );
        };

        //分页配置项
        scope.tagoptions = {callback: search};

        //选中全部
        scope.checkAll = function () {
          scope.tagLists.map(function (obj) {
            obj.checked = scope.checked;
            scope.check(obj, true);
          });
        };

        //选中
        scope.check = function (obj, checkAll, event) {
          if (event) {
            event.stopPropagation();
          } else if (!checkAll) {
            obj.checked = !obj.checked;
          }
          if (obj.checked) {
            var temp = list.filter(function (_obj) {
              if (_obj.id === obj.id) {
                return _obj;
              }
            });
            //如果没有找到就添加
            if (!temp.length) {
              list.push(obj);
            }
          } else {
            //过滤取消的值
            list = list.filter(function (_obj) {
              if (_obj.id !== obj.id) {
                return _obj;
              }
            });
          }
          //如果不是全选按钮调用的
          if (!checkAll) {
            //如果当前页的数据都被选中 则自动选中全选按钮
            scope.checked = scope.tagLists.length === scope.tagLists.filter(function (obj) {
                if (obj.checked) {
                  return obj;
                }
              }).length;
          }
        };

        //确定
        scope.confirm = function () {
          scope.list = angular.copy(list);
          $(element).modal('hide');
        };

        //取消
        scope.cancel = function () {
          scope.checked = false;
          scope.tagLists.map(function (obj) {
            obj.checked = false;
          });
          $(element).modal('hide');
        };
      }
    };
  }

  chooseTag.$inject = ['$http'];

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

        if (attrs.delegate) {
          $('#' + attrs.chooseArea).delegate(attrs.delegate, 'click', function (event) {
            init(event);
          });
        } else {
          $('#' + attrs.chooseArea).bind('click', function (event) {
            init(event);
          });
        }

        function init() {
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
        }

        //全选全不选
        scope.chooseAll = function (val) {
          scope.cityList.map(function (obj) {
            obj.ischoose = val;
          });
          if (val) {
            var hasProvince = false;
            selectedArea.map(function (area) {
              //找到就覆盖该省下的所有市
              if (area.province.id == scope.selectedProvince.id) {
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
              if (area.province.id != scope.selectedProvince.id) {
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
                  if (area.province.id == scope.selectedProvince.id) {
                    //找到对应的市 设置其选中状态
                    area.cityList.map(function (city) {
                      msg.errmsg.map(function (_city) {
                        if (city.id == _city.id) {
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
              if (area.province.id == scope.selectedProvince.id) {
                hasProvince = true;
                var has = false;
                area.cityList.map(function (_city) {
                  if (_city.id == city.id) {
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
              if (area.province.id == scope.selectedProvince.id) {
                area.cityList = area.cityList.filter(function (_city) {
                  if (_city.id != city.id) {
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

  /**
   * @desc 选择商品
   * @example
   * <button id="goods">选择商品</button>
   * <div choose-goods="goods" selected-list="selectedList"></div> 避免样式冲突，最好将此处添加至最外层div下
   */
  function chooseGoods($http) {
    return {
      restrict: 'A',
      scope: {
        selectedList: '='
      },
      replace: true,
      template: '<div class="bootbox modal fade in"><div class="modal-dialog modal-dialog6"><div class="modal-content">' +
      '<div class="modal-header modal-header2"><a class="bootbox-close-button close" data-dismiss="modal">×</a>' +
      '<h4 class="modal-title">商品列表</h4></div><div class="modal-body"><div class="bootbox-body">' +
      '<div class="tabbable"><div class="tab-content clearfix"><div id="product" class="tab-pane in active">' +
      '<div class="table-responsive pre-scrollable"><div class="margin-bottom10 text-right">商品分类:' +
      '<select class="width120" ng-model="fCategory" ng-change="getSecond()">' +
      '<option value="{{i.id}}" ng-bind="i.name" ng-repeat="i in fCategorySelect" ng-selected="i.id==fCategory"></option>' +
      '</select>' +
      '<select class="width120" ng-model="sCategory" ng-change="getThree()" ng-disabled="fCategory==\'\'||sCategorySelect.length===1"><option value="{{i.id}}" ng-bind="i.name" ng-repeat="i in sCategorySelect" ng-selected="i.id==sCategory"></option></select>' +
      '<select class="width120" ng-model="tCategory" ng-disabled="sCategory==\'\'||tCategorySelect.length===1">' +
      '<option value="{{i.id}}" ng-bind="i.name" ng-repeat="i in tCategorySelect" ng-selected="i.id==tCategory"></option>' +
      '</select>' +
      '<input class="inline text-muted width-250px" placeholder="搜索相关关键字或商品名称或商品编码" type="text" value="" ng-model="goodsName">' +
      ' <span class="inline align-top"><a ng-click="search()" class="btn btn-xs btn-primary align-top"><i class="icon-search icon-on-right bigger-100"></i></a></span>' +
      '</div>' +
      '<table class="table table-striped table-bordered table-hover table-width">' +
      '<thead><tr>' +
      '<th width="4%"></th><th width="12%">商品图片</th>' +
      '<th width="35%">商品名称</th><th width="16%">商品分类</th>' +
      '<th width="8%">库存</th><th width="12%">销售价</th>' +
      '<th width="12%"></th></tr></thead>' +
      '<tbody ng-repeat="goods in goodsList">' +
      '<tr class="products" ng-click="showChild(goods)">' +
      '<td><i class="icon-ok bigger-120 green" ng-if="goods.isshow"></i></td>' +
      '<td><img class="goods-item-pic" ng-src="{{goods.covers.file_cdn_path}}" width="100%"></td>' +
      '<td ng-bind="goods.name">上装韩版宽松长袖t恤女款大码打底袖t恤</td>' +
      '<td ng-bind="goods.productCategory.name">分类一</td>' +
      '<td ng-bind="goods.reserves">23</td>' +
      '<td ng-bind="goods.show_price/100 | number: 2"></td>' +
      '<td></td></tr>' +
      '<tr class="products_sku" ng-show="goods.isshow">' +
      '<td colspan="7" class="no-padding" width="100%">' +
      '<table class="table table-striped table-hover table-width skuList">' +
      '<tbody><tr ng-click="checkAll(goods)"><td width="3%">' +
      '<input type="checkbox"  ng-model="goods.ischeck" ng-click="checkAll(goods,$event)"></td>' +
      '<td width="12%">商品编号</td><td width="35%">商品名称</td>' +
      '<td width="15%">库存</td><td width="20%">规格</td>' +
      '<td >零售价</td></tr><tr ng-repeat="sku in goods.productSkus" ng-click="check(sku,goods)"  ng-hide="sku.ischoose || sku.status != 1">' +
      '<td width="29"><label><input type="checkbox" ng-model="sku.ischeck " ng-disabled="!sku.reserves || sku.attendActivity" ng-click="check(sku,goods,$event)">' +
      ' <span class="lbl"></span></label></td><td ng-bind="sku.sku_no"></td><td ng-bind="sku.name"></td>' +
      '<td ng-bind="sku.reserves"></td><td><span ng-repeat="kind in sku.kinds">' +
      '<span ng-bind="kind.name"></span>:<span ng-bind="sku.kindValues[$index].name"></span></span></td>' +
      '<td ng-bind="sku.retail_price/100 | number: 2">150</td>' +
      '<td ng-if="sku.attendActivity"  class="text-center blue">该规格的商品已关联其它活动</td></tr>' +
      '<tr ng-repeat="sku in goods.productSkus" ng-if="sku.ischoose || sku.status != 1"><td colspan="6" class="text-center">规格下架或者已选中</td></tr></tbody></table></td></tr></tbody></table>' +
      '<p ng-if="!goodsList.length" class="red text-center">暂无数据</p></div><div ng-paginate options="options" page="page"></div></div></div></div></div></div>' +
      '<div class="modal-footer"><a data-dismiss="modal" class="btn btn-default">取消</a> <a class="btn btn-primary" ng-click="save()">确定</a></div></div></div></div>',
      link: function (scope, element, attrs) {

        var selectedList = [];//
        scope.is_selected = false;//判断商品是否关联其它活动标识
        var selectedProList = {};

        //查询一级
        $http.post('/product/category-list-ajax', {pid: 0})
          .success(function (msg) {
            if (msg.errmsg.data && msg.errmsg.data.length > 0) {
              scope.fCategorySelect = [{
                id: '',
                name: '全部一级分类'
              }].concat(msg.errmsg.data);
              scope.sCategorySelect = [{
                'id': '',
                'name': '全部二级分类'
              }];
              scope.tCategorySelect = [{
                'id': '',
                'name': '全部三级分类'
              }];
            } else {
              scope.fCategorySelect = scope.sCategorySelect = scope.tCategorySelect = [{
                'id': '',
                'name': '暂无下级分类'
              }];
            }
            scope.fCategory = scope.sCategory = scope.tCategory = '';
          }
        );

        //查询二级
        scope.getSecond = function () {
          $http.post('/product/category-list-ajax', {pid: scope.fCategory})
            .success(function (msg) {
              if (msg.errmsg.data && msg.errmsg.data.length > 0) {
                scope.sCategorySelect = [{
                  id: '',
                  name: '全部二级分类'
                }].concat(msg.errmsg.data);
                scope.tCategorySelect = [{
                  'id': '',
                  'name': '全部三级分类'
                }];
              } else {
                scope.sCategorySelect = scope.tCategorySelect = [{
                  'id': '',
                  'name': '暂无下级分类'
                }];
              }
              scope.sCategory = scope.tCategory = '';
            }
          );
        };

        //查询三级
        scope.getThree = function () {
          $http.post('/product/category-list-ajax', {pid: scope.sCategory})
            .success(function (msg) {
              if (msg.errmsg.data && msg.errmsg.data.length > 0) {
                scope.tCategorySelect = [{
                  id: '',
                  name: '全部三级分类'
                }].concat(msg.errmsg.data);
              } else {
                scope.tCategorySelect = [{
                  'id': '',
                  'name': '暂无下级分类'
                }];
              }
              scope.tCategory = '';
            }
          );
        };

        function init(list) {
          if (parseInt(attrs.seletedShow) === 1) {
            getSelectedPro();
          }
          else {
            list.forEach(function (goods) {
              selectedList.forEach(function (_goods) {
                if (_goods.id === goods.id) {
                  var cnt = 0;
                  goods.productSkus.forEach(function (sku) {
                    _goods.productSkus.forEach(function (_sku) {
                      if (_sku.id === sku.id) {
                        ++cnt;
                        sku.ischeck = true;
                      }
                    });
                    if (cnt === goods.productSkus.length) {
                      goods.ischeck = true;
                    }
                    goods.isshow = true;
                  });
                }

              });
            });
          }

        }

        $('#' + attrs.chooseGoods).bind('click', function () {
          selectedList = angular.copy(scope.selectedList) || [];
          scope.search(1);
          $(element).modal('show');
        });

        scope.checkAll = function (item, event) {
          event ? event.stopPropagation() : item.ischeck = !item.ischeck;
          var count = 0;
          item.productSkus.forEach(function (obj) {
            if (obj.reserves && !obj.attendActivity) {
              obj.ischeck = item.ischeck;
            } else {
              obj.ischeck = false;
              count++;
            }
          });
          if (count == item.productSkus.length) {
            item.ischeck = false;
          }
          if (item.ischeck) {
            var has = false;
            selectedList.forEach(function (goods) {
              if (goods.id === item.id) {
                has = true;
                goods.productSkus = item.productSkus.filter(function (sku) {
                  if (sku.reserves && sku.status === 1) {
                    return sku;
                  }
                });
              }
            });
            if (!has) {
              var temp = angular.copy(item);
              temp.productSkus = temp.productSkus.filter(function (sku) {
                if (sku.reserves && sku.status === 1 && !sku.attendActivity) {
                  return sku;
                }
              });
              selectedList.unshift(temp);
            }
          } else {
            selectedList = selectedList.filter(function (goods) {
              if (goods.id !== item.id) {
                return goods;
              }
            });
          }
        };

        scope.check = function (item, goods, event) {
          if (item.attendActivity) return;
          if (event) {
            event.stopPropagation();
            if (!item.reserves) event.preventDefault();
          } else {
            if (!item.reserves) return;
            item.ischeck = !item.ischeck;
          }
          if (item.ischeck) {
            var count = selectedList.filter(function (_goods) {
              if (goods.id === _goods.id) {
                var cnt = _goods.productSkus.filter(function (sku) {
                  if (sku.id === item.id) {
                    return sku;
                  }
                }).length;
                if (!cnt) {
                  _goods.productSkus.unshift(item);
                }
                return _goods;
              }
            }).length;
            if (!count) {
              var temp = angular.copy(goods);
              temp.productSkus = [item];
              selectedList.unshift(temp);
            }
          } else {
            selectedList = selectedList.filter(function (_goods) {
              _goods.productSkus = _goods.productSkus.filter(function (sku) {
                if (sku.id !== item.id) {
                  return sku;
                }
              });
              if (_goods.productSkus.length) {
                return _goods;
              }
            });
          }
        };

        scope.search = function (page) {
          var categoryId = scope.sCategory ? scope.sCategory : scope.fCategory;
          categoryId = scope.tCategory ? scope.tCategory : categoryId;
          $http.post('/product/list-ajax', {
            '_page': page,
            '_page_size': 10,
            'status': 1,
            'name': scope.goodsName,
            'product_category_id': categoryId,
            'is_search': true
          }).success(
            function (msg) {
              wsh.successback(msg, '', false, function () {
                scope.goodsList = msg.errmsg.data;
                scope.page = msg.errmsg.page;
                init(scope.goodsList);

              });
            }
          );
        };

        scope.options = {callback: scope.search};

        //展示规格分类
        scope.showChild = function (obj) {
          obj.isshow = !obj.isshow;
        };

        //确定函数
        scope.save = function () {
          if (!selectedList.length) return alert('请选择商品！');
          scope.selectedList = angular.copy(selectedList);
          $(element).modal('hide');
        };

        ////获取满减活动已被选中的商品

        function getSelectedPro() {
          $http.post('/reduction/find-selected-product-ajax').success(
            function (msg) {
              wsh.successback(msg, '', false, function () {
                selectedProList = msg.errmsg || '';
                scope.goodsList.forEach(function (goods) {
                  goods.productSkus.forEach(function (sku) {
                    if (selectedProList) {
                      if (selectedProList.is_relate_all == 1) {
                        sku.attendActivity = true;
                      }
                      else {
                        if (selectedProList.products) {
                          if (selectedProList.products.length) {
                            selectedProList.products.map(function (sel_obj) {
                              if (sel_obj.product_id == goods.id) {
                                if (sel_obj.product_sku_id == sku.id) {
                                  sku.attendActivity = true;
                                }
                              }
                            })
                          }
                        }


                      }

                    }

                  });

                  if (selectedList.length) {
                    selectedList.forEach(function (_goods) {
                      if (_goods.id === goods.id) {
                        var cnt = 0;
                        goods.productSkus.forEach(function (sku) {

                          _goods.productSkus.forEach(function (_sku) {
                            if (_sku.id === sku.id) {
                              ++cnt;
                              sku.ischeck = true;
                            }
                          });

                        });

                        if (cnt === goods.productSkus.length) {
                          goods.ischeck = true;
                        }
                        goods.isshow = true;
                      }
                    });
                  } else {
                    goods.productSkus.forEach(function (sku) {
                      if (selectedProList) {
                        if (selectedProList.is_relate_all == 1) {
                          sku.attendActivity = true;
                        }
                        else {
                          if (selectedProList.products) {
                            if (selectedProList.products.length) {
                              selectedProList.products.map(function (sel_obj) {
                                if (sel_obj.product_id == goods.id) {
                                  if (sel_obj.product_sku_id == sku.id) {
                                    sku.attendActivity = true;
                                  }
                                }
                              })
                            }
                          }


                        }

                      }
                    });
                  }

                });
              });
            }
          );
        }
      }
    };
  }

  chooseGoods.$inject = ['$http'];
})
();