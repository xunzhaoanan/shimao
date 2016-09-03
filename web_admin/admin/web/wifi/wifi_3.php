<!DOCTYPE html >
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>智慧WIFI</title>
<style>
*{ margin:0; padding:0;}
html{ height:100%;}
body{background:#ffcb27; height:100%;}
img{width:100%; vertical-align:top;}
.bg{ background:url(./wifi_3/3d6ab40884e50c06d85640c7dc204976.jpg) no-repeat; background-size:100% 100%;height:100%; position:relative;}
.list1{width:80%; padding:2% 0 0 0; margin: 0 auto;}
.list2{width:70%; padding:5% 0 0 0; margin: 0 auto;}
.list3{width: 80%;  padding: 7% 0 0 0; margin: 0 auto;}
.info{ font-size:14px; color:#882f18; text-align:center; background:#fff; width:60%; padding:10px; border-radius:5px; margin:20px auto 0 auto;}
.obtain{ background:#882f18;font-size:14px; color:#fff;width:50%; margin:10px auto 0 auto; text-align:center; padding:10px 0; border-radius:5px;}
.copyright{ height:40px; line-height:40px; position:absolute; right:0; bottom:0;  left:0; padding:10px 0; color:#882f18; font-size:12px; text-align:center;}

@media screen and (max-width: 320px)

{
.list1{ width:70%;}
.list2{ width:50%; padding-top:0;}
.info,.obtain{ font-size:12px;}
.copyright{}
}
</style>
</head>

<body>
<div class="bg">
    <div class="list1"><img src="./wifi_3/38d8d20e03384489054b6b31eb50cd75.png"></div>
    <div class="list2"><img src="./wifi_3/39fc7b1f9e993a9f6a83e870163b5e2e.png"></div>

    <?php if(isset($_REQUEST['link']) && $_REQUEST['link']){ ?>
        <a href="<?php echo $_REQUEST['link']; ?>"><h3 class="obtain">获取免费WIFI</h3></a>
    <?php }else{ ?>
        <p class="info">请到商家门店内，通过微信扫一扫</p>
    <?php } ?>

    <div class="copyright">本WIFI服务由微商户提供</div>
</div>
</body>
</html>
