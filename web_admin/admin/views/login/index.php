<!DOCTYPE html>
<html lang="cn">
<head>
  <meta charset="utf-8"/>
  <title>世贸地产管理后台</title>
  <meta name="keywords" content="微商户后台管理"/>
  <meta name="description" content="移动互联网营销的大赢家"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <!-- basic styles -->
  <link href="/ace/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="/ace/css/font.css"/>
  <link rel="stylesheet" href="/ace/css/ace.min.css"/>
  <link rel="stylesheet" href="/ace/css/ace-rtl.min.css"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <style type="text/css">
    body, td, th {
      font-family: "微软雅黑";
    }

    body {
      margin: 0;
      padding: 0 0 50px;
      background: #fff;
      color: #5d5d5d;
      font-size: 12px;
      font-family: "Microsoft YaHei";
    }

    /*皮肤颜色*/
    .color_theme {
      background: #269bd1;
    }
  </style>
  <!--[if gte IE 7]>
  <style type="text/css">
    .login_center {
      _padding-top: 12%;
      *padding-top: 12%;
    }
  </style>
  <![endif]-->
  <!--[if gte IE 7]>
  <style type="text/css">
    .login_center {
      _padding-top: 12%;
      *padding-top: 12%;
    }
  </style>
  <![endif]-->
</head>
<body class="login-layout" onkeydown="on_return();">
<div class="main-container">
  <div class="main-content" id="content" style=" z-index:99">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <div class="login-container">
          <div class="position-relative">
            <div id="login-box" class="login-box visible widget-box no-border">
              <div class="login_head1"><div style="font-size:20px; text-align: center; padding: 20px 0 20px 0">世贸地产管理后台<span class="banben">V1.0</span></div></div>
              <div class="widget-body">
                <div class="widget-main">
                  <div class="space-6"></div>
                  <form method="POST">
                    <fieldset>
                      <label class="block clearfix"> <span
                          class="block input-icon input-icon-right">

                        <input type="text" id="staff_id" name="LoginForm[username]" value=""
                               class="form-control login_h" placeholder="用户名"/>
                        <i class="icon-user"></i> </span> </label>
                      <label class="block clearfix"> <span
                          class="block input-icon input-icon-right ">
                        <input type="password" id="password" name="LoginForm[password]" value=""
                               class="form-control login_h" placeholder="密码"/>
                        <i class="icon-lock"></i> </span> </label>
                      <label class="block clearfix"> <span
                          class="block input-icon input-icon-right ">
                        <input type="text" id="captcha" class="form-control login_code login_h"
                               placeholder="验证码"/>
                        <i class="code_img"><img id="captchaimg" src="/captcha/getimage" width="124"
                                                 height="50"></i> </span> </label>

                      <div class="space"></div>
                      <div class="clearfix">
                        <label class="inline">
                          <input type="checkbox" class="ace"/>
                        </label>
                        <button type="button" id="login"
                                class="width-100 pull-right btn btn-sm btn-primary login_h"
                                ng-click="test(frm,event)"><i class="icon-key"></i> 登录后台
                        </button>
                      </div>
                      <div class="space-4"></div>
                    </fieldset>
                  </form>
                </div>
                <!-- /widget-main -->

              </div>
              <!-- /widget-body -->
            </div>
            <!-- /login-box -->

            <!-- /forgot-box -->

            <!-- /signup-box -->
          </div>
          <!-- /position-relative -->
          <div class="clearfix"></div>
        </div>
        <!--<div class="toolbar center"> <a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link"> <i class="icon-arrow-left"></i> Back to login </a> </div>-->
      </div>
      <!-- /widget-body -->
    </div>
    <!-- /signup-box -->
  </div>
  <!-- /position-relative -->
  <div class="clearfix"></div>
</div>
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
</div>

<script src="/ace/js/jquery.min.js"></script>

<script type="text/javascript">
  window.jQuery || document.write("<script src='/ace/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
</script>

<script type="text/javascript">
  $('#login').click(function () {
    var captcha = $('#captcha').val();
    var account = $('#staff_id').val();
    var pwd = $('#password').val();

    if (!account) {
      alert('请输入用户名');
      $('#staff_id').focus();
      return false;
    }
    if (!pwd) {
      alert('请输入密码');
      $('#password').focus();
      return false;
    }
    if (!captcha) {
      alert('请输入验证码');
      $('#captcha').focus();
      return false;
    }
    function on_return(event) {
      if (window.event.keyCode == 13) {
        $("#login").click();
      }
    }

    login(captcha, account, pwd);
  })
  function on_return(event) {
    if (window.event.keyCode == 13) {
      $("#login").click();
    }
  }
  function login(captcha, username, password) {
    $.ajax({
      url: '/test/get-ajax',
      type: 'POST',
      dataType: 'json',
      data: {'captcha': captcha, 'username': username, 'password': password},
      success: function (response) {
        if (response.errcode == 0) {
          location.href = '/shop/index';
        } else if (response.errcode == 200) {
          location.href = response.errmsg;
        } else {
          alert(response.errmsg);
          $('#captchaimg').attr('src', '/captcha/getimage?rand=' + Math.random());
        }
      }
    });
  }

  $('#captchaimg').click(function () {
    $('#captchaimg').attr('src', '/captcha/getimage?rand=' + Math.random());
  })

  function changeCode() {
    $('#captchaimg').attr('src', '/captcha/getimage?rand=' + Math.random());
  }
</script>
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/ace/js/checkBrowser/checkBrowser.js"></script>
</body>
</html>
