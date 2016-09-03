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
	app.controller('leftController', function($scope, $rootScope){
        if(wsh.getHref("terminal_id")) {
            $scope.leftArray = [
                {href: '', text: '终端店信息', class: 'icon-home', isshow: true, child: [
                    {href: '/terminal/detail?terminal_id='+wsh.getHref("terminal_id"), text: '终端店信息'},
                    <?php
   if(isset(Session::get(Session::SESSION_KEY_MENU)['order_manage'])) echo "{href: '/order/list?terminal_id='+wsh.getHref(\"terminal_id\"), text: '订单列表'},";
   if(isset(Session::get(Session::SESSION_KEY_MENU)['member_manage'])) echo "{href: '/member/list?terminal_id='+wsh.getHref(\"terminal_id\"), text: '客户列表'},";
   if(isset(Session::get(Session::SESSION_KEY_MENU)['/fx/member-list'])) echo "{href: '/fx/member-list?terminal_id='+wsh.getHref(\"terminal_id\"), text: '推广管理'},";
   ?>
                    {href: '/staff/list?terminal_id='+wsh.getHref("terminal_id"), text: '员工列表'},
                    <?php
                    if(isset(Session::get(Session::SESSION_KEY_MENU)['cancel_manage'])) echo "{href: '/terminal/write-off?terminal_id='+wsh.getHref(\"terminal_id\"), text: '核销管理'},";
                    ?>
                ]},
                <?php
                            if(isset(Session::get(Session::SESSION_KEY_MENU)['terminaldata_manage'])) echo "{href: '', text: '数据统计', class: 'icon-dailishang newicon-font', isshow: true, child: [";
                            if(isset(Session::get(Session::SESSION_KEY_MENU)['/data/order-shop'])) echo "    {href: '/data/order-shop?terminal_id='+wsh.getHref(\"terminal_id\"), text: '订单统计', class: 'icon-line-chart', child: []},";
                            if(isset(Session::get(Session::SESSION_KEY_MENU)['/data/member-shop'])) echo "    {href: '/data/member-shop?terminal_id='+wsh.getHref(\"terminal_id\"), text: '客户统计', class: 'icon-pie-chart', child: []},";
                            if(isset(Session::get(Session::SESSION_KEY_MENU)['/data/fx-shop'])) echo "    {href: '/data/fx-shop?terminal_id='+wsh.getHref(\"terminal_id\"), text: '推广统计', class: 'icon-pie-chart', child: []},";
                            if(isset(Session::get(Session::SESSION_KEY_MENU)['terminaldata_manage'])) echo "]},";
                ?>
            ];
        }else if(wsh.getHref("agent_id")){
            $scope.leftArray = [
                {href: '', text: '代理商信息', class: 'icon-reorder', isshow: true, child: [
                    {href: '/agent/detail?agent_id='+wsh.getHref("agent_id"), text: '代理商信息', class: 'icon-shopping-cart'},
                    {href: '/agent/list?agent_id='+wsh.getHref("agent_id"), text: '下级代理商', class: 'icon-shopping-cart'},
                ]},
                {href: '', text: '他的加盟店', class: 'icon-bar-chart', isshow: true, child: [
                    <?php
if(isset(Session::get(Session::SESSION_KEY_MENU)['/terminal/list'])) echo "{href: '/terminal/list?agent_id='+wsh.getHref(\"agent_id\"), text: '加盟店列表', class: 'icon-shopping-cart'},";
if(isset(Session::get(Session::SESSION_KEY_MENU)['order_manage'])) echo "{href: '/order/list?agent_id='+wsh.getHref(\"agent_id\"), text: '订单列表'},";
if(isset(Session::get(Session::SESSION_KEY_MENU)['member_manage'])) echo "{href: '/member/list?agent_id='+wsh.getHref(\"agent_id\"), text: '客户列表'},";
if(isset(Session::get(Session::SESSION_KEY_MENU)['/fx/member-list'])) echo "{href: '/fx/member-list?agent_id='+wsh.getHref(\"agent_id\"), text: '推广管理'},";
                ?>
                ]},
                <?php
           if(isset(Session::get(Session::SESSION_KEY_MENU)['terminaldata_manage'])) echo "{href: '', text: '数据统计', class: 'icon-dailishang newicon-font', isshow: true, child: [";
           if(isset(Session::get(Session::SESSION_KEY_MENU)['/data/order-shop'])) echo "    {href: '/data/order-shop?agent_id='+wsh.getHref(\"agent_id\"), text: '订单统计', class: 'icon-line-chart', child: []},";
           if(isset(Session::get(Session::SESSION_KEY_MENU)['/data/member-shop'])) echo "    {href: '/data/member-shop?agent_id='+wsh.getHref(\"agent_id\"), text: '客户统计', class: 'icon-pie-chart', child: []},";
           if(isset(Session::get(Session::SESSION_KEY_MENU)['/data/fx-shop'])) echo "    {href: '/data/fx-shop?agent_id='+wsh.getHref(\"agent_id\"), text: '推广统计', class: 'icon-pie-chart', child: []},";
           if(isset(Session::get(Session::SESSION_KEY_MENU)['terminaldata_manage'])) echo "]},";
?>
            ];
        }else {
            $scope.leftArray = [
                <?php
            if(isset(Session::get(Session::SESSION_KEY_MENU)['order_manage'])) echo "{href: '/order/list', id: 'order_list', text: '全部订单', class: 'icon-dingdan newicon-font', isshow: true, child: []},";
             if(isset(Session::get(Session::SESSION_KEY_MENU)['orderrefund_manage'])) echo "   {href: '', id: 'order_refund_list', text: '售后处理', class: 'icon-shouhou newicon-font', isshow: true, child: [";
              if(isset(Session::get(Session::SESSION_KEY_MENU)['/order/refund-list'])) echo "      {href: '/order/refund-list', text: '退款订单', class: 'icon-shopping-cart'},";
             if(isset(Session::get(Session::SESSION_KEY_MENU)['orderrefund_manage'])) echo "   ]},";
             if(isset(Session::get(Session::SESSION_KEY_MENU)['shipping_manage'])) echo "   { href: '', id: 'order_shippingmode', text: '物流管理', class: 'icon-fahuo newicon-font', isshow: true, child: [";
             if(isset(Session::get(Session::SESSION_KEY_MENU)['/order/shippingmode'])) echo "       {href: '/order/shippingmode', text: '配送设置', class: 'icon-shopping-cart'},";
             if(isset(Session::get(Session::SESSION_KEY_MENU)['shipping_manage'])) echo "   ]},";
             if(isset(Session::get(Session::SESSION_KEY_MENU)['orderdata_manage'])) echo "    { href: '/order/order-shop', id: 'order_order_shop', text: '订单统计', class: 'icon-dingdan newicon-font', isshow: true, child: []},";
                ?>
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
