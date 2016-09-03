<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '添加抽奖活动设置';
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">
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
          <li>活动基本信息设置</li>
        </ul>
      </div>

      <div class="page-content">
        <div class="clearfix">
          <div class="col-xs-12">

            <div class="tabbable clearfix">
              <ng-form class="form-horizontal" name="myform" novalidate="novalidate">
                <!--基本信息设置开始了-->
                <div class="tab-pane active ruleCont">

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>活动名称：</label>

                    <div class="col-sm-10">
                      <input id="activity_name" type="text" class="col-sm-4"
                             ng-model="model.activity_name"
                             name="activity_name" reg-char-len="30" prompt-msg="actNameMsg" prompt-type="1" ng-trim="false" diff-zh="true" required>
                      <span class="inline padding5 red"
                            ng-show="myform.activity_name.$error.required && isSubmit"
                            ng-cloak>必填项</span>
                      <span class="inline padding5" ng-class="{'red':myform.activity_name.$error.exceed}" ng-bind="actNameMsg"></span>
                    </div>
                  </div>


                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">抽奖对象：</label>

                    <div class="col-sm-10">
                      <select class="col-sm-2" ng-model="model.buy_limit"
                              ng-options="o.id as o.name for o in limitOption"
                              ng-change="buyLimitChange(model.buy_limit)">
                      </select>
                    </div>
                  </div>


                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>活动时间：</label>

                    <div class="col-sm-8">
                      <div class="input-group col-sm-3 no-padding">
                        <input type="text" name="start" id="start_time"
                               class="Wdate form-control hasDatepicker"
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}',maxDate:'#F{$dp.$D(\'end_time\')||\'2030-10-01\'}'});"
                               value=""/>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                      </div>
                      <span class="float-left padding5 "> 至 </span>

                      <div class="input-group col-sm-3 no-padding">
                        <input type="text" name="start" id="end_time"
                               class="Wdate form-control hasDatepicker"
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}',maxDate:'2030-10-01'});"
                               value=""/>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                      </div>
                      <span class="inline padding5 red" ng-show="isTimes" ng-cloak>必填项</span>
                      <span class="inline padding5 red" ng-show="isCompare"
                            ng-cloak>结束时间必须大于开始时间</span>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">活动类型：</label>

                    <div class="col-sm-9">
                      <p>
                        <label>
                          <input name="offline" type="radio" class="ace" value="1"
                                 ng-model="model.share_type" checked>
                          <span class="lbl"> 开放性活动&nbsp;&nbsp;</span>
                        </label>
                        <span class="grey margin-left10">（可在惊喜页列表中显示，允许分享）</span>
                      </p>

                      <p>
                        <label>
                          <input name="offline" type="radio" class="ace" value="2"
                                 ng-model="model.share_type">
                          <span class="lbl"> 线下分享活动</span>
                        </label>
                        <span class="grey margin-left5">（不在惊喜页列表中显示，允许分享）</span>

                      </p>

                      <p>
                        <label>
                          <input name="offline" type="radio" class="ace" value="3"
                                 ng-model="model.share_type">
                          <span class="lbl"> 线下活动 &nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </label>
                        <span class="grey margin-left12">（不在惊喜页列表中显示，禁止分享）</span>
                      </p>
                    </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">是否强制关注：</label>

                    <div class="col-sm-10">
                      <label>
                        <input name="switch-field-1" class="ace ace-switch ace-switch-6"
                               my-check-box ng-model="model.is_subscribe" type="checkbox" ng-click="change(model.is_subscribe)">
                        <span class="lbl"></span> </label>

                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">赠送抽奖机会：</label>

                    <div class="col-sm-10">
                      <label>
                        <input name="switch-field-1" class="ace ace-switch ace-switch-6"
                               ng-model="model.isShareAward" type="checkbox">
                        <span class="lbl"></span> </label>
                      <span class="inline padding5 grey">（注：分享并成功邀请好友赠送一次机会，同一个好友只有一次）</span>
                    </div>
                       <span class="text-left margin-bottom20  margin-top20   text-warning orange font-size12" ng-show="isAttention || model.isShareAward">
                            <i class="icon-exclamation-triangle "></i>
                            开启强制关注/赠送抽奖机会有可能被微信官方停用公众号，请谨慎选择
                        </span>
                  </div>


                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">是否使用积分抽奖：</label>

                    <div class="col-sm-10">
                      <select class="col-sm-2" ng-model="model.use_points"
                              ng-options="o.id as o.name for o in useOption"
                              ng-change="useChange(model.use_points)">
                      </select>
                    </div>
                  </div>

                  <div class="form-group margin-bottom10 clearfix" ng-show="model.use_points == 1">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-10">
                      <input type="text" class="inline width181" id="points_count" maxlength="7"
                             ng-model="model.points_count"
                             ng-change="pointsCount(model.points_count)">
                      <span class="lbl padding5 inline">积分增加一次抽奖机会，限制使用</span>
                      <input type="text" class="inline width181" id="points_num" maxlength="7"
                             ng-model="model.points_num" ng-change="pointsNum(model.points_num)">
                      <span class="lbl padding5 inline">次</span>
                      <span class="inline padding5 grey">（注：限制次数为0或不填则无次数限制）</span>
                      <span class="inline padding5 red" ng-show="isUse">必填项</span>
                      <span class="inline padding5 red" ng-show="isUseCount">大于0的整数</span>
                      <span class="inline padding5 red" ng-show="isUseNum">大于等于0的整数</span>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">次数限制类型：</label>

                    <div class="col-sm-10">
                      <select class="col-sm-2" ng-model="model.limit_type"
                              ng-options="o.id as o.name for o in limitTypeOption"
                              ng-change="limitTypeChange(model.limit_type)">
                      </select>
                      <!--<span class="inline padding5 grey">（注：限制次数为0或不填则无次数限制）</span>-->
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>限制参与次数：</label>

                    <div class="col-sm-10">
                      <input id="try_limit" type="text" maxlength="3" class="col-sm-4"
                             ng-model="model.try_limit"
                             name="try_limit" required ng-change="tryLimitChange(model.try_limit)">
                      <span class="inline padding5 red"
                            ng-show="myform.try_limit.$error.required && isSubmit"
                            ng-cloak>必填项</span>
                      <span class="inline padding5 red" ng-show="istryLimit">大于0的整数</span>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">中奖次数限制：</label>

                    <div class="col-sm-10">
                      <select class="col-sm-2" ng-model="model.winning_limit"
                              ng-options="o.id as o.name for o in winningOption"
                              ng-change="winningChange(model.winning_limit)">
                      </select>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>补充活动说明：</label>

                    <div class="col-sm-10">
                      <textarea id="activity_desc" class="col-sm-5" style="height:160px;"
                                placeholder="字符个数少于300"
                                ng-model="model.activity_desc" name="activity_desc"
                                ng-maxlength="300"
                                required>
                      </textarea>
                      <span class="inline padding5 red"
                            ng-show="myform.activity_desc.$error.required && isSubmit"
                            ng-cloak>必填项</span>
                      <span class="inline padding5 red"
                            ng-show="myform.activity_desc.$error.maxlength && isSubmit" ng-cloak>字符超过300</span>
                    </div>
                  </div>
                  <div class="form-group margin-bottom10 clearfix">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                      <span class="inline padding5 grey" >(请按活动实际情况进行填写)</span>
                    </div>
                  </div>

                  <!--基本信息设置结束了-->
                  <div class="space-32"></div>

                  <!--奖励设置开始了-->
                  <div class="form-group clearfix">
                    <h4>活动奖励设置</h4>

                    <div class="hr hr16 hr-dotted"></div>
                    <div class="table-responsive clearfix">
                      <table class="table table-striped table-bordered table-hover table-width">
                        <thead>
                        <tr>
                          <th width="8%">奖项</th>
                          <th width="15%">类型</th>
                          <th width="20%">奖品</th>
                          <th width="20%">奖品图片(80*80)</th>
                          <th width="20%">数量</th>
                          <th width="20%">中奖率</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-if="prizeList.level == 0" ng-repeat="prizeList in prizeLists">
                          <td>未中奖</td>
                          <td colspan="4">
                            <input id="prizename" type="text" class="col-sm-8" placeholder="20个字以内"
                                   ng-model="prizeList.name" name="prizename" maxlength="20" required>
                            <span class="inline padding5 red"
                                  ng-show="myform.prizename.$error.required && isSubmit" ng-cloak>必填项</span>

                          </td>
                          <td><input type="text" class="col-sm-6" ng-model="prizeList.probability"
                                     id="fristproba" readonly>
                            <span class="inline padding5">%</span></td>

                        </tr>
                        <tr ng-if="prizeList.level != 0" ng-repeat="prizeList in prizeLists">
                          <td ng-if="prizeList.level == 1">一等奖</td>
                          <td ng-if="prizeList.level == 2">二等奖</td>
                          <td ng-if="prizeList.level == 3">三等奖</td>
                          <td ng-if="prizeList.level == 4">四等奖</td>
                          <td ng-if="prizeList.level == 5">五等奖</td>
                          <td>
                            <select style="width:80px;" ng-model="prizeList.type"
                                    ng-options="o.id as o.name for o in prizeOption"
                                    ng-change="prizeChange(prizeList)"></select>
                          </td>
                          <td class="prizenameIndex">
                            <input ng-if="prizeList.type == 1" type="text" class="col-sm-6"
                                   name="prizename{{$index}}" ng-model="prizeList.name"
                                   ng-change="onNameChange(prizeList)">

                            <input ng-if="prizeList.type == 3" type="text" class="col-sm-6"
                                   name="prizename3{{$index}}" ng-model="prizeList.name"
                                   ng-pattern="" reg-int maxlength="7"
                                   ng-change="onNameChange(prizeList)">
                            <span  class="inline padding5" ng-if="prizeList.type == 3">分</span>

                            <span ng-if="prizeList.type == 3" class="inline padding5 red"
                                  ng-show="myform.prizename3{{$index}}.$error.pattern">{{$root.regIntText}}</span>

                                  <span ng-if="prizeList.type == 2" type="submit"
                                        data-toggle="modal" data-target="#cardModal"
                                        class="btn btn-xs btn-primary" ng-show="!prizeList.name"
                                        ng-click="selectCard(prizeList.level)">
                                                   选择卡券
                                                </span>


                            <p ng-if="prizeList.type == 2" class="form-control-static pointer"
                               ng-show="prizeList.name" name="cardTitle">
                              {{prizeList.name}} <a href="javascript:void(0);"
                                                    class="inline margin-left10"
                                                    data-toggle="modal" data-target="#cardModal"
                                                    ng-click="selectCard(prizeList.level, prizeList.type_id)">重新选择</a>
                            </p>

                            <!--红包,此地方不好理解，namfour = namefourOption[0] 很关键-->


                                <span ng-if="prizeList.type == 4" type="submit" data-toggle="modal"
                                      data-target="#redPackModal"
                                      class="btn btn-xs btn-primary" ng-show="!prizeList.name"
                                      ng-click="selectRedPack(prizeList.level, prizeList.type_id)">
                                                   选择红包</span>

                            <p ng-if="prizeList.type == 4" class="form-control-static pointer"
                               ng-show="prizeList.name">
                              {{prizeList.name}} <a href="javascript:void(0);"
                                                    class="inline margin-left10"
                                                    data-toggle="modal" data-target="#redPackModal"
                                                    ng-click="selectRedPack(prizeList.level, prizeList.type_id)">重新选择</a>
                            </p>

                                 <span ng-if="prizeList.type == 5" type="submit" data-toggle="modal"
                                       data-target="#redCashPackModal"
                                       class="btn btn-xs btn-primary" ng-show="!prizeList.name"
                                       ng-click="selectCashRedPack(prizeList.level, prizeList.type_id)">
                                                   选择现金红包</span>

                            <p ng-if="prizeList.type == 5" class="form-control-static pointer"
                               ng-show="prizeList.name">
                              {{prizeList.name}} <a href="javascript:void(0);"
                                                    class="inline margin-left10"
                                                    data-toggle="modal"
                                                    data-target="#redCashPackModal"
                                                    ng-click="selectCashRedPack(prizeList.level, prizeList.type_id)">重新选择</a>
                            </p>
                            <span class="inline padding5 red " ng-if="prizeList.invalidInfo"
                                  ng-bind="prizeList.invalidInfo"></span>

                          </td>
                          <td class="action-buttons">
                            <a class="inline pointer" title="上传图片" data-toggle="modal"
                               data-target="#myModalImage" ng-click="btnPrizeImg(prizeList)">
                              <i class="icon-upload-alt"></i>
                            </a>
                            <img ng-src="{{prizeList.documentLib.file_cdn_path}}" width="80"
                                 height="80">
                          </td>
                          <td>
                            <input type="text" class="col-sm-6" ng-model="prizeList.num"
                                   name="name{{$index}}" required ng-pattern="/^\d+$/"
                                   maxlength="7">
                            <span class="inline padding5">份</span>
                            <span class="inline padding5 red"
                                  ng-show="myform.name{{$index}}.$error.required && isSubmit">必填项</span>
                            <span class="inline padding5 red"
                                  ng-show="myform.name{{$index}}.$error.pattern">正整数</span>
                          </td>
                          <td>
                            <input type="text" class="col-sm-6" ng-model="prizeList.probability"
                                   maxlength="7" name="probability{{$index}}"
                                   ng-change="probabilityChange(prizeList.probability, $index)"
                                   required ng-pattern="/^\d+(.\d{1,3})?$/"><span
                              class="inline padding5">%</span>
                            <span class="inline padding5 red"
                                  ng-show="myform.probability{{$index}}.$error.required && isSubmit">必填项</span>
                            <span class="inline padding5 red"
                                  ng-show="myform.probability{{$index}}.$error.pattern">正整数或者保留3位小数</span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="6">
                            <div class="text-right padding5">
                              <a class="btn btn-xs btn-primary margin-right10"
                                 ng-click="btnDelete()">删除 </a>
                              <a class="btn btn-xs btn-primary margin-right20" ng-click="btnAdd()">添加 </a>
                            </div>
                          </td>
                        </tr>
                        </tbody>
                      </table>

                      <div class="form-group clearfix">
                        <label class="col-sm-2 control-label"><strong
                            class="red verg_mid">*</strong>兑奖结束时间：</label>

                        <div class="col-sm-8">
                          <div class="input-group col-sm-3 no-padding">
                            <input type="text" name="start" id="prizetime"
                                   class="Wdate form-control hasDatepicker"
                                   onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}',maxDate:'2030-10-01'});"/>
                            <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                          </div>
                          <span class="inline padding5 red" ng-show="isPrizeTime"
                                ng-cloak>必填项</span>
                        </div>
                      </div>

                    </div>
                  </div>
                  <!--奖励设置结束了-->

                  <div class="space-32"></div>
                  <!--高级设置开始了-->
                  <div class="form-group clearfix">
                    <h4>图文信息设置</h4>

                    <div class="hr hr16 hr-dotted"></div>

                    <div class="form-group clearfix" id="starttitle">
                      <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>图文标题：</label>

                      <div class="col-sm-10">
                        <input type="text" class="col-sm-4" ng-model="startImageTxt.title"
                               name="starttitle"  reg-char-len="60" prompt-msg="titleMsg" prompt-type="1" ng-trim="false" diff-zh="true" required>
                        <span class="inline padding5" ng-class="{'red':myform.starttitle.$error.exceed}" ng-bind="titleMsg"></span>
                        <span class="inline padding5 red"
                              ng-show="myform.starttitle.$error.required && isSubmit"
                              ng-cloak>必填项</span>
                      </div>
                    </div>

                    <div class="form-group  margin-bottom20 clearfix">
                      <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>摘要内容：</label>

                      <div class="col-sm-10">
                        <textarea class="col-sm-5" style="height:160px;" ng-model="startImageTxt.description" name="startdesc" reg-char-len="120" prompt-msg="descMsg" prompt-type="1" ng-trim="false" diff-zh="true" required></textarea>
                        <span class="inline padding5" ng-class="{'red':myform.startdesc.$error.exceed}" ng-bind="descMsg"></span>
                        <span class="inline padding5 red"
                              ng-show="myform.startdesc.$error.required && isSubmit"
                              ng-cloak>必填项</span>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <label class="col-sm-2 control-label">图片：</label>

                      <div class="col-sm-10">
                        <div class="ace-file-input col-sm-3 clearfix">
                          <a data-toggle="modal" data-target="#myModalImage"
                             ng-click="btnStartImg()">
                            <label class="file-label" data-title="选择">
                                                  <span class="file-name file-name2 "
                                                        data-title="点击上传图片...">
                                                    <i class="icon-upload-alt"></i>
                                                  </span>
                            </label>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="form-group margin-bottom10 clearfix">
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-10">
                        <img ng-src="{{startImageTxt.imgsrc}}" class="img-thumb3">
                      </div>
                    </div>
                  </div>

                  <div class="space-32"></div>


                  <!-- 分享设置 -->
                  <div class="form-group clearfix">
                    <h4>分享设置</h4>

                    <div class="hr hr16 hr-dotted"></div>

                    <div class="form-group margin-bottom20 clearfix" id="sharetitle">
                      <label class="col-sm-2 control-label"><strong
                          class="red">*</strong>分享标题：</label>

                      <div class="col-sm-10">
                        <input type="text" class="col-sm-4" ng-model="shareMessageaa.title"
                               name="sharetitle" required  reg-char-len="60" prompt-msg="shareTitleMsg" prompt-type="1" ng-trim="false" diff-zh="true">
                            <span class="inline padding5 red"
                                  ng-show="myform.sharetitle.$error.required && isSubmit"
                                  ng-cloak>必填项</span>
                        <span class="inline padding5" ng-class="{'red':myform.sharetitle.$error.exceed}" ng-bind="shareTitleMsg"></span>
                      </div>
                    </div>

                    <div class="form-group margin-bottom20 clearfix">
                      <label class="col-sm-2 control-label"><strong
                          class="red">*</strong>分享内容：</label>

                      <div class="col-sm-10">
                        <textarea class="col-sm-5" style="height:160px;"
                                  ng-model="shareMessageaa.desc" name="sharedesc" reg-char-len="50" prompt-msg="shareDescMsg" prompt-type="1" ng-trim="false" diff-zh="true"
                                  required></textarea>
                        <span class="inpine padding5 red" ng-show="myform.sharedesc.$error.required && isSubmit" ng-cloak>必填项</span>
                        <span class="inline padding5" ng-class="{'red':myform.sharedesc.$error.exceed}" ng-bind="shareDescMsg"></span>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <label class="col-sm-2 control-label">分享图标：</label>

                      <div class="col-sm-10">
                        <div class="ace-file-input col-sm-3 clearfix">
                          <a data-toggle="modal" data-target="#myModalImage" ng-click="shareImg()">
                            <label class="file-label" data-title="选择">
                                                      <span class="file-name file-name2 "
                                                            data-title="点击上传图片...">
                                                        <i class="icon-upload-alt"></i>
                                                      </span>
                            </label>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="form-group margin-bottom10 clearfix">
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-10">
                        <label class="float-left margin-left10"></label>
                        <img ng-src="{{shareMessageaa.imgsrc}}" class="img-thumb">
                      </div>

                    </div>
                    <!-- 分享设置 -->

                  </div>

                </div>
              </ng-form>

            </div>


          </div>
        </div>
      </div>
      <div class="space-32"></div>
      <!-- 确定 -->
      <div class="modal-footer margin-auto" id="modal-footer">
        <a class="btn btn-infor" href="list"> 返回列表 </a>
        <a id="post" class="btn btn-primary" ng-click="btnSave()"> 保存并关闭 </a>
      </div>
    </div>
  </div>
