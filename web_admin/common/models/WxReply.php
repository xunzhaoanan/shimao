<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/25
 * Time: 20:05
 */
namespace common\models;

use common\cache\WxReplyCache;
use Yii;

/**
 * WxReplyDefault model
 */
class WxReply extends BaseModel
{

    //完全匹配
    const MATCH_ALL  = 1;
    //包含匹配
    const MATCH_INCLUDE = 2;

    //普通关键字
    const TYPE_USER = 1;
    //系统关键字
    const TYPE_SYSTEM  = 2;

    protected $wxReplyCache ;

    public function init()
    {
        $this->wxReplyCache = new WxReplyCache();
    }

    /**
     * 获取默认回复详情
     * @return mixed
     */
    public function getDefault($params){
        // 拿缓存数据
        $data = $this->wxReplyCache->getDefault($params);
        if($data !== false){
            return $this->setResult($data);
        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('wx-reply-default-get',$apiParams);
        if ( is_null($this->getError())){
            $this->wxReplyCache->setDefault($params,$this->_data);
        }
    }

    /**
     * 创建默认回复
     * @return mixed
     */
    public function createDefault($params){
        $this->wxReplyCache->delDefault($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'reply_ids' => isset($params['reply_ids']) ? $params['reply_ids'] : null,
        ];
        $this->getResult('wx-reply-default-create',$apiParams);
    }

    /**
     * 修改默认回复
     * @return mixed
     */
    public function updateDefault($params){
        $this->wxReplyCache->delDefault($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'default_id' => isset($params['default_id']) ? $params['default_id'] : null,
            'reply_ids' => isset($params['reply_ids']) ? $params['reply_ids'] : null,
        ];
        $this->getResult('wx-reply-default-update',$apiParams);
    }

    /**
     * 开启默认回复
     * @return mixed
     */
    public function openDefault($params){
        $this->wxReplyCache->delDefault($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'default_id' => isset($params['default_id']) ? $params['default_id'] : null
        ];
        $this->getResult('wx-reply-default-open',$apiParams);
    }

    /**
     * 关闭默认回复
     * @return mixed
     */
    public function closeDefault($params){
        $this->wxReplyCache->delDefault($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'default_id' => isset($params['default_id']) ? $params['default_id'] : null
        ];
        $this->getResult('wx-reply-default-close',$apiParams);
    }

    /**
     * 获取关注回复详情
     * @return mixed
     */
    public function getAttention($params){
        // 拿缓存数据
        $data = $this->wxReplyCache->getAttention($params);
        if($data !== false){
            return $this->setResult($data);
        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('wx-reply-attention-get',$apiParams);
        if ( is_null($this->getError())){
            $this->wxReplyCache->setAttention($params,$this->_data);
        }
    }

    /**
     * 创建关注回复
     * @return mixed
     */
    public function createAttention($params){
        $this->wxReplyCache->delAttention($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'reply_ids' => isset($params['reply_ids']) ? $params['reply_ids'] : null,
        ];
        $this->getResult('wx-reply-attention-create',$apiParams);
    }

    /**
     * 修改关注回复
     * @return mixed
     */
    public function updateAttention($params){
        $this->wxReplyCache->delAttention($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'attention_id' => isset($params['attention_id']) ? $params['attention_id'] : null,
            'reply_ids' => isset($params['reply_ids']) ? $params['reply_ids'] : null,
        ];
        $this->getResult('wx-reply-attention-update',$apiParams);
    }

    /**
     * 开启关注回复
     * @return mixed
     */
    public function openAttention($params){
        $this->wxReplyCache->delAttention($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'attention_id' => isset($params['attention_id']) ? $params['attention_id'] : null,
        ];
        $this->getResult('wx-reply-attention-open',$apiParams);
    }

    /**
     * 关闭关注回复
     * @return mixed
     */
    public function closeeAttention($params){
        $this->wxReplyCache->delAttention($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'attention_id' => isset($params['attention_id']) ? $params['attention_id'] : null,
        ];
        $this->getResult('wx-reply-attention-close',$apiParams);
    }

    /**
     * 获取关键字回复列表
     * @return mixed
     */
    public function findKeyword($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            // 数据太多会很卡
            'count' => 5,
            'keyword' => isset($params['keyword']) ? $params['keyword'] : null,
            'match_type' => isset($params['match_type']) ? $params['match_type'] : null,
            'run_type' => isset($params['run_type']) ? $params['run_type'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'search_type' => isset($params['search_type']) ? $params['search_type'] : null,
        ];
        $this->getResult('wx-reply-keyword-list',$apiParams);
    }

    /**
     * 搜索是否有匹配的关键字，这个只提供微信用户发的消息关键字匹配
     * @return mixed
     */
    public function searchKeyword($params){
        $data = $this->wxReplyCache->getSearch($params);
        if($data !== false){
            return $this->setResult($data);
        }
        //由于缓存列表更新机制，只拿一条，只设置缓存第一条，不然必定出错
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'keyword' => isset($params['keyword']) ? $params['keyword'] : null,
            'match_type' => isset($params['match_type']) ? $params['match_type'] : null,
            'page' => 0 ,
            'count' => 1,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
        ];
        $this->getResult('wx-reply-keyword-list',$apiParams);
        $this->setResult($this->_data['data']);
        //再从新设置缓存
        if ( is_null($this->getError())){
            $this->wxReplyCache->setSearch($params,$this->_data);
        }
    }

    /**
     * 获取关键字回复详情
     * @return mixed
     */
    public function getKeyword($params){
        // 拿缓存数据
        $data = $this->wxReplyCache->getKeyword($params);
        if($data !== false){
            return $this->setResult($data);
        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'keyword_id' => isset($params['keyword_id']) ? $params['keyword_id'] : null
        ];
        $this->getResult('wx-reply-keyword-get',$apiParams);
        //再从新设置缓存
        if ( is_null($this->getError())){
            $this->wxReplyCache->setKeyword($params,$this->_data);
        }
    }

    /**
     * 创建关键字回复
     * @return mixed
     */
    public function createKeyword($params){
        //清除这个关键字搜索的缓存
        $this->wxReplyCache->delSearch($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'keyword' => isset($params['keyword']) ? $params['keyword'] : null,
            'match_type' => isset($params['match_type']) ? $params['match_type'] : null,
            'reply_ids' => isset($params['reply_ids']) ? $params['reply_ids'] : null,
        ];
        $this->getResult('wx-reply-keyword-create',$apiParams);
    }


    /**
     * 修改关键字回复
     * @return mixed
     */
    public function updateKeyword($params){
        // 2、清除这个关键字的搜索缓存
        $this->_clearKeywordCache($params);
        // 2、清除这个关键字修改后的搜索缓存
        $this->wxReplyCache->delSearch($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'keyword_id' => isset($params['keyword_id']) ? $params['keyword_id'] : null,
            'keyword' => isset($params['keyword']) ? $params['keyword'] : null,
            'match_type' => isset($params['match_type']) ? $params['match_type'] : null,
            'reply_ids' => isset($params['reply_ids']) ? $params['reply_ids'] : null,
        ];
        $this->getResult('wx-reply-keyword-update',$apiParams);
    }

    /**
     * 删除关键字回复
     * @return mixed
     */
    public function deleteKeyword($params){
        $this->_clearKeywordCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'keyword_id' => isset($params['keyword_id']) ? $params['keyword_id'] : null
        ];
        $this->getResult('wx-reply-keyword-del',$apiParams);
    }

    /**
     * 开启关键字回复
     * @return mixed
     */
    public function openKeyword($params){
        $this->_clearKeywordCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'keyword_id' => isset($params['keyword_id']) ? $params['keyword_id'] : null
        ];
        $this->getResult('wx-reply-keyword-open',$apiParams);
    }

    /**
     * 关闭关键字回复
     * @return mixed
     */
    public function closeKeyword($params){
        $this->_clearKeywordCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'keyword_id' => isset($params['keyword_id']) ? $params['keyword_id'] : null
        ];
        $this->getResult('wx-reply-keyword-close',$apiParams);
    }

    /**
     * 清除某个关键字的缓存
     */
    private function _clearKeywordCache($params){
        // 1、清除这个关键字的搜索缓存
        $this->getKeyword($params);
        if( ! is_null($this->getError())){
            return false;
        }
        $beforeParams = [
            'shop_id' => $this->_data['shop_id'],
            'keyword' => $this->_data['keyword'],
            'match_type' => $this->_data['match_type'],
        ];
        $this->wxReplyCache->delSearch($beforeParams);
        // 2、清除这个关键字的缓存
        $this->wxReplyCache->delKeyword($params);
    }





}
