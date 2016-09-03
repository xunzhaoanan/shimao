<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\newservices;


use common\cache\ShopCache;

class NewShop extends BaseService
{

    //支付方式开启状态
    const PAY_STATUS_OPEMN = 1;
    const PAY_STATUS_CLOSE = 0;

    const PAY_TYPE_TENPAY = 1;
    const PAY_TYPE_WXPAY = 2;
    const PAY_TYPE_DELIVERY = 3;
    const PAY_TYPE_COLLECTION = 4;
    const PAY_TYPE_NEW_WXPAY = 5;
    const PAY_TYPE_QQ_PAY = 8;


    protected $shopCache ;

    public function __construct()
    {
        parent::__construct();
        $this->shopCache = new ShopCache();
    }

    /**
     * 获取商家信息
     */
    public function get($params)
    {
        $data = $this->shopCache->getShop($params);
        if($data !== false){
            return $data;
        }
        $data =  $this->getResult('shop-get',$params);
        $this->shopCache->setShop($params,$data);
        return $data;
    }

    /**
     * 修改商家信息
     */
    public function update($params)
    {
        return $this->getResult('shop-update',$params);
    }

    /**
     * 支付设置列表
     */
    public function getPaymentSetting($params){
        $data = $this->shopCache->getPaymentSetting($params);
        if($data !== false){
            return $data;
        }
        $data =  $this->getResult('payment-setting-get',$params);
        $this->shopCache->getPaymentSetting($params,$data);
        return $data;
    }


}