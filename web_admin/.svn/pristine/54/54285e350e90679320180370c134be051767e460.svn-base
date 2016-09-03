<?php
/**
 * Author: Kevin
 * Date: 2015/06/26
 * Time: 15:00
 * 策略
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * FxPolicy model
 */
class FxPolicy extends BaseModel
{
    /**
     * 策略添加
     * @return mixed
     */
    public function create($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'endtime' => isset($params['endtime']) ? $params['endtime'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'operator' => isset($params['operator']) ? $params['operator'] : null,
        ];
        $this->getResult('fx-policy-create',$apiParams);
    }

    /**
     * 策略添加 等级配置
     * @return mixed
     */
    public function createWithLevel($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'endtime' => isset($params['endtime']) ? $params['endtime'] : 0,
            'type' => isset($params['type']) ? $params['type'] : null,
            'operator' => isset($params['operator']) ? $params['operator'] : null,
            'levels' => isset($params['levels']) ? $params['levels'] : null,
        ];
        $this->getResult('fx-policy-create-with-level',$apiParams);
    }

    /**
     * 获取策略列表
     * @return mixed
     */
    public function find($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('fx-policy-list',$apiParams);
    }

    /**
     * 获取策略
     * @return mixed
     */
    public function get($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'policy_id' => isset($params['policy_id']) ? $params['policy_id'] : null,
            //'operator' => isset($params['operator']) ? $params['operator'] : null,
        ];
        $this->getResult('fx-policy-get',$apiParams);
    }

    /**
     * 删除策略
     * @return mixed
     */
    public function del($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'operator' => isset($params['operator']) ? $params['operator'] : null,
        ];

        $this->getResult('fx-policy-del',$apiParams);
    }

    /**
     * 策略更新
     * @return mixed
     */
    public function update($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'policy_id' => isset($params['policy_id']) ? $params['policy_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'endtime' => isset($params['endtime']) ? $params['endtime'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'operator' => isset($params['operator']) ? $params['operator'] : null,
        ];
        pr($params);
        $this->getResult('fx-policy-update',$apiParams);
    }

    /**
     * 策略更新 等级配置
     * @return mixed
     */
    public function updateWithLevel($params)
    {
        $apiParams = [
            'policy_id' => isset($params['policy_id']) ? $params['policy_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'endtime' => isset($params['endtime']) ? $params['endtime'] : 0,
            'type' => isset($params['type']) ? $params['type'] : null,
            'operator' => isset($params['operator']) ? $params['operator'] : null,
            'levels' => isset($params['levels']) ? $params['levels'] : null,
        ];
        $this->getResult('fx-policy-update-with-level',$apiParams);
    }

    /**
     * 策略启用
     * @return mixed
     */
    public function enable($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'operator' => isset($params['operator']) ? $params['operator'] : null,
        ];
        $this->getResult('fx-policy-enable',$apiParams);
    }

     /**
     * 策略禁用
     * @return mixed
     */
    public function disable($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'operator' => isset($params['operator']) ? $params['operator'] : null,
        ];
        $this->getResult('fx-policy-disable',$apiParams);
    }

}
