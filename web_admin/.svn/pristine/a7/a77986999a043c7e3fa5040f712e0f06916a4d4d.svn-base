<?php
/**
 * Author: LiuPing
 * Date: 2015/09/02
 * Time: 15:05
 */
namespace common\models;

use common\cache\BaseCache;
use common\vendor\wechat\wechat_sdk\Wechat;
use common\vendor\wechat\WechatCard;
use Yii;
use yii\base\Model;

/**
 * CardCoupon model
 */
class CardCoupon extends BaseModel
{

    // 类缓存前缀
    const CACHE_KEY_PRE = 'models_card_coupon_';

    //卡券类型：代金券
    const WX_CARD_TYPE_CACH = 1;
    //卡券类型：折扣券
    const WX_CARD_TYPE_DISCOUNT = 2;
    //卡券类型：礼品券（微信叫兑换券）
    const WX_CARD_TYPE_GIFT = 3;

    // 1：普通方式获得卡券
    const GET_CARD_TYPE_NORMAL = 1;
    // 2：摇电视获得卡券
    const GET_CARD_TYPE_TV = 2;

    //获取卡券途径：1.直接领取 2.手动派送 3.抽奖活动 4.购物赠送 5.游戏奖励
    const CARD_RECEIVE_TYPE_DIRECT = 1;
    const CARD_RECEIVE_TYPE_MANUAL = 2;
    const CARD_RECEIVE_TYPE_MARKETING = 3;
    const CARD_RECEIVE_TYPE_SHOPPING = 4;
    const CARD_RECEIVE_TYPE_GAME = 5;

    //卡券类型 1：微商户 2：微信卡券
    const CARD_TYPE_WSH = 1;
    const CARD_TYPE_WEIXIN = 2;

    //显示卡券方式 1序列码 2条形码 3二维码，微商户卡券没有条形码
    const CODE_TYPE_TXT = 1;
    const CODE_TYPE_BAR_CODE = 2;
    const CODE_TYPE_QR_CODE = 3;

    //是否可转赠 1是 2否
    const CAN_GIVE_FRIEND_TURE = 1;
    const CAN_GIVE_FRIEND_FALSE = 2;

    //有效期类型 1:固定日期 2:固定时长
    const DATE_INFO_TYPE_FIX_DATE = 1;
    const DATE_INFO_TYPE_FIX_TERM = 2;

    /**
     * 领取状态 1:未领取 2:已领取 3:已核销 4:已赠送
     * 5:已冻结 6:已删除
     */
    const STATUS_CARD_UNRECEIVE = 1;
    const STATUS_CARD_RECEIVE = 2;
    const STATUS_CARD_EXCHANGE = 3;
    const STATUS_CARD_GIVE = 4;
    const STATUS_CARD_FREEZE = 5; //通过字段deleted=2标识
    const STATUS_CARD_DELETED = 6;  //通过字段deleted=3标识

    /**
     * 微信审核状态，1正常使用，2审核中，3审核失败
     */
    const EXAMINE_TYPE_NORMAL = 1;
    const EXAMINE_TYPE_VERIFY = 2;
    const EXAMINE_TYPE_FAILURE_AUDIT = 3;

    /**
     * 消费策略 1:消费指定金额2:购买指定商品
     */
    const STRATEGY_TYPE_AMOUNT = 1;
    const STRATEGY_TYPE_PRODUCT = 2;

    //销券设置
    public $codeType = [
        'CODE_TYPE_TEXT' => self::CODE_TYPE_TXT,
        'CODE_TYPE_BARCODE' => self::CODE_TYPE_BAR_CODE,
        'CODE_TYPE_QRCODE' => self::CODE_TYPE_QR_CODE
    ];

    //卡券类型对应微信优惠券类型
    public $wxCardType = [
        'CASH' => self::WX_CARD_TYPE_CACH,
        'GENERAL_COUPON' => self::WX_CARD_TYPE_DISCOUNT
    ];

