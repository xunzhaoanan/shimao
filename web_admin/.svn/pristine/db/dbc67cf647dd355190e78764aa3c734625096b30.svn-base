<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '微商户开发者工具';
?>
<style>

    .grey{color:#d1d1d1;}
</style>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
    <script type="text/javascript">try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {}</script>

    <div class="main-container-inner">
        <?php
        echo $this -> render('@app/views/side/manage_setting.php');
        ?>
        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">try {
                        ace.settings.check('breadcrumbs', 'fixed')
                    } catch (e) {}</script>
                <ul class="breadcrumb">
                    <li>
                        微商户开发者工具
                    </li>
                </ul>
                <!-- .breadcrumb -->
                <!-- #nav-search -->
            </div>
            <div class="page-content">
                <!-- /.page-header -->
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="container_fluid CardVoucher">
                            <div class="cont_title">
                                <h3 class="margin-bottom20">微商户开发者工具  </h3>
                            </div>
                            <ul style="font-size: 16px; list-style: circle;">
                                <li style="list-style: initial;">开通服务后可以查看API文档，调用相关的接口。</li>
                                <li style="list-style: initial;">商家可以通过微商户开放的API接口，进行数据对接。</li>
                                <li style="list-style: initial;">当前微商户支持调用的接口包括商品接口、订单接口、粉丝接口</li>
                            </ul>
                            <div class="space-6"></div>
                            <div class="alert alert-block alert-info margin-left22" ng-show="isOpen" style="width: 450px; color: #333">
                                <p>使用AppID与AppSecret进行微商户接口的调用</p>
                                <p><span class="inline width101">AppID </span> <span ng-bind="model.data.app_id">wx474bb9c1bf651a26</span></p>
                                <p><span class="inline width101">AppSecret</span>  <span ng-bind="model.data.app_secret">wx474bb9c1bf651a26wx474bb9c1bf651a26</span></p>
                            </div>

                            <div class="space-6"></div>
                            <div ng-hide="isOpen">
                                <button class="btn btn-primary margin-left22" ng-if="$root.hasPermission('shop/open-developer-tool-ajax')" ng-click="openDeveloper()">开启开发者工具</button>
                            </div>
                            <div class="margin-left20 margin-top10" ng-show="isOpen">
                                <p class="font-size14px margin-bottom20">微商户开发者功能已开启，您可以使用以下服务:</p>
                                <a class="inline developer_hover" ng-href="{{model.doc_url}}" target="view_window"><i class="icon-file-text-o"  ></i><span class="text" >开发者文档</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PAGE CONTENT BEGINS -->
                <!-- /.page-header -->
            </div>
        </div>
    </div>
</div>


</div>


<script>
    app.controller("mainController", function($scope, $timeout, $rootScope,$http) {
        $timeout(function(){$rootScope.$broadcast('leftMenuChange', 'ah');}, 100);
        $scope.model = JSON.parse('<?= addslashe(json_encode($model)); ?>');
        $scope.isOpen = $scope.model.data != 'null';
        $scope.openDeveloper = function () {
            $http.post("/shop/open-developer-tool-ajax", {})
                .success(function (msg) {
                    wsh.successback(msg, '开启成功', true, function () {
                    });
                })
                .error(function () {
                    alert('网络异常');
                });
        }
    })
</script>