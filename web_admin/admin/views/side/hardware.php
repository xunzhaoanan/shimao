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
    $scope.leftArray = $rootScope.headList.i.child;
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
        if($('#headactive li').eq(i).find('a').text() == '微硬件'){
          index = i;
        }
      }
      if(id.substring(0,1) == 'i'){
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
