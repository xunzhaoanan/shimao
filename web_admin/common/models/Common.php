<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/13
 * Time: 14:19
 */

namespace common\models;

use common\cache\CommonCache;
use Yii;
use yii\base\Model;

/**
 * Common model
 */
class Common extends BaseModel
{

    protected $commonCache ;

    public function init()
    {
        $this->commonCache = new CommonCache();
    }

    /**
     * 获取省份列表
     * @return mixed
     */
    public function findProvince()
    {
        //拿缓存数组
        $data = $this->commonCache->findProvince();
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        //拿接口数据
        $apiParams = [
        ];
        $this->getResult('common-province-list',$apiParams);
        if ( ! is_null($this->_data)){
            $this->commonCache->setProvince($this->_data);
        }
    }

    /**
     * 获取省的城市列表
     * @return mixed
     */
    public function findCity($params = [])
    {
        //拿缓存数组
        $data = $this->commonCache->findCity($params);
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        //拿接口数据
        $apiParams = [
            'province_id' => isset($params['province_id']) ? $params['province_id'] : null
        ];
        $this->getResult('common-city-list',$apiParams);
        if ( ! is_null($this->_data)){
            $this->commonCache->setCity($params,$this->_data);
        }
    }

    /**
     * 获取城市的地区列表
     * @return mixed
     */
    public function findDistrict($params = [])
    {
        //拿缓存数组
        $data = $this->commonCache->findDistrict($params);
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        //拿接口数据
        $apiParams = [
            'city_id' => isset($params['city_id']) ? $params['city_id'] : null,
        ];
        $this->getResult('common-district-list',$apiParams);
        if ( ! is_null($this->_data)){
            $this->commonCache->setDistrict($params,$this->_data);
        }
    }

    /**
     * 获取商圈列表
     * @return mixed
     */
    public function findCircle($params = [])
    {
        //拿缓存数组
        $data = $this->commonCache->findCircle($params);
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        //拿接口数据
        $apiParams = [
            'district_id' => isset($params['district_id']) ? $params['district_id'] : null,
        ];
        $this->getResult('common-circle-list',$apiParams);
        if ( ! is_null($this->_data)){
            $this->commonCache->setCircle($params,$this->_data);
        }
    }

    /**
     * 获取所有省市区列表
     * @return mixed
     */
    public function findArea(){
        //拿缓存数组
        $data = $this->commonCache->findCircle();
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        //拿接口数据
        $apiParams = [];
        $this->getResult('common-circle-list',$apiParams);
        if ( ! is_null($this->_data)){
            $this->commonCache->setCircle($this->_data);
        }
    }


    /**
     * 根据id获取省市区名称
     * 参数：数组或数字
     * @return mixed
     */
    public function getAreaName($params = []){
        if(is_array($params) && count($params)){
            $data = array();
            foreach($params as $val){
                $data[] = $this->_getName(['id'=>$val]);
            }
        }else{
            $data = $this->_getName(['id'=>$params]);
        }
        $this->setResult($data);
    }

    /**
     * 根据id获取省市区名称
     * 走接口层，供内部调用
     * @return mixed
     */
    private function _getName($params = []){
        //拿缓存数组
        $data = $this->commonCache->getName($params);
        if($data !== false){
           return $data;
        }
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('common-area-name',$apiParams);
        if ( is_null($this->getError())){
            $this->setResult($this->_data['name']);
            $this->commonCache->setName($params, $this->_data);
        }else{
            $this->setResult('未知地区');
        }
        return $this->_data;
    }

    /**
     * 获取第三方配置信息
     * 走接口层，供内部调用
     * @return mixed
     */
    public function getThirdPartyInfo($params){
        //拿缓存数组
        $data = $this->commonCache->getThirdPartyInfo($params);
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'platform_type' => isset($params['platform_type']) ? $params['platform_type'] : null,
        ];
        $this->getResult('third-party-get',$apiParams);
        if ( ! is_null($this->_data)){
            $this->commonCache->setThirdPartyInfo($params, $this->_data);
        }
    }

    /**
     * 修改第三方平台配置信息
     * @return mixed
     */
    public function updateWxConfig($params){
        $params['platform_type'] = ThirdParty::TYPE_WX;
        $this->commonCache->delThirdPartyInfo($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'token' => isset($params['token']) ? $params['token'] : null,
            'appid' => isset($params['appid']) ? $params['appid'] : null,
            'secret' => isset($params['secret']) ? $params['secret'] : null,
            'third_party_id' => isset($params['third_party_id']) ? $params['third_party_id'] : null,
        ];
        $this->getResult('third-party-update-wx',$apiParams);
    }

    /**
     * 根据微信号获取第三方配置信息
     * 走接口层，供内部调用
     * @return mixed
     */
    public function getThirdPartyInfoByAccount($params){
        $data = $this->commonCache->getThirdPartyInfoByAccount($params);
        if($data !== false){
            return $this->setResult($data);
        }
        //拿接口数据
        $apiParams = [
            'account' => isset($params['account']) ? $params['account'] : null,
            'platform_type' => isset($params['platform_type']) ? $params['platform_type'] : null,
        ];
        $this->getResult('third-party-get-by-account',$apiParams);
        if ( ! is_null($this->_data)){
            $this->commonCache->setThirdPartyInfoByAccount($params, $this->_data);
        }
    }
    
}
