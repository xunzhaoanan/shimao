<?php
/**
 * Author: Kevin
 * Date: 2015/08/13
 * Time: 15:00
 * 分销员
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * FxMember model
 */
class FxMember extends BaseModel
{

    public $type = [['id' => 0, 'name' => '全部'],['id' => 1, 'name' => '审核中'],['id' => 2, 'name' => '审核成功']];

    public $status = [
        ['id' => 0, 'name' => '全部状态'],
        ['id' => 1, 'name' => '未入账(未付款)'],
        ['id' => 2, 'name' => '未入账(待发货)'],
        ['id' => 3, 'name' => '未入账(待收货)'],
        ['id' => 7, 'name' => '未入账(异常关闭)'],
        ['id' => 5, 'name' => '未入账(已完成)'],
        ['id' => 4, 'name' => '已入账(已完成)']
    ];

    /**
     * 分销员添加
     * @return mixed
     */
    public function create($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'recommend_name' => isset($params['recommend_name']) ? $params['recommend_name'] : null,
            'real_name' => isset($params['real_name']) ? $params['real_name'] : null,
            'phone' => isset($params['phone']) ? $params['phone'] : null,
        ];
        $this->getResult('fx-member-create', $apiParams);
    }

    /**
     * 获取分销员列表
     * @return mixed
     */
    public function find($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['storeId']) ? $params['storeId'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'real_name' => isset($params['name']) ? $params['name'] : null,
            'status' => isset($params['typeId']) ? $params['typeId'] : null,
            'fx_level_id' => isset($params['memberId']) ? $params['memberId'] : null,
            'gt_overage' => isset($params['value']) ? $params['value'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('fx-member-list', $apiParams);
    }

    /**
     * 获取分销员列表
     * @return mixed
     */
    public function findBelong($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'real_name' => isset($params['name']) ? $params['name'] : null,
            'status' => isset($params['typeId']) ? $params['typeId'] : null,
            'fx_level_id' => isset($params['memberId']) ? $params['memberId'] : null,
            'gt_overage' => isset($params['value']) ? $params['value'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sorStr' => isset($params['sorStr']) ? $params['sorStr'] : null,
        ];
        $this->getResult('fx-member-list', $apiParams);
    }

    /**
     * 获取分销员会员列表
     * @return mixed
     */
    public function fansFind($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sorStr' => isset($params['sorStr']) ? $params['sorStr'] : null,
        ];
        $this->getResult('fx-member-fans-list', $apiParams);
    }

    /**
     * 获取分销员会员列表
     * @return mixed
     */
    public function fansFindBrokerage($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sorStr' => isset($params['sorStr']) ? $params['sorStr'] : null,
        ];
        $this->getResult('fx-member-fans-list-brokerage', $apiParams);
    }

    /**
     * 获取分销员
     * @return mixed
     */
    public function get($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
        ];
        $this->getResult('fx-member-get', $apiParams);
    }

    /**
     * 获取分销员订单数
     * @return mixed
     */
    public function getOrderCount($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
        ];
        // pr($apiParams);
        $this->getResult('fx-member-order-count', $apiParams);
    }

    /**
     * 获取分销员会员数
     * @return mixed
     */
    public function getFansCount($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
        ];
        //pr($apiParams);
        $this->getResult('fx-member-fans-count', $apiParams);
    }

    /**
     * 分销员更新
     * @return mixed
     */
    public function update($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
            'pay_id' => isset($params['pay_id']) ? $params['pay_id'] : null,
            'shop_theme' => isset($params['shop_theme']) ? $params['shop_theme'] : null,
            'fx_level_id' => isset($params['fx_level_id']) ? $params['fx_level_id'] : null,
            'content' => isset($params['content']) ? $params['content'] : null,
            'scene_id' => isset($params['scene_id']) ? $params['scene_id'] : null,
            'real_name' => isset($params['real_name']) ? $params['real_name'] : null,
            'pay_card' => isset($params['pay_card']) ? $params['pay_card'] : null,
            'subbranch' => isset($params['subbranch']) ? $params['subbranch'] : null,
            'shop_name' => isset($params['shop_name']) ? $params['shop_name'] : null,
            'payee' => isset($params['payee']) ? $params['payee'] : null,
            'x_brokerage' => isset($params['x_brokerage']) ? $params['x_brokerage'] : null,
            'x_order' => isset($params['x_order']) ? $params['x_order'] : null,
            'operator' => isset($params['operator']) ? $params['operator'] : null,
            'phone' => isset($params['phone']) ? $params['phone'] : null,
        ];
        $this->getResult('fx-member-update', $apiParams);
    }

    /**
     * 获取分销员会员余额
     * @return mixed
     */
    public function updateOverage($params)
    {
        $apiParams = [
            'overages' => isset($params['overages']) ? $params['overages'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_staff_id' => isset($params['shop_staff_id']) ? $params['shop_staff_id'] : null,
            'operator' => isset($params['operator']) ? $params['operator'] : null,
        ];
        $this->getResult('fx-member-overage', $apiParams);
    }


        /**
     * 分销员 启用
     * @return mixed
     */
    public function open($params)
    {
        $apiParams = [
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'operator' => isset($params['operator']) ? $params['operator'] : null,
        ];
        $this->getResult('fx-member-open', $apiParams);
    }

    /**
     * 分销员 禁用
     * @return mixed
     */
    public function close($params)
    {
        $apiParams = [
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'operator' => isset($params['operator']) ? $params['operator'] : null,
        ];
        $this->getResult('fx-member-close', $apiParams);
    }

    /**
     * 分销员 审核通过
     * @return mixed
     */
    public function reviewSuccess($params)
    {
        $apiParams = [
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'operator' => isset($params['operator']) ? $params['operator'] : null,
        ];
        $this->getResult('fx-member-review-success', $apiParams);
    }

    /**
     * 分销员 审核不通过
     * @return mixed
     */
    public function reviewFail($params)
    {
        $apiParams = [
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'operator' => isset($params['operator']) ? $params['operator'] : null,
        ];
        $this->getResult('fx-member-review-fail', $apiParams);
    }

    /**
     * 分销员 余额日志列表
     * @return mixed
     */
    public function overageLogList($params)
    {
        $apiParams = [
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'money_sign' => isset($params['money_sign']) ? $params['money_sign'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sorStr' => isset($params['sorStr']) ? $params['sorStr'] : null,
        ];

        $this->getResult('fx-member-overage-log-list', $apiParams);
    }

    /**
     * 分销员 获取微信头像
     * @return mixed
     */
    public function getSimple($params)
    {
        $apiParams = [
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        //pr($apiParams);
        $this->getResult('fx-member-simple-get', $apiParams);
    }

    /**
     * 分销员升级
     * @param $params
     */
    public function levelUp($params)
    {
        $apiParams = [
            'id' => isset($params['level_id']) ? $params['level_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'x_order' => isset($params['x_order']) ? $params['x_order'] : null,
            'x_brokerage' => isset($params['x_brokerage']) ? $params['x_brokerage'] : null,
            'operator' => isset($params['operator']) ? $params['operator'] : null,
        ];
        $this->getResult('fx-member-level-up', $apiParams);
    }

    /**
     * 创建日志
     * @param $params
     */
    public function createLog($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'operator' => isset($params['operator']) ? $params['operator'] : null,
            'content' => isset($params['content']) ? $params['content'] : null,
        ];
        $this->getResult('create-log', $apiParams);
    }

    /**
     * 分销员 访客列表
     * @return mixed
     */
    public function findVisitor($params)
    {
        $apiParams = [
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sorStr' => isset($params['sorStr']) ? $params['sorStr'] : null
        ];

        $this->getResult('fx-member-visitor-list', $apiParams);
    }

    /**
     * 分销员 会员列表
     * @return mixed
     */
    public function findMember($params)
    {
        $apiParams = [
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null,
            'member_id' => isset($params['member_id']) ? $params['member_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sorStr' => isset($params['sorStr']) ? $params['sorStr'] : null
        ];

        $this->getResult('fx-member-member-list', $apiParams);
    }

    /**
     * 新增或修改店员对应的分销员
     * @param $params
     */
    public function saveStaffToFxMember($params){
        $apiParams = [
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'agent_id' => isset($params['agent_id']) ? $params['agent_id'] : null
        ];

        $this->getResult('fx-member-save-by-staff', $apiParams);
    }


}
