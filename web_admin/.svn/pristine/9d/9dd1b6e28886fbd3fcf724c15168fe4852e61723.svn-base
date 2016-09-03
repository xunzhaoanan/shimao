<?php
/**
 * Author: Kevin
 * Date: 2015/07/01
 * Time: 15:00
 * 分销商品
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * FxProduct model
 */
class FxProduct extends BaseModel
{
    /**
     * 分销商品添加
     * @return mixed
     */
    public function create($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'fx_policy_id' => isset($params['fx_policy_id']) ? $params['fx_policy_id'] : null,
            'product_id' => isset($params['product_id']) ? $params['product_id'] : null,
        ];
        $this->getResult('fx-product-create',$apiParams);
    }

    /**
     * 获取分销商品列表
     * @return mixed
     */
    public function find($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sorStr' => isset($params['sorStr']) ? $params['sorStr'] : null,
            'filter_choosed' => isset($params['filter_choosed']) ? $params['filter_choosed'] : null,
            'fx_policy_id' => isset($params['fx_policy_id']) ? $params['fx_policy_id'] : null,
            'member_flag' => isset($params['member_flag']) ? $params['member_flag'] : null,
            'app' => isset($params['app']) ? $params['app'] : null,
            'fx_member_product_flag' => isset($params['fx_member_product_flag']) ? $params['fx_member_product_flag'] : null,
        ];

        $this->getResult('fx-product-list',$apiParams);
    }

    /**
     * 获取分销商品
     * @return mixed
     */
    public function get($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'fx_product_id' => isset($params['fx_product_id']) ? $params['fx_product_id'] : null,
        ];
        $this->getResult('fx-product-get',$apiParams);
    }

    /**
     * 分销商品更新策略
     * @return mixed
     */
    public function updatePolicy($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'fx_product_id' => isset($params['fx_product_id']) ? $params['fx_product_id'] : null,
            'fx_policy_id' => isset($params['fx_policy_id']) ? $params['fx_policy_id'] : null,
        ];
        $this->getResult('fx-product-policy-update',$apiParams);
    }

    /**
     * 分销商品 删除
     * @return mixed
     */
    public function del($params)
    {
        $apiParams = [
            'fx_product_id' => isset($params['fx_product_id']) ? $params['fx_product_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            // 'operator' => isset($params['operator']) ? $params['operator'] : null,
        ];
        $this->getResult('fx-product-del',$apiParams);
    }

}
