var wsh = wsh || {};
wsh.dialog = null; //弹框全局变量
wsh.getLength = function (str) {
  var length = 0;
  if (str) {
    for (var i = 0; i < str.length; i++) {
      if (str.charCodeAt(i) > 255) {
        length += 2;
      } else {
        length++;
      }
    }
  }
  return length;
}
wsh.dialogFun = function (args) {
  return dialog(args);
};
wsh.changeReq = function (obj) {
  if (!obj.value) {
    $(obj).siblings('span').removeClass('hide');
    return setTimeout(function () {
      $(obj).siblings('span').addClass('hide');
    }, 2000);
  }
};
wsh.changeNumber = function (obj) {
  if (!(/^[0-9]+(.[0-9]{1,2})?$/).test(obj.value)) {
    obj.value = '';
    return alert('请输入数字');
  }
};
wsh.changeNumber3 = function (obj) {
  if (!(/^[0-9]+(.[0-9]{1,2})?$/).test(obj.value)) {
    obj.value = '';
    return;
  }
};
wsh.changeNumber2 = function (obj) {
  if (obj.value && !(/^[0-9]+(.[0-9]{1,2})?$/).test(obj.value.trim())) {
    obj.value = '';
    return alert('请输入数字');
  }
};
//校验大于等于0的整数
wsh.validPositiveInt = function (input) {
  if (input && input.value && !(/^[0-9]\d*$/).test(input.value.trim())) {
    input.value = '';
    return alert('请输入正整数');
  }
};
wsh.changeshuzi = function (obj) {
  if (obj.value && !(/^[0-9a-zA-Z]*$/g).test(obj.value.trim())) {
    obj.value = '';
    return alert('请输入数字或字母或数字和字母');
  }
}
wsh.getdate = function (int) {
  var aa = int ? new Date(int * 1000) : new Date();
  var years = aa.getFullYear();
  var hours = aa.getHours();
  var minutes = aa.getMinutes();
  var seconds = aa.getSeconds();
  var date = aa.getDate();
  var month = aa.getMonth() + 1;
  hours = hours < 10 ? '0' + hours : hours;
  seconds = seconds < 10 ? '0' + seconds : seconds;
  minutes = minutes < 10 ? '0' + minutes : minutes;
  month = month < 10 ? '0' + month : month;
  date = date < 10 ? '0' + date : date;
  return years + '-' + month + '-' + date + ' ' + hours + ':' + minutes + ':' + seconds;
};
wsh.quickDialog = function (text, time) {
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
    setTimeout(closeFun, time ? time : 1000);
  }
};
wsh.fxStatus = function (int) {
  switch (int) {
    case 1:
      return '未入帐';
      break;
    case 2:
      return '已入帐';
      break;
  }
}
wsh.successback = function (msg, text, isreload, callback, errorback) {
  if (msg.errcode == 0) {
    text ? window.alert(text) : void 0;
    isreload ? window.location.reload() : void 0;
    if (typeof callback == 'function') {
      callback.call(this, msg);
    }
  } else {
    if (typeof errorback == 'function') {
      errorback.call(this, msg);
    }
    if (msg.errcode == -503) return;
    alert(msg.errmsg);
  }
};
wsh.setDialog = function (title, content, url, data, callback, text, errorback, callcancel) {
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
          }, errorback);
        })
    },
    otherBtnValue: "取消",
    otherBtn: function () {
      if (typeof callcancel == 'function') callcancel.call(this);
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
wsh.dropdown = function (array) { //控制id 内容id 关闭id和取消id
  $('#' + array[0]).bind('click', function (e) {
    $('#' + array[1]).toggle();
  });
  $('#' + array[2] + ', #' + array[3]).bind('click', function (e) {
    $('#' + array[1]).hide();
  });
};
wsh.dropdownHide = function (string, callback) {
  $('#' + string).hide();
  if (typeof callback == 'function') {
    callback.call(this);
  }
};
wsh.changeObj = function (obj) {
  if ($.isEmptyObject(obj)) return [];
  var arr = [];
  for (var i in obj) {
    arr.push(obj[i]);
  }
  return arr;
};
wsh.getObjectLength = function (obj) {
  var count = 0;
  for (var i in obj) {
    count++;
  }
  return count;
};
wsh.unique = function (array, string) {
  var ret = [];
  var o = {};
  var len = array.length;
  for (var i = 0; i < len; i++) {
    if (string) {
      var v = array[i][string];
    } else {
      var v = array[i];
    }
    if (!o[v]) {
      o[v] = 1;
      ret.push(array[i]);
    }
  }
  return ret;
}
wsh.url = window.location.href.match(/^.+\//)[0];
wsh.getHref = function (string) {
  var reg = new RegExp("(^|&)" + string + "=([^&]*)(&|$)");
  var r = window.location.search.substr(1).match(reg);
  if (r)return decodeURI(r[2]);
  return false;
}


//排序
wsh.sort = function (arr) {
  return quickSort(arr, 0, arr.length - 1);
  function quickSort(arr, l, r) {
    if (l < r) {
      var mid = arr[parseInt((l + r) / 2)], i = l - 1, j = r + 1;
      while (true) {
        while (arr[++i] < mid);
        while (arr[--j] > mid);
        if (i >= j)break;
        var temp = arr[i];
        arr[i] = arr[j];
        arr[j] = temp;
      }
      quickSort(arr, l, i - 1);
      quickSort(arr, j + 1, r);
    }
    return arr;
  }
}

//相加[解决浮点相加问题]
wsh.sumOfNumbers = function (arr) {
  var len = arr.length, m, sum = 0, r = [];
  for (var i = 0; i < len; i++) {
    try {
      r[i] = arg1.toString().split(".")[1].length;
    } catch (e) {
      r[i] = 0;
    }
  }
  m = Math.pow(10, wsh.sort(r)[len - 1]);
  for (var i = 0; i < len; i++) {
    sum += arr[i] * m;
  }
  return sum / m;
}

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
//获取字符长度
wsh.getLength = function (str) {
  var length = 0;
  if (str) {
    for (var i = 0; i < str.length; i++) {
      if (str.charCodeAt(i) > 255) {
        length += 2;
      } else {
        length++;
      }
    }
  }
  return length;
};