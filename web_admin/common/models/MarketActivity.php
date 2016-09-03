<?php
/**
 * Author: Liuping
 * Date: 2015/07/20
 * Time: 19:00
 * 商品类
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * shop model
 */
class MarketActivity extends BaseModel
{
    // 类缓存前缀
    const CACHE_KEY_PRE = 'models_market_activity';

    //未中奖
    const LEVER_ZERO = 0;
    // 1-大转盘
    const TYPE_ACTIVITY_TURNPLATE = 1;

    //2-刮刮乐
    const TYPE_ACTIVITY_SCRATCH = 2;

    //3-翻卡牌
    const TYPE_ACTIVITY_TURN_CARD = 3;

    //4-砸金蛋
    const TYPE_ACTIVITY_SMASH_EGG = 4;

    // 5-摇一摇
    const TYPE_ACTIVITY_SHARK_IT_OFF = 5;

    //奖品是否兑换：是
    const EXCHANGE_TRUE = 1;

    //奖品是否兑换：不
    const EXCHANGE_FALSE = 2;

    //1:所有用户,2:购买过商品的用户
    const BUY_LIMIT_ALL = 1;

    //是否可以使用积分兑换机会：是
    const USE_POINTS_TURE = 1;

    //是否可以使用积分兑换机会：是
    const USE_POINTS_FLASE = 2;

    //1:所有用户,2:购买过商品的用户
    const BUY_LIMIT_HAD_ORDER = 2;

    //1-每天限制次数类型
    const LIMIT_TYPE_DAY = 1;

    //2-限制总次数类型
    const LIMIT_TYPE_TOTAL = 2;

    //1只能一次中奖
    const WINNING_LIMIT_ONE = 1;

    //2可多次中奖
    const WINNING_LIMIT_MORE = 2;

    // 类型 1:普通奖品
    const PRIZE_TYPE_NORMAL = 1;

    //类型 2：优惠券
    const PRIZE_TYPE_COUPON = 2;

    //类型 3:积分
    const PRIZE_TYPE_INTEGRAL = 3;

    //4：红包
    const PRIZE_TYPE_REDPACKET = 4;
    //5:现金红包
    const PRIZE_TYPE_CASH_REDPACKET = 5;

    //活动类型
    static public $template = [
        ['id' => self::TYPE_ACTIVITY_TURNPLATE, 'name' => '大转盘'],
        ['id' => self::TYPE_ACTIVITY_SCRATCH, 'name' => '刮刮乐'],
        //['id' => self::TYPE_ACTIVITY_TURN_CARD, 'name' => '翻卡牌'],
        //['id' => self::TYPE_ACTIVITY_SMASH_EGG, 'name' => '砸金蛋'],
        //['id' => self::TYPE_ACTIVITY_SHARK_IT_OFF, 'name' => '摇一摇']
    ];

    //奖品设置
    static public $prizeType = [
        ['id' => self::PRIZE_TYPE_NORMAL, 'name' => '实物奖'],
        ['id' => self::PRIZE_TYPE_COUPON, 'name' => '卡券'],
        ['id' => self::PRIZE_TYPE_INTEGRAL, 'name' => '积分'],
        ['id' => self::PRIZE_TYPE_REDPACKET, 'name' => '商城红包'],
        ['id' => self::PRIZE_TYPE_CASH_REDPACKET, 'name' => '现金红包']
    ];

    //奖品图片设置
    static public $prizeDefaultImg = [
        ['id' => self::PRIZE_TYPE_NORMAL, 'imgPic' => 'http://imgcache.vikduo.com/static/463ad47a800772aa84aade7879749216.png', 'document_id' => 91751],
        ['id' => self::PRIZE_TYPE_COUPON, 'imgPic' => 'http://imgcache.vikduo.com/static/105807a761f0383a34502b0f5776b9ad.png', 'document_id' => 91750],
        ['id' => self::PRIZE_TYPE_INTEGRAL, 'imgPic' => 'http://imgcache.vikduo.com/static/8d665aa70eedd30e5ad62edcc7dc4979.png', 'document_id' => 91752],
        ['id' => self::PRIZE_TYPE_REDPACKET, 'imgPic' => 'http://imgcache.vikduo.com/static/68897ebd2baa044df7da38994b106d80.png', 'document_id' => 91754],
        ['id' => self::PRIZE_TYPE_CASH_REDPACKET, 'imgPic' => 'http://imgcache.vikduo.com/static/b5e7d2d43dbac650c358c1c2f77e1188.png', 'document_id' => 91753]
    ];

