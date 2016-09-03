<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 14:05
 */
namespace common\models;

use Yii;

/**
 * point model
 */
class ActivityPoint extends BaseModel
{
    // 活动优惠类型 1.消费送
    const TYPE_SALE_SEND = 1;

    // 活动优惠类型 2.单次消费满送
    const TYPE_REDUCTION_SEND = 2;

    // 类缓存前缀
    const CACHE_KEY_PRE = 'models_point_';

    /**
     * 获取积分活动列表
     */
    public function pointFind($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('activity-point-find', $apiParams);
    }

    /**
     * 获取积分活动信息
     */
    public function pointGet($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null
        ];
        $this->getResult('activity-point-get', $apiParams);
    }

    /**
     * 创建积分活动
     */
    public function pointCreate($params)
    {
        $apiParams = [
            'activity' => [
                'name' => isset($params['activity']['name']) ? $params['activity']['name'] : null,
                'desc' => isset($params['activity']['desc']) ? $params['activity']['desc'] : null,
                'name' => isset($params['activity']['name']) ? $params['activity']['name'] : null,
                'sort' => isset($params['activity']['sort']) ? $params['activity']['sort'] : null,
                'expire_type' => isset($params['activity']['expire_type']) ? $params['activity']['expire_type'] : null,
                'relate_product_type' => isset($params['activity']['relate_product_type']) ? $params['activity']['relate_product_type'] : null,
                'activity_type' => isset($params['activity']['activity_type']) ? $params['activity']['activity_type'] : null,
                'share_message_id' => isset($params['activity']['share_message_id']) ? $params['activity']['share_message_id'] : null,
                'wx_imagetxt_reply_id' => isset($params['activity']['wx_imagetxt_reply_id']) ? $params['activity']['wx_imagetxt_reply_id'] : null,
                'start_time' => isset($params['activity']['start_time']) ? $params['activity']['start_time'] : null,
                'end_time' => isset($params['activity']['end_time']) ? $params['activity']['end_time'] : null,
                'shop_id' => isset($params['activity']['shop_id']) ? $params['activity']['shop_id'] : null,
                'shop_sub_id' => isset($params['activity']['shop_sub_id']) ? $params['activity']['shop_sub_id'] : null
            ],
            'pointsConsumption' => [
                'num' => isset($params['pointsConsumption']['num']) ? $params['pointsConsumption']['num'] : null,
                'type' => isset($params['pointsConsumption']['type']) ? $params['pointsConsumption']['type'] : null,
                'amount' => isset($params['pointsConsumption']['amount']) ? $params['pointsConsumption']['amount'] : null,
                'points' => isset($params['pointsConsumption']['points']) ? $params['pointsConsumption']['points'] : null,
                'count_type' => isset($params['pointsConsumption']['count_type']) ? $params['pointsConsumption']['count_type'] : null
            ]
        ];
        $this->getResult('activity-point-create', $apiParams);
    }

    /**
     * 更新积分活动
     */
    public function pointUpdate($params)
    {
        $apiParams = [
            'activity' => [
                'id' => isset($params['activity']['id']) ? $params['activity']['id'] : null,
                'name' => isset($params['activity']['name']) ? $params['activity']['name'] : null,
                'desc' => isset($params['activity']['desc']) ? $params['activity']['desc'] : null,
                'name' => isset($params['activity']['name']) ? $params['activity']['name'] : null,
                'sort' => isset($params['activity']['sort']) ? $params['activity']['sort'] : null,
                'expire_type' => isset($params['activity']['expire_type']) ? $params['activity']['expire_type'] : null,
                'start_time' => isset($params['activity']['start_time']) ? $params['activity']['start_time'] : null,
                'end_time' => isset($params['activity']['end_time']) ? $params['activity']['end_time'] : null,
                'shop_id' => isset($params['activity']['shop_id']) ? $params['activity']['shop_id'] : null,
            ],
            'pointsConsumption' => [
                'id' => isset($params['pointsConsumption']['id']) ? $params['pointsConsumption']['id'] : null,
                'type' => isset($params['pointsConsumption']['type']) ? $params['pointsConsumption']['type'] : null,
                'amount' => isset($params['pointsConsumption']['amount']) ? $params['pointsConsumption']['amount'] : null,
                'points' => isset($params['pointsConsumption']['points']) ? $params['pointsConsumption']['points'] : null,
                'count_type' => isset($params['pointsConsumption']['count_type']) ? $params['pointsConsumption']['count_type'] : null
            ]
        ];
        $this->getResult('activity-point-update', $apiParams);
    }

    /**
     * 开启活动
     * @param $params
     */
    public function pointOpen($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('activity-point-open', $apiParams);
    }

    /**
     * 关闭活动
     * @param $params
     */
    public function pointClose($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('activity-point-close', $apiParams);
    }

    /**
     * 删除活动
     * @param $params
     */
    public function pointDel($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('activity-point-del', $apiParams);
    }

    /**
     * 添加积分商品
     * @param $params
     */
    public function pointGoodsCreate($params)
    {
        $apiParams = $params;
        $this->getResult('point-goods-create', $apiParams);
    }

    /**
     * 获取积分商品列表
     * @param $params
     */
    public function pointGoodsFind($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('point-goods-find', $apiParams);
    }


    /**
     * 删除积分商品
     * @param $params
     */
    public function pointGoodsDel($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('point-goods-del', $apiParams);
    }
}
