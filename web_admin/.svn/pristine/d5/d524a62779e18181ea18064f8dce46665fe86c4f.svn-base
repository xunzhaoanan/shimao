<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '新增卡券';
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
          <li>新增卡券</li>
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
                          <span class="merchants_logo">
                              <img ng-src="{{logo_url}}" width="100%" height="100%" ng-show="logo_url"/>
                              <span class=" text-center block white" style="line-height:38px;">logo</span></span>

                          <strong title="{{brand_name}}"
                                  style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;  padding: 0px 5px;"
                                  ng-bind="brand_name"></strong>
                          <strong ng-bind="title"></strong>
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
                                                        href="#cardset3">适用门店</a> <i
                          class="icon-chevron-right"></i></div>
                    </div>
                    <div class="card_item border-top  padding-left10">
                      <div class="card_col clearfix">
                        <a data-toggle="tab" class="card_setbtn" href="#cardset4"
                           ng-show="!custom_url_name">自定义入口1</a>
                        <a data-toggle="tab" class="card_setbtn" href="#cardset4"
                           ng-show="custom_url_name" ng-bind="custom_url_name"></a>
                        <i
                          class="icon-chevron-right"></i></div>
                    </div>
                    <div class="card_item border-bottom padding-left10 margin-bottom10">
                      <div class="card_col clearfix">
                        <a data-toggle="tab" class="card_setbtn" href="#cardset5"
                           ng-show="!promotion_url_name">自定义入口2</a>
                        <a data-toggle="tab" class="card_setbtn" href="#cardset5"
                           ng-show="promotion_url_name" ng-bind="promotion_url_name"></a>
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
                          <input type="text" class="col-sm-6" title="brand_name"
                                 ng-model="brand_name" placeholder="输入公众号名称" max-string-length="36"
                                 name="brand_name" required>
                          <span class="red" ng-show="form1.brand_name.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                          <span class="red" ng-show="form1.brand_name.$error.maxStringLength">汉字不超过12个</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">卡券名称：</label>

                        <div class="col-sm-10">
                          <input type="text" class="col-sm-6" ng-model="title" maxlength="9"
                                 name="title" required>
                          <span class="red" ng-show="form1.title.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                        </div>
                      </div>
                      <div class="form-group margin-bottom10">
                        <label class="col-sm-2 control-label">卡券LOGO：</label>

                        <div class="col-sm-10">
                          <div class="ace-file-input col-sm-6">
                            <a data-toggle="modal" data-target="#myModalImage">
                              <label class="file-label" data-title="选择"> <span
                                  class="file-name file-name2"
                                  data-title="点击上传图片..."> <i
                                    class="icon-upload-alt"></i> </span>
                              </label>
                            </a>
                          </div>
                          <span class="red" ng-show="isChooseImg">请选择图片</span>

                          <div class="clearfix"></div>

                          <div class="text-left text-warning orange font-size12">
                            <i class="icon-exclamation-triangle "></i>
                            提示：为了更好的展示，建议尺寸125X125，创建后无法再修改
                          </div>
                          <div ng-if="logo_url">
                            <img ng-src="{{logo_url}}" width="125px" height="125px">
                          </div>
                        </div>
                      </div>
                      <div class="form-group ">
                        <label class="col-sm-2 control-label">卡券颜色：</label>

                        <div class="col-sm-10">
                          <div class="position-relative">
                            <input type="text" class="col-sm-6 margin-right10" id="selectColor"
                                   value="#55bd47"
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
                          <select ng-model="date_info_type"
                                  ng-options="o.date_info_type as o.name for o in effectTime"></select>
                        </div>
                        <div class="col-sm-10" style="width: 60%" ng-if="date_info_type == 1">
                          <div class="col-sm-10" style="width: 100%;">
                            <input type="text" id="start_time" class="col-sm-3 no-float"
                                   onfocus="WdatePicker({minDate:'%y-%M-#{%d}', maxDate:'#F{$dp.$D(\'start_end\', {d:-1})}', dateFmt:'yyyy-MM-dd'})">
                            <span class="inline padding5">至</span>
                            <!--截止日期要大于开始日期+1-->
                            <input type="text" id="start_end" class="col-sm-3 no-float"
                                   onfocus="WdatePicker({minDate:'#F{$dp.$D(\'start_time\', {d:1})||\'%y-%M-{%d+1}\'}', dateFmt:'yyyy-MM-dd'})">
                            <span class="red" ng-show="isTime">{{$root.regRequiredText}}</span>
                          </div>
                        </div>
                        <div class="col-sm-10" style="width: 60%" ng-if="date_info_type == 2">
                          <div class="col-sm-10">
                            领取后
                            <select ng-model="begin"
                                    ng-options="o.id as o.name for o in beginOptions"
                                    ng-change="beginChange(begin)"></select>
                            <span>天生效，有效天数</span>

                            <select ng-model="end" ng-options="o.id as o.name for o in endOptions"
                                    ng-change="endChange(end)"></select>
                            天
                          </div>
                        </div>
                      </div>

                      <!--卡券类型开始了-->
                      <div class="form-group">
                        <label class="col-sm-2 control-label">卡券类型：</label>

                        <div class="col-sm-10">
                          <select class="col-sm-6" ng-model="wx_card_type"
                                  ng-options="o.wx_card_type as o.name for o in wxTypeSelect"></select>
                          <span class="red" ng-show="isCardType">请选择卡券类型</span>
                        </div>
                      </div>
                      <div class="form-group margin-bottom10" ng-show="wx_card_type == 2 || wx_card_type == 3">
                        <label class="col-sm-2 control-label"></label>

                        <div class="col-sm-10 orange font-size12">
                          <i class="icon-exclamation-triangle "></i>
                          如需使用POS机核销，务必将POS机更新到最新版本
                        </div>
                      </div>

                      <div ng-show="wx_card_type==1 || wx_card_type==2">
                        <!--<div>-->
                        <div class="form-group" ng-show="wx_card_type==1">
                          <label class="col-sm-2 control-label">优惠金额：</label>

                          <div class="col-sm-10">
                            <div class="input-group col-sm-6 no-padding">
                              <input type="text" class="form-control" ng-model="card_money"
                                     placeholder="大于0的数，若是小数则保留2位小数"
                                     maxlength="10"
                                     name="card_money" ng-blur="changeText(1,card_money)">
                              <span class="input-group-addon">元</span>
                            </div>
                    <span class="red"
                          ng-show="isType1">{{$root.regRequiredText}}</span>
                            <span class="red" ng-show="isType1Pat">{{$root.regMoneyText}}</span>
                          </div>
                        </div>
                        <div class="form-group" ng-show="wx_card_type==2">
                          <label class="col-sm-2 control-label">卡券折扣：</label>

                          <div class="col-sm-10">
                            <div class="input-group col-sm-6 no-padding">
                              <input type="text" class="form-control" ng-model="card_discount"
                                     placeholder="输入小于10的正数，最多一位小数"
                                     maxlength="10"
                                     name="card_discount" ng-blur="changeText(2,card_discount)">
                              <span class="input-group-addon">折</span>
                            </div>
                    <span class="red"
                          ng-show="isType2">{{$root.regRequiredText}}</span>
                            <span class="red" ng-show="isType2Pat">{{$root.regDiscontText}}</span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">最低消费金额：</label>

                          <div class="col-sm-10">
                            <label ng-click="LimitClick()">
                              <input name="offline" type="radio" class="ace" value="1"
                                     ng-model="priceLimit" checked>
                              <span class="lbl"> 无金额限制 </span>
                            </label>
                            <label>
                              <input name="offline" type="radio" class="ace" value="2"
                                     ng-model="priceLimit">
                              <span class="lbl" style="margin-right: 2px;"> 满</span>
                              <input type="text" class="width51" ng-readonly="priceLimit==1"
                                     ng-model="money_limit"
                                     maxlength="10"
                                     name="money_limit" ng-blur="changeText(3,money_limit)">
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
                        <div class="form-group" ng-show="isType1Com">
                          <label class="col-sm-2 control-label"></label>

                          <div class="col-sm-10">
                            <span class="red">最低消费金额不能小于优惠金额</span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">可使用商品：</label>

                          <div class="col-sm-10">
                            <label ng-click="goodsClick()">
                              <input name="goods" type="radio" class="ace" value="1"
                                     ng-model="goodsm" checked>
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
                      <div ng-show="wx_card_type==3">
                        <div class="form-group">
                          <label class="col-sm-2 control-label">兑换内容：</label>

                          <div class="col-sm-10">
                            <div class="input-group col-sm-6 no-padding">
                              <input type="text" class="form-control"
                                     ng-model="exchange_content_text"
                                     placeholder="填写兑换内容的名称，例：兑换奥利奥饼干一包"
                                     maxlength="50"
                                     name="kindc">
                              <!--<input type="text" class="form-control" ng-model="exchange_content_text"-->
                              <!--placeholder="填写兑换内容的名称，例：兑换奥利奥饼干一包"-->
                              <!--maxlength="50" required-->
                              <!--name="kindc">-->
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
                           ng-show="producChoosL.length > 0 && goodsm == 2 && wx_card_type != 3">
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
                            <input type="text" class="form-control" ng-model="quantity"
                                   name="quantity" maxlength="8"
                                   required ng-pattern="" reg-int>
                            <span class="input-group-addon">张</span>
                          </div>
                    <span class="red"
                          ng-show="form2.quantity.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                          <span class="red" ng-show="form2.quantity.$error.pattern">{{$root.regIntText}}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">领取限制：</label>

                        <div class="col-sm-10">
                          <div class="input-group col-sm-6 no-padding">
                            <input type="text" class="form-control" ng-model="get_limit"
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
                          <input name="form-field-radio01" type="checkbox" class="ace"
                                 ng-model="can_give_friend"
                                 my-check-box="[1,2]"><span class="lbl">用户领券后可转赠其他好友 </span>
                        </div>
                      </div>

                      <h4 class="header paddingnone">销券设置</h4>

                      <div class="form-group margin-bottom10">
                        <label class="col-sm-2 control-label">销券方式：</label>

                        <div class="col-sm-10">
                          <div class="item">
                            <label><input name="radio01" type="radio" class="ace" value="1"
                                          ng-model="code_type"><span
                                class="lbl">序列号 </span> </label>

                            <div class="grey">显示卡券号，验证后可进行销券</div>
                          </div>
                          <div class="item">
                            <label><input name="radio01" type="radio" class="ace" value="3"
                                          ng-model="code_type"><span
                                class="lbl">二维码 </span> </label>

                            <div class="grey">显示二维码，验证后可进行销券</div>
                          </div>
                          <div class="item">
                            <label> <input name="radio01" type="radio" class="ace" value="2"
                                           ng-model="code_type"><span
                                class="lbl">条形码 </span> </label>

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
                          <input type="text" class="col-sm-6" ng-model="notice" name="notice"
                                 placeholder="示例：请向店员出示二维码"
                                 maxlength="16" required>
                    <span class="red"
                          ng-show="form2.notice.$error.required && isSubmit">{{$root.regRequiredText}}</span>
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
                        <label class="col-sm-2 control-label">使用须知：</label>

                        <div class="col-sm-10">
                          <textarea class="col-sm-6 form-control minheight-200px" id="form-field-8" ng-model="description" name="description" reg-char-len="300" ng-trim="true" prompt-type="2" prompt-msg="descmsg"></textarea>
                          <span class="inline padding5" ng-class="{'red':form3.description.$error.exceed}" ng-bind="descmsg"></span>
                          <span class="red" ng-show="form3.description.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">客服电话：</label>

                        <div class="col-sm-10">
                          <input type="text" class="col-sm-6" ng-model="service_phone"
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
                    <h4 class="header paddingnone">同步设置</h4>

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <!--card_type 1, 不选中，2，选中-->
                        <label><input name="form-field-radio01" type="checkbox" class="ace"
                                      ng-model="card_type"
                                      my-check-box="[2,1]" ng-click="cardTypeFun()"><span
                            class="lbl">用户领取后同步到微信卡包 </span>
                        </label>

                        <div class="text-warning bigger-110 orange font-size12"><i
                            class="icon-exclamation-triangle"></i>
                          提示：只有在微信公众平台开通卡券功能的用户才能使用本设置
                        </div>
                      </div>
                    </div>

                    <h4 class="header paddingnone">服务信息</h4>

                    <form class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">适用门店：</label>

                        <div class=" col-sm-10">
                          <select ng-model="assign"
                                  ng-options="o.id as o.name for o in assignOptions"
                                  ng-change="assignChange(assign)"></select>
                        </div>
                      </div>
                      <div ng-show="assign == 1">
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
                          <input type="text" class="col-sm-6" ng-model="custom_url_name"
                                 name="cosname" maxlength="5" required>
                          <span class="red" ng-show="form4.cosname.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">地址链接：</label>

                        <div class=" col-sm-10">
                          <input type="text" class="col-sm-6 " ng-model="custom_url" id="tipurl1"
                                 maxlength="100" name="cusurl" required
                                 ng-pattern="/^(http|https):\/\//"
                                 placeholder="以http://或https://开头">
                          <span class="red" ng-show="form4.cusurl.$error.pattern">请填写带http://或https://的地址</span>
                          <span class="red" ng-show="form4.cusurl.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">入口右侧的tips：</label>

                        <div class=" col-sm-10">
                          <input type="text" class="col-sm-6 " ng-model="custom_url_sub_title"
                                 maxlength="6" name="custips" required>
                          <span class="red" ng-show="form4.custips.$error.required && isSubmit">{{$root.regRequiredText}}</span>
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
                          <input type="text" class="col-sm-6 " ng-model="promotion_url_name"
                                 name="proname" maxlength="5" required>
                          <span class="red" ng-show="form5.proname.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">地址链接：</label>

                        <div class=" col-sm-10">
                          <input type="text" class="col-sm-6" id="tipurl2" ng-model="promotion_url"
                                 maxlength="100" name="prourl" placeholder="以http://或https://开头"
                                 ng-pattern="/^(http|https):\/\//" required>
                          <span class="red" ng-show="form5.prourl.$error.required && isSubmit">{{$root.regRequiredText}}</span>
                          <span class="red" ng-show="form5.prourl.$error.pattern">请填写带http://或https://的地址</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">入口右侧的tips：</label>

                        <div class=" col-sm-10">
                          <input type="text" class="col-sm-6" ng-model="promotion_url_sub_title"
                                 name="protip" maxlength="6" required>
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
          <a class="btn btn-primary" ng-click="saveBtnAdd()" ng-disabled="isDisable"> 保存并关闭 </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
