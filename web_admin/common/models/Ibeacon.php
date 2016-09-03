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
 * Ibeacon model
 */
class Ibeacon extends BaseModel
{

    /**
     * ibeacon 页面管理列表
     * @return mixed
     */
    public function findPages($params,$is_search = false)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'comment' => isset($params['comment']) ? $params['comment'] : null
        ];
        $this->getResult('ibeacon-find-page-list',$apiParams);
    }

    /**
     * 页面管理-创建页面
     * @return mixed
     */
    public function createPages($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'page_url' => isset($params['page_url']) ? $params['page_url'] : null,
            'description' => isset($params['description']) ? $params['description'] : null,
            'comment' => isset($params['comment']) ? $params['comment'] : null,
            'cdn_url' => isset($params['cdn_url']) ? $params['cdn_url'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'model' => isset($params['model']) ? $params['model'] : null,
            'model_id' => isset($params['model_id']) ? $params['model_id'] : null
        ];
        $this->getResult('ibeacon-create-page',$apiParams);
    }

    /**
     * 页面管理-修改页面信息
     * @return mixed
     */
    public function getPages($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('ibeacon-get-page',$apiParams);
    }

    /**
     * 页面管理-修改页面
     * @return mixed
     */
    public function updatePages($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'page_url' => isset($params['page_url']) ? $params['page_url'] : null,
            'material_id' => isset($params['material_id']) ? $params['material_id'] : null,
            'page_id' => isset($params['page_id']) ? $params['page_id'] : null,
            'description' => isset($params['description']) ? $params['description'] : null,
            'comment' => isset($params['comment']) ? $params['comment'] : null,
            'icon_url' => isset($params['icon_url']) ? $params['icon_url'] : null,
            'website_reply_url' => isset($params['website_reply_url']) ? $params['website_reply_url'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'model' => isset($params['model']) ? $params['model'] : null,
            'model_id' => isset($params['model_id']) ? $params['model_id'] : null,
            'cdn_url' => isset($params['cdn_url']) ? $params['cdn_url'] : null,
        ];
        $this->getResult('ibeacon-update-page',$apiParams);
    }

    /**
     * 页面管理-删除
     * @return mixed
     */
    public function delPages($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null
        ];
        $this->getResult('ibeacon-del-page',$apiParams);
    }

    /**
     * ibeacon 设备管理列表
     * @return mixed
     */
    public function findEvices($params)
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
        $this->getResult('ibeacon-find-client-list',$apiParams);
    }

    /**
     * ibeacon 获取设备管理列表-修改页面信息
     * @return mixed
     */
    public function getEvices($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('ibeacon-get-client',$apiParams);
    }

    /**
     * 设备管理列表-修改页面
     * @return mixed
     */
    public function updateEvices($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'comment' => isset($params['comment']) ? $params['comment'] : null,
            'pages' => isset($params['pages']) ? $params['pages'] : null,
        ];
        $this->getResult('ibeacon-update-client',$apiParams);
    }

    /**
     * ibeacon 数据统计列表
     * @return mixed
     */
    public function findStatistic($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'device_id' => isset($params['device_id']) ? $params['device_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('ibeacon-find-main-statistic',$apiParams);
    }

    /**
     * ibeacon 数据统计-效果详情
     * @return mixed
     */
    public function findStatisticDetail($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'device_id' => isset($params['device_id']) ? $params['device_id'] : null,
            'ftime' => isset($params['ftime']) ? $params['ftime'] : null,
            'shop_name' => isset($params['shop_name']) ? $params['shop_name'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('ibeacon-find-statistics-list',$apiParams);
    }

    /**
     * 数据统计-效果详情-修改
     * @return mixed
     */
    public function getStatistic($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('ibeacon-get-statistics',$apiParams);
    }

    /**
     * 数据统计-统计总人数
     * @return mixed
     */
    public function getSumUv($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('ibeacon-get-sum-shake-uv',$apiParams);
    }

    /**
     * 直营店列表
     * @param $params
     */
    public function shopList($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'name' => isset($params['name']) ? $params['name'] : null
        ];
        $this->getResult('terminal-list',$apiParams);
    }


}
