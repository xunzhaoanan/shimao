<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '编辑秒杀活动';
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">
<div class="main-container" id="main-container" ng-clock ng-controller="mainController">
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
          <li>编辑秒杀活动</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">

            <div class="leader clearfix">
              <div class="col-sm-12 margin-bottom10"><span
                  class="label label-light  no-padding center"><b class="red">提示：活动一旦开启就不能再进行任何改动</b> </span>
              </div>
              <div class=" col-sm-6"><span
                  class="label label-lg arrowed-right no-padding">1 设置图文</span></div>
              <div class=" col-sm-6"><span
                  class="label label-lg label-success arrowed-in no-padding">2 活动规则</span></div>
            </div>
            <div class="tabbable clearfix">
              <!--内容开始了-->
              <div id="rule" class="tab-pane active ruleCont margin-top20">

                <form class="form-horizontal " name="myform" novalidate>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><span class="red">*</span>活动名称：</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-4" name="name"
                             ng-model="model['activity']['name']" required reg-char-len="30" prompt-msg="nameMsg" prompt-type="1" ng-trim="false" diff-zh="true">
                      <span class="inline padding5 red"
                            ng-if="myform.name.$error.required && isSubmit">必填项</span>
                      <span class="inline padding5" ng-class="{'red':myform.name.$error.exceed}" ng-bind="nameMsg"></span>
                    </div>
                  </div>

                  <div class="form-group margin-bottom5 clearfix">
                    <label class="col-sm-2 control-label"><span class="red">*</span>活动说明：</label>

                    <div class="col-sm-10">
                      <textarea class="col-sm-6 padding5" style="height:200px;" name="desc" ng-model="model['activity']['desc']" required reg-char-len="400" ng-trim="true" prompt-type="2" prompt-msg="descMsg"></textarea>
                      <span class="inline padding5 red" ng-if="myform.desc.$error.required && isSubmit">必填项</span>
                      <span class="inline padding5" ng-class="{'red':myform.desc.$error.exceed}" ng-bind="descMsg"></span>
                    </div>
                  </div>
                  <div class="form-group margin-bottom10 clearfix">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-10">
                      <span class="inline padding5 grey">(请按活动实际情况进行填写)</span>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><span class="red">*</span>活动时间：</label>

                    <div class="col-sm-8">
                      <div class="input-group col-sm-3 no-padding">
                        <input type="text" id="start_time"
                               class="Wdate form-control hasDatepicker"
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}',maxDate:'2030-10-01',onpicked:validateTime,oncleared:validateTime})"/>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                      </div>
                      <span class="float-left padding5">至</span>

                      <div class="input-group col-sm-3 no-padding">
                        <input type="text" id="end_time"
                               class="Wdate form-control hasDatepicker"
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}',maxDate:'2030-10-01',onpicked:validateTime,oncleared:validateTime})"/>
                        <span class="input-group-addon"> <i class="icon-calendar"></i></span>
                      </div>
                      <span class="padding5 red" id="validateResult"
                            style="display: none;"></span>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><span class="red">*</span>运费策略：</label>

                    <div class="col-sm-8">
                      <select class="col-sm-3" ng-model="model['postageSetting']['type']"
                              ng-options="o.id as o.title for o in postoption"
                              ng-change="changePosttype(model['postageSetting']['type'])">
                      </select>
                    </div>
                  </div>
                  <!--运费政策2-->
                  <div class="form-group clearfix" ng-show="isYuan">
                    <label class="col-sm-2 control-label"><span class="red">*</span>该秒杀订单满：</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-2 "
                             name="model['postageSetting']['amount']"
                             ng-model="postageAmout" maxlength="7">
                      <span class="inline padding5">元，免运费</span>
                      <span class="inline padding5 red" ng-show="isAmount">必填项</span>
                      <span class="inline padding5 red" ng-show="isAmountPat"
                        >请输入大于0的整数</span>
                    </div>
                  </div>
                  <!--运费政策3-->
                  <div class="form-group clearfix" ng-show="isJian">
                    <label class="col-sm-2 control-label"><span class="red">*</span>该秒杀订单满：</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-2 " name="model['postageSetting']['num']"
                             ng-model="model['postageSetting']['num']" maxlength="7">
                      <span class="inline padding5">件，免运费</span>
                      <span class="inline padding5 red" ng-show="isNum">必填项</span>
                                            <span class="inline padding5 red" ng-show="isNumPat"
                                              >请输入大于0的整数</span>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><span class="red">*</span>参加活动商品：</label>

                    <div class="col-sm-10">
                      <a data-toggle="modal" data-target="#productModal"
                         class="btn btn-xs btn-primary" ng-click="concatd()"> 选择商品 </a>
                    </div>
                  </div>
                  <div class="form-group margin-bottom10 clearfix">
                    <ng-form name="productForm" novalidate="novalidate">
                      <div class="table-responsive clearfix"
                           ng-show="productList.length">
                        <table
                          class="table table-striped table-bordered table-hover table-width">
                          <thead>
                          <tr>
                            <th width="15%">商品名称</th>
                            <th width="15%">规格</th>
                            <th width="15%">商品编码</th>
                            <th width="10%">商品分类</th>
                            <th width="8%">销售价</th>
                            <th width="8%">秒杀价</th>
                            <th width="6%">库存</th>
                            <th width="8%">配额</th>
                            <th width="10%">每人限购</th>
                            <th width="10%">操作</th>
                          </tr>
                          </thead>
                          <tbody id="tbody">
                          <tr ng-repeat="list in productList track by $index">
                            <td ng-bind="list.name"></td>
                            <td><span ng-repeat="kind in list.kinds"> {{kind.name}}:{{list.kindValues[$index].name}} </span>
                            </td>
                            <td ng-bind="list.sku_no"></td>
                            <td ng-bind="list.productName"></td>
                            <td ng-bind="list.retail_price/100"></td>
                            <td><input ng-show="!list.isShowEdit" type="text"
                                       class="col-sm-10" maxlength="7"
                                       ng-model="list.buy_price"
                                       ng-blur="changeText(list.buy_price, list, 0)">
                              <span ng-show="list.isShowEdit"
                                    ng-bind="list.buy_price"></span>
                            </td>
                            <td ng-bind="list.reserves"></td>
                            <td><input ng-show="!list.isShowEdit" type="text"
                                       class="col-sm-10" maxlength="7" ng-model="list.quota"
                                       ng-blur="changeText(list.quota, list, 1)">
                                                            <span ng-show="list.isShowEdit"
                                                                  ng-bind="list.quota"></span>
                            </td>
                            <td><input ng-show="!list.isShowEdit" type="text"
                                       class="col-sm-10" maxlength="7"
                                       ng-model="list.limit_buy"
                                       ng-blur="changeText(list.limit_buy, list, 2)">
                              <span ng-show="list.isShowEdit"
                                    ng-bind="list.limit_buy"></span>
                            </td>
                            <td>
                              <div class="action-buttons">
                                <a class="green pointer" ng-click="save($index, list)"
                                   ng-show="!list.isShowEdit"> <i
                                    class="icon-save bigger-130"></i> </a>
                                <a class="success pointer" ng-click="edit($index, list)"
                                   ng-show="list.isShowEdit"> <i
                                    class="icon-pencil bigger-130"></i> </a>
                                <a class="red pointer"
                                   ng-click="deleteProduct($index, list)"> <i
                                    class="icon-trash bigger-130"></i> </a>
                              </div>
                            </td>
                          </tr>
                          </tbody>
                        </table>
                      </div>
                    </ng-form>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">活动类型：</label>

                    <div class="col-sm-9">
                      <p>
                        <label>
                          <input name="offline" type="radio" class="ace" value="1"
                                 ng-model="model.activity.share_type" checked>
                          <span class="lbl"> 开放性活动&nbsp;&nbsp;</span>
                        </label>
                        <span class="grey margin-left10">（可在惊喜页列表中显示，允许分享）</span>
                      </p>

                      <p>
                        <label>
                          <input name="offline" type="radio" class="ace" value="2"
                                 ng-model="model.activity.share_type">
                          <span class="lbl"> 线下分享活动</span>
                        </label>
                        <span class="grey margin-left5">（不在惊喜页列表中显示，允许分享）</span>

                      </p>

                      <p>
                        <label>
                          <input name="offline" type="radio" class="ace" value="3"
                                 ng-model="model.activity.share_type">
                          <span class="lbl"> 线下活动 &nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </label>
                        <span class="grey margin-left12">（不在惊喜页列表中显示，禁止分享）</span>
                      </p>
                    </div>
                  </div>

                  <!--点击高级设置按钮，开始了-->
                  <div id="share">
                    <div class="form-group clearfix">
                      <label class="col-sm-2 control-label">活动主页面：</label>

                      <div class="col-sm-9">
                        <label class="float-left margin-top5"> <span
                            class="red">*</span>分享标题</label>
                        <input type="text" class="col-sm-4 margin-left10" name="heititle"
                               ng-model="model['shareMessage']['title']" required
                               ng-maxlength="36">
                        <span class="inline padding5 red"
                              ng-if="myform.heititle.$error.required && isSubmit"
                          >必填项</span>
                        <span class="inline padding5 red" ng-if="myform.heititle.$error.maxlength"
                          >字符个数需少36</span>
                        <span class="inline padding5 grey">（建议不超过36个字符）</span>
                      </div>
                    </div>

                    <div class="form-group  margin-bottom10 clearfix">
                      <label class="col-sm-2 control-label"> </label>

                      <div class="col-sm-9">
                        <label class="float-left margin-top5"> <span
                            class="red">*</span>分享描述</label>
                        <input type="text" class="col-sm-4 margin-left10" name="hdesc"
                               ng-model="model['shareMessage']['desc']" required
                               ng-maxlength="50">
                        <span class="inline padding5 red"
                              ng-if="myform.hdesc.$error.required && isSubmit">必填项</span>
                        <span class="inline padding5 red" ng-if="myform.hdesc.$error.maxlength"
                          >字符个数需少于50</span>
                        <span class="inline padding5 grey">（建议不超过50个字符）</span>
                      </div>
                    </div>

                    <div class="form-group margin-bottom10 clearfix">
                      <label class="col-sm-2 control-label"> </label>

                      <div class="col-sm-9">
                        <label class="float-left margin-top5"><span
                            class="red">*</span>分享图标</label>

                        <div class="ace-file-input col-sm-3 margin-left10 clearfix">
                          <a data-toggle="modal" data-target="#myModalImage">
                            <label class="file-label" data-title="选择"> <span
                                class="file-name file-name2 " data-title="点击上传图片..."> <i
                                  class="icon-upload-alt"></i> </span> </label>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-10">
                        <label class="float-left margin-left10 width51"></label>
                        <img ng-src="{{model['shareMessage']['documentLib']['file_cdn_path']}}"
                             width="100" height="100"/>
                      </div>
                    </div>
                  </div>

                  <!--点击高级设置按钮，结束了-->

                </form>
              </div>
              <!--内容结束了-->
            </div>
            <!-- 确定开始了 -->
          </div>


        </div>
        <div class="space-32"></div>
        <div class="modal-footer margin-auto" id="modal-footer">
          <a class="btn btn-infor" href="/second-kill/list"> 返回列表 </a>
          <a id="back" class="btn btn-primary"
             href="<?= Url::to(['/second-kill/edit-news']); ?>?id={{model.activity.id}}"> 上一步 </a>
          <a id="post" class="btn btn-primary" ng-click="saveBtn()"> 保存并关闭 </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- 弹出层 -->