echo $this->render('@app/views/uploadImg/imageIndex.php');
?>

<!-- 选择商品 -->
<?php
echo $this->render('@app/views/product/cardProduct.php');
?>

<script language="javascript" type="text/javascript"
        src="/ace/js/DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ec');
    }, 100);
    $scope.can_give_friend = 2;
    $scope.model = JSON.parse('<?= addslashe(json_encode($model))?>');
    $scope.cardCardFn = $scope.model.isOpenCardFn;  //等于ture，可以点
    $http.post('/card-coupons/check-card-fn-ajax', {}).
      success(function (msg) {
        wsh.successback(msg, "", false, function () {
          $scope.cardCardFn = msg.errmsg;
        });
      }).
      error(function (msg) {
        console.log(msg);
      });

    //卡券类型
    $scope.money_limit = '';
    $scope.wx_card_type = 0;
    $scope.wxTypeSelect = [
      {'wx_card_type': 0, 'name': '请选择'},
      {'wx_card_type': 1, 'name': '代金券'},
      {'wx_card_type': 2, 'name': '折扣券'},
      {'wx_card_type': 3, 'name': '礼品券'}
    ];
    $scope.priceLimit = 1;
    $scope.goodsm = 1;
    $scope.LimitClick = function () {
      $scope.money_limit = ''; //选择的是无金额限制
    };
    $scope.goodsClick = function () {
      product_ids = '';
      //之前的商品清空
    }

