<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '商户证书';
?>

<div class="main-container" id="main-container" ng-controller="mainController"> 
  <script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
  </script>
  <div class="main-container-inner">
    <?php
  echo $this->render('@app/views/side/manage_setting.php');
  ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs" > 
        <script type="text/javascript">
              try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>
        <ul class="breadcrumb">
          <li> 商户证书</li>
        </ul>
        <!-- .breadcrumb --> 
      </div>
     <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="space-10"></div>
            <form action="/shop/upload-certificate-ajax" class="form-horizontal" novalidate="novalidate" name="myform" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <h3 class="margin-left32"><a class="red">*</a>商户证书：</h3>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label" for="form-field-1"><strong>scert.pem文件：</strong></label>
                <div class="col-sm-10">
                    <input type="file" name="UploadCertificateForm[secret_file]" value="选择文件" class="col-sm-3">
                </div>
              </div>

                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label" for="form-field-1"><strong>key.pem文件：</strong></label>
                    <div class="col-sm-10">
                        <input type="file" name="UploadCertificateForm[key_file]" value="选择文件" class="col-sm-3">
                    </div>
                </div>


              <div class="space-6"></div>
              <div class="form-group clearfix">
                <label class="col-sm-2 control-label" for="form-field-1"></label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary"> 确定 </button>
                </div>
              </div>
            </form>


          </div>

        </div>
         <div style="border-radius:10px;border: 1px solid #ccc;width:1000px;margin:0 auto" class="margin-top40">
         <div class="alert alert-block border_grey   " >
             <h4 >附件：</h4>
             <h4 >商户证书获取方法：</h4>
             <p >
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;微信支付接口中，涉及资金回滚的接口会使用到商户证书，包括退款、撤销接口。商家在申请微信支付成功后，收到的相应邮件后，可以按照指引下载API证书，也可以按照以下路径下载：微信商户平台(pay.weixin.qq.com)-->账户设置-->API安全-->证书下载 。证书文件有四个，分别说明如下：
             </p>
             </div>
             <div class="margin-top15" style="margin:0 auto;width:950px">
             <table width="100%" class="table table-striped table-bordered table-hover table-width margin-left10 margin-right10">
                 <thead>
                 <tr>
                     <th width="14%" class="text-center">证书附件</th>
                     <th width="31%" class="text-center">描述</th>
                     <th width="30%" class="text-center">适应场景</th>
                     <th width="30%" class="text-center">备注</th>
                 </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td class="text-center dark">pkcs12格式(apiclient_cert.p12)</td>
                         <td class="text-center dark">包含了私钥信息的证书文件，为p12(pfx)格式，由微信支付签发给您用来标识和界定您的身份</td>
                         <td class="text-center dark">撤销、退款申请API中调用</td>
                         <td class="text-center dark">windows上可以直接双击导入系统，导入过程中会提示输入证书密码，证书密码默认为您的商户ID（如：10010000）</td>
                     </tr>
                     <tr>
                         <td class="text-center dark">证书pem格式<p  style="border:1px solid red;">(apiclient_cert.pem)</p></td>
                         <td class="text-center dark">从apiclient_cert.p12中导出证书部分的文件，为pem格式，请妥善保管不要泄漏和被他人复制</td>
                         <td class="text-center dark">PHP等不能直接使用p12文件，而需要使用pem，为了方便您使用，已为您直接提供</td>
                         <td class="text-center dark">您也可以使用openssl命令来自己导出：openssl pkcs12 -clcerts -nokeys -in apiclient_cert.p12 -out apiclient_cert.pem</td>
                     </tr>
                     <tr>
                         <td class="text-center dark">证书密钥pem格式<p  style="border:1px solid red;">(apiclient_key.pem)</p></td>
                         <td class="text-center dark">从apiclient_key.pem中导出密钥部分的文件，为pem格式</td>
                         <td class="text-center dark">PHP等不能直接使用p12文件，而需要使用pem，为了方便您使用，已为您直接提供</td>
                         <td class="text-center dark">您也可以使用openssl命令来自己导出：openssl pkcs12 -nocerts -in apiclient_cert.p12 -out apiclient_key.pem</td>
                     </tr>
                     <tr>
                         <td class="text-center dark">CA证书（rootca.pem）</td>
                         <td class="text-center dark">微信支付api服务器上也部署了证明微信支付身份的服务器证书，您在使用api进行调用时也需要验证所调用服务器及域名的真实性</td>
                         <td class="text-center dark">该文件为签署微信支付证书的权威机构的根证书，可以用来验证微信支付服务器证书的真实性</td>
                         <td class="text-center dark">部分工具已经内置了若干权威机构的根证书，无需引用该证书也可以正常进行验证，这里提供给您在未内置所必须根证书的环境中载入使用</td>
                     </tr>

                 </tbody>
             </table>
             </div>
             <div class="margin-left10 margin-bottom10">关于微信证书详情请查看：https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_3</div>
         </div>
         </div>
        <!-- /.page-content --> 
      </div>
    </div>
  </div>
</div>
<script>
app.controller('mainController', function($scope, $rootScope, $timeout, $http){
  $timeout(function () { $rootScope.$broadcast('leftMenuChange', 'ab');  }, 100);

    var code = wsh.getHref('code');
    switch (code){
        case '1000':
            alert('证书上传成功！');
            break;
        case '1001':
            alert('上传文件格式非法！');
            break;
        case '1002':
            alert('上传文件没有任何数据！');
            break;
        case '1003':
            alert('上传文件格式非法！');
            break;
        case '1004':
            alert('您没有上传权限！');
            break;
        case '1005':
            alert('没有上传文件！');
            break;
        case '1006':
            alert('上传文件失败！');
            break;
    }
});
</script>
