
<?php
$urlImage[0]='./39d77d3998efe288eae287db5e80ebc1.jpg';
$urlImage[1]='./51ed771cb303bc7acd395f20bab74b9c.jpg';
$urlImage[2]='./075b4781fb1c79f606bfd1a36e2c82e1.jpg';
$urlImage[3]='./e0cc32f8ddcfae0edddfa3f6d9ebbe0c.jpg';
$urlImage[4]='./83a36516d69126846f9379b1aaf90ef9.jpg';
?>
<!DOCTYPE html >
<html lang="en-US" ng-app="myapp">
<head>
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="bG1JOEFFU2sIGg5tDg86IiQuLnMnAAQeVBciVB4dNgYcAhhoCmgSGA==">
    <meta charset="UTF-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="telephone=no" name="format-detection" />
    <meta content="no-cache" http-equiv="pragma">
    <style>
        html{height: 100%;}
        body{margin: 0;padding: 0;
            height: 100%;overflow: hidden; text-align: center;}
        #container {
            max-width: 640px;
            margin: auto;
            min-height: 100%;
            height: 100%;
            position: relative;
            display: block;
            background-size: 100% 100%;
            -webkit-box-sizing: border-box;
            min-width: 320px;
        }
        .wifi_wallbox{width: 100%; height: 100%; background: url("./51ed771cb303bc7acd395f20bab74b9c.jpg")center center no-repeat; background-size:cover }

    </style>
<body >
<div id="container">
    <div class="wifi_wallbox" style="background: url(
    <?php
    $id=$_REQUEST['id'];
    if(isset($urlImage[$id])){
        echo $urlImage[$id];
    }else{
        echo $urlImage[1];
    }?>) center center no-repeat; background-size:cover;">
    </div>
</div>
</body>
</html>
<!--<script>-->
<!--var id=window.location.href.split('?')[1].split("=")[1];-->
<!--var url = ['',"http://imgcache.vikduo.com/static/39d77d3998efe288eae287db5e80ebc1.jpg",-->
<!--                "http://imgcache.vikduo.com/static/51ed771cb303bc7acd395f20bab74b9c.jpg",-->
<!--                "http://imgcache.vikduo.com/static/075b4781fb1c79f606bfd1a36e2c82e1.jpg",-->
<!--                "http://imgcache.vikduo.com/static/e0cc32f8ddcfae0edddfa3f6d9ebbe0c.jpg",-->
<!--                "http://imgcache.vikduo.com/static/83a36516d69126846f9379b1aaf90ef9.jpg"-->
<!--            ];-->
<!--var urlname=url[id];-->
<!--console.log(urlname);-->
<!---->
<!--</script>-->

