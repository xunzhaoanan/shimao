app.controller('imageController', function ($scope, $rootScope, $routeParams, $location, $http, $parse, userInfo) {
  $scope.options = {page: 'page1', callback: getData, isRoot: true};
  var isfirst = 1, string, loaded;
  $scope.imageHtml = '';
  $scope.imageToggle = 1;
  $scope.imgLists = [];
  var selectId = '';
  var name = ''
  $scope.groupId = '';

  $scope.loadImage = function () {
    $scope.imageMask = true;
    $('#myModalImage').css('top', '-100%');
    $('#myModalImage').animate({top: '0'}, 500, function () {
      $scope.$apply();
    });
    loaded = true;
    getData(1);
    setUpload();
  }

  //接收图片开启事件
  $scope.$on('imgUpload', function (e, string) {
    string = string;
    if (isfirst) {
      $scope.imageHtml = '/magazine/image';
      isfirst = 0;
      return;
    } else {
      $scope.imageMask = true;
      $('#myModalImage').animate({top: '0'}, 500, function () {
        $scope.options.status = 'update';
        $scope.options.width = $('#myImageModal').width();
        //$scope.options.width = 730;
        $scope.$apply();
      });
    }
  })

  //本地上传选择分组
  $scope.groupChange = function (id) {
    $scope.groupId = id;
  };

  $http.post("/document/find-category-ajax")
    .success(function (msg) {
      wsh.successback(msg, '', false, function () {
        $scope.groupOptios = msg.errmsg;
      });
    })

  //切换 tab
  $scope.toggle = function (index) {
    $("#groupId").val('');
    $("#groupIdto").val('');
    $("#searchText").val('');
    $scope.groupId = '';
    selectId='';
    name = '';
    if (index == $scope.imageToggle) return;
    $scope.imageToggle = index;
    if (index == 1) {
      console.log(selectId)
      getData(1);
    }
  }

  //图片点击
  $scope.clickImg = function (index) {
    $scope.imgListIndex = index;
    //$scope.name = $scope.imgLists[index].name;
  };

  //按分组条件搜索图片库
  $scope.groupChenge = function (id) {
    $("#searchText").val('');
    name = '';
    selectId = parseInt(id);
    getData(1);
  }
  $scope.changeQuer = function (id,searchText) {
    name = searchText;
    selectId = parseInt(id);
    getData(1);
  }

  //图片删除
  $scope.deleted = function (index) {
    wsh.setNoAjaxDialog('删除提示', '确定要删除该图片吗?', function () {
      $scope.imgLists.splice(index, 1);
      $scope.$apply();
    });
  };
  function setUpload() {
    $('#chooseImage').uploadify({
      'fileTypeDesc': '不超过300kb的图片 (*.gif;*.jpg;*.png)',
      'fileTypeExts': '*.gif;*.jpg;*.jpeg;*.png',//
      'fileSizeLimit': '300kb',
      'swf': '/ace/uploadify/uploadify.swf',
      'uploader': '/document/upload-ajax',
      'buttonClass': 'btn btn-sm btn-info',
      'buttonText': '上传图片',
      'width': 100,
      'height': 23,
      'opacity': 0,
      'background': '#428bca',
      '-webkit-border-radius': 0,
      'border-radius': 0,
      'border': 0,
      'multi': $rootScope.isuploadOne ? false : true,
      'removeTimeout': 0.1,
      'onUploadStart': function (file) {

      },
      'onFallback': function () {
        alert("您未安装FLASH控件，无法上传图片！请安装FLASH控件后再试。");
      },
      'onUploadSuccess': function (file, data, response) {
        try {
          data = $parse(data)($scope);
          if (data.errcode == 0) {
            $scope.imgLists.push(data.errmsg);
            $scope.imgLists[$scope.imgLists.length - 1].tag_id = 1;
            $scope.clickImg($scope.imgLists.length - 1);
            $scope.$apply();
          }
        } catch (e) {
          console.log(e.name);
        }
        ;
      }
    });
    $('#chooseImage').css({
      'position': 'absolute',
      'top': '0',
      'left': '147px',
      'width': '100',
      'height': '23',
      'opacity': '0'
    });
  }

  function getData(int) {
    var aa = userInfo.getListAjax('/document/image-ajax', {
      '_page': int,
      '_page_size': 15,
      "category_id": selectId,
      "name": name
    });
    aa.then(function (msg) {
      $rootScope.page1 = msg.errmsg.page;
      $scope.lists = msg.errmsg.data;
    })
  }

  //选择 图片
  $scope.choose = function (index, list) {
    list.ischoose = !list.ischoose;
    if ($rootScope.ischooseOne) {
      if (list.ischoose) {
        $.each($scope.lists, function (i, e) {
          if (i != index) e.ischoose = false;
        });
      }
    }
  }
  //关闭
  $scope.close = function () {
    $('#myModalImage').animate({top: '-100%'}, 500, function () {
      $scope.imageMask = false;
      $scope.$apply();
    });
    $.each($scope.lists, function (i, e) {
      e.ischoose = false;
    });
  }
  //确定
  var iscon = false;
  $scope.confirm = function () {
    if (iscon) return;
    switch ($scope.imageToggle) {
      //上传
      case 0:
        if (!$scope.imgLists.length) return alert('请上传图片');
        $.each($scope.imgLists, function (i, e) {
          $scope.imgLists[i].category_id = $scope.groupId;
        });
        iscon = true;
        var aa = userInfo.getListAjax('/document/create-ajax', {list: $scope.imgLists});
        aa.then(function (msg) {
          $rootScope.$broadcast('ImageListChange', msg.errmsg);
          $scope.imgLists = [];
          iscon = false;
          $scope.close()
        })
        break;
      //选择
      case 1:
        iscon = true;
        var imageArray = [];
        $.each($scope.lists, function (i, e) {
          if (e.ischoose) imageArray.push(e);
          e.ischoose = false;
        })
        if (!imageArray.length) return alert('请选择图片');
        $rootScope.$broadcast('ImageChoose', imageArray);
        //$scope.page = {}
        iscon = false;
        $scope.close()
        break;
    }
  }
  var imagePager;
  $scope.$watch('page.total_page', function (a) {
    if (a > 1) {
      $('#imageCenter').show();
      if (imagePager instanceof paginate) {
        return imagePager.update({count: a, start: 1});
      }
      imagePager = new paginate({
        self: $("#imagePager"),
        parent: $('#imageCenter'),
        count: a,
        start: 1,
        display: 10,
        border: true,
        border_color: '#fff',
        text_color: '#fff',
        background_color: '#2283c5',
        border_hover_color: '#ccc',
        text_hover_color: '#000',
        background_hover_color: '#fff',
        images: false,
        mouse: 'press',
        onChange: function (page, string) {
          getData(page);
        }
      })
    } else {
      $('#imageCenter').hide()
    }
  });
});