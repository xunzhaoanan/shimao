<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 14:05
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * RedpackManage model
 */
class RedpackManage extends BaseModel
{

    // 类缓存前缀
    const CACHE_KEY_PRE = 'models_redpackmanage_';
    /**
     * 红包类型：商城红包
     */
    const TYPE_MALL = 1;

    /**
     * 创建
     */
    public function create($params)
    {
        $apiParams = [
            'name' => isset($params['name']) ? $params['name'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'total_amount' => isset($params['total_amount']) ? $params['total_amount'] : null, //金额
            'remark' => isset($params['remark']) ? $params['remark'] : null, //备注
            'order_limit' => isset($params['order_limit']) ? $params['order_limit'] : null, //订单限额
            'start_time' => isset($params['start_time']) ? $params['start_time'] : null,
            'end_time' => isset($params['end_time']) ? $params['end_time'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('redpack-manage-create', $apiParams);
    }

    /**
     * 获取列表
     */
    public function find($params)
    {
        //拿接口数据
        $apiParams = [
            'name' => isset($params['name']) ? $params['name'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'is_not_end' => isset($params['is_not_end']) ? $params['is_not_end'] : null
        ];
        $this->getResult('redpack-manage-find', $apiParams);
    }

    /**
     * 获取信息
     */
    public function get($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'total_amount' => isset($params['total_amount']) ? $params['total_amount'] : null,
            'order_limit' => isset($params['order_limit']) ? $params['order_limit'] : null,
            'start_time' => isset($params['start_time']) ? $params['start_time'] : null,
            'end_time' => isset($params['end_time']) ? $params['end_time'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('redpack-manage-get', $apiParams);
    }

    /**
     * 更新
     */
    public function update($params)
    {
        $apiParams = [
            'redpacket_id' => isset($params['id']) ? $params['id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'total_amount' => isset($params['total_amount']) ? $params['total_amount'] : null,
            'order_limit' => isset($params['order_limit']) ? $params['order_limit'] : null,
            'start_time' => isset($params['start_time']) ? $params['start_time'] : null,
            'end_time' => isset($params['end_time']) ? $params['end_time'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'remark' => isset($params['remark']) ? $params['remark'] : null
        ];
        $this->getResult('redpack-manage-update', $apiParams);
    }


    /**
     * 删除
     * @param $params
     */
    public function del($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('redpack-manage-del', $apiParams);
    }
}
