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
	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
		app.controller('leftController', function($scope, $rootScope){
			$scope.leftArray = [
                                {href: '', text: '终端店信息', class: 'icon-home', isshow: true, child: [
                                             {href: '/shop/index', text: '终端店信息'},
                                              // {href: '/product/list', text: '商品列表'},
                                             {href: '/terminal-shop/order-list', text: '订单列表'},
                                             {href: '/terminal-shop/member-list', text: '客户列表'},
                                             // {href: '/market-activity/list', text: '活动列表'},
                                             {href: '/terminal/fx-list', text: '推广管理'},
                                             {href: '/terminal-shop/staff-list', text: '员工列表'},
                                             {href: '/terminal/write-off', text: '核销管理'},
                                ]},
                                 {href: '', text: '数据统计', class: 'icon-line-chart', isshow: true, child: [
                                             {href: '/shop/order-statistics', text: '订单统计'},
                                             {href: '/shop/member-statistics', text: '客户统计'},
                                             {href: '/shop/fx-statistics', text: '推广统计'},      
                                ]},
                               
								
								];
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