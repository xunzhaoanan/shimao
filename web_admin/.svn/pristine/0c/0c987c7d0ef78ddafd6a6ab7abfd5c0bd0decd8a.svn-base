<?php
/**
 * Author: LiuPing
 * Date: 2016/03/02
 * Time: 20:15
 */

namespace admin\controllers;

use common\forms\activity\ListAjaxForm;
use common\forms\GeneralForm;
use common\forms\togetherbuy\AddAjaxForm;
use common\forms\togetherbuy\CloseQueueAjaxForm;
use common\forms\togetherbuy\EditAjaxForm;
use common\forms\togetherbuy\FindJoinListAjaxForm;
use common\forms\togetherbuy\FindQueueListAjaxForm;
use common\forms\togetherbuy\TogetherbuyGoodsAddAjaxForm;
use common\forms\togetherbuy\TogetherbuyGoodsEditAjaxForm;
use common\forms\togetherbuy\TogetherBuyEditForm;
use common\models\NewsPushConfig;
use common\models\TogetherBuy;
use common\services\activity\TogetherBuyService;
use Yii;


class TogetherBuyController extends BaseController
{

    protected $togetherBuyModel;
    protected $togetherBuyService;

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->togetherBuyModel = new TogetherBuy();
        $this->togetherBuyService = new TogetherBuyService();
    }

    /**
     * 拼团活动列表
     */
    public function actionList()
    {
        return $this->render('list');
    }

    /**
     * 添加拼团活动
     * 跳转活动添加统一视图 '/activity/add',并给视图传递添加方法请求地址'addUrl'
     */
    public function actionAdd()
    {
        return $this->render('/activity/add', [
            'title' => '添加拼团活动',
            'addUrl' => '/together-buy/add-ajax',
            'leftMenuLevel' => 'ea',//左侧导航级别
            'news' => NewsPushConfig::$togetherBuy,
            'redirectUrl' => '/together-buy/edit'
        ]);
    }

    /**
     * 查看/编辑活动  详细信息
     */
    public function actionEdit()
    {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->togetherBuyModel->togetherBuyGet($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $model = $this->togetherBuyModel->_data;
        //认证标识转为数组
        if(!empty($model['togetherBuy']['auth_icons'])){
            $model['togetherBuy']['auth_icons'] = explode('|', $model['togetherBuy']['auth_icons']);
        }
        return $this->render('edit', ['model' => $model, 'authIcon' => TogetherBuy::$authIcon]);
    }

    /**
     * 查看/编辑活动  图文信息
     */
    public function actionEditNews()
    {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->togetherBuyService->togetherBuyGet($serviceParams);
        // 接收逻辑层处理结果
        $model = $this->togetherBuyService->_data;
        if (!is_null($this->togetherBuyService->getError()) || empty($model)) {
            return $this->setError($this->togetherBuyService->getError());
        }
        return $this->render('/activity/edit',
            [
                'title' => '编辑拼团活动',
                'model' => $model,
                'leftMenuLevel' => 'ea',
                'editUrl' => '/together-buy/edit-ajax',
                'redirectUrl' => '/together-buy/edit?id=' . $model['activity']['id'],
                'type' => 'togetherBuy'
            ]);
    }

    /**
     * ajax 活动列表分页
     */
    public function actionListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new ListAjaxForm();
        $this->checkForm(["ListAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form, ['_name' => 'name']);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        if(Yii::$app->request->post('deletedFlag')){
            $serviceParams['deletedFlag'] = true;
        }
        $this->getPageInfo($serviceParams);
        $this->togetherBuyModel->togetherBuyFind($serviceParams);
        $model = $this->togetherBuyModel->_data;
        // 接收逻辑层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        //TODO 后续放开 拼团活动关联商品数
        //$this->_deal($model);
        $this->setResult($model);
    }

    /**
     * 拼团活动关联商品个数
     * @param $data
     * @return array
     */
    private function _deal(&$data)
    {
        foreach ($data['data'] as &$val) {
            $val['togetherBuyCount'] = isset($val['togetherBuy']['togetherBuy']) && is_array($val['togetherBuy']['togetherBuy'])
                ? count($val['togetherBuy']['togetherBuy']) : 0;
        }
    }

    /**
     * 添加拼团活动
     */
    public function actionAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理 使用activity下的图文验证的form验证
        $form = new AddAjaxForm();
        $this->checkForm(["AddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);//pr($serviceParams);
        //添加商家id
        $serviceParams['activity'] = [
            'shop_id' => $this->_shop['id']
        ];
        $this->togetherBuyService->togetherBuyCreate($serviceParams);
        // 接收逻辑层处理结果
        $model = $this->togetherBuyService->_data;
        if (!is_null($this->togetherBuyService->getError()) || empty($model)) {
            return $this->setError($this->togetherBuyService->getError());
        }
        $this->setResult([$model, 'id' => $model['activity']['id']]);
    }

    /**
     * 编辑拼团活动
     */
    public function actionEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $post = Yii::$app->request->post();
        if (isset($post['activitytype'])) {
            $post['togetherBuy'] = $post['activitytype'];
        }
        // form处理
        $form = new EditAjaxForm();
        $this->checkForm(["EditAjaxForm" => $post], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams['activity'] += [
            'shop_id' => $this->_shop['id']
        ];
        $this->togetherBuyService->togetherBuyUpdate($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->togetherBuyService->getError())) {
            return $this->setError($this->togetherBuyService->getError());
        }
        $model = $this->togetherBuyService->_data;
        $this->setResult([$model, 'id' => $model['activity']['id']]);
    }

    /**
     * 拼团活动团列表
     *
     */
    public function actionTuxedoDetail()
    {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $param = $this->handleForm($form);
        $param += [
            'shop_id' => $this->_shop['id']
        ];
        $this->togetherBuyModel->togetherBuyGet($param);
        // 接收逻辑层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        return $this->render('tuxedo-detail', ['model' => $this->togetherBuyModel->_data]);
    }

    /**
     * 获取拼团列表
     */
    public function actionFindQueueListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new FindQueueListAjaxForm();
        $this->checkForm(["FindQueueListAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->togetherBuyService->togetherBuyQueueFind($serviceParams);
        $model = $this->togetherBuyService->_data;
        // 接收逻辑层处理结果
        if (!is_null($this->togetherBuyService->getError())) {
            return $this->setError($this->togetherBuyService->getError());
        }
        $this->setResult($model);
    }

    /**
     * 团详情
     */
    public function actionDetail()
    {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->togetherBuyModel->togetherBuyQueueGet($serviceParams);
        // 接收逻辑层处理结果
        $model = $this->togetherBuyModel->_data;
        if (!is_null($this->togetherBuyModel->getError()) || empty($model)) {
            return $this->setError($this->togetherBuyModel->getError());
        }

        return $this->render('detail', ['model' => $model]);
    }

    /**
     * 获取团内成员列表
     */
    public function actionFindJoinByQueueAjax(){
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new FindJoinListAjaxForm();
        $this->checkForm(["FindJoinListAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->togetherBuyService->togetherBuyJoinByQueue($serviceParams);
        $model = $this->togetherBuyService->_data;
        // 接收逻辑层处理结果
        if (!is_null($this->togetherBuyService->getError())) {
            return $this->setError($this->togetherBuyService->getError());
        }
        $this->setResult($model);
    }

    /**
     * 开启拼团活动
     */
    public function actionOpenAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->togetherBuyModel->togetherBuyOpen($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $this->setResult($this->togetherBuyModel->_data);
    }

    /**
     * 关闭拼团活动
     */
    public function actionCloseAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->togetherBuyModel->togetherBuyClose($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $this->setResult($this->togetherBuyModel->_data);
    }

    /**
     * 删除拼团活动
     */
    public function actionDelAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->togetherBuyModel->togetherBuyDel($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $this->setResult($this->togetherBuyModel->_data);
    }

    /**
     * 添加拼团活动商品
     */
    public function actionTogetherBuyGoodsAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new TogetherbuyGoodsAddAjaxForm();
        $this->checkForm(["TogetherbuyGoodsAddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->togetherBuyModel->togetherBuyGoodsCreate($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $this->setResult($this->togetherBuyModel->_data);
    }

    /**
     * 修改关联商品
     */
    public function actionTogetherBuyGoodsUpdateAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new TogetherbuyGoodsEditAjaxForm();
        $this->checkForm(["TogetherbuyGoodsEditAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->togetherBuyModel->togetherBuyGoodsUpdate($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $this->setResult($this->togetherBuyModel->_data);
    }

    /**
     * 去除关联商品
     */
    public function actionTogetherBuyGoodsDelAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->togetherBuyModel->togetherBuyGoodsDel($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $this->setResult($this->togetherBuyModel->_data);
    }

    /**
     * 获取拼团活动商品列表
     */
    public function actionTogetherBuyGoodsListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form, ['id' => 'together_buy_id']);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];

        $this->getPageInfo($serviceParams);
        $this->togetherBuyModel->togetherBuyGoodsFind($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $this->setResult($this->togetherBuyModel->_data);
    }

    /**
     * 管理员关闭团
     */
    public function actionCloseQueueAjax(){
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new CloseQueueAjaxForm();
        $this->checkForm(["CloseQueueAjaxForm" => Yii::$app->request->post()], $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id'],
            'staff_id' => $this->_shopStaff['id']
        ];
        $this->togetherBuyModel->closeQueue($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $this->setResult($this->togetherBuyModel->_data);
    }

    /**
     * 管理员注水成团
     */
    public function actionHelpSuccessQueueAjax()
    {
        @set_time_limit(0);
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id'],
            'staff_id' => $this->_shopStaff['id']
        ];
        $this->togetherBuyModel->helpSuccessQueue($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $this->setResult($this->togetherBuyModel->_data);
    }

    /**
     * 拼团帮助文档
     */
    public function actionVoucher()
    {
        return $this->render('voucher');
    }

}