<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/25
 * Time: 20:05
 */

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * WxMenu model
 */
class WxMessage extends BaseModel
{

    const TYPE_REALTIME = 1;
    const TYPE_ASK = 2;
    //是否收藏
    const MESSAGE_LIKE = 1;
    const MESSAGE_UNLIKE = 2;
    //是否回复
    const IS_REPLY = 1;
    const UN_REPLY = 2;

    /**
     * 创建微信消息
     * @return mixed
     */
    public function create($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'to_user_name' => isset($params['to_user_name']) ? $params['to_user_name'] : null,
            'content' => isset($params['content']) ? $params['content'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null,
            'is_reply' => isset($params['is_reply']) ? $params['is_reply'] : null
        ];
        $this->getResult('wx-user-message-create',$apiParams);
    }

    /**
     * 获取微信消息列表
     * @return mixed
     */
    public function find($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'content' => isset($params['content']) ? $params['content'] : null,
            'is_reply' => isset($params['is_reply']) ? $params['is_reply'] : null,
            'mark' => isset($params['mark']) ? $params['mark'] : null,
            'user_id' => isset($params['user_id']) ? $params['user_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('wx-user-message-list',$apiParams);
    }

    /**
     * 收藏消息
     * @return mixed
     */
    public function likeMessage($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'message_id' => isset($params['message_id']) ? $params['message_id'] : null,
            'mark' => isset($params['mark']) ? $params['mark'] : null
        ];
        $this->getResult('wx-user-message-like',$apiParams);
    }

}
