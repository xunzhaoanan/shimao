<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '消息管理';
?>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner"> <?php echo $this->
    render('@app/views/side/weixin_setting.php');?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>消息管理</li>
        </ul>
        <!-- .breadcrumb -->
        <!-- #nav-search -->
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="space-4"></div>
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert"><i
                  class="ace-icon icon-times"></i></button>
              <p><strong class="font-size14"> <i class="ace-icon icon-bullhorn"></i> </strong>
                超过48小时未回复的消息将无法再回复消息给用户! </p>
            </div>
            <div class="space-10"></div>
            <div class="tabbable">
              <ul class="nav nav-tabs" id="myTab">
                <li ng-class="{'active': toggleIndex == 0}"><a
                    ng-if="hasPermission('weixin/message-list-ajax')" isshow="true"
                    ng-click="toggle(0)">所有消息</a></li>
                <li ng-class="{'active': toggleIndex == 1}"><a isshow="false" ng-click="toggle(1)">已收藏</a>
                </li>
                <!--    <li><a data-toggle="tab" href="#tui">导出信息<span class="badge badge-danger">2</span> </a></li> -->
              </ul>
              <div class="tab-content">
                <div class="tab-pane" style="display:block;" ng-show="toggleIndex == 0">
                  <div class="table-responsive clearfix">
                    <table class="table table-striped table-bordered table-hover no-margin ">
                      <thead class="">
                      <tr>
                        <th width="10%" class="text-center goods-bg">消息发送者</th>
                        <th width="30%" class="text-center">消息内容</th>
                        <th width="12%" class="text-center">发送时间</th>
                        <th width="12%" class="text-center">操作</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr ng-repeat="list in  listArray[0]">
                        <td class="text-center" ng-bind="list.to_user_name"></td>
                        <td class="text-center table-width" ng-bind="list.content"></td>
                        <td class="text-center"
                            ng-bind="list.created * 1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                        <td class="text-center">
                          <div class="action-buttons">
                            <a class="red pointer"
                               ng-if="hasPermission('weixin/message-like-close-ajax')"
                               ng-show="list.mark === 1 && list.is_reply === 2"
                               ng-click="closeLike(list.id, list)" data-rel="tooltip"
                               title="取消收藏"><i class="icon-shoucang bigger-130"></i></a>
                            <a class="grey pointer"
                               ng-if="hasPermission('weixin/message-like-open-ajax')"
                               ng-show="list.mark === 2 && list.is_reply === 2"
                               ng-click="openLike(list.id, list)" data-rel="tooltip"
                               title="收藏"><i class="icon-quxiaoguanzhu bigger-130"></i></a>
                            <a class="blue pointer"
                               ng-if="hasPermission('weixin/message-reply-ajax')"
                               ng-show="list.is_reply === 2 && list.can_reply === 1"
                               ng-click="reply($index, list)" data-toggle="modal"
                               data-target="#reply" data-rel="tooltip" title="回复"><i
                                class="icon-huifu bigger-130"></i></a>
                            <a class="green pointer" ng-show="list.is_reply === 2"
                               ng-click="look(list)" data-toggle="modal" data-target="#message"
                               data-rel="tooltip" title="查看对话"><i
                                class="icon-mingchengpaixu bigger-140"></i></a></div>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane" style="display:block;" ng-show="toggleIndex == 1">
                  <form class="form-horizontal">
                    <div class="table-responsive clearfix">
                      <table class="table table-striped table-bordered table-hover no-margin">
                        <thead>
                        <tr>
                          <th width="20%" class="text-center">消息发送者</th>
                          <th width="30%" class="text-center">消息内容</th>
                          <th width="30%" class="text-center">发送时间</th>
                          <th width="12%" class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="list in  listArray[1]">
                          <td class="text-center" ng-bind="list.to_user_name"></td>
                          <td class="text-center table-width" ng-bind="list.content"></td>
                          <td class="text-center"
                              ng-bind="list.created * 1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                          <td class="text-center">
                            <div class="action-buttons">
                              <a class="red pointer"
                                 ng-if="hasPermission('weixin/message-like-close-ajax')"
                                 ng-show="list.mark === 1 && list.is_reply === 2"
                                 ng-click="closeLike(list.id, list)" title="取消收藏"><i
                                  class="icon-shoucang bigger-130" data-rel="tooltip"></i></a>
                              <a class="green pointer"
                                 ng-if="hasPermission('weixin/message-like-open-ajax')"
                                 ng-show="list.mark === 2 && list.is_reply === 2"
                                 ng-click="openLike(list.id, list)" title="收藏"><i
                                  class="icon-quxiaoguanzhu bigger-130" data-rel="tooltip"></i></a>
                              <a class="blue pointer"
                                 ng-if="hasPermission('weixin/message-reply-ajax')"
                                 ng-show="list.is_reply === 2 && list.can_reply === 1"
                                 ng-click="reply($index, list)" data-toggle="modal"
                                 data-target="#reply" title="回复"><i class="icon-huifu bigger-130"
                                                                    data-rel="tooltip"></i></a>
                              <a class="green pointer" ng-click="look(list, $index)"
                                 data-toggle="modal" data-target="#message" title="查看对话"><i
                                  class="icon-mingchengpaixu bigger-140" data-rel="tooltip"></i></a>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td ng-show="!listArray[1].length" colspan="4" class="red text-center">
                            暂时没有可展示的数据
                          </td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </form>
                </div>
                <div ng-paginate options="options" page="page"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- /.col -->
    </div>
    <!-- /.main-container-inner -->
  </div>

  <div class="bootbox modal fade in" id="reply" tabindex="-1" role="dialog" open-close-modal
       aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog2">
      <div class="modal-content">
        <form>
          <div class="modal-header"><a type="button" class="bootbox-close-button close"
                                       data-dismiss="modal">×</a>
            <h4 class="modal-title">回复消息</h4>
          </div>
          <div class="modal-body">
            <div class="bootbox-body">
              <form class="bootbox-form">
                <div class="table-responsive clearfix">
                  <table class="table no-border no-margin table-width">
                    <tbody>
                    <tr>
                      <td class="width81 text-right no-border-top">回复内容：</td>
                      <td class="no-border-top"><textarea class="width100 height160"
                                                          id="textarea"></textarea></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <a class="btn btn-default pointer" data-dismiss="modal">取消</a>
            <a id="saveReply" ng-click="saveReply()" class="btn btn-primary pointer">确定</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="bootbox modal fade in" id="message" tabindex="-1" role="dialog" open-close-modal
       aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog2">
      <div class="modal-content">
        <form>
          <div class="modal-header"><a type="button" class="bootbox-close-button close"
                                       data-dismiss="modal">×</a>
            <h4 class="modal-title">消息</h4>
          </div>
          <div class="modal-body">
            <div class="bootbox-body">
              <form class="bootbox-form">
                <div class="table-responsive clearfix">
                  <table class="table table-striped table-bordered table-hover table-width">
                    <thead>
                    <tr>
                      <th width="8%">消息发送者</th>
                      <th width="20%">消息内容</th>
                      <th width="10%">发送时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="list in mamama">
                      <td ng-bind="list.to_user_name">1</td>
                      <td ng-bind="list.content">1</td>
                      <td ng-bind="list.created * 1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                    </tr>
                    </tbody>
                  </table>
                  <!-- 程序增加分页 -->
                  <div ng-paginate options="optionsSub" page="pageSub"></div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer"><a class="btn btn-primary pointer" data-dismiss="modal">确定</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  var intArray = [];//保存请求的分页数
  var pageArray = [];
  app.controller('mainController', function ($scope, $timeout, $rootScope) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'bd');
    }, 100);
    $scope.page = {};
    $scope.pageSub = {};
    //分页
    $scope.options = {page: 'page', callback: getData};//所有消息的分页
    $scope.optionsSub = {page: 'page', callback: getMessage};//查看对话的分页
    $scope.toggleIndex = 0;
    $scope.toggle = function (index) {
      $scope.toggleIndex = index;
      getData(1);
    };
    $scope.listArray = [];
    //获取数据
    function getData(int) {
      $.post('/weixin/message-list-ajax', {
        '_page': int,
        '_page_size': 15,
        'type': $scope.toggleIndex
      }, function (msg) {
        wsh.successback(msg, '', false, function () {
          $scope.page = msg.errmsg.page;
          if (!msg.errmsg.data.length) return $scope.empty = true, $scope.$apply();
          $scope.empty = false;
          $scope.listArray[$scope.toggleIndex] = msg.errmsg.data;
          $scope.$apply();
        });
      }, 'json');
    }

    getData(1);
    //右上侧搜索设置
    $scope.searchText = '';
    $scope.searchList = function () {
      $scope.searchText = '';
    };
    //取消收藏消息
    $scope.closeLike = function (id, obj) {
      $.post('/weixin/message-like-close-ajax', {'id': id}, function (msg) {
        wsh.successback(msg, '取消收藏成功', true, function () {
          obj.mark = obj.mark == 1 ? 2 : 1;
        });
      }, 'json');
    }
    //收藏消息
    $scope.openLike = function (id, obj) {
      $.post('/weixin/message-like-open-ajax', {'id': id}, function (msg) {
        wsh.successback(msg, '收藏成功', true, function () {
          obj.mark = obj.mark == 1 ? 2 : 1;
        });
      }, 'json');
    }
    //回复
    $scope.id = 0;
    $scope.reply = function (index, obj) {
      $scope.id = obj.user_id;
    };
    //确认回复
    $scope.saveReply = function () {
      var value = $('#textarea').val();
      if (!value) return alert('回复的消息不能为空');
      $('#saveReply').attr('disabled', 'disabled');
      $.post('/weixin/message-reply-ajax', {
        user_id: $scope.id,
        content: value
      }, function (msg) {
        $('#saveReply').removeAttr('disabled');
        wsh.successback(msg, '回复成功', false, function () {
          $('#reply').modal('toggle');
          $('#textarea').val('');
        });
      }, 'json');
    };
    //查看对话的对话框
    $scope.obj = {};
    $scope.index = 0;
    $scope.look = function (obj, index) {
      $scope.obj = obj;
      $scope.index = index;
      intArray[index] = intArray[index] ? intArray[index] : 1;
      getMessage(1);
    };
    function getMessage(int) {
      $.post('/weixin/message-list-ajax', {
        'user_id': $scope.obj.user_id,
        '_page': int,
        '_page_size': 10,
        'is_reply': true
      }, function (msg) {
        wsh.successback(msg, '', false, function () {
          $scope.mamama = msg.errmsg.data;
          $scope.pageSub = msg.errmsg.page;
        });
      }, 'json');
    }

    $('#message').bind('shown.bs.modal', function () {

    });
    $('#message').bind('hidden.bs.modal', function () {
    });


  });
  //加星
  $(".mark").click(function () {

    var msg = $(this).html();
    if (msg == '收藏') {
      msg = '取消收藏';
      $(this).html(msg)
    } else {
      msg = '收藏';
      $(this).html(msg)
    }

  });
</script> 
