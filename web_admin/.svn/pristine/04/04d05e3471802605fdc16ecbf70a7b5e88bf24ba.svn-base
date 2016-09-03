<?php
use common\cache\Session;
?>
<a class="menu-toggler" id="menu-toggler" href="#"> <span class="menu-text"></span></a>
<div class="sidebar sidebar-fixed" id="sidebar">
  <script>
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
  <!-- /.nav-list -->
  <div class="sidebar-collapse" id="sidebar-collapse"> <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i> </div>
  <script>
	try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
	app.controller('leftController', function($scope, $rootScope){
		$scope.leftArray = [
							<?php
                            if(isset(Session::get(Session::SESSION_KEY_MENU)['xiaoshouhuodong_manage'])) echo "{href: '', id:'mall_navigation_list', text: '销售活动', class: 'icon-xiaoshou newicon-font', isshow: true, child: [";
							if(isset(Session::get(Session::SESSION_KEY_MENU)['/activity-points/list'])) echo "{href: '/activity-points/list', text: '积分活动'},";
							if(isset(Session::get(Session::SESSION_KEY_MENU)['/second-kill/list'])) echo "{href: '/second-kill/list', text: '秒杀'},";
							if(isset(Session::get(Session::SESSION_KEY_MENU)['xiaoshouhuodong_manage'])) echo "]},";
                            if(isset(Session::get(Session::SESSION_KEY_MENU)['tuiguanghuodong_manage'])) echo "{href: '', id:'redpack_list', text: '推广活动', class: 'icon-tuiguang newicon-font', isshow: true, child: [";
                            if(isset(Session::get(Session::SESSION_KEY_MENU)['/redpack/list'])) echo "    {href: '/redpack/list', text: '红包'},";
                            if(isset(Session::get(Session::SESSION_KEY_MENU)['/collect-zan/list'])) echo "    {href: '/collect-zan/list', text: '众筹'},";
                            if(isset(Session::get(Session::SESSION_KEY_MENU)['/market-activity/list'])) echo "{href: '/market-activity/list', text: '大转盘'},";
                            if(isset(Session::get(Session::SESSION_KEY_MENU)['/market-activity/smashegg-list'])) echo "{href: '/market-activity/smashegg-list', text: '砸金蛋'},";
                            if(isset(Session::get(Session::SESSION_KEY_MENU)['tuiguanghuodong_manage'])) echo "]},";
							if(isset(Session::get(Session::SESSION_KEY_MENU)['kaquan_manage'])) echo "{href: '', id:'card_coupons_list', text: '卡券', class: 'icon-credit-card', isshow: true, child: [";
                            if(isset(Session::get(Session::SESSION_KEY_MENU)['/card-coupons/list'])) echo "    {href: '/card-coupons/list', text: '卡券列表'},";
                            if(isset(Session::get(Session::SESSION_KEY_MENU)['/card-coupons/receive-list'])) echo "    {href: '/card-coupons/receive-list', text: '派发管理'},";
                            if(isset(Session::get(Session::SESSION_KEY_MENU)['kaquan_manage'])) echo "]},";
							if(isset(Session::get(Session::SESSION_KEY_MENU)['yingyongtuiguang_manage'])) echo "{href: '', id:'reserve_list', text: '应用推广', class: 'icon-yingyongtuiguang newicon-font', isshow: true, child: [";
							if(isset(Session::get(Session::SESSION_KEY_MENU)['/reserve/list'])) echo "	{href: '/reserve/list', text: '微预约'},";
							if(isset(Session::get(Session::SESSION_KEY_MENU)['yingyongtuiguang_manage'])) echo "]},";
							if(isset(Session::get(Session::SESSION_KEY_MENU)['magazine_manage'])) echo "{href: '', id:'magazine_list', text: '微杂志', class: 'icon-book newicon-font', isshow: true, child: [";
							if(isset(Session::get(Session::SESSION_KEY_MENU)['/magazine/list'])) echo "	{href: '/magazine/list', text: '杂志列表'},";
							if(isset(Session::get(Session::SESSION_KEY_MENU)['/magazine/category-list'])) echo "	{href: '/magazine/category-list', text: '分类管理'},";
							if(isset(Session::get(Session::SESSION_KEY_MENU)['/magazine/form'])) echo "	{href: '/magazine/form', text: '表单数据'},";
							if(isset(Session::get(Session::SESSION_KEY_MENU)['magazine_manage'])) echo "]},";
                            ?>
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