</div>
<?php
echo $this->render('@app/views/card-coupons/card-connect.php');
?>
<?php
echo $this->render('@app/views/uploadImg/imageIndex.php');
?>
<?php
    echo $this->render('@app/views/redpack/index.php');
?>
<?php
    echo $this->render('@app/views/cash-redpack/index.php');
?>
<script language="javascript" type="text/javascript"
        src="/ace/js/DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
  app.controller('mainController', function ($scope, $rootScope, $timeout) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'eb');
    }, 100);
    //活动数据
    $scope.model = {};
    $scope.model.template = JSON.parse('<?= addslashe(json_encode($template)); ?>');   //某个活动类型
    $scope.templateOption = JSON.parse('<?= addslashe(json_encode($templateOption)); ?>');   //活动类型
    $scope.prizeOption = JSON.parse('<?= addslashe(json_encode($prizeType)); ?>');  //奖品类型
    $scope.shareNews = JSON.parse('<?= addslashe(json_encode($shareNews)); ?>');  //高级分享的数据
    $scope.prizeDefaultImg = JSON.parse('<?= addslashe(json_encode($prizeDefaultImg)); ?>');//默认图片
    $scope.model.activity_desc = JSON.parse('<?= addslashe(json_encode($rule)); ?>');// 活动规则
    $scope.model.share_type = 1;
    $rootScope.isuploadOne = false;

      $scope.change =function(is_subscribe){
          $scope.isAttention = is_subscribe == 1 ? true : false;  //强制关注
      }

    $scope.selectCard = function (level, id) {
      $rootScope.$broadcast('selectedCardId', id);
      $scope.levelOneBtn = level;
    };

    $scope.selectRedPack = function (level, id) {
      $rootScope.$broadcast('selectedRedPackId', id);
      $scope.levelTwoBtn = level;
    };
    $scope.selectCashRedPack = function (level, id) {
      $rootScope.$broadcast('selectCashRedPackId', id);
      $scope.levelThreeBtn = level;
    };


    //选择卡券
    $scope.$on('chooseCard', function (e, json) {
      $scope.prizeLists[$scope.levelOneBtn].invalidInfo = "";
      $scope.prizeLists[$scope.levelOneBtn].name = json.title;
      $scope.prizeLists[$scope.levelOneBtn].type_id = json.id;
    })
    //选择红包
    $scope.$on('chooseRedPack', function (e, obj) {
      $scope.prizeLists[$scope.levelTwoBtn].invalidInfo = "";
      $scope.prizeLists[$scope.levelTwoBtn].name = obj.name;
      $scope.prizeLists[$scope.levelTwoBtn].type_id = obj.id;

    });
    //选择现金红包
    $scope.$on('chooseCashRedPack', function (e, arr) {
      $scope.prizeLists[$scope.levelThreeBtn].invalidInfo = "";
      $scope.prizeLists[$scope.levelThreeBtn].name = arr.act_name;
      $scope.prizeLists[$scope.levelThreeBtn].type_id = arr.id;

    });


    //提交成功后页面跳转
    $scope.directUrl = 'list';
    switch ($scope.model.template) {
      case 1 :
        $scope.directUrl = 'list';
        break;
      case 4 :
        $scope.directUrl = 'smashegg-list';
        break;
    }
    $scope.startImageTxt = {};
    $scope.shareMessageaa = {};
    $scope.templateChange = function (template) {
      $scope.model.template = template;
      for (var k in $scope.shareNews) {
        if (k == template) {
          $scope.startImageTxt.title = $scope.shareNews[k].startNews.title;
          $scope.startImageTxt.description = $scope.shareNews[k].startNews.description;
          $scope.startImageTxt.imgsrc = $scope.shareNews[k].startNews.imgsrc;
          $scope.startImageTxt.document_id = $scope.shareNews[k].startNews.document_id;
          $scope.shareMessageaa.title = $scope.shareNews[k].shareMessage.title;
          $scope.shareMessageaa.desc = $scope.shareNews[k].shareMessage.desc;
          $scope.shareMessageaa.imgsrc = $scope.shareNews[k].shareMessage.imgsrc;
          $scope.shareMessageaa.pic_id = $scope.shareNews[k].shareMessage.pic_id;
        }
      }
    }
    //设置默认图文分享信息
    $scope.templateChange($scope.model.template);


    //抽奖对象
    $scope.model.buy_limit = 1;
    $scope.limitOption = [{"id": 1, "name": "所有用户"}, {"id": 2, "name": "购买过商品的用户"}];
    $scope.buyLimitChange = function (buy_limit) {
      $scope.model.buy_limit = buy_limit;
    };

    $scope.model.isShareAward = false;

    //是否使用积分抽奖
    $scope.model.use_points = 2;
    $scope.useOption = [{"id": 1, "name": "是"}, {"id": 2, "name": "否"}];
    $scope.useChange = function (type) {
      $scope.model.use_points = type;
    };

    //次数限制类型
    $scope.model.limit_type = 1;
    $scope.limitTypeOption = [{"id": 1, "name": "每天限制次数"}, {"id": 2, "name": "限制总次数"}];
    $scope.limitTypeChange = function (type) {
      $scope.model.limit_type = type;
    };

    $scope.isUseCount = false;
    $scope.pointsCount = function (count) {
      if (!(/^[1-9][0-9]*$/).test(count)) {
        $scope.model.points_count = "";
        $scope.isUseCount = true;
        return $timeout(function () {
          $scope.isUseCount = false;
        }, 2000);
      }
    };
    $scope.isUseNum = false;
    $scope.pointsNum = function (num) {
      if (!(/^[0-9]*$/).test(num)) {
        $scope.model.points_num = "";
        $scope.isUseNum = true;
        return $timeout(function () {
          $scope.isUseNum = false;
        }, 2000);
      }
    };
    $scope.istryLimit = false;
    $scope.tryLimitChange = function (num) {
      if (!(/^[1-9][0-9]*$/).test(num)) {
        $scope.model.try_limit = "";
        $scope.istryLimit = true;
        return $timeout(function () {
          $scope.istryLimit = false;
        }, 2000);
      }
    };

    $scope.onNameChange = function (obj) {
      if (obj.name && obj.name.trim()) {
        obj.invalidInfo = '';
      }
    };

    //中奖次数限制
    $scope.model.winning_limit = 1;
    $scope.winningOption = [{"id": 1, "name": "中奖一次后无法再次中奖"}, {"id": 2, "name": "可多次中奖"}];
    $scope.winningChange = function (type) {
      $scope.model.winning_limit = type;
    };

    //默认实物奖图片
    var defaultImg = $scope.prizeDefaultImg.filter(function (img) {
      if (img.id == 1) {
        return img;
      }
    })[0];
    if (!defaultImg) {
      defaultImg = {document_id: null, file_cdn_path: null};
    }
    $scope.prizeLists = [
      {
        "level": 0,
        "type": 1,
        "name": "",
        "type_id": null,
        "prize_pic": null,
        "documentLib": {"file_cdn_path": null},
        "num": 0,
        "probability": 100
      },
      {
        "level": 1,
        "type": 1,
        "name": "",
        "type_id": null,
        "prize_pic": defaultImg.document_id,
        "documentLib": {"file_cdn_path": defaultImg.imgPic},
        "num": 0,
        "probability": 0
      },
      {
        "level": 2,
        "type": 1,
        "name": "",
        "type_id": null,
        "prize_pic": defaultImg.document_id,
        "documentLib": {"file_cdn_path": defaultImg.imgPic},
        "num": 0,
        "probability": 0
      },
      {
        "level": 3,
        "type": 1,
        "name": "",
        "type_id": null,
        "prize_pic": defaultImg.document_id,
        "documentLib": {"file_cdn_path": defaultImg.imgPic},
        "num": 0,
        "probability": 0
      }
    ];

    $scope.probabilityChange = function (probability, index) {
      var nowproba = probability ? parseFloat(probability) * 1000 : 0
      var levelpre = 0, leveltotal = 0;
      $($scope.prizeLists).each(function (r, t) {
        if (t.level != 0 && r != index) {
          levelpre = t.probability ? parseFloat(t.probability) * 1000 : 0;
          leveltotal += levelpre;
        }
      });
      if (leveltotal + nowproba > 100000) {
        $scope.prizeLists[index].probability = (100000 - leveltotal) / 1000;
        $scope.prizeLists[0].probability = 0;
      } else {
        $scope.prizeLists[0].probability = (100000 - (leveltotal + parseFloat(probability) * 1000)) / 1000;
      }
    };


    $scope.prizeValue = JSON.parse('<?= addslashe(json_encode($prizeValue)); ?>');   //选择奖品类型为红包和优惠券时提供的值

    //type=2,卡券
    $scope.nametwoOption = $scope.prizeValue[2].data
    $scope.nametwo = $scope.nametwoOption[0];


    //type=4,红包
    $scope.namefourOption = $scope.prizeValue[4].data;
    $scope.namfour = $scope.namefourOption[0];


    //type=5,现金红包
    $scope.namefiveOption = $scope.prizeValue[5].data;
    $scope.namfive = $scope.namefiveOption[0];

    //奖品类型
    $scope.prizeChange = function (obj) {
      selectedRow = obj;
      selectedRow.type_id = "";
      selectedRow.name = "";
      selectedRow.invalidInfo = "";
      var tempImg = $scope.prizeDefaultImg.filter(function (img) {
        if (img.id == selectedRow.type) {
          return img;
        }
      })[0];
      selectedRow.documentLib = {};
      selectedRow.prize_pic = tempImg ? tempImg.document_id : '';
      selectedRow.documentLib.file_cdn_path = tempImg ? tempImg.imgPic : '';
    };

    //红包类型
    $scope.namefourChange = function (list, index) {
      $scope.prizeLists[index].type_id = list.id;
      $scope.prizeLists[index].name = list.name;
    };

    //现金红包类型
    $scope.namefiveChange = function (list, index) {
      $scope.prizeLists[index].type_id = list.id;
      $scope.prizeLists[index].name = list.act_name;
    };

    //卡券类型
    $scope.nametwoChange = function (list, index) {
      $scope.prizeLists[index].type_id = list.id;
      $scope.prizeLists[index].name = list.title;
    };
    //奖品上传图片
