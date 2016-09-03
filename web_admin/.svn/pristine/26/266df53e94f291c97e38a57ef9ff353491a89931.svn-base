<?php
/**
 * Author: LiuPing
 * Date: 2016/03/02
 * Time: 18:20
 */
namespace common\models;

use Yii;

/**
 * TogetherBuy model
 */
class TogetherBuy extends BaseModel
{
    //queueu status 1.创建、2.进行中、3.完成、4.关闭
    const QUEUE_STATUS_CREATE = 1;
    const QUEUE_STATUS_UNDERWAY = 2;
    const QUEUE_STATUS_FINISH = 3;
    const QUEUE_STATUS_CLOSE = 4;
    const QUEUE_STATUS_IS_HELP = 5; // 注水成团

    /**
     * 是否注水成团（1.是、2.否）
     */
    const IS_HELP_YES = 1;
    const IS_HELP_NO = 2;

    /**
     * 是否有参团时间限制（1.是、2.否）
     */
    const IS_TIME_LIMIT_YES = 1;
    const IS_TIME_LIMIT_NO = 2;

    /**
     * 是否同意协议（1：不同意，2：同意）
     */

    const IS_AGREE_NO = 1;
    const IS_AGREE_YES = 2;

    // 类缓存前缀
    const CACHE_KEY_PRE = 'models_togetherbuy_';

    /**
     * 认证标识
     * @var array
     */
    static public $authIcon = [
        'FREE_SHIPPING', //包邮
        'QUALITY_GOODS', //质量保证
        'AUTHENTICATION', //认证商家
        'IMPORT_GOODS', //进口商品
        'SUPER_SALE' //限时优惠
    ];

