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


use common\forms\GeneralForm;
use common\forms\wxmaterial\ImageAddAjaxForm;
use common\forms\wxmaterial\ImageEditAjaxForm;
use common\forms\wxmaterial\ImageEditForm;
use common\forms\wxmaterial\ImageListAjaxForm;
use common\forms\wxmaterial\MusicAddAjaxForm;
use common\forms\wxmaterial\MusicEditAjaxForm;
use common\forms\wxmaterial\MusicEditForm;
use common\forms\wxmaterial\NewsAddAjaxForm;
use common\forms\wxmaterial\NewsEditAjaxForm;
use common\forms\wxmaterial\NewsEditForm;
use common\forms\wxmaterial\NewsListAjaxForm;
use common\forms\wxmaterial\NewsWshAddAjaxForm;
use common\forms\wxmaterial\NewsWshEditAjaxForm;
use common\forms\wxmaterial\TextAddAjaxForm;
use common\forms\wxmaterial\TextDelAjaxForm;
use common\forms\wxmaterial\TextEditAjaxForm;
use common\forms\wxmaterial\TextEditForm;
use common\forms\wxmaterial\TextListAjaxForm;
use common\forms\wxmaterial\VideoAddAjaxForm;
use common\forms\wxmaterial\VideoEditAjaxForm;
use common\forms\wxmaterial\VideoEditForm;
use common\forms\wxmaterial\VoiceAddAjaxForm;
use common\forms\wxmaterial\VoiceEditAjaxForm;
use common\forms\wxmaterial\VoiceEditForm;
use common\models\WxMaterial;
use common\newforms\IdForm;
use common\services\weixin\WxMaterialService;
use common\vendor\wechat\WechatMaterial;
use Yii;


class WxmaterialController extends BaseController
{

