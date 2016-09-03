<?php
/**
 * Author: LiuPing
 * Date: 2015/07/2
 * Time: 15:15
 */
namespace common\models;

use common\cache\PointRedeemCache;
use Yii;

/**
 * pointRedeem model
 */
class PointRedeem extends BaseModel
{

    // 类缓存前缀
    const CACHE_KEY_PRE = 'models_pointRedeemredeem_';
    /**
     * 类型 2.百分比
     */
    const TYPE_DISCOUNT = 2;
    /**
     * 有效期类型 1.指定时间范围
     */
    const TYPE_LIMIT_TIME = 1;

    protected $pointRedeemCache ;

    public function init()
    {
        $this->pointRedeemCache = new PointRedeemCache();
    }

    /**
     * 获取积分活动列表
     */
    public function find($params)
    {
        $data = $this->pointRedeemCache->getFind($params);
        if($data !== false){
            return $this->setResult($data);
        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('point-redeem-find', $apiParams);
        //再从新设置缓存
        if ( ! is_null($this->_data)){
            $this->pointRedeemCache->setFind($params, $this->_data);
        }
    }

    /**
     * 获取积分活动信息
     */
    public function get($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'points_redeem_id' => isset($params['points_redeem_id']) ? $params['points_redeem_id'] : null
        ];
        $this->getResult('point-redeem-get', $apiParams);
    }

    /**
     * 创建积分活动
     */
    public function create($params)
    {
        $this->pointRedeemCache->delFind($params);
        $apiParams = [
            'name' => isset($params['name']) ? $params['name'] : null,
            'min_consumption' => isset($params['min_consumption']) ? $params['min_consumption'] : null,
            'max_amount' => isset($params['max_amount']) ? $params['max_amount'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'unit_points' => isset($params['unit_points']) ? $params['unit_points'] : null,
            'unit_amount' => isset($params['unit_amount']) ? $params['unit_amount'] : null,
            'expire_type' => isset($params['expire_type']) ? $params['expire_type'] : null,
            'wx_imagetxt_reply_id' => isset($params['wx_imagetxt_reply_id']) ? $params['wx_imagetxt_reply_id'] : null,
            'start_time' => isset($params['start_time']) ? $params['start_time'] : null,
            'end_time' => isset($params['end_time']) ? $params['end_time'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('point-redeem-create', $apiParams);
    }

    /**
     * 更新积分活动
     */
    public function update($params)
    {
        $this->pointRedeemCache->delFind($params);
        $apiParams = [
            'points_redeem_id' => isset($params['points_redeem_id']) ? $params['points_redeem_id'] : null, //活动id
            'name' => isset($params['name']) ? $params['name'] : null,
            'min_consumption' => isset($params['min_consumption']) ? $params['min_consumption'] : null,
            'max_amount' => isset($params['max_amount']) ? $params['max_amount'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'unit_points' => isset($params['unit_points']) ? $params['unit_points'] : null,
            'unit_amount' => isset($params['unit_amount']) ? $params['unit_amount'] : null,
            'expire_type' => isset($params['expire_type']) ? $params['expire_type'] : null,
            'start_time' => isset($params['start_time']) ? $params['start_time'] : null,
            'end_time' => isset($params['end_time']) ? $params['end_time'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('point-redeem-update', $apiParams);
    }

    /**
     * 开启活动
     * @param $params
     */
    public function open($params)
    {
        $this->pointRedeemCache->delFind($params);
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('point-redeem-open', $apiParams);
    }

    /**
     * 关闭活动
     * @param $params
     */
    public function close($params)
    {
        $this->pointRedeemCache->delFind($params);
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('point-redeem-close', $apiParams);
    }

    /**
     * 删除活动
     * @param $params
     */
    public function delete($params)
    {
        $this->pointRedeemCache->delFind($params);
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('point-redeem-del', $apiParams);
    }
}
