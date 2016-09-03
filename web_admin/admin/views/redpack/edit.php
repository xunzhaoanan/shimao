<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '修改红包活动';
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">
<div class="main-container" id="main-container" ng-controller="mainController">
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
          <li>修改红包活动</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="leader clearfix">
              <div class="col-sm-12 margin-bottom10"><span
                  class="label label-light  no-padding center"><b class="red">提示：活动一旦开启就不能再进行任何改动 </b> </span></div>
              <div class=" col-sm-6 no-padding"><span
                  class="label label-lg label-success arrowed-right no-padding"
                  id="home">1 设置图文</span></div>
              <div class=" col-sm-6 no-padding"><span
                  class="label label-lg label-light arrowed-in no-padding" id="rule">2 活动说明</span>
              </div>
            </div>

            <!--图文设置开始了-->
            <div class="tabbable clearfix">
              <div class="tab-pane active ruleCont margin-top20 clearfix" ng-show="isHome">

                <div class="weileft col-sm-push-1 col-sm-3">
                  <div class="weileftda">
                    <ul class="wbsc slim-scroll" data-height="455">
                      <li>
                        <div class="wcright">
                          <h3 ng-bind="wxImagetxtReplyItems.title"></h3>
                          <span class="text-muted" id="getDate"></span> <img
                            ng-src="{{wxImagetxtReplyItems.documentLib.file_cdn_path}}" width="212"
                            height="120">

                          <div class="margin-bottom5"
                               ng-bind="wxImagetxtReplyItems.description"></div>
                          <div class="yue">阅读全文<span><i
                                class="icon-angle-right bigger-110"></i></span></div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="col-sm-push-1 col-sm-7">
                  <form class="form-horizontal" name="myform1" novalidate="novalidate">
                    <div class="form-group clearfix">
                      <label class="col-sm-2 control-label"> <strong class="red verg_mid">*</strong>图文标题：</label>

                      <div class="col-sm-10">

                        <input type="text" class="col-sm-5" ng-model="wxImagetxtReplyItems.title" name="title" reg-char-len="60" prompt-msg="titleMsg" prompt-type="1" ng-trim="false" diff-zh="true" required>
                        <span class="inline padding5 red" ng-show="myform1.title.$error.required && isSubmit" ng-cloak>必填项</span>
                        <span class="inline padding5" ng-class="{'red':myform1.title.$error.exceed}" ng-bind="titleMsg"></span>
                      </div>
                    </div>

                    <div class="form-group  margin-bottom20 clearfix">
                      <label class="col-sm-2 control-label"> <strong class="red verg_mid">*</strong>摘要内容：</label>

                      <div class="col-sm-10">
                        <textarea class="col-sm-5 padding5" style="height:160px;"
                                  ng-model="wxImagetxtReplyItems.description" reg-char-len="120" prompt-msg="descMsg" prompt-type="1" ng-trim="false" diff-zh="true"
                                  name="description" required></textarea>
                        <span class="inline padding5" ng-class="{'red':myform1.description.$error.exceed}" ng-bind="descMsg"></span>
                        <span class="inline padding5 red"
                              ng-show="myform1.description.$error.required && isSubmit"
                              ng-cloak>必填项</span></div>
                    </div>

                    <div class="form-group clearfix">
                      <label class="col-sm-2 control-label"> <strong class="red verg_mid">*</strong>活动图片：</label>

                      <div class="col-sm-10">
                        <div class="ace-file-input col-sm-4 margin-right10 clearfix"><a
                            data-toggle="modal" data-target="#myModalImage" ng-click="news()">
                            <label class="file-label" data-title="选择"> <span
                                class="file-name file-name2 " data-title="点击上传图片..."> <i
                                  class="icon-upload-alt"></i> </span> </label>
                          </a></div>
                        <span class="inline padding5 grey">（建议尺寸像素：360*200像素或等比例图片）</span>
                        <span class="inline padding5 red" ng-show="isSrcRequired"
                              ng-cloak>请选择活动图片</span></div>
                    </div>

                    <div class="form-group clearfix"
                         ng-show="wxImagetxtReplyItems.documentLib.file_cdn_path" ng-cloak>
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-10"><img
                          ng-src="{{wxImagetxtReplyItems.documentLib.file_cdn_path}}"
                          class="img-thumb3"/></div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
            <!--图文设置结束了-->

            <!--活动规则开始了-->
            <div class="tab-pane active ruleCont margin-top20 clearfix" ng-show="isRule">
              <form class="form-horizontal " name="myform2" novalidate="novalidate">

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label"><strong class="red">*</strong>活动名称：</label>

                  <div class="col-sm-10">
                    <input type="text" class="col-sm-4" ng-model="activity.name" reg-char-len="30" prompt-msg="nameMsg" prompt-type="1" ng-trim="false" diff-zh="true"
                           name="name" required>
                    <span class="inline padding5" ng-class="{'red':myform2.name.$error.exceed}" ng-bind="nameMsg"></span>
                    <span class="inline padding5 red"
                          ng-show="myform2.name.$error.required && isSubmit" ng-cloak>必填项</span>
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label"><strong class="red">*</strong>活动类型：</label>

                  <div class="col-sm-10">
                    <select class="col-sm-2" ng-model="redPacketEvent.type"
                            ng-options="o.id as o.title for o in redpackOption"
                            ng-change="changeRedpack(redPacketEvent.type)" disabled>
                    </select>
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label">选择红包：</label>

                  <div class="col-sm-10 input-group">
                    <div class="ace-file-input col-sm-9 no-padding clearfix"><a
                        class="btn btn-xs btn-grey"> 选择红包 </a></div>
                  </div>
                </div>

                <div class="form-group clearfix">
                  <div class="col-sm-12 input-group">
                    <table class="table table-striped table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th width="10%">红包名称</th>
                        <th width="8%">红包金额</th>
                        <th width="10%">订单限额</th>
                        <th width="8%">红包类型</th>
                        <th width="20%" class="text-center">使用时间</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td ng-bind="model.redPacketEvent.redPacket.name">123</td>
                        <td ng-bind="model.redPacketEvent.redPacket.total_amount | price: 2">
                          100.00
                        </td>
                        <td ng-bind="model.redPacketEvent.redPacket.order_limit | price">100.00</td>
                        <td ng-bind="model.redPacketEvent.redPacket.type == 1 ? '商城红包' : '现金红包'">
                          商城红包
                        </td>
                        <td class="text-center">
                          <span ng-bind="model.redPacketEvent.redPacket.start_time * 1000 | date:'yyyy-MM-dd HH:mm:ss'"></span>
                          至
                          <span ng-bind="model.redPacketEvent.redPacket.end_time * 1000 | date:'yyyy-MM-dd HH:mm:ss'"></span>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="form-group clearfix" ng-show="isnumPerPacket">
                  <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>每个红包：</label>

                  <div class="col-sm-10">
                    <input type="text" class="col-sm-4" ng-model="redPacketEvent.num_per_packet"
                           name="num_per_packet" required maxlength="4" readonly>
                    <span class="inline padding5">人瓜分</span>
                    <span class="inline padding5 light-grey"> 注：瓜分人数需小于1万；添加后，无法再修改</span>
                    <span class="inline padding5"
                          ng-show="myform2.num_per_packet.$error.required && isSubmit"
                          ng-cloak>必填项</span>
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>生成红包个数：</label>

                  <div class="col-sm-10">
                    <input type="text" class="col-sm-4" ng-model="redPacketEvent.red_packet_num"
                           readonly maxlength="4" name="red_packet_num" ng-pattern="/^[1-9][0-9]*$/"
                           required>
                    <span class="inline padding5 light-grey"> 注：红包个数需小于1万；添加后，无法再修改。</span>
                    <span class="inline padding5 red" class="col-sm-4"
                          ng-model="redPacketEvent.red_packet_num" name="red_packet_num" required
                          readonly></span>
                    <span class="inline padding5 red"
                          ng-show="myform2.red_packet_num.$error.required && isSubmit"
                          ng-cloak>必填项</span>
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label"><span class="red">*</span>活动有效时间：</label>

                  <div class="col-sm-8">
                    <div class="input-group col-sm-3 no-padding">
                      <input type="text" name="start" id="start_time"
                             class="Wdate form-control hasDatepicker"
                             onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{$dp.$D(\'end_time\')||\'2030-10-01\'}'});"
                             value=""/>
                      <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                    </div>
                    <span class="float-left padding5"> 至 </span>

                    <div class="input-group col-sm-3 no-padding">
                      <input type="text" name="start" id="end_time"
                             class="Wdate form-control hasDatepicker"
                             onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'start_time\')}',maxDate:'2030-10-01'});"
                             value=""/>
                      <span class="input-group-addon"> <i class="icon-calendar"></i> </span></div>
                    <span class="inline padding5 red" ng-show="isTimes" ng-cloak>必填项</span>
                    <span class="inline padding5 red" ng-show="isCompare"
                          ng-cloak>结束时间必须大于开始时间</span></div>
                </div>

                <div class="form-group margin-bottom10 clearfix">
                  <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>活动说明：</label>

                  <div class="col-sm-10">
                    <textarea class="col-sm-5" style="height:160px;" id="form-field-8" ng-model="activity.desc" name="desc" required reg-char-len="400" ng-trim="true" prompt-type="2" prompt-msg="activityDescMsg"></textarea>
                    <span class="inline padding5 red" ng-show="myform2.desc.$error.required && isSubmit" ng-cloak>必填项</span>
                    <span class="inline padding5" ng-class="{'red':myform2.desc.$error.exceed}" ng-bind="activityDescMsg"></span>
                  </div>
                </div>
                <div class="form-group margin-bottom10 clearfix">
                  <label class="col-sm-2 control-label"></label>

                  <div class="col-sm-10">
                    <span class="inline padding5 grey">(请按活动实际情况进行填写)</span>
                  </div>
                </div>
                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>强制关注：</label>

                  <div class="col-sm-10">
                    <label>
                      <input name="switch-field-1" class="ace ace-switch ace-switch-6"
                             ng-model="isAttention" type="checkbox">
                      <span class="lbl"></span> </label>


                  </div>
  <span class="text-left margin-bottom10  margin-top20   text-warning orange font-size12" ng-show="isAttention">
                            <i class="icon-exclamation-triangle "></i>
                            开启强制关注有可能被微信官方停用公众号，请谨慎选择
                        </span>
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


                <!--高级设置开始了     -->
                <div id="share">
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">活动主页面：</label>

                    <div class="col-sm-9">
                      <span class="float-left margin-top5"><span class="red">*</span>分享标题</span>
                      <input type="text" class="col-sm-4 margin-left10" ng-model="shareaa.title"
                             name="sharetitle" required maxlength="36">
                      <span class="inline padding5 red"
                            ng-show="myform2.sharetitle.$error.required && isSubmit"
                            ng-cloak>必填项</span>
                      <span class="inline padding5 grey">（建议不超过36个字符）</span>
                    </div>
                  </div>

                  <div class="form-group  margin-bottom10 clearfix">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-9">
                      <label class="float-left margin-top5"><span class="red">*</span>分享描述</label>
                      <input type="text" class="col-sm-4 margin-left10" ng-model="shareaa.desc"
                             name="sharedesc" required maxlength="50">
                      <span class="inline padding5 red"
                            ng-show="myform2.sharedesc.$error.required && isSubmit"
                            ng-cloak>必填项</span>
                      <span class="inline padding5 grey">（建议不超过50个字符）</span>
                    </div>
                  </div>

                  <div class="form-group  margin-bottom10 clearfix">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-9">
                      <label class="float-left margin-top5"> <span class="red">*</span>分享图标</label>

                      <div class="ace-file-input col-sm-3 margin-left10 clearfix"><a
                          data-toggle="modal" data-target="#myModalImage" ng-click="shareMessage()">
                          <label class="file-label" data-title="选择"> <span
                              class="file-name file-name2 " data-title="点击上传图片..."> <i
                                class="icon-upload-alt"></i></span> </label>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-10">
                      <label class="float-left margin-left10 width51"></label>
                      <img ng-src="{{shareaa.documentLib.file_cdn_path}}" class="img-thumb"/>
                    </div>
                  </div>
                </div>
                <!--高级设置结束了-->
              </form>
            </div>
            <!--活动规则结束了-->
            <div class="space-32"></div>
            <!-- 确定 -->
            <div class="modal-footer margin-auto" id="modal-footer">
              <a class="btn btn-infor" href="list"> 返回列表 </a>
              <a class="btn btn-primary" ng-cloak ng-show="isSBackb" ng-click="btnBack()"> 上一步 </a>
              <a class="btn btn-primary" ng-cloak ng-show="isSNextb" ng-click="btnNext()">下一步 </a>
              <a class="btn btn-success" ng-cloak ng-show="isSBackb" ng-click="btnSave()"
                 id="btnSve"> 保存并关闭 </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
