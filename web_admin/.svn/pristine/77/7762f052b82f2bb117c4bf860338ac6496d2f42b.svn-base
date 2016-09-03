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
class MallCache extends BaseCache
{

    # 类缓存前缀
    const CACHE_KEY_PRE  = 'member_';
    # 缓存模块
    const CACHE_KEY_GET = 'get_';
    const CACHE_KEY_GET_BY_OPENID = 'get_by_openid_';


    /**
     * 获取单条数据缓存key
     * @return mixed
     */
    private function getByOpenidKey($params){
        //拿缓存数组
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_GET_BY_OPENID;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['open_id']) ? $params['open_id'] : null;
        return $cacheKey;
    }

    /**
     * 清除单条数据缓存
     * @return mixed
     */
    public function delGetByOpenid($params){
        $this->del($this->getByOpenidKey($params));
    }

    /**
     * 设置单条数据缓存
     * @return mixed
     */
    public function setGetByOpenid($params,$value,$expire = 86400){
        $this->set($this->getByOpenidKey($params),$value);
    }

    /**
     * 获取单条数据缓存
     * @return mixed
     */
    public function getGetByOpenid($params){
        return $this->get($this->getByOpenidKey($params));
    }

    /**
     * 获取单条数据缓存key
     * @return mixed
     */
    private function getKey($params){
        //拿缓存数组
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_GET;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['user_id']) ? $params['user_id'] : null;
        return $cacheKey;
    }

    /**
     * 清除单条数据缓存
     * @return mixed
     */
    public function delGet($params){
        $this->del($this->getKey($params));
    }

    /**
     * 设置单条数据缓存
     * @return mixed
     */
    public function setGet($params,$value,$expire = 86400){
        $this->set($this->getKey($params),$value);
    }

    /**
     * 获取单条数据缓存
     * @return mixed
     */
    public function getGet($params){
        return $this->get($this->getKey($params));
    }





}
