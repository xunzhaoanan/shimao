<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */

namespace common\models;

use common\cache\Session;
use common\cache\TerminalCache;
use Yii;

/**
 * shop model
 */
class Terminal extends BaseModel
{
    //店铺类型:直营店。加盟店
    const SHOP_TYPE_STORE = 1;
    const SHOP_TYPE_STORE_ITS_FRANCHISEES = 2;


    //微信创建门店状态(同步微信门店)  1未同步 2审核中 3创建成功 4创建失败
    const AVAILABLE_STATUS_UNSYNCHRONIZED = 1;
    const AVAILABLE_STATUS_PENDING = 2;
    const AVAILABLE_STATUS_SYNCHRONIZING_SUCCESS = 3;
    const AVAILABLE_STATUS_SYNCHRONIZING_FAIL = 4;


    protected $terminalCache ;

    public function init()
    {
        $this->terminalCache = new TerminalCache();
    }

    /**
     * 添加店铺信息
     * @return mixed
     */
    public function updateSetting($params){
        $this->terminalCache->delCache($params);
        $this->getResult('terminal-setting-update',$params);
    }

    /**
     * 添加店铺信息
     * @return mixed
     */
    public function create($params){
        //拿接口数据
        $apiParams = [
            'shopSub' => isset($params['shopSub']) ? $params['shopSub'] : null,
            'shopInfo' => isset($params['shopInfo']) ? $params['shopInfo'] : null,
            'shopStaff' => isset($params['shopStaff']) ? $params['shopStaff'] : null,
        ];
        $this->getResult('terminal-create',$apiParams);
    }

    /**
     * 获取店铺信息列表
     * @return mixed
     */
    public function find($params){
        $this->getResult('terminal-list',$params);
    }

