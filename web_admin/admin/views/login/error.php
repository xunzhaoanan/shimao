<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>首页-微商户</title>
<link href="img/favicon.ico" type="image/x-icon" rel="icon" >
<style type="text/css" media="screen">
*{-webkit-tap-highlight-color:rgba(255,255,255,0);}
article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}
body,p,h1,h2,h3,h4,h5,h6,ul,ol,dl,dd,form,textarea{margin:0;}
ul,ol,td,th,textarea,option{padding:0;}
ul,ol{list-style:none;}
a{text-decoration:none;outline:0 none;}
img{border:0 none;vertical-align:top;}
*{margin:0;padding:0;font-weight:normal;outline:0 none;}
body{font-family: "微软雅黑", arial, sans-serif;}
:focus{outline:0;}
.w1200{width:1200px;margin:0 auto;}
.wsh_404{width:890px;height:600px;position:absolute;top:0;right:0;bottom:0;left:0;margin:auto;text-align:center;}
.wsh_404 .title{ margin-bottom:40px; color:#677c74; font-size:30px;}
.wsh_404btn{display:block;width:200px;height:60px;margin:140px auto 20px;font-size:24px;color:#2bb3e8;text-align:center;border:1px solid #2bb3e8;line-height:60px;}
</style>
</head>
<body>



<div class="cooperator">
	<div class="w1200">
    	<div class="wsh_404">
            <p class="title"><?=isset($_GET['errmsg']) ? $_GET['errmsg'] : '您的账号暂时无法使用'?></p>
            <img src="http://imgcache.vikduo.com/static/b8d7fb002f59fead22e65d53366b62a7.png" alt="">
            <a href="http://shanghu.qq.com/help/auth?ref=%2Fadmin" class="wsh_404btn" title="返回登陆">返回登陆</a>
        </div>
    </div>
</div>



</body>
</html>
