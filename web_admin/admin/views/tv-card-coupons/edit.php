<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '编辑摇电视卡券';
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">
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
          <li>编辑摇电视卡券</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="tabbable clearfix">

              <!--手机里面的样式开始了-->
              <div class="weileft col-sm-push-1 col-sm-3">
                <div class="weileftda" id="phone_page1">
                  <div class="card_box" id="myTab">
                    <div class="card_hbg bgColor" data-toggle="tab" href="#cardset0"
                         style="background-color:#52bd42;">
                      <div class="card_hlogo pointer">
                        <a class="card_setbtn">
                        <span class="merchants_logo"> <img ng-src="{{model.logo_url}}" width="100%"
                                                           height="100%"
                                                           title="logo"/> </span>
                          <strong title="{{model.brand_name}}"
                                  style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;padding:0px 5px;"
                                  ng-bind="model.brand_name"></strong>
                          <strong ng-bind="model.title"></strong>
                        </a>
                      </div>
                    </div>
                    <div class="card_setitem margin-bottom10"><a data-toggle="tab"
                                                                 class="card_setbtn"
                                                                 href="#cardset1">销券设置</a>
                    </div>
                    <div class="card_item border-top  padding-left10">
                      <div class="card_col clearfix"><a data-toggle="tab" class="card_setbtn"
                                                        href="#cardset2">卡券详情</a> <i
                          class="icon-chevron-right"></i></div>
                    </div>
                    <div class="card_item border-bottom padding-left10 margin-bottom10">
                      <div class="card_col clearfix"><a data-toggle="tab" class="card_setbtn"
                                                        id="threeShow" href="#cardset3">适用门店</a> <i
                          class="icon-chevron-right"></i></div>
                    </div>
                    <div class="card_item border-top  padding-left10">
                      <div class="card_col clearfix">
                        <a data-toggle="tab" class="card_setbtn" href="#cardset4"
                           ng-show="!model.custom_url_name">自定义入口1</a>
                        <a data-toggle="tab" class="card_setbtn" href="#cardset4"
                           ng-show="model.custom_url_name">{{model.custom_url_name}}</a>
                        <i
                          class="icon-chevron-right"></i></div>
                    </div>
                    <div class="card_item border-bottom padding-left10 margin-bottom10">
                      <div class="card_col clearfix">
                        <a data-toggle="tab" class="card_setbtn" href="#cardset5"
                           ng-show="!model.promotion_url_name">自定义入口2</a>
                        <a data-toggle="tab" class="card_setbtn" href="#cardset5"
                           ng-show="model.promotion_url_name">{{model.promotion_url_name}}</a>
                        <i
                          class="icon-chevron-right"></i></div>
                    </div>
                  </div>
                </div>

              </div>
              <!--手机里面的样式结束了-->

              <div class="tab-content no-border col-sm-push-1 col-sm-7">

                <!--基础设置开始了-->
                <div id="cardset0" class="tab-pane active">
                  <div class="card_setcont clearfix">
                    <ng-form class="form-horizontal" name="form1">
                      <h4 class="header paddingnone">基础设置</h4>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">商户名称：</label>

                        <div class="col-sm-10">
                          <input type="text" class="col-sm-6" ng-model="model.brand_name" disabled
                                 maxlength="36" name="brand_name"
                                 required>
                          <span class="red" ng-show="form1.brand_name.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                          <span class="red" ng-show="form1.brand_name.$error.maxlength && isSubmit">汉字字数限制在12</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">卡券名称：</label>

                        <div class="col-sm-10">
                          <input type="text" class="col-sm-6" ng-model="model.title" disabled
                                 maxlength="50" name="title"
                                 required>
                          <span class="red" ng-show="form1.title.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                          <span class="red" ng-show="form1.title.$error.maxlength && isSubmit">字数限制在50个字符</span>
                        </div>
                      </div>
                      <div class="form-group margin-bottom10">
                        <label class="col-sm-2 control-label">卡券LOGO：</label>

                        <div class="col-sm-10">
                          <div>
                            <img ng-src="{{model.logo_url}}" width="125px" height="125px">
                          </div>
                        </div>
                      </div>
                      <div class="form-group ">
                        <label class="col-sm-2 control-label">卡券颜色：</label>

                        <div class="col-sm-10">
                          <div class="position-relative">
                            <input type="text" class="col-sm-6 margin-right10" id="selectColor"
                                   placeholder="点击选择卡券的颜色"
                                   readonly ng-click="colorClick()">
                            <span class="red" ng-show="isColor">{{$root.regRequiredText}}</span>
                            <table class="color_box" cellpadding="1" cellspacing="2" id="tips"
                                   ng-show="isColor">
                              <tbody>
                              <tr>
                                <td id="color"></td>
                                <td id="color1"></td>
                                <td id="color2"></td>
                                <td id="color3"></td>
                                <td id="color4"></td>
                                <td id="color5"></td>
                              </tr>
                              <tr>
                                <td id="color6"></td>
                                <td id="color7"></td>
                                <td id="color8"></td>
                                <td id="color9"></td>
                                <td id="color10"></td>
                                <td id="color11"></td>
                              </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">有效日期：</label>

                        <div class="col-sm-10" style="width: 9%">
                          <span ng-bind="effectTime(model.date_info_type)"></span>
                        </div>

                        <div class="col-sm-10" style="width: 60%" ng-if="model.date_info_type == 1">
                          <input type="text" id="start_time" ng-disabled="model.card_type == 2" class="col-sm-3 no-float"
                                 onfocus="WdatePicker({minDate:'%y-%M-#{%d}', maxDate:'#F{$dp.$D(\'start_end\')}', dateFmt:'yyyy-MM-dd'})">
                          <span class="inline padding5">至</span>
                          <!--截止日期要大于开始日期+1-->
                          <input type="text" id="start_end" class="col-sm-3 no-float"
                                 onfocus="WdatePicker({minDate:'#F{$dp.$D(\'start_time\', {d:1})||\'%y-%M-{%d+1}\'}', dateFmt:'yyyy-MM-dd'})">
                        </div>

                        <div class="col-sm-10" style="width: 60%" ng-if="model.date_info_type == 2">
                          领取后
                          <span ng-bind="beginFun(model.begin)"></span>
                          <span>天生效，有效天数</span>
                          <span ng-bind="model.end"></span>
                          天
                        </div>
                      </div>
                      <!--卡券类型开始了-->
                      <div class="form-group">
                        <label class="col-sm-2 control-label">卡券类型：</label>

                        <div class="col-sm-10">
                          <select class="col-sm-6" ng-model="model.wx_card_type"
                                  ng-options="o.wx_card_type as o.name for o in wxTypeSelect"
                                  disabled></select>
                        </div>
                      </div>

                      <div ng-show="model.wx_card_type==1 || model.wx_card_type==2">
                        <!--<div>-->
                        <div class="form-group" ng-show="model.wx_card_type==1">
                          <label class="col-sm-2 control-label">优惠金额：</label>

                          <div class="col-sm-10">
                            <div class="input-group col-sm-6 no-padding">
                              <input type="text" class="form-control" ng-model="card_money"
                                     placeholder="大于0的数，若是小数则保留2位小数"
                                     maxlength="10"
                                     name="card_money" disabled>
                              <span class="input-group-addon">元</span>
                            </div>
                    <span class="red"
                          ng-show="isType1">{{$root.regRequiredText}}</span>
                            <span class="red" ng-show="isType1Pat">{{$root.regMoneyText}}</span>
                          </div>
                        </div>
                        <div class="form-group" ng-show="model.wx_card_type==2">
                          <label class="col-sm-2 control-label">卡券折扣：</label>

                          <div class="col-sm-10">
                            <div class="input-group col-sm-6 no-padding">
                              <input type="text" class="form-control" ng-model="card_discount"
                                     placeholder="输入小于10的正数，最多一位小数"
                                     maxlength="10"
                                     name="card_discount" disabled>
                              <span class="input-group-addon">折</span>
                            </div>
                    <span class="red"
                          ng-show="isType2">{{$root.regRequiredText}}</span>
                            <span class="red" ng-show="isType2Pat">{{$root.regMoneyText}}</span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">最低消费金额：</label>

                          <div class="col-sm-10">
                            <label ng-click="LimitClick()">
                              <input name="offline" type="radio" class="ace" value="1"
                                     ng-model="priceLimit" disabled>
                              <span class="lbl"> 无金额限制 </span>
                            </label>
                            <label>
                              <input name="offline" type="radio" class="ace" value="2"
                                     ng-model="priceLimit" disabled>
                              <span class="lbl" style="margin-right: 2px;"> 满</span>
                              <input type="text" class="width51" ng-readonly="priceLimit==1"
                                     ng-model="money_limit"
                                     maxlength="10"
                                     name="money_limit" disabled>
                              <span class="lbl"> 元可以使用 </span>
                            </label>
                          </div>
                        </div>
                        <div class="form-group"
                             ng-show="isMoney">
                          <label class="col-sm-2 control-label"></label>

                          <div class="col-sm-10">
                            <span class="red">{{$root.regRequiredText}}</span>
                          </div>
                        </div>
                        <div class="form-group" ng-show="isMoneyPat">
                          <label class="col-sm-2 control-label"></label>

                          <div class="col-sm-10">
                            <span class="red">{{$root.regMoneyWithText}}</span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">可使用商品：</label>

                          <div class="col-sm-10">
                            <label ng-click="goodsClick()">
                              <input name="goods" type="radio" class="ace" value="1"
                                     ng-model="goodsm">
                              <span class="lbl"> 全店通用 </span>
                            </label>
                            <label>
                              <input name="goods" type="radio" class="ace" value="2"
                                     ng-model="goodsm">
                              <span class="lbl"> 指定商品</span>
                            </label>
                          </div>
                        </div>
                        <div class="form-group clearfix" ng-show="goodsm == 2">
                          <label class="col-sm-2 control-label"><span class="red"></span></label>

                          <div class="col-sm-10">
                            <a data-toggle="modal"
                               data-target="#productModal"
                               class="btn btn-xs btn-primary"> 选择商品 </a>
                             <span class="red"
                                   ng-show="isChooseP">请选择商品</span>

                          </div>
                        </div>
                      </div>
                      <div ng-show="model.wx_card_type==3">
                        <div class="form-group">
                          <label class="col-sm-2 control-label">兑换内容：</label>

                          <div class="col-sm-10">
                            <div class="input-group col-sm-6 no-padding">
                              <input type="text" class="form-control"
                                     ng-model="model.exchange_content_text"
                                     placeholder="填写兑换内容的名称，例：兑换奥利奥饼干一包"
                                     maxlength="50"
                                     name="kindc" disabled>
                            </div>
                    <span class="red"
                          ng-show="isshiwucontent">{{$root.regRequiredText}}</span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label"></label>

                          <div class="col-sm-10 grey">
                            （礼品券用于线下实物兑换，请在“卡券详情-使用须知”中详细描述兑换方法）
                          </div>
                        </div>
                      </div>
                      <!--商品表格-->
                      <div class="form-group margin-top10"
                           ng-show="producChoosL.length > 0 && goodsm == 2 && model.wx_card_type != 3">
                        <label class="col-sm-2 control-label"></label>

                        <div class=" col-sm-10">
                          <table class="table table-striped table-bordered table-hover table-width">
                            <thead>
                            <tr>
                              <th width="42%">商品名称</th>
                              <th width="12%">库存</th>
                              <th width="12%">状态</th>
                              <th width="12%">销售价</th>
                              <th width="12%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="products" ng-repeat="list in producChoosL"
                                ng-show="!list.isshow">

                              <td ng-bind="list.name"></td>
                              <td ng-bind="list.reserves"></td>
                              <td ng-if="list.productInfo
