<?php
/**
 * Author: Kevin
 * Date: 2015/07/02
 * Time: 15:00
 * 分销员商品
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * FxMemberProduct model
 */
class FxMemberProduct extends BaseModel
{
    /**
     * 分销员商品添加
     * @return mixed
     */
    public function create($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
            'product_id' => isset($params['product_id']) ? $params['product_id'] : null,
            'fx_product_id' => isset($params['fx_product_id']) ? $params['fx_product_id'] : null,
        ];
        $this->getResult('fx-member-product-create',$apiParams);
    }

    /**
     * 分销员商品添加
     * @return mixed
     */
    public function createAll($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
        ];
        $this->getResult('fx-member-product-create-all',$apiParams);
    }

    /**
     * 获取分销员商品列表
     * @return mixed
     */
    public function find($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'category_id' => isset($params['category_id']) ? $params['category_id'] : null,
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sorStr' => isset($params['sorStr']) ? $params['sorStr'] : null,
            'app' => isset($params['app']) ? $params['app'] : null,
            'name' => isset($params['product_name']) ? $params['product_name'] : null
        ];
        $this->getResult('fx-member-product-list',$apiParams);
    }

    /**
     * 获取分销员商品
     * @return mixed
     */
    public function get($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'fx_member_product_id' => isset($params['fx_member_product_id']) ? $params['fx_member_product_id'] : null,
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
        ];
        $this->getResult('fx-member-product-get',$apiParams);
    }

    /**
     * 分销员商品 删除
     * @return mixed
     */
    public function del($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'fx_member_product_id' => isset($params['fx_member_product_id']) ? $params['fx_member_product_id'] : null,
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
        ];
        $this->getResult('fx-member-product-del',$apiParams);
    }

    /**
     * 分销员商品 删除所有
     * @return mixed
     */
    public function delAll($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
        ];
        $this->getResult('fx-member-product-del-all',$apiParams);
    }

    /**
     * 获取推广商品佣金
     * @param $params
     */
    public function getBrokerageFxProduct($params){
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
            'fx_pro_ids' => isset($params['fx_pro_ids']) ? $params['fx_pro_ids'] : null
        ];
        $this->getResult('fx-member-product-get-brokerage',$apiParams);
    }
}
