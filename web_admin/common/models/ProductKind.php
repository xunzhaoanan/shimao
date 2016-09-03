<?php
/**
 * Author: Kevin
 * Date: 2015/06/18
 * Time: 15:00
 * 商品规格
 */
namespace common\models;

use Yii;

/**
 * shop model
 */
class ProductKind extends BaseModel
{

    /**
     * 获取商品规格列表
     * @return mixed
     */
    public function find($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => ['id'=>'asc']
        ];
        $this->getResult('product-kind-list',$apiParams);
    }

    /**
     * 添加商品规格
     * @return mixed
     */
    public function create($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
        ];
        $this->getResult('product-kind-create',$apiParams);
    }

    /**
     * 更新商品规格
     * @return mixed
     */
    public function update($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'kind_id' => isset($params['kind_id']) ? $params['kind_id'] : null,
        ];
        $this->getResult('product-kind-update',$apiParams);
    }

    /**
     * 删除商品规格
     * @return mixed
     */
    public function del($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('product-kind-del',$apiParams);
    }

    /**
     * 获取商品规格值列表
     * @return mixed
     */
    public function valueFind($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'product_kind_id' => isset($params['product_kind_id']) ? $params['product_kind_id'] : null,
            'page' => 0,
            'count' => 1000,
            'sortStr' => ['id'=>'asc']
        ];
        $this->getResult('product-kind-value-list',$apiParams);
    }

    /**
     * 添加商品规格值
     * @return mixed
     */
    public function valueCreate($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'product_kind_id' => isset($params['product_kind_id']) ? $params['product_kind_id'] : null,
        ];
        $this->getResult('product-kind-value-create',$apiParams);
    }

    /**
     * 更新商品规格值
     * @return mixed
     */
    public function valueUpdate($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'kind_value_id' => isset($params['kind_value_id']) ? $params['kind_value_id'] : null,
            'product_kind_id' => isset($params['product_kind_id']) ? $params['product_kind_id'] : null,
        ];
        $this->getResult('product-kind-value-update',$apiParams);
    }

    /**
     * 删除商品规格值
     * @return mixed
     */
    public function valueDel($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('product-kind-value-del',$apiParams);
    }

}