.deleted== 3" class="red">已删除
                              </td>
                              <td ng-if="list.status == 1 && list.productInfo
.deleted != 3">上架
                              </td>
                              <td ng-if="list.status == 2 && list.productInfo
.deleted != 3">下架
                              </td>
                              <td ng-bind="list.productSkus[0].retail_price | price"></td>
                              <td ng-click="delProductFun(list.id)">
                                <div
                                  class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                                  <a class="red pointer" title="删除">
                                    <i class="icon-shanchu bigger-140"></i>
                                  </a>
                                </div>
                              </td>
                            </tr>
                            </tbody>
                          </table>
                        </div>
                        <div ng-paginate options="option3" page="page3"></div>
                      </div>

                      <!--卡券类型结束了-->

                    </ng-form>
                  </div>
                </div>
                <!--基础设置结束了-->

                <!-- 销券设置开始了 -->
                <div id="cardset1" class="tab-pane">
                  <div class="card_setcont clearfix">
                    <h4 class="header paddingnone">领券设置</h4>
                    <ng-form class="form-horizontal" name="form2">

                      <div class="form-group">
                        <label class="col-sm-2 control-label">生成数量：</label>

                        <div class="col-sm-10">
                          <div class="input-group col-sm-6 no-padding">
                            <input type="text" class="form-control" ng-model="model.quantity"
                                   disabled>
                            <span class="input-group-addon">张</span>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">领取限制：</label>

                        <div class="col-sm-10">
                          <div class="input-group col-sm-6 no-padding">
                            <input type="text" class="form-control" ng-model="model.get_limit"
                                   name="getlimit" maxlength="8"
                                   required ng-pattern="" reg-int>
                            <span class="input-group-addon">张</span>
                          </div>
                    <span class="red"
                          ng-show="form2.getlimit.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                          <span class="red" ng-show="form2.getlimit.$error.pattern">{{$root.regIntText}}</span>
                          <span class="red" ng-show="showQuantityText()">领取限制应小于等于生成数量</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label"></label>

                        <div class="col-sm-10">
                          <input name="form-field-radio01" type="checkbox" disabled class="ace"
                                 ng-model="model.can_give_friend"
                                 my-check-box="[1,2]"><span class="lbl">用户领券后可转赠其他好友 </span>
                        </div>
                      </div>

                      <h4 class="header paddingnone">销券设置</h4>

                      <div class="form-group margin-bottom10">
                        <label class="col-sm-2 control-label">销券方式：</label>

                        <div class="col-sm-10">
                          <div class="item">
                            <label><input name="radio01" type="radio" class="ace" value="1"
                                          ng-model="model.code_type"><span
                                class="lbl">序列号 </span> </label>

                            <div class="grey">显示卡券号，验证后可进行销券</div>
                          </div>
                          <div class="item">
                            <label><input name="radio01" type="radio" class="ace" value="3"
                                          ng-model="model.code_type"><span
                                class="lbl">二维码 </span> </label>

                            <div class="grey">显示二维码，验证后可进行销券</div>
                          </div>
                          <div class="item">
                            <label> <input name="radio01" type="radio" class="ace" value="2"
                                           ng-model="model.code_type"><span class="lbl">条形码 </span>
                            </label>

                            <div class="grey">显示条形码，验证后可进行销券</div>
                          </div>
                          <div class="text-warning bigger-110 orange font-size12"><i
                              class="icon-exclamation-triangle"></i>
                            提示：本系统暂不支持条形码，选择条形码将以二维码形式展示，若同步微信卡包则展示条形码
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">引导提示：</label>

                        <div class="col-sm-10">
                          <input type="text" class="col-sm-6" ng-model="model.notice" name="notice"
                                 maxlength="16">
                          <span class="red" ng-show="form2.notice.$error.maxlength && isSubmit">字数限制在16个字符</span>
                        </div>
                      </div>
                    </ng-form>
                  </div>
                </div>
                <!-- 销券设置结束了 -->

                <!-- 卡券详情 -->
                <div id="cardset2" class="tab-pane">
                  <div class="card_setcont clearfix">
                    <h4 class="header paddingnone">卡券详情</h4>
                    <ng-form class="form-horizontal" name="form3">
                      <div class="form-group margin-bottom10">
                        <label class="col-sm-2 control-label">卡券详情：</label>

                        <div class="col-sm-10">
                          <textarea class="col-sm-6 form-control minheight-200px" name="deal_detail" ng-model="model.deal_detail" reg-char-len="300" ng-trim="true" prompt-type="2" prompt-msg="deal_detail"></textarea>
                          <span class="inline padding5" ng-class="{'red':form3.deal_detail.$error.exceed}" ng-bind="deal_detail"></span>
                        </div>
                      </div>
                      <div class="form-group margin-bottom10">
                        <label class="col-sm-2 control-label">使用须知：</label>

                        <div class="col-sm-10">
                          <textarea class="col-sm-6 form-control minheight-200px" ng-model="model.description" name="description" reg-char-len="300" ng-trim="true" prompt-type="2" prompt-msg="description"></textarea>
                          <span class="inline padding5" ng-class="{'red':form3.description.$error.exceed}" ng-bind="description"></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">客服电话：</label>

                        <div class="col-sm-10">
                          <input type="text" class="col-sm-6" ng-model="model.service_phone"
                                 name="servicephone"
                                 placeholder="请输入手机或固话" required ng-pattern="" reg-mobile>
                    <span class="red"
                          ng-show="form3.servicephone.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                          <span class="red" ng-show="form3.servicephone.$error.pattern">{{$root.regMobileText}}</span>

                        </div>
                      </div>

                    </ng-form>
                  </div>
                </div>
                <!-- 卡券详情 -->

                <!-- 适合门店 -->
                <div id="cardset3" class="tab-pane">
                  <div class="card_setcont clearfix">
                    <!--<h4 class="header paddingnone">同步设置</h4>-->

                    <!--<div class="form-group">-->
                    <!--<div class="col-sm-offset-2 col-sm-10">-->
                    <!--&lt;!&ndash;card_type 1, 不选中，2，选中&ndash;&gt;-->
                    <!--<label><input name="form-field-radio01" type="checkbox" class="ace" ng-model="card_type"-->
                    <!--my-check-box disabled><span class="lbl">用户领取后同步到微信卡包 </span> </label>-->

                    <!--<div class="text-warning bigger-110 orange font-size12"><i class="icon-exclamation-triangle"></i>-->
                    <!--提示：只有在微信公众平台开通卡券功能的用户才能使用本设置-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</div>-->

                    <h4 class="header paddingnone">服务信息</h4>

                    <form class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">适用门店：</label>

                        <div class=" col-sm-10">
                          <select ng-model="model.assign"
                                  ng-options="o.id as o.name for o in assignOptions"
                                  ng-change="assignChange(model.assign)"></select>
                        </div>
                      </div>
                      <div ng-show="model.assign == 1">
                        <div class="form-group">
                          <label class="col-sm-2 control-label"></label>

                          <div class=" col-sm-10">
                            <table
                              class="table table-striped table-bordered table-hover table-width">
                              <!--range, array-->
                              <thead>
                              <tr>
                                <th width="3%" class="lt-width3 text-center"><label>
                                    <input type="checkbox" class="ace" ng-model="isCheckAll"
                                           ng-change="checkAllFun(isCheckAll)">
                                    <span class="lbl"></span> </label>
                                </th>
                                <th width="15%">门店名称</th>
                                <th width="20%">地址</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr ng-repeat="list in storeList">
                                <td class="lt-width3 text-center"><label>
                                    <input type="checkbox" class="ace" ng-model="list.isCheck"
                                           ng-change="choose(list)">
                                    <span class="lbl"></span> </label></td>
                                <td ng-bind="list.shopInfo.name"></td>
                                <td ng-bind="list.shopInfo.address"></td>
                              </tr>
                              <td colspan="3" ng-show="!storeList.length" class="red text-center"
                                  ng-cloak>暂无数据
                              </td>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div ng-paginate options="options" page="page"></div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- 适合门店 -->

                <!-- 自定义入口1 -->
                <div id="cardset4" class="tab-pane">
                  <div class="card_setcont clearfix">
                    <h4 class="header paddingnone">自定义入口1</h4>

                    <ng-form name="form4" class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">自定义入口1名称：</label>

                        <div class=" col-sm-10">
                          <input type="text" class="col-sm-6" name="cosname"
                                 ng-model="model.custom_url_name" maxlength="5" required>
                          <span class="red" ng-show="form4.cosname.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                          <span class="red" ng-show="form4.cosname.$error.maxlength && isSubmit">字数限制在5个字符</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">地址链接：</label>

                        <div class=" col-sm-10">
                          <input type="text" class="col-sm-6 " id="tipurl1"
                                 ng-model="model.custom_url" maxlength="100" name="cusurl" required
                                 ng-pattern="/^(http|https):\/\//"
                                 placeholder="以http://或https://开头">
                          <span class="red" ng-show="form4.cusurl.$error.pattern">请填写带http://或https://的地址</span>
                          <span class="red" ng-show="form4.cusurl.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">入口右侧的tips：</label>

                        <div class=" col-sm-10">
                          <input type="text" class="col-sm-6 " ng-model="model.custom_url_sub_title"
                                 maxlength="6" name="custips" required>
                          <span class="red" ng-show="form4.custips.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                          <span class="red" ng-show="form4.custips.$error.maxlength && isSubmit">字数限制在6个字符</span>
                        </div>
                      </div>
                    </ng-form>
                  </div>
                </div>
                <!-- 自定义入口1 -->

                <!-- 自定义入口2 -->
                <div id="cardset5" class="tab-pane">
                  <div class="card_setcont clearfix">
                    <h4 class="header paddingnone">自定义入口2</h4>

                    <ng-form class="form-horizontal" name="form5">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">自定义入口2名称：</label>

                        <div class=" col-sm-10">
                          <input type="text" class="col-sm-6 " ng-model="model.promotion_url_name"
                                 name="proname" maxlength="5" required>
                          <span class="red" ng-show="form5.proname.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">地址链接：</label>

                        <div class=" col-sm-10">
                          <input type="text" class="col-sm-6" id="tipurl2"
                                 ng-model="model.promotion_url" maxlength="100" name="prourl"
                                 placeholder="以http://或https://开头" ng-pattern="/^(http|https):\/\//"
                                 required>
                          <span class="red" ng-show="form5.prourl.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                          <span class="red" ng-show="form5.prourl.$error.pattern">请填写带http://或https://的地址</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">入口右侧的tips：</label>

                        <div class=" col-sm-10">
                          <input type="text" class="col-sm-6"
                                 ng-model="model.promotion_url_sub_title" name="protip"
                                 maxlength="6" required>
                          <span class="red" ng-show="form5.protip.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                        </div>
                      </div>


                    </ng-form>
                  </div>
                </div>
                <!-- 自定义入口2 -->
              </div>
            </div>


          </div>
        </div>
        <div class="space-32"></div>
        <!-- 确定 -->
        <div class="modal-footer margin-auto" id="modal-footer">
          <a href="list" class="btn btn-infor"> 返回 </a>
          <a class="btn btn-primary" ng-click="saveBtnEdit()" ng-disabled="isDisable"> 保存并关闭 </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
