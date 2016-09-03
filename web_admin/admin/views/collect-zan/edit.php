<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '编辑点赞众筹';
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
          <li>编辑点赞众筹</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="leader clearfix">
              <div class="col-sm-12 margin-bottom10"><span
                  class="label label-light  no-padding center"><b class="red">提示：活动一旦开启就不能再进行任何改动</b> </span></div>
              <div class=" col-sm-6"><span
                  class="label label-lg label-light arrowed-right no-padding">1 设置图文</span></div>
              <div class=" col-sm-6"><span
                  class="label label-lg label-success arrowed-in no-padding">2 活动规则</span></div>
            </div>
            <div class="tabbable clearfix">
              <div id="rule" class="tab-pane active ruleCont margin-top20 clearfix">
                <form class="form-horizontal" name="myform" novalidate>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>活动名称：</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-4" name="name" ng-model="collect.name"
                             required reg-char-len="30" prompt-msg="nameMsg" prompt-type="1" ng-trim="false" diff-zh="true">
                      <span class="inline padding5 red"
                            ng-if="myform.name.$error.required && isSubmit">必填项</span>
                      <span class="inline padding5" ng-class="{'red':myform.name.$error.exceed}" ng-bind="nameMsg"></span>
                    </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"> <strong class="red verg_mid">*</strong>活动时间：</label>

                    <div class="col-sm-8">
                      <div class="input-group col-sm-3 no-padding">
                        <input type="text" name="start" id="start_time"
                               class="Wdate form-control hasDatepicker"
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss', maxDate:'#F{$dp.$D(\'end_time\')||\'2030-10-01\'}'});"
                               value=""/>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span></div>
                      <span class="float-left padding5"> 至 </span>

                      <div class="input-group col-sm-3 no-padding">
                        <input type="text" name="start" id="end_time"
                               class="Wdate form-control hasDatepicker"
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'start_time\')}',maxDate:'2030-10-01'});"
                               value=""/>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span></div>
                      <span class="inline padding5 red" ng-show="isTimes">必填项</span> <span
                        class="inline padding5 red" ng-show="isCompare">结束时间必须大于开始时间</span></div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>奖品来源：</label>

                    <div class="col-sm-10">
                      <select class="col-sm-2 " ng-model="sourceradio"
                              ng-options="o.id as o.text for o in spurceOption"
                              ng-change="changeSource(sourceradio)">
                      </select>
                      <span class="grey pl20"
                            ng-if="sourceradio == 2">（只能添加一个商品，选择多个的时候会默认第一个）</span>
                    </div>
                  </div>
                  <div class="form-group clearfix" ng-show="sourceradio == 1">
                    <table width="100%"
                           class="table  margin-top15 table-striped table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <td>奖品名称</td>
                        <td>奖品图片</td>
                        <td>奖品数量</td>
                        <td>任务集点数</td>
                        <td>操作</td>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td>
                          <input type="text" class="col-sm-8" ng-model="tableSource.name"
                                 id="souname" name="souname" maxlength="30"
                                 ng-readonly="tabreadonly"/>
                          <span class="inline padding5 red" ng-show="isSubmit0">必填项</span></td>
                        <td><span class="inline padding5 verg_mid"
                                  ng-show="tableSource.documentLib.file_cdn_path"> <img
                              ng-src="{{tableSource.documentLib.file_cdn_path}}" width="30"
                              height="30"> </span>

                          <div class="inline padding5 verg_mid width180 clearfix">
                            <div class="ace-file-input " data-rel="tooltip" title=""
                                 data-original-title="Default"><a data-toggle="modal"
                                                                  data-target="#myModalImage"
                                                                  ng-click="sourceImg()">
                                <label class="file-label" data-title="选择"> <span
                                    class="file-name file-name2 " data-title="点击上传图片..."> <i
                                      class="icon-upload-alt"></i></span> </label>
                              </a></div>
                          </div>
                          <span class="inline padding5 verg_mid red"
                                ng-show="isImgSource">请选择图片</span></td>
                        <td><input type="text" class="col-sm-8" ng-model="tableSource.count"
                                   id="soucount" name="soucount" maxlength="7"
                                   ng-readonly="tabreadonly"
                                   ng-change="customChange(tableSource.count, 0)"/>
                          <span class="inline padding5 red" ng-show="isSubmit1">必填项</span>
                        </td>
                        <td><input type="text" class="col-sm-8" ng-model="tableSource.number"
                                   id="sounumber" name="sounumber" maxlength="7"
                                   ng-readonly="tabreadonly"
                                   ng-change="customChange(tableSource.number, 1)"/>
                          <span class="inline padding5 red" ng-show="isSubmit2">必填项</span>
                        </td>
                        <td>
                          <div class="action-buttons">
                                  <span ng-show="isSave">
                                      <a class="green pointer" ng-click="tableSave()"><i
                                          class="icon-save bigger-130"></i></a>
                                      <a class="red pointer" ng-show="tableSource.id"
                                         ng-click="tableCancel()"><i
                                          class="icon-remove bigger-130"></i></a>
                                  </span>
                                  <span ng-show="isEdit">
                                      <a class="success pointer" ng-click="tableEdit()"><i
                                          class="icon-pencil bigger-130"></i></a>
                                      <a class="red pointer" ng-show="tableSource.id"
                                         ng-click="tableEmpty()"><i
                                          class="icon-trash bigger-130"></i></a>
                                  </span>
                          </div>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="form-group margin-bottom20 clearfix">
                    <div ng-show="sourceradio == 2">
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-10"><a data-toggle="modal" data-target="#productModal"
                                                class="btn btn-xs btn-primary" ng-click="concatd()"
                                                ng-show="productList.length < 1"> 选择商品 </a></div>
                      <div class="table-responsive clearfix">
                        <table class="table table-striped table-bordered table-hover table-width"
                               ng-show="productList.length">
                          <thead>
                          <tr>
                            <th width="10%">商品名称</th>
                            <th width="15%">规格</th>
                            <th width="10%">商品分类</th>
                            <th width="8%">销售价</th>
                            <th width="6%">库存</th>
                            <th width="8%">奖品数量</th>
                            <th width="13%">任务集点数</th>
                            <th width="10%">操作</th>
                          </tr>
                          </thead>
                          <tbody id="tbody">
                          <tr ng-repeat="list in productList">
                            <td ng-bind="list.name"></td>
                            <td><span ng-repeat="kindValue in list.kindValues"><span ng-bind="list.kinds[$index].name"></span>:<span ng-bind="kindValue.name"> </span></span>
                            </td>
                            <td ng-bind="list.productName"></td>
                            <td ng-bind="list.retail_price/100 | number:2"></td>
                            <td ng-bind="list.reserves" class="prizereserves"></td>
                            <td><input ng-show="!list.isShowEdit" type="text"
                                       class="col-sm-10 prizecont" maxlength="7"
                                       ng-model="list.count"
                                       ng-change="changeText(list.count, list, 0)">
                              <span ng-show="list.isShowEdit" ng-bind="list.count"></span>
                            </td>
                            <td><input ng-show="!list.isShowEdit" type="text"
                                       class="col-sm-10" maxlength="7" ng-model="list.number"
                                       ng-change="changeText(list.number, list, 1)">
                              <span ng-show="list.isShowEdit" ng-bind="list.number"></span>
                            </td>
                            <td>
                              <div class="action-buttons"><a class="green pointer"
                                                             ng-click="save($index, list)"
                                                             ng-show="!list.isShowEdit"> <i
                                    class="icon-save bigger-130"></i> </a> <a class="success pointer"
                                                                              ng-click="edit($index, list)"
                                                                              ng-show="list.isShowEdit"
                                  > <i
                                    class="icon-pencil bigger-130"></i> </a> <a class="red pointer"
                                                                                ng-click="deleteProduct($index, list)"><i
                                    class="icon-remove bigger-130"></i> </a></div>
                            </td>
                          </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>


                  <div class="form-group margin-bottom10 clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>活动说明：</label>

                    <div class="col-sm-10">
                      <textarea class="col-sm-8 minheight-200px no-padding" name="rule" ng-model="collect.rule" required reg-char-len="400" ng-trim="true" prompt-type="2" prompt-msg="descMsg"></textarea>
                      <span class="inline padding5 red" ng-if="myform.rule.$error.required && isSubmit">必填项</span>
                      <span class="inline padding5" ng-class="{'red':myform.rule.$error.exceed}" ng-bind="descMsg"></span>
                    </div>
                  </div>
                  <div class="form-group margin-bottom10 clearfix">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-10">
                      <span class="inline padding5 grey">(请按活动实际情况进行填写)</span>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label">活动类型：</label>

                    <div class="col-sm-9">
                      <p>
                        <label>
                          <input name="offline" type="radio" class="ace" value="1"
                                 ng-model="model.collect.share_type" checked>
                          <span class="lbl"> 开放性活动&nbsp;&nbsp;&nbsp; </span>（可在惊喜页列表中显示，允许分享）
                        </label>
                      </p>

                      <p>
                        <label>
                          <input name="offline" type="radio" class="ace" value="2"
                                 ng-model="model.collect.share_type">
                          <span class="lbl"> 线下分享活动 </span>（不在惊喜页列表中显示，允许分享）
                        </label>
                      </p>
                    </div>
                  </div>

                  <div class="form-group margin-bottom10 clearfix">
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


                  <!--点击高级设置按钮，开始了-->
                  <div id="share">
                    <div class="form-group clearfix">
                      <label class="col-sm-2 control-label"> 活动主页面：</label>

                      <div class="col-sm-9">
                        <label class="float-left margin-top5"><strong
                            class="red verg_mid">*</strong>分享标题</label>
                        <input type="text" class="col-sm-4 margin-left10" name="sharetitle"
                               ng-model="shareMessageaaa.title" maxlength="36" required="36">
                        <span class="inline padding5 red"
                              ng-if="myform.sharetitle.$error.required && isSubmit"
                          >必填项</span> <span
                          class="inline padding5 grey">（建议不超过36个字符）</span></div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="col-sm-2 control-label"> </label>

                      <div class="col-sm-9">
                        <label class="float-left margin-top5"><strong
                            class="red verg_mid">*</strong>分享描述</label>
                        <input type="text" class="col-sm-4 margin-left10" name="sharedese"
                               ng-model="shareMessageaaa.desc" maxlength="50" required="50">
                        <span class="red" ng-if="myform.sharedese.$error.required && isSubmit"
                          >必填项</span> <span
                          class="inline padding5 grey">（建议不超过50个字符）</span></div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="col-sm-2 control-label"> </label>

                      <div class="col-sm-9">
                        <label class="float-left margin-top5"><strong
                            class="red verg_mid">*</strong>分享图标</label>

                        <div class="ace-file-input col-sm-3 margin-left10 clearfix"><a
                            data-toggle="modal" data-target="#myModalImage" ng-click="shareImg()">
                            <label class="file-label" data-title="选择"> <span
                                class="file-name file-name2 " data-title="点击上传图片..."> <i
                                  class="icon-upload-alt"></i> </span> </label>
                          </a></div>
                      </div>
                    </div>
                    <div class="form-group clearfix"
                         ng-show="shareMessageaaa.documentLib.file_cdn_path">
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-10">
                        <label class="float-left margin-left10 width51"></label>
                        <img ng-src="{{shareMessageaaa.documentLib.file_cdn_path}}" width="100"
                             height="100" class="img-thumb"/></div>
                    </div>
                  </div>
                  <!--点击高级设置按钮，结束了-->

                </form>
              </div>
            </div>
            <div class="space-32"></div>
            <!-- 确定 -->
            <div class="modal-footer margin-auto" id="modal-footer"><a class="btn btn-infor"
                                                                       href="list"> 返回列表 </a>
              <a id="back" class="btn btn-primary"
                 href="<?= Url::to(['/collect-zan/edit-news']); ?>?id={{model.collect.id}}"> 上一步 </a>
              <a id="saveBtn" class="btn btn-success" ng-click="saveBtn()"> 保存并关闭 </a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
