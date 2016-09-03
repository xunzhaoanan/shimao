<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '新增现金红包';
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">
<link href="/ace/css/cashredpack.css" rel="stylesheet">

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
          <li>新增现金红包</li>
        </ul>
        <!-- .breadcrumb -->
        <!-- #nav-search -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <div class="space-10"></div>
            <div class="row">
              <div class="col-md-6">

                <form novalidate="novalidate" class="form-horizontal " name="myform">

                  <div class="form-group  clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>红包类型:</label>

                    <div class="col-sm-10">
                      <select class="width150" ng-model="model.type"
                              ng-options="o.id as o.title for o in redpackOption"
                              ng-change="change(model.type)">
                      </select>

                    </div>
                  </div>


                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>商户名:</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-8 no-float" ng-model="model.send_name" name="name"
                             placeholder="" required="required" reg-char-len="20" prompt-msg="nameMsg" prompt-type="1" ng-trim="false" diff-zh="true">
                      <span ng-show="myform.name.$error.required && isSubmit" class="red">必填项</span>
                      <span class="inline padding5" ng-class="{'red':myform.name.$error.exceed}" ng-bind="nameMsg"></span>

                    </div>
                  </div>


                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>红包名称:</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-8 no-float" ng-model="model.act_name"
                             name="act_name"  required="required" reg-char-len="20" prompt-msg="actNameMsg" prompt-type="1" ng-trim="false" diff-zh="true">
                      <span ng-show="myform.act_name.$error.required && isSubmit"
                            class="red">必填项</span>
                      <span class="inline padding5" ng-class="{'red':myform.act_name.$error.exceed}" ng-bind="actNameMsg"></span>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>祝福语:</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-8 no-float" ng-model="model.wishing"
                             placeholder="少于20个字符" maxlength="19" required="required" name="wish">
                      <span ng-show="myform.wish.$error.required && isSubmit" class="red">必填项</span>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>备注:
                    </label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-8 no-float" ng-model="model.remark" name="remark" reg-char-len="30" prompt-msg="remarkMsg" prompt-type="1" ng-trim="false" diff-zh="true" required="required">
                      <span ng-show="myform.remark.$error.required && isSubmit"
                            class="red">必填项</span>
                      <span class="inline padding5" ng-class="{'red':myform.remark.$error.exceed}" ng-bind="remarkMsg"></span>
                    </div>
                  </div>

                  <div class="form-group  clearfix" ng-show="model.type == 1">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>红包金额:
                    </label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-4 no-float" placeholder="单个红包金额，1-200元"
                             id="money" ng-model="money" name="money"
                             ng-pattern="" reg-money-with-one zero-fill>

                    </div>
                    <span ng-show="myform.money.$error.pattern" class="red margin-left10" ng-bind="$root.regMoneyWithOneText"></span>
                  </div>

                  <div class="form-group clearfix" ng-show="model.type ==2">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>金额区间:</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-2 no-float" ng-model="model.min_value"
                             name="min_value" placeholder="最小" reg-money-with-one
                             ng-pattern="" zero-fill>~<input
                        type="text" class="col-sm-2 no-float" ng-model="model.max_value"
                        name="max_value" placeholder="最大" reg-money-with-one ng-pattern=""
                        zero-fill>
                      <span>单位为元，最小为1元，最大为200元</span>
                      <span ng-show="myform.min_value.$error.pattern" class="block red margin-top3" ng-bind="$root.regMoneyWithOneText"></span>
                      <span ng-show="myform.max_value.$error.pattern" class="block red margin-top3" ng-bind="$root.regMoneyWithOneText"></span>

                    </div>


                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>红包数量:
                    </label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-4 no-float" required="required" value=""
                             ng-model="model.quantity" name="quantity" reg-int ng-pattern=""
                             placeholder="输入红包库存总量">

                    </div>
                    <span ng-show="myform.quantity.$error.required && isSubmit"
                          class="red margin-left10">必填项</span>
                    <span ng-show="myform.quantity.$error.pattern" class="red margin-left10" ng-bind="$root.regIntText"></span>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>是否启用:</label>

                    <div class="col-sm-10">
                      <label>
                        <input name="switch-field-1"
                               class="ace ace-switch ace-switch-6 ng-valid ng-dirty ng-valid-parse ng-touched"
                               my-check-box="[1,2]" ng-model="model.deleted" type="checkbox">
                        <span class="lbl no-margin-left" style="margin-top:3px;"></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group margin-bottom10 clearfix">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-10">
                      <p style="font-size: 20px;margin-left: -64px">该红包预计会发放
                        <b class="red" ng-show="model.type == 1 "
                           ng-bind="(money * model.quantity ? money * model.quantity : 0) | number:2"></b>
                        <b class="red" ng-show="model.type == 2"><span
                            ng-bind="(model.min_value && model.quantity ? (model.min_value * model.quantity) : 0) | number:2"></span>
                          ~ <span
                              ng-bind="(model.max_value && model.quantity ? (model.max_value * model.quantity) : 0) | number:2"></span>
                        </b>元
                      </p>
                    </div>
                  </div>

                  <div class="form-group margin-bottom10 clearfix">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-10">

                      <a class="btn btn-primary" ng-click="save()" id="submit">保存</a>
                      <a class="btn btn-grey" ng-href="/cash-redpack/list">返回</a>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-4">
                <div class="CashRedpackAdd">
                  <div class="preview_box">
                    <div class="preview ">
                      <div class="preview_t"><a id="second" class="cur">预览图1</a><a id="first"
                                                                                   class="">预览图2</a>
                      </div>
                      <div class="first" style="display:none">
                        <div class="t">
                          <div class="tit">微信红包</div>
                          <img
                              src="http://imgcache.vikduo.com/static/b1580662bbb3d272c6affc64bc6bea4f.jpg">
                        </div>
                        <div class="m">
                          <p>
                            <strong>你收到一个红包</strong>
                            <span class="date">7月09日</span>
                          </p>

                          <p>你参与<span id="actName" class="c57" ng-bind="model.act_name">抽奖活动</span>,成功获得<span
                              class="c57" ng-bind="model.send_name">微客多</span>赠送的红包，<span
                              id="mTitle" ng-bind="model.remark">备注</span></p>

                          <p class="intr">点击消息拆开红包即可获得现金</p>

                          <div class="d"><em>&gt;</em>详情</div>
                        </div>
                        <div class="f"><img
                            src="http://imgcache.vikduo.com/static/df2923ed68f414062fd86bc08ff9a291.jpg">
                        </div>
                      </div>
                      <div class="second" style="display:block">
                        <div class="t">
                          <div class="tit">微信红包</div>
                          <img
                              src="http://imgcache.vikduo.com/static/b1580662bbb3d272c6affc64bc6bea4f.jpg">
                        </div>
                        <div class="second_bg"><img
                            src="http://imgcache.vikduo.com/static/22da7ce774ede3df8d5af3782288f080.png">
                        </div>
                        <div class="second_c">
                          <img ng-src="{{shop.logo}}"
                               src="http://imgcache.vikduo.com/static/654abc371caf1231d3c8c426123321d1.png">
                          <span style="width: 200px;margin: 5px auto 0;" ng-bind="model.send_name">微客多</span>
                          <span class="gray">给你发了一个红包</span>
                          <span id="nTitle" ng-bind="model.wishing ?model.wishing:'恭喜发财！大吉大利！'"
                                style="width: 200px;margin: 10px auto 0; line-height: 1.2">恭喜发财！大吉大利！</span>
                        </div>
                        <div class="f"><img
                            src="http://imgcache.vikduo.com/static/b0cae6571f785e9fd243040c9cf116ad.jpg">
                        </div>
                      </div>
                      <div class="preview_f">
                        <h5>注：</h5>

                        <p>微信版本在6.1以下的用户由微信红包公众号下发领取消息，为预览2里的内容；</p>

                        <p>微信版本在6.1及以上的用户收到企业自身微信号下发领取消息；如果用户未关注微信号，那么会收到由“服务通知”下发的消息，为红包样式。</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.main-container-inner -->
  </div>

