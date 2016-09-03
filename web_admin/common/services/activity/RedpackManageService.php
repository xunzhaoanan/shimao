<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 10:50
 * 红包管理
 */

namespace common\services\activity;

use common\models\RedpackManage;
use common\services\BaseService;

class RedpackManageService extends BaseService
{

    protected $redpackManageModel;

    public function init()
    {
        $this->redpackManageModel = new RedpackManage();
    }

    /**
     * 获取列表
     * @param $params
     */
    public function find($params)
    {
        $this->redpackManageModel->find($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackManageModel->getError())) {
            return $this->setError($this->redpackManageModel->getError());
        }
        $this->setResult($this->redpackManageModel->_data);
    }

    /**
     * 创建
     * @param $params
     */
    public function create($params)
    {
        //验证数据参数
        $this->checkParams($params);
        $this->redpackManageModel->create($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackManageModel->getError())) {
            return $this->setError($this->redpackManageModel->getError());
        }
        $this->setResult($this->redpackManageModel->_data);
    }

    /**
     * 活动详情页
     * @param $params
     */
    public function get($params)
    {
        $this->redpackManageModel->get($params);

        // 接收数据层处理结果
        if (!is_null($this->redpackManageModel->getError())) {
            return $this->setError($this->redpackManageModel->getError());
        }
        $this->setResult($this->redpackManageModel->_data);
    }

    /**
     * 修改
     * @param $params
     */
    public function update($params)
    {
        //验证数据参数
        $this->checkParams($params);
        $this->redpackManageModel->update($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackManageModel->getError())) {
            return $this->setError($this->redpackManageModel->getError());
        }
        $this->setResult($this->redpackManageModel->_data);
    }

    /**
     * 删除
     * @param $params
     */
    public function delete($params)
    {
        $this->redpackManageModel->del($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackManageModel->getError())) {
            return $this->setError($this->redpackManageModel->getError());
        }
        $this->setResult($this->redpackManageModel->_data);
    }


    /**
     * 活动参数校验
     * @param $params
     */
    protected function checkParams($params)
    {
        if (isset($params['start_time']) && isset($params['end_time']) && ($params['start_time']) >= ($params['end_time'])) {
            return $this->setError('有效开始时间要小于结束时间');
        }
    }


}