<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 10:50
 */

namespace common\services\activity;

use common\cache\ActivityCache;
use common\models\Activity;
use common\models\Member;
use common\models\SecondKill;
use common\models\Staff;
use common\services\BaseService;
use common\services\member\MemberService;

class ActivityService extends BaseService
{

    protected $activityModel;
    //跳转链接，活动在不同的状态时，需要跳转到不同的url

    //初始设置不同活动关联产品类型的对应值
    static public $relate_product_type = [
        Activity::SECONDKILL => Activity::RELATE_PRODUCT_TYPE_BY_TABLE,
        Activity::QR_DISCOUNT => Activity::RELATE_PRODUCT_TYPE_BY_TABLE,
        Activity::PRE_SALE => Activity::RELATE_PRODUCT_TYPE_BY_TABLE,
        Activity::POINT => Activity::RELATE_PRODUCT_TYPE_ALL,
        Activity::TOGETHERBUY => Activity::RELATE_PRODUCT_TYPE_BY_TABLE
    ];

    public function init()
    {
        $this->activityModel = new Activity();
    }

    /**
     * 创建空白活动
     * @param $params
     */
    public function createBlank($params, $type)
    {
        if (!isset($params) || empty($params) || !isset($params['news'])) {
            return $this->setError('数据有误');
        }
        //设置活动默认值
        $params = $this->setDefaultValue($params, $type);
        //判断活动时间
        $this->checkActivityTime($params['activity']);
        //创建活动
        $this->activityModel->create($params, $type);
        // 接收数据层处理结果
        if (!is_null($this->activityModel->getError())) {
            return $this->setError($this->activityModel->getError());
        }
        $this->setResult($this->activityModel->_data);
    }

    /**
     * 设置活动默认值
     * @param $params
     * @param $type
     * @return array
     */
    public function setDefaultValue($params, $type)
    {
        //设置关联产品类型值
        $this->setRelateProductType($params['activity'], $type);
        //设置活动默认值
        $default = $this->activityModel->setDefaultValue($type);
        return array_merge_recursive($default, $params);
    }

    /**
     * 检查时间设置
     * expire_type =1 时需验证开始结束时间
     * @param $params
     * @param bool $is_expire_type 是否有参数$params['expire_type']
     * @return bool
     */
    public function checkActivityTime($params, $is_expire_type = true)
    {
        if($is_expire_type){
            //活动时间类型设置判断
            if (!isset($params['expire_type']) || empty($params['expire_type'])) {
                $this->setError('活动时间设置类型不能为空');
                return false;
            }
            //为指定时间类型 则进行时间判断
            if ($params['expire_type'] == Activity::VALIDITY_SCHEDULE_TIME) {
                if (empty($params['start_time']) || empty($params['end_time'])) {
                    $this->setError('活动时间不能为空');
                    return false;
                }
                if ($params['start_time'] >= $params['end_time']) {
                    $this->setError('活动开始时间要小于结束时间');
                    return false;
                }
            }
        }else{
            if (empty($params['start_time']) || empty($params['end_time'])) {
                $this->setError('活动时间不能为空');
                return false;
            }
            if ($params['start_time'] >= $params['end_time']) {
                $this->setError('活动开始时间要小于结束时间');
                return false;
            }
        }

        return true;
    }

    /**
     * 设置关联产品类型值
     * @param $params
     * @param $activity_type
     */
    public function setRelateProductType(&$params, $activity_type)
    {
        //设置为关联产品类型
        if (in_array($activity_type, array_keys(self::$relate_product_type))) {
            $params['relate_product_type'] = self::$relate_product_type[$activity_type];
        }
    }

    /**
     * 格式化，获取的活动相关数据
     * @param $model
     * @param $name  不同活动键值名称 如：secondKill|
     * @param string $activity_name 活动表，区分activity和collect
     * @return array
     */
    public function formatData($model, $name, $activity_name = 'activity')
    {
        if (!empty($model)) {
            $tmp_model = [];
            //对应活动设置信息
            if (isset($model[$name]) && !empty($model)) {
                $tmp_model[$name] = $model[$name];
                unset($model[$name]);
            }
            //邮费设置信息
            if (isset($model['postageSetting'])) {
                $tmp_model['postageSetting'] = $model['postageSetting'];
                unset($model['postageSetting']);
            }
            //分享设置信息
            if (isset($model['shareMessage'])) {
                $tmp_model['shareMessage'] = $model['shareMessage'];
                unset($model['shareMessage']);
            }
            //图文设置信息
            if (isset($model['news'])) {
                $tmp_model['news'] = $model['news'];
                unset($model['news']);
            }
            $tmp_model[$activity_name] = $model;//pr($model);
            return $tmp_model;
        }
        return $model;
    }

