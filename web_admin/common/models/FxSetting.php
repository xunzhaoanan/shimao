<?php
/**
 * Author: Kevin
 * Date: 2015/06/30
 * Time: 15:00
 * 分销商家设置
 */
namespace common\models;

use Yii;
use yii\base\Model;
use yii\helpers\StringHelper;

/**
 * FxSetting model
 */
class FxSetting extends BaseModel
{
    /**
     * 设置分销处理页面过滤器
     * @var array
     */
    public static $filter = [
        'mall/index', 'mall/index-copy', 'mall/home', 'cppage/detail', 'product/category', 'product/detail', 'surprise/index', 'collect/list', 'collect-zan/zan', 'reserve/list', 'second-kill/list', 'card-coupons/card', 'card-coupons/card-list', 'grouppack/receive', 'redpack/list', 'market-activity/list', 'market-activity/activity','fx-member/card', 'fx-member/shop', 'fx/qrcode', 'together-buy/list'
    ];

    /**
     * 分销设置添加
     * @return mixed
     */
    public function create($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'agreement' => isset($params['agreement']) ? $params['agreement'] : null,
            'type' => isset($params['type']) ? $params['type'] : 1,
            'integral' => isset($params['integral']) ? $params['integral'] : 0,
            'money' => isset($params['money']) ? $params['money'] : 0,
            'img_empower' => isset($params['img_empower']) ? (string)$params['img_empower'] : null,
            'img_top' => isset($params['img_top']) ? (string)$params['img_top'] : null,
        ];
        $this->getResult('fx-setting-create',$apiParams);
    }

    /**
     * 获取分销设置
     * @return mixed
     */
    public function get($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('fx-setting-get',$apiParams);
    }

    /**
     * 分销设置更新
     * @return mixed
     */
    public function update($params)
    {
        $apiParams = [
            'setting_id' => isset($params['setting_id']) ? $params['setting_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'agreement' => isset($params['agreement']) ? $params['agreement'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'integral' => isset($params['integral']) ? $params['integral'] : null,
            'money' => isset($params['money']) ? $params['money'] : null,
            'img_empower' => isset($params['img_empower']) ? (string)$params['img_empower'] : null,
            'img_top' => isset($params['img_top']) ? (string)$params['img_top'] : null,
        ];
        $this->getResult('fx-setting-update',$apiParams);
    }

    /**
     * 开启申请
     * @return mixed
     */
    public function openApply($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('fx-setting-apply-open',$apiParams);
    }

    /**
     * 关闭申请
     * @return mixed
     */
    public function closeApply($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('fx-setting-apply-close',$apiParams);
    }

}
