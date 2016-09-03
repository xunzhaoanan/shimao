<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 * 商铺信息接口类
 * 1、店铺信息
 * 2、店铺日志
 * 3、分店列表
 */

namespace admin\controllers;


use common\cache\BaseCache;
use common\forms\document\CreateAjaxForm;
use common\forms\document\EditAjaxForm;
use common\forms\document\ImageAjaxForm;
use common\forms\GeneralForm;
use common\services\DocumentService;
use common\vendor\document\DocumentLib;
use Yii;


class DocumentController extends BaseController
{

    protected $documentService;

    function __construct($id, $module, $config = [])
    {
        $this->documentService = new DocumentService();
        parent::__construct($id, $module, $config);
    }

    /*
     * 圖片文件列表
     */
    public function actionImage()
    {
        return $this->render('image', []);
    }

    /*
     * 圖片文件列表分頁
     */
    public function actionImageAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new ImageAjaxForm();
        $this->checkForm(["ImageAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $this->getPageInfo($serviceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'file_type' => DocumentLib::TYPE_IMAGE
        ];
        if(isset($serviceParams['tag_id']) && $serviceParams['tag_id']){
            $serviceParams['shop_id'] = 0;
        }
        unset($serviceParams['shop_sub_id']);
        $this->documentService->find($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $this->setResult($this->documentService->_data);
    }

    /*
     * 上傳并且创建文件
     */
    public function actionUploadCreateAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // 是否有传输文件
        if (!isset($_FILES['upfile']) || empty($_FILES['upfile'])) {
            return $this->setError('上传中断，请刷新重试');
        }
        // 格式化文件参数
        $postFile = $_FILES['upfile'];
        $params['fileName'] = str_replace(strrchr($postFile['name'], '.'), '', $postFile['name']);
        $params['postName'] = $postFile['name'];
        $params['filePath'] = $postFile['tmp_name'];
        $this->documentService->upload($params);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $createParams['list'][] = [
            'file_cdn_path' => $this->documentService->_data['file_cdn_path'],
            'name' => $params['fileName'],
            'tag_id' => 1
        ];
        $createParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->documentService->create($createParams);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        exit("{'url':'" . $this->documentService->_data[0]['file_cdn_path'] . "','state':'SUCCESS','original': '','title':" . json_encode($this->documentService->_data[0]['name']) . "}");
    }

    /*
     * 上傳并且创建文件，新富文本编辑器
     */
    public function actionNewUploadCreateAjax($params)
    {
        // 是否有传输文件
        if (!isset($params['type']) || empty($params['type'])) {
            return $this->setError('上传中断，请刷新重试');
        }
        // 格式化文件参数
        $postFile = $params;
        $params['fileName'] = str_replace(strrchr($postFile['name'], '.'), '', $postFile['name']);
        $params['postName'] = $postFile['name'];
        $params['filePath'] = $postFile['tmp_name'];
        $this->documentService->upload($params);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $createParams['list'][] = [
            'file_cdn_path' => $this->documentService->_data['file_cdn_path'],
            'name' => $params['fileName'],
            'tag_id' => 1
        ];
        $createParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->documentService->create($createParams);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $data['url'] = $this->documentService->_data[0]['file_cdn_path'];
        $data['state'] = 'SUCCESS';
        $data['original'] = '';
        $data['title'] = $this->documentService->_data[0]['name'];
        exit(json_encode($data));
    }

