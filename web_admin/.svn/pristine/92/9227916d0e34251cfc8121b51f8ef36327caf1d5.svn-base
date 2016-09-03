<?php
/**
 * Author: LiuPing
 * Date: 2015/07/1
 * Time: 11:00
 */

namespace admin\controllers;

use common\forms\activitypoint\AddAjaxForm;
use common\forms\activitypoint\EditAjaxForm;
use common\forms\activitypoint\PointGoodsAddAjaxForm;
use common\forms\GeneralForm;
use common\forms\point\PointGoodsUpdateAjaxForm;
use common\services\activity\ActivityPointService;
use Yii;

class ActivityPointsController extends BaseController
{

    protected $pointService;

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->pointService = new ActivityPointService();
    }

    /**
     * 积分活动列表
     */
    public function actionList()
    {
        return $this->render('list');
    }

    /**
     * 添加积分活动
     */
    public function actionAdd()
    {
        return $this->render('add');
    }

    /**
     * 查看/编辑活动
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
        $this->pointService->pointGet($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->pointService->getError())) {
            return $this->setError($this->pointService->getError());
        }
        $model = $this->pointService->_data;
        return $this->render('edit', ['model' => $model]);
    }

    /**
     * ajax 活动列表分页
     */
    public function actionListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $serviceParams = [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->pointService->pointFind($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->pointService->getError())) {
            return $this->setError($this->pointService->getError());
        }
        $this->setResult($this->pointService->_data);
    }

    /**
     * 添加积分活动
     */
    public function actionAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new AddAjaxForm();
        $this->checkForm(["AddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams['activity'] += [
            'shop_id' => $this->_shop['id']
        ];
        $this->pointService->pointCreate($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->pointService->getError())) {
            return $this->setError($this->pointService->getError());
        }
        $this->setResult($this->pointService->_data);
    }

    /**
     * 编辑积分活动
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
        $serviceParams['activity'] += [
            'shop_id' => $this->_shop['id']
        ];
        $this->pointService->pointUpdate($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->pointService->getError())) {
            return $this->setError($this->pointService->getError());
        }
        $this->setResult($this->pointService->_data);
    }

    /**
     * 开启积分活动
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
        $this->pointService->pointOpen($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->pointService->getError())) {
            return $this->setError($this->pointService->getError());
        }
        $this->setResult($this->pointService->_data);
    }

    /**
     * 关闭积分活动
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
        $this->pointService->pointClose($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->pointService->getError())) {
            return $this->setError($this->pointService->getError());
        }
        $this->setResult($this->pointService->_data);
    }

    /**
     * 删除积分活动
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
        $this->pointService->pointDel($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->pointService->getError())) {
            return $this->setError($this->pointService->getError());
        }
        $this->setResult($this->pointService->_data);
    }

    /**
     * 添加积分商品
     */
    public function actionPointGoodsAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new PointGoodsAddAjaxForm();
        $this->checkForm(["PointGoodsAddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->pointService->pointGoodsCreate($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->pointService->getError())) {
            return $this->setError($this->pointService->getError());
        }
        $this->setResult($this->pointService->_data);
    }

    /**
     * 去除关联商品
     */
    public function actionPointGoodsDelAjax()
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
        $this->pointService->pointGoodsDel($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->pointService->getError())) {
            return $this->setError($this->pointService->getError());
        }
        $this->setResult($this->pointService->_data);
    }

    /**
     * 获取积分商品列表
     */
    public function actionPointGoodsListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];

        $this->getPageInfo($serviceParams);
        $this->pointService->pointGoodsFind($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->pointService->getError())) {
            return $this->setError($this->pointService->getError());
        }
        $this->setResult($this->pointService->_data);
    }
}