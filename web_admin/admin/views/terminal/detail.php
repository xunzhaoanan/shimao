<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '终端店信息';
?>

<div class="main-container" id="main-container" ng-cloak>
  <script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
  <div class="main-container-inner"> <?php echo $this->render('@app/views/side/terminal.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs"> 
        <script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
        <ul class="breadcrumb">
          <li>终端店信息</li>
        </ul>
        <!-- .breadcrumb --> 
      </div>
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="tabbable">
              <ul class="nav nav-tabs" id="myTab">
                <li class="active"> <a data-toggle="tab" href="#home">终端店信息设置</a> </li>
                <li class="hide"> <a data-toggle="tab" href="#jifen">操作日志</a> </li>
              </ul>
              <div class="tab-content">
                <div id="home" class="tab-pane in active">
                  <form class="form-horizontal ng-pristine ng-valid" >
                    <div class="space-6"></div>
                      <div class="form-group margin-bottom10 clearfix">
                          <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>终端店名称:</strong></label>
                          <div class="col-sm-9">
                              <!--<input type="text" class="col-sm-5 margin-right10 clearfix" placeholder="社会化电子商务平台">-->
                              <label class="width120 float-left text-left margin-right10 clearfix" for="form-field-1">
                                  <?= $data['shopInfo']['name'] ?>
                              </label>
                          </div>
                      </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>商家名称:</strong></label>
                      <div class="col-sm-9"> 
                        <!--<input type="text" class="col-sm-5 margin-right10 clearfix" placeholder="社会化电子商务平台">-->
                        <label class="width120 float-left text-left margin-right10 clearfix" for="form-field-1">
                            <?= $data['shop']['name'] ?>
                        </label>
                      </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>微信店铺分类:</strong></label>
                      <div class="col-sm-9">
                        <label class="width50 float-left text-left margin-right10 clearfix" for="form-field-1">
                            <?= $data['shopInfo']['wxshop'] ?>
                        </label>
                      </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>所属商圈:</strong></label>
                      <div class="col-sm-9">
                        <label class="width50 float-left text-left margin-right10 clearfix" for="form-field-1">
                            <?= $data['shopInfo']['circle'] ?>
                        </label>
                      </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>营业时间:</strong></label>
                      <div class="col-sm-9">
                        <label class="width120 float-left text-left margin-right10 clearfix" for="form-field-1">
                          <?= $data['shopInfo']['businesshour'] ?>
                        </label>
                      </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>电话:</strong></label>
                      <div class="col-sm-9">
                        <label class="width120 float-left text-left margin-right10 clearfix" for="form-field-1">
                          <?= $data['shopInfo']['phone'] ?>
                        </label>
                      </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>人均消费:</strong></label>
                      <div class="col-sm-9">
                        <label class="width120 float-left text-left margin-right10 clearfix" for="form-field-1">
                          <?= $data['shopInfo']['avg_price'] ?>
                        </label>
                      </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>特色推荐:</strong></label>
                      <div class="col-sm-9">
                        <label class=" float-left text-left margin-right10 clearfix" for="form-field-1">
                          <?= $data['shopInfo']['recommend'] ?>
                        </label>
                      </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>特色服务:</strong></label>
                      <div class="col-sm-9">
                        <label class=" float-left text-left margin-right10 clearfix" for="form-field-1">
                          <?= $data['shopInfo']['special'] ?>
                        </label>
                      </div>
                    </div>





                    <div class="form-group margin-bottom10 clearfix">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>门店地图:</strong></label>
                      <div class="col-sm-9">
                        <label class="width50 float-left text-left margin-right10 clearfix" for="form-field-1"> <a style="margin-left:10px;" href="<?= Url::to(['/terminal/edit']).'?id='.$data['id'].'&terminal_id='.$data['id'].'#l-map' ?>">查看地图</a></label>
                      </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>网址:</strong></label>
                      <div class="col-sm-9">
                        <label class="width100 float-left text-left margin-right10 clearfix" for="form-field-1"><a href="<?= $data['shopInfo']['url'] ?>" target="_blank">
                          <?= $data['shopInfo']['url'] ?>
                          </a></label>
                      </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>商家微信号:</strong></label>
                      <div class="col-sm-9">
                        <label class="width120 float-left text-left margin-right10 clearfix" for="form-field-1">
                          <?= $wx_account ?>
                        </label>
                      </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>店铺URL:</strong></label>
                      <div class="col-sm-9">
                        <label class="width100 float-left text-left margin-right10 clearfix" for="form-field-1"><a href="<?= getMobileSite().'/mall/index';?>" target="_blank">
                          <?= getMobileSite().'/mall/index';?>
                          </a></label>
                      </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix hide">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>店铺图片:</strong></label>
                      <div class="col-sm-9"> <img src="<?= $data['shopInfo']['site_img'] ?>" width="100" /> </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix hide">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>是否显示LBS:</strong></label>
                      <div class="col-sm-9">
                        <label class="width100 float-left text-left margin-right10 clearfix" for="form-field-1"></label>
                      </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix hide">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>官网背景:</strong></label>
                      <div class="col-sm-9"> <img src="<?= $data['shopInfo']['bg_img'] ?>" width="100" /> </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>商家描述:</strong></label>
                      <div class="col-sm-9">
                        <label class="width100 float-left text-left margin-right10 clearfix" for="form-field-1">
                          <?=$data['shopInfo']['description'] ?>
                        </label>
                      </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"><strong>详细地址:</strong></label>
                      <div class="col-sm-9">
                        <label class="width100 float-left text-left margin-right10 clearfix" for="form-field-1">
                          <?=$data['shopInfo']['address'] ?>
                        </label>
                      </div>
                    </div>
                    <div class="form-group margin-bottom10 clearfix">
                      <label class="width120 float-left text-right margin-right10 clearfix" for="form-field-1"></label>
                      <div class="col-sm-2"> <a href=<?= Url::to(['/terminal/edit?id=']).$data['id'].'&terminal_id='.$data['id'] ?> class="btn btn-primary"> <i class="icon-ok bigger-110"></i> 修改信息 </a> </div>
                        <div class="col-sm-2"> <a ng-href="{{'/terminal/terminal-password' + $root.getSearchUrl}}" class="btn btn-primary"> <i class="icon-ok bigger-110"></i> 修改密码 </a>  </div>
                    </div>
                  </form>
                </div>
                <div id="jifen" class="tab-pane">
                  <form class="form-horizontal ng-pristine ng-valid" >
                    <table width="100%" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th width="166" class="width150">操作时间</th>
                          <th width="100">操作类型</th>
                          <th width="200">操作人</th>
                          <th width="752">操作详情</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="width150">2015-05-15 15:40:44</td>
                          <td>基础数据</td>
                          <td></td>
                          <td>编辑商店信息</td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="grid-pager">
                      <ul class="pagination">
                        <li class="prev disabled"><a ><i class="icon-chevron-left"></i></a></li>
                        <li class="active"><a >1</a></li>
                        <li><a >2</a></li>
                        <li><a >3</a></li>
                        <li><a >…</a></li>
                        <li><a >21</a></li>
                        <li><a >22</a></li>
                        <li><a >23</a></li>
                        <li class="next"><a ><i class="icon-chevron-right"></i></a></li>
                        <li class="grid-pager-go"> <span>
                          <input type="text" class="ui-pg-input " size="2" maxlength="7" placeholder="5" role="textbox">
                          </span> <a  class="btn btn-sm btn-success ">页/跳转</a> </li>
                      </ul>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
    $('#updatePwd').click(function(){
        var oldPwd = $('#oldPwd').val();
        var newPwd = $('#newPwd').val();

        if(!oldPwd){
            alert('请输入旧密码');
            $('#oldPwd').focus();
            return false;
        }
        if(!newPwd){
            alert('请输入新密码');
            $('#newPwd').focus();
            return false;
        }
        updatePwd(oldPwd,newPwd);
    })

    function updatePwd(oldPwd,newPwd){
        $.ajax({
            url: '/mall/staff-edit-pwd-ajax',
            type: 'POST',
            dataType: 'json',
            data: {'oldPwd': oldPwd,'newPwd': newPwd},
            success:function(response){
                if(response.errcode == 0){
                    alert('修改成功');
                    location.href = location.href;
                }else{
                    alert(response.errmsg);
                }
            }
        });
    }
</script> 
