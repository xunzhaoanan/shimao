
<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '素材管理';
?>

<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/weixin_setting.php');?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>
        <ul class="breadcrumb">
          <li>素材管理</li>
        </ul>
        <!-- .breadcrumb -->
        <!-- #nav-search -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <!--操作栏-->
            <div class="clearfix no-padding">
              <div class="col-sm-7 no-padding">
                <ul class="listli left-space1 btn-primary bune float-left">
                  <li><a ng-if="$root.hasPermission('wxmaterial/image-add')" href="<?= Url::to(['wxmaterial/image-add']);?>" class="btn btn-xs btn-primary tian">添加图片</a></li>
                </ul>
                <!--<ul class="jiasucai">
                  <li><a href="<?= Url::to(['wxmaterial/news-add']);?>" target="_blank" >图文素材&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>
                  <li><a href="<?= Url::to(['wxmaterial/text-add']);?>" target="_blank">文本素材&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>
                  <li ><a href="<?= Url::to(['wxmaterial/image-add']);?>" target="_blank">图片素材&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>
                  &lt;!&ndash;<li><a href="/wxmaterial/voice-add" target="_blank">语音素材&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>&ndash;&gt;
                  &lt;!&ndash;                  <li><a href="/wxmaterial/music-add']);?>&lt;!&ndash;" target="_blank">音乐素材&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>&ndash;&gt;
                  &lt;!&ndash;                  <li><a href="/wxmaterial/video-add']);?>&lt;!&ndash;" target="_blank">视频素材&nbsp;&nbsp;<i class="icon-plus smaller-75"></i></a></li>&ndash;&gt;
                </ul>-->
              </div>
              <div class="col-sm-5 no-padding">
                <div class="col-sm-12 float-right no-padding">
                  <div class="float-right">
                    <div class="input-group float-left">
                      <input class="min-width120 float-left" placeholder="搜索消息相关关键字" type="text" ng-model="searchText">
                      <span class="float-left "> <a ng-click="getImage(1)" class="btn btn-xs btn-primary margin_right1"><i class="icon-search icon-on-right bigger-110"></i></a> </span> </div>
                  </div>
                </div>
              </div>
            </div>
            <!--/操作栏-->
            <div class="tabbable">
              <ul class="nav nav-tabs" id="myTab">
                <li ng-if="$root.hasPermission('wxmaterial/news-list')" style="cursor:pointer;"><a href="/wxmaterial/news-list">图文素材</a> </li>
                <!--                <li style="cursor:pointer;"><a href="/wxmaterial/music-list">音乐素材</a> </li>-->
                <li ng-if="$root.hasPermission('wxmaterial/text-list')" style="cursor:pointer;"><a href="/wxmaterial/text-list">文本素材</a> </li>
                <li ng-if="$root.hasPermission('wxmaterial/image-list')" class="active" style="cursor:pointer;"><a href="/wxmaterial/image-list">图片素材</a> </li>
                <!--<li style="cursor:pointer;"><a href="/wxmaterial/voice-list">语音素材</a> </li>-->
                <!--                <li style="cursor:pointer;"><a href="/wxmaterial/video-list">视频素材</a> </li>-->
              </ul>
              <div class="tab-content col-sm-12 clearfix">
                <div class="tab-pane active">
                  <!--图片素材-->
                  <ul class="dtw clearfix">
                    <li ng-repeat="list in imageList">
                      <h3 ng-bind="list.title | limitTo: 20" title="{{list.title}}" class="sc_title"></h3>
                        <p class="text-muted" ng-bind="list.modified*1000 | date:'yyyy-MM-dd HH:mm:ss'"></p>
                        <div class="imgbox95">
                            <img ng-src="{{list.cdn_path}}"  class="imgthd no-margin">
                       </div>
                      <div class="space-6"></div>
                      <div class=" visible-md visible-lg hidden-sm hidden-xs action-buttons weicb">

                          <a class=" blue width50 float-left" ng-if="$root.hasPermission('wxmaterial/image-edit')" data-rel="tooltip"
                             href="{{'/wxmaterial/image-edit?id=' + list.id}}" title="编辑"> <i class="icon-bianji bigger-130"></i> </a>
                        <a class=" bloak red width50 pointer float-right" ng-click="deleteImage(list.id)" title="删除"> <i class="icon-shanchu bigger-130"></i> </a>
                      </div>
                    </li>
                  </ul>
                  <!--/图片素材-->
                </div>
                <div ng-paginate options="options" page="page"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $(".tian").click(function(){
      $(".jiasucai").toggle();
    });
  });
</script>
<script>
  app.controller('mainController', function($scope, $http,$timeout, $rootScope){
    $timeout(function(){
      $rootScope.$broadcast('leftMenuChange','ba');
    },100);

    //获取图片素材

    $scope.getImage = function (int,title){
      $http.post("/wxmaterial/image-list-ajax", {'_page': int, '_page_size': 10,'title':$scope.searchText})
          .success(function(msg){
            wsh.successback(msg, '', false, function(){
              $scope.imageList = msg.errmsg.data;
              $scope.page = msg.errmsg.page;
            });
          })
    };
    $scope.getImage(1);
    $scope.options = {callback:$scope.getImage};
   /* $scope.deleteImage = function(index){
      dialog({
        zIndex: 9999998,
        title: "删除提示",
        content: '',
        okValue: "删除",
        ok: function() {

        },
        otherBtnValue: "取消",
        otherBtn: function() {
        }
      }).width(320).showModal()
    };*/

    $scope.deleteImage = function(id){
      wsh.setDialog('删除提示', '确定删除此图片素材', wsh.url + 'image-del-ajax', {id: id}, function(){
        $scope.getImage(1);
       // console.log("11111111");
      }, '删除成功');
    };
    //右上侧搜索设置
    $scope.searchText = '';
   /* var title;
    $scope.searchList = function(){
      if($scope.searchText){
        title=$scope.searchText;
        getImage(1,title)
      }else{
        getImage(1);
      }
    };*/
  });
</script> 