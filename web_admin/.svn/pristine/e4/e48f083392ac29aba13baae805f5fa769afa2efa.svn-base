<?php
/**
 * Author: zhangjn
 * Date: 2015/9/9
 * Time: 11:07
 */

namespace common\cache;

use Yii;

/**
 * printer model
 */
class PrinterCache extends BaseCache
{
    # 类缓存前缀
    const CACHE_KEY_PRE  = 'printer_';
    # 缓存模块

    /**
     * key
     * @return mixed
     */
    private function keyGet($params, $type){
        $cacheKey = self::CACHE_KEY_PRE.$type;
        $cacheKey .= '_';
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['factory']) ? $params['factory'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['id']) ? $params['id'] : null;
        return $cacheKey;
    }

    /**
     * 清除
     * @return mixed
     */
    public function delCache($params,$type){
        $this->del($this->keyGet($params, $type));
    }

    /**
     * 设置
     * @return mixed
     */
    public function setCache($params,$type,$value,$expire = 108600){
        $this->set($this->keyGet($params,$type),$value,$expire);
    }

    /**
     * 获取
     * @return mixed
     */
    public function getCache($params,$type){
        return $this->get($this->keyGet($params,$type));
    }
}