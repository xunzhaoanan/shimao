<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '编辑拼团活动';
?>

<style>
  #ptpopover-tips .popover {
    max-width: none;
  }
</style>
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
          <li>编辑拼团活动</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">

            <div class="leader clearfix">
              <div class="col-sm-12 margin-bottom10">
                                <span class="label label-light  no-padding center"><b
                                    class="red">提示：活动一旦开启就不能再进行任何改动</b> </span>
              </div>
              <div class=" col-sm-6">
                <span class="label label-lg arrowed-right no-padding">1 设置图文</span>
              </div>
              <div class=" col-sm-6">
                <span class="label label-lg label-success arrowed-in no-padding">2 活动说明</span>
              </div>
            </div>
            <div class="tabbable clearfix">
              <!--内容开始了-->
              <div id="rule" class="tab-pane active ruleCont margin-top20">

                <ng-form class="form-horizontal " name="myform1" novalidate>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><span class="red">*</span>拼团开启条件：</label>

                    <div class="col-sm-10">
                      <label>
                        <input type="checkbox" class="ace"
                               my-check-box="[2,1]" ng-model="isAgree">
                        <span class="lbl"></span>
                      </label>
                      <span>同意对于未成团但已支付的订单可系统自动退款</span>
                    </div>
                    <div class="col-sm-10 margin-bottom10" id="ptpopover-tips">
                      <strong class="red">请开启自动退款功能，否则需要在微信支付平台进行手动退款（工作量较大）</strong>
                                            <span class="icon-question-circle bigger-180 align-middle orange pointer"
                                                  data-toggle="popover"
                                                  data-placement="bottom"
                                                  data-content="<img class='img-responsive' width='450' src='http://imgcache.vikduo.com/static/3e95d8ea50bc94cb9461e393abfb2663.jpg'>"
                                                  data-original-title="" title="">
                        </span><a href="/order/refund-list" target="_blank">点击设置自动退款</a>
                    </div>

                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><span class="red">*</span>活动名称：</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-4" name="name" ng-model="model.name"
                             required reg-char-len="30" prompt-msg="nameMsg" prompt-type="1" ng-trim="false" diff-zh="true">
                                            <span class="inline padding5 red"
                                                  ng-if="myform1.name.$error.required && isSubmit">必填项</span>
                      <span class="inline padding5" ng-class="{'red':myform1.name.$error.exceed}" ng-bind="nameMsg"></span>
                    </div>
                  </div>

                  <div class="form-group margin-bottom5 clearfix">
                    <label class="col-sm-2 control-label"><span class="red">*</span>活动说明：</label>

                    <div class="col-sm-10">
                      <textarea class="col-sm-6 padding5" style="height:200px;" name="desc" ng-model="model.desc" required reg-char-len="400" ng-trim="true" prompt-type="2" prompt-msg="descMsg"></textarea>
                      <span class="inline padding5 red" ng-if="myform1.desc.$error.required && isSubmit">必填项</span>
                      <span class="inline padding5" ng-class="{'red':myform1.desc.$error.exceed}" ng-bind="descMsg"></span>
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
                    <label class="col-sm-2 control-label"><span class="red">*</span>该团购订单满：</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-2 "
                             name="amount"
                             ng-model="postageAmout" maxlength="10">
                      <span class="inline padding5">元，免运费</span>
                      <span class="inline padding5 red" ng-show="isAmount">必填项</span>
                      <span class="inline padding5 red" ng-show="isAmountPat">请输入大于0的正整数或者保留2位小数</span>
                    </div>
                  </div>
                  <!--运费政策3-->
                  <div class="form-group clearfix" ng-show="isJian">
                    <label class="col-sm-2 control-label"><span class="red">*</span>该团购订单满：</label>

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
                            <th width="8%">团购价</th>
                            <th width="6%">库存</th>
                            <th width="8%">配额</th>
                            <th width="12%">参团人数要求</th>
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
                                       ng-blur="changeText(list.buy_price, list, 0)"
                                       reg-int>
                              <span ng-show="list.isShowEdit"
                                    ng-bind="list.buy_price"></span>
                                                            <span class="inline padding5 red" ng-show="isNull1"
                                                              >必填项</span>
                            </td>
                            <td ng-bind="list.reserves"></td>
                            <td><input ng-show="!list.isShowEdit" type="text"
                                       class="col-sm-10" maxlength="7" ng-model="list.quota"
                                       ng-blur="changeText(list.quota, list, 1)">
                                                            <span ng-show="list.isShowEdit"
                                                                  ng-bind="list.quota"></span>
                                                            <span class="inline padding5 red" ng-show="isNull2"
                                                              >必填项</span>
                            </td>
                            <td><input ng-show="!list.isShowEdit" type="text"
                                       class="col-sm-10"
                                       ng-model="list.together_num"
                                       ng-blur="changeText(list.together_num, list, 3)">
                                                            <span ng-show="list.isShowEdit"
                                                                  ng-bind="list.together_num"></span>
                                                            <span class="inline padding5 red" ng-show="isNull3"
                                                              >必填项</span>
                            </td>
                            <td><input ng-show="!list.isShowEdit" type="text"
                                       class="col-sm-10" maxlength="7"
                                       ng-model="list.limit_buy"
                                       ng-blur="changeText(list.limit_buy, list, 2)">
                              <span ng-show="list.isShowEdit"
                                    ng-bind="list.limit_buy"></span>
                                                            <span class="inline padding5 red" ng-show="isNull4"
                                                              >必填项</span>
                            </td>
                            <td>
                              <div class="action-buttons">
                                <a class="green pointer" ng-click="save($index, list)"
                                   ng-show="!list.isShowEdit"> <i
                                    class="icon-save bigger-130"></i> </a>
                                <a class="success pointer" ng-click="edit($index, list)"
                                   ng-show="list.isShowEdit"> <i
                                    class="icon-bianji bigger-130"></i> </a>
                                <a class="red pointer"
                                   ng-click="deleteProduct($index, list)"> <i
                                    class="icon-shanchu bigger-130"></i> </a>
                              </div>
                            </td>
                          </tr>
                          </tbody>
                        </table>
                      </div>
                    </ng-form>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong
                        class="red">*</strong>团长订单减额：</label>

                    <div class="col-sm-10" id="radio">
                      <label>
                        <input name="favorable" id="no_favorable" type="radio"
                               ng-model="model['togetherBuy']['is_discount']" class="ace"
                               value="2">
                        <span class="lbl"> 不减额 </span>
                      </label>
                      <label>
                        <input name="favorable" id="favorable" type="radio" class="ace"
                               ng-model="model['togetherBuy']['is_discount']" value="1">
                        <span class="lbl"> 减额 </span>
                      </label>


                    </div>
                  </div>
                  <!--                    如果选择优惠就显示-->
                  <div class="form-group clearfix margin-bottom10" id="favorable_amount"
                       ng-show="model.togetherBuy.is_discount == 1">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-4">
                      <input type="text" ng-model="disAmout"
                             name="head_price" class="col-sm-2" maxlength="8"
                             id="amountVal" ng-blur="changeText('','',4)">
                      <span class="margin-left10">元</span>
                      <span class="red margin-left10" ng-show="isDisAmount">必填项</span>
                      <span class="red margin-left10" ng-show="isMax">输入金额不能大于99999.99</span>
                      <span class="inline padding5 red" ng-show="isDisShow">请输入大于0的正整数或者保留2位小数</span>
                    </div>
                  </div>


                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong
                        class="red">*</strong>是否开启凑团：</label>

                    <div class="col-sm-10" id="radio">
                      <label>
                        <input name="open" id="no_favorable" type="radio"
                               ng-model="model['togetherBuy']['is_open']" class="ace"
                               value="2">
                        <span class="lbl"> 不开启 </span>
                      </label>
                      <label>
                        <input name="open" id="favorable" type="radio" class="ace"
                               ng-model="model['togetherBuy']['is_open']" value="1">
                        <span class="lbl"> 开启 </span>
                      </label>
                      <span class="red">（在拼团页显示进行中的团，增加成团率，可能会降低开团率）</span>

                    </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong
                        class="red">*</strong>是否在拼团页添加商品简介：</label>

                    <div class="col-sm-10" id="radio">
                      <label>
                        <input name="inclusion" id="no_favorable" type="radio"
                               ng-model="is_inclusion" class="ace"
                               value="2">
                        <span class="lbl"> 不添加 </span>
                      </label>
                      <label>
                        <input name="inclusion" id="favorable" type="radio" class="ace"
                               ng-model="is_inclusion" value="1">
                        <span class="lbl"> 添加 </span>
                      </label>


                    </div>
                  </div>
                  <div class="form-group clearfix margin-bottom10" id="favorable_amount"
                       ng-show="is_inclusion == 1">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-10">
                                              <textarea type="text" id="description" ng-blur="changeText('','',6)"
                                                        class="col-sm-6 padding5" style="height:200px;"
                                                        name="description" ng-model="description" ng-maxlength="150"
                                                        placeholder="少于150个字符"></textarea>
                                            <span class="inline padding5 red"
                                                  ng-show="isDec">必填项</span>
                      <span class="inline padding5 red" ng-show="isMaxDec">字符过多，不能超过150个字符</span>
                    </div>
                  </div>
                  <!--是否在拼团页显示认证标示-->
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong
                        class="red">*</strong>是否在拼团页显示认证标识：</label>

                    <div class="col-sm-10" id="radio">
                      <label>
                        <input name="is_auth_icons" type="radio"
                               ng-model="is_auth_icons" class="ace"
                               value="2">
                        <span class="lbl"> 不显示 </span>
                      </label>
                      <label>
                        <input name="is_auth_icons" type="radio" class="ace"
                               ng-model="is_auth_icons" value="1" ng-click="changeAuth(is_auth_icons)">
                        <span class="lbl"> 显示 </span>
                      </label>
                      <span class="red">（最多可选择三个标识）</span>

                    </div>
                  </div>

                  <!-- 认证标识 -->
                  <div class="form-group clearfix margin-bottom10" ng-show="is_auth_icons == 1">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-10">
                      <label ng-repeat="arr in list">
                        <input type="checkbox" ng-model="arr.ischeck" value="arr.id" ng-click="choose(arr,$event)" class="ace"><span class="lbl" ng-bind="arr.name"><img src=""></span>
                      </label>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong
                        class="red">*</strong>是否在拼团页显示更多拼团：</label>

                    <div class="col-sm-10" id="radio">
                      <label>
                        <input name="is_more" ng-model="model['togetherBuy']['is_more']" type="radio" class="ace"
                               value="2">
                        <span class="lbl"> 不显示 </span>
                      </label>
                      <label>
                        <input name="is_more" type="radio" ng-model="model['togetherBuy']['is_more']" class="ace" value="1">
                        <span class="lbl"> 显示 </span>
                      </label>

                    </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong
                        class="red">*</strong>参团时间限制：</label>

                    <div class="col-sm-10" id="radio">
                      <label>
                        <input name="limit" id="no_limit" type="radio"
                               ng-model="model['togetherBuy']['is_time_limit']" class="ace"
                               value="2">
                        <span class="lbl"> 不限制 </span>
                      </label>
                      <label>
                        <input name="limit" id="limit" type="radio"
                               ng-model="model['togetherBuy']['is_time_limit']" class="ace"
                               value="1">
                        <span class="lbl"> 限制 </span>
                      </label>


                    </div>
                  </div>
                  <!-- 如果选择限制就显示-->
                  <div class="form-group clearfix margin-bottom10" id="limit_time"
                       ng-show="model.togetherBuy.is_time_limit == 1">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-4">
                      <input type="text" ng-model="time_limit"
                             name="limit_time" class="col-sm-2" maxlength="7"
                             ng-blur="changeText('','',5)">
                      <span class="margin-left10">小时</span>
                      <span class="red margin-left10" ng-show="isTime">必填项</span>
                                            <span class="inline padding5 red" ng-show="isTimeShow"
                                              >请输入大于0的正整数</span>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">活动类型：</label>

                    <div class="col-sm-9">
                      <p>
                        <label>
                          <input name="offline" type="radio" class="ace" value="1"
                                 ng-model="model.share_type" checked>
                          <span class="lbl"> 开放性活动 &nbsp;&nbsp;</span>（可在惊喜页列表中显示，允许分享）
                        </label>
                      </p>

                      <p>
                        <label>
                          <input name="offline" type="radio" class="ace" value="2"
                                 ng-model="model.share_type">
                          <span class="lbl"> 线下分享活动 </span>（不在惊喜页列表中显示，允许分享）
                        </label>
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
                              ng-if="myform1.heititle.$error.required && isSubmit"
                          >必填项</span>
                                                  <span class="inline padding5 red"
                                                        ng-if="myform1.heititle.$error.maxlength"
                                                    >字符过多，不能超过36个字符</span>
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
                              ng-if="myform1.hdesc.$error.required && isSubmit">必填项</span>
                                                  <span class="inline padding5 red"
                                                        ng-if="myform1.hdesc.$error.maxlength"
                                                    >字符过多，不能超过50个字符</span>
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

                  <div class="form-group margin-top20 clearfix">
                    <label class="col-sm-2 control-label">是否开启动态分享标题:</label>

                    <div class="col-sm-10">
                      <label>
                        <input name="is_auto_share" ng-model="model['togetherBuy']['is_auto_share']" type="radio" class="ace" value="1">
                        <span class="lbl"> 开启 </span>
                      </label>
                      <label>
                        <input name="is_auto_share" ng-model="model['togetherBuy']['is_auto_share']" type="radio" class="ace" value="2">
                        <span class="lbl"> 不开启 </span>
                      </label>
                    </div>
                  </div>
              </div>
              <!--点击高级设置按钮，结束了-->
              <div class="form-group clearfix margin-bottom10" ng-show="model.togetherBuy.is_auto_share == 1">
                <label class="col-sm-2 control-label"></label>

                <div class="col-sm-10">
                  <p>开启后，进行中的团分享时显示：还差(参团剩余人数)就成团啦！(分享者昵称) 喊你来拼(商品名称)！</p>

                  <p>例:还差3人就成团啦！张三喊你来拼红富士苹果！</p>
                </div>
              </div>
              </ng-form>
            </div>
            <!--内容结束了-->
          </div>
          <!-- 确定开始了 -->
        </div>


      </div>
      <div class="space-32"></div>
      <div class="modal-footer margin-auto" id="modal-footer">
        <a class="btn btn-infor" href="/together-buy/list"> 返回列表 </a>
        <a id="back" class="btn btn-primary"
           href="<?= Url::to(['/together-buy/edit-news']); ?>?id={{model.id}}"> 上一步 </a>
        <a id="post" class="btn btn-primary" ng-click="saveBtn()"> 保存并关闭 </a>
      </div>
    </div>
  </div>
