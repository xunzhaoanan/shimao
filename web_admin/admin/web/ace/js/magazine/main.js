app.controller('mainController', function($scope, $rootScope, $routeParams, $location, $http, userInfo){

    wsh.editWidth = $('.edit_introduction').width();
    wsh.editLeft = $('.edit_introduction').offset().left;
    var wHeight = $(window).height();
    var version = '3.0.0';
    $('#mainContant').css('height', (wHeight - 45) + 'px');
    var q, s;
    $scope.loadLeft = function(){
        q = colorjoe.rgb("backgroundColorPicker", "#772d90", ["currentColor", "hex", "text", ["text",
            {
                text: "param demo"
            }]]);
        s = colorjoe.rgb("backgroundSelect", "#772d90", ["currentColor", "hex", "text", ["text",
            {
                text: "param demo"
            }]]);
        $scope.loaded = true;
        $("#mainMenu").niceScroll({
            cursorcolor:"#3e94e1",
            cursoropacitymax:1,
            touchbehavior:false,
            cursorwidth:"2px",
            cursorborder:"0",
            cursorborderradius:"1px"
        });
    }

    $scope.uploadImage = function(string){
        $rootScope.$broadcast('imgUpload', string);
        $rootScope.ischooseOne = true;
        $scope.imageString = string;
    }

    $scope.uploadMusic = function(string){
        $rootScope.$broadcast('musicUpload');
    }

    $scope.$on('show animate', function(e){
        $scope.showMenu = 17;
    })

    $rootScope.data = userInfo.getDate('mainContent') || {};
    if($.isEmptyObject($rootScope.data)){
        var id = $location.hash();
        $rootScope.createOrget({id: id}, false);
    }

    $scope.AlignShow = false;
    $scope.isForm = true;
    $scope.elementCount = 0;


    //预览时浏览的点是否显示
    $scope.whiteLists = [];
    $scope.changeCheck = function(){
        $rootScope.chk = !$rootScope.chk;
        $rootScope.chk ? wsh.quickDialog('页面标识显示') : wsh.quickDialog('页面标识隐藏');
        $rootScope.$broadcast('sync');
    }

    $scope.copyElement = null;//  记录复制来的元素
    //底图和手机区域的右键菜单 显示 或 隐藏 及样式的计算
    $scope.pageMenu = false;
    $scope.createMenu = false;
    $scope.pageMenuOffset = {left: 0, top: 0};
    $scope.createMenuOffset = {left: 0, top: 0};
    //公共属性 并会赋值给手机区域选中的对象
    $scope.public = {width : 160, height: 28, opacity: 100, rotate: 0, left: 0, top: 0};
    //复选框  先默认为false;
    $scope.checkScale = false;
    $scope.checkRound = false;

    //虚线框框显示设置
    $scope.frameShow = false;
    //改变宽度
    $scope.changeWidth = function(a){
        if(wsh.element && a){
            wsh.element.css('width', a.toFixed(0) + 'px');
            if($scope.checkScale && wsh.element.is('.image')){
                wsh.element.css('height', (a * wsh.scale).toFixed(0) + 'px');
                //$scope.public.height = (a * wsh.scale).toFixed(0);
            }
            $rootScope.$broadcast('sync');
        }
    };
    //改变高度
    $scope.changeHeight = function(a){
        if(wsh.element && a){
            wsh.element.css('height', a.toFixed(0) + 'px');
            if($scope.checkScale && wsh.element.is('.image')){
                wsh.element.css('width', (a/wsh.scale).toFixed(0) + 'px');
                //$scope.public.width = (a/wsh.scale).toFixed(0);
            }
            $rootScope.$broadcast('sync');
        }
    };
    //改变透明度
    $scope.changeOpacity = function(a){
        if(wsh.element && a){
            wsh.element.css('opacity', (a/100).toFixed(2));
            wsh.element.attr('opacity', (a/100).toFixed(2));
            $rootScope.$broadcast('sync');
        }
    };
    //改变旋转度
    $scope.changeRotate = function(a){
        if(wsh.element && a > -1){
            wsh.element.css(wsh.style + 'transform', 'rotateZ(' +a.toFixed(0)+ 'deg)');
            wsh.element.attr('rotateZ', a.toFixed(0));
            $rootScope.$broadcast('sync');
        }
    };
    //字体选择属性
    $scope.fontFamily = [{font: '华文细黑'}, {font: '宋体'}, {font: '黑体'}, {font: 'Cuisive'}, {font: 'Fantasy'}, {font: 'Helvetica'}, {font: 'Monospace'}, {font: 'Serif'}, {font: 'Sans-serif'}];
    $scope.fontFamilySelecd = $scope.fontFamily[2];
    $scope.changeFontFamily = function(a){
        if(wsh.element){
            wsh.element.css('font-family', a.font);
            $rootScope.$broadcast('sync');
        }
    }
    //字号选择属性
    $scope.fontSize = [{size: '12'}, {size: '14'}, {size: '16'}, {size: '18'}, {size: '24'}, {size: '30'}, {size: '36'}, {size: '48'}, {size: '60'}, {size: '72'}];
    $scope.fontSizeSelecd = $scope.fontSize[0];
    $scope.changeFontSize = function(a){
        if(wsh.element){
            wsh.element.css('font-size', a.size + 'px');
            $rootScope.$broadcast('sync');
        }
    }
    //字体样式的选择属性
    $scope.fontStyle = [{className: 'menu enlarge', iClass: 'fa fa-font', title: '增大字号'},
                        {className: 'menu shrink', iClass: 'fa fa-font', title: '减小字号'},
                        {className: 'menu bold', iClass: 'fa fa-bold', title: '加粗'},
                        {className: 'menu italic', iClass: 'fa fa-italic', title: '倾斜'},
                        {className: 'menu underline', iClass: 'fa fa-underline', title: '下划线'},
                        {className: 'menu distributed', iClass: 'fa fa-align-center', title: '居中对齐'},
                        {className: 'menu leftAligned', iClass: 'fa fa-align-left', title: '左对齐'},
                        {className: 'menu rightAligned', iClass: 'fa fa-align-right', title: '右对齐'}];
    //字体菜单函数
    $scope.fontMenu = function(eve, index){
        if(wsh.element){
            var text;
            switch(index){
                case 0:
                var index = $scope.fontSize.indexOf($scope.fontSizeSelecd);
                if(index == ($scope.fontSize.length - 1)){
                    text = '字体已经是最大!';
                }else{
                    $scope.fontSizeSelecd = $scope.fontSize[index + 1];
                    wsh.element.css('font-size', $scope.fontSize[index + 1].size + 'px');
                    text = '已选择' +$scope.fontSize[index + 1].size+'号字体';
                }
                break;
                case 1:
                var index = $scope.fontSize.indexOf($scope.fontSizeSelecd);
                if(index == 0){
                    text = '字体已经是最小!';
                }else{
                    $scope.fontSizeSelecd = $scope.fontSize[index - 1];
                    wsh.element.css('font-size', $scope.fontSize[index - 1].size + 'px');
                    text = '已选择' +$scope.fontSize[index - 1].size+'号字体';
                }
                break;
                case 2:
                if(wsh.element.css('font-weight') != 'bold'){
                    wsh.element.css('font-weight', 'bold');
                    text = '已选择添加粗体样式';
                }else{
                    wsh.element.css('font-weight', 'normal');
                    text = '已选择取消粗体样式';
                }
                break;
                case 3:
                if(wsh.element.css('font-style') == 'normal'){
                    wsh.element.css('font-style', 'italic');
                    text = '已选择添加斜体样式';
                }else{
                    wsh.element.css('font-style', 'normal');
                    text = '已选择取消斜体样式';
                }
                break;
                case 4:
                if(wsh.element.css('text-decoration') == 'underline'){
                    wsh.element.css('text-decoration', 'none');
                    text = '已选择取消下划线';
                }else{
                    wsh.element.css('text-decoration', 'underline');
                    text = '已选择添加下划线';
                }
                break;
                case 5:
                wsh.element.css('text-align', 'center');
                text = '已选择居中对齐';
                break;
                case 6:
                wsh.element.css('text-align', 'start');
                text = '已选择向左对齐';
                break;
                case 7:
                wsh.element.css('text-align', 'end');
                text = '已选择向右对齐';
                break;
            }
            wsh.quickDialog(text);
            $rootScope.$broadcast('sync');
        }
    };
    //行高设置函数
    $scope.changeLineHeight = function(a){
        if(wsh.element){
            wsh.element.css('line-height', a + 'px');
            $rootScope.$broadcast('sync');
        }
    };
    //图形文本链接
    $scope.btnshapeText = '';
    $scope.changeBtnshapeText = function(a){
        if(wsh.element){
            wsh.element.text(a);
            $rootScope.$broadcast('sync');
        }
    };
    //边框设置函数
    $scope.borderWidth = [{Border: 0},{Border: 1},{Border: 2},{Border: 3},{Border: 4}];
    $scope.borderWidthSelecd = $scope.borderWidth[0];
    $scope.changeBorderWidth = function(a){
        if(wsh.element){
            wsh.element.css('border-width', a.Border + 'px');
            $rootScope.$broadcast('sync');
        }
    };
    //圆角设置函数
    $scope.roundCorner = [{Round: 0},{Round: 1},{Round: 2},{Round: 3},{Round: 4},{Round: 6},{Round: 8},{Round: 10}];
    $scope.roundCornerSelecd = $scope.roundCorner[0];
    $scope.changeRoundCorner = function(a){
        if(wsh.element){
            wsh.element.css('border-radius', a.Round + 'px');
            $rootScope.$broadcast('sync');
        }
    };
    //内链与外链
    $scope.Links = [{Link: '内部链接'},{Link: '外部链接'}];
    $scope.linkSelected = 1;
    //内链的选择框
    $scope.innerLinks = [{Link: '清除内链属性'}];
    $scope.innerLinkSelecd = $scope.innerLinks[0];
    $scope.changeInnerLink = function(a){
        if(wsh.element){
            if(a.Link == '清除内链属性'){
                wsh.element.removeAttr('data-page');
            }else{
                if(a.Link == $scope.childPageActive + 1) return wsh.quickDialog('不能绑定到本页面', 2000);
                wsh.element.attr('data-page', a.Link);
            }
            wsh.element.removeAttr('link');
            $scope.outLink = '';
        }
    };
    //外链输入文本函数
    $scope.outLink = '';
    $scope.changeOutLink = function(a){
        if(wsh.element){
            wsh.element.attr('link', a);
            wsh.element.removeAttr('data-page');
            $scope.innerLinkSelecd = $scope.innerLinks[0];
        }
    };
    //联系中文本及号码的设置
    $scope.btnText = '';
    $scope.btnLink = '';
    $scope.changeBtnText = function(a){
        if(wsh.element){
            wsh.element.text(a);
            $rootScope.$broadcast('sync');
        }
    };
    $scope.changeBtnLink = function(a){
        if(wsh.element){
            wsh.element.attr('href', a);
            if(typeof a == 'string'){
                a.length >= 11 ? (/^(1[3|4|5|8]\d{9}|0755[\d]{7,8}|400[\d]{7})$/).test(a) ? void 0 : alert('电话号码错误') : void 0;
            }
            $rootScope.$broadcast('sync');
        }
    };
    //颜色属性数组  一般的文本  字体  填充  边框都是用此数组
    $scope.textColorIndex = -1;
    $scope.textColors = [{className: 'color color-picker-none', color: '#fff'},
                         {className: 'color color-picker-white', color: '#fff'},
                         {className: 'color color-picker-darkgray', color: '#a9a9a9'},
                         {className: 'color color-picker-gray', color: '#808080'},
                         {className: 'color color-picker-black', color: '#000'},
                         {className: 'color color-picker-pink', color: '#f25c93'},
                         {className: 'color color-picker-lightblue', color: '#71a8d9'},
                         {className: 'color color-picker-red', color: '#b60927'},
                         {className: 'color color-picker-orange', color: '#da5525'},
                         {className: 'color color-picker-yellow', color: '#f59c00'},
                         {className: 'color color-picker-green', color: '#01a187'},
                         {className: 'color color-picker-blue', color: '#217fbc'},
                         {className: 'color color-picker-indigo', color: '#334960'},
                         {className: 'color color-picker-purple', color: '#913eb0'}];
    //背景颜色属性数组
    $scope.backgroundColorIndex = -1;
    $scope.backgroundColors = [{className: 'color color-picker-none', color: '#fff'},
                               {className: 'color color-picker-white', color: '#fff'},
                               {className: 'color color-picker-darkgray', color: '#a9a9a9'},
                               {className: 'color color-picker-gray', color: '#808080'},
                               {className: 'color color-picker-black', color: '#000'},
                               {className: 'color color-picker-pink', color: '#f25c93'},
                               {className: 'color color-picker-lightblue', color: '#71a8d9'},
                               {className: 'color color-picker-red', color: '#b60927'},
                               {className: 'color color-picker-orange', color: '#da5525'},
                               {className: 'color color-picker-yellow', color: '#f59c00'},
                               {className: 'color color-picker-green', color: '#01a187'},
                               {className: 'color color-picker-blue', color: '#217fbc'},
                               {className: 'color color-picker-indigo', color: '#334960'},
                               {className: 'color color-picker-purple', color: '#913eb0'},
                               {className: 'color color-picker-light-red', color: '#ff6a66'},
                               {className: 'color color-picker-dark-orange', color: '#dd8472'},
                               {className: 'color color-picker-dark-yellow', color: '#ceb082'},
                               {className: 'color color-picker-light-green', color: '#2ad1bb'},
                               {className: 'color color-picker-light-indigo', color: '#657d9f'},
                               {className: 'color color-picker-light-purple', color: '#aba4f4'},
                               {className: 'color color-picker-dark-purple', color: '#4e2961'},];
    //文本颜色选择函数
    $scope.textColorChoose = function(eve, index){
        var color = $scope.textColors[index].color;
        if(wsh.element){
            wsh.element.css('color', color);
            $rootScope.$broadcast('sync');
        }
    };
    //背景填充色选择函数
    $scope.backColorChoose = function(eve, index){
        var color = $scope.textColors[index].color;
        if(wsh.element){
            wsh.element.css('background-color', color);
            $rootScope.$broadcast('sync');
        }
    };
    //边框颜色选择函数
    $scope.borderColorChoose = function(eve, index){
        var color = $scope.textColors[index].color;
        if(wsh.element){
            wsh.element.css('border-color', color);
            $rootScope.$broadcast('sync');
        }
    };
    //背景面板 背景色块的点击函数
    $scope.changeBackground = function(index){
        $('.pages').children().eq($scope.childPageActive).css('background-color', $scope.backgroundColors[index].color);
        $rootScope.$broadcast('sync');
    };
    //行高选择属性
    $scope.lineHeight = 28;
    $scope.changeLineHeight = function(a){
        if(wsh.element){
            wsh.element.css('line-height', a + 'px');
            $rootScope.$broadcast('sync');
        }
    };
    //图片配置中的 预览图片
    $scope.previewSrc = 'http://imgcache.vikduo.com/static/4c4552dbbe45c2af0a3ed4da4bd8da87.png';
    //动画持续时间设置
    $scope.duration = 1;
    $scope.changeDuration = function(a){
        if(wsh.element){
            wsh.element.attr('data-duration', a);
        }
    };
    //动画延时时间设置
    $scope.delay = 1;
    $scope.changeDelay = function(a){
        if(wsh.element){
            wsh.element.attr('data-delay', a);
        }
    };
    //配置点击
    $scope.showMenu = 0;
    $scope.items = [{title: '修改杂志配置', dataTitle: '配置', className: 'fa-left fa-cog'},
                    {title: '点击生成文本', dataTitle: '文本', className: 'fa-left fa-text-width'},
                    {title: '修改背景', dataTitle: '背景', className: 'fa-left fa-image'},
                    {title: '点击生成图片', dataTitle: '图片', className: 'fa-left fa-image'},
                    {title: '点击生成图形', dataTitle: '图形', className: 'fa-left fa-th-large'},
                    // {title: '点击生成特效', dataTitle: '特效', className: 'fa-left fa-magic'},
                    {title: '点击生成表单', dataTitle: '表单', className: 'fa-left fa-file-text'},
                    {title: '联系', dataTitle: '联系', className: 'fa-left fa-phone-square'}];
    //动画选择
    $scope.effectsIndex = -1;
    $scope.effects = [{effectname: '清除动画', effect: 'effectclear', effShow: true},
                      {effectname: '从左飞入', effect: 'fromleft', effShow: true},
                      {effectname: '从下飞入', effect: 'frombottom', effShow: true},
                      {effectname: '从右飞入', effect: 'fromright', effShow: true},
                      {effectname: '从上飞入', effect: 'fromtop', effShow: true},
                      {effectname: '淡出', effect: 'fade', effShow: true},
                      {effectname: '旋转', effect: 'rotation', effShow: true},
                      {effectname: '旋转2D', effect: 'rotation2d', effShow: true},
                      {effectname: '跳跃', effect: 'bounceIn', effShow: true},
                      {effectname: '雨滴', effect: 'rainy', effShow: false},
                      {effectname: '从大到小', effect: 'show', effShow: true},
                      {effectname: '从小到大', effect: 'small2big', effShow: true},
                      {effectname: '擦除', effect: 'erase', effShow: false},
                      {effectname: '抖动', effect: 'jitter', effShow: true},
                      {effectname: '闪烁', effect: 'light', effShow: true},
                      {effectname: '从左淡出', effect: 'fadeFromLeft', effShow: true},
                      {effectname: '从下淡出', effect: 'fadeFromBottom', effShow: true},
                      {effectname: '从右淡出', effect: 'fadeFromRight', effShow: true},
                      {effectname: '从上淡出', effect: 'fadeFromTop', effShow: true}];
    $scope.$on('show effects', function(e){
        $scope.showMenu = 17;
    });
    //接收显示虚线框事件
    $scope.$on('show line', function(event, ele){
        //event.stopPropagation();
        //公共属性
        $scope.public.left = ele.offset().left;
        $scope.public.top = ele.offset().top;
        $scope.public.width = ele.width() + +ele.css('padding-left').replace('px', '') + +ele.css('padding-right').replace('px', '');
        $scope.public.height = ele.height() + +ele.css('padding-top').replace('px', '') + +ele.css('padding-bottom').replace('px', '');
        $scope.public.opacity = ele.css('opacity') ? ((+ele.css('opacity')).toFixed(2) * 100) : 100;
        $scope.public.rotate = ele.attr('rotatez') ? parseInt(ele.attr('rotatez')) : 0;
        $scope.frameShow = true;
        //回传选中手机区域的 .component 并判断左侧配置需要显示的对象
        $(".create-toolbar-list").find(".tool").eq(5).removeClass("active");
        if(ele.is('.text')){
            $scope.showMenu = 1;
            //字体大小
            setFont(ele);
            setLink(ele);
        }
        if(ele.is('.btn')){
            $scope.showMenu = 4;
            setBtnText(ele);
            setBorder(ele);
            setLink(ele);
        }
        if(ele.is('.btnC')){
            $scope.showMenu = 6;
            setContactText(ele);
            setFont(ele);
        }
        if(ele.is('.form')){
            $scope.showMenu = 16;
            $(".create-toolbar-list").find(".tool").eq(5).addClass("active");
            setLink(ele);
        }
        if(ele.is('img')){
            $scope.showMenu = 3;
            setLink(ele);
            setPicture(ele);
        }
        setAnimate(ele);
    });
    //接收隐藏虚线框事件
    $scope.$on('hide line', function(event){
        //event.stopPropagation();
        $scope.frameShow = false;
    });
    //回传的图片 src 地址
    function setPicture(ele){
        $scope.previewSrc = ele.attr('src');
    }
    //回传动画属性
    function setAnimate(ele){
        $scope.duration = ele.attr('data-duration') ? +ele.attr('data-duration') : void 0;
        $scope.delay = ele.attr('data-delay') ? +ele.attr('data-delay') : void 0;
        if(!ele.attr('data-animation')){
            $scope.effectsIndex = -1;
            return;
        }
        wsh.animation = ele.attr('data-animation');
        $scope.effects.forEach(function(i, e){
            if(i.effect == wsh.animation){
                $scope.effectsIndex = e;
                return;
            }
        });
    }
    //回传的联系文字 及号码
    function setContactText(ele){
        //文字
        $scope.btnText = ele.text();
        $scope.btnLink = ele.attr('href');
    }
    //回传的图形文字
    function setBtnText(ele){
        $scope.btnshapeText = ele.text() ? ele.text() : '';
    }
    //回传的边框 圆角 属性
    function setBorder(ele){
        //边框
        wsh.border = ele.css('border-width') ? +(ele.css('border-width').replace('px', '')) : 0;
        $scope.borderWidth.forEach(function(i, e){
            if(i.Border == wsh.border){
                wsh.borderIndex = e;
                return;
            }
        });
        $scope.borderWidthSelecd = $scope.borderWidth[wsh.borderIndex];
        //圆角
        wsh.radius = ele.css('border-width') ? +(ele.css('border-radius').replace('px', '')) : 0;
        $scope.roundCorner.forEach(function(i, e){
            if(i.Round == wsh.radius){
                wsh.radiusIndex = e;
                return;
            }
        });
        $scope.roundCornerSelecd = $scope.roundCorner[wsh.radiusIndex];
    }
    //回传的内链 外链 设置
    function setLink(ele){
        wsh.innerLink = ele.attr('data-page');
        wsh.outLink = ele.attr('link');
        if(!wsh.outLink) {
            if(ele.parent().find('a.form-btn').length == 1) {
                wsh.outLink = ele.parent().attr('link');
            }
        }
        if(wsh.innerLink){
            //内链
            $scope.linkSelected = 0;
            $scope.innerLinks.forEach(function(i, e){
                if(i.Link == wsh.innerLink){
                    wsh.innerLinksIndex = e;
                    return;
                }
            });
            $scope.innerLinkSelecd = wsh.innerLinksIndex == -1 ?$scope.innerLinks[0] : $scope.innerLinks[wsh.innerLinksIndex];
            $scope.outLink = '';
        }else if(wsh.outLink){
            //外链
            $scope.linkSelected = 1;
            $scope.outLink = wsh.outLink;
            $scope.innerLinkSelecd = $scope.innerLinks[0];
        }else{
            //内外链都没有的情况
            $scope.linkSelected = 1;
            $scope.innerLinkSelecd = $scope.innerLinks[0];
            $scope.outLink = '';
        }
    }
    //回传的字体样式设置
    function setFont(ele){
        wsh.size = ele.css('font-size') ? ele.css('font-size').replace('px','') : 12;
        $scope.fontSize.forEach(function(i, e){
            if(i.size == wsh.size){
                wsh.sizeIndex = e;
                return;
            }
        });
        $scope.fontSizeSelecd = wsh.sizeIndex == -1 ?$scope.fontSize[2] : $scope.fontSize[wsh.sizeIndex];
        //字体样式
        wsh.font = ele.css('font-family') ? ele.css('font-family') : '黑体';
        $scope.fontFamily.forEach(function(i, e){
            if(i.font == wsh.font){
                wsh.fontIndex = e;
                return;
            }
        });
        $scope.fontFamilySelecd = wsh.fontIndex == -1 ?$scope.fontFamily[0] : $scope.fontFamily[wsh.fontIndex];
        //行高
        $scope.lineHeight = ele.css('line-height') ? parseInt(ele.css('line-height').replace('px', '')) : 28;
    }
    //底图数组
    $scope.pages = [];
    $scope.childPageActive = -1;

    //接收保存事件 wsh.saveObj 接收保存而来的参数设置
    $scope.$on('save app data', function(eve, obj, callback){
        if(!$rootScope.data.category_id) return alert('请选择配置里的分类');
        if($.isEmptyObject($rootScope.data.shareMessage.documentLib)) return alert('请选择配置里的分享图片');
        if(!$rootScope.data.shareMessage.desc) return alert('请选择配置里的分享文字');
        $("#nav-save-weza").text("保存中");
        $rootScope.chk == true ? $rootScope.data.is_show_icon = 1 : $rootScope.data.is_show_icon = 2;
        $rootScope.data.version = version;
        //console.log("aaabbb", $rootScope.data);
        $http.post(wsh.url + 'edit-ajax', $rootScope.data)
            .success(function(msg){
                var text;
                if(msg.errcode == 0){
                    text = '已保存';
                    wsh.historyArray.unshift(angular.copy($rootScope.data));
                    $rootScope.historyArray.unshift(+new Date());
                    if(typeof callback == 'function'){
                        callback.call(this);
                    }
                }else{
                    text = '保存失败';
                    alert(msg.errmsg);
                }
                $("#nav-save-weza").text(text);
                setTimeout(function(){
                    return $("#nav-save-weza").html('<i class="fa fa-floppy-o"></i><span>保存</span>');
                }, 1500)
            })
    });
}).directive('pages', function($sce, $http, $compile, $rootScope, userInfo){
    //手机区域的自定义指令
    return {
        restrict: 'A',
        replace: true,
        template: '<div class="pages"></div>',
        link: function(scope, elem, attrs) {
            scope.$watch('$root.data.id', function(a){
                if(a){
                    setContent($rootScope.data);
                }
            });
            scope.$on('history', function(e, data){
                setContent(data, true)
            })
            scope.pageTemplete = function(list){
                scope.pageAdd(list.content);
            };
            //底部添加页面点击函数
            scope.pageAdd = function(string, str){
                if(!string){
                    var white = 0;
                    //删除空白页面
                    $(elem).children().each(function(i, e) {
                        if(!$(e).children().length && $(e).css('background-image') == 'none'){
                            white++;
                        }
                    });
                    if(white){
                        return wsh.quickDialog('存在空白页面，请向空白页面添加组件，否则无法继续添加页面');
                    }
                }
                $http.post(wsh.url + 'add-page-ajax', {magazine_id: scope.data.id, page: scope.pageInt + 1})
                    .success(function(msg){
                        wsh.successback(msg, '', false, function(){
                            msg.errmsg.content = changeData.changeOne(string) || MainHtml();
                            $(elem).append(msg.errmsg.content);
                            scope.pages.push(msg.errmsg);
                            that.gotoPage(null, scope.pages.length - 1);
                            $rootScope.$broadcast('save app data');
                        })
                    })
            };
            //接收关闭音乐  musicController 传递过来的
            scope.$on('pausedMusic', function(e){
                scope.isPlay = false;
            });
            //接收上传来的音乐
            scope.$on('MusicListChange', function(e, json){
                setMusic(json);
            });
            //接收选择来的音乐
            scope.$on('MusicChoose', function(e, json){
                setMusic(json);
            });
            scope.playOrPause = function(index){
                scope.isPlay = !scope.isPlay;
                if(index) $('#audio')[0].pause();
                else $('#audio')[0].play();
            };
            scope.deleteMusic = function () {
                $('#audio')[0].pause();
                scope.data.music_document_id = 0;
                scope.data.music = [];
                //scope.data.music.file_cdn_path = scope.data.music.name = '';
            };
            function setMusic(json){
                scope.data.music = angular.copy(json[0]);
                scope.data.music_document_id = angular.copy(json[0].id);
                scope.isPlay = true;
                $('#audio')[0].play();
            }
            function setContent(data, ishistory){
                scope.childPageActive = -1;
                //data.musicName = !data.musicName ? '请选择MP3格式(≤3MB)的文件。' : data.musicName;
                //data.imgUrl = !data.imgUrl ? 'http://imgcache.vikduo.com/static/4c4552dbbe45c2af0a3ed4da4bd8da87.png' : data.imgUrl;
                //data.shareLogo = data.shareLogo == '' ? 'http://imgcache.vikduo.com/static/4c4552dbbe45c2af0a3ed4da4bd8da87.png' : data.shareLogo;
                //scope.data.musicStr = data.musicName.substr(0, 8) + '...';
                //$scope.data.musicUrl = ishistory ? $scope.data.musicUrl : $sce.trustAsResourceUrl($scope.data.musicUrl);
                if(data.is_show_icon == 1){
                    scope.chk = true;
                }else{
                    scope.chk = false;
                }
                //加载音乐
                if(data.music.file_cdn_path != ''){
                    scope.isPlay = true;
                    if($('#audio').length){
                        var audio = $('#audio')[0];
                        audio.load();
                        audio.oncanplaythrough = function(){
                            audio.play();
                        }
                    }
                }
                scope.showMenu = 0;
                scope.pages = [];
                scope.pages = data.magazineInfo;
                if(!scope.pages.length){
                    scope.pageAdd()
                }else{
                    $(elem).empty();
                    $.each(scope.pages, function(i, e){
                        e.content = e.content && e.content.replace(/\\/g, '') || MainHtml();
                        e.content = changeData.changeOne(e.content);
                        $(elem).append(e.content);
                        scorllBefore($(elem).children().eq(i))
                    });
                }
                that.gotoPage(null, 0);
                if(!ishistory){
                    wsh.dataFirst = data;
                    wsh.historyArray = [];
                    wsh.historyArray.push(angular.copy(data));
                    $rootScope.historyArray = [];
                    $rootScope.historyArray.push(+new Date());

                    if($.cookie('isfirst') == 'true'){
                        $.removeCookie('isfirst');
                        $('.introduction').show();
                        $rootScope.guideIndex = 1;
                    }
                }else{
                    return $rootScope.$apply()
                }
            }
            function MainHtml(){
                var str = '';
                str += '<section class="page" data-direction="vertical" version="andy"></section>';
                return str;
            }
            var that = scope;
            scope.$on('sync', function(eve, content, callback, ishistory){
                sync();
            });
            function sync(string, index){
                switch(string){
                    case 'delete':
                    scope.pages.splice(index, 1);
                    break;
                    //复制一页
                    case 'copy':
                        if($(scope.pages[index].content).html()){
                            var magazinId = scope.pages[index].id;
                            $http.post(wsh.url + 'copypage-ajax', {id: magazinId})
                              .success(function (msg) {
                                  wsh.successback(msg, '', false, function () {
                                      console.log(msg.errmsg);
                                      var string = msg.errmsg.content;
                                      msg.errmsg.content = changeData.changeOne(string) || MainHtml();
                                      $(elem).append(msg.errmsg.content);
                                      scope.pages.push(msg.errmsg);
                                      scope.childPageActive = scope.pages.length-1;
                                      wsh.quickDialog('复制成功');
                                      that.gotoPage(null, scope.pages.length - 1);
                                      $rootScope.$broadcast('save app data');
                                  });
                              });
                        }else{
                            wsh.quickDialog('空白页面不能复制');
                        }

                        //var magazinId = scope.pages[index].id;
                        //$http.post(wsh.url + 'copypage-ajax', {id: magazinId})
                        //  .success(function (msg) {
                        //      wsh.successback(msg, '', false, function () {
                        //          var string = msg.errmsg.content;
                        //          console.log('sss', msg);
                        //          if(!string){
                        //              var white = 0;
                        //              //删除空白页面
                        //              $(elem).children().each(function(i, e) {
                        //                  if(!$(e).children().length && $(e).css('background-image') == 'none'){
                        //                      white++;
                        //                  }
                        //              });
                        //              if(white){
                        //                  return wsh.quickDialog('空白页面不能复制');
                        //              }
                        //          }
                        //          msg.errmsg.content = changeData.changeOne(string) || MainHtml();
                        //          console.log("3333", msg.errmsg.content);
                        //          $(elem).append(msg.errmsg.content);
                        //          scope.pages.push(msg.errmsg);
                        //          scope.childPageActive = scope.pages.length-1;
                        //          wsh.quickDialog('复制成功');
                        //          that.gotoPage(null, scope.pages.length - 1);
                        //      });
                        //  });

                    break;
                    //上移一页
                    case 'upMove':
                        var obj = scope.pages[index];
                        var tempId = scope.pages[index + 1].id;
                        scope.childPageActive = index + 1;
                        scope.pages[index] = scope.pages[index + 1];
                        scope.pages[index].id = obj.id;
                        scope.pages[index + 1] = obj;
                        scope.pages[index + 1].id = tempId;
                        wsh.quickDialog('上移成功');
                        that.gotoPage(null, index);
                        $rootScope.$broadcast('save app data');
                    break;
                    //下移一页
                    case 'downMove':
                        var obj = scope.pages[index];
                        var tempIdaa = scope.pages[index - 1].id;
                        scope.childPageActive = index - 1;
                        scope.pages[index] = scope.pages[index -1];
                        scope.pages[index].id = obj.id;
                        scope.pages[index - 1] = obj;
                        scope.pages[index - 1].id = tempIdaa;
                        wsh.quickDialog('下移成功');
                        that.gotoPage(null, index);
                        $rootScope.$broadcast('save app data');
                    break;
                    default :
                    scope.pages[scope.childPageActive].content = $(elem).find('.page').eq(scope.childPageActive)[0].outerHTML;
                    break;
                }
            }
            //同步手机区域及底图的代码
            function syncAll(a, callback, ishistory){
                if(a){
                    a = changeData.change(a);
                    $(elem).html(a);
                }
                scope.pages = [];
                $(elem).find('.page').each(function(i, e){
                    $(e).css({'height': '100%', 'width': '100%'});
                    scope.pages[i] = {};
                    //同步内链属性
                    scope.innerLinks[i+1] = {Link: i+1};
                    scope.pages[i].html = $sce.trustAsHtml(scope.restorHTML(e.outerHTML));
                    scope.pages[i].isEffect = $(e).attr('iseffect') == 'true';
                    if(a){
                        scorllBefore($(e));
                    }
                    scope.chk ? $(e).attr('data-chk', 'true') : $(e).attr('data-chk', 'false');

                });
                $('#page_total').css('width', 110 * scope.pages.length + 'px');
                a ? that.gotoPage(null, 0) : void 0;
                ishistory ? scope.$apply() : void 0;
                if(typeof callback == 'function'){
                    callback.call(this);
                }
            }
            scope.pageInt = 1;
            scope.$watch('pages.length', function(a){
                if(a){
                    scope.innerLinks = [{Link: '清除内链属性'}];
                    $.each(scope.pages, function(i, e){
                        scope.innerLinks[i+1] = {Link: i+1};
                        scope.pageInt = Math.max(scope.pageInt, e.page);
                    });
                }
            })
            scope.restorHTML = function(string){
                var div = $(string);
                div.css('top', 0);
                div.children().each(function(i, e){
                    $(e).css('opacity', $(e).attr('opacity'));
                    var rotateZ = 0;
                    if($(e).attr('rotatez')){
                        rotateZ = +$(e).attr('rotatez');
                    }else{
                        $(e).attr('rotatez', 0);
                    }
                    setAnimateStyle($(e), rotateZ);
                });
                return div[0].outerHTML;
            }
            scope.$on('show-menu', function(e, left, top, index, string){
                if(string == 'small'){
                    scope.index = index;
                    scope.pageMenuOffset.left = left;
                    scope.pageMenuOffset.top = scope.copyElement ? top - (30 * 4) : top - (30 * 3) ;
                    scope.pageMenu = true;
                }else{
                    wsh.createMenuTarget = index;
                    scope.createMenuOffset.left = left;
                    scope.createMenuOffset.top = top;
                    scope.isForm = true;
                    if(index.is('.form')){
                        scope.isForm = false;
                    }
                    scope.createMenu = true;
                }
            });
            //表单属性设置 取消按纽
            scope.closeForm = function(){
                scope.showMenu = -1;
                scope.formList = [{}, {}];
                scope.formContent = {};
            };
            //表单确认 发送$http请求
            scope.formList = [{}, {}];
            scope.formContent = {};
            scope.confirmForm = function(){
                var myform = $('<div id="currentForm" class="component form form_p onlyOneForm" opacity="0.8" style="width: 320px; min-height: 120px; opacity: 0.8;"></div>'), str = '', d = [];
                if(!scope.formContent.title) return alert('表单标题不能为空');
                else str += '<p class="component title form_p">' +scope.formContent.title+ '</p>';

                for(var i in scope.formList){
                    if(!scope.formList[i].name){
                        alert('第'+(i+1)+'行标题为空');
                        continue;
                    }else{
                        d[i] = {};
                        d[i].name = 'p' + i;
                        d[i].label = scope.formList[i].name;
                        str += '<p class="component form-row form_p"><input type="text" class="component form_p" name=p' +(i)+ '><span class="form_p">' +scope.formList[i].name+ ':</span></p>';
                    }
                }
                if(!scope.formContent.content) return alert('按纽内容不能为空');
                else str += '<a class="form-btn component form_p">' +scope.formContent.content+ '</a>';
                var form = userInfo.getListAjax('/magazine/add-form-ajax', {
                        'magazine_id': $rootScope.data.id,
                        'title': scope.formContent.title,
                        'button': scope.formContent.content,
                        'content': d});
                form.then(function(msg){
                    if(scope.pages.length){
                        myform.html(str);
                        console.log(msg);
                        myform.attr('id', msg.errmsg.id);
                        setAnimateStyle(myform);
                        $(elem).find('.page').eq(scope.childPageActive).append(myform);
                        var count = $(elem).find('.page').eq(scope.childPageActive).children().length;
                        myform.css('z-index', count);
                        showLine(myform);
                        getBorderElement();
                        sync();
                        $rootScope.$broadcast('save app data');
                        scope.formList = [{}, {}];
                        scope.formContent = {};
                    }else{
                        alert('请新建页面，再继续操作');
                    }
                })

            };
            //增加行数
            scope.addRow = function(){
                if(scope.formList.length < 5){
                    scope.formList.push({});
                }
            };
            //删除行数
            scope.deleteRow = function(index){
                if(scope.formList.length > 2){
                    scope.formList.splice(index, 1);
                }
            };
            scope.$watch('formList.length', function(a){
                $('.form-container').css('margin-top', -($('.form-container').height()/2) + 'px');
            })
            //右键菜单的点击函数
            scope.pageMenuClick = function(index){
                switch(index){
                    case 0:
                    if(scope.index == 0){
                        wsh.quickDialog('已经是第一页');
                    }else{
                        var element = $(elem).find('.page').eq(scope.index);
                        var ele = $(elem).find('.page').eq(scope.index - 1);
                        ele.before(element);
                        sync('upMove', scope.index - 1);

                    }
                    break;
                    case 1:
                    //下移一页
                    if(scope.index == scope.pages.length - 1){
                        wsh.quickDialog('已经是最后一页');
                    }else{
                        var element = $(elem).find('.page').eq(scope.index);
                        var ele = $(elem).find('.page').eq(scope.index + 1);
                        ele.after(element);
                        sync('downMove', scope.index + 1);
                    }

                    break;
                    case 2:
                    //复制一页
                    sync('copy', scope.index);
                    break;
                    case 3:
                    //粘贴至页面
                    wsh.setNoAjaxDialog('粘贴提示', '确实要将该元素粘贴至该页面吗?', function(){
                        $(elem).find('.page').eq(scope.index).append(scope.copyElement);
                        var count = $(elem).find('.page').eq(scope.index).children().length;
                        scope.copyElement.css('z-index', count);
                        setAnimateStyle(scope.copyElement);
                        that.gotoPage(null, scope.index);
                        sync();
                        scope.elementCount++;
                        $rootScope.$broadcast('save app data');
                    });
                    break;
                }
                scope.createMenu = scope.pageMenu = false;
            }
            $(document).on('keydown', function(e){
                //复制组合键
                if(e.keyCode == 67 && e.ctrlKey){
                    if(wsh.element){
                        that.createMenuClick(5);
                    }
                    return;
                }
                //粘贴组合键
                if(e.keyCode == 86 && e.ctrlKey){
                    if(scope.copyElement){
                        wsh.setNoAjaxDialog('粘贴提示', '确实要将该元素粘贴至该页面吗?', function(){
                            var element = scope.copyElement.clone(true);
                            var left = element.css('left') == 'auto' ? 0 : +(element.css('left').replace('px', ''));
                            var top = element.css('top') == 'auto' ? 0 : +(element.css('top').replace('px', ''));
                            var offsetLeft = wsh.copyIndex == scope.childPageActive ? 10 : 0;
                            var offsetTop = wsh.copyIndex == scope.childPageActive ? 10 : 0;
                            element.css({'left': (left + offsetLeft) + 'px', 'top': (top + offsetTop) + 'px'});
                            $(elem).find('.page').eq(scope.childPageActive).append(element);
                            var count = $(elem).find('.page').eq(scope.childPageActive).children().length;
                            element.css('z-index', count);
                            setAnimateStyle(element);
                            sync();
                            scope.elementCount++;
                            $rootScope.$broadcast('save app data');
                        });
                    }
                    return;
                }
                var moveDistance = 1;
                if(e.shiftKey){
                    moveDistance = 10;
                }
                if(wsh.element&&scope.keyCodeVal){
                    switch(e.keyCode){
                        case 37:
                        //左
                        var left = wsh.element.css('left') == 'auto' ? 0 : +(wsh.element.css('left').replace('px', ''));
                        wsh.element.css('left', (left - moveDistance) + 'px');
                        scope.public.left -= moveDistance;
                        break;
                        case 39:
                        //右
                        var left = wsh.element.css('left') == 'auto' ? 0 : +(wsh.element.css('left').replace('px', ''));
                        wsh.element.css('left', (left + moveDistance) + 'px');
                        scope.public.left += moveDistance;
                        break;
                        case 38:
                        //上
                        var top = wsh.element.css('top') == 'auto' ? 0 : +(wsh.element.css('top').replace('px', ''));
                        wsh.element.css('top', (top - moveDistance) + 'px');
                        scope.public.top -= moveDistance;
                        break;
                        case 40:
                        //下
                        var top = wsh.element.css('top') == 'auto' ? 0 : +(wsh.element.css('top').replace('px', ''));
                        wsh.element.css('top', (top + moveDistance) + 'px');
                        scope.public.top += moveDistance;
                        break;
                    }
                    scope.$apply();
                }
            });

          //判断光标是否在中间手机上id=phone;然后在去判断上面按上下左右按键移动；
          $("#phone").attr('tabindex','0').attr('hidefocus','true');
          $("#phone").blur(function(){ scope.keyCodeVal=false; })
          $("#phone").focus(function(){ scope.keyCodeVal=true; })

            scope.createMenuClick = function(index, boo){
                switch(index){
                    //置于顶层
                    case 0:
                    var ii = +wsh.createMenuTarget.css('z-index');
                    var length = wsh.createMenuTarget.parents('.page').children().length;
                    if(ii == length){
                        boo ? void 0 : wsh.quickDialog('已经是最顶层了');
                    }else{
                        wsh.createMenuTarget.parents('.page').children().each(function(i, e){
                            var iii = +$(e).css('z-index');
                            if(iii > ii){
                                $(e).css('z-index', iii - 1);
                            }
                        });
                        wsh.createMenuTarget.css('z-index', length);
                        boo ? void 0 : wsh.quickDialog('置顶成功');
                    }
                    break;
                    //上移一层 z-index 属性值会加1  对应的上层对象 z-index属性会减1
                    case 1:
                    var ii = +wsh.createMenuTarget.css('z-index');
                    var length = wsh.createMenuTarget.parents('.page').children().length;
                    if(ii == length){
                        wsh.quickDialog('已经是最顶层对象，无法上移');
                    }else{
                        var element = getIndex(wsh.createMenuTarget.parents('.page'), ii, 'up');
                        if(element){
                            var iii = +element.css('z-index')
                            wsh.createMenuTarget.css('z-index', iii);
                            element.css('z-index', ii);
                            wsh.quickDialog('上移一层成功')
                        }else{
                            wsh.quickDialog('上移一层失败, 找不到上层对象');
                        }
                    }
                    break;
                    //下移一层  z-index 属性值会减1  对应的上层对象 z-index属性会加1
                    case 2:
                    var ii = +(wsh.createMenuTarget.css('z-index'));
                    if(ii == 1){
                        wsh.quickDialog('已经是最底层对象，无法下移');
                    }else{
                        var element = getIndex(wsh.createMenuTarget.parents('.page'), ii, 'down');
                        if(element){
                            var iii = +element.css('z-index')
                            wsh.createMenuTarget.css('z-index', iii);
                            element.css('z-index', ii);
                            wsh.quickDialog('下移一层成功')
                        }else{
                            wsh.quickDialog('下移一层失败, 找不到上层对象');
                        }
                    }
                    break;
                    //置于底层
                    case 3:
                    var ii = +wsh.createMenuTarget.css('z-index');
                    if(ii == 1){
                        wsh.quickDialog('已经是最底层了');
                    }else{
                        wsh.createMenuTarget.parents('.page').children().each(function(i, e){
                            var iii = +$(e).css('z-index');
                            if(iii < ii){
                                $(e).css('z-index', iii + 1);
                            }
                        });
                        wsh.element.css('z-index', 1);
                        wsh.quickDialog('置底成功');
                    }
                    break;
                    //对齐功能
                    case 4:
                    //定义在eff.js这个动画js内
                    //eff.Align(wsh.element.parents('.page'), wsh.element);
                    //wsh.quickDialog('请单击选择同一页面内的对齐参照元素');
                    break;
                    //复制 复制到底图功能
                    case 5:
                    scope.copyElement = wsh.element.clone(true);
                    wsh.quickDialog('已将该元素复制到粘贴板');
                    wsh.copyIndex = scope.childPageActive;
                    break;
                    case 6:

                    break;
                    //删除
                    case 7:
                    wsh.setNoAjaxDialog('组件删除提示', '确实要删除该组件吗?', function(){
                      if($('#createPages').find('.border').hasClass('onlyOneForm')) {
                        $http.post(wsh.url + 'del-form-ajax', {id: $('#createPages').find('.border').attr('id')})
                          .success(function (msg) {
                            wsh.successback(msg, '', false, function () {
                            });
                          });
                      }
                      scope.createMenuClick(0, true);
                      wsh.createMenuTarget.remove();
                      $rootScope.$broadcast('hide line');
                      scope.elementCount--;
                      sync();
                      $rootScope.$broadcast('save app data');
                    });
                    break;
                }
                scope.createMenu = scope.pageMenu = false;
            };
            //用z-index属性去获取对象的方法 ele为需要遍历的元素 index 为 z-index 的索引值
            function getIndex(ele, index, string){
                var element;
                var iii = string == 'up' ? index + 1 : index - 1;
                if((index == ele.children().length && string == 'up') || (index == 1 && string == 'down')) return null;
                ele.children().each(function(i, e) {
                    var ii = $(e).css('z-index') ? +$(e).css('z-index') : 0;
                    if(ii == iii){
                        element = $(e);
                    }
                });

                if(!element) return getIndex(ele, iii, string);
                return element;
            }
            //特效点击
            scope.pageEffect = function(index){
                var data = { tx: index };
                getPage(data, true);
            };
            //模板分类
            //$http.post(wsh.url + 'category-list-ajax', {})
            //    .success(function(msg){
            //        wsh.successback(msg, '', false, function(){
            //            if(msg.errmsg.data.length){
            //                $.each(msg.errmsg.data, function(i, e){
            //                    e.id = +e.id;
            //                })
            //                scope.templateCategory = msg.errmsg.data;
            //                console.log("111sd", scope.templateCategory);
            //            }else{
            //                scope.templateCategory = [{id: 0, name: '当前杂志没有分类'}];
            //            }
            //            $rootScope.data.category_id = scope.templateCategory[0].id;
            //
            //            console.log("111sd", $rootScope.data.category_id);
            //        })
            //    });
            //模板数据
            var top = $('#tpl_content').offset().top;
            var tplHeight = $(window).height() - $('.tempate-cases-more').height() - top;
            $('#tpl_content').css('height', tplHeight + 'px');
            $http.post(wsh.url + 'page-template-category-list-ajax', {})
                .success(function(msg){
                    wsh.successback(msg, '', false, function(){
                        scope.templateCategoryList = msg.errmsg;
                    })
                })
            scope.toggleTemplate = function(list, index){
                if(scope.templateIndex != index){
                    scope.templateIndex = index;
                    scope.templateList[index] = scope.templateList[index] || [];
                    if(!scope.templateList[index].length){
                        var data = list ? {pid: list.id} : {}
                        getTemplate(data, index)
                    }
                }
            };
            function getTemplate(data, index){
                $http.post(wsh.url + 'page-template-list-ajax', data)
                    .success(function(msg){
                        wsh.successback(msg, '', false, function(){
                            $.each(msg.errmsg.data, function(i, e){
                                e.content = e.content.replace(/\\/g, '');
                            })
                            scope.templateList[index] = scope.templateList[index].concat(msg.errmsg.data);
                        })
                    })
            }
            scope.templateList = [];
            scope.toggleTemplate(null, 0);
            scope.tempateMore = function(){
                var int = Math.floor(scope.templateList[scope.templateIndex].length/14) + 1;
                if(int > 1){
                    var data = {}
                }
            }
            //底部删除页面 boo 用来判断是否需要弹框删除
            scope.deletePage = function(list, index){
                if(scope.pages.length == 1) return alert('不能全部删除');
                var content = "<p>您是否确认删除第<span class=txt_blue>[" + (index + 1) + "]</span>页的内容？</p>";
                wsh.setDialog('删除提示', content, wsh.url + 'del-page-ajax', {magazine_id: scope.data.id, id: list.id}, function(){
                    $(elem).children().eq(index).remove();
                    var ii = index == 0 ? 0 : index - 1;
                    console.log('ggg', ii);
                    that.gotoPage(null, ii);
                    sync('delete', index);
                    $rootScope.$broadcast('save app data');
                }, '删除成功');
            };
            //底图点击函数
            scope.gotoPage = function(eve, index, element){
                //console.log("111", eve, index, element);
                //console.log("222", scope.childPageActive);
                if(index != scope.childPageActive){
                    if($('#pageStyle').length){
                        $('#pageStyle').text('');
                    }
                    var ele, element, string, top;
                    if(scope.childPageActive != -1){
                        ele = element ? element : $(elem).find('.page').eq(scope.childPageActive);
                    }
                    scope.childPageActive = index;
                    scope.elementCount = $(elem).find('.page').eq(scope.childPageActive).children().length;

                    element = $(elem).find('.page').eq(index);

                    if(ele && ele.index() > element.index()){
                        top = '-100%';
                    }else{
                        top = '100%';
                    }

                    element.css({'top': top, 'z-index': 2});

                    element.animate({top : 0}, 300, function(){
                        element.siblings().css('z-index', 0);
                        element.css('z-index', 1);
                        scorllAfter(element);
                        ele ? scorllBefore(ele) : void 0;
                    });
                    if(eve){
                        var left = +($('#page_total').css('left').replace('px' ,''));
                        left = left ? left : 0;
                        var x = (eve.clientX - wsh.editLeft) - wsh.editWidth/2;
                        if(x > 110){
                            x = Math.floor(x/110) * 110;
                            var maxLeft = scope.pages.length * 110 - wsh.editWidth + left;
                            x = x > maxLeft ? maxLeft : x;
                            x > 0 ? $('#page_total').animate({left: '-=' + x + 'px'}, 1000) : void 0;
                        }else if(x < -110){
                            x = Math.ceil(x/110) * 110;
                            x = x > left ? x : left;
                            x != 0 ? $('#page_total').animate({left: '+=' + Math.abs(x) + 'px'}, 1000) : void 0;
                        }
                    }
                }
            };
            //加载动画函数
            function scorllAfter(ele){
                ele.children().each(function(i, e) {
                    var obj = {};
                    obj.rotateZ = $(e).attr('rotateZ') ? +$(e).attr('rotateZ') : 0;
                    obj.animation = $(e).attr('data-animation');
                    obj.duration = $(e).attr('data-duration') ? +$(e).attr('data-duration') : 1;
                    obj.delay = $(e).attr('data-delay') ? +$(e).attr('data-delay') : 0.2;
                    obj.opacity = parseFloat($(e).attr('opacity'));
                    obj.animate = 'page' + scope.childPageActive + i;
                    if(obj.animation == 'rotation2d' || obj.animation == 'bounceIn' || obj.animation == 'jitter' || obj.animation == 'light'){
                        eff.setHeadStyle(obj.animate, obj.animation, obj.rotateZ, obj.opacity);
                    }
                    var index = eff.animateName.indexOf(obj.animation);
                    if(index != -1) eff.animateArray[index]($(e), obj.rotateZ, obj);
                    obj = {};
                });
            };
            //清除动画函数
            function scorllBefore(ele, callback){
                ele.children().each(function(i, e) {
                    var animate = $(e).attr('data-animation');
                    var rotateZ = $(e).attr('rotateZ') ? +$(e).attr('rotateZ') : 0;
                    var index = eff.animateName.indexOf(animate);
                    if(index != -1) eff.animateArray[index]($(e), rotateZ);
                });
                if(typeof callback == 'function'){
                    callback.call(this);
                }
            };
            //配置点击函数
            scope.menu = function(index){
                var isShow = true;
                switch(index){
                    case 0:

                    break;
                    case 1:
                    //文本点击函数
                    if(scope.pages.length){
                        // if(scope.pages[scope.childPageActive].isEffect){
                        //     return wsh.quickDialog('特效页面暂时不可添加组件');
                        // }
                        var text = $('<article class="component text" style="font-family: 黑体; font-size: 12px;" rotatez="0" opacity="1">文字 (双击编辑文字)</article>');
                        $(elem).find('.page').eq(scope.childPageActive).append(text);
                        var count = $(elem).find('.page').eq(scope.childPageActive).children().length;
                        text.css('z-index', count);
                        setAnimateStyle(text);
                        showLine(text);
                        scope.elementCount++;
                        $rootScope.$broadcast('save app data');
                    }else{
                        isShow = false;
                        alert('请新建页面，再继续操作');
                    }
                    break;
                    case 2:

                    break;
                    case 3:
                    //图片点击函数
                    if(scope.pages.length){
                        if(scope.pages[scope.childPageActive].isEffect){
                            return wsh.quickDialog('特效页面暂时不可添加组件');
                        }
                        var seed, img_url = "http://imgcache.vikduo.com/static/4c4552dbbe45c2af0a3ed4da4bd8da87.png";
                        var img = $('<img class="component image" src="' + img_url + '" rotatez="0" opacity="1">');
                        setAnimateStyle(img);
                        $(elem).find('.page').eq(scope.childPageActive).append(img);
                        var count = $(elem).find('.page').eq(scope.childPageActive).children().length;
                        img.css('z-index', count);
                        seed = Math.floor(img.height() / img.width());
                        img.css({width: 300, height: seed * 300});
                        showLine(img);
                        scope.elementCount++;
                        $rootScope.$broadcast('save app data');
                    }else{
                        isShow = false;
                        alert('请新建页面，再继续操作');
                    }
                    break;
                    case 4:
                    //图形点击函数
                    if(scope.pages.length){
                        if(scope.pages[scope.childPageActive].isEffect){
                            return wsh.quickDialog('特效页面暂时不可添加组件');
                        }
                        var button = $('<button type="button" class="component btn" style="width: 130px; height: 32px; text-align: center; border: 1px solid rgb(255, 255, 255); border-radius: 3px; color: rgb(255, 255, 255); background-color: rgb(1, 161, 135); -webkit-box-sizing: border-box; box-sizing: border-box; display: block; padding:0;" rotatez="0" opacity="1"></button>');
                        setAnimateStyle(button);
                        $(elem).find('.page').eq(scope.childPageActive).append(button);
                        var count = $(elem).find('.page').eq(scope.childPageActive).children().length;
                        button.css('z-index', count);
                        showLine(button);
                        scope.elementCount++;
                        $rootScope.$broadcast('save app data');
                    }else{
                        isShow = false;
                        alert("请新建页面，再继续操作");
                    }
                    break;
                    // case 5:

                    // break;
                    case 5:
                    //表单点击函数
                      if($('#createPages').find('.onlyOneForm').length == 1) {
                        return wsh.quickDialog('一个微杂志只可以添加一个表单');
                      }
                      if(scope.pages.length){
                          if(scope.pages[scope.childPageActive].isEffect){
                              return wsh.quickDialog('特效页面暂时不可添加组件');
                          }
                      }else{
                          isShow = false;
                          alert("请新建页面，再继续操作");
                      }
                      break;
                    case 6:
                    //联系点击函数
                    if(scope.pages.length){
                        if(scope.pages[scope.childPageActive].isEffect){
                            return wsh.quickDialog('特效页面暂时不可添加组件');
                        }
                        var btnC = $('<div href="" class="component btnC" style="font-family: 黑体;width:100px;height:30px;text-align:center;line-height:28px;font-size:12px;" rotatez="0" opacity="1">一键拨号</div>');
                        setAnimateStyle(btnC);
                        $(elem).find('.page').eq(scope.childPageActive).append(btnC);
                        var count = $(elem).find('.page').eq(scope.childPageActive).children().length;
                        btnC.css('z-index', count);
                        showLine(btnC);
                        scope.elementCount++;
                        $rootScope.$broadcast('save app data');
                    }else{
                        isShow = false;
                        alert("请新建页面，再继续操作");
                    }
                    break;
                }
                getBorderElement();
                if(isShow){
                    scope.showMenu = index;

                    sync();
                }

            };

            //底部缩略滑动
            $(document).on('click',"#thumbnailSlide",function(){
                var bottom = $("#createPages").css("bottom");
                if(bottom == "0px"){
                    $("#createPages").animate({bottom:"-150px"},800);
                    $("#phone").animate({"margin-top":"-310px"},800);
                    $(this).find("i").removeClass("fa-chevron-down");
                    $(this).find("i").addClass("fa-chevron-up");
                }else{
                    $(this).find("i").removeClass("fa-chevron-up");
                    $(this).find("i").addClass("fa-chevron-down");
                    $("#createPages").animate({bottom:"0px"},800);
                    $("#phone").animate({"margin-top":"-405px"},800);
                }
            });
            //选择动画函数
            scope.chooseAnimate = function(eve, index){
                eve.stopPropagation();
                scope.effectsIndex = index;
                if(wsh.element){
                    var text = '已选择' + scope.effects[index].effectname + '动画';
                    wsh.element.attr('data-animation', scope.effects[index].effect);
                }else{
                    var text = '请选择动画组件';
                }
                wsh.quickDialog(text);
            }

            $(document).bind('mousedown', function(a){
                if($(a.target).parents().is('.fade') || $(a.target).is('.fade')){
                    return;
                }
                var ele = getRPComponent($(a.target));
                if(!$(a.target).parents().is('#app-list')){
                    $rootScope.appTopList = false;
                }
                if(!$(a.target).parents().is('#app-history')){
                    $rootScope.appHistoryShow = false;
                }
                if(
                (ele.is(".component") && !$(a.target).parents().is('#page_total')) ||
                $(a.target).is('.size-hd')){
                    if(!$(a.target).is('.text')){
                        a.preventDefault();
                    }
                    if(!$(a.target).is('.size-hd')){
                        wsh.isEleDown = true;
                        showLine(ele);
                        getBorderElement();
                        scope.$apply();
                    }else{
                        wsh.isLineDown = true;
                        if($(a.target).is('.size-n')){
                            wsh.string = 'n';
                        }
                        if($(a.target).is('.size-s')){
                            wsh.string = 's';
                        }
                        if($(a.target).is('.size-e')){
                            wsh.string = 'e';
                        }
                        if($(a.target).is('.size-w')){
                            wsh.string = 'w';
                        }
                        if($(a.target).is('.size-nw')){
                            wsh.string = 'nw';
                        }
                        if($(a.target).is('.size-ne')){
                            wsh.string = 'ne';
                        }
                        if($(a.target).is('.size-se')){
                            wsh.string = 'se';
                        }
                        if($(a.target).is('.size-sw')){
                            wsh.string = 'sw';
                        }
                        wsh.width = wsh.element.width();//保存选中物体的宽度
                        wsh.height = wsh.element.height();//保存选中物体的调试
                    }
                    wsh.startX = a.pageX;
                    wsh.startY = a.pageY;
                }else{
                    if($(a.target).is('section.page') && $(a.target).parents().is('.pages')){
                        //点击手机区域的背景图
                        wsh.element = $(a.target);
                        scope.showMenu = 2;
                        $(".create-toolbar-list").find(".tool").eq(5).removeClass("active");
                        $(elem).find('.border').removeClass('border');
                        if(scope.frameShow){
                            $rootScope.$broadcast('hide line');
                        }
                    }else if(
                    !$(a.target).parents().is('ul.create-toolbar-list') &&
                    !$(a.target).parents().is('#mainMenu') &&
                    !$(a.target).parents().is('#animation-editor') &&
                    !$(a.target).parents().is('.form-container') &&
                    !$(a.target).parents().is('.imgstore_main') &&
                    !$(a.target).parents().is('#animation-editor')){
                        //隐藏动画等面板
                        if(!$(a.target).is('.page-menu li') && !$(a.target).is('.create-menu li')){
                            scope.createMenu = scope.pageMenu = false;
                            $(elem).find('.border').removeClass('border');
                            wsh.element = null;
                            scope.showMenu = -1;
                            $(".create-toolbar-list").find(".tool").eq(5).removeClass("active");
                            if(scope.frameShow){
                                $rootScope.$broadcast('hide line');
                            }
                        }
                    }
                    $rootScope.$apply();
                }
                $(document).bind('mousemove', function(a){
                    a.preventDefault();
                    var startX = a.pageX;
                    var startY = a.pageY;
                    //虚线框框事件
                    wsh.startX = wsh.startX ? wsh.startX : startX;
                    wsh.startY = wsh.startY ? wsh.startY : startY;
                    if(wsh.isLineDown){
                        //上
                        switch(wsh.string){
                            case 'n':
                            wsh.string = 'n';
                            if(startY > wsh.parentOffset.top && startY < (wsh.parentOffset.top + wsh.eleTop + wsh.height)){
                                var moveY = startY - wsh.startY;
                                scope.public.height = wsh.height - moveY;
                                scope.public.top = wsh.top + moveY;
                                if(wsh.element){
                                    wsh.element.css({'height': scope.public.height + 'px', 'top': wsh.eleTop + moveY + 'px'});
                                }
                            }
                            break;
                            case 's':
                            wsh.string = 's';
                            if(startY > (wsh.parentOffset.top + wsh.eleTop) && startY < (wsh.parentOffset.top + wsh.parentHeight)){
                                var moveY = startY - wsh.startY;
                                scope.public.height = wsh.height + moveY;
                                if(wsh.element){
                                    wsh.element.css('height', scope.public.height + 'px');
                                }
                            }
                            break;
                            case 'e':
                            wsh.string = 'e';
                            if(startX > wsh.parentOffset.left && startX < (wsh.parentOffset.left + wsh.width + wsh.eleLeft)){
                                var moveX = startX - wsh.startX;
                                scope.public.width = wsh.width - moveX;
                                scope.public.left = wsh.left + moveX;
                                if(wsh.element){
                                    wsh.element.css({'width': scope.public.width + 'px', 'left': wsh.eleLeft + moveX + 'px'});
                                }
                            }
                            break;
                            case 'w':
                            wsh.string = 'w';
                            if(startX > (wsh.parentOffset.left + wsh.eleLeft) && startX < (wsh.parentOffset.left + wsh.parentWidth)){
                                var moveX = startX - wsh.startX;
                                scope.public.width = wsh.width + moveX;
                                if(wsh.element){
                                    wsh.element.css({'width': scope.public.width + 'px'});
                                }
                            }
                            break;
                            case 'nw':
                            wsh.string = 'nw';
                            if(startX > wsh.parentOffset.left && startX < (wsh.parentOffset.left + wsh.width + wsh.eleLeft) &&
                            startY > wsh.parentOffset.top && startY < (wsh.parentOffset.top + wsh.eleTop + wsh.height)){
                                var moveY = startY - wsh.startY;
                                var moveX = startX - wsh.startX;
                                scope.public.width = wsh.width - moveX;
                                scope.public.height = wsh.height - moveY;
                                scope.public.left = wsh.left + moveX;
                                scope.public.top = wsh.top + moveY;
                                if(wsh.element){
                                    wsh.element.css({'width': scope.public.width + 'px',
                                                     'height': scope.public.height + 'px',
                                                     'left': wsh.eleLeft + moveX + 'px',
                                                     'top': wsh.eleTop + moveY + 'px'
                                                     });
                                }
                            }
                            break;
                            case 'ne':
                            wsh.string = 'ne';
                            if(startX > (wsh.parentOffset.left + wsh.eleLeft) && startX < (wsh.parentOffset.left + wsh.parentWidth) &&
                            startY > wsh.parentOffset.top && startY < (wsh.parentOffset.top + wsh.eleTop + wsh.height)){
                                var moveY = startY - wsh.startY;
                                var moveX = startX - wsh.startX;
                                scope.public.width = wsh.width + moveX;
                                scope.public.height = wsh.height - moveY;
                                scope.public.top = wsh.top + moveY;
                                if(wsh.element){
                                    wsh.element.css({'width': scope.public.width + 'px',
                                                     'height': scope.public.height + 'px',
                                                     'top': wsh.eleTop + moveY + 'px'
                                                     });
                                }
                            }
                            break;
                            case 'se':
                            wsh.string = 'se';
                            if(startX > (wsh.parentOffset.left + wsh.eleLeft) && startX < (wsh.parentOffset.left + wsh.parentWidth) &&
                            startY > (wsh.parentOffset.top + wsh.eleTop) && startY < (wsh.parentOffset.top + wsh.parentHeight)){
                                var moveY = startY - wsh.startY;
                                var moveX = startX - wsh.startX;
                                scope.public.width = wsh.width + moveX;
                                scope.public.height = wsh.height + moveY;
                                if(wsh.element){
                                    wsh.element.css({'width': scope.public.width + 'px',
                                                     'height': scope.public.height + 'px'
                                                     });
                                }
                            }
                            break;
                            case 'sw':
                            wsh.string = 'sw';
                            if(startX > wsh.parentOffset.left && startX < (wsh.parentOffset.left + wsh.width + wsh.eleLeft) &&
                            startY > (wsh.parentOffset.top + wsh.eleTop) && startY < (wsh.parentOffset.top + wsh.parentHeight)){
                                var moveY = startY - wsh.startY;
                                var moveX = startX - wsh.startX;
                                scope.public.width = wsh.width - moveX;
                                scope.public.height = wsh.height + moveY;
                                scope.public.left = wsh.left + moveX;
                                if(wsh.element){
                                    wsh.element.css({'width': scope.public.width + 'px',
                                                     'height': scope.public.height + 'px',
                                                     'left': wsh.eleLeft + moveX + 'px'
                                                     });
                                }
                            }
                            break;
                        }
                        scope.$apply();
                    }else if(wsh.isEleDown){
                        //手机区域内移动事件
                        if(startX > wsh.parentOffset.left && startX < (wsh.parentOffset.left + wsh.parentWidth) &&
                            startY > wsh.parentOffset.top && startY < (wsh.parentOffset.top + wsh.parentHeight)){
                            var moveX = startX - wsh.startX;
                            var moveY = startY - wsh.startY;
                            scope.public.left = wsh.left + moveX;
                            scope.public.top = wsh.top + moveY;
                            wsh.element.css({'left': wsh.eleLeft + moveX + 'px', 'top': wsh.eleTop + moveY + 'px'});
                            scope.$apply();
                        }
                    }
                });
                $(document).bind('mouseup', function(a){
                    $(document).unbind('mousemove');
                    wsh.isEleDown = false;
                    wsh.isLineDown = false;
                    wsh.istextDblclick = false;
                    sync();
                    $(document).unbind('mouseup');
                });
            });


            wsh.parentOffset = $('.pages').offset();
            wsh.parentWidth = $('.pages').width();
            wsh.parentHeight = $('.pages').height();
            //双击文本框事件
            $(document).on('dblclick', function(e){
                if($(e.target).is('.text')){
                    $(e.target).attr('contenteditable', !0);
                    $(e.target).addClass('text-contenteditable');
                    wsh.istextDblclick = true;
                }
            });
            //失去焦点事件
            $(document).on('blur', '.text', null, function(a){
                wsh.istextDblclick = false;
                var b;
                $(a.target).removeAttr('contenteditable');
                $(a.target).removeClass('text-contenteditable');
                b = a.target.innerText.replace(/\n/g, '<br>');
                if (b == '') {
                    b = '文字 (双击编辑文字)';
                }
                a.target.innerHTML = b;
            });
            //显示虚线框框
            function showLine(ele){
                $(elem).find('.border').removeClass('border');
                ele.addClass('border');
                var opacity = (+ele.attr('opacity')).toFixed(2);
                ele.css(wsh.style + 'transition', 'none');
                ele.css(wsh.style + 'animation', 'none');
                ele.css('opacity', opacity);
                //scope.$emit
                $rootScope.$broadcast('show line', ele);
            }
            //获取选中元素的信息
            function getBorderElement(){
                if(!$(elem).find('.border').length) return;
                wsh.element = $(elem).find('.border');
                wsh.left = wsh.element.offset().left;//保存选中物体的左边距值
                wsh.top = wsh.element.offset().top;//保存选中物体的上边距值
                wsh.width = wsh.element.width();//保存选中物体的宽度
                wsh.height = wsh.element.height();//保存选中物体的调试
                wsh.eleTop = +(wsh.element.css('top').replace('px', ''));//保存选中在其父级中的left 值
                wsh.eleTop = wsh.eleTop ? wsh.eleTop : 0;
                wsh.eleLeft = +(wsh.element.css('left').replace('px', ''));//保存选中在其父级中的top 值
                wsh.eleLeft = wsh.eleLeft ? wsh.eleLeft : 0;
                //保存选中物体的宽高比例
                wsh.scale = (wsh.height/wsh.width);
            }
            //添加动画样式信息
            function setAnimateStyle(ele, rotateZ){
                rotateZ = rotateZ == null ? 0 : rotateZ;
                ele.css(wsh.style + 'transform', 'translateX(0px) translateY(0px) translateZ(0px) scaleX(1) scaleY(1) scaleZ(1) rotateX(0deg) rotateY(0deg) rotateZ(' +rotateZ+ 'deg)');
                ele.css(wsh.style + 'transition', 'none');
                ele.css(wsh.style + 'animation', 'none');
            }

            $(document).on('click', '#backgroundColorPicker .twod, #backgroundSelect .twod', function(e){
                if($(e.target).parents().is('#backgroundSelect')){
                    var value = $('#backgroundSelect').find('input[type="text"]').val();
                    $(elem).children().eq(scope.childPageActive).css('background-color', value);
                }else{
                    var value = $('#backgroundColorPicker').find('input[type="text"]').val();
                    wsh.element ? wsh.element.css('color', value) : void 0;
                }
                sync();
            });
            scope.$on('ImageListChange', function(e, json){
                setPic(json);

            })
            scope.$on('ImageChoose', function(e, json){
                setPic(json);
            })
            function setPic(json){
                switch(scope.imageString){
                    case 'logo':
                    $rootScope.data.face = json[0];
                    $rootScope.data.face_document_id = json[0].id;
                    break;
                    case 'desc':
                    $rootScope.data.shareMessage = $rootScope.data.shareMessage || {}
                    $rootScope.data.shareMessage.documentLib = json[0];
                    $rootScope.data.share_message_id = json[0].id;
                    break;
                    case 'background':
                    if(scope.showMenu == 2){
                        $(elem).children().eq(scope.childPageActive).css('background-image', 'url(' + json[0].file_cdn_path + ')');
                    }else{
                        wsh.element.attr('src', json[0].file_cdn_path);
                        scope.previewSrc = json[0].file_cdn_path;
                    }

                    break;
                }
                sync();
            }
            //获取手机区域中的  .component 对象
            function getRPComponent(a) {
                var b, c, d, e;
                for (e = a.parents(), c = 0, d = e.length; d > c; c++)
                    b = e[c], $(b).is(".form.component") && (a = $(b)), $(b).is(".text.component") && (a = $(b)), $(b).is(".btn.component") && (a = $(b)), $(b).is(".image.component") && (a = $(b));
                return a
            }
        }
    };
});