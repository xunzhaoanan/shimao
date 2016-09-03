<?php
/**
 * Author: Kevin
 * Date: 2015/06/30
 * Time: 11:00
 */

namespace admin\controllers;

use common\forms\activity\ListAjaxForm;
use common\forms\reserve\AddAjaxForm;
use common\forms\reserve\EditAjaxForm;
use common\forms\reserve\EditReserveUserDataAjaxForm;
use common\forms\reserve\GetUserDataAjaxForm;
use common\models\Activity;
use common\models\NewsPushConfig;
use common\models\Reserve;
use common\models\Terminal;
use common\services\activity\ReserveService;
use Yii;
use yii\base\UserException;
use yii\web\NotFoundHttpException;
use common\forms\GeneralForm;

class ReserveController extends BaseController
{

    protected $reserveService;

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->reserveService = new ReserveService();
    }

    /**
     * 活动列表
     */
    public function actionList()
    {
        return $this->render('list', ['account' => $this->_wxInfo['account']]);
    }

    /**
     * 查看/编辑 活动
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
        $this->reserveService->get($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->reserveService->getError())) {
            return $this->setError($this->reserveService->getError());
        }
        $model = $this->reserveService->_data;
        $shopList = $this->_findShopList();
        return $this->render('edit', ['model' => $model, 'itemDefault' => Reserve::getDefault($shopList)]);
    }

    /**
     * 添加活动
     * itemDefault: 预约项默认设置
     */
    public function actionAdd()
    {
        $shopList = $this->_findShopList();
        return $this->render('add', ['itemDefault' => Reserve::getDefault($shopList), 'news' => NewsPushConfig::$reserve]);
    }

    /**
     * 获取商家门店 组合成 name1|name2|name3的形式
     * @return string|void
     */
    private function _findShopList()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'count' => 100
        ];
        $this->getPageInfo($serviceParams);
        // 把商家店铺都拿出来
        $terminalModel = new Terminal();
        $terminalModel->find($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($terminalModel->getError())) {
            return $this->setError($terminalModel->getError());
        }
        $shopNames = '';
        foreach ($terminalModel->_data['data'] as $val) {
            if(isset($val['shopInfo']['name'])){
                $shopNames .= $val['shopInfo']['name'] . '|';
            }
        }
        return trim($shopNames, '|');
    }

    /**
     * ajax 添加活动
     */
    public function actionAddAjax()
    {
        // form处理
        $form = new AddAjaxForm();
        $this->checkForm(["AddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams['reserveSetting'] += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->reserveService->create($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->reserveService->getError())) {
            return $this->setError($this->reserveService->getError());
        }
        $this->setResult($this->reserveService->_data);
    }

    /**
     * ajax 编辑活动
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
        $serviceParams['reserveSetting'] += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->reserveService->update($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->reserveService->getError())) {
            return $this->setError($this->reserveService->getError());
        }
        $this->setResult($this->reserveService->_data);
    }

    /**
     * ajax 活动列表分页
     */
    public function actionListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new ListAjaxForm();
        $this->checkForm(["ListAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form, ['_name' => 'title']);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'share_type' => Yii::$app->request->post('is_display') == true ? Activity::SHARE_TYPE_NORMAL : null //是否显示惊喜列表里
        ];
        $this->getPageInfo($serviceParams);
        $this->reserveService->find($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->reserveService->getError())) {
            return $this->setError($this->reserveService->getError());
        }
        $this->setResult($this->reserveService->_data);
    }

    /**
     * 开启预约活动
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
        $this->reserveService->open($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->reserveService->getError())) {
            return $this->setError($this->reserveService->getError());
        }
        $this->setResult($this->reserveService->_data);
    }

    /**
     * 关闭预约活动
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
        $this->reserveService->close($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->reserveService->getError())) {
            return $this->setError($this->reserveService->getError());
        }
        $this->setResult($this->reserveService->_data);
    }

    /**
     * 删除预约活动
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
        $this->reserveService->delete($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->reserveService->getError())) {
            return $this->setError($this->reserveService->getError());
        }
        $this->setResult($this->reserveService->_data);
    }

    /**
     * 预约用户列表
     * @return string
     */
    public function actionJoinUser()
    {
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->reserveService->get($serviceParams);
        $model = $this->reserveService->_data;
        // 接收逻辑层处理结果
        if (is_null($model)) {
            return $this->setError($this->reserveService->getError());
        }
        return $this->render('join-user', ['model' => $model]);
    }

    /**
     * ajax 预约用户列表
     */
    public function actionJoinUserAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'reserve_setting_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->reserveService->findJoinUser($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->reserveService->getError())) {
            return $this->setError($this->reserveService->getError());
        }
        $userData['data'] = $this->_formatData($this->reserveService->_data['data']);
        $userData['page'] = $this->reserveService->_data['page'];
        $this->setResult($userData);
    }

    private function _formatData($model)
    {
        $setting = empty($model[0]['reserveSetting']) ? [] : json_decode($model[0]['reserveSetting']['items'], true);
        if (!$setting) {
            return [];
        }
        $data = $userData = [];
        foreach ($setting as $key => $val) {
            if($val['check'] == 'true'){
                $data[$key]['name'] = $val['key'];
                $data[$key]['type'] = $val['type'];
                $data[$key]['nametag'] = $val['nametag'];
            }
        }
        foreach ($model as $key => $val) {
            $val['user_data'] = json_decode($val['user_data'], true);
            $i = 0;
            foreach($data as $k => $v){
                $userData[$key][$i]['id'] = $val['id'];
                $userData[$key][$i]['nickname'] = isset($val['userInfo']['nickname']) ? $val['userInfo']['nickname'] : '';
                $userData[$key][$i]['name'] = $val['user_data'][$v['nametag']];
                $userData[$key][$i]['type'] = $v['type'];
                $userData[$key][$i]['status'] = $val['status'];
                $i++;
            }
        }
        return ['head' => $data, 'data' => $userData];
    }

    /**
     * 通过预约
     */
    public function actionPassAjax()
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
        $this->reserveService->passUserData($serviceParams);
        // 接收逻辑层处理结果
        if (is_null($this->reserveService->_data)) {
            $msg = is_null($this->reserveService->getError()) ? '非法操作' : $this->reserveService->getError();
            return $this->setError($msg);
        }
        $this->setResult($this->reserveService->_data);
    }

    /**
     * 拒绝预约
     */
    public function actionRejectAjax()
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
        $this->reserveService->rejectUserData($serviceParams);
        // 接收逻辑层处理结果
        if (is_null($this->reserveService->_data)) {
            $msg = is_null($this->reserveService->getError()) ? '非法操作' : $this->reserveService->getError();
            return $this->setError($msg);
        }
        $this->setResult($this->reserveService->_data);
    }

    /**
     * 编辑预约数据
     */
    public function actionEditUserData()
    {
        if (!Yii::$app->request->isGet) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->isGet()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->reserveService->rejectUserData($serviceParams);
        // 接收逻辑层处理结果
        if (is_null($this->reserveService->_data)) {
            $msg = is_null($this->reserveService->getError()) ? '非法操作' : $this->reserveService->getError();
            return $this->setError($msg);
        }
        $this->setResult($this->reserveService->_data);
    }

    /**
     * ajax 编辑预约信息
     */
    public function actionEditUserDataAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new EditReserveUserDataAjaxForm();
        $this->checkForm(["EditReserveUserDataAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $serviceParams['user_data'] = json_encode($serviceParams['user_data']);
        $this->reserveService->updateUserData($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->reserveService->getError())) {
            return $this->setError($this->reserveService->getError());
        }
        $this->setResult($this->reserveService->_data);
    }

    /**
     * 获取预约用户填写信息
     */
    public function actionGetUserData()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GetUserDataAjaxForm();
        $this->checkForm(["GetUserDataAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->reserveService->getUserData($serviceParams);
        // 接收逻辑层处理结果
        if (is_null($this->reserveService->_data)) {
            return $this->setError($this->reserveService->getError());
        }
        $this->setResult($this->reserveService->_data);
    }
}