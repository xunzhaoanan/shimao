<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 商品类
 */
namespace common\models;

use common\cache\ProductCache;
use Yii;

/**
 * shop model
 */
class CustompageCategory extends BaseModel
{
    /**
     * 获取分类列表
     * @return mixed
     */
    public function find($apiParams)
    {
        //$apiParams['count'] = 1000;
        $this->getResult('custompage-category-list',$apiParams);
    }

    /**
     * 添加分类
     * @return mixed
     */
    public function create($apiParams)
    {
        $this->getResult('custompage-category-create',$apiParams);
    }

    /**
     * 更新分类
     * @return mixed
     */
    public function update($apiParams)
    {
        $this->getResult('custompage-category-update',$apiParams);
    }

    /**
     * 删除分类
     * @return mixed
     */
    public function delete($apiParams)
    {
        $this->getResult('custompage-category-delete',$apiParams);
    }

}
