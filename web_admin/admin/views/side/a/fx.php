<a class="menu-toggler" id="menu-toggler" href="#"> <span class="menu-text"></span></a>
<div class="sidebar sidebar-fixed" id="sidebar"> 
  <script type="text/javascript">
            try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
          </script> 
  <!-- #sidebar-shortcuts -->
	<ul class="nav nav-list" id="navList" ng-controller="leftController">
		<li ng-class="{true: 'open'}[$root.leftMenuIndex == $index]" ng-repeat="list in leftArray" id="{{list.id}}"> <a ng-click="clickMenu($index, $event, list)" ng-href="{{list.href}}" ng-class="{true: 'dropdown-toggle'}[list.child.length > 0]"> <i class="{{list.class}}"></i> <span class="menu-text" ng-bind="list.text"></span><b class="arrow icon-angle-down" ng-if="list.child.length"></b> </a>
			<ul ng-class="{true: 'submenu', false: 'submenu hide'}[list.isshow]" ng-if="list.child.length" style="display:block;">
				<li ng-repeat="childList in list.child track by $index"> <a href="{{childList.href}}" ng-bind="childList.text"> <i class="icon-double-angle-right"></i></a> </li>
			</ul>
		</li>
	</ul>
  <div class="sidebar-collapse" id="sidebar-collapse"> <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i> </div>
  <script>
	try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
	app.controller('leftController', function($scope, $rootScope){
        if(wsh.getHref("terminal_id")) {
            $scope.leftArray = [
                {href: '', text: '终端店信息', class: 'icon-home', isshow: true, child: [
                    {href: '/terminal/detail?terminal_id='+wsh.getHref("terminal_id"), text: '终端店信息'},
                    {href: '/order/list?terminal_id='+wsh.getHref("terminal_id"), text: '订单列表'},
                    {href: '/member/list?terminal_id='+wsh.getHref("terminal_id"), text: '客户列表'},
                    {href: '/fx/member-list?terminal_id='+wsh.getHref("terminal_id"), text: '推广管理'},
                    {href: '/staff/list?terminal_id='+wsh.getHref("terminal_id"), text: '员工列表'},
                    {href: '/terminal/write-off?terminal_id='+wsh.getHref("terminal_id"), text: '核销管理'},
                ]},
                {href: '', text: '数据统计', class: 'icon-home', isshow: true, child: [
                    {href: '/data/order-shop?terminal_id='+wsh.getHref("terminal_id"), text: '订单统计'},
                    {href: '/data/member-shop?terminal_id='+wsh.getHref("terminal_id"), text: '客户统计'},
                    {href: '/data/fx-shop?terminal_id='+wsh.getHref("terminal_id"), text: '推广统计'},
                ]},
            ];
        }else if(wsh.getHref("agent_id")){
            $scope.leftArray = [
                {href: '', text: '代理商信息', class: 'icon-reorder', isshow: true, child: [
                    {href: '/agent/detail?agent_id='+wsh.getHref("agent_id"), text: '代理商信息', class: 'icon-shopping-cart'},
                    {href: '/agent/list?agent_id='+wsh.getHref("agent_id"), text: '下级代理商', class: 'icon-shopping-cart'},
                ]},
                {href: '', text: '他的加盟店', class: 'icon-bar-chart', isshow: true, child: [
                    {href: '/terminal/list?agent_id='+wsh.getHref("agent_id"), text: '加盟店列表', class: 'icon-shopping-cart'},
                    {href: '/order/list?agent_id='+wsh.getHref("agent_id"), text: '订单列表', class: 'icon-shopping-cart'},
                    {href: '/member/list?agent_id='+wsh.getHref("agent_id"), text: '客户列表', class: 'icon-shopping-cart'},
                    {href: '/fx/member-list?agent_id='+wsh.getHref("agent_id"), text: '推广管理', class: 'icon-shopping-cart'},
                ]},
                {href: '', text: '数据统计', class: 'icon-bar-chart', isshow: true, child: [
                    {href: '/data/order-shop?agent_id='+wsh.getHref("agent_id"), text: '订单统计', class: 'icon-shopping-cart'},
                    {href: '/data/member-shop?agent_id='+wsh.getHref("agent_id"), text: '客户统计', class: 'icon-shopping-cart'},
                    {href: '/data/fx-shop?agent_id='+wsh.getHref("agent_id"), text: '推广统计', class: 'icon-shopping-cart'},
                ]},
            ];
        }else {
            $scope.leftArray = [
                {href: '/fx/setting', text: '推广设置', class: 'icon-line-chart', child: []},
                {href: '/fx/paysetting', text: '商家支付类型', class: 'icon-bar-chart', child: []},
                {href: '/fx/policy-list', text: '推广策略', class: 'icon-area-chart', child: []},
                // {href: '/fx/level-list', text: '推广员等级管理', class: 'icon-pie-chart', child: []},
                {href: '/fx/member-list', text: '推广员管理', class: 'icon-pie-chart', child: []},
                // {href: '/fx/product-list', text: '分销商品', class: 'icon-pie-chart', child: []},
                // {href: '/fx/member-product-list', text: '分销员商品', class: 'icon-pie-chart', child: []},
                {href: '/fx/order-list', text: '推广订单', class: 'icon-pie-chart', child: []},
                {href: '/fx/operation-log-list', text: '推广结算', class: 'icon-pie-chart', child: []},
            ];
        }
		$scope.clickMenu = function(index, eve, obj){
			$rootScope.leftMenuIndex = index;
			if(obj.child.length){
				obj.isshow = !obj.isshow;
			}
		};
		$scope.$on('leftMenuChange', function(e, index){
			$rootScope.leftMenuIndex = index;
			if($scope.leftArray[index].child.length){
				$scope.leftArray[index].isshow = !$scope.leftArray[index].isshow;
			}
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
