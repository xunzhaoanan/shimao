<?php
/**
 * Author: MaChenghang
 * Date: 2015/10/22
 * Time: 22:08
 */

namespace common\helpers;
use common\cache\Session;
use Yii;

class ShanghuFunctionHelper
{

    const ROUTE_LOGIN = 'login/index';
    const ROUTE_ERROR = 'shop/error';

    private static $_shop = null;
    private static $_platformWx  = null;

    /**
     * 获取管理员信息
     */
    public static function isVisitorRoute($route){
        $visitorRoute = ['wrong/index'];
        if(in_array($route,$visitorRoute)){
            return true;
        }
        return false;
    }

    /**
     * 获取管理员信息
     */
    public static function getManager(){
        return Session::get(Session::SESSION_KEY_MANAGER);
    }

    /**
     * 设置管理员信息
     */
    public static function setManager($manager){
        Session::set(Session::SESSION_KEY_MANAGER,$manager);
    }


    /**
     * 设置当前商家信息
     */
    public static function setShop($shop){
        self::$_shop = $shop;
    }

    /**
     * 获取当前商家信息
     */
    public static function getShop(){
        if(is_null(self::$_shop)){
            JsApiHelper::setError('未设置商家数据',JsApiCodeHelper::CODE_ERROR_SYSTEM);
        }
        return self::$_shop;
    }

    /**
     * 设置当前商家微信平台信息
     */
    public static function setPlatformWx($platformWx){
        self::$_platformWx = $platformWx;
    }

    /**
     * 获取当前商家微信平台信息
     */
    public static function getPlatformWx(){
        if(is_null(self::$_platformWx)){
            JsApiHelper::setError('未设置商家微信平台数据',JsApiCodeHelper::CODE_ERROR_SYSTEM);
        }
        return self::$_platformWx;
    }

    /**
     * 跳转到登陆页面
     */
    public static function redirectToLogin(){
        CommonFunctionHelper::redirect('http://'.PC_SITE.'/'.self::ROUTE_LOGIN);
    }

    /**
     * 跳转到错误页面
     */
    public static function redirectToError(){
        CommonFunctionHelper::redirect('http://'.PC_SITE.self::ROUTE_ERROR);
    }


// ************************* 待调整  ***********************************************************************************************
//    /**
//     * 跳转到手机端
//     */
//    public static function redirectToMobile(){
//        CommonFunctionHelper::redirect('http://'.MOBILE_HOST.'/mall/index');
//    }
//
//    /**
//     * 跳转到商家系统
//     */
//    public static function redirectToShanghu(){
//        CommonFunctionHelper::redirect('http://'.MOBILE_HOST.'/mall/index');
//    }
//
//    /**
//     * 跳转到代理商系统
//     */
//    public static function redirectToAgent(){
//        CommonFunctionHelper::redirect('http://'.AGENT_HOST);
//    }
//
//    /**
//     * 跳转到终端店系统
//     */
//    public static function redirectToShop(){
//        CommonFunctionHelper::redirect('http://'.SHOP_HOST);
//    }


}