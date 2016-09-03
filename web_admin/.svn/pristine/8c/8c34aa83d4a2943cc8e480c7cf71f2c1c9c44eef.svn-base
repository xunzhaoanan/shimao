<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 商品类
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * shop model
 */
class Activity extends BaseModel
{

    //活动开启状态
    const STATUS_OPEN = 1;

    //活动关闭状态
    const STATUS_CLOSE = 2;

    //活动删除状态
    const STATUS_DELETED = 3;

    // 展示在惊喜页面和分享1.显示和分享，2.不能显示可分享，3.不能显示不可分享
    const SHARE_TYPE_NORMAL = 1;
    const SHARE_TYPE_NO_SHOW = 2;
    const SHARE_TYPE_NO_ALL = 3;

    // 强制关注
    const YES_MUCH_SUBSCRIBE = 1;

    // 不强制关注
    const NO_MUCH_SUBSCRIBE = 2;

    //活动已关闭错误码
    const ERROR_CLOSE_CODED = -1;

    //活动过期错误码
    const ERROR_EXPIRE_CODED = -2;

    //活动未开始错误码
    const ERROR_UNSTART_CODED = -3;

    //活动未开始错误码
    const ERROR_DELETED_CODED = -4;

    //当前调用的活动类型
    protected $currentActivity;
    //关联产品类型：按关联表
    const RELATE_PRODUCT_TYPE_BY_TABLE = 1;
    //关联产品类型：所有
    const RELATE_PRODUCT_TYPE_ALL = 2;

    //有效期类型：指定时间范围
    const VALIDITY_SCHEDULE_TIME = 1;

    //有效类型：无时间限制
    const VALIDITY_ALL_TIME = 2;

    //秒杀
    const SECONDKILL = 1;
    //预售
    const PRE_SALE = 2;
    //拍码
    const QR_DISCOUNT = 3;
    //积分
    const POINT = 4;
    //祝福墙
    const WALL = 5;
    //红包活动
    const REDPACKET = 6;
    //拼团活动
    const TOGETHERBUY = 7;


    //TODO 添加请求接口
    private $api_add_url = [
        self::POINT => 'activity-point-create',
        self::SECONDKILL => 'second-kill-create',
        self::REDPACKET => 'redpack-create',
        self::PRE_SALE => '',
        self::QR_DISCOUNT => '',
        self::WALL => '',
        self::TOGETHERBUY => 'together-buy-create'
    ];

    //TODO 获取活动详情请求接口
    private $api_get_url = [
        self::POINT => 'activity-point-get',
        self::SECONDKILL => 'second-kill-get',
        self::REDPACKET => 'redpack-get',
        self::PRE_SALE => '',
        self::QR_DISCOUNT => '',
        self::WALL => '',
        self::TOGETHERBUY => 'together-buy-get',
    ];



    /**
     * 添加活动
     * @param $params
     * @param $type 活动类型
     */
    public function create($params, $type)
    {
        //调用对应添加活动接口
        $this->getResult($this->api_add_url[$type], $params);
    }

    /**
     * TODO 设置活动默认值
     * @param $type
     * @return array
     */
    public function setDefaultValue($type)
    {
        switch ($type) {
            //秒杀活动默认值
            case self::SECONDKILL:
                $default = [
                    'activity' => [
                        'name' => '秒杀活动名称',
                        'desc' => RuleConfig::$secondKill,
                        'sort' => '50',
                        'expire_type' => self::VALIDITY_SCHEDULE_TIME,
                        'start_time' => time() + 3600 * 24,
                        'end_time' => time() + 3600 * 24 * 2,
                    ],
                    'shareMessage' => ShareConfig::$secondKill,
                    'secondKill' => []
                ];
                break;
            //积分活动默认值
            case self::POINT:
                $default = [
                    'activity' => [
                        'name' => '积分活动名称',
                        'desc' => '积分活动规则',
                        'sort' => '50',
                        'expire_type' => self::VALIDITY_ALL_TIME,
                        'start_time' => time() + 3600 * 24,
                        'end_time' => time() + 3600 * 24 * 2,
                    ],
                    'pointsConsumption' => [
                        'type' => ActivityPoint::TYPE_SALE_SEND,
                        'amount' => 1 * 100,//数值以分为单位
                        'points' => 1,
                    ]
                ];
                break;
            //拼团活动默认值
            case self::TOGETHERBUY:
                $default = [
                    'activity' => [
                        'name' => '拼团活动名称',
                        'desc' => RuleConfig::$togetherBuy,
                        'sort' => '50',
                        'expire_type' => self::VALIDITY_SCHEDULE_TIME,
                        'start_time' => time() + 3600 * 24,
                        'end_time' => time() + 3600 * 24 * 2,
                    ],
                    'shareMessage' => ShareConfig::$togetherBuy,
                    'togetherBuy' => []
                ];
                break;
            default:
                $default = [];
                break;
        }
        return $default;
    }

    /**
     * 获取对应类型活动详情
     * @param $params
     * @param $type
     */
    public function get($params, $type){
        $apiParams = [
          'id' => isset($params['id']) ? $params['id'] : null,
          'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult($this->api_get_url[$type], $apiParams);
    }


}