    /**
     * 获取卡券颜色
     * @param $value
     * @return mixed
     */
    public function cardColor($value)
    {
        $color_arr = [
            'Color010' => '#55bd47',
            'Color020' => '#10ad61',
            'Color030' => '#35a4de',
            'Color040' => '#3d78da',
            'Color050' => '#9058cb',
            'Color060' => '#de9c33',
            'Color070' => '#ebac16',
            'Color080' => '#f9861f',
            'Color081' => '#f08500',
            //'Color082'  => '#a9d92d',
            'Color090' => '#e75735',
            'Color100' => '#d54036',
            'Color101' => '#cf3e36',
        ];
        $color_value = array_search($value, $color_arr);
        return $color_value;
    }

    /**
     * 新增卡券
     * @param $params
     */
    public function create($params)
    {
        $apiParams = [
            'title' => isset($params['title']) ? $params['title'] : null,
            'card_type' => isset($params['card_type']) ? $params['card_type'] : null,
            'quantity' => isset($params['quantity']) ? $params['quantity'] : null,
            'logo_url' => isset($params['logo_url']) ? $params['logo_url'] : null,
            'color' => isset($params['color']) ? $params['color'] : null,
            'card_money' => isset($params['card_money']) ? $params['card_money'] : null,
            'card_discount' => isset($params['card_discount']) ? $params['card_discount'] : null,
            'money_limit' => isset($params['money_limit']) ? $params['money_limit'] : null,
            'exchange_content_text' => isset($params['exchange_content_text']) ? $params['exchange_content_text'] : null,
            'get_limit' => isset($params['get_limit']) ? $params['get_limit'] : null,
            'product_ids' => isset($params['product_ids']) ? $params['product_ids'] : null,
            'notice' => isset($params['notice']) ? $params['notice'] : null,
            'description' => isset($params['description']) ? $params['description'] : null,
            'service_phone' => isset($params['service_phone']) ? $params['service_phone'] : null,
            'wx_card_id' => isset($params['wx_card_id']) ? $params['wx_card_id'] : null,
            'wx_card_type' => isset($params['wx_card_type']) ? $params['wx_card_type'] : null,
            'get_card_type' => isset($params['get_card_type']) ? $params['get_card_type'] : null,
            'examine_type' => isset($params['examine_type']) ? $params['examine_type'] : null,
            'code_type' => isset($params['code_type']) ? $params['code_type'] : null,
            'brand_name' => isset($params['brand_name']) ? $params['brand_name'] : null,
            'can_share' => isset($params['can_share']) ? $params['can_share'] : null,
            'can_give_friend' => isset($params['can_give_friend']) ? $params['can_give_friend'] : null,
            'date_info_type' => isset($params['date_info_type']) ? $params['date_info_type'] : null,
            'begin' => isset($params['begin']) ? $params['begin'] : null,
            'end' => isset($params['end']) ? $params['end'] : null,
            'range' => isset($params['range']) ? $params['range'] : null,
            'deal_detail' => isset($params['deal_detail']) ? $params['deal_detail'] : null, //团购券专用
            'custom_url_name' => isset($params['custom_url_name']) ? $params['custom_url_name'] : null,
            'custom_url' => isset($params['custom_url']) ? $params['custom_url'] : null,
            'custom_url_sub_title' => isset($params['custom_url_sub_title']) ? $params['custom_url_sub_title'] : null,
            'promotion_url_name' => isset($params['promotion_url_name']) ? $params['promotion_url_name'] : null,
            'promotion_url' => isset($params['promotion_url']) ? $params['promotion_url'] : null,
            'promotion_url_sub_title' => isset($params['promotion_url_sub_title']) ? $params['promotion_url_sub_title'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-coupon-create', $apiParams);
    }

    /**
     * 更新卡券
     * @param $params
     */
    public function update($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'card_type' => isset($params['card_type']) ? $params['card_type'] : null,
            'quantity' => isset($params['quantity']) ? $params['quantity'] : null,
            'logo_url' => isset($params['logo_url']) ? $params['logo_url'] : null,
            'color' => isset($params['color']) ? $params['color'] : null,
            'card_money' => isset($params['card_money']) ? $params['card_money'] : null,
            'card_discount' => isset($params['card_discount']) ? $params['card_discount'] : null,
            'money_limit' => isset($params['money_limit']) ? $params['money_limit'] : null,
            'exchange_content_text' => isset($params['exchange_content_text']) ? $params['exchange_content_text'] : null,
            'get_limit' => isset($params['get_limit']) ? $params['get_limit'] : null,
            'product_ids' => isset($params['product_ids']) ? $params['product_ids'] : null,
            'notice' => isset($params['notice']) ? $params['notice'] : null,
            'description' => isset($params['description']) ? $params['description'] : null,
            'service_phone' => isset($params['service_phone']) ? $params['service_phone'] : null,
            'wx_card_id' => isset($params['wx_card_id']) ? $params['wx_card_id'] : null,
            'wx_card_type' => isset($params['wx_card_type']) ? $params['wx_card_type'] : null,
            'examine_type' => isset($params['examine_type']) ? $params['examine_type'] : null,
            'code_type' => isset($params['code_type']) ? $params['code_type'] : null,
            'brand_name' => isset($params['brand_name']) ? $params['brand_name'] : null,
            'can_share' => isset($params['can_share']) ? $params['can_share'] : null,
            'can_give_friend' => isset($params['can_give_friend']) ? $params['can_give_friend'] : null,
            'date_info_type' => isset($params['date_info_type']) ? $params['date_info_type'] : null,
            'begin' => isset($params['begin']) ? $params['begin'] : null,
            'end' => isset($params['end']) ? $params['end'] : null,
            'range' => isset($params['range']) ? $params['range'] : null,
            'deal_detail' => isset($params['deal_detail']) ? $params['deal_detail'] : null,
            'custom_url_name' => isset($params['custom_url_name']) ? $params['custom_url_name'] : null,
            'custom_url' => isset($params['custom_url']) ? $params['custom_url'] : null,
            'custom_url_sub_title' => isset($params['custom_url_sub_title']) ? $params['custom_url_sub_title'] : null,
            'promotion_url_name' => isset($params['promotion_url_name']) ? $params['promotion_url_name'] : null,
            'promotion_url' => isset($params['promotion_url']) ? $params['promotion_url'] : null,
            'promotion_url_sub_title' => isset($params['promotion_url_sub_title']) ? $params['promotion_url_sub_title'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'rangeNullFlag' => isset($params['rangeNullFlag']) ? $params['rangeNullFlag'] : null
        ];
        $this->getResult('card-coupon-update', $apiParams);
    }

    /**
     * 获取卡券详情
     * @param $params
     */
    public function get($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-coupon-get', $apiParams);
    }

    /**
     * 获取卡券列表
     * @param $params
     */
    public function find($params)
    {
        $this->getResult('card-coupon-find', $params);
    }

    /**
     * 启用卡券
     * @param $params
     */
    public function open($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('card-coupon-open', $apiParams);
    }

    /**
     * 禁用卡券
     * @param $params
     */
    public function close($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('card-coupon-close', $apiParams);
    }

    /**
     * 执行硬删除卡券
     * @param $params
     */
    public function hardDelete($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('card-coupon-hard-del', $apiParams);
    }

    /**
     * 删除卡券
     * @param $params
     */
    public function delete($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('card-coupon-del', $apiParams);
    }

    /**
     * 新增卡券赠送策略
     * @param $params
     */
    public function createCardStrategy($params)
    {
        $apiParams = [
            'card_type_id' => isset($params['card_type_id']) ? $params['card_type_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'order_limit' => isset($params['order_limit']) ? $params['order_limit'] : null,
            'amount' => isset($params['amount']) ? $params['amount'] : null,
            'product_ids' => isset($params['product_ids']) ? $params['product_ids'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-create-strategy', $apiParams);
    }

    /**
     * 修改卡券赠送策略
     * @param $params
     */
    public function updateCardStrategy($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'card_type_id' => isset($params['card_type_id']) ? $params['card_type_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'order_limit' => isset($params['order_limit']) ? $params['order_limit'] : null,
            'amount' => isset($params['amount']) ? $params['amount'] : null,
            'product_ids' => isset($params['product_ids']) ? $params['product_ids'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-update-strategy', $apiParams);
    }

    /**
     * 获取卡券赠送策略详情
     * @param $params
     */
    public function getCardStrategy($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'card_type_id' => isset($params['card_type_id']) ? $params['card_type_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-get-strategy', $apiParams);
    }

    /**
     * 获取卡券赠送策略列表
     * @param $params
     */
    public function findCardStrategy($params)
    {
        $apiParams = [
            'card_type_id' => isset($params['card_type_id']) ? $params['card_type_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-find-strategy', $apiParams);
    }

    /**
     * 删除券赠送策略
     * @param $params
     */
    public function delCardStrategy($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-del-strategy', $apiParams);
    }

    /**
     * 开启赠送策略
     * @param $params
     */
    public function openStrategy($params){
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-open-strategy', $apiParams);
    }

    /**
     * 关闭赠送策略
     * @param $params
     */
    public function closeStrategy($params){
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-close-strategy', $apiParams);
    }

    /**
     * 创建卡券直接领取活动
     * @param $params
     */
    public function createCardReceive($params)
    {
        $apiParams = [
            'card_type_id' => isset($params['card_type_id']) ? $params['card_type_id'] : null,
            'begin_time' => isset($params['begin_time']) ? $params['begin_time'] : null,
            'end_time' => isset($params['end_time']) ? $params['end_time'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'share_type' => isset($params['share_type']) ? $params['share_type'] : null,
            'news' => [
                'title' => isset($params['news']['title']) ? $params['news']['title'] : null,
                'description' => isset($params['news']['description']) ? $params['news']['description'] : null,
                'document_id' => isset($params['news']['document_id']) ? $params['news']['document_id'] : null
            ],
            'shareMessage' => [
                'title' => isset($params['shareMessage']['title']) ? $params['shareMessage']['title'] : null,
                'description' => isset($params['shareMessage']['desc']) ? $params['shareMessage']['desc'] : null,
                'document_id' => isset($params['shareMessage']['pic_id']) ? $params['shareMessage']['pic_id'] : null
            ],
        ];
        $this->getResult('card-create-receive', $apiParams);
    }

    /**
     * 更新卡券直接领取活动
     * @param $params
     */
    public function updateCardReceive($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'card_type_id' => isset($params['card_type_id']) ? $params['card_type_id'] : null,
            'begin_time' => isset($params['begin_time']) ? $params['begin_time'] : null,
            'end_time' => isset($params['end_time']) ? $params['end_time'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'share_type' => isset($params['share_type']) ? $params['share_type'] : null,
            'news' => [
                'title' => isset($params['news']['title']) ? $params['news']['title'] : null,
                'description' => isset($params['news']['description']) ? $params['news']['description'] : null,
                'document_id' => isset($params['news']['document_id']) ? $params['news']['document_id'] : null
            ],
            'shareMessage' => [
                'title' => isset($params['shareMessage']['title']) ? $params['shareMessage']['title'] : null,
                'description' => isset($params['shareMessage']['desc']) ? $params['shareMessage']['desc'] : null,
                'document_id' => isset($params['shareMessage']['pic_id']) ? $params['shareMessage']['pic_id'] : null
            ],
        ];
        $this->getResult('card-update-receive', $apiParams);
    }

    /**
     * 获取卡券直接领取活动详情
     * @param $params
     */
    public function getCardReceive($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-get-receive', $apiParams);
    }

    /**
     * 获取卡券直接领取活动列表
     * @param $params
     */
    public function findCardReceive($params)
    {
        $apiParams = [
            'card_type_id' => isset($params['card_type_id']) ? $params['card_type_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'share_type' => isset($params['share_type']) ? $params['share_type'] : null
        ];
        $this->getResult('card-find-receive', $apiParams);
    }

    /**
     * 删除卡券直接领取活动
     * @param $params
     */
    public function delCardReceive($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-del-receive', $apiParams);
    }

    /**
     * 手动派发卡券
     * @param $params
     */
    public function handSendCard($params)
    {
        $apiParams = [
            'card_type_id' => isset($params['card_type_id']) ? $params['card_type_id'] : null,
            'to_user_ids' => isset($params['to_user_ids']) ? $params['to_user_ids'] : null, //要派发的用户数组
            'user_group' => isset($params['user_group']) ? $params['user_group'] : null,
            'code' => isset($params['code']) ? $params['code'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-hand-send', $apiParams);
    }

    /**
     * 领取微信卡券 【系统接收到微信端的请求】
     * 领取卡券或领取转赠卡券
     * @param $params
     */
    public function getWxCard($params)
    {
        $apiParams = [
            'wx_card_id' => isset($params['wx_card_id']) ? $params['wx_card_id'] : null, //微信卡券标识
            'user_open_id' => isset($params['user_open_id']) ? $params['user_open_id'] : null, //领取卡券的用户openid
            'from_user_open_id' => isset($params['from_user_open_id']) ? $params['from_user_open_id'] : null, //转赠的用户openid
            'old_user_code' => isset($params['old_user_code']) ? $params['old_user_code'] : null, //转赠的用户卡券code
            'code' => isset($params['code']) ? $params['code'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-send-card', $apiParams);
    }

    /**
     * 更新微信卡券审核状态
     */
    public function updateExamine($params){
        $apiParams = [
            'examine_type' => isset($params['examine_type']) ? $params['examine_type'] : null,
            'wx_card_id' => isset($params['wx_card_id']) ? $params['wx_card_id'] : null, //微信卡券id(字符串)
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-update-examine', $apiParams);
    }

    /**
     * 领取卡券
     * @param $params
     */
    public function receiveCard($params)
    {
        $apiParams = [
            'card_type_id' => isset($params['card_type_id']) ? $params['card_type_id'] : null,
            'to_user_id' => isset($params['to_user_id']) ? $params['to_user_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-receive', $apiParams);
    }

    /**
     * 接收赠送的卡券【微商户卡券】
     * @param $params
     */
    public function acceptCard($params)
    {
        $apiParams = [
            'card_info_id' => isset($params['card_info_id']) ? $params['card_info_id'] : null,
            'to_user_id' => isset($params['to_user_id']) ? $params['to_user_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-accept', $apiParams);
    }

    /**
     * 获取用户的卡券详情
     * @param $params
     */
    public function getCardInfo($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'to_user_id' => isset($params['to_user_id']) ? $params['to_user_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-get-info', $apiParams);
    }

    /**
     * 获取用户的卡券列表
     * @param $params
     */
    public function findCardInfo($params)
    {
        $apiParams = [
            'card_type_id' => isset($params['card_type_id']) ? $params['card_type_id'] : null, //卡券id
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'code' => isset($params['code']) ? $params['code'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'from_user_id' => isset($params['from_user_id']) ? $params['from_user_id'] : null,
            'to_user_id' => isset($params['to_user_id']) ? $params['to_user_id'] : null,
            'status' => isset($params['status']) ? $params['status'] : null, //可以为数组
            'type' => isset($params['type']) ? $params['type'] : null,
            'receive_type' => isset($params['receive_type']) ? $params['receive_type'] : null,
            'order_amount' => isset($params['order_amount']) ? $params['order_amount'] : null, //订单限额
            'valid_time' => isset($params['valid_time']) ? $params['valid_time'] : null, //是否在有效期内
            'un_expire' => isset($params['un_expire']) ? $params['un_expire'] : null, //未过期
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'codeFlag' => isset($params['codeFlag']) ? $params['codeFlag'] : null, //编号是否模糊查询
            'nickname' => isset($params['nickname']) ? $params['nickname'] : null,
            'inRange' => isset($params['inRange']) ? $params['inRange'] : null, //门店id
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null //订单id
        ];
        $this->getResult('card-find-info', $apiParams);
    }

    /**
     * 核销卡券
     * @param $params
     */
    public function cancelCard($params){
        $apiParams = [
            'code' => isset($params['code']) ? $params['code'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'staff_open_id' => isset($params['staff_open_id']) ? $params['staff_open_id'] : null,
            'total_price' => isset($params['total_price']) ? $params['total_price'] : null, //消费金额
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'weixin_sync' => isset($params['weixin_sync']) ? $params['weixin_sync'] : null
        ];
        $this->getResult('card-cancel-card', $apiParams);
    }

    /**
     * 核销卡券新接口
     * @param $params
     */
    public function cancelCardNew($params){
        $apiParams = [
            'code' => isset($params['code']) ? $params['code'] : null,
            'open_id' => isset($params['open_id']) ? $params['open_id'] : null,
            'source' => isset($params['source']) ? $params['source'] : null,
        ];
        $this->getResult('card-cancel-card-new', $apiParams);

    }

    /**
     * 删除用户的卡券
     * @param $params
     */
    public function delCardInfo($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'code' => isset($params['code']) ? $params['code'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('card-del-info', $apiParams);
    }

    /**
     * 卡券保存默认参数
     * @param $data
     * @param $extends
     * @return array
     */
    public function getBaseInfo($data, $extends)
    {
        $card_txt = strtolower($extends['card_type']); //卡券类型转小写
        //卡券时间设置为固定日期
        if ($data['date_info_type'] == CardCoupon::DATE_INFO_TYPE_FIX_DATE) {
            $datastr = [
                'type' => 'DATE_TYPE_FIX_TIME_RANGE',
                'begin_timestamp' => $data['begin'],
                'end_timestamp' => $data['end']
            ];
        } else {//卡券时间设置为固定时长
            $datastr = [
                'type' => 'DATE_TYPE_FIX_TERM',
                'fixed_term' => $data['end'],
                'fixed_begin_term' => $data['begin']
            ];
        }
        $baseinfo = [
            'color' => $extends['color'],
            'service_phone' => $data['service_phone'],
            'get_limit' => (int)$data['get_limit'],
            'code_type' => $extends['code_type'],
            'location_id_list' => $extends['store_arr'],
            'custom_url_name' => $data['custom_url_name'],
            'custom_url' => $data['custom_url'],
            'custom_url_sub_title' => $data['custom_url_sub_title'],
            'promotion_url_name' => $data['promotion_url_name'],
            'promotion_url' => $data['promotion_url'],
            'notice' => $data['notice'],
            'description' => $data['description'],
            'promotion_url_sub_title' => $data['promotion_url_sub_title']
        ];

        //如果是编辑且而且选择时指定日期
        if(isset($data['wx_card_id']) && $data['date_info_type'] == self::DATE_INFO_TYPE_FIX_DATE){
            $baseinfo['date_info'] = $datastr;
        }
        $card_txt_data = [];

        if(!empty($data['id']) && !empty($data['wx_card_id'])){ //编辑时
            array_remove_empty($baseinfo);
            $card_txt_data['base_info'] = $baseinfo;
            $arr = [
                'card_id' => $data['wx_card_id'],
                $card_txt => $card_txt_data
            ];
        }else{//添加时
            $addBaseInfo = [
                //===========================相对编辑添加时多的===============
                'can_give_friend' => boolval($extends['can_give_friend']),
                'logo_url' => $data['logo_url'],
                'brand_name' => $data['brand_name'],
                'title' => $data['title'],
                'date_info' => $datastr,
                'use_custom_code' => false,
                'sku' => ['quantity' => (int)$data['quantity']]
            ];
            $baseinfo = array_merge($baseinfo, $addBaseInfo);
            array_remove_empty($baseinfo);
            $card_txt_data['base_info'] = $baseinfo;
            //添加卡券参数
            $arr = [
                'card' => [
                    'card_type' => $extends['card_type'],
                    $card_txt => $card_txt_data
                ]
            ];
        }

        return $arr;
    }

    /**
     * 领取微信卡券时签名信息
     * @param $wxInfo
     * @return array|bool
     */
    public function getSignature($wxInfo, $params, $type = 'addCard')
    {
        $wxObj = new WechatCard($wxInfo);
        BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__);
        if(isset($params['sign_action'])){
            $type = $params['sign_action'];
        }
        switch($type){
            case 'addCard':
                $signParams = ["card_id" => $params['card_id']];//参与签名参数
                break;
            case 'chooseCard':
                //参与签名参数
                $signParams = [
                    "card_id" => $params['card_id'],
                    'app_id' => $wxInfo['appid'],
                    'card_type' => array_search($params['card_type'], $this->wxCardType)
                ];
                break;
        }
        $data = $wxObj->getCardSignature($signParams);
        BaseCache::append('test_cache', $data);
        if(!$data){
            $this->setError(['errmsg' => '卡券签名失败']);
        }
        $this->_data = $data;
    }
}

