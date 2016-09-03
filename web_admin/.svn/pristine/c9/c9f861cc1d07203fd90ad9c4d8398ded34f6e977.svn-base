<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 商品类
 */
namespace common\cache;

use common\vendor\request\RequestLib;
use Yii;

/**
 * shop model
 */
class WechatCache extends BaseCache
{

    const ENCODING_AES_KEY  = "1234567891123456789112345678911234567891abc" ;
    const TOKEN = "devnewwx";
    const APP_ID = "wx7313c89076b1d59f";
    const APP_SECRET = "0c79e1fa963cd80cc0be99b20a18faeb";

    # 类缓存前缀
    const CACHE_KEY_PRE  = 'wechat_';
    # 缓存模块
    const CACHE_KEY_TOKEN = 'token_';
    const TICKET = 'ComponentVerifyTicket_';
    const PREAUTHCODE = 'pre_auth_code_';
    const AUTHORIZATION_CODE = 'authorization_code_';
    const AUTH_INFO= 'auth_info_';


    /**
     * 设置ticket
     * @return mixed
     */
    public static function setTicket($ticket){
        $cacheKey = self::CACHE_KEY_PRE.self::TICKET;
        BaseCache::set($cacheKey,$ticket,1800);
    }

    /**
     * 获取ticket
     * @return mixed
     */
    public static function getTicket(){
        $cacheKey = self::CACHE_KEY_PRE.self::TICKET;
        return BaseCache::get($cacheKey);
    }

//    /**
//     * 获取第三方平台的token，
//     * @return mixed
//     */
//    public static function getToken(){
//        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_TOKEN;
//        $token = BaseCache::get($cacheKey);
//        if ($token !== false)  {
//            return $token;
//        }
//        $postUrl = 'https://api.weixin.qq.com/cgi-bin/component/api_component_token';
//        $postParams = [
//            'component_appid' => self::APP_ID,
//            'component_appsecret' =>  self::APP_SECRET ,
//            'component_verify_ticket' => self::getTicket(),
//        ];
//        $result = RequestLib::http_post($postUrl,$postParams);
//        if ($result)
//        {
//            $json = json_decode($result,true);
//            if (!$json || isset($json['errcode'])) {
//                BaseCache::append('test_cache',$json);
//                return false;
//            }
//            $access_token = $json['component_access_token'];
//            $expire = $json['expires_in'] ? intval($json['expires_in'])-100 : 3600;
//            BaseCache::set($cacheKey,$access_token,$expire);
//            return $access_token;
//        }
//        return false;
//    }

    /**
     * 获取第三方平台的 pre_auth_code，
     * @return mixed
     */
    public static function getPreAuthCode(){
        $postParams = ['component_appid' => self::APP_ID];
        $cacheKey = self::CACHE_KEY_PRE.self::PREAUTHCODE;
        $token = BaseCache::get($cacheKey);
        if ($token !== false)  {
          return $token;
        }
        $postUrl = 'https://api.weixin.qq.com/cgi-bin/component/api_create_preauthcode?component_access_token='.self::getToken();
        $result = RequestLib::http_post($postUrl,$postParams);
        if ($result)
        {
            $json = json_decode($result,true);
            if (!$json || isset($json['errcode'])) {
//                BaseCache::append('test_cache',$json);
                return false;
            }
            $preAuthCode = $json['pre_auth_code'];
            $expire = $json['expires_in'] ? intval($json['expires_in'])-100 : 560;
            BaseCache::set($cacheKey,$preAuthCode,$expire);
            return $preAuthCode;
        }
        return false;
    }

    /**
     * 设置授权 authorization_code
     * @return mixed
     */
    public static function setAuthorizationCode($code){
        $cacheKey = self::CACHE_KEY_PRE.self::AUTHORIZATION_CODE;
        BaseCache::set($cacheKey,$code,1800);
    }

    /**
     * 获取授权 authorization_code
     * @return mixed
     */
    public static function getAuthorizationCode()
    {
        $cacheKey = self::CACHE_KEY_PRE.self::AUTHORIZATION_CODE;
        return BaseCache::get($cacheKey);
    }

