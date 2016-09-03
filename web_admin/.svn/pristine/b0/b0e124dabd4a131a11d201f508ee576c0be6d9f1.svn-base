<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '编辑预约内容';
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
          <li>编辑预约内容</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">

            <div class="leader clearfix">
              <div class="col-sm-12 margin-bottom10"><span
                  class="label label-light  no-padding center"><b class="red">提示：活动一旦开启就不能再进行任何改动 </b> </span></div>
              <div class=" col-sm-4"><span
                  class="label label-lg label-success arrowed-right no-padding" id="home_title">1 设置图文</span>
              </div>
              <div class=" col-sm-4"><span
                  class="label label-lg label-info arrowed-in arrowed-right no-padding"
                  id="rule_title">2 预约正文</span></div>
              <div class=" col-sm-4"><span class="label label-lg label-light arrowed-in no-padding"
                                           id="pro_title">3 预约项设置</span></div>
            </div>

            <!--设置图文开始了-->
            <div class="tabbable padding10 clearfix col-sm-12" id="home" ng-show="isHome">
              <div class="tab-pane active ruleCont margin-top20 clearfix">

                <div class="weileft col-sm-push-1 col-sm-3">
                  <div class="weileftda">
                    <ul class="wbsc slim-scroll" data-height="455">
                      <li>
                        <div class="wcright">
                          <h3 ng-bind="news.title"></h3>

                          <div class="text-muted" id="timephone"></div>
                          <img ng-src="{{news.documentLib.file_cdn_path}}" width="212" height="120">

                          <div class="margin-bottom5" ng-bind="news.description"></div>
                          <div class="yue">阅读全文<span><i
                              class="icon-angle-right bigger-110"></i></span></div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="col-sm-push-1 col-sm-7">
                  <form class="form-horizontal" name="myform" novalidate="novalidate">

                    <div class="form-group clearfix">
                      <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>图文标题：</label>

                      <div class="col-sm-10">

                        <input type="text" class="col-sm-5" ng-model="news.title" name="title" reg-char-len="60" prompt-msg="titleMsg" prompt-type="1" ng-trim="false" diff-zh="true" required>
                        <span class="inline padding5 red" ng-show="myform.title.$error.required && isSubmit" ng-cloak>必填项</span>
                        <span class="inline padding5" ng-class="{'red':myform.title.$error.exceed}" ng-bind="titleMsg"></span>
                      </div>
                    </div>

                    <div class="form-group margin-bottom20 clearfix">
                      <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>摘要内容：</label>

                      <div class="col-sm-10">
                        <textarea class="col-sm-5 padding5" style="height: 250px" id="form-field-8" name="description" ng-model="news.description" reg-char-len="120" prompt-msg="descMsg" prompt-type="1" ng-trim="false" diff-zh="true" required></textarea>
                        <span class="inline padding5" ng-class="{'red':myform.description.$error.exceed}" ng-bind="descMsg"></span>
                        <span class="inline padding5 red"
                              ng-show="myform.description.$error.required && isSubmit"
                              ng-cloak>必填项</span>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>活动图片：</label>

                      <div class="col-sm-10 input-group">
                        <div class="ace-file-input col-sm-4 clearfix" data-rel="tooltip" title=""
                             data-original-title="Default">
                          <a data-toggle="modal" data-target="#myModalImage" ng-click="ActiveImg()">
                            <label class="file-label" data-title="选择"> <span
                                class="file-name file-name2 " data-title="点击上传图片..."> <i
                                class="icon-upload-alt"></i> </span> </label>
                          </a>
                        </div>
                      </div>
                      <span class="inline padding5 red" ng-show="isImgShow" ng-cloak>请选择图片</span>
                    </div>

                    <div class="form-group margin-bottom10 clearfix"
                         ng-show="news.documentLib.file_cdn_path">
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-10">
                        <img ng-src="{{news.documentLib.file_cdn_path}}" class="img-thumb3"/>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
              <div class="space-32"></div>
            </div>
            <!--设置图文结束了-->

            <!--预约正文开始了-->
            <div class="tabbable " id="rule" style="display: none" ng-cloak>
              <div class="tab-pane active ruleCont margin-top20 clearfix">

                <form class="form-horizontal" name="myform1" novalidate="novalidate">

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>预约开始时间：</label>

                    <div class="col-sm-10">
                      <div class="input-group col-sm-5 no-padding">
                        <input type="text" name="start" id="start_time"
                               class="Wdate form-control hasDatepicker"
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{$dp.$D(\'end_time\')||\'2030-10-01\'}'});"
                               value=""/>
                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                        <span class="inline padding5 red" ng-show="isTimes" ng-cloak>必填项</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>
                      预约结束时间：</label>

                    <div class="col-sm-10">
                      <div class="input-group col-sm-5 no-padding">
                        <input type="text" name="start" id="end_time"
                               class="Wdate form-control hasDatepicker"
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'start_time\')}',maxDate:'2030-10-01'});"
                               value=""/>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                        <span class="inline padding5 red" ng-show="isTimes1" ng-cloak>必填项</span>
                        <span class="inline padding5 red" ng-show="isCompare"
                              ng-cloak>结束时间必须大于开始时间</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>
                      预约页面标题：</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-5" ng-model="model.title" name="modeltitle"
                             reg-char-len="60" prompt-msg="modelTitleMsg" prompt-type="1" ng-trim="false" diff-zh="true" required>
                      <span class="inline padding5" ng-class="{'red':myform1.modeltitle.$error.exceed}" ng-bind="modelTitleMsg"></span>
                      <span class="inline padding5 red"
                            ng-show="myform1.modeltitle.$error.required && isSubmit"
                            ng-cloak>必填项</span>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">预约人数上限：</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-5" ng-model="model.per_count" maxlength="7"
                             name="modelpercount" ng-change="changeText(model, model.per_count)">
                      <span class="inline padding5 grey">(注：0或者不填为不限制预约人数)</span>
                      <span class="inline padding5 red" ng-show="isChangeText"
                            ng-cloak>填写大于等于0的正整数</span>
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


                </form>
              </div>
              <div class="space-32"></div>
            </div>
            <!--预约正文结束了-->


            <!--预约项设置开始了-->
            <div id="pro" class="tab-pane active ruleCont margin-top20 clearfix" ng-show="isPro"
                 ng-cloak>

              <div class="alert alert-block alert-success">
                <button type="button" class="close" data-dismiss="alert">
                  <i class="ace-icon icon-times"></i>
                </button>
                <i class="ace-icon icon-check green"></i>提示：若为服务号高级接口，则请不需要获取微信用户昵称、性别、省、市、国家资料，因本身接口能获取。
              </div>

              <div class="form-group margin-bottom10 clearfix">
                <h4> 预约填写项</h4>

                <div class="hr hr16 hr-dotted"></div>

                <div class="table-responsive clearfix">
                  <table class="table table-striped table-bordered table-hover table-width">
                    <thead>
                    <tr>
                      <th width="20%" class="text-center">添加类型</th>
                      <th width="20%" class="text-center">字段类型</th>
                      <th width="20%" class="text-center">字段名称</th>
                      <th width="20%" class="text-center">初始内容</th>
                      <th width="8%" class="text-center">显示</th>
                      <th width="10%" class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="list in setting1">
                      <td class="lt-width3 text-center" ng-bind="default($index)"></td>
                      <td class="text-center" ng-bind="changeType($index)"></td>
                      <td class="text-center">
                        <input type="text" class="col-sm-10" ng-model="list.key" readonly></td>
                      <td class="text-center">
                        <input type="text" class="col-sm-10" ng-model="list.value" readonly>
                      </td>
                      <td class="text-center">
                        <label>
                          <input name="switch-field-1" class="ace" disabled
                                 ng-if="list.check == 'true'" type="checkbox" checked>
                          <input name="switch-field-1" class="ace" disabled
                                 ng-if="list.check == 'false'" type="checkbox">
                          <span class="lbl"></span>
                        </label>
                      </td>
                      <td class="text-center">
                        <div class="action-buttons">
                          <a class="blue pointer" ng-if="$index >= 8"
                             ng-click="threeEdit($index)"><i class="icon-bianji bigger-130"></i>
                          </a>
                          <a class="red pointer" href="#" title="删除" ng-if="$index >= 8"
                             ng-click="threeDelete($index)">
                            <i class="icon-shanchu bigger-130"></i>
                          </a>
                        </div>
                      </td>

                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="space-32"></div>
            </div>
            <!--预约项设置结束了-->

            <!-- 操作按钮开始了 -->
            <div class="modal-footer margin-auto" id="modal-footer" ng-cloak>
              <a class="btn btn-infor" href="list"> 返回列表 </a>
              <a id="back" class="btn btn-primary" ng-show="isThree" ng-click="threeBack()">
                上一步 </a>
              <a id="backOnce" class="btn btn-primary" ng-show="isTwo" ng-click="twoBack()">
                上一步 </a>
              <a id="next" class="btn btn-primary" ng-show="isOne" ng-click="oneNext()"> 下一步 </a>
              <a id="nextOnce" class="btn btn-primary" ng-show="isTwo" ng-click="twoNext()">
                下一步 </a>
              <a class="btn btn-primary" ng-show="isThree" id="btnSave"
                 ng-click="btnSave()">保存并关闭 </a>
            </div>
            <!-- 操作按钮结束了 -->

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
      $rootScope.$broadcast('leftMenuChange', 'ed');
    }, 100);
    $("#timephone").html(wsh.getdate());

    $scope.isOne = true, $scope.isTwo = $scope.isThree = false;
    $scope.isHome = true, $scope.isPro = false;
    $scope.isSubmit = $scope.isSubmit1 = $scope.isSubmit2 = false, $scope.isImgShow = false;

    $scope.model = JSON.parse('<?= addslashe(json_encode($model))?>');
    $scope.news = [];
    if ($.isArray($scope.model.news.wxImagetxtReplyItems)) {
      if ($scope.model.news.wxImagetxtReplyItems.length) {
        $scope.news = $scope.model.news.wxImagetxtReplyItems[0];
      }
    }

    $scope.setting1 = JSON.parse($scope.model.items);
    $scope.default = function (index) {
      if ($scope.setting1[index].addtype == "system") {
        return "系统默认";
      } else {
        return "自定义";
      }
    }
    $scope.changeType = function (index) {
      switch ($scope.setting1[index].type) {
        case 'text':
          return '单行文本';
          break;
        case 'select':
          return '下拉框';
          break;
        case 'calendar':
          return '日历';
          break;
        case 'textarea':
          return '多行文本';
          break;
      }
    };
    $("#start_time").val(wsh.getdate($scope.model.start_time));
    $("#end_time").val(wsh.getdate($scope.model.end_time));

    $scope.isChangeText = false;
    $scope.changeText = function (model, val) {
      if (!(/^\+?[0-9][0-9]*$/).test(val)) {
        model.per_count = '';
        $scope.isChangeText = true;
        return $timeout(function () {
          $scope.isChangeText = false;
        }, 2000);
      }
    };

    //第一页的下一步
    $scope.oneNext = function () {
      if ($scope.myform.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
      if (!$scope.news.documentLib.file_cdn_path) {
        $scope.isImgShow = true;
        return $timeout(function () {
          $scope.isImgShow = false;
        }, 2000);
      }
      $("#home_title").removeClass("label-success").addClass("label-light");
      $("#rule_title").removeClass("label-light").addClass("label-success");
      $scope.isRule = true;
      $("#rule").show();
      $scope.isHome = $scope.isPro = false;
      $scope.isOne = false, $scope.isTwo = true;
    };

    //第二页的下一步
    $scope.twoNext = function () {
      $scope.starttime = $("#start_time").val(), $scope.endtime = $("#end_time").val(), $scope.start = +new Date($scope.starttime) / 1000, $scope.end = +new Date($scope.endtime) / 1000;
      if ($scope.starttime == "" || $scope.starttime == "undefined") {
        return alert("开始时间不能为空！");
      }
      if ($scope.endtime == "" || $scope.endtime == "undefined") {
        return alert("结束时间不能为空！");
      }
      if ($scope.start >= $scope.end) {
        return alert("结束时间必须大于开始时间！！");
      }
      if ($scope.myform1.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
      if (!$scope.model.share_type) {
        return alert("请选择活动类型");
      }

      $("#rule_title").removeClass("label-success").addClass("label-light");
      $("#pro_title").removeClass("label-light").addClass("label-success");
      $scope.isPro = true, $scope.isHome = false;
      $("#rule").hide();
      $scope.isOne = $scope.isTwo = false, $scope.isThree = true;
    };

    //第二步的返回
    $scope.twoBack = function () {
      $("#rule_title").removeClass("label-success").addClass("label-light");
      $("#home_title").removeClass("label-light").addClass("label-success");
      $scope.isHome = true, $scope.isPro = false;
      $("#rule").hide();
      $scope.isThree = $scope.isTwo = false, $scope.isOne = true;
    };

    //第三步的返回
    $scope.threeBack = function () {
      $("#pro_title").removeClass("label-success").addClass("label-light");
      $("#rule_title").removeClass("label-light").addClass("label-success");
      $scope.isPro = $scope.isHome = false;
      $("#rule").show();
      $scope.isThree = $scope.isOne = false, $scope.isTwo = true;
    };

    //图片
    $scope.isImg = true;
    $scope.ActiveImg = function () {
      $scope.isImg = true;
    };
    $scope.YaoQingImg = function () {
      $scope.isImg = false;
    };
    $scope.news.documentLib = $scope.news.documentLib ? $scope.news.documentLib : {};
    $rootScope.isuploadOne = false;
    $scope.$on('ImageListChange', function (e, json) {
      for (var i = 0; i < json.length; i++) {
        if ($scope.isImg) {
          $scope.news.documentLib.file_cdn_path = json[i].file_cdn_path;
          $scope.news.document_id = json[i].id;
        } else {
          $scope.model.documentLib.file_cdn_path = json[i].file_cdn_path;
          $scope.model.document_id = json[i].id;
        }
      }

    });
    $scope.$on('ImageChoose', function (e, json) {
      if ($scope.isImg) {
        $scope.news.documentLib.file_cdn_path = json[0].file_cdn_path;
        $scope.news.document_id = json[0].id;
      } else {
        $scope.model.documentLib.file_cdn_path = json[0].file_cdn_path;
        $scope.model.document_id = json[0].id;
      }
    });

    $scope.btnSave = function () {
      $scope.starttime = $("#start_time").val(), $scope.endtime = $("#end_time").val(), $scope.start = +new Date($scope.starttime) / 1000, $scope.end = +new Date($scope.endtime) / 1000;
      $('#btnSave').attr('disabled', 'disabled');
      $.ajax({
        type: "post",
        url: wsh.url + "edit-ajax",
        dataType: "JSON",
        data: {
          reserveSetting: {
            "id": $scope.model.id, //活动id
            "title": $scope.model.title, // varchar(100) | 标题 |
            "summary": "活动简介",// text | editor.getContent() |
            "note": "报名须知",// text |  editor1.getContent()|
            "start_time": $scope.start,// Integer(11) | 活动开始时间 |
            "end_time": $scope.end,// Integer(11) | 活动结束时间 |
            "document_id": 250,// $scope.model.document_id varchar(20) | 邀请函主图 |
            "per_count": $scope.model.per_count ? $scope.model.per_count : 0,//Integer(11) | 预约人数上限 |
            "share_type": $scope.model.share_type
          },
          "news": {
            "id": $scope.news.id,
            "title": $scope.news.title,//| 否 | String(100) | 图文标题 |
            "description": $scope.news.description,//否 | String(100) | 图文描述 |
            "document_id": $scope.news.document_id // 否 | string(20) | document_lib表外键 |
          }
        },
        success: function (msg) {
          wsh.successback(msg, "提交成功", false, function () {
            $('#btnSave').removeAttr('disabled');
            window.location = 'list';
          });
          $('#btnSave').removeAttr('disabled');
        }, error: function (msg) {
          console.log(msg);
          $('#btnSave').removeAttr('disabled');
        }
      });
    }
  })
</script>