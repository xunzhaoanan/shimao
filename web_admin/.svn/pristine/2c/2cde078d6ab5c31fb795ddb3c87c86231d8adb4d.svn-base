<?php
/**
 * Author: Kevin
 * Date: 2015/07/10
 * Time: 11:11
 * 幻灯片
 */
namespace common\models;

use common\cache\WebsiteSlideCache;
use Yii;

/**
 * WebsiteSlide model
 */
class WebsiteSlide extends BaseModel
{


    protected $websiteSlideCache ;

    public function init()
    {
        $this->websiteSlideCache = new WebsiteSlideCache();
    }


    /**
     * 幻灯片添加
     * @return mixed
     */
    public function create($params)
    {
        $this->websiteSlideCache->delFind($params);
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'description' => isset($params['description']) ? $params['description'] : null,
            'sort' => isset($params['sort']) ? $params['sort'] : null,
            'pic_url' => isset($params['pic_url']) ? $params['pic_url'] : null,
            'type_url' => isset($params['type_url']) ? $params['type_url'] : null,
            'model' => isset($params['model']) ? $params['model'] : null,
            'model_id' => isset($params['model_id']) ? $params['model_id'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null
        ];

        $this->getResult('website-slide-create',$apiParams);
    }

    /**
     * 获取幻灯片列表
     * @return mixed
     */
    public function find($params)
    {
        $params['count'] = 10;
        //拿缓存数组
        $data = $this->websiteSlideCache->getFind($params);
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
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null
        ];
        $this->getResult('website-slide-list',$apiParams);
        if ( ! is_null($this->_data)){
            $this->websiteSlideCache->setFind($params,$this->_data);
        }
    }

    /**
     * 获取幻灯片
     * @return mixed
     */
    public function get($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('website-slide-get',$apiParams);
    }

    /**
     * 更新幻灯片
     * @return mixed
     */
    public function update($params)
    {
        $this->websiteSlideCache->delFind($params);
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'description' => isset($params['description']) ? $params['description'] : null,
            'sort' => isset($params['sort']) ? $params['sort'] : null,
            'pic_url' => isset($params['pic_url']) ? $params['pic_url'] : null,
            'type_url' => isset($params['type_url']) ? $params['type_url'] : null,
            'model' => isset($params['model']) ? $params['model'] : null,
            'model_id' => isset($params['model_id']) ? $params['model_id'] : null
        ];
        $this->getResult('website-slide-update',$apiParams);
    }

    /**
     * 启用幻灯片
     * @return mixed
     */
    public function enable($params)
    {
        $this->websiteSlideCache->delFind($params);
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('website-slide-enable',$apiParams);
    }

    /**
     * 禁用幻灯片
     * @return mixed
     */
    public function disable($params)
    {
        $this->websiteSlideCache->delFind($params);
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('website-slide-disable',$apiParams);
    }

    /**
     * 删除幻灯片
     * @return mixed
     */
    public function del($params)
    {
        $this->websiteSlideCache->delFind($params);
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('website-slide-del',$apiParams);
    }

}