    /**
     * 获取公众号授权信息
     * @return mixed
     */
    public static function getAuthInfo(){
        $postParams = [
            'component_appid' => self::APP_ID ,
            'authorization_code' => self::getAuthorizationCode() ,
        ];
        $cacheKey = self::CACHE_KEY_PRE.self::AUTH_INFO;
        $token = BaseCache::get($cacheKey);
        if ($token !== false)  {
            return $token;
        }
        $postUrl = 'https://api.weixin.qq.com/cgi-bin/component/api_query_auth?component_access_token='.self::getToken();
        $result = RequestLib::http_post($postUrl,$postParams);
        if ($result)
        {
            $json = json_decode($result,true);
            if (!$json || isset($json['errcode'])) {
//                BaseCache::append('test_cache',$json);
                return false;
            }
            BaseCache::set($cacheKey,$json,108640);
            return $json;
        }
        return false;
    }

    /**
     * 获取（刷新）授权公众号的令牌，
     * @return mixed
     */
    public static function refreshAuthorizerAccessToken($authorizerAppid,$authorizerRefreshToken){
        $postParams = [
            'component_appid' => self::APP_ID ,
            'authorizer_appid' => $authorizerAppid ,
            'authorizer_refresh_token' => $authorizerRefreshToken
        ];
        $postUrl = 'https://api.weixin.qq.com/cgi-bin/component/api_authorizer_token?component_access_token='.self::getToken();
        $result = RequestLib::http_post($postUrl,$postParams);
//        BaseCache::append('test_cache',1);
        if ($result)
        {
//            BaseCache::append('test_cache',2);
            $json = json_decode($result,true);
            if (!$json || isset($json['errcode'])) {
//                BaseCache::append('test_cache',$json);
//                BaseCache::append('test_cache',4);
                return false;
            }
//            BaseCache::append('test_cache',3);
            return $json;
        }
//        BaseCache::append('test_cache',5);
        return false;
    }

    /**
     * 获取授权方的账户信息
     * @return mixed
     */
    public static function getAuthorizerInfo($authorizerAppid){
        $postParams = [
            'component_appid' => self::APP_ID ,
            'authorizer_appid' => $authorizerAppid ,
        ];
        $postUrl = 'https://api.weixin.qq.com/cgi-bin/component/api_get_authorizer_info?component_access_token='.self::getToken();
        $result = RequestLib::http_post($postUrl,$postParams);
        if ($result)
        {
            $json = json_decode($result,true);
            if (!$json || isset($json['errcode'])) {
//                BaseCache::append('test_cache',$json);
                return false;
            }
            return $json;
        }
        return false;
    }

    /**
     * 获取token，这个是老接口的
     * @return mixed
     */
    public static function getToken($appid,$appsecret,$isFlash = false){
        $cacheKey = self::_getTokenCacheKey($appid, $appsecret);
        $token = Yii::$app->getCache()->get($cacheKey);
        if ($token !== false && !$isFlash)  {
            if(isset($token['access_token'])) return $token['access_token'];
        }
        $result = RequestLib::http_get('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret);
        if ($result){
            $json = json_decode($result,true);
            if (!$json || isset($json['errcode'])) {
                return false;
            }
            $access_token = $json['access_token'];
            $expire = $json['expires_in'] ? intval($json['expires_in'])-600 : 3000;
            //BaseCache::set($cacheKey,$access_token,$expire);
            Yii::$app->getCache()->set($cacheKey,$json,$expire);
            /**
             * token获取次数计数测试
             */
            $count = WechatCache::get('token_' . $appid . 'count');
            WechatCache::set('token_' . $appid . 'count', $count ? ++$count : 1, 0);
            return $access_token;
        }
        return false;
    }

    /**
     * 删除token
     * @return mixed
     */
    public static function delToken($appid, $appsecret){
        $cacheKey = self::_getTokenCacheKey($appid, $appsecret);
        BaseCache::del($cacheKey);
    }

    /**
     * 获取Token cache Key
     * 和接口token key保持一致
     * @param $appid
     * @param $appsecret
     * @return string
     */
    private static function _getTokenCacheKey($appid,$appsecret){
        return self::CACHE_KEY_TOKEN.$appid;
    }
}
