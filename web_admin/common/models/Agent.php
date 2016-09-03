<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\models;

use common\cache\Session;
use Yii;
use yii\base\Model;

/**
 * Agent model
 */
class Agent extends BaseModel
{
    //代理商统计
    const DATA_ORDER_SEARCH_TYPE_SHOP = 3;//按加盟店统计
    const DATA_ORDER_SEARCH_TYPE_AGENT = 4;//按代理商统计
    const DATA_ORDER_SEARCH_TYPE_STAFF = 5;//代理商员工

    /**
     * 代理商添加
     * @return mixed
     */
    public function create($params)
    {
        $apiParams = [
            'pid' => isset($params['pid']) ? $params['pid'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'user_name' => isset($params['user_name']) ? $params['user_name'] : null,
            'password' => isset($params['password']) ? $params['password'] : null,
            'real_name' => isset($params['real_name']) ? $params['real_name'] : null,
            'mobile' => isset($params['mobile']) ? $params['mobile'] : null,
            'email' => isset($params['email']) ? $params['email'] : null,
            'agent_name' => isset($params['agent_name']) ? $params['agent_name'] : null,
            'path' => isset($params['path']) ? $params['path'] : null,
            'area' => isset($params['area']) ? $params['area'] : null,
        ];
        $this->getResult('agent-create',$apiParams);
    }

    /**
     * 获取下级代理商列表
     * @return mixed
     */
    public function find($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'agent_name' => isset($params['name']) ? $params['name'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'nopid' => isset($params['nopid']) ? $params['nopid'] : null
        ];
        $this->getResult('agent-list',$apiParams);
    }

    /**
     * 获取全部代理商列表
     * @return mixed
     */
    public function findAll($params)
    {
        $this->getResult('agent-list-all',$params);
    }

    /**
     * 获取归属关系代理商列表
     * @return mixed
     */
    public function findBelong($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'agent_name' => isset($params['name']) ? $params['name'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'nopid' => isset($params['nopid']) ? $params['nopid'] : null,
            'belong_to_staff_id' => isset($params['belong_to_staff_id']) ? $params['belong_to_staff_id'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
        ];
        $this->getResult('agent-list-belong',$apiParams);
    }


    /**
     * 获取代理商
     * @return mixed
     */
    public function get($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
        ];
        $this->getResult('agent-get',$apiParams);
    }

    /**
     * 代理商更新
     * @return mixed
     */
    public function update($params, $is_reset_cache = true)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'user_name' => isset($params['user_name']) ? $params['user_name'] : null,
            'real_name' => isset($params['real_name']) ? $params['real_name'] : null,
            'role_id' => isset($params['role_id']) ? $params['role_id'] : null,
            'mobile' => isset($params['mobile']) ? $params['mobile'] : null,
            'email' => isset($params['email']) ? $params['email'] : null,
            'agent_name' => isset($params['agent_name']) ? $params['agent_name'] : null,
            'area' => isset($params['area']) ? $params['area'] : null,
        ];
        $this->getResult('agent-update',$apiParams);
        //重设代理商session
        if( is_null($this->getError()) && $is_reset_cache){
            Session::set(Session::SESSION_KEY_AGENT,$this->_data);
        }
    }

    /**
     * 修改登陆密码
     * @return mixed
     */
    public function pwdUpdate($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'old_pwd' => isset($params['old_pwd']) ? $params['old_pwd'] : null,
            'new_pwd' => isset($params['new_pwd']) ? $params['new_pwd'] : null,
        ];
        $this->getResult('agent-pwd-update',$apiParams);
    }

    /**
     * 管理员修改登陆密码
     * @return mixed
     */
    public function pwdManagerUpdate($params)
    {
        $apiParams = [
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'new_pwd' => isset($params['new_pwd']) ? $params['new_pwd'] : null,
        ];
        $this->getResult('agent-pwd-manager-update',$apiParams);
    }

    /**
     * 根据代理商统计订单
     * @return mixed
     */
    public function order($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'agent_ids' => isset($params['agent_ids']) ? $params['agent_ids'] : null,
            'search_type' => isset($params['search_type']) ? $params['search_type'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('agent-order',$apiParams);
    }

    /**
     * 根据代理商统计订单明细
     * @return mixed
     */
    public function orderDetail($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_staff_id' => isset($params['shop_staff_id']) ? $params['shop_staff_id'] : null,
            'agent_ids' => isset($params['agent_ids']) ? $params['agent_ids'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'search_type' => isset($params['search_type']) ? $params['search_type'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];

        $this->getResult('agent-order-by-agent',$apiParams);
    }

    /**
     * 根据代理商统计订单
     * @return mixed
     */
    public function orderCount($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'agent_ids' => isset($params['agent_ids']) ? $params['agent_ids'] : null,
            'search_type' => isset($params['search_type']) ? $params['search_type'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
        ];
        $this->getResult('agent-order-count',$apiParams);
    }

    /**
     * 统计下级代理商数量
     * 统计单个agent_id下的代理商总数
     * @param $params
     */
    public function countAgent($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'pid' => isset($params['pid']) ? $params['pid'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'sub_kind' => isset($params['sub_kind']) ? $params['sub_kind'] : null
        ];
        $this->getResult('agent-agent-count',$apiParams);
    }

    /**
     * 统计多个代理商直属下级代理商数量
     * array pid(可统计数组里存在的多个代领商的下级代理商总数)
     * @param $params
     */
    public function countAgentList($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'pid' => isset($params['pid']) ? $params['pid'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'sub_kind' => isset($params['sub_kind']) ? $params['sub_kind'] : null
        ];
        $this->getResult('agent-agent-count-list',$apiParams);
    }
}
