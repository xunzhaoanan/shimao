<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 * 商铺信息接口类
 * 1、店铺信息
 * 2、店铺日志
 * 3、分店列表
 */
namespace common\services\weixin;

use common\models\WxReply;
use common\services\BaseService;

class WxReplyService extends BaseService
{

    protected $wxReplyModel ;
    protected $wxMaterialService;

    public function init()
    {
        $this->wxReplyModel = new WxReply();
        $this->wxMaterialService = new WxMaterialService();
    }

    /**
     * 获取默认回复详情
     * @return mixed
     */
    public function getDefault($params)
    {
        $this->wxReplyModel->getDefault($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        // 有数据就格式化
        if(isset($this->wxReplyModel->_data['reply_ids']) && count($this->wxReplyModel->_data['reply_ids'])) {
            $result = $this->wxReplyModel->_data;
            $result['reply_ids'] = $this->wxMaterialService->getMaterialByIds($result['reply_ids'], $params['shop_id']);
            $this->setResult($result);
        }else{
            $this->setResult($this->wxReplyModel->_data);
        }
    }

    /**
     * 创建默认回复
     * @return mixed
     */
    public function createDefault($params)
    {
        // 检验并格式化ids
        $params['reply_ids'] = $this->wxMaterialService->setMaterialByIds($params['reply_ids']);
        if ($params['reply_ids'] === false) {
            return $this->setError('不支持的回复素材类型');
        }
        $this->wxReplyModel->createDefault($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        $this->setResult($this->wxReplyModel->_data);
    }

    /**
     * 修改默认回复
     * @return mixed
     */
    public function updateDefault($params)
    {
        // 检验并格式化ids
        $params['reply_ids'] = $this->wxMaterialService->setMaterialByIds($params['reply_ids']);
        if ($params['reply_ids'] === false) {
            return $this->setError('不支持的回复素材类型');
        }
        $this->wxReplyModel->updateDefault($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        $this->setResult($this->wxReplyModel->_data);
    }

    /**
     * 开启默认回复
     * @return mixed
     */
    public function openDefault($params)
    {
        $this->wxReplyModel->openDefault($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        $this->setResult($this->wxReplyModel->_data);
    }

    /**
     * 关闭默认回复
     * @return mixed
     */
    public function closeDefault($params)
    {
        $this->wxReplyModel->closeDefault($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        $this->setResult($this->wxReplyModel->_data);
    }

    /**
     * 获取关注回复详情
     * @return mixed
     */
    public function getAttention($params)
    {
        $this->wxReplyModel->getAttention($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        // 有数据就格式化
        if(isset($this->wxReplyModel->_data['reply_ids']) && count($this->wxReplyModel->_data['reply_ids'])) {
            $result = $this->wxReplyModel->_data;
            $result['reply_ids'] = $this->wxMaterialService->getMaterialByIds($result['reply_ids'], $params['shop_id']);
            $this->setResult($result);
        }else{
            $this->setResult([]);
        }
    }

    /**
     * 创建关注回复
     * @return mixed
     */
    public function createAttention($params)
    {
        // 检验并格式化ids
        $params['reply_ids'] = $this->wxMaterialService->setMaterialByIds($params['reply_ids']);
        if ($params['reply_ids'] === false) {
            return $this->setError('不支持的回复素材类型');
        }
        $this->wxReplyModel->createAttention($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        $this->setResult($this->wxReplyModel->_data);
    }

    /**
     * 修改关注回复
     * @return mixed
     */
    public function updateAttention($params)
    {
        // 检验并格式化ids
        $params['reply_ids'] = $this->wxMaterialService->setMaterialByIds($params['reply_ids']);
        if ($params['reply_ids'] === false) {
            return $this->setError('不支持的回复素材类型');
        }
        $this->wxReplyModel->updateAttention($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        $this->setResult($this->wxReplyModel->_data);
    }

    /**
     * 开启关注回复
     * @return mixed
     */
    public function openAttention($params)
    {
        $this->wxReplyModel->openAttention($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        $this->setResult($this->wxReplyModel->_data);
    }

    /**
     * 关闭关注回复
     * @return mixed
     */
    public function closeAttention($params)
    {
        $this->wxReplyModel->closeAttention($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        $this->setResult($this->wxReplyModel->_data);
    }

    /**
     * 获取关键字回复列表
     * @return mixed
     */
    public function findKeyword($params)
    {
        $this->wxReplyModel->findKeyword($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        $result = $this->wxReplyModel->_data;
        foreach($result['data'] as $key=>$val){
            $result['data'][$key]['reply_ids'] = $this->wxMaterialService->getMaterialByIds($result['data'][$key]['reply_ids'],$params['shop_id']);
        }
        $this->setResult($result);
    }

    /**
     * 获取关键字回复详情
     * @return mixed
     */
    public function getKeyword($params)
    {
        $this->wxReplyModel->getKeyword($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        // 有数据就格式化
        if(isset($this->wxReplyModel->_data['reply_ids']) && count($this->wxReplyModel->_data['reply_ids'])) {
            $result = $this->wxReplyModel->_data;
            $result['reply_ids'] = $this->wxMaterialService->getMaterialByIds($result['reply_ids'], $params['shop_id']);
            $this->setResult($result);
        }else{
            $this->setResult($this->wxReplyModel->_data);
        }
    }

    /**
     * 新增关键字回复
     * @return mixed
     */
    public function createKeyword($params)
    {
        // 检验并格式化ids
        $params['reply_ids'] = $this->wxMaterialService->setMaterialByIds($params['reply_ids']);
        if ($params['reply_ids'] === false) {
            return $this->setError('不支持的回复素材类型');
        }
        $this->wxReplyModel->createKeyword($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        $this->setResult($this->wxReplyModel->_data);
    }

    /**
     * 修改关键字回复
     * @return mixed
     */
    public function updateKeyword($params)
    {
        // 检验并格式化ids
        $params['reply_ids'] = $this->wxMaterialService->setMaterialByIds($params['reply_ids']);
        if ($params['reply_ids'] === false) {
            return $this->setError('不支持的回复素材类型');
        }
        $this->wxReplyModel->updateKeyword($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        $this->setResult($this->wxReplyModel->_data);
    }

    /**
     * 删除关键字回复
     * @return mixed
     */
    public function deleteKeyword($params)
    {
        $this->wxReplyModel->deleteKeyword($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        $this->setResult($this->wxReplyModel->_data);
    }

    /**
     * 开启关键字回复
     * @return mixed
     */
    public function openKeyword($params)
    {
        $this->wxReplyModel->openKeyword($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        $this->setResult($this->wxReplyModel->_data);
    }

    /**
     * 关闭关键字回复
     * @return mixed
     */
    public function closeKeyword($params)
    {
        $this->wxReplyModel->closeKeyword($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxReplyModel->getError())){
            return $this->setError($this->wxReplyModel->getError());
        }
        $this->setResult($this->wxReplyModel->_data);
    }




}