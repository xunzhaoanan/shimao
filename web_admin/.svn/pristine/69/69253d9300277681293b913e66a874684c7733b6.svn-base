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
 * shop model
 */
class CartCache extends BaseCache
{

    # 类缓存前缀
    const CACHE_KEY_PRE  = 'cart_';

    /**
     * 购物车缓存key
     */
    private function _key($params){
        $cacheKey = self::CACHE_KEY_PRE;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['uid']) ? $params['uid'] : null;
        //$cacheKey .= '_';
        //$cacheKey .= isset($params['mid']) ? $params['mid'] : null;
        return $cacheKey;
    }

    /**
     * 获取购物车缓存
     */
    public function getCache($params){
        return $this->get($this->_key($params));
    }

    /**
     * 设置购物车缓存
     */
    public function setCache($params,$value,$expire = 864000){
        $this->set($this->_key($params),$value,$expire);
    }

}