//    $scope.prizeimg = 1;

    //选中的行数据
    var selectedRow = {};

    $scope.btnPrizeImg = function (obj) {
//      $scope.prizeimg = 1;
      selectedRow = obj;
    };

    $scope.btnStartImg = function () {
      $scope.prizeimg = 20;
    };

    $scope.shareImg = function () {
      $scope.prizeimg = 21;
    };

    $scope.$on('ImageListChange', function (e, json) {
      for (var i = 0; i < json.length; i++) {
        if ($scope.prizeimg == 20) {   //图文
          if (!$scope.startImageTxt) {
            $scope.startImageTxt = {};
          }
          $scope.startImageTxt.document_id = json[i]["id"];
          $scope.startImageTxt.imgsrc = json[i]["file_cdn_path"];
        } else if ($scope.prizeimg == 21) {  //分享
          if (!$scope.shareMessageaa.documentLib) {
            $scope.shareMessageaa.documentLib = {};
          }
          $scope.shareMessageaa.pic_id = json[i]["id"];
          $scope.shareMessageaa.imgsrc = json[i]["file_cdn_path"];
        } else {   //奖品
          selectedRow.documentLib = selectedRow.documentLib || {};
          selectedRow.prize_pic = json[i]["id"];
          selectedRow.documentLib.file_cdn_path = json[i]["file_cdn_path"];
        }
      }
    });

    $scope.$on('ImageChoose', function (e, json) {
      if ($scope.prizeimg == 20) {   //图文
        if (!$scope.startImageTxt) {
          $scope.startImageTxt = {};
        }
        $scope.startImageTxt.document_id = json[0]["id"];
        $scope.startImageTxt.imgsrc = json[0]["file_cdn_path"];
      } else if ($scope.prizeimg == 21) {  //分享
        if (!$scope.shareMessageaa.documentLib) {
          $scope.shareMessageaa.documentLib = {};
        }
        $scope.shareMessageaa.pic_id = json[0]["id"];
        $scope.shareMessageaa.imgsrc = json[0]["file_cdn_path"];
      } else {   //奖品
        selectedRow.documentLib = selectedRow.documentLib || {};
        selectedRow.prize_pic = json[0]["id"];
        selectedRow.documentLib.file_cdn_path = json[0]["file_cdn_path"];
      }
    });

    //添加
    $scope.btnAdd = function () {
      if ($scope.prizeLists.length == 4) {
        $scope.prizeLists.push({
          "level": 4,
          "type": 1,
          "probability": 0,
          "num": 0,
          "prize_pic": defaultImg.document_id,
          "documentLib": {"file_cdn_path": defaultImg.imgPic}
        });
      } else if ($scope.prizeLists.length == 5) {
        $scope.prizeLists.push({
          "level": 5,
          "type": 1,
          "probability": 0,
          "num": 0,
          "prize_pic": defaultImg.document_id,
          "documentLib": {"file_cdn_path": defaultImg.imgPic}
        });
      } else {
        return alert("最多设置五等奖");
      }
    };

    //删除
    $scope.btnDelete = function () {
      if ($scope.prizeLists.length == 6) {
        $("#fristproba").val(parseInt($("#fristproba").val()) + parseInt($scope.prizeLists[5].probability))
        $scope.prizeLists.splice(5, 1);
      } else if ($scope.prizeLists.length == 5) {
        $("#fristproba").val(parseInt($("#fristproba").val()) + parseInt($scope.prizeLists[4].probability))
        $scope.prizeLists.splice(4, 1);
      } else {
        return alert("请至少保留三等奖");
      }
    };

    var invalidInfos = ['请输入实物奖', '请选择卡券', '请输入积分', '请选择红包', '请选择现金红包'];
    var is_send_ajax = false;
    $scope.btnSave = function () {
      $scope.isCompare = $scope.isTimes = $scope.isPrizeTime = $scope.isSubmit = $scope.isUse = false;
      //滚动条滚动
      var heightval = $("#activity_name").offset().top;
      var i = 0;
      var cnt = 0;
      angular.forEach($scope.prizeLists, function (oo, index) {
        i++;
        if (i == 1) {
          $scope.valueval1 = oo.type;
        } else if (i == 2) {
          $scope.valueval2 = oo.type;
        } else if (i == 3) {
          $scope.valueval3 = oo.type;
        } else if (i == 4) {
          $scope.valueval4 = oo.type;
        }
        if (index) {
          if (oo.name && !oo.name.trim() || !oo.name) {
            oo.invalidInfo = invalidInfos[parseInt(oo.type) - 1];
            cnt++;
          }
          else {
            oo.invalidInfo = "";
          }

        }

      });
      if (cnt) return false;


      if ($scope.myform.activity_name.$error.required == true) {
        var height = $("#activity_name").offset().top;
        document.body.scrollTop = height - heightval;
      } else if ($scope.myform.try_limit.$error.required == true) {
        var height = $("#try_limit").offset().top;
        document.body.scrollTop = height - heightval;
      } else if ($scope.myform.activity_desc.$error.required == true) {
        var height = $("#activity_desc").offset().top;
        document.body.scrollTop = height - heightval;
      } else if ($scope.myform.prizename.$error.required == true) {
        var height = $("#prizename").offset().top;
        document.body.scrollTop = height - heightval;
      } else if ($scope.valueval2 == 1 && $scope.myform.prizename1.$error.required == true) {
        var height = $(".prizenameIndex").offset().top;
        document.body.scrollTop = height - heightval;
      } else if ($scope.valueval2 == 3 && $scope.myform.prizename31.$error.required == true) {
        var height = $(".prizenameIndex").offset().top;
        document.body.scrollTop = height - heightval;
      } else if ($scope.valueval3 == 1 && $scope.myform.prizename2.$error.required == true) {
        var height = $(".prizenameIndex").offset().top;
        document.body.scrollTop = height - heightval;
      } else if ($scope.valueval3 == 3 && $scope.myform.prizename32.$error.required == true) {
        var height = $(".prizenameIndex").offset().top;
        document.body.scrollTop = height - heightval;
      } else if ($scope.valueval4 == 1 && $scope.myform.prizename3.$error.required == true) {
        var height = $(".prizenameIndex").offset().top;
        document.body.scrollTop = height - heightval;
      } else if ($scope.valueval4 == 3 && $scope.myform.prizename33.$error.required == true) {
        var height = $(".prizenameIndex").offset().top;
        document.body.scrollTop = height - heightval;
      } else if ($scope.myform.starttitle.$error.required == true) {
        var height = $("#starttitle").offset().top;
        document.body.scrollTop = height - heightval;
      } else if ($scope.myform.startdesc.$error.required == true) {
        var height = $("#starttitle").offset().top;
        document.body.scrollTop = height - heightval;
      } else if ($scope.myform.sharetitle.$error.required == true || $scope.myform.sharetitle.$error.maxlength == true) {
        var height = $("#sharetitle").offset().top;
        document.body.scrollTop = height - heightval;
      } else if ($scope.myform.sharedesc.$error.required == true || $scope.myform.sharedesc.$error.maxlength == true) {
        var height = $("#sharetitle").offset().top;
        document.body.scrollTop = height - heightval;
      }


      if ($scope.myform.$invalid) {
          $scope.isSubmit = true;
          return;
      }
      $scope.startt = $("#start_time").val(), $scope.endtime = $("#end_time").val(), $scope.prizetime = $("#prizetime").val();
      if ($scope.startt == "" || $scope.startt == "undefined" || $scope.endtime == "" || $scope.endtime == "undefined" || !$scope.prizeLists) {
        $scope.isTimes = true;
        var height = $("#start_time").offset().top;
        document.body.scrollTop = height - heightval;
        return;
      }
      $scope.start = +new Date($scope.startt) / 1000, $scope.end = +new Date($scope.endtime) / 1000;
      if ($scope.start >= $scope.end) {
        $scope.isCompare = true;
        var height = $("#start_time").offset().top;
        document.body.scrollTop = height - heightval;
        return;
      }
      if (!$scope.model.share_type) {

        return alert("请选择活动类型！")
      }
      if ($scope.model.use_points == 1) {
        $scope.countaa = $("#points_count").val();
        if ($scope.countaa == "" || $scope.countaa == "undefined") {
          $scope.isUse = true;
          var height = $("#points_count").offset().top;
          document.body.scrollTop = height - heightval;
          return;
        }
      }


      if ($scope.prizetime == "" || $scope.prizetime == "undefined") {

        $scope.isPrizeTime = true;
        var height = $("#prizetime").offset().top;
        document.body.scrollTop = height - heightval;
        return;
      }
      var filepath = 0;
      $($scope.prizeLists).each(function (a, b) {
        if (a != 0) {
          if (!b.documentLib.file_cdn_path) {
            filepath++;
          }
        }
      });
      if (filepath > 0) {
        var height = $(".prizenameIndex").offset().top;
        document.body.scrollTop = height - heightval;
        return alert("请选择奖品图片！")
      }

      $scope.model.share_award = $scope.model.isShareAward == true ? 1 : 2;
        $scope.model.is_subscribe = $scope.isAttention == true ? 1 : 2;  //强制关注
      $scope.ajaxData = {
        "activity_name": $scope.model.activity_name,
        "template": $scope.model.template,
        "buy_limit": $scope.model.buy_limit,
        "start_time": $scope.start,
        "end_time": $scope.end,
        "is_subscribe": $scope.model.is_subscribe,
        "share_award": $scope.model.share_award,
        "use_points": $scope.model.use_points,
        "points_count": $scope.model.points_count,
        "points_num": $scope.model.points_num ? $scope.model.points_num : 0,
        "limit_type": $scope.model.limit_type,
        "try_limit": $scope.model.try_limit,
        "winning_limit": $scope.model.winning_limit,
        "activity_desc": $scope.model.activity_desc,
        "prize": $scope.prizeLists,
        "expiry_time": +new Date($scope.prizetime) / 1000,
        "share_type": $scope.model.share_type,
        "startNews": {
          "title": $scope.startImageTxt.title,
          "description": $scope.startImageTxt.description,
          "document_id": $scope.startImageTxt.document_id
        },
        "shareMessage": {
          "title": $scope.shareMessageaa.title,
          "desc": $scope.shareMessageaa.desc,
          "pic_id": $scope.shareMessageaa.pic_id
        }
      }
      if (is_send_ajax) {

        return false;
      }
      is_send_ajax = true;
      $.ajax({
        type: "POST",
        url: wsh.url + "add-ajax",
        dataType: "JSON",
        data: $scope.ajaxData,
        success: function (msg) {
          wsh.successback(msg, '提交成功!', false, function () {
            window.location = $scope.directUrl;
          });
          is_send_ajax = false;
        },
        error: function () {
          is_send_ajax = false;
        }
      });


    }
  });
</script>