echo $this->render('@app/views/uploadImg/imageIndex.php');
?>
<?php
echo $this->render('@app/views/product/index.php');
?>
<script language="javascript" type="text/javascript"
        src="/ace/js/DatePicker/WdatePicker.js"></script>
<script>
  app.controller("mainController", function ($scope, $rootScope, $timeout) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'eb');
    }, 100);
    $scope.model = JSON.parse('<?= addslashe(json_encode($model))?>');

    $scope.collect = $scope.model.collect;
    $scope.collect.rule = $scope.collect.rule.replace(/<p>/g, '').replace(/<\/p>/g, '\n').replace(/<br\/>/g, '\n').replace(/&nbsp;/g, '\s');
    $scope.tableSource = $scope.model.collect.collectCustomGift[0];
    $scope.shareMessageaaa = $scope.model.shareMessage;
    $scope.news = $scope.model.news.wxImagetxtReplyItems[0];
    $('#start_time').val(wsh.getdate($scope.collect.start_time));
    $('#end_time').val(wsh.getdate($scope.collect.end_time));
    //奖品来源
    $scope.sourceradio = $scope.collect.collectProducts.length ? 2 : 1;
    var isCostom = true, isChoose = false;
    //奖品来源选项
    $scope.spurceOption = [
      {"id": 1, "text": "自定义奖品"},
      {"id": 2, "text": "选择商品作为奖品"}
    ];
    //改变奖品选择
    $scope.changeSource = function (id) {
      if ($scope.sourceradio == 1) {
        var count = 0;
        $.each($scope.productList, function (i, e) {
          if (e.id) count++;
        });
        if (count) return $scope.sourceradio = 2, alert('已选择商品作为奖品，请先删除商品');
        isCostom = true, isChoose = false;
        //清空商品
        $scope.productList = [];
      } else {
        if ($scope.tableSource.id) return $scope.sourceradio = 1, alert('已选择自定义作为奖品，请先删除自定义商品');
        isCostom = false, isChoose = true;
        //清空自定义商品
        $scope.tableSource = {};
        $scope.tableSource.documentLib = {};
      }
      $scope.sourceradio = id;
    };
    $scope.isAttention = $scope.collect.is_attention == 1 ? true : false;  //强制关注
    $scope.isSubmit = false;

    //图片处理
    $scope.Img = true;
    $scope.sourceImg = function () {
      $scope.Img = true;
    };
    $scope.shareImg = function () {
      $scope.Img = false;
    };
    if (!$scope.tableSource) {
      $scope.tableSource = {};
      $scope.tableSource.documentLib = {};
    }
    if (!$scope.shareMessageaaa.documentLib) {
      $scope.shareMessageaaa.documentLib = {};
    }
    $rootScope.isuploadOne = true;
    $scope.$on('ImageListChange', function (e, json) {
      if ($scope.Img) {  //奖品来源
        $scope.tableSource.document_id = json[0]["id"];
        $scope.tableSource.documentLib.file_cdn_path = json[0]["file_cdn_path"];
      } else {  //分享图片
        $scope.shareMessageaaa.pic_id = json[0]["id"];
        $scope.shareMessageaaa.documentLib.file_cdn_path = json[0]["file_cdn_path"];
      }
    });
    $scope.$on('ImageChoose', function (e, json) {
      if ($scope.Img) {  //奖品来源
        $scope.tableSource.document_id = json[0]["id"];
        $scope.tableSource.documentLib.file_cdn_path = json[0]["file_cdn_path"];
      } else {  //分享图片
        $scope.shareMessageaaa.pic_id = json[0]["id"];
        $scope.shareMessageaaa.documentLib.file_cdn_path = json[0]["file_cdn_path"];
      }
    });

    $scope.isImgSource = false, $scope.isSubmit0 = false, $scope.tabreadonly = $scope.isEdit = $scope.model.collect.collectCustomGift.length, $scope.isSave = !$scope.isEdit;
    $scope.tableEmpty = function () {
      wsh.setDialog('删除提示', '确定要删除该数据吗?', '/collect-zan/custom-gift-del-ajax', {
        id: $scope.tableSource.id,
        collect_id: $scope.collect.id
      }, function () {
        $scope.isSave = true, $scope.isEdit = false;
        $scope.tabreadonly = false;
        $scope.tableSource = {};
        $scope.tableSource.documentLib = {};
      }, '删除成功');
    };
    $scope.tableEdit = function () {
      $scope.isSave = true, $scope.isEdit = false, $scope.tabreadonly = false;
      ;
    };
    $scope.tableCancel = function () {
      $scope.isSave = false, $scope.isEdit = true, $scope.tabreadonly = true;
    };
    //table的保存
    $scope.tableSave = function () {
      if ($('#souname').val() == "" || $('#souname').val() == "undefined") {
        $scope.isSubmit0 = true;
        return $timeout(function () {
          $scope.isSubmit0 = false;
        }, 2000);
      }
      if ($('#soucount').val() == "" || $('#soucount').val() == "undefined") {
        $scope.isSubmit1 = true;
        return $timeout(function () {
          $scope.isSubmit1 = false;
        }, 2000);
      }
      if ($('#sounumber').val() == "" || $('#sounumber').val() == "undefined") {
        $scope.isSubmit2 = true;
        return $timeout(function () {
          $scope.isSubmit2 = false;
        }, 2000);
      }
      if (!$scope.tableSource.documentLib.file_cdn_path) {
        $scope.isImgSource = true;
        return $timeout(function () {
          $scope.isImgSource = false;
        }, 2000);
      }
      if ($scope.tableSource.id) {
        $.ajax({
          type: "POST",
          url: "<?= Url::to(['/collect-zan/edit-custom-gift-ajax']);?>",
          dataType: "JSON",
          data: {
            "id": $scope.tableSource.id,
            "collect_id": $scope.collect.id,
            "name": $scope.tableSource.name,
            "number": $scope.tableSource.number,
            "price": $scope.tableSource.number, //价格和集赞数一样
            "count": $scope.tableSource.count,
            "document_id": $scope.tableSource.document_id
          },
          success: function (msg) {
            wsh.successback(msg, '保存成功！', false, function () {
              $scope.isSave = false, $scope.isEdit = true;
              $scope.tabreadonly = true;
              $scope.$apply();
            });
          }
        });
      } else {
        $.ajax({
          type: "POST",
          url: "<?= Url::to(['/collect-zan/add-custom-gift-ajax']);?>",
          dataType: "JSON",
          data: {
            "collect_id": $scope.collect.id,
            "name": $scope.tableSource.name,
            "number": $scope.tableSource.number,//最低点赞人数
            "count": $scope.tableSource.count,
            "price": $scope.tableSource.number, //价格和集赞数一样
            "lastCount": $scope.tableSource.count,  //添加需要这个字段，修改不需要这个字段
            "document_id": $scope.tableSource.document_id
          },
          success: function (msg) {
            wsh.successback(msg, '保存成功！', false, function () {
              $.extend($scope.tableSource, msg.errmsg);
              $scope.isSave = false, $scope.isEdit = true;
              $scope.tabreadonly = true;
              $scope.$apply();
            });
          }
        });
      }
    };


    //整体保存
    $scope.saveBtn = function () {
      if ($scope.myform.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
      //商品选择了其一
      if (!$.isEmptyObject($scope.tableSource.documentLib) || $scope.productList.length) {
        //自定义商品 && 但处于编辑状态
        if (!$.isEmptyObject($scope.tableSource.documentLib)) {
          //并未保存 自定义商品
          if (!$scope.tableSource.id) {
            return alert('请先保存自定义商品');
          }
          //已保存过自定义商品 但还是处于编辑状态
          if ($scope.tableSource.id && !$scope.tabreadonly) {
            return alert('请先保存自定义商品');
          }
        }
        if ($scope.productList.length) {
          //并未保存 选择商品
          if (!$scope.productList[0].id) {
            return alert('请先保存选择的商品');
          }
          //已保存过选择商品 但还是处于编辑状态
          if ($scope.productList[0].id && !$scope.productList[0].isShowEdit) {
            return alert('请先保存选择的商品');
          }
        }
      } else if ($.isEmptyObject($scope.tableSource.documentLib) && !$scope.productList.length) {
        //未选择商品
        return alert('请编辑商品来源');
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
      $scope.collect.is_attention = $scope.isAttention == true ? 1 : 2;  //强制关注
      $scope.datas = {
        collect: {
          "id": $scope.collect.id,
          "name": $scope.collect.name,
          "rule": $scope.collect.rule,
          "is_attention": $scope.collect.is_attention,
          "start_time": $scope.start,
          "end_time": $scope.end,
          'share_type': $scope.model.collect.share_type
        },
        shareMessage: {
          "title": $scope.shareMessageaaa.title,
          "desc": $scope.shareMessageaaa.desc,
          "pic_id": $scope.shareMessageaaa.pic_id
        }
      };
      $.ajax({
        type: "POST",
        url: "<?= Url::to(['/collect-zan/edit-ajax']);?>",
        dataType: "JSON",
        data: $scope.datas,
        success: function (msg) {
          wsh.successback(msg, '保存成功！', false, function () {
            window.location = 'list';
          });
        },
        error: function (msg) {
          console.log(msg);
        }

      });
    };
    //选择的商品  与插件交互
    $scope.productList = [];
    if ($scope.collect.collectProducts.length) {
      $.each($scope.collect.collectProducts, function (i, e) {
        e.name = e.product.name;
        e.productName = e.productSku.name;
        e.retail_price = e.productSku.retail_price;
        e.reserves = e.productSku.reserves;
        e.name = e.product.name;
        e.isShowEdit = true;
        e.kindValues = e.productSku.kindValues;
        e.kinds = e.productSku.kinds;
      });
      $scope.productList = $scope.collect.collectProducts;
    }
    $rootScope.productObj = [];
    //点击选择商品  关联商品
    $scope.concatd = function () {
      $rootScope.productObj = $scope.productList;
    };
    $scope.$on('chooseProduct', function (e, json) {
      var arr = [];
      $.each($scope.productList, function (m, n) {
        if (!n.id) {
          $scope.productList.splice(m, 1);
        }
      });
      for (i in json) {
        for (j in json[i]) {
          for (k in json[i][j].productSkus) {
            json[i][j].productSkus[k].productName = json[i][j].productCategory.name;
            if (json[i][j].productSkus[k].id) {
              json[i][j].productSkus[k].product_sku_id = json[i][j].productSkus[k].id;
              delete json[i][j].productSkus[k].id;
            }
            if (json[i][j].productSkus[k].ischeck && json[i][j].productSkus[k].reserves) {
              if ($scope.productList.length) {
                $.each($scope.productList, function (m, n) {
                  if (n.sku_no != json[i][j].productSkus[k].sku_no && n.name != json[i][j].productSkus[k].name && n.reserves != json[i][j].productSkus[k].reserves) {
                    arr.push(angular.copy(json[i][j].productSkus[k]));
                  }
                });
              } else {
                arr.push(angular.copy(json[i][j].productSkus[k]));
              }
            }
          }
        }
      }
      $scope.productList = $scope.productList.concat(arr[0]);
    });

    $scope.changeText = function (val, obj, index) {
      switch (index) {
        case 0:
          if (!val) return;
          if (!(/^[1-9][0-9]*$/).test(val)) {
            obj.count = '';
            return alert('请输入正整数');
          }
          break;
        case 1:
          if (!val) return;
          if (!(/^[1-9][0-9]*$/).test(val)) {
            obj.number = '';
            return alert('请输入正整数');
          }
          break;
      }
    };
    $scope.customChange = function (val, index) {
      switch (index) {
        case 0:
          if (!(/^[1-9][0-9]*$/).test(val)) {
            $scope.tableSource.count = '';
            return alert('请输入正整数');
          }
          break;
        case 1:
          if (!(/^[1-9][0-9]*$/).test(val)) {
            $scope.tableSource.number = '';
            return alert('请输入正整数');
          }
          break;
      }
    };
    //删除商品
    $scope.deleteProduct = function (index, obj) {
      //有id 指 已经保存到数据库
      if (obj.id) {
        wsh.setDialog('删除提示', '确定要删除该数据吗?', '/collect-zan/collect-product-del-ajax', {
          id: obj.id,
          collect_id: obj.collect_id
        }, function () {
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
      var preserves = $('#tbody').find('tr').eq(index).find('.prizereserves').text();
      var pcount = $('#tbody').find('tr').eq(index).find('.prizecont').val();
      if (parseInt(preserves) <= parseInt(pcount)) {
        return alert("奖品数量必须小于库存数量！")
      }

      var input = $('#tbody').find('tr').eq(index).find('input');
      if (input.eq(0).val() && input.eq(1).val()) {
        if (obj.id) {
          //走编辑接口
          $.post('/collect-zan/edit-collect-product-ajax', {
            collect_id: $scope.model.collect.id,
            product_id: obj.product_id,
            product_sku_id: obj.product_sku_id,
            price: obj.number,
            number: obj.number,
            count: obj.count,
            lastCount: obj.count,
            id: obj.id
          }, function (msg) {
            wsh.successback(msg, '保存成功', false, function () {
              $.extend($scope.productList[index], msg.errmsg);
              obj.isShowEdit = true;
              $scope.$apply();
            });
          }, 'json');
        } else {
          //走新增接口
          $.post('/collect-zan/add-collect-product-ajax', {
            collect_id: $scope.model.collect.id,
            product_id: obj.product_id,
            product_sku_id: obj.product_sku_id,
            price: obj.number, //需要达成数
            number: obj.number, //最低代领人数和需达成数一致
            reserves: obj.reserves,
            count: obj.count,
            lastCount: obj.count
          }, function (msg) {
            wsh.successback(msg, '保存成功', false, function () {
              $.extend($scope.productList[index], msg.errmsg);
              obj.isShowEdit = true;
              $scope.$apply();
            });
          }, 'json');
        }
      } else {
        alert('奖品数量和任务急点数不能为空!');
      }
    };
  })
</script>