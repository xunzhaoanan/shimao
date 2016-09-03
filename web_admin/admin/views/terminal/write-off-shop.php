<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '核销管理';
?>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
<script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
<div class="main-container-inner"> <?php echo $this->render('@app/views/side/manage_setting.php');?>
  <div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs" >
      <script type="text/javascript">try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}</script>
      <ul class="breadcrumb">
        <li>核销门店排行榜</li>
      </ul>
      <!-- .breadcrumb -->
    </div>
    <div class="page-content">
      <!-- /.page-header -->
      <!-- PAGE CONTENT BEGINS -->
      <div class="row">
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-12">

                <div class="alert alert-block alert-success" ng-if="isshow">
                  <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon icon-times"></i>
                  </button>
                  <p><i class="ace-icon icon-check green"></i> 1.只有员工绑定的微信号正常，才能进行核销。</p>
                  <p><i class="ace-icon icon-check green"></i> 2.员工绑定微信号请到“员工管理”页面进行绑定</p>
                </div>
            </div>
          </div>

          <div class="tabbable">
              <ul class="nav nav-tabs tab-color-blue " id="myTab" ng-if="isshow">
                  <li><a ng-if="$root.hasPermission('terminal/write-off')" ng-href="/terminal/write-off{{$root.getSearchUrl}}">绑定核销员</a> </li>
                  <li><a ng-if="$root.hasPermission('terminal/write-off-web')" ng-href="/terminal/write-off-web{{$root.getSearchUrl}}">网页核销</a> </li>
                  <li><a ng-if="$root.hasPermission('terminal/write-off-records')" ng-href="/terminal/write-off-records{{$root.getSearchUrl}}">核销记录</a> </li>
                  <li class="active"><a ng-if="$root.hasPermission('terminal/write-off-shop')" ng-href="/terminal/write-off-shop{{$root.getSearchUrl}}">核销门店排行榜</a> </li>
                  <li><a ng-if="$root.hasPermission('terminal/write-off-staff')" ng-href="/terminal/write-off-staff{{$root.getSearchUrl}}">核销员排行榜</a> </li>
              </ul>
            <div class="tab-content">

                <div class="tab-pane active">
                    <div class="row margin-bottom10 padding-left10 float-right clearfix">
                        <div class=" no-padding-left ">
                            <div class="input-group  float-left no-padding  " >
                                <div class="inline float-right margin-left10">
                                    <select class="width130" ng-options="o.id as o.shopInfo.name for o in shopList" ng-model="shop_id" ng-change="shopChange(shop_id)">
                                    </select>
                                </div>
                            </div>
                            <span class="float-left margin-right10 " ng-click="shopSearch()"><a class="btn btn-xs btn-primary">搜索</a></span>
                        </div>

                    </div>
                    <table width="100%" class="table table-striped table-bordered table-hover table-width" >
                        <thead>
                        <tr>
                            <th width="21%" class="text-center">序号</th>
                            <th width="14%" class="text-center">核销门店</th>
                            <th width="16%" class="text-center">核销次数</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="list in shops">
                            <td class="text-center" ng-bind="list.top"></td>
                            <td class="text-center" ng-bind="list.name ?list.name:'总店'"></td>
                            <td class="text-center" ng-bind="list.num"></td>
                        </tr>
                        <tr ng-show="!shops.length">
                            <td colspan="3" class="red text-center">暂时没有可显示的数据</td>
                        </tr>
                        </tbody>
                    </table>
                    <div ng-paginate options="options" page="page">
                    </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="/ace/js/DatePicker/WdatePicker.js"></script>

<script>
app.filter('cancelStatus', function(){
	return function(val){
		switch(val){
			case 1:
			    return '卡券';
			break;
			case 2:
			    return '抽奖活动';
			break;
			case 3:
			    return '到店自提';
            case 4:
                return '众筹';
			break;
		};
	};
});
app.controller("mainController", function($scope, $http, $rootScope, $timeout) {
    $timeout(function () {
        $rootScope.$broadcast('leftMenuChange', 'ae');
    }, 100);
    $scope.isshow = false;
    if(wsh.getHref("terminal_id")) {
        $scope.isshow = true;
    }

    //核销门店
    $scope.shopList = JSON.parse('<?= addslashe(json_encode($shopList)) ?>');
    console.log("shop",$scope.shopList);
    $scope.shopList.unshift({"id": 0, "shopInfo": {"name": "核销门店"}});
    $scope.shop_id = 0;
    $scope.shopChange = function(id){
        $scope.shop_id = id;
    };

    var shop_sub_id = '';
    $scope.options={callback:pageList};
    pageList(1,shop_sub_id);
    function pageList(int,shop_sub_id) {
        $http.post(wsh.url + 'shopsub-cancel-list-ajax', {'_page': int, '_page_size': 10,'shop_sub_id':shop_sub_id})
            .success(function(msg){
                wsh.successback(msg, '', false, function(){
                    $scope.shops = msg.errmsg.data;
                    $scope.page = msg.errmsg.page;
                });
            })

    }

    //核销门店查询
    $scope.shopSearch = function(){
        var id = $scope.shop_id;
        if(id == 0)
        {
            id = null;
        }
        pageList(1,id);
    };
});

</script>
