<?php
/**
 * Author: MaChenghang
 * Date: 2015/07/04
 * Time: 15:00
 * cache类
 *
 *
//        $key = 'test';
//        $value = 'cache_calue';
//        $expire = 6;
//       Yii::$app->cache->set($key,$value,10);
//        pr(Yii::$app->cache->get($key));
//
//
//
//        $mem = new \Memcache() ;
//
//        pr(Yii::$app->params);
//
//        $mem->connect( '127.0.0.1',11211 ) ;
//
//       $mem->set($key,$value,false,$expire);
//
//        $b = $mem->get($key);
//
//       // $mem->delete($key);
//
//        pr($b);
 */
namespace common\cache;

use Yii;
use common\vendor\log\Log;

/**
 * shop model
 */
class BaseCache
{
    public static $cache = null ;
    public static $cacheTimeKey = '_expiretime' ;

    public static function build()
    {
        if (is_null(self::$cache)) {
            self::$cache = Yii::$app->cache;
        }
        return self::$cache;
    }
    /**
     * 得到 post 的某个参数
     * http_post的时候用的
     */
    public static function getPostParams($key)
    {
        if (!isset($_SERVER['HTTP_REFERER'])) {
            return null;
        }
        $referer = $_SERVER['HTTP_REFERER'];
        $strposKey = $key.'=';
        $strposBegin = strpos($referer, $strposKey);
        if ($strposBegin === false) {
            return null;
        }
        $strposBegin += strlen($strposKey);
        $value = substr($referer, $strposBegin);
        $strposKey = '&';
        $strposBegin = strpos($value, $strposKey);
        if ($strposBegin === false) {
            return $value;
        }
        $value = substr($value,0, $strposBegin);
        return $value;
    }


    /**
     * 获取缓存
     * @return mixed
     */
    public static function get($key)
    {
        //获取不到自己封装的过期时间，就返回false
        if(self::build()->get($key.self::$cacheTimeKey) === false){
            return false;
        }
        //过期了就返回false
        if(self::build()->get($key.self::$cacheTimeKey) < time()){
            return false;
        }
        return self::build()->get($key);
    }

    /**
     * 追加缓存
     * @return mixed
     */
    public static function append($key = null, $value  = null)
    {
        if(defined('WSH_DEBUG') && WSH_DEBUG) {
            if (!Yii::$app->request->get('debug') && !self::getPostParams('debug')) {
                return false;
            }
            $cache = self::get($key) ? self::build()->get($key) : [];
            $cache = count($cache) > 50 ? [] : $cache;
            $cache[] = $value;
            self::set($key, $cache, 60);
        }
    }

    /**
     * 追加缓存
     * @return mixed
     */
    public static function appends($key , $value , $expire = 3600)
    {
        $cache = self::get($key) ? self::build()->get($key) : [];
        $cache[] = $value;
        self::set($key, $cache,$expire);
    }

    /**
     * 设置缓存
     * @return mixed
     */
    public static function set($key , $value , $expire = 600)
    {
        $expire = intval($expire);
        //由于yii内置的memcache无法设置时间，所以自己改装一下
        self::build()->set($key.self::$cacheTimeKey, time()+$expire);
        self::build()->set($key, $value);
    }

    /**
     * 删除缓存
     * @return mixed
     */
    public static function del($key)
    {
        self::build()->delete($key);
    }

    /**
     * 清空缓存
     * @return mixed
     */
    public static function clear()
    {
        self::build()->flush();
    }


}
