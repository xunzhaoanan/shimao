<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 订单类
 */
namespace common\models;

use common\cache\ProductCache;
use Yii;
use yii\base\Model;

/**
 * shop model
 */
class Order extends BaseModel
{
//    order_status  订单状态(1.未付款，2.部分付款，3.支付中，4.已付款 ，5.交易完成，6.订单已取消.7.订单已关闭)
//    refund_status 退款状态（0.未申请1.申请退款中。2.全退款。3.部分退款）
//    deliver_status  1.待发货。2.已发货。3.确认收货。4.已评价。5.订单锁定
//    after_sales_status 1.售后处理订单。2.非售后处理订单
//    order_type 订单类型（1.普通订单、2.秒杀、3.预售、4.pos收银、5..pos订单、）
//    pickup_type 提货方式：1.普通发货。2.到店自提。
//    order_refund.status  1 申请中2 退款失败3 退款成功4 平台审核失败5. 部分成功

    //数据库里面的订单状态
    const ORDER_STATUS_UN_PAY = 1;
    const ORDER_STATUS_PART_PAY = 2;
    const ORDER_STATUS_PAYING = 3;
    const ORDER_STATUS_ALL_PAY = 4;
    const ORDER_STATUS_COMPLATE = 5;
    const ORDER_STATUS_CANCLE = 6;
    const ORDER_STATUS_CLOSE = 7;

    //发货状态
    const DELIVERY_STATUS_UN_DELIVERY = 1;
    const DELIVERY_STATUS_UN_TAKE = 2;
    const DELIVERY_STATUS_TAKE = 3;
    const DELIVERY_STATUS_COMMENT = 4;
    const DELIVERY_STATUS_LOCK = 5;

    const ORDER_REFUND_STATUS_APPLY = 1;
    const ORDER_REFUND_STATUS_FAIL = 2;
    const ORDER_REFUND_STATUS_SUCCESS = 3;

    //after_sales_service表里售后处理状态 : 新提交
    const AFTER_SALES_SERVICE_STATUS_APPLY = 1;

    //after_sales_service表里售后处理状态 : 处理中
    const AFTER_SALES_SERVICE_STATUS_PROCESSING = 2;

    //after_sales_service表里售后处理状态 : 处理完成
    const AFTER_SALES_SERVICE_STATUS_FINISH = 3;

    //after_sales_service表里售后处理状态 : 退款取消
    const AFTER_SALES_SERVICE_STATUS_CANCEL = 4;

    //after_sales_service表里售后处理状态 : 商家收货
    const AFTER_SALES_SERVICE_STATUS_SELLER_ACCEPT_GOODS = 5;

    //after_sales_service表里售后处理结果 : 通过
    const AFTER_SALES_SERVICE_RESULT_PASS = 1;

    //after_sales_service表里售后处理结果 : 拒绝
    const AFTER_SALES_SERVICE_RESULT_REJECT = 2;

    //after_sales_service表里boss_check_type类型 : 需要审核
    const AFTER_SALES_SERVICE_BOSS_CHECK_TYPE_NEED = 1;

    //after_sales_service表里boss_check_type类型 : 不需要审核
    const AFTER_SALES_SERVICE_BOSS_CHECK_TYPE_NONE = 2;

    //after_sales_service表里boss_check状态 : 通过
    const AFTER_SALES_SERVICE_BOSS_CHECK_PASS = 1;

    //after_sales_service表里boss_check状态 : 拒绝
    const AFTER_SALES_SERVICE_BOSS_CHECK_REFUSE = 2;

