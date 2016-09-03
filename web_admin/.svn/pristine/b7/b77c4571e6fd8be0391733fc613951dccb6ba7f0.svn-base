<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '编辑现金红包';
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
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/marketing.php');?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>编辑现金红包</li>
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
                      <select class="width150 " ng-model="model.type"
                              ng-options="o.id as o.title for o in redpackOption" disabled>
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
                             name="act_name" required="required" reg-char-len="20" prompt-msg="actNameMsg" prompt-type="1" ng-trim="false" diff-zh="true">
                      <span ng-show="myform.act_name.$error.required && istrue"
                            class="red">必填项</span>
                      <span class="inline padding5" ng-class="{'red':myform.act_name.$error.exceed}" ng-bind="actNameMsg"></span>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>祝福语:</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-8 no-float" ng-model="model.wishing"
                             placeholder="" maxlength="19" required="required" name="wish">
                      <span ng-show="myform.wish.$error.required && istrue" class="red">必填项</span>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>备注:
                    </label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-8 no-float" ng-model="model.remark" name="remark"  reg-char-len="30" prompt-msg="remarkMsg" prompt-type="1" ng-trim="false" diff-zh="true" required="required">
                      <span ng-show="myform.remark.$error.required && istrue" class="red">必填项</span>
                      <span class="inline padding5" ng-class="{'red':myform.remark.$error.exceed}" ng-bind="remarkMsg"></span>
                    </div>
                  </div>

                  <div class="form-group  clearfix" ng-if="model.type == 1">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>红包金额:
                    </label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-4 no-float" ng-model="model.money" readonly
                             placeholder="单个红包金额，1-200元" name="money" reg-money-with-one
                             ng-pattern="">

                      <span ng-show="myform.money.$error.pattern" class="red margin-left10" ng-bind="$root.regMoneyWithOneText"></span>
                    </div>
                  </div>

                  <div class="form-group  clearfix" ng-if="model.type ==2">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>金额区间:</label>

                    <div class="col-sm-10">
                      <input type="text" readonly class="col-sm-2 no-float" placeholder="最小"
                             ng-model="model.min_value" name="min_value" reg-money-with-one
                             ng-pattern="">~<input type="text" class="col-sm-2 no-float"
                                                   placeholder="最大" ng-model="model.max_value"
                                                   readonly name="max_value" reg-money-with-one
                                                   ng-pattern="">
                      <span>单位为元，最小为1元，最大为200元</span>
                      <span ng-show="myform.min_value.$error.pattern" class="red margin-left10" ng-bind="$root.regMoneyWithOneText"></span>
                      <span ng-show="myform.max_value.$error.pattern" class="red margin-left10" ng-bind="$root.regMoneyWithOneText"></span>
                    </div>
                  </div>

                  <div class="form-group  clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>红包数量:
                    </label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-4 no-float" readonly
                             ng-model="model.quantity" placeholder="输入红包库存总量" reg-int-and-zero
                             ng-pattern="">
                    </div>
                  </div>

                  <div class="form-group  clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>是否启用:</label>

                    <div class="col-sm-10">
                      <label>
                        <input name="switch-field-1"
                               class="ace ace-switch ace-switch-6 ng-valid ng-dirty ng-valid-parse ng-touched"
                               my-check-box="" ng-model="model.deleted" type="checkbox">
                        <span class="lbl no-margin-left" style="margin-top:3px;"></span>
                      </label>
                    </div>
                  </div>

                  <div class="form-group margin-bottom10 clearfix">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-10">
                      <p style="font-size: 20px;margin-left: -64px">该红包预计会发放
                        <b class="red" ng-show="model.type == 1 "
                           ng-bind="(model.money * model.quantity ? model.money * model.quantity : 0) | number:2"></b>
                        <b class="red" ng-show="model.type == 2"><span
                            ng-bind="(model.min_value && model.quantity ? (model.min_value * model.quantity) : 0) | number:2"></span>
                          ~ <span ng-bind="(model.max_value && model.quantity ? (model.max_value * model.quantity) : 0) | number:2"></span>
                        </b>元
                      </p>
                    </div>
                  </div>

                  <div class="form-group margin-bottom10 clearfix">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-10">

                      <a class="btn btn-primary" ng-click="edit()" id="submit">保存</a>
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
                          <span ng-bind="model.send_name" style="width: 200px;margin: 5px auto 0;">微客多</span>
                          <span class="gray">给你发了一个红包</span>
                          <span id="nTitle" ng-bind="model.wishing"
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
    $scope.model = JSON.parse('<?= addslashe(json_encode($model))?>');
    //红包类型
    $scope.redpackOption = [
      {"id": 1, "title": "微信固定金额红包"}, {"id": 2, "title": "微信随机金额红包"}
    ];
    $scope.model.money = ( $scope.model.max_value / 100).toFixed(2);
    $scope.model.money = ( $scope.model.min_value / 100).toFixed(2);
    $scope.model.min_value = ( $scope.model.min_value / 100).toFixed(2);//红包最小金额
    $scope.model.max_value = ( $scope.model.max_value / 100).toFixed(2);;//红包最大金额
    $scope.isSubmit = false;
    var is_send_ajax = false;
    //编辑
    $scope.edit = function () {
      if (is_send_ajax) return false;
      if ($scope.myform.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }

      is_send_ajax = true;
      $http.post(wsh.url + "edit-ajax",
          {
            "id": $scope.model.id,
            "type": $scope.model.type,
            "act_name": $scope.model.act_name,
            "send_name": $scope.model.send_name,
            "wishing": $scope.model.wishing,
            "remark": $scope.model.remark,
            "deleted": $scope.model.deleted,
            "can_share": $scope.model.can_share
          })
          .success(function (msg) {
            wsh.successback(msg, '编辑成功', false, function () {
              window.location.href = "/cash-redpack/list"
            });
            is_send_ajax = false;
          }).error(function () {
            alert("服务器忙！");
            is_send_ajax = false;
          });

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