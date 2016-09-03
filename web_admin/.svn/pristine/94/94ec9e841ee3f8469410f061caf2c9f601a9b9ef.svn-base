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
class Point extends BaseModel
{

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
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('second-kill-find', $apiParams);
    }

    /**
     * 获取积分活动信息
     */
    public function pointGet($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['user_id']) ? $params['user_id'] : null,
        ];
        $this->getResult('second-kill-get', $apiParams);
    }

    /**
     * 创建积分活动
     */
    public function pointCreate($params)
    {
        $apiParams = $params;
        $this->getResult('second-kill-create', $apiParams);
    }

    /**
     * 更新积分活动
     */
    public function pointUpdate($params)
    {
        $apiParams = $params;
        $this->getResult('second-kill-update', $apiParams);
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
        $this->getResult('second-kill-open', $apiParams);
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
        $this->getResult('second-kill-close', $apiParams);
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
        $this->getResult('second-kill-del', $apiParams);
    }

    /**
     * 添加积分商品
     * @param $params
     */
    public function pointGoodsCreate($params)
    {
        $apiParams = $params;
        $this->getResult('seckill-goods-create', $apiParams);
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
        $this->getResult('seckill-goods-find', $apiParams);
    }

    /**
     * 修改积分商品
     * @param $params
     */
    public function pointGoodsUpdate($params)
    {
        $apiParams = $params;
        $this->getResult('seckill-goods-update', $apiParams);
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
        $this->getResult('seckill-goods-del', $apiParams);
    }
}