    protected $wxMaterialService ;
    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->wxMaterialService = new WxMaterialService($this->_wxInfo);
    }

    /*
     * 文本素材列表
     */
    public function actionTextList(){
		return $this->render('text-list', []);
	}


    /*
     * 修改文本素材
     */
    public function actionTextEdit(){
        // form处理
        $form = new TextEditForm();
        $this->checkForm(["TextEditForm"=>Yii::$app->request->get()],$form);
        $replaceParams = ['id'=>'material_id'];
        $serviceParams = $this->handleForm($form,$replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->wxMaterialService->getText($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $model = $this->wxMaterialService->_data ;
        return $this->render('text-edit', ['model'=>$model]);
    }

    /*
     * 添加文本素材
     */
    public function actionTextAdd(){
        return $this->render('text-add', []);
    }

    /*
    * 文本素材列表
    */
    public function actionTextListAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        $form = new TextListAjaxForm();
        $this->checkForm(["TextListAjaxForm"=>Yii::$app->request->post()],$form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->wxMaterialService->findText($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult($this->wxMaterialService->_data);
    }

    /*
     * 修改文本素材
     */
    public function actionTextEditAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new TextEditAjaxForm();
        $this->checkForm(["TextEditAjaxForm"=>Yii::$app->request->post()],$form);
        $replaceParams = ['id' => 'material_id'];
        $serviceParams = $this->handleForm($form,$replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $serviceParams['reply_content'] = json_encode($serviceParams['reply_content']);
        $this->wxMaterialService->updateText($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }

    /*
     * 添加文本素材
     */
    public function actionTextAddAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new TextAddAjaxForm();
        $this->checkForm(["TextAddAjaxForm"=>Yii::$app->request->post()],$form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        $serviceParams['reply_content'] = json_encode($serviceParams['reply_content']);
        // 调用逻辑层
        $this->wxMaterialService->createText($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }

    /*
     * 删除文本素材
     */
    public function actionTextDelAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new TextDelAjaxForm();
        $this->checkForm(["TextDelAjaxForm"=>Yii::$app->request->post()],$form);
        $replaceParams = ['id' => 'material_id'];
        $serviceParams = $this->handleForm($form,$replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMaterialService->deleteText($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }

    /*
     * 图片素材列表
     */
    public function actionImageList(){
        return $this->render('image-list', []);
    }

    /*
     * 修改图片素材
     */
    public function actionImageEdit(){
        // form处理
        $form = new ImageEditForm();
        $this->checkForm(["ImageEditForm"=>Yii::$app->request->get()],$form);
        $replaceParams = ['id'=>'material_id'];
        $serviceParams = $this->handleForm($form,$replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->wxMaterialService->getImage($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $model = $this->wxMaterialService->_data ;
        return $this->render('image-edit', ['model'=>$model]);
    }

    /*
     * 添加图片素材
     */
    public function actionImageAdd(){
        return $this->render('image-add', []);
    }

    /*
     * 图片素材列表
     */
    public function actionImageListAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        $form = new ImageListAjaxForm();
        $this->checkForm(["ImageListAjaxForm"=>Yii::$app->request->post()],$form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->wxMaterialService->findImage($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult($this->wxMaterialService->_data);
    }

    /*
     * 微信图片素材列表
     */
    public function actionWxImageListAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        $form = new ImageListAjaxForm();
        $this->checkForm(["ImageListAjaxForm"=>Yii::$app->request->post()],$form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->wxMaterialService->findWxImage($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult($this->wxMaterialService->_data);
    }

    /*
     * 同步微信图片url到数据库
     */
    public function actionWxImageUrlToDb(){

        $serviceParams = [
            'shop_id' => $this->_shop['id']
        ];
        $this->wxMaterialService->WxImageUrlToDb($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult($this->wxMaterialService->_data);
    }

    /*
     * 修改图片素材
     */
    public function actionImageEditAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new ImageEditAjaxForm();
        $this->checkForm(["ImageEditAjaxForm"=>Yii::$app->request->post()],$form);
        $replaceParams = ['id' => 'material_id'];
        $serviceParams = $this->handleForm($form,$replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMaterialService->updateImage($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }

    /*
     * 添加图片素材
     */
    public function actionImageAddAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new ImageAddAjaxForm();
        $this->checkForm(["ImageAddAjaxForm"=>Yii::$app->request->post()],$form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        // 调用逻辑层
        $this->wxMaterialService->createImage($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }

    /**
     * 删除图片素材
     */
    public function actionImageDelAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new IdForm();
        $this->checkForm(["IdForm"=>Yii::$app->request->post()],$form);
        $replaceParams = ['id' => 'material_id'];
        $serviceParams = $this->handleForm($form,$replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMaterialService->deleteImage($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }

    /*
     * 图文素材列表
     */
    public function actionNewsList(){
        return $this->render('news-list', []);
    }

    /*
     * 删除图文素材
     */
    public function actionNewsDelAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new TextDelAjaxForm();
        $this->checkForm(["TextDelAjaxForm"=>Yii::$app->request->post()],$form);
        $replaceParams = ['id' => 'material_id'];
        $serviceParams = $this->handleForm($form,$replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMaterialService->deleteNews($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }

    /*
     * 修改图文素材
     */
    public function actionNewsEdit(){
        // form处理
        $form = new NewsEditForm();
        $this->checkForm(["NewsEditForm"=>Yii::$app->request->get()],$form);
        $replaceParams = ['id'=>'material_id'];
        $serviceParams = $this->handleForm($form,$replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->wxMaterialService->getNewsNew($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $model = $this->wxMaterialService->_data ;
        return $this->render('news-edit', ['model'=>$model]);
    }

    /*
     * 添加图文素材
     */
    public function actionNewsAdd(){
        return $this->render('news-add', []);
    }

    /*
     * 图文素材列表
     */
    public function actionNewsListAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        $form = new NewsListAjaxForm();
        $this->checkForm(["NewsListAjaxForm"=>Yii::$app->request->post()],$form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'type' => WxMaterial::NEWS_TYPE_WX
        ];
        $this->getPageInfo($serviceParams);
        $this->wxMaterialService->findNews($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult($this->wxMaterialService->_data);
    }

    /*
     * 图文素材列表（修改返回参数）
     */
    public function actionNewsListAjaxNew(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        $form = new NewsListAjaxForm();
        $this->checkForm(["NewsListAjaxForm"=>Yii::$app->request->post()],$form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'type' => WxMaterial::NEWS_TYPE_WX
        ];
        $this->getPageInfo($serviceParams);
        $this->wxMaterialService->findNewsNew($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult($this->wxMaterialService->_data);
    }

    /*
     * 修改图文素材
     */
    public function actionNewsEditAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new NewsEditAjaxForm();
        $this->checkForm(["NewsEditAjaxForm"=>Yii::$app->request->post()],$form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $newsParams = ['author' => $this->_shop['name'],'sourceUrlPre' => getMobileSite()];
        $this->wxMaterialService->updateNews($serviceParams,$newsParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }

    /*
     * 添加图文素材
     */
    public function actionNewsAddAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new NewsAddAjaxForm();
        $this->checkForm(["NewsAddAjaxForm"=>Yii::$app->request->post()],$form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $serviceParams['cdn_path'] = $serviceParams['item'][0]['cdn_path'];
        // 调用逻辑层
        $newsParams = ['author' => $this->_shop['name'],'sourceUrlPre' => getMobileSite()];
        $this->wxMaterialService->createNews($serviceParams,$newsParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }

    /*
     * 添加微商户图文素材
     */
    public function actionNewsWshAddAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new NewsWshAddAjaxForm();
        $this->checkForm(["NewsWshAddAjaxForm"=>Yii::$app->request->post()],$form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'is_wsh' => 1,
        ];
        // 调用逻辑层
        $this->wxMaterialService->createWshNews($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }

    /*
     * 修改图文素材
     */
    public function actionNewsWshedit(){
        // form处理
        $form = new NewsEditForm();
        $this->checkForm(["NewsEditForm"=>Yii::$app->request->get()],$form);
        $replaceParams = ['id'=>'material_id'];
        $serviceParams = $this->handleForm($form,$replaceParams);
        $serviceParams += [
          'shop_id' => $this->_shop['id']
        ];
        $this->wxMaterialService->getNewsNew($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $model = $this->wxMaterialService->_data ;
        return $this->render('news-wshedit', ['model'=>$model]);
    }

    /*
     * 修改微商户图文素材
     */
    public function actionNewsWshEditAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new NewsWshEditAjaxForm();
        $this->checkForm(["NewsWshEditAjaxForm"=>Yii::$app->request->post()],$form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMaterialService->updateWshNews($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }

    /*
    * 语音素材列表
    */
    public function actionVoiceList(){
        return $this->render('voice-list', []);
    }

    /*
     * 修改语音素材
     */
    public function actionVoiceEdit(){
        // form处理
        $form = new VoiceEditForm();
        $this->checkForm(["VoiceEditForm"=>Yii::$app->request->get()],$form);
        $replaceParams = ['id'=>'material_id'];
        $serviceParams = $this->handleForm($form,$replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->wxMaterialService->getVideo($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $model = $this->wxMaterialService->_data ;
        return $this->render('voice-edit', ['model'=>$model]);
    }

    /*
     * 添加语音素材
     */
    public function actionVoiceAdd(){
        return $this->render('voice-add', []);
    }

    /*
     * 语音素材列表
     */
    public function actionVoiceListAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        $serviceParams = [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->wxMaterialService->findVoice($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult($this->wxMaterialService->_data);
    }


    /*
     * 修改语音素材
     */
    public function actionVoiceEditAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new VoiceEditAjaxForm();
        $this->checkForm(["VoiceEditAjaxForm"=>Yii::$app->request->post()],$form);
        $replaceParams = ['id' => 'material_id'];
        $serviceParams = $this->handleForm($form,$replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMaterialService->updateVoice($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }

    /*
     * 添加语音素材
     */
    public function actionVoiceAddAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new VoiceAddAjaxForm();
        $this->checkForm(["VoiceAddAjaxForm"=>Yii::$app->request->post()],$form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        // 调用逻辑层
        $this->wxMaterialService->createVoice($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }


    /*
     * 音乐素材列表
     */
    public function actionMusicList(){
        return $this->render('music-list', []);
    }

    /*
     * 编辑音乐素材
     */
    public function actionMusicEdit(){
        // form处理
        $form = new MusicEditForm();
        $this->checkForm(["MusicEditForm"=>Yii::$app->request->get()],$form);
        $replaceParams = ['id'=>'material_id'];
        $serviceParams = $this->handleForm($form,$replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->wxMaterialService->getMusic($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $model = $this->wxMaterialService->_data ;
        return $this->render('music-edit', ['model'=>$model]);
    }

    /*
     * 添加音乐素材
     */
    public function actionMusicAdd(){
        return $this->render('music-add', []);
    }

    /*
     * 音乐素材列表
     */
    public function actionMusicListAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        $serviceParams = [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->wxMaterialService->findMusic($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult($this->wxMaterialService->_data);
    }

    /*
     * 编辑音乐素材
     */
    public function actionMusicEditAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new MusicEditAjaxForm();
        $this->checkForm(["MusicEditAjaxForm"=>Yii::$app->request->post()],$form);
        $replaceParams = ['id' => 'material_id'];
        $serviceParams = $this->handleForm($form,$replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMaterialService->updateMusic($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }

    /*
     * 添加音乐素材
     */
    public function actionMusicAddAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new MusicAddAjaxForm();
        $this->checkForm(["MusicAddAjaxForm"=>Yii::$app->request->post()],$form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        // 调用逻辑层
        $this->wxMaterialService->createMusic($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }


    /*
    * 视频素材列表
    */
    public function actionVideoList(){
        return $this->render('video-list', []);
    }

    /*
     * 编辑视频素材
     */
    public function actionVideoEdit(){
        // form处理
        $form = new VideoEditForm();
        $this->checkForm(["VideoEditForm"=>Yii::$app->request->get()],$form);
        $replaceParams = ['id'=>'material_id'];
        $serviceParams = $this->handleForm($form,$replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->wxMaterialService->getVideo($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $model = $this->wxMaterialService->_data ;
        return $this->render('video-edit', ['model'=>$model]);
    }

    /*
     * 添加视频素材
     */
    public function actionVideoAdd(){
        return $this->render('video-add', []);
    }

    /*
     * 视频素材列表
     */
    public function actionVideoListAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        $serviceParams = [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->wxMaterialService->findVideo($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult($this->wxMaterialService->_data);
    }

    /*
     * 编辑视频素材
     */
    public function actionVideoEditAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new VideoEditAjaxForm();
        $this->checkForm(["VideoEditAjaxForm"=>Yii::$app->request->post()],$form);
        $replaceParams = ['id' => 'material_id'];
        $serviceParams = $this->handleForm($form,$replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMaterialService->updateVideo($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }

    /*
     * 添加视频素材
     */
    public function actionVideoAddAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // form处理
        $form = new VideoAddAjaxForm();
        $this->checkForm(["VideoAddAjaxForm"=>Yii::$app->request->post()],$form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        // 调用逻辑层
        $this->wxMaterialService->createVideo($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult();
    }


    /*
     * 上傳微信素材
     */
    public function actionUploadAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        // 是否有传输文件
        if ( !isset($_FILES['Filedata']) || empty($_FILES['Filedata'])) {
            return $this->setError('上传中断，请刷新重试');
        }
        // 格式化文件参数
        // 格式化文件参数
        $postFile = $_FILES['Filedata'];
        $params['fileName'] = str_replace(strrchr($postFile['name'], '.'),'',$postFile['name']);
        $params['fileName'] = str_replace(array("@","!","$","#","%","^","&","'","\\","'","\""),"",$params['fileName']);
        if(empty($params['fileName'])){
            $params['fileName'] = time().rand(0,1000);
        }
        $params['postName'] = $params['fileName'].strrchr($postFile['name'], '.');
        $params['filePath'] = $postFile['tmp_name'];
        $this->wxMaterialService->upload($params);
        // 接收逻辑层处理结果
        if ( ! is_null($this->wxMaterialService->getError())){
            return $this->setError($this->wxMaterialService->getError());
        }
        $this->setResult($this->wxMaterialService->_data);
    }

    /*
     * 素材选择框插件
     */
    public function actionIndex(){
        return $this->renderPartial('index', []);
    }


    // 编辑文件  张良
    public function actionTextListss(){
        return $this->render('text-listss', []);
    }
    public function actionNewsListss(){
        return $this->render('news-listss', []);
    }
    public function actionNewsWshadd(){
        return $this->render('news-wshadd', []);
    }

}