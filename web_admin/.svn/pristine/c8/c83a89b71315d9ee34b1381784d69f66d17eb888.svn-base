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
class TerminalCache extends BaseCache
{

    # 类缓存前缀
    const CACHE_KEY_PRE  = 'terminal_';
    # 缓存模块
    const CACHE_KEY_GET = 'get_';

    /**
     * 店铺缓存key
     * 内部调用
     * @return mixed
     */
    private function getKey($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_GET;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null;
        return $cacheKey;
    }

    /**
     * 获取店铺信息缓存
     * @return mixed
     */
    public function getCache($params){
        return $this->get($this->getKey($params));
    }

    /**
     * 设置店铺信息缓存
     * @return mixed
     */
    public function setCache($params,$value,$expire = 86400){
        return $this->set($this->getKey($params),$value,$expire);
    }

    /**
     * 设置店铺信息缓存
     * @return mixed
     */
    public function delCache($params){
        $this->del($this->getKey($params));
    }


}