echo $this->render('@app/views/uploadImg/imageIndex.php');
?>
<?php
echo $this->render('@app/views/product/cardProduct.php');
?>

<script language="javascript" type="text/javascript"
        src="/ace/js/DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http, $filter) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ed');
    }, 100);

    $http.post('/tv-card-coupons/check-card-fn-ajax', {}).
      success(function (msg) {
        wsh.successback(msg, "", false, function () {
          $scope.cardCardFn = msg.errmsg;
          if (!$scope.cardCardFn) {
            alert('该账号未在微信公众平台开通卡券功能，无法创建卡券，确认后返回列表页');
            window.location.href = '/tv-card-coupons/list';
          }
        });
      }).
      error(function (msg) {
        console.log(msg);
        alert('该账号未在微信公众平台开通卡券功能，无法创建卡券，确认后返回列表页!');
        window.location.href = '/tv-card-coupons/list';
      });

    $scope.model = JSON.parse('<?= addslashe(json_encode($model))?>');
    $scope.card_money = $scope.model.card_money / 100;
    $scope.money_limit = $scope.model.money_limit / 100 ? $scope.model.money_limit / 100 : '';
    $scope.card_discount = Number($scope.model.card_discount).toFixed(1);

    $('#selectColor').val($scope.model.color);
    $('#myTab .card_hbg').css('background-color', $scope.model.color);
    var data = $filter('date');
    setTimeout(function () {
      $('#start_time').val(data($scope.model.begin * 1000, 'yyyy-MM-dd')), $('#start_end').val(data($scope.model.end * 1000, 'yyyy-MM-dd'));
    }, 1000);
    $scope.effectTime = function (date_info_type) {
      if (date_info_type == 1) {
        return '固定日期';
      } else if (date_info_type == 2) {
        return '生效日期';
      } else {
        return '没有日期';
      }
    }
    $scope.beginFun = function (begin) {
      if (begin == 0) {
        return '当';
      } else {
        return begin;
      }
    }
    $scope.card_type = $scope.model.card_type == 1 ? 0 : 1;

    var int = 1
    $scope.isColor = false;
    $scope.colorClick = function () {
      $scope.isColor = !$scope.isColor;
    }
    $("#selectColor").focusout(function () {
      $scope.isColor = false;
    });
    /*RGB颜色转换为16进制*/
    var reg = /^#([0-9a-fA-f]{3}|[0-9a-fA-f]{6})$/;
    String.prototype.colorHex = function () {
      var that = this;
      if (/^(rgb|RGB)/.test(that)) {
        var aColor = that.replace(/(?:\(|\)|rgb|RGB)*/g, "").split(",");
        var strHex = "#";
        for (var i = 0; i < aColor.length; i++) {
          var hex = Number(aColor[i]).toString(16);
          if (hex === "0") {
            hex += hex;
          }
          strHex += hex;
        }
        if (strHex.length !== 7) {
          strHex = that;
        }
        return strHex;
      } else if (reg.test(that)) {
        var aNum = that.replace(/#/, "").split("");
        if (aNum.length === 6) {
          return that;
        } else if (aNum.length === 3) {
          var numHex = "#";
          for (var i = 0; i < aNum.length; i += 1) {
            numHex += (aNum[i] + aNum[i]);
          }
          return numHex;
        }
      } else {
        return that;
      }
    };

    //卡券类型
    $scope.wxTypeSelect = [
      {'wx_card_type': 0, 'name': '请选择'},
      {'wx_card_type': 1, 'name': '代金券'},
      {'wx_card_type': 2, 'name': '折扣券'},
      {'wx_card_type': 3, 'name': '礼品券'}
    ];

    //校验生成数量是否小于领取限制
    $scope.showQuantityText = function () {
      if (parseInt($scope.model.quantity) < parseInt($scope.model.get_limit)) {
        return true;
      }
      return false;
    }

    $("#tips").find("td").click(function () {
      $("#selectColor").val($(this).css("background-color").colorHex());
      $('#myTab .card_hbg').css('background-color', $(this).css("background-color").colorHex());
      $scope.isColor = false;
    });
    $scope.page = {};
    $scope.model.assign = $.isArray($scope.model.range) && $scope.model.range.length ? 1 : -1;
    $scope.assignOptions = [{'id': -1, 'name': '无门店限制'}, {'id': 1, 'name': '指定适用门店'}];
    $('#threeShow').click(function () {
      if ($scope.model.range) {
        getData(int, $scope.model.card_type);
        $scope.options = {callback: getData};
      }
    });


    $scope.assignChange = function (id) {
      $scope.model.assign = id;
      if ($scope.model.assign == 1) {
        getData(int, $scope.model.card_type);
        $scope.options = {callback: getData};
      }

    };
    var arrayStory = $scope.model.range;

    function getData(int, cardtype) {
      var datas;
      datas = {"_page": int, "_page_size": 6};
      if ($scope.model.card_type == 2) { //用户领取后同步到微信卡包当不选择的时候是'',选择的时候是1
        datas._available_status = cardtype;
      }
      $http.post('/card-coupons/shop-sub-list-ajax', datas).
        success(function (msg) {
          wsh.successback(msg, "", false, function () {
            $scope.storeList = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
            complie();
          });
        }).
        error(function (msg) {
          console.log(msg);
        });
    }

    function complie() {
      if (!arrayStory.length) return;
      for (var i in $scope.storeList) {
        for (var j in arrayStory) {
          if ($scope.storeList[i].id == arrayStory[j]) {
            $scope.storeList[i].isCheck = true;
            continue;
          }
        }
      }
    }

    $scope.isCheckAll = false;
    $scope.choose = function (list) {
      if (list.isCheck) {
        arrayStory.push(list.id);
      } else {
        var ii = arrayStory.indexOf(list.id);
        arrayStory.splice(ii, 1);
      }
    }
    $scope.checkAllFun = function (allCheck) {
      $.each($scope.storeList, function (a, b) {
        b.isCheck = allCheck;
        if (allCheck) {
          arrayStory.push(b.id);
        } else {
          var ii = arrayStory.indexOf(b.id);
          if (ii != -1) arrayStory.splice(ii, 1);
        }
      });
      arrayStory = wsh.unique(arrayStory);
    };

    //提交给后台的数据
    var product_ids = [], productAll = [];

    productAll = $scope.model.cardTypeInfoProduct.length > 0 ? $scope.model.cardTypeInfoProduct : [];
    $.each(productAll, function (a, b) {
      b.id = b.productInfo.id;
      b.name = b.productInfo.name;
      b.status = b.productInfo.status;
      if (!b.productInfo.productSkus.length) {
        b.productInfo.productSkus = [{retail_price: 0}];
      }
      b.productSkus = [{
        retail_price: b.productInfo.productSkus[0].retail_price
      }];
      b.reserves = 0;
      $.each(b.productInfo.productSkus, function (i, j) {
        b.reserves += j.reserves ? parseInt(j.reserves) : 0;
      });
    });
    if (productAll.length > 0) $scope.goodsm = 2;
    else $scope.goodsm = 1;
    if ($scope.money_limit) $scope.priceLimit = 2;
    else $scope.priceLimit = 1;

    producChoosList(1);

    //选择的商品  与插件交互
    $scope.$on('chooseCardProduct', function (e, json) {
      if (json.length) {
        productAll = json;
        producChoosList(1);
      }
    });

    var delProductId, flag = false;
    $scope.delProductFun = function (id) {
      wsh.setNoAjaxDialog('删除', '确定要删除吗？', function () {
        flag = true;
        delProductId = id;
        producChoosList(1);
      });
    };

    function producChoosList(int) {
      var perpage = 10;
      $scope.producChoosL = [];
      if (flag) {
        $.each(productAll, function (a, b) {
          if (b) {
            if (delProductId == b.id) {
              productAll.splice(a, 1);
            }
          }
        });
      }
      flag = false;
      $rootScope.productAllaa = productAll.length > 0 ? productAll : [];
      $.each(productAll, function (a, b) {
        if (a >= (int - 1) * perpage && a < (int - 1) * perpage + perpage) {
          $scope.producChoosL.push(b);
        }
      });
      $scope.page3 = {
        per_page: perpage,
        total_count: productAll.length,
        current_page: int - 1,
        total_page: Math.ceil(productAll.length / perpage)
      };
    }

    $scope.option3 = {callback: producChoosList};
    $scope.isChooseImg = $scope.isColor = $scope.isDisable = false;

    $scope.saveBtnEdit = function () {
      if ($scope.isDisable) {
        return;
      }

      //校验生成数量是否小于领取限制
      if ($scope.showQuantityText()) {
        return;
      }
      if ($scope.form1.$invalid) {
        form1Show();
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
      if (!$('#selectColor').val()) {
        form1Show();
        $scope.isColor = true;
        return $timeout(function () {
          $scope.isColor = false;
        }, 2000);
      }

      if (productAll.length > 0) {
        $.each(productAll, function (i, e) {
          product_ids.push(e.id);
        });
      }
      if ($scope.model.wx_card_type == 1 || $scope.model.wx_card_type == 2) {
        if ($scope.goodsm == 2) { //可使用商品
          if (product_ids == '' || product_ids.length == 0) {
            form1Show();
            $scope.isChooseP = true;
            return $timeout(function () {
              $scope.isChooseP = false;
            }, 2000);
          }
        }
      }

      if ($scope.form2.$invalid) {
        $('#cardset1').addClass('active');
        if ($('#cardset1').addClass('active').siblings().hasClass('active')) {
          $('#cardset1').addClass('active').siblings().removeClass('active');
        }
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
      if ($scope.form3.$invalid) {
        $('#cardset2').addClass('active');
        if ($('#cardset2').addClass('active').siblings().hasClass('active')) {
          $('#cardset2').addClass('active').siblings().removeClass('active');
        }
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
      if ($scope.model.assign == 1) {
        if (!arrayStory.length) {
          $('#cardset3').addClass('active');
          if ($('#cardset3').addClass('active').siblings().hasClass('active')) {
            $('#cardset3').addClass('active').siblings().removeClass('active');
          }
          return alert('请选择指定使用门店');
        }
      }

      if ($scope.model.custom_url_name || $('#tipurl1').val() || $scope.model.custom_url_sub_title) {
        if ($scope.form4.$invalid) {
          $('#cardset4').addClass('active');
          if ($('#cardset4').addClass('active').siblings().hasClass('active')) {
            $('#cardset4').addClass('active').siblings().removeClass('active');
          }
          $scope.isSubmit = true;
          return $timeout(function () {
            $scope.isSubmit = false;
          }, 2000);
        }
      }

      if ($scope.model.promotion_url_name || $('#tipurl2').val() || $scope.model.promotion_url_sub_title) {
        if ($scope.form5.$invalid) {
          $('#cardset5').addClass('active');
          if ($('#cardset5').addClass('active').siblings().hasClass('active')) {
            $('#cardset5').addClass('active').siblings().removeClass('active');
          }
          $scope.isSubmit = true;
          return $timeout(function () {
            $scope.isSubmit = false;
          }, 2000);
        }
      }
      var begintime, endtime;
      if ($scope.model.date_info_type == 1) {
        begintime = +new Date(new Date($('#start_time').val()).toLocaleDateString()).getTime() / 1000,
          endtime = +new Date(new Date(new Date($('#start_end').val()).toLocaleDateString() + ' 23:59:59')).getTime() / 1000;
      } else {
        begintime = $scope.model.begin, endtime = $scope.model.end;
      }

      $scope.model.color = $('#selectColor').val();
      $scope.model.begin = begintime;
      $scope.model.end = endtime;
      if ($scope.model.assign == 1) {
        $scope.model.range = arrayStory;
      } else {
        $scope.model.range = [];
      }
      product_ids = wsh.unique(product_ids);
      if ($scope.goodsm == 1) product_ids = [];
      $scope.model.product_ids = product_ids.length > 0 ? product_ids : [];
      $scope.isDisable = true;
      $http.post('/tv-card-coupons/edit-ajax', $scope.model).
        success(function (msg) {
          wsh.successback(msg, "编辑成功", false, function () {
            $scope.isDisable = false;
            window.location.href = 'list';
          });
          $scope.isDisable = false;
        }).
        error(function (msg) {
          $scope.isDisable = false;
          console.log(msg);
        });
    }

    function form1Show() {
      $('#cardset0').addClass('active');
      if ($('#cardset0').addClass('active').siblings().hasClass('active')) {
        $('#cardset0').addClass('active').siblings().removeClass('active');
      }
    }

  });
  $(function () {
    $('#selectColor').focus(function () {
      $('.color_box').addClass('on').show();
    })
  })
</script>

