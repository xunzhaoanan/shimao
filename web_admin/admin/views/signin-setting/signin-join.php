<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '签到活动人员';
?>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <!-- <script type="text/javascript">
       try {
           ace.settings.check('main-container', 'fixed')
       } catch (e) {
       }
   </script>-->
  <div class="main-container-inner">
    <?php
    echo $this->render('@app/views/side/marketing.php');
    ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <!--<script type="text/javascript">
            try {
                ace.settings.check('breadcrumbs', 'fixed')
            } catch (e) {
            }
        </script>-->
        <ul class="breadcrumb">
          <li>签到活动人员</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="leader clearfix">
            </div>
            <div class="tabbable clearfix">
              <div id="rule" class="tab-pane active ruleCont margin-top20 clearfix">
                <form class="form-horizontal" name="myform">
                  <div class="infobox-content">
                    总共签到：<span class="infobox-data-number pointer" ng-bind="countJoin ? countJoin : 0"></span> 人
                  </div>
                  <div class="inline float-right margin-left10">
                    <input placeholder="搜索微信昵称" type="text" ng-model="searchName"
                           class="inline align-top">
											<span ng-click="normalSearch()">
												<a class="btn btn-xs btn-primary align-top" style="margin-left:-4px;">
                          <i class="icon-search icon-on-right bigger-90">
                          </i>
                        </a>
											</span>
                  </div>
                  <div class="space-6 clearfix col-sm-12"></div>
                  <div class="table-responsive clearfix">
                    <table class="table table-striped table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th width="10%" class="text-center">排名</th>
                        <th width="15%" class="text-center">微信昵称</th>
                        <th width="15%" class="text-center">签到时间</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr ng-show="lists" ng-repeat="list in lists | orderBy: 'floor'" ng-cloak>
                        <td class="lt-width3 text-center" ng-bind="list.floor"></td>
                        <td class="lt-width3 text-center" ng-bind="list.userInfo.nickname"></td>
                        <td class="lt-width3 text-center"
                            ng-bind="list.created*1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                      </tr>
                      <tr>
                        <td colspan="3" ng-show="!lists.length || !lists" class="text-center red">
                          暂时没有可显示的数据
                        </td>
                      </tr>
                      </tbody>
                    </table>
                    <div ng-paginate options="options" page="page"></div>
                  </div>
                  <div class="modal-footer margin-auto" id="modal-footer">
                    <a class="btn btn-infor" href="/signin-setting/list"> 返回列表 </a>
                  </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'eb');
    }, 100);
    $scope.countJoin = JSON.parse('<?= addslashe(json_encode($countJoin)); ?>'); //签到人数
    function getData(int) {//请求列表
      $http.post("<?= Url::to(['/signin-setting/signin-join-list-ajax']);?>", {
          "id": id,
          "_page": int,
          "_page_size": 15,
          'nickName': $scope.searchName ? $scope.searchName : ''
        })
        .success(function (msg) {
          wsh.successback(msg, "", false, function () {
            $scope.lists = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
          })
        });

    }
    //分页
    $scope.options = {callback: getData};
    var id = wsh.getHref('id');
    getData(1);

    //查询
    $scope.normalSearch = function () {
      getData(1);
    };

  });


</script>