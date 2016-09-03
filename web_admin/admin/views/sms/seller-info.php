<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '短信赠送套餐';
?>
<style>

  .dx-lq-btn {
    display: inline-block;
    width: 100px;
    height: 30px;
    margin: 0 auto;
    line-height: 30px;
    border: 1px solid #428bca;
    border-radius: 5px;
    text-align: center;
  }

  .dx-lq-table td {
    height: 40px;
  }
</style>
<div class="main-container" id="main-container" ng-cloak>
  <script type="text/javascript"> try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner" ng-controller="mainController">
    <?php echo $this->render('@app/views/side/manage_setting.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
          <li>短信赠送套餐
          </li>
        </ul>
      </div>
      <div class="page-content">


        <div class="row">
          <div class="col-xs-12">
            <table class="table table-striped table-bordered table-hover table-width dx-lq-table">
              <thead>
              <tr>
                <th class="text-center">套餐名称</th>
                <th class="text-center">领取数量</th>
                <th class="text-center">状态</th>
              </tr>
              </thead>
              <tbody>
              <tr ng-repeat="list in lists">
                <td class="text-center" ng-bind="list.name"></td>
                <td class="text-center" ng-bind="list.gift_sms_num"></td>
                <td class="text-center" ng-if="list.receive_status == 1">
                  <button class=" btn btn-primary" ng-click="getSms(list.id)">领取</button>
                </td>
                <td class="text-center" ng-if="list.receive_status == 2">已领取</td>

              </tr>
              <tr>
                <td ng-show="!lists.length" colspan="3" class="red text-center">
                  暂时没有可展示的数据
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
<script>
  app.controller("mainController", function ($scope, $timeout, $rootScope, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ai');
    }, 2000);
    $scope.model = [];
    getData();
    function getData(int) {
      $http.post(wsh.url + "package-list-ajax", {
          "_page": int,
          "_page_size": 15,
          "type": 2,
          "status": 1
        })
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.lists = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
          });
        });
    }

    //分页
    $scope.options = {callback: getData};
    //领取
    $scope.getSms = function (id) {
      $http.post(wsh.url + 'receive-ajax', {
          "id": id
        })
        .success(function (msg) {
          wsh.successback(msg, '领取成功', false, function () {
            $scope.lists = msg.errmsg.data;
          });
        });
      window.location.href = ("/sms/seller-info");
    }


  });
</script>