<?php
/**
 * Author: Kevin
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\export;

use common\forms\BaseForm;

/**
 * Class CategoryEditAjaxForm
 * @package common\forms
 */
class OrderForm extends BaseForm
{
    public $_status;
    public $createStart;
    public $createEnd;
    public $order_no;
    public $service_no;
    public $order_type;
    public $s_consignee;
    public $s_tel;
    public $pay_type;
    public $shop_sub_id;
    public $auto_get_params;
    public $agent_id;
    public $staff_id;
    public $pay_time_start;
    public $pay_time_end;
    public $total_price_min;
    public $total_price_max;
    public $user_name;
    public $express_type;
    public $after_sales_status;
    public $statement;
    public $consignor_status;
    public $pos_pin_code;
    public $ids;
    public $pos_flag;
    public $pickup_type;
    public $pickup_date_start;
    public $pickup_date_end;

    public function rules()
    {
        return [
            [['pos_flag','ids','pos_pin_code','_status', 'express_type', 'user_name', 'createStart', 'createEnd', 'order_no', 'service_no', 'order_type', 'pay_type', 's_tel', 's_consignee', 'shop_sub_id', 'agent_id', 'auto_get_params', 'staff_id', 'pay_time_start', 'pay_time_end', 'total_price_min', 'total_price_max', 'statement', 'consignor_status', 'after_sales_status', 'pickup_type'], 'safe'],
            [['pickup_date_start', 'pickup_date_end'], 'integer', 'min' => 0]
        ];
    }
}