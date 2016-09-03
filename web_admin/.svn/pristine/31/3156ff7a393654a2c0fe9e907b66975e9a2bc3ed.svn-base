<?php
/**
 * Author: LiuPing
 * Date: 2015/07/2
 * Time: 15:50
 */

namespace common\services\activity;


use common\models\Activity;
use common\models\PointRedeem;
use common\services\BaseService;

class PointRedeemService extends BaseService
{

    protected $pointRedeemModel;
    protected $activityService;

    public function init()
    {
        $this->pointRedeemModel = new PointRedeem();
        $this->activityService = new ActivityService();
    }


    /**
     * 获取订单相关积分数据
     * @param $params
     */
    public function getOrderPoint($params)
    {
        //无效的返回数据
        $returnData = [
            'maxPrice' => 0,
            'discount' => 1,
            'isShow' => 1,
            'userPoint' => $params['userPoint'],
            'maxPoint' => 0
        ];
        $modelParams = [
            'deleted' => Activity::STATUS_OPEN,
            'shop_id' => $params['shop_id']
        ];
        $this->pointRedeemModel->find($modelParams);
        $modelData = $this->pointRedeemModel->_data;
        // 接收数据层处理结果
        if (!isset($modelData['data'][0])) {
            return $returnData;
        }
        $shopPoint = $modelData['data'][0];
        //是否有效
        if ($shopPoint['expire_type'] == PointRedeem::TYPE_LIMIT_TIME) {
            $time = time();
            if ($time < $shopPoint['start_time'] || $time > $shopPoint['end_time']) {
                return $returnData;
            }
        }
        //订单未达到订单限额
        if ($params['orderPrice'] < ($shopPoint['min_consumption'] / 100)) {
            $returnData['isShow'] = 2;
            return $returnData;
        }
        //设置积分抵扣为可显示状态
        $returnData['isShow'] = 3;

        //得到活动最高抵扣
        if ($shopPoint['type'] == PointRedeem::TYPE_DISCOUNT) {
            ////百分比
            $returnData['maxPrice'] = $params['orderPrice'] * $shopPoint['max_amount'] / 10000;
        } else {
            ////指定金额
            $returnData['maxPrice'] = $shopPoint['max_amount'] / 100;
        }
        //积分金额比例
        $returnData['discount'] = $shopPoint['unit_points'] / ($shopPoint['unit_amount'] / 100);
        //活动最高抵扣金额、最高可使用积分
        if ($params['userPoint'] / $returnData['discount'] < $returnData['maxPrice']) {
            $returnData['maxPrice'] = $params['userPoint'] / $returnData['discount'];
        }
        //比较活动最高抵扣金额、订单最高金额，得到较小值，获取用户订单最高抵扣金额
        $returnData['maxPrice'] = $returnData['maxPrice'] > $params['orderPrice'] ? $params['orderPrice'] : $returnData['maxPrice'];
        //得到订单最大可使用的积分数
        $returnData['maxPoint'] = $returnData['maxPrice'] * $returnData['discount'];
        // 积分数只能为整数，去掉小数，并重新计算最大积分对应的最大金额
        $returnData['maxPoint'] = floor($returnData['maxPoint']) ;
        $returnData['maxPrice'] = floor($returnData['maxPoint'] * 100 /  $returnData['discount']) / 100;
        //比较用户积分是否满足最大可使用积分数，不满足则取用户所有积分
        $returnData['maxPoint'] = $returnData['maxPoint'] > $params['userPoint'] ? $params['userPoint'] : $returnData['maxPoint'];
        return $returnData;
    }

    /**
     * 获取积分抵扣列表
     * @param $params
     */
    public function pointFind($params)
    {
        $this->pointRedeemModel->find($params);
        // 接收数据层处理结果
        if (!is_null($this->pointRedeemModel->getError())) {
            return $this->setError($this->pointRedeemModel->getError());
        }
        $this->setResult($this->pointRedeemModel->_data);
    }

    /**
     * 创建积分抵扣活动
     * @param $params
     */
    public function pointCreate($params)
    {
        //检查活动时间设置参数
        if (!$this->activityService->checkActivityTime($params)) {
            return $this->setError($this->activityService->getError());
        }
        //创建活动
        $this->pointRedeemModel->create($params);
        // 接收数据层处理结果
        if (!is_null($this->pointRedeemModel->getError())) {
            return $this->setError($this->pointRedeemModel->getError());

        }
        $this->setResult($this->pointRedeemModel->_data);
    }

    /**
     * 活动详情页
     * @param $params
     */
    public function pointGet($params)
    {
        $this->pointRedeemModel->get($params);
        // 接收数据层处理结果
        if (!is_null($this->pointRedeemModel->getError())) {
            return $this->setError($this->pointRedeemModel->getError());
        }
        $this->setResult($this->pointRedeemModel->_data);
    }

    /**
     * 修改积分抵扣活动
     * @param $params
     */
    public function pointUpdate($params)
    {
        $this->pointRedeemModel->update($params);
        // 接收数据层处理结果
        if (!is_null($this->pointRedeemModel->getError())) {
            return $this->setError($this->pointRedeemModel->getError());
        }
        $this->setResult($this->pointRedeemModel->_data);
    }

    /**
     * 开启积分抵扣活动
     * @param $params
     */
    public function pointOpen($params)
    {
        $this->pointRedeemModel->open($params);
        // 接收数据层处理结果
        if (!is_null($this->pointRedeemModel->getError())) {
            return $this->setError($this->pointRedeemModel->getError());
        }
        $this->setResult($this->pointRedeemModel->_data);
    }

    /**
     * 关闭积分抵扣活动
     * @param $params
     */
    public function pointClose($params)
    {
        $this->pointRedeemModel->close($params);
        // 接收数据层处理结果
        if (!is_null($this->pointRedeemModel->getError())) {
            return $this->setError($this->pointRedeemModel->getError());
        }
        $this->setResult($this->pointRedeemModel->_data);
    }

    /**
     * 关闭积分抵扣活动
     * @param $params
     */
    public function pointDel($params)
    {
        $this->pointRedeemModel->delete($params);
        // 接收数据层处理结果
        if (!is_null($this->pointRedeemModel->getError())) {
            return $this->setError($this->pointRedeemModel->getError());
        }
        $this->setResult($this->pointRedeemModel->_data);
    }
}