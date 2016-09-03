<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 10:50
 */

namespace common\services\activity;

use common\models\Reserve;
use common\services\BaseService;

class ReserveService extends ActivityService
{

    protected $reserveModel;

    public function init() {
        parent::init();
        $this->reserveModel = new Reserve();
    }

    /**
     * 检查预约活动
     * @param $params
     */
    public function checkReserve($params) {
        // 接收数据层处理结果
        if (empty($params)) {
            return false;
        }

        return true;
    }

    /**
     * 创建活动
     * @param $params
     */
    public function create($params) {
        //TODO 相关数据验证
        if (isset($params['reserveSetting']['items'])) {
            $params['reserveSetting']['items'] = json_encode($params['reserveSetting']['items']);
        }
        $this->reserveModel->create($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }

    /**
     * 更新活动
     * @param $params
     */
    public function update($params) {
        //TODO 相关数据验证

        $this->reserveModel->update($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }

    /**
     * 详情
     * @param $params
     */
    public function get($params) {
        $this->reserveModel->get($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }

    /**
     * 获取活动列表
     * @param $params
     */
    public function find($params) {
        $this->reserveModel->find($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }

    /**
     * 开启活动
     * @param $params
     */
    public function open($params) {
        $this->reserveModel->open($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }

    /**
     * 关闭活动
     * @param $params
     */
    public function close($params) {
        $this->reserveModel->close($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }

    /**
     * 删除活动
     * @param $params
     */
    public function delete($params) {
        $this->reserveModel->delete($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }

    /**
     * 删除用户预约信息
     * @param $params
     */
    public function delUserData($params) {
        $this->reserveModel->delUserData($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }

    /**
     * 获取活动参与预约用户列表
     * @param $params
     */
    public function findJoinUser($params) {
        $this->reserveModel->joinUser($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            $this->_data = null;
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }

    /**
     * 获取预约者预约信息详情
     * @param $params
     */
    public function getUserData($params) {
        $this->reserveModel->getUserData($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }

    /**
     * 新增用户预约信息
     * @param $params
     */
    public function createUserData($params) {
        $this->reserveModel->createUserData($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }

    /**
     * 修改用户预约信息
     * @param $params
     */
    public function updateUserData($params) {
        $this->reserveModel->updateUserData($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }

    /**
     * 签到操作
     * @param $params
     */
    public function sign($params) {
        $params['status'] = Reserve::STATUS_SIGN_SUCCESS; //签到状态码
        $this->reserveModel->changeStatus($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }

    /*
     * 拒绝用户签到操作
     * @param $params
     *
    public function rejectSign($params)
    {
        $params['status'] = Reserve::STATUS_REJECT_SUCCESS; //拒绝状态码
        $this->reserveModel->changeStatus($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }

    public function passSign($params){
        $params['status'] = Reserve::STATUS_RESERVE_SUCCESS; //通过状态码
        $this->reserveModel->changeStatus($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }*/

    /**
     * 通过预约
     * @param $params
     */
    public function passUserData($params) {
        $this->reserveModel->userPass($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }

    /**
     * 拒绝预约
     * @param $params
     */
    public function rejectUserData($params) {
        $this->reserveModel->userReject($params);
        // 接收数据层处理结果
        if (!is_null($this->reserveModel->getError())) {
            return $this->setError($this->reserveModel->getError());
        }
        $this->setResult($this->reserveModel->_data);
    }
}