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
use common\forms\weixin\AttentionReplyAddAjaxForm;
use common\forms\weixin\AttentionReplyCloseAjaxForm;
use common\forms\weixin\AttentionReplyEditAjaxForm;
use common\forms\weixin\AttentionReplyOpenAjaxForm;
use common\forms\weixin\DefaultReplyAddAjaxForm;
use common\forms\weixin\DefaultReplyCloseAjaxForm;
use common\forms\weixin\DefaultReplyEditAjaxForm;
use common\forms\weixin\DefaultReplyOpenAjaxForm;
use common\forms\weixin\DiymenuAddParentsAjaxForm;
use common\forms\weixin\DiymenuEditParentsAjaxForm;
use common\forms\weixin\DiymenuSortAjaxForm;
use common\forms\weixin\KeywordReplyAddAjaxForm;
use common\forms\weixin\KeywordReplyCloseAjaxForm;
use common\forms\weixin\KeywordReplyDelAjaxForm;
use common\forms\weixin\KeywordReplyEditAjaxForm;
use common\forms\weixin\KeywordReplyEditForm;
use common\forms\weixin\KeywordReplyOpenAjaxForm;
use common\forms\weixin\MessageListAjaxForm;
use common\forms\weixin\MessageReplyAjaxForm;
use common\forms\weixin\QrcodeDetailAjaxForm;
use common\models\WxMessage;
use common\models\WxReply;
use common\services\weixin\WxMessageService;
use common\services\weixin\WxQrcodeService;
use Yii;
use common\services\weixin\WxMenuService;
use common\services\weixin\WxReplyService;
use common\forms\weixin\DiymenuDelAjaxForm;
use common\forms\weixin\DiymenuEditAjaxForm;
use common\forms\weixin\DiymenuAddAjaxForm;

class WeixinController extends BaseController
{
    protected $wxMenuService;
    protected $wxReplyService;
    protected $qrcodeService;
    protected $wxMessageService;

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->wxMenuService = new WxMenuService();
        $this->wxReplyService = new WxReplyService();
        $this->wxMessageService = new WxMessageService();
    }

    public function actionIndex()
    {
        return $this->render('index', []);
    }

    /*
     * 消息列表
     */
    public function actionMessageList()
    {
        return $this->render('message-list');
    }

    /*
     * 消息分页
     */
    public function actionMessageListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new MessageListAjaxForm();
        $post = Yii::$app->request->post();
        $this->checkForm(["MessageListAjaxForm" => $post], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        if (empty($post['is_reply'])) {
            $serviceParams['is_reply'] = WxMessage::UN_REPLY;
        }
        $this->getPageInfo($serviceParams);
        // 调用逻辑层
        $this->wxMessageService->find($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMessageService->getError())) {
            return $this->setError($this->wxMessageService->getError());
        }
        $this->setResult($this->wxMessageService->_data);
    }

    /*
     * 回复消息
     */
    public function actionMessageReplyAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new MessageReplyAjaxForm();
        $this->checkForm(["MessageReplyAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

            'is_reply' => WxMessage::IS_REPLY,
            'to_user_name' => '商家公众号'
        ];
        // 调用逻辑层
        $this->wxMessageService->replyMessage($serviceParams, $this->_wxInfo);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMessageService->getError())) {
            return $this->setError($this->wxMessageService->getError());
        }
        $this->setResult();
    }

    /*
     * 收藏消息
     */
    public function actionMessageLikeOpenAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form, ['id' => 'message_id']);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

            'mark' => WxMessage::MESSAGE_LIKE,
        ];
        // 调用逻辑层
        $this->wxMessageService->likeMessage($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMessageService->getError())) {
            return $this->setError($this->wxMessageService->getError());
        }
        $this->setResult();
    }

    /*
     * 取消收藏消息
     */
    public function actionMessageLikeCloseAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form, ['id' => 'message_id']);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

            'mark' => WxMessage::MESSAGE_UNLIKE,
        ];
        // 调用逻辑层
        $this->wxMessageService->likeMessage($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMessageService->getError())) {
            return $this->setError($this->wxMessageService->getError());
        }
        $this->setResult();
    }

    /*
     * 自定义菜单列表
     */
    public function actionDiymenu()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'id' => ['sort' => 'asc'],
        ];
        $this->wxMenuService->find($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMenuService->getError())) {
            return $this->setError($this->wxMenuService->getError());
        }

        return $this->render('diymenu', ['model' => $this->wxMenuService->_data]);
    }

    /*
     * 自定义菜单列表
     */
    public function actionDiymenuSortAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new DiymenuSortAjaxForm();
        $this->checkForm(["DiymenuSortAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        foreach( $serviceParams['sortable'] as $val){
            if(!isset($val['id']) || !isset($val['sort'])){
                $this->setError('您提交的数据有误.');
            }
        }
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->wxMenuService->updateSort($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMenuService->getError())) {
            return $this->setError($this->wxMenuService->getError());
        }
        $this->setResult();
    }

    /*
     * 添加子级自定义菜单
     */
    public function actionDiymenuBatchAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
