<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '编辑满减包邮活动';
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">
<style>
  .proHeight {
    height: 270px;
    overflow-y: scroll;
    display: inline-block;
    width: 90%;
  }
</style>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/marketing.php'); ?>
    <div class="main-content">

      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>编辑满减包邮活动</li>
        </ul>
      </div>

      <div class="page-content">
        <div class="space-6"></div>
        <div class="row">
          <div class="col-xs-12">
            <form class="form-horizontal">
              <div class="form-group">
                <lable class="col-sm-2 control-label"><span class="red">*</span>活动名称：</lable>
                <div class="col-sm-10">
                  <input class="width200" id="hasName" type="text" ng-model="model.name" name="name" reg-char-len="30" prompt-msg="nameMsg" prompt-type="1" ng-trim="false" diff-zh="true" required/>
                  <span class="red" ng-show="myform.name.$error.required && isSubmit">必填项</span>
                  <span class="inline padding5" ng-class="{'red':myform.name.$error.exceed}" ng-bind="nameMsg"></span>
                </div>
              </div>
              <div class="form-group">
                <lable class="col-sm-2 control-label"><span class="red">*</span>活动时间：</lable>
                <div class="col-sm-10">
                  <div class="input-group pull-left width200 no-padding">
                    <input type="text" id="start_time" class="Wdate form-control hasDatepicker" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}',maxDate:'2030-10-01',onpicked:validateTime,oncleared:validateTime})">
                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                  </div>
                  <span class="float-left padding5">至</span>

                  <div class="input-group pull-left width200 no-padding">
                    <input type="text" id="end_time" class="Wdate form-control hasDatepicker" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}',maxDate:'2030-10-01',onpicked:validateTime,oncleared:validateTime})">
                    <span class="input-group-addon"> <i class="icon-calendar"></i></span>
                  </div>
                                     <span class="padding5 red" id="validateResult"
                                           style="display: none;"></span>
                </div>
              </div>
              <div class="form-group">
                <lable class="col-sm-2 control-label"><span class="red">*</span>商品选择：</lable>
                <div class="col-sm-10">
                  <label>
                    <input name="offline" type="radio" class="ace " ng-model="model.is_relate_all" value="1" checked="">
                    <span class="lbl"> 全场商品</span>
                  </label>
                  <label>
                    <input name="offline" type="radio" class="ace " ng-model="model.is_relate_all" value="2">
                    <span class="lbl"> 指定商品</span>
                  </label>
                </div>
              </div>
              <div class="form-group" ng-show="model.is_relate_all==2">
                <div class="col-sm-10 col-sm-push-2">
                  <a class="btn btn-sm btn-primary" id="goods">添加商品</a>
                </div>
              </div>
              <div class="form-group margin-top10" ng-show="model.is_relate_all==2 && productList.length">
                <div class="col-sm-10 col-sm-push-2">
                  <div ng-class="{'proHeight':productList.length > 10}">

                    <table class="table table-striped table-bordered table-hover table-width text-center">
                      <tr>
                        <th class="text-center">商品名称</th>
                        <th class="text-center">规格</th>
                        <th class="text-center">商品编码</th>
                        <th class="text-center">商品分类</th>
                        <th class="text-center">销售价</th>
                        <th class="text-center">库存</th>
                        <th class="text-center">操作</th>
                      </tr>
                      <tr ng-repeat="list in productList track by $index">
                        <td ng-bind="list.name"></td>
                        <td><span ng-repeat="kind in list.kinds"> {{kind.name}}:{{list.kindValues[$index].name}} </span>
                        </td>
                        <td ng-bind="list.sku_no"></td>
                        <td ng-bind="list.productName"></td>
                        <td ng-bind="list.retail_price/100"></td>
                        <td ng-bind="list.reserves"></td>
                        <td>
                          <div class="action-buttons">
                            <a class="pointer red pointer" title="删除" ng-click="deleteProduct($index, list)">
                              <i class="icon-shanchu bigger-140"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-sm-10 col-sm-push-2">
                <table id="area" class="width90 table table-striped table-bordered table-width text-center">
                  <tr>
                    <!--                <td width="25%">优惠层级</td>-->
                    <td width="25%">设置条件</td>
                    <td width="50%">设置优惠</td>
                  </tr>
                  <tr ng-repeat="con in model.conditions">
                    <!--                <td >第一层</td>-->
                    <td class="text-left padding-left20">
                      <div class="inline width100">
                        <label class="align-middle">
                          <input name="offline" type="radio" class="ace " ng-model="con.condition_type" value="1" checked="" ng-change="changeCType(con.condition_type,con)">
                          <span class="lbl"></span>
                        </label>

                        <div class="form-group inline align-middle width50">
                          <label class="sr-only"></label>

                          <div class="input-group" ng-if="con.condition_type == 1">
                            <div class="input-group-addon">满</div>
                            <input type="text" class="form-control" placeholder="" ng-model="con.condition_min">

                            <div class="input-group-addon">元</div>
                          </div>
                          <div class="input-group" ng-if="con.condition_type == 2">
                            <div class="input-group-addon">满</div>
                            <input type="text" class="form-control" placeholder="">

                            <div class="input-group-addon">元</div>
                          </div>
                        </div>
                      </div>
                      <div class="inline width100 margin-top10 ">
                        <label class="align-middle">
                          <input name="offline" type="radio" class="ace " ng-model="con.condition_type" value="2" ng-change="changeCType(con.condition_type,con)">
                          <span class="lbl"></span>
                        </label>

                        <div class="form-group inline align-middle width50">
                          <label class="sr-only"></label>

                          <div class="input-group" ng-if="con.condition_type == 2">
                            <div class="input-group-addon">满</div>
                            <input type="text" class="form-control" placeholder="" ng-model="con.count" maxlength="5">

                            <div class="input-group-addon">件</div>
                          </div>
                          <div class="input-group" ng-if="con.condition_type == 1">
                            <div class="input-group-addon">满</div>
                            <input type="text" class="form-control" placeholder="">

                            <div class="input-group-addon">件</div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="text-left padding-left20 padding-bottom15">
                      <!--                                          <div class="inline width100 margin-top15">-->
                      <!--                                              <label class="align-middle">-->
                      <!--                                                  <input  type="checkbox" class="ace " >-->
                      <!--                                                  <span class="lbl"></span>-->
                      <!--                                              </label>-->
                      <!--                                              <div class="form-group inline align-middle width120">-->
                      <!--                                                  <label class="sr-only"></label>-->
                      <!--                                                  <div class="input-group">-->
                      <!--                                                      <div class="input-group-addon">减</div>-->
                      <!--                                                      <input type="text" class="form-control" placeholder="">-->
                      <!--                                                      <div class="input-group-addon">元</div>-->
                      <!--                                                  </div>-->
                      <!--                                              </div>-->
                      <!--                                              <label class="align-middle margin-left10">-->
                      <!--                                                  <input  type="checkbox" class="ace " value="1" checked="">-->
                      <!--                                                  <span class="lbl"> 上不封顶</span>-->
                      <!--                                              </label>-->
                      <!--                                                                 <span class="inline align-middle tdpopover pointer"  data-toggle="popover" data-trigger="hover" data-placement="bottom" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">-->
                      <!--                                                                     <i class="icon icon-question-circle bigger-160 orange"></i>-->
                      <!--                                                                 </span>-->
                      <!--                                          </div>-->
                      <!--                                          <div class="inline width100 margin-top10">-->
                      <!--                                              <label class="align-middle">-->
                      <!--                                                  <input  type="checkbox" class="ace " value="1" checked="">-->
                      <!--                                                  <span class="lbl"></span>-->
                      <!--                                              </label>-->
                      <!--                                              <div class="form-group inline align-middle width120">-->
                      <!--                                                  <label class="sr-only"></label>-->
                      <!--                                                  <div class="input-group">-->
                      <!--                                                      <div class="input-group-addon">打</div>-->
                      <!--                                                      <input type="text" class="form-control" placeholder="">-->
                      <!--                                                      <div class="input-group-addon">折</div>-->
                      <!--                                                  </div>-->
                      <!--                                              </div>-->
                      <!--                                          </div>-->
                      <!---->
                      <!--                    <div class="inline width100 margin-top10">-->
                      <!--                        <label class="align-middle">-->
                      <!--                            <input  type="checkbox" class="ace " value="1" checked="">-->
                      <!--                            <span class="lbl"></span>-->
                      <!--                        </label>-->
                      <!--                        <div class="form-group inline align-middle width127">-->
                      <!--                            <label class="sr-only"></label>-->
                      <!--                            <div class="input-group">-->
                      <!--                                <div class="input-group-addon">送</div>-->
                      <!--                                <input type="text" class="form-control" placeholder="">-->
                      <!--                                <div class="input-group-addon">积分</div>-->
                      <!--                            </div>-->
                      <!--                        </div>-->
                      <!--                        <label class="align-middle margin-left10">-->
                      <!--                            <input  type="checkbox" class="ace " value="1" checked="">-->
                      <!--                            <span class="lbl"> 上不封顶</span>-->
                      <!--                        </label>-->
                      <!--                                           <span class="inline align-middle tdpopover pointer"  data-toggle="popover" data-trigger="hover" data-placement="bottom" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">-->
                      <!--                                               <i class="icon icon-question-circle bigger-160 orange"></i>-->
                      <!--                                           </span>-->
                      <!--                    </div>-->
                      <div class="inline width100 margin-top10">
                        <label class="align-middle">
                          <span class="lbl">选择包邮区域：</span>
                        </label>
                        <span style="margin-left: 8px;">
                        <label class="align-middle">
                          <input type="radio" class="ace" ng-model="model.conditions[0].strategys[0].is_all_area" value="1">
                          <span class="lbl">&nbsp;全国包邮</span>
                        </label>
                        <label class="align-middle">
                          <input type="radio" class="ace" ng-model="model.conditions[0].strategys[0].is_all_area" value="2">
                          <span class="lbl">&nbsp;指定区域包邮</span>
                        </label>
                        </span>
                      </div>
                      <div class="inline width100 margin-top10" ng-show="model.conditions[0].strategys[0].is_all_area == 2">
                        <div class="btn btn-xs btn-primary area-btn">设置指定区域</div>
                        <div class="grey" style="margin-top: 8px;">
                          <span class="l-24 m-r-12" ng-if="areaListText" ng-bind="areaListText"></span>
                        </div>
                      </div>
                      <!--                    <div class="inline width100 margin-top5">-->
                      <!--                        <label class="align-middle">-->
                      <!--                            <input  type="checkbox" class="ace " value="1" checked="">-->
                      <!--                            <span class="lbl">&nbsp;&nbsp;&nbsp;&nbsp;送卡券</span>-->
                      <!--                        </label>-->
                      <!--                    </div>-->
                      <!--                    <div class="inline width100 ">-->
                      <!--                        <label class="align-middle">-->
                      <!--                            <input  type="checkbox" class="ace " value="1" checked="">-->
                      <!--                            <span class="lbl">&nbsp;&nbsp;&nbsp;&nbsp;送现金红包</span>-->
                      <!--                        </label>-->
                      <!--                    </div>-->
                      <!--                    <div class="inline width100 ">-->
                      <!--                        <label class="align-middle">-->
                      <!--                            <input  type="checkbox" class="ace " value="1" checked="">-->
                      <!--                            <span class="lbl">&nbsp;&nbsp;&nbsp;&nbsp;送商城红包</span>-->
                      <!--                        </label>-->
                      <!--                    </div>-->
                    </td>
                  </tr>
                  <!--            <tr>-->
                  <!--                <td colspan="3" class="text-left padding-left20">-->
                  <!--                    <a class="btn btn-sm btn-primary" href="###">新增一级优惠</a>-->
                  <!--                    <span class="inline padding5 grey">最多五级优惠</span>-->
                  <!--                </td>-->
                  <!--            </tr>-->
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="space-32"></div>
      <!-- 确定 -->
      <div class="modal-footer margin-auto" id="modal-footer">
        <a class="btn btn-infor" href="list"> 返回列表 </a>
        <a id="post" class="btn btn-primary" ng-click="btnSave()"> 保存 </a>
      </div>
    </div>
  </div>
  <!--选择地区-->
  <div choose-area="area" delegate=".area-btn" area-list="areaList" show-text="showText"></div>
  <!--选择商品-->
  <div choose-goods="goods" selected-list="selectedList" seleted-show="1"></div>
