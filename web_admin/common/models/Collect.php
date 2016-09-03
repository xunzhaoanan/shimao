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
 * CollectReceive model
 */
class Collect extends BaseModel
{

    // 类缓存前缀
    const CACHE_KEY_PRE = 'models_collect_';

    /**
     * 代领
     */
    const COLLECT_RECEIVE = 1;
    /**
     * 红包
     */
    const COLLECT_REDPACKET = 2;
    /**
     * 点赞
     */
    const COLLECT_ZAN = 3;
    /**
     * 众筹结果：已完成
     */
    const COLLECT_JOIN_STATUS_FINISH = 1;
    /**
     * 众筹结果：未完成
     */
    const COLLECT_JOIN_STATUS_UNFINISH = 2;
    /**
     * 众筹结果：已兑换
     */
    const COLLECT_JOIN_STATUS_EXCHANGE = 3;

    /**
     * 代理摘要 加数
     * @var array
     */
    static public $luckWord = [
        '你的好运怎么也分不完呐！',
        '哇！人品大爆发！',
        '快来沾沾我的喜气吧，哈哈！',
        '哈哈，让你见识见识我的厉害！',
        '哇，幸运之神降临了！'
    ];

    /**
     * 代理摘要 负数
     * @var array
     */
    static public $hateWord = [
        '衰神来了！',
        '哎呀，我会帮你分享给朋友的！',
        '呜呜呜呜，我不是故意的！',
        '我一定会卷土重来的！',
        '我就是来捣乱的~~~我还会继续捣乱下去的'
    ];

    /**
     * 创建活动
     * @param $params
     */
    public function create($params)
    {
        $apiParams = [
            'collect' => [
                'name' => isset($params['collect']['name']) ? $params['collect']['name'] : null,
                'rule' => isset($params['collect']['rule']) ? $params['collect']['rule'] : null,
                'is_attention' => isset($params['collect']['is_attention']) ? $params['collect']['is_attention'] : null,
                'document_id' => isset($params['collect']['document_id']) ? $params['collect']['document_id'] : null,
                'start_time' => isset($params['collect']['start_time']) ? $params['collect']['start_time'] : null,
                'end_time' => isset($params['collect']['end_time']) ? $params['collect']['end_time'] : null,
                'deleted' => isset($params['collect']['deleted']) ? $params['collect']['deleted'] : null,
                'shop_id' => isset($params['collect']['shop_id']) ? $params['collect']['shop_id'] : null,
                'shop_sub_id' => isset($params['collect']['shop_sub_id']) ? $params['collect']['shop_sub_id'] : null,
                'share_type' => isset($params['collect']['share_type']) ? $params['collect']['share_type'] : null,
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
            ],
            'type' => isset($params['collect']['type']) ? $params['collect']['type'] : null, //代领类型
        ];
        //去除空白数组
        array_remove_empty($apiParams);
        $this->getResult('collect-create', $apiParams);
    }

    /**
     * 更新活动
     * @param $params
     */
    public function update($params)
    {
        $apiParams = [
            'collect' => [
                'id' => isset($params['collect']['id']) ? $params['collect']['id'] : null,
                'name' => isset($params['collect']['name']) ? $params['collect']['name'] : null,
                'rule' => isset($params['collect']['rule']) ? $params['collect']['rule'] : null,
                'is_attention' => isset($params['collect']['is_attention']) ? $params['collect']['is_attention'] : null,
                'document_id' => isset($params['collect']['document_id']) ? $params['collect']['document_id'] : null,
                'start_time' => isset($params['collect']['start_time']) ? $params['collect']['start_time'] : null,
                'end_time' => isset($params['collect']['end_time']) ? $params['collect']['end_time'] : null,
                'deleted' => isset($params['collect']['deleted']) ? $params['collect']['deleted'] : null,
                'shop_id' => isset($params['collect']['shop_id']) ? $params['collect']['shop_id'] : null,
                'shop_sub_id' => isset($params['collect']['shop_sub_id']) ? $params['collect']['shop_sub_id'] : null,
                'share_type' => isset($params['collect']['share_type']) ? $params['collect']['share_type'] : null
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
            ],
            'type' => isset($params['collect']['type']) ? $params['collect']['type'] : null, //代领类型
        ];
        //去除空白数组
        array_remove_empty($apiParams);
        $this->getResult('collect-update', $apiParams);
    }