    //分享和图文
    static public function setDefault()
    {
        return [
            self::TYPE_ACTIVITY_TURNPLATE => ['shareMessage' => ShareConfig::$turnplateActivity, 'startNews' => NewsPushConfig::$turnplateActivity],
            self::TYPE_ACTIVITY_SCRATCH => ['shareMessage' => ShareConfig::$scratchActivity, 'startNews' => NewsPushConfig::$scratchActivity],
            self::TYPE_ACTIVITY_TURN_CARD => ['shareMessage' => ShareConfig::$turnCardActivity, 'startNews' => NewsPushConfig::$turnCardActivity],
            self::TYPE_ACTIVITY_SMASH_EGG => ['shareMessage' => ShareConfig::$smashEggActivity, 'startNews' => NewsPushConfig::$smashEggActivity],
            self::TYPE_ACTIVITY_SHARK_IT_OFF => ['shareMessage' => ShareConfig::$sharkActivity, 'startNews' => NewsPushConfig::$sharkActivity]
        ];
    }

    /**
     * 创建抽奖活动
     * @param $params
     */
    public function create($params)
    {
        //拿接口数据
        $apiParams = [
            'activity_name' => isset($params['activity_name']) ? $params['activity_name'] : null,
            'activity_desc' => isset($params['activity_desc']) ? $params['activity_desc'] : null,
            'template' => isset($params['template']) ? $params['template'] : null,
            'start_time' => isset($params['start_time']) ? $params['start_time'] : null,
            'end_time' => isset($params['end_time']) ? $params['end_time'] : null,
            'buy_limit' => isset($params['buy_limit']) ? $params['buy_limit'] : null,
            'limit_type' => isset($params['limit_type']) ? $params['limit_type'] : null,
            'try_limit' => isset($params['try_limit']) ? $params['try_limit'] : null,
            'expiry_time' => isset($params['expiry_time']) ? $params['expiry_time'] : null,
            'winning_limit' => isset($params['winning_limit']) ? $params['winning_limit'] : null,
            'share_award' => isset($params['share_award']) ? $params['share_award'] : null,
            'sorry_word' => isset($params['sorry_word']) ? $params['sorry_word'] : null,
            'logo_img' => isset($params['logo_img']) ? $params['logo_img'] : null,
            'total_win_limit' => isset($params['total_win_limit']) ? $params['total_win_limit'] : null,
            'is_subscribe' => isset($params['is_subscribe']) ? $params['is_subscribe'] : null,
            'use_points' => isset($params['use_points']) ? $params['use_points'] : null,
            'points_count' => isset($params['points_count']) ? $params['points_count'] : null,
            'points_num' => isset($params['points_num']) ? $params['points_num'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'extend' => [
                'level' => isset($params['extend']['level']) ? $params['extend']['level'] : null,
                'key' => isset($params['extend']['key']) ? $params['extend']['key'] : null,
                'value' => isset($params['extend']['value']) ? $params['extend']['value'] : null,
            ],
            'shareMessage' => [
                'title' => isset($params['shareMessage']['title']) ? $params['shareMessage']['title'] : null,
                'pic_id' => isset($params['shareMessage']['pic_id']) ? $params['shareMessage']['pic_id'] : null,
                'desc' => isset($params['shareMessage']['desc']) ? $params['shareMessage']['desc'] : null,
            ],
            'notstartNews' => [ //未开始图文
                'title' => isset($params['notstartNews']['title']) ? $params['notstartNews']['title'] : null,
                'description' => isset($params['notstartNews']['description']) ? $params['notstartNews']['description'] : null,
                'document_id' => isset($params['notstartNews']['document_id']) ? $params['notstartNews']['document_id'] : null,
            ],
            'startNews' => [ //开始图文
                'title' => isset($params['startNews']['title']) ? $params['startNews']['title'] : null,
                'description' => isset($params['startNews']['description']) ? $params['startNews']['description'] : null,
                'document_id' => isset($params['startNews']['document_id']) ? $params['startNews']['document_id'] : null,
            ],
            'endNews' => [ //结束开始图文
                'title' => isset($params['endNews']['title']) ? $params['endNews']['title'] : null,
                'description' => isset($params['endNews']['description']) ? $params['endNews']['description'] : null,
                'document_id' => isset($params['endNews']['document_id']) ? $params['endNews']['document_id'] : null,
            ],
            //奖品
            'prize' => isset($params['prize']) ? $params['prize'] : null,
            'share_type' => isset($params['share_type']) ? $params['share_type'] : null
        ];
        $this->getResult('market-activity-create', $apiParams);
    }

    /**
     * 修改
     * @param $params
     */
    public function update($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'activity_name' => isset($params['activity_name']) ? $params['activity_name'] : null,
            'activity_desc' => isset($params['activity_desc']) ? $params['activity_desc'] : null,
            'template' => isset($params['template']) ? $params['template'] : null,
            'start_time' => isset($params['start_time']) ? $params['start_time'] : null,
            'end_time' => isset($params['end_time']) ? $params['end_time'] : null,
            'buy_limit' => isset($params['buy_limit']) ? $params['buy_limit'] : null,
            'limit_type' => isset($params['limit_type']) ? $params['limit_type'] : null,
            'try_limit' => isset($params['try_limit']) ? $params['try_limit'] : null,
            'expiry_time' => isset($params['expiry_time']) ? $params['expiry_time'] : null,
            'winning_limit' => isset($params['winning_limit']) ? $params['winning_limit'] : null,
            'share_award' => isset($params['share_award']) ? $params['share_award'] : null,
            'sorry_word' => isset($params['sorry_word']) ? $params['sorry_word'] : null,
            'is_subscribe' => isset($params['is_subscribe']) ? $params['is_subscribe'] : null,
            'logo_img' => isset($params['logo_img']) ? $params['logo_img'] : null,
            'total_win_limit' => isset($params['total_win_limit']) ? $params['total_win_limit'] : null,
            'use_points' => isset($params['use_points']) ? $params['use_points'] : null,
            'points_count' => isset($params['points_count']) ? $params['points_count'] : null,
            'points_num' => isset($params['points_num']) ? $params['points_num'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'extend' => [
                'level' => isset($params['extend']['level']) ? $params['extend']['level'] : null,
                'key' => isset($params['extend']['key']) ? $params['extend']['key'] : null,
                'value' => isset($params['extend']['value']) ? $params['extend']['value'] : null,
            ],
            'shareMessage' => [
                'title' => isset($params['shareMessage']['title']) ? $params['shareMessage']['title'] : null,
                'pic_id' => isset($params['shareMessage']['pic_id']) ? $params['shareMessage']['pic_id'] : null,
                'desc' => isset($params['shareMessage']['desc']) ? $params['shareMessage']['desc'] : null,
            ],
            'notstartNews' => [ //未开始图文
                'title' => isset($params['notstartNews']['title']) ? $params['notstartNews']['title'] : null,
                'description' => isset($params['notstartNews']['description']) ? $params['notstartNews']['description'] : null,
                'document_id' => isset($params['notstartNews']['document_id']) ? $params['notstartNews']['document_id'] : null,
            ],
            'startNews' => [ //开始图文
                'title' => isset($params['startNews']['title']) ? $params['startNews']['title'] : null,
                'description' => isset($params['startNews']['description']) ? $params['startNews']['description'] : null,
                'document_id' => isset($params['startNews']['document_id']) ? $params['startNews']['document_id'] : null,
            ],
            'endNews' => [ //结束开始图文
                'title' => isset($params['endNews']['title']) ? $params['endNews']['title'] : null,
                'description' => isset($params['endNews']['description']) ? $params['endNews']['description'] : null,
                'document_id' => isset($params['endNews']['document_id']) ? $params['endNews']['document_id'] : null,
            ],
            //奖品
            'prize' => isset($params['prize']) ? $params['prize'] : null,
            'share_type' => isset($params['share_type']) ? $params['share_type'] : null
        ];
        $this->getResult('market-activity-update', $apiParams);
    }

    /**
     * 获取抽奖活动列表
     * @param $params
     */
    public function find($params)
    {
        //拿接口数据
        $apiParams = [
            'activity_name' => isset($params['activity_name']) ? $params['activity_name'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'template' => isset($params['template']) ? $params['template'] : null,
            'share_type' => isset($params['share_type']) ? $params['share_type'] : null
        ];
        $this->getResult('market-activity-find', $apiParams);
    }

    /**
     * 获取抽奖活动详情
     * @param $params
     */
    public function get($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('market-activity-get', $apiParams);
    }

    /**
     * 进入抽奖页面
     * @param $params
     */
    public function joinActivity($params)
    {
        $apiParams = [
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'from_uid' => isset($params['from_uid']) ? $params['from_uid'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('market-activity-join', $apiParams);
    }


    /**
     * 请求抽奖
     * @param $params
     */
    public function getPrize($params)
    {
        $apiParams = [
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'activity_id' => isset($params['activity_id']) ? $params['activity_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('market-get-prize', $apiParams);
    }

    /**
     * 获取活动中奖记录列表
     * @param $params
     */
    public function findRecord($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'findName' => isset($params['findName']) ? $params['findName'] : null, //昵称/或者username搜索
            'level' => isset($params['level']) ? $params['level'] : null,
            'prize_type' => isset($params['prize_type']) ? $params['prize_type'] : null, //奖品类型
            'exchange' => isset($params['exchange']) ? $params['exchange'] : null, //是否兑奖
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'activity_id' => isset($params['activity_id']) ? $params['activity_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'doFilter' => isset($params['doFilter']) ? $params['doFilter'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'un_info' => isset($params['un_info']) ? $params['un_info'] : null // 是否筛选未填写收货信息的中奖记录
        ];
        $this->getResult('market-find-record-list', $apiParams);
    }

    /**
     * 获取活动中奖记录详情
     * @param $params
     */
    public function getRecord($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'marketing_activity_id' => isset($params['marketing_activity_id']) ? $params['marketing_activity_id'] : null,
            'exchange' => isset($params['exchange']) ? $params['exchange'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('market-get-record', $apiParams);
    }

    /**
     * 兑换中奖
     * @param $params
     */
    public function exchangeRecord($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'marketing_activity_id' => isset($params['marketing_activity_id']) ? $params['marketing_activity_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('market-exchange-record', $apiParams);
    }

    /**
     * 更新中奖记录，如添加收货信息
     * @param $params
     */
    public function updateRecord($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'mobile' => isset($params['mobile']) ? $params['mobile'] : null,
            'username' => isset($params['username']) ? $params['username'] : null,
            'address' => isset($params['address']) ? $params['address'] : null
        ];
        $this->getResult('market-update-record', $apiParams);
    }

    /**
     * 通过积分增加抽奖次数
     * @param $params
     */
    public function addPointChance($params)
    {
        //拿接口数据
        $apiParams = [
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'activity_id' => isset($params['activity_id']) ? $params['activity_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('market-add-points-chance', $apiParams);
    }

    /**
     * 获取用户剩余中奖次数
     * @param $params
     */
    public function getChanceCount($params)
    {
        //拿接口数据
        $apiParams = [
            'activity_id' => isset($params['activity_id']) ? $params['activity_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null
        ];
        $this->getResult('market-get-left-chance-count', $apiParams);
    }

    /**
     * 获取用户中奖次数信息
     * @param $params
     */
    public function getMarketingChance($params)
    {
        //拿接口数据
        $apiParams = [
            'marketing_activity_id' => isset($params['marketing_activity_id']) ? $params['marketing_activity_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null
        ];
        $this->getResult('market-get-marketing-chance', $apiParams);
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
        $this->getResult('market-activity-open', $apiParams);
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
        $this->getResult('market-activity-close', $apiParams);
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
        $this->getResult('market-activity-del', $apiParams);
    }
}
