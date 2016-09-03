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
class WxMenuCache extends BaseCache
{
    # 类缓存前缀
    const CACHE_KEY_PRE  = 'wxmenu_';
    # 缓存模块
    const CACHE_KEY_GET = 'get_';


    /**
     * 多条商品分类条记录的缓存key
     * 内部调用
     * @return mixed
     */
    private function keyGet($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_GET;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        return $cacheKey;
    }

    /**
     * 清除多条商品分类记录缓存
     * 注意传过来的ids是商品id是数组
     * @return mixed
     */
    public function delCache($params){
        $this->del($this->keyGet($params));
    }

    /**
     * 设置多条商品分类记录缓存
     * @return mixed
     */
    public function setCache($params,$value,$expire = 3600){
        $this->set($this->keyGet($params),$value,$expire);
    }

    /**
     * 获取商品分类多条记录缓存
     * @return mixed
     */
    public function getCache($params){
        return $this->get($this->keyGet($params));
    }



}
