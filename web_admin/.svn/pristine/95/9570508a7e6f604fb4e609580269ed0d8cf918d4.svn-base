<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/13
 * Time: 14:19
 */

namespace common\models;

use common\cache\UserCache;
use Yii;
use yii\base\Model;

/**
 * Common model
 */
class User extends BaseModel
{

    const REDPACK_USED = 1;
    const REDPACK_UN_USED = 2;
    //商城红包
    const REDPACK_TYPE_SHOP = 1;

    //启用的红包
    const REDPACK_OPEN = 1;

    protected $userCache;

    public function init()
    {
        $this->userCache = new UserCache();
    }

    /**
     * 拿到默认用户默认收货地址
     * @return mixed
     */
    public function getDefaultAddress($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'page' => 0,
            'count' => 1,
            'sortStr' => ['id' => 'desc']
        ];
        $this->getResult('user-address-find', $apiParams);
    }


    /**
     * 获取收货地址列表
     * @return mixed
     */
    public function findAddress($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'page' => 0,
            'count' => 100,//一次性取完
            // 只做倒序排序
            'sortStr' => ['id' => 'desc']
        ];
        $this->getResult('user-address-find', $apiParams);
    }

    /**
     * 获取收货地址
     * @return mixed
     */
    public function getAddress($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
        ];
        $this->getResult('user-address-get', $apiParams);
    }

    /**
     * 创建收货地址
     * @return mixed
     */
    public function createAddress($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'consignee' => isset($params['consignee']) ? $params['consignee'] : null,
            'tel' => isset($params['tel']) ? $params['tel'] : null,
            'zip' => isset($params['zip']) ? $params['zip'] : null,
            'province_id' => isset($params['province_id']) ? $params['province_id'] : null,
            'province' => isset($params['province']) ? $params['province'] : null,
            'city_id' => isset($params['city_id']) ? $params['city_id'] : null,
            'city' => isset($params['city']) ? $params['city'] : null,
            'county_id' => isset($params['county_id']) ? $params['county_id'] : null,
            'county' => isset($params['county']) ? $params['county'] : null,
            'detail' => isset($params['detail']) ? $params['detail'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'check_flag' => isset($params['check_flag']) ? true : false,
        ];
        $this->getResult('user-address-create', $apiParams);
    }

    /**
     * 修改收货地址
     * @return mixed
     */
    public function updateAddress($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'consignee' => isset($params['consignee']) ? $params['consignee'] : null,
            'tel' => isset($params['tel']) ? $params['tel'] : null,
            'zip' => isset($params['zip']) ? $params['zip'] : null,
            'province_id' => isset($params['province_id']) ? $params['province_id'] : null,
            'province' => isset($params['province']) ? $params['province'] : null,
            'city_id' => isset($params['city_id']) ? $params['city_id'] : null,
            'city' => isset($params['city']) ? $params['city'] : null,
            'county_id' => isset($params['county_id']) ? $params['county_id'] : null,
            'county' => isset($params['county']) ? $params['county'] : null,
            'detail' => isset($params['detail']) ? $params['detail'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
        ];
        $this->getResult('user-address-update', $apiParams);
    }

    /**
     * 获取用户红包详情
     * @return mixed
     */
    public function getRedpack($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
        ];
        $this->getResult('user-redpack-get', $apiParams);
    }

    /**
     * 获取用户红包列表
     * @return mixed
     */
    public function findRedpack($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'doFilter' => isset($params['doFilter']) ? $params['doFilter'] : null,
            'order_amount' => isset($params['order_amount']) ? $params['order_amount'] : null,
            'time_in' => isset($params['time_in']) ? $params['time_in'] : null,
            'is_use' => isset($params['is_use']) ? $params['is_use'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('user-redpack-find', $apiParams);
        if (isset($this->_data['data']) && count($this->_data['data'])) {
            foreach ($this->_data['data'] as $key => $val) {
                $this->_data['data'][$key]['amount'] = self::amountToYuan($this->_data['data'][$key]['amount']);
                $this->_data['data'][$key]['order_limit'] = self::amountToYuan($this->_data['data'][$key]['order_limit']);
            }
        }
    }

    /**
     * 获取用户积分日志列表
     * @return mixed
     */
    public function findPointLog($params)
    {
        $this->getResult('user-point-log-find', $params);
    }

    /**
     * 获取用户预约列表
     * @param $params
     */
    public function findReserveUserData($params)
    {
        //拿接口数据
        $apiParams = [
            'reserve_setting_id' => isset($params['reserve_setting_id']) ? $params['reserve_setting_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('reserve-find-user-data', $apiParams);
    }


    /**
     * 绑定微信账号
     * @param $params
     */
    public function bindStaff($params)
    {
        //拿接口数据
        $apiParams = [
            'user_name' => isset($params['user_name']) ? $params['user_name'] : null,
            'pwd' => isset($params['pwd']) ? $params['pwd'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'isManager' => isset($params['isManager']) ? $params['isManager'] : null,
        ];

        $this->getResult('staff-bind-staff-user', $apiParams);
    }
}
