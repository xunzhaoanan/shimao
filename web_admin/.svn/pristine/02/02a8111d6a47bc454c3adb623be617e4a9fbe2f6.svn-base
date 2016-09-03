<?php
/**
 * Author: LiuPing
 * Date: 2015/07/02
 * Time: 21:05
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Reserve model
 */
class Reserve extends BaseModel
{

    // 类缓存前缀
    const CACHE_KEY_PRE = 'models_reserve_';
    /**
     * 状态：预约成功
     */
    const STATUS_RESERVE_SUCCESS = 1;
    /**
     * 状态：签到成功
     */
    const STATUS_SIGN_SUCCESS = 2;
    /**
     * 状态：拒绝成功
     */
    const STATUS_REJECT_SUCCESS = 3;

    /**
     * 预约项设置默认值
     * @return array
     */
    static public function getDefault($shopList)
    {
        $defalt = [
            ['nametag' => 'name', 'type' => 'text', 'key' => '姓名', 'value' => '请输入您的名字', 'check' => false, 'addtype' => 'system'],
            ['nametag' => 'sex', 'type' => 'select', 'key' => '性别', 'value' => '男|女', 'check' => false, 'addtype' => 'system'],
            ['nametag' => 'mobile', 'type' => 'text', 'key' => '手机', 'value' => '请输入您的手机', 'check' => false, 'addtype' => 'system'],
            ['nametag' => 'idCard', 'type' => 'text', 'key' => '身份证', 'value' => '请输入您的身份证号码', 'check' => false, 'addtype' => 'system'],
            ['nametag' => 'bookedDate', 'type' => 'calendar', 'key' => '预约日期', 'value' => '点击输入', 'check' => false, 'addtype' => 'system'],
            ['nametag' => 'bookedTime', 'type' => 'select', 'key' => '预约时间', 'value' => '0:00-1:00|1:00-2:00|2:00-3:00|3:00-4:00|4:00-5:00|5:00-6:00|6:00-7:00|7:00-8:00|8:00-9:00|9:00-10:00|10:00-11:00|11:00-12:00|12:00-13:00|13:00-14:00|14:00-15:00|15:00-16:00|16:00-17:00|17:00-18:00|18:00-19:00|19:00-20:00|20:00-21:00|21:00-22:00|22:00-23:00|23:00-24:00', 'check' => false, 'addtype' => 'system'],
            ['nametag' => 'message', 'type' => 'textarea', 'key' => '留言', 'value' => '请输入您的留言内容', 'check' => false, 'addtype' => 'system'],
            //获取店铺列表
            ['nametag' => 'fShop', 'type' => 'select', 'key' => '预约店铺', 'value' => $shopList, 'check' => false, 'addtype' => 'system']
        ];
        return $defalt;
    }

