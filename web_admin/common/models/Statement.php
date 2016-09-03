<?php
/**
 * Author: zhangjn
 * Date: 2016/4/6
 * Time: 10:57
 */

namespace common\models;

use Yii;

/**
 * 对账单
 * Class Statement
 * @package common\models
 */
class Statement extends BaseModel
{
    /**
     * 终端店打款账号设置
     * @param $params
     */
    public function statementReceiveSetting($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'payee' => isset($params['payee']) ? $params['payee'] : null,
            'due_bank' => isset($params['due_bank']) ? $params['due_bank'] : null,
            'opening_bank' => isset($params['opening_bank']) ? $params['opening_bank'] : null,
            'account_no' => isset($params['account_no']) ? $params['account_no'] : null,
            'tel' => isset($params['tel']) ? $params['tel'] : null,
        ];
        $this->getResult('statement-receive-setting',$apiParams, false);
    }

    /**
     * 获取终端店打款账号设置信息
     * @param $params
     */
    public function getStatementReceiveSetting($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('statement-receive-setting-get',$apiParams);
    }

    /**
     * 创建打款记录
     * @param $params
     */
    public function createStatementRecord($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'settlement_start' => isset($params['createStart']) ? $params['createStart'] : null,
            'settlement_end' => isset($params['createEnd']) ? $params['createEnd'] : null,
            'statement_rate' => isset($params['statement_rate']) ? $params['statement_rate'] : null,
            'online_status' => isset($params['online_status']) ? $params['online_status'] : null,
            'pos_pay_status' => isset($params['pos_pay_status']) ? $params['pos_pay_status'] : null,
            'scan_pay_status' => isset($params['scan_pay_status']) ? $params['scan_pay_status'] : null,
            'order_type' => isset($params['order_type']) ? $params['order_type'] : null,
            'consignor_status' => isset($params['consignor_status']) ? $params['consignor_status'] : null,
        ];
        $this->getResult('statement-record-add',$apiParams);
    }

    /**
     * 打款记录列表
     * @param $params
     */
    public function findStatementRecord($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('statement-record-find',$apiParams);
    }

    /**
     * 打款记录门店详情列表
     * @param $params
     */
    public function findStatementDetail($params)
    {
        $apiParams = [
            'statement_record_id' => isset($params['statement_record_id']) ? $params['statement_record_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_name' => isset($params['shop_name']) ? $params['shop_name'] : null,
            'payee' => isset($params['payee']) ? $params['payee'] : null,
            'due_bank' => isset($params['due_bank']) ? $params['due_bank'] : null,
            'status' => (isset($params['status']) && $params['status']) ? $params['status'] : null,
            'push_msg_status' => (isset($params['push_msg_status']) && $params['push_msg_status']) ? $params['push_msg_status'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('statement-detail-find',$apiParams);
    }

    /**
     * 获取打款门店详情
     * @param $params
     */
    public function getStatementDetail($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('statement-detail-get',$apiParams);
    }

    /**
     * 更新打款门店详情信息
     * @param $params
     */
    public function updateStatementDetail($params)
    {
        $apiParams = [
            'ids' => isset($params['ids']) ? $params['ids'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'push_msg_status' => isset($params['push_msg_status']) ? $params['push_msg_status'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
        ];
        $this->getResult('statement-detail-update',$apiParams);
    }

    /**
     * 对账操作日志列表
     * @param $params
     */
    public function findStatementLog($params)
    {
        $apiParams = [
            'statement_record_id' => isset($params['statement_record_id']) ? $params['statement_record_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'content' => isset($params['content']) ? $params['content'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('statement-log-find',$apiParams);
    }

    /**
     * 推送打款结算消息
     * @param $params
     */
    public function sendMessage($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'ids' => isset($params['ids']) ? $params['ids'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'action' => isset($params['action']) ? $params['action'] : null,
        ];
        $this->getResult('statement-send-message',$apiParams);
    }

    /**
     * 获取门店推送消息接收的员工
     * @param $params
     */
    public function findPushMsgStaff($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('statement-push-msg-staff-find',$apiParams);
    }
}