</div>


<script type="text/javascript">

  app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'eb');
    }, 100);

    $scope.model = {};
    $scope.model.wishing = '恭喜发财！大吉大利！';//默认祝福语
    $scope.shop = JSON.parse('<?= addslashe(json_encode($shop))?>');//商家
    $scope.model.send_name = $scope.shop.name;//商家名称
    //红包类型
    $scope.redpackOption = [
      {'id': 1, 'title': '微信固定金额红包'}, {'id': 2, 'title': '微信随机金额红包'}
    ];
    $scope.model.type = 1;//默认红包类型
    $scope.model.deleted = 2;
    $scope.model.can_share = 1; //TODO 初期默认可共享，不给选择
    $scope.isSubmit = false;
    var is_send_ajax = false;
    //保存
    $scope.save = function () {
      if (is_send_ajax) return;
      if ($scope.myform.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
      if ($scope.model.type == 1) {
        if (!$scope.money) return alert("请输入红包金额");
        $scope.model.min_value = $scope.money;
        $scope.model.max_value = $scope.money;
      } else {
        if (!$scope.model.min_value) return alert("请输入最小金额");
        if (!$scope.model.max_value) return alert("请输入最大金额");
        if (parseFloat($scope.model.min_value) > parseFloat($scope.model.max_value)) return alert("最小金额不能大于最大金额");
      }
      is_send_ajax = true;
      $http.post("/cash-redpack/add-ajax",
          {
            "type": $scope.model.type,
            "act_name": $scope.model.act_name,
            "send_name": $scope.model.send_name,
            "wishing": $scope.model.wishing,
            "remark": $scope.model.remark,
            "min_value": $scope.model.min_value * 100,
            "max_value": $scope.model.max_value * 100,
            "quantity": $scope.model.quantity,
            "deleted": $scope.model.deleted,
            "can_share": $scope.model.can_share
          })
          .success(function (msg) {
            wsh.successback(msg, '添加成功', false, function () {
              window.location.href = "/cash-redpack/list"
            });
            is_send_ajax = false;
          }).error(function () {
            alert("服务器忙！");
            is_send_ajax = false;
          });

    };
     //红包类型切换时的事件
    $scope.change = function (type) {

      $scope.model = {};
      $scope.money = "";
      $scope.model.wishing = '恭喜发财！大吉大利！';
      $scope.model.send_name = $scope.shop.name;
      $scope.model.type = type;
    }

  });
</script>

<script type="text/javascript">
  $("#first").click(function () {
    $("#second").removeClass("cur");
    $(this).addClass("cur");
    $(".second").hide();
    $(".first").show();

  });
  $("#second").click(function () {
    $("#first").removeClass("cur");
    $(this).addClass("cur");
    $(".first").hide();
    $(".second").show();
  })
</script>