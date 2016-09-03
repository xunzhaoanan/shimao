<?php
/**
 * Author: Kevin
 * Date: 2015/06/30
 * Time: 15:00
 * 分销操作日志
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * FxOperationLog model
 */
class FxOperationLog extends BaseModel
{
    // 1 策略
    const TYPE_STRATEGY = 1;

    //6 导出
    const TYPE_EXPORT = 6;

    /**
     * 获取分销操作日志列表
     * @return mixed
     */
    public function find($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
        ];
        $this->getResult('fx-operation-log-list',$apiParams);
    }

}
