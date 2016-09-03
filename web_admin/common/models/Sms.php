<?php
/**
 * Author: zhangjn
 * Date: 2016/5/4
 * Time: 10:29
 */

namespace common\models;

use Yii;

/**
 * 短信
 * Class Sms
 * @package common\models
 */
class Sms extends BaseModel
{
    /**
     * 充值类型：微信支付
     */
    const SMS_RECHARGE_TYPE = 1;
    /**
     * 充值类型：系统赠送
     */
    const SMS_GIFT_TYPE = 2;
    /**
     * 充值状态：未完成充值
     */
    const SMS_STATUS_RECHARGE_NOT_COMPLETED = 1;
    /**
     * 充值状态：已完成充值
     */
    const SMS_STATUS_RECHARGE_COMPLETED = 2;
    /**
     * 赠送套餐领取状态：未领取
     */
    const SMS_STATUS_NOT_RECEIVE = 1;
    /**
     * 赠送套餐领取状态：已领取
     */
    const SMS_STATUS_RECEIVE = 2;
    /**
     * 套餐：上架
     */
    const SMS_STATUS_ON_SALE = 1;
    /**
     * 套餐：下架
     */
    const SMS_STATUS_NOT_ON_SALE = 2;

    /**
     * 短信发送记录
     * @param $params
     */
    public function findSmsSendLogList($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
            'mobile' => isset($params['mobile']) ? $params['mobile'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
        ];
        $this->getResult('sms-send-log-list',$apiParams);
    }

    /**
     * 短信套餐列表
     * @param $params
     */
    public function findSmsPackageList($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
        ];
        $this->getResult('sms-package-list',$apiParams);
    }

    /**
     * 充值与赠送领取记录列表
     * @param $params
     */
    public function findSmsRechargeOrderList($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
            'order_no' => isset($params['order_no']) ? $params['order_no'] : null,
            'recharge_type' => isset($params['recharge_type']) ? $params['recharge_type'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
        ];
        $this->getResult('sms-recharge-order-list',$apiParams);
    }

    /**
     * 获取商户短信存量信息
     * @param $params
     */
    public function getSmsShop($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('sms-shop',$apiParams);
    }

    /**
     * 赠送套餐领取
     * @param $params
     */
    public function smsReceive($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('sms-receive',$apiParams);
    }
    
    /**
     * 充值
     * @param unknown $params
     */
    public function rechange($params)
    {
        $apiParams = [
            'sms_package_id' => isset($params['sms_package_id']) ? $params['sms_package_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_manager_id' => isset($params['shop_manager_id']) ? $params['shop_manager_id'] : null,
            'ip' => isset($params['ip']) ? $params['ip'] : null,
        ];
        $this->getResult('sms-rechange',$apiParams);
    }

    /**
     * 充值(微信扫码支付)
     * @param unknown $params
     */
    public function rechangeByWx($params)
    {
        $apiParams = [
            'sms_package_id' => isset($params['sms_package_id']) ? $params['sms_package_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_manager_id' => isset($params['shop_manager_id']) ? $params['shop_manager_id'] : null,
            'ip' => isset($params['ip']) ? $params['ip'] : null,
        ];
        $this->getResult('sms-rechange-wx',$apiParams);
    }
    
    /**
     * 记录财付通参数信息
     * @param unknown $params
     */
    public function logTenpayNotice($params)
    {
        $apiParams = [
        'get' => isset($params['get']) ? $params['get'] : null,
        'post' => isset($params['post']) ? $params['post'] : null,
        'ip' => isset($params['ip']) ? $params['ip'] : null,
        ];
        $this->getResult('sms-log-tenpay-notice',$apiParams);
    }
    
    /**
     * 记录财付通参数信息
     * @param unknown $params
     */
    public function payCallback($params)
    {
        $apiParams = [
        'order_no' => isset($params['order_no']) ? $params['order_no'] : null,
        'tenpay_no' => isset($params['tenpay_no']) ? $params['tenpay_no'] : null,
        'recharge_money' => isset($params['recharge_money']) ? $params['recharge_money'] : null,
        'log_id' => isset($params['log_id']) ? $params['log_id'] : null,
        'state' => isset($params['state']) ? $params['state'] : null,
        ];
        $this->getResult('sms-pay-callback',$apiParams ,false);
    }

    /**
     * 微信扫码支付回调
     * @param array $params
     */
    public function payCallbackWx($params)
    {
        $apiParams = [
            'get' => isset($params['get']) ? $params['get'] : null,
            'post' => isset($params['post']) ? $params['post'] : null,
            'order_no' => isset($params['order_no']) ? $params['order_no'] : null,
            'ip' => isset($params['ip']) ? $params['ip'] : null,
        ];
        $this->getResult('sms-pay-callback-wx',$apiParams ,false);
    }
}