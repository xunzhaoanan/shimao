<?php
/**
 * Author: MaChenghang
 * Date: 2015/10/22
 * Time: 22:08
 */

namespace common\helpers;
use common\cache\Session;
use Yii;

class WeixinFunctionHelper
{

    const ROUTE_LOGIN = 'login/index';
    const ROUTE_ERROR = 'mall/error';

    /**
     * 是否为游客可以访问的页面
     */
    public static function isVisitorRoute($route){
        $visitorRoute = ['sso/oauth'];
        if(in_array($route,$visitorRoute)){
            return true;
        }
        return false;
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


}