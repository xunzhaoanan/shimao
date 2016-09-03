var app = angular.module('myapp', ['ui.bootstrap']).run([
  '$rootScope', '$timeout', 'userInfo', '$http', '$filter',
  function ($rootScope, $timeout, userInfo, $http, $filter) {
    $rootScope.leftMenuIndex = 0; //控制左侧的选择项
    $rootScope.ischooseOne = true;
    $rootScope.Wxmaterials = {};
    wsh.http = $http;
    gettime();
    function gettime() {
      $rootScope.nowTime = userInfo.now();
      $rootScope.nowDate = $filter('date')($rootScope.nowTime * 1000, 'yyyy-MM-dd HH:mm:ss');
      $timeout(function () {
        gettime();
      }, 1000);
    }

    $rootScope.tableNoData = "暂时没有可展示的数据";
    $rootScope.regIntAndZeroText = "请输入大于等于0的整数(最多七位正整数)";
    $rootScope.regIntText = '请输入大于等于0的整数(最多七位正整数)';  //正整数
    $rootScope.regNumberText = '只能输入数字(最多七位正整数)';  //数字
    $rootScope.regGtten = '请输入大于或等于10的整数';
    $rootScope.regMoneyText = '请输入大于0的正整数，若是小数，最多保留2位小数(金额只能到百万)';  //金额
    $rootScope.regDiscontText = '请输入小于10的正数，最多一位小数';  //折扣
    $rootScope.regMoneyWithZeroText = '请输入大于等于0的数，若是小数，最多保留2位小数(金额只能到百万)';  //金额
    $rootScope.regMoneyWithText = '请输入大于0的数，若是小数，最多保留2位小数(金额只能到百万)';  //金额不等于0
    $rootScope.regMoneyWithOneText = '请输入1-200之间的数（包括1和200），若是小数，最多保留2位小数';  //金额
    $rootScope.regMobileText = '手机号码输入错误'; // 手机号码
    $rootScope.regEmailText = '邮箱地址输入错误'; // email
    $rootScope.regUrlText = 'url地址输入错误';  // url
    $rootScope.regIntAndCharText = '请填写数字或字母+数字'; //只允许 数字和26个英文字母组成的字符串
    $rootScope.regIntAndCharAndLineText = '请填写数字或字母或下划线'; //只允许 数字和26个英文字母组成的字符串和下划线
    $rootScope.regChineseText = '只能输入汉字'; //只允许 汉字
    $rootScope.regPercentText = '请填写正确的百分比'; //只允许 汉字   regName
    $rootScope.regNameText = '姓名验证错误';
    $rootScope.regRequiredText = '必填项';
  }
]);

