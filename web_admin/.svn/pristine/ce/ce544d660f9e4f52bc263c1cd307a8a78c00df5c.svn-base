<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * BackScript model
 */
class BackScript extends BaseModel
{

    /**
     * 转发请求至后台处理脚本
     * @return mixed
     */
    public function transferToBackScript($url,$params)
    {
        $this->transferDataOnly($url,$params);
    }
    /**
     * 用户关注公众号
     * @return mixed
     */
    public function attentionBackground($params)
    {
        //post数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'open_id' => isset($params['open_id']) ? $params['open_id'] : null,
            'mobile' => isset($params['mobile']) ? $params['mobile'] : null,
            'province' => isset($params['province']) ? $params['province'] : null,
            'nickname' => isset($params['nickname']) ? $params['nickname'] : null,
            'sex' => isset($params['sex']) ? $params['sex'] : null,
            'city' => isset($params['city']) ? $params['city'] : null,
            'country' => isset($params['country']) ? $params['country'] : null,
            'headimgurl' => isset($params['headimgurl']) ? $params['headimgurl'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'group_id' => isset($params['group_id']) ? $params['group_id'] : 1,
            'password' => isset($params['password']) ? $params['password'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'scene_id' => isset($params['scene_id']) ? $params['scene_id'] : null,
            'mpath' => isset($params['mpath']) ? $params['mpath'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
            'is_subscribe' => isset($params['is_subscribe']) ? $params['is_subscribe'] : 1,
            'level_id' => isset($params['level_id']) ? $params['level_id'] : null,
            'point' => isset($params['point']) ? $params['point'] : null,
            'wsh_code' => isset($params['wsh_code']) ? $params['wsh_code'] : null
        ];
        $this->postDataOnly('wx-user-attention',$apiParams);
    }
    /**
     * 用户扫码订单归属
     * @return mixed
     */
    public function userBelongByScanOrderBackground($params)
    {
        //post数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'open_id' => isset($params['open_id']) ? $params['open_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null
        ];
        $this->postDataOnly('wx-user-attention',$apiParams);
    }
}
