<?php
/**
 * Author: Liuping
 * Date: 2015/7/6
 * Time: 14:05
 */

namespace admin\controllers;

use common\forms\activity\ListAjaxForm;
use common\forms\GeneralForm;
use common\forms\marketactivity\AddAjaxForm;
use common\forms\marketactivity\EditAjaxForm;
use common\forms\marketactivity\ExchangeRecordAjaxForm;
use common\forms\marketactivity\ListRecodeAjaxForm;
use common\models\Activity;
use common\models\CardCoupon;
use common\models\CashRedpack;
use common\models\MarketActivity;
use common\models\RedpackManage;
use common\models\RuleConfig;
use common\services\activity\MarketActivityService;
use common\services\activity\RedpackManageService;
use Yii;


class MarketActivityController extends BaseController
{

    protected $marketActivityService;

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->marketActivityService = new MarketActivityService();
    }

    /**
     * 添加活动
     */
    public function actionAdd()
    {
        $data = $this->_add();
        return $this->render('add', array_merge($data, [
            'rule' => RuleConfig::$turnplateActivity,
            'template' => MarketActivity::TYPE_ACTIVITY_TURNPLATE
        ]));
    }

    /**
     * 添加砸金蛋活动
     */
    public function actionSmasheggAdd()
    {
        $data = $this->_add();
        return $this->render('add', array_merge($data, [
            'rule' => RuleConfig::$smashEggActivity,
            'template' => MarketActivity::TYPE_ACTIVITY_SMASH_EGG
        ]));
    }

    /**
     * 添加活动默认数据
     * @return array
     */
    private function _add(){
        return [
            'templateOption' => MarketActivity::$template,
            'prizeType' => MarketActivity::$prizeType,
            'prizeValue' => $this->_getPrize(), //可用的优惠券和红包
            'prizeDefaultImg' => MarketActivity::$prizeDefaultImg, //奖品默认图片
            'shareNews' => MarketActivity::setDefault()
        ];
    }

    /**
     * ajax 添加活动
     */
    public function actionAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }

        $form = new AddAjaxForm();
        $this->checkForm(["AddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->marketActivityService->create($serviceParams);
        if (!is_null($this->marketActivityService->getError())) {
            return $this->setError($this->marketActivityService->getError());
        }
        $this->setResult($this->marketActivityService->_data);
    }

    /**
     * 大转盘活动列表
     */
    public function actionList()
    {
        return $this->render('list', ['template' => MarketActivity::$template]);
    }

    /**
     * 砸金蛋活动列表
     */
    public function actionSmasheggList()
    {
        return $this->render('smashegg-list', ['template' => MarketActivity::$template]);
    }

    /**
     * ajax活动列表
     */
    public function actionListAjax()
    {
        $this->listAjax(MarketActivity::TYPE_ACTIVITY_TURNPLATE);
    }

    /**
     * ajax砸金蛋活动列表
     */
    public function actionSmasheggListAjax()
    {
        $this->listAjax(MarketActivity::TYPE_ACTIVITY_SMASH_EGG);
    }

    /**
     * 公用方法 方便权限控制 【活动列表】
     * @param $template
     */
    protected function listAjax($template){
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new ListAjaxForm();
        $this->checkForm(["ListAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form, ['_name' => 'activity_name']);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'template' => $template,
            'share_type' => Yii::$app->request->post('is_display') == true ? Activity::SHARE_TYPE_NORMAL : null //是否显示惊喜列表里
        ];
        $this->getPageInfo($serviceParams);
        $this->marketActivityService->find($serviceParams);
        if (!is_null($this->marketActivityService->getError())) {
            return $this->setError($this->marketActivityService->getError());
        }
        $this->setResult($this->marketActivityService->_data);
    }

    /**
     * 修改大转盘活动
     */
    public function actionEdit()
    {
        $model = $this->edit();
        return $this->render('edit', $model);
    }

    /**
     * 修改砸金蛋活动
     */
    public function actionSmasheggEdit()
    {
        $model = $this->edit();
        return $this->render('edit', $model);
    }

    /**
     * 公用方法 方便权限控制 【修改活动】
     * @return string|void
     */
    protected function edit(){
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->marketActivityService->get($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->marketActivityService->getError())) {
            return $this->setError($this->marketActivityService->getError());
        }
        $model = $this->marketActivityService->_data;
        return  [
            'model' => $model,
            'template' => MarketActivity::$template,
            'prizeType' => MarketActivity::$prizeType,
            'prizeValue' => $this->_getPrize(),
            'prizeDefaultImg' => MarketActivity::$prizeDefaultImg, //奖品默认图片
            'shareNews' => MarketActivity::setDefault()
        ];
    }

    /**
     * ajax 修改活动
     */
    public function actionEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new EditAjaxForm();
        $this->checkForm(["EditAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        $this->marketActivityService->update($serviceParams);
        if (!is_null($this->marketActivityService->getError())) {
            return $this->setError($this->marketActivityService->getError());
        }
        $this->setResult($this->marketActivityService->_data);
    }

    /**
     * 大转盘中奖记录页面
     */
    public function actionWinnerRecord()
    {
        $model = $this->winnerRecordList();
        return $this->render('winner-record', $model);
    }

    /**
     * 砸金蛋中奖记录页面
     */
    public function actionSmasheggWinnerRecord()
    {
        $model = $this->winnerRecordList();
        return $this->render('smashegg-winner-record', $model);
    }

    /**
     * 公用方法 方便权限控制 【中奖记录页面】
     * @return string|void
     */
    protected function winnerRecordList(){
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->marketActivityService->get($serviceParams);
        if (!is_null($this->marketActivityService->getError())) {
            return $this->setError($this->marketActivityService->getError());
        }
        return ['model' => $this->marketActivityService->_data];
    }

    /**
     * ajax 获取中奖记录
     * 参数
     * [id,activity_id]
     */
    public function actionRecordListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new ListRecodeAjaxForm();
        $this->checkForm(["ListRecodeAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form, ['id' => 'activity_id']);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'doFilter' => ['level' => MarketActivity::LEVER_ZERO]
        ];

        $this->getPageInfo($serviceParams);
        $this->marketActivityService->findRecord($serviceParams);
        if (!is_null($this->marketActivityService->getError())) {
            return $this->setError($this->marketActivityService->getError());
        }
        $this->setResult($this->marketActivityService->_data);
    }

    /**
     * 大转盘 兑换中奖
     */
    public function actionExchangeRecordAjax(){
        $this->exchangeRecordAjax();
    }

    /**
     * 砸金蛋 兑换中奖
     */
    public function actionSmasheggExchangeRecordAjax(){
        $this->exchangeRecordAjax();
    }

    /**
     * 公用方法 方便权限控制 【兑换中奖】
     */
    protected function exchangeRecordAjax(){
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new ExchangeRecordAjaxForm();
        $this->checkForm(["ExchangeRecordAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'staff_id' => $this->_shopStaff['id'],
            'shop_id' => $this->_shop['id'],

        ];
        $this->marketActivityService->exchangeRecord($serviceParams);
        if (!is_null($this->marketActivityService->getError())) {
            return $this->setError($this->marketActivityService->getError());
        }
        $this->setResult($this->marketActivityService->_data);
    }

    /**
     * 开启大转盘活动
     */
    public function actionOpenAjax()
    {
       $this->openAjax();
    }

    /**
     * 开启砸金蛋活动
     */
    public function actionOpenSmasheggAjax()
    {
       $this->openAjax();
    }

    /**
     * 公用方法 方便权限控制 【开启活动】
     */
    protected function openAjax()
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
        $this->marketActivityService->open($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->marketActivityService->getError())) {
            return $this->setError($this->marketActivityService->getError());
        }
        $this->setResult($this->marketActivityService->_data);
    }

    /**
     * 关闭大转盘活动
     */
    public function actionCloseAjax()
    {
        $this->closeAjax();
    }

    /**
     * 关闭砸金蛋活动
     */
    public function actionCloseSmasheggAjax()
    {
        $this->closeAjax();
    }

    /**
     * 公用方法 方便权限控制 【关闭活动】
     */
    protected function closeAjax()
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
        $this->marketActivityService->close($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->marketActivityService->getError())) {
            return $this->setError($this->secondKillService->getError());
        }
        $this->setResult($this->marketActivityService->_data);
    }

    /**
     * 删除大转盘活动
     */
    public function actionDelAjax()
    {
      $this->delAjax();
    }

    /**
     * 删除砸金蛋活动
     */
    public function actionDelSmasheggAjax()
    {
        $this->delAjax();
    }

    /**
     * 公用方法 方便权限控制 【删除活动】
     */
    protected function delAjax()
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
        $this->marketActivityService->delete($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->marketActivityService->getError())) {
            return $this->setError($this->marketActivityService->getError());
        }
        $this->setResult($this->marketActivityService->_data);
    }

    /**
     * 奖品设置获取 可用的优惠券和红包
     */
    private function _getPrize()
    {
        $prizeList = [];
        //1.优惠券获取 接口没出
        $cardParams = [
            'shop_id' => $this->_shop['id'],
            'valid' => true,
            'get_card_type' => CardCoupon::GET_CARD_TYPE_NORMAL, //普通卡券，区分摇电视卡券
            'count' => 100
        ];
        $card = new CardCoupon();
        $card->find($cardParams);
        // 接收逻辑层处理结果
        if (!is_null($card->getError())) {
            return $this->setError($card->getError());
        }
        $prizeList[MarketActivity::PRIZE_TYPE_COUPON] = $card->_data; //可选优惠券

        //2.红包获取
        $redpackParams = [
            'shop_id' => $this->_shop['id'],
            'deleted' => RedpackManage::STATUS_ENABLE,
            'count' => 100,
            'type' => RedpackManage::TYPE_MALL,
            'is_not_end' => true //使用期限是否未结束
        ];
        $redpack = new RedpackManageService();
        $redpack->find($redpackParams);
        if (!is_null($redpack->getError())) {
            $this->marketActivityService->setError($redpack->getError());
        }
        $prizeList[MarketActivity::PRIZE_TYPE_REDPACKET] = $redpack->_data; //可选红包数据

        //3.现金红包
        $cashParams = [
            'shop_id' => $this->_shop['id'],
            'deleted' => CashRedpack::CASHREDPACK_OPEN,
            'count' => 100,
            'valid' => true
        ];
        $cashRedpack = new CashRedpack();
        $cashRedpack->find($cashParams);
        if (!is_null($redpack->getError())) {
          $this->marketActivityService->setError($cashRedpack->getError());
        }
        $prizeList[MarketActivity::PRIZE_TYPE_CASH_REDPACKET] = $cashRedpack->_data; //可选红包数据
        return $prizeList;
    }
}