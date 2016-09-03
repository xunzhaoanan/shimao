<script src="/ace/js/bootstrap.min.js"></script>
<!--乐语客服插件-->
<script type="text/javascript">
  var uid = "";
  var uname = "";
  var phone = "";
  var address = "";
  $.post('/shop/get-ajax', function (msg) {
    if (msg.errcode == 0) {
      uid = msg.errmsg.id;
      uname = msg.errmsg.name;
      phone = msg.errmsg.tel;
      address = msg.errmsg.addr;
    }
  }, "json");
  var key_str = '#params:商家ID,' + uid + ',商家名称,' + uname;
  if (phone.replace(/(^\s*)|(\s*$)/g, '') != "") {
    key_str = key_str + ',联系电话,' + phone + ',商家地址,' + address;
  }
  if (address.replace(/(^\s*)|(\s*$)/g, '') != "") {
    key_str = key_str + ',商家地址,' + address;
  }
  window.reseveKey = key_str;
</script>
