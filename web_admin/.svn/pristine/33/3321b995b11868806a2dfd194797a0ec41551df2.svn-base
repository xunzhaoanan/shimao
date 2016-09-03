<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '满减包邮';
?>
<div class="main-container" id="main-container" ng-controller="mainController">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/marketing.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>满减包邮</li>
        </ul>
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="clearfix no-padding">

              <a ng-if="$root.hasPermission('reduction/add')" href="/reduction/add"
                 class="btn btn-xs btn-primary float-left">添加活动</a>

            </div>
            <div class="space-6 clearfix col-sm-12"></div>
            <div class="table-responsive clearfix">
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                <tr>
                  <th width="10%" class="text-center">活动名称</th>
                  <th width="25%" class="text-center">活动时间</th>
                  <th width="10%" class="text-center">活动条件</th>
                  <th width="15%" class="text-center">优惠内容</th>
                  <th width="15%" class="text-center">优惠关联</th>
                  <th width="10%" class="text-center">状态</th>
                  <th width="20%" class="text-center">操作</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="list in lists" ng-cloak>
                  <td class="text-center" ng-bind="list.name"></td>
                  <td class="text-center"><span ng-bind="list.start_time * 1000 | date:'yyyy-MM-dd HH:mm:ss'"></span> 至 <span ng-bind="list.end_time * 1000 | date:'yyyy-MM-dd HH:mm:ss'"></span></td>
                  <td class="text-center">
                    <div ng-repeat="con in list.conditions"><span ng-if="con.condition_type == 1">满<span ng-bind="con.condition_min / 100"></span>元</span><span ng-if="con.condition_type == 2">满{{con.condition_min}}件</span></div>
                  </td>
                  <td class="text-center">
                    <div ng-repeat="t in list.conditions"><span ng-bind="showType(t)"></span></div>
                  </td>
                  <td class="text-center">
                    <div ng-repeat="s in list.conditions"><span ng-bind="showContent(s)"></span></div>
                  </td>
                  <td class="text-center">
                    <label>
                      <input name="switch-field-1" ng-disabled="!$root.hasPermission('reduction/open-ajax')" class="ace ace-switch ace-switch-6" ng-model="list.ischoose" type="checkbox" ng-click="statues($index, list)">
                      <span class="lbl"></span>
                    </label>
                  </td>

                  <td class="text-center">
                    <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                      <a class="blue pointer" title="编辑" ng-if="$root.hasPermission('reduction/edit')" ng-href="{{'/reduction/edit?id=' + list.id}}">
                        <i class="icon-bianji bigger-130"></i>
                      </a>
                      <a class="red pointer" title="删除" ng-click="delete(list.id)" ng-if="$root.hasPermission('reduction/delete-ajax')">
                        <i class="icon-shanchu bigger-140"></i>
                      </a>

                    </div>
                  </td>
                </tr>
                <tr ng-cloak ng-show="!lists.length || !lists" class="center">
                  <td colspan="7">暂无数据</td>
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
        $rootScope.$broadcast('leftMenuChange', 'ea');
      }, 100);
      $scope.strategys = [];
      $scope.conditions = [];
      //分页
      $scope.options = {callback: getData};
      var int = 1;//第一页
      getData(int);
      function getData(int) {//请求列表
        $http.post("<?= Url::to(['/reduction/list-ajax']);?>", {"_page": int, "_page_size": 15})
          .success(function (msg) {
            wsh.successback(msg, "", false, function () {
              $scope.lists = msg.errmsg.data;
              $scope.page = msg.errmsg.page;

              if ($scope.lists.length > 0) {
                $scope.lists.map(function (obj) {
                  obj.ischoose = obj.deleted == 1 ? true : false;  //deleted  1是开启，2是关闭

                  obj.conditions.map(function (con_obj) {
                    con_obj.strategys.map(function (str_obj) {
                      $scope.strategys.push(str_obj);
                    });
                  });

                });
              }
            });
          });
      }

      //优惠内容
      $scope.showType = function (s) {
        var type = 0;
        s.strategys.map(function (obj) {
          type = obj.reduction_type;
        });
        switch (type) {
          case 1:
            return '满减';
            break;
          case 2:
            return '打折';
            break;
          case 3:
            return '送积分';
            break;
          case 4:
            return '包邮';
            break;
          case 5:
            return '送卡券';
            break;
          case 6:
            return '送现金红包';
            break;
          case 7:
            return '送商城红包';
            break;
        }
      };

      //优惠关联
      $scope.showContent = function (s) {
        var area_cn = '', type = 0,is_all_area = 1,amount= 0,discount= 0,point=0;
        s.strategys.map(function (obj) {
          area_cn = obj.area_cn;
          type = obj.reduction_type;
          is_all_area = obj.is_all_area;
          amount = obj.amount;
          discount = obj.discount;
          point = obj.point;

        });
        switch (type) {
          case 1:
            return amount + '元';
            break;
          case 2:
            return discount / 10 + '折';
            break;
          case 3:
            return point + '分';
            break;
          case 4:
            if (is_all_area == 1) {
              return '全国';
            } else {
              return area_cn;
            }
            break;
          case 5:
            return '送卡券';
            break;
          case 6:
            return '送现金红包';
            break;
          case 7:
            return '送商城红包';
            break;
        }
      };
      //删除
      $scope.delete = function (id) {
        dialog({
          zIndex: 9999998,
          title: "活动删除提示",
          content: "确定要删除此活动吗?",
          okValue: "删除",
          ok: function () {
            $http.post("<?= Url::to(['/reduction/delete-ajax']);?>", {"id": id})
              .success(function (msg) {
                wsh.successback(msg, '删除成功', false, function () {
                  getData(1);
                });
              });
          },
          otherBtnValue: "取消",
          otherBtn: function () {
          }
        }).width(320).showModal();
      };
      //状态
      $scope.statues = function (index, obj) {
        if (!obj.ischoose) { //关闭
          $http.post("<?= Url::to(['/reduction/close-ajax']);?>", {"id": obj.id})
            .success(function (msg) {
              wsh.successback(msg, '活动已关闭', false, '', function () {
                if (msg.errcode == 0) {
                  obj.isdisabled = false;
                } else {
                  obj.ischoose = obj.ischoose == true ? false : true;
                }
              });
            });
        } else { //开启

          $http.post("<?= Url::to(['/reduction/open-ajax']);?>", {"id": obj.id})
            .success(function (msg) {
              wsh.successback(msg, '活动已开启', false, '', function () {
                if (msg.errcode == 0) {
                  obj.isdisabled = false;
                } else {
                  obj.ischoose = obj.ischoose == true ? false : true;
                }
              });

            });
        }
      };


    }
  );

</script> 
