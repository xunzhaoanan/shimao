<?php
/**
 * Author: Kevin
 * Date: 2015/06/30
 * Time: 11:00
 */

namespace admin\controllers;

use common\forms\activity\ListAjaxForm;
use common\forms\collect\AddCustomGiftAjaxForm;
use common\forms\collect\EditCustomGiftAjaxForm;
use common\forms\collect\ExchangeAjaxForm;
use common\forms\collect\GetForm;
use common\models\Activity;
use common\models\Collect;
use common\models\NewsPushConfig;
use common\services\activity\CollectService;
use Yii;
use yii\base\UserException;
use yii\web\NotFoundHttpException;
use common\forms\GeneralForm;
use common\forms\collect\AddAjaxForm;
use common\forms\collect\AddProductAjaxForm;
use common\forms\collect\EditAjaxForm;
use common\forms\collect\EditProductAjaxForm;

class CollectZanController extends BaseController
{
    protected $collectService;

    function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);
        $this->collectService = new CollectService();
    }

    /**
     * 活动列表
     */
    public function actionList() {
        return $this->render('list');
    }

    /**
     * 活动列表
     */
    public function actionListAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new ListAjaxForm();
        $this->checkForm(["ListAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form, ['_name' => 'name']);
        $serviceParams += [
            'type' => Collect::COLLECT_ZAN,
            'shop_id' => $this->_shop['id'],
            'share_type' => Yii::$app->request->post('is_display') == true ? Activity::SHARE_TYPE_NORMAL : null //是否显示惊喜列表里
        ];
        $this->getPageInfo($serviceParams);
        $this->collectService->find($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->collectService->getError())) {
            return $this->setError($this->collectService->getError());
        }
        $this->setResult($this->collectService->_data);
    }

    /**
     * 添加活动
     */
    public function actionAdd() {
        return $this->render('/activity/add',
            [
                'title' => '添加点赞活动',
                'addUrl' => '/collect-zan/add-ajax',
                'redirectUrl' => '/collect-zan/edit',
                'leftMenuLevel' => 'eb', //左侧导航级别
                'news' => NewsPushConfig::$collectZan
            ]);
    }

    /**
     * ajax 添加活动
     */
    public function actionAddAjax() {
        // form处理
        $form = new AddAjaxForm();
        $this->checkForm(["AddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams['collect'] = [
            'shop_id' => $this->_shop['id'],

        ];
        // 调用逻辑层 创建众筹活动 传递参数 众筹类型
        $this->collectService->create($serviceParams, Collect::COLLECT_ZAN);//众筹代领类型
        // 接收逻辑层处理结果
        $model = $this->collectService->_data;
        if (!is_null($this->collectService->getError()) || empty($model)) {
            return $this->setError($this->collectService->getError());
        }
        $this->setResult([$model, 'id' => $model['collect']['id']]);
    }

    /**
     * 查看/编辑 活动
     */
    public function actionEdit() {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'type' => Collect::COLLECT_ZAN, //众筹代领类型
            'shop_id' => $this->_shop['id']
        ];
        $this->collectService->get($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->collectService->getError())) {
            return $this->setError($this->collectService->getError());
        }
        $model = $this->collectService->_data;
        return $this->render('edit', ['model' => $model]);
    }

    /**
     * 查看/编辑活动  图文信息
     */
    public function actionEditNews() {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'type' => Collect::COLLECT_ZAN, //众筹代领类型
            'shop_id' => $this->_shop['id']
        ];
        $this->collectService->get($serviceParams);
        // 接收逻辑层处理结果
        $model = $this->collectService->_data;
        if (!is_null($this->collectService->getError()) || empty($model)) {
            return $this->setError($this->collectService->getError());
        }
        return $this->render('/activity/edit',
            [
                'title' => '编辑点赞众筹活动',
                'model' => $model,
                'leftMenuLevel' => 'eb', //左侧导航级别
                'editUrl' => '/collect-zan/edit-ajax',
                'redirectUrl' => '/collect-zan/edit?id=' . $model['collect']['id'],
                'type' => 'collect' //方便组合数据提交格式
            ]
        );
    }

    /**
     * 更新众筹代领活动
     */
    public function actionEditAjax() {

        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $post = Yii::$app->request->post();
        if (isset($post['activitytype'])) {
            $post['collect'] = $post['activitytype'];
        }
        // form处理
        $form = new EditAjaxForm();
        $this->checkForm(["EditAjaxForm" => $post], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams['collect'] += [
            'type' => Collect::COLLECT_ZAN, //众筹代领类型
            'shop_id' => $this->_shop['id'],

        ];

        // 调用逻辑层 创建众筹活动 传递参数 众筹类型
        $this->collectService->update($serviceParams, Collect::COLLECT_ZAN);//众筹代领类型
        // 接收逻辑层处理结果
        $model = $this->collectService->_data;
        if (!is_null($this->collectService->getError()) || empty($model)) {
            return $this->setError($this->collectService->getError());
        }
        $this->setResult([$model, 'id' => $model['collect']['id']]);
    }

    /**
     * 新增众筹商品
     */
    public function actionAddCollectProductAjax() {
        // form处理
        $form = new AddProductAjaxForm();
        $this->checkForm(["AddProductAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        // 调用逻辑层 创建众筹活动 传递参数 众筹类型
        $this->collectService->createCollectProduct($serviceParams);//众筹代领类型
        // 接收逻辑层处理结果
        $model = $this->collectService->_data;
        if (!is_null($this->collectService->getError()) || empty($model)) {
            return $this->setError($this->collectService->getError());
        }
        $this->setResult($model);
    }

    /**
     * 获取商品列表
     */
    public function actionFindCollectProductAjax() {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);

        // 调用逻辑层
        $this->collectService->findCollectProduct($serviceParams);//众筹代领类型
        // 接收逻辑层处理结果
        if (!is_null($this->collectService->_data)) {
            return $this->setError($this->collectService->getError());
        }
        $this->setResult($this->collectService->_data);
    }

    /**
     * 获取商品列表
     */
    public function actionFindCustomGiftAjax() {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);

        // 调用逻辑层
        $this->collectService->findCustomGift($serviceParams);//众筹代领类型
        // 接收逻辑层处理结果
        if (!is_null($this->collectService->_data)) {
            return $this->setError($this->collectService->getError());
        }
        $this->setResult($this->collectService->_data);
    }

    /**
     * 添加自定义商品
     */
    public function actionAddCustomGiftAjax() {
        // form处理
        $form = new AddCustomGiftAjaxForm();
        $this->checkForm(["AddCustomGiftAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];

        // 调用逻辑层 创建众筹活动 传递参数 众筹类型
        $this->collectService->createCustomGift($serviceParams);//众筹代领类型
        // 接收逻辑层处理结果
        $model = $this->collectService->_data;
        if (!is_null($this->collectService->getError()) || empty($model)) {
            return $this->setError($this->collectService->getError());
        }
        $this->setResult($model);
    }

    /**
     * 修改众筹商品
     */
    public function actionEditCollectProductAjax() {
        // form处理
        $form = new EditProductAjaxForm();
        $this->checkForm(["EditProductAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];

        // 调用逻辑层 创建众筹活动 传递参数 众筹类型
        $this->collectService->updateCollectProduct($serviceParams);//众筹代领类型
        // 接收逻辑层处理结果
        $model = $this->collectService->_data;
        if (!is_null($this->collectService->getError()) || empty($model)) {
            return $this->setError($this->collectService->getError());
        }
        $this->setResult($model);
    }

    /**
     * 修改众筹自定义商品
     */
    public function actionEditCustomGiftAjax() {
        // form处理
        $form = new EditCustomGiftAjaxForm();
        $this->checkForm(["EditCustomGiftAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层 创建众筹活动 传递参数 众筹类型
        $this->collectService->updateCustomGift($serviceParams);//众筹代领类型
        // 接收逻辑层处理结果
        $model = $this->collectService->_data;
        if (!is_null($this->collectService->getError()) || empty($model)) {
            return $this->setError($this->collectService->getError());
        }
        $this->setResult($model);
    }


    /**
     * 开启活动
     */
    public function actionOpenAjax() {
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
        $this->collectService->open($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->collectService->getError())) {
            return $this->setError($this->collectService->getError());
        }
        $this->setResult($this->collectService->_data);
    }

    /**
     * 关闭活动
     */
    public function actionCloseAjax() {
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
        $this->collectService->close($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->collectService->getError())) {
            return $this->setError($this->secondKillService->getError());
        }
        $this->setResult($this->collectService->_data);
    }

    /**
     * 删除活动
     */
    public function actionDelAjax() {
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
        $this->collectService->delete($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->collectService->getError())) {
            return $this->setError($this->collectService->getError());
        }
        $this->setResult($this->collectService->_data);
    }

    /**
     * 去除关联商品
     */
    public function actionCollectProductDelAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GetForm();
        $this->checkForm(["GetForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->collectService->delCollectProduct($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->collectService->getError())) {
            return $this->setError($this->collectService->getError());
        }
        $this->setResult($this->collectService->_data);
    }


    /**
     * 去除自定义商品
     */
    public function actionCustomGiftDelAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GetForm();
        $this->checkForm(["GetForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->collectService->delCustomGift($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->collectService->getError())) {
            return $this->setError($this->collectService->getError());
        }
        $this->setResult($this->collectService->_data);
    }

    /**
     * 参与名单
     */
    public function actionJoinUser() {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'type' => Collect::COLLECT_ZAN, //众筹代领类型
            'shop_id' => $this->_shop['id']
        ];
        $this->collectService->get($serviceParams);
        // 接收逻辑层处理结果
        $model = $this->collectService->_data;
        if (!is_null($this->collectService->getError()) || empty($model)) {
            return $this->setError($this->collectService->getError());
        }
        return $this->render('join-user', ['id' => $model['collect']['id']]);
    }

    /**
     * ajax 参与人员
     */
    public function actionJoinUserAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form, ['id' => 'collect_id']);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'nickname' => Yii::$app->request->post('nickname')
        ];
        $this->getPageInfo($serviceParams);
        $this->collectService->findJoinUser($serviceParams);
        // 接收逻辑层处理结果
        $model = $this->collectService->_data;
        if (!is_null($this->collectService->getError())) {
            return $this->setError($this->collectService->getError());
        }
        $this->setResult($model);
    }

    /**
     * ajax 手动兑换 众筹公用
     * 参数 id
     * collect_id
     */
    public function actionExchangeAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new ExchangeAjaxForm();
        $this->checkForm(["ExchangeAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'staff_id' => $this->_shopStaff['id'],
            'shop_id' => $this->_shop['id'],

        ];
        $this->collectService->exchangeJoin($serviceParams);
        // 接收逻辑层处理结果
        $model = $this->collectService->_data;
        if (!is_null($this->collectService->getError())) {
            return $this->setError($this->collectService->getError());
        }
        $this->setResult($model);
    }
}