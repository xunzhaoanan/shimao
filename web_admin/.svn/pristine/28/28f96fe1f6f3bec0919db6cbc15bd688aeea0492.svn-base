<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '商家信息';
?>

<div class="main-container" id="main-container" ng-cloak>
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>
    <div class="main-container-inner">
        <?php echo $this->render('@app/views/side/manage_setting.php'); ?>
        <div class="main-content" ng-controller="mainController">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try {
                        ace.settings.check('breadcrumbs', 'fixed')
                    } catch (e) {
                    }
                </script>
                <ul class="breadcrumb">
                    <li>商家信息</li>
                </ul>
                <!-- .breadcrumb -->
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="tabbable">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a data-toggle="tab" href="#home">商家信息设置</a></li>
                                <li class="hide"><a data-toggle="tab" href="#jifen">操作日志</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="home" class="tab-pane in active">
                                    <form class="form-horizontal ng-pristine ng-valid">
                                        <div class="space-6"></div>
                                        <div class="form-group clearfix">
                                            <label class="col-sm-2 width120 control-label" for="form-field-1"><strong>商家名称:</strong></label>

                                            <div class="col-sm-9">
                                                <!--<input type="text" class="col-sm-5 margin-right10 clearfix" placeholder="社会化电子商务平台">-->
                                                <p class="form-control-static" for="form-field-1" ng-bind="lists.name">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <label class="col-sm-2 width120 control-label" for="form-field-1"><strong>商家logo:</strong></label>

                                            <div class="col-sm-8 margin-bottom10">
                                                <img ng-src="{{lists.logo}}" width="100"/>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <label class="col-sm-2 width120 control-label" for="form-field-1"><strong>联系电话:</strong></label>

                                            <div class="col-sm-8">
                                                <p class="form-control-static" ng-bind="lists.tel">
                                                </p>
                                            </div>
                                        </div>

                                        <div class="form-group clearfix hide">
                                            <label class="col-sm-2 width120 control-label" for="form-field-1"><strong>商家网址:</strong></label>

                                            <div class="col-sm-8">
                                                <p class="form-control-static">
                                                    <a ng-href="{{lists.website}}" ng-bind="lists.website"
                                                       target="_blank"></a>
                                                </p>
                                            </div>
                                        </div>


                                        <div class="form-group clearfix">
                                            <label class="col-sm-2 width120 control-label"><strong>商家微信号:</strong></label>

                                            <div class="col-sm-8">
                                                <label class="form-control-static" ng-bind="wxInfo.account">
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group clearfix">
                                            <label class="col-sm-2 width120 control-label" for="form-field-1"><strong>微信二维码:</strong></label>

                                            <div class="col-sm-8 margin-bottom10">
                                                <img ng-src="{{qrcode}}" width="100"/>
                                            </div>
                                        </div>

                                        <div class="form-group clearfix">
                                            <label class="col-sm-2 width120 control-label"><strong>在线商城:</strong></label>

                                            <div class="col-sm-8">
                                                <a class="block form-control-static blue dropdown-toggle align-middle"
                                                   href="<?= getMobileSite() . '/mall/index'; ?>" target="_blank">
                                                    点击预览
                                                </a>
                                            </div>
                                        </div>
                                        <!--<div class="form-group margin-bottom10 clearfix">
                                            <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>商城URL:</strong></label>
                                            <div class="col-sm-9">
                                                <label class="width100 float-left text-left margin-right10 clearfix" for="form-field-1" >
                                                <a href="<?= getMobileSite() . '/mall/index' ?>" target="_blank"><?= getMobileSite() . '/mall/index' ?></a>
                                                </label>
                                            </div>
                                        </div>-->

                                        <!--   <div class="form-group margin-bottom10 clearfix">
                                              <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>官网背景:</strong></label>
                                              <div class="col-sm-9">
                                                  <img ng-src="{{lists.bg_img}}" width="100" />
                                              </div>
                                          </div> -->
                                        <div class="form-group clearfix">
                                            <label class="col-sm-2 width120 control-label" for="form-field-1"><strong>商家描述:</strong></label>

                                            <div class="col-sm-10">
                                                <label class="form-control-static" ng-bind="lists.desc"
                                                       style="word-break: break-all;">
                                                </label>
                                            </div>
                                        </div>
                                        <!--    <div class="form-group margin-bottom10 clearfix">
                                               <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>详细地址:</strong></label>
                                               <div class="col-sm-9">
                                                   <label class="width100 float-left text-left margin-right10 clearfix" for="form-field-1" ng-bind="lists.addr">
                                                   </label>
                                               </div>
                                           </div> -->
                                        <div class="form-group clearfix">
                                            <label class="col-sm-2 width120 control-label" for="form-field-1"></label>

                                            <div class="col-sm-8">
                                                <a ng-if="$root.hasPermission('shop/edit')"
                                                   href="<?= Url::to(['/shop/edit']) ?>" class="btn btn-primary"> <i
                                                      class="icon-ok bigger-110"></i> 修改信息 </a>
                                                <!-- <a href="<?= Url::to(['/terminal/list']) ?>" class="btn btn-primary" style="margin-left:50px;"> <i class="icon-ok bigger-110"></i> 终端店管理 </a>  -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="jifen" class="tab-pane">
                                    <form class="form-horizontal ng-pristine ng-valid">
                                        <table width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th width="166" class="width150">操作时间</th>
                                                <th width="100">操作类型</th>
                                                <th width="200">操作人</th>
                                                <th width="752">操作详情</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="width150">2015-05-15 15:40:44</td>
                                                <td>基础数据</td>
                                                <td></td>
                                                <td>编辑商店信息</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="grid-pager">
                                            <ul class="pagination">
                                                <li class="prev disabled"><a><i class="icon-chevron-left"></i></a></li>
                                                <li class="active"><a>1</a></li>
                                                <li><a>2</a></li>
                                                <li><a>3</a></li>
                                                <li><a>…</a></li>
                                                <li><a>21</a></li>
                                                <li><a>22</a></li>
                                                <li><a>23</a></li>
                                                <li class="next"><a><i class="icon-chevron-right"></i></a></li>
                                                <li class="grid-pager-go"> <span>
                          <input type="text" class="ui-pg-input " size="2" maxlength="7"
                                 placeholder="5" role="textbox">
                          </span> <a class="btn btn-sm btn-primary ">页/跳转</a></li>
                                            </ul>
                                        </div>
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
</div>
<script type="text/javascript">
    app.controller('mainController', function ($scope, $rootScope, $timeout, $http) {
        $timeout(function () {
            $rootScope.$broadcast('leftMenuChange', 'aa');
        }, 100);
        $scope.model = JSON.parse('<?= addslashe(json_encode($data)); ?>');
        $scope.lists = $scope.model.shop;
        $scope.wxInfo = $scope.model.wxInfo;
        $scope.qrcode = $scope.model.qrcode;
        console.log('22222', $scope.qrcode)
        console.log("asfa0", $scope.model);
        console.log("wxInfo", $scope.wxInfo);
    });
    //    $('#updatePwd').click(function(){
    //        var oldPwd = $('#oldPwd').val();
    //        var newPwd = $('#newPwd').val();
    //
    //        if(!oldPwd){
    //            alert('请输入旧密码');
    //            $('#oldPwd').focus();
    //            return false;
    //        }
    //        if(!newPwd){
    //            alert('请输入新密码');
    //            $('#newPwd').focus();
    //            return false;
    //        }
    //        updatePwd(oldPwd,newPwd);
    //    })
    //
    //    function updatePwd(oldPwd,newPwd){
    //        $.ajax({
    //            url: '/mall/staff-edit-pwd-ajax',
    //            type: 'POST',
    //            dataType: 'json',
    //            data: {'oldPwd': oldPwd,'newPwd': newPwd},
    //            success:function(response){
    //                if(response.errcode == 0){
    //                    alert('修改成功');
    //                    location.href = location.href;
    //                }else{
    //                    alert(response.errmsg);
    //                }
    //            }
    //        });
    //    }
</script>