    /**
     * 获取店铺信息列表
     * @return mixed
     */
    public function findBelong($params){
        //拿接口数据
        $apiParams = [
            'ids' => isset($params['ids']) ? $params['ids'] : null,//数组
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'shop_type' => isset($params['shop_type']) ? $params['shop_type'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'province_id' => isset($params['province_id']) ? $params['province_id'] : null,
            'district_id' => isset($params['district_id']) ? $params['district_id'] : null,
            'city_id' => isset($params['city_id']) ? $params['city_id'] : null,
            'available_status' => isset($params['available_status']) ? $params['available_status'] : null,
            'belong_to_staff_id' => isset($params['belong_to_staff_id']) ? $params['belong_to_staff_id'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null
        ];
        $this->getResult('terminal-list-belong',$apiParams);
    }

    /**
     * 获取店铺信息
     * @return mixed
     */
    public function addScanCount($params){
        $this->postDataOnly('terminal-add-scan-count',$params);
    }

    /**
     * 获取店铺信息
     * @return mixed
     */
    public function get($params){
        $this->getResult('terminal-get',$params);
    }

    /**
     * 删除店铺信息
     * @return mixed
     */
    public function del($params){
        $this->terminalCache->delCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,

        ];
        $this->getResult('terminal-del',$apiParams);
    }

    /**
     * 修改店铺信息
     * @return mixed
     */
    public function update($params){
        //转换缓存处理需要的参数
        $params += [
            'shop_id' => $params['shopSub']['shop_id'],
            'shop_sub_id' => $params['shopSub']['id']
        ];
        $this->terminalCache->delCache($params);
        //拿接口数据
        $apiParams = [
            'shopSub' => [
                'id' => isset($params['shopSub']['id']) ? $params['shopSub']['id'] : null,
                'shop_id' => isset($params['shopSub']['shop_id']) ? $params['shopSub']['shop_id'] : null,
                'agent_id' => isset($params['shopSub']['agent_id']) ? $params['shopSub']['agent_id'] : null,
                'sync_setting' => isset($params['shopSub']['sync_setting']) ? $params['shopSub']['sync_setting'] : null,
                'lng' => isset($params['shopSub']['lng']) ? $params['shopSub']['lng'] : null,
                'lat' => isset($params['shopSub']['lat']) ? $params['shopSub']['lat'] : null,
                'shop_path' => isset($params['shopSub']['shop_path']) ? $params['shopSub']['shop_path'] : null,
                'shop_type' => isset($params['shopSub']['shop_type']) ? $params['shopSub']['shop_type'] : null,
                'is_pickup_shop' => isset($params['shopSub']['is_pickup_shop']) ? $params['shopSub']['is_pickup_shop'] : null
            ],
            'shopInfo' => [
                'name' => isset($params['shopInfo']['name']) ? $params['shopInfo']['name'] : null,
                'phone' => isset($params['shopInfo']['phone']) ? $params['shopInfo']['phone'] : null,
                'province_id' => isset($params['shopInfo']['province_id']) ? $params['shopInfo']['province_id'] : null,
                'city_id' => isset($params['shopInfo']['city_id']) ? $params['shopInfo']['city_id'] : null,
                'district_id' => isset($params['shopInfo']['district_id']) ? $params['shopInfo']['district_id'] : null,
                'address' => isset($params['shopInfo']['address']) ? $params['shopInfo']['address'] : null,
                'circle_id' => isset($params['shopInfo']['circle_id']) ? $params['shopInfo']['circle_id'] : null,
                'businesshour' => isset($params['shopInfo']['businesshour']) ? $params['shopInfo']['businesshour'] : null,
                'url' => isset($params['shopInfo']['url']) ? $params['shopInfo']['url'] : null,
                'bg_img' => isset($params['shopInfo']['bg_img']) ? $params['shopInfo']['bg_img'] : null,
                'description' => isset($params['shopInfo']['description']) ? $params['shopInfo']['description'] : null,
                'theme' => isset($params['shopInfo']['theme']) ? $params['shopInfo']['theme'] : null,
                'lbs' => isset($params['shopInfo']['lbs']) ? $params['shopInfo']['lbs'] : null,
                'site_img' => isset($params['shopInfo']['site_img']) ? $params['shopInfo']['site_img'] : null,
                'ewm_img' => isset($params['shopInfo']['ewm_img']) ? $params['shopInfo']['ewm_img'] : null,
                'scene_id' => isset($params['shopInfo']['scene_id']) ? $params['shopInfo']['scene_id'] : null,
                'category_del_id' => isset($params['shopInfo']['category_del_id']) ? $params['shopInfo']['category_del_id'] : null,
                'wx_categories' => isset($params['shopInfo']['wx_categories']) ? json_encode($params['shopInfo']['wx_categories']) : null,
                'recommend' => isset($params['shopInfo']['recommend']) ? $params['shopInfo']['recommend'] : null,
                'special' => isset($params['shopInfo']['special']) ? $params['shopInfo']['special'] : null,
                'avg_price' => isset($params['shopInfo']['avg_price']) ? $params['shopInfo']['avg_price'] : null
            ]
        ];
        $this->getResult('terminal-update',$apiParams);
        //重设终端店session
        if( is_null($this->getError())){
            Session::set(Session::SESSION_KEY_SHOPINFO,$this->_data['shopInfo']);
            Session::set(Session::SESSION_KEY_SHOPSUB,$this->_data['shopSub']);
        }
    }


    /**
     * 更新shop_info 店铺二维码信息
     * @return mixed
     */
    public function updateShopInfoEwm($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'scene_id' => isset($params['scene_id']) ? $params['scene_id'] : null,
            'ewm_img' => isset($params['ewm_img']) ? $params['ewm_img'] : null
        ];
        $this->getResult('terminal-update-ewm', $apiParams);
    }

    /**
     * 全店推广员总数
     * @return mixed
     */
    public function fxMemberCount($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_count_type' => isset($params['shop_count_type']) ? $params['shop_count_type'] : null,
            'agent_ids' => isset($params['agent_ids']) ? $params['agent_ids'] : null,
            'start' => isset($params['start']) ? $params['start'] : null,
            'end' => isset($params['end']) ? $params['end'] : null,
            'kind' => isset($params['kind']) ? $params['kind'] : null
        ];
        $this->getResult('terminal-fx-member-count',$apiParams);
    }

    /**
     * 统计单个代理商下门店数量
     * @param $params
     */
    public function countTerminal($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_type' => isset($params['shop_type']) ? $params['shop_type'] : null, //店铺类型：加盟店和直营店
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'sub_kind' => isset($params['sub_kind']) ? $params['sub_kind'] : null
        ];
        $this->getResult('terminal-shop-sub-count',$apiParams);
    }

    /**
     * 统计多个代理商下直属门店数量
     * agent_id array类型
     * @param $params
     */
    public function countTerminalList($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null
        ];
        $this->getResult('terminal-shop-sub-count-list',$apiParams);
    }

    /**
     * 获取最近的门店列表
     * @param $params
     */
    public function getNearestTerminalList($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'lat' => isset($params['lat']) ? $params['lat'] : null,
            'lng' => isset($params['lng']) ? $params['lng'] : null,
            'count' => isset($params['count']) ? $params['count'] : 6
        ];
        $this->getResult('terminal-nearest-list',$apiParams);
    }

}
