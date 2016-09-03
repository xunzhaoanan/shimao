<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '手动派发卡券';
?>

<!-- 关指定商品示例样式 -->
<link rel="stylesheet" href="/ace/js/selectize/orgsinfo.select.css"/>

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
          <li>手动派发卡券</li>
        </ul>
      </div>
      <div class="page-content" ng-cloak>
        <div class="row">
          <div class="col-xs-12">
            <div class="space-10"></div>
            <form class="form-horizontal" role="form" name="myform">

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">指定：</label>

                <div class="col-sm-10" id="radio">
                  <label>
                    <input name="usergroup" id="user_send" type="radio" class="ace" value="1"
                           checked>
                    <span class="lbl " for="user_send">用户 </span>
                  </label>

                  <label>
                    <input name="usergroup" id="group_send" type="radio" class="ace" value="2">
                    <span class="lbl" for="group_send"> 分组 </span>
                  </label>
                </div>
              </div>

              <div class="form-group clearfix" id="tag_user">
                <label class="col-sm-2 control-label">选择用户：</label>

                <div class="col-sm-10">
                  <div class="col-sm-4 no-padding">
                    <div class="col-sm-10 margin-bottom10">
                      <a data-toggle="modal" data-target="#cardUserModal"
                         class="btn btn-xs btn-primary"
                         ng-click="$root.copy('userList', storeList)"> 选择用户 </a></div>
                    <div class="table-responsive clearfix">
                      <table class="table table-striped table-bordered table-hover table-width"
                             ng-show="storeList.length" ng-cloak>
                        <thead>
                        <tr>
                          <th width="10%">昵称</th>
                          <th width="10%">操作</th>
                        </tr>
                        </thead>
                        <tbody id="tbody">
                        <tr ng-repeat="list in storeList">
                          <td ng-bind="list.nickname"></td>
                          <td>
                            <div class="action-buttons" ng-click="edit($index)">
                              <a class="success pointer" ng-show="list.isShowEdit" ng-cloak>
                                <i class="icon-pencil bigger-130"></i>
                              </a>
                              <a class="red pointer" ng-click="deleteProduct($index, list)">
                                <i class="icon-remove bigger-130"></i>
                              </a>
                            </div>
                          </td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group clearfix" id="tag_group" style="display:none">
                <label class="col-sm-2 control-label">指定分组：</label>

                <div class="col-sm-10">
                  <div class="col-sm-4 no-padding">
                    <input data-toggle="modal" data-target="#cardGroupModal" ng-model="gropName"
                           name="gropName"
                           type="text" class="width100" value="" readonly>
                  </div>
                </div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">关联卡券：</label>

                <div class="col-sm-10">
                  <div class="col-sm-4 no-padding">
                    <div class="col-sm-10 margin-bottom10">
                                          <span type="submit" data-toggle="modal"
                                                data-target="#cardModal"
                                                class="btn btn-xs btn-primary" ng-show="!title">
                                                   选择卡券
                                                </span>

                      <p class="form-control-static pointer" ng-show="title" name="cardTitle">
                       <span ng-bind="title"></span><a href="javascript:void(0);" class="inline margin-left10"
                                    data-toggle="modal" data-target="#cardModal">重新选择</a></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">派送失败说明：</label>

                <div class="col-sm-10 margin-top5">
                  <p class="grey">1、库存不足：卡券已全部派送完，增加库存后方可继续派送。</p>

                  <p class="grey">2、领取过多：同一用户领取次数过多，若继续进行派送，则部分用户将无法收到派送的卡券。</p>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="space-32"></div>
        <!-- 确定 -->
        <div class="modal-footer margin-auto" id="modal-footer">
          <a id="post" ng-click="saveBtn()" class="btn btn-primary"> 派发 </a>
        </div>
      </div>

    </div>
  </div>

</div>
<?php
echo $this->render('@app/views/card-coupons/card-connect.php');
?>
<?php
echo $this->render('@app/views/card-coupons/card-user.php');
?>
<?php
echo $this->render('@app/views/card-coupons/card-group.php');
?>
<script>
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ec');
    }, 100);

    $scope.radio_money = $('#radio').find('input[type="radio"]')[0].checked ? 1 : 2;
    if ($scope.radio_money == 2) {
      $("#connect").val("");
    }
    $scope.isSubmit = false;
    $scope.saveBtn = function () {
      if ($scope.myform.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
      $scope.radio_money = $('#radio').find('input[type="radio"]')[0].checked ? 1 : 2;
      var data = {"user_type": $scope.radio_money, "card_type_id": $scope.id};
      if ($scope.radio_money == 1) {
        data.to_user_ids = $scope.ids;
        if ($scope.storeList.length == 0) return alert("请选择用户!");
      } else if ($scope.radio_money == 2) {
        if ($scope.gropName == "" || $scope.gropName == undefined) return alert("请选择分组!");
        data.user_group = $scope.group_id;
      }
      if (!$scope.title) return alert("请选择卡券!");
      $http.post(wsh.url + 'send-ajax', data)
          .success(function (msg) {
            var txt = '';
            if (msg.errcode == 0) {
              switch (msg.errmsg.flag) {
                case 1:
                  txt = '派发成功';
                  break;
                case 2:
                  txt = '派发失败';
                  break;
                case 3:
                  txt = '部分派发成功';
                  break;
              }
            }
            wsh.successback(msg, txt, false, function () {
              window.location.href = "/card-coupons/send-list";
            })
            $('#post').removeAttr('disabled');
          }).error(function () {
            $('#post').removeAttr('disabled');
          });

    };
    $scope.ids = [];
    $scope.$on('chooseCard', function (e, json) {
      $scope.title = json.title;
      $scope.id = json.id;
    });
    //删除
    $scope.edit = function (index) {
      wsh.setNoAjaxDialog('删除提示', '确定要删除？', function () {
        $scope.storeList.splice(index, 1);
      })
    };
    //用户
    $scope.storeList = [];
    $rootScope.userList = [];
    $scope.$watch('storeList.length', function () {
      $scope.ids = [];
      angular.forEach($scope.storeList, function (obj) {
        $scope.ids.push(obj.id);
      });
    });
    $scope.$on('chooseDlist', function (e, json) {
      $scope.storeList = angular.copy(json);
    });


    //分组

    $scope.$on('chooseGroup', function (e, json) {
      $scope.gropName = json.group_name;
      console.log(json);
      $scope.group_id = json.id;
    });
    //删除
    $scope.delete = function (index) {
      wsh.setNoAjaxDialog('删除提示', '确定要删除？', function () {
        $scope.groupList.splice(index, 1);
      })
    };
  });

  $('#user_send').click(function () {
    $('#tag_group').hide();
    $('#tag_user').show();
  });

  $('#group_send').click(function () {
    $('#tag_user').hide();
    $('#tag_group').show();
  });





</script> 