    /**
     * 通用接口:获取活动详情
     * @param $params
     * @param $type
     */
    public function getGeneral($params, $type, $key)
    {
        $this->activityModel->get($params, $type);
        // 接收数据层处理结果
        if (is_null($this->activityModel->_data)) { //数据为空返回错误信息
            return false;
        }
        //处理数据 将从接口获取的数据 组合成 ['activity' => [], 'secondKill' => [], 'news' => [], 'postageSetting' => [], 'shareMessage' => []]的格式

        $this->activityModel->_data = $this->formatData($this->activityModel->_data, $key);
        return $this->activityModel->_data;
    }

    /**
     * 判断活动是否过期 或开启 或未开始
     * @param $paramas
     */
    public function isActive($data)
    {
        //是否开启活动
        if (isset($data['deleted']) && $data['deleted'] == Activity::STATUS_CLOSE) {
            return Activity::ERROR_CLOSE_CODED;
        }
        //活动不存在
        if (isset($data['deleted']) && $data['deleted'] == Activity::STATUS_DELETED) {
            return Activity::ERROR_DELETED_CODED;
        }
        //活动未开始
        $time = time();
        if ($data['start_time'] > $time) {
            return Activity::ERROR_UNSTART_CODED;
        }
        //活动已过期
        if ($data['end_time'] < $time) {
            return Activity::ERROR_EXPIRE_CODED;
        }
        return true;
    }

    /**
     * 判断用户是否是强制关注
     * is_attention ， 表示活动字段值
     * user_id ， 表示当前用户id，
     * shop_id ， 表示当前活动的公众号
     * @param $paramas
     */
    static public function isAttention($params)
    {
        // 1、不强制关注
        if ($params['is_attention'] == Activity::NO_MUCH_SUBSCRIBE) {
            return false;
        }
        // 2、强制关注就去检查用户是否关注
        $user = new MemberService();
        $params['isReflash'] = true; //不从session里拿数据
        $user->get($params);
        ////没有用户信息就强制关注
        if (is_null($user->_data)) {
            return true;
        }
        //没关注
        if ($user->_data['is_subscribe'] == Member::UN_ATTENTION) {
            return true;
        }

        return false;
    }


    /**
     * 判断核销员权限
     * @return bool|string
     */
    public static function checkMember($userInfo)
    {
        //不是核销员
        if (
            empty($userInfo['staff_id']) ||
            (
                isset($userInfo['shopStaff']) &&
                $userInfo['shopStaff']['is_cancel'] == Staff::IS_CANCEL_FALSE && //不是核销员
                $userInfo['shopStaff']['is_super_cancel'] == Staff::IS_CANCEL_FALSE &&//不是超级核销员
                $userInfo['shopStaff']['shop_manager_id'] == 0 //操作员(shop_manager_id>0)都可以核销
            )
        ) {
            return false;
        }
        return true;
    }

    /**
     * 线下活动用户扫码标识，将用户open_id写入缓存
     * @param $params
     * @param $data 活动详情
     * @return bool
     */
    static public function sureScan($params, $data)
    {
        if (isset($data['share_type']) && $data['share_type'] == Activity::SHARE_TYPE_NO_ALL) {
            if (empty($params['open_id'])) {
                return false;
            }
            $openId = $params['open_id'];
            $params = [
                'type' => $params['activity_type'],
                'id' => $params['id'],
                'shop_id' => $params['shop_id']
            ];
            $activityCache = new ActivityCache();
            //活动未过期时缓存
            if (isset($data['end_time']) && $data['end_time'] > time()) {
                //缓存时间设置活动过期时间
                $expireTime = $data['end_time'] - time();
                $activityCache->setActivityScan($params, $openId, $expireTime);
            } else {
                $activityCache->delActivityScan($params);
            }
        }
    }
}