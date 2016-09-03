<?php
/**
 * Author: LiuPing
 * Date: 2015/12/31
 * Time: 10:05
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * CashRedpack model
 */
class CashRedpack extends BaseModel
{
    // 类缓存前缀
    const CACHE_KEY_PRE = 'models_cash_redpack';

    //红包启用状态 1启用 2禁用 3删除
    const CASHREDPACK_OPEN= 1;
    const CASHREDPACK_CLOSE= 2;
    const CASHREDPACK_DELETED= 3;

    //红包类型 1定额 2随机
    const TYPE_FIXED = 1;
    const TYPE_RANDOM = 2;

    //发放平台 1：微商户 2：开放平台
    const PLATFORM_WSH = 1;
    const PLATFORM_OPEN = 2;

    //是否可共享活动 1是 2否，默认2
    const SHARE_YES = 1;
    const SHARE_NO = 2;

    //发放状态：1发放失败，2未领取，3已领取，4已退款，5发放中
    const SEND_STATUS_FAIL = 1;
    const SEND_STATUS_WAITING_RECEIVE = 2;
    const SEND_STATUS_SUCCESS = 3;
    const SEND_STATUS_REFUND = 4;
    const SEND_STATUS_ONGOING = 5;

    //获取方式：1扫码领取，2手动派送，3抽奖活动，4购物赠送，5游戏奖励，6平台发放
    const SOURCE_SCAN = 1;
    const SOURCE_HAND_SEND = 2;
    const SOURCE_JOIN_ACTIVITY = 3;
    const SOURCE_BUY_PRODUCT = 4;
    const SOURCE_GAME = 5;
    const SOURCE_PLATFORM_SEND = 6;

    //规则类型：1指定金额，2指定商品
    const STRATEGY_TYPE_AMOUNT = 1;
    const STRATEGY_TYPE_PRODUCT = 2;