<?php
echo $this->render('@app/views/product/index.php');
?>
<?php
echo $this->render('@app/views/uploadImg/imageIndex.php');
?>
<script src="/ace/js/DatePicker/WdatePicker.js"></script>
<script>
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
    //校验时间间隔不可超过四天
    if ((new Date(starttime.substr(0, 10))).getTime() + 4 * 86400000 < (new Date(endtime.substr(0, 10))).getTime()) {
      validateResult.text(' 时间间隔不可超过4天').show();
      setTimeout(function () {
        validateResult.hide();
      }, 2000);
      return false;
    }
    startT = +new Date(starttime) / 1000, endT = +new Date(endtime) / 1000;
    return true;
  }
  app.controller("mainController", function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ea');
    }, 100);
    $scope.istrue = false;
    $scope.model = JSON.parse('<?= addslashe(json_encode($model))?>');
    $scope.postageAmout = $scope.model.postageSetting.amount ? parseInt($scope.model.postageSetting.amount) / 100 : null;
    //andy 关联商品
    $scope.showEdit = false;//是否显示编辑商品
    $scope.numis = false;
    $scope.productList = [];
    $rootScope.productObj = {};
    //点击选择商品  关联商品
    $scope.concatd = function () {
      $rootScope.productObj = $scope.productList;
    };

    $scope.changeText = function (val, obj, index) {
      switch (index) {
        case 0:
          if (!val) return;
          if (!(/^([0-9]+\.[0-9]{1,2}|[1-9][0-9]*)$/).test(val)) {
            obj.buy_price = '';
            return alert('请输入正整数或者保留2位小数的数');
          }
          break;
        case 1:
          if (!val) return;
          if (!(/^[1-9][0-9]*$/).test(val)) {
            obj.quota = '';
            return alert('请输入整数');
          }
          if (parseInt(obj.limit_buy) && parseInt(obj.quota) < parseInt(obj.limit_buy)) {
            obj.quota = '';
            return alert('限购数量需小于等于配额');
          }
          break;
        case 2:
          if (!val) return;
          if (!(/^[1-9][0-9]*$/).test(val)) {
            obj.limit_buy = '';
            return alert('请输入整数');
          }
          if (parseInt(obj.quota) && parseInt(obj.quota) < parseInt(obj.limit_buy)) {
            obj.limit_buy = '';
            return alert('限购数量需小于等于配额');
          }
          break;
      }
    };
    //删除商品
    $scope.deleteProduct = function (index, obj) {
      //有id 指 已经保存到数据库
      if (obj.id) {
        wsh.setDialog('删除提示', '确定要删除该数据吗?', 'seckill-goods-del-ajax', {id: obj.id}, function () {
          $scope.productList.splice(index, 1);
          $scope.$apply();
        }, '删除成功');
      } else {
        wsh.setNoAjaxDialog('删除提示', '确定要删除该数据吗?', function () {
          obj.ischeck = false;
          $scope.productList.splice(index, 1);
          $scope.$apply();
        });
      }

    };
    //编辑
    $scope.edit = function (index, obj) {
      obj.isShowEdit = false;
    };
    //保存
    $scope.save = function (index, obj) {
      var input = $('#tbody').find('tr').eq(index).find('input');
      if (input.eq(0).val() && input.eq(1).val() && input.eq(2).val()) {
        if (obj.id) {
          console.log(obj.id);
          //走编辑接口
          $http.post('/second-kill/seckill-goods-update-ajax', {
            second_kill_id: $scope.model.secondKill.id,
            buy_price: obj.buy_price * 100,
            product_price: obj.retail_price * 100,
            quota: obj.quota,
            limit_buy: obj.limit_buy,
            id: obj.id
          })
            .success(function (msg) {
              wsh.successback(msg, '保存成功', false, function () {
                msg.errmsg.buy_price = msg.errmsg.buy_price / 100;
                $.extend($scope.productList[index], msg.errmsg);
                obj.isShowEdit = true;
              });
            });
        } else {
          //走新增接口
          $http.post('/second-kill/seckill-goods-add-ajax', {
            second_kill_id: $scope.model.secondKill.id,
            product_id: obj.product_id,
            product_sku_id: obj.product_sku_id,
            buy_price: obj.buy_price * 100,
            quota: obj.quota,
            limit_buy: obj.limit_buy,


          })
            .success(function (msg) {
              wsh.successback(msg, '保存成功', false, function () {
                msg.errmsg.product_price = msg.errmsg.product_price / 100;
                msg.errmsg.buy_price = msg.errmsg.buy_price / 100;
                $.extend($scope.productList[index], msg.errmsg);
                obj.isShowEdit = true;
              });
            });
        }
      } else {
        alert('请把信息完整!');
      }
    };
    //接收选择的商品数据   json 为一个二维数组
    $scope.$on('chooseProduct', function (e, json) {

      for (i in json) {
        for (j in json[i]) {
          for (k in json[i][j].productSkus) {
            json[i][j].productSkus[k].productName = json[i][j].productCategory.name;
            if (json[i][j].productSkus[k].id) {
              json[i][j].productSkus[k].product_sku_id = json[i][j].productSkus[k].id;
              delete json[i][j].productSkus[k].id;
            }
            if (json[i][j].productSkus[k].ischeck && json[i][j].productSkus[k].reserves) {
              $scope.productList.push(angular.copy(json[i][j].productSkus[k]));
            }
          }
        }
      }

      $scope.productList = wsh.unique($scope.productList, 'product_sku_id');
    });
    //ajax 获取关联的商品列表
    getSeckill();
    function getSeckill() {
      $http.post('seckill-goods-list-ajax', {
        '_page': 1,
        '_page_size': 100,
        id: $scope.model.secondKill.id
      })
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $.each(msg.errmsg.data, function (i, e) {
              $scope.productList[i] = {};
              $scope.productList[i].name = e.product.name;
              $scope.productList[i].productName = e.product.productCategory.name;
              $scope.productList[i].kindValues = e.productSku.kindValues;
              $scope.productList[i].kinds = e.productSku.kinds;
              $scope.productList[i].sku_no = e.productSku.sku_no;
              $scope.productList[i].retail_price = e.productSku.retail_price ? e.productSku.retail_price : e.product_price;
              $scope.productList[i].reserves = e.productSku.reserves;
              $scope.productList[i].buy_price = e.buy_price / 100;
              $scope.productList[i].limit_buy = e.limit_buy;
              $scope.productList[i].quota = e.quota;
              $scope.productList[i].id = e.id;
              $scope.productList[i].isShowEdit = true;
              $scope.productList[i].product_id = e.product_id;
              $scope.productList[i].product_sku_id = e.product_sku_id;
            });
          });
        });
    }

    //end 关联商品


    $('#start_time').val(wsh.getdate($scope.model.activity.start_time));
    $('#end_time').val(wsh.getdate($scope.model.activity.end_time));
    //运费策略
    if ($scope.model['postageSetting'].length == 0) {
      $scope.model['postageSetting']['type'] = 0;
    }
    $scope.isYuan = false, $scope.isJian = false;
    $scope.postoption = [{
      "id": 0,
      "title": "无运费优惠"
    }, {
      "id": 3,
      "title": "该秒杀订单免运费"
    }, {
      "id": 1,
      "title": "该秒杀订单满多少元免运费"
    }, {
      "id": 2,
      "title": "该秒杀订单满多少件免运费"
    }];
    if ($scope.model['postageSetting']['type'] == 1) {
      $scope.isYuan = true;
      $scope.isJian = false;
    }
    if ($scope.model['postageSetting']['type'] == 2) {
      $scope.isYuan = false;
      $scope.isJian = true;
    }
    $scope.changePosttype = function (id) {
      if (id == 0 || id == 3) {
        $scope.isYuan = false;
        $scope.isJian = false;
      } else if (id == 1) {
        $scope.isYuan = true;
        $scope.isJian = false;
      } else if (id == 2) {
        $scope.isYuan = false;
        $scope.isJian = true;
      }
      $scope.model['postageSetting']['type'] = id;
    }


    //分享图标
    $scope.images = [], $scope.isRequiredImg = false;
    if (!$scope.model['shareMessage']['documentLib']) {
      $scope.model['shareMessage']['documentLib'] = {};
    }

    $rootScope.isuploadOne = true;
    $scope.$on('ImageListChange', function (e, json) {
      $scope.model['shareMessage']['pic_id'] = json[0]["id"];
      $scope.model['shareMessage']['documentLib']['file_cdn_path'] = json[0]["file_cdn_path"];
    });
    $scope.$on('ImageChoose', function (e, json) {
      $scope.model['shareMessage']['pic_id'] = json[0]["id"];
      $scope.model['shareMessage']['documentLib']['file_cdn_path'] = json[0]["file_cdn_path"];
    });

    //保存按钮
    $scope.isAmount = false, $scope.isNum = false, $scope.isSubmit = false, $scope.isHeight = false;
    $scope.saveBtn = function () {
      if (!validateTime()) {
        return;
      }
      if ($scope.myform.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
      if ($scope.model['postageSetting']['type'] == 1) { //满金额包邮
        if (!$scope.postageAmout) {
          $scope.isAmount = true;
          return $timeout(function () {
            $scope.isAmount = false;
          }, 2000);
        }
        if (!(/^([0-9]+\.[0-9]{1,2}|[1-9][0-9]*)$/).test($scope.postageAmout)) {
          $scope.isAmountPat = true;
          return $timeout(function () {
            $scope.isAmountPat = false;
          }, 2000);
        }
      }
      if ($scope.model['postageSetting']['type'] == 2) { //满件包邮
        if (!$scope.model['postageSetting']['num']) {
          $scope.isNum = true;
          return $timeout(function () {
            $scope.isNum = false;
          }, 2000);
        }
        if (!(/^[1-9][0-9]*$/).test(parseInt($scope.model['postageSetting']['num']))) {
          $scope.isNumPat = true;
          return $timeout(function () {
            $scope.isNumPat = false;
          }, 2000);
        }
      }
      //判断秒杀商品是否处于编辑状态
      var isEdit = false;
      $.each($scope.productList, function (i, e) {
        if (!e.isShowEdit) {
          isEdit = true;
          return false;
        }
      });
      if (isEdit) {
        alert('请保存秒杀商品');
        return false;
      }
      if (!$scope.productList.length || !$scope.productList[0].id) {
        alert('请设置秒杀商品');
        return false;
      }
      var datas = {};
      if ($scope.model['postageSetting']['type'] == 0) { //无运费设置
        datas = {
          activity: {
            "id": $scope.model['activity']['id'],
            "name": $scope.model['activity']['name'],
            "desc": $scope.model['activity']['desc'],
            "expire_type": $scope.model['activity']['expire_type'],
            "postage_setting_id": 0,
            "start_time": startT,
            "end_time": endT,
            'share_type': $scope.model.activity.share_type
          },
          secondKill: {
            "id": $scope.model['secondKill']['id']
          },
          shareMessage: {
            "title": $scope.model['shareMessage']['title'],
            "desc": $scope.model['shareMessage']['desc'],
            "pic_id": $scope.model['shareMessage']['pic_id']
          }
        }
      } else {
        datas = {
          activity: {
            "id": $scope.model['activity']['id'],
            "name": $scope.model['activity']['name'],
            "desc": $scope.model['activity']['desc'],
            "expire_type": $scope.model['activity']['expire_type'],
            "start_time": startT,
            "end_time": endT,
            'share_type': $scope.model.activity.share_type
          },
          postageSetting: {
            "type": $scope.model['postageSetting']['type'],
            "num": $scope.model['postageSetting']['num'] ? $scope.model['postageSetting']['num'] : null,
            //dierci有问题
            "amount": $scope.postageAmout * 100 ? Math.floor($scope.postageAmout * 100) : null
          },
          secondKill: {
            "id": $scope.model['secondKill']['id']
          },
          shareMessage: {
            "title": $scope.model['shareMessage']['title'],
            "desc": $scope.model['shareMessage']['desc'],
            "pic_id": $scope.model['shareMessage']['pic_id']
          }
        }
      }
      $('#post').attr('disabled', 'disabled');
      $http.post(wsh.url + "edit-ajax", datas)
        .success(function (msg) {
          $('#post').removeAttr('disabled');
          wsh.successback(msg, '保存成功！', false, function () {
            window.location = 'list';
          });
        })
        .error(function (msg) {
          $('#post').removeAttr('disabled');
          wsh.successback(msg);
        });
    }
  });
</script>