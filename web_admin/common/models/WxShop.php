<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/25
 * Time: 20:05
 */

namespace common\models;

use common\cache\BaseCache;
use common\cache\WxshopCache;
use Yii;
use yii\base\Model;

/**
 * WxMenu model
 */
class WxShop extends BaseModel
{
    //微信创建门店状态 1未同步 2审核中 3创建成功 4创建失败
    const AVAILABLE_STATUS_UNSYNC = 1;
    const AVAILABLE_STATUS_ONCHECK = 2;
    const AVAILABLE_STATUS_SUCCESS = 3;
    const AVAILABLE_STATUS_FAIL = 4;

    const UPDATE_STATUS_NORMAL = 0;
    const UPDATE_STATUS_ON_MODIFYING = 1;
    const UPDATE_STATUS_SUCCESS = 2;
    const UPDATE_STATUS_FAIL = 3;

    protected $wxshopCache ;

    public function init()
    {
        $this->wxshopCache = new WxshopCache();
    }

    /**
     * 获取微信小店分类列表
     * @return mixed
     */
    public function findCategory($params){
        //拿缓存数组
        $data = $this->wxshopCache->getFindCategory($params);
        //pr($data);
        BaseCache::append('test_cache', __FILE__.'_____'.__LINE__);
        BaseCache::append('test_cache', $data);
        if($data !== false){
            return $this->setResult($data);
        }
        //拿接口数据
        $apiParams = [
            'pid' => isset($params['pid']) ? $params['pid'] : null,
            'level' => isset($params['level']) ? $params['level'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null
        ];
        $this->getResult('wx-shop-category-find',$apiParams);
        if ( ! is_null($this->_data)){
            $this->wxshopCache->setFindCategory($params, $this->_data);
        }else{
            $this->setResult([]);
        }
    }

    /**
     * 获取微信小店分类
     * @return mixed
     */
    public function getCategory($params){
        //拿缓存数组
        $data = $this->wxshopCache->getGetCategory($params);
        if($data !== false){
            return $data;
        }
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null
        ];
        $this->getResult('wx-shop-category-get',$apiParams);
        if ( ! is_null($this->getError())){
            $data = $this->_data['name'];
        }else{
            $data = '未知地区';
        }
        $this->setResult($data);
        $this->wxshopCache->setGetCategory($params, $data);
    }

    /**
     * 同步微信门店
     * @return mixed
     */
    public function syncShopToWx($params){
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('wx-shop-sync-to-wx',$apiParams);
    }

    /**
     * 同步微信门店
     * @return mixed
     */
    public function batchSyncShopToWx($params){
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null
        ];
        $this->getResult('wx-shop-batch-sync-to-wx',$apiParams);
    }

    /**
     * 同步微信门店到本地
     * @return mixed
     */
    public function batchSyncShopFromWx($params){
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('wx-shop-batch-sync-from-wx',$apiParams);
    }

    /**
     * 同步微信门店审核状态到本地
     * @return mixed
     */
    public function batchSyncShopStatus($params){
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('wx-batch-sync-shop-status',$apiParams);
    }

    /**
     * 更新微信门店审核状态
     */
    public function updateStatus($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'poi_id' => isset($params['poi_id']) ? $params['poi_id'] : null,
            'check_status' => isset($params['check_status']) ? $params['check_status'] : null,
            //'available_status' => isset($params['available_status']) ? $params['available_status'] : null,
            //'update_status' => isset($params['update_status']) ? $params['update_status'] : null,
            'fail_msg' => isset($params['fail_msg']) ? $params['fail_msg'] : null
        ];
        $this->getResult('wx-shop-update-status',$apiParams);
    }

    /**
     * 修复线上拉取微信门店 没有创建默认员工和角色的数据
     */
    public function fixShopStaff(){
        $apiParams = [];
        $this->getResult('wx-shop-fix-shopstaff',$apiParams);
    }

}