    /**
     * TODO 新增现金红包
     * @param $params
     */
    public function create($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'send_name' => isset($params['send_name']) ? $params['send_name'] : null,
            'act_name' => isset($params['act_name']) ? $params['act_name'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'quantity' => isset($params['quantity']) ? $params['quantity'] : null,
            'min_value' => isset($params['min_value']) ? $params['min_value'] : null,
            'max_value' => isset($params['max_value']) ? $params['max_value'] : null,
            'total_num' => isset($params['total_num']) ? $params['total_num'] : null,
            'wishing' => isset($params['wishing']) ? $params['wishing'] : null,
            'remark' => isset($params['remark']) ? $params['remark'] : null,
            'platform' => isset($params['platform']) ? $params['platform'] : null,
            'can_share' => isset($params['can_share']) ? $params['can_share'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null
        ];
        $this->getResult('cash-redpack-create', $apiParams);
    }

    /**
     * TODO 更新现金红包
     * @param $params
     */
    public function update($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'act_name' => isset($params['act_name']) ? $params['act_name'] : null,
            'send_name' => isset($params['send_name']) ? $params['send_name'] : null,
            'wishing' => isset($params['wishing']) ? $params['wishing'] : null,
            'remark' => isset($params['remark']) ? $params['remark'] : null,
            'can_share' => isset($params['can_share']) ? $params['can_share'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null
        ];
        $this->getResult('cash-redpack-update', $apiParams);
    }

    /**
     * TODO 获取现金红包
     * @param $params
     */
    public function get($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'can_share' => isset($params['can_share']) ? $params['can_share'] : null,
            'platform' => isset($params['platform']) ? $params['platform'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null
        ];
        $this->getResult('cash-redpack-get', $apiParams);
    }

    /**
     * TODO 获取现金红包列表
     * @param $params
     */
    public function find($params)
    {
        //拿接口数据
        $apiParams = [
            'type' => isset($params['type']) ? $params['type'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'platform' => isset($params['platform']) ? $params['platform'] : null,
            'act_name' => isset($params['act_name']) ? $params['act_name'] : null,
            'can_share' => isset($params['can_share']) ? $params['can_share'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'valid' => isset($params['valid']) ? $params['valid'] : null, //去掉库存为0和关闭删除状态
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('cash-redpack-find', $apiParams);
    }

    /**
     * 获取所有现金红包列表  无分页
     * @param $params
     */
    public function findAll($params)
    {
        //拿接口数据
        $apiParams = [
            'type' => isset($params['type']) ? $params['type'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'valid' => isset($params['valid']) ? $params['valid'] : null,
            'platform' => isset($params['platform']) ? $params['platform'] : null,
            'can_share' => isset($params['can_share']) ? $params['can_share'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null
        ];
        $this->getResult('cash-redpack-find-all', $apiParams);
    }

    /**
     * 启用现金红包
     * @param $params
     */
    public function open($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('cash-redpack-open', $apiParams);
    }

    /**
     * 禁用现金红包
     * @param $params
     */
    public function close($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('cash-redpack-close', $apiParams);
    }

    /**
     * 删除现金红包
     * @param $params
     */
    public function delete($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('cash-redpack-del', $apiParams);
    }

    /**
     * 获取现金红包个人发放列表
     * @param $params
     */
    public function findUserCashredpack($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'cash_redpack_id' => isset($params['cash_redpack_id']) ? $params['cash_redpack_id'] : null,
            'group_id' => isset($params['group_id']) ? $params['group_id'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'source' => isset($params['source']) ? $params['source'] : null,
            'keyword' => isset($params['keyword']) ? $params['keyword'] : null,
            'wx_keyword' => isset($params['wx_keyword']) ? $params['wx_keyword'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null
        ];
        $this->getResult('cash-redpack-data-find', $apiParams);
    }

    /**
     * 获取红包群组发放列表
     * @param $params
     */
    public function findCashredpackGroup($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'cash_redpack_id' => isset($params['cash_redpack_id']) ? $params['cash_redpack_id'] : null,
            'keyword' => isset($params['keyword']) ? $params['keyword'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null
        ];
        $this->getResult('cash-redpack-group-find', $apiParams);
    }

    /**
     * 按用户派发红包
     * @param $params
     */
    public function sendCashredpack($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'cash_redpack_id' => isset($params['cash_redpack_id']) ? $params['cash_redpack_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'source' => isset($params['source']) ? $params['source'] : null
        ];
        $this->getResult('cash-redpack-send', $apiParams);
    }

    /**
     * 扫码派发红包
     * @param $params
     */
    public function sendCashredpackByScan($params)
    {
      $apiParams = [
          'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
          'cash_redpack_id' => isset($params['cash_redpack_id']) ? $params['cash_redpack_id'] : null,
          'open_id' => isset($params['open_id']) ? $params['open_id'] : null
      ];
      $this->getResult('cash-redpack-send-by-scan', $apiParams);
    }

    /**
     * 按群组派发红包
     * @param $params
     */
    public function groupSendCashredpack($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'cash_redpack_id' => isset($params['cash_redpack_id']) ? $params['cash_redpack_id'] : null,
            'wx_group_id' => isset($params['wx_group_id']) ? $params['wx_group_id'] : null,
            'source' => isset($params['source']) ? $params['source'] : null
        ];
        $this->getResult('cash-redpack-group-send', $apiParams);
    }

    /**
     * 重新派发
     * @param $params
     */
    public function resendCashredpack($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('cash-redpack-resend', $apiParams);
    }

    /**
     * 重新派发
     * @param $params
     */
    public function updateCashredpackDateStatus($params){
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null, //红包数据id(单条数据id，或多条数据id数组)
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('cash-redpack-update-data-status', $apiParams);
    }

    /**
     * 添加消费赠送规则
     * @param $params
     */
    public function createCashredpackStrategy($params){
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'cash_redpack_id' => isset($params['cash_redpack_id']) ? $params['cash_redpack_id'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'amount' => isset($params['amount']) ? $params['amount'] : null,
            'product_ids' => isset($params['product_ids']) ? $params['product_ids'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null
        ];
        $this->getResult('cash-redpack-strategy-create', $apiParams);
    }

    /**
     * 修改消费赠送规则
     * @param $params
     */
    public function updateCashredpackStrategy($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'cash_redpack_id' => isset($params['cash_redpack_id']) ? $params['cash_redpack_id'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'amount' => isset($params['amount']) ? $params['amount'] : null,
            'product_ids' => isset($params['product_ids']) ? $params['product_ids'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null
        ];
        $this->getResult('cash-redpack-strategy-update', $apiParams);
    }

    /**
     * 获取消费赠送规则详情
     * @param $params
     */
    public function getCashredpackStrategy($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('cash-redpack-strategy-get', $apiParams);
    }

    /**
     * 获取消费赠送规则列
     * @param $params
     */
    public function findCashredpackStrategy($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'cash_redpack_id' => isset($params['cash_redpack_id']) ? $params['cash_redpack_id'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'page' => isset($params['page']) ? $params['page'] : null
        ];
        $this->getResult('cash-redpack-strategy-find', $apiParams);
    }

    /**
     * 启用策略规则
     * @param $params
     */
    public function openCashredpackStrategy($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('cash-redpack-strategy-open', $apiParams);
    }

    /**
     * 关闭策略规则
     * @param $params
     */
    public function closeCashredpackStrategy($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('cash-redpack-strategy-close', $apiParams);
    }

    /**
     * 删除策略规则
     * @param $params
     */
    public function deleteCashredpackStrategy($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('cash-redpack-strategy-delete', $apiParams);
    }
}

