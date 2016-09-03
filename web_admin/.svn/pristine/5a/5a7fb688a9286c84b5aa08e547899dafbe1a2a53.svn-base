<?php
/**
 * Author: zhangjn
 * Date: 2015/11/19
 * Time: 17:03
 */

namespace admin\controllers;

use common\cache\BaseCache;
use common\forms\activity\ListAjaxForm;
use common\forms\cardcoupon\AddAjaxForm;
use common\forms\cardcoupon\AddHandSendAjaxForm;
use common\forms\cardcoupon\AddReceiveAjaxForm;
use common\forms\cardcoupon\AddStrategyAjaxForm;
use common\forms\cardcoupon\CancelAjaxForm;
use common\forms\cardcoupon\EditAjaxForm;
use common\forms\cardcoupon\EditReceiveAjaxForm;
use common\forms\cardcoupon\EditStrategyAjaxForm;
use common\forms\cardcoupon\ListShopSubAjaxForm;
use common\forms\cardcoupon\ListRecordAjaxForm;
use common\forms\GeneralForm;
use common\models\CardCoupon;
use common\models\Terminal;
use common\services\activity\CardCouponService;
use common\services\wechat\WechatPushService;
use Yii;
use yii\base\UserException;
use yii\web\NotFoundHttpException;


