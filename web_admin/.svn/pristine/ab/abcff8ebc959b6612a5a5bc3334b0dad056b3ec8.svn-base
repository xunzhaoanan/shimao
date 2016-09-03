<?php
/**
 * Author: LiuPing
 * Date: 2015/12/31
 * Time: 15:31
 */

namespace admin\controllers;

use common\forms\cashredpack\AddAjaxForm;
use common\forms\cashredpack\EditAjaxForm;
use common\forms\cashredpack\GroupJoinUserListAjaxForm;
use common\forms\cashredpack\ListAjaxForm;
use common\forms\cashredpack\PolicyAddAjaxForm;
use common\forms\cashredpack\PolicyEditAjaxForm;
use common\forms\cashredpack\PolicyListAjaxForm;
use common\forms\cashredpack\SendAjaxForm;
use common\forms\cashredpack\SendListAjaxForm;
use common\forms\GeneralForm;
use common\models\CashRedpack;
use common\services\activity\CashRedpackService;
use Yii;
use yii\base\UserException;
use yii\web\NotFoundHttpException;


class CashRedpackController extends BaseController
{
    protected $cashRedpackModel;
    protected $cashRedpackService;

    function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);
        $this->cashRedpackModel = new CashRedpack();
        $this->cashRedpackService = new CashRedpackService();
    }

    /**
     * 现金红包列表
     */
    public function actionList() {
        return $this->render('list');
    }

    /**
     * ajax 红包列表分页
     */
    public function actionListAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new ListAjaxForm();
        $this->checkForm(["ListAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'platform' => CashRedpack::PLATFORM_WSH  //商户平台
        ];
        $this->getPageInfo($serviceParams);
        $this->cashRedpackModel->find($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

    /**
     * 查看/编辑红包管理
     */
    public function actionEdit() {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cashRedpackModel->get($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $model = $this->cashRedpackModel->_data;
        return $this->render('edit', ['model' => $model]);
    }

    /**
     * 添加红包管理
     */
    public function actionAdd() {
        return $this->render('add', ['shop' => $this->_shop]);
    }

    /**
     * 添加红包管理
     */
    public function actionAddAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new AddAjaxForm();
        $this->checkForm(["AddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'total_num' => 1 //红包发放总人数
        ];
        $serviceParams['can_share'] = CashRedpack::SHARE_YES;
        $this->cashRedpackModel->create($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

    /**
     * 编辑红包活动
     */
    public function actionEditAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new EditAjaxForm();
        $this->checkForm(["EditAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cashRedpackModel->update($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

    /**
     * 删除红包
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
        $this->cashRedpackModel->delete($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

    /**
     * 现金红包说明
     */
    public function actionHelp() {
        return $this->render('help');
    }

    /**
     * 赠送策略
     */
    public function actionPolicyList() {
        return $this->render('policy-list');
    }

    /**
     * 赠送策略ajax
     */
    public function actionPolicyListAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
         // form处理
        $form = new PolicyListAjaxForm();
        $this->checkForm(["PolicyListAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->cashRedpackModel->findCashredpackStrategy($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

    /**
     * 新增赠送策略
     */
    public function actionPolicyAdd() {
        return $this->render('policy-add');
    }

    /**
     * 新增赠送策略ajax
     */
    public function actionPolicyAddAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new PolicyAddAjaxForm();
        $this->checkForm(["PolicyAddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cashRedpackModel->createCashredpackStrategy($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

    /**
     * 编辑赠送策略
     */
    public function actionPolicyEdit() {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cashRedpackModel->getCashredpackStrategy($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $model = $this->cashRedpackModel->_data;
        return $this->render('policy-edit', ['model' => $model]);
    }

    /**
     * ajax编辑赠送策略
     */
    public function actionPolicyEditAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new PolicyEditAjaxForm();
        $this->checkForm(["PolicyEditAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cashRedpackModel->updateCashredpackStrategy($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

    /**
     * 手动派发红包列表
     */
    public function actionSendList() {
        return $this->render('send-list');
    }

    /**
     * 手动派发红包列表
     */
    public function actionSendListAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new SendListAjaxForm();
        $this->checkForm(["SendListAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'source' => CashRedpack::SOURCE_HAND_SEND //手动派发
        ];
        $this->getPageInfo($serviceParams);
        $this->cashRedpackModel->findUserCashredpack($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

    /**
     * 派发红包
     */
    public function actionSend() {
        return $this->render('send');
    }

    /**
     * ajax 手动派发红包
     */
    public function actionSendAjax() {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new SendAjaxForm();
        $this->checkForm(["SendAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cashRedpackService->handSend($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackService->getError())) {
            return $this->setError($this->cashRedpackService->getError());
        }
        $ret = $this->_processSendResult($this->cashRedpackService->_data);
        $this->setResult(['flag' => $ret]);
    }

    /**
     * ajax现金红包 启用
     */
    public function actionOpenAjax(){
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
        $this->cashRedpackModel->open($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

    /**
     * ajax现金红包 禁用
     */
    public function actionCloseAjax(){
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
        $this->cashRedpackModel->close($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

    /**
     * ajax赠送策略 启用
     */
    public function actionOpenStrategyAjax(){
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
        $this->cashRedpackModel->openCashredpackStrategy($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

    /**
     * ajax赠送策略 禁用
     */
    public function actionCloseStrategyAjax(){
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
        $this->cashRedpackModel->closeCashredpackStrategy($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

    /**
     * ajax赠送策略 删除
     */
    public function actionDelStrategyAjax(){
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
        $this->cashRedpackModel->deleteCashredpackStrategy($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

    /**
     * 获取领取用户列表
     */
    public function actionJoinUserListAjax(){
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new SendListAjaxForm();
        $this->checkForm(["SendListAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->cashRedpackService->findUserCashredpack($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackService->getError())) {
            return $this->setError($this->cashRedpackService->getError());
        }
        $this->setResult($this->cashRedpackService->_data);
    }

    /**
     * 更新用户领取状态
     * @return string|void
     */
    public function actionUpdateUserDataStatusAjax(){
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cashRedpackModel->updateCashredpackDateStatus($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
          return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

    /**
     * 重新发送
     */
    public function actionResendAjax(){
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cashRedpackModel->resendCashredpack($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
          return $this->setError($this->cashRedpackModel->getError());
        }
        $ret = $this->_processSendResult($this->cashRedpackModel->_data);
        $this->setResult(['flag' => $ret]);
    }

    /**
     * 处理发送红包结果
     * @param $data
     * @return string|void
     */
    protected function _processSendResult($data){
        if(isset($data['send']) && isset($data['success'])){
            if($data['success'] && $data['send'] == $data['success']){
              $ret = 'ALLSUCCESS';
            }elseif($data['success'] && $data['send'] > $data['success']){
              $ret = 'PARTSUCCESS';
            }else{
              $ret = 'ALLFAIL';
            }
            return $ret;
        }else{
            return $this->setError('发送失败');
        }
    }
    /**
     * 获取群组发放列表
     */
    public function actionGroupJoinUserListAjax(){
        if (!Yii::$app->request->isPost) {
          return $this->setError();
        }
        // form处理
        $form = new GroupJoinUserListAjaxForm();
        $this->checkForm(["GroupJoinUserListAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->cashRedpackModel->findCashredpackGroup($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
          return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

}