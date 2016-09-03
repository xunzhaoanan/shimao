<?php
/**
 * Author: Kevin
 * Date: 2015/06/30
 * Time: 15:00
 * 分销员等级
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * FxMemberLevel model
 */
class FxMemberLevel extends BaseModel
{
    /**
     * 分销员等级添加
     * @return mixed
     */
    public function create($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'total' => isset($params['total']) ? $params['total'] : null,
            'brokeragee' => isset($params['brokeragee']) ? $params['brokeragee'] : null,
        ];
        $this->getResult('fx-member-level-create',$apiParams);
    }

    /**
     * 获取分销员等级列表
     * @return mixed
     */
    public function find($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sorStr' => isset($params['sorStr']) ? $params['sorStr'] : null,
        ];
        $this->getResult('fx-member-level-list',$apiParams);
    }

    /**
     * 获取分销员等级
     * @return mixed
     */
    public function get($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'level_id' => isset($params['level_id']) ? $params['level_id'] : null,
        ];
        $this->getResult('fx-member-level-get',$apiParams);
    }

    /**
     * 分销员等级更新
     * @return mixed
     */
    public function update($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'level_id' => isset($params['level_id']) ? $params['level_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'total' => isset($params['total']) ? $params['total'] : null,
            'brokeragee' => isset($params['brokeragee']) ? $params['brokeragee'] : null,
        ];
        $this->getResult('fx-member-level-update',$apiParams);
    }


    /**
     * 分销员等级删除
     * @return mixed
     */
    public function del($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('fx-member-level-del',$apiParams);
    }

}
