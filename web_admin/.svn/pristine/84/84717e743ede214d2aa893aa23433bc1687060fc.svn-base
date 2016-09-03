<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 会员类
 */
namespace common\models;

use common\cache\MemberCache;
use Yii;
use yii\base\Model;

/**
 * YeahWifi model
 */
class YeahWifi extends BaseModel
{

    //wifi AP 当前最新版本号
    public static $device_version = 'B1601D02';

    //AP 设备状态 1不需要升级，2需要升级，3不在线
    const AP_STATUS_NORMAL = 1;
    const AP_STATUS_NEED_UPDATE = 2;
    const AP_STATUS_NOT_ONLINE = 3;

    /**
     * YeahWifi列表
     * @param $params
     * @return mixed
     */
    public function find($params,$is_search = false)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'shop_name' => isset($params['shop_name']) ? $params['shop_name'] : null
        ];
        $this->getResult('yeah-wifi-list',$apiParams);
    }

    /**
     * 直营店列表
     * @param $params
     */
    public function shopList($params)
    {
        $apiParams = [
            'name' => isset($params['name']) ? $params['name'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'available_status' => isset($params['available_status']) ? $params['available_status'] : null,
            'wifi_shop_id_status' => isset($params['wifi_shop_id_status']) ? $params['wifi_shop_id_status'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
        ];
        $this->getResult('terminal-list',$apiParams);
    }

    /**
     * 修改wifi信息
     * @param $params
     * @return mixed
     */
    public function update($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'comment' => isset($params['comment']) ? $params['comment'] : null,
            'ssid' => isset($params['ssid']) ? $params['ssid'] : null,
            'brand_name' => isset($params['brand_name']) ? $params['brand_name'] : null,
            'action_code' => isset($params['action_code']) ? $params['action_code'] : null,
            'ad_page_url' => isset($params['ad_page_url']) ? $params['ad_page_url'] : null,
            'portal_page_url' => isset($params['portal_page_url']) ? $params['portal_page_url'] : null,
            'appid' => isset($params['appid']) ? $params['appid'] : null,
            'model' => isset($params['model']) ? $params['model'] : null,
            'model_id' => isset($params['model_id']) ? $params['model_id'] : null,
            'bar_type' => isset($params['bar_type']) ? $params['bar_type'] : null,
        ];
        $this->getResult('yeah-wifi-update',$apiParams);
    }

    /**
     * 获取wifi详情
     * @param $params
     * @return mixed
     */
    public function get($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? intval($params['shop_id']) : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'mac_addr' => isset($params['deviceNo']) ? $params['deviceNo'] : null
        ];
        $this->getResult('yeah-wifi-get',$apiParams);

    }

    /**
     * 获取拦截页模板列表
     * @param $params
     * @return mixed
     */
    public function find_portal($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('yeah-wifi-portal',$apiParams);

    }

    /**
     * 获取action_bar列表
     * @param $params
     * @return mixed
     */
    public function find_bar_list($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('yeah-wifi-action-bar',$apiParams);

    }

    /**
     * 获取微信门店wifi ssid
     * @param $params
     */
    public function get_wx_wifi_ssid($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('yeah-wifi-get-ssid',$apiParams);
    }

    /**
     * 获取wifi和公众号信息
     * @param $params
     */
    public function get_wifi_info_with_other($params){
        $this->getResult('yeah-wifi-get-info-with-other', $params);
    }

    /**
     * 获取wifi统计列表信息
     * @param $params
     */
    public function find_wifi_statistics_list($params){
        $this->getResult('yeah-wifi-find-statistics-list', $params);
    }

    /**
     * wifi ap update
     * @param $params
     */
    public function wifi_ap_update($params){
        $this->getResult('yeah-wifi-ap-update', $params);
    }

    /**
     * 获取wifi ap info
     * @param $params
     */
    public function get_wifi_ap_info($params){
        $this->getResult('yeah-wifi-get-ap-info', $params);
    }

    /**
     *
     * @param $params
     */
    public function update_wx_wifi_shop($params){
        $this->getResult('yeah-wifi-get-wx-wifi-shop', $params);
    }
}
