<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '添加满减包邮活动';
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
          <li>添加满减包邮活动</li>
        </ul>
      </div>

      <div class="page-content">
        <div class="space-6"></div>
        <div class="row">
          <div class="col-xs-12">
            <form class="form-horizontal" name="myform" ovalidate="novalidate">
              <div class="form-group">
                <lable class="col-sm-2 control-label"><span class="red">*</span>活动名称：</lable>
                <div class="col-sm-10">
                  <input class="width200" type="text" name="name" ng-model="params.name" reg-char-len="30" prompt-msg="nameMsg" prompt-type="1" ng-trim="false" diff-zh="true" required/>
                  <span class="red" ng-show="myform.name.$error.required && isSubmit">必填项</span>
                  <span class="inline padding5" ng-class="{'red':myform.name.$error.exceed}" ng-bind="nameMsg"></span>
                </div>
              </div>
              <div class="form-group">
                <lable class="col-sm-2 control-label"><span class="red">*</span>活动时间：</lable>
                <div class="col-sm-10">
                  <div class="input-group pull-left width200 no-padding">
                    <input type="text" id="start_time" class="Wdate form-control hasDatepicker"
                           onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}',maxDate:'2030-10-01',onpicked:validateTime,oncleared:validateTime})"/>
                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                  </div>
                  <span class="float-left padding5">至</span>

                  <div class="input-group pull-left width200 no-padding">
                    <input type="text" id="end_time" class="Wdate form-control hasDatepicker"
                           onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}',maxDate:'2030-10-01',onpicked:validateTime,oncleared:validateTime})"/>
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
                    <input name="offline" type="radio" class="ace " ng-model="params.is_relate_all" value="1" checked ng-change="changePro(params.is_relate_all)">
                    <span class="lbl"> 全场商品</span>
                  </label>
                  <label>
                    <input name="offline" type="radio" class="ace " ng-model="params.is_relate_all" value="2">
                    <span class="lbl"> 指定商品</span>
                  </label>
                </div>
              </div>
              <div class="form-group" ng-show="params.is_relate_all == 2">
                <div class="col-sm-10 col-sm-push-2">
                  <a class="btn btn-sm btn-primary" id="goods">添加商品</a>
                </div>
              </div>
              <div class="form-group margin-top10" ng-show="params.is_relate_all == 2 && productList.length">
                <div class="col-sm-10 col-sm-push-2">
                  <div ng-class="{'proHeight':productList.length > 10}">
                    <table class="width90 table table-striped table-bordered table-hover table-width text-center">
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
                            <a class="pointer red" title="删除" ng-click="deleteProduct($index,list)">
                              <i class="icon-shanchu bigger-130 red"></i>
                            </a>
                          </div>
                        </td>
                      </tr>

                    </table>
                  </div>
                </div>
              </div>
            </form>
            <div class="row margin-top10">
              <div class="col-sm-10 col-sm-push-2">
                <table id="area" class="width90 table table-striped table-bordered table-width text-center" style="table-layout: fixed">
                  <tr>
                    <!--                                   <td width="25%">优惠层级</td>-->
                    <td width="25%">设置条件</td>
                    <td width="50%">设置优惠</td>
                  </tr>
                  <tr ng-repeat="con in params.conditions">
                    <!--                                   <td >第一层</td>-->
                    <td class="text-left padding-left20">
                      <div class="inline width100">
                        <label class="align-middle">
                          <input name="condition_type" type="radio" ng-model="con.condition_type" class="ace " value="1" checked="" ng-change="change($index)">
                          <span class="lbl"></span>
                        </label>

                        <div class="form-group inline align-middle width50">
                          <label class="sr-only"></label>

                          <div class="input-group" ng-if="con.condition_type == 1">
                            <div class="input-group-addon">满</div>
                            <input type="text" name="amout" class="form-control" ng-model="con.condition_min" placeholder="">

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
                          <input name="condition_type" type="radio" class="ace " ng-model="con.condition_type" value="2" ng-change="change($index)">
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
                      <!--                                                             <div class="inline width100 margin-top15">-->
                      <!--                                                                 <label class="align-middle">-->
                      <!--                                                                     <input  type="checkbox" class="ace " value="1" checked="">-->
                      <!--                                                                     <span class="lbl"></span>-->
                      <!--                                                                 </label>-->
                      <!--                                                                 <div class="form-group inline align-middle width120">-->
                      <!--                                                                     <label class="sr-only"></label>-->
                      <!--                                                                     <div class="input-group">-->
                      <!--                                                                         <div class="input-group-addon">减</div>-->
                      <!--                                                                         <input type="text" class="form-control" placeholder="">-->
                      <!--                                                                         <div class="input-group-addon">元</div>-->
                      <!--                                                                     </div>-->
                      <!--                                                                 </div>-->
                      <!--                                                                 <label class="align-middle margin-left10">-->
                      <!--                                                                     <input  type="checkbox" class="ace " value="1" checked="">-->
                      <!--                                                                     <span class="lbl"> 上不封顶</span>-->
                      <!--                                                                 </label>-->
                      <!--                                                                 <span class="inline align-middle tdpopover pointer"  data-toggle="popover" data-trigger="hover" data-placement="bottom" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">-->
                      <!--                                                                     <i class="icon icon-question-circle bigger-160 orange"></i>-->
                      <!--                                                                 </span>-->
                      <!--                                                             </div>-->
                      <!--                                                             <div class="inline width100 margin-top10">-->
                      <!--                                                                 <label class="align-middle">-->
                      <!--                                                                     <input  type="checkbox" class="ace " value="1" checked="">-->
                      <!--                                                                     <span class="lbl"></span>-->
                      <!--                                                                 </label>-->
                      <!--                                                                 <div class="form-group inline align-middle width120">-->
                      <!--                                                                     <label class="sr-only"></label>-->
                      <!--                                                                     <div class="input-group">-->
                      <!--                                                                         <div class="input-group-addon">打</div>-->
                      <!--                                                                         <input type="text" class="form-control" placeholder="">-->
                      <!--                                                                         <div class="input-group-addon">折</div>-->
                      <!--                                                                     </div>-->
                      <!--                                                                 </div>-->
                      <!--                                                             </div>-->

                      <!--                                       <div class="inline width100 margin-top10">-->
                      <!--                                           <label class="align-middle">-->
                      <!--                                               <input  type="checkbox" class="ace " value="1" checked="">-->
                      <!--                                               <span class="lbl"></span>-->
                      <!--                                           </label>-->
                      <!--                                           <div class="form-group inline align-middle width127">-->
                      <!--                                               <label class="sr-only"></label>-->
                      <!--                                               <div class="input-group">-->
                      <!--                                                   <div class="input-group-addon">送</div>-->
                      <!--                                                   <input type="text" class="form-control" placeholder="">-->
                      <!--                                                   <div class="input-group-addon">积分</div>-->
                      <!--                                               </div>-->
                      <!--                                           </div>-->
                      <!--                                           <label class="align-middle margin-left10">-->
                      <!--                                               <input  type="checkbox" class="ace " value="1" checked="">-->
                      <!--                                               <span class="lbl"> 上不封顶</span>-->
                      <!--                                           </label>-->
                      <!--                                           <span class="inline align-middle tdpopover pointer"  data-toggle="popover" data-trigger="hover" data-placement="bottom" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">-->
                      <!--                                               <i class="icon icon-question-circle bigger-160 orange"></i>-->
                      <!--                                           </span>-->
                      <!--                                       </div>-->
                      <div class="inline width100 margin-top10">
                        <label class="align-middle">
                          <span class="lbl">选择包邮区域：</span>
                        </label>
                        <span style="margin-left: 8px;">
                        <label class="align-middle">
                          <input type="radio" class="ace" ng-model="params.conditions[0].strategys[0].is_all_area" value="1">
                          <span class="lbl">&nbsp;全国包邮</span>
                        </label>
                        <label class="align-middle">
                          <input type="radio" class="ace" ng-model="params.conditions[0].strategys[0].is_all_area" value="2">
                          <span class="lbl">&nbsp;指定区域包邮</span>
                        </label>
                        </span>
                      </div>
                      <div class="inline width100 margin-top10" ng-show="params.conditions[0].strategys[0].is_all_area == 2">
                        <div class="btn btn-xs btn-primary area-btn">设置指定区域</div>
                        <div class="grey" style="margin-top: 8px;">
                          <span class="l-24 m-r-12" ng-if="areaListText" ng-bind="areaListText"></span>
                        </div>
                      </div>
                      <!--                                       <div class="inline width100 margin-top5">-->
                      <!--                                           <label class="align-middle">-->
                      <!--                                               <input  type="checkbox" class="ace " value="1" checked="">-->
                      <!--                                               <span class="lbl">&nbsp;&nbsp;&nbsp;&nbsp;送卡券</span>-->
                      <!--                                           </label>-->
                      <!--                                       </div>-->
                      <!--                                       <div class="inline width100 ">-->
                      <!--                                           <label class="align-middle">-->
                      <!--                                               <input  type="checkbox" class="ace " value="1" checked="">-->
                      <!--                                               <span class="lbl">&nbsp;&nbsp;&nbsp;&nbsp;送现金红包</span>-->
                      <!--                                           </label>-->
                      <!--                                       </div>-->
                      <!--                                       <div class="inline width100 ">-->
                      <!--                                           <label class="align-middle">-->
                      <!--                                               <input  type="checkbox" class="ace " value="1" checked="">-->
                      <!--                                               <span class="lbl">&nbsp;&nbsp;&nbsp;&nbsp;送商城红包</span>-->
                      <!--                                           </label>-->
                      <!--                                       </div>-->
                    </td>
                  </tr>
                  <!--                               <tr>-->
                  <!--                                   <td colspan="3" class="text-left padding-left20">-->
                  <!--                                       <a class="btn btn-sm btn-primary" href="###">新增一级优惠</a>-->
                  <!--                                       <span class="inline padding5 grey">最多五级优惠</span>-->
                  <!--                                   </td>-->
                  <!--                               </tr>-->
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
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
    $scope.products = [];//商品
    $scope.amount = 0;
    $scope.areaList = [];//初始化地区
    $scope.selectedList = [];//init
    var area_cn = '';
    var area_ids = '';
    $scope.params = {
      name: '',                           //活动名称
      is_relate_all: 1,                  //是否关联所有商品
      start_time: '',                    //活动开始时间
      end_time: '',                      //活动结束时间
      conditions: [
        {
          condition_type: 1,            //1, 优惠条件类型 （1、满X元 2、满X件）
          level: 1,                     //2 ,优惠条件层级
          condition_min: '',            //优惠条件值
          strategys: [                  //优惠设置
            {
              "reduction_type": 4,      //1,优惠类型
              "amount": "",             //优惠值设置
              "is_all_area": 1,      //是否全国包邮
              "area_id": '',
              "area_cn": '',
              is_limit: 1
            }
          ]
        }
      ],
      products: $scope.products
    };
    $scope.change = function (index) {
      $scope.params.conditions[index].condition_min = '';
    };


    //获取选中的地区文本
    $scope.showText = function (list) {

      var result = '';
      var result_id = '';
      var cityList = angular.copy(list);
      cityList.map(function (area) {
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
    $scope.is_click = true;
    $scope.productList = [];

    //接收选择的商品数据   json 为一个二维数组
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
        $scope.productList.map(function (e) {
          $scope.products.push({product_id: e.product_id, product_sku_id: e.product_sku_id});
        })
      }

    });

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
      wsh.setNoAjaxDialog('删除提示', '确定要删除该数据吗?', function () {
        delItem(index, obj);
      });


    };

    $scope.isSubmit = false;
    var is_send_ajax = false;
    $scope.btnSave = function () {
      if (is_send_ajax) return is_send_ajax;


      if ($scope.myform.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
      if (!validateTime()) {
        return;
      }

      var start_time = +new Date($("#start_time").val()) / 1000;
      var end_time = +new Date($("#end_time").val()) / 1000;
      var data = angular.copy($scope.params);
      data.start_time = start_time;
      data.end_time = end_time;
      if (data.is_relate_all == 1) {//如果是全场商品，不传product
        data.products = undefined;
      }
      else {
        if ($scope.productList.length == 0) {
          return alert('请选择商品！');
        }
      }
      if ($scope.params.conditions[0].strategys[0].is_all_area == 2 && !$scope.areaListText) {
        return alert('请选择指定区域');
      }
      data.conditions.map(function (e, i) {
        //1.默认满X元，否则就是满X件
        if (e.condition_type == 1) {
          if (e.condition_min == '' || e.condition_min == undefined) {
            return alert('请输入金额！'), $scope.isSubmit = false;
          }
          else {
            var reg = /^([1-9]\d{0,6}(\.\d{1,2})?|0\.[1-9][0-9]?|0\.[0-9][1-9])$/;
            if (!reg.test(e.condition_min)) {
              e.condition_min = '';
              return alert('请输入大于0的正整数，若是小数，最多保留2位小数(金额只能到百万)');
            } else {
              e.condition_min = e.condition_min * 100;
              $scope.isSubmit = true;
            }

          }
        } else {
          if (e.count == '' || e.count == undefined) {
            return alert('请输入件数！'), $scope.isSubmit = false;
          }
          else {
            if (!(/^[1-9][0-9]*$/).test(e.count)) {
              e.count = '';
              return alert('请输入整数');
            } else {
              e.condition_min = e.count;
              $scope.isSubmit = true;
            }

          }
        }
        //1.默认全国包邮，否则就是指定区域包邮
        if (e.strategys[i].is_all_area == 1) {
          e.strategys[i].area_id = '';
          e.strategys[i].area_cn = '';
        }
        else {
          e.strategys[i].area_id = area_ids;
          e.strategys[i].area_cn = area_cn;
        }

      });
      if ($scope.isSubmit) {//如果验证通过就请求
        is_send_ajax = true;
        $http.post('/reduction/add-ajax', data).success(function (msg) {
          wsh.successback(msg, '保存成功', false, function () {
            window.location.href = 'list';
          });
          is_send_ajax = false;
        });
      }

    }

  });
</script>