    //售后状态
    const AFTER_ORDER = 1;
    const UN_AFTER_ORDER = 2;
    const AFTER_SALES_HAPPEND_YES = 1;
    const AFTER_SALES_HAPPEND_NO = 2;
    //页面展示的订单状态
    //异常订单
    const ORDER_BAD = 0;
    //未付款
    const ORDER_UN_PAY = 1;
    //已付款待发货
    const ORDER_UN_DELIVERY = 2;
    //已发货待收货
    const ORDER_UN_TAKE = 3;
    //已付完成（包含已评价和未评价的）
    const ORDER_COMPLATE = 4;
    //退款相关
    const ORDER_REFUND = 5;
    //订单关闭
    const ORDER_CANCEL = 7;
    //订单锁定
    const ORDER_LOCK = 8;
    //订单支付方式
    public static $orderStatus = [
        self::ORDER_BAD => ['text' => '异常订单'],
        self::ORDER_UN_PAY => ['text' => '待付款'],
        self::ORDER_UN_DELIVERY => ['text' => '待发货'],
        self::ORDER_UN_TAKE => ['text' => '待收货', 'pickupSelf' => '待提货'],
        self::ORDER_COMPLATE => ['text' => '已完成'],
        self::ORDER_REFUND => ['text' => '售后'],
        self::ORDER_CANCEL => ['text' => '已关闭'],
        self::ORDER_LOCK => ['text' => '已锁定', 'togetherBuyText' => '待成团'],
    ];

    //退款状态
    const REFUND_STATUS_UN_APPLY = 0;
    const REFUND_STATUS_APPLY = 1;
    const REFUND_STATUS_ALL = 2;
    const REFUND_STATUS_PART = 3;
    public static $orderRefundStatus = [
        self::REFUND_STATUS_UN_APPLY => ['text' => '未申请'],
        self::REFUND_STATUS_APPLY => ['text' => '售后申请中'],
        self::REFUND_STATUS_ALL => ['text' => '退款完成'],
        self::REFUND_STATUS_PART => ['text' => '部分退款'],
    ];

    //支付方式（0、未支付，1.财付通、2.微信支付、3.货到付款、4.代收、5.新微信支付、6.现金支付、7、微信扫码支付、8.手Q扫码支付）
    const PAY_TYPE_UN_PAY = 0;
    const PAY_TYPE_TENPAY = 1;
    const PAY_TYPE_WXPAY = 2;
    const PAY_TYPE_DELIVERY = 3;
    const PAY_TYPE_COLLECTION = 4;
    const PAY_TYPE_NEWWXPAY = 5;
    const PAY_TYPE_MONEY = 6;
    const PAY_TYPE_WXQRCODE = 7;
    const PAY_TYPE_QQQRCODE = 8;
    public static $orderPayType = [
        self::PAY_TYPE_UN_PAY => ['text' => '未支付', 'key' => self::PAY_TYPE_UN_PAY],
        self::PAY_TYPE_TENPAY => ['text' => '财付通', 'key' => self::PAY_TYPE_TENPAY],
        self::PAY_TYPE_WXPAY => ['text' => '微信支付', 'key' => self::PAY_TYPE_WXPAY],
        self::PAY_TYPE_DELIVERY => ['text' => '货到付款', 'key' => self::PAY_TYPE_DELIVERY],
        self::PAY_TYPE_COLLECTION => ['text' => '代收', 'key' => self::PAY_TYPE_COLLECTION],
        self::PAY_TYPE_NEWWXPAY => ['text' => '微信支付', 'key' => self::PAY_TYPE_NEWWXPAY],
        self::PAY_TYPE_MONEY => ['text' => '现金支付', 'key' => self::PAY_TYPE_MONEY],
        self::PAY_TYPE_WXQRCODE => ['text' => '微信刷卡支付', 'key' => self::PAY_TYPE_WXQRCODE],
        self::PAY_TYPE_QQQRCODE => ['text' => '手Q刷卡支付', 'key' => self::PAY_TYPE_QQQRCODE],
    ];

    //订单类型
    const ORDER_TYPE_NORMAL = 1;
    const ORDER_TYPE_SECONDKILL = 2;
    const ORDER_TYPE_PRESALE = 3;
    const ORDER_TYPE_POS_MONEY = 4;
    const ORDER_TYPE_POS_ORDER = 5;
    const ORDER_TYPE_SCAN_ORDER = 7;
    const ORDER_TYPE_TOGETHER_BUY = 8;
    public static $orderType = [
        self::ORDER_TYPE_NORMAL => ['text' => '普通订单'],
        self::ORDER_TYPE_SECONDKILL => ['text' => '秒杀'],
        self::ORDER_TYPE_PRESALE => ['text' => '预售'],
        self::ORDER_TYPE_POS_MONEY => ['text' => 'pos收银'],
        self::ORDER_TYPE_POS_ORDER => ['text' => 'pos订单'],
        self::ORDER_TYPE_SCAN_ORDER => ['text' => '扫码订单'],
        self::ORDER_TYPE_TOGETHER_BUY => ['text' => '拼团订单']
    ];
    //是否使用会员优惠
    const USE_MEMBER_DISCOUNT_YES = 1;
    const USE_MEMBER_DISCOUNT_NO = 2;

