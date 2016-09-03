<?php
/**
 * Author: Kevin
 * Date: 2015/07/09
 * Time: 11:11
 * 商城导航
 */
namespace common\models;

use common\cache\WebsiteCategoryCache;
use Yii;
use yii\base\Model;

/**
 * WebsiteCategory model
 */
class WebsiteCategory extends BaseModel
{
    protected $websiteCategotyCache ;

    public function init()
    {
        $this->websiteCategotyCache = new WebsiteCategoryCache();
    }

    /**
     * 商城导航添加
     * @return mixed
     */
    public function create($params)
    {
        $this->websiteCategotyCache->delFind($params);
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'describe' => isset($params['describe']) ? $params['describe'] : null,
            'sort' => isset($params['sort']) ? $params['sort'] : null,
            'icon' => isset($params['icon']) ? $params['icon'] : null,
            'face' => isset($params['face']) ? $params['face'] : null,
            'type_url' => isset($params['type_url']) ? $params['type_url'] : null,
            'model' => isset($params['model']) ? $params['model'] : null,
            'model_id' => isset($params['model_id']) ? $params['model_id'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
        ];
        $this->getResult('website-category-create',$apiParams);
    }

    /**
     * 获取商城导航列表
     * @return mixed
     */
    public function find($params)
    {
        $params['count'] = 10;
        //拿缓存数组
        $data = $this->websiteCategotyCache->getFind($params);
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'type' => isset($params['type']) ? $params['type'] : null
        ];
        $this->getResult('website-category-list',$apiParams);
        if ( ! is_null($this->_data)){
            $this->websiteCategotyCache->setFind($params,$this->_data);
        }
    }

    /**
     * 获取商城导航
     * @return mixed
     */
    public function get($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('website-category-get',$apiParams);
    }

    /**
     * 设置商城导航为已入账
     * @return mixed
     */
    public function update($params)
    {
        $this->websiteCategotyCache->delFind($params);
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'describe' => isset($params['describe']) ? $params['describe'] : null,
            'sort' => isset($params['sort']) ? $params['sort'] : null,
            'icon' => isset($params['icon']) ? $params['icon'] : null,
            'face' => isset($params['face']) ? $params['face'] : null,
            'type_url' => isset($params['type_url']) ? $params['type_url'] : null,
            'model' => isset($params['model']) ? $params['model'] : null,
            'model_id' => isset($params['model_id']) ? $params['model_id'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
        ];
        $this->getResult('website-category-update',$apiParams);
    }

    /**
     * 启用商城导航
     * @return mixed
     */
    public function enable($params)
    {
        $this->websiteCategotyCache->delFind($params);
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('website-category-enable',$apiParams);
    }

    /**
     * 禁用商城导航
     * @return mixed
     */
    public function disable($params)
    {
        $this->websiteCategotyCache->delFind($params);
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('website-category-disable',$apiParams);
    }

    /**
     * 删除商城导航
     * @return mixed
     */
    public function del($params)
    {
        $this->websiteCategotyCache->delFind($params);
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('website-category-del',$apiParams);
    }

}
