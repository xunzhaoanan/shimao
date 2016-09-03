(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
var MessagerBox;

MessagerBox = (function() {
  function MessagerBox($icon) {
    this.$icon = $icon;
    this.isShowing = false;
    this.width = 400;
    this.height = 300;
    this.iconRight = 295;
    this.iconTop = 8;
    this.right = 10;
    this.top = 50;
  }

  MessagerBox.prototype.initContainer = function() {
    var domHtml;
    domHtml = '<div class="message-box" style="width:0px;height:0px;display: none;right:' + this.iconRight + 'px;top:' + this.iconTop + 'px;">' + '<div class="message-box-header">' + '<div class="message-box-header-type message-box-header-type0">站内消息</div>' + '<div class="clearb"></div>' + '</div>' + '<div class="message-box-body">' + '<div class="message-box-msgs">' + '</div>' + '<div class="message-empty-tip" style="display: none;">暂无消息</div>' + '<div class="message-box-more"></div>' + '</div>' + '</div>';
    this.$dom = $(domHtml).appendTo(document.body);
    this.load(0);
    return this;
  };

  MessagerBox.prototype.getMsgsDom = function() {
    if (this.$msgsDom == null) {
      this.$msgsDom = this.$dom.find('.message-box-body .message-box-msgs');
    }
    return this.$msgsDom;
  };

  MessagerBox.prototype.getMsgItem = function(message) {
    return this.$dom.find('.message-box-msg[data-message="' + message + '"]');
  };

  MessagerBox.prototype.toggle = function() {
    if (this.isShowing === true) {
      return this.hide();
    } else {
      return this.show();
    }
  };

  MessagerBox.prototype.show = function() {
    if (!this.$dom) {
      this.initContainer();
    }
    this.$dom.show().animate({
      right: this.right,
      top: this.top,
      width: this.width,
      height: this.height
    });
    return this.isShowing = true;
  };

  MessagerBox.prototype.hide = function() {
    var $dom;
    $dom = this.$dom;
    if ($dom != null) {
      $dom.show().animate({
        right: this.iconRight,
        top: this.iconTop,
        width: 0,
        height: 0
      }, function() {
        return $dom.hide();
      });
    }
    return this.isShowing = false;
  };

  MessagerBox.prototype.setType = function(type) {};

  MessagerBox.prototype.load = function(pageNum) {
    this.getRemoteData(pageNum, function(data) {
      var $msgDom, el, msgHtml, msgs;
      msgs = data.messages;
      this.user = data.user;
      $msgDom = this.getMsgsDom();
      msgHtml = this.caluateMsgHtml(msgs);
      $msgDom.append(msgHtml);
      this.checkEmpty();
      el = this;
      $msgDom.on('click', '.message-box-msg-header', function(event) {
        return el.toggleItem($(event.target).parents('.message-box-msg').data('message'));
      });
      $msgDom.on('click', '.message-box-msg-replybtn', function(event) {
        var $input, msg;
        $input = $(event.target).siblings('input');
        msg = $input.val();
        if (msg) {
          el.reply($(event.target).parents('.message-box-msg').data('message'), msg);
          return $input.val('');
        }
      });
      return this.setNewStat();
    });
    return this;
  };

  MessagerBox.prototype.checkEmpty = function() {
    var $msgDom, $tipDom;
    $msgDom = this.getMsgsDom();
    $tipDom = this.$dom.find('.message-empty-tip');
    if ($msgDom.is(':empty')) {
      return $tipDom.show();
    } else {
      return $tipDom.hide();
    }
  };

  MessagerBox.prototype.startLoad = function() {};

  MessagerBox.prototype.endLoad = function() {};

  MessagerBox.prototype.getRemoteData = function(pageNum, callback) {
    var el;
    el = this;
    this.startLoad();
    // $.ajax({
    //   'url': '/message/',
    //   'type': 'GET',
    //   'dataType': 'json',
    //   'data': {
    //     'pageNum': pageNum
    //   },
    //   'success': function(data) {
    //     if (callback != null) {
    //       callback.call(el, data);
    //     }
    //     return el.endLoad();
    //   },
    //   'error': function() {
    //     return el.endLoad();
    //   }
    // });
    //
    //
    var data = {"user":"asjmtz","messages":[{
      _id: "_id",
      read: true,
      receiver: 'receiver',
      newreply: 'newreply',
      type: 0,
      replyListHtml: 'replyListHtml',
      title: 'titel',
      sender: 'sender',
      sendTime: 1419319669909,
      content: 'content'
    }]};

    callback.call(el, data);
    return this;
  };

  MessagerBox.prototype.getTimeStr = function(time) {
    var date;
    date = new Date(time);
    return date.getFullYear() + '/' + (this.num2Str(date.getMonth() + 1)) + '/' + (this.num2Str(date.getDate())) + ' ' + (this.num2Str(date.getHours())) + ':' + (this.num2Str(date.getMinutes())) + ':' + (this.num2Str(date.getSeconds()));
  };

  MessagerBox.prototype.num2Str = function(num) {
    var prev;
    prev = '';
    if (num < 10) {
      prev = '0';
    }
    return prev + num;
  };

  MessagerBox.prototype.caluateMsgHtml = function(msgs) {
    var html, i, id, item, key, message, messageId, newMSg, readClass, replyHtml, replyListHtml, _i, _len, _ref, _ref1;
    html = '';
    newMSg = {};
    for (i = _i = 0, _len = msgs.length; _i < _len; i = ++_i) {
      item = msgs[i];
      messageId = item['messageId'];
      if (messageId) {
        message = (_ref = newMSg[messageId]) != null ? _ref : {};
        replyHtml = this.getReplyHtml(item);
        if (message.replyListHtml) {
          message.replyListHtml += replyHtml;
        } else {
          message.replyListHtml = replyHtml;
        }
        if (item.read === false && item.receiver === this.user) {
          message.newreply = true;
        }
        newMSg[messageId] = message;
      } else {
        id = item['_id'];
        if (newMSg[id]) {
          $.extend(newMSg[id], item);
        } else {
          newMSg[id] = item;
        }
      }
    }
    for (key in newMSg) {
      item = newMSg[key];
      replyHtml = '';
      readClass = ' message-box-msg-readed';
      if (item.read === false && item.receiver === this.user) {
        readClass = '';
      }
      if (item.newreply === true) {
        readClass += ' message-box-msg-newreply';
      }
      if (item.type === 0) {
        replyListHtml = (_ref1 = item.replyListHtml) != null ? _ref1 : '';
        replyHtml = '<div class="message-box-msg-btns">' + '<div class="message-box-msg-replyBtn">回复</div>' + '<div class="clearb"></div>' + '</div>' + '<div class="message-box-msg-reply">' + '<div class="message-box-msg-replylist">' + replyListHtml + '</div>' + '<div class="message-box-msg-replyinput">' + '<input type="text" />' + '<div class="message-box-msg-replybtn">发送</div>' + '</div>' + '</div>';
      }
      html += '<div class="message-box-msg" data-message="' + item._id + '">' + '<div class="message-box-msg-header' + readClass + '">' + '<div class="message-box-msg-title">' + item.title + '</div>' + '<div class="message-box-msg-sender">' + item.sender + '</div>' + '<div class="message-box-msg-sendtime">' + (this.getTimeStr(item.sendTime)) + '</div>' + '<div class="clearb"></div>' + '</div>' + '<div class="message-box-msg-body message-box-msg-collapsed">' + '<div class="message-box-msg-content">' + item.content + '</div>' + replyHtml + '</div>' + '</div>';
    }
    return html;
  };

  MessagerBox.prototype.getReplyHtml = function(message) {
    return '<div class="message-box-msg-reply-item" data-message="' + message._id + '">' + '<div class="message-box-msg-reply-itemheader">' + '<div class="message-box-msg-reply-itemsender">' + message.sender + '</div>' + '<div class="message-box-msg-reply-itemsendtime">' + (this.getTimeStr(message.sendTime)) + '</div>' + '<div class="clearb"></div>' + '</div>' + '<div class="message-box-msg-reply-itemmsg">' + message.content + '</div>' + '</div>';
  };

  MessagerBox.prototype.read = function(message, callback) {
    var el;
    el = this;
    $.ajax({
      'url': '/message/' + message,
      'type': 'PUT',
      'dataType': 'json',
      'data': {
        'read': true,
        'cols': JSON.stringify(["read"])
      },
      'success': function(data) {
        if (callback != null) {
          return callback.call(el, data);
        }
      },
      'error': function() {
        return console.log('error');
      }
    });
    return this;
  };

  MessagerBox.prototype.setNewStat = function() {
    var $dom, $newreply, $norreaded;
    $dom = this.$dom;
    $newreply = $dom.find('.message-box-msg-header.message-box-msg-newreply');
    $norreaded = ($dom.find('.message-box-msg-header')).not('.message-box-msg-readed');
    if ($newreply.length + $norreaded.length > 0) {
      return this.$icon.addClass('message-new');
    } else {
      return this.$icon.removeClass('message-new');
    }
  };

  MessagerBox.prototype.done = function(message) {
    var el;
    el = this;
    $.ajax({
      'url': '/message/' + message,
      'type': 'PUT',
      'dataType': 'json',
      'data': {
        'done': true,
        'cols': JSON.stringify(["read"])
      },
      'success': function(data) {
        if (typeof callback !== "undefined" && callback !== null) {
          return callback.call(el, data);
        }
      },
      'error': function() {
        return console.log('error');
      }
    });
    return this;
  };

  MessagerBox.prototype.open = function(message) {
    var $header, $msgItem;
    $msgItem = this.getMsgItem(message);
    $header = $msgItem.find('.message-box-msg-header');
    if (($header.get(0)) && ((!($header.is('.message-box-msg-readed'))) || ($header.is('.message-box-msg-newreply')))) {
      this.read(message);
      $header.addClass('message-box-msg-readed');
      $header.removeClass('message-box-msg-newreply');
      return this.setNewStat();
    }
  };

  MessagerBox.prototype.close = function(message) {};

  MessagerBox.prototype.toggleItem = function(message) {
    var $body, $msgItem;
    $msgItem = this.getMsgItem(message);
    $body = $msgItem.find('.message-box-msg-body');
    if ($body.is(':visible')) {
      this.close(message);
    } else {
      this.open(message);
    }
    return $body.slideToggle();
  };

  MessagerBox.prototype.reply = function(oriMsg, replyMsg) {
    var $msgItem, el, msg, msgHtml, title;
    el = this;
    $msgItem = this.getMsgItem(oriMsg);
    title = "Reply: " + ($msgItem.find('.message-box-msg-title')).html();
    msg = {
      'messageId': oriMsg,
      'title': title,
      'content': replyMsg,
      'sender': this.user
    };
    $.ajax({
      'url': '/message/',
      'type': 'POST',
      'dataType': 'json',
      'data': msg,
      'success': function(data) {
        if (typeof callback !== "undefined" && callback !== null) {
          ($msgItem.find('.message-box-msg-reply-item')).last().attr('data-message', data._id);
          return callback.call(el, data);
        }
      },
      'error': function() {
        console.log('error');
        return ($msgItem.find('.message-box-msg-reply-item')).last().addClass('message-box-msg-reply-error');
      }
    });
    msg.sendTime = new Date();
    msgHtml = this.getReplyHtml(msg);
    ($msgItem.find('.message-box-msg-replylist')).append(msgHtml);
    return this;
  };

  return MessagerBox;

})();

window.MessageBox = MessagerBox;

module.exports = MessagerBox;



},{}]},{},[1]);