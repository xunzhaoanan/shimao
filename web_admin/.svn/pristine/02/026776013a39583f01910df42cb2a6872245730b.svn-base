<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <title>微商户</title>
    <style type="text/css">
        body{margin:0;}
        img{ width:100%;}

        #errorpage .err_page{width:100%; min-width:1024px; height:100%; position:relative;}
        #errorpage .nofindpage{background:#f0f4f8 url('http://imgcache.vikduo.com/static/99d129c4db66b1e6f645991d439770b3.jpg') center top no-repeat; background-size:100%;}
        #errorpage .nofindpage .err_btn{ position:absolute; bottom:18%; width:100%; text-align:center;}
        #errorpage .nofindpage .err_btn a{border:3px solid #79a0d7; padding:10px 30px; font-size:14px; font-family:'微软雅黑'; color:#5378ac; text-decoration: none; margin:0 5px; transition:all .5s;}
        #errorpage .nofindpage .err_btn a:hover{background:#79a0d7; color:#fff;}
        @media only screen and (max-width:1400px) {
            #errorpage .nofindpage .err_btn{ position:absolute; bottom:10%; width:100%; text-align:center;}
        }

    </style>
</head>
<body>
<div class="errorpage" id="errorpage">
    <div class="err_page nofindpage">
        <div class="err_btn">
            <a href="/shop/index" class="home_btn">返回首页</a>
            <?php
            if (isset($_SERVER['HTTP_REFERER'])) {
                echo '<a href="'.$_SERVER['HTTP_REFERER'].'" class="back_btn">返回上一步</a>';
            }else{
                echo '<a href="/shop/index" class="back_btn">返回上一步</a>';
            }
            ?>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        var winH = $(document).height();
        $('#errorpage').css({'height':winH});

    })
</script>
</html> 	