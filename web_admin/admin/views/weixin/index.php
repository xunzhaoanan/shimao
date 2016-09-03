<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '微信公众号绑定';
?>

<div class="main-container" id="main-container" > 
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
          <li>微信公众号绑定</li>
        </ul>
        <!-- .breadcrumb --> 
        <!-- #nav-search --> 
      </div>
      <div class="page-content"> 
        <!-- /.page-header --> 
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <div class="space-6 clearfix col-sm-12 floatnone"></div>
            <div class=" alert alert-block label-yellow yellow-border">
              <button type="button" class="close" data-dismiss="alert"> <i class="icon-remove"></i> </button>
              <i class="icon-warning-sign"></i> 温馨提示：您还有 0 个微信公众号配额，请珍惜使用名额！ </div>
            <!--商品活动列表-->
            <div class="table-responsive clearfix">
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                  <tr>
                    <th width="3%" class="lt-width3 text-center"> <label>
                        <input type="checkbox" class="ace">
                        <span class="lbl"></span> </label>
                    </th>
                    <th >操作</th>
                    <th>公众号名称</th>
                    <th>微信号</th>
                    <th >类型</th>
                    <th >创建时间</th>
                    <th width="">排序</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="lt-width3 text-center"><label>
                        <input type="checkbox" class="ace">
                        <span class="lbl"></span> </label></td>
                    <td class="visible-md visible-lg hidden-sm hidden-xs action-buttons"><a class="red" href="http://backend.cxm/site/view?u=/weixin/cxsq" title="重新授权"> <i class="icon-key bigger-130"></i> </a></td>
                    <td>大闹天宫</td>
                    <td>515dg65hg</td>
                    <td>订阅号</td>
                    <td>2014-10-20</td>
                    <td>50</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="text-center" id="center">
              <div id="grid-pager"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.main-container-inner --> 
  </div>
</div>
<script>

</script>