    /**
     * ueditor 文本编辑器配置
     */
    public function actionUeditor(){

        $action = $_GET['action'];

        if($action == 'config'){
            exit('{
    /* 上传图片配置项 */
    "imageActionName": "uploadimage", /* 执行上传图片的action名称 */
    "imageFieldName": "upfile", /* 提交的图片表单名称 */
    "imageMaxSize": 2048000, /* 上传大小限制，单位B */
    "imageAllowFiles": [".png", ".jpg", ".jpeg", ".gif", ".bmp"], /* 上传图片格式显示 */
    "imageCompressEnable": false, /* 是否压缩图片,默认是true */
    "imageCompressBorder": 1600, /* 图片压缩最长边限制 */
    "imageInsertAlign": "none", /* 插入的图片浮动方式 */
    "imageUrlPrefix": "", /* 图片访问路径前缀 */
    "imagePathFormat": "/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
                                /* {filename} 会替换成原文件名,配置这项需要注意中文乱码问题 */
                                /* {rand:6} 会替换成随机数,后面的数字是随机数的位数 */
                                /* {time} 会替换成时间戳 */
                                /* {yyyy} 会替换成四位年份 */
                                /* {yy} 会替换成两位年份 */
                                /* {mm} 会替换成两位月份 */
                                /* {dd} 会替换成两位日期 */
                                /* {hh} 会替换成两位小时 */
                                /* {ii} 会替换成两位分钟 */
                                /* {ss} 会替换成两位秒 */
                                /* 非法字符 \ : * ? " < > | */
                                /* 具请体看线上文档: fex.baidu.com/ueditor/#use-format_upload_filename */

    /* 涂鸦图片上传配置项 */
    "scrawlActionName": "uploadscrawl", /* 执行上传涂鸦的action名称 */
    "scrawlFieldName": "upfile", /* 提交的图片表单名称 */
    "scrawlPathFormat": "/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
    "scrawlMaxSize": 2048000, /* 上传大小限制，单位B */
    "scrawlUrlPrefix": "", /* 图片访问路径前缀 */
    "scrawlInsertAlign": "none",

    /* 截图工具上传 */
    "snapscreenActionName": "uploadimage", /* 执行上传截图的action名称 */
    "snapscreenPathFormat": "/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
    "snapscreenUrlPrefix": "", /* 图片访问路径前缀 */
    "snapscreenInsertAlign": "none", /* 插入的图片浮动方式 */

    /* 抓取远程图片配置 */
    "catcherLocalDomain": ["127.0.0.1", "localhost", "img.baidu.com"],
    "catcherActionName": "catchimage", /* 执行抓取远程图片的action名称 */
    "catcherFieldName": "source", /* 提交的图片列表表单名称 */
    "catcherPathFormat": "/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
    "catcherUrlPrefix": "", /* 图片访问路径前缀 */
    "catcherMaxSize": 2048000, /* 上传大小限制，单位B */
    "catcherAllowFiles": [".png", ".jpg", ".jpeg", ".gif", ".bmp"], /* 抓取图片格式显示 */

    /* 上传视频配置 */
    "videoActionName": "uploadvideo", /* 执行上传视频的action名称 */
    "videoFieldName": "upfile", /* 提交的视频表单名称 */
    "videoPathFormat": "/ueditor/php/upload/video/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
    "videoUrlPrefix": "", /* 视频访问路径前缀 */
    "videoMaxSize": 102400000, /* 上传大小限制，单位B，默认100MB */
    "videoAllowFiles": [
        ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
        ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid"], /* 上传视频格式显示 */

    /* 上传文件配置 */
    "fileActionName": "uploadfile", /* controller里,执行上传视频的action名称 */
    "fileFieldName": "upfile", /* 提交的文件表单名称 */
    "filePathFormat": "/ueditor/php/upload/file/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
    "fileUrlPrefix": "", /* 文件访问路径前缀 */
    "fileMaxSize": 51200000, /* 上传大小限制，单位B，默认50MB */
    "fileAllowFiles": [
        ".png", ".jpg", ".jpeg", ".gif", ".bmp",
        ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
        ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid",
        ".rar", ".zip", ".tar", ".gz", ".7z", ".bz2", ".cab", ".iso",
        ".doc", ".docx", ".xls", ".xlsx", ".ppt", ".pptx", ".pdf", ".txt", ".md", ".xml"
    ], /* 上传文件格式显示 */

    /* 列出指定目录下的图片 */
    "imageManagerActionName": "listimage", /* 执行图片管理的action名称 */
    "imageManagerListPath": "/ueditor/php/upload/image/", /* 指定要列出图片的目录 */
    "imageManagerListSize": 20, /* 每次列出文件数量 */
    "imageManagerUrlPrefix": "", /* 图片访问路径前缀 */
    "imageManagerInsertAlign": "none", /* 插入的图片浮动方式 */
    "imageManagerAllowFiles": [".png", ".jpg", ".jpeg", ".gif", ".bmp"], /* 列出的文件类型 */

    /* 列出指定目录下的文件 */
    "fileManagerActionName": "listfile", /* 执行文件管理的action名称 */
    "fileManagerListPath": "/ueditor/php/upload/file/", /* 指定要列出文件的目录 */
    "fileManagerUrlPrefix": "", /* 文件访问路径前缀 */
    "fileManagerListSize": 20, /* 每次列出文件数量 */
    "fileManagerAllowFiles": [
        ".png", ".jpg", ".jpeg", ".gif", ".bmp",
        ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
        ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid",
        ".rar", ".zip", ".tar", ".gz", ".7z", ".bz2", ".cab", ".iso",
        ".doc", ".docx", ".xls", ".xlsx", ".ppt", ".pptx", ".pdf", ".txt", ".md", ".xml"
    ] /* 列出的文件类型 */

}');
        }elseif($action == 'uploadimage'){
            return $this->actionNewUploadCreateAjax($_FILES['upfile']);
        }elseif($action == 'listimage'){
            exit('{"state":"SUCCESS","list":[],"start":"0","total":0}');
        }
    }

    /*
     * 上傳文件
     */
    public function actionUploadAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // 是否有传输文件
        if (!isset($_FILES['Filedata']) || empty($_FILES['Filedata'])) {
            return $this->setError('上传中断，请刷新重试');
        }
        // 格式化文件参数
        $postFile = $_FILES['Filedata'];
        $params['fileName'] = str_replace(strrchr($postFile['name'], '.'), '', $postFile['name']);
        $params['fileName'] = str_replace(array("@", "!", "$", "#", "%", "^", "&", "'", "\\", "'", "\""), "", $params['fileName']);
        if (empty($params['fileName'])) {
            $params['fileName'] = time() . rand(0, 1000);
        }
        $params['postName'] = $params['fileName'] . strrchr($postFile['name'], '.');
        $params['filePath'] = $postFile['tmp_name'];
        $this->documentService->upload($params);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $this->setResult($this->documentService->_data);
    }

