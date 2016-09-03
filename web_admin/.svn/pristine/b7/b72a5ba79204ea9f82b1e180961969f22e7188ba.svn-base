<?php
/**
 * 微信公众平台自定义菜单
 * Author: MaChenghang
 * Date: 2015/06/20
 * Time: 11:47
 */

namespace common\vendor\wechat;

use common\models\WxMenu;
use common\vendor\wechat\wechat_sdk\Wechat;

class WechatMenu extends Wechat{

    protected $wechatSDK ;

    function __construct($options){
        $this->wechatSDK = new Wechat($options);
    }

    /**
     * 创建菜单(认证后的订阅号可用)
     * @param array $data 菜单数组数据
     * example:
     * 	array (
     * 	    'button' => array (
     * 	      0 => array (
     * 	        'name' => '扫码',
     * 	        'sub_button' => array (
     * 	            0 => array (
     * 	              'type' => 'scancode_waitmsg',
     * 	              'name' => '扫码带提示',
     * 	              'key' => 'rselfmenu_0_0',
     * 	            ),
     * 	            1 => array (
     * 	              'type' => 'scancode_push',
     * 	              'name' => '扫码推事件',
     * 	              'key' => 'rselfmenu_0_1',
     * 	            ),
     * 	        ),
     * 	      ),
     * 	      1 => array (
     * 	        'name' => '发图',
     * 	        'sub_button' => array (
     * 	            0 => array (
     * 	              'type' => 'pic_sysphoto',
     * 	              'name' => '系统拍照发图',
     * 	              'key' => 'rselfmenu_1_0',
     * 	            ),
     * 	            1 => array (
     * 	              'type' => 'pic_photo_or_album',
     * 	              'name' => '拍照或者相册发图',
     * 	              'key' => 'rselfmenu_1_1',
     * 	            )
     * 	        ),
     * 	      ),
     * 	      2 => array (
     * 	        'type' => 'location_select',
     * 	        'name' => '发送位置',
     * 	        'key' => 'rselfmenu_2_0'
     * 	      ),
     * 	    ),
     * 	)
     * type可以选择为以下几种，其中5-8除了收到菜单事件以外，还会单独收到对应类型的信息。
     * 1、click：点击推事件
     * 2、view：跳转URL
     * 3、scancode_push：扫码推事件
     * 4、scancode_waitmsg：扫码推事件且弹出“消息接收中”提示框
     * 5、pic_sysphoto：弹出系统拍照发图
     * 6、pic_photo_or_album：弹出拍照或者相册发图
     * 7、pic_weixin：弹出微信相册发图器
     * 8、location_select：弹出地理位置选择器
     */
    public function createMenus($data,$wxconfig){
        $menuData = [];
        $parentsId = 0;
        foreach($data as $val){
            $menuData['button'][$parentsId]['name'] = $val['parents']['menuname'];
            if(isset($val['child'])) {
                foreach ($val['child'] as $childVal) {
                    if($childVal['menu_type'] == WxMenu::MENU_TYPE_CLICK || $childVal['menu_type'] == WxMenu::MENU_TYPE_MODEL){
                        $menuKey = 'key';
                        $menuValue = $childVal['menu_type'].'_'.json_encode($childVal['menu_url']);
                    }else{
                        $menuKey = 'url';
                        if(strpos($childVal['menu_url'],'http') === false){
                            $menuValue = getMobileSite().$childVal['menu_url'];
                        }else{
                            $menuValue = $childVal['menu_url'];
                        }
                    }
                    $menuData['button'][$parentsId]['sub_button'][] = [
                        'type' => WxMenu::$menuType[$childVal['menu_type']],
                        'name' => $childVal['menuname'],
                        $menuKey => $menuValue
                    ];
                }
            }else{
                $childVal = $val['parents'];
                if($childVal['menu_type'] == WxMenu::MENU_TYPE_CLICK || $childVal['menu_type'] == WxMenu::MENU_TYPE_MODEL){
                    $menuKey = 'key';
                    $menuValue = $childVal['menu_type'].'_'.json_encode($childVal['menu_url']);
                }else{
                    $menuKey = 'url';
                    if(strpos($childVal['menu_url'],'http') === false){
                        $menuValue = getMobileSite().$childVal['menu_url'];
                    }else{
                        $menuValue = $childVal['menu_url'];
                    }
                }
                $menuData['button'][$parentsId] = [
                    'type' => WxMenu::$menuType[$childVal['menu_type']],
                    'name' => $childVal['menuname'],
                    $menuKey => $menuValue
                ];
            }
            $parentsId++;
        }
        return $this->wechatSDK->createMenu($menuData);
    }

    /**
     * 获取菜单(认证后的订阅号可用)
     * @return array('menu'=>array(....s))
     */
    public function getMenu(){
        return $this->wechatSDK->getMenu();
    }

    /**
     * 删除菜单(认证后的订阅号可用)
     * @return boolean
     */
    public function deleteMenu(){
        return $this->wechatSDK->deleteMenu();
    }


    /**
     * 获取自定义菜单的扫码推事件信息
     *
     * 事件类型为以下两种时则调用此方法有效
     * Event	 事件类型，scancode_push
     * Event	 事件类型，scancode_waitmsg
     *
     * @return: array | false
     * array (
     *     'ScanType'=>'qrcode',
     *     'ScanResult'=>'123123'
     * )
     */
    public function getRevScanInfo(){
        return $this->wechatSDK->getRevScanInfo();
    }

    /**
     * 获取自定义菜单的图片发送事件信息
     *
     * 事件类型为以下三种时则调用此方法有效
     * Event	 事件类型，pic_sysphoto        弹出系统拍照发图的事件推送
     * Event	 事件类型，pic_photo_or_album  弹出拍照或者相册发图的事件推送
     * Event	 事件类型，pic_weixin          弹出微信相册发图器的事件推送
     *
     * @return: array | false
     * array (
     *   'Count' => '2',
     *   'PicList' =>array (
     *         'item' =>array (
     *             0 =>array ('PicMd5Sum' => 'aaae42617cf2a14342d96005af53624c'),
     *             1 =>array ('PicMd5Sum' => '149bd39e296860a2adc2f1bb81616ff8'),
     *         ),
     *   ),
     * )
     *
     */
    public function getRevSendPicsInfo(){
        return $this->wechatSDK->getRevSendPicsInfo();
    }

    /**
     * 获取自定义菜单的地理位置选择器事件推送
     *
     * 事件类型为以下时则可以调用此方法有效
     * Event	 事件类型，location_select        弹出地理位置选择器的事件推送
     *
     * @return: array | false
     * array (
     *   'Location_X' => '33.731655000061',
     *   'Location_Y' => '113.29955200008047',
     *   'Scale' => '16',
     *   'Label' => '某某市某某区某某路',
     *   'Poiname' => '',
     * )
     *
     */
    public function getRevSendGeoInfo(){
        return $this->wechatSDK->getRevSendGeoInfo();
    }


}
