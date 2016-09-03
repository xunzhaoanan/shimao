<?php
/**
 * Author: Kevin
 * Date: 2015/06/26
 * Time: 15:00
 * 分销支付类型
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * FxPayType model
 */
class FxPayType extends BaseModel
{
    /**
     * 支付类型添加
     * @return mixed
     */
    public function create($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'note' => isset($params['note']) ? $params['note'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
        ];
        $this->getResult('fx-pay-type-create',$apiParams);
    }

    /**
     * 获取支付类型列表
     * @return mixed
     */
    public function find($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
        ];
        $this->getResult('fx-pay-type-list',$apiParams);
    }

    /**
     * 获取支付类型
     * @return mixed
     */
    public function get($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'type_id' => isset($params['type_id']) ? $params['type_id'] : null,
        ];
        $this->getResult('fx-pay-type-del',$apiParams);
    }

    /**
     * 支付类型更新
     * @return mixed
     */
    public function update($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'type_id' => isset($params['type_id']) ? $params['type_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'note' => isset($params['note']) ? $params['note'] : null,
        ];
        $this->getResult('fx-pay-type-update',$apiParams);
    }

    /**
     * 支付类型开启
     * @return mixed
     */
    public function open($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'type_id' => isset($params['type_id']) ? $params['type_id'] : null,
        ];
        $this->getResult('fx-pay-type-open',$apiParams);
    }

    /**
     * 支付类型关闭
     * @return mixed
     */
    public function close($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'type_id' => isset($params['type_id']) ? $params['type_id'] : null,
        ];
        $this->getResult('fx-pay-type-close',$apiParams);
    }

    /**
     * 支付类型删除
     * @return mixed
     */
    public function del($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'type_id' => isset($params['type_id']) ? $params['type_id'] : null,
        ];
        $this->getResult('fx-pay-type-del',$apiParams);
    }

}
