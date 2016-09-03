<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * WxMsgTpl model
 */
class WxMsgTpl extends BaseModel
{

    /**
     * 创建微信消息模板
     * @return mixed
     */
    public function create($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'template_id' => isset($params['template_id']) ? $params['template_id'] : null,
        ];
        $this->getResult('wx-msg-tpl-create', $apiParams);
    }

    /**
     * 更新对应模板内容
     * @return mixed
     */
    public function updateMsgTpl($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'template_id' => isset($params['template_id']) ? $params['template_id'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'mp_id' => isset($params['mp_id']) ? $params['mp_id'] : null,
            'header' => isset($params['header']) ? $params['header'] : null,
            'footer' => isset($params['footer']) ? $params['footer'] : null,
            'remark' => isset($params['remark']) ? $params['remark'] : null,
            'send_type' => isset($params['send_type']) ? $params['send_type'] : null,
        ];
        $this->getResult('wx-msg-tpl-update', $apiParams ,false);
    }

    /**
     * 获取微信模板详情
     * @return mixed
     */
    public function getMsgTplDetail($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('wx-msg-tpl-detail-get', $apiParams);
    }
    
    /**
     * 获取微信模板详情
     * @return mixed
     */
    public function getMsgDetail($params)
    {
        //拿接口数据
        $apiParams = [
        'id' => isset($params['id']) ? $params['id'] : null,
        'type_id' => isset($params['id']) ? $params['id'] : null,
        'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('wx-msg-get-detail', $apiParams);
    }
    

    /**
     * 获取可用的微信模板
     * @return mixed
     */
    public function findOptionalMsgTpl($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'to_user' => isset($params['to_user']) ? $params['to_user'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('wx-optional-msg-tpl-get', $apiParams);
    }

    /**
     * 获取已选模板列表
     * @return mixed
     */
    public function findMsgTpl($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'to_user' => isset($params['to_user']) ? $params['to_user'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('wx-msg-tpl-get', $apiParams);
    }

    /**
     * 获取已选操作员列表
     * @return mixed
     */
    public function findOptionalDefaultStaffList($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('wx-msg-optional-default-staff-get', $apiParams);
    }

    /**
     * 创建操作员
     * @return mixed
     */
    public function createDefaultStaff($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null
        ];

        $this->getResult('wx-msg-default-staff-create', $apiParams);
    }

    /**
     * 获取已选操作员列表
     * @return mixed
     */
    public function findDefaultStaffList($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('wx-msg-default-staff-get', $apiParams);
    }

    /**
     * 更新对应操作员
     * @return mixed
     */
    public function updateDefaultStaff($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null
        ];
        $this->getResult('wx-default-staff-update', $apiParams);
    }

    /**
     * 获取是否有对应的模板
     * @return mixed
     */
    public function getEnableMsgTpl($params)
    {
        //拿接口数据
        $apiParams = [
            'no' => isset($params['no']) ? $params['no'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('wx-msg-enable-tpl-get', $apiParams);
    }
    
    public function getMessageId($params)
    {
        //拿接口数据
        $apiParams = [       
        'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        'no' => isset($params['no']) ? $params['no'] : null
        ];
        $this->getResult('wx-msg-get-message-id', $apiParams);
    }
    
    /**
     * 获取场景消息数据
     * @param unknown $params
     */
    public function getMsgList($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'to_user' => isset($params['to_user']) ? $params['to_user'] : null,
            'module' => isset($params['module']) ? $params['module'] : null,
            'is_show' => isset($params['is_show']) ? $params['is_show'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
        ];       
        $this->getResult('wx-msg-get-msg-tpl-list', $apiParams);
    }
    
    /**
     * 获取场景消息数据
     * @param unknown $params
     */
    public function getDetail($params)
    {
        //拿接口数据
        $apiParams = [
        'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        'id' => isset($params['id']) ? $params['id'] : null,
        'type_id' => isset($params['type_id']) ? $params['type_id'] : null,
        ];
        $this->getResult('wx-msg-get-detail', $apiParams);
    }
    
    /**
     * 获取场景消息数据
     * @param unknown $params
     */
    public function setState($params)
    {
        //拿接口数据
        $apiParams = [
        'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        'id' => isset($params['id']) ? $params['id'] : null,
        'type_id' => isset($params['type_id']) ? $params['type_id'] : null,
        'state' => isset($params['state']) ? $params['state'] : null,
        ];
        $this->getResult('wx-msg-set-message-state', $apiParams);
    }
    
    public function updateMsg($params)
    {
        //拿接口数据
        $apiParams = [
        'id' => isset($params['id']) ? $params['id'] : null,
        'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        'type_id' => isset($params['type_id']) ? $params['type_id'] : null,
        'send_type' => isset($params['send_type']) ? $params['send_type'] : null,
        'send_by_sms' => isset($params['send_by_sms']) ? $params['send_by_sms'] : null,
        'header' => isset($params['header']) ? $params['header'] : null,
        'footer' => isset($params['footer']) ? $params['footer'] : null,
        'mp_id' => isset($params['mp_id']) ? $params['mp_id'] : null,
        ];
        $this->getResult('wx-msg-update-message', $apiParams,false);
    }
    
    public function addShopReceive($params)
    {
        //拿接口数据
        $apiParams = [
        'id' => isset($params['id']) ? $params['id'] : null,
        'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        'send_to_operator' => isset($params['send_to_operator']) ? $params['send_to_operator'] : null,
        'send_to_staff' => isset($params['send_to_staff']) ? $params['send_to_staff'] : null,
        'send_to_belong_to_staff' => isset($params['send_to_belong_to_staff']) ? $params['send_to_belong_to_staff'] : null,
        'operator_ids' => isset($params['operator_ids']) ? $params['operator_ids'] : null,
        'staff_ids' => isset($params['staff_ids']) ? $params['staff_ids'] : null,
        'belong_to_staff_ids' => isset($params['belong_to_staff_ids']) ? $params['belong_to_staff_ids'] : null,
        ];
        $this->getResult('wx-msg-add-shop-receive', $apiParams);
    }
    
    public function addShopReceiveByUser($params)
    {
        //拿接口数据
        $apiParams = [
        'id' => isset($params['id']) ? intval($params['id']) : null,
        'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,        
        'uid' => isset($params['uid']) ? $params['uid'] : null,
        ];
        $this->getResult('wx-msg-add-shop-receive-by-user', $apiParams);
    }
    
    public function addShopReceiveByUserAndAuth($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'username' => isset($params['username']) ? $params['username'] : null,
            'password' => isset($params['password']) ? $params['password'] : null,
        ];
        $this->getResult('wx-msg-add-shop-receive-by-user-and-auth', $apiParams);
    }
    
    public function setShopReceive($params)
    {
        //拿接口数据
        $apiParams = [
        'id' => isset($params['id']) ? $params['id'] : null,
        'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        'send_to_operator' => isset($params['send_to_operator']) ? $params['send_to_operator'] : null,
        'send_to_staff' => isset($params['send_to_staff']) ? $params['send_to_staff'] : null,
        'send_to_belong_to_staff' => isset($params['send_to_belong_to_staff']) ? $params['send_to_belong_to_staff'] : null,
        'operator_ids' => isset($params['operator_ids']) ? $params['operator_ids'] : null,
        'staff_ids' => isset($params['staff_ids']) ? $params['staff_ids'] : null,
        'belong_to_staff_ids' => isset($params['belong_to_staff_ids']) ? $params['belong_to_staff_ids'] : null,
        ];
        $this->getResult('wx-msg-set-shop-receive', $apiParams);
    }
    
    public function deleteShopReceive($params)
    {
        //拿接口数据
        $apiParams = [
        'id' => isset($params['id']) ? $params['id'] : null,
        'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        'operator_ids' => isset($params['operator_ids']) ? $params['operator_ids'] : null,
        'staff_ids' => isset($params['staff_ids']) ? $params['staff_ids'] : null,
        'belong_to_staff_ids' => isset($params['belong_to_staff_ids']) ? $params['belong_to_staff_ids'] : null,
        ];
        $this->getResult('wx-msg-delete-shop-receive', $apiParams);
    }
    
    public function getShopReceive($params)
    {
        //拿接口数据
        $apiParams = [
        'id' => isset($params['id']) ? $params['id'] : null,
        'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        'type_id' => isset($params['type_id']) ? $params['type_id'] : null,
        ];
        $this->getResult('wx-msg-get-shop-receive', $apiParams);
    }
}
