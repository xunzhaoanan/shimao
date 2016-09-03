(function () {

  'use strict';

  function init() {
    var div = document.createElement("div");
    div.innerHTML = '<div class="chrome1 cover_browser"></div>' +
      '<div class="chrome2 upgrade_browser chromeframe">' +
      '<p class="tt">友情提示：</p>' +
      '<p>您的浏览器版本体验不佳，为了您能更好的交互体验，请选择谷歌 Chrome浏览器。谢谢！</p>' +
      '<a class="btn btn-xs btn-success" target="_blank" href="http://dlsw.baidu.com/sw-search-sp/soft/9d/14744/ChromeStandalone_49.0.2623.87_Setup.1457595239.exe">立即下载</a>' +
      '</div>';
    div.id = 'checkBrowserId';
    document.body.appendChild(div);
  }

  if (!window.chrome) {
    var fileref = document.createElement('link');
    fileref.setAttribute("rel", "stylesheet");
    fileref.setAttribute("type", "text/css");
    fileref.setAttribute("href", '/ace/js/checkBrowser/checkBrowser.css');
    document.getElementsByTagName("head")[0].appendChild(fileref);
    init();
    setInterval(function () {
      if (!document.getElementById('checkBrowserId')) {
        init();
      }
    }, 2000);
  }
})();