(function (window, document, angular, app, wsh, $rootScope) {

  'use strict';//启用严格模式

  // region factory
  app.factory('userInfo', userInfo)//用户信息
    .filter('orderpaykey', orderpaykey)//支付方式过滤器
    .filter('orderpayType', orderpayType)//订单类型过滤器
    .filter('orderSelType', orderSelType)// 类型过滤
    .filter('jsonType', jsonType)// 活动类型过滤
    .filter('ordertype', ordertype)//售后类型
    .filter('filterVal', filterVal)//过滤器"-"截取右边的值
    .filter('filterBefore', filterBefore)//过滤器"-"截取左边的值
    .filter('trustFilterimg', trustFilterimg)//$sce过滤器
    .filter('trustFilter', trustFilter)//$sce过滤器
    .filter('trust', trust)//$sce过滤器
    .filter('trim', trim)//前后去空格过滤器
    .filter('space', space)//过滤器
    .filter('isEmpty', isEmpty)//过滤器
    .filter('price', price)//价格过滤器
    .filter('pricec', pricec)//价格过滤器
    .filter('star', star)//计分过滤器
    .filter('sysface', sysface)//系统表情过滤器
    .filter('returnGoodsReason', returnGoodsReason)//退货退款理由
    .filter('returnSendType', returnSendType)//发送方式
    .filter('isBind', isBind)//是否绑定微信
    .filter('bindStatus', bindStatus)//是否绑定微信
    .filter('source', source)//是否绑定微信
    .filter('discount', discount)//折扣,保留一位
    .filter('gender', gender)//性别
    .directive('myPrice', myPrice)//
    .directive('mySelect', mySelect)//改变 select 选择框
    .directive('myDate', myDate)//改变 input type="date" 的状态
    .directive('myDatePicker', myDatePicker)//改变 微商户 时间选择器 的状态
    .directive('myCheckBox', myCheckBox)//改变 checkbox  的状态
    .directive('openCloseModal', openCloseModal)//启用和禁用所有的模态框 的关闭方式
    .directive('regPercent', regPercent)//
    .directive('regIntAndZero', regIntAndZero)//
    .directive('regInt', regInt)//
    .directive('regGtten', regGtten)//
    .directive('regMoney', regMoney)//
    .directive('regDiscont', regDiscont)//折扣
    .directive('regMoneyWithZero', regMoneyWithZero)//金额只能输入1-200
    .directive('regMoneyWithOne', regMoneyWithOne)//
    .directive('regNumber', regNumber)//
    .directive('regMobile', regMobile)//
    .directive('regTelephone', regTelephone)//校验手机和电话
    .directive('regCharLen', regCharLen)//校验字符长度
    .directive('regEmail', regEmail)//
    .directive('regUrl', regUrl)//
    .directive('regIntAndChar', regIntAndChar)//
    .directive('regIntAndCharAndLine', regIntAndCharAndLine)//
    .directive('regChinese', regChinese)//
    .directive('regName', regName)//
    .directive('regCardNo', regCardNo)//校验银行卡号
    .directive('regMoneyWithBetween', regMoneyWithBetween)//金额只能输入区间  使用格式reg-money-with-between="1|200"
    .directive('maxStringLength', maxStringLength)//字符个数，非汉字个数，utf8编码一汉字对应3字符
    .directive('onFinishRenderFilters', onFinishRenderFilters)//侦听ng-repeat完成事件
    .directive('zeroFill', zeroFill)//元素失去焦点后自动补零
    .directive('textareaLen', textareaLen)//获取textarea内容长度
    .directive('qqface', qqface)//qqface
    .directive('emoji', emoji)//emoji
    .directive('ngPaginate', ngPaginate)//ngPaginate
    .directive('choosePeople', choosePeople)//choosePeople
    .directive('selecOperator', selecOperator)//selecOperator
    .directive('chooseMember', chooseMember)//chooseMember
    .directive('searchBelong', searchBelong)//searchBelong
    .directive('chooseStore', chooseStore);//chooseStore

  // endregion

  function userInfo($http, $q) {
    return {
      provinceList: function () {
        var deferred = $q.defer();
        $http.post('/common/find-province-ajax', {})
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              deferred.resolve(msg.errmsg);
            });
          });
        return deferred.promise;
      },
      wxShopList: function () {
        var deferred = $q.defer();
        $http.post('/common/find-wxshop-category-ajax', {pid: 0})
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              deferred.resolve(msg.errmsg);
            });
          });
        return deferred.promise;
      },
      now: function () {
        return Math.floor(+new Date() / 1000);
      },
      shopTypeList: function () {
        var deferred = $q.defer();
        $http.post('/terminal/list-ajax', {'_page': 1, '_page_size': 100})
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              deferred.resolve(msg.errmsg);
            });
          });
        return deferred.promise;
      },
      roleList: function () {
        var deferred = $q.defer();
        $http.post('/role/list-ajax', {'_page': 1, '_page_size': 100})
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              deferred.resolve(msg.errmsg);
            });
          });
        return deferred.promise;
      }
    };
  }

  userInfo.$inject = ['$http', '$q'];

  function orderpaykey() {
    return function (val) {
      switch (val) {
        case 0:
          return '未付款';
        case 1:
          return '财付通';
        case 2:
          return '微信支付';
        case 3:
          return '货到付款';
        case 4:
          return '代收';
        case 5:
          return '微信支付';
        case 6:
          return '现金支付';
        case 7:
          return '微信扫码支付';
        case 8:
          return '手Q扫码支付';
        default :
          return '未知';
      }
    };
  }

  function orderpayType() {
    return function (val) {
      switch (val) {
        case 1:
          return '普通订单';
        case 2:
          return '秒杀';
        case 3:
          return '预售';
        case 4:
          return 'pos收银';
        case 5:
          return 'pos订单';
        case 6:
          return '拍码打折';
        case 7:
          return '扫码订单';
        case 8:
          return '拼团';
        default :
          return '未知';
      }
    };
  }

  function orderSelType() {
    return function (val) {
      switch (val) {
        case 1:
          return '消费赠送';
        case 2:
          return '消费抵扣现金';
        case 3:
          return '积分兑换';
        case 4:
          return '签到赠送';
        case 5:
          return '抽奖赠送';
        case 6:
          return '抽奖消耗';
        case 7:
          return '内部接口';
        case 9:
          return '会员开卡送积分';
          break;
        default:
          return '未知';
      }
    };
  }

  function jsonType() {
    return function (val) {
      if (val == 'order') {
        return '订单';
      }
      switch (val) {
        case 0:
          return '订单';
        case 1:
          return '大转盘';
        case 2:
          return '刮刮乐';
        case 3:
          return '翻卡牌';
        case 4:
          return '砸金蛋';
        case 5:
          return '摇一摇';
        default:
          return '未知';
      }
    };
  }

  function ordertype() {
    return function (val) {
      switch (val) {
        case 1:
          return '退款';
        case 2:
          return '换货';
        case 3:
          return '退货';
        default :
          return '其它';
      }
    };
  }

  function filterVal() {
    return function (val) {
      if (val == null)return
      if (val.indexOf("-") != -1) {
        return val.split("-")[1];
      } else {
        return val;
      }
    };
  }

  function filterBefore() {
    return function (val) {
      if (val == null)return
      if (val.indexOf("-") != -1) {
        return val.split("-")[0];
      } else {
        return val;
      }
    };
  }

  function trustFilter($sce) {
    return function (val, str) {
      switch (str) {
        case 'html':
          return $sce.trustAsHtml(val.replace('undefined', '').replace('null', ''));
        case 'js':
          return $sce.trustAsJs(val);
        case 'css':
          return $sce.trustAsCss(val);
        case 'url':
          return $sce.trustAsUrl(val);
        case 'resourceUrl':
          return $sce.trustAsResourceUrl(val);
        default :
          return '未可知';
      }
    };
  }

  trustFilter.$inject = ['$sce'];


  function trustFilterimg($sce) {
    return function (val) {
      var result = '';
      if (val.indexOf('<br/><img') > -1) {
        var before = val.split('<br/><img');//看有没有图片
        result = before[0];
        return $sce.trustAsHtml(result);
      } else {
        return $sce.trustAsHtml(val);
      }
    };
  }

  trustFilterimg.$inject = ['$sce'];

  function trust($sce) {
    return function (val, str) {
      switch (str) {
        case 'html':
          return $sce.trustAsHtml(val);
        case 'js':
          return $sce.trustAsJs(val);
        case 'css':
          return $sce.trustAsCss(val);
        case 'url':
          return $sce.trustAsUrl(val);
        case 'resourceUrl':
          return $sce.trustAsResourceUrl(val);
        default :
          return '未可知';
      }
    };
  }

  trust.$inject = ['$sce'];

  function trim() {
    return function (val) {
      if (typeof val === 'string') {
        return val.trim();
      } else {
        return '';
      }
    };
  }

  function space() {
    return function (val) {
      return val.replace(/ [^ .]+$/, '');
    };
  }

  function isEmpty() {
    return function (val) {
      if (typeof val === 'object') {
        if ($.isArray(val)) {
          if (val.length) return true;
          else return false;
        } else {
          if ($.isEmptyObject(val)) return false;
          else return true;
        }
      }
    };
  }

  function price() {
    return function (val, int) {
      if (!val) return '0.00';
      if (int === undefined) int = 2;
      if (typeof val === 'number') val = val.toString();
      if (val.length > int) {
        return val.substr(0, val.length - int) + '.' + val.substr(val.length - int, val.length - 1);
      } else {
        if (val.length === int) {
          return '0.' + val;
        } else {
          var count = int - val.length, str = '0.';
          for (var i = 0; i < count; i++) {
            str += '0';
          }
          return str + val;
        }
      }
    };
  }

  function pricec() {
    return function (val, int, pre) {
      var arr, prefix = pre === undefined ? '￥' : pre, result = prefix + '0.00', j = 0;
      if (!val) return result;
      int = int || 2;
      arr = val.toString().split('.');
      result = prefix + arr[0] + '.';
      if (arr.length > 1) {
        j = int - arr[1].length;
        result += arr[1];
      } else {
        j = int;
      }
      for (var i = 0; i < j; i++) {
        result += '0';
      }
      return result;
    };
  }

  function star() {
    return function (val) {
      switch (val) {
        case 1:
          return '★';
        case 2:
          return '★★';
        case 3:
          return '★★★';
        case 4:
          return '★★★★';
        case 5:
          return '★★★★★';
      }
    };
  }

  function sysface() {

    function convert(value) {
      var emojis = [{"text": "😄", "desc": "smile"}, {"text": "😆", "desc": "laughing"}, {
        "text": "😊",
        "desc": "blush"
      }, {"text": "😃", "desc": "smiley"}, {"text": "☺️", "desc": "relaxed"}, {
        "text": "😏",
        "desc": "smirk"
      }, {"text": "😍", "desc": "heart_eyes"}, {
        "text": "😘",
        "desc": "kissing_heart"
      }, {"text": "😚", "desc": "kissing_closed_eyes"}, {
        "text": "😳",
        "desc": "flushed"
      }, {"text": "😌", "desc": "relieved"}, {"text": "😁", "desc": "grin"}, {
        "text": "😉",
        "desc": "wink"
      }, {"text": "😜", "desc": "stuck_out_tongue_winking_eye"}, {
        "text": "😝",
        "desc": "stuck_out_tongue_closed_eyes"
      }, {"text": "😀", "desc": "grinning"}, {"text": "😗", "desc": "kissing"}, {
        "text": "😙",
        "desc": "kissing_smiling_eyes"
      }, {"text": "😛", "desc": "stuck_out_tongue"}, {
        "text": "😴",
        "desc": "sleeping"
      }, {"text": "😟", "desc": "worried"}, {"text": "😦", "desc": "frowning"}, {
        "text": "😧",
        "desc": "anguished"
      }, {"text": "😮", "desc": "open_mouth"}, {"text": "😬", "desc": "grimacing"}, {
        "text": "😕",
        "desc": "confused"
      }, {"text": "😯", "desc": "hushed"}, {"text": "😑", "desc": "expressionless"}, {
        "text": "😒",
        "desc": "unamused"
      }, {"text": "😅", "desc": "sweat_smile"}, {"text": "😓", "desc": "sweat"}, {
        "text": "😥",
        "desc": "disappointed_relieved"
      }, {"text": "😩", "desc": "weary"}, {"text": "😔", "desc": "pensive"}, {
        "text": "😞",
        "desc": "disappointed"
      }, {"text": "😖", "desc": "confounded"}, {"text": "😨", "desc": "fearful"}, {
        "text": "😰",
        "desc": "cold_sweat"
      }, {"text": "😣", "desc": "persevere"}, {"text": "😢", "desc": "cry"}, {
        "text": "😭",
        "desc": "sob"
      }, {"text": "😂", "desc": "joy"}, {"text": "😲", "desc": "astonished"}, {
        "text": "😱",
        "desc": "scream"
      }, {"text": "😫", "desc": "tired_face"}, {"text": "😠", "desc": "angry"}, {
        "text": "😡",
        "desc": "rage"
      }, {"text": "😤", "desc": "triumph"}, {"text": "😪", "desc": "sleepy"}, {
        "text": "😋",
        "desc": "yum"
      }, {"text": "😷", "desc": "mask"}, {"text": "😎", "desc": "sunglasses"}, {
        "text": "😵",
        "desc": "dizzy_face"
      }, {"text": "😈", "desc": "smiling_imp"}, {
        "text": "😐",
        "desc": "neutral_face"
      }, {"text": "😶", "desc": "no_mouth"}, {"text": "😇", "desc": "innocent"}, {
        "text": "🙆",
        "desc": "ok_woman"
      }, {"text": "🙅", "desc": "no_good"}, {
        "text": "🙎",
        "desc": "person_with_pouting_face"
      }, {"text": "💆", "desc": "massage"}, {"text": "🐶", "desc": "dog"}, {
        "text": "🐭",
        "desc": "mouse"
      }, {
        "text": "🐹",
        "desc": "hamster"
      }, {"text": "🐰", "desc": "rabbit"}, {"text": "🐺", "desc": "wolf"}, {
        "text": "🐸",
        "desc": "frog"
      }, {"text": "🐯", "desc": "tiger"}, {"text": "🐻", "desc": "bear"}, {
        "text": "🐷",
        "desc": "pig"
      }, {"text": "🐮", "desc": "cow"}, {"text": "🐵", "desc": "monkey_face"}, {
        "text": "🐴",
        "desc": "horse"
      }, {"text": "🐼", "desc": "panda_face"}, {"text": "🐲", "desc": "dragon_face"}, {
        "text": "🌞",
        "desc": "sun_with_face"
      }, {"text": "🌝", "desc": "full_moon_with_face"}, {
        "text": "🌚",
        "desc": "new_moon_with_face"
      }, {"text": "🌜", "desc": "last_quarter_moon_with_face"}, {
        "text": "🌛",
        "desc": "first_quarter_moon_with_face"
      }];
      var result = emojis.filter(function (obj) {
        if (obj.text === value) return obj;
      })[0];
      return result ? result.desc : '';
    }

    return function (input) {
      if (input) {
        input = input.toString();
        var face = ['/::)', '/::~', '/::B', '/::|', '/:8-)', '/::<', '/::$', '/::X', '/::Z', '/::\'(', '/::-|', '/::@', '/::P', '/::D', '/::O', '/::(', '/::+', '/:--b', '/::Q', '/::T', '/:,@P', '/:,@-D', '/::d', '/:,@o', '/::g', '/:|-)', '/::!', '/::L', '/::>', '/::,@', '/:,@f', '/::-S', '/:?', '/:,@x', '/:,@@', '/::8', '/:,@!', '/:!!!', '/:xx', '/:bye', '/:wipe', '/:dig', '/:handclap', '/:&-(', '/:B-)', '/:<@', '/:@>', '/::-O', '/:>-|', '/:P-(', '/::\'|', '/:X-)', '/::*', '/:@x', '/:8*', '/:pd', '/:<W>', '/:beer', '/:basketb', '/:oo', '/:coffee', '/:eat', '/:pig', '/:rose', '/:fade', '/:showlove', '/:heart', '/:break', '/:cake', '/:li', '/:bome', '/:kn', '/:footb', '/:ladybug', '/:shit', '/:moon', '/:sun', '/:gift', '/:hug', '/:strong', '/:weak', '/:share', '/:v', '/:@)', '/:jj', '/:@@', '/:bad', '/:lvu', '/:no', '/:ok', '/:love', '/:<L>', '/:jump', '/:shake', '/:<O>', '/:circle', '/:kotow', '/:turn', '/:skip', '/:oY', '/:#-0', '/hiphot', '/:kiss', '/:<&', '/:&>'],
          rFace = new RegExp("(/::\\)|/::~|/::B|/::\\||/:8-\\)|/::<|/::\\$|/::X|/::Z|/::'\\(|/::-\\||/::@|/::P|/::D|/::O|/::\\(|/::\\+|/:--b|/::Q|/::T|/:,@P|/:,@-D|/::d|/:,@o|/::g|/:\\|-\\)|/::!|/::L|/::>|/::,@|/:,@f|/::-S|/:\\?|/:,@x|/:,@@|/::8|/:,@!|/:!!!|/:xx|/:bye|/:wipe|/:dig|/:handclap|/:&-\\(|/:B-\\)|/:<@|/:@>|/::-O|/:>-\\||/:P-\\(|/::'\\||/:X-\\)|/::\\*|/:@x|/:8\\*|/:pd|/:<W>|/:beer|/:basketb|/:oo|/:coffee|/:eat|/:pig|/:rose|/:fade|/:showlove|/:heart|/:break|/:cake|/:li|/:bome|/:kn|/:footb|/:ladybug|/:shit|/:moon|/:sun|/:gift|/:hug|/:strong|/:weak|/:share|/:v|/:@\\)|/:jj|/:@@|/:bad|/:lvu|/:no|/:ok|/:love|/:<L>|/:jump|/:shake|/:<O>|/:circle|/:kotow|/:turn|/:skip|/:oY|/:#-0|/:hiphot|/:kiss|/:<&|/:&>)", "g"),
          emoji = ["😄", "😆", "😊", "😃", "☺️", "😏", "😍", "😘", "😚", "😳", "😌", "😁", "😉", "😜", "😝", "😀", "😗", "😙", "😛", "😴", "😟", "😦", "😧", "😮", "😬", "😕", "😯", "😑", "😒", "😅", "😓", "😥", "😩", "😔", "😞", "😖", "😨", "😰", "😣", "😢", "😭", "😂", "😲", "😱", "😫", "😠", "😡", "😤", "😪", "😋", "😷", "😎", "😵", "😈", "😐", "😶", "😇", "🙆", "🙅", "🙎", "💆", "🐶", "🐭", "🐹", "🐰", "🐺", "🐸", "🐯", "🐻", "🐷", "🐮", "🐵", "🐴", "🐼", "🐲", "🌞", "🌝", "🌚", "🌜", "🌛"],
          rEmoji = new RegExp("(" + emoji.join("|") + ")", "g");

        input = input.replace(/&amp;/g, '&')
          .replace(/&quot;/g, '"')
          .replace(/&#39;/g, '\'')
          .replace(/&lt;/g, '<')
          .replace(/&gt;/g, '>');

        input = input.replace(/\n/g, '<br>').replace(/\s/g, '&nbsp;');

        return input.replace(rFace, function (match, text) {
          var num = face.indexOf(match) + 1;
          (num < 10) && (num = "0" + num);
          return "<img class='qqface-img' src='/ace/js/angular-qqface/face/" + num + ".gif' facecode='" + text + "' end=''>";
        }).replace(rEmoji, function (match, text) {
          return "<img src='https://wx2.qq.com/zh_CN/htmledition/v2/images/spacer.gif' class='emoji-img emoji emoji_" + convert(text) + "' facecode='" + text + "' end=''>";
        });
      }
    }
  }

  function discount() {
    return function (val) {
      return (val / 10).toFixed(1);
    }
  }

  function myPrice() {
    return {
      restrict: 'A',
      require: 'ngModel',
      link: function (scope, elem, attr, ctrl) {
        function formatter(value) {
          if (!value) return '0.00';
          if (typeof value === 'number') value = value.toString();
          if (value.length > 2) {
            return value.substr(0, value.length - 2) + '.' + value.substr(value.length - 2, value.length - 1);
          } else {
            if (value.length === 2) {
              return '0.' + value;
            } else {
              var count = 2 - value.length, str = '0.';
              for (var i = 0; i < count; i++) {
                str += '0';
              }
              return str + value;
            }
          }
        }

        function parser(val) {
          return val * 100;
        }

        ctrl.$formatters.push(formatter);
        ctrl.$parsers.push(parser);
      }
    };
  }

  function mySelect($parse) {
    return {
      restrict: 'A',
      require: 'ngModel',
      link: function (scope, elem, attr, ctrl) {
        var selec = attr.ngOptions.match(/in (.*)$/)[1];
        var array;
        var value = attr.mySelect ? attr.mySelect : 'id';

        function parser(val) {
          array = $parse(selec)(scope);
          var obj;
          for (var i in array) {
            if (array[i][value] == val) {
              obj = array[i];
              continue;
            }
          }
          return obj;
        }

        ctrl.$parsers.push(parser);
      }
    };
  }

  mySelect.$inject = ['$parse'];

  function myDate() {
    return {
      restrict: 'A',
      require: 'ngModel',
      link: function (scope, elem, attr, ctrl) {
        function formatter(value) {
          return new Date(value * 1000);
        }

        function parser(val) {
          return Math.floor(+new Date(val) / 1000);
        }

        ctrl.$formatters.push(formatter);
        ctrl.$parsers.push(parser);
      }
    };
  }

  function myDatePicker($filter) {
    return {
      restrict: 'A',
      require: 'ngModel',
      link: function (scope, elem, attr, ctrl) {
        function formatter(value) {
          return $filter('date')(value * 1000, 'yyyy-MM-dd HH:mm:ss');
        }

        function parser(val) {
          return Math.floor(+new Date(val) / 1000);
        }

        ctrl.$formatters.push(formatter);
        ctrl.$parsers.push(parser);
      }
    };
  }

  myDatePicker.$inject = ['$filter'];

  function myCheckBox($parse) {
    return {
      require: 'ngModel',
      link: function (scope, elem, attr, ctrl) {
        var array = [1, 2];
        if (attr.myCheckBox) {
          array = $parse(attr.myCheckBox)(scope);
        }
        function formatter(value) {
          if (value == array[0]) return true;
          else return false;
        }

        function parser(val) {
          if (val) return array[0];
          else return array[1];
        }

        ctrl.$formatters.push(formatter);
        ctrl.$parsers.push(parser);
      }
    };
  }

  myCheckBox.$inject = ['$parse'];

  function openCloseModal() {
    return {
      restrict: 'EAC',
      link: function (scope, elem) {
        elem.attr('data-keyboard', 'false');
        elem.attr('data-backdrop', 'static');
      }
    };
  }

  function regPercent() {
    return {
      restrict: 'EAC',
      compile: function (element, attr) {
        $(element).attr('maxlength', '7');
        attr.ngPattern = '/^(([1-9][0-9]{0,1}|0)(\\.[0-9]{1,2})?|100(\\.[0]{1,2})?)$/';  //百分比
      }
    };
  }

  function regIntAndZero() {
    return {
      restrict: 'EAC',
      compile: function (element, attr) {
        $(element).attr('maxlength', '7');
        attr.ngPattern = '/^([1-9][0-9]{0,6}|0)$/';  //正整数且可以等于0
      }
    };
  }

  function regInt() {
    return {
      restrict: 'EAC',
      compile: function (element, attr) {
        attr.ngPattern = '/^[1-9][0-9]{0,6}$/';  //正整数且不可以等于0
      }
    };
  }

  function regMoney() {
    return {
      restrict: 'EAC',
      compile: function (element, attr) {
        $(element).attr('maxlength', '10');
        attr.ngPattern = '/^([1-9]\\d{0,6}(\\.\\d{1,2})?|0\\.[1-9][0-9]?|0\\.[0-9][1-9])$/'; //金额
      }
    };
  }

  function regDiscont() {
    return {
      restrict: 'EAC',
      compile: function (element, attr) {
        //$(element).attr('maxlength', '10');
        attr.ngPattern = '/^([1-9]{1}(\\.[1-9]{0,1})?|0\\.[1-9])$/'; //折扣(1~9,1~9.1~9,0.1~9)
      }
    };
  }

  function regMoneyWithZero() {
    return {
      restrict: 'EAC',
      compile: function (element, attr) {
        $(element).attr('maxlength', '10');
        attr.ngPattern = '/^([1-9]\\d{0,6}(\\.\\d{1,2})?|0\\.[1-9][0-9]?|0\\.[0-9][1-9]|0)$/'; //金额
      }
    };
  }

  function regMoneyWithOne() {
    return {
      restrict: 'EAC',
      compile: function (element, attr) {
        $(element).attr('maxlength', '6');
        attr.ngPattern = '/^(1[0-9]{1,2}(\\.[0-9]{1,2})?|200(\\.[0]0?)?|[2-9][0-9]?(\\.[0-9]{1,2})?|[1-9](\\.[0-9]{1,2})?)$/'; //金额
      }
    };
  }

  function regNumber() {
    return {
      restrict: 'EAC',
      compile: function (element, attr) {
        $(element).attr('maxlength', '10');
        attr.ngPattern = '/^([1-9]\\d{0,6}(\\.\\d{1,2})?|0\\.[1-9][0-9]?|0\\.[0-9][1-9])$/';
      }
    };
  }

  function regMobile() {
    return {
      restrict: 'EAC',
      compile: function (element, attr) {
        if (!$(element).attr('maxlength')) {
          $(element).attr('maxlength', 13);
        }
        attr.ngPattern = '/^(1[3|4|5|7|8][\\d]{9}|0[\\d]{2,3}-[\\d]{7,8}|400[-]?[\\d]{3}[-]?[\\d]{4})$/'; // 手机号码
      }
    };
  }

  /**
   * @desc 校验电话号码
   * @example
   * <input name="phone" class="line" placeholder="请输入您的电话号码" required ng-model="phone" reg-telephone type="text">
   * <span class="rederror" ng-show="myform.phone.$error.telephone">请输入正确的电话号码</span>
   */
  function regTelephone() {
    return {
      restrict: 'A',
      require: 'ngModel',
      link: function (scope, elem, attrs, ngModelCtrl) {
        ngModelCtrl.$parsers.push(function (viewValue) {
          if (/^(1[3|4|5|7|8][\d]{9}|0[\d]{2,3}-[\d]{7,8}|400[-]?[\d]{3}[-]?[\d]{4})$/.test(viewValue) || !viewValue) {
            ngModelCtrl.$setValidity('telephone', true);
          } else {
            ngModelCtrl.$setValidity('telephone', false);
          }
          return viewValue;
        });
      }
    };
  }

  /**
   * @desc 校验字符长度
   *
   * @param
   * ng-model * 必填
   * name * 必填
   * ng-trim * 必填 [Boolean] 是否去前后空格 默认true
   * diff-zh [Boolean] 是否区别中文 默认false
   * reg-char-len [Number] 最大长度 默认16
   * prompt-msg * 必填 [String] 提示信息
   * prompt-type [Number] 提示类型 默认1 （1.您还能输入40个字符、 2.当前已输入0个字符，您还能输入40个字符）
   *
   * @return
   * formName.inputName.$error.exceed 超出最大字符数时为true
   *
   * @example
   * <input type="text" class="form-control" ng-model="tagname" name="tagname" placeholder="不能超过40个字符或20个汉字" reg-char-len="40" prompt-msg="promptMsg" prompt-type="1" ng-trim="false" diff-zh="true" required>
   * <span class="inline padding5" ng-class="{'red':namemy.tagname.$error.exceed}" ng-bind="promptMsg"></span>
   */
  function regCharLen() {
    return {
      restrict: 'A',
      require: 'ngModel',
      scope: {
        promptMsg: '='
      },
      link: function (scope, elem, attrs, ngModelCtrl) {

        var charLen = 0;//输入的字符长度
        var maxLen = parseInt(attrs.regCharLen) || 16;//最大长度
        var subfix = attrs.diffZh === 'true' ? '字符' : '字';//后缀
        var prefix = attrs.promptType === '2' ? '当前已输入' + charLen + '个' + subfix + '，' : '';//前缀

        //校验长度
        function validateLen(viewValue) {
          viewValue = viewValue || '';
          charLen = attrs.diffZh === 'true' ? wsh.getLength(viewValue) : viewValue.length;//如果区别中文
          if (charLen <= maxLen) {
            if (charLen === maxLen && !viewValue.trim()) {
              scope.promptMsg = '您输入的数据有误';
              ngModelCtrl.$setValidity('exceed', false);
            } else {
              prefix = attrs.promptType === '2' ? '当前已输入' + charLen + '个' + subfix + '，' : '';//前缀
              scope.promptMsg = prefix + '您还能输入' + (maxLen - charLen) + '个' + subfix;
              ngModelCtrl.$setValidity('exceed', true);
            }
          } else {
            scope.promptMsg = '您已输入超过' + maxLen + '个' + subfix;
            ngModelCtrl.$setValidity('exceed', false);
          }
          return viewValue;
        }

        //$parsers管道添加校验函数
        ngModelCtrl.$parsers.push(validateLen);

        //在渲染页面前校验字符长度
        ngModelCtrl.$render = function () {
          elem.val(validateLen(ngModelCtrl.$viewValue));
        };
      }
    };
  }

  function regGtten() {
    return {
      restrict: 'A',
      require: 'ngModel',
      link: function (scope, elem, attrs, ngModelCtrl) {
        ngModelCtrl.$parsers.push(function (viewValue) {
          if (/^[1-9][0-9]{1,7}$/.test(viewValue) || !viewValue) {
            ngModelCtrl.$setValidity('gtten', true);
          } else {
            ngModelCtrl.$setValidity('gtten', false);
          }
          return viewValue;
        });
      }
    };
  }

  function regEmail() {
    return {
      restrict: 'EAC',
      compile: function (element, attr) {
        attr.ngPattern = '/^([a-z0-9_\\.-]+)@([\\da-z\\.-]+)\\.([a-z\\.]{2,6})$/'; // email
      }
    };
  }

  function regUrl() {
    return {
      restrict: 'EAC',
      compile: function (element, attr) {
        var strRegex = "/^((https|http|ftp|rtsp|mms)?:\\/\\/)"
          + "?(([0-9a-z_!~*'()\\.&=+$%-]+: )?[0-9a-z_!~*'()\\.&=+$%-]+@)?"
          + "(([0-9]{1,3}\\.){3}[0-9]{1,3}"
          + "|"
          + "([0-9a-z_!~*'()-]+\\.)*"
          + "([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\\."
          + "[a-z]{2,6})"
          + "(:[0-9]{1,4})?"
          + "((/?)|"
          + "(/[0-9a-z_!~*'()\\.;?:@&=+$,%#-]+)+/?)$/";
        attr.ngPattern = strRegex;  // url
      }
    };
  }

  function regIntAndChar() {
    return {
      restrict: 'EAC',
      compile: function (element, attr) {
        attr.ngPattern = '/^[A-Za-z0-9]+$/';//只允许 数字和26个英文字母组成的字符串  前部英文  后部数字
      }
    };
  }

  function regIntAndCharAndLine() {
    return {
      restrict: 'EAC',
      compile: function (element, attr) {
        attr.ngPattern = '/^[A-Za-z0-9_]+$/';//只允许 数字和26个英文字母组成的字符串  前部英文  后部数字
      }
    };
  }

  function regChinese() {
    return {
      restrict: 'EAC',
      compile: function (element, attr) {
        attr.ngPattern = '/^[\\u2E80-\\u9FFF]+$/'; //只允许 汉字
      }
    };
  }

  function regName() {
    return {
      restrict: 'EAC',
      compile: function (element, attr) {
        attr.ngPattern = '/^[\\u2E80-\\u9FFF]{2,5}$/'; //只允许 汉字
      }
    };
  }

  /**
   * @desc 校验银行卡号
   * @example
   * <input name="cardNo" class="line" placeholder="请输入您的银行卡号" required ng-model="cardNo" reg-card-no type="text">
   * <span class="rederror" ng-show="myform.cardNo.$error.cardNo">请输入正确的银行卡号</span>
   */
  function regCardNo() {
    return {
      restrict: 'A',
      require: 'ngModel',
      link: function (scope, elem, attrs, ngModelCtrl) {
        ngModelCtrl.$parsers.push(function (viewValue) {
          if (/^[\d]{12,19}$/.test(viewValue) || !viewValue) {
            ngModelCtrl.$setValidity('cardNo', true);
          } else {
            ngModelCtrl.$setValidity('cardNo', false);
          }
          return viewValue;
        });
      }
    };
  }

  function regMoneyWithBetween() {
    return {
      restrict: 'A',
      require: 'ngModel',
      link: function (scope, elem, attr, ctrl) {
        ctrl.$parsers.push(function (viewValue) {
          var between = $(elem).attr('reg-money-with-between');
          between = between.split("|");
          var min = between[0];
          var max = between[1];
          if (parseFloat(viewValue) <= parseFloat(max) && parseFloat(viewValue) >= parseFloat(min)) {
            ctrl.$setValidity('regMoneyWithBetween', true);
            return viewValue;
          } else {
            ctrl.$setValidity('regMoneyWithBetween', false);
          }
        });
      }
    };
  }

  function maxStringLength() {
    return {
      restrict: 'A',
      require: 'ngModel',
      link: function (scope, elem, attr, ctrl) {
        ctrl.$parsers.push(function (viewValue) {
          //输入文本对应字符数（比如utf8编码，一个汉字对应3个字符）
          function utf8_strlen(str, len) {
            var ret = {cnt: 0, string: ''};
            for (var i = 0; i < str.length; i++) {
              var value = str.charCodeAt(i);
              if (value < 0x080) {
                ret.cnt += 1;
              } else if (value < 0x0800) {
                ret.cnt += 2;
              } else {
                ret.cnt += 3;
              }
              if (ret.cnt <= len) {
                ret.string += str[i];
              }
            }
            return ret;
          }

          var stringLength = $(elem).attr('max-string-length');
          var ret = utf8_strlen(viewValue, stringLength)
          if (ret.cnt <= stringLength) {
            ctrl.$setValidity('maxStringLength', true);
            return viewValue;
          } else {
            ctrl.$setValidity('maxStringLength', false);
            return true;
          }
        });
      }
    };
  }

  function onFinishRenderFilters($rootScope) {
    return {
      restrict: 'A',
      link: function (scope) {
        if (scope.$last === true) {
          $rootScope.$broadcast('ngRepeatFinished');
        }
      }
    };
  }

  onFinishRenderFilters.$inject = ['$rootScope'];

  /**
   * 元素失去焦点后自动补零
   * <xxx zero-fill="2">
   * ng-model 为必填
   * 参数为小数位数 默认为2
   */
  function zeroFill() {
    return {
      restrict: 'A',
      require: 'ngModel',
      link: function (scope, element, attrs, ngModel) {
        //保留小数位数
        var cnt = parseInt(attrs.zeroFill) || 2;
        element.bind('blur', function () {
          var value = element.val();
          value = parseInt(value) ? value : '';//如果是合法的数字
          if (value.indexOf('.') > -1) {//如果值包含小数点
            var arr = value.split('.');

            for (var i = arr[1].length; i < cnt; i++) {
              value += '0';
            }
          } else if (value) {//如果值不包含小数点
            value += '.';
            for (var i = 0; i < cnt; i++) {
              value += '0';
            }
          }
          //更新值
          scope.$apply(function () {
            ngModel.$setViewValue(value);
            element.val(value);
          });
        });
      }
    };
  }

  /**
   * 获取textarea内容长度
   * <xxx textarea-len max="250" length="cnt">
   * length 展示长度的字段 必填
   * max 内容的最大长度 默认250
   */
  function textareaLen() {
    return {
      restrict: 'A',
      require: 'ngModel',
      scope: {
        max: '@',
        length: '='
      },
      link: function (scope, element, attrs, ngModel) {

        //覆盖默认的$render方法
        ngModel.$render = function () {
          setLength(ngModel.$viewValue, false);//设置长度
          element.val(ngModel.$viewValue);//设置内容
        };

        var len = scope.length = 0;
        scope.max = scope.max ? scope.max : 250;//可输入的最大长度 默认250个字符

        //设置长度
        function setLength(value, b) {
          len = JSON.stringify(value).replace(/[\\n]/g, '').length - 2;//获取内容长度（过滤回车和stringify多出的两个字符） 得到长度
          scope.length = len;
          if (b === undefined)scope.$apply();//设置长度 立即刷新视图
        }

        element.bind('keydown', function (event) {
          setLength(event.target.value);
          if (len >= scope.max && event.keyCode !== 8 && !(event.ctrlKey && (event.keyCode === 65 || event.keyCode === 86 || event.keyCode === 67 || event.keyCode === 88))) event.preventDefault();//如果长度超过最大值并且输入的不是删除键就禁止输入
        }).bind('keyup', function (event) {
          setLength(event.target.value);
        }).bind('paste', function (event) {
          event.preventDefault();
          var val = element.val() + event.clipboardData.getData('text').replace(/<([^>]*)>/g, '');
          ngModel.$setViewValue(val);
          element.val(val);
        });
      }
    };
  }

  function qqface($filter) {

    return {
      restrict: 'E',
      template: '<span class="emotion qqface-btn float-left"></span>',
      replace: true,
      scope: {
        target: '='
      },
      link: function (scope, element) {
        element = $(element[0]);
        var face = ['/::)', '/::~', '/::B', '/::|', '/:8-)', '/::<', '/::$', '/::X', '/::Z', '/::\'(', '/::-|', '/::@', '/::P', '/::D', '/::O', '/::(', '/::+', '/:--b', '/::Q', '/::T', '/:,@P', '/:,@-D', '/::d', '/:,@o', '/::g', '/:|-)', '/::!', '/::L', '/::>', '/::,@', '/:,@f', '/::-S', '/:?', '/:,@x', '/:,@@', '/::8', '/:,@!', '/:!!!', '/:xx', '/:bye', '/:wipe', '/:dig', '/:handclap', '/:&-(', '/:B-)', '/:<@', '/:@>', '/::-O', '/:>-|', '/:P-(', '/::\'|', '/:X-)', '/::*', '/:@x', '/:8*', '/:pd', '/:<W>', '/:beer', '/:basketb', '/:oo', '/:coffee', '/:eat', '/:pig', '/:rose', '/:fade', '/:showlove', '/:heart', '/:break', '/:cake', '/:li', '/:bome', '/:kn', '/:footb', '/:ladybug', '/:shit', '/:moon', '/:sun', '/:gift', '/:hug', '/:strong', '/:weak', '/:share', '/:v', '/:@)', '/:jj', '/:@@', '/:bad', '/:lvu', '/:no', '/:ok', '/:love', '/:<L>', '/:jump', '/:shake', '/:<O>', '/:circle', '/:kotow', '/:turn', '/:skip', '/:oY', '/:#-0', '/:kiss', '/:<&', '/:&>'].join('');
        var pop = $('<div class="qqface-panel">' + $filter('sysface')(face) + '</div>');
        pop.find('img').bind('click', function (e) {
          e.stopPropagation();
          scope.target.execCommand('inserthtml', e.target.outerHTML);
          pop.hide();
        });
        element.bind('click', function () {
          if (!element.parent().find('.qqface-panel').length) {
            element.parent().append(pop);
          } else {
            pop.toggle();
          }
        });
        document.addEventListener('click', function (e) {
          if (!$(e.target).closest('.qqface-btn').length && !$(e.target).closest('.qqface-panel').length) {
            pop.hide();
          } else {
            pop.show();
          }
        });
      }
    };
  }

  qqface.$inject = ['$filter'];

  function emoji($filter) {

    return {
      restrict: 'E',
      template: '<span class="emoji-btn emoji float-left"></span>',
      scope: {
        target: '='
      },
      replace: true,
      link: function (scope, element) {
        element = $(element[0]);
        var emoji = "😄😆😊😃☺️😏😍😘😚😳😌😁😉😜😝😀😗😙😛😴😟😦😧😮😬😕😯😑😒😅😓😥😩😔😞😖😨😰😣😢😭😂😲😱😫😠😡😤😪😋😷😎😵😈😐😶😇🙆🙅🙎💆🐶🐭🐹🐰🐺🐸🐯🐻🐷🐮🐵🐴🐼🐲🌞🌝🌚🌜🌛";
        var pop = $('<div class="emoji-panel">' + $filter('sysface')(emoji) + '</div>');
        pop.find('img').bind('click', function (e) {
          e.stopPropagation();
          scope.target.execCommand('inserthtml', e.target.outerHTML);
          pop.hide();
        });
        element.bind('click', function () {
          if (!element.parent().find('.emoji-panel').length) {
            element.parent().append(pop);
          } else {
            pop.toggle();
          }
        });
        document.addEventListener('click', function (e) {
          if (!$(e.target).closest('.emoji-btn').length && !$(e.target).closest('.emoji-panel').length) {
            pop.hide();
          } else {
            pop.show();
          }
        });
      }
    };
  }

  emoji.$inject = ['$filter'];

  function ngPaginate() {
    return {
      restrict: 'A',
      template: '<div class="ng-paginate" ng-show="page.total_page>1">' +
      '<uib-pagination boundary-links="true" ng-change="go()" total-items="page.total_count" items-per-page="page.per_page" ng-model="currentPage" max-size="5" previous-text="«" next-text="»" last-text="末页" first-text="首页"></uib-pagination>' +
      '<ul class="pagination">' +
      '<li class="ng-paginate-search"><span class="text-box"><input ng-model="goPage" ng-keypress="enterEvent($event)"></span></li>' +
      '<li class="ng-paginate-search"><span><button class="btn" ng-click="search()">共<span ng-bind="page.total_page"></span>页/搜索</button></span></li>' +
      '<li class="ng-paginate-search"><span class="text">共<span ng-bind="page.total_count"></span>条</span></li>' +
      '</ul>' +
      '</div>',
      replace: true,
      scope: {
        options: '=options',
        page: '=page'
      },
      link: function (scope) {

        //后端第一页为0 监听返回的页码 +1赋值
        scope.$watch('page.current_page', function (newV, oldV) {
          if (newV !== oldV && newV !== undefined) {
            scope.currentPage = parseInt(newV) + 1;
          }
        });

        //回车事件
        scope.enterEvent = function (event) {
          //当键入回车 阻止默认事件和事件传播 并调用查询方法
          if (event.keyCode === 13 || event.charCode === 13) {
            event.stopPropagation();
            event.preventDefault();
            scope.search();
          }
        }

        //跳转方法
        scope.go = function () {
          scope.goPage = '';
          scope.options.callback(parseInt(scope.currentPage));
        }

        //查询方法
        scope.search = function () {
          //如果是正整数
          if (/^\d+$/.test(scope.goPage)) {
            if (scope.goPage == scope.currentPage) {//如果目标页等于当前页
              scope.goPage = '';
            } else if (scope.goPage < 1 || scope.goPage > scope.page.total_page) {//如果目标页大于最大页或者小于一页
              alert('无法跳转至目标页');
              scope.goPage = '';
            } else {
              scope.currentPage = parseInt(scope.goPage);
              scope.options.callback(scope.currentPage);
            }
          } else {
            scope.goPage = '';
          }
        }
      }
    };
  }

  function choosePeople($filter, $http) {
    return {
      restrict: 'A',
      template: '<table class="table table-striped table-bordered table-width ">' +
      '<thead>' +
      '<tr>' +
      '<th width="25%" class="align-center">选择代理商/终端店</th>' +
      '<th width="75%" class="align-center">所选员工</th>' +
      '</tr>' +
      '</thead>' +
      '<tbody>' +
      '<tr>' +
      '<td class="no-padding">' +
      '<div class="padding10" style="height: 350px; overflow: hidden; overflow-y: scroll; box-sizing: border-box; text-align: left;">' +
      '<div class="tree-container"></div>' +
      '</div>' +
      '</td>' +
      '<td class="no-padding">' +
      '<div style="height: 350px; overflow: hidden; overflow-y: scroll; box-sizing: border-box">' +
      '<table class="table table-striped table-width ">' +
      '<thead>' +
      '<tr>' +
      '<th width="10%" class="align-center">' +
      '<label>' +
      '<input type="checkbox" class="ace" ng-model="checkAll" ng-change="personnelCheck()">' +
      '<span class="lbl"></span>' +
      '</label>' +
      '</th>' +
      '<th width="30%" class="align-center">员工</th>' +
      '<th width="30%" class="align-center">终端店</th>' +
      '<th width="30%" class="align-center">代理商</th>' +
      '</tr>' +
      '</thead>' +
      '<tbody>' +
      '<tr ng-repeat="personnel in peopleList">' +
      '<td style="position: relative;">' +
      '<label>' +
      '<input type="checkbox" class="ace" ng-model="personnel.checked" ng-change="personnelCheck(personnel)">' +
      '<span class="lbl"></span>' +
      '</label>' +
      '</td>' +
      '<td ng-bind="personnel.text"></td>' +
      '<td ng-bind="personnel.terminalName"></td>' +
      '<td ng-bind="personnel.agentName"></td>' +
      '</tr>' +
      '</tbody>' +
      '</table>' +
      '</div>' +
      '</td>' +
      '</tr>' +
      '</tbody>' +
      '</table>',
      scope: {
        peopleList: '='
      },
      link: function (scope, element) {

        var elem = $(element[0]).find('.tree-container');
        //初始化页面分类下拉框
        $http.post('/employees-code/policy-relation-staff-list-ajax', {})
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              elem.jstree({
                plugins: ['checkbox'],
                multiple: false,
                core: {
                  data: msg.errmsg
                }
              });
            });
          });

        var selected = [];

        elem.on('changed.jstree', function (e, data) {
          selected = [];
          //获取选中的节点
          data.instance.get_selected(true).map(function (obj) {
            //获取员工
            if (obj.original.icon === 'icon-3') {
              var terminal = data.instance.get_node(obj.parents[0]).original || {};
              var agent = data.instance.get_node(obj.parents[1]).original || {};
              selected.push($.extend({
                terminalName: terminal.text || '',
                terminalId: terminal._id || '',
                agentName: agent.text || '',
                agentId: agent._id || '',
                id: obj.original._id
              }, obj.original));
            }
          });
          var temp = {};
          scope.peopleList.map(function (o) {
            $.each(selected, function (idx, obj) {
              if (obj._id === o._id) {
                temp[o._id] = o.checked;
                return false;
              }
            });
          });
          selected.map(function (o) {
            o.checked = temp[o._id];
          });
          selected = $filter('orderBy')(selected, 'terminalId');
          scope.peopleList = selected;
          scope.$digest();
        });

        scope.checkAll = false;

        scope.personnelCheck = function (param) {
          if (param) {
            var b = true;
            $.each(scope.peopleList, function (idx, obj) {
              if (!obj.checked) {
                b = false;
              }
            });
            scope.checkAll = b;
          } else {
            angular.forEach(scope.peopleList, function (obj) {
              obj.checked = scope.checkAll;
            });
          }
        };
      }
    };
  }

  choosePeople.$inject = ['$filter', '$http'];

  //操作员
  function selecOperator($filter, $http) {
    return {
      // region template
      restrict: 'A',
      template: '<table class="table table-striped table-bordered table-width ">' +
      '<thead>' +
      '<tr>' +
      '<th width="25%" class="align-center">选择操作员</th>' +
      '<th width="75%" class="align-center"></th>' +
      '</tr>' +
      '</thead>' +
      '<tbody>' +
      '<tr>' +
      '<td class="no-padding">' +
      '<div class="padding10" style="height: 350px; overflow: hidden; overflow-y: scroll; box-sizing: border-box; text-align: left;">' +
      '<div class="tree-container"></div>' +
      '</div>' +
      '</td>' +
      '<td class="no-padding">' +
      '<div style="height: 350px; overflow: hidden; overflow-y: scroll; box-sizing: border-box">' +
      '<table class="table table-striped table-width ">' +
      '<thead>' +
      '<tr>' +
      '<th width="10%" class="align-center">' +
      '<label>' +
      '<input type="checkbox" class="ace" ng-model="checkAll" ng-change="personnelCheck()">' +
      '<span class="lbl"></span>' +
      '</label>' +
      '</th>' +
      '<th width="30%" class="align-center">操作员</th>' +
      '<th width="30%" class="align-center">操作员角色</th>' +
      '<th width="30%" class="align-center">微信绑定状态</th>' +
      '</tr>' +
      '</thead>' +
      '<tbody>' +
      '<tr ng-repeat="personnel in peopleList">' +
      '<td style="position: relative;" class="align-center">' +
      '<label>' +
      '<input type="checkbox" class="ace" ng-model="personnel.checked" ng-change="personnelCheck(personnel)">' +
      '<span class="lbl"></span>' +
      '</label>' +
      '</td>' +
      '<td ng-bind="personnel.text" class="align-center"></td>' +
      '<td ng-bind="personnel.terminalName" class="align-center"></td>' +
      '<td ng-bind="personnel.is_bind | isBind" class="align-center"></td>' +
      '</tr>' +
      '</tbody>' +
      '</table>' +
      '</div>' +
      '</td>' +
      '</tr>' +
      '</tbody>' +
      '</table>',
      // endregion
      scope: {
        peopleList: '=',
        defaultSelected: '='
      },
      link: function (scope, element) {

        var elem = $(element[0]).find('.tree-container'), jump;
        var tempList = [];
        var flag = false;

        function findChild(obj, id) {
          if (jump) {
            if (!obj.is_bind) {
              obj.children.map(function (o) {
                findChild(o, id);
              });
            } else {
              if (obj._id == id) {
                obj.state = {"selected": true};
                if (!flag) {
                  obj.checked = true;
                }
                tempList.push(obj);
                jump = false;
              }
            }
          }
        }

        scope.$watch('defaultSelected', function (val) {
          if (val) {
            //初始化页面分类下拉框
            $http.post('/wx-msg-tpl/get-shop-receive-list', {'type_id': 1})
              .success(function (msg) {
                var arr = scope.defaultSelected || [];
                wsh.successback(msg, '', false, function () {
                  arr.map(function (value) {
                    jump = true;
                    msg.errmsg.data.map(function (obj) {
                      findChild(obj, value);
                    });
                  });
                  msg.errmsg.data = [{text: '全部操作员', children: msg.errmsg.data}];
                  elem.jstree({
                    plugins: ['checkbox'],
                    multiple: false,
                    core: {
                      data: msg.errmsg.data
                    }
                  }).bind("loaded.jstree", function () {
                    $(this).jstree("open_all");
                  });
                });
              });
          }
        });

        var selected = [];

        elem.on('changed.jstree', function (e, data) {
          selected = [];
          //获取选中的节点
          data.instance.get_selected(true).map(function (obj) {
            //获取操作员
            if (obj.original.is_bind !== undefined) {
              var terminal = data.instance.get_node(obj.parents[0]).original || {};
              var agent = data.instance.get_node(obj.parents[1]).original || {};
              selected.push($.extend({
                terminalName: terminal.text || '',
                terminalId: terminal._id || '',
                agentName: agent.text || '',
                agentId: agent._id || '',
                id: obj.original._id
              }, obj.original));
            }
          });
          var temp = {};

          scope.peopleList.map(function (o) {
            $.each(selected, function (idx, obj) {
              if (obj._id === o._id) {
                temp[o._id] = o.checked;
                return false;
              }
            });
          });

          selected.map(function (o) {
            o.checked = temp[o._id];
            $.each(scope.defaultSelected, function (idx, obj) {
              if (o.id == obj) {
                o.checked = true;
              }
            });
          });
          selected = $filter('orderBy')(selected, 'terminalId');
          scope.peopleList = selected;
          scope.$digest();
        });

        scope.checkAll = false;

        scope.personnelCheck = function (param) {
          flag = true;
          if (param) {
            var b = true;
            $.each(scope.peopleList, function (idx, obj) {
              if (!obj.checked) {
                b = false;
              }
            });
            scope.checkAll = b;
          } else {
            angular.forEach(scope.peopleList, function (obj) {
              obj.checked = scope.checkAll;
            });
          }
        };
      }
    };
  }

  selecOperator.$inject = ['$filter', '$http'];

  //商家消息-->公众号设置的门店员工
  function chooseMember($filter, $http) {
    return {
      // region template
      restrict: 'A',
      template: '<table class="table table-striped table-bordered table-width ">' +
      '<thead>' +
      '<tr>' +
      '<th width="25%" class="align-center">选择代理商/终端店</th>' +
      '<th width="75%" class="align-center">所选员工</th>' +
      '</tr>' +
      '</thead>' +
      '<tbody>' +
      '<tr>' +
      '<td class="no-padding">' +
      '<div class="padding10" style="height: 350px; overflow: hidden; overflow-y: scroll; box-sizing: border-box; text-align: left;">' +
      '<div class="tree-container"></div>' +
      '</div>' +
      '</td>' +
      '<td class="no-padding">' +
      '<div style="height: 350px; overflow: hidden; overflow-y: scroll; box-sizing: border-box">' +
      '<table class="table table-striped table-width ">' +
      '<thead>' +
      '<tr>' +
      '<th width="10%" class="align-center">' +
      '<label>' +
      '<input type="checkbox" class="ace" ng-model="checkAll" ng-change="personnelCheck()">' +
      '<span class="lbl"></span>' +
      '</label>' +
      '</th>' +
      '<th width="15%" class="align-center">员工</th>' +
      '<th width="15%" class="align-center">微信绑定状态</th>' +
      '<th width="15%" class="align-center">终端店</th>' +
      '<th width="15%" class="align-center">代理商</th>' +
      '</tr>' +
      '</thead>' +
      '<tbody>' +
      '<tr ng-repeat="personnel in peopleList">' +
      '<td style="position: relative;" class="align-center">' +
      '<label>' +
      '<input type="checkbox" class="ace" ng-model="personnel.checked" ng-change="personnelCheck(personnel)">' +
      '<span class="lbl"></span>' +
      '</label>' +
      '</td>' +
      '<td ng-bind="personnel.text" class="align-center"></td>' +
      '<td ng-bind="personnel.is_bind | isBind" class="align-center"></td>' +
      '<td ng-bind="personnel.shop_name" class="align-center"></td>' +
      '<td ng-bind="personnel.agent_name" class="align-center"></td>' +
      '</tr>' +
      '</tbody>' +
      '</table>' +
      '</div>' +
      '</td>' +
      '</tr>' +
      '</tbody>' +
      '</table>',
      // endregion
      scope: {
        peopleList: '=',
        defaultSelected: '='
      },
      link: function (scope, element) {

        var elem = $(element[0]).find('.tree-container'), jump;
        var tempList = [];
        var flag = false;

        function findChild(obj, id) {
          if (jump) {
            if (!obj.is_bind) {
              obj.children.map(function (o) {
                findChild(o, id);
              });
            } else {
              if (obj._id == id) {
                obj.state = {"selected": true};
                if (!flag) {
                  obj.checked = true;
                }
                tempList.push(obj);
                jump = false;
              }
            }
          }
        }

        //初始化页面分类下拉框
        scope.$watch('defaultSelected', function (val) {
          if (val) {
            //初始化页面分类下拉框
            $http.post('/wx-msg-tpl/get-shop-receive-list', {'type_id': 2})
              .success(function (msg) {
                var arr = scope.defaultSelected || [];
                wsh.successback(msg, '', false, function () {
                  arr.map(function (value) {
                    jump = true;
                    msg.errmsg.data.map(function (obj) {
                      findChild(obj, value);
                    });
                  });
                  msg.errmsg.data = [{text: '全部门店', children: msg.errmsg.data}];
                  elem.jstree({
                    plugins: ['checkbox'],
                    multiple: false,
                    core: {
                      data: msg.errmsg.data
                    }
                  }).bind("loaded.jstree", function () {
                    $(this).jstree("open_all");
                  });
                });
              });
          }
        });

        var selected = [];

        elem.on('changed.jstree', function (e, data) {
          selected = [];
          //获取选中的节点
          data.instance.get_selected(true).map(function (obj) {
            //获取员工
            if (obj.original.is_bind !== undefined) {
              var terminal = data.instance.get_node(obj.parents[0]).original || {};
              var agent = data.instance.get_node(obj.parents[1]).original || {};
              selected.push($.extend({
                terminalName: terminal.text || '',
                terminalId: terminal._id || '',
                agentName: agent.text || '',
                agentId: agent._id || '',
                id: obj.original._id
              }, obj.original));
            }
          });
          var temp = {};

          scope.peopleList.map(function (o) {
            $.each(selected, function (idx, obj) {
              if (obj._id === o._id) {
                temp[o._id] = o.checked;
                return false;
              }
            });
          });

          selected.map(function (o) {
            o.checked = temp[o._id];
            $.each(scope.defaultSelected, function (idx, obj) {
              if (o.id == obj) {
                o.checked = true;
              }
            });
          });
          selected = $filter('orderBy')(selected, 'terminalId');
          scope.peopleList = selected;
          scope.$digest();
        });

        scope.checkAll = false;

        scope.personnelCheck = function (param) {
          flag = true;
          if (param) {
            var b = true;
            $.each(scope.peopleList, function (idx, obj) {
              if (!obj.checked) {
                b = false;
              }
            });
            scope.checkAll = b;
          } else {
            angular.forEach(scope.peopleList, function (obj) {
              obj.checked = scope.checkAll;
            });
          }
        };
      }
    };
  }

  chooseMember.$inject = ['$filter', '$http'];

  //shanghu
  function searchBelong($http) {
    return {
      restrict: 'A',
      template: '<div class="bootbox modal fade in" tabindex="-1" role="dialog" open-close-modal aria-labelledby="myModalLabel" aria-hidden="true">' +
      '<div class="modal-dialog modal-dialog1"><div class="modal-content"><div class="modal-header modal-header2"><a class="bootbox-close-button close" data-dismiss="modal">×</a><h4 class="modal-title">归属选择</h4></div><div class="modal-body"><div class="bootbox-body">' +
      '<div class="margin-bottom5 font-size14px">已选归属：' +
      '<button class="btn btn-white btn-info btn-round margin-bottom5 margin-left5" ng-repeat="list in arr" ng-click="deleteBtn(list.id)">{{list.text}}<div class="inline"><img src="http://imgcache.vikduo.com/static/54f0adf655936fd25667e3bc92e0391c.png" width="15" height="15" style="margin: -2px -8px 0 0;" alt=关闭"" title="关闭"/></div></button>' +
      '<div class="inline margin-left10 blue pointer" ng-click="belongClearAll()">清除所选</div>' +
      '</div>' +
      '<div class="col-sm-12 across-space1 across-space2">' +
      '<div class="form-group">' +
      '<table class="table table-striped table-bordered table-width ">' +
      '<thead>' +
      '<tr>' +
      '<th  class="align-center"><div class="icon-search-gjss"> <input type="text" id="searchAgent" class="inline align-top" ng-model="queryAgent" placeholder="搜索代理商"/><i class="icon-search icon-on-right bigger-90"></i></div></th>' +
      '<th  class="align-center "><div class="icon-search-gjss"><input type="text" class="inline align-top" ng-model="queryTerminal" placeholder="搜索终端店"/><i class="icon-search icon-on-right bigger-90"></i></div></th>' +
      '<th class="align-center"><div class="icon-search-gjss"><input type="text" class="inline align-top" ng-model="queryStaff" placeholder="搜索员工"/><i class="icon-search icon-on-right bigger-90 "></i></div></th>' +
      '</tr>' +
      '</thead>' +
      '<tbody>' +
      '<tr>' +
      '<td class="no-padding">' +
      '<div class="padding10" style="height: 350px; overflow: hidden; overflow-y: scroll; box-sizing: border-box; text-align: left;">' +
      '<div class="tree-container"></div>' +
      '</div>' +
      '</td>' +
      '<td class="no-padding">' +
      '<div class="padding10" style="height: 350px; overflow: hidden; overflow-y: scroll; box-sizing: border-box; text-align: left;">' +
      '<div class="tree-store" ng-repeat="list in terminalLists | filter : {shopInfo:{name : queryTerminal}}">' +
      '<span class="pointer" ng-class="{true: \'bghover\', false: \'\'}[terminalIndex == $index]" ng-bind="list.shopInfo.name" ng-click="terminalClick(list, $index)"></span>' +
      '</div>' +
      '</div>' +
      '</td>' +
      '<td class="no-padding">' +
      '<div class="padding10" style="height: 350px; overflow: hidden; overflow-y: scroll; box-sizing: border-box; text-align: left;">' +
      '<div class="tree-staff"  ng-repeat="list in staffLists | filter: {real_name: queryStaff}">' +
      '<span class="pointer"  ng-class="{true: \'bghover\', false: \'\'}[staffIndex == $index]" ng-bind="list.real_name" ng-click="staffClick(list, $index)"></span>' +
      '</div>' +
      '</div>' +
      '</td>' +
      '</tr>' +
      '</tbody>' +
      '</table>' +
      '</div><div class="padding10">Tip：只选择代理商，查询结果为该代理商名下所有终端店的数据；选择到终端店，查询结果为该终端店下的数据。可单层级（代理商、终端店、员工）多选，不可跨层级多选。同时最多支持10条归属选择。</div> </div></div><div class="modal-footer"><a type="button" class="btn btn-default" ng-click="belongCancel()">取消</a><a type="button" class="btn btn-primary" ng-click="belongSave()">确定</a></div></div> </div></div>',
      scope: {
        options: '=',
        belongList: '=belongList'
      },
      replace: true,
      compile: function () {

        var terminalId = wsh.getHref('terminal_id');
        var agentId = wsh.getHref('agent_id');

        function initTree(elem, data) {
          elem.jstree({
            plugins: ['contextmenu', 'search'],
            core: {
              data: data,
              multiple: true
            },
            search: {
              show_only_matches: true//只显示匹配的项
            }
          }).bind("loaded.jstree", function () {
            $(this).jstree("open_all");
          });
        }

        function getAgentInfo(elem, id) {
          $http.post('/agent/get-shop-agent-ajax', {id: id})
            .success(function (msg) {
              wsh.successback(msg, '', false, function (data) {
                data.errmsg.agentInfo._id = data.errmsg.agentInfo.id;
                data.errmsg.agentInfo.text = data.errmsg.agentInfo.agent_name;
                data.errmsg.agentInfo.icon = 'icon-1';
                msg.errmsg = [data.errmsg.agentInfo];
                initTree(elem, msg.errmsg);
                setTimeout(function () {
                  $('.tree-container a').click();
                }, 1000);
              });
            });
        }

        return function (scope, element, attrs) {

          scope.queryTerminal = '';  //一定需要
          scope.queryStaff = ''; //一定需要
          var elem = $(element[0]).find('.tree-container');

          init();

          $(attrs.triggerBtn).click(function () {
            scope.arr = angular.copy(scope.belongList);
            $(element[0]).modal('show');
            if (agentId) {
              scope.terminalIndex = -1;
              scope.staffIndex = -1;
              scope.staffLists = [];
            } else if (terminalId) {
              scope.staffIndex = -1;
            } else {
              elem.jstree('deselect_all');
              scope.terminalIndex = -1;
              scope.staffIndex = -1;
              scope.terminalLists = [];
              scope.staffLists = [];
            }
          });

          scope.$watchCollection('arr', function (newV) {
            if (!newV || !newV.length) {
              scope.belongClearAll();
            }
          });

          function init() {
            if (agentId) {
              getAgentInfo(elem, agentId);
            } else if (terminalId) {
              $http.post('/terminal/detail-ajax')
                .success(function (msg) {
                  wsh.successback(msg, '', false, function (data) {
                    scope.terminalLists = [data.errmsg];
                    if (data.errmsg.shop_type === 1) {
                      initTree(elem, [
                        {
                          '_id': 0,
                          'text': '直营店',
                          'agent_name': '直营店',
                          'icon': 'icon-1'
                        }
                      ]);
                      setTimeout(function () {
                        $('.tree-container a').click();
                      }, 1000);
                    } else {
                      getAgentInfo(elem, data.errmsg.agent_id);
                    }
                  });
                });
            } else {
              $http.post('/agent/all-list-ajax', {})
                .success(function (msg) {
                  wsh.successback(msg, '', false, function () {
                    msg.errmsg.unshift({
                      '_id': 0,
                      'text': '直营店',
                      'agent_name': '直营店',
                      'icon': 'icon-1'
                    });
                    initTree(elem, msg.errmsg);
                  });
                });
            }
          }

          var agent = {}, shop = {}, person = {}, level = 0;
          scope.arr = [];

          function agentChange(obj, parent, grandParent) {
            if (agentId || terminalId) {
              level = 1;
              agent = obj;
            } else {
              obj.text = (grandParent.agent_name ? grandParent.agent_name + '-' : '') + (parent.agent_name ? parent.agent_name + '-' : '') + obj.agent_name;
              obj.id = obj._id;
              var list = scope.arr.filter(function (o) {
                if (o.id === obj.id) {
                  return o;
                }
              });
              if (!list.length) {
                if (scope.arr.length < 10) {
                  scope.arr.push({
                    text: obj.text,
                    id: obj.id
                  });
                } else {
                  alert('只支持10条归属条件');
                }
              }
              level = 0;
              agent = obj;
            }
            if (terminalId) {
              setTimeout(function () {
                $('.tree-store span').click();
              }, 1000);
            } else {
              $http.post('/terminal/list-ajax', {
                'agent_id': obj._id,
                '_page': 1,
                '_page_size': 1000
              }).success(function (msg) {
                wsh.successback(msg, '', false,
                  function () {
                    scope.terminalLists = msg.errmsg.data;
                  }
                );
              });
            }
          }

          function shopChange(obj) {
            $http.post('/staff/list-ajax', {'terminal_id': obj.id, '_page': 1, '_page_size': 1000})
              .success(function (msg) {
                wsh.successback(msg, '', false, function () {
                  scope.staffLists = msg.errmsg.data;
                });
              });
            if (terminalId) {
              level = 2;
              shop = obj;
            } else {
              var id = agent.id + '-' + obj.id;
              var text = agent.text + '-' + obj.shopInfo.name;
              var list = scope.arr.filter(function (o) {
                if (o.id === id) {
                  return o;
                }
              });
              if (!list.length) {
                if (level !== 0) {
                  if (scope.arr.length < 10) {
                    scope.arr.push({
                      text: text,
                      id: id
                    });
                  } else {
                    alert('只支持10条归属条件');
                  }
                } else {
                  var temp = scope.arr[scope.arr.length - 1];
                  temp.text = text;
                  temp.id = id;
                }
              }
              level = 1;
              shop = obj;
            }
          }

          function personChange(obj) {
            var id = agent.id + '-' + shop.id + '-' + obj.id;
            var text = agent.text + '-' + shop.shopInfo.name + '-' + obj.real_name;
            var list = scope.arr.filter(function (o) {
              if (o.id === id) {
                return o;
              }
            });
            if (!list.length) {
              if (level === 2) {
                if (scope.arr.length < 10) {
                  scope.arr.push({
                    text: text,
                    id: id
                  });
                } else {
                  alert('只支持10条归属条件');
                }
              } else {
                var temp = scope.arr[scope.arr.length - 1];
                temp.text = text;
                temp.id = id;
              }
            }
            level = 2;
            person = obj;
          }

          elem.on('changed.jstree', function (e, data) {
            if (data.node) {
              scope.staffLists = [];
              scope.terminalIndex = -1;
              var parent = data.instance.get_node(data.node.parents[0]).original || {};
              var grandParent = data.instance.get_node(data.node.parents[1]).original || {};
              agentChange(data.node.original, parent, grandParent);
            }
          });

          scope.terminalClick = function (list, index) {
            scope.terminalIndex = index;
            scope.staffIndex = -1;
            shopChange(list);
          };

          scope.staffClick = function (list, index) {
            scope.staffIndex = index;
            personChange(list);
          };

          scope.belongSave = function () {
            scope.belongList = angular.copy(scope.arr);
            scope.options.searchBelong(scope.belongList);
            $(element[0]).modal('hide');
          };

          scope.belongCancel = function () {
            $(element[0]).modal('hide');
          };

          scope.deleteBtn = function (id) {
            scope.arr.map(function (a, b) {
              if (id === a.id) {
                scope.arr.splice(b, 1);
              }
            });
          };

          //清楚全中的全部
          scope.belongClearAll = function () {
            scope.arr = [];
            if (agentId) {
              scope.terminalIndex = -1;
              scope.staffIndex = -1;
              scope.staffLists = [];
            } else if (terminalId) {
              scope.staffIndex = -1;
            } else {
              elem.jstree('deselect_all');
              scope.terminalIndex = -1;
              scope.staffIndex = -1;
              scope.terminalLists = [];
              scope.staffLists = [];
            }
          };

          var to = false;
          $('#searchAgent').keyup(function () {
            if (to) {
              clearTimeout(to);
            }
            to = setTimeout(function () {
              var v = $('#searchAgent').val();
              elem.jstree(true).search(v);
            }, 250);
          });
        }
      }
    }
  }

  searchBelong.$inject = ['$http'];

  function chooseStore($filter, $http) {
    return {
      restrict: 'A',
      template: '<table class="table table-striped table-bordered table-width ">' +
      '<thead>' +
      '<tr>' +
      '<th width="25%" class="align-center">选择代理商/终端店</th>' +
      '<th width="75%" class="align-center">所选门店</th>' +
      '</tr>' +
      '</thead>' +
      '<tbody>' +
      '<tr>' +
      '<td class="no-padding">' +
      '<div class="padding10" style="height: 350px; overflow: hidden; overflow-y: scroll; box-sizing: border-box; text-align: left;">' +
      '<div class="tree-container"></div>' +
      '</div>' +
      '</td>' +
      '<td class="no-padding">' +
      '<div style="height: 350px; overflow: hidden; overflow-y: scroll; box-sizing: border-box">' +
      '<table class="table table-striped table-width ">' +
      '<thead>' +
      '<tr>' +
      '<th width="10%" class="align-center">' +
      '<label>' +
      '<input type="checkbox" class="ace" ng-model="checkAll" ng-change="storeCheck()">' +
      '<span class="lbl"></span>' +
      '</label>' +
      '</th>' +
      '<th width="30%" class="align-center">终端店</th>' +
      '<th width="30%" class="align-center">代理商</th>' +
      '</tr>' +
      '</thead>' +
      '<tbody>' +
      '<tr ng-repeat="store in storeList">' +
      '<td style="position: relative;">' +
      '<label>' +
      '<input type="checkbox" class="ace" ng-model="store.checked" ng-change="storeCheck(store)">' +
      '<span class="lbl"></span>' +
      '</label>' +
      '</td>' +
      '<td ng-bind="store.text"></td>' +
      '<td ng-bind="store.agentName"></td>' +
      '</tr>' +
      '</tbody>' +
      '</table>' +
      '</div>' +
      '</td>' +
      '</tr>' +
      '</tbody>' +
      '</table>',
      scope: {
        storeList: '='
      },
      link: function (scope, element) {

        var elem = $(element[0]).find('.tree-container');

        //初始化页面分类下拉框'
        $http.post('/employees-code/policy-relation-store-list-ajax', {})
          .success(function (msg) {
            wsh.successback(msg, '', false, function () {
              elem.jstree({
                plugins: ['checkbox'],
                multiple: false,
                core: {
                  data: msg.errmsg
                }
              });
            });
          });

        var selected = [];

        elem.on('changed.jstree', function (e, data) {
          selected = [];
          //获取选中的节点
          data.instance.get_selected(true).map(function (obj) {
            //获取门店
            if (obj.original.icon === 'icon-2') {
              var agent = data.instance.get_node(obj.parents[0]).original || {};
              selected.push($.extend({
                agentName: agent.text || '',
                agentId: agent._id || '',
                id: obj.original._id
              }, obj.original));
            }
          });
          var temp = {};
          scope.storeList.map(function (o) {
            $.each(selected, function (idx, obj) {
              if (obj._id === o._id) {
                temp[o._id] = o.checked;
                return false;
              }
            });
          });
          selected.map(function (o) {
            o.checked = temp[o._id];
          });
          selected = $filter('orderBy')(selected, 'agentId');
          scope.storeList = selected;
          scope.$digest();
        });

        scope.checkAll = false;

        scope.storeCheck = function (param) {
          if (param) {
            var b = true;
            $.each(scope.storeList, function (idx, obj) {
              if (!obj.checked) {
                b = false;
              }
            });
            scope.checkAll = b;
          } else {
            angular.forEach(scope.storeList, function (obj) {
              obj.checked = scope.checkAll;
            });
          }
        };
      }
    };
  }

  chooseStore.$inject = ['$filter', '$http'];

  //退货退款理由
  function returnGoodsReason() {
    return function (val) {
      if (val == 1) {
        return '买/卖双方协调一致';
      } else if (val == 2) {
        return '买错/多买/不想要';
      } else if (val == 3) {
        return '商家长时间未发货';
      } else if (val == 4) {
        return '其它';
      } else {
        return '-----';
      }
    };
  }

  //退货退款理由
  function returnSendType() {
    return function (val) {
      if (val == 1) {
        return '微商户';
      } else if (val == 2) {
        return '微信';
      } else {
        return '未设置';
      }
    };
  }

  function isBind() {
    return function (val) {
      if (val == 1) {
        return '已绑定';
      } else {
        return '未绑定';
      }
    }
  }

  function bindStatus() {
    return function (val) {
      if (val == 1) {
        return '正常';
      } else if (val == 2) {
        return '已冻结';
      } else if (val == 3) {
        return '未绑定';
      } else {
        return '--';
      }
    }
  }

  function source() {
    return function (val) {
      if (val == 1) {
        return '线上申请';
      } else if (val == 2) {
        return '线下导入';
      } else {
        return '--';
      }
    }
  }

  function gender() {
    return function (val) {
      if (val == 1) {
        return '男';
      } else if (val == 2) {
        return '女';
      } else if (val == 3) {
        return '未知';
      }
    }
  }

})(window, document, angular, app, wsh);