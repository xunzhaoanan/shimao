<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */

namespace common\models;

use common\cache\ShopCache;
use Yii;

/**
 * shop model
 */
class Shop extends BaseModel
{
    //支付方式开启状态
    const PAY_STATUS_OPEMN = 1;
    const PAY_STATUS_CLOSE = 0;

    const PAY_TYPE_TENPAY = 1;
    const PAY_TYPE_WXPAY = 2;
    const PAY_TYPE_DELIVERY = 3;
    const PAY_TYPE_COLLECTION = 4;
    const PAY_TYPE_NEW_WXPAY = 5;
    const PAY_TYPE_QQ_PAY = 8;

    //退货设置
    const RETURN_GOODS_ON = 1;
    const RETURN_GOODS_OFF = 2;

    //是否开启餐饮系统
    const IS_RESTAURANT_YES = 1;
    const IS_RESTAURANT_NO = 2;

    //开发者文档地址
    const DEVELOPER_WIKI = 'http://wshopen.nexto2o.com/doc/';
    const DEVELOPER_GET_URL = '/pv1/user/get';
    const DEVELOPER_CREATE_URL = '/pv1/user/create';

    private $provider = 'wsh';

    //支付方式列表
    public $payTypeList = [
        'tenpay' => [
            'key' => 'tenpay',
            'val' => 1,
            'desc' => '财付通'
        ],
        'wxpay' => [
            'key' => 'wxpay',
            'val' => 2,
            'desc' => '微信支付'
        ],
        'delivery' => [
            'key' => 'delivery',
            'val' => 3,
            'desc' => '货到付款'
        ],
        'agentpay' => [
            'key' => 'agentpay',
            'val' => 4,
            'desc' => '代收款（财付通）'
        ],
        'newwxpay' => [
            'key' => 'newwxpay',
            'val' => 5,
            'desc' => '新微信支付'
        ],
        'qqpay' => [
            'key' => 'qqpay',
            'val' => 8,
            'desc' => '手Q支付'
        ]
    ];

    /**
     * 快递配送 开关
     */
    const SHIPPING_STATUS_ON = 1;
    const SHIPPING_STATUS_OFF = 2;

    /**
     * 自提 开关
     */
    const SELF_PICKUP_STATUS_ON = 1;
    const SELF_PICKUP_STATUS_OFF = 2;

    protected $shopCache ;

    public function init()
    {
        $this->shopCache = new ShopCache();
    }

    /**
     * 修改商家的设置
     * @return mixed
     */
    public function updateShopSetting($params){
        $this->shopCache->delShop($params);
        $this->getResult('shop-setting-update',$params,false);
    }

    /**
     * 商家设置数据补齐
     * @return mixed
     */
    public function constData(){
        $this->getResult('shop-setting-data-test',[]);
    }

