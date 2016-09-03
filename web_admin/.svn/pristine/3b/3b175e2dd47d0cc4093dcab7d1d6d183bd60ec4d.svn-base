app.controller('templateController', function($scope, $rootScope, $routeParams, $location, $http, userInfo) {
    $scope.options={page: 'page', callback: getData}
    $scope.type = 1;
    $scope.aa = 0;
    $scope.bb = 0;
    $scope.cc = 0;
    $scope.title = 0;
    console.log($("#weza-template").height())
    $("#weza-template").niceScroll({  
        cursorcolor:"#3e94e1",  
        cursoropacitymax:1,  
        touchbehavior:false,  
        cursorwidth:"2px",  
        cursorborder:"0",  
        cursorborderradius:"1px"  
    }); 
    var aa = userInfo.getListAjax('/magazine/template-category-list-ajax', {});
    aa.then(function (msg) {
        $scope.tempCategory = msg.errmsg;
    })
    $scope.template = [];
    $scope.category_id = 11;
    var int = 1, name;
    getData(int);
    function getData(int) {

        $http.post("/magazine/template-list-ajax", {"_page": int, "_page_size": 10, 'category_id': $scope.category_id, 'tag_id': $scope.tag,  'type': $scope.type, 'name': $scope.searchText})
            .success(function (msg) {
                wsh.successback(msg, '', false, function () {
                    $scope.magazineList = msg.errmsg.data;
                    $scope.page = msg.errmsg.page;
                    console.log(msg);
                });
            });
    }

  $scope.search = function(){
        name = $scope.searchText;
        getData(1)
  }

    $scope.colorLists = [{"id": 0, 'color': ''}, {"id": 32, 'color': '#000'}, {"id": 33, 'color': '#090'},
        {"id": 69, 'color': '#909'}, {"id": 70, 'color': '#00f'}, {"id": 71, 'color': '#fcc'}, {"id": 72, 'color': '#ff0'},
        {"id": 73, 'color': '#ff0'},
     {"id": 74, 'color': '#fff'}, {"id": 75, 'color': '#bbb'}];
    $scope.styleList = [{"id": 0, "name": "全部"}, {"id": 52, "name": "雅致"}, {"id": 53, "name": "可爱"}, {
        "id": 54, "name": "时尚"
    }, {"id": 55, "name": "简约"}, {"id": 56, "name": "潮流"}, {"id": 57, "name": "庆典"}];
    $scope.useList = [{"id": 0, "name": "全部"}, {"id": 59, "name": "商业"}, {"id": 60, "name": "报名"}, {
        "id": 61, "name": "年会"
    }];
    $scope.titleList = [{"id": 1,"type":1, "name": "推荐模版"}, {"id": 2,"type":1, "name": "热门模版"}, {"id": 3,"type":3, "name": "最新模版"}, {
        "id": 4,"type":4, "name": "经典案例"
    }];

    $rootScope.isoldVersion = false;

    $scope.templateList = [];
    $scope.tag = [null, null, null];
    $scope.clickCategory = function (index, list) {
        if($scope.aa != index){
            $scope.aa = index;
            $scope.category_id = list.id;
            getData(1)
        }
    }
    $scope.clickStyle = function (index, list) {
        if($scope.bb != index){
            $scope.bb = index;
            $scope.tag[0] = list.id && list.id || null;
            getData(1)
        }
    }
    $scope.clickUse = function (index, list) {
        if($scope.cc != index){
            $scope.cc = index;
            $scope.tag[1] = list.id && list.id || null;
            getData(1)
        }
    }
    $scope.clickColor = function (index, list) {
        if($scope.dd != index){
            $scope.dd = index;
            $scope.tag[2] = list.id && list.id || null;
            getData(1)
        }
    }
    $scope.clickTitle = function (index, list) {
        if($scope.title != index){
            $scope.title = index;
            $scope.type = list.id && list.id || null;
            getData(1)
        }
    }
    $scope.templateClick = function(id){
        if(id == -1){
            return $http.post('/magazine/add-ajax', {})
                    .success(function (msg) {
                        wsh.successback(msg, '', false, function(){
                            window.location.href = '/magazine/edit#' + msg.errmsg.id;
                        })
                    })
        }
        //创建应用
        $rootScope.createOrget({'template_id': id}, true, function(data){
            window.location.href = '/magazine/edit#' + data.id;
        }); 
    }
});

