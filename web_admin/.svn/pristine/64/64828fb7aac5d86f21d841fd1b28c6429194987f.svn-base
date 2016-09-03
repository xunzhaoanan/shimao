<?php
/**
 * Author: LiuPing
 * Date: 2016/03/22
 * Time: 15:05
 */
namespace common\models;

use Yii;

/**
 * signin-setting model
 */
class SigninSetting extends BaseModel
{

    // 类缓存前缀
    const CACHE_KEY_PRE = 'models_signin_';

    /**
     * 获取签到活动列表
     */
    public function find($params)
    {
        //拿接口数据
        $apiParams = [
            'name' => isset($params['name']) ? $params['name'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null
        ];
        $this->getResult('signin-setting-find', $apiParams);
    }

    /**
     * 获取签到活动信息
     */
    public function get($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('signin-setting-get', $apiParams);
    }

    /**
     * 创建签到活动
     */
    public function create($params)
    {
        $apiParams = [
            'pic_url' => isset($params['pic_url']) ? $params['pic_url'] : null,
            'limit_count' => isset($params['limit_count']) ? $params['limit_count'] : null,
            'is_subscribe' => isset($params['is_subscribe']) ? $params['is_subscribe'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'start_time' => isset($params['start_time']) ? $params['start_time'] : null,
            'end_time' => isset($params['end_time']) ? $params['end_time'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        array_remove_empty($apiParams);
        $this->getResult('signin-setting-create', $apiParams);
    }

    /**
     * 开启活动
     * @param $params
     */
    public function open($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('signin-setting-open', $apiParams);
    }

    /**
     * 更新签到活动
     */
    public function update($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'pic_url' => isset($params['pic_url']) ? $params['pic_url'] : null,
            'limit_count' => isset($params['limit_count']) ? $params['limit_count'] : null,
            'is_subscribe' => isset($params['is_subscribe']) ? $params['is_subscribe'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'start_time' => isset($params['start_time']) ? $params['start_time'] : null,
            'end_time' => isset($params['end_time']) ? $params['end_time'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        array_remove_empty($apiParams);
        $this->getResult('signin-setting-update', $apiParams);
    }

    /**
     * 关闭活动
     * @param $params
     */
    public function close($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('signin-setting-close', $apiParams);
    }

    /**
     * 删除活动
     * @param $params
     */
    public function delete($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('signin-setting-del', $apiParams);
    }

    /**
     * * 获取签到者签到信息详情
     */
    public function getUserData($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null, //用户签到id
            'signin_setting_id' => isset($params['signin_setting_id']) ? $params['signin_setting_id'] : null, //签到活动id
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('signin-setting-get-user-data', $apiParams);
    }

    /**
     * 获取签到用户列表
     * @param $params
     */
    public function findJoinUser($params)
    {
        $apiParam = [
            'signin_setting_id' => isset($params['signin_setting_id']) ? $params['signin_setting_id'] : null, //活动id
            'nickName' => isset($params['nickName']) ? $params['nickName'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('signin-setting-find-user-data', $apiParam);
    }

    /**
     * 统计签到人数
     * @param $params
     */
    public function countJoinUser($params)
    {
        $apiParam = [
            'id' => isset($params['id']) ? $params['id'] : null, //活动id
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('signin-setting-count-join', $apiParam);
    }

    /**
     * 新增签到用户信息
     * @param $params
     */
    public function signin($params)
    {
        $apiParam = [
            'signin_setting_id' => isset($params['signin_setting_id']) ? $params['signin_setting_id'] : null, //活动id
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('signin-setting-create-user-data', $apiParam);
    }
}
