<?php
/**
 * Author: Kevin
 * Date: 2015/07/02
 * Time: 11:11
 * 分销订单
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * FxOrder model
 */
class FxOrder extends BaseModel
{
    //未入账
    const NOT_ACCOUNTED = 1;
    //已入账
    const HAS_ACCOUNTED = 2;

    /**
     * 分销订单添加
     * @return mixed
     */
    public function create($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null,
            'product_count' => isset($params['product_count']) ? $params['product_count'] : null,
            'fx_product_count' => isset($params['fx_product_count']) ? $params['fx_product_count'] : null,
            'total_price' => isset($params['total_price']) ? $params['total_price'] : null,
            'fx_total_price' => isset($params['fx_total_price']) ? $params['fx_total_price'] : null,
            'brokerage' => isset($params['brokerage']) ? $params['brokerage'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'policy_type' => isset($params['policy_type']) ? $params['policy_type'] : null,
            'policy_value' => isset($params['policy_value']) ? $params['policy_value'] : null,
            'member_name' => isset($params['member_name']) ? $params['member_name'] : null,
            'user_name' => isset($params['user_name']) ? $params['user_name'] : null,
        ];
        $this->getResult('fx-order-create',$apiParams);
    }

    /**
     * 获取分销订单列表
     * @return mixed
     */
    public function find($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
            's_member_name' => isset($params['s_member_name']) ? $params['s_member_name'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,

            'order_status' => isset($params['order_status']) ? $params['order_status'] : null,
            'deliver_status' => isset($params['deliver_status']) ? $params['deliver_status'] : null,
            'after_sales_status' => isset($params['after_sales_status']) ? $params['after_sales_status'] : null,
            'order_type' => isset($params['order_type']) ? $params['order_type'] : null,
            'doFilter' => isset($params['doFilter']) ? $params['doFilter'] : null,
            'is_cod' => isset($params['is_cod']) ? $params['is_cod'] : null,
            'order_status_in' => isset($params['order_status_in']) ? $params['order_status_in'] : null,
            'deliver_status_in' => isset($params['deliver_status_in']) ? $params['deliver_status_in'] : null,
            'wait_send_flag' => isset($params['wait_send_flag']) ? $params['wait_send_flag'] : null,

            's_order_no' => isset($params['s_order_no']) ? $params['s_order_no'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
            'ids' => isset($params['ids']) ? $params['ids'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        //pr(json_encode($params));
        $this->getResult('fx-order-list',$apiParams);
    }

    /**
     * 获取分销订单
     * @return mixed
     */
    public function get($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
        ];
        $this->getResult('fx-order-get',$apiParams);
    }

    /**
     * 获取分销订单金额
     * @return mixed
     */
    public function getMoney($params)
    {
        $apiParams = [
            'sum' => isset($params['sum']) ? $params['sum'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
        ];
        //pr($apiParams);
        $this->getResult('fx-order-sum',$apiParams);
    }

    /**
     * 获取分销订单 通过订单号
     * @return mixed
     */
    public function getByOrderId($params)
    {
        $apiParams = [
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
        ];
        $this->getResult('fx-order-get',$apiParams);
    }

    /**
     * 设置分销订单为已入账
     * @return mixed
     */
    public function update($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
        ];
        $this->getResult('fx-order-del',$apiParams);
    }

}