    //配送方式
    const PICKUP_TYPE_SHIPPING = 1;
    const PICKUP_TYPE_SELF = 2;

    /**
     * 创建秒杀订单
     * @return mixed
     */
    public function createSecondKill($params)
    {
        $apiParams = [
            'plat_id' => isset($params['plat_id']) ? $params['plat_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'activity_id' => isset($params['activity_id']) ? $params['activity_id'] : null,
            'discount' => isset($params['discount']) ? self::amountToFen($params['discount']) : null,
            'seller_cut' => isset($params['seller_cut']) ? self::amountToFen($params['seller_cut']) : null,
            'red_packet_id' => isset($params['red_packet_id']) ? $params['red_packet_id'] : null,
            'card_id' => isset($params['card_id']) ? $params['card_id'] : null,
            'r_points' => isset($params['r_points']) ? $params['r_points'] : null,
            'shop_staff_id' => isset($params['shop_staff_id']) ? $params['shop_staff_id'] : null,
            'share_message_id' => isset($params['share_message_id']) ? $params['share_message_id'] : null,
            'pickup_type' => isset($params['pickup_type']) ? $params['pickup_type'] : null,
            'pickup_shop_sub_id' => isset($params['pickup_shop_sub_id']) ? $params['pickup_shop_sub_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'ip' => isset($params['ip']) ? $params['ip'] : null,
            'user_name' => isset($params['user_name']) ? $params['user_name'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'delivery_id' => isset($params['delivery_id']) ? $params['delivery_id'] : null,
            'products' => [
                'num' => isset($params['products']['num']) ? $params['products']['num'] : null,
                'sku_id' => isset($params['products']['sku_id']) ? $params['products']['sku_id'] : null,
                'id' => isset($params['products']['id']) ? $params['products']['id'] : null,
            ]
        ];
        $this->getResult('order-create-secondkill', $apiParams);
    }


    /**
     * 创建普通订单
     * @return mixed
     */
    public function create($params)
    {
        $apiParams = [
            'plat_id' => isset($params['plat_id']) ? $params['plat_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'discount' => isset($params['discount']) ? self::amountToFen($params['discount']) : null,
            'seller_cut' => isset($params['seller_cut']) ? self::amountToFen($params['seller_cut']) : null,
            'red_packet_id' => isset($params['red_packet_id']) ? $params['red_packet_id'] : null,
            'card_id' => isset($params['card_id']) ? $params['card_id'] : null,
            'r_points' => isset($params['r_points']) ? $params['r_points'] : null,
            'shop_staff_id' => isset($params['shop_staff_id']) ? $params['shop_staff_id'] : null,
            'share_message_id' => isset($params['share_message_id']) ? $params['share_message_id'] : null,
            'pickup_type' => isset($params['pickup_type']) ? $params['pickup_type'] : null,
            'pickup_shop_sub_id' => isset($params['pickup_shop_sub_id']) ? $params['pickup_shop_sub_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'ip' => isset($params['ip']) ? $params['ip'] : null,
            'user_name' => isset($params['user_name']) ? $params['user_name'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'delivery_id' => isset($params['delivery_id']) ? $params['delivery_id'] : null,
            'products' => $this->createProductFormat($params['products']),
            'fx_member_id' => isset($params['fx_member_id']) ? $params['fx_member_id'] : null,
            'pickup_type' => isset($params['pickup_type']) ? $params['pickup_type'] : null,
        ];
        $this->getResult('order-create', $apiParams);
    }

    /**
     * 创建扫码订单订单
     * @return mixed
     */
    public function createScan($params)
    {
        $this->getResult('order-create-scan', $params);
    }

    /**
     * 创建订单商品参数转换
     * @return mixed
     */
    private function createProductFormat($products)
    {
        $productIds = ['ids' => []];
        foreach ($products as $key => $params) {
            $products[$key] = [
                'sku_id' => isset($params['sku_id']) ? $params['sku_id'] : null,
                'num' => isset($params['num']) ? $params['num'] : null,
                'id' => isset($params['id']) ? $params['id'] : null,
                'mid' => isset($params['mid']) ? $params['mid'] : null
            ];
            $productIds['ids'][] = $params['id'];
        }
        //清除这个商品的缓存，因为库存变了
        $productCache = new ProductCache();
        $productCache->delCache($productIds);
        //返回结果
        return $products;
    }

    /**
     * 获取订单
     * @return mixed
     */
    public function get($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'service_id' => isset($params['service_id']) ? $params['service_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'queueWithFlag' => isset($params['queueWithFlag']) ? $params['queueWithFlag'] : null,
            'pickup_code' => isset($params['pickup_code']) ? $params['pickup_code'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('order-get', $apiParams);
        if (!is_null($this->_data)) {
            $this->_data['total_price'] = self::amountToYuan($this->_data['total_price']);
            $this->_data['delivery_fee'] = self::amountToYuan($this->_data['delivery_fee']);
            $this->_data['should_pay'] = self::amountToYuan($this->_data['should_pay']);
            $this->_data['payed'] = self::amountToYuan($this->_data['payed']);
            $this->_data['qr_discount'] = self::amountToYuan($this->_data['qr_discount']);
            $this->_data['point_discount'] = self::amountToYuan($this->_data['point_discount']);
            $this->_data['member_discount_num'] = self::amountToYuan($this->_data['member_discount_num']);
            $this->_data['seller_cut'] = self::amountToYuan($this->_data['seller_cut']);
            $this->_data['discount'] = self::amountToYuan($this->_data['discount']);
            foreach ($this->_data['orderDetails'] as $key => $val) {
                $this->_data['orderDetails'][$key]['price'] = self::amountToYuan($this->_data['orderDetails'][$key]['price']);
                $this->_data['orderDetails'][$key]['cost_price'] = self::amountToYuan($this->_data['orderDetails'][$key]['cost_price']);
                $this->_data['orderDetails'][$key]['kinds'] = json_decode($val['kinds']);
            }
            $this->setResult($this->_data);
        } else {
            $this->setError();
        }
    }

    /**
     * 普通订单支付
     * @return mixed
     */
    public function pay($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'r_points' => isset($params['r_points']) ? $params['r_points'] : null,
            'red_packet_id' => isset($params['red_packet_id']) ? $params['red_packet_id'] : null,
            'card_id' => isset($params['card_id']) ? $params['card_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'customer_mark' => isset($params['customer_mark']) ? $params['customer_mark'] : null,
            'orderPayInfo' => $this->formatPay($params['orderPayInfo']),
            'member_discount' => isset($params['member_discount']) ? $params['member_discount'] : null,
            'pickup_shop_sub_id' => isset($params['pickup_shop_sub_id']) ? $params['pickup_shop_sub_id'] : null,
            'pickup_date' => isset($params['pickup_date']) ? $params['pickup_date'] : null,
            'pickup_name' => isset($params['pickup_name']) ? $params['pickup_name'] : null,
            'pickup_phone' => isset($params['pickup_phone']) ? $params['pickup_phone'] : null,
        ];
        $this->getResult('order-simple-pay', $apiParams);
        if (isset($this->_data['should_pay'])) {
            $this->_data['should_pay'] = self::amountToYuan($this->_data['should_pay']);
        }
    }

    /**
     * 普通订单支付
     * @return mixed
     */
    public function payDone($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null,
            'amount' => isset($params['amount']) ? $params['amount'] : null,
            'pay_id' => isset($params['pay_id']) ? $params['pay_id'] : null,
            'pay_type' => isset($params['pay_type']) ? $params['pay_type'] : null,
            'trade_no' => isset($params['trade_no']) ? $params['trade_no'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null
        ];
        $this->getResult('order-pay-done', $apiParams);
    }

    /**
     * 订单支付数据转换
     * @return mixed
     */
    private function formatPay($orderPayInfo)
    {
        foreach ($orderPayInfo as $key => $params) {
            $orderPayInfo[$key] = [
                'pay_type' => isset($params['pay_type']) ? $params['pay_type'] : null,
                'amount' => isset($params['amount']) ? self::amountToFen($params['amount']) : null
            ];
        }
        return $orderPayInfo;
    }

    /**
     * 订单列表
     * @return mixed
     */
    public function find($params)
    {
        $this->getResult('order-find', $params);
        if (isset($this->_data['data']) && count($this->_data['data'])) {
            foreach ($this->_data['data'] as $orderKey => $orderValue) {
                $this->_data['data'][$orderKey]['total_price'] = self::amountToYuan($orderValue['total_price']);
                $this->_data['data'][$orderKey]['delivery_fee'] = self::amountToYuan($orderValue['delivery_fee']);
                $this->_data['data'][$orderKey]['should_pay'] = self::amountToYuan($orderValue['should_pay']);
                $this->_data['data'][$orderKey]['payed'] = self::amountToYuan($orderValue['payed']);
                $this->_data['data'][$orderKey]['qr_discount'] = self::amountToYuan($orderValue['qr_discount']);
                $this->_data['data'][$orderKey]['point_discount'] = self::amountToYuan($orderValue['point_discount']);
                $this->_data['data'][$orderKey]['seller_cut'] = self::amountToYuan($orderValue['seller_cut']);
                $this->_data['data'][$orderKey]['discount'] = self::amountToYuan($orderValue['discount']);
                $this->_data['data'][$orderKey]['member_discount_num'] = self::amountToYuan($orderValue['member_discount_num']);
                foreach ($orderValue['orderDetails'] as $key => $val) {
                    $this->_data['data'][$orderKey]['orderDetails'][$key]['price'] = self::amountToYuan($this->_data['data'][$orderKey]['orderDetails'][$key]['price']);
                    $this->_data['data'][$orderKey]['orderDetails'][$key]['cost_price'] = self::amountToYuan($this->_data['data'][$orderKey]['orderDetails'][$key]['cost_price']);
                    $this->_data['data'][$orderKey]['orderDetails'][$key]['kinds'] = json_decode($val['kinds'], true);
                }
            }
        }
        $this->setResult($this->_data);
    }

    /**
     * 修改收货地址
     * @return mixed
     */
    public function updateAddress($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'delivery_id' => isset($params['delivery_id']) ? $params['delivery_id'] : null
        ];
        $this->getResult('order-update-delivery', $apiParams);
    }

    /**
     * 商家修改收货人信息
     * @return mixed
     */
    public function sellerUpdateAddress($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null,
            'consignee' => isset($params['consignee']) ? $params['consignee'] : null,
            'tel' => isset($params['tel']) ? $params['tel'] : null,
            'delivery_id' => isset($params['delivery_id']) ? $params['delivery_id'] : null,
            'province' => isset($params['province']) ? $params['province'] : null,
            'city' => isset($params['city']) ? $params['city'] : null,
            'county' => isset($params['county']) ? $params['county'] : null,
            'detail' => isset($params['detail']) ? $params['detail'] : null,
            'zip' => isset($params['zip']) ? $params['zip'] : null
        ];
        $this->getResult('order-seller-update-delivery', $apiParams);
    }

    /**
     * 商家手动优惠
     * @return mixed
     */
    public function sellerUpdateDiscount($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'seller_cut' => isset($params['seller_cut']) ? self::amountToFen($params['seller_cut']) : null
        ];
        $this->getResult('order-seller-update-discount', $apiParams);
    }

    /**
     * 申请退款
     * @return mixed
     */
    public function refund($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'content' => isset($params['content']) ? $params['content'] : "",
            'refund_reason' => isset($params['refund_reason']) ? $params['refund_reason'] : null,
            'user_phone' => isset($params['user_phone']) ? $params['user_phone'] : null,
            'type' => isset($params['type']) ? $params['type'] : 1,
            'pic_list' => isset($params['pic_list']) ? $params['pic_list'] : null,
        ];
        $this->getResult('order-apply-refund', $apiParams);
    }

    /**
     * 取消退款
     * @return mixed
     */
    public function cancelRefund($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
        ];
        $this->getResult('order-cancel-refund', $apiParams);
    }


    /**
     * 取消退款
     * @return mixed
     */
    public function refundLog($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'after_sales_service_id' => isset($params['id']) ? $params['id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('order-refund-log', $apiParams);
        if (isset($this->_data['data']) && count($this->_data['data'])) {
            foreach ($this->_data['data'] as $orderKey => $orderValue) {
                if (isset($this->_data['data'][$orderKey]['order'])) {
                    $this->_data['data'][$orderKey]['order']['total_price'] = self::amountToYuan($orderValue['order']['total_price']);
                    $this->_data['data'][$orderKey]['order']['delivery_fee'] = self::amountToYuan($orderValue['order']['delivery_fee']);
                    $this->_data['data'][$orderKey]['order']['should_pay'] = self::amountToYuan($orderValue['order']['should_pay']);
                    $this->_data['data'][$orderKey]['order']['payed'] = self::amountToYuan($orderValue['order']['payed']);
                    $this->_data['data'][$orderKey]['order']['qr_discount'] = self::amountToYuan($orderValue['order']['qr_discount']);
                    $this->_data['data'][$orderKey]['order']['point_discount'] = self::amountToYuan($orderValue['order']['point_discount']);
                    $this->_data['data'][$orderKey]['order']['seller_cut'] = self::amountToYuan($orderValue['order']['seller_cut']);
                    $this->_data['data'][$orderKey]['order']['discount'] = self::amountToYuan($orderValue['order']['discount']);
                    foreach ($orderValue['order']['orderDetails'] as $key => $val) {
                        $this->_data['data'][$orderKey]['order']['orderDetails'][$key]['cost_price'] = self::amountToYuan($this->_data['data'][$orderKey]['order']['orderDetails'][$key]['price']);
                        $this->_data['data'][$orderKey]['order']['orderDetails'][$key]['cost_price'] = self::amountToYuan($this->_data['data'][$orderKey]['order']['orderDetails'][$key]['cost_price']);
                        $this->_data['data'][$orderKey]['order']['orderDetails'][$key]['kinds'] = json_decode($val['kinds'], true);
                    }
                }
            }
        }
    }

    /**
     * 退款审核通过
     * @return mixed
     */
    public function refundPass($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'reply' => isset($params['reply']) ? $params['reply'] : null
        ];
        $this->getResult('order-pass-refund', $apiParams);
    }

    /**
     * 退款审核不通过
     * @return mixed
     */
    public function refundRefuse($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'reply' => isset($params['reply']) ? $params['reply'] : null
        ];
        $this->getResult('order-refuse-refund', $apiParams);
    }

    /**
     * 售后处理完成
     * @return mixed
     */
    public function afterConfirm($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null
        ];
        $this->getResult('after-order-confirm', $apiParams);
    }

    /**
     * 售后单信息列表
     * @return mixed
     */
    public function findRefund($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'shop_staff_id' => isset($params['shop_staff_id']) ? $params['shop_staff_id'] : null,
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'order_no' => isset($params['order_no']) ? $params['order_no'] : null,
            'service_no' => isset($params['service_no']) ? $params['service_no'] : null,
            'order_type' => isset($params['order_type']) ? $params['order_type'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
            'pay_type' => isset($params['pay_type']) ? $params['pay_type'] : null,
            'consignee' => isset($params['consignee']) ? $params['consignee'] : null,
            'tel' => isset($params['tel']) ? $params['tel'] : null,
            'user_phone' => isset($params['user_phone']) ? $params['user_phone'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'pickup_type' => isset($params['pickup_type']) ? $params['pickup_type'] : null,
        ];
        $this->getResult('order-refund-list', $apiParams);
    }


    /**
     * 确认收货
     * @return mixed
     */
    public function takeOver($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null
        ];
        $this->getResult('order-take-over', $apiParams);
    }

    /**
     * 关闭订单
     * @return mixed
     */
    public function close($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null
        ];
        $this->getResult('order-close', $apiParams);
    }

