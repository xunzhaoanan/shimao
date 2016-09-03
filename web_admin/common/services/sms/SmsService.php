<?php
/**
 * Author: zhangjn
 * Date: 2016/5/4
 * Time: 10:27
 */

namespace common\services\sms;

use common\models\Sms;
use common\services\BaseService;

class SmsService extends BaseService
{
    protected $smsModel;

    public function init()
    {
        $this->smsModel = new Sms();
    }

    /**
     * 短信发送记录
     * @param $params
     */
    public function findSmsSendLogList($params)
    {
        $this->smsModel->findSmsSendLogList($params);
        // 接收数据层处理结果
        if ( ! is_null($this->smsModel->getError())){
            return $this->setError($this->smsModel->getError());
        }
        $this->setResult($this->smsModel->_data);
    }

    /**
     * 短信套餐列表
     * @param $params
     */
    public function findSmsPackageList($params)
    {
        $this->smsModel->findSmsPackageList($params);
        // 接收数据层处理结果
        if ( ! is_null($this->smsModel->getError())){
            return $this->setError($this->smsModel->getError());
        }
        $result = $this->smsModel->_data;
        if (isset($result['data']) && $result['data']) {
            for ($i = 0; $i < count($result['data']); $i++) {
                //判断赠送套餐是否已领取
                $result['data'][$i]['receive_status'] = $this->isReceive($result['data'][$i], $params['shop_id']);
            }
        }
        $this->setResult($result);
    }

    /**
     * 充值与赠送领取记录列表
     * @param $params
     */
    public function findSmsRechargeOrderList($params)
    {
        $this->smsModel->findSmsRechargeOrderList($params);
        // 接收数据层处理结果
        if ( ! is_null($this->smsModel->getError())){
            return $this->setError($this->smsModel->getError());
        }
        $this->setResult($this->smsModel->_data);
    }

    /**
     * 获取商户短信存量信息
     * @param $params
     */
    public function getSmsShop($params)
    {
        $this->smsModel->getSmsShop($params);
        // 接收数据层处理结果
        if ( ! is_null($this->smsModel->getError())){
            return $this->setError($this->smsModel->getError());
        }

        $result = $this->smsModel->_data;
        $data['balance_num'] = (isset($result['sms_num']) && $result['sms_num'] > 0) ? $result['sms_num'] : 0;
        $data['un_receive_gift_sms_num'] = $this->getUnReceiveGiftSmsNum($params['shop_id']);
        $this->setResult($data);
    }

    /**
     * 获取商户短信赠送套餐未领取短信数
     * @param $shop_id
     * @return int|void
     */
    public function getUnReceiveGiftSmsNum($shop_id)
    {
        $params = [
            'shop_id' => $shop_id,
            'page' => 0,
            'count' => 2000,
            'type' => Sms::SMS_GIFT_TYPE,
            'status' => Sms::SMS_STATUS_ON_SALE
        ];
        $this->smsModel->findSmsPackageList($params);
        // 接收数据层处理结果
        if ( ! is_null($this->smsModel->getError())){
            return $this->setError($this->smsModel->getError());
        }
        $result = $this->smsModel->_data;
        $unReceiveSmsNum = 0;
        if(isset($result['data']) && $result['data']){
            foreach($result['data'] as $packageItem){
                if($this->isReceive($packageItem, $params['shop_id']) == Sms::SMS_STATUS_NOT_RECEIVE){
                    $unReceiveSmsNum += (isset($packageItem['gift_sms_num'])?$packageItem['gift_sms_num']:0);
                }
            }
        }
        return $unReceiveSmsNum;
    }

    /**
     * 赠送套餐是否已领取
     * @param $data
     * @param $shop_id
     * @return int
     */
    protected function isReceive($data, $shop_id)
    {
        $result = Sms::SMS_STATUS_NOT_RECEIVE;//未领取
        if (isset($data['smsOrders']) && $data['smsOrders']) {
            foreach ($data['smsOrders'] as $smsOrderItem) {
                if (isset($smsOrderItem['shop_id']) && $smsOrderItem['shop_id'] == $shop_id && isset($smsOrderItem['recharge_type']) && $smsOrderItem['recharge_type'] == Sms::SMS_GIFT_TYPE && isset($smsOrderItem['status']) && $smsOrderItem['status'] == Sms::SMS_STATUS_RECEIVE) {
                    $result = Sms::SMS_STATUS_RECEIVE;//已领取
                }
            }
        }
        return $result;
    }

    /**
     * 赠送套餐领取
     * @param $params
     */
    public function smsReceive($params)
    {
        $this->smsModel->smsReceive($params);
        // 接收数据层处理结果
        if ( ! is_null($this->smsModel->getError())){
            return $this->setError($this->smsModel->getError());
        }
        $this->setResult($this->smsModel->_data);
    }
    
    /**
     * 短信充值
     * @param array $params
     */
    public function rechange($params)
    {
        $this->smsModel->rechange($params);
        // 接收数据层处理结果
        if ( ! is_null($this->smsModel->getError())){
            return $this->setError($this->smsModel->getError());
        }
        $this->setResult($this->smsModel->_data);
    }

    /**
     * 短信充值(微信扫码支付)
     * @param array $params
     */
    public function rechangeByWx($params)
    {
        $this->smsModel->rechangeByWx($params);
        // 接收数据层处理结果
        if ( ! is_null($this->smsModel->getError())){
            return $this->setError($this->smsModel->getError());
        }
        $this->setResult($this->smsModel->_data);
    }
    
    public function logTenpayNotice($params)
    {
        $this->smsModel->logTenpayNotice($params);
        // 接收数据层处理结果
        if (! is_null($this->smsModel->getError())){
            return $this->setError($this->smsModel->getError());
        }
        $this->setResult($this->smsModel->_data);
        return isset($this->smsModel->_data['id'])?$this->smsModel->_data['id']:0;
    }
    
    public function payCallback($params)
    {
        $log_id = intval($this->logTenpayNotice($params));
        $is_debug = isset($params['is_debug'])?$params['is_debug']:false;
        $apiParams = (new TenayService())->getNoticeInfo($is_debug);
        $apiParams['log_id'] = $log_id;
        return $this->payNotice($apiParams);
    }

    /**
     * 微信扫码支付回调
     * @param $params
     * @return bool|void
     */
    public function payNoticeWx($params)
    {
        $this->smsModel->payCallbackWx($params);
        // 接收数据层处理结果
        if ( ! is_null($this->smsModel->getError())){
            return $this->setError($this->smsModel->getError());
        }
        $this->setResult($this->smsModel->_data);
        if(isset($this->smsModel->_data['ret']) && $this->smsModel->_data['ret'])
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function payNotice($params)
    {
        $this->smsModel->payCallback($params);
        // 接收数据层处理结果
        if ( ! is_null($this->smsModel->getError())){
            return $this->setError($this->smsModel->getError());
        }
        $this->setResult($this->smsModel->_data);
        if($params['state'] == 1 && isset($this->smsModel->_data['ret']) && $this->smsModel->_data['ret'])
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}