    /**
     * 获取商家信息
     * @return mixed
     */
    public function get($params){
        $data = $this->shopCache->getShop($params);
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'qq' => isset($params['qq']) ? $params['qq'] : null
        ];
        $this->getResult('shop-get',$apiParams);
        //再从新设置缓存
        if ( ! is_null($this->_data)){
            $this->shopCache->setShop($params, $this->_data);
        }
    }

    /**
     * 修改商家信息
     * @return mixed
     */
    public function update($params){
        $this->shopCache->delShop($params);
        if(isset($params['desc'])){
            if( ! $params['desc']){
                $params['desc'] = ' ';
            }
        }else{
            $params['desc'] = ' ';
        }
        $this->getResult('shop-update',$params);
    }

    /**
     * 支付设置列表
     * @return mixed
     */
    public function paymentSettingList($params){
        $data = $this->shopCache->getPaymentSettingList($params);
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('payment-setting-list',$apiParams);
        if ( ! is_null($this->_data)){
            $this->shopCache->setPaymentSettingList($params,$this->_data);
        }
    }

    /**
     * 修改支付设置列表
     * @return mixed
     */
    public function updatePaymentSettingList($params){
        $this->shopCache->delPaymentSettingList($params);
        //走修改支付设置接口
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'pay_settings' => isset($params['pay_settings']) ? $params['pay_settings'] : null
        ];
        $this->getResult('payment-setting-list-update',$apiParams);
        //重新设置缓存
        if ( ! is_null($this->getError())){
            $this->shopCache->setPaymentSettingList($params,$this->_data);
        }
    }

    /**
     * 获取支付设置信息
     * @return mixed
     */
    public function getPaymentSetting($params){
        //拿缓存数组
        $data = $this->shopCache->getPaymentSetting($params);
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'type' => isset($params['type']) ? $params['type'] : null
        ];
        $this->getResult('payment-setting-get',$apiParams);
        if ( ! is_null($this->_data)){
            $this->shopCache->setPaymentSetting($params,$this->_data,18400);
        }
    }

    /**
     * 修改支付设置信息
     * @return mixed
     */
    public function updatePaymentSetting($params){
        //清除缓存数组
        $this->shopCache->delPaymentSetting($params);
        //走修改支付设置接口
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'key' => isset($params['key']) ? $params['key'] : null,
            'account' => isset($params['account']) ? $params['account'] : null,
            'sign_key' => isset($params['sign_key']) ? $params['sign_key'] : null,
            'config_id' => isset($params['config_id']) ? $params['config_id'] : null,
            'type' => isset($params['type']) ? $params['type'] : null
        ];
        $this->getResult('payment-setting-update',$apiParams);
        //再从新设置缓存
        if ( ! is_null($this->_data)){
            $this->shopCache->setPaymentSetting($params,$this->_data,18400);
        }
    }

    /**
     * 管理员列表
     * @return mixed
     */
    public function findManager($params){
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('manager-list',$apiParams);
    }

    /**
     * 创建管理员
     * @return mixed
     */
    public function createManager($params){
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'role_id' => isset($params['role_id']) ? $params['role_id'] : null,
            'qq' => isset($params['qq']) ? $params['qq'] : null,
            'password' => isset($params['password']) ? $params['password'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'sex' => isset($params['sex']) ? $params['sex'] : null,
            'phone' => isset($params['phone']) ? $params['phone'] : null,
            'email' => isset($params['email']) ? $params['email'] : null,
            'address' => isset($params['address']) ? $params['address'] : null
        ];
        $this->getResult('manager-create',$apiParams);
    }

    /**
     * 获取管理员信息
     * @return mixed
     */
    public function getManager($params){
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('manager-get',$apiParams);
    }

    /**
     * 修改管理员信息
     * @return mixed
     */
    public function updateManager($params){
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'qq' => isset($params['qq']) ? $params['qq'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'password' => isset($params['password']) ? $params['password'] : null,
            'role_id' => isset($params['role_id']) ? $params['role_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'sex' => isset($params['sex']) ? $params['sex'] : null,
            'email' => isset($params['email']) ? $params['email'] : null,
            'phone' => isset($params['phone']) ? $params['phone'] : null,
            'address' => isset($params['address']) ? $params['address'] : null
        ];
        $this->getResult('manager-update',$apiParams);
    }

    /**
     * 修改操作员密码
     * @return mixed
     */
    public function updateManagerPassword($params){
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'password' => isset($params['password']) ? $params['password'] : null
        ];
        $this->getResult('manager-update-manager-password',$apiParams);
    }

    /**
     * TODO 没接口 启用管理员
     * @return mixed
     */
    public function openManager($params){
        $apiParams = [
            'id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('manager-open',$apiParams);
    }

    /**
     * TODO 没接口 禁用管理员
     * @return mixed
     */
    public function closeManager($params){
        $apiParams = [
            'id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('manager-close',$apiParams);
    }


    /**
     * 删除管理员
     * @return mixed
     */
    public function delManager($params){
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('manager-del',$apiParams);
    }

    /**
     * 获取开发者信息
     * @param $params
     * @return string
     */
    public function getDeveloper($params){
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        return $this->postCurl(OPEN_HOST.self::DEVELOPER_GET_URL, $apiParams);
    }

    /**
     * 开启开发者
     * @param $params
     * @return string
     */
    public function createDeveloper($params){
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_name' => isset($params['shop_name']) ? $params['shop_name'] : null,
            'provider' => isset($params['provider']) ? $params['provider'] : $this->provider
        ];
        return $this->postCurl(OPEN_HOST.self::DEVELOPER_CREATE_URL, $apiParams);
    }

    /**
     * 添加常用地址
     * @param $params
     * @return string
     */
    public function addUsedAddress($params){
        $this->getResult('shop/create-shop-used-address',$params);
        $this->setResult($this->_data);
    }

    /**
     * 常用地址列表
     * @param $params
     * @return string
     */
    public function getUsedAddressList($params){
        $this->getResult('shop/find-shop-used-address-list',$params);
        $this->setResult($this->_data);
    }

    /**
     * 更新地址列表
     * @param $params
     * @return string
     */
    public function updateUsedAddress($params){
        $this->getResult('shop/update-shop-used-address',$params);
        $this->setResult($this->_data);
    }

    /**
     * 添加提货点
     * @param $params
     * @return string
     */
    public function createSelfPickupSub($params){
        $this->getResult('shop/create-shop-self-pickup-sub',$params);
        $this->setResult($this->_data);
    }

    /**
     * 删除提货点
     * @param $params
     * @return string
     */
    public function delSelfPickupSub($params){
        $this->getResult('shop/del-shop-self-pickup-sub',$params);
        $this->setResult($this->_data);
    }

    /**
     * 删除提货点
     * @param $params
     * @return string
     */
    public function findSelfPickupSub($params){
        $this->getResult('shop/find-shop-self-pickup-sub',$params);
        $this->setResult($this->_data);
    }

    /**
     * 查找所有商家
     * @param $params
     */
    public function findAllShop($params){
        $this->getResult('shop/find-all-shop', $params);
        $this->setResult($this->_data);
    }
}
