<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\models;

use Yii;

/**
 * Staff model
 */
class Staff extends BaseModel
{
    //是否为核销员：是
    const IS_CANCEL_TRUE = 1;

    //是否为核销员：是
    const IS_CANCEL_FALSE = 2;

    /**
     * 员工添加
     * @return mixed
     */
    public function create($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'user_name' => isset($params['user_name']) ? $params['user_name'] : null,
            'password' => isset($params['password']) ? $params['password'] : null,
            'real_name' => isset($params['real_name']) ? $params['real_name'] : null,
            'role_id' => isset($params['role_id']) ? $params['role_id'] : null,
            'mobile' => isset($params['mobile']) ? $params['mobile'] : null,
            'email' => isset($params['email']) ? $params['email'] : null,
            'ewm_img' => isset($params['ewm_img']) ? $params['ewm_img'] : null,
            'scene_id' => isset($params['scene_id']) ? $params['scene_id'] : null,
            'path' => isset($params['path']) ? $params['path'] : null,
            'is_bind' => isset($params['is_bind']) ? $params['is_bind'] : null,
            'is_cancel' => isset($params['is_cancel']) ? $params['is_cancel'] : null,
            'is_super_cancel' => isset($params['is_super_cancel']) ? $params['is_super_cancel'] : null,
        ];
        $this->getResult('staff-create',$apiParams);
    }

    /**
     * 获取员工列表
     * @return mixed
     */
    public function find($params)
    {
        $this->getResult('staff-list',$params);
    }

    /**
     * 获取员工归属关系列表
     * @return mixed
     */
    public function findBelong($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'real_name' => isset($params['real_name']) ? $params['real_name'] : null,
            'role_id' => isset($params['role_id']) ? $params['role_id'] : null,
            'shop_type' => isset($params['shop_type']) ? $params['shop_type'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'is_bind' => isset($params['is_bind']) ? $params['is_bind'] : null,
            'is_default' => isset($params['is_default']) ? $params['is_default'] : null,
            'is_cancel' => isset($params['is_cancel']) ? $params['is_cancel'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
        ];
        $this->getResult('staff-list-belong',$apiParams);
    }

    /**
     * 获取员工
     * @return mixed
     */
    public function get($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
        ];
        $this->getResult('staff-get',$apiParams);
    }

    /**
     * 员工更新
     * @return mixed
     */
    public function update($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'user_name' => isset($params['user_name']) ? $params['user_name'] : null,
            'password' => isset($params['password']) ? $params['password'] : null,
            'real_name' => isset($params['real_name']) ? $params['real_name'] : null,
            'role_id' => isset($params['role_id']) ? $params['role_id'] : null,
            'mobile' => isset($params['mobile']) ? $params['mobile'] : null,
            'email' => isset($params['email']) ? $params['email'] : null,
            'ewm_img' => isset($params['ewm_img']) ? $params['ewm_img'] : null,
            'scene_id' => isset($params['scene_id']) ? $params['scene_id'] : null,
            'path' => isset($params['path']) ? $params['path'] : null,
            'is_scan_pay' => isset($params['is_scan_pay']) ? $params['is_scan_pay'] : null,
            'is_scan_refund' => isset($params['is_scan_refund']) ? $params['is_scan_refund'] : null,
        ];
        $this->getResult('staff-update',$apiParams);
    }

    /**
     * 员工更新
     * @return mixed
     */
    public function addScanCount($params)
    {
        $this->postDataOnly('staff-add-scan-count',$params);
    }

    /**
     * 员工 禁用
     * @return mixed
     */
    public function staffClose($params)
    {
        $apiParams = [
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('staff-close',$apiParams);
    }
    /**
     * 员工 启用
     * @return mixed
     */
    public function staffOpen($params)
    {
        $apiParams = [
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('staff-open',$apiParams);
    }

    /**
     * 修改登陆密码
     * @return mixed
     */
    public function pwdUpdate($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'new_pwd' => isset($params['new_pwd']) ? $params['new_pwd'] : null,
            'old_pwd' => isset($params['old_pwd']) ? $params['old_pwd'] : null,
        ];
        $this->getResult('staff-pwd-update',$apiParams);
    }

    /**
     * 管理员修改登陆密码
     * @return mixed
     */
    public function pwdManagerUpdate($params)
    {
        $apiParams = [
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'new_pwd' => isset($params['new_pwd']) ? $params['new_pwd'] : null,
        ];
        $this->getResult('staff-pwd-manager-update',$apiParams);
    }

    /**
     * 员工 删除
     * @return mixed
     */
    public function del($params)
    {
        $apiParams = [
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('staff-del',$apiParams);
    }

    /**
     * 绑定员工微信帐号
     * @return mixed
     */
    public function staffBind($params)
    {
        $apiParams = [
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('staff-enable',$apiParams);
    }
    /**
     * 取消绑定员工微信帐号
     * @return mixed
     */
    public function cancelBind($params){
        $apiParams = [
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('staff-disable',$apiParams);
    }

    /**
     * 获取未成为分销员或需要调整归属的员工帐号列表
     * @param $params
     */
    public function findStaffToFxMember($params){
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('staff-find-to-fx-member',$apiParams);
    }
}
