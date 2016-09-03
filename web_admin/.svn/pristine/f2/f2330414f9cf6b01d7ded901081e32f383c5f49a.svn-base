app.directive('downSelect', function($rootScope, userInfo, $http, $parse){
	return {
		restrict: 'A',
        scope: {
            options: '=options'
        },
		link: function(scope, elem, attr){
            var firstData = {};
            firstData[scope.options.dataName] = -1;
            firstData[scope.options.dataOptionName] = scope.options.optionNames[0];
            var secondData = {};
            secondData[scope.options.dataName] = -1;
            secondData[scope.options.dataOptionName] = scope.options.optionNames[1];
            var thirdData;
            if(scope.options.count != 2){
                thirdData = {};
                thirdData[scope.options.dataName] = -1;
                thirdData[scope.options.dataOptionName] = scope.options.optionNames[2];
            }
            $http.post(scope.options.urlArray[0], scope.options.data)
                .success(function(msg){
                    wsh.successback(msg, '', false, function(){
                        scope.options.dataOptions.firstOption = scope.options.backDataName ? msg.errmsg.data : msg.errmsg;
                        scope.options.dataOptions.firstOption.unshift(firstData);
                    })
                })
            //侦测第一级菜单的变化  
            var isfirst = false;
            var status;  
            scope.$watch('options.dataBack[0]', function(a){
                if(typeof scope.options.firstCallBack == 'function'){
                    scope.options.firstCallBack.call(this);
                }
                if(a == -1){
                    scope.options.dataOptions.secondOption = [secondData];
                    if(scope.options.count != 2){
                        scope.options.dataOptions.thirdOption = [thirdData];
                    }
                    scope.options.dataBack[1] = -1;
                }else{
                    var data = {};
                    data[scope.options.searchName] = a;
                    getData(scope.options.urlArray[1], data, setSecond);
                }
                status = 0;
                if(!isfirst){
                    isfirst = true;
                    if(a == -1) status = 0;
                    else status = 1;
                }
            });
            //侦测第二级菜单的变化
            if(scope.options.count >= 2) {
                scope.$watch('options.dataBack[1]', function (a) {
                    if(typeof scope.options.secondCallBack == 'function'){
                        scope.options.secondCallBack.call(this);
                    }
                    if(scope.options.count > 2){
                        if (a == -1) {
                            scope.options.dataOptions.thirdOption = [thirdData];
                            scope.options.dataBack[2] = -1;
                        } else {
                            var data = {};
                            data[scope.options.searchName] = a;
                            getData(scope.options.urlArray[2], data, setThird);
                        }
                    }
                });
            }
            //侦测第三级菜单的变化
            if(scope.options.count >= 3) {
                scope.$watch('options.dataBack[1]', function (a) {
                    if(typeof scope.options.thirdCallBack == 'function'){
                        scope.options.thirdCallBack.call(this);
                    }
                    if(scope.options.count > 3){
                        if (a == -1) {
                            scope.options.dataOptions.thirdOption = [thirdData];
                            scope.options.dataBack[2] = -1;
                        } else {
                            var data = {};
                            data[scope.options.searchName] = a;
                            getData(scope.options.urlArray[2], data, setThird);
                        }
                    }
                });
            }
            var first = 0;
            function setSecond(data){
                if(data.length){
                    scope.options.dataOptions.secondOption = data;
                    if(!first && status == 1) return;
                    scope.options.dataBack[1] = scope.options.dataOptions.secondOption[0].id;
                }else{
                    var data = {};
                    data[scope.options.dataOptionName] = scope.options.notFindNames[0];
                    data[scope.options.dataName] = -1;
                    scope.options.dataOptions.secondOption = [data];
                    scope.options.dataBack[1] = -1;
                }
                first++;
            }
            var second = 0;
            function setThird(data){
                if(data.length){
                    scope.options.dataOptions.thirdOption = data;
                    if(!second && status == 1) return;
                    scope.options.dataBack[2] = scope.options.dataOptions.thirdOption[0].id;
                }else{
                    var data = {};
                    data[scope.options.dataOptionName] = scope.options.notFindNames[1];
                    data[scope.options.dataName] = -1;
                    scope.options.dataOptions.thirdOption = [data];
                    scope.options.dataBack[2] = -1;
                }
                second++;
            }
            function getData(url, data, callback){
                $http.post(url, data)
                    .success(function(msg){
                        wsh.successback(msg, '', false, function(){
                            callback.call(this, scope.options.backDataName ? msg.errmsg.data : msg.errmsg);
                        })
                    })
            }
		}
	};
});