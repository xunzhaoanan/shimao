<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 10:50
 */

namespace common\services\activity;


use common\models\Activity;
use common\models\ActivityPoint;
use common\services\BaseService;

class ActivityPointService extends BaseService
{

    protected $pointModel;
    protected $activityService;

    public function init()
    {
        $this->pointModel = new ActivityPoint();
        $this->activityService = new ActivityService();
    }

    /**
     * 获取积分活动列表
     * @param $params
     */
    public function pointFind($params)
    {
        $this->pointModel->pointFind($params);
        // 接收数据层处理结果
        if (!is_null($this->pointModel->getError())) {
            return $this->setError($this->pointModel->getError());
        }
        $this->setResult($this->pointModel->_data);
    }

    /**
     * 创建积分活动
     * @param $params
     */
    public function pointCreate($params)
    {
        if (!isset($params['activity']) || empty($params['activity'])) {
            return $this->setError('数据有误');
        }
        //检查活动时间设置参数
        if (!$this->activityService->checkActivityTime($params['activity'])) {
            return $this->setError($this->activityService->getError()); //service层错误
        }
        //设置活动关联产品类型
        $this->activityService->setRelateProductType($params['activity'], Activity::POINT);
        //创建活动
        //暂无选择商品功能，设定关联商品为全部商品
        $params['activity']['relate_product_type'] = Activity::RELATE_PRODUCT_TYPE_ALL;
        $this->pointModel->pointCreate($params);
        // 接收数据层处理结果
        if (!is_null($this->pointModel->getError())) {
            return $this->setError($this->pointModel->getError());
        }
        $this->setResult($this->pointModel->_data);
    }

    /**
     * 活动详情页
     * @param $params
     */
    public function pointGet($params)
    {
        $this->pointModel->pointGet($params);
        // 接收数据层处理结果
        if (!is_null($this->pointModel->getError())) {
            return $this->setError($this->pointModel->getError());
        }
        //处理数据 将从接口获取的数据 组合成 ['activity' => [], 'pointsConsumption' => [], 'shareMessage' => []]的格式
        if (!empty($this->pointModel->_data)) {
            $this->pointModel->_data = $this->activityService->formatData($this->pointModel->_data, 'pointsConsumption');
        }
        $this->setResult($this->pointModel->_data);
    }

    /**
     * 修改积分活动
     * @param $params
     */
    public function pointUpdate($params)
    {
        $this->pointModel->pointUpdate($params);
        // 接收数据层处理结果
        if (!is_null($this->pointModel->getError())) {
            return $this->setError($this->pointModel->getError());
        }
        $this->setResult($this->pointModel->_data);
    }

    /**
     * 开启积分活动
     * @param $params
     */
    public function pointOpen($params)
    {
        $this->pointModel->pointOpen($params);
        // 接收数据层处理结果
        if (!is_null($this->pointModel->getError())) {
            return $this->setError($this->pointModel->getError());
        }
        $this->setResult($this->pointModel->_data);
    }

    /**
     * 关闭积分活动
     * @param $params
     */
    public function pointClose($params)
    {
        $this->pointModel->pointClose($params);
        // 接收数据层处理结果
        if (!is_null($this->pointModel->getError())) {
            return $this->setError($this->pointModel->getError());
        }
        $this->setResult($this->pointModel->_data);
    }

    /**
     * 关闭积分活动
     * @param $params
     */
    public function pointDel($params)
    {
        $this->pointModel->pointDel($params);
        // 接收数据层处理结果
        if (!is_null($this->pointModel->getError())) {
            return $this->setError($this->pointModel->getError());
        }
        $this->setResult($this->pointModel->_data);
    }

    /**
     * 创建积分商品
     * @param $params
     */
    public function pointGoodsCreate($params)
    {
        $this->pointModel->pointGoodsCreate($params);
        // 接收数据层处理结果
        if (!is_null($this->pointModel->getError())) {
            return $this->setError($this->pointModel->getError());
        }
        $this->setResult($this->pointModel->_data);
    }

    /**
     * 获取积分商品列表
     * @param $params
     */
    public function pointGoodsFind($params)
    {
        $this->pointModel->pointGoodsFind($params);
        // 接收数据层处理结果
        if (!is_null($this->pointModel->getError())) {
            return $this->setError($this->pointModel->getError());
        }
        $this->setResult($this->pointModel->_data);
    }

    /**
     * 去除积分商品
     * @param $params
     */
    public function pointGoodsDel($params)
    {
        $this->pointModel->pointGoodsDel($params);
        // 接收数据层处理结果
        if (!is_null($this->pointModel->getError())) {
            return $this->setError($this->pointModel->getError());
        }
        $this->setResult($this->pointModel->_data);
    }

}