    /**
     * 商家取消订单
     * @return mixed
     */
    public function sellerCancel($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null,
            'seller_mark' => isset($params['seller_mark']) ? $params['seller_mark'] : null
        ];
        $this->getResult('order-seller-cancel', $apiParams);
    }

    /**
     * 用户取消订单
     * @return mixed
     */
    public function cancel($params)
    {
        //拿接口数据
        $apiParams = [
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null,
            'customer_mark' => isset($params['customer_mark']) ? $params['customer_mark'] : null
        ];
        $this->getResult('order-cancel', $apiParams);
    }

    /**
     * 发货
     * @return mixed
     */
    public function deliver($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null,
            'express_type' => isset($params['express_type']) ? $params['express_type'] : null,
            'express_no' => isset($params['express_no']) ? $params['express_no'] : null,
            'seller_mark' => isset($params['seller_mark']) ? $params['seller_mark'] : null,
            'consignor' => isset($params['consignor']) ? $params['consignor'] : null,
        ];
        $this->getResult('deliver-done', $apiParams);
    }

    /**
     * 商家创建订单日志
     * @return mixed
     */
    public function createLog($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null,
            'content' => isset($params['content']) ? $params['content'] : null
        ];
        $this->getResult('order-create-log', $apiParams);
    }

    /**
     * 获取订单日志列表
     * @return mixed
     */
    public function findLog($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null,
            'page' => 0,
            'count' => 100,
            'sortStr' => ['id' => 'desc']
        ];
        $this->getResult('order-find-log', $apiParams);
    }

    /**
     * 添加邮费模板
     * @return mixed
     */
    public function createShippingMode($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'logistics_company' => isset($params['logistics_company']) ? $params['logistics_company'] : null,
            'default_money' => isset($params['default_money']) ? self::amountToFen($params['default_money']) : null,
            'default_weight' => isset($params['default_weight']) ? $params['default_weight'] : null,
            'increase' => isset($params['increase']) ? self::amountToFen($params['increase']) : null,
            'w_increase' => isset($params['w_increase']) ? $params['w_increase'] : null,
            'order' => isset($params['order']) ? $params['order'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'remarks' => isset($params['remarks']) ? $params['remarks'] : null,
            'area' => $this->formatArea($params['area'])
        ];
        $this->getResult('shipping-mode-create', $apiParams, false);
    }

    /**
     * 邮费模板地区数据转换
     * @return mixed
     */
    private function formatArea($area)
    {
        if (is_array($area) && count($area)) {
            foreach ($area as $key => $params) {
                $area[$key] = [
                    'id' => isset($params['id']) ? $params['id'] : null,
                    'area' => isset($params['area']) ? $params['area'] : null,
                    'default' => isset($params['default']) ? self::amountToFen($params['default']) : null,
                    'increase' => isset($params['increase']) ? self::amountToFen($params['increase']) : null,
                    'area_text' => isset($params['area_text']) ? $params['area_text'] : null,
                ];
            }
        }
        return $area;
    }

    /**
     * 获取邮费模板
     * @return mixed
     */
    public function getShippingMode($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'delivery_id' => isset($params['delivery_id']) ? $params['delivery_id'] : null
        ];
        $this->getResult('shipping-mode-get', $apiParams);
        if (!is_null($this->_data)) {
            $this->_data['default'] = self::amountToYuan($this->_data['default']);
            $this->_data['increase'] = self::amountToYuan($this->_data['increase']);
            if (is_array($this->_data['productsShippingFees']) && count($this->_data['productsShippingFees'])) {
                foreach ($this->_data['productsShippingFees'] as $key => $val) {
                    $this->_data['productsShippingFees'][$key]['increase'] = self::amountToYuan($val['increase']);
                    $this->_data['productsShippingFees'][$key]['default'] = self::amountToYuan($val['default']);
                }
            }
        }
    }

    /**
     * 查找邮费模板
     * @return mixed
     */
    public function findShippingMode($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('shipping-mode-find', $apiParams);
        if (isset($this->_data['data']) && count($this->_data['data'])) {
            foreach ($this->_data['data'] as $dataKey => $dataVal) {
                $this->_data['data'][$dataKey]['default'] = self::amountToYuan($dataVal['default']);
                $this->_data['data'][$dataKey]['increase'] = self::amountToYuan($dataVal['increase']);
            }
        }
    }

    /**
     * 删除邮费模板
     * @return mixed
     */
    public function delShippingMode($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'delivery_id' => isset($params['delivery_id']) ? $params['delivery_id'] : null,
            'flag' => isset($params['flag']) ? $params['flag'] : null
        ];
        $this->getResult('shipping-mode-del', $apiParams);
    }

    /**
     * 删除邮费模板
     * @return mixed
     */
    public function delShippingFee($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null
        ];
        $this->getResult('shipping-fee-del', $apiParams);
    }

    /**
     * 修改邮费模板
     * @return mixed
     */
    public function updateShippingMode($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'delivery_id' => isset($params['delivery_id']) ? $params['delivery_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'logistics_company' => isset($params['logistics_company']) ? $params['logistics_company'] : null,
            'default_money' => isset($params['default_money']) ? self::amountToFen($params['default_money']) : null,
            'default_weight' => isset($params['default_weight']) ? $params['default_weight'] : null,
            'increase' => isset($params['increase']) ? self::amountToFen($params['increase']) : null,
            'w_increase' => isset($params['w_increase']) ? $params['w_increase'] : null,
            'order' => isset($params['order']) ? $params['order'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'remarks' => isset($params['remarks']) ? $params['remarks'] : null,
            'area' => $this->formatArea($params['area'])
        ];
        $this->getResult('shipping-mode-update', $apiParams, false);
    }

    /**
     * 开启邮费模板
     * @return mixed
     */
    public function openShippingMode($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'delivery_id' => isset($params['delivery_id']) ? $params['delivery_id'] : null
        ];
        $this->getResult('shipping-mode-open', $apiParams);
    }

    /**
     * 关闭邮费模板
     * @return mixed
     */
    public function closeShippingMode($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'delivery_id' => isset($params['delivery_id']) ? $params['delivery_id'] : null,
            'flag' => isset($params['flag']) ? $params['flag'] : null
        ];
        $this->getResult('shipping-mode-close', $apiParams);
    }

    /**
     * 商家确认收货
     * @param $params
     */
    public function staffConfirmReceipt($params)
    {
        //拿接口数据
        $apiParams = [
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'shop_staff_id' => isset($params['shop_staff_id']) ? $params['shop_staff_id'] : null,
            'pickup_code' => isset($params['pickup_code']) ? $params['pickup_code'] : null
        ];
        $this->getResult('order-staff-confirm-receipt', $apiParams);
    }

    /**
     * 查找活动下用户未支付订单列表（非货到付款）
     * @param $params
     */
    public function findUnpayByActivity($params)
    {
        //拿接口数据
        $apiParams = [
            'activity_id' => isset($params['activity_id']) ? $params['activity_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null
        ];
        $this->getResult('order-find-can-cancel-by-activity', $apiParams);
    }

    /**
     * 批量取消活动未支付订单（非货到付款）
     * @param $params
     */
    public function batchCancelByActivity($params)
    {
        //拿接口数据
        $apiParams = [
            'activity_id' => isset($params['activity_id']) ? $params['activity_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null
        ];
        $this->getResult('order-batch-cancel-order-by-activity', $apiParams);
    }

    /**
     * 获取物流信息
     * @param $params
     */
    public function getLogistics($params){
        //拿接口数据
        $apiParams = [
            'express_type' => isset($params['express_type']) ? $params['express_type'] : null,
            'express_no' => isset($params['express_no']) ? $params['express_no'] : null,
            'order_id' => isset($params['order_id']) ? $params['order_id'] : null,
            'get_time' => isset($params['get_time']) ? $params['get_time'] : null
        ];
        $this->getResult('find-logistics', $apiParams);
    }


}
