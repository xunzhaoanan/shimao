<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '终端店收款码';
?>

<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner">
    <?php
    echo $this->render('@app/views/side/extension.php');
    ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>终端店收款码</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">

            <div class="tabbable">
              <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="/terminal/scan-pay">直营店</a></li>
                <li><a href="/terminal/scan-pay-agent">加盟店</a></li>
              </ul>
            </div>

            <div class="tab-content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="float-left margin-left10 no-padding">
                    <div class="col-sm-7 no-padding">
                      <ul class="listli left-space1 btn-primary bune">
                        <li class="dropdown">
                          <a data-toggle="dropdown"
                             ng-if="$root.hasPermission('terminal/bulid-qrcode-ajax')"
                             class="dropdown-toggle btn btn-xs btn-primary">
                            批量导出二维码&nbsp&nbsp <i
                              class="icon-caret-down bigger-110 width-auto"></i>
                          </a>
                          <ul class="pull-left dropdown-menu dropdown-yellow dropdown-caret dropdown-close"
                              style="cursor:pointer;">
                            <li ng-repeat="list in handleAll">
                              <a ng-bind="list.name" ng-click="handClick(list)"></a>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="inline float-right margin-bottom10 margin-left10">
                    <input class="min-width120 float-left" placeholder="搜索终端店相关关键字" type="text"
                           ng-model="searchName" maxlength="20">
                                        <span class="float-left " ng-click="normalSearch()">
                                            <a class="btn btn-xs btn-primary"><i
                                                class="icon-search icon-on-right bigger-110"></i></a>
                                        </span>
                  </div>
                </div>

              </div>
              <div class=" space-6"></div>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-width">
                  <thead>
                  <tr>
                    <th width="3%" class="text-center"><label>
                      <input type="checkbox" class="ace" ng-model="isCheckeAll"
                             ng-click="checkAllFun(isCheckeAll)">
                      <span class="lbl"></span> </label>
                    </th>
                    <th width="20%" class="text-center">终端店名称</th>
                    <th width="10%" class="text-center">终端店分类</th>
                    <th width="8%" class="text-center">地址</th>
                    <th width="6%" class="text-center">联系电话</th>
                    <th width="8%" class="text-center">扫码次数</th>
                    <th width="5%" class="text-center">收款码状态</th>
                    <th width="8%" class="text-center">收款二维码</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr ng-repeat="list in lists">
                    <td class="lt-width3 text-center" ng-click="checkFun(1, list, $event)"><label>
                      <input type="checkbox" class="ace" ng-model="list.isCheck"
                             ng-click="checkFun(2, list, $event)">
                      <span class="lbl"></span> </label></td>
                    <td ng-bind="list.shopInfo.name" class="text-center"></td>
                    <td class="text-center">直营店</td>
                    <td ng-bind="list.shopInfo.address" class="text-center"></td>
                    <td class="text-center" ng-bind="list.shopInfo.phone"></td>
                    <td class="text-center" ng-bind="list.shopSubSetting.scan_count"></td>
                    <td class="text-center"><label>
                      <input name="switch-field-1"
                             ng-disabled="!$root.hasPermission('terminal/scan-pay-open-ajax') ||  !$root.hasPermission('terminal/scan-pay-close-ajax')"
                             class="ace ace-switch ace-switch-6"
                             ng-model="list.shopSubSetting.is_scan_pay" my-check-box
                             type="checkbox"
                             ng-click="statueFun(list.shopSubSetting.is_scan_pay, list.shopInfo.shop_sub_id)">
                      <span class="lbl"></span> </label></td>
                    <td class="text-center">
                      <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons"><a
                          class="success pointer" data-rel="tooltip" title="查看二维码"
                          ng-model="list.id"
                          ng-click="getQrcode(list.shopInfo.shop_sub_id)" data-toggle="modal"
                          data-target="#query">
                        <i
                            class="icon-erweima bigger-130"></i> </a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="8" ng-show="!lists.length" class="red text-center">暂时没有可展示的数据
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
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"><a type="button" class="bootbox-close-button close"
                                     data-dismiss="modal">×</a>
          <h4 class="modal-title">查看收款二维码</h4>
        </div>
        <div class="modal-body">
          <div class="bootbox-body">
            <div class="center">
              <img width="430px" height="430px" ng-src="{{qrcodeUrl}}">
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
      $rootScope.$broadcast('leftMenuChange', 'he');
    }, 100);
      $scope.searchName = '';
    //查看二维码
    var qrcode = JSON.parse('<?= addslashe(json_encode($qrcode)); ?>');
    $scope.getQrcode = function (id) {
      $scope.qrcodeUrl = qrcode + '?id=' + id;
    }
    var arrayStory = [];

    function getData(int) {
      $http.post('/terminal/list-ajax', {
        "_page": int,
        "_page_size": 20,
        'shop_type': 1,
        'name': $scope.searchName,
        'search_all':true
      })
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              $scope.isCheckeAll = false;
              $scope.lists = msg.errmsg.data;
              if (!$scope.lists) {
                $scope.lists = [];
                return;
              }
              $($scope.lists).each(function (a, b) {
                b.isCheck = false;
                if (!b.shopSubSetting.scan_count) b.shopSubSetting.scan_count = 0;
              });
              $scope.page = msg.errmsg.page;
              complie();
            });
          })
          .error(function () {
            alert('网络异常，请重试');
          });
    }

    //过滤
    function complie() {
      if (!arrayStory.length) return;
      for (var i in $scope.lists) {
        for (var j in arrayStory) {
          if ($scope.lists[i].shopInfo.shop_sub_id == arrayStory[j]) {
            $scope.lists[i].isCheck = true;
            continue;
          }
        }
      }
    }

    //选择单个
    $scope.checkFun = function (id, list, event) {
      if (id == 1) {
        list.isCheck = !list.isCheck;
        if (list.isCheck) {
          arrayStory.push(list.shopInfo.shop_sub_id);
        } else {
          var ii = arrayStory.indexOf(list.shopInfo.shop_sub_id);
          arrayStory.splice(ii, 1);
        }
      } else if (id == 2) {
        if (list.isCheck) {
          arrayStory.push(list.shopInfo.shop_sub_id);
        } else {
          var ii = arrayStory.indexOf(list.shopInfo.shop_sub_id);
          arrayStory.splice(ii, 1);
        }
        event.stopPropagation();
      }

    }

    //全选
    $scope.checkAllFun = function (allCheck) {
      $.each($scope.lists, function (a, b) {
        b.isCheck = allCheck;
        if (allCheck) {
          arrayStory.push(b.shopInfo.shop_sub_id);
        } else {
          var ii = arrayStory.indexOf(b.shopInfo.shop_sub_id);
          if (ii != -1) arrayStory.splice(ii, 1);
        }
      });
      arrayStory = wsh.unique(arrayStory);
    }

    //批量导出二维码
    $scope.handleAll = [
      {id: 1, name: '导出所选收款二维码'},
      {id: 2, name: '导出全部收款二维码'}
    ];

    //批量导出二维码下拉的事件
    $scope.handClick = function (list) {
      if (list.id == 1) {  //所选
        if (arrayStory.length < 1) return alert('请选择需要导出的收款二维码！');
          location.href = '/terminal/bulid-qrcode-ajax?ids='+arrayStory.join(',');
      } else {  //全部
          location.href = '/terminal/bulid-qrcode-ajax?shop_type=1&name='+$scope.searchName+'&search_all=true';
      }
    }

    //搜索事件
    $scope.normalSearch = function () {
      arrayStory = [];
      getData(1, $scope.searchName);
    };

    //收款码状态
    $scope.statueFun = function (issacn, shopid) {
      if (issacn === 1) {
        $http.post("/terminal/scan-pay-open-ajax", {'id': shopid})
            .success(function (msg) {
              wsh.successback(msg, '启用成功', false, function () {
              });
            })
            .error(function () {
              alert('网络异常,请重试');
            });
      } else {
        $http.post("/terminal/scan-pay-close-ajax", {'id': shopid})
            .success(function (msg) {
              wsh.successback(msg, '禁用成功', false, function () {
              });
            })
            .error(function () {
              alert('网络异常,请重试');
            });
      }
    }

    //分页
    getData(1);
    $scope.options = {page: 'page', callback: getData};

  });
</script>