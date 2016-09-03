<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '终端店管理';
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
          <li>终端店列表</li>
        </ul>
        <!-- .breadcrumb -->
        <!-- #nav-search -->
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="tabbable">
              <div class="tab-content">
                <div class="row">
                  <div class="col-xs-12">
                    <div class=" float-left no-padding">
                      <a ng-if="$root.hasPermission('terminal/add-ajax')"
                         ng-href="{{'/terminal/add' + $root.getSearchUrl}}"
                         class="btn btn-xs btn-primary">添加</a>
                    </div>
                    <!--操作栏-->
                    <div class="float-left margin-left10 no-padding">
                      <div class="col-sm-7 no-padding">
                        <ul class="listli left-space1 btn-primary bune">
                          <li class="dropdown">
                            <a
                              ng-if="$root.hasPermission('wx-shop/sync-shop-from-wx') ||$root.hasPermission('wx-shop/batch-sync-shop-to-wx') || $root.hasPermission('wx-shop/batch-sync-shop-status')"
                              data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary">
                              微信门店操作&nbsp&nbsp <i class="icon-caret-down bigger-110 width-auto"></i>
                            </a>
                            <ul
                              class="pull-left dropdown-menu dropdown-yellow dropdown-caret dropdown-close"
                              style="cursor:pointer;">
                              <li ng-repeat="list in handleAll">
                                <a ng-bind="list.name" ng-click="handClick(list)"></a>
                              </li>
                            </ul>
                          </li>
                          <!--<li><a class="btn btn-xs btn-primary">更新收货状态</a></li>-->
                        </ul>
                      </div>
                    </div>
                    <a href="http://<?= SHOP_HOST ?>/login/index" target="_blank"
                       class="btn btn-xs btn-primary margin-left10">终端店登录</a>
                    <!--/操作栏-->
                    <div class="inline float-right margin-bottom10 margin-left10">
                      <input class="min-width120 float-left" placeholder="终端店名称搜索" type="text"
                             ng-model="name">
                                        <span class="float-left " ng-click="normalSearch()">
                                            <a class="btn btn-xs btn-primary"><i
                                                class="icon-search icon-on-right bigger-110"></i></a>
                                        </span>
                    </div>
                    <span province-search></span>
                    <!--   <div class="inline float-right margin-left10" style="margin-right:-1px;">
                         <select>
                           <option value="" selected=""> 请选择地区</option>
                         </select>
                      </div>
                      <div class="inline float-right margin-left10" style="margin-right:-1px;">
                         <select>
                           <option value="" selected=""> 请选择城市</option>
                         </select>
                      </div>
                     <div class="inline float-right" style="margin-right:-1px;">
                       <select id="form-field-select-1">
                         <option value="" selected="">请选省份</option>
                       </select>
                      </div> -->
                    <!--      <div class="input-group float-right margin-right10 margin-bottom10">
                           <input class="min-width120 float-left"  type="text">
                         </div>
                          <div class="float-right  margin-right10" style="margin-right:-1px;">
                           <label>终端店名称:</label>
                         </div> -->
                  </div>

                </div>
                <div class=" space-6"></div>
                <div class="row">
                  <div class="col-xs-12">
                    <form class="form-horizontal">
                      <table width="100%"
                             class="table table-striped table-bordered table-hover table-width action-buttons">
                        <thead>
                        <tr>
                          <th width="14%" class="text-center">终端店名称</th>
                          <th width="14%" class="text-center">终端店分类</th>
                          <th width="16%" class="text-center">地址</th>
                          <th width="16%" class="text-center">联系电话</th>
                          <th width="19%" class="text-center">终端店二维码</th>
                          <th width="14%" class="text-center hide">兑换密码</th>
                          <th width="14%" class="text-center">状态</th>
                          <th width="16%" class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="list in terminallists">
                          <td class="text-center" ng-bind="list.shopInfo.name">智慧门店2</td>
                          <td class="text-center" ng-show="list.shop_type == 1">直营店</td>
                          <td class="text-center" ng-show="list.shop_type == 2">加盟店</td>
                          <td class="text-center" ng-bind="list.shopInfo.address">上海上海闸北区其他商圈</td>
                          <td class="text-center" ng-bind="list.shopInfo.phone">021-60490259</td>
                          <td class="text-center">
                            <a ng-show="list.shopInfo.ewm_img" target="_blank"
                               href="{{list.shopInfo.ewm_img}}">
                              <img ng-src="{{list.shopInfo.ewm_img}}" width="30" height="30">
                            </a>
                            <a ng-show="!list.shopInfo.ewm_img" href="javascript:void(0);"
                               id="createQrcodeBtn"
                               ng-click="createQrcode(list.shopInfo.shop_sub_id)">点击生成</a>
                          </td>
                          <td class="text-center hide">36</td>
                          <td class="text-center">
                            {{showStatus(list, $index)}}
                            <img ng-show="list.shopInfo.available_status == 4 ||
                                                     (list.shopInfo.available_status == 3 && list.shopInfo.update_status == 3)"
                                 src="http://imgcache.vikduo.com/static/db358ebbdfdfa08455415509d75b9d92.png"
                                 title="{{list.shopInfo.fail_msg}}"/>
                          </td>
                          <td class="text-center">
                            <a ng-if="$root.hasPermission('terminal/edit')" class="blue pointer"
                               title="编辑" ng-click="update(list)">
                              <i class="icon-bianji bigger-130"></i>
                            </a>
                            <a ng-if="$root.hasPermission('terminal/detail')" title="查看"
                               target="_blank" ng-href="/terminal/detail?terminal_id={{list.id}}"
                               class="success">
                              <i class="icon-mingchengpaixu bigger-140 text-decoration"></i>
                            </a>
                            <a ng-if="$root.hasPermission('wx-shop/sync-shop-to-wx')" title="同步微信"
                               ng-click="handClick(null, list)" class="success">
                              <i class="icon-refresh bigger-130 text-decoration"></i>
                            </a>
                          </td>
                        </tr>
                        </tbody>
                      </table>
                    </form>
                  </div>
                </div>
                <div ng-show="empty" class="text-center red">暂时没有可显示的数据</div>
                <div ng-paginate options="options" page="page"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="/ace/js/provinceSearch.js"></script>
