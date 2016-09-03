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
              <a ng-click="export()" class="btn btn-xs btn-primary">导出领取记录</a>

            <div class="inline float-right margin-left10">
              <input placeholder="领取用户搜索" type="text" ng-model="searchName" class="inline align-top">
											<span  ng-click="cardSearch()">
												<a class="btn btn-xs btn-primary align-top" style="margin-left:-4px;">
                          <i class="icon-search icon-on-right bigger-90">
                          </i>
                        </a>
											</span>
            </div>
            <div class="inline float-right margin-left10">
              <input placeholder="卡券编号" type="text" ng-model="searchCode" class="inline align-top">
            </div>
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
                <tbody  >
                  <tr ng-repeat="list in lists">
                    <td class="lt-width3 text-center" ng-bind="list.id"></td>
                    <td class="lt-width3 text-center" ng-bind="list.code"></td>
                    <td class="text-center" ng-bind="list.wxUser.nickname || '游客'"></td>
                    <td class="text-center" ng-bind="list.time * 1000 | date : 'yyyy-MM-dd  HH:mm:ss'"></td>
                    <td class="text-center" ng-bind="status(list.status)"></td>
                    <td class="text-center" ng-bind="list.cancelRecord ? list.cancelRecord.shopStaff.real_name : ''"></td>
                    <td class="text-center" ng-bind="list.cancelRecord ? list.cancelRecord.shopInfo.name : ''"></td>
                  </tr>
                  <tr ng-show="!lists.length || !lists" class="center">
                    <td colspan="7">暂无数据</td>
                  </tr>
                </tbody>
              </table>
              <div ng-paginate options="options" page="page"></div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
        $timeout(function () {
            $rootScope.$broadcast('leftMenuChange', 'ec');
        }, 100);
        var s_page = 1;
        $scope.model = JSON.parse('<?= addslashe(json_encode($model))?>');

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
                "_status": true,
                "nickname": $scope.searchName,
                "code":$scope.searchCode,
                "codeFlag": true  //卡券编号 设置模糊查询
            }).success(function (msg) {
                    wsh.successback(msg, "", false, function () {
                        $scope.lists = msg.errmsg.data;
                        $scope.page = msg.errmsg.page;
                    })
                }).error(function (msg) {
                    console.log(msg);
                });
        }
      //查询
        $scope.cardSearch = function(){
            getData(1);
        };
       //导出
        $scope.export = function(){
          var searchCode = $scope.searchCode ? $scope.searchCode : '';
          var nickname = $scope.searchName ? $scope.searchName : '';
          window.open("/export/user-card?card_type_id="+$scope.model.id+"&code="+searchCode+"&nickname="+ nickname);
        };
      //领取状态
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
