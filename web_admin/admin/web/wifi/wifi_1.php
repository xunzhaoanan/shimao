<!DOCTYPE html >
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>智慧WIFI</title>
<style>
*{ margin:0; padding:0;}
html{ height:100%;}
body{ background:#3fc277; height:100%;}
img{width:100%; vertical-align:top;}
.bg{ background:url(./wifi_1/095839c4bee397821fd5ffbf0627ef0d.jpg) no-repeat; background-size:100% 100%;height:100%; position:relative;}
.list1{width: 60%; padding: 8% 0 0 0; margin: 0 auto;}
.list2{width:60%; padding: 7% 0 0 0; margin: 0 auto;}
.list3{width: 80%;  padding: 7% 0 0 0; margin: 0 auto;}
.info{ font-size:14px; color:#fff; text-align:center; margin-top:20px;}
.obtain{font-size:14px; color:#fdff9b; text-align:center; padding:10px 0}
.copyright{ height:40px; line-height:40px; position:absolute; right:0; bottom:2%; left:0; padding:10px 0; color:#fff; font-size:12px; text-align:center;}
@media (device-height:480px) and (-webkit-min-device-pixel-ratio:2){/* 兼容iphone4/4s */
.list2{ width:40%;}
.info,.obtain{ font-size:12px;}
.copyright{ bottom:0;}
}
</style>
</head>

<body>
<div class="bg">
    <div class="list1"><img src="./wifi_1/6cc7851b423ede407ad855b674f76cdf.png"></div>
    <div class="list2"><img src="./wifi_1/efa70c415d416f976b16f4fbe3b6759b.png"></div>

    <?php if(isset($_REQUEST['link']) && $_REQUEST['link']){ ?>
        <a href="<?php echo $_REQUEST['link']; ?>"><h3 class="obtain">获取免费WIFI</h3></a>
    <?php }else{ ?>
        <p class="info">请到商家门店内，通过微信扫一扫</p>
    <?php } ?>

    <div class="copyright">本WIFI服务由微商户提供</div>
</div>
</body>
</html>
