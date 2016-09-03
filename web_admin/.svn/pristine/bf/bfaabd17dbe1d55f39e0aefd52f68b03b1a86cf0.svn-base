<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '派发红包';
?>
<link href="/ace/js/DatePicker/skin/WdatePicker.css" rel="stylesheet">
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
          <li>派发红包</li>
        </ul>
      </div>
      <div class="page-content" ng-cloak>
        <div class="row">
          <div class="col-xs-12">
            <div class="space-10"></div>
            <div id="home" style="display: block">
            <form class="form-horizontal" role="form" name="myform">

              <div class="form-group clearfix">
                <label class="col-sm-2 control-label">派发模式：</label>

                <div class="col-sm-10" id="radio">
                  <label>
                    <input name="usergroup" id="user_send" type="radio" class="ace" value="1"
                           checked>
                    <span class="lbl " for="user_send">单用户派发 </span>
                  </label>

                  <label>
                    <input name="usergroup" id="group_send" type="radio" class="ace" value="2">
                    <span class="lbl" for="group_send"> 群组派发 </span>
                  </label>
                </div>
              </div>

              <div class="form-group clearfix" id="tag_user">
                <label class="col-sm-2 control-label">指定用户：</label>

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
                            <div class="action-buttons" ng-click="delete($index)">
                              <a class="success pointer" ng-show="list.isShowEdit" ng-cloak>
                                <i class="icon-pencil bigger-130"></i>
                              </a>
                              <a class="red pointer">
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
                <label class="col-sm-2 control-label">关联红包：</label>

                <div class="col-sm-10">
                  <div class="col-sm-4 no-padding">
                    <div class="col-sm-10 margin-bottom10">
                      <span type="submit" data-toggle="modal" data-target="#redCashPackModal"
                            class="btn btn-xs btn-primary" ng-show="!actName">
                                                   选择红包
                                                </span>

                    <p class="form-control-static" ng-show="actName">
                     <span ng-bind="actName"></span><a href="javascript:void(0);" class="inline margin-left10 pointer"
                                    data-toggle="modal" data-target="#redCashPackModal">重新选择</a></p>
                      </div>
                  </div>

                </div>
              </div>

            </form>
            </div>
            <div id="ruselt" style="display: none">
               <p>您将要派送<b class="red" ng-bind="actName"></b>现金红包，给<b class="blue" ng-show="radio_money == 1" ng-repeat=" l in storeList"><span  ng-bind="l.nickname"></span>,</b><b class="blue" ng-show="radio_money == 2"><span ng-bind="gropName"></span>(<span ng-bind="group_num"></span>人)</b>总共会派发<b class="red" ng-show="type ==1" ng-bind="total_amount"></b>元<b class="red"  ng-show="type ==2"><span ng-bind="mintotal_amount"></span>元~<span ng-bind="maxtotal_amount"></span>元</b></p>
            </div>
          </div>
        </div>

        <div class="space-32"></div>
        <!-- 确定 -->
        <div class="modal-footer margin-auto" id="modal-footer">
          <a id="next" ng-click="next()" class="btn btn-primary"> 下一步 </a>
          <a id="post"  ng-click="saveBtn()" style="display: none" class="btn btn-primary"> 确定 </a>
          <a id="back"  ng-click="back()" style="display: none" class="btn  btn-default"> 返回 </a>
        </div>
      </div>

    </div>
  </div>

</div>

<?php
    echo $this->render('@app/views/cash-redpack/index.php');
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
      $rootScope.$broadcast('leftMenuChange', 'eb');
    }, 100);

    $scope.radio_money = $('#radio').find('input[type="radio"]')[0].checked ? 1 : 2;
    if ($scope.radio_money == 2) {
      $("#connect").val("");
    }
    $scope.isSubmit = false;
    var is_send_ajax = false;
    $scope.saveBtn = function () {
      if(is_send_ajax) return false;
      if ($scope.myform.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }
      $scope.radio_money = $('#radio').find('input[type="radio"]')[0].checked ? 1 : 2;
      var data = {"cash_redpack_id": $scope.id};
      if ($scope.radio_money == 1) {
        data.uids = $scope.ids;
        if ($scope.storeList.length == 0) return alert("请选择用户!");
      } else if ($scope.radio_money == 2) {
        if (!$scope.gropName) return alert("请选择分组!");
        data.group_ids = $scope.group_id;
      }
      if (!$scope.actName) return alert("请选择红包!");
      is_send_ajax = true;
      $http.post(wsh.url + 'send-ajax', data)
          .success(function (msg) {
            var txt = '';
            if(msg.errcode == 0){
              switch (msg.errmsg.flag){
                case 'ALLSUCCESS': txt = '派发成功'; break;
                case 'ALLFAIL': txt = '派发失败'; break;
                case 'PARTSUCCESS': txt = '部分派发成功'; break;
              }
            }
            wsh.successback(msg, txt, false, function () {
                 window.location.href = "/cash-redpack/send-list"
            });
            is_send_ajax = false;
          }).error(function () {
            alert("服务器忙！");
            is_send_ajax = false;
          });

    };
    //选择红包
    $scope.cashRedpack={};
    $scope.$on('chooseCashRedPack', function (e, json) {
      $scope.actName = json.act_name;
      $scope.num = json.quantity - json.send_num;
      $scope.type = json.type;
      $scope.id = json.id;
      $scope.cashRedpack = json;
    });
    //下一步
    $scope.next = function(){
     
      if ($scope.myform.$invalid) {
        $scope.isSubmit = true;
        return $timeout(function () {
          $scope.isSubmit = false;
        }, 2000);
      }

      $scope.min_value = $scope.cashRedpack.min_value /100;
      $scope.max_value = $scope.cashRedpack.max_value /100;

      $scope.radio_money = $('#radio').find('input[type="radio"]')[0].checked ? 1 : 2;
      if ($scope.radio_money == 1) {
        if ($scope.storeList.length == 0) return alert("请选择用户!");
        if( $scope.storeList.length > $scope.num )    return  alert("用户数量不能大于红包数量");
        $scope.total_amount = ($scope.min_value * $scope.storeList.length).toFixed(2);
        $scope.mintotal_amount =($scope.min_value *  $scope.storeList.length).toFixed(2);
        $scope.maxtotal_amount =($scope.max_value *  $scope.storeList.length).toFixed(2) ;
      } else if ($scope.radio_money == 2) {
        if (!$scope.gropName) return alert("请选择分组!");
        if( $scope.group_num > $scope.num )  return  alert("群组人数不能大于红包数量");
        $scope.total_amount =($scope.min_value *  $scope.group_num).toFixed(2);
        $scope.mintotal_amount =($scope.min_value *  $scope.group_num).toFixed(2);
        $scope.maxtotal_amount = ($scope.max_value *  $scope.group_num).toFixed(2);


      }
      if (!$scope.actName) return alert("请选择红包!");

      $("#home").hide();
      $("#ruselt").show();
      $("#next").hide();
      $("#post").show();
      $("#back").show();
    };
    $scope.back = function(){
      $("#home").show();
      $("#ruselt").hide();
      $("#next").show();
      $("#post").hide();
      $("#back").hide();
    };
    $scope.ids = [];

    //删除
    $scope.delete = function (index) {
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
      $scope.group_num = json.user_num;
      $scope.group_id = json.id;
    });

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