class TvCardCouponsController extends BaseController
{
    protected $cardCouponService;
    protected $cardCouponModel;

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->cardCouponModel = new CardCoupon();
        $this->cardCouponService = new CardCouponService($this->_wxInfo);
    }

    /**
     * 卡券列表
     */
    public function actionList()
    {
        return $this->render('list');
    }

    /**
     * ajax 卡券列表
     */
    public function actionListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new ListAjaxForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form, ['_name' => 'title']);
        $modelParams += [
            'shop_id' => $this->_shop['id'],
            'get_card_type' => 2//摇电视卡券
        ];
        $this->getPageInfo($modelParams);
        $this->cardCouponModel->find($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * TODO 添加卡券
     */
    public function actionAdd()
    {
        //1.进入添加页面判断微信公众号是否有卡券创建功能
        //$isOpenCardFn = $this->cardCouponService->isOpenCardFunction();
        $model = [
            'isOpenCardFn' => false, //是否开启了卡券功能
            'shopName' => $this->_shop['name']
        ];
        return $this->render('add', ['model' => $model]);
    }

    /**
     * 判断公众号是否开通卡券功能
     */
    public function actionCheckCardFnAjax(){
        $isOpenCardFn = $this->cardCouponService->isOpenCardFunction();
        $this->setResult($isOpenCardFn);
    }

    /**
     * ajax 添加卡券
     */
    public function actionAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new AddAjaxForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id'],
            //'brand_name' => $this->_shop['name'], //商家名称
            'get_card_type' => CardCoupon::GET_CARD_TYPE_TV, //创建摇电视卡券
        ];
        $this->cardCouponService->create($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponService->getError())) {
            return $this->setError($this->cardCouponService->getError());
        }
        $this->setResult($this->cardCouponService->_data);
    }

    /**
     * 编辑卡券
     */
    public function actionEdit()
    {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        //获取卡券活动信息
        $model = $this->_getCardCoupon($modelParams);
        if(trim($model['range'])){
            $model['range'] = array_map('intval', explode(',', $model['range']));
        }else{
            $model['range'] = [];
        }
        return $this->render('edit', ['model' => $model]);
    }

    /**
     * ajax 编辑卡券
     */
    public function actionEditAjax()
    {
        // form处理
        $form = new EditAjaxForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cardCouponService->update($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponService->getError())) {
            return $this->setError($this->cardCouponService->getError());
        }
        $this->setResult($this->cardCouponService->_data);
    }

    /**
     * 开启卡券
     */
    public function actionOpenAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cardCouponModel->open($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * 关闭卡券
     */
    public function actionCloseAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cardCouponModel->close($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     *  删除卡券
     */
    public function actionDelAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cardCouponModel->delete($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * 直接领取列表:
     * @return string
     */
    public function actionReceiveList()
    {
        return $this->render('receive-list');
    }

    /**
     * ajax 直接领取列表
     */
    public function actionReceiveListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $modelParams = [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($modelParams);
        $this->cardCouponModel->findCardReceive($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * 添加直接领取:
     * @return string
     */
    public function actionReceiveAdd()
    {
        return $this->render('receive-add');
    }

    /**
     * ajax 添加直接领取
     * @return string
     */
    public function actionReceiveAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new AddReceiveAjaxForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cardCouponModel->createCardReceive($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * 修改直接领取
     * @return string
     */
    public function actionReceiveEdit()
    {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cardCouponModel->getCardReceive($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $model = $this->cardCouponModel->_data;
        return $this->render('receive-edit', ['model' => $model]);
    }

    /**
     * ajax 修改直接领取
     * @return string
     */
    public function actionReceiveEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new EditReceiveAjaxForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cardCouponModel->updateCardReceive($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * ajax 删除直接领取卡券
     */
    public function actionReceiveDelAjax(){
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cardCouponModel->delCardReceive($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * 赠送策略列表:
     * @return string
     */
    public function actionPolicyList()
    {
        return $this->render('policy-list');
    }

    /**
     * ajax 赠送策略列表
     */
    public function actionPolicyListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $modelParams = [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($modelParams);
        $this->cardCouponModel->findCardStrategy($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * 新增赠送策略:
     * @return string
     */
    public function actionPolicyAdd()
    {
        return $this->render('policy-add');
    }

    /**
     * ajax新增赠送策略:
     * @return string
     */
    public function actionPolicyAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new AddStrategyAjaxForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        //指定商品
        if($modelParams['type'] == CardCoupon::STRATEGY_TYPE_PRODUCT){
            $modelParams['product_ids'] = implode(',', $modelParams['product_ids']);
        }
        $this->cardCouponModel->createCardStrategy($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * 修改赠送策略:
     * @return string
     */
    public function actionPolicyEdit()
    {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cardCouponModel->getCardStrategy($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        return $this->render('policy-edit', ['model' => $this->cardCouponModel->_data]);
    }

    /**
     * ajax修改赠送策略:
     * @return string
     */
    public function actionPolicyEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new EditStrategyAjaxForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        //指定商品
        if($modelParams['type'] == CardCoupon::STRATEGY_TYPE_PRODUCT && $modelParams['product_ids']){
            $modelParams['product_ids'] = implode(',', $modelParams['product_ids']);
        }
        $this->cardCouponModel->updateCardStrategy($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * ajax 删除赠送卡券策略
     */
    public function actionPolicyDelAjax(){
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cardCouponModel->delCardStrategy($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * 手动派发列表:
     * @return string
     */
    public function actionSendList()
    {
        return $this->render('send-list');
    }

    /**
     * ajax 手动派发列表:
     * @return string
     */
    public function actionSendListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $modelParams = [
            'shop_id' => $this->_shop['id'],
            'receive_type' => CardCoupon::CARD_RECEIVE_TYPE_MANUAL //手动派发
        ];
        $this->getPageInfo($modelParams);
        $this->cardCouponModel->findCardInfo($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * 手动派发卡券:
     * @return string
     */
    public function actionSend()
    {
        return $this->render('send');
    }

    /**
     * 可能有点问题
     * ajax 手动派发卡券:
     * @return string
     */
    public function actionSendAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new AddHandSendAjaxForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cardCouponModel->handSendCard($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $sendUserCard = $this->cardCouponModel->_data;
        //1.检查卡券活动
        /*$cardParams = ['shop_id' => $this->_shop['id'], 'id' => $modelParams['card_type_id']];
        $cardTypeInfo = $this->_getCardCoupon($cardParams);
        //2.消息推送
        $flag = $this->_sendWxMsg($cardTypeInfo, $sendUserCard['data']);*/
        //$sendUserCard['pushFlag'] 稍后替换$flag
        $this->setResult(['sendUserCard' => $sendUserCard['data'], 'flag' => $sendUserCard['pushFlag']]);
    }

    /**
     * 推送卡券派发信息
     * @param $cardInfo
     * @param $params
     */
    private function _sendWxMsg($cardTypeInfo, $params){
        $extends = ['shopName' => $this->_shop['name'], 'card_type' => $cardTypeInfo['card_type']];
        $wechatPush = new WechatPushService($this->_wxInfo, '');
        BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__);
        //推送卡券派送消息
        $flag = 1;
        //如果是商户卡券，直接提示派发成功，因为微商户卡券派发时，状态直接为已领取，微信卡券只是未领取
        $is_wx_card = ($cardTypeInfo['card_type'] == CardCoupon::CARD_TYPE_WEIXIN) ? true : false;
        foreach($params as $val){
            $sucCount = $fail = 0;
            $count = count($params);
            BaseCache::append('test_cache', 'val：'. json_encode($val));
            if(!empty($val['user']['wxUsers']['open_id'])){
                $extends['open_id'] = $val['user']['wxUsers']['open_id'];
                $extends['info_id'] = $val['cardInfo']['id'];
                $return = $wechatPush->sendCardCoupon($cardTypeInfo, $extends);
                if($is_wx_card){ //如果为微信卡券则处理是否全部发送成功
                    $return ? $sucCount++ : $fail++;
                    if($sucCount >= $count){
                        $flag = 1;
                    }elseif($fail < $count && $fail > 0){
                        $flag = 3; //部分成功
                    }else{
                        $flag = 2; //全部失败
                    }
                }
            }
        }
        return $flag;
    }

    /**
     * 获取卡券活动信息
     * @param $params
     * @return null|void
     */
    private function _getCardCoupon($params)
    {
        $this->cardCouponModel->get($params);
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        return $this->cardCouponModel->_data;
    }

    /**
     * 卡券手册:
     * @return string
     */
    public function actionCardVoucher()
    {
        return $this->render('card-voucher');
    }

    /**
     * 卡券领取记录:
     * @return string
     */
    public function actionCardRecord()
    {
        $form = new GeneralForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        //获取卡券活动信息
        $model = $this->_getCardCoupon($modelParams);
        return $this->render('card-record', ['model' => $model]);
    }

    /**
     * ajax 卡券领取记录
     */
    public function actionCardRecordListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new ListRecordAjaxForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($modelParams);
        //卡券状态 1:未领取 2:已领取 3:已核销 4:已赠送 5:已冻结 6:已删除(2:已领取,3:已核销,4:已赠送为领取状态)
        if (isset($modelParams['_status'])) {
            $modelParams['status'] = [CardCoupon::STATUS_CARD_RECEIVE, CardCoupon::STATUS_CARD_EXCHANGE,CardCoupon::STATUS_CARD_GIVE];
        }
        $this->cardCouponModel->findCardInfo($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * 门店列表分页
     * 包含直营店或加盟店
     */
    public function actionShopSubListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new ListShopSubAjaxForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        if (isset($modelParams['_available_status'])) {
            $modelParams['available_status'] = Terminal::AVAILABLE_STATUS_SYNCHRONIZING_SUCCESS; //微信创建门店状态 1未同步 2审核中 3创建成功 4创建失败
        }
        $this->getPageInfo($modelParams);
        $terminalModel = new Terminal();
        $terminalModel->find($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($terminalModel->getError())) {
            return $this->setError($$terminalModel->getError());
        }
        $this->setResult($terminalModel->_data);
    }

    /**
     * 核销卡券
     */
    public function actionCancelCardAjax(){
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new CancelAjaxForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'staff_id' => $this->_shopStaff['id'],
            'shop_id' => $this->_shop['id'],
            //'status' => [CardCoupon::STATUS_CARD_RECEIVE] //已领取
        ];
        $this->cardCouponModel->cancelCard($modelParams);
        if(!is_null($this->cardCouponModel->getError())){
            return $this->setError($this->cardCouponModel->getError());
        }

        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * ajax 开启赠送策略
     */
    public function actionReceiveOpenAjax(){
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cardCouponModel->openStrategy($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * ajax 关闭赠送策略
     */
    public function actionReceiveCloseAjax(){
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(null, $form);
        $modelParams = $this->handleForm($form);
        $modelParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->cardCouponModel->closeStrategy($modelParams);
        // 接收逻辑层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * 摇电视卡券手册:
     * @return string
     */
    public function actionTvCardHelp()
    {
        return $this->render('tv-card-help');
    }

}