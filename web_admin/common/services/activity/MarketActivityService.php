<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 10:50
 */

namespace common\services\activity;

use common\models\Activity;
use common\models\MarketActivity;
use common\models\Member;
use common\models\SecondKill;
use common\services\BaseService;
use common\services\member\MemberService;

class MarketActivityService extends BaseService
{

    protected $marketActivityModel;

    //跳转链接，活动在不同的状态时，需要跳转到不同的url

    public function init()
    {
        $this->marketActivityModel = new MarketActivity();
    }

    /**
     * 创建抽奖活动
     * @param $params
     */
    public function create($params)
    {
        //创建活动*/
        $this->marketActivityModel->create($params);
        // 接收数据层处理结果
        if (!is_null($this->marketActivityModel->getError())) {
            return $this->setError($this->marketActivityModel->getError());
        }
        $this->setResult($this->marketActivityModel->_data);
    }

    /**
     * 更新抽奖活动
     * @param $params
     */
    public function update($params)
    {
        //创建活动*/
        $this->marketActivityModel->update($params);
        // 接收数据层处理结果
        if (!is_null($this->marketActivityModel->getError())) {
            return $this->setError($this->marketActivityModel->getError());
        }
        $this->setResult($this->marketActivityModel->_data);
    }

    /**
     * 获取活动详情
     * @param $params
     */
    public function get($params)
    {
        $this->marketActivityModel->get($params);
        // 接收数据层处理结果
        if (!is_null($this->marketActivityModel->getError())) {
            return $this->setError($this->marketActivityModel->getError());
        }
        $this->setResult($this->marketActivityModel->_data);
    }

    /**
     * 参加抽奖
     * @param $params
     */
    public function joinActivity($params)
    {
        $this->marketActivityModel->joinActivity($params);
        // 接收数据层处理结果
        if (!is_null($this->marketActivityModel->getError())) {
            return $this->setError($this->marketActivityModel->getError());
        }
        $this->setResult($this->marketActivityModel->_data);
    }

    /**
     * 获取活动列表
     * @param $params
     */
    public function find($params)
    {
        $this->marketActivityModel->find($params);
        // 接收数据层处理结果
        if (!is_null($this->marketActivityModel->getError())) {
            return $this->setError($this->marketActivityModel->getError());
        }
        $this->setResult($this->marketActivityModel->_data);
    }

    /**
     * 请求抽奖
     * @param $params
     */
    public function getPrize($params)
    {
        $this->marketActivityModel->getPrize($params);
        // 接收数据层处理结果
        if (!is_null($this->marketActivityModel->getError())) {
            return $this->setError($this->marketActivityModel->getError());
        }
        $this->setResult($this->marketActivityModel->_data);
    }

    /**
     * 填写兑奖地址
     * @param $params
     */
    public function updateRecord($params)
    {
        $this->marketActivityModel->updateRecord($params);
        // 接收数据层处理结果
        if (!is_null($this->marketActivityModel->getError())) {
            return $this->setError($this->marketActivityModel->getError());
        }
        $this->setResult($this->marketActivityModel->_data);
    }

    /**
     * 关闭活动
     * @param $params
     */
    public function close($params)
    {
        $this->marketActivityModel->close($params);
        // 接收数据层处理结果
        if (!is_null($this->marketActivityModel->getError())) {
            return $this->setError($this->marketActivityModel->getError());
        }
        $this->setResult($this->marketActivityModel->_data);
    }

    /**
     * 开启活动
     * @param $params
     */
    public function open($params)
    {
        $this->marketActivityModel->open($params);
        // 接收数据层处理结果
        if (!is_null($this->marketActivityModel->getError())) {
            return $this->setError($this->marketActivityModel->getError());
        }
        $this->setResult($this->marketActivityModel->_data);
    }

    /**
     * 删除
     * @param $params
     */
    public function delete($params)
    {
        $this->marketActivityModel->delete($params);
        // 接收数据层处理结果
        if (!is_null($this->marketActivityModel->getError())) {
            return $this->setError($this->marketActivityModel->getError());
        }
        $this->setResult($this->marketActivityModel->_data);
    }

    /**
     * 获取中奖记录列表
     * @param $params
     */
    public function findRecord($params)
    {
        $this->marketActivityModel->findRecord($params);
        // 接收数据层处理结果
        if (!is_null($this->marketActivityModel->getError())) {
            return $this->setError($this->marketActivityModel->getError());
        }
        $this->setResult($this->marketActivityModel->_data);
    }

    /**
     * 获取中奖记录详情
     * @param $params
     */
    public function getRecord($params)
    {
        $this->marketActivityModel->getRecord($params);
        // 接收数据层处理结果
        if (!is_null($this->marketActivityModel->getError())) {
            return $this->setError($this->marketActivityModel->getError());
        }
        $this->setResult($this->marketActivityModel->_data);
    }

    /**
     * 兑换中奖
     * @param $params
     */
    public function exchangeRecord($params)
    {
        $this->marketActivityModel->exchangeRecord($params);
        // 接收数据层处理结果
        if (!is_null($this->marketActivityModel->getError())) {
            return $this->setError($this->marketActivityModel->getError());
        }
        $this->setResult($this->marketActivityModel->_data);
    }

    /**
     * 获取用户剩余中奖次数
     * @param $params
     */
    public function getChanceCount($params)
    {
        $this->marketActivityModel->getChanceCount($params);
        // 接收数据层处理结果
        if (!is_null($this->marketActivityModel->getError())) {
            return $this->setError($this->marketActivityModel->getError());
        }
        $this->setResult($this->marketActivityModel->_data);
    }

    /**
     * 积分兑换中奖次数
     * @param $params
     */
    public function addPointChance($params)
    {
        $this->marketActivityModel->addPointChance($params);
        // 接收数据层处理结果
        if (!is_null($this->marketActivityModel->getError())) {
            return $this->setError($this->marketActivityModel->getError());
        }
        $this->setResult($this->marketActivityModel->_data);
    }

    /**
     * 获取用户抽奖次数信息
     * @param $params
     */
    public function getMarketingChance($params)
    {
        $this->marketActivityModel->getMarketingChance($params);
        // 接收数据层处理结果
        if (!is_null($this->marketActivityModel->getError())) {
            return $this->setError($this->marketActivityModel->getError());
        }
        $this->setResult($this->marketActivityModel->_data);
    }
}