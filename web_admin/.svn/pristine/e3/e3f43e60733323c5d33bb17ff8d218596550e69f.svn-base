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
		<li ng-class="{true: 'open'}[$root.leftMenuIndex == $index]" ng-repeat="list in leftArray" pid="{{list.key}}" index="{{$index}}" ng-if="$root.authorityJSON[list.key] == 1"> <a ng-click="clickMenu($index, $event, list)" ng-href="{{list.href}}" ng-class="{true: 'dropdown-toggle'}[list.child.length > 0]"> <i class="{{list.class}}"></i> <span class="menu-text" ng-bind="list.text"></span><b class="arrow icon-angle-down" ng-if="list.child.length"></b> </a>
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
								{href: '', text: '商家管理', class: 'icon-dailishang newicon-font', isshow: false, key: 'aa'},
								{href: '', text: '支付管理', class: 'icon-dailishang newicon-font', isshow: false, key: 'ab'},
								{href: '', text: '文件管理', class: 'icon-dailishang newicon-font', isshow: false, key: 'ac'},
								{href: '', text: '操作员管理', class: 'icon-wenjiaguanli newicon-font', isshow: false, key: 'ad'},
								{href: '', text: '核销管理', class: 'icon-caozuoyuanguanli newicon-font', isshow: false, key: 'ae'},
								{href: '', text: '帮助中心', class: 'icon-wenjiaguanli newicon-font', isshow: false, key: 'af', child: 
									[
										{href: '', text: '系统公告', key: 'afa'},
										{href: '', text: '意见反馈', key: 'afb'}
									]
								}
                ]
			$scope.clickMenu = function(index, eve, obj){
				$rootScope.leftMenuIndex = index;
				if($.isArray(obj.child)){
					if(obj.child.length){
						obj.isshow = !obj.isshow;
					}
				}
			};
			$rootScope.$on('leftMenuChange', function(e, id){
		        var ids = [];
		        $.each($scope.leftArray, function(i, e){
		          if(id == e.key){
		            $rootScope.leftMenuIndex = i;
		            if(!$.isArray(e.child)) return
		            if(e.child.length){
		              e.isshow = true;
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