    /**
     * 获取预约活动列表
     */
    public function find($params)
    {
        //拿接口数据
        $apiParams = [
            'title' => isset($params['title']) ? $params['title'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'share_type' => isset($params['share_type']) ? $params['share_type'] : null
        ];
        $this->getResult('reserve-find', $apiParams);
    }

    /**
     * 获取预约活动信息
     */
    public function get($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'summary' => isset($params['summary']) ? $params['summary'] : null,
            'note' => isset($params['note']) ? $params['note'] : null,
            'content' => isset($params['content']) ? $params['content'] : null,
            'items' => isset($params['items']) ? $params['items'] : null,
            'document_id' => isset($params['document_id']) ? $params['document_id'] : null,
            'per_count' => isset($params['per_count']) ? $params['per_count'] : null,
            'start_time' => isset($params['start_time']) ? $params['start_time'] : null,
            'end_time' => isset($params['end_time']) ? $params['end_time'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null

        ];
        $this->getResult('reserve-get', $apiParams);
    }

    /**
     * 创建预约活动
     */
    public function create($params)
    {
        $apiParams = [
            'reserveSetting' => [
                'title' => isset($params['reserveSetting']['title']) ? $params['reserveSetting']['title'] : null,
                'summary' => isset($params['reserveSetting']['summary']) ? $params['reserveSetting']['summary'] : null,
                'note' => isset($params['reserveSetting']['note']) ? $params['reserveSetting']['note'] : null,
                'content' => isset($params['reserveSetting']['content']) ? $params['reserveSetting']['content'] : null,
                'items' => isset($params['reserveSetting']['items']) ? $params['reserveSetting']['items'] : null,
                'document_id' => isset($params['reserveSetting']['document_id']) ? $params['reserveSetting']['document_id'] : null,
                'per_count' => isset($params['reserveSetting']['per_count']) ? $params['reserveSetting']['per_count'] : null,
                'start_time' => isset($params['reserveSetting']['start_time']) ? $params['reserveSetting']['start_time'] : null,
                'end_time' => isset($params['reserveSetting']['end_time']) ? $params['reserveSetting']['end_time'] : null,
                'shop_id' => isset($params['reserveSetting']['shop_id']) ? $params['reserveSetting']['shop_id'] : null,
                'shop_sub_id' => isset($params['reserveSetting']['shop_sub_id']) ? $params['reserveSetting']['shop_sub_id'] : null,
                'share_type' => isset($params['reserveSetting']['share_type']) ? $params['reserveSetting']['share_type'] : null
            ],
            'shareMessage' => [
                'title' => isset($params['shareMessage']['title']) ? $params['shareMessage']['title'] : null,
                'desc' => isset($params['shareMessage']['desc']) ? $params['shareMessage']['desc'] : null,
                'pic_id' => isset($params['shareMessage']['pic_id']) ? $params['shareMessage']['pic_id'] : null,
            ],
            'news' => [
                'title' => isset($params['news']['title']) ? $params['news']['title'] : null,
                'description' => isset($params['news']['description']) ? $params['news']['description'] : null,
                'document_id' => isset($params['news']['document_id']) ? $params['news']['document_id'] : null,
                'content' => isset($params['news']['content']) ? $params['news']['content'] : null
            ]
        ];
        array_remove_empty($apiParams);
        $this->getResult('reserve-create', $apiParams);
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
        $this->getResult('reserve-open', $apiParams);
    }

    /**
     * 更新预约活动
     */
    public function update($params)
    {
        $apiParams = [
            'reserveSetting' => [
                'id' => isset($params['reserveSetting']['id']) ? $params['reserveSetting']['id'] : null,
                'title' => isset($params['reserveSetting']['title']) ? $params['reserveSetting']['title'] : null,
                'summary' => isset($params['reserveSetting']['summary']) ? $params['reserveSetting']['summary'] : null,
                'note' => isset($params['reserveSetting']['note']) ? $params['reserveSetting']['note'] : null,
                'content' => isset($params['reserveSetting']['content']) ? $params['reserveSetting']['content'] : null,
                'items' => isset($params['reserveSetting']['items']) ? $params['reserveSetting']['items'] : null,
                'document_id' => isset($params['reserveSetting']['document_id']) ? $params['reserveSetting']['document_id'] : null,
                'per_count' => isset($params['reserveSetting']['per_count']) ? $params['reserveSetting']['per_count'] : null,
                'start_time' => isset($params['reserveSetting']['start_time']) ? $params['reserveSetting']['start_time'] : null,
                'end_time' => isset($params['reserveSetting']['end_time']) ? $params['reserveSetting']['end_time'] : null,
                'shop_id' => isset($params['reserveSetting']['shop_id']) ? $params['reserveSetting']['shop_id'] : null,
                'shop_sub_id' => isset($params['reserveSetting']['shop_sub_id']) ? $params['reserveSetting']['shop_sub_id'] : null,
                'share_type' => isset($params['reserveSetting']['share_type']) ? $params['reserveSetting']['share_type'] : null
            ],
            'news' => [
                'title' => isset($params['news']['title']) ? $params['news']['title'] : null,
                'description' => isset($params['news']['description']) ? $params['news']['description'] : null,
                'document_id' => isset($params['news']['document_id']) ? $params['news']['document_id'] : null,
                'content' => isset($params['news']['content']) ? $params['news']['content'] : null
            ],
            'shareMessage' => [
                'title' => isset($params['shareMessage']['title']) ? $params['shareMessage']['title'] : null,
                'desc' => isset($params['shareMessage']['desc']) ? $params['shareMessage']['desc'] : null,
                'pic_id' => isset($params['shareMessage']['pic_id']) ? $params['shareMessage']['pic_id'] : null
            ]
        ];
        array_remove_empty($apiParams);
        $this->getResult('reserve-update', $apiParams);
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
        $this->getResult('reserve-close', $apiParams);
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
        $this->getResult('reserve-del', $apiParams);
    }

    /**
     * 删除用户预约信息
     * @param $params
     */
    public function delUserData($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'reserve_setting_id' => isset($params['reserve_setting_id']) ? $params['reserve_setting_id'] : null,
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('reserve-del-user-data', $apiParams);
    }

    /**
     * * 获取预约者预约信息详情
     */
    public function getUserData($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null, //用户预约id
            'reserve_setting_id' => isset($params['reserve_setting_id']) ? $params['reserve_setting_id'] : null, //预约活动id
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('reserve-get-user-data', $apiParams);
    }

    /**
     * 获取签到用户列表
     * @param $params
     */
    public function joinUser($params)
    {
        $apiParam = [
            'reserve_setting_id' => isset($params['reserve_setting_id']) ? $params['reserve_setting_id'] : null, //活动id
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('reserve-find-user-data', $apiParam);
    }

    /**
     * 新增预约用户信息
     * @param $params
     */
    public function createUserData($params)
    {
        $apiParam = [
            'reserve_setting_id' => isset($params['reserve_setting_id']) ? $params['reserve_setting_id'] : null, //活动id
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null,
            'user_data' => isset($params['user_data']) ? $params['user_data'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        array_remove_empty($apiParam);
        $this->getResult('reserve-create-user-data', $apiParam);
    }

    /**
     * 修改预约用户信息
     * status 【1：预约成功，2：签到成功，3：拒绝成功】
     * @param $params
     */
    public function updateUserData($params)
    {
        $apiParam = [
            'id' => isset($params['id']) ? $params['id'] : null, //活动id
            'reserve_setting_id' => isset($params['reserve_setting_id']) ? $params['reserve_setting_id'] : null, //活动id
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null,
            'user_data' => isset($params['user_data']) ? $params['user_data'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        array_remove_empty($apiParam);
        $this->getResult('reserve-update-user-data', $apiParam);
    }

    /**
     * 修改status 签到|拒绝预约
     * @param $params
     */
    public function changeStatus($params)
    {
        $apiParam = [
            'id' => isset($params['id']) ? $params['id'] : null, //活动id
            'reserve_setting_id' => isset($params['reserve_setting_id']) ? $params['reserve_setting_id'] : null, //活动id
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'status' => isset($params['status']) ? $params['status'] : null
        ];
        array_remove_empty($apiParam);//pr(json_encode($apiParam));
        $this->getResult('reserve-update-user-data', $apiParam);
    }

    /**
     * 预约用户通过
     * @param $params
     */
    public function userPass($params)
    {
        $apiParam = [
            'id' => isset($params['id']) ? $params['id'] : null, //活动id
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];

        $this->getResult('reserve-pass-user-data', $apiParam);
    }

    /**
     * 预约用户拒绝
     * @param $params
     */
    public function userReject($params)
    {
        $apiParam = [
            'id' => isset($params['id']) ? $params['id'] : null, //活动id
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('reserve-reject-user-data', $apiParam);
    }
}
