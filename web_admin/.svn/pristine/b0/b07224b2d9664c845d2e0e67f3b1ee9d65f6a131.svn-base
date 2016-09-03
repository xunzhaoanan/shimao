<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '二维码';
?>
<div class="main-container" id="main-container">
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div class="main-container-inner" ng-controller="mainController"> <?php echo $this->
    render('@app/views/side/fx.php');?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">try {
          ace.settings.check('breadcrumbs', 'fixed')
        } catch (e) {
        }</script>
        <ul class="breadcrumb">
          <li>二维码</li>
        </ul>
        <!-- .breadcrumb -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->

        <div class="row">
          <div class="col-xs-12">

            <div class="table-responsive clearfix">
              <table class="table table-striped table-bordered table-hover table-width">
                <thead>
                <tr>
                  <th width="10%" class="text-center">二维码归属</th>
                  <th width="10%" class="text-center">扫码人数统计</th>
                  <th width="8%" class="text-center">创建时间</th>
                  <th width="8%" class="text-center">操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td class="lt-width3 text-center">上海微商户</td>
                  <td class="text-center">0</td>
                  <td class="text-center"></td>
                  <td class="text-center"><a href="#">查看二维码</a></td>
                </tr>
                <tr>
                  <td class="lt-width3 text-center">上海微商户</td>
                  <td class="text-center">0</td>
                  <td class="text-center"></td>
                  <td class="text-center"><a href="#">查看二维码</a></td>
                </tr>
                </tbody>
              </table>
            </div>
            <div ng-paginate options="options" page="page"></div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>


<script>
  app.controller("mainController", function ($scope) {
    //分页
    $scope.options = {callback: getData};
    var int = 1;
    getData(int);
    function getData(int) {
      $.ajax({
        url: '<?= Url::to(["shop/staff-list-ajax"]);?>',
        type: 'POST',
        dataType: 'json',
        data: {
          '_page': int,
          '_page_size': 2
        },
        success: function (msg) {
          if (msg.errcode == 0) {
            if (!$.isArray(msg.errmsg.data)) {
              return $scope.empty = true, $scope.$apply();
            }
            $scope.lists = msg.errmsg.data;
            $scope.lists.forEach(function (i, e) {
              i.deleted = i.deleted == 1 ? true : false;
              i.created = getNowDate(i.created);
              i.flag = false;
            });
            $scope.page = msg.errmsg.page;
            $scope.$apply();
          }
        }
      });
    }
    function getNowDate(int) {
      var tt = new Date(parseInt(int) * 1000).toLocaleString();
      return tt;
    }

    $scope.change = function (index) {
      $scope.lists[index].isdisable = true;
      if (!$scope.lists[index].deleted) {
        $.post('<?= Url::to(["shop / staff - close - ajax"]);?>',
        {id: $scope.lists[index].id}, function (data) {
          $scope.lists[index].isdisable = false;
          $scope.$apply();
        }, 'json'
      );
      } else {
        $.post('<?= Url::to(["shop / staff - open - ajax"]);?>',
            {id: $scope.lists[index].id}, function (data) {
          $scope.lists[index].isdisable = false;
          $scope.$apply();
          console.log(data);
        }, 'json'
      )
        ;
      }

    };

  });


</script>

