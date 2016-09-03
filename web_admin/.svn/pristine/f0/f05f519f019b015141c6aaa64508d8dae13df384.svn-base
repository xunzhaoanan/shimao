<?php
/**
 * Author: LiuPing
 * Date: 2015/12/31
 * Time: 16:51
 */

namespace common\services\activity;

use common\models\CashRedpack;
use common\services\BaseService;

class CashRedpackService extends BaseService
{

    protected $cashRedpackModel;

    public function init() {
        $this->cashRedpackModel = new CashRedpack();
    }

    /**
     * 手动派发
     * @param $params
     */
    public function handSend($params) {
        $params['source'] = CashRedpack::SOURCE_HAND_SEND; // 手动派发
        //按用户派发
        if (isset($params['uids']) && $params['uids']) {
            $params['uid'] = is_array($params['uids']) && count($params['uids']) == 1 ? $params['uids'][0] : $params['uids'];
            $this->cashRedpackModel->sendCashredpack($params);
        //按群组派发
        } elseif (isset($params['group_ids']) && $params['group_ids']) {
            $params['wx_group_id'] = is_array($params['group_ids']) && count($params['group_ids']) == 1 ? $params['group_ids'][0] : $params['group_ids'];
            $this->cashRedpackModel->groupSendCashredpack($params);
        } else {
            return $this->setError('请选择用户或用户组!');
        }

        // 接收数据层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

    /**
     * 获取用户领取记录
     */
    public function findUserCashredpack($params){
        if(isset($params['_source']) && $params['_source']){
            if($params['_source'] == 6){
                $params['source'] = [CashRedpack::SOURCE_SCAN, CashRedpack::SOURCE_JOIN_ACTIVITY,CashRedpack::SOURCE_GAME];
            }else{
                $params['source'] = $params['_source'];
            }
        }
        $this->cashRedpackModel->findUserCashredpack($params);
        // 接收数据层处理结果
        if (!is_null($this->cashRedpackModel->getError())) {
            return $this->setError($this->cashRedpackModel->getError());
        }
        $this->setResult($this->cashRedpackModel->_data);
    }

}