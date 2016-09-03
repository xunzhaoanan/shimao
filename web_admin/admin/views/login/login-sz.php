<?php include 'head.php';?>
<div class="main-container" id="main-container"> 
	<script type="text/javascript">
					try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	</script>
	<div class="main-container-inner">
		<?php include 'side.php';?>
		<div class="main-content">
			<div class="breadcrumbs" id="breadcrumbs"> 
				<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
				<ul class="breadcrumb">
					<li>登录设置</li>
				</ul>
				<!-- .breadcrumb --> 
			</div>
			<div class="page-content"> 
				<!-- /.page-header --> 
				<!-- PAGE CONTENT BEGINS -->
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<div class="col-sm-6 no-padding"> <span class="icon-line"></span><span class="api-f-size16">联合登陆开关
								<input name="switch-field-1" class="ace ace-switch ace-switch-6" checked="" type="checkbox">
								<span class="lbl"></span></span> </div>
							<div class="col-sm-6 no-padding"> <span class="float-right"> </span> </div>
						</div>
						<div class="space-10 clearfix"></div>
						<form class="form-horizontal" ro;e="form">
							<div class="space-4"></div>
							<table width="100%" class="table table-striped table-bordered table-hover table-width">
								<thead>
									<tr>
										<th width="16%">第三方登陆名称</th>
										<th width="22%">APP_KEY&nbsp;&nbsp;|&nbsp;&nbsp;APP_SECRET</th>
										<th width="6%">状态</th>
										<th width="56%">操作</th>
									</tr>
								</thead>
								<tr>
									<td>新浪微博</td>
									<td> 使用snsshop登陆平台参数 </td>
									<td><label>
											<input name="switch-field-1" class="ace ace-switch ace-switch-6" checked="" type="checkbox">
											<span class="lbl"></span> </label></td>
									<td><div class="visible-md visible-lg hidden-sm hidden-xs action-buttons" data-toggle="modal" data-target="#myModal"> <a class="blue" data-toggle="modal" data-target="#myModal"> <i class="icon-pencil bigger-130"></i></a> </div></td>
								</tr>
								<tr>
									<td>腾讯QQ</td>
									<td> 使用snsshop登陆平台参数 </td>
									<td><label>
											<input name="switch-field-1" class="ace ace-switch ace-switch-6" checked="" type="checkbox">
											<span class="lbl"></span> </label></td>
									<td><div class="visible-md visible-lg hidden-sm hidden-xs action-buttons" data-toggle="modal" data-target="#myModal"> <a class="blue" data-toggle="modal" data-target="#myModal"> <i class="icon-pencil bigger-130"></i></a> </div></td>
								</tr>
								<tr>
									<td>开心网</td>
									<td> 使用snsshop登陆平台参数 </td>
									<td><label>
											<input name="switch-field-1" class="ace ace-switch ace-switch-6" checked="" type="checkbox">
											<span class="lbl"></span> </label></td>
									<td><div class="visible-md visible-lg hidden-sm hidden-xs action-buttons" data-toggle="modal" data-target="#myModal"> <a class="blue" data-toggle="modal" data-target="#myModal"> <i class="icon-pencil bigger-130"></i></a> </div></td>
								</tr>
								<tr>
									<td>腾讯微博</td>
									<td> 使用snsshop登陆平台参数 </td>
									<td><label>
											<input name="switch-field-1" class="ace ace-switch ace-switch-6" checked="" type="checkbox">
											<span class="lbl"></span> </label></td>
									<td><div class="visible-md visible-lg hidden-sm hidden-xs action-buttons" data-toggle="modal" data-target="#myModal"> <a class="blue" data-toggle="modal" data-target="#myModal"> <i class="icon-pencil bigger-130"></i></a> </div></td>
								</tr>
								<tr>
									<td>人人网</td>
									<td> 使用snsshop登陆平台参数 </td>
									<td><label>
											<input name="switch-field-1" class="ace ace-switch ace-switch-6" checked="" type="checkbox">
											<span class="lbl"></span> </label></td>
									<td><div class="visible-md visible-lg hidden-sm hidden-xs action-buttons" data-toggle="modal" data-target="#myModal"> <a class="blue" data-toggle="modal" data-target="#myModal"> <i class="icon-pencil bigger-130"></i></a> </div></td>
								</tr>
								<tr>
									<td>淘宝网</td>
									<td> 使用snsshop登陆平台参数 </td>
									<td><label>
											<input name="switch-field-1" class="ace ace-switch ace-switch-6" checked="" type="checkbox">
											<span class="lbl"></span> </label></td>
									<td><div class="visible-md visible-lg hidden-sm hidden-xs action-buttons" data-toggle="modal" data-target="#myModal"> <a class="blue" data-toggle="modal" data-target="#myModal"> <i class="icon-pencil bigger-130"></i></a> </div></td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /row -->
<div class="bootbox modal fade in"  id="myModal" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="bootbox-close-button close" data-dismiss="modal">×</button>
				<h4 class="modal-title">登陆设置</h4>
			</div>
			<div class="modal-body">
				<div class="bootbox-body">
					<form class="bootbox-form form-horizontal valid_form">
						<div id="home" class="tab-pane in active row">
							<div class="form-group margin-bottom10">
								<label class="col-sm-4 text-right no-padding-top" for="form-field-1">登陆名称</label>
								<div class="col-sm-8  ">新浪微博</div>
							</div>
							<div class="form-group margin-bottom10">
								<label class="col-sm-4 text-right" for="form-field-1">启用snsshop登陆平台</label>
								<div class="col-sm-8">
									<label>
										<input name="form-field-radio" type="radio" class="ace">
										<span class="lbl"> 启用</span>&nbsp;&nbsp;&nbsp;&nbsp;
									</label>
									<label>
										<input name="form-field-radio" type="radio" class="ace">
										<span class="lbl"> 不启用</span> </label>
								</div>
							</div>
							<div class="form-group margin-bottom10">
								<label class="col-sm-4 text-right" for="form-field-1">APP_ID</label>
								<div class="col-sm-8">
									<input type="text" class="col-xs-10" >
								</div>
							</div>
							<div class="form-group margin-bottom10">
								<label class="col-sm-4 text-right" for="form-field-1">APP_KEY</label>
								<div class="col-sm-8">
									<input type="text" class="col-xs-10" >
								</div>
							</div>
							<div class="form-group margin-bottom10">
								<label class="col-sm-4 text-right" for="form-field-1">APP_SECRET</label>
								<div class="col-sm-8">
									<input type="text" class="col-xs-10" >
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
			    <a href="#" data-bb-handler="cancel" type="button" class="btn btn-default">取消</a>
			    <a href="#" data-bb-handler="confirm" type="button" class="btn btn-primary">确定</a>
			</div>
		</div>
	</div>
</div>

<!-- PAGE CONTENT ENDS -->

<?php include 'foot.php';?>
