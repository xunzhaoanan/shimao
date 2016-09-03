<?php
/**
 * Author: LiuPing
 * Date: 2016/03/02
 * Time: 18:20
 */

namespace common\services\activity;

use common\models\Activity;
use common\models\TogetherBuy;
use common\services\BaseService;

class TogetherBuyService extends BaseService
{

    protected $togetherBuyModel;
    protected $activityService;

    public function init() {
        $this->togetherBuyModel = new TogetherBuy();
        $this->activityService = new ActivityService();
    }

    /**
     * 获取活动列表 处理成商品列表
     * @param $params
     */
    public function togetherBuyFind($params) {
        $this->togetherBuyModel->togetherBuyFind($params);
        // 接收数据层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $togetherBuyGoodsList = [];
        foreach($this->togetherBuyModel->_data['data'] as $key => $val){
            if(isset($val['togetherBuy']['togetherBuyGoods']) && $val['togetherBuy']['togetherBuyGoods']){
                $togetherBuyGoods = $val['togetherBuy']['togetherBuyGoods'][0];
                unset($val['togetherBuy']['togetherBuyGoods']);
                $togetherBuyGoodsList[] = array_merge($togetherBuyGoods, ['activity' => $val]);
            }
        }
        $this->togetherBuyModel->_data['data'] = $togetherBuyGoodsList;
        $this->setResult($this->togetherBuyModel->_data);
    }

    /**
     * 创建拼团活动
     * @param $params
     */
    public function togetherBuyCreate($params) {
        //调用统一接口 创建空活动
        $this->activityService->createBlank($params, Activity::TOGETHERBUY);
        // 接收数据层处理结果
        if (!is_null($this->activityService->getError())) {
            return $this->setError($this->activityService->getError());
        }
        $this->setResult($this->activityService->_data);
    }

    /**
     * 活动详情
     * 处理后数据格式 ['activity' => [], 'togetherBuy' => [], 'news' => [], 'postageSetting' => [], 'shareMessage' => []]
     * @param $params
     */
    public function togetherBuyGet($params) {
        $this->togetherBuyModel->togetherBuyGet($params);
        // 接收数据层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        //处理数据 将从接口获取的数据 组合成 ['activity' => [], 'togetherBuy' => [], 'news' => [], 'postageSetting' => [], 'shareMessage' => []]的格式
        if (!empty($this->togetherBuyModel->_data)) {
            $this->togetherBuyModel->_data = $this->activityService->formatData($this->togetherBuyModel->_data, 'togetherBuy');
        }
        $this->setResult($this->togetherBuyModel->_data);
    }

    /**
     * 修改团购活动
     * @param $params
     */
    public function togetherBuyUpdate($params) {
        //验证数据参数
        if (!$this->checkParams($params)) {
            return false;
        }
        //更新数据
        if(empty($params['togetherBuy']['description'])){ //重置商品描述为空标识
            $params['togetherBuy']['no_description'] = true;
        }
        $auth_icons = '';
        if(!empty($params['togetherBuy']['auth_icons'])){ //认证标识
            foreach(TogetherBuy::$authIcon as $val){
                if(in_array($val, $params['togetherBuy']['auth_icons'])){
                    $auth_icons .= $val. '|';
                }
            }
            $params['togetherBuy']['auth_icons'] = trim($auth_icons, '|');
        } else {
            $params['togetherBuy']['no_auth_icons'] = true; //重置认证标识
        }
        $this->togetherBuyModel->togetherBuyUpdate($params);
        // 接收数据层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $this->setResult($this->togetherBuyModel->_data);
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
        }
        //判断参数
        if (!isset($params['activity']['id']) || empty($params['togetherBuy']['id']) || !isset($params['activity']['id']) || empty($params['togetherBuy']['id'])) {
            $this->setError('数据有误');
            return false;
        }
        return true;
    }

    /**
     * 创建团购商品
     * @param $params
     */
    public function togetherBuyGoodsCreate($params) {
        $this->checkParam($params);
        $this->togetherBuyModel->seckillGoodsCreate($params);
        // 接收数据层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $this->setResult($this->togetherBuyModel->_data);
    }

    /**
     * 拼团详情
     * @param $params
     */
    public function togetherBuyQueueGet($params){
        $this->togetherBuyModel->togetherBuyQueueGet($params);
        // 接收数据层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $this->setResult($this->togetherBuyModel->_data);
    }

    /**
     * 检查商品添加时参数
     * @param $params
     */
    public function checkParam($params) {
        if (!isset($params['buy_price']) || empty($params['buy_price']) || !is_numeric($params['buy_price'])) {
            return $this->setError('请设置团购价');
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
     * 查找活动下所有管理商品 返回活动信息和商品信息
     * @param $params
     */
    public function getTogetherBuyWithGoods($params) {
        $this->togetherBuyModel->getTogetherBuyWithGoods($params);
        // 接收数据层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $this->setResult($this->togetherBuyModel->_data);
    }

    /**
     * 统计用户已购买该拼团商品数量
     * @param $params
     */
    public function countUserBuy($params) {
        $this->togetherBuyModel->countUserBuy($params);
        // 接收数据层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $this->setResult($this->togetherBuyModel->_data);
    }

    /**
     * 获取拼团列表
     * @param $params
     */
    public function togetherBuyQueueFind($params){
        $params['status'] = isset($params['_status']) ? $params['_status'] : null;
        //如果是商家关闭的状态
        if(isset($params['_status']) && $params['_status'] == TogetherBuy::QUEUE_STATUS_IS_HELP){
            $params['status'] = TogetherBuy::QUEUE_STATUS_FINISH;
            $params['is_help'] = TogetherBuy::IS_HELP_YES;
        }
        $this->togetherBuyModel->togetherBuyQueueFind($params);
        // 接收数据层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        $this->setResult($this->togetherBuyModel->_data);
    }

    /**
     * 参团成员
     * @param $params
     */
    public function togetherBuyJoinByQueue($params){
        $this->togetherBuyModel->togetherBuyJoinByQueue($params);
        // 接收数据层处理结果
        if (!is_null($this->togetherBuyModel->getError())) {
            return $this->setError($this->togetherBuyModel->getError());
        }
        if(isset($this->togetherBuyModel->_data['data']) && $this->togetherBuyModel->_data['data']){
            foreach($this->togetherBuyModel->_data['data'] as $key => $val){
                if($val['uid'] == 0){
                    $this->togetherBuyModel->_data['data'][$key]['userInfo'] = ['headimgurl' => $val['headimgurl'], 'nickname' => $val['nickname']];
                }
            }
        }
        $this->setResult($this->togetherBuyModel->_data);
    }
}