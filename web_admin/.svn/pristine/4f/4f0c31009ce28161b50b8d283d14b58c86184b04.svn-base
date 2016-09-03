<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 10:50
 */

namespace common\services\activity;

use common\models\Collect;
use common\services\BaseService;

class CollectService extends BaseService
{

    protected $collectModel;
    protected $activityService;

    public function init()
    {
        $this->collectModel = new Collect();
        $this->activityService = new ActivityService();
    }

    /**
     * 创建活动 众筹公用方法
     * @param $params
     */
    public function create($params, $type)
    {
        $default = $this->collectModel->setDefaultValue($type);
        $params = array_merge_recursive($default, $params);
        $this->collectModel->create($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 更新活动 众筹公用方法
     * @param $params
     */
    public function update($params)
    {
        $this->collectModel->update($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 详情 众筹公用方法
     * @param $params
     */
    public function get($params)
    {

        $this->collectModel->get($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        //处理数据 将从接口获取的数据 组合成 ['collect' => [],  'news' => [], 'shareMessage' => []]的格式
        if (!empty($this->collectModel->_data)) {
            $this->collectModel->_data = $this->activityService->formatData($this->collectModel->_data, '', 'collect');
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 获取活动列表 众筹公用方法
     * @param $params
     */
    public function find($params)
    {
        if (empty($params['type'])) {
            $params['type'] = [Collect::COLLECT_ZAN, Collect::COLLECT_RECEIVE, Collect::COLLECT_REDPACKET];
        }
        $this->collectModel->find($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }


    /**
     * 创建众筹代领商品
     * @param $params
     */
    public function createCollectProduct($params)
    {
        $this->collectModel->createCollectProduct($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 创建自定义商品
     * @param $params
     */
    public function createCustomGift($params)
    {
        $this->collectModel->createCustomGift($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 获取商品
     * @param $params
     */
    public function findCollectProduct($params)
    {
        $this->collectModel->findCollectProduct($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 获取自定义商品
     * @param $params
     */
    public function findCustomGift($params)
    {
        $this->collectModel->findCustomGift($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }


    /**
     * 修改众筹代领商品
     * @param $params
     */
    public function updateCollectProduct($params)
    {
        $this->collectModel->updateCollectProduct($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 修改自定义众筹代领商品
     * @param $params
     */
    public function updateCustomGift($params)
    {
        $this->collectModel->updateCustomGift($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 删除众筹代领商品
     * @param $params
     */
    public function delCollectProduct($params)
    {
        $this->collectModel->delCollectProduct($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 删除自定义众筹代领商品
     * @param $params
     */
    public function delCustomGift($params)
    {
        $this->collectModel->delCustomGift($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 获取众筹下的参与名单
     * @param $params
     */
    public function findJoinUser($params)
    {
        $this->collectModel->findJoinUser($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 获取某join id下的帮助名单
     * @param $params
     */
    public function getCollectJoinWithClick($params)
    {
        $this->collectModel->getCollectJoinWithClick($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 获取众筹下的参与名单
     * @param $params
     */
    public function getJoin($params)
    {
        $this->collectModel->getJoin($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 获取代领商品详情
     * @param $params
     */
    public function getReceiveProduct($params)
    {
        $this->collectModel->getReceiveProduct($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 创建众筹参与数据 众筹公用方法
     * @param $params
     * @param $type 众筹类型
     */
    public function createReceiveJoin($params, $type)
    {
        //检查奖品id
        $this->_checkJoinParams($params, $type);
        $this->collectModel->createCollectJoin($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 添加众筹参与数据时  检查奖品
     * @param $params
     * @param $type
     */
    private function _checkJoinParams($params, $type)
    {
        switch ($type) {
            case Collect::COLLECT_RECEIVE:
                //判断是否设置产品id
                if (!isset($params['collect_product_id']) || empty($params['collect_product_id'])) {
                    return $this->setError($this->collectModel->getError());
                }
                break;
            case Collect::COLLECT_ZAN:
                //判断产品id 获取自定义商品id是否存在其中之一
                if (!isset($params['collect_product_id']) || !isset($params['collect_custom_gift_id']) ||
                    empty($params['collect_product_id']) || empty($params['collect_custom_gift_id'])
                ) {
                    return $this->setError($this->collectModel->getError());
                }
                break;
            default :
                break;
        }
    }

    /**
     * 新增join记录
     * 参数[uid,shop_id,shop_sub_id,collect_id]
     * @param $params
     */
    public function createCollectJoin($params)
    {
        $this->collectModel->createCollectJoin($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 修改join记录
     * 参数[uid,shop_id,shop_sub_id,collect_id]
     * @param $params
     */
    public function updateCollectJoin($params)
    {
        $this->collectModel->updateCollectJoin($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 手动兑换
     * @param $params
     */
    public function exchangeJoin($params)
    {
        $this->collectModel->exchangeJoin($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 创建click记录
     * 参数[uid,shop_id,shop_sub_id,collect_id,collect_join_id]
     * @param $params
     */
    public function createCollectClick($params)
    {
        $this->collectModel->createCollectClick($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 开启活动 众筹公用方法
     * @param $params
     */
    public function open($params)
    {
        $this->collectModel->open($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 关闭活动 众筹公用方法
     * @param $params
     */
    public function close($params)
    {
        $this->collectModel->close($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    /**
     * 删除活动 众筹公用方法
     * @param $params
     */
    public function delete($params)
    {
        $this->collectModel->delete($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    //TODO 获取商品信息
    public function getProduct($params)
    {
        $this->collectModel->getProduct($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }

    //获取用户帮点列表
    public function findClickUser($params)
    {
        $this->collectModel->findClickUser($params);
        // 接收数据层处理结果
        if (!is_null($this->collectModel->getError())) {
            return $this->setError($this->collectModel->getError());
        }
        $this->setResult($this->collectModel->_data);
    }
}