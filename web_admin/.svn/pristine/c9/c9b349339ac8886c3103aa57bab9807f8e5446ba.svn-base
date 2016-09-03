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
class WxshopCache extends BaseCache
{

    # 类缓存前缀
    const CACHE_KEY_PRE  = 'wxshop_';
    # 缓存模块
    const CACHE_KEY_CATEGORY_LIST = 'category_list_';
    const CACHE_KEY_CATEGORY_GET = 'category_get_';


    /**
     * 获取单条数据缓存key
     * @return mixed
     */
    private function categoryGetKey($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_CATEGORY_GET;
        $cacheKey .= isset($params['id']) ? $params['id'] : null;
        return $cacheKey;
    }

    /**
     * 清除单条数据缓存
     * @return mixed
     */
    public function delGetCategory($params){
        $this->del($this->categoryGetKey($params));
    }

    /**
     * 设置单条数据缓存
     * @return mixed
     */
    public function setGetCategory($params,$value,$expire = 86400){
        $this->set($this->categoryGetKey($params),$value,$expire);
    }

    /**
     * 获取单条数据缓存
     * @return mixed
     */
    public function getGetCategory($params){
        return $this->get($this->categoryGetKey($params));
    }

    /**
     * 获取单条数据缓存key
     * @return mixed
     */
    private function categoryFindKey($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_CATEGORY_GET;
        $cacheKey .= isset($params['pid']) ? $params['pid'] : null;
        return $cacheKey;
    }

    /**
     * 清除单条数据缓存
     * @return mixed
     */
    public function delFindCategory($params){
        $this->del($this->categoryFindKey($params));
    }

    /**
     * 设置单条数据缓存
     * @return mixed
     */
    public function setFindCategory($params,$value,$expire = 86400){
        $this->set($this->categoryFindKey($params),$value,$expire);
    }

    /**
     * 获取单条数据缓存
     * @return mixed
     */
    public function getFindCategory($params){
        return $this->get($this->categoryFindKey($params));
    }



}
