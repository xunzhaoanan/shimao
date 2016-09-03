<?php
/**
 * 微信公众平台授权相关
 * Author: MaChenghang
 * Date: 2015/06/20
 * Time: 11:47
 */

namespace common\vendor\wechat;

use common\vendor\wechat\wechat_sdk\Wechat;
use common\cache\BaseCache;

class WechatOauth

{
    protected $wechatSDK ;

    function __construct($options){
        $this->wechatSDK = new Wechat($options);
    }

    /**
     * 校验接入微信
     */
    public function validation(){
        return $this->wechatSDK->validation();
    }


    /**
     * 获取access_token
     * @param string $appid 如在类初始化时已提供，则可为空
     * @param string $appsecret 如在类初始化时已提供，则可为空
     * @param string $token 手动指定access_token，非必要情况不建议用
     */
    public function checkAuth($appid='',$appsecret='',$token=''){
        return $this->wechatSDK->checkAuth($appid,$appsecret,$token);
    }

    /**
     * 删除验证数据
     * @param string $appid
     */
    public function resetAuth($appid=''){
        return $this->wechatSDK->resetAuth($appid);
    }

    /**
     * 删除JSAPI授权TICKET
     * @param string $appid 用于多个appid时使用
     */
    public function resetJsTicket($appid=''){
        return $this->wechatSDK->resetJsTicket($appid);
    }

    /**
     * 获取JSAPI授权TICKET
     * @param string $appid 用于多个appid时使用,可空
     * @param string $jsapi_ticket 手动指定jsapi_ticket，非必要情况不建议用
     */
    public function getJsTicket($appid='',$jsapi_ticket=''){
        return $this->wechatSDK->getJsTicket($appid,$jsapi_ticket);
    }


    /**
     * 获取JsApi使用签名
     * @param string $url 网页的URL，自动处理#及其后面部分
     * @param string $timestamp 当前时间戳 (为空则自动生成)
     * @param string $noncestr 随机串 (为空则自动生成)
     * @param string $appid 用于多个appid时使用,可空
     * @return array|bool 返回签名字串
     */
    public function getJsSign($url, $timestamp=0, $noncestr='', $appid=''){
        $cacheKey = 'js_sign_'.md5($url);
        $data = $this->wechatSDK->getJsSign($url,$timestamp,$noncestr,$appid);
        BaseCache::set($cacheKey,$data,7000);
        return $data;
    }

    /**
     * oauth 授权跳转接口
     * @param string $callback 回调URI
     * @return string
     */
    public function getOauthRedirect($callback,$state='',$scope='snsapi_userinfo'){
        return $this->wechatSDK->getOauthRedirect($callback,$state,$scope);
    }

    /**
     * 通过code获取Access Token
     * @return array {access_token,expires_in,refresh_token,openid,scope}
     */
    public function getOauthAccessToken(){
        return $this->wechatSDK->getOauthAccessToken();
    }

    /**
     * 刷新access token并续期
     * @param string $refresh_token
     * @return boolean|mixed
     */
    public function getOauthRefreshToken($refresh_token){
        return $this->wechatSDK->getOauthRefreshToken($refresh_token);
    }

    /**
     * 获取授权后的用户资料
     * @param string $access_token
     * @param string $openid
     * @return array {openid,nickname,sex,province,city,country,headimgurl,privilege,[unionid]}
     * 注意：unionid字段 只有在用户将公众号绑定到微信开放平台账号后，才会出现。建议调用前用isset()检测一下
     */
    public function getOauthUserinfo($access_token,$openid){
        return $this->wechatSDK->getOauthUserinfo($access_token,$openid);
    }

    /**
     * 检验授权凭证是否有效
     * @param string $access_token
     * @param string $openid
     * @return boolean 是否有效
     */
    public function getOauthAuth($access_token,$openid){
        return $this->wechatSDK->getOauthAuth($access_token,$openid);
    }


}
