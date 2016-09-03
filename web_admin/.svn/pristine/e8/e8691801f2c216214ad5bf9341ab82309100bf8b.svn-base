<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 10:50
 */

namespace common\services\activity;

use common\models\Activity;
use common\models\SecondKill;
use common\services\BaseService;

class SecondKillService extends BaseService
{

    protected $secondKillModel;
    protected $activityService;

    public function init() {
        $this->secondKillModel = new SecondKill();
        $this->activityService = new ActivityService();
    }

    /**
     * 获取秒杀活动列表
     * @param $params
     */
    public function secondKillFind($params) {
        $this->secondKillModel->secondKillFind($params);
        // 接收数据层处理结果
        if (!is_null($this->secondKillModel->getError())) {
            return $this->setError($this->secondKillModel->getError());
        }
        $this->setResult($this->secondKillModel->_data);
    }

    /**
     * 创建秒杀活动
     * @param $params
     */
    public function secondKillCreate($params) {
        //调用统一接口 创建空活动
        $this->activityService->createBlank($params, Activity::SECONDKILL);
        // 接收数据层处理结果
        if (!is_null($this->activityService->getError())) {
            return $this->setError($this->activityService->getError());
        }
        $this->setResult($this->activityService->_data);
    }

    /**
     * 活动详情
     * 处理后数据格式 ['activity' => [], 'secondKill' => [], 'news' => [], 'postageSetting' => [], 'shareMessage' => []]
     * @param $params
     */
    public function secondKillGet($params) {
        $this->secondKillModel->secondKillGet($params);
        // 接收数据层处理结果
        if (!is_null($this->secondKillModel->getError())) {
            return $this->setError($this->secondKillModel->getError());
        }
        //处理数据 将从接口获取的数据 组合成 ['activity' => [], 'secondKill' => [], 'news' => [], 'postageSetting' => [], 'shareMessage' => []]的格式
        if (!empty($this->secondKillModel->_data)) {
            $this->secondKillModel->_data = $this->activityService->formatData($this->secondKillModel->_data, 'secondKill');
        }
        $this->setResult($this->secondKillModel->_data);
    }

    /**
     * 修改秒杀活动
     * @param $params
     */
    public function secondKillUpdate($params) {
        //验证数据参数
        if (!$this->checkParams($params)) {
            return false;
        }
        //更新数据
        $this->secondKillModel->secondKillUpdate($params);
        // 接收数据层处理结果
        if (!is_null($this->secondKillModel->getError())) {
            return $this->setError($this->secondKillModel->getError());
        }
        $this->setResult($this->secondKillModel->_data);
    }

    /**
     * 活动参数校验
     * @param $params
     */
    protected function checkParams($params) {
        if (!isset($params['activity']) || empty($params['activity'])) {
            return $this->setError('数据有误');
        }
        //判断活动时间设置
        if (!$this->activityService->checkActivityTime($params['activity'])) {
            $this->setError($this->activityService->getError());
            return false;
        } elseif ($params['activity']['end_time'] - $params['activity']['start_time'] > 4 * 24 * 3600) {
            //秒杀时间将不能超过4天
            return $this->setError('时间设置间隔不能超过4天');
        }
        //判断参数
        if (!isset($params['activity']['id']) || empty($params['secondKill']['id']) || !isset($params['activity']['id']) || empty($params['secondKill']['id'])) {
            $this->setError('数据有误');
            return false;
        }
        return true;
    }

    /**
     * 开启秒杀活动
     * @param $params
     */
    public function secondKillOpen($params) {
        $this->secondKillModel->secondKillOpen($params);
        // 接收数据层处理结果
        if (!is_null($this->secondKillModel->getError())) {
            return $this->setError($this->secondKillModel->getError());
        }
        $this->setResult($this->secondKillModel->_data);
    }

