<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 10:55
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Mall model
 */
class Ad extends BaseModel
{

    /**
     * 广告位列表
     */
    public function find($params)
    {
        $apiParams = [
            'code' => isset($params['code']) ? $params['code'] : null,
        ];
        $this->getResult('ad-site-list',$apiParams);
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
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
        ];
        $this->getResult('shop-sub-list',$apiParams);
    }

    /**
     * 活动列表
     * @param $params
     */
    public function actList($params)
    {
        $apiParams = [
            'range_type' => isset($params['range_type']) ? $params['range_type'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
        ];
        $this->getResult('activity-list',$apiParams);
    }

    /**
     * 禁用广告活动
     */
    public function closeAct($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('close-act',$apiParams);
    }

    /**
     * 開啟广告活动
     */
    public function openAct($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('open-act',$apiParams);
    }

    /**
     * 删除广告活动
     */
    public function deleteAct($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('delete-act',$apiParams);
    }

    /**
     * 广告内容列表
     */
    public function actContentList($params)
    {
        $apiParams = [
            'ad_activity_id' => isset($params['ad_activity_id']) ? $params['ad_activity_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
        ];
        $this->getResult('act-content-list',$apiParams);
    }

    /**
     * 禁用广告活动
     */
    public function closeAd($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('close-ad',$apiParams);
    }

    /**
     * 開啟广告活动
     */
    public function openAd($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('open-ad',$apiParams);
    }

    /**
     * 删除广告内容
     */
    public function deleteAd($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('delete-ad',$apiParams);
    }

    /**
     * 添加广告内容
     */
    public function addContent($params)
    {
        $apiParams = [
            'ad_activity_id' => isset($params['ad_activity_id']) ? $params['ad_activity_id'] : null,
            'type' => isset($params['ad_activity_id']) ? $params['type'] : null,
            'content' => isset($params['content']) ? $params['content'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('add-ad-content',$apiParams);
    }

    /**
     * 添加广告内容
     */
    public function editContent($params)
    {
        $apiParams = [
            'ad_activity_id' => isset($params['ad_activity_id']) ? $params['ad_activity_id'] : null,
            'type' => isset($params['ad_activity_id']) ? $params['type'] : null,
            'content' => isset($params['content']) ? $params['content'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('edit-ad-content',$apiParams);
    }

    /**
     * 广告活动详情
     * @param $params
     */
    public function actInfo($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('act-info',$apiParams);
    }

    /**
     * 添加广告活动
     * @param $params
     */
    public function adActInfo($params)
    {
        $apiParams = [
            'ad_site_id' => isset($params['ad_site_id']) ? $params['ad_site_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'avtivity_name' => isset($params['avtivity_name']) ? $params['avtivity_name'] : null,
            'range_type' => isset($params['range_type']) ? $params['range_type'] : null,
            'played' => isset($params['played']) ? $params['played'] : null,
            'begin_time' => isset($params['begin_time']) ? $params['begin_time'] : null,
            'end_time' => isset($params['end_time']) ? $params['end_time'] : null,
            'ad_ranges' => isset($params['ad_ranges']) ? $params['ad_ranges'] : null,
        ];
        $this->getResult('ad-act-info',$apiParams);
    }

    /**
     * 修改广告活动
     * @param $params
     */
    public function editActInfo($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'ad_site_id' => isset($params['ad_site_id']) ? $params['ad_site_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'avtivity_name' => isset($params['avtivity_name']) ? $params['avtivity_name'] : null,
            'range_type' => isset($params['range_type']) ? $params['range_type'] : null,
            'played' => isset($params['played']) ? $params['played'] : null,
            'begin_time' => isset($params['begin_time']) ? $params['begin_time'] : null,
            'end_time' => isset($params['end_time']) ? $params['end_time'] : null,
            'ad_ranges' => isset($params['ad_ranges']) ? $params['ad_ranges'] : null,
        ];
        $this->getResult('edit-act-info',$apiParams);
    }

    /**
     * 删除指定店铺
     * @param $params
     */
    public function delRangeShop($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'ad_activity_id' => isset($params['ad_activity_id']) ? $params['ad_activity_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('del-range-shop',$apiParams);
    }

    public function staffAdCount($params)
    {
        $apiParams = [
            'ad_content_id' => isset($params['ad_content_id']) ? $params['ad_content_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
        ];
        $this->getResult('staff-ad-count',$apiParams);
    }
}