//有效日期
    var int = 1;
    $scope.code_type = '1';
    $scope.date_info_type = 1;
    $scope.effectTime = [
      {'date_info_type': 1, 'name': '固定日期'},
      {'date_info_type': 2, 'name': '生效日期'}
    ];
    $scope.begin = 0;
    $scope.end = 1;
    $scope.beginOptions = [];
    $scope.endOptions = [];
    for (var i = 0; i < 91; i++) {
      if (i == 0) {
        $scope.beginOptions.push({'id': i, 'name': '当'});
      } else {
        $scope.beginOptions.push({'id': i, 'name': i});
        $scope.endOptions.push({'id': i, 'name': i});
      }
    }
    $scope.beginChange = function (id) {
      $scope.begin = id;
    }
    $scope.endChange = function (id) {
      $scope.end = id;
    }
    $scope.beginChange = function (id) {
      $scope.begin = id;
    }
    $scope.$on('ImageListChange', function (e, json) {
      for (var i = 0; i < json.length; i++) {
        $scope.logo_url = json[i]["file_cdn_path"];
      }

    });
    $scope.$on('ImageChoose', function (e, json) {
      $scope.logo_url = json[0]["file_cdn_path"];
    });
    $scope.isColor = false;
    $scope.colorClick = function () {
      $scope.isColor = !$scope.isColor;
    }
    $("#selectColor").focusout(function () {
      $scope.isColor = false;
    });


    //校验生成数量是否小于领取限制
    $scope.showQuantityText = function () {
      if (parseInt($scope.quantity) < parseInt($scope.get_limit)) {
        return true;
      }
      return false;
    }

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
    $("#tips").find("td").click(function () {
      $("#selectColor").val($(this).css("background-color").colorHex());
      $('#myTab .card_hbg').css('background-color', $(this).css("background-color").colorHex());
      $scope.isColor = false;
    });


    $scope.card_type = 1;  //用户领取后同步到微信卡包
    $scope.cardTypeFun = function () {
      if ($scope.cardCardFn) {
        $scope.assign = -1;
      } else {
        $scope.card_type = 1;
        alert('你还没有开通卡劵功能！');
      }
    };
    $scope.assign = -1;
    $scope.assignOptions = [{'id': -1, 'name': '无门店限制'}, {'id': 1, 'name': '指定适用门店'}];
    $scope.assignChange = function (id) {
      $scope.assign = id;
      if ($scope.assign == 1) {
        getData(int, $scope.card_type);
        $scope.options = {callback: getData};

      }
    };
    var arrayStory = [];

    function getData(int, cardtype) {
      var datas;
      datas = {"_page": int, "_page_size": 6};
      if ($scope.card_type == 2) { //用户领取后同步到微信卡包当不选择的时候是'',选择的时候是1
        datas._available_status = cardtype;
      }
      $http.post('/card-coupons/shop-sub-list-ajax', datas).
        success(function (msg) {
          wsh.successback(msg, "", false, function () {
            $scope.isCheckAll = false;

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

    //单选
    $scope.isCheckAll = false;
    $scope.choose = function (list) {
      if (list.isCheck) {
        arrayStory.push(list.id);
      } else {
        var ii = arrayStory.indexOf(list.id);
        arrayStory.splice(ii, 1);
      }
    };
    //全选
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
    $scope.isChooseImg = $scope.isTime = $scope.isColor = $scope.isDisable = false;

    $scope.changeText = function (index, val) {
      if (!val) return;
      if (index == 1) {
        if (!(/^([1-9]\d{0,6}(\.\d{1,2})?|0\.[1-9][0-9]?|0\.[0-9][1-9])$/).test(val)) {
          $scope.card_money = '';
          $scope.isType1Pat = true;
          return $timeout(function () {
            $scope.isType1Pat = false;
          }, 2000);
        }
      } else if (index == 2) {
        if (!(/^([1-9]{1}(\.[1-9]{0,1})?|0\.[1-9])$/).test(val)) {
          $scope.card_discount = '';
          $scope.isType2Pat = true;
          return $timeout(function () {
            $scope.isType2Pat = false;
          }, 2000);
        }
      } else {
        if (!(/^([1-9]\d{0,6}(\.\d{1,2})?|0\.[1-9][0-9]?|0\.[0-9][1-9])$/).test(val)) {
          $scope.money_limit = '';
          $scope.isMoneyPat = true;
          return $timeout(function () {
            $scope.isMoneyPat = false;
          }, 2000);
        }
        if (Number($scope.card_money) > Number($scope.money_limit)) {
          form1Show();
          $scope.isType1Com = true;
          return $timeout(function () {
            $scope.isType1Com = false;
          }, 2000);
        }
      }
    }

    $scope.saveBtnAdd = function () {
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

      if (!$scope.logo_url) {
        form1Show();
        $scope.isChooseImg = true;
        return $timeout(function () {
          $scope.isChooseImg = false;
        }, 2000)
      }
      if (!$('#selectColor').val()) {
        form1Show();
        $scope.isColor = true;
        return $timeout(function () {
          $scope.isColor = false;
        }, 2000);
      }
      if ($scope.date_info_type == 1) {
        if (!$("#start_time").val() || !$("#start_end").val()) {
          form1Show();
          $scope.isTime = true;
          return $timeout(function () {
            $scope.isTime = false;
          }, 2000);
        }
      }

      if ($scope.wx_card_type == 0) {
        form1Show();
        $scope.isCardType = true;
        return $timeout(function () {
          $scope.isCardType = false;
        }, 2000);
      }

      if ($scope.wx_card_type == 1) {
        if (!$scope.card_money) {
          form1Show();
          $scope.isType1 = true;
          return $timeout(function () {
            $scope.isType1 = false;
          }, 2000);
        }
        if (!(/^([1-9]\d{0,6}(\.\d{1,2})?|0\.[1-9][0-9]?|0\.[0-9][1-9])$/).test($scope.card_money)) {
          form1Show();
          $scope.isType1Pat = true;
          return $timeout(function () {
            $scope.isType1Pat = false;
          }, 2000);
        }

        //代金券，最低消费金额不能小于优惠金额
        if ($scope.priceLimit == 2) {
          if (Number($scope.card_money) > Number($scope.money_limit)) {
            form1Show();
            $scope.isType1Com = true;
            return $timeout(function () {
              $scope.isType1Com = false;
            }, 2000);
          }
        }
      }

      if ($scope.wx_card_type == 2) {
        if (!$scope.card_discount) {
          form1Show();
          $scope.isType2 = true;
          return $timeout(function () {
            $scope.isType2 = false;
          }, 2000);
        }
        if (!(/^([1-9]{1}(\.[1-9]{0,1})?|0\.[1-9])$/).test($scope.card_discount)) {
          form1Show();
          $scope.isType2Pat = true;
          return $timeout(function () {
            $scope.isType2Pat = false;
          }, 2000);
        }
      }

      if (productAll.length > 0) {
        $.each(productAll, function (i, e) {
          product_ids.push(e.id);
        });
      }

      if ($scope.wx_card_type == 1 || $scope.wx_card_type == 2) {
        if ($scope.priceLimit == 2) {  //最低消费金额
          if (!$scope.money_limit) {
            form1Show();
            $scope.isMoney = true;
            return $timeout(function () {
              $scope.isMoney = false;
            }, 2000);
          }
          if (!(/^([1-9]\d{0,6}(\.\d{1,2})?|0\.[1-9][0-9]?|0\.[0-9][1-9]|0)$/).test($scope.money_limit)) {
            form1Show();
            $scope.isMoneyPat = true;
            return $timeout(function () {
              $scope.isMoneyPat = false;
            }, 2000);
          }
        }

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
      if ($scope.wx_card_type == 3) {
        if (!$scope.exchange_content_text) {
          form1Show();
          $scope.isshiwucontent = true;
          return $timeout(function () {
            $scope.isshiwucontent = false;
          }, 2000);
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
      if ($scope.assign == 1) {
        if (!arrayStory.length) {
          $('#cardset3').addClass('active');
          if ($('#cardset3').addClass('active').siblings().hasClass('active')) {
            $('#cardset3').addClass('active').siblings().removeClass('active');
          }
          return alert('请选择指定使用门店');
        }
      }
      if ($scope.custom_url_name || $('#tipurl1').val() || $scope.custom_url_sub_title) {
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
      if ($scope.promotion_url_name || $('#tipurl2').val() || $scope.promotion_url_sub_title) {
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

      product_ids = wsh.unique(product_ids);
      if ($scope.goodsm == 1) product_ids = [];
      var data_save, begintime, endtime;
      if ($scope.date_info_type == 1) {
        begintime = +new Date(new Date($('#start_time').val()).toLocaleDateString()).getTime() / 1000,
          endtime = +new Date(new Date(new Date($('#start_end').val()).toLocaleDateString() + ' 23:59:59')).getTime() / 1000;
      } else {
        begintime = $scope.begin, endtime = $scope.end;
      }
      var ditail;
      //卡券详情
      if ($scope.wx_card_type == 1) {
        if ($scope.priceLimit == 2) {
          if ($scope.goodsm == 2) {
            ditail = '价值' + $scope.card_money + '元代金券1张，指定商品满' + $scope.money_limit + '元可用';
          } else {
            ditail = '价值' + $scope.card_money + '元代金券1张，全场满' + $scope.money_limit + '元可用';
          }
        } else {
          if ($scope.goodsm == 2) {
            ditail = '价值' + $scope.card_money + '元代金券1张，指定商品可用';
          } else {
            ditail = '价值' + $scope.card_money + '元代金券1张，全场通用';
          }
        }
      } else if ($scope.wx_card_type == 2) {
        if ($scope.priceLimit == 2) {
          if ($scope.goodsm == 2) {
            ditail = $scope.card_discount + '折折扣券1张，指定商品满' + $scope.money_limit + '元可用';
          } else {
            ditail = $scope.card_discount + '折折扣券1张，全场满' + $scope.money_limit + '元可用';
          }
        } else {
          if ($scope.goodsm == 2) {
            ditail = $scope.card_discount + '折折扣券1张，指定商品可用';
          } else {
            ditail = $scope.card_discount + '折折扣券1张，全场通用';
          }
        }
      } else {
        ditail = $scope.exchange_content_text;
      }
      data_save = {
        'brand_name': $scope.brand_name,
        'title': $scope.title,
        'logo_url': $scope.logo_url,
        'color': $('#selectColor').val(),
        'date_info_type': $scope.date_info_type,
        'begin': begintime,
        'end': endtime,
        'quantity': $scope.quantity,
        'get_limit': $scope.get_limit,
        'can_give_friend': $scope.can_give_friend,
        'code_type': $scope.code_type,
        'notice': $scope.notice,
        'description': $scope.description,
        'service_phone': $scope.service_phone,
        'card_type': $scope.card_type,
        'assign': $scope.assign,
        'custom_url_name': $scope.custom_url_name,
        'custom_url': $scope.custom_url,
        'custom_url_sub_title': $scope.custom_url_sub_title,
        'promotion_url_name': $scope.promotion_url_name,
        'promotion_url': $scope.promotion_url,
        'promotion_url_sub_title': $scope.promotion_url_sub_title,
        'wx_card_type': $scope.wx_card_type,//卡券类型，1，2，3
        'card_money': $scope.wx_card_type == 1 ? Math.floor(wsh.mul($scope.card_money, 100)) : 0,
        'money_limit': (($scope.wx_card_type == 1 || $scope.wx_card_type == 2) && $scope.priceLimit == '2') ? Math.floor(wsh.mul($scope.money_limit, 100)) : 0,
        'card_discount': $scope.wx_card_type == 2 ? $scope.card_discount : 0,//只有折扣的时候传，没有传0
        'exchange_content_text': $scope.wx_card_type == 3 ? $scope.exchange_content_text : '',  //只有礼品券兑换内容  没有是传‘’；
        'product_ids': (($scope.wx_card_type == 1 || $scope.wx_card_type == 2) && $scope.goodsm == '2') ? product_ids : '', //指定商品，有数据的时候传[],没有的时候传 ‘’；
        'deal_detail': ditail
      };
      if ($scope.assign == 1) {
        data_save.range = arrayStory;
      }

      $scope.isDisable = true;
      $http.post('/card-coupons/add-ajax', data_save).
        success(function (msg) {
          wsh.successback(msg, "添加成功", false, function () {
            $scope.isDisable = false;
            window.location.href = 'list';
          });
          console.log(msg);
          $scope.isDisable = false;
        }).
        error(function (msg) {
          $scope.isDisable = false;
          console.log(msg);
        });
    };

    //基础设置
    function form1Show() {
      $('#cardset0').addClass('active');
      if ($('#cardset0').addClass('active').siblings().hasClass('active')) {
        $('#cardset0').addClass('active').siblings().removeClass('active');
      }
    }

  });
  $(function () {
    //颜色选择弹框
    $('#selectColor').focus(function () {
      $('.color_box').addClass('on').show();
    })
  })
</script>
