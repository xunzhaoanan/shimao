<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 商品类
 */
namespace common\cache;

use common\models\Product;
use Yii;

/**
 * shop model
 */
class WxMaterialCache extends BaseCache
{
    # 类缓存前缀
    const CACHE_KEY_PRE  = 'wxmaterial_';
    # 缓存模块
    const CACHE_KEY_GET = 'get_';

    /**
     * 单个素材key
     * @return mixed
     */
    private function keyGet($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_GET;
        $cacheKey .= isset($params['material_type']) ? $params['material_type'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['material_id']) ? $params['material_id'] : null;
        return $cacheKey;
    }

    /**
     * 清除单个素材
     * @return mixed
     */
    public function delCache($params){
        $this->del($this->keyGet($params));
    }

    /**
     * 设置单个素材
     * @return mixed
     */
    public function setCache($params,$value,$expire = 108600){
        $this->set($this->keyGet($params),$value,$expire);
    }

    /**
     * 获取单个素材
     * @return mixed
     */
    public function getCache($params){
        return $this->get($this->keyGet($params));
    }



}
