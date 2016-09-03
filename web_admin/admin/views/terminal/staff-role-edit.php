<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '员工权限分配';
?>
<div class="main-container" id="main-container">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner" ng-controller="mainController">
    <?php echo $this->render('@app/views/side/terminal.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }</script>
        <ul class="breadcrumb">
          <li>员工权限分配</li>
        </ul>
        <!-- .breadcrumb -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <div class="tab-content tab-content3">
              <form class="form-horizontal" role="form">
                <div class="form-group">
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 全选 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 商品管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 编辑 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 批量复制 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 复制设置 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 保存批量设置 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 商品列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 商品标签管理 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 标签列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 添加标签 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 编辑标签 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 删除标签 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 商品标识管理 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 列表 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 商品虚拟分类 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 添加虚拟分类 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 修改虚拟分类 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 删除虚拟分类 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 尺码列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 添加尺码 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 修改尺码 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 删除尺码 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 商品规格分类 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 分类列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 添加分类 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 修改分类 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 删除分类 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 批量修改分类 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 售后说明模板管理 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 模板修改 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 删除模板 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 商品其他分类 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 批量编辑商品 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 详情页-添加品牌 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 详情页-添加供应商 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 详情页-添加标识 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 详情页-添加标签 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 选择售后说明模板 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 商品灌水 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 保存草稿 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 删除草稿 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 草稿列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 使用草稿 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 获得商品sku </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 商品颜色管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查看 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 颜色列表 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-3"><input name="form-field-checkbox" class="ace"
                                                   type="checkbox"><span class="lbl blue"> 颜色代码与Web颜色码关系管理 </span>
                    </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label
                      ><label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 商品分组管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label
                      ><label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 商品分组列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 分组列表 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 商品分类管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label
                      ><label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 列表 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 读取分组列表 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 商品供应商管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label
                      ><label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 供应商列表 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 商品品牌管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label
                      ><label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 品牌列表 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 订单管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 查看详细 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 超时订单 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 未确认订单 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 退货管理 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 换货管理 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 订单拒收 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 异常订单 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 审核通过/无效 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 开发票 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 取消订单 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 修改订单信息 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 修改订单商品 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 查看退货/查看拒收 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 退货确认/取消 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 拒收确认/取消 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 订单完成 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 确认付款 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 取消异常 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 编辑订单商品 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 搜索订单商品 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 更新订单商品 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 保存订单商品 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 订单列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 打印拣货单 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 删除订单 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 打印货运单 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 批量发货 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 未处理及未付款订单 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 导出订单xls </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 导出订单csv </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 货到付款区域 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 退换货申请 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 拒绝退换货申请 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 同意退换货申请 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 拒收订单列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 已发货订单 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 已完成订单 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 已取消订单 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 无效订单 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 已确认订单 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 换货商品列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 退货商品列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 确认退货商品 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 订单删除（全局） </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 订单发货 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 物流管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label
                      ><label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 物流列表 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 客户管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label
                      ><label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 重置密码 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查看 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 充值 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 余额明细 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 导出 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 客户充值 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 红包查询 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 客户列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 积分管理 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 客户分组管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 分组列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 添加分组 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 秒杀 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查看 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 暂停/取消 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 秒杀列表 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 团购 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查看 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 暂停/取消 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 团购列表 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 红包管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 查看明细 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 红包列表 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 红包活动管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 暂停/启动 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 发放红包 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 导出激活码 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 活动立即上线 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 红包活动列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 查看红包 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 删除红包活动 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 免运费管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 暂停/取消 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查看 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 免运费列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 上线 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 加价购管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 上线/取消 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查看 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 搜索 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 加价购列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 积分 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 暂停/启动/取消 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查看 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 积分列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 商品促销 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 暂停/取消 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查看 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 促销列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 大客户管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查看 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 列表 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 专题管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查看 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 专题列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 图片分类管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 图片分类列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 图片配置 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 图片管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> ZIP压缩上传 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 图片列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 上传图片 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 图片批量上传 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 弹窗中图片上传 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 文章分类管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 文章分类列表 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 文章管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 文章列表 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 模板管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 编辑列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 使用模板 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 备份模板 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 恢复模板 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 模板列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 上传模板包 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 插件管理 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 插件列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 下载 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 商城设置 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 管理员管理 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 角色管理 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 前台导航列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 添加前台导航 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 修改前台导航 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 删除前台导航 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 收听关注设置 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 第三方登录列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 第三方登录列表 </span>
                    </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 启用/禁用 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 文章管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 文章列表 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 在线客服 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 客服列表 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 支付管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 删除/禁用/启用 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 支付列表 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 商城配置 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 同步API配置 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 管理员管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 编辑 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span></label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 修改个人信息 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 分配权限 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 收听关注设置 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 特惠管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 列表 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 特惠列表 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 暂停/取消 </span></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 广告管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 广告列表 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 礼品卡管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 生成礼品卡 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 充值/作废 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 礼品卡列表 </span></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 邮箱折扣管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查看 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 列表 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span></label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 暂停/取消/启动 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 邮件/短信管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 邮件/短信设置 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 邮件/短信列表 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 优惠券管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 查看优惠码 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 列表 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span></label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 商品属性管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 属性列表 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span></label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 客户评留建议 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 列表 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 编辑 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span></label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 编辑显示状态 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 添加评论 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 权限管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 权限列表 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 组合返管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 列表 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查看 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 暂停/取消 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查询 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 获得各个活动参与的款色 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 组合返活动 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 邮件/短信管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 邮件短信配置管理 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 邮件列表 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查看 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 重置 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查询 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 礼品卡管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 列表页 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 添加活动 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 编辑 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查看 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 导入 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 满减 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 列表页 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 暂停/取消 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查看 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 定时脚本管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 列表 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 添加 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 发票管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 列表 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 导出 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 发票 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 查看 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 系统设置 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 系统初始化 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> APP、微客多系统配置 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> APP自动登陆 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 微客多自动登陆 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 站点开关 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 商城LOGO </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 前台背景 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 修改背景 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 清除背景 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 折扣券 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 折扣券列表 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 添加折扣券 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 修改折扣券 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 暂停/取消折扣券 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 上线 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> seo优化 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 上传seo文件 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 上传 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 生成html地图 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 生成 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 导入数据 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 导入商品数据 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 导入客户数据 </span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 自定义连接 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 添加url </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 qx-bg   ">
                    <label class="col-sm-2 margin-top3 no-padding-left clearfix"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl blue"> 自定义字段管理 </span> </label>
                  </div>
                  <div class="col-sm-12  ">
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span class="lbl"> 自定义字段列表 </span>
                    </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 修改 </span> </label>
                    <label
                      class="col-sm-2 margin-top3 no-padding-left clearfix qx-text qx-text"><input
                        name="form-field-checkbox" class="ace" type="checkbox"><span
                        class="lbl"> 删除 </span> </label>
                  </div>
                </div>
                <div class="space-10"></div>
                <div class="form-group clearfix">
                  <div class="col-sm-3"></div>
                  <div class="col-sm-9">
                    <a href="#" type="button" class="btn btn-primary"> 确定 </a>
                    &nbsp; &nbsp; &nbsp;
                    <a href="#" type="reset" class="btn">重置 </a>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /row -->
          <div id="modal-table" class="modal fade" tabindex="-1" open-close-modal>
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header no-padding">
                  <div class="table-header">
                    <a href="#" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                      <span class="white">&times;</span> </a>
                    Results for "Latest Registered Domains
                  </div>
                </div>
                <div class="modal-footer no-margin-top">
                  <a href="#" class="btn btn-sm btn-danger pull-left" data-dismiss="modal"> <i
                      class="icon-remove"></i> Close </a>
                  <ul class="pagination pull-right no-margin">
                    <li class="prev disabled"><a href="#"> <i class="icon-double-angle-left"></i>
                      </a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li class="next"><a href="#"> <i class="icon-double-angle-right"></i> </a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  app.controller("mainController", function ($scope, $http, $rootScope) {
    $rootScope.leftMenuIndex = 4;
    var int = 1;
    getData(int);
    function getData(int) {
      $.ajax({
        url: '/staff/list',
        type: 'GET',
        dataType: 'json',
        data: {'_page': int, '_page_size': 20},
        success: function (response) {
          $scope.lists = response.data;
          $scope.page = response.page;
          console.log(response);
          $scope.$apply();
        }
      });
    }

    //分页
    $scope.options = {callback: getData};

    $scope.disable = function (index) {
      if ($scope.lists[index].deleted) {
        $.get('/staff/disable?id=' + $scope.lists[index].id)
          .done(function (data) {
            console.log(data);
          });
      } else {
        $.get('/staff/enable?id=' + $scope.lists[index].id)
          .done(function (data) {
            console.log(data);
          });
      }
      $scope.lists[index].deleted = !$scope.lists[index].deleted;
    };
    $scope.Delete = function (index) {
      dialog({
        zIndex: 9999998,
        title: "删除提示",
        content: "是否删除此条数据",
        okValue: "删除",
        ok: function () {
          $.get('/staff/del?id=' + $scope.lists[index].id)
            .success(function (data) {
              getData(int);
            });
        },
        otherBtnValue: "取消",
        otherBtn: function () {
        }
      }).width(320).showModal()
    };
  });
</script>
