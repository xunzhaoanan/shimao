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
class CommonCache extends BaseCache
{


    # 类缓存前缀
    const CACHE_KEY_PRE  = 'common_';
    # 缓存模块
    const CACHE_KEY_FIND_PROVINCE = 'find_province_';
    const CACHE_KEY_FIND_CITY = 'find_city_';
    const CACHE_KEY_FIND_DISTRICT = 'find_district_';
    const CACHE_KEY_FIND_CIRCLE = 'find_circle_';
    const CACHE_KEY_FIND_AREA = 'find_area_';
    const CACHE_KEY_GET_AREA_NAME = 'get_area_name_';
    const CACHE_KEY_GET_THIRDPARTY_INFO = 'get_tpinfo_';
    const CACHE_KEY_GET_THIRDPARTY_INFO_BYACCOUNT = 'get_tpinfo_byaccount_';

    /**
     * 获取地区信息缓存
     */
    public function findProvince(){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_FIND_PROVINCE;
        return $this->get($cacheKey);
    }

    /**
     * 设置地区信息缓存
     */
    public function setProvince($data,$expire = 108640){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_FIND_PROVINCE;
        $this->set($cacheKey,$data,$expire);
    }

    /**
     * 获取地区信息缓存
     */
    public function findCity($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_FIND_CITY;
        $cacheKey .= isset($params['province_id']) ? $params['province_id'] : null;
        return $this->get($cacheKey);
    }

    /**
     * 设置地区信息缓存
     */
    public function setCity($params,$data,$expire = 108640){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_FIND_CITY;
        $cacheKey .= isset($params['province_id']) ? $params['province_id'] : null;
        $this->set($cacheKey,$data,$expire);
    }

    /**
     * 获取地区信息缓存
     */
    public function findDistrict($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_FIND_DISTRICT;
        $cacheKey .= isset($params['city_id']) ? $params['city_id'] : null;
        return $this->get($cacheKey);
    }

    /**
     * 设置地区信息缓存
     */
    public function setDistrict($params,$data,$expire = 108640){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_FIND_DISTRICT;
        $cacheKey .= isset($params['city_id']) ? $params['city_id'] : null;
        $this->set($cacheKey,$data,$expire);
    }

    /**
     * 获取地区信息缓存
     */
    public function findCircle($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_FIND_CIRCLE;
        $cacheKey .= isset($params['district_id']) ? $params['district_id'] : null;
        return $this->get($cacheKey);
    }

    /**
     * 设置地区信息缓存
     */
    public function setCircle($params,$data,$expire = 108640){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_FIND_CIRCLE;
        $cacheKey .= isset($params['district_id']) ? $params['district_id'] : null;
        $this->set($cacheKey,$data,$expire);
    }

    /**
     * 获取地区信息缓存
     */
    public function findArea(){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_FIND_AREA;
        return $this->get($cacheKey);
    }

    /**
     * 设置地区信息缓存
     */
    public function setArea($data,$expire = 108640){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_FIND_AREA;
        $this->set($cacheKey,$data,$expire);
    }

    /**
     * 获取地区信息缓存
     */
    public function getName($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_GET_AREA_NAME;
        $cacheKey .= isset($params['id']) ? $params['id'] : null;
        return $this->get($cacheKey);
    }

    /**
     * 设置地区信息缓存
     */
    public function setName($params,$data,$expire = 108640){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_GET_AREA_NAME;
        $cacheKey .= isset($params['id']) ? $params['id'] : null;
        $this->set($cacheKey,$data,$expire);
    }

    /**
     * 第三方平台配置的缓存key
     * 内部调用
     * @return mixed
     */
    private function keyThirdParty($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_GET_THIRDPARTY_INFO;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['platform_type']) ? $params['platform_type'] : null;
        return $cacheKey;
    }

    /**
     * 获取第三方平台配置信息
     */
    public function getThirdPartyInfo($params){
        return $this->get($this->keyThirdParty($params));
    }

    /**
     * 删除第三方平台配置信息
     */
    public function delThirdPartyInfo($params){
        return $this->del($this->keyThirdParty($params));
    }

    /**
     * 设置第三方平台配置信息
     */
    public function setThirdPartyInfo($params,$data,$expire = 108640){
        $this->set($this->keyThirdParty($params),$data,$expire);
    }

    /**
     * 根据微信号获取第三方平台配置信息
     */
    public function getThirdPartyInfoByAccount($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_GET_THIRDPARTY_INFO_BYACCOUNT;
        $cacheKey .= isset($params['account']) ? $params['account'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['platform_type']) ? $params['platform_type'] : null;
        return $this->get($cacheKey);
    }

    /**
     * 根据微信号设置第三方平台配置信息
     */
    public function setThirdPartyInfoByAccount($params,$data,$expire = 108640){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_GET_THIRDPARTY_INFO_BYACCOUNT;
        $cacheKey .= isset($params['account']) ? $params['account'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['platform_type']) ? $params['platform_type'] : null;
        $this->set($cacheKey,$data);
    }




}
