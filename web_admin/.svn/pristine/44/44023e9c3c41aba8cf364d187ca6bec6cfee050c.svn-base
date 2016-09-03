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
class WxReplyCache extends BaseCache
{
    # 类缓存前缀
    const CACHE_KEY_PRE  = 'wx_reply_';
    # 缓存模块
    const CACHE_KEY_GET_DEFAULT = 'get_default_';
    const CACHE_KEY_GET_ATTENTION = 'get_attention_';
    const CACHE_KEY_GET_KEYWORD = 'get_keyword_';
    const CACHE_KEY_GET_SEARCH = 'get_search_';

    /**
     * 默认回复
     * 内部调用
     * @return mixed
     */
    private function keyGetDefault($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_GET_DEFAULT;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        return $cacheKey;
    }

    /**
     * 清除默认回复
     * 注意传过来的ids是商品id是数组
     * @return mixed
     */
    public function delDefault($params){
        $this->del($this->keyGetDefault($params));
    }

    /**
     * 设置默认回复
     * @return mixed
     */
    public function setDefault($params,$value,$expire = 108600){
        $this->set($this->keyGetDefault($params),$value,$expire);
    }

    /**
     * 获取默认回复
     * @return mixed
     */
    public function getDefault($params){
        return $this->get($this->keyGetDefault($params));
    }

    /**
     * 关注时回复
     * 内部调用
     * @return mixed
     */
    private function keyGetAttention($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_GET_ATTENTION;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        return $cacheKey;
    }

    /**
     * 清除关注时回复
     * 注意传过来的ids是商品id是数组
     */
    public function delAttention($params){
        $this->del($this->keyGetAttention($params));
    }

    /**
     * 设置关注时回复
     */
    public function setAttention($params,$value,$expire = 108600){
        $this->set($this->keyGetAttention($params),$value);
    }

    /**
     * 获取关注时回复
     */
    public function getAttention($params){
        return $this->get($this->keyGetAttention($params));
    }

    /**
     * 关键字回复
     * 内部调用
     * @return mixed
     */
    private function keyGetKeyword($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_GET_KEYWORD;
        $cacheKey .= isset($params['keyword_id']) ? $params['keyword_id'] : null;
        return $cacheKey;
    }

    /**
     * 清除关键字回复
     * 注意传过来的ids是商品id是数组
     * @return mixed
     */
    public function delKeyword($params){
        $this->del($this->keyGetKeyword($params));
    }

    /**
     * 设置关键字回复
     * @return mixed
     */
    public function setKeyword($params,$value,$expire = 108600){
        $this->set($this->keyGetKeyword($params),$value);
    }

    /**
     * 获取关键字回复
     * @return mixed
     */
    public function getKeyword($params){
        return $this->get($this->keyGetKeyword($params));
    }

    /**
     * 匹配关键字
     * 内部调用
     * @return mixed
     */
    private function keyGetSearch($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_GET_SEARCH;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['keyword']) ? md5($params['keyword']) : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['match_type']) ? $params['match_type'] : null;
        return $cacheKey;
    }

    /**
     * 清除匹配关键字
     * 注意传过来的ids是商品id是数组
     * @return mixed
     */
    public function delSearch($params){
        $this->del($this->keyGetSearch($params));
    }

    /**
     * 设置匹配关键字
     * @return mixed
     */
    public function setSearch($params,$value,$expire = 108600){
        $this->set($this->keyGetSearch($params),$value);
    }

    /**
     * 获取匹配关键字
     * @return mixed
     */
    public function getSearch($params){
        return $this->get($this->keyGetSearch($params));
    }



}
