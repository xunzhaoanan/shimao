<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 商品类
 */
namespace common\cache;

use Yii;

/**
 * shop cache
 */
class ShopCache extends BaseCache
{

    # 类缓存前缀
    const CACHE_KEY_PRE  = 'shop_';
    # 缓存模块
    const CACHE_KEY_PAYMENT_SETTING_LIST = 'payment_setting_list_';
    const CACHE_KEY_PAYMENT_SETTING_GET = 'payment_setting_get_';
    const CACHE_KEY_SHOP_GET = 'get_';


    /**
     * 支付设置配置列表key
     * 内部调用
     * @return mixed
     */
    private function paymentSettingListKey($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_PAYMENT_SETTING_LIST;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        return $cacheKey;
    }

    /**
     * 清除支付配置列表缓存
     * @return mixed
     */
    public function delPaymentSettingList($params){
        $this->del($this->paymentSettingListKey($params));
    }

    /**
     * 设置支付配置列表缓存
     * @return mixed
     */
    public function setPaymentSettingList($params,$value,$expire = 86400){
        $this->set($this->paymentSettingListKey($params),$value,$expire);
    }

    /**
     * 获取支付配置列表缓存
     * @return mixed
     */
    public function getPaymentSettingList($params){
        return $this->get($this->paymentSettingListKey($params));
    }

    /**
     * 支付设置缓存key
     * 内部调用
     * @return mixed
     */
    private function paymentSettingKey($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_PAYMENT_SETTING_GET;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['type']) ? $params['type'] : null;
        return $cacheKey;
    }

    /**
     * 清除支付设置缓存
     * @return mixed
     */
    public function delPaymentSetting($params){
        $this->del($this->paymentSettingKey($params));
    }

    /**
     * 设置支付信息缓存
     * @return mixed
     */
    public function setPaymentSetting($params,$value,$expire = 86400){
        $this->set($this->paymentSettingKey($params),$value,$expire);
    }

    /**
     * 获取支付信息缓存
     * @return mixed
     */
    public function getPaymentSetting($params){
        return $this->get($this->paymentSettingKey($params));
    }

    /**
     * 店铺缓存key
     * 内部调用
     * @return mixed
     */
    private function getShopKey($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_SHOP_GET;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        return $cacheKey;
    }

    /**
     * 获取店铺信息缓存
     * @return mixed
     */
    public function getShop($params){
        return $this->get($this->getShopKey($params));
    }

    /**
     * 设置店铺信息缓存
     * @return mixed
     */
    public function setShop($params,$value,$expire = 86400){
        return $this->set($this->getShopKey($params),$value,$expire);
    }

    /**
     * 设置店铺信息缓存
     * @return mixed
     */
    public function delShop($params){
        $this->del($this->getShopKey($params));
    }


}