    /**
     * 关闭秒杀活动
     * @param $params
     */
    public function secondKillClose($params) {
        $this->secondKillModel->secondKillClose($params);
        // 接收数据层处理结果
        if (!is_null($this->secondKillModel->getError())) {
            return $this->setError($this->secondKillModel->getError());
        }
        $this->setResult($this->secondKillModel->_data);
    }

    /**
     * 删除秒杀活动
     * @param $params
     */
    public function secondKillDel($params) {
        $this->secondKillModel->secondKillDel($params);
        // 接收数据层处理结果
        if (!is_null($this->secondKillModel->getError())) {
            return $this->setError($this->secondKillModel->getError());
        }
        $this->setResult($this->secondKillModel->_data);
    }

    /**
     * 创建秒杀商品
     * @param $params
     */
    public function seckillGoodsCreate($params) {

        $this->secondKillModel->seckillGoodsCreate($params);
        // 接收数据层处理结果
        if (!is_null($this->secondKillModel->getError())) {
            return $this->setError($this->secondKillModel->getError());
        }
        $this->setResult($this->secondKillModel->_data);
    }

    /**
     * 检查秒杀商品添加时参数
     * @param $params
     */
    public function checkParam($params) {
        if (!isset($params['buy_price']) || empty($params['buy_price']) || !is_numeric($params['buy_price'])) {
            return $this->setError('请设置秒杀价');
        }

        if (!isset($params['quota']) || empty($params['quota']) || !is_numeric($params['quota'])) {
            return $this->setError('请设置配额');
        }

        if (isset($params['limit_buy']) && !is_numeric($params['limit_buy'])) {
            return $this->setError('请设置限购数量');
        }

        if (intval($params['quota']) < $params['limit_buy']) {
            return $this->setError('限购数量必须小于配额');
        }
    }

    /**
     * 获取秒杀商品列表
     * @param $params
     */
    public function seckillGoodsFind($params) {
        $this->secondKillModel->seckillGoodsFind($params);
        // 接收数据层处理结果
        if (!is_null($this->secondKillModel->getError())) {
            return $this->setError($this->secondKillModel->getError());
        }
        $this->setResult($this->secondKillModel->_data);
    }

    /**
     * 查找活动下所有管理商品 返回活动信息和商品信息
     * @param $params
     */
    public function getSecondKillWithGoods($params) {
        $this->secondKillModel->getSecondKillWithGoods($params);
        // 接收数据层处理结果
        if (!is_null($this->secondKillModel->getError())) {
            return $this->setError($this->secondKillModel->getError());
        }
        $this->setResult($this->secondKillModel->_data);
    }

    /**
     * 修改秒杀商品
     * @param $params
     */
    public function seckillGoodsUpdate($params) {
        $this->secondKillModel->seckillGoodsUpdate($params);
        // 接收数据层处理结果
        if (!is_null($this->secondKillModel->getError())) {
            return $this->setError($this->secondKillModel->getError());
        }
        $this->setResult($this->secondKillModel->_data);
    }

    /**
     * 获取秒杀商品详情
     * @param $params
     */
    public function seckillGoodsGet($params) {
        $this->secondKillModel->seckillGoodsGet($params);
        // 接收数据层处理结果
        if (!is_null($this->secondKillModel->getError())) {
            return $this->setError($this->secondKillModel->getError());
        }
        $this->setResult($this->secondKillModel->_data);
    }

    /**
     * 去除秒杀商品
     * @param $params
     */
    public function seckillGoodsDel($params) {
        $this->secondKillModel->seckillGoodsDel($params);
        // 接收数据层处理结果
        if (!is_null($this->secondKillModel->getError())) {
            return $this->setError($this->secondKillModel->getError());
        }
        $this->setResult($this->secondKillModel->_data);
    }

    /**
     * 统计用户已购买秒杀商品数量
     * @param $params
     */
    public function countUserBuy($params) {
        $this->secondKillModel->countUserBuy($params);
        // 接收数据层处理结果
        if (!is_null($this->secondKillModel->getError())) {
            return $this->setError($this->secondKillModel->getError());
        }
        $this->setResult($this->secondKillModel->_data);
    }
}