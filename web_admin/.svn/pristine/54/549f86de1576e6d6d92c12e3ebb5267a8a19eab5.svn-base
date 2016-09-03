<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '派发管理';
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
          <li>卡券管理</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="tabbable">

              <ul class="nav nav-tabs tab-color-blue " id="myTab4">
                <li class=""><a href="/card-coupons/list">卡券列表 </a></li>
                <li class="active"><a href="/card-coupons/receive-list">直接领取 </a></li>
                <li class=""><a href="/card-coupons/policy-list">赠送策略</a></li>
                <li class=""><a href="/card-coupons/send-list">手动派发</a></li>
              </ul>

              <div class="tab-content">
                <div class="tab-pane active">
                  <div class="clearfix no-padding">
                    <div class="col-sm-7 no-padding">
                      <ul class="listli left-space1 btn-primary bune">
                        <li><a href="/card-coupons/receive-add"
                               ng-if="$root.hasPermission('card-coupons/receive-add')"
                               class="btn btn-xs btn-primary">添&nbsp;&nbsp;&nbsp;&nbsp;&nbsp加</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <form class="form-horizontal">
                    <table width="100%"
                           class="table  margin-top15 table-striped table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th width="20%" class="text-center">信息标题</th>
                        <th width="8%" class="text-center">活动类型</th>
                        <th width="20%" class="text-center">卡券名称</th>
                        <th width="5%" class="text-center">卡券类型</th>
                        <th width="20%" class="text-center">有效领取时间</th>
                        <th width="7%" class="text-center">操作</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr ng-repeat="list in lists" ng-cloak>
                        <td class="text-center" ng-bind="list.news.title"></td>
                        <td class="text-center" ng-bind="shareType(list.share_type)"></td>
                        <td class="text-center" ng-bind="list.cardTypeInfo.title"></td>
                        <td class="text-center"
                            ng-bind="cardTypeInfo(list.cardTypeInfo.wx_card_type)"></td>
                        <td class="text-center">
                          <span ng-bind="list.begin_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></span>至<span ng-bind="list.end_time*1000 | date:'yyyy-MM-dd HH:mm:ss'"></span>
                        </td>
                        <td class="text-center">
                          <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                            <a class="success pointer ng-pristine ng-valid ng-touched"
                               ng-href="{{'/activity/qrcode?model=cardcoupon&model_id='+list.id}}"
                               title="二维码管理">
                              <i class="icon-erweima bigger-130"></i>
                            </a>
                            <a class="blue pointer"
                               ng-if="$root.hasPermission('card-coupons/receive-edit')"
                               ng-href="{{'/card-coupons/receive-edit?id=' + list.id}}" title="编辑">
                              <i class="icon-bianji bigger-130"></i>
                            </a>
                            <a class="red pointer" title="删除" ng-click="delete(list.id)">
                              <i class="icon-shanchu bigger-140"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                      <td colspan="6" ng-show="!lists.length" class="red text-center" ng-cloak>
                        暂无数据
                      </td>
                      </tbody>
                    </table>

                    <div ng-paginate options="options" page="page"></div>

                  </form>

                </div>
              </div>

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

    var int = 1;
    //分页
    $scope.options = {callback: getData};
    getData(int);
    function getData(int) {
      $http.post(wsh.url + "receive-list-ajax", {'_page': int, '_page_size': 15})
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              $scope.lists = msg.errmsg.data;
              $scope.page = msg.errmsg.page;
            })
          })
    }

    //活动类型
    $scope.shareType = function (id) {
      switch (id) {
        case 1:
          return '开放性活动';
          break;
        case 2:
          return '线下分享活动';
          break;
        case 3:
          return '线下活动';
          break;
        default :
          return '没有活动类型';
      }
    };
    //卡券类型
    $scope.cardTypeInfo = function (id) {
      switch (id) {
        case 1:
          return '代金券';
          break;
        case 2:
          return '折扣券';
          break;
        case 3:
          return '礼品券';
          break;
        default :
          return '没有卡券类型';
      }
    };

    $scope.delete = function (id) {
      wsh.setDialog('删除提示', '确定要删除吗', wsh.url + 'receive-del-ajax', {'id': id}, function () {
        getData(1);
      }, '删除成功！');
    };


  });

</script>
