<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '领取记录';
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
          <li>领取记录</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
              <a ng-href="{{'../export/user-tv-card?id=' + id}}"  ng-if="$root.hasPermission('export/user-tv-card')" target="_blank"  class="btn btn-xs btn-primary">导出领取记录</a>
             <div class="space-6"></div>
           
            <div class="table-responsive clearfix">
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                  <tr>
                    <th width="5%" class="text-center">卡券ID</th>
                    <th width="15%" class="text-center">卡券编号</th>
                    <th width="18%" class="text-center">领取用户</th>
                    <th width="20%" class="text-center">领取时间</th>
                     <th width="8%" class="text-center">核销状态</th>
                    <th width="15%" class="text-center">核销人员</th>
                    <th width="15%" class="text-center">核销门店</th>
                  </tr>
                </thead>
                <tbody ng-repeat="list in lists" ng-cloak>
                  <tr>
                    <td class="lt-width3 text-center" ng-bind="list.id"></td>
                    <td class="lt-width3 text-center" ng-bind="list.code"></td>
                    <td class="text-center" ng-bind="list.wxUser.nickname || '游客'"></td>
                    <td class="text-center" ng-bind="list.time * 1000 | date : 'yyyy-MM-dd  HH:mm:ss'"></td>
                    <td class="text-center" ng-bind="status(list.status)"></td>
                    <td class="text-center" ng-bind="list.cancelRecord ? list.cancelRecord.shopStaff.real_name : ''"></td>
                    <td class="text-center" ng-bind="list.cancelRecord ? list.cancelRecord.shopInfo.name : ''"></td>
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

<script>
    app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
        $timeout(function () {
            $rootScope.$broadcast('leftMenuChange', 'ed');
        }, 100);
        $scope.model = JSON.parse('<?= addslashe(json_encode($model))?>');
        $scope.id
        $scope.id = wsh.getHref('id');
        //分页
        $scope.options = {callback: getData};
        var int = 1;
        getData(int);
        function getData(int) {
            $http.post(wsh.url + 'card-record-list-ajax', {
                "card_type_id": $scope.model.id,
                "_page": int,
                "_page_size": 20,
                "_status": true
            }).success(function (msg) {
                    wsh.successback(msg, "", false, function () {
                        $scope.lists = msg.errmsg.data;
                        $scope.page = msg.errmsg.page;
                        console.log($scope.lists);
                    })
                }).error(function (msg) {
                    console.log(msg);
                });
        }

        $scope.status = function (status) {
            switch (status) {
                case 1:
                    return '未领取';
                    break;
                case 2:
                    return '已领取';
                    break;
                case 3:
                    return '已核销';
                    break;
                case 4:
                    return '已赠送';
                    break;
                default :
                    return '没有状态';
            }
        }


    });
</script> 
