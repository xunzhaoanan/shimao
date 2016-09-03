<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '新增预约内容';
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
          <li>新增预约内容</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="leader clearfix">
              <div class=" col-sm-6"><a
                  class="label label-lg label-success arrowed-right no-padding"
                  href="#home">1 设置图文</a></div>
              <div class=" col-sm-5 "><a
                  class="label label-lg label-info arrowed-in arrowed-right no-padding" href="#rule">2 预约正文</a>
              </div>
            </div>
            <div class="space-6"></div>
            <!--设置图文开始了-->
            <div class="tabbable " id="home" ng-show="isHome">
              <!--左边的手机区域开始了-->
              <div class="weileft col-sm-push-1 col-sm-3">
                <div class="weileftda" id="phone_page">
                  <div class="wbsc slim-scroll">
                    <div class="wcright">
                      <h3 ng-bind="news.title"></h3>
                      <img ng-src="{{news.imgsrc}}" width="212" height="103">

                      <div class="margin-bottom5" ng-bind="news.description"></div>
                      <div class="yue margin-top5">阅读全文<span><i
                          class="icon-angle-right bigger-110"></i></span></div>
                    </div>
                  </div>
                </div>
              </div>
              <!--左边的手机区域结束了-->
              <div class="col-sm-push-1 col-sm-7">
                <form class="form-horizontal" name="myform" novalidate="novalidate">
                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>图文标题：</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-5" ng-model="news.title" name="title"
                             maxlength="30" required>
                      <span class="inline padding5 grey">（建议少于30个字）</span>
                      <span class="inline padding5 red"
                            ng-show="myform.title.$error.required && isSubmit" ng-cloak>必填项</span>
                    </div>
                  </div>

                  <div class="form-group margin-bottom20 clearfix">
                    <label class="col-sm-2 control-label"><strong class="red verg_mid">*</strong>摘要内容：</label>

                    <div class="col-sm-10">
                      <textarea class="col-sm-5 padding5" style="height:160px;"
                                ng-model="news.description" maxlength="120" name="description"
                                required></textarea>
                      <span class="inline padding5 grey">（建议少于120个字）</span>
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
                          <label class="file-label" data-title="选择"><span
                              class="file-name file-name2 " data-title="点击上传图片..."> <i
                              class="icon-upload-alt"></i> </span> </label></a>
                      </div>
                    </div>
                    <span class="inline padding5 red" ng-show="isImgShow" ng-cloak>请选择活动图片</span>
                  </div>

                  <div class="form-group margin-bottom10 clearfix" ng-show="news.imgsrc">
                    <label class="col-sm-2 control-label"></label>

                    <div class="col-sm-10">
                      <img ng-src="{{news.imgsrc}}" class="img-thumb3"/>
                    </div>
                  </div>

                </form>
              </div>
              <!--内容开始了-->
              <div class="tabbable " id="rule" style="display: none" ng-cloak>

                <form class="form-horizontal " name="myform" novalidate="novalidate">

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><span class="red">*</span>活动名称：</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-4" name="name"
                             ng-model="model['activity']['name']" required maxlength="100">
                      <span class="inline padding5 red"
                            ng-show="myform.name.$error.required && isSubmit" ng-cloak>必填项</span>
                    </div>
                  </div>

                  <div class="form-group margin-bottom20 clearfix">
                    <label class="col-sm-2 control-label"><span class="red">*</span>活动说明：</label>

                    <div class="col-sm-10">
                      <textarea type="text" class="col-sm-6 padding5" style="height:200px;"
                                name="desc" ng-model="model['activity']['desc']" required
                                maxlength="400" placeholder="少于400个字符"></textarea>
                      <span class="inline padding5 red"
                            ng-show="myform.desc.$error.required && isSubmit" ng-cloak>必填项</span>
                    </div>
                  </div>

                  <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><span class="red">*</span>活动时间：</label>

                    <div class="col-sm-8">
                      <div class="input-group col-sm-3 no-padding">
                        <input type="text" id="start_time" class="Wdate form-control hasDatepicker"
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}',maxDate:'2030-10-01'});"
                               name=""/>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                      </div>
                      <span class="float-left padding5">至</span>

                      <div class="input-group col-sm-3 no-padding">
                        <input type="text" name="start" id="end_time"
                               class="Wdate form-control hasDatepicker"
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}',maxDate:'2030-10-01'});"
                               name=""/>
                        <span class="input-group-addon"> <i class="icon-calendar"></i></span>
                      </div>
                      <span class="inline padding5 red" ng-show="isTimes" ng-cloak>必填项</span> <span
                        class="red" ng-show="isCompare" ng-cloak>结束时间必须大于开始时间</span>
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
                    <label class="col-sm-2 control-label"><span class="red">*</span>该秒杀订单满：</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-2 " name="model['postageSetting']['amount']"
                             ng-model="postageAmout" maxlength="7">
                      <span class="inline padding5">元，免运费</span>
                      <span class="inline padding5 red" ng-show="isAmount" ng-cloak>必填项</span>
                      <span class="inline padding5 red" ng-show="isAmountPat"
                            ng-cloak>请输入大于0的整数</span>
                    </div>
                  </div>
                  <!--运费政策3-->
                  <div class="form-group clearfix" ng-show="isJian">
                    <label class="col-sm-2 control-label"><span class="red">*</span>该秒杀订单满：</label>

                    <div class="col-sm-10">
                      <input type="text" class="col-sm-2 " name="model['postageSetting']['num']"
                             ng-model="model['postageSetting']['num']" maxlength="7">
                      <span class="inline padding5">件，免运费</span>
                      <span class="inline padding5 red" ng-show="isNum" ng-cloak>必填项</span>
                      <span class="inline padding5 red" ng-show="isNumPat" ng-cloak>请输入大于0的整数</span>
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
                      <div class="table-responsive clearfix" ng-cloak ng-show="productList.length">
                        <table class="table table-striped table-bordered table-hover table-width">
                          <thead>
                          <tr>
                            <th width="15%">商品名称</th>
                            <th width="15%">规格</th>
                            <th width="15%">商品编码</th>
                            <th width="10%">商品分类</th>
                            <th width="8%">销售价</th>
                            <th width="8%">秒杀价</th>
                            <th width="6%">库存</th>
                            <th width="8%">配额</th>
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
                            <td><input ng-show="!list.isShowEdit" ng-cloak type="text"
                                       class="col-sm-10" maxlength="7" ng-model="list.buy_price"
                                       ng-blur="changeText(list.buy_price, list, 0)">
                              <span ng-show="list.isShowEdit" ng-cloak
                                    ng-bind="list.buy_price"></span>
                            </td>
                            <td ng-bind="list.reserves"></td>
                            <td><input ng-show="!list.isShowEdit" ng-cloak type="text"
                                       class="col-sm-10" maxlength="7" ng-model="list.quota"
                                       ng-blur="changeText(list.quota, list, 1)">
                              <span ng-show="list.isShowEdit" ng-cloak ng-bind="list.quota"></span>
                            </td>
                            <td><input ng-show="!list.isShowEdit" ng-cloak type="text"
                                       class="col-sm-10" maxlength="7" ng-model="list.limit_buy"
                                       ng-blur="changeText(list.limit_buy, list, 2)">
                              <span ng-show="list.isShowEdit" ng-cloak
                                    ng-bind="list.limit_buy"></span>
                            </td>
                            <td>
                              <div class="action-buttons">
                                <a class="green pointer" ng-click="save($index, list)"
                                   ng-show="!list.isShowEdit" ng-cloak> <i
                                    class="icon-save bigger-130"></i> </a>
                                <a class="success pointer" ng-click="edit($index, list)"
                                   ng-show="list.isShowEdit" ng-cloak> <i
                                    class="icon-pencil bigger-130"></i> </a>
                                <a class="red pointer" ng-click="deleteProduct($index, list)"> <i
                                    class="icon-trash bigger-130"></i> </a>
                              </div>
                            </td>
                          </tr>
                          </tbody>
                        </table>
                      </div>
                    </ng-form>
                  </div>

                  <!--点击高级设置按钮，开始了-->
                  <div id="share">
                    <div class="form-group clearfix">
                      <label class="col-sm-2 control-label">活动主页面：</label>

                      <div class="col-sm-9">
                        <label class="float-left margin-top5"> <span
                            class="red">*</span>分享标题</label>
                        <input type="text" class="col-sm-4 margin-left10" name="heititle"
                               ng-model="model['shareMessage']['title']" required ng-maxlength="36">
                        <span class="inline padding5 red"
                              ng-show="myform.heititle.$error.required && isSubmit"
                              ng-cloak>必填项</span>
                        <span class="inline padding5 red" ng-show="myform.heititle.$error.maxlength"
                              ng-cloak>字符个数需少36</span>
                        <span class="inline padding5 grey">（建议少于36个字）</span>
                      </div>
                    </div>

                    <div class="form-group  margin-bottom10 clearfix">
                      <label class="col-sm-2 control-label"> </label>

                      <div class="col-sm-9">
                        <label class="float-left margin-top5"> <span
                            class="red">*</span>分享描述</label>
                        <input type="text" class="col-sm-4 margin-left10" name="hdesc"
                               ng-model="model['shareMessage']['desc']" required ng-maxlength="50">
                        <span class="inline padding5 red"
                              ng-show="myform.hdesc.$error.required && isSubmit" ng-cloak>必填项</span>
                        <span class="inline padding5 red" ng-show="myform.hdesc.$error.maxlength"
                              ng-cloak>字符个数需少于50</span>
                        <span class="inline padding5 grey">（建议少于50个字）</span>
                      </div>
                    </div>

                    <div class="form-group margin-bottom10 clearfix">
                      <label class="col-sm-2 control-label"> </label>

                      <div class="col-sm-9">
                        <label class="float-left margin-top5"><span class="red">*</span>分享图标</label>

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

                  <!--点击高级设置按钮，结束了-->

                </form>
              </div>


            </div>
            <div class="space-32"></div>
          </div>
          <!--设置图文结束了-->


          <!--内容结束了-->
          <!--预约正文结束了-->


          <!-- 操作按钮开始了 -->
          <div class="modal-footer margin-auto" id="modal-footer" ng-cloak>
            <a class="btn btn-infor" href="list"> 返回列表 </a>
            <a id="back" class="btn btn-primary" ng-click="threeBack()" ng-cloak> 上一步 </a>

            <a id="next" class="btn btn-primary" ng-click="nextBtn()"> 下一步 </a>

            <a class="btn btn-success" ng-click="btnSave()" ng-cloak>保存并关闭 </a>
          </div>
          <!-- 操作按钮结束了 -->

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
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ed');
    }, 100);
    $scope.isOne = true, $scope.isTwo = $scope.isThree = false;
    $scope.isHome = true, $scope.isPro = false; //$scope.isRule =
    $scope.isSubmit = $scope.isSubmit1 = $scope.isSubmit2 = false, $scope.isImgShow = false;
    var addUrl = "<?php echo $addUrl;?>", redirectUrl = "<?php echo $redirectUrl;?>";
    $scope.news = JSON.parse('<?= addslashe(json_encode($news)); ?>');

    //选择图片后，确定按钮
    $scope.isRequiredImg = false;

    $rootScope.isuploadOne = false;
    $scope.$on('ImageListChange', function (e, json) {
      for (var i = 0; i < json.length; i++) {
        $scope.news.document_id = json[i]["id"];
        $scope.news.imgsrc = json[i]["file_cdn_path"];
      }

    });
    $scope.$on('ImageChoose', function (e, json) {
      $scope.news.document_id = json[0]["id"];
      $scope.news.imgsrc = json[0]["file_cdn_path"];
    });

    //下一步按钮
    $scope.isSubmit = false;
    $scope.nextBtn = function () {
      $http.post(addUrl, {
        news: {
          "title": $scope.news.title,
          "description": $scope.news.description,
          "document_id": $scope.news.document_id
        }
      })
          .success(function (msg) {
            $('#btnConfirm').removeAttr('disabled');
            wsh.successback(msg, '', false, function () {
              console.log(msg);
              window.location.href = redirectUrl + "?id=" + msg["errmsg"]["id"];
            });
          })
          .error(function (msg) {
            $('#btnConfirm').removeAttr('disabled');
            wsh.successback(msg);
          });

      $("#home").removeClass("label-success").addClass("label-light");
      $("#rule").removeClass("label-light").addClass("label-success");
      $scope.isRule = true;
      $("#rule").show();
      $scope.isHome = $scope.isPro = false;
      $scope.isOne = false, $scope.isTwo = true;
    }


    //第二步的返回
    $scope.twoBack = function () {
      $("#rule_title").removeClass("label-success").addClass("label-light");
      $("#home_title").removeClass("label-light").addClass("label-success");
      $scope.isHome = true, $scope.isPro = false;
//            $scope.isRule = false;
      $("#rule").hide();
      $scope.isThree = $scope.isTwo = false, $scope.isOne = true;
    }

    //第三步的返回
    $scope.threeBack = function () {
      $("#pro_title").removeClass("label-success").addClass("label-light");
      $("#rule_title").removeClass("label-light").addClass("label-success");
      $scope.isPro = $scope.isHome = false;
      //            $scope.isRule = true;
      $("#rule").show();
      $scope.isThree = $scope.isOne = false, $scope.isTwo = true;
    }


  })
</script>