<script type="text/javascript">
  app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ha');
    }, 100);
    $rootScope.getSearchUrl;
    $scope.toggleIndex = 0;//tab 的切换
    $scope.agent_id = wsh.getHref("agent_id");
    $rootScope.editObj = [];
var name='';

    $rootScope.edit = function (obj) {
      $rootScope.editObj = angular.copy(obj);
    }

    $rootScope.editSave = function () {
      $.post('/terminal/agent-edit-ajax', $rootScope.editObj, function (msg) {
        wsh.successback(msg, '修改成功', false, function () {
          getData(parseInt($scope.page.current_page) + 1);
          $('#myModalEdit').modal('hide');
        });
      }, 'json');
    }

    //微信门店操作
    $scope.handleAll = [
      {id: 1, name: '拉取微信门店'},
      {id: 2, name: '批量同步至微信'},
      {id: 3, name: '同步状态'}
    ];
    var is_ajax_from, is_ajax_batch_to, is_ajax_scny_status, is_ajax_to = [];
    //微信门店操作
    $scope.handClick = function (list, obj) {
      var postObj = {'title': '微信门店同步提示', 'data': {}};
      var eventId;

      if (list && list.id) {
        switch (list.id) {
          case 1: //拉取微信门店
            postObj.content = '此操作可能将耗费您一些时间，您确定要将微信平台门店同步到本系统吗?',
              postObj.url = '/wx-shop/sync-shop-from-wx';
            postObj.text = '拉取门店成功';
            if (is_ajax_from) {
              return false;
            }
            eventId = 1;
            is_ajax_from = true;
            break;
          case 2: //批量同步至微信
            postObj.content = '确定将未同步的门店批量同步至微信,同步后门店名称将无法更改?',
              postObj.url = '/wx-shop/batch-sync-shop-to-wx',
              postObj.text = '同步成功';
            if (is_ajax_from) {
              return false;
            }
            eventId = 2;
            is_ajax_batch_to = true;
            break;
          case 3: //同步微信审核状态
            postObj.content = '此操作将本系统处于审核中的门店与微信平台门店进行状态同步处理，确定进行此操作？',
              postObj.url = '/wx-shop/batch-sync-shop-status';
            postObj.text = '同步状态成功';
            if (is_ajax_scny_status) {
              return false;
            }
            eventId = 3;
            is_ajax_scny_status = true;
            break;
          default :
            break;
        }
      } else {
        if (obj.status) {
          alert('该门店处于审核状态中，审核结束后方可再次进行同步操作。');
          return true;
        }
        postObj.data = {"id": obj.id},
          postObj.content = '同步后将在5个工作日内给出审核结果，在此期间无法进行修改，同步后门店名称将无法更改，确认要同步？',
          postObj.url = '/wx-shop/sync-shop-to-wx';
        postObj.text = '同步成功';

        if (is_ajax_to[obj.id]) {
          return true;
        }
        eventId = 4;
        is_ajax_to[obj.id] = true;
      }

      var id = obj ? obj.id : null;
      wsh.setDialog(postObj.title, postObj.content, postObj.url, postObj.data, function () {
        getData(parseInt($scope.page.current_page) + 1);
        setIsAjax(eventId, id);
      }, postObj.text, function () {
        setIsAjax(eventId, id);
      }, function () {
        setIsAjax(eventId, id);
      });
    }

    //设置按钮可点状态
    function setIsAjax(eventId, id) {
      switch (eventId) {
        case 1:
          is_ajax_from = false;
          break;
        case 2:
          is_ajax_batch_to = false;
          break;
        case 3:
          is_ajax_scny_status = false;
          break;
        case 4:
          is_ajax_to[id] = false;
          break;
      }
    }

    $rootScope.btnConfirm = function () {
      $.post('/terminal/agent-add-ajax', $rootScope.model, function (msg) {
        wsh.successback(msg, '添加成功', false, function () {
          getData(1);
          $('#myModal').modal('hide');
        });
      }, 'json');
    }
    $rootScope.deleted = function (id) {
      wsh.setDialog('删除提示', '是否删除？', wsh.url + 'del-ajax', {id: id}, function () {
        getData(1)
      }, '删除成功');
    }
    $scope.update = function (list) {
      if (list.status) {
        alert('该门店处于审核状态中，无法修改信息。');
        return true;
      }
      var ext_url = $scope.agent_id ? '&agent_id=' + $scope.agent_id : '';
      window.location.href = '/terminal/edit?id=' + list.id + ext_url;
    }
    //同步状态
    $scope.showStatus = function (list, index) {
      var statusTxt;
      switch (list.shopInfo.available_status) {
        case 1:
          statusTxt = '未同步';
          break;
        case 2:
          $scope.terminallists[index].status = 1;
          statusTxt = '创建门店中';
          break;
        case 4:
          statusTxt = '创建失败';
          break;
        default:
          switch (list.shopInfo.update_status) {
            case 1:
              $scope.terminallists[index].status = 1;
              statusTxt = '修改审核中';
              break;
            case 3:
              statusTxt = '修改未通过';
              break;
            default:
              statusTxt = '正常使用';
              break;
          }
          break;
      }
      return statusTxt;
    }
    getData(1);

    function getData(int) {
      $http.post(wsh.url + 'list-ajax', {
        "_page": int,
        "_page_size": 10,
        "province_id": $scope.province,
        "city_id": $scope.city,
        "district_id": $scope.district,
        "name": name,
        //"shop_type": 1,
        "is_search": true
      })
        .success(
        function (msg) {
          wsh.successback(msg, "", false, function () {
            $scope.terminallists = msg.errmsg.data;
            console.log(msg.errmsg.data);
            $.each($scope.terminallists, function (i, e) {
              e.ischoose = e.deleted == 1 ? true : false;
              e.isdisabled = false;
            });
            console.log(msg);
            $scope.page = msg.errmsg.page;
          });
        });
    }

    //老版迁移商户店铺没有生成推广二维码需用户点击生成
    $scope.createQrcode = function (shop_sub_id) {
      $('#createQrcodeBtn').attr('disabled', 'disabled');
      $http.post(wsh.url + 'create-terminal-qrcode', {"shop_sub_id": shop_sub_id})
        .success(function (msg) {
          wsh.successback(msg, "生成电商推广二维码成功", false, function () {
            $('#createQrcodeBtn').removeAttr('disabled');
            location.reload();
          });
        })
        .error(function (msg) {
          $('#createQrcodeBtn').removeAttr('disabled');
        });
    };

    $scope.normalSearch = function () {
      name=$scope.name;
      getData(1);
    };


    //分页
    $scope.options = {callback: getData};


  });
</script>