</div>

<!-- 弹出层 -->

<?php
echo $this->render('@app/views/together-buy/index.php');
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

    startT = +new Date(starttime) / 1000, endT = +new Date(endtime) / 1000;
    return true;
  }
  //优惠
  $('#favorable').click(function () {
    $('#favorable_amount').show();
  });
  //不优惠
  $('#no_favorable').click(function () {
    $('#favorable_amount').hide();
  });
  //限制
  $('#limit').click(function () {
    $('#limit_time').show();
  });
  //不限制
  $('#no_limit').click(function () {
    $('#limit_time').hide();
  });
  app.controller("mainController", function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ea');
    }, 100);
    $scope.model = JSON.parse('<?= addslashe(json_encode($model))?>');
    console.log($scope.model);
    $scope.is_agree = $scope.model.togetherBuy.is_agree;//是否同意开启条件
    $scope.isAgree = $scope.is_agree == 1 ? 1 : 2; //1:不同意，2：同意
    $scope.postageAmout = $scope.model.postageSetting.amount ? parseInt($scope.model.postageSetting.amount) / 100 : null;//该拼团订单满多少元的金额
    $scope.disAmout = $scope.model.togetherBuy.head_price ? $scope.model.togetherBuy.head_price / 100 : null; //优惠金额
    $scope.time_limit = $scope.model.togetherBuy.time_limit ? $scope.model.togetherBuy.time_limit : null;//限制时间
    //andy 关联商品
    $scope.showEdit = false;//是否显示编辑商品
    $scope.productList = [];
    $rootScope.productObj = {};
    $scope.is_inclusion = 2;//商品简介
    $scope.isDec = false; ///商品简介是否必填
    $scope.isMaxDec = false;///商品简介是否超过最大字符
    $scope.description = $scope.model.togetherBuy.description;//商品简介
    $scope.is_auth_icons = 2; //默认不显示认证标识
    var list_id = [];
    var desc = $scope.model.desc.replace(/\n/g, '<br>').replace(/\s/g, '&nbsp;');
    if (($scope.model.postageSetting.type == 1 || $scope.model.postageSetting.type == 2 || $scope.model.postageSetting.type == 3) && $scope.model.postageSetting != undefined) {
      $scope.list = [{id: 'FREE_SHIPPING', name: '包邮', ischeck: false}, {id: 'QUALITY_GOODS', name: '正品保障', ischeck: false}, {id: 'AUTHENTICATION', name: '认证商户', ischeck: false}, {id: 'IMPORT_GOODS', name: '进口商品', ischeck: false}, {id: 'SUPER_SALE', name: '限时特惠', ischeck: false}];
    }
    else {
      $scope.list = [{id: 'QUALITY_GOODS', name: '正品保障', ischeck: false}, {id: 'AUTHENTICATION', name: '认证商户', ischeck: false}, {id: 'IMPORT_GOODS', name: '进口商品', ischeck: false}, {id: 'SUPER_SALE', name: '限时特惠', ischeck: false}];
    }
    $scope.auth_icons = $scope.model.togetherBuy.auth_icons ? $scope.model.togetherBuy.auth_icons : [];

    if (!$scope.description) {
      $scope.is_inclusion = 2;

    }
    else {
      $scope.is_inclusion = 1;
    }
    if (!$scope.auth_icons.length) {
      $scope.is_auth_icons = 2;
    }
    else {
      $scope.is_auth_icons = 1;
      $scope.auth_icons.map(function (e, i) {
        if ($scope.model.postageSetting.type == 0) {
          $scope.list = [{id: 'QUALITY_GOODS', name: '正品保障', ischeck: false}, {id: 'AUTHENTICATION', name: '认证商户', ischeck: false}, {id: 'IMPORT_GOODS', name: '进口商品', ischeck: false}, {id: 'SUPER_SALE', name: '限时特惠', ischeck: false}];
        }
        else {
          $scope.list.map(function (k, j) {
            if (e.indexOf(k.id) != -1) {
              k.ischeck = true;
              if (k.ischeck) {
                list_id.push(k.id);
              }
              else {
                list_id.splice(index, 1);
              }
            }
          })
        }

      })

    }

    ///
    $scope.changeAuth = function (radio_id) {
      if (radio_id == 1) {
        if ($scope.model.postageSetting.type == 0) {
          $scope.list = [{id: 'QUALITY_GOODS', name: '正品保障', ischeck: false}, {id: 'AUTHENTICATION', name: '认证商户', ischeck: false}, {id: 'IMPORT_GOODS', name: '进口商品', ischeck: false}, {id: 'SUPER_SALE', name: '限时特惠', ischeck: false}];
        }
      }
    }
    //点击选择商品  关联商品
    $scope.concatd = function () {
      $rootScope.productObj = $scope.productList;
    };
    var index = -1;
    //选择认证标识
    $scope.choose = function (obj, idx) {

      if (obj.ischeck) {//如果是选中 并且不存在于List中就添加
        list_id.push(obj.id);
      } else if (!obj.ischeck) {//如果是取消 并且存在于List中就移除
        del(obj.id);
      }
      if (list_id.length > 3) {
        alert('最多只能选择三个！');
        list_id.splice(-1, 1);
        return obj.ischeck = false;
      }
    };
    //删除数组中指定的某个元素
    function del(varElement) {
      var numDeleteIndex = -1;
      for (var i = 0; i < list_id.length; i++) {
        // 严格比较，即类型与数值必须同时相等。
        if (list_id[i] === varElement) {
          list_id.splice(i, 1);
          numDeleteIndex = i;
          break;
        }
      }
      return numDeleteIndex;
    }

    //验证
    $scope.changeText = function (val, obj, index) {
      switch (index) {
        case 0:

          if (!val) return;
          if (!(/^([0-9]+\.[0-9]{1,2}|[1-9][0-9]*)$/).test(val)) {
            obj.buy_price = '';
            return alert('请输入大于0的正整数或者保留2位小数的数');
          }
          if (val * 100 > obj.retail_price) {
            obj.buy_price = '';
            return alert('团购价需小于等于销售价');
          }
          break;
        case 1:

          if (!val) return;
          if (!(/^[1-9][0-9]*$/).test(val)) {
            obj.quota = '';
            return alert('请输入大于0的正整数');
          }
          if (parseInt(val) > parseInt(obj.reserves)) {
            obj.quota = '';
            return alert('限购数量需小于等于库存');
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
        case 3:
          if (!val) return;
          if (!(/^\b[1-9]\d*\b[1-9]*$/).test(val)) {
            obj.together_num = '';
            return alert('请输入大于1的整数');
          }
          if (parseInt(val) < 2 || parseInt(val) > 100) {
            obj.together_num = '';
            return alert('参团人数至少2人且不能超过100人');
          }
          if (parseInt(obj.together_num) > parseInt(obj.quota)) {
            obj.together_num = '';
            return alert('参团人数不能大于配额');
          }
          break;
        case 4:
          if ($scope.model['togetherBuy']['is_discount'] == 1) { //优惠
            if (!$('#amountVal').val()) {
              $scope.isDisAmount = true;
              return $timeout(function () {
                $scope.isDisAmount = false;
              }, 2000);
            }
            if (parseFloat($('#amountVal').val()) > 99999.99) {
              $scope.isMax = true;
              return $timeout(function () {
                $scope.isMax = false;
              }, 2000);
            }
            if (!(/^([0-9]+\.[0-9]{1,2}|[1-9][0-9]*)$/).test($('#amountVal').val())) {
              $scope.isDisShow = true;
              return $timeout(function () {
                $scope.isDisShow = false;
              }, 2000);
            }
          }
          break;
        case 5:
          if ($scope.model['togetherBuy']['is_time_limit'] == 1) { //限制时间
            if (!$scope.time_limit) {
              $scope.isTime = true;
              return $timeout(function () {
                $scope.isTime = false;
              }, 2000);
            }
            if (!(/^[1-9][0-9]*$/).test($scope.time_limit)) {
              $scope.isTimeShow = true;
              return $timeout(function () {
                $scope.isTimeShow = false;
              }, 2000);
            }
          }
          break;
        case 6:
          if ($scope.is_inclusion == 1) {
            if (!$("#description").val()) {
              $scope.isDec = true;
              return $timeout(function () {
                $scope.isDec = false;
              }, 2000);
            }

            if (parseInt($("#description").val().length) > 150) {
              $scope.isMaxDec = true;
              return $timeout(function () {
                $scope.isMaxDec = false;
              }, 2000);
            }
          }
          break;
      }
    };

    //删除商品
    $scope.deleteProduct = function (index, obj) {
      //有id 指 已经保存到数据库
      if (obj.id) {
        wsh.setDialog('删除提示', '确定要删除该数据吗?', 'together-buy-goods-del-ajax', {id: obj.id}, function () {
          $scope.productList = [];
        }, '删除成功');
      } else {
        wsh.setNoAjaxDialog('删除提示', '确定要删除该数据吗?', function () {
          obj.ischeck = false;
          $scope.productList = [];
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
      if (input.eq(0).val() && input.eq(1).val() && input.eq(2).val() && input.eq(3).val()) {
        if (obj.id) {
          //走编辑接口
          $http.post('/together-buy/together-buy-goods-update-ajax', {
            together_buy_id: $scope.model.togetherBuy.id,
            buy_price: obj.buy_price * 100,
            product_price: obj.retail_price * 100,
            quota: obj.quota,
            limit_buy: obj.limit_buy,
            id: obj.id,
            together_num: obj.together_num
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
          $http.post('/together-buy/together-buy-goods-add-ajax', {
            together_buy_id: $scope.model.togetherBuy.id,
            product_id: obj.product_id,
            product_sku_id: obj.product_sku_id,
            buy_price: obj.buy_price * 100,
            quota: obj.quota,
            limit_buy: obj.limit_buy,
            together_num: obj.together_num
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
        $scope.isNull1 = !input.eq(0).val() ? true : false;
        $scope.isNull2 = !input.eq(1).val() ? true : false;
        $scope.isNull3 = !input.eq(2).val() ? true : false;
        $scope.isNull4 = !input.eq(3).val() ? true : false;

        $timeout(function () {
          $scope.isNull1 = $scope.isNull2 = $scope.isNull3 = $scope.isNull4 = false;
        }, 2000);
      }
    };
    //接收选择的商品数据   json 为一个二维数组
    $scope.$on('chooseProduct', function (e, json) {
      $.each($scope.productList, function (m, n) {
        if (!n.id) {
          $scope.productList.splice(m, 1);
        }
      });
      json[0].product_sku_id = json[0].id;
      delete json[0].id;
      $scope.productList = angular.copy(json);
    });
    //ajax 获取关联的商品列表
    getTogetherBuy();
    function getTogetherBuy() {
      $http.post('together-buy-goods-list-ajax', {
        '_page': 1,
        '_page_size': 100,
        id: $scope.model.togetherBuy.id
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
              $scope.productList[i].together_num = e.together_num;
            });
          });
        });
    }

    $('#start_time').val(wsh.getdate($scope.model.start_time));
    $('#end_time').val(wsh.getdate($scope.model.end_time));
    //运费策略
    if ($scope.model['postageSetting'].length == 0) {
      $scope.model['postageSetting']['type'] = 0;
    }
    $scope.isYuan = false, $scope.isJian = false;
    $scope.postoption = [{//运费策略
      "id": 0,
      "title": "无运费优惠"
    }, {
      "id": 3,
      "title": "该拼团订单免运费"
    }, {
      "id": 1,
      "title": "该拼团订单满多少元免运费"
    }, {
      "id": 2,
      "title": "该拼团单满多少件免运费"
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
      list_id = [];
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
      else {
        $scope.model['postageSetting']['type'] = id;
      }

      if (id != 0) {
        $scope.list = [{id: 'FREE_SHIPPING', name: '包邮', ischeck: false}, {id: 'QUALITY_GOODS', name: '正品保障', ischeck: false}, {id: 'AUTHENTICATION', name: '认证商户', ischeck: false}, {id: 'IMPORT_GOODS', name: '进口商品', ischeck: false}, {id: 'SUPER_SALE', name: '限时特惠', ischeck: false}];
      }
      else {
        $scope.list = [{id: 'QUALITY_GOODS', name: '正品保障', ischeck: false}, {id: 'AUTHENTICATION', name: '认证商户', ischeck: false}, {id: 'IMPORT_GOODS', name: '进口商品', ischeck: false}, {id: 'SUPER_SALE', name: '限时特惠', ischeck: false}];
      }
    };


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

    $scope.check = function (val) {
      $scope.isAgree = val;

    }
    //保存按钮
    $scope.isAmount = false, $scope.isNum = false, $scope.isSubmit = false, $scope.isHeight = false, $scope.isDisMount = false;
    $scope.saveBtn = function () {

      if ($scope.isAgree == 1) {

        return alert('请勾选拼团开启条件！');
      }

      if (!validateTime()) {
        return;
      }
      if ($scope.myform1.$invalid) {
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

      if ($scope.model['togetherBuy']['is_discount'] == 1) { //优惠
        if (!$scope.disAmout) {
          $scope.isDisAmount = true;
          return $timeout(function () {
            $scope.isDisAmount = false;
          }, 2000);
        }
        if (parseFloat($scope.disAmout) > 99999.99) {
          $scope.isMax = true;
          return $timeout(function () {
            $scope.isMax = false;
          }, 2000);
        }
        if (!(/^([0-9]+\.[0-9]{1,2}|[1-9][0-9]*)$/).test($scope.disAmout)) {
          $scope.isDisShow = true;
          return $timeout(function () {
            $scope.isDisShow = false;
          }, 2000);
        }
      }

      if ($scope.model['togetherBuy']['is_time_limit'] == 1) { //限制时间
        if (!$scope.time_limit) {
          $scope.isTime = true;
          return $timeout(function () {
            $scope.isTime = false;
          }, 2000);
        }
        if (!(/^[1-9][0-9]*$/).test($scope.time_limit)) {
          $scope.isTimeShow = true;
          return $timeout(function () {
            $scope.isTimeShow = false;
          }, 2000);
        }
      }
      //判断拼团商品是否处于编辑状态
      var isEdit = false;
      $.each($scope.productList, function (i, e) {
        if (!e.isShowEdit) {
          isEdit = true;
          return false;
        }
      });
      if (isEdit) {
        alert('请保存拼团商品');
        return false;
      }
      if (!$scope.productList.length || !$scope.productList[0].id) {
        alert('请设置拼团商品');
        return false;
      }
      if ($scope.is_inclusion == 1) {
        if (!$("#description").val()) {
          $scope.isDec = true;
          return $timeout(function () {
            $scope.isDec = false;
          }, 2000);
        }

        if (parseInt($("#description").val().length) > 150) {
          $scope.isMaxDec = true;
          return $timeout(function () {
            $scope.isMaxDec = false;
          }, 2000);
        }
      }
      if ($scope.is_auth_icons == 1) {
        if (!list_id.length) {
          return alert('请选择认证标识');
        }
      }
      var datas = {};
      if ($scope.model['postageSetting']['type'] == 0) { //无运费设置
        datas = {
          activity: {
            "id": $scope.model['id'],
            "name": $scope.model['name'],
            "desc": $scope.model['desc'],
            "expire_type": $scope.model['expire_type'],
            "postage_setting_id": 0,
            "start_time": startT,
            "end_time": endT,
            'share_type': $scope.model.share_type
          },
          togetherBuy: {
            "id": $scope.model['togetherBuy']['id'],
            "is_agree": $scope.isAgree,
            "is_discount": $scope.model['togetherBuy']['is_discount'],
            "is_time_limit": $scope.model['togetherBuy']['is_time_limit'],
            "head_price": parseFloat($scope.disAmout) * 100,
            "time_limit": parseInt($scope.time_limit),
            "is_open": $scope.model['togetherBuy']['is_open'],
            "is_more": $scope.model['togetherBuy']['is_more'],
            "is_auto_share": $scope.model['togetherBuy']['is_auto_share'],
            "auth_icons": list_id,
            "description": $scope.is_inclusion == 1 ? $scope.description : ''
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
            "id": $scope.model['id'],
            "name": $scope.model['name'],
            "desc": $scope.model['desc'],
            "expire_type": $scope.model['expire_type'],
            "start_time": startT,
            "end_time": endT,
            'share_type': $scope.model.share_type
          },
          postageSetting: {
            "type": $scope.model['postageSetting']['type'],
            "num": $scope.model['postageSetting']['num'] ? $scope.model['postageSetting']['num'] : null,
            //dierci有问题
            "amount": $scope.postageAmout * 100 ? Math.floor($scope.postageAmout * 100) : null
          },
          togetherBuy: {
            "id": $scope.model['togetherBuy']['id'],
            "is_agree": $scope.isAgree,
            "is_discount": $scope.model['togetherBuy']['is_discount'],
            "is_time_limit": $scope.model['togetherBuy']['is_time_limit'],
            "head_price": parseFloat($scope.disAmout) * 100,
            "time_limit": parseInt($scope.time_limit),
            "is_open": $scope.model['togetherBuy']['is_open'],
            "is_more": $scope.model['togetherBuy']['is_more'],
            "is_auto_share": $scope.model['togetherBuy']['is_auto_share'],
            "auth_icons": list_id,
            "description": $scope.is_inclusion == 1 ? $scope.description : ''
          },
          shareMessage: {
            "title": $scope.model['shareMessage']['title'],
            "desc": $scope.model['shareMessage']['desc'],
            "pic_id": $scope.model['shareMessage']['pic_id']
          }
        }
      }
      $http.post("/shop/get-ajax")
        .success(function (msg) {

          $scope.auto_refund = msg.errmsg.auto_refund;
          if ($scope.auto_refund == 1) {
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
          } else {
            alert('请开启自动退款');
          }

        })
        .error(function (msg) {

          wsh.successback(msg);
        });

    }
    $("[data-toggle='popover']").popover({html: true, trigger: 'hover focus'});
  });
  function isBlur() {
    var reg = /^([1-9]\\d{0,6}(\\.\\d{1,2})?|0\\.[1-9][0-9]?|0\\.[0-9][1-9])$/;
    var amount = $("#amountVal").val();
    if (reg.test(amount.toString())) {
      return true;
    }
    else {
      alert("请输入大于等于0的数，若是小数，最多保留2位小数");
      return false;
    }
  }


</script>