<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '素材管理';
?>
<link href="/ace/js/angular-qqface/emoji.min.css" rel="stylesheet"/>
<div class="main-container" id="main-container" ng-controller="mainController" ng-cloak>
  <script type="text/javascript">
    try {
      ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
  </script>
  <div
    class="main-container-inner"> <?php echo $this->render('@app/views/side/weixin_setting.php'); ?>
    <div class="main-content">
      <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
          try {
            ace.settings.check('breadcrumbs', 'fixed')
          } catch (e) {
          }
        </script>
        <ul class="breadcrumb">
          <li>素材管理</li>
        </ul>
        <!-- .breadcrumb -->
        <!-- #nav-search -->
      </div>
      <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
          <div class="col-xs-12">
            <!--操作栏-->
            <div class="row ">
              <div class="col-sm-12 ">
                <a data-toggle="modal" data-target="#newtextbox"
                   class="btn btn-xs btn-primary tian float-left">添加文本</a>
                <script type="text/javascript">
                  $(document).ready(function () {
                    $(".tian").click(function () {
                      $(".jiasucai").toggle();
                    });
                  });
                </script>
                <div class=" float-right">
                  <div class="float-right">
                    <div class="input-group float-left">
                      <input class="min-width120 float-left" placeholder="搜索消息相关关键字" type="text"
                             ng-model="searchText">
                      <span class="float-left "> <a ng-click="getText(1)"
                                                    class="btn btn-xs btn-primary margin_right1"><i
                            class="icon-search icon-on-right bigger-110"></i></a> </span></div>
                  </div>
                </div>
              </div>
            </div>
            <!--/操作栏-->
            <div class="space-6"></div>
            <div class="row">
              <div class="col-sm-12 clearfix">
                <div ng-class="{true: 'tab-pane active', false: 'tab-pane'}[toggleIndex == 2]">
                  <table class="table table-striped table-bordered table-hover table-width">
                    <tr>
                      <th width="15%">文本标签</th>
                      <th width="55%">文本内容</th>
                      <th width="20%">添加时间</th>
                      <th width="10%">操作</th>
                    </tr>
                    <tr ng-repeat="list in textList">
                      <td><span ng-bind="list.title | limitTo : 15"
                                class="sc_title titleEdit"></span></td>
                      <td style="overflow: hidden;"><span
                          ng-bind-html="list.reply_content | sysface | trust:'html'"
                          class="textthd content"></span></td>
                      <td><span ng-bind="list.modified*1000 | date:'yyyy-MM-dd HH:mm:ss'"></span>
                      </td>
                      <td class="action-buttons">
                        <div>
                          <a class="blue pointer" data-toggle="modal" data-target="#textbox"
                             title="编辑" ng-click="edit(list)"> <i
                              class="icon-bianji bigger-130"></i> </a>
                          <a class="red pointer" data-toggle="modal" data-target="#" title="删除"
                             ng-click="deltext(list.id)"> <i class="icon-shanchu bigger-130"></i>
                          </a>

                        </div>
                      </td>
                    </tr>
                  </table>
                  <div ng-show="!textList.length" class="text-center red">暂时没有可显示的数据</div>
                  <div ng-paginate options="options" page="page"></div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.main-container-inner -->
  </div>
  <!--添加文本信息-->
  <div class="modal fade" id="newtextbox" tabindex="-1" role="dialog"
       aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel1">添加文本消息</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              <form class="form-horizontal" name="myform" novalidate>
                <div class="form-group">
                  <label class="col-sm-2 control-label">文本标签：</label>

                  <div class="col-sm-10">
                    <input type="text" class="width200 inline" ng-model="groupObj.title"
                           name="title"  placeholder="请输入名字" maxlength="30" reg-char-len="30" prompt-msg="promptMsg" prompt-type="2" ng-trim="false" diff-zh="true" required>
                    <span class="inline padding5" ng-class="{'red':namemy.title.$error.exceed}" ng-bind="promptMsg">

                    </span>
                    <span class="inline red margin-top5"
                          ng-show="myform.title.$error.required && istrue">必填项</span>

                    <p class="grey">请用简短的词或字描述此文本消息</p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">文本内容：</label>

                  <div class="col-sm-10">
                    <div
                      class="frm_textarea_box with_counter counter_out counter_in append count com_form">
                      <div class="face-box" style="height: 40px;">
                        <qqface target="addContent"></qqface>
                        <emoji target="addContent"></emoji>
                      </div>
                      <textarea id="addContent" style="width: 446px;height: 320px;"></textarea>
                      <span class="block red" style="position: absolute; left: 4px; top: 384px;"
                            ng-show="!param.addContent && istrue">必填项（不能输入纯空格）</span>
                      <!--  <span class="block red" style="position: absolute; left: 4px; top: 384px;"
                              ng-show="!param.addContent && !param.addContent.trim().length && istruee">不能输入纯空格</span>-->
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">取消</button>
          <button type="button" class="btn btn-sm btn-primary" ng-click="save()" id="submit">保存
          </button>
        </div>
      </div>
    </div>
  </div>

  <!--编辑文本信息-->
  <div class="modal fade" id="textbox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">编辑文本消息</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              <form class="form-horizontal" name="myformtwo" novalidate>
                <div class="form-group">
                  <label class="col-sm-2 control-label">文本标签：</label>

                  <div class="col-sm-10">
                    <input type="text" class="width200 inline" ng-model="groupObj.title"
                           name="title"  placeholder="请输入名字" maxlength="30" reg-char-len="30" prompt-msg="promptMsg" prompt-type="2" ng-trim="false" diff-zh="true" required>
                    <span class="inline padding5" ng-class="{'red':namemy.title.$error.exceed}" ng-bind="promptMsg">

                    </span>
                    <span class="inline red margin-top5"
                          ng-show="myform.title.$error.required && istrue">必填项</span>

                    <p class="grey">请用简短的词或字描述此文本消息</p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">文本内容：</label>

                  <div class="col-sm-10">
                    <div
                      class="frm_textarea_box with_counter counter_out counter_in append count com_form">
                      <div class="face-box" style="height: 40px;">
                        <qqface target="editContent"></qqface>
                        <emoji target="editContent"></emoji>
                      </div>
                      <textarea id="editContent" style="width: 446px;height: 320px;"></textarea>
                      <span class="block red" style="position: absolute; left: 4px; top: 384px;"
                            ng-show="!param.editContent && istrue">必填项（不能输入纯空格）</span>
                      <!--  <span class="block red" style="position: absolute; left: 4px; top: 384px;"
                              ng-show="param.editContent.trim() && istrue">不能输入纯空格</span>-->
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">取消</button>
          <button type="button" class="btn btn-sm btn-primary" ng-click="editsave()" id="submit1">
            保存
          </button>
        </div>
      </div>
    </div>
  </div>

</div>
<script type="text/javascript" src="/ace/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/ace/js/ueditor/ueditor.all.js"></script>
<script>

  app.controller('mainController', function ($scope, $http, $timeout, $rootScope, $filter) {

    var editorConfig = {
      toolbars: [],//隐藏工具栏
      enableAutoSave: false,//关闭自动保存
      iframeCssUrl: '/ace/js/angular-qqface/emoji.min.css',//外部样式文件
      imageScaleEnabled: false,//禁用拉伸图标
      maximumWords: 500,//最大输入值
      zIndex: 0,//层级
      autoSyncData: false,
      saveInterval: 600000,
      initialFrameHeight: 320,
      autoHeightEnabled: false,
      pasteplain: true,//启用纯文本粘贴
      wordOverFlowMsg: '<span style="color:red;">字符过多</span>'
    };

    $scope.addContent = UE.getEditor('addContent', angular.copy(editorConfig));

    $scope.addContent.addListener('contentChange', function () {
      $scope.param.addContent = $scope.addContent.getContent().replace(/(<img.*?facecode="|" end=""\/>)/g, '').replace(/<br\/>/g, "\n").replace(/<.*?>/g, '').replace(/&nbsp;/g, " ");
    });

    $scope.editContent = UE.getEditor('editContent', angular.copy(editorConfig));

    $scope.editContent.addListener('contentChange', function () {
      $scope.param.editContent = $scope.editContent.getContent().replace(/(<img.*?facecode="|" end=""\/>)/g, '').replace(/<br\/>/g, "\n").replace(/<.*?>/g, '').replace(/&nbsp;/g, " ");
    });

    $timeout(function () {
      $rootScope.$broadcast('leftMenuChange', 'ba');
    }, 100);
    $scope.toggleIndex = 2;
    $scope.param = {
      addContent: '',
      editContent: ''
    };

    //获取文本素材
    $scope.getText = function (int) {
      $http.post("/wxmaterial/text-list-ajax", {'_page': int, '_page_size': 10, 'title': $scope.searchText})
        .success(function (msg) {
          wsh.successback(msg, '', false, function () {
            $scope.textList = msg.errmsg.data;
            $scope.textList.forEach(function (e, i) {
              e.ischoose = true;
            });
            $scope.page = msg.errmsg.page;
          });
        })
    };
    $scope.getText(1);
    //分页的
    $scope.options = {callback: $scope.getText};
    $scope.titleEdit = function (index) {
      $scope.textList[index].ischoose = false;
      $('.content').eq(index).attr('contenteditable', 'true');
      $('.titleEdit').eq(index).attr('contenteditable', 'true').focus();
    }
    //右上侧搜索设置
    $scope.searchText = '';
    $('#newtextbox').on('hide.bs.modal', function () {
      $scope.groupObj.title = '';
      $scope.param.addContent = '';
      $scope.addContent.setContent('');
    });

    $('#textbox').on('hide.bs.modal', function () {
      $scope.groupObj.title = '';
      $scope.param.editContent = '';
      $scope.editContent.setContent('');
    });

    //添加文本保存
    $scope.save = function () {
      if ($scope.myform.$invalid || $scope.addContent.getContentLength(true) > 500 || !$scope.param.addContent) {
        $scope.istrue = true;

        return $timeout(function () {
          $scope.istrue = false;
        }, 3000);
      }
      $('#submit').attr('disabled', 'disabled');
      $scope.groupObj.reply_content = $scope.param.addContent;
      $http.post("/wxmaterial/text-add-ajax", $scope.groupObj)
        .success(function (msg) {
          $('#submit').removeAttr('disabled');
          wsh.successback(msg, '提交成功', true, function () {
          });
        });
    };

    //编辑文本保存
    $scope.editsave = function (index) {
      if ($scope.myformtwo.$invalid || $scope.editContent.getContentLength(true) > 500 || !$scope.param.editContent) {
        $scope.istrue = true;
        return $timeout(function () {
          $scope.istrue = false;
        }, 3000);
      }
      $('#submit1').attr('disabled', 'disabled');
      $scope.groupObj.reply_content = $scope.param.editContent;
      $http.post("/wxmaterial/text-edit-ajax", $scope.groupObj)
        .success(function (msg) {
          $('#submit1').removeAttr('disabled');
          wsh.successback(msg, '提交成功', true, function () {
            $scope.textList[index].ischoose = true;
            $scope.$apply();
          }, 'json');
        });
    };
    //编辑
    $scope.groupObj = {};
    $scope.edit = function (list) {
      $scope.groupObj = angular.copy(list);
      $scope.param.editContent = $scope.groupObj.reply_content;
      $scope.editContent.setContent($filter('sysface')($scope.param.editContent));
      $scope.isadd = false;
    };
    //删除
    $scope.deltext = function (id) {
      wsh.setDialog('删除提示', '是否要删除该文本素材', wsh.url + 'text-del-ajax', {"id": id}, function () {
        $scope.getText(1);
      }, '删除成功');
    };
  });
</script>