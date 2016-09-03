<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '新增红包活动';
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
          <li>新增红包活动</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="leader clearfix">
              <div class=" col-sm-6">
                <span class="label label-lg label-success arrowed-right no-padding"
                      id="home">1 设置图文</span>
              </div>
              <div class=" col-sm-6 ">
                <span class="label label-lg label-light arrowed-in no-padding"
                      id="rule">2 活动说明</span>
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
                          <h3 ng-bind="news.title"></h3>
                          <span class="text-muted" id="getDate"></span> <img
                            ng-src="{{news.imgsrc}}" width="212" height="120">

                          <div class="margin-bottom5" ng-bind="news.description"></div>
                          <div class="yue margin-top5">阅读全文<span><i
                                class="icon-angle-right bigger-110"></i></span></div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="col-sm-push-1 col-sm-7">
                  <form class="form-horizontal" name="myform1" novalidate="novalidate" ng-cloak>

                    <div class="form-group clearfix">
                      <label class="col-sm-2 control-label"> <strong class="red verg_mid">*</strong>图文标题：</label>

                      <div class="col-sm-10">
                        <input type="text" class="col-sm-5" ng-model="news.title" name="title" reg-char-len="60" prompt-msg="titleMsg" prompt-type="1" ng-trim="false" diff-zh="true" required>
                        <span class="inline padding5 red" ng-show="myform1.title.$error.required && isSubmit" ng-cloak>必填项</span>
                        <span class="inline padding5" ng-class="{'red':myform1.title.$error.exceed}" ng-bind="titleMsg"></span>
                      </div>
                    </div>

                    <div class="form-group  margin-bottom20 clearfix">
                      <label class="col-sm-2 control-label"> <strong class="red verg_mid">*</strong>摘要内容：</label>

                      <div class="col-sm-10">

                        <textarea class="col-sm-5 padding5" style="height: 250px" id="form-field-8" name="description" ng-model="news.description" reg-char-len="120" prompt-msg="descMsg" prompt-type="1" ng-trim="false" diff-zh="true" required></textarea>
                        <span class="inline padding5" ng-class="{'red':myform1.description.$error.exceed}" ng-bind="descMsg"></span>

                        <span class="inline padding5 red" ng-show="myform1.description.$error.required && isSubmit" ng-cloak>必填项</span></div>
                    </div>

                    <div class="form-group clearfix">
                      <label class="col-sm-2 control-label"> <strong class="red verg_mid">*</strong>活动图片：</label>

                      <div class="col-sm-10">
                        <div class="ace-file-input col-sm-4 margin-right10 clearfix">
                          <a data-toggle="modal" data-target="#myModalImage" ng-click="newsBtn()">
                            <label class="file-label" data-title="选择"> <span
                                class="file-name file-name2 " data-title="点击上传图片..."> <i
                                  class="icon-upload-alt"></i> </span> </label>
                          </a>
                        </div>
                        <span class="inline padding5 grey">（建议尺寸像素：360*200像素或等比例图片）</span>
                        <span class="inline padding5 red" ng-show="!news.imgsrc"
                              ng-cloak>请选择活动图片</span></div>
                    </div>

                    <div class="form-group clearfix" ng-show="news.imgsrc" ng-cloak>
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-10">
                        <img ng-src="{{news.imgsrc}}" class="img-thumb3"/>

                      </div>
                    </div>

                  </form>
                </div>

              </div>
            </div>
            <!--图文设置结束了-->

            <!--活动规则开始了-->
            <div class="tab-pane ruleCont margin-top20 clearfix" ng-show="isRule">
              <form class="form-horizontal" name="myform2" novalidate="novalidate">

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>活动名称：</label>

                  <div class="col-sm-10">
                    <input type="text" class="col-sm-4" ng-model="name" reg-char-len="30" prompt-msg="nameMsg" prompt-type="1" ng-trim="false" diff-zh="true"
                           name="name" required>
                    <span class="inline padding5" ng-class="{'red':myform2.name.$error.exceed}" ng-bind="nameMsg"></span>
                    <span class="inline padding5 red"
                          ng-show="myform2.name.$error.required && isSubmit" ng-cloak>必填项</span>
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label"> <strong class="red verg_mid">*</strong>红包类型：</label>

                  <div class="col-sm-10">
                    <select class="col-sm-2" ng-model="redPackType"
                            ng-options="o.id as o.title for o in redpackOption"
                            ng-change="changeRedpack(redPackType)">
                    </select>
                    <span class="inline padding5 light-grey">注：添加后，无法再修改。</span></div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>选择红包：</label>

                  <div class="col-sm-10">
                    <div class="ace-file-input col-sm-9 no-padding clearfix">
                      <a data-toggle="modal" data-target="#redPackModal"
                         class="btn btn-xs btn-primary"> 选择红包 </a>
                      <span
                        class="inline padding5 verg_mid light-grey"> 注：添加后，无法再修改；接龙类型红包请选择整数红包。</span>
                    </div>

                  </div>
                </div>

                <div class="form-group clearfix" ng-cloak ng-show="redPackList.length">
                  <div class="col-sm-12">
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
                      <tr ng-repeat="list in redPackList">
                        <td ng-bind="list.name">123</td>
                        <td ng-bind="list.total_amount | price: 2">100.00</td>
                        <td ng-bind="list.order_limit | price: 2">100.00</td>
                        <td ng-bind="list.type == 1 ? '商城红包' : '现金红包'">商城红包</td>
                        <td class="text-center">
                          <span ng-bind="list.start_time * 1000 | date:'yyyy-MM-dd HH:mm:ss'"></span> 至
                          <span ng-bind="list.end_time * 1000 | date:'yyyy-MM-dd HH:mm:ss'"></span>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="form-group clearfix" ng-show="isnumPerPacket">
                  <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>每个红包：</label>

                  <div class="col-sm-10">
                    <input type="text" class="col-sm-4" name="num_per_packet"
                           ng-pattern="/^[1-9][0-9]*$/" maxlength="4" ng-model="num_per_packet"
                           id="numperpacket">
                    <span class="inline padding5">人瓜分</span>
                    <span class="inline padding5 light-grey"> 注：瓜分人数需小于1万；添加后，无法再修改</span>
                    <span class="inline padding5 red" ng-show="isGroup" ng-cloak>必填项</span>
                    <span class="inline padding5 red"
                          ng-show="myform2.num_per_packet.$error.pattern" ng-cloak>请输入数字</span>
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>生成红包个数：</label>

                  <div class="col-sm-10">
                    <input type="text" class="col-sm-4" ng-model="red_packet_num"
                           name="red_packet_num" maxlength="4" ng-pattern="/^[1-9][0-9]*$/"
                           required>
                    <span class="inline padding5 light-grey"> 注：红包份数需小于1万；添加后，无法再修改。</span>
                    <span class="inline padding5 red"
                          ng-show="myform2.red_packet_num.$error.required && isSubmit"
                          ng-cloak>必填项</span>
                    <span class="inline padding5 red"
                          ng-show="myform2.red_packet_num.$error.pattern" ng-cloak>请输入大于0的整数</span>
                  </div>
                </div>

                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label"><span class="red">*</span>活动有效时间：</label>

                  <div class="col-sm-8">
                    <div class="input-group col-sm-3 no-padding">
                      <input type="text" name="start" id="start_time"
                             class="Wdate form-control hasDatepicker"
                             onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}',maxDate:'#F{$dp.$D(\'end_time\')}'});"
                             value=""/>
                      <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                    </div>
                    <span class="float-left padding5"> 至 </span>

                    <div class="input-group col-sm-3 no-padding">
                      <input type="text" name="start" id="end_time"
                             class="Wdate form-control hasDatepicker"
                             onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'start_time\')}',maxDate:'2030-10-01'});"
                             value=""/>
                      <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                    </div>
                    <span class="inline padding5 red" ng-show="isTimes" ng-cloak>必填项</span> <span
                      class="inline padding5 red" ng-show="isCompare" ng-cloak>结束时间必须大于开始时间</span>
                  </div>
                </div>

                <div class="form-group  margin-bottom10 clearfix">
                  <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>活动说明：</label>

                  <div class="col-sm-10">
                    <textarea class="col-sm-5" style="height:160px;" id="form-field-8" ng-model="desc" name="desc" required reg-char-len="400" ng-trim="true" prompt-type="2" prompt-msg="descDescMsg"></textarea>
                    <span class="inline padding5" ng-class="{'red':myform2.desc.$error.exceed}" ng-bind="descDescMsg"></span>
                    <span class="inline padding5 red" ng-show="myform2.desc.$error.required && isSubmit" ng-cloak>必填项</span>
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
                      <span class="lbl"></span>
                    </label>

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
                               ng-model="share_type" checked>
                        <span class="lbl"> 开放性活动&nbsp;&nbsp;</span>
                      </label>
                      <span class="grey margin-left10">（可在惊喜页列表中显示，允许分享）</span>
                    </p>

                    <p>
                      <label>
                        <input name="offline" type="radio" class="ace" value="2"
                               ng-model="share_type">
                        <span class="lbl"> 线下分享活动</span>
                      </label>
                      <span class="grey margin-left5">（不在惊喜页列表中显示，允许分享）</span>

                    </p>

                    <p>
                      <label>
                        <input name="offline" type="radio" class="ace" value="3"
                               ng-model="share_type">
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
                      <span class="float-left margin-top5">分享标题</span>
                      <input type="text" class="col-sm-4 margin-left10"
                             ng-model="shareMessage.title" name="sharetitle" required
                             maxlength="36">
                      <span class="inline padding5 red"
                            ng-show="myform2.sharetitle.$error.required && isSubmit"
                            ng-cloak>必填项</span>
                      <span class="inline padding5 grey">（建议不超过36个字符）</span>
                    </div>
                  </div>

                  <div class="form-group  margin-bottom10 clearfix">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-9">
                      <label class="float-left margin-top5"> 分享描述</label>
                      <input type="text" class="col-sm-4 margin-left10" ng-model="shareMessage.desc"
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
                      <label class="float-left margin-top5"> 分享图标</label>

                      <div class="ace-file-input col-sm-3 margin-left10 clearfix">
                        <a data-toggle="modal" data-target="#myModalImage"
                           ng-click="shareMessageBtn()">
                          <label class="file-label" data-title="选择"> <span
                              class="file-name file-name2 " data-title="点击上传图片..."> <i
                                class="icon-upload-alt"></i></span>
                          </label>
                        </a>
                      </div>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-10">
                      <label class="float-left margin-left10 width51"></label>
                      <img ng-src="{{shareMessage.imgsrc}}" class="img-thumb"/>
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
              <a class="btn btn-primary" ng-cloak ng-show="isSBackb" ng-click="btnSave()"
                 id="btnSave"> 保存并关闭 </a>
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
<!--添加-->
<?php
echo $this->render('@app/views/redpack/index.php');
?>
<script language="javascript" type="text/javascript"
        src="/ace/js/DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ec');
    }, 100);
    var isSHeightB = false, img = true;
    $scope.isSBackb = false, $scope.isSNextb = true, $scope.isHome = true, $scope.isRule = false, $scope.isnumPerPacket = true, $scope.isDelete = true, $scope.isAttention = false, $scope.isSubmit = false, $scope.isSrcRequired = false;

    $scope.shareMessage = JSON.parse('<?= addslashe(json_encode($shareMessage))?>');//分享数据
    $scope.news = JSON.parse('<?= addslashe(json_encode($news))?>');//图文数据
    $scope.desc = JSON.parse('<?= addslashe(json_encode($rule))?>');//分享描述
    $scope.share_type = 1;

    //下一步
    $scope.btnNext = function () {
      if ($scope.myform1.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
      $rootScope.isuploadOne = false;
      isSHeightB = true;
      $scope.isSBackb = true, $scope.isSNextb = false, $scope.isHome = false, $scope.isRule = true;
      $("#home").removeClass("label-success").addClass("label-light");
      $("#rule").removeClass("label-light").addClass("label-success");
    };
    $scope.btnBack = function () {
      $scope.isSHeightB = false, $scope.isSBackb = false, $scope.isSNextb = true, $scope.isHome = true, $scope.isRule = false;
      $("#rule").removeClass("label-success").addClass("label-light");
      $("#home").removeClass("label-light").addClass("label-success");
    };
    $("#getDate").html(wsh.getdate());

    //活动类型
    $scope.redPackType = 1;
    $scope.redpackOption = [
      {"id": 1, "title": "群红包"}
      /* TODO 暂时去掉 {"id": 2, "title":"接龙红包"}*/
    ];
    $scope.changeRedpack = function (type) {
      $scope.isnumPerPacket = true;
      if (type != 1) {
        $scope.isnumPerPacket = false;
      }
      $scope.redPackType = type;
    };
    $scope.newsBtn = function () {
      img = true;
    };
    $scope.shareMessageBtn = function () {
      img = false;
    };

    $scope.$on('ImageListChange', function (e, json) {
      for (var i = 0; i < json.length; i++) {
        if (img) {
          $scope.news.document_id = json[i]["id"];
          $scope.news.imgsrc = json[i]["file_cdn_path"];
        } else {
          $scope.shareMessage.pic_id = json[i]["id"];
          $scope.shareMessage.imgsrc = json[i]["file_cdn_path"];
        }
      }

    });
    //选择图片
    $scope.$on('ImageChoose', function (e, json) {
      if (img) {
        $scope.news.document_id = json[0]["id"];
        $scope.news.imgsrc = json[0]["file_cdn_path"];
      } else {
        $scope.shareMessage.pic_id = json[0]["id"];
        $scope.shareMessage.imgsrc = json[0]["file_cdn_path"];
      }
    });

    $scope.isGroup = false;
    $scope.btnSave = function () {
      if (!$scope.redPackList.length) return alert('请选择红包!');
      if ($scope.myform2.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
      if ($scope.redPackType == 1) {
        if ($("#numperpacket").val() == "" || $("#numperpacket").val() == "undefined") {
          $scope.isGroup = true;
          return $timeout(function () {
            $scope.isGroup = false;
          }, 2000);
        }
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
        $scope.is_attention = 1;
      } else {
        $scope.is_attention = 2;
      }
      $scope.datas = {
        "activity": {
          "name": $scope.name,
          "desc": $scope.desc,
          "start_time": $scope.start,
          "end_time": $scope.end,
          "share_type": $scope.share_type

        },
        "redPacketEvent": {
          "type": $scope.redPackType,
          "red_packet_id": $scope.redPackList[0].id,  //红包表外键 |
          "num_per_packet": $scope.num_per_packet,
          "red_packet_num": $scope.red_packet_num,
          "is_attention": $scope.is_attention
        },
        "shareMessage": {
          "title": $scope.shareMessage.title,
          "desc": $scope.shareMessage.desc,
          "pic_id": $scope.shareMessage.pic_id
        },
        news: {
          "title": $scope.news.title,
          "description": $scope.news.description,
          "document_id": $scope.news.document_id
        }
      };
      $('#btnSave').attr('disabled', 'disabled');

      $http.post(wsh.url + "add-ajax", $scope.datas)
        .success(function (msg) {
          $('#btnSave').removeAttr('disabled');
          wsh.successback(msg, '添加成功', false, function () {
            window.location = 'list';
          });
        })
        .error(function (msg) {
          $('#btnSave').removeAttr('disabled');
          wsh.successback(msg);
        });
    };
    //红包
    $scope.redPackList = [];
    $scope.$on('chooseRedPack', function (e, obj) {
      console.log(obj);
      $scope.redPackList = [];
      $scope.redPackList.push(obj);

    });

  });
</script>