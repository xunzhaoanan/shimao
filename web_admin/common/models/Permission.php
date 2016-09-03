<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/19
 * Time: 10:36
 */


namespace common\models;

use Yii;


/**
 * shop model
 */
class Permission extends BaseModel
{

    /**
     * 商家系统忽略列表
     * 控制器对应的值 ， 为 true 时，表示忽略整个控制器， 为数组时，表示只忽略控制器的方法列表
     */
    public static $ignoreListByadmin = array(
        'shop' => ['index','edit-manager-pwd','edit-manager-pwd-ajax','error','get-ajax'],
        'weixin' => ['qrcode-detail-ajax'],
       // 'permission' => true,
        'common' => true,
        'page' => ['category-list-ajax'],
        'errors' => true,
        'terminal' => ['detail-ajax'],
        'qrcode' => true,
        'test' => true,
        'login' => true,
        'captcha' => true,
        'data' => ['order-shop','order-by-shop-ajax','member-shop','member-by-shop-ajax','fx-shop','fx-by-shop-ajax'],
        'magazine' => ['left'],
        'activity' => ['qrcode', 'qrcode-ajax'],
        'zip' => true,
        'cash-redpack' => ['help'],
        'export' => ['down-all', 'waiting', 'waiting-ajax','waiting-qrcode-ajax','download-qrcode-zip'],
        'new-export' => ['down-all', 'waiting', 'waiting-ajax','waiting-qrcode-ajax','download-qrcode-zip'],
        'order' => ['logisticsmodel']
    );

    /**
     * 特殊通用权限处理列表
     */
    public static $specialIgnoreListByadmin = array(
        'terminal/list-ajax','card-coupons/shop-sub-list-ajax','member/shop-by-agent-ajax', 'agent/list-ajax', 'wxmaterial/wx-image-list-ajax', 'document/ueditor',
        'shop/get-ajax','staff/list-ajax','member/list-ajax','member/find-group','document/find-category-ajax','member/count-wx-member','agent/all-list-ajax'
    );

    /**
     * 终端店系统忽略列表
     * 控制器对应的值 ， 为 true 时，表示忽略整个控制器， 为数组时，表示只忽略控制器的方法列表
     */
    public static $ignoreListByShop = array(
        'shop' => ['index','get-ajax'],
        'common' => true,
        'errors' => true,
        'test' => true,
        'zip' => true,
        'login' => true,
        'qrcode' => true,
        'weixin' => ['qrcode-detail-ajax'],
    );

    /**
     * 代理商系统忽略列表
     * 控制器对应的值 ， 为 true 时，表示忽略整个控制器， 为数组时，表示只忽略控制器的方法列表
     */
    public static $ignoreListByAgent = array(
        'agent' => ['index'],
        'common' => true,
        'errors' => true,
        'test' => true,
        'zip' => true,
        'login' => true,
        'qrcode' => true,
    );

}
