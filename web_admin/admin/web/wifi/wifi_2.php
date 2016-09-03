<!DOCTYPE html >
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>智慧WIFI</title>
<style>
*{ margin:0; padding:0;}
html{ height:100%;}
body{background:#ff5f53; height:100%;}
img{width:100%; vertical-align:top;}
.bg{ background:#ff5f53; background-size:100% 100%;height:100%; position:relative;}
.list1{width:80%; padding:0; margin: 0 auto;}
.list2{width:80%; padding:10% 0 0 0; margin: 0 auto;}
.list3{width: 80%;  padding: 7% 0 0 0; margin: 0 auto;}
.info{ font-size:14px; color:#fff; text-align:center; margin-top:20px;}
.obtain{font-size:14px; color:#fdff9b; text-align:center; padding:10px 0;}
.copyright{ height:40px; line-height:40px; position:absolute; right:0; bottom:0;  left:0; padding:10px 0; color:#fff; font-size:12px; text-align:center;}
@media (device-height:480px) and (-webkit-min-device-pixel-ratio:2){/* 兼容iphone4/4s */
.list2{ width:70%;}
.info,.obtain{ font-size:12px;}
.copyright{}
}
</style>
</head>

<body>
<div class="bg">
    <div class="list1"><img src="./wifi_2/91f74329feb78924e7154a026ff826eb.png"></div>
    <div class="list2"><img src="./wifi_2/7fc404c19b2a2401624eb8d8690d024c.png"></div>

    <?php if(isset($_REQUEST['link']) && $_REQUEST['link']){ ?>
        <a href="<?php echo $_REQUEST['link']; ?>"><h3 class="obtain">获取免费WIFI</h3></a>
    <?php }else{ ?>
        <p class="info">请到商家门店内，通过微信扫一扫</p>
    <?php } ?>

    <div class="copyright">本WIFI服务由微商户提供</div>
</div>
</body>
</html>
