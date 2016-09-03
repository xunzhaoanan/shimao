<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class FindMemberOrderListForm extends BaseForm
{
    public $shop_sub_id;
    public $count = 20;
    public $page = 0;
    public $sortStr;

    public $order_no;
    public $user_name;
    public $real_name;
    public $uid;
    public $order_status;
    public $deliver_status;
    public $after_sales_status;
    public $order_type;
    public $createStart;
    public $createEnd;
    public $modifyStart;
    public $modifyEnd;
    public $pay_time_start;
    public $pay_time_end;
    public $total_price_min;
    public $total_price_max;
    public $s_tel;
    public $s_consignee;
    public $ids;
    public $pay_type;
    public $pos_pin_code;

    public $agent_id;
    public $agent_path;
    public $shop_staff_id;

    public $order_status_in;
    public $deliver_status_in;
    public $is_refund;//是否进行退款的订单
    public $is_cod;
    public $wait_send_flag;//待发货
    public $after_sales_flag;//售后相关
    public $get_refund;//获取退款信息
    public $pos_flag;
    public $express_type;

    public $statement;//对账单
    public $consignor_status;//总店或分店发货

    public $bind_mobile;

    public $doFilter;

    public function rules()
    {
        return [
            [['uid', 'page', 'order_status', 'deliver_status', 'after_sales_status', 'createStart', 'createEnd', 'modifyStart', 'modifyEnd', 'is_cod','pay_time_start','pay_time_end','total_price_min','total_price_max'], 'integer', 'min' => 0],
            [['count'], 'integer', 'min' => 1, 'max' => 2000],
            [['sortStr', 'order_status_in', 'deliver_status_in', 'doFilter', 'ids'], 'safe'],
            [['order_no', 'user_name', 'real_name'], 'string', 'max' => 50],
            [['s_tel', 's_consignee', 'bind_mobile'], 'string', 'max' => 20],
            [['agent_path'], 'string', 'max' => 250],
            [['pos_pin_code'], 'string', 'max' => 64],
            [['is_refund', 'wait_send_flag', 'after_sales_flag', 'get_refund', 'pos_flag'], 'boolean'],
            [['shop_staff_id','shop_sub_id','agent_id','order_type','pay_type','statement','consignor_status','express_type'], 'safe'],
        ];
    }

}