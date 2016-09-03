<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 10:55
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Mall model
 */
class Pos extends BaseModel
{

    /**
     * Pos统计列表
     */
    public function posCountList($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
        ];
        $this->getResult('find-pos-count-list',$apiParams);
    }

    public function editDesc($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'description' => isset($params['description']) ? $params['description'] : null,
        ];
        $this->getResult('update-pos-desc',$apiParams);
    }

    public function posInfo($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('get-pos-desc',$apiParams);
    }

}
