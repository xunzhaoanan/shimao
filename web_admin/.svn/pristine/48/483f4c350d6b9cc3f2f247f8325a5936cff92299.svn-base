<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '接龙红包活动参与人员';
?>
<div class="main-container" id="main-container" ng-controller="mainController">
  <script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/marketing.php');?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs"> 
        <script type="text/javascript">
              try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>
        <ul class="breadcrumb">
          <li>接龙红包活动参与人员</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <!--<div class="clearfix no-padding">
              <div class="col-sm-7 no-padding">
                <ul class="listli left-space1 btn-primary bune">
                  <li><a  class="btn btn-xs btn-primary">导出人员</a></li>
                </ul>
              </div>
            </div>-->
            <div class="space-6 clearfix col-sm-12"></div>
            <div class="table-responsive clearfix">
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                  <tr>
                    <th width="10%" class="text-center">红包ID</th>
                    <th width="10%" class="text-center">红包金额</th>
                    <th width="8%" class="text-center">参与总人数</th>
                    <th width="15%" class="text-center">接龙状态</th>
                    <th width="7%"  class="text-center">操作</th>
                  </tr>
                </thead>
                <tbody>
                  <tr ng-repeat="list in lists">
                    <td class="lt-width3 text-center" ng-bind="list.id"></td>
                    <td class="text-center" ng-bind="list.amount"></td>
                    <td class="text-center"></td>
                    <td class="text-center" ng-if="list.status == 2">领取中</td>
                    <td class="text-center" ng-if="list.status == 3">已完成</td>
                    <td class="text-center"><div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                      <a class="blue" ng-if="list.status == 3" data-toggle="modal" data-target="#myModal" title="管理" ng-click="whoGroup(list.id)">
                        <i class="icon-user bigger-130"></i> </a>
                      <a class="grey" ng-if="list.status == 2"  title="管理">
                        <i class="icon-user bigger-130"></i> </a>
                    </div></td>
                  </tr>
                  <tr ng-cloak ng-show="!lists" class="center"><td colspan="5">暂无数据</td></tr>
                </tbody>
              </table>
              <div ng-paginate options="options1" page="page1"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!--列表-->
<div class="bootbox modal fade in"  id="myModal" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
      <div class="modal-header"> <a href="#" type="button" class="bootbox-close-button close" data-dismiss="modal">×</a>
        <h4 class="modal-title">接龙红包领取人员</h4>
      </div>
      <div class="modal-body">
      <div class="bootbox-body">
        <div id="home" class="tab-pane in active row">
         <div class="table-responsive clearfix">
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                  <tr>
                    <th width="10%" class="text-center">用户ID</th>
                    <th width="10%" class="text-center">昵称</th>
                    <th width="8%" class="text-center">手机号</th>
                    <th width="15%" class="text-center">领取金额</th>
                  </tr>
                </thead>
                <tbody>
                  <tr ng-repeat="listpop in listspops">
                    <td class="lt-width3 text-center" ng-bind="listpop.uid"></td>
                    <td class="text-center" ng-bind="listpop.wxUserInfos.nickname"></td>
                    <td class="text-center" ng-bind="listpop.wxUserInfos.mobile"></td>
                    <td class="text-center" ng-bind="amount"></td>
                  </tr>
                </tbody>
              </table>
           <div ng-paginate options="options2" page="page2"></div>
            </div>
      </div>
  </div>
  </div>
   <div class="modal-footer">
     <a href="#" data-bb-handler="confirm" class="btn btn-primary" ng-click="$root.btnConfirm()" id="btnConfirm">确定</a>
   </div>
</div>
</div>
</div>
<script>
  app.controller('mainController',function($scope, $rootScope, $timeout){
    $timeout(function(){$rootScope.$broadcast('leftMenuChange', 1);}, 100);
    $scope.modelId = JSON.parse('<?= addslashe(json_encode($id)); ?>');  //活动ID
    $scope.redpackId;  //红包ID

    var int = 1;
    getData(int);
    function getData(int){
      $.ajax({
        type: "POST",
        url: "<?= Url::to(['redpack/find-transmit-item-list-ajax']);?>",
        dataType:"JSON",
        data: {"_page": int, "_page_size": 1, "id": $scope.modelId},
        success: function(msg){
          wsh.successback(msg, '', false, function(){
            $scope.lists = msg.errmsg.data;
            $scope.page1 = msg.errmsg.page;
            $scope.$apply();
            console.log("getData", msg);
          });
        }
      });
    }

    function getDataPop(int, redpackId, activeId){
      $.ajax({
        type: "POST",
        url: "<?= Url::to(['redpack/find-transmit-log-ajax']);?>",
        dataType:"JSON",
        data: {"red_packet_event_id": activeId, "red_package_item_id": redpackId, "_page": int, "_page_size": 100},
        success: function(msg){
          $rootScope.listspops = msg.errmsg.data;
          $rootScope.amount = msg.errmsg.amount;
          $rootScope.page2 = msg.errmsg.page;
          $rootScope.$apply();
          console.log("getDataPop", msg);
        }
      });
    }

    $scope.whoGroup = function(redpackId){
      $scope.redpackId = redpackId;
      getDataPop(int, redpackId, $scope.modelId);
    }

    //分页
    $scope.options = {callback: getData};
    $scope.options = {callback: getDataPop};
  });
</script> 
