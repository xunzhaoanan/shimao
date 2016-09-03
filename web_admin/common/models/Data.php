<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\models;


/**
 * Agent model
 */
class Data extends BaseModel
{

    const DATA_ORDER_SEARCH_TYPE_SHOP = 1;
    const DATA_ORDER_SEARCH_TYPE_STAFF = 2;
    const DATA_ORDER_SEARCH_TYPE_AGENT = 3;

    const DATA_MEMBER_KIND_SHOP = 1;
    const DATA_MEMBER_KIND_STAFF = 2;
    const DATA_MEMBER_KIND_AGENT = 3;
    const DATA_MEMBER_KIND_FXMEMBER = 4;
    //推广统计模块
    const DATA_FX_KIND_SHOP = 1;
    const DATA_FX_KIND_STAFF = 2;
    const DATA_FX_KIND_AGENT = 3;
    const DATA_FX_KIND_FXMEMBER = 4;
    //推广统计类型
    const DATA_FX_SUM_PROFIT = 1;
    const DATA_FX_SUM_ORDER = 2;


    /**
     * 统计门店订单
     * @return mixed
     */
    public function order($params){
        //某个终端店
        if(isset($params['shop_sub_id']) && $params['shop_sub_id'] || isset($params['agent_ids']) && $params['agent_ids']){
            $params['shop_count_type'] = 1;
        }else{
            //整个商家的直营店
            $params['shop_count_type'] = 2;
        }
        $this->_order($params);
    }