//        $form = new DiymenuAddAjaxForm();
//        $this->checkForm(["DiymenuAddAjaxForm" => Yii::$app->request->post()], $form);
//        $serviceParams = $this->handleForm($form);
        $serviceParams['menu'] = Yii::$app->request->post();
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        // 调用逻辑层
        $this->wxMenuService->batchCreate($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMenuService->getError())) {
            return $this->setError($this->wxMenuService->getError());
        }
        $this->setResult($this->wxMenuService->_data);
    }

    /*
     * 添加子级自定义菜单
     */
    public function actionDiymenuAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new DiymenuAddAjaxForm();
        $this->checkForm(["DiymenuAddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

            'display' => 1,
        ];
        // 调用逻辑层
        $this->wxMenuService->createChild($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMenuService->getError())) {
            return $this->setError($this->wxMenuService->getError());
        }
        $this->setResult($this->wxMenuService->_data);
    }

    /*
     * 添加父级自定义菜单
     */
    public function actionDiymenuAddParentsAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new DiymenuAddParentsAjaxForm();
        $this->checkForm(["DiymenuAddParentsAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'pid' => 0,
            'display' => 1,
            'shop_id' => $this->_shop['id'],

        ];
        // 调用逻辑层
        $this->wxMenuService->createParents($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMenuService->getError())) {
            return $this->setError($this->wxMenuService->getError());
        }
        $this->setResult($this->wxMenuService->_data);
    }

    /*
     * 修改子级自定义菜单
     */
    public function actionDiymenuEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new DiymenuEditAjaxForm();
        $this->checkForm(["DiymenuEditAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'menu_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMenuService->updateChild($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMenuService->getError())) {
            return $this->setError($this->wxMenuService->getError());
        }
        $this->setResult();
    }

    /*
     * 修改父级自定义菜单
     */
    public function actionDiymenuEditParentsAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new DiymenuEditParentsAjaxForm();
        $this->checkForm(["DiymenuEditParentsAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'menu_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMenuService->updateParents($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMenuService->getError())) {
            return $this->setError($this->wxMenuService->getError());
        }
        $this->setResult();
    }

    /*
     * 删除自定义菜单
     */
    public function actionDiymenuDelAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new DiymenuDelAjaxForm();
        $this->checkForm(["DiymenuDelAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'menu_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMenuService->delete($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMenuService->getError())) {
            return $this->setError($this->wxMenuService->getError());
        }
        $this->setResult();
    }

    /*
     * 发布自定义菜单列表
     */
    public function actionDiymenuPublishAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'id' => ['sort' => 'asc'],
        ];
        // 调用逻辑层
        $this->wxMenuService->publish($serviceParams, $this->_wxInfo);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMenuService->getError())) {
            return $this->setError($this->wxMenuService->getError());
        }
        $this->setResult();
    }

    /*
     * 默认回复
     */
    public function actionDefaultReplyEdit()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id']
        ];
        $this->wxReplyService->getDefault($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        return $this->render('default-reply-edit', ['model' => $this->wxReplyService->_data]);
    }

    /*
     * 创建默认回复信息
     */
    public function actionDefaultReplyAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new DefaultReplyAddAjaxForm();
        $this->checkForm(["DefaultReplyAddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        // 调用逻辑层
        $this->wxReplyService->createDefault($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        $this->setResult();
    }

    /*
     * 修改默认回复信息
     */
    public function actionDefaultReplyEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new DefaultReplyEditAjaxForm();
        $this->checkForm(["DefaultReplyEditAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'default_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxReplyService->updateDefault($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        $this->setResult();
    }

    /*
     * 开启默认回复
     */
    public function actionDefaultReplyOpenAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new DefaultReplyOpenAjaxForm();
        $this->checkForm(["DefaultReplyOpenAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'default_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->wxReplyService->openDefault($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        $this->setResult();
    }

    /*
     * 关闭默认回复
     */
    public function actionDefaultReplyCloseAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new DefaultReplyCloseAjaxForm();
        $this->checkForm(["DefaultReplyCloseAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'default_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->wxReplyService->closeDefault($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        $this->setResult();
    }

    /*
     * 关注时回复
     */
    public function actionAttentionReplyEdit()
    {
        return $this->render('attention-reply-edit');
    }

    /**
     * 获取关注时回复的数据
     */
    public function actionAttentionReplyGetAjax()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id']
        ];
        $this->wxReplyService->getAttention($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        $this->setResult($this->wxReplyService->_data);
    }

    /*
     * 创建关注时回复
     */
    public function actionAttentionReplyAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new AttentionReplyAddAjaxForm();
        $this->checkForm(["AttentionReplyAddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        // 调用逻辑层
        $this->wxReplyService->createAttention($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        $this->setResult();
    }

    /*
     * 修改关注时回复
     */
    public function actionAttentionReplyEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new AttentionReplyEditAjaxForm();
        $this->checkForm(["AttentionReplyEditAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'attention_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxReplyService->updateAttention($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        $this->setResult();
    }

    /*
     * 开启关注时回复
     */
    public function actionAttentionReplyOpenAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new AttentionReplyOpenAjaxForm();
        $this->checkForm(["AttentionReplyOpenAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'attention_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->wxReplyService->openAttention($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        $this->setResult();
    }

    /*
     * 关闭关注时回复
     */
    public function actionAttentionReplyCloseAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new AttentionReplyCloseAjaxForm();
        $this->checkForm(["AttentionReplyCloseAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'attention_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $this->wxReplyService->closeAttention($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        $this->setResult();
    }

    /*
     * 关键字回复列表
     */
    public function actionKeywordReplyList()
    {
        return $this->render('keyword-reply-list', []);
    }

    /*
     * 添加关键字回复
     */
    public function actionKeywordReplyAdd()
    {
        return $this->render('keyword-reply-add', []);
    }

    /*
     * 修改关键字回复
     */
    public function actionKeywordReplyEdit()
    {
        // form处理
        $form = new KeywordReplyEditForm();
        $this->checkForm(["KeywordReplyEditForm" => Yii::$app->request->get()], $form);
        $replaceParams = ['id' => 'keyword_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxReplyService->getKeyword($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        return $this->render('keyword-reply-edit', ['model' => $this->wxReplyService->_data]);
    }

    /*
     * 关键字回复分页
     */
    public function actionKeywordReplyListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'run_type' => WxReply::TYPE_USER,
            'keyword' => Yii::$app->request->post('keyword'),
            'search_type' => Yii::$app->request->post('search_type')
        ];
        $this->getPageInfo($serviceParams);
        // 调用逻辑层
        $this->wxReplyService->findKeyword($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        $this->setResult($this->wxReplyService->_data);
    }

    /*
     * 修改关键字回复
     */
    public function actionKeywordReplyEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new KeywordReplyEditAjaxForm();
        $this->checkForm(["KeywordReplyEditAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'keyword_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxReplyService->updateKeyword($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        $this->setResult();
    }

    /*
     * 添加关键字回复
     */
    public function actionKeywordReplyAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new KeywordReplyAddAjaxForm();
        $this->checkForm(["KeywordReplyAddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        // 调用逻辑层
        $this->wxReplyService->createKeyword($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        $this->setResult();
    }

    /*
     * 删除关键字回复
     */
    public function actionKeywordReplyDelAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new KeywordReplyDelAjaxForm();
        $this->checkForm(["KeywordReplyDelAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'keyword_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxReplyService->deleteKeyword($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        $this->setResult();
    }

    /*
     * 开启关键字回复
     */
    public function actionKeywordReplyOpenAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new KeywordReplyOpenAjaxForm();
        $this->checkForm(["KeywordReplyOpenAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'keyword_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxReplyService->openKeyword($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        $this->setResult();
    }

    /*
     * 关闭关键字回复
     */
    public function actionKeywordReplyCloseAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new KeywordReplyCloseAjaxForm();
        $this->checkForm(["KeywordReplyCloseAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'keyword_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxReplyService->closeKeyword($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxReplyService->getError())) {
            return $this->setError($this->wxReplyService->getError());
        }
        $this->setResult();
    }

    /*
     * 推送管理
     */
    public function actionPush()
    {
        return $this->render('push', []);
    }

    /*
     * 生成永久二维码
     * 好像没用了
     */
//    public function actionQrcodeAddAjax(){
//        if( ! Yii::$app->request->isPost ) {
//            return $this->setError();
//        }
//        // form处理
//        $form = new QrcodeAddAjaxForm();
//        $this->checkForm(["QrcodeAddAjaxForm"=>Yii::$app->request->post()],$form);
//        $serviceParams = $this->handleForm($form);
//        $serviceParams += [
//            'shop_id' => $this->_shop['id'],
//        ];
//        // 调用逻辑层
//        $this->qrcodeService = new WxQrcodeService($this->_wxInfo);
//        $this->qrcodeService->create($serviceParams);
//        // 接收逻辑层处理结果
//        if ( ! is_null($this->qrcodeService->getError())){
//            return $this->setError($this->qrcodeService->getError());
//        }
//        $this->setResult($this->qrcodeService->_data);
//    }


    /*
     * 查看带关注参数二维码，如果没有就生成二维码
     */
    public function actionQrcodeDetailAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new QrcodeDetailAjaxForm();
        $this->checkForm(["QrcodeDetailAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'operator' => $this->_shopManager['qq'],
        ];
        // 调用逻辑层
        $this->qrcodeService = new WxQrcodeService($this->_wxInfo);
        $this->qrcodeService->getQrcode($serviceParams);

        // 接收逻辑层处理结果
        if (!is_null($this->qrcodeService->getError())) {
            return $this->setError($this->qrcodeService->getError());
        }
        
        $this->setResult($this->qrcodeService->_data);
    }


}