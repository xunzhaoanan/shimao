<?php
/**
 * Author: ChenZiYang
 * Date: 2015/07/30
 * Time: 10:10
 */

namespace common\models;

use common\cache\Session;
use Yii;
use yii\base\Model;

/**
 * shop model
 */
class Cancel extends BaseModel
{

    const IS_CANCEL = 1;
    const IS_NOT_CANCEL = 2;


    /**
     * 绑定员工微信帐号
     * @return mixed
     */
    public function bindStaffUser($params){
        //拿接口数据
        $apiParams = [
            'user_name' => isset($params['user_name']) ? $params['user_name'] : null,
            'pwd' => isset($params['pwd']) ? $params['pwd'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        //pr($apiParams);
        $this->getResult('cancel-bind-staff-user',$apiParams);
    }


    /**
     * 取消绑定员工微信帐号
     * @return mixed
     */
    public function cancelStaffUserBind($params){
        //拿接口数据
        $apiParams = [
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        //pr($apiParams);
        $this->getResult('cancel-cancel-staff-user-bind',$apiParams);
    }

    /**
     * 创建核销员
     * @return mixed
     */
    public function createCancelMember($params){
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('cancel-create-cancel-member',$apiParams);
    }

    /**
     * 修改核销员信息
     * @return mixed
     */
    public function updateCancelMember($params){
        //拿接口数据
        $apiParams = [
            'id' => isset($params['name']) ? $params['name'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('cancel-update-cancel-member',$apiParams);
    }


    /**
     * 获取核销员详情
     * @return mixed
     */
    public function getCancelMember($params){
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
        ];
        $this->getResult('cancel-get-cancel-member',$apiParams);
    }

    /**
     * 获取核销员列表
     * @return mixed
     */
    public function findCancelMember($params){
        //拿接口数据
        $apiParams = [
            'name' => isset($params['name']) ? $params['name'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'is_cancel' => isset($params['is_cancel']) ? $params['is_cancel'] : null,
        ];
        $this->getResult('cancel-find-cancel-member',$apiParams);
    }

    /**
     * 启用核销员
     * @return mixed
     */
    public function enableCancelMember($params){
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        //pr($apiParams);
        $this->getResult('cancel-enable-cancel-member',$apiParams);
    }

    /**
     * 启用/禁用核销员
     * @return mixed
     */
    public function disableCancelMember($params){
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        //pr($apiParams);
        $this->getResult('cancel-disable-cancel-member',$apiParams);
    }


    /**
     * 删除核销员
     * @return mixed
     */
    public function delCancelMember($params){
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        //pr($apiParams);
        $this->getResult('cancel-del-cancel-member',$apiParams);
    }

    /**
     * 获取核销列表
     * @return mixed
     */
    public function getCancelRecords($params){
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'cancel_type' => isset($params['cancel_type']) ? $params['cancel_type'] : null,
            'cancel_id' => isset($params['cancel_id']) ? $params['cancel_id'] : null,
            'cancel_member_id' => isset($params['cancel_member_id']) ? $params['cancel_member_id'] : null,
            'code' => isset($params['code']) ? $params['code'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('cancel-get-cancel-records',$apiParams);
    }

    /**
     * 获取核销列表
     * @return mixed
     */
    public function findCancelRecords($params){
        //拿接口数据
        $apiParams = [
            'cancel_type' => isset($params['cancel_type']) ? $params['cancel_type'] : null,
            'cancel_id' => isset($params['cancel_id']) ? $params['cancel_id'] : null,
            'cancel_member_id' => isset($params['cancel_member_id']) ? $params['cancel_member_id'] : null,
            'code' => isset($params['code']) ? $params['code'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
            'code' => isset($params['code']) ? $params['code'] : null,
        ];
        $this->getResult('cancel-find-cancel-records',$apiParams);
    }

    /**
     * 获取员工核销排行榜
     * @return mixed
     */
    public function findStaffList($params){
        //拿接口数据
        $apiParams = [
            'cancel_type' => isset($params['cancel_type']) ? $params['cancel_type'] : null,
            'cancel_id' => isset($params['cancel_id']) ? $params['cancel_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
        ];
        $this->getResult('cancel-staff-list',$apiParams);
    }

    /**
     * 获取门店核销排行榜
     * @return mixed
     */
    public function findShopsubList($params){
        //拿接口数据
        $apiParams = [
            'cancel_type' => isset($params['cancel_type']) ? $params['cancel_type'] : null,
            'cancel_id' => isset($params['cancel_id']) ? $params['cancel_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
        ];
        $this->getResult('cancel-shopsub-list',$apiParams);
    }


}
