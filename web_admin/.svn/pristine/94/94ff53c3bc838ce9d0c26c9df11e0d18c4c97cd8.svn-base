/*
 * andy 2015.04.16
 */
//全局变量obj
var wsh = wsh || {};
wsh.saveObj = {};  //将此值做保存函数的传递数据
wsh.url = window.location.href.match(/^.+\//)[0]; //ajax 或 $http 地址管理
wsh.element = null; //手机区域中选中的对象
wsh.pageMenuTarget = null; //保存底图右键时的对象
wsh.createMenuTarget = null; //保存手机区域右键时的对象
wsh.dummyStyle = document.createElement('div').style; //返回浏览器类型
wsh.style = (function () {
  var vendors = ['webkitT', 'MozT', 'msT', 'OT', 't'],
    t,
    i = 0,
    l = vendors.length;
  for (; i < l; i++) {
    t = vendors[i] + 'ransform';
    if (t in wsh.dummyStyle) {
      return vendors[i].substr(0, vendors[i].length - 1);
    }
  }
  return false;
})();
wsh.style = '-' + wsh.style + '-';
wsh.successback = function (msg, text, isreload, callback, failCallback) {
  if (msg.errcode == 0) {
    text ? window.alert(text) : void 0;
    isreload ? window.location.reload() : void 0;
    if (typeof callback == 'function') {
      callback.call(this, msg);
    }
  } else {
    alert(msg.errmsg);
    if (typeof failCallback == 'function') {
      failCallback.call(this, msg);
    }
  }
};
wsh.setDialog = function (title, content, url, data, callback, text) {
  return dialog({
    zIndex: 9999998,
    title: title,
    content: content,
    okValue: "确定",
    ok: function () {
      wsh.http.post(url, data)
        .success(function (msg) {
          wsh.successback(msg, text, false, function () {
            if (typeof callback == 'function') callback.call(this);
          });
        })
    },
    otherBtnValue: "取消",
    otherBtn: function () {
    }
  }).width(320).showModal();
};
wsh.setNoAjaxDialog = function (title, content, callback) {
  return dialog({
    zIndex: 9999998,
    title: title,
    content: content,
    okValue: "确定",
    ok: function () {
      if (typeof callback == 'function') callback.call(this);
    },
    otherBtnValue: "取消",
    otherBtn: function () {
    }
  }).width(320).showModal();
}
//封装快速弹框函数
wsh.dialog = null; //弹框全局变量
wsh.dialogFun = function (args) {
  return dialog(args);
};
wsh.quickDialog = function (text) {
  if (!wsh.dialog) {
    wsh.dialog = wsh.dialogFun({
      content: text,
      quickClose: true
    });
    wsh.dialog.showModal();
    var closeFun = function () {
      wsh.dialog.close().remove();
      wsh.dialog = null;
    };
    setTimeout(closeFun, 1000);
  }
};
//自动保存
wsh.autoSave = null;
wsh.isAutoSave = false;
//记录是不是从新手向导进来
wsh.isIntroudction = false;
wsh.isFirst = false;
//历史记录最大步数
wsh.id = null; // 保存微杂志的id值
wsh.dataFirst = {}; //保存微杂志最初的记录
wsh.historyArray = []; //保存历史记录的数组
wsh.historyCount = 50;

/**
 ** 加
 **/
wsh.add = function (arg1, arg2) {
  var r1, r2, m, c;
  try {
    r1 = arg1.toString().split(".")[1].length;
  }
  catch (e) {
    r1 = 0;
  }
  try {
    r2 = arg2.toString().split(".")[1].length;
  }
  catch (e) {
    r2 = 0;
  }
  c = Math.abs(r1 - r2);
  m = Math.pow(10, Math.max(r1, r2));
  if (c > 0) {
    var cm = Math.pow(10, c);
    if (r1 > r2) {
      arg1 = Number(arg1.toString().replace(".", ""));
      arg2 = Number(arg2.toString().replace(".", "")) * cm;
    } else {
      arg1 = Number(arg1.toString().replace(".", "")) * cm;
      arg2 = Number(arg2.toString().replace(".", ""));
    }
  } else {
    arg1 = Number(arg1.toString().replace(".", ""));
    arg2 = Number(arg2.toString().replace(".", ""));
  }
  return (arg1 + arg2) / m;
};

/**
 ** 减
 **/
wsh.sub = function (arg1, arg2) {
  var r1, r2, m, n;
  try {
    r1 = arg1.toString().split(".")[1].length;
  }
  catch (e) {
    r1 = 0;
  }
  try {
    r2 = arg2.toString().split(".")[1].length;
  }
  catch (e) {
    r2 = 0;
  }
  m = Math.pow(10, Math.max(r1, r2)); //last modify by deeka //动态控制精度长度
  n = (r1 >= r2) ? r1 : r2;
  return Number(((arg1 * m - arg2 * m) / m).toFixed(n));
};

/**
 ** 乘
 **/
wsh.mul = function (arg1, arg2) {
  var m = 0, s1 = arg1.toString(), s2 = arg2.toString();
  try {
    m += s1.split(".")[1].length;
  }
  catch (e) {
  }
  try {
    m += s2.split(".")[1].length;
  }
  catch (e) {
  }
  return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m);
};

/**
 ** 除
 **/
wsh.div = function (arg1, arg2) {
  var t1 = 0, t2 = 0, r1, r2;
  try {
    t1 = arg1.toString().split(".")[1].length;
  }
  catch (e) {
  }
  try {
    t2 = arg2.toString().split(".")[1].length;
  }
  catch (e) {
  }
  with (Math) {
    r1 = Number(arg1.toString().replace(".", ""));
    r2 = Number(arg2.toString().replace(".", ""));
    return (r1 / r2) * pow(10, t2 - t1);
  }
};