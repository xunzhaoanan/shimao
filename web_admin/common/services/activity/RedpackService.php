<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 10:50
 */

namespace common\services\activity;

use common\models\Activity;
use common\models\Redpack;

class RedpackService extends ActivityService
{

    protected $redpackModel;

    public function init()
    {
        $this->redpackModel = new Redpack();
    }

    /**
     * 创建活动
     * @param $params
     */
    public function create($params)
    {
        $params['activity']['expire_type'] = Activity::VALIDITY_SCHEDULE_TIME;
        //检查更新数据
        if (!$this->checkParam($params)) {
            return false;
        }
        $this->redpackModel->create($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackModel->getError())) {
            return $this->setError($this->redpackModel->getError());
        }
        $this->setResult($this->redpackModel->_data);
    }

    /**
     * 检查用户是否可以领取接龙红包
     * 可以领取会返回 true
     * @param $params
     */
    public function checkTransmitReceive($params)
    {
        $this->redpackModel->getTransmitLog($params);
        if (!is_null($this->redpackModel->_data)) {
            return $this->redpackModel->_data;
        }
        return true;
    }
    /**
     * 检查是否可以拆开群红包
     * 可以领取会返回 true
     * @param $params
     */
    public function checkGroupReceive($params)
    {
        $this->redpackModel->findGroupLogList($params);
        if (!is_null($this->redpackModel->_data) && !empty($this->redpackModel->_data['data'])) {
            return $this->redpackModel->_data['data'][0];
        }
        return true;
    }

    /**
     * 更新数据
     * @param $params
     */
    public function update($params)
    {
        $params['activity']['expire_type'] = Activity::VALIDITY_SCHEDULE_TIME;
        if (!$this->checkParam($params)) {
            return false;
        }
        $this->redpackModel->update($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackModel->getError())) {
            return $this->setError($this->redpackModel->getError());
        }
        $this->setResult($this->redpackModel->_data);
    }

    /**
     * TODO 检测数据
     * @param $params
     */
    protected function checkParam($params)
    {
        if (!isset($params['activity']) || empty($params['activity'])) {
            return $this->setError('数据有误');
        }
        //验证时间
        if (!$this->checkActivityTime($params['activity'])) {
            return false;
        }
        return true;
    }

    /**
     * 获取详情
     * @param $params
     */
    public function get($params)
    {
        $this->redpackModel->get($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackModel->getError())) {
            return $this->setError($this->redpackModel->getError());
        }
        //处理数据 将从接口获取的数据 组合成 ['activity' => [], 'redPacketEvent' => [], 'news' => [], 'shareMessage' => []]的格式
        if (!empty($this->redpackModel->_data)) {
            $this->redpackModel->_data = $this->formatData($this->redpackModel->_data, 'redPacketEvent');
        }
        $this->setResult($this->redpackModel->_data);
    }

    /**
     * 获取活动列表
     * @param $params
     */
    public function find($params)
    {
        $this->redpackModel->find($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackModel->getError())) {
            return $this->setError($this->redpackModel->getError());
        }
        $this->setResult($this->redpackModel->_data);
    }

    /**
     * 开启活动
     * @param $params
     */
    public function open($params)
    {
        $this->redpackModel->onStatus($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackModel->getError())) {
            return $this->setError($this->redpackModel->getError());
        }
        $this->setResult($this->redpackModel->_data);
    }

    /**
     * 关闭活动
     * @param $params
     */
    public function close($params)
    {
        $this->redpackModel->offStatus($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackModel->getError())) {
            return $this->setError($this->redpackModel->getError());
        }
        $this->setResult($this->redpackModel->_data);
    }

    /**
     * 删除活动
     * @param $params
     */
    public function delete($params)
    {
        $this->redpackModel->delete($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackModel->getError())) {
            return $this->setError($this->redpackModel->getError());
        }
        $this->setResult($this->redpackModel->_data);
    }

    /**
     * 获取红包信息
     */
    public function getItem($params)
    {
        $this->redpackModel->getItem($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackModel->getError())) {
            return $this->setError($this->redpackModel->getError());
        }
        $this->setResult($this->redpackModel->_data);
    }

    /**
     * 瓜分群红包
     */
    public function getGroupItem($params)
    {
        $this->redpackModel->getGroupItem($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackModel->getError())) {
            return $this->setError($this->redpackModel->getError());
        }
        $this->setResult($this->redpackModel->_data);
    }

    /**
     * 获取活动对应被领取的红包列表
     */
    public function findItemList($params)
    {
        $this->redpackModel->findItemList($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackModel->getError())) {
            return $this->setError($this->redpackModel->getError());
        }
        $this->setResult($this->redpackModel->_data);
    }

    /**
     * 获取群红包的一条瓜分记录信息
     */
    public function getGroupLog($params)
    {
        $this->redpackModel->getGroupLog($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackModel->getError())) {
            return $this->setError($this->redpackModel->getError());
        }
        $this->setResult($this->redpackModel->_data);
    }

    /**
     * 查找群红包记录列表
     * @param $params
     */
    public function findGroupLogList($params)
    {
        $this->redpackModel->findGroupLogList($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackModel->getError())) {
            return $this->setError($this->redpackModel->getError());
        }
        $this->setResult($this->redpackModel->_data);
    }


    /**
     * 查找接龙红包记录列表
     * @param $params
     */
    public function findTransmitLogList($params)
    {
        $this->redpackModel->findTransmitLogList($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackModel->getError())) {
            return $this->setError($this->redpackModel->getError());
        }
        $this->setResult($this->redpackModel->_data);
    }

    /**
     * 猜接龙红包
     */
    public function guessTransmit($params)
    {
        $this->redpackModel->guessTransmit($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackModel->getError())) {
            return $this->setError($this->redpackModel->getError());
        }
        $data = $this->redpackModel->_data;
        $this->setResult($data);
    }


    /**
     * 获取接龙红包记录
     */
    public function getTransmitLog($params)
    {
        $this->redpackModel->getTransmitLog($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackModel->getError())) {
            return $this->setError($this->redpackModel->getError());
        }
        $data = $this->redpackModel->_data;
        //得到区间值
        if (empty($data['guess_amount'])) {
            $data['min'] = 1;
            $data['max'] = $data['bd_amount'];
        } else {
            if ($data['guess_amount'] > $data['bd_amount']) {
                $data['min'] = $data['bd_amount'];
                $data['max'] = $data['guess_amount'] - 1;
            } else {
                $data['min'] = $data['guess_amount'] + 1;
                $data['max'] = $data['bd_amount'];
            }
        }
        $this->setResult($data);
    }

    /**
     * 领取红包
     */
    public function receive($params)
    {
        $this->redpackModel->receive($params);
        // 接收数据层处理结果
        if (!is_null($this->redpackModel->getError())) {
            return $this->setError($this->redpackModel->getError());
        }
        $this->setResult($this->redpackModel->_data);
    }

    /**
     * 检查是否瓜分
     * @param $params
     */
    public function checkDivide($params)
    {

    }

    /**
     * 获取接龙瓜分的红包金额
     * @param $params
     */
    public function divide($params)
    {
        $divide_amount = '';
        if (is_array($params)) {
            $total_arr = array_shift($params);
            $total_amount = $total_arr['guess_amount'];
            $count = count($params);
            $total_amount;
            $divide_amount = intval($total_amount / $count);
        }
        return $divide_amount;
    }
}