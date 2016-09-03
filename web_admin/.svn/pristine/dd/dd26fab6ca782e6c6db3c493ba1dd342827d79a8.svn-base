<?php
/**
 * Author:
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\services\base;

use common\cache\Session;
use common\models\WxShop;
use common\services\BaseService;
use common\models\Cancel;
use common\models\ThirdParty;

class CancelService extends BaseService
{

    protected $CancelModel;

    public function init()
    {
        $this->CancelModel = new Cancel();
    }


    /**
     * 绑定员工微信帐号
     * @return mixed
     */
    public function bindStaffUser($params){
        $this->CancelModel->bindStaffUser($params);
        // 接收数据层处理结果
        if ( ! is_null($this->CancelModel->getError())){
            return $this->setError($this->CancelModel->getError());
        }
        $this->setResult($this->CancelModel->_data);
    }


    /**
     * 取消绑定员工微信帐号
     * @return mixed
     */
    public function cancelStaffUserBind($params){
        $this->CancelModel->cancelStaffUserBind($params);
        // 接收数据层处理结果
        if ( ! is_null($this->CancelModel->getError())){
            return $this->setError($this->CancelModel->getError());
        }
        $this->setResult($this->CancelModel->_data);
    }


    /**
     * 创建核销员
     * @return mixed
     */
    public function createCancelMember($params){
        $this->CancelModel->createCancelMember($params);
        // 接收数据层处理结果
        if ( ! is_null($this->CancelModel->getError())){
            return $this->setError($this->CancelModel->getError());
        }
        $this->setResult($this->CancelModel->_data);
    }


    /**
     * 修改核销员信息
     * @return mixed
     */
    public function updateCancelMember($params){
        $this->CancelModel->updateCancelMember($params);
        // 接收数据层处理结果
        if ( ! is_null($this->CancelModel->getError())){
            return $this->setError($this->CancelModel->getError());
        }
        $this->setResult($this->CancelModel->_data);
    }



    /**
     * 获取核销员详情
     * @return mixed
     */
    public function getCancelMember($params){
        $this->CancelModel->getCancelMember($params);
        // 接收数据层处理结果
        if ( ! is_null($this->CancelModel->getError())){
            return $this->setError($this->CancelModel->getError());
        }
        $this->setResult($this->CancelModel->_data);
    }


    /**
     * 获取核销员列表
     * @return mixed
     */
    public function findCancelMember($params){
        $this->CancelModel->findCancelMember($params);
        // 接收数据层处理结果
        if ( ! is_null($this->CancelModel->getError())){
            return $this->setError($this->CancelModel->getError());
        }
        $this->setResult($this->CancelModel->_data);
    }



    /**
     * 启用核销员
     * @return mixed
     */
    public function enableCancelMember($params){
        $this->CancelModel->enableCancelMember($params);
        // 接收数据层处理结果
        if ( ! is_null($this->CancelModel->getError())){
            return $this->setError($this->CancelModel->getError());
        }
        $this->setResult($this->CancelModel->_data);
    }


    /**
     * 启用/禁用核销员
     * @return mixed
     */
    public function disableCancelMember($params){
        $this->CancelModel->disableCancelMember($params);
        // 接收数据层处理结果
        if ( ! is_null($this->CancelModel->getError())){
            return $this->setError($this->CancelModel->getError());
        }
        $this->setResult($this->CancelModel->_data);
    }

    /**
     * 删除核销员
     * @return mixed
     */
    public function delCancelMember($params){
        $this->CancelModel->delCancelMember($params);
        // 接收数据层处理结果
        if ( ! is_null($this->CancelModel->getError())){
            return $this->setError($this->CancelModel->getError());
        }
        $this->setResult($this->CancelModel->_data);
    }


    /**
     * 获取核销列表
     * @return mixed
     */
    public function getCancelRecords($params){
        $this->CancelModel->getCancelRecords($params);
        // 接收数据层处理结果
        if ( ! is_null($this->CancelModel->getError())){
            return $this->setError($this->CancelModel->getError());
        }
        $this->setResult($this->CancelModel->_data);
    }



    /**
     * 获取核销列表
     * @return mixed
     */
    public function findCancelRecords($params) {
        $this->CancelModel->findCancelRecords($params);
        // 接收数据层处理结果
        if ( ! is_null($this->CancelModel->getError())){
            return $this->setError($this->CancelModel->getError());
        }
        $this->setResult($this->CancelModel->_data);
    }




}