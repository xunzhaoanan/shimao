<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\newservices;


use common\cache\BaseCache;
use common\helpers\CommonFunctionHelper;
use common\services\member\MemberService;

class Sso extends BaseService
{

    const COOKIE_UID = 'WSHUID';
    const COOKIE_TOKEN = 'access_token';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 验证用户是否登陆
     */
    public function checkUserLogining(){
        if(isset($_COOKIE[self::COOKIE_UID]) && $_COOKIE[self::COOKIE_UID]){
            if(BaseCache::get($_COOKIE[self::COOKIE_UID])){
                $userCache = BaseCache::get($_COOKIE[self::COOKIE_UID]);
            }else{
                return false;
//                $this->setError('无效身份',JsApiCodeHelper::CODE_ERROR_LOGIN);
            }
        }else{
            return false;
//            $this->setError('请登录',JsApiCodeHelper::CODE_ERROR_LOGIN);
        }
        //登陆设备验证
        if($_SERVER['HTTP_USER_AGENT'] != $userCache['user_agent']){
            return false;
//            $this->setError('身份已过期',JsApiCodeHelper::CODE_ERROR_LOGIN);
        }
        //登陆身份验证
        if($userCache['access_token'] != $_COOKIE[self::COOKIE_TOKEN]){
            return false;
//            $this->setError('身份已过期',JsApiCodeHelper::CODE_ERROR_LOGIN);
        }
        return $userCache;
    }

    /**
     * 验证登陆用户状态是否异常
     */
    public function checkLoginingUserStatus($shopId){
        return true;
        if(($uid = $this->getLoginingUid()) === false){
            return '身份已过期，请重新登陆';
        };
        $memberService = new MemberService();
        $userInfo['shop_id'] = $shopId;
        $userInfo['user_id'] = $uid;
       //获取用户信息，检查用户状态 （是否被禁用、修改密码等）

        //正常情况下返回true
        return true;
    }

    /**
     * 获取当前登陆的用户信息
     */
    public function getLoginingUid(){
        $checkLogining = $this->checkUserLogining();
        if($checkLogining === false){
            return false;
        }else{
            return $checkLogining['uid'];
        }
    }

    /**
     * 设置用户为登陆状态，返回登陆跳转秘钥
     */
    public function setLoginSuccess($uid){
        $wshuid = md5(CommonFunctionHelper::getDevice().$uid);
        $accessToken = md5(time().rand(0,10000));
        BaseCache::set($wshuid,[self::COOKIE_UID=>$wshuid,self::COOKIE_TOKEN=>$accessToken,'user_agent' => $_SERVER['HTTP_USER_AGENT'],'uid'=>$uid],24*60*60);
        $jumpKey = md5($accessToken);
        BaseCache::set($jumpKey,[self::COOKIE_UID=>$wshuid,self::COOKIE_TOKEN=>$accessToken],600);
        return $jumpKey;
    }


    /**
     * 兑换跳转秘钥的数据
     */
    public function jumpKeyExchange($jumpKey){
        $data = BaseCache::get($jumpKey);
        if($data === false){
            return false;
        }
        //清除跳转key的有效性
        BaseCache::del($jumpKey);
        return [self::COOKIE_UID=>$data[self::COOKIE_UID],self::COOKIE_TOKEN=>$data[self::COOKIE_TOKEN]];
    }

}