</div>
<script src="/ace/js/DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
  var startT = '', endT = '', globalClick = false, validateResult = $('#validateResult');
  function validateTime() {
    validateResult = validateResult.length ? validateResult : $('#validateResult');
    var starttime = $("#start_time").val(), endtime = $("#end_time").val();
    //校验必填
    if (!starttime || !endtime) {
      validateResult.text('必填项').show();
      setTimeout(function () {
        validateResult.hide();
      }, 2000);
      return false;
    }
    //校验开始时间不能大于或者等于结束时间
    if (+new Date(starttime) / 1000 >= +new Date(endtime) / 1000) {
      validateResult.text('结束时间必须大于开始时间').show();
      setTimeout(function () {
        validateResult.hide();
      }, 2000);
      return false;
    }

    startT = +new Date(starttime) / 1000, endT = +new Date(endtime) / 1000;
    return true;
  }
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http, $filter) {
    $scope.model = {};
    $scope.productList = [];
    $rootScope.productObj = {};
    $scope.products = [];//商品
    //点击选择商品  关联商品
    $scope.areaList = [];//初始化地区
    $scope.searchArray = [];
    var area_cn = '';
    var area_ids = '';

    //获取选中的地区文本
    $scope.showText = function (list) {
      var result = '';
      var result_id = '';
      list.map(function (area) {
        //如果该省下有市
        if (area.cityList.length) {
          var citys = '';
          var city_ids = '';
          //用逗号拼接
          area.cityList.map(function (city) {
            city_ids += city.id + ',';
            citys += city.name + ',';
          });
          result_id += area.province.id + '(' + city_ids.substr(0, city_ids.length - 1) + ');';
          //用括号包住 例如： 天津市(天津);
          result += area.province.name + '(' + citys.substring(0, citys.length - 1) + ');';
          area_cn = result;
          area_ids = result_id;

        }
      });
      return result;
    };
    $scope.$watchCollection('areaList', function (newV) {
      if (newV) {
        $scope.areaListText = $scope.showText(newV);
      }
    });

    $scope.changeCType = function (type, obj) {
      if (type == 1) {
        obj.condition_min = '';
      }
      else {
        obj.condition_min = '';
      }
    }
    var id = wsh.getHref('id');
    getDetail();//获取活动详情
    function getDetail() {
      $http.post('/reduction/detail-ajax', {id: id}).success(function (msg) {
        wsh.successback(msg, '', false, function () {
          $scope.model = msg.errmsg;
          $scope.conditions = msg.errmsg.conditions ? msg.errmsg.conditions : [];
          $("#start_time").val($filter('date')($scope.model.start_time * 1000, 'yyyy-MM-dd HH:mm:ss'));
          $("#end_time").val($filter('date')($scope.model.end_time * 1000, 'yyyy-MM-dd HH:mm:ss'));

          $scope.conditions.map(function (a, b) {
            if (a.condition_type == 1) {
              if (a.condition_min) {
                a.condition_min /= 100;
              }
            }
            else {
              a.count = a.condition_min;
            }

            if (a.strategys.length > 0) {
              a.strategys.map(function (e) {
                if (e.area_cn) {
                  a.strategys.is_all_area = 2;
                  $scope.areaListText = e.area_cn;
                  var json = {
                    area_cn: e.area_cn,
                    area_id: e.area_id
                  };
                  dateFilter(json);
                  return $scope.is_click = false;

                } else {
                  a.strategys.is_all_area = 1;
                  $scope.is_click = true;
                }
              })
            }
          })
        });
      });
    }

    function dateFilter(json) {

      var list = [];
      var city = json.area_cn.split(';'),
        id = json.area_id.split(';');
      city.length--;
      id.length--;
      var array = [];
      city.map(function (val, idx) {
        for (i in val) {
          if (val[i] == '(') {
            var _cityList = val.substring(parseInt(i) + 1, val.length - 1).split(','), cityList = [];
            _cityList.map(function (value, index) {
              cityList.push({id: '', name: value, ischoose: true});
            });
            array.push({province: {name: val.substring(0, parseInt(i)), id: ''}, cityList: cityList});
          }
        }
      });
      id.map(function (val, idx) {
        for (i in val) {
          if (val[i] == '(') {
            var _idList = val.substring(parseInt(i) + 1, val.length - 1).split(','), idList = [];
            _idList.map(function (value, index) {
              array[idx].cityList[index].id = value;
            });
            array[idx].province.id = val.substring(0, parseInt(i));
          }
        }
      });
      $scope.areaList = array;
    }

    //接收选择的商品数据
    $scope.$watch('selectedList', function (newV) {
      if (newV) {
        var list = [];
        newV.forEach(function (goods) {
          goods.productSkus.forEach(function (sku) {
            list.push({
              id: goods._id,
              product_id: goods.id,
              product_sku_id: sku.id,
              name: goods.name,
              sku_no: sku.sku_no,
              productName: goods.productCategory.name,
              retail_price: sku.retail_price,
              reserves: sku.reserves,
              kinds: sku.kinds,
              kindValues: sku.kindValues
            });
          });
        });
        $scope.productList = list;
      }
      if ($scope.productList.length > 0) {
        $scope.products = [];
        $scope.productList.map(function (e) {
          $scope.products.push({product_id: e.product_id, product_sku_id: e.product_sku_id});
        })
      }
    });
    //ajax 获取关联的商品列表
    getProduct();
    function getProduct() {
      $http.post('/reduction/find-product-ajax', {
        id: id,
        is_find_all: 1
      })
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            var selectedList = [];
            msg.errmsg.data.forEach(function (d) {
              var cnt = selectedList.filter(function (_d) {
                if (d.product_id === _d.id) {
                  var len = _d.productSkus.filter(function (_sku) {
                    if (d.product_sku_id === _sku.id) {
                      return _sku;
                    }
                  }).length;
                  if (!len) {
                    _d.productSkus.push(d.productSku);
                  }
                  return _d;
                }
              }).length;
              if (!cnt) {
                d.product.productSkus = [d.productSku];
                d.product._id = d.id;
                selectedList.push(d.product);
              }
            });
            $scope.selectedList = selectedList;
          });
        });

    }

    function delItem(index, _obj) {
      $scope.productList.splice(index, 1);
      $scope.selectedList = $scope.selectedList.filter(function (obj) {
        obj.productSkus = obj.productSkus.filter(function (_sku) {
          if (_sku.id !== _obj.product_sku_id) {
            return _sku;
          }
        });
        if (obj.productSkus.length) {
          return obj;
        }
      });
      $scope.$apply();
    }

    //删除商品
    $scope.deleteProduct = function (index, obj) {
      //有id 指 已经保存到数据库
      if (obj.id) {
        wsh.setDialog('删除提示', '确定要删除该数据吗?', '/reduction/delete-product-ajax', {reduction_id: id, product_id: obj.product_id, product_sku_id: obj.product_sku_id}, function () {
          delItem(index, obj);
        }, '删除成功');
      } else {
        wsh.setNoAjaxDialog('删除提示', '确定要删除该数据吗?', function () {
          delItem(index, obj);
        });
      }
    };

    //end 关联商品
    $scope.isSubmit = false;
    var is_send_ajax = false, is_sync_ajax = false;
    $scope.btnSave = function () {
      if (is_send_ajax) return is_send_ajax;
      var start_time = +new Date($("#start_time").val()) / 1000;
      var end_time = +new Date($("#end_time").val()) / 1000;
      var list = angular.copy($scope.conditions);
      var data = {};
      if ($scope.model.conditions[0].strategys[0].is_all_area == 2 && !$scope.areaListText) {
        return alert('请选择指定区域');
      }
      list.map(function (obj) {
        $scope.condition_type = obj.condition_type;
        $scope.id = obj.id;

        if ($scope.condition_type == 1) {
          if (obj.condition_min == '' || obj.condition_min == undefined) {
            return alert('请输入金额！'), $scope.isSubmit = false;
          }
          else {
            var reg = /^([1-9]\d{0,6}(\.\d{1,2})?|0\.[1-9][0-9]?|0\.[0-9][1-9])$/;
            if (!reg.test(obj.condition_min)) {
              obj.condition_min = '';
              return alert('请输入大于0的正整数，若是小数，最多保留2位小数(金额只能到百万)');
            } else {
              $scope.condition_min = obj.condition_min * 100;
              $scope.isSubmit = true;
            }
          }

        }
        else {
          if (obj.count == '' || obj.count == undefined) {
            return alert('请输入件数！'), $scope.isSubmit = false;
          }
          else {
            if (!(/^[1-9][0-9]*$/).test(obj.count)) {
              obj.count = '';
              return alert('请输入整数');
            } else {
              $scope.condition_min = obj.count;
              $scope.isSubmit = true;
            }
          }
        }


      });
      if ($scope.model.conditions[0].strategys[0].is_all_area == 1) {
        area_ids = '';
        area_cn = '';
      }
      data = {
        id: $scope.id,
        reduction_id: id,
        condition_type: $scope.condition_type,
        level: 1,
        condition_min: $scope.condition_min,
        strategys: [{
          reduction_id: id,
          reduction_type: 4,
          amount: '',
          is_all_area: $scope.model.conditions[0].strategys[0].is_all_area,
          area_id: area_ids,
          area_cn: area_cn,
          is_limit: 2
        }]

      };


      if ($scope.isSubmit) {
        is_send_ajax = true;
        $http.post('/reduction/edit-conditions-ajax', data).success(function (msg) {

        }).success(function (msg) {
          wsh.successback(msg, '', false, function () {
            if (msg.errcode == 0) {
              if ($scope.model.is_relate_all == 2) {

                if ($scope.productList.length == 0) {
                  return alert('请选择商品！');
                }
                $http.post('/reduction/create-product-list-ajax', {
                  reduction_id: id,
                  products: $scope.products
                }).success(function (msg) {
                  wsh.successback(msg, '', false, function () {
                    if (msg.errcode == 0) {
                      is_send_ajax = true;
                      $http.post('/reduction/edit-ajax', {
                        id: id,
                        name: $scope.model.name,
                        is_relate_all: $scope.model.is_relate_all,
                        start_time: start_time,
                        end_time: end_time
                      }).success(function (msg) {
                        wsh.successback(msg, '保存成功', false, function () {
                          window.location.href = 'list';
                        });
                        is_send_ajax = false;
                      }).error(function (msg) {
                        is_send_ajax = false;
                        wsh.successback(msg);
                      });
                    }
                  });
                }).error(function (msg) {
                  is_send_ajax = false;
                  wsh.successback(msg);
                });
              } else {
                $http.post('/reduction/edit-ajax', {
                  id: id,
                  name: $scope.model.name,
                  is_relate_all: $scope.model.is_relate_all,
                  start_time: start_time,
                  end_time: end_time
                }).success(function (msg) {
                  wsh.successback(msg, '保存成功', false, function () {
                    window.location.href = 'list';
                  });
                  is_send_ajax = false;
                }).error(function (msg) {
                  is_send_ajax = false;
                  wsh.successback(msg);
                });
              }

            }
          });
          is_send_ajax = false;
        }).error(function (msg) {
          is_send_ajax = false;
          wsh.successback(msg);
        });


      }


    }

  });
</script>