echo $this->render('@app/views/uploadImg/imageIndex.php');
?>
<script language="javascript" type="text/javascript"
        src="/ace/js/DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
  app.controller('mainController', function ($scope, $rootScope, $timeout) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ec');
    }, 100);
    $scope.model = JSON.parse('<?= addslashe(json_encode($model)); ?>');
    $scope.wxImagetxtReplyItems = $scope.model.news.wxImagetxtReplyItems[0];
    $scope.activity = $scope.model.activity;
    $scope.redPacketEvent = $scope.model.redPacketEvent;
    $scope.shareaa = $scope.model.shareMessage;//分享数据
    if ($scope.shareaa.length == 0) {
      $scope.shareaa = {};
      $scope.shareaa.documentLib = {};
    }

    $('#start_time').val(wsh.getdate($scope.activity.start_time));
    $('#end_time').val(wsh.getdate($scope.activity.end_time));
    var img = true;
    $scope.isSHeightB = false, $scope.isSBackb = false, $scope.isSNextb = true, $scope.isHome = true, $scope.isRule = false, $scope.isnumPerPacket = true,
      $scope.isAttention = false, $scope.isSubmit = false, $scope.isSrcRequired = false;

    if ($scope.redPacketEvent.is_attention == 1) {
      $scope.isAttention = true;
    } else {
      $scope.isAttention = false;
    }
    //下一步
    $scope.btnNext = function () {
      if ($scope.myform1.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
      if (!$scope.wxImagetxtReplyItems.documentLib.file_cdn_path) {
        $scope.isSrcRequired = true;
        return $timeout(function () {
          $scope.isSrcRequired = false;
        }, 2000);
      }
      $scope.isSHeightB = true, $scope.isSBackb = true, $scope.isSNextb = false, $scope.isHome = false, $scope.isRule = true;
      $("#home").removeClass("label-success").addClass("label-light");
      $("#rule").removeClass("label-light").addClass("label-success");
    };
    $scope.btnBack = function () {
      $scope.isSHeightB = false, $scope.isSBackb = false, $scope.isSNextb = true, $scope.isHome = true, $scope.isRule = false;
      $("#rule").removeClass("label-success").addClass("label-light");
      $("#home").removeClass("label-light").addClass("label-success");
    };

    $("#getDate").html(wsh.getdate());

    //活动类型默认为1
    $scope.redPacketEvent.type = 1;
    $scope.redpackOption = [
      {"id": 1, "title": "群红包"},
      {"id": 2, "title": "接龙红包"}
    ];
    //活动类型
    $scope.changeRedpack = function (type) {
      $scope.isnumPerPacket = true;
      if (type != 1) {
        $scope.isnumPerPacket = false;
      }
      $scope.redPacketEvent.type = type;
    };
    $scope.news = function () {
      img = true;
    };
    $scope.shareMessage = function () {
      img = false;
    };

    $rootScope.isuploadOne = false;
    $scope.$on('ImageListChange', function (e, json) {
      for (var i = 0; i < json.length; i++) {
        if ($scope.img) {
          $scope.wxImagetxtReplyItems.document_id = json[i]["id"];
          $scope.wxImagetxtReplyItems.documentLib.file_cdn_path = json[i]["file_cdn_path"];
        } else {
          $scope.shareaa.pic_id = json[i]["id"];
          $scope.shareaa.documentLib.file_cdn_path = json[i]["file_cdn_path"];
        }
      }

    });
    $scope.$on('ImageChoose', function (e, json) {
      if (img) {
        $scope.wxImagetxtReplyItems.document_id = json[0]["id"];
        $scope.wxImagetxtReplyItems.documentLib.file_cdn_path = json[0]["file_cdn_path"];
      } else {
        $scope.shareaa.pic_id = json[0]["id"];
        $scope.shareaa.documentLib.file_cdn_path = json[0]["file_cdn_path"];
      }
    });
    $scope.btnSave = function () {
      if ($scope.myform2.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
      $scope.isCompare = $scope.isTimes = false;
      $scope.startt = $("#start_time").val(), $scope.endtime = $("#end_time").val();
      if ($scope.startt == "" || $scope.startt == "undefined" || $scope.endtime == "" || $scope.endtime == "undefined") {
        $scope.isTimes = true;
        return $timeout(function () {
          $scope.isTimes = false;
        }, 2000);
      }
      $scope.start = +new Date($scope.startt) / 1000, $scope.end = +new Date($scope.endtime) / 1000;
      if ($scope.start >= $scope.end) {
        $scope.isCompare = true;
        return $timeout(function () {
          $scope.isCompare = false;
        }, 2000);
      }
      if ($scope.isAttention) {
        $scope.redPacketEvent.is_attention = 1;
      } else {
        $scope.redPacketEvent.is_attention = 2;
      }
      $scope.datas = {
        "activity": {
          "id": $scope.activity.id,
          "name": $scope.activity.name,
          "desc": $scope.activity.desc,
          "start_time": $scope.start,
          "end_time": $scope.end,
          "share_type": $scope.model.activity.share_type
        },
        "redPacketEvent": {
          "id": $scope.redPacketEvent.id,
          "type": $scope.redPacketEvent.type,
          "red_packet_id": $scope.redPacketEvent.red_packet_id,  //红包表外键 |
          "num_per_packet": $scope.redPacketEvent.num_per_packet,
          "red_packet_num": $scope.redPacketEvent.red_packet_num,
          "is_attention": $scope.redPacketEvent.is_attention
        },
        "shareMessage": {
          "title": $scope.shareaa.title,
          "desc": $scope.shareaa.desc,
          "pic_id": $scope.shareaa.pic_id
        },
        news: {
          "title": $scope.wxImagetxtReplyItems.title,
          "description": $scope.wxImagetxtReplyItems.description,
          "document_id": $scope.wxImagetxtReplyItems.document_id
        }
      };
      $('#btnSave').attr('disabled', 'disabled');

      $.ajax({
        type: "post",
        url: wsh.url + "edit-ajax",
        data: $scope.datas,
        dataType: "json",
        success: function (msg) {
          $('#btnSave').removeAttr('disabled');
          wsh.successback(msg, '修改成功', false, function () {
            window.location = 'list';
          });
        },
        error: function (msg) {
          $('#btnSave').removeAttr('disabled');
          wsh.successback(msg);
        }
      });
    }


  });
</script>