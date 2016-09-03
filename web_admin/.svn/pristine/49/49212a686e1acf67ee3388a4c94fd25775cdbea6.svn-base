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
 * WxQrcodeCach model
 */
class WxQrcodeCache extends BaseCache
{
    # 类缓存前缀
    const CACHE_KEY_PRE  = 'wxqrcode_';
    # 缓存模块
    const CACHE_KEY_GET = 'get_';


    /**
     * 二维码缓存key
     * 内部调用
     * @return mixed
     */
    private function keyGet($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_GET;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['scene_id']) ? $params['scene_id'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['model']) ? $params['model'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['model_id']) ? $params['model_id'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['ticket']) ? $params['ticket'] : null;
        return $cacheKey;
    }

    /**
     * 清除二维码缓存
     * 注意传过来的ids是商品id是数组
     * @return mixed
     */
    public function delCache($params){
        $this->del($this->keyGet($params));
    }

    /**
     * 设置二维码缓存
     * @return mixed
     */
    public function setCache($params,$value,$expire = 3600){
        $this->set($this->keyGet($params),$value,$expire);
    }

    /**
     * 获取二维码缓存
     * @return mixed
     */
    public function getCache($params){
        return $this->get($this->keyGet($params));
    }



}
