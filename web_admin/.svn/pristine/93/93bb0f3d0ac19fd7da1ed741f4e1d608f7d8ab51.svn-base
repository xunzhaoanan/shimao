<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '二维码';
?>
<div class="main-container" id="main-container">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner"
       ng-controller="mainController"> <?php echo $this->render('@app/views/side/marketing.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }</script>
        <ul class="breadcrumb">
          <li>二维码</li>
        </ul>
        <!-- .breadcrumb -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->

        <div class="row">
          <div class="col-xs-12">

            <div class="table-responsive clearfix">
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                <tr>
                  <th width="10%" class="text-center">二维码归属</th>
                  <th width="10%" class="text-center">所属代理商</th>
                  <th width="10%" class="text-center">查看二维码</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="list in lists" ng-cloak>
                  <td class="lt-width3 text-center">{{list.shopInfo.name}}</td>
                  <td class="text-center">{{list.shopAgents.agent_name}}</td>
                  <td class="text-center action-buttons">
                    <a class="pointer" data-toggle="modal" data-target="#query"
                       ng-click="getQrcode(list.id)"><i class="icon-erweima bigger-130"></i></a>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
            <div ng-paginate options="options" page="page"></div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>

<!--查看二维码-->
<div class="bootbox modal fade in" id="query" tabindex="-1" role="dialog" open-close-modal
     aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header"><a type="button" class="bootbox-close-button close"
                                   data-dismiss="modal">×</a>
        <h4 class="modal-title">查看二维码</h4>
      </div>
      <div class="modal-body ">
        <div class="bootbox-body">
          <div class="text-center clearfix">
            <img ng-src="{{$root.srcImg}}">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>


  app.controller("mainController", function ($scope, $http, $rootScope, $timeout) {
    $rootScope.leftMenuIndex = -1;
    $scope.qrcode = JSON.parse('<?= addslashe(json_encode($qrcode)); ?>');
    //查看二维码
    $scope.getQrcode = function (id) {
      $.ajax({
        type: "POST",
        url: "<?= Url::to(['weixin/qrcode-detail-ajax']);?>",
        dataType: "JSON",
        data: {
          "model": $scope.qrcode.model,
          "model_id": $scope.qrcode.model_id,
          "shop_sub_id": id
        },
        success: function (msg) {
          wsh.successback(msg, '', false, function () {
            $rootScope.srcImg = msg["errmsg"];
            $rootScope.$apply();
          });
        }
      });
    }

    var int = 1;
    getData(int);

    function getData(int) {
      $.ajax({
        type: "POST",
        url: "<?= Url::to(['activity/qrcode-ajax']);?>",
        dataType: "JSON",
        data: {
          "_page": int,
          "_page_size": 20
        },
        success: function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.lists = msg.errmsg.data;
            //console.log($scope.lists);
            $.each($scope.lists, function (a, b) {
              b.isShelves = b.status == 1 ? true : false;
              b.isRecommend = b.is_recommend == 1 ? true : false;
            })
            $scope.page = msg.errmsg.page;
            $scope.$apply();
            //console.log("msg", msg);
          });
        }
      });
    }

    //分页
    $scope.options = {callback: getData};
  });

</script>
