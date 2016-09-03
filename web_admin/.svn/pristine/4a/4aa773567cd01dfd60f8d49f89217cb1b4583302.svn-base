<?php
/**
 * Author: MaChenghang
 * Date: 2015/07/04
 * Time: 15:00
 * session类
 */
namespace common\cache;

use Yii;

/**
 * session cache
 */
class Session
{
    //代理商信息
    const SESSION_KEY_AGENT = '_agent';
    //前台用户信息
    const SESSION_KEY_USER = '_user';
    //微信配置
    const SESSION_KEY_WXINFO = '_wxInfo';
    //分销员
    const SESSION_KEY_MEMBER = '_fx_member';
    //分销员
    const SESSION_KEY_FX_SHOP = '_fx_shop';
    //员工
    const SESSION_KEY_STAFF = '_staff';
    //管理员
    const SESSION_KEY_MANAGER = '_manager';
    //商家信息
    const SESSION_KEY_SHOP = '_shop';
    //商家信息
    const SESSION_KEY_PERMISSION = '_permission';
    //店铺详细信息
    const SESSION_KEY_SHOPINFO = '_shopInfo';
    //店铺主表信息
    const SESSION_KEY_SHOPSUB = '_shopSub';
    //验证码
    const SESSION_KEY_CAPTCHA = '_captcha';
    //用户菜单信息
    const SESSION_KEY_MENU = '_menu';
    //手机端底部
    const SESSION_KEY_MOBILE_FOOTER = '_mobile_footer';
    //手机端店铺信息
    const SESSION_KEY_MOBILE_SHOPINFO = '_mobile_shopInfo';


    public static function bulid(){
        return Yii::$app->session;
    }

    /**
     * 获取session
     * @return mixed
     */
    public static function get($key = null)
    {
        if(is_null($key)){
            return false;
        }
        return self::bulid()->get($key);
    }

    /**
     * 设置session
     * @return mixed
     */
    public static function set($key = null, $value = null)
    {
        if(is_null($key) || is_null($value)){
            return false;
        }
        return self::bulid()->set($key, $value);
    }

    /**
     * 删除session
     * @return mixed
     */
    public static function del($key = null)
    {
        if(is_null($key)){
            return false;
        }
        return self::bulid()->set($key, null);
    }

    /**
     * 注销session
     * @return mixed
     */
    public static function clear(){
        self::bulid()->open();
        self::bulid()->destroy();
        self::bulid()->close();
    }


}
