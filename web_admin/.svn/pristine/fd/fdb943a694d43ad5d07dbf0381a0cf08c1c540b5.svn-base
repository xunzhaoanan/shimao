<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 13:50
 */


namespace admin\controllers;

use common\forms\activity\ListAjaxForm;
use common\forms\GeneralForm;
use common\forms\signin\AddAjaxForm;
use common\forms\signin\EditAjaxForm;
use common\forms\signin\JoinListAjaxForm;
use common\models\SigninSetting;
use Yii;


class SigninSettingController extends BaseController
{

    protected $signinModel;

    function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);
        $this->signinModel = new SigninSetting();
    }

    /**
     * 签到活动列表
     */
    public function actionList() {
        return $this->render('list', ['url' => urlencode(getMobileSite() . '/signin/signin-success?id=')]);
    }

    /**
     * 添加签到活动
     */
    public function actionAdd() {
        return $this->render('add');
    }

    /**
     * 查看/编辑活动  详细信息
     */
    public function actionEdit() {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->signinModel->get($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->signinModel->getError())) {
            return $this->setError($this->signinModel->getError());
        }
        $model = $this->signinModel->_data;
        return $this->render('edit', ['model' => $model]);
    }

    /**
     * ajax 活动列表分页
     */
    public function actionListAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new ListAjaxForm();
        $this->checkForm(["ListAjaxForm" => Yii::$app->request->post()], $form);
        $modelParams = $this->handleForm($form, ['_name' => 'name']);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($modelParams);
        $this->signinModel->find($modelParams);
        $model = $this->signinModel->_data;
        // 接收逻辑层处理结果
        if (!is_null($this->signinModel->getError())) {
            return $this->setError($this->signinModel->getError());
        }
        $this->setResult($model);
    }

    /**
     * 添加签到活动
     */
    public function actionAddAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new AddAjaxForm();
        $this->checkForm(["AddAjaxForm" => Yii::$app->request->post()], $form);
        $modelParams = $this->handleForm($form);
        //添加商家id
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->signinModel->create($modelParams);
        // 接收逻辑层处理结果
        $model = $this->signinModel->_data;
        if (!is_null($this->signinModel->getError()) || empty($model)) {
            return $this->setError($this->signinModel->getError());
        }
        $this->setResult($model);
    }

    /**
     * 编辑签到活动
     */
    public function actionEditAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new EditAjaxForm();
        $this->checkForm(["EditAjaxForm" => Yii::$app->request->post()], $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->signinModel->update($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->signinModel->getError())) {
            return $this->setError($this->signinModel->getError());
        }
        $model = $this->signinModel->_data;
        $this->setResult($model);
    }

    /**
     * 开启签到活动
     */
    public function actionOpenAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->signinModel->open($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->signinModel->getError())) {
            return $this->setError($this->signinModel->getError());
        }
        $this->setResult($this->signinModel->_data);
    }

    /**
     * 关闭签到活动
     */
    public function actionCloseAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->signinModel->close($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->signinModel->getError())) {
            return $this->setError($this->signinModel->getError());
        }
        $this->setResult($this->signinModel->_data);
    }

    /**
     * 删除签到活动
     */
    public function actionDelAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->signinModel->delete($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->signinModel->getError())) {
            return $this->setError($this->signinModel->getError());
        }
        $this->setResult($this->signinModel->_data);
    }

    /**
     * 签到人员列表
     * @return string
     */
    public function actionSigninJoin() {
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $modelParams = $this->handleForm($form);
        //统计签到人数
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];

        $this->signinModel->countJoinUser($modelParams);
        return $this->render('signin-join', ['countJoin' => $this->signinModel->_data]);
    }

    /**
     * 获取签到用户列表
     */
    public function actionSigninJoinListAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new JoinListAjaxForm();
        $this->checkForm(["JoinListAjaxForm" => Yii::$app->request->post()], $form);
        $modelParams = $this->handleForm($form, ['id' => 'signin_setting_id']);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($modelParams);
        $this->signinModel->findJoinUser($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->signinModel->getError())) {
            return $this->setError($this->signinModel->getError());
        }
        $this->setResult($this->signinModel->_data);
    }
}