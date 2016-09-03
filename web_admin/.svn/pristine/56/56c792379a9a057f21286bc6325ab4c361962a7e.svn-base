<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '员工列表';
?>
<div class="main-container" id="main-container">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner"
       ng-controller="mainController"> <?php echo $this->render('@app/views/side/terminal.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }</script>
        <ul class="breadcrumb">
          <li>员工列表</li>
        </ul>
        <!-- .breadcrumb -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <div class="input-group float-right margin-bottom10 ">


              <div class="inline margin-left10" style="margin-right:-1px;">
                <label>姓名:</label>
              </div>

              <input class="min-width120 inline margin-left10" type="text">
              <span class="inline align-top"><a class="btn btn-xs btn-xs btn-primary margin_right1">
                  <i class="icon-search icon-on-right bigger-110"></i></a> </span>
            </div>
            <div class="tabbable">
              <div id="home" class="tab-pane active">
                <a href="#" data-toggle="modal" data-target="#query2"
                   class="btn btn-xs btn-primary">微信绑定</a>
                <a href="/terminal/staff-add" class="btn btn-xs btn-primary">添加员工</a>
                <!--                    <a target="_blank" href="-->
                <?php //echo SHOP_SITE ;?><!--"  class="btn btn-xs btn-primary">员工登录</a>-->
                <div class=" space-6"></div>

                <form class="form-horizontal" ro;e="form">
                  <table width="100%"
                         class="table table-striped table-bordered table-hover table-width">
                    <thead>
                    <tr>
                      <!--                          <th width="9%" class="text-center">员工工号</th>-->
                      <th width="9%" class="text-center">员工姓名</th>
                      <th width="9%" class="text-center">所属店铺</th>
                      <th width="21%" class="text-center">联系电话</th>
                      <!--                          <th width="13%" class="text-center">推广二维码</th>-->
                      <th width="13%" class="text-center">微信绑定</th>
                      <th width="16%" class="text-center">最后登录时间</th>
                      <th width="16%" class="text-center">状态</th>
                      <th width="19%" class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="list in lists">
                      <!--                           <td class="text-center">123</td>-->
                      <td class="text-center" ng-bind="list.real_name"></td>
                      <td class="text-center" ng-bind="list.shopSub.shopInfo.name">上海微商户</td>
                      <td class="text-center" ng-bind="list.mobile"></td>
                      <!--                          <td class="text-center"><a href="{{list.ewm_img}}"></a></td>-->
                      <td class="text-center" ng-bind="list.is_bind == 1 ? '已绑定' : '未绑定'">已绑定</td>
                      <td class="text-center"
                          ng-bind="list.modified * 1000 | date:'yyyy-MM-dd HH:mm:ss'"></td>
                      <td class="text-center"><label>
                          <input name="switch-field-1" class="ace ace-switch ace-switch-6"
                                 type="checkbox" my-check-box ng-model="list.deleted"
                                 ng-disabled="list.isdisable" ng-change="change($index)">
                          <span class="lbl"></span> </label></td>
                      <td class="text-center action-buttons">
                        <a href="{{'/terminal/staff-edit?id=' + list.id}}" class="blue pointer"
                           title="修改"><i class="icon-bianji bigger-130"></i></a>
                        <a class="red pointer" title="删除" ng-click="btnDelete(list.id)"><i
                            class="icon-shanchu bigger-130"></i></a>
                        <a class="success pointer ng-pristine ng-untouched ng-valid"
                           data-toggle="modal" data-target="#query" ng-click="getQrcode(list.id)"
                           title="查看"> <i class="icon-erweima bigger-130"></i> </a>
                        <a class="pointer" ng-click="btnDisable(list.id)" title="微信解绑"
                           ng-show="list.is_bind == 1"><i
                            class="icon-quanxiandongjie bigger-130"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="7" ng-show="!lists.length" class="red text-center">暂时没有可展示的数据
                      </td>
                    </tr>

                    </tbody>
                  </table>
                  <div ng-paginate options="options" page="page"></div>
                </form>
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
                <h4 class="modal-title">查看员工二维码</h4>
              </div>
              <div class="modal-body">
                <div class="bootbox-body">
                  <div class="center">
                    <img ng-src="{{$root.srcImg}}">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="bootbox modal fade in" id="query2" tabindex="-1" role="dialog" open-close-modal
             aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header"><a type="button" class="bootbox-close-button close"
                                           data-dismiss="modal">×</a>
                <h4 class="modal-title">查看绑定二维码</h4>
              </div>
              <div class="modal-body">
                <div class="bootbox-body">
                  <div class="center">
                    <img src="../qrcode/image?url=<?= getMobileSite() ?>/user/accredit"
                         width="380" height="380">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- /row -->
        <div id="modal-table" class="modal fade" tabindex="-1" open-close-modal>
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header no-padding">
                <div class="table-header"><a href="#" type="button" class="close"
                                             data-dismiss="modal" aria-hidden="true"> <span
                      class="white">&times;</span> </a> Results for "Latest Registered Domains
                </div>
              </div>
              <div class="modal-footer no-margin-top"><a href="#"
                                                         class="btn btn-sm btn-danger pull-left"
                                                         data-dismiss="modal"> <i
                    class="icon-remove"></i> Close </a>
                <ul class="pagination pull-right no-margin">
                  <li class="prev disabled"><a href="#"> <i class="icon-double-angle-left"></i> </a>
                  </li>
                  <li class="active"><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li class="next"><a href="#"> <i class="icon-double-angle-right"></i> </a></li>
                </ul>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- PAGE CONTENT ENDS -->
      </div>
    </div>
  </div>
</div>
<script>
  app.controller("mainController", function ($scope, $timeout, $rootScope, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 0);
    }, 100);
    var int = 1;
    $scope.wxAccount = JSON.parse('<?= addslashe(json_encode($wxAccount)); ?>');
    getData(int);
    function getData(int) {
      $http.post(wsh.url + 'staff-list-ajax', {'_page': int, '_page_size': 20})
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.lists = msg.errmsg.data;
            $scope.page = msg.errmsg.page;
          })
        })
    }

    $scope.change = function (index) {
      $scope.lists[index].isdisable = true;
      if ($scope.lists[index].deleted == 2) {
        $http.post(wsh.url + 'staff-close-ajax', {id: $scope.lists[index].id})
          .success(function (msg) {
            wsh.successback(msg, '禁用成功', false, function () {
              $scope.lists[index].isdisable = false;
            })
          })
      } else {
        $http.post(wsh.url + 'staff-open-ajax', {id: $scope.lists[index].id})
          .success(function (msg) {
            wsh.successback(msg, '启用成功', false, function () {
              $scope.lists[index].isdisable = false;
            })
          })
      }
    };

    //查看二维码
    $scope.getQrcode = function (id) {
      $http.post('/weixin/qrcode-detail-ajax', {"model": "staff", "model_id": id})
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $rootScope.srcImg = msg["errmsg"];
          })
        })
    }

    //解绑
    $scope.btnDisable = function (id) {
      $http.post(wsh.url + 'disable-staff-ajax', {id: id})
        .success(function (msg) {
          wsh.successback(msg, '解绑成功', true, function () {

          })
        })

    }
    //删除
    $scope.btnDelete = function (id) {
      wsh.setDialog('删除提示', '确实要删除此记录吗?', '/terminal/staff-del-ajax', {"id": id}, function () {
        getData(1);
        if (isgrid) $("#grid-pager").update({start: 1});
      }, '删除成功')
    }

    //分页
    $scope.options = {callback: getData};
  });
</script>
