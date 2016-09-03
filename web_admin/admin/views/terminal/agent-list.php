<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '代理商列表';
?>

<div class="main-container" id="main-container" ng-controller="mainController">
<script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  	</script>
<div class="main-container-inner">
  <?php
		echo $this->render('@app/views/side/terminal.php');
		?>
  <div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs"> 
      <script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
      <ul class="breadcrumb">
        <li>代理商列表</li>
      </ul>
      <!-- .breadcrumb --> 
      <!-- #nav-search --> 
    </div>
    <div class="page-content">
      <div class="row">
        <div class="col-xs-12">
          <div class="form-group clearfix">
            <div class="tabbable">
             
         
                <div id="home" class="tab-pane active">
                 <a href="/terminal/agent-add" class="btn btn-xs btn-primary">添加代理商</a>
                    <!--查询-->
                    <div class="inline float-right margin-bottom10 margin-left10">
                      <input class="min-width120 float-left" placeholder="" type="text">
                      <span class="float-left "> <a class="btn btn-xs btn-primary"><i class="icon-search icon-on-right bigger-110"></i></a> </span> 
                    </div>
                     <div class="inline float-right margin-left10" style="margin-right:-1px;">
                     
                      <select>
                        <option value="" selected=""> 请选择地区</option>
                      </select>
                    </div> 
                   <div class="inline float-right margin-left10" style="margin-right:-1px;">
                      
                      <select>
                        <option value="" selected=""> 请选择城市</option>
                      </select>
                    </div> 
                  <div class="inline float-right" style="margin-right:-1px;">
                  
                    <select id="form-field-select-1">
                      <option value="" selected="">请选省份</option>
                    </select>
                  </div>
            
                  <div class="space-6"> </div>
                  <form class="form-horizontal">
                    <table width="100%" class="table table-striped table-bordered table-hover table-width">
                      <thead>
                        <tr>
                          <th width="14%" class="text-center">代理商ID</th>
                          <th width="14%" class="text-center">代理商名称</th>
                          <th width="14%" class="text-center">负责人姓名</th>
                          <th width="16%" class="text-center">联系电话</th>
                          <th width="19%" class="text-center">负责区域</th>
                          <th width="10%" class="text-center">下级代理数</th>
                          <th width="10%" class="text-center">加盟店数</th>
                          <th width="16%" class="text-center">操作</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="text-center" >123464</td>
                          <td class="text-center" >深证加盟二店</td>
                          <td class="text-center" >gf</td>
                          <td class="text-center" >021-60490259</td>
                          <td class="text-center" >北京市门头沟区所属</td>
                          <td class="text-center">10</td>
                          <td class="text-center">10</td>
                          <td class="text-center">
                              <a class="blue pointer" target="_blank" title="编辑" ng-href="/terminal/agent-edit?id={{list.id}}"><i class="icon-pencil bigger-130"></i></a>
                            <a title="查看代理商" target="_bank" href="/agent/detail" class="success"><i class="icon-eye-open bigger-130 text-decoration"></i></a> 
                          </td>
                        </tr>
                        <tr>
                          <td class="text-center" >123464</td>
                          <td class="text-center" >深证加盟二店</td>
                          <td class="text-center" >gf</td>
                          <td class="text-center" >021-60490259</td>
                          <td class="text-center" >北京市门头沟区所属</td>
                          <td class="text-center">10</td>
                          <td class="text-center">10</td>
                          <td class="text-center">
                             <a class="blue pointer" target="_blank" title="编辑" ng-href="/terminal/agent-edit?id={{list.id}}"><i class="icon-pencil bigger-130"></i></a>
                            <a title="查看代理商" target="_bank" href="/agent/detail" class="success"><i class="icon-eye-open bigger-130 text-decoration"></i></a> 
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>
              
                <div ng-show="empty" class="text-center red">暂时没有可显示的数据</div>
                <div id="center" style="position:relative;">
                  <div id="grid-pager"></div>
                </div>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>

    <!--编辑-->
  
 
<script type="text/javascript">
  
  app.controller('mainController',function($scope, $rootScope,$timeout){
    $timeout(function(){$rootScope.$broadcast('leftMenuChange', 2);}, 100);
  });
</script>