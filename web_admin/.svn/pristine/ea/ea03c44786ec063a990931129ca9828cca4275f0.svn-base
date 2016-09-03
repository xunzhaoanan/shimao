<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 14:05
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Redpack model
 */
class Redpack extends BaseModel
{

    // 类缓存前缀
    const CACHE_KEY_PRE = 'models_redpack_';

    /**
     * 类型：群红包
     */
    const TYPE_GROUP = 1;

    /**
     * 类型：接龙红包
     */
    const TYPE_TRANSMIT = 2;

    /**
     * 领取状态 ：待领取
     */
    const STATUS_WAIT_RECEIVE = 1;

    /**
     * 领取状态 ：进行中
     */
    const STATUS_UNDERWAY = 2;

    /**
     * 领取状态 ：已完成
     */
    const STATUS_FINISH = 3;

    /**
     * 接龙红包猜中状态 ：已猜中
     */
    const GUESS_SUCCESS = 1;
    /**
     * 接龙红包猜中状态 ：猜错
     */
    const GUESS_ERROR = 2;

    /**
     * 获取活动列表
     */
    public function find($params)
    {
        //拿接口数据
        $apiParams = [
            'name' => isset($params['name']) ? $params['name'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'countFlag' => isset($params['countFlag']) ? $params['countFlag'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'share_type' => isset($params['share_type']) ? $params['share_type'] : null
        ];
        $this->getResult('redpack-find', $apiParams);
    }


    /**
     * 获取活动信息
     */
    public function get($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('redpack-get', $apiParams);
    }

    /**
     * 添加活动
     * @param $params
     */
    public function create($params)
    {
        //拿接口数据
        $apiParams = [
            'activity' => [
                'relate_activity_type' => isset($params['activity']['relate_activity_type']) ? $params['activity']['relate_activity_type'] : null,
                'name' => isset($params['activity']['name']) ? $params['activity']['name'] : null,
                'desc' => isset($params['activity']['desc']) ? $params['activity']['desc'] : null,
                'name' => isset($params['activity']['name']) ? $params['activity']['name'] : null,
                'sort' => isset($params['activity']['sort']) ? $params['activity']['sort'] : null,
                'expire_type' => isset($params['activity']['expire_type']) ? $params['activity']['expire_type'] : null,
                'activity_type' => isset($params['activity']['activity_type']) ? $params['activity']['activity_type'] : null,
                'share_message_id' => isset($params['activity']['share_message_id']) ? $params['activity']['share_message_id'] : null,
                'wx_imagetxt_reply_id' => isset($params['activity']['wx_imagetxt_reply_id']) ? $params['activity']['wx_imagetxt_reply_id'] : null,
                'start_time' => isset($params['activity']['start_time']) ? $params['activity']['start_time'] : null,
                'end_time' => isset($params['activity']['end_time']) ? $params['activity']['end_time'] : null,
                'shop_id' => isset($params['activity']['shop_id']) ? $params['activity']['shop_id'] : null,
                'shop_sub_id' => isset($params['activity']['shop_sub_id']) ? $params['activity']['shop_sub_id'] : null,
                'share_type' => isset($params['activity']['share_type']) ? $params['activity']['share_type'] : null
            ],

            'redPacketEvent' => [
                'type' => isset($params['redPacketEvent']['type']) ? $params['redPacketEvent']['type'] : null,
                'red_packet_id' => isset($params['redPacketEvent']['red_packet_id']) ? $params['redPacketEvent']['red_packet_id'] : null,
                'num_per_packet' => isset($params['redPacketEvent']['num_per_packet']) ? $params['redPacketEvent']['num_per_packet'] : null,
                'red_packet_num' => isset($params['redPacketEvent']['red_packet_num']) ? $params['redPacketEvent']['red_packet_num'] : null,
                'is_attention' => isset($params['redPacketEvent']['is_attention']) ? $params['redPacketEvent']['is_attention'] : null
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
        $this->getResult('redpack-create', $apiParams);
    }

    /**
     * 更新活动
     * @param $params
     */
    public function update($params)
    {
        //拿接口数据
        $apiParams = [
            'activity' => [
                'id' => isset($params['activity']['id']) ? $params['activity']['id'] : null,
                'relate_activity_type' => isset($params['activity']['relate_activity_type']) ? $params['activity']['relate_activity_type'] : null,
                'name' => isset($params['activity']['name']) ? $params['activity']['name'] : null,
                'desc' => isset($params['activity']['desc']) ? $params['activity']['desc'] : null,
                'name' => isset($params['activity']['name']) ? $params['activity']['name'] : null,
                'sort' => isset($params['activity']['sort']) ? $params['activity']['sort'] : null,
                'expire_type' => isset($params['activity']['expire_type']) ? $params['activity']['expire_type'] : null,
                'activity_type' => isset($params['activity']['activity_type']) ? $params['activity']['activity_type'] : null,
                'share_message_id' => isset($params['activity']['share_message_id']) ? $params['activity']['share_message_id'] : null,
                'wx_imagetxt_reply_id' => isset($params['activity']['wx_imagetxt_reply_id']) ? $params['activity']['wx_imagetxt_reply_id'] : null,
                'start_time' => isset($params['activity']['start_time']) ? $params['activity']['start_time'] : null,
                'end_time' => isset($params['activity']['end_time']) ? $params['activity']['end_time'] : null,
                'shop_id' => isset($params['activity']['shop_id']) ? $params['activity']['shop_id'] : null,
                'shop_sub_id' => isset($params['activity']['shop_sub_id']) ? $params['activity']['shop_sub_id'] : null,
                'share_type' => isset($params['activity']['share_type']) ? $params['activity']['share_type'] : null,
            ],

            'redPacketEvent' => [
                'id' => isset($params['redPacketEvent']['id']) ? $params['redPacketEvent']['id'] : null,
                'type' => isset($params['redPacketEvent']['type']) ? $params['redPacketEvent']['type'] : null,
                'red_packet_id' => isset($params['redPacketEvent']['red_packet_id']) ? $params['redPacketEvent']['red_packet_id'] : null,
                'num_per_packet' => isset($params['redPacketEvent']['num_per_packet']) ? $params['redPacketEvent']['num_per_packet'] : null,
                'red_packet_num' => isset($params['redPacketEvent']['red_packet_num']) ? $params['redPacketEvent']['red_packet_num'] : null,
                'is_attention' => isset($params['redPacketEvent']['is_attention']) ? $params['redPacketEvent']['is_attention'] : null
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
        $this->getResult('redpack-update', $apiParams);
    }

    /**
     * 开启活动
     * @param $params
     */
    public function onStatus($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('redpack-on-status', $apiParams);
    }

    /**
     * 关闭活动
     * @param $params
     */
    public function offStatus($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('redpack-off-status', $apiParams);
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
        $this->getResult('redpack-delete', $apiParams);
    }

    /**
     *  获取红包item信息
     */
    public function getItem($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('redpack-get-item', $apiParams);
    }

    /**
     * 获取群红包item
     */
    public function getGroupItem($params)
    {
        //拿接口数据
        $apiParams = [
            'item_id' => isset($params['item_id']) ? $params['item_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('group-get-item', $apiParams);
    }

    /**
     * 获取活动对应红包的领取列表
     */
    public function findItemList($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'nickname' => isset($params['nickname']) ? $params['nickname'] : null,
            'red_packet_event_id' => isset($params['red_packet_event_id']) ? $params['red_packet_event_id'] : null //活动id
        ];
        $this->getResult('redpack-find-item-list', $apiParams);
    }

    /**
     * 获取群红包的一条瓜分记录信息
     * @param $params
     */
    public function getGroupLog($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'activity_id' => isset($params['activity_id']) ? $params['activity_id'] : null, //activity_id
            'red_package_item_id' => isset($params['red_package_item_id']) ? $params['red_package_item_id'] : null, //红包item id
            'red_packet_event_id' => isset($params['red_packet_event_id']) ? $params['red_packet_event_id'] : null //活动id
        ];
        $this->getResult('redpack-get-group-log', $apiParams);
    }

    /**
     * 查找群红包记录列表
     */
    public function findGroupLogList($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'activity_id' => isset($params['activity_id']) ? $params['activity_id'] : null, //activity_id
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'red_packet_event_id' => isset($params['red_packet_event_id']) ? $params['red_packet_event_id'] : null,
            'red_package_item_id' => isset($params['red_package_item_id']) ? $params['red_package_item_id'] : null
        ];
        $this->getResult('redpack-find-group-log-list', $apiParams);
    }

    /**
     * 查找接龙红包记录列表
     */
    public function findTransmitLogList($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'is_guess' => isset($params['is_guess']) ? $params['is_guess'] : null, //是否猜中
            'red_packet_event_id' => isset($params['red_packet_event_id']) ? $params['red_packet_event_id'] : null,
            'red_package_item_id' => isset($params['red_package_item_id']) ? $params['red_package_item_id'] : null
        ];
        $this->getResult('redpack-find-transmit-log-list', $apiParams);
    }

    /**
     * 获取接龙红包记录
     */
    public function getTransmitLog($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null
        ];
        $this->getResult('transmit-get-log', $apiParams);
    }

    /**
     * 猜接龙红包
     */
    public function guessTransmit($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'item_id' => isset($params['item_id']) ? $params['item_id'] : null,
            'guess' => isset($params['guess']) ? $params['guess'] : null,
            'pid' => isset($params['pid']) ? $params['pid'] : null,
        ];
        $this->getResult('transmit-guess', $apiParams);
    }

    /**
     * 领取红包
     */
    public function receive($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'activity_id' => isset($params['activity_id']) ? $params['activity_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null
        ];
        $this->getResult('redpack-receive-item', $apiParams);
    }
}