    /**
     * 获取众筹详情
     * @param $params
     */
    public function get($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null
        ];
        $this->getResult('collect-get', $apiParams);
    }

    /**
     * 获取众筹列表
     * @param $params
     */
    public function find($params)
    {
        //拿接口数据
        $apiParams = [
            'name' => isset($params['name']) ? $params['name'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'share_type' => isset($params['share_type']) ? $params['share_type'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('collect-find', $apiParams);
    }

    /**
     * 新增众筹商品
     * @param $params
     */
    public function createCollectProduct($params)
    {
        $apiParams = [
            'collect_id' => isset($params['collect_id']) ? $params['collect_id'] : null,
            'product_id' => isset($params['product_id']) ? $params['product_id'] : null,
            'product_sku_id' => isset($params['product_sku_id']) ? $params['product_sku_id'] : null,
            'price' => isset($params['price']) ? $params['price'] : null,
            'give' => isset($params['give']) ? $params['give'] : null,
            'number' => isset($params['number']) ? $params['number'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'minus' => isset($params['minus']) ? $params['minus'] : null,
            'lastCount' => isset($params['lastCount']) ? $params['lastCount'] : null, //礼品剩余数
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('collect-create-product', $apiParams);
    }

    /**
     * 更新众筹商品
     * @param $params
     */
    public function updateCollectProduct($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'collect_id' => isset($params['collect_id']) ? $params['collect_id'] : null,
            'product_id' => isset($params['product_id']) ? $params['product_id'] : null,
            'product_sku_id' => isset($params['product_sku_id']) ? $params['product_sku_id'] : null,
            'price' => isset($params['price']) ? $params['price'] : null,
            'give' => isset($params['give']) ? $params['give'] : null,
            'number' => isset($params['number']) ? $params['number'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'minus' => isset($params['minus']) ? $params['minus'] : null,
            'lastCount' => isset($params['lastCount']) ? $params['lastCount'] : null, //礼品剩余数
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('collect-update-product', $apiParams);
    }

    /**
     * 修改自定义商品
     * @param $params
     */
    public function updateCustomGift($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'collect_id' => isset($params['collect_id']) ? $params['collect_id'] : null,
            'give' => isset($params['give']) ? $params['give'] : null,
            'product_sku_id' => isset($params['product_sku_id']) ? $params['product_sku_id'] : null,
            'number' => isset($params['number']) ? $params['number'] : null,
            'price' => isset($params['price']) ? $params['price'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'lastCount' => isset($params['lastCount']) ? $params['lastCount'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'document_id' => isset($params['document_id']) ? $params['document_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('collect-update-custom-gift', $apiParams);
    }

    /**
     * 新增自定义商品
     * @param $params
     */
    public function createCustomGift($params)
    {
        $apiParams = [
            'collect_id' => isset($params['collect_id']) ? $params['collect_id'] : null,
            'give' => isset($params['give']) ? $params['give'] : null,
            'product_sku_id' => isset($params['product_sku_id']) ? $params['product_sku_id'] : null,
            'number' => isset($params['number']) ? $params['number'] : null,
            'price' => isset($params['price']) ? $params['price'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'lastCount' => isset($params['lastCount']) ? $params['lastCount'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'document_id' => isset($params['document_id']) ? $params['document_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('collect-create-custom-gift', $apiParams);
    }

    /**
     * 删除众筹商品
     * @param $params
     */
    public function delCollectProduct($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'collect_id' => isset($params['collect_id']) ? $params['collect_id'] : null,
            'product_id' => isset($params['product_id']) ? $params['product_id'] : null,
            'product_sku_id' => isset($params['product_sku_id']) ? $params['product_sku_id'] : null,
            'price' => isset($params['price']) ? $params['price'] : null,
            'give' => isset($params['give']) ? $params['give'] : null,
            'number' => isset($params['number']) ? $params['number'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'minus' => isset($params['minus']) ? $params['minus'] : null,
            'lastCount' => isset($params['lastCount']) ? $params['lastCount'] : null, //礼品剩余数
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('collect-delete-product', $apiParams);
    }

    /**
     * 删除自定义众筹商品
     * @param $params
     */
    public function delCustomGift($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'collect_id' => isset($params['collect_id']) ? $params['collect_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('collect-delete-custom-gift', $apiParams);
    }

    /**
     * 获取众筹产品列表
     * @param $params
     */
    public function findCollectProduct($params)
    {
        //拿接口数据
        $apiParams = [
            'collect_id' => isset($params['collect_id']) ? $params['collect_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('collect-find-product', $apiParams);
    }

    /**
     * 获取众筹产品列表
     * @param $params
     */
    public function findCustomGift($params)
    {
        //拿接口数据
        $apiParams = [
            'collect_id' => isset($params['collect_id']) ? $params['collect_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('collect-find-custom-gift', $apiParams);
    }

    /**
     * 获取众筹参与名单
     * @param $params
     */
    public function findJoinUser($params)
    {
        //拿接口数据
        $apiParams = [
            'collect_id' => isset($params['collect_id']) ? $params['collect_id'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'nickname' => isset($params['nickname']) ? $params['nickname'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'doFilter' => isset($params['doFilter']) ? $params['doFilter'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('collect-find-join-user', $apiParams);
    }

    /**
     * 获取众筹参与名单
     * @param $params
     */
    public function getJoin($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'collect_id' => isset($params['collect_id']) ? $params['collect_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('collect-get-collect-join', $apiParams);
    }

    /**
     * 获取雷锋列表
     * @param $params
     */
    public function getCollectJoinWithClick($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'collect_id' => isset($params['collect_id']) ? $params['collect_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('collect-get-collect-join-with-click', $apiParams);
    }

    /**
     * 新增join记录
     * @param $params
     */
    public function createCollectJoin($params)
    {
        //拿接口数据
        $apiParams = [
            'collect_id' => isset($params['collect_id']) ? $params['collect_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'mobile' => isset($params['mobile']) ? $params['mobile'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'address' => isset($params['address']) ? $params['address'] : null,
            'collect_product_id' => isset($params['collect_product_id']) ? $params['collect_product_id'] : null,
            'collect_redpacket_id' => isset($params['collect_redpacket_id']) ? $params['collect_redpacket_id'] : null,
            'collect_custom_gift_id' => isset($params['collect_custom_gift_id']) ? $params['collect_custom_gift_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('collect-create-collect-join', $apiParams);
    }

    /**
     * 修改join记录
     * @param $params
     */
    public function updateCollectJoin($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'mobile' => isset($params['mobile']) ? $params['mobile'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'address' => isset($params['address']) ? $params['address'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('collect-update-collect-join', $apiParams);
    }

    /**
     * 创建click记录
     * @param $params
     */
    public function createCollectClick($params)
    {
        //拿接口数据
        $apiParams = [
            'collect_id' => isset($params['collect_id']) ? $params['collect_id'] : null,
            'collect_join_id' => isset($params['collect_join_id']) ? $params['collect_join_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'num' => isset($params['num']) ? $params['num'] : null,
            'word' => isset($params['word']) ? $params['word'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('collect-create-collect-click', $apiParams);
    }

    /**
     * 获取众筹帮点用户
     * @param $params
     */
    public function findClickUser($params)
    {
        //拿接口数据
        $apiParams = [
            'collect_id' => isset($params['collect_id']) ? $params['collect_id'] : null,
            'collect_join_id' => isset($params['collect_join_id']) ? $params['collect_join_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('collect-find-click-user', $apiParams);
    }

    /**
     * 获取代领商品详情
     * @param $params
     */
    public function getReceiveProduct($params)
    {
        //拿接口数据
        $apiParams = [
            'type' => isset($params['type']) ? $params['type'] : null,
            'collect_id' => isset($params['collect_id']) ? $params['collect_id'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('collect-get-receive-product', $apiParams);
    }

    /**
     * 手动兑换 更改状态，新增核销记录
     * @param $params
     */
    public function exchangeJoin($params)
    {
        $apiParams = [
            'collect_id' => isset($params['collect_id']) ? $params['collect_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('collect-exchange-join', $apiParams);
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
        $this->getResult('collect-open', $apiParams);
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
        $this->getResult('collect-close', $apiParams);
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
        $this->getResult('collect-del', $apiParams);
    }

    /**
     * 设置活动默认值
     * @param $type
     * @return array
     */
    public function setDefaultValue($type)
    {
        switch ($type) {
            //代领活动默认值
            case self::COLLECT_RECEIVE:
                $default = [
                    'collect' => [
                        'name' => '代领活动名称',
                        'rule' => RuleConfig::$collectRecive,
                        'is_attention' => Activity::NO_MUCH_SUBSCRIBE,
                        'start_time' => time() + 3600,
                        'end_time' => time() + 3600 * 24,
                        'type' => self::COLLECT_RECEIVE
                    ],
                    'shareMessage' => ShareConfig::$collectReserve
                ];
                break;
            //点赞活动默认值
            case self::COLLECT_ZAN:
                $default = [
                    'collect' => [
                        'name' => '点赞活动名称',
                        'rule' => RuleConfig::$collectZan,
                        'is_attention' => Activity::NO_MUCH_SUBSCRIBE,
                        'start_time' => time() + 3600,
                        'end_time' => time() + 3600 * 24,
                        'type' => self::COLLECT_ZAN
                    ],
                    'shareMessage' => ShareConfig::$collectZan
                ];
                break;
            //拆红包活动默认值
            case self::COLLECT_REDPACKET:
                $default = [
                    'collect' => [
                        'name' => '拆红包活动名称',
                        'rule' => '拆红包活动规则',
                        'is_attention' => Activity::NO_MUCH_SUBSCRIBE,
                        'start_time' => time() + 3600,
                        'end_time' => time() + 3600 * 24,
                        'type' => self::COLLECT_ZAN
                    ],
                    'shareMessage' => ShareConfig::$collectRedpacket
                ];
                break;
            default:
                $default = [];
                break;
        }
        return $default;
    }
}