    /**
     * 获取拼团活动列表
     */
    public function togetherBuyFind($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'isUnstart' => isset($params['isUnstart']) ? $params['isUnstart'] : null, //未开始的(仅限时间判断，开启状态另传)，传true
            'isEnd' => isset($params['isEnd']) ? $params['isEnd'] : null,  //已结束的(仅限时间判断，开启状态另传)，传true
            'underwayFlag' => isset($params['underwayFlag']) ? $params['underwayFlag'] : null,  //进行中
            'deletedFlag' => isset($params['deletedFlag']) ? $params['deletedFlag'] : null,  //获取活动是否可删除标识
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'share_type' => isset($params['share_type']) ? $params['share_type'] : null,
            'doFilter' => isset($params['doFilter']) ? $params['doFilter'] : null
        ];
        $this->getResult('together-buy-find', $apiParams);
    }

    /**
     * 获取拼团活动信息
     */
    public function togetherBuyGet($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'activity_type' => isset($params['activity_type']) ? $params['activity_type'] : null,
            'relate_activity_type' => isset($params['relate_activity_type']) ? $params['relate_activity_type'] : null,
            'postage_setting_id' => isset($params['postage_setting_id']) ? $params['postage_setting_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'desc' => isset($params['desc']) ? $params['desc'] : null,
            'sort' => isset($params['sort']) ? $params['sort'] : null,
            'expire_type' => isset($params['expire_type']) ? $params['expire_type'] : null,
            'start_time' => isset($params['start_time']) ? $params['start_time'] : null,
            'end_time' => isset($params['end_time']) ? $params['end_time'] : null,
            'wx_qrcode_id' => isset($params['wx_qrcode_id']) ? $params['wx_qrcode_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('together-buy-get', $apiParams);
    }

    /**
     * 更新拼团活动
     */
    public function togetherBuyUpdate($params)
    {
        $apiParams = [
            'activity' => [
                'id' => isset($params['activity']['id']) ? $params['activity']['id'] : null,
                'name' => isset($params['activity']['name']) ? $params['activity']['name'] : null,
                'desc' => isset($params['activity']['desc']) ? $params['activity']['desc'] : null,
                'sort' => isset($params['activity']['sort']) ? $params['activity']['sort'] : null,
                'activity_type' => isset($params['activity']['activity_type']) ? $params['activity']['activity_type'] : null,
                'start_time' => isset($params['activity']['start_time']) ? $params['activity']['start_time'] : null,
                'end_time' => isset($params['activity']['end_time']) ? $params['activity']['end_time'] : null,
                'shop_id' => isset($params['activity']['shop_id']) ? $params['activity']['shop_id'] : null,
                'shop_sub_id' => isset($params['activity']['shop_sub_id']) ? $params['activity']['shop_sub_id'] : null,
                'share_type' => isset($params['activity']['share_type']) ? $params['activity']['share_type'] : null
            ],

            'togetherBuy' => [
                'id' => isset($params['togetherBuy']['id']) ? $params['togetherBuy']['id'] : null,
                'head_price' => isset($params['togetherBuy']['head_price']) ? $params['togetherBuy']['head_price'] : null,
                'is_agree' => isset($params['togetherBuy']['is_agree']) ? $params['togetherBuy']['is_agree'] : null,
                'is_time_limit' => isset($params['togetherBuy']['is_time_limit']) ? $params['togetherBuy']['is_time_limit'] : null,
                'is_discount' => isset($params['togetherBuy']['is_discount']) ? $params['togetherBuy']['is_discount'] : null,
                'time_limit' => isset($params['togetherBuy']['time_limit']) ? $params['togetherBuy']['time_limit'] : null,
                'is_open' => isset($params['togetherBuy']['is_open']) ? $params['togetherBuy']['is_open'] : null,
                'no_description' => isset($params['togetherBuy']['no_description']) ? $params['togetherBuy']['no_description'] : null,
                'description' => isset($params['togetherBuy']['description']) ? $params['togetherBuy']['description'] : null,
                'no_auth_icons' => isset($params['togetherBuy']['no_auth_icons']) ? $params['togetherBuy']['no_auth_icons'] : null,
                'auth_icons' => isset($params['togetherBuy']['auth_icons']) ? $params['togetherBuy']['auth_icons'] : null,
                'is_auto_share' => isset($params['togetherBuy']['is_auto_share']) ? $params['togetherBuy']['is_auto_share'] : null,
                'is_more' => isset($params['togetherBuy']['is_more']) ? $params['togetherBuy']['is_more'] : null
            ],
            'postageSetting' => [
                'type' => isset($params['postageSetting']['type']) ? $params['postageSetting']['type'] : null,
                'num' => isset($params['postageSetting']['num']) ? $params['postageSetting']['num'] : null,
                'amount' => isset($params['postageSetting']['amount']) ? $params['postageSetting']['amount'] : null,//数值以分为单位
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
        //去除空白数组
        array_remove_empty($apiParams);
        $this->getResult('together-buy-update', $apiParams);
    }

    /**
     * 开启活动
     * @param $params
     */
    public function togetherBuyOpen($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('together-buy-open', $apiParams);
    }

    /**
     * 关闭活动
     * @param $params
     */
    public function togetherBuyClose($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('together-buy-close', $apiParams);
    }

    /**
     * 查找活动下所有管理商品 返回活动信息和商品信息
     * @param $params
     */
    public function getTogetherBuyWithGoods($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('togetherbuy-get-with-Goods', $apiParams);
    }

    /**
     * 参团商品详情信息（当团长）
     * @param $params
     */
    public function getTogetherBuyWithOneGoods($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'activity_id' => isset($params['activity_id']) ? $params['activity_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('together-buy-join-activity', $apiParams);
    }

    /**
     * 参团商品详情信息（当团长）
     * @param $params
     */
    public function getUserJoinDetail($params)
    {
        $apiParams = [
            'together_buy_queue_id' => isset($params['together_buy_queue_id']) ? $params['together_buy_queue_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('together-buy-get-user-buy-detail', $apiParams);
    }

    /**
     * 删除活动
     * @param $params
     */
    public function togetherBuyDel($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('together-buy-del', $apiParams);
    }

    /**
     * 添加拼团商品
     * @param $params
     */
    public function togetherBuyGoodsCreate($params)
    {
        $apiParams = [
            'together_buy_id' => isset($params['together_buy_id']) ? $params['together_buy_id'] : null,
            'product_id' => isset($params['product_id']) ? $params['product_id'] : null,
            'product_sku_id' => isset($params['product_sku_id']) ? $params['product_sku_id'] : null,
            'product_name' => isset($params['product_name']) ? $params['product_name'] : null,
            'product_price' => isset($params['product_price']) ? $params['product_price'] : null,
            'buy_price' => isset($params['buy_price']) ? $params['buy_price'] : null,
            'quota' => isset($params['quota']) ? $params['quota'] : null,
            'limit_buy' => isset($params['limit_buy']) ? $params['limit_buy'] : null,
            'sales_num' => isset($params['sales_num']) ? $params['sales_num'] : null,
            'together_num' => isset($params['together_num']) ? $params['together_num'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('togetherbuy-goods-create', $apiParams);
    }

    /**
     * 获取拼团商品列表
     * @param $params
     */
    public function togetherBuyGoodsFind($params)
    {
        //拿接口数据
        $apiParams = [
            'together_buy_id' => isset($params['together_buy_id']) ? $params['together_buy_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('togetherbuy-goods-find', $apiParams);
    }

    /**
     * 拼团列表queue
     * @param $params
     */
    public function togetherBuyQueueFind($params)
    {
        //拿接口数据
        $apiParams = [
            'together_buy_id' => isset($params['together_buy_id']) ? $params['together_buy_id'] : null,
            'headNickname' => isset($params['headNickname']) ? $params['headNickname'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'reasonFlag' => isset($params['reasonFlag']) ? $params['reasonFlag'] : null,
            'is_help' => isset($params['is_help']) ? $params['is_help'] : null,
            'validFlag' => isset($params['validFlag']) ? $params['validFlag'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('together-buy-queue-find', $apiParams);
    }

    /**
     * 拼团详情queue
     * @param $params
     */
    public function togetherBuyQueueGet($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('together-buy-queue-get', $apiParams);
    }

    /**
     * 修改拼团商品
     * @param $params
     */
    public function togetherBuyGoodsUpdate($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'together_buy_id' => isset($params['together_buy_id']) ? $params['together_buy_id'] : null,
            'product_id' => isset($params['product_id']) ? $params['product_id'] : null,
            'product_sku_id' => isset($params['product_sku_id']) ? $params['product_sku_id'] : null,
            'product_name' => isset($params['product_name']) ? $params['product_name'] : null,
            'product_price' => isset($params['product_price']) ? $params['product_price'] : null,
            'buy_price' => isset($params['buy_price']) ? $params['buy_price'] : null,
            'quota' => isset($params['quota']) ? $params['quota'] : null,
            'together_num' => isset($params['together_num']) ? $params['together_num'] : null,
            'limit_buy' => isset($params['limit_buy']) ? $params['limit_buy'] : null,
            'sales_num' => isset($params['sales_num']) ? $params['sales_num'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('togetherbuy-goods-update', $apiParams);
    }

    /**
     * 获取拼团商品详情
     * @param $params
     */
    public function togetherBuyGoodsGet($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'together_buy_id' => isset($params['together_buy_id']) ? $params['together_buy_id'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('togetherbuy-goods-get', $apiParams);
    }

    /**
     * 删除拼团商品
     * @param $params
     */
    public function togetherBuyGoodsDel($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('togetherbuy-goods-del', $apiParams);
    }

    /**
     * 参团成员列表
     * @param $params
     */
    public function togetherBuyJoinFind($params)
    {
        //拿接口数据
        $apiParams = [
            'together_buy_queue_id' => isset($params['together_buy_queue_id']) ? $params['together_buy_queue_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'headNickname' => isset($params['headNickname']) ? $params['headNickname'] : null,
            'is_head' => isset($params['is_head']) ? $params['is_head'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('together-buy-join-find', $apiParams);
    }

    /**
     * 团中参团人员列表
     * @param $params
     */
    public function togetherBuyJoinByQueue($params)
    {
        //拿接口数据
        $apiParams = [
            'together_buy_id' => isset($params['together_buy_id']) ? $params['together_buy_id'] : null,
            'together_buy_queue_id' => isset($params['together_buy_queue_id']) ? $params['together_buy_queue_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'headNickname' => isset($params['headNickname']) ? $params['headNickname'] : null,
            'is_head' => isset($params['is_head']) ? $params['is_head'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('together-buy-join-by-queue', $apiParams);
    }

    /**
     * 统计用户购买该拼团商品的数量
     * @param $params
     */
    public function countUserBuy($params)
    {
        $apiParams = [
            'activity_id' => isset($params['activity_id']) ? $params['activity_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'product_sku_id' => isset($params['product_sku_id']) ? $params['product_sku_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('togetherbuy-user-buy-count', $apiParams);
    }

    /**
     * 创建未开启团
     * @param $params
     */
    public function openQueue($params)
    {
        //拿接口数据
        $apiParams = [
            'activity_id' => isset($params['activity_id']) ? $params['activity_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'together_buy_goods_id' => isset($params['together_buy_goods_id']) ? $params['together_buy_goods_id'] : null,
            'num' => isset($params['num']) ? $params['num'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('together-buy-queue-open', $apiParams);
    }

    /**
     * 加入团 创建订单
     * @param $params
     */
    public function joinQueue($params)
    {
        //拿接口数据
        $apiParams = [
            'activity_id' => isset($params['activity_id']) ? $params['activity_id'] : null,
            'together_buy_queue_id' => isset($params['together_buy_queue_id']) ? $params['together_buy_queue_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'together_buy_goods_id' => isset($params['together_buy_goods_id']) ? $params['together_buy_goods_id'] : null,
            'num' => isset($params['num']) ? $params['num'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('together-buy-join-queue', $apiParams);
    }

    /**
     * 管理员关闭团
     * @param $params
     */
    public function closeQueue($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'close_reason' => isset($params['close_reason']) ? $params['close_reason'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('together-buy-close-queue', $apiParams);
    }

    /**
     * 管理员注水成团
     * @param $params
     */
    public function helpSuccessQueue($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('together-buy-help-success-queue', $apiParams);
    }
}
