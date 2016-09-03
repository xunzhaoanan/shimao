(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
var config;

config = exports;

config.downloadUrl = "http://file.weza.com/";

config.uploadUrl = "http://upload.qiniu.com/";



},{}],2:[function(require,module,exports){
/*!
 * EventEmitter2
 * https://github.com/hij1nx/EventEmitter2
 *
 * Copyright (c) 2013 hij1nx
 * Licensed under the MIT license.
 */
;!function(undefined) {

  var isArray = Array.isArray ? Array.isArray : function _isArray(obj) {
    return Object.prototype.toString.call(obj) === "[object Array]";
  };
  var defaultMaxListeners = 10;

  function init() {
    this._events = {};
    if (this._conf) {
      configure.call(this, this._conf);
    }
  }

  function configure(conf) {
    if (conf) {

      this._conf = conf;

      conf.delimiter && (this.delimiter = conf.delimiter);
      conf.maxListeners && (this._events.maxListeners = conf.maxListeners);
      conf.wildcard && (this.wildcard = conf.wildcard);
      conf.newListener && (this.newListener = conf.newListener);

      if (this.wildcard) {
        this.listenerTree = {};
      }
    }
  }

  function EventEmitter(conf) {
    this._events = {};
    this.newListener = false;
    configure.call(this, conf);
  }

  //
  // Attention, function return type now is array, always !
  // It has zero elements if no any matches found and one or more
  // elements (leafs) if there are matches
  //
  function searchListenerTree(handlers, type, tree, i) {
    if (!tree) {
      return [];
    }
    var listeners=[], leaf, len, branch, xTree, xxTree, isolatedBranch, endReached,
        typeLength = type.length, currentType = type[i], nextType = type[i+1];
    if (i === typeLength && tree._listeners) {
      //
      // If at the end of the event(s) list and the tree has listeners
      // invoke those listeners.
      //
      if (typeof tree._listeners === 'function') {
        handlers && handlers.push(tree._listeners);
        return [tree];
      } else {
        for (leaf = 0, len = tree._listeners.length; leaf < len; leaf++) {
          handlers && handlers.push(tree._listeners[leaf]);
        }
        return [tree];
      }
    }

    if ((currentType === '*' || currentType === '**') || tree[currentType]) {
      //
      // If the event emitted is '*' at this part
      // or there is a concrete match at this patch
      //
      if (currentType === '*') {
        for (branch in tree) {
          if (branch !== '_listeners' && tree.hasOwnProperty(branch)) {
            listeners = listeners.concat(searchListenerTree(handlers, type, tree[branch], i+1));
          }
        }
        return listeners;
      } else if(currentType === '**') {
        endReached = (i+1 === typeLength || (i+2 === typeLength && nextType === '*'));
        if(endReached && tree._listeners) {
          // The next element has a _listeners, add it to the handlers.
          listeners = listeners.concat(searchListenerTree(handlers, type, tree, typeLength));
        }

        for (branch in tree) {
          if (branch !== '_listeners' && tree.hasOwnProperty(branch)) {
            if(branch === '*' || branch === '**') {
              if(tree[branch]._listeners && !endReached) {
                listeners = listeners.concat(searchListenerTree(handlers, type, tree[branch], typeLength));
              }
              listeners = listeners.concat(searchListenerTree(handlers, type, tree[branch], i));
            } else if(branch === nextType) {
              listeners = listeners.concat(searchListenerTree(handlers, type, tree[branch], i+2));
            } else {
              // No match on this one, shift into the tree but not in the type array.
              listeners = listeners.concat(searchListenerTree(handlers, type, tree[branch], i));
            }
          }
        }
        return listeners;
      }

      listeners = listeners.concat(searchListenerTree(handlers, type, tree[currentType], i+1));
    }

    xTree = tree['*'];
    if (xTree) {
      //
      // If the listener tree will allow any match for this part,
      // then recursively explore all branches of the tree
      //
      searchListenerTree(handlers, type, xTree, i+1);
    }

    xxTree = tree['**'];
    if(xxTree) {
      if(i < typeLength) {
        if(xxTree._listeners) {
          // If we have a listener on a '**', it will catch all, so add its handler.
          searchListenerTree(handlers, type, xxTree, typeLength);
        }

        // Build arrays of matching next branches and others.
        for(branch in xxTree) {
          if(branch !== '_listeners' && xxTree.hasOwnProperty(branch)) {
            if(branch === nextType) {
              // We know the next element will match, so jump twice.
              searchListenerTree(handlers, type, xxTree[branch], i+2);
            } else if(branch === currentType) {
              // Current node matches, move into the tree.
              searchListenerTree(handlers, type, xxTree[branch], i+1);
            } else {
              isolatedBranch = {};
              isolatedBranch[branch] = xxTree[branch];
              searchListenerTree(handlers, type, { '**': isolatedBranch }, i+1);
            }
          }
        }
      } else if(xxTree._listeners) {
        // We have reached the end and still on a '**'
        searchListenerTree(handlers, type, xxTree, typeLength);
      } else if(xxTree['*'] && xxTree['*']._listeners) {
        searchListenerTree(handlers, type, xxTree['*'], typeLength);
      }
    }

    return listeners;
  }

  function growListenerTree(type, listener) {

    type = typeof type === 'string' ? type.split(this.delimiter) : type.slice();

    //
    // Looks for two consecutive '**', if so, don't add the event at all.
    //
    for(var i = 0, len = type.length; i+1 < len; i++) {
      if(type[i] === '**' && type[i+1] === '**') {
        return;
      }
    }

    var tree = this.listenerTree;
    var name = type.shift();

    while (name) {

      if (!tree[name]) {
        tree[name] = {};
      }

      tree = tree[name];

      if (type.length === 0) {

        if (!tree._listeners) {
          tree._listeners = listener;
        }
        else if(typeof tree._listeners === 'function') {
          tree._listeners = [tree._listeners, listener];
        }
        else if (isArray(tree._listeners)) {

          tree._listeners.push(listener);

          if (!tree._listeners.warned) {

            var m = defaultMaxListeners;

            if (typeof this._events.maxListeners !== 'undefined') {
              m = this._events.maxListeners;
            }

            if (m > 0 && tree._listeners.length > m) {

              tree._listeners.warned = true;
              console.error('(node) warning: possible EventEmitter memory ' +
                            'leak detected. %d listeners added. ' +
                            'Use emitter.setMaxListeners() to increase limit.',
                            tree._listeners.length);
              console.trace();
            }
          }
        }
        return true;
      }
      name = type.shift();
    }
    return true;
  }

  // By default EventEmitters will print a warning if more than
  // 10 listeners are added to it. This is a useful default which
  // helps finding memory leaks.
  //
  // Obviously not all Emitters should be limited to 10. This function allows
  // that to be increased. Set to zero for unlimited.

  EventEmitter.prototype.delimiter = '.';

  EventEmitter.prototype.setMaxListeners = function(n) {
    this._events || init.call(this);
    this._events.maxListeners = n;
    if (!this._conf) this._conf = {};
    this._conf.maxListeners = n;
  };

  EventEmitter.prototype.event = '';

  EventEmitter.prototype.once = function(event, fn) {
    this.many(event, 1, fn);
    return this;
  };

  EventEmitter.prototype.many = function(event, ttl, fn) {
    var self = this;

    if (typeof fn !== 'function') {
      throw new Error('many only accepts instances of Function');
    }

    function listener() {
      if (--ttl === 0) {
        self.off(event, listener);
      }
      fn.apply(this, arguments);
    }

    listener._origin = fn;

    this.on(event, listener);

    return self;
  };

  EventEmitter.prototype.emit = function() {

    this._events || init.call(this);

    var type = arguments[0];

    if (type === 'newListener' && !this.newListener) {
      if (!this._events.newListener) { return false; }
    }

    // Loop through the *_all* functions and invoke them.
    if (this._all) {
      var l = arguments.length;
      var args = new Array(l - 1);
      for (var i = 1; i < l; i++) args[i - 1] = arguments[i];
      for (i = 0, l = this._all.length; i < l; i++) {
        this.event = type;
        this._all[i].apply(this, args);
      }
    }

    // If there is no 'error' event listener then throw.
    if (type === 'error') {

      if (!this._all &&
        !this._events.error &&
        !(this.wildcard && this.listenerTree.error)) {

        if (arguments[1] instanceof Error) {
          throw arguments[1]; // Unhandled 'error' event
        } else {
          throw new Error("Uncaught, unspecified 'error' event.");
        }
        return false;
      }
    }

    var handler;

    if(this.wildcard) {
      handler = [];
      var ns = typeof type === 'string' ? type.split(this.delimiter) : type.slice();
      searchListenerTree.call(this, handler, ns, this.listenerTree, 0);
    }
    else {
      handler = this._events[type];
    }

    if (typeof handler === 'function') {
      this.event = type;
      if (arguments.length === 1) {
        handler.call(this);
      }
      else if (arguments.length > 1)
        switch (arguments.length) {
          case 2:
            handler.call(this, arguments[1]);
            break;
          case 3:
            handler.call(this, arguments[1], arguments[2]);
            break;
          // slower
          default:
            var l = arguments.length;
            var args = new Array(l - 1);
            for (var i = 1; i < l; i++) args[i - 1] = arguments[i];
            handler.apply(this, args);
        }
      return true;
    }
    else if (handler) {
      var l = arguments.length;
      var args = new Array(l - 1);
      for (var i = 1; i < l; i++) args[i - 1] = arguments[i];

      var listeners = handler.slice();
      for (var i = 0, l = listeners.length; i < l; i++) {
        this.event = type;
        listeners[i].apply(this, args);
      }
      return (listeners.length > 0) || !!this._all;
    }
    else {
      return !!this._all;
    }

  };

  EventEmitter.prototype.on = function(type, listener) {

    if (typeof type === 'function') {
      this.onAny(type);
      return this;
    }

    if (typeof listener !== 'function') {
      throw new Error('on only accepts instances of Function');
    }
    this._events || init.call(this);

    // To avoid recursion in the case that type == "newListeners"! Before
    // adding it to the listeners, first emit "newListeners".
    this.emit('newListener', type, listener);

    if(this.wildcard) {
      growListenerTree.call(this, type, listener);
      return this;
    }

    if (!this._events[type]) {
      // Optimize the case of one listener. Don't need the extra array object.
      this._events[type] = listener;
    }
    else if(typeof this._events[type] === 'function') {
      // Adding the second element, need to change to array.
      this._events[type] = [this._events[type], listener];
    }
    else if (isArray(this._events[type])) {
      // If we've already got an array, just append.
      this._events[type].push(listener);

      // Check for listener leak
      if (!this._events[type].warned) {

        var m = defaultMaxListeners;

        if (typeof this._events.maxListeners !== 'undefined') {
          m = this._events.maxListeners;
        }

        if (m > 0 && this._events[type].length > m) {

          this._events[type].warned = true;
          console.error('(node) warning: possible EventEmitter memory ' +
                        'leak detected. %d listeners added. ' +
                        'Use emitter.setMaxListeners() to increase limit.',
                        this._events[type].length);
          console.trace();
        }
      }
    }
    return this;
  };

  EventEmitter.prototype.onAny = function(fn) {

    if (typeof fn !== 'function') {
      throw new Error('onAny only accepts instances of Function');
    }

    if(!this._all) {
      this._all = [];
    }

    // Add the function to the event listener collection.
    this._all.push(fn);
    return this;
  };

  EventEmitter.prototype.addListener = EventEmitter.prototype.on;

  EventEmitter.prototype.off = function(type, listener) {
    if (typeof listener !== 'function') {
      throw new Error('removeListener only takes instances of Function');
    }

    var handlers,leafs=[];

    if(this.wildcard) {
      var ns = typeof type === 'string' ? type.split(this.delimiter) : type.slice();
      leafs = searchListenerTree.call(this, null, ns, this.listenerTree, 0);
    }
    else {
      // does not use listeners(), so no side effect of creating _events[type]
      if (!this._events[type]) return this;
      handlers = this._events[type];
      leafs.push({_listeners:handlers});
    }

    for (var iLeaf=0; iLeaf<leafs.length; iLeaf++) {
      var leaf = leafs[iLeaf];
      handlers = leaf._listeners;
      if (isArray(handlers)) {

        var position = -1;

        for (var i = 0, length = handlers.length; i < length; i++) {
          if (handlers[i] === listener ||
            (handlers[i].listener && handlers[i].listener === listener) ||
            (handlers[i]._origin && handlers[i]._origin === listener)) {
            position = i;
            break;
          }
        }

        if (position < 0) {
          continue;
        }

        if(this.wildcard) {
          leaf._listeners.splice(position, 1);
        }
        else {
          this._events[type].splice(position, 1);
        }

        if (handlers.length === 0) {
          if(this.wildcard) {
            delete leaf._listeners;
          }
          else {
            delete this._events[type];
          }
        }
        return this;
      }
      else if (handlers === listener ||
        (handlers.listener && handlers.listener === listener) ||
        (handlers._origin && handlers._origin === listener)) {
        if(this.wildcard) {
          delete leaf._listeners;
        }
        else {
          delete this._events[type];
        }
      }
    }

    return this;
  };

  EventEmitter.prototype.offAny = function(fn) {
    var i = 0, l = 0, fns;
    if (fn && this._all && this._all.length > 0) {
      fns = this._all;
      for(i = 0, l = fns.length; i < l; i++) {
        if(fn === fns[i]) {
          fns.splice(i, 1);
          return this;
        }
      }
    } else {
      this._all = [];
    }
    return this;
  };

  EventEmitter.prototype.removeListener = EventEmitter.prototype.off;

  EventEmitter.prototype.removeAllListeners = function(type) {
    if (arguments.length === 0) {
      !this._events || init.call(this);
      return this;
    }

    if(this.wildcard) {
      var ns = typeof type === 'string' ? type.split(this.delimiter) : type.slice();
      var leafs = searchListenerTree.call(this, null, ns, this.listenerTree, 0);

      for (var iLeaf=0; iLeaf<leafs.length; iLeaf++) {
        var leaf = leafs[iLeaf];
        leaf._listeners = null;
      }
    }
    else {
      if (!this._events[type]) return this;
      this._events[type] = null;
    }
    return this;
  };

  EventEmitter.prototype.listeners = function(type) {
    if(this.wildcard) {
      var handlers = [];
      var ns = typeof type === 'string' ? type.split(this.delimiter) : type.slice();
      searchListenerTree.call(this, handlers, ns, this.listenerTree, 0);
      return handlers;
    }

    this._events || init.call(this);

    if (!this._events[type]) this._events[type] = [];
    if (!isArray(this._events[type])) {
      this._events[type] = [this._events[type]];
    }
    return this._events[type];
  };

  EventEmitter.prototype.listenersAny = function() {

    if(this._all) {
      return this._all;
    }
    else {
      return [];
    }

  };

  if (typeof define === 'function' && define.amd) {
     // AMD. Register as an anonymous module.
    define(function() {
      return EventEmitter;
    });
  } else if (typeof exports === 'object') {
    // CommonJS
    exports.EventEmitter2 = EventEmitter;
  }
  else {
    // Browser global.
    window.EventEmitter2 = EventEmitter;
  }
}();

},{}],3:[function(require,module,exports){
var Ajax, getRandomToken;

getRandomToken = function() {
  var i, index, str, text, _i;
  str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz";
  text = "";
  for (i = _i = 1; _i <= 15; i = ++_i) {
    index = parseInt(Math.random() * 62);
    text = text + str[index];
  }
  return text;
};

Ajax = (function() {
  function Ajax() {}

  return Ajax;

})();

Ajax.request = function(options) {
  var rtoken, url;
  rtoken = getRandomToken();
  if (options.type === "GET") {
    url = options.url;
    options.data.rtoken = rtoken;
  } else {
    url = options.url + "?rtoken=" + rtoken;
  }
  return $.ajax({
    url: url,
    type: options.type,
    data: options.data,
    dataType: options.dataType,
    processData: options.processData,
    contentType: options.contentType,
    beforeSend: options.beforeSend,
    success: options.success,
    statusCode: options.statusCode
  });
};

module.exports = Ajax;



},{}],4:[function(require,module,exports){

/*
    Last Edit: Lorde-Y 1031
    Description: 截取字符
 */
var toSubString;

toSubString = function(str, len, status) {
  var chineseRegex, i, newLength, newStr, singleChar, strLength;
  newLength = 0;
  newStr = "";
  chineseRegex = /[^\x00-\xff]/g;
  singleChar = "";
  strLength = str.replace(chineseRegex, "**").length;
  i = 0;
  while (i < strLength) {
    singleChar = str.charAt(i).toString();
    if (singleChar.match(chineseRegex) != null) {
      newLength += 2;
    } else {
      newLength++;
    }
    if (newLength > len) {
      break;
    }
    newStr += singleChar;
    i++;
  }
  if (status && (strLength > len)) {
    newStr += '...';
  }
  return newStr;
};

module.exports = toSubString;



},{}],5:[function(require,module,exports){
var $fileBtn, $uploadBtn, ECENTEMITTER, EventEmitter2, SubString, ajax, app, cancleBackValue, checkTitleDes, clearErrorFormMsg, config, sys;

ajax = require("./common/ajax.coffee");

SubString = require("./common/subString.coffee");

EventEmitter2 = (require("eventemitter2")).EventEmitter2;

$uploadBtn = $("#upload-btn");

$fileBtn = $("#file-btn");

config = sys = require('../../config.coffee');

cancleBackValue = $('#is-cancle-back').val();

if (cancleBackValue === 'true') {
  $('#back-to-edit').removeClass('hide');
} else {
  $('#back-to-edit').remove();
}

$(document).on('click', '#back-to-edit', function() {
  $.cookie('App Id', window.location.pathname.split('/')[2], {
    expires: 1 / 96,
    path: '/'
  });
  return window.location.href = 'http://' + window.location.host + '/create';
});

// if ($('.preview').data('flag') === true) {
//   app = new Vue({
//     el: "#message",
//     data: {
//       title: "",
//       description: ""
//     },
//     created: function() {
//       return setTimeout(function() {
//         app.$watch("title", function(value) {
//           var value1;
//           value1 = SubString(value, 30, true);
//           $(".show .title").html(value1);
//           return $('.signal-title').html(value1);
//         });
//         return app.$watch("description", function(value) {
//           value = SubString(value, 30, true);
//           return $(".show .description").html(value);
//         });
//       });
//     }
//   });
//   app.title = $(".show .title").html();
//   app.description = $(".show .description").html();
// }

$(document).on("change", "#file-btn", function(event) {
  var appId;
  appId = $("#appId").val();
  return $.ajax({
    url: "/images/" + this.id,
    type: "POST",
    data: {},
    dataType: 'json',
    success: (function(_this) {
      return function(data) {
        var dfilename, dusername, formData;
        if (data.result === 'ok') {
          formData = new FormData();
          formData.append('token', data.token);
          formData.append('key', data.imgKey);
          formData.append('x:appId', data.appId);
          formData.append('x:username', data.username);
          formData.append('x:uid', data.uid);
          formData.append('file', $('#file-btn')[0].files[0]);
          dusername = data.username;
          dfilename = data.imgKey;
          return $.ajax({
            url: config.uploadUrl,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
              var appData;
              if (data.success === true) {
                appData = {};
                appData.imgUrl = dfilename;
                appData.cols = JSON.stringify(['imgUrl']);
                return $.ajax({
                  url: "/wezas/" + appId,
                  type: "PUT",
                  data: appData,
                  success: function(data) {
                    return $('#cover-img').attr('src', config.downloadUrl + dfilename);
                  }
                });
              }
            }
          });
        }
      };
    })(this)
  });
});

$(document).on("click", ".cover-wrapper", function(e) {
  return $("#file-btn").trigger("click");
});

$('.cover-wrapper').hover((function() {
  return $('.upload-img').css('display', 'block');
}), function() {
  return $('.upload-img').css('display', 'none');
});

ECENTEMITTER = new EventEmitter2();

$(document).on("click", ".iphone-controller .controller-btn", function(e) {
  var $active, iframe;
  iframe = $(".iphone iframe").get(0);
  if (iframe) {
    $active = $(iframe.contentWindow);
    if ($(e.target).is('.controller-up')) {
      $active.trigger('swipeDown');
      return ECENTEMITTER.emit('swipe up', 0, 0, 0);
    } else if ($(e.target).is('.controller-down')) {
      $active.trigger('swipeUp');
      return ECENTEMITTER.emit('swipe down', 0, 0, 0);
    }
  }
});

$(document).on("click", "#publish-btn", function(e) {
  var appId, desFlag, description, title, titleFlag;
  appId = $("#appId").val();
  title = $("#title").val();
  description = $("#description").val();
  titleFlag = checkTitleDes('title', title);
  desFlag = checkTitleDes('description', description);
  if (!titleFlag) {
    $("#title").focus();
    return false;
  }
  if (!desFlag) {
    $("#description").focus();
    return false;
  }
  return ajax.request({
    url: '/wezas/' + appId,
    type: 'PUT',
    data: {
      title: title,
      isPublish: true,
      description: description,
      cols: JSON.stringify(["isPublish", "title", "description"])
    },
    dataType: 'json',
    success: function(data) {
      var callBack, cancleButton;
      if (data.result === 'OK') {
        Pub.show();
        callBack = function() {
          return Pub.close();
        };
        setTimeout(callBack, 2000);
        cancleButton = '<a id="cancel-publish-btn" class="publish-btn button button-rounded button-flat-action button-cancle" href="#">' + '<i class="fa fa-cloud"></i>' + '<span>取消发布</span>' + '</a>';
        $('.publish-box').append(cancleButton);
        return $('.publish-box').find('a#publish-btn').remove();
      }
    }
  });
});

$(document).on("click", "#cancel-publish-btn", function(e) {
  var appId;
  appId = $("#appId").val();
  return ajax.request({
    url: '/wezas/' + appId,
    type: 'PUT',
    data: {
      isPublish: false,
      cols: JSON.stringify(["isPublish"])
    },
    dataType: 'json',
    success: function(data) {
      var callBack, fabuButton;
      if (data.result === 'OK') {
        canclePub.show();
        callBack = function() {
          return canclePub.close();
        };
        setTimeout(callBack, 2000);
        fabuButton = '<a id="publish-btn" class="publish-btn button button-rounded button-flat-action button-fabu" href="#">' + '<i class="fa fa-cloud"></i>' + '<span>发布</span>' + '</a>';
        $('.publish-box').append(fabuButton);
        return $('.publish-box').find('a#cancel-publish-btn').remove();
      }
    }
  });
});

checkTitleDes = function(type, value) {
  var c, i, len, leng, pattens, reg, sum, _i;
  leng = value.length;
  if (leng <= 0) {
    $('.error-msg').text('标题或描述不能为空');
    clearErrorFormMsg();
    return false;
  } else {
    pattens = "^[0-9a-zA-Z!！~·@#$%^&*()._+|{}\\\\,\\-\【\】\\ \，\;\、\"\“\”\"\：\:\。\《\》\<\>\——?\u4e00-\u9fa5]+$";
    reg = new RegExp(pattens);
    if (reg.test(value)) {
      len = leng - 1;
      sum = 0;
      for (i = _i = 0; 0 <= len ? _i <= len : _i >= len; i = 0 <= len ? ++_i : --_i) {
        c = value.charCodeAt(i);
        if ((c >= 0x0001 && c <= 0x007e) || (0xff60 <= c && c <= 0xff9f)) {
          sum++;
        } else {
          sum += 2;
        }
      }
      if (type === 'title') {
        if (sum > 50) {
          $('.error-msg').text('标题不能大于50个字符');
          clearErrorFormMsg();
          return false;
        }
      } else {
        if (sum > 70) {
          $('.error-msg').text('描述不能大于70个字符');
          clearErrorFormMsg();
          return false;
        }
      }
    } else {
      $('.error-msg').text('输入含有无效符号');
      clearErrorFormMsg();
      return false;
    }
  }
  return true;
};

clearErrorFormMsg = function() {
  var callBack;
  callBack = function() {
    return $('.error-msg').text('');
  };
  return setTimeout(callBack, 2000);
};

$("#title").bind('blur', function() {
  var value;
  value = $(this).val();
  return checkTitleDes('title', value);
});

$("#description").bind('blur', function() {
  var value;
  value = $(this).val();
  return checkTitleDes('description', value);
});



},{"../../config.coffee":1,"./common/ajax.coffee":3,"./common/subString.coffee":4,"eventemitter2":2}]},{},[5]);