    /*
     * 创建文件
     */
    public function actionCreateAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new CreateAjaxForm();
        $this->checkForm(["CreateAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->documentService->create($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $this->setResult($this->documentService->_data);
    }

    /*
     * 修改文件
     */
    public function actionEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new EditAjaxForm();
        $this->checkForm(["EditAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->documentService->update($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $this->setResult($this->documentService->_data);
    }

    /**
     * 删除文档
     */
    public function actionDeleteAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->documentService->delete($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $this->setResult($this->documentService->_data);
    }

    /**
     * 删除文档
     */
    public function actionMultiDeleteAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $serviceParams = Yii::$app->request->post();
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->documentService->multiDelete($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $this->setResult($this->documentService->_data);
    }

    /*
     * 語音文件列表
     */
    public function actionVoice()
    {
        return $this->render('voice', []);
    }

    /*
     * 语音文件列表分頁
     */
    public function actionVoiceAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new ImageAjaxForm();
        $this->checkForm(["ImageAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $this->getPageInfo($serviceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'file_type' => DocumentLib::TYPE_VOICE
        ];
        $this->documentService->find($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $this->setResult($this->documentService->_data);
    }

    /*
     * 音樂文件列表
     */
    public function actionMusic()
    {
        return $this->render('music', []);
    }

    /*
     * 音樂文件列表分頁
     */
    public function actionMusicAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new ImageAjaxForm();
        $this->checkForm(["ImageAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $this->getPageInfo($serviceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'file_type' => DocumentLib::TYPE_MUSIC
        ];
        $this->documentService->find($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $this->setResult($this->documentService->_data);
    }

    /*
     * 視頻文件列表
     */
    public function actionVideo()
    {
        return $this->render('video', []);
    }

    /*
     * 視頻文件列表分頁
     */
    public function actionVideoAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new ImageAjaxForm();
        $this->checkForm(["ImageAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $this->getPageInfo($serviceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'file_type' => DocumentLib::TYPE_VIDEO
        ];
        $this->documentService->find($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $this->setResult($this->documentService->_data);
    }

    /*
    * 視頻文件列表
    */
    public function actionImagess()
    {
        return $this->render('imagess', []);
    }

    /**
     * 批量修改文档的分类
     */
    public function actionMultiUpdateDocCategoryAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $serviceParams = Yii::$app->request->post();
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->documentService->multiUpdateDocCategory($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $this->setResult($this->documentService->_data);
    }

    /**
     * 创建文档分类
     */
    public function actionCreateCategoryAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $serviceParams = Yii::$app->request->post();
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->documentService->createCategory($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $this->setResult($this->documentService->_data);
    }

    /**
     * 修改文档分类
     */
    public function actionUpdateCategoryAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $serviceParams = Yii::$app->request->post();
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->documentService->updateCategory($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $this->setResult($this->documentService->_data);
    }

    /**
     * 获取文档分类
     */
    public function actionGetCategoryAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $serviceParams = Yii::$app->request->post();
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->documentService->getCategory($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $this->setResult($this->documentService->_data);
    }

    /**
     * 文档分类列表
     */
    public function actionFindCategoryAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $serviceParams = Yii::$app->request->post();
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->documentService->findCategory($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $this->setResult($this->documentService->_data);
    }

    /**
     * 删除文档分类
     */
    public function actionDeleteCategoryAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $serviceParams = Yii::$app->request->post();
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->documentService->deleteCategory($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->documentService->getError())) {
            return $this->setError($this->documentService->getError());
        }
        $this->setResult($this->documentService->_data);
    }

}