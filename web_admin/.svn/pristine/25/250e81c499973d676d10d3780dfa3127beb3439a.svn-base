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

use common\cache\BaseCache;
use common\models\Member;
use common\models\WxMessage;
use common\services\BaseService;
use common\services\wechat\WechatPushService;

class WxMessageService extends BaseService
{

    protected $wxMessageModel ;

    public function init()
    {
        $this->wxMessageModel = new WxMessage();
    }

    /**
     * 创建用户微信消息
     * @return mixed
     */
    public function create($params)
    {
        $this->wxMessageModel->create($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxMessageModel->getError())){
            return $this->setError($this->wxMessageModel->getError());
        }
        $this->setResult($this->wxMessageModel->_data);
    }

    /**
     * 获取消息列表
     * @return mixed
     */
    public function find($params)
    {
        if(isset($params['type'])){
            switch($params['type']){
                //收藏的消息列表
                case 1 :
                    $params['mark'] = WxMessage::MESSAGE_LIKE;
                    break;
            }
        }
        $this->wxMessageModel->find($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxMessageModel->getError())){
            return $this->setError($this->wxMessageModel->getError());
        }
        $result = $this->wxMessageModel->_data;
        // 超过48小时的消息不能回复
        $time = time();
        foreach($result['data'] as $key=>$val){
            if($time - $val['created'] > 48*3600){
                $result['data'][$key]['can_reply'] = WxMessage::UN_REPLY;
            }else{
                $result['data'][$key]['can_reply'] = WxMessage::IS_REPLY;
            }
        }
//        //如果是查看对话模式，按照时间排序消息
//        if(isset($params['user_id'])){
//            $count = count($result['data']);
//            $newData = [];
//            for($i=$count-1;$i>=0;$i--){
//                $newData[] = $result['data'][$i];
//            }
//            $result['data'] = $newData;
//        }
        $this->setResult($result);
    }

    /**
     * 收藏消息
     * @return mixed
     */
    public function likeMessage($params)
    {
        $this->wxMessageModel->likeMessage($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxMessageModel->getError())){
            return $this->setError($this->wxMessageModel->getError());
        }
        $this->setResult($this->wxMessageModel->_data);
    }

    /**
     * 回复消息
     * @return mixed
     */
    public function replyMessage($params,$wxInfo)
    {
        //消息入库
        $this->wxMessageModel->create($params);
        if ( ! is_null($this->wxMessageModel->getError())){
            return $this->setError($this->wxMessageModel->getError());
        }
        $this->setResult($this->wxMessageModel->_data);
        //推送给微信
        $memberModel = new Member();
        $memberModel->get($params);
        if ( ! is_null($memberModel->getError())){
            return false;
        }
        $member = $memberModel->_data;
        $pushService = new WechatPushService($wxInfo,['open_id' => $member['wxUsers']['open_id']]);
        $pushService->text($params['content']);
    }



}