    /**
     * 根据门店统计订单
     * @return mixed
     */
    public function _order($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'search_type' => isset($params['search_type']) ? $params['search_type'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'agent_ids' => isset($params['agent_ids']) ? $params['agent_ids'] : null,
            'shop_count_type' => isset($params['shop_count_type']) ? $params['shop_count_type'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'statement' => isset($params['statement']) ? $params['statement'] : null,
            'consignor_status' => isset($params['consignor_status']) ? $params['consignor_status'] : null,
            'order_type' => isset($params['order_type']) ? $params['order_type'] : null,
        ];
        $this->getResult('terminal-order', $apiParams);
    }

    /**
     * 根据门店统计订单总数
     * @return mixed
     */
    public function orderCount($params){
        //某个终端店
        if(isset($params['shop_sub_id']) && $params['shop_sub_id'] || isset($params['agent_ids']) && $params['agent_ids']){
            $params['shop_count_type'] = 1;
        }else{
            //整个商家的直营店
            $params['shop_count_type'] = 2;
        }
        $this->_orderCount($params);
    }

    /**
     * 根据门店统计订单总数
     * @return mixed
     */
    public function _orderCount($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'search_type' => isset($params['search_type']) ? $params['search_type'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
            'agent_ids' => isset($params['agent_ids']) ? $params['agent_ids'] : null,
            'shop_count_type' => isset($params['shop_count_type']) ? $params['shop_count_type'] : null,
            'statement' => isset($params['statement']) ? $params['statement'] : null,
            'order_type' => isset($params['order_type']) ? $params['order_type'] : null,
            'consignor_status' => isset($params['consignor_status']) ? $params['consignor_status'] : null,
        ];
        $this->getResult('terminal-order-count',$apiParams);
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
     * 根据门店统计会员
     * @return mixed
     */
    public function member($params){
        //某个终端店
        if(isset($params['shop_sub_id']) && $params['shop_sub_id'] || isset($params['agent_ids']) && $params['agent_ids']){
            $params['shop_count_type'] = 1;
        }else{
            //整个商家的直营店
            $params['shop_count_type'] = 2;
        }
        $this->_member($params);
    }

    /**
     * 根据门店统计会员
     * @return mixed
     */
    public function _member($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'shop_count_type' => isset($params['shop_count_type']) ? $params['shop_count_type'] : null,
            'agent_ids' => isset($params['agent_ids']) ? $params['agent_ids'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
            'start' => isset($params['start']) ? $params['start'] : null,
            'end' => isset($params['end']) ? $params['end'] : null,
            'is_subscribe' => isset($params['is_subscribe']) ? $params['is_subscribe'] : null,
            'group' => isset($params['group']) ? $params['group'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('terminal-member',$apiParams);
    }

    /**
     * 获取会员明细统计
     * @return mixed
     */
    public function memberDetail($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'shop_staff_id' => isset($params['shop_staff_id']) ? $params['shop_staff_id'] : null,
            'agent_id' => isset($params['agent_ids']) ? $params['agent_ids'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('terminal-member-detail',$apiParams);
    }

    /**
     * 根据门店统计会员总数
     * @return mixed
     */
    public function memberCount($params){
        //某个终端店
        if(isset($params['shop_sub_id']) && $params['shop_sub_id'] || isset($params['agent_ids']) && $params['agent_ids']){
            $params['shop_count_type'] = 1;
        }else{
            //整个商家的直营店
            $params['shop_count_type'] = 2;
        }
        $this->_memberCount($params);
    }

    /**
     * 根据门店统计会员总数
     * @return mixed
     */
    public function _memberCount($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'staff_id' => isset($params['shop_staff_id']) ? $params['shop_staff_id'] : null,
            'shop_count_type' => isset($params['shop_count_type']) ? $params['shop_count_type'] : null,
            'agent_ids' => isset($params['agent_ids']) ? $params['agent_ids'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
            'start' => isset($params['start']) ? $params['start'] : null,
            'end' => isset($params['end']) ? $params['end'] : null,
            'is_subscribe' => isset($params['is_subscribe']) ? $params['is_subscribe'] : null,
            'kind' => isset($params['group']) ? $params['group'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('terminal-member-count',$apiParams);
    }

    /**
     * 根据门店统计会员总数
     * @return mixed
     */
    public function fx($params){
        //某个终端店
        if(isset($params['shop_sub_id']) && $params['shop_sub_id'] || isset($params['agent_ids']) && $params['agent_ids'] || isset($params['staff_id']) && $params['staff_id']){
            $params['shop_count_type'] = 1;
        }else{
            //整个商家的直营店
            $params['shop_count_type'] = 2;
        }
        $this->_fx($params);
    }

    /**
     * 根据门店统计推广订单
     * @return mixed
     */
    public function _fx($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_count_type' => isset($params['shop_count_type']) ? $params['shop_count_type'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'agent_ids' => isset($params['agent_ids']) ? $params['agent_ids'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
            'start' => isset($params['createStart']) ? $params['createStart'] : null,
            'end' => isset($params['createEnd']) ? $params['createEnd'] : null,
            'group' => isset($params['group']) ? $params['group'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('terminal-fx',$apiParams);
    }

    /**
     * 根据门店统计会员总数
     * @return mixed
     */
    public function fxcount($params){
        //某个终端店
        if(isset($params['shop_sub_id']) && $params['shop_sub_id'] || isset($params['agent_ids']) && $params['agent_ids'] || isset($params['staff_id']) && $params['staff_id']){
            $params['shop_count_type'] = 1;
        }else{
            //整个商家的直营店
            $params['shop_count_type'] = 2;
        }
        $this->_fxCount($params);
    }

    /**
     * 推广订单总数、收益统计总数
     * @return mixed
     */
    public function _fxCount($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'shop_count_type' => isset($params['shop_count_type']) ? $params['shop_count_type'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'agent_ids' => isset($params['agent_ids']) ? $params['agent_ids'] : null,
            'mid' => isset($params['mid']) ? $params['mid'] : null,
            'start' => isset($params['start']) ? $params['start'] : null,
            'end' => isset($params['end']) ? $params['end'] : null,
            'kind' => isset($params['kind']) ? $params['kind'] : null,
            'sum' => isset($params['sum']) ? $params['sum'] : null
        ];
        $this->getResult('terminal-fx-count',$apiParams);
    }

    /**
     * 推广员总数
     * @return mixed
     */
    public function fxMemberCount($params){
        //某个终端店
        if(isset($params['shop_sub_id']) && $params['shop_sub_id'] || isset($params['agent_ids']) && $params['agent_ids'] || isset($params['staff_id']) && $params['staff_id']){
            $params['shop_count_type'] = 1;
        }else{
            //整个商家的直营店
            $params['shop_count_type'] = 2;
        }
        $this->_fxMemberCount($params);
    }

    /**
     * 推广员总数
     * @return mixed
     */
    public function _fxMemberCount($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'shop_count_type' => isset($params['shop_count_type']) ? $params['shop_count_type'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'agent_ids' => isset($params['agent_ids']) ? $params['agent_ids'] : null,
            //'start' => isset($params['start']) ? $params['start'] : null,
            //'end' => isset($params['end']) ? $params['end'] : null,
            'kind' => isset($params['kind']) ? $params['kind'] : null,
            'status' => isset($params['status']) ? $params['status'] : 2 //默认获取审核通过的
        ];
        $this->getResult('terminal-fx-member-count',$apiParams);
    }

    /**
     * 根据门店统计推广订单明细
     * @return mixed
     */
    public function fxDetail($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'shop_staff_id' => isset($params['shop_staff_id']) ? $params['shop_staff_id'] : null,
            'fx_member_id' => isset($params['fx_member_id']) ? $params['fx_member_id'] : null,
            'agent_ids' => isset($params['agent_ids']) ? $params['agent_ids'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('terminal-fx-detail',$apiParams);
    }

    /**
     * 根据门店统计推广订单明细
     * @return mixed
     */
    public function userPointCount($params){
        //拿接口数据
        $this->getResult('wxuser/count-user-point',$params);
    }
}
