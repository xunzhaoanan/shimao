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
    <li ng-class="{true: 'open'}[$root.leftMenuIndex == $index]" ng-if="list.hasPermission" pid="{{list.key}}" ng-repeat="list in leftArray" pid="{{list.id}}"> <a ng-click="clickMenu($index, $event, list)" ng-href="{{list.href}}" ng-class="{true: 'dropdown-toggle'}[list.child.length > 0]"> <i class="{{list.class}}"></i> <span class="menu-text" ng-bind="list.text"></span><b class="arrow icon-angle-down" ng-if="list.child.length"></b> </a>
      <ul ng-class="{true: 'submenu', false: 'submenu hide'}[list.isshow]" ng-if="list.child.length" style="display:block;">
        <li ng-repeat="childList in list.child track by $index" ng-if="childList.hasPermission"> <a href="{{childList.href}}" ng-bind="childList.text"> <i class="icon-double-angle-right"></i></a> </li>
      </ul>
    </li>
  </ul>
  <div class="sidebar-collapse" id="sidebar-collapse"> <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i> </div>
  <script>
  try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
  app.controller('leftController', function($scope, $rootScope){
    if(wsh.getHref("terminal_id")) {
      $scope.leftArray = [
        {href: '', text: '终端店信息', class: 'icon-home', isshow: true,  key: 'ha', child: [
          {href: '/terminal/detail?terminal_id='+wsh.getHref("terminal_id"), text: '终端店信息',  key: 'ha', child: []},
          {href: '/order/list?terminal_id='+wsh.getHref("terminal_id"), text: '订单列表',  key: 'cc', child: []},
          {href: '/member/list?terminal_id='+wsh.getHref("terminal_id"), text: '客户列表',  key: 'da', child: []},
          {href: '/fx/member-list?terminal_id='+wsh.getHref("terminal_id"), text: '推广管理',  key: 'ge', child: []},
          {href: '/staff/list?terminal_id='+wsh.getHref("terminal_id"), text: '员工列表',  key: 'ha', child: []},
          {href: '/terminal/write-off?terminal_id='+wsh.getHref("terminal_id"), text: '核销管理',  key: 'ae', child: []},
        ]},
        {href: '', text: '数据统计', class: 'icon-dailishang newicon-font', key: 'hb', isshow: true, child: [
          {href: '/data/order-shop?terminal_id='+wsh.getHref("terminal_id"), text: '订单统计', class: 'icon-line-chart',  key: 'hba'},
          {href: '/data/member-shop?terminal_id='+wsh.getHref("terminal_id"), text: '客户统计', class: 'icon-pie-chart', key: 'hbb'},
          {href: '/data/fx-shop?terminal_id='+wsh.getHref("terminal_id"), text: '推广统计', class: 'icon-pie-chart', key: 'hbc'},
        ]},
      ];
    }else if(wsh.getHref("agent_id")){
      $scope.leftArray = [
        {href: '', text: '代理商信息', class: 'icon-reorder', isshow: true, key: 'hc', child: [
          {href: '/agent/detail?agent_id='+wsh.getHref("agent_id"), text: '代理商信息',key: 'hc', class: 'icon-shopping-cart'},
          {href: '/agent/list?agent_id='+wsh.getHref("agent_id"), text: '下级代理商',key: 'hc', class: 'icon-shopping-cart'},
        ]},
        {href: '', text: '他的加盟店', class: 'icon-bar-chart', isshow: true, key: 'hc', child: [
          {href: '/terminal/list?agent_id='+wsh.getHref("agent_id"), text: '加盟店列表',key:'hc', class: 'icon-shopping-cart'},
          {href: '/order/list?agent_id='+wsh.getHref("agent_id"), text: '订单列表',  key: 'cc'},
          {href: '/member/list?agent_id='+wsh.getHref("agent_id"), text: '客户列表',  key: 'da'},
          {href: '/fx/member-list?agent_id='+wsh.getHref("agent_id"), text: '推广管理',  key: 'ge'},
        ]},
        {href: '', text: '数据统计', class: 'icon-dailishang newicon-font', key: 'hb',isshow: true, child: [
          {href: '/data/order-shop?agent_id='+wsh.getHref("agent_id"), text: '订单统计', class: 'icon-line-chart',  key: 'hba'},
          {href: '/data/member-shop?agent_id='+wsh.getHref("agent_id"), text: '客户统计', class: 'icon-pie-chart',  key: 'hbb'},
          {href: '/data/fx-shop?agent_id='+wsh.getHref("agent_id"), text: '推广统计', class: 'icon-pie-chart',  key: 'hbc'},
        ]},
      ];
    }else {
      $scope.leftArray = [
        {href: '/fx/setting', text: '推广设置', class: 'icon-cogs newicon-font', isshow: false, key: 'ga'},
        {href: '/fx/level-list', text: '推广员等级', class: 'icon-cubes', isshow: false, key: 'gc'},
        {href: '/fx/member-list', text: '推广员管理', class: 'icon-gonggaofuzhi newicon-font', isshow: false, key: 'gd'},
        {href: '/fx/policy-list', text: '推广策略', class: 'icon-dashboard ', isshow: false, key: 'gb'},
        {href: '/fx/order-list', text: '推广订单', class: 'icon-dingdan newicon-font', isshow: false, key: 'ge'},
        {href: '/fx/member-overage-list', text: '推广结算', class: 'icon-calculator', isshow: false, key: 'gf'}
      ];
    }
    $scope.leftArray = $rootScope.headList.g.child;
    $scope.clickMenu = function(index, eve, obj){
      $rootScope.leftMenuIndex = index;
      if($.isArray(obj.child)){
        if(obj.child.length){
          obj.isshow = !obj.isshow;
        }
      }
    };
    $rootScope.$on('leftMenuChange', function(e, id){
      var index;
      for(var i = 0;  i< $('#headactive li').length; i++ ){
        if($('#headactive li').eq(i).find('a').text() == '微推广'){
          index = i;
        }
      }
      if(id.substring(0,1) == 'g'){
        $('#headactive li').eq(index).css('background','rgb(43, 115, 181)');
      }
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
