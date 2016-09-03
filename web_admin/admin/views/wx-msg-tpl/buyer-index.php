<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '买家消息';
?>

<style>

  .grey {
    color: #d1d1d1;
  }
</style>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }</script>
  <div class="main-container-inner">
    <?php
    echo $this->render('@app/views/side/manage_setting.php');
    ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }</script>
        <ul class="breadcrumb">
          <li>
            买家消息
          </li>
        </ul>
      </div>
      <div class="page-content">
        <div class="col-xs-12">

          <div class="row">
            <div class="col-sm-12">
                <a class="btn btn-sm btn-primary float-right" href="/wx-msg-tpl/tmp-help">模板消息操作说明</a>
            </div>
          </div>
          <div class="space-6">
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="table-responsive ">
                <table class="table table-striped table-bordered table-hover action-buttons">
                  <thead>
                  <tr>
                    <th width="20%" class="text-center">
                      场景名称
                    </th>
                    <th width="20%" class="text-center">
                      场景描述
                    </th>
                    <th width="15%" class="text-center">
                      发送方式
                    </th>
                    <th width="10%" class="text-center">
                      状态
                    </th>

                    <th width="10%" class="text-center">
                      操作
                    </th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr ng-repeat="list in lists" ng-class="{true: 'grey',false: ''}[list.deleted == 2]">
                    <td class="center " ng-bind="list.name">
                    </td>
                    <td class="center " ng-bind="list.remark">
                    </td>
                    <td class="center" ng-bind="list.sendTypeDesc"></td>
                    <td class="center">
                      <label>
                        <input class="ace ace-switch ace-switch-6" type="checkbox"
                               ng-disabled="!$root.hasPermission('wx-msg-tpl/set-state')"
                               ng-model="list.state" my-check-box
                               ng-click="changeChoose(list, $index)" ng-disabled="list.deleted == 2">
                        <span class="lbl"></span> </label>
                    </td>
                    <td class="center">
                      <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                        <a class="blue pointer" title="编辑"  ng-show="list.deleted == 1"
                           ng-if="$root.hasPermission('wx-msg-tpl/update-msg')"
                           ng-href="/wx-msg-tpl/detail?id={{list.id}}&type_id={{list.type_id}}">编辑</a>
                         <!-- <i class="icon-bianji bigger-130" ng-click="do_thing(list)"></i>-->
                      </div>
                    </td>
                  </tr>
                  <tr ng-cloak ng-show="!lists.length || !lists" class="center red">
                    <td colspan="5"> 暂时没有可显示的数据</td>
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
</div>

<script>
  app.controller("mainController", function ($scope, $timeout, $rootScope, $http, $filter) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ag');
    }, 100);
    $scope.page = {};
    getData(1);
    function getData(int) {
      $http.post(wsh.url + "get-msg-list-ajax", {"_page": int, "_page_size": 15, "to_user": 1,"module": 1})
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            msg.errmsg.data.forEach(function (obj) {
              var desc = '';
              switch (obj.send_type) {
                case '1':
                  if(obj.send_by_sms == 1){
                    desc = '微商户/短信';
                  }else {
                    desc = '微商户';
                  }
                  break;
                case '2':
                  if(obj.send_by_sms == 1){
                    desc = '微信/短信';
                  }else {
                    desc = '微信';
                  }
                  break;
                case '0':
                  if(obj.send_by_sms == 1){
                    desc = '短信';
                  }else {
                    desc = '未设置发送方式';
                  }
                  break;
              }
              obj.sendTypeDesc = desc;
            });

            $scope.lists = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
          });
        })
    }
   /* //点击链接
    $scope.modify = false;
    $scope.do_thing = function(list){
      if(list.state == 2) {
        $(".input.span").removeClass()
        return;
      }
      location.href = "/wx-msg-tpl/detail?id="+list.id+"&type_id="+list.type_id;
    }*/
    //分页
    $scope.options = {page: 'page', callback: getData};
    //启用  禁用
    $scope.changeChoose = function (list,index) {
     if(list.deleted == 2){
       return list.deleted = list.deleted == 1 ? 2 :1;
     }else {
       list.isdisabled = true;
       $http.post(wsh.url + 'set-state', {id: list.id, type_id: list.type_id, state: list.state})
         .success(function (msg) {
           console.log(msg);
           wsh.successback(msg, msg.errmsg.deleted == '1' ? '启用成功' : '禁用成功', false, '', function () {
             if (msg.errcode == 0) {
               list.isdisabled = false;
             } else {
               list.deleted = list.deleted == 1 ? 2 : 1;
             }
           })
          // window.location.href = ('/wx-msg-tpl/buyer-index');
         })
     }

    }

  });
</script>