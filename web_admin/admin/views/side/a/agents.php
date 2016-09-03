<?php
use common\cache\Session;
?>
<a class="menu-toggler" id="menu-toggler" href="#"> <span class="menu-text"></span></a>
<div class="sidebar sidebar-fixed" id="sidebar">
  <script type="text/javascript">
            try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
          </script>
  <!-- #sidebar-shortcuts -->
	<ul class="nav nav-list" id="navList" ng-controller="leftController">
		<li ng-class="{true: 'open'}[$root.leftMenuIndex == $index]" ng-repeat="list in leftArray" pid="{{list.id}}"> <a ng-click="clickMenu($index, $event, list)" ng-href="{{list.href}}" ng-class="{true: 'dropdown-toggle'}[list.child.length > 0]"> <i class="{{list.class}}"></i> <span class="menu-text" ng-bind="list.text"></span><b class="arrow icon-angle-down" ng-if="list.child.length"></b> </a>
			<ul ng-class="{true: 'submenu', false: 'submenu hide'}[list.isshow]" ng-if="list.child.length" style="display:block;">
				<li ng-repeat="childList in list.child track by $index"> <a href="{{childList.href}}" ng-bind="childList.text"> <i class="icon-double-angle-right"></i></a> </li>
			</ul>
		</li>
	</ul>
  <div class="sidebar-collapse" id="sidebar-collapse"> <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i> </div>
  <script>
	try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
	app.controller('leftController', function($scope, $rootScope, $http){
        if(wsh.getHref("agent_id")){
            $scope.leftArray = [
                <?php
if(isset(Session::get(Session::SESSION_KEY_MENU)['agent_manage'])) echo "{href: '', text: '代理商信息', class: 'icon-reorder', isshow: true, child: [ ";
if(isset(Session::get(Session::SESSION_KEY_MENU)['/agent/detail'])) echo "{href: '/agent/detail?agent_id='+wsh.getHref(\"agent_id\"), text: '代理商信息', class: 'icon-shopping-cart'},";
if(isset(Session::get(Session::SESSION_KEY_MENU)['agent_manage'])) echo "]},";
                if(isset(Session::get(Session::SESSION_KEY_MENU)['shop_manage'])) echo "{href: '', text: '他的加盟店', class: 'icon-bar-chart', isshow: true, child: [";
                    if(isset(Session::get(Session::SESSION_KEY_MENU)['shop_manage'])) echo "{href: '/terminal/list?agent_id='+wsh.getHref(\"agent_id\"), text: '加盟店列表', class: 'icon-shopping-cart'},";
                    if(isset(Session::get(Session::SESSION_KEY_MENU)['shop_manage'])) echo "{href: '/order/list?agent_id='+wsh.getHref(\"agent_id\"), text: '订单列表', class: 'icon-shopping-cart'},";
                    if(isset(Session::get(Session::SESSION_KEY_MENU)['shop_manage'])) echo "{href: '/member/list?agent_id='+wsh.getHref(\"agent_id\"), text: '客户列表', class: 'icon-shopping-cart'},";
                    if(isset(Session::get(Session::SESSION_KEY_MENU)['shop_manage'])) echo "{href: '/fx/member-list?agent_id='+wsh.getHref(\"agent_id\"), text: '推广管理', class: 'icon-shopping-cart'},";
                if(isset(Session::get(Session::SESSION_KEY_MENU)['shop_manage'])) echo "]},";
                if(isset(Session::get(Session::SESSION_KEY_MENU)['shop_manage'])) echo "{href: '', text: '数据统计', class: 'icon-bar-chart', isshow: true, child: [";
                    if(isset(Session::get(Session::SESSION_KEY_MENU)['shop_manage'])) echo "{href: '/agent/order-shop?agent_id='+wsh.getHref(\"agent_id\"), text: '订单统计', class: 'icon-shopping-cart'},";
                    if(isset(Session::get(Session::SESSION_KEY_MENU)['shop_manage'])) echo "{href: '/agent/member-shop?agent_id='+wsh.getHref(\"agent_id\"), text: '客户统计', class: 'icon-shopping-cart'},";
                    if(isset(Session::get(Session::SESSION_KEY_MENU)['shop_manage'])) echo "{href: '/agent/fx-shop?agent_id='+wsh.getHref(\"agent_id\"), text: '推广统计', class: 'icon-shopping-cart'},";
                if(isset(Session::get(Session::SESSION_KEY_MENU)['shop_manage'])) echo "]},";
                ?>
            ];
            //代理商级别小于3则显示下级代理商
            $scope.$watch('$root.agentInfo', function(a){
                if(a && a.level < 3){
                    $scope.leftArray[0].child.push({href: '/agent/list?agent_id='+wsh.getHref("agent_id"), text: '下级代理商', class: 'icon-shopping-cart'})
                }
            })
        }else {
            $scope.leftArray = [
                {
                    href: '', text: '下级代理商', class: 'icon-reorder', isshow: true, child: [
                    {href: '/agent/list', text: '代理商列表', class: 'icon-shopping-cart'},
                ]
                },
            ];
        }

		$scope.clickMenu = function(index, eve, obj){
			$rootScope.leftMenuIndex = index;
			if(obj.child.length){
				obj.isshow = !obj.isshow;
			}
		};
		$rootScope.$on('leftMenuChange', function(e, id){
            var ids = [];
            $.each($('#navList >li'), function(i, e){
              if(id == $(e).attr('pid')){
                $rootScope.leftMenuIndex = i;
                if($scope.leftArray[i].child.length){
                  $scope.leftArray[i].isshow = true;
                }
              }
            })
          });
		$('#sidebar-collapse').click(function(e){
			$('#sidebar').toggleClass('menu-min');
			if($(this).find('i').is('.icon-double-angle-right')){
				$(this).find('i').get(0).className = 'icon-double-angle-left';
			}else{
				$(this).find('i').get(0).className = 'icon-double-angle-right';
			}
		});
	});
  </script>
</div>
