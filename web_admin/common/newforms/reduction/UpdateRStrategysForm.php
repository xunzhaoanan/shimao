<?php
/**
 * Author: LiuPing
 * Date: 2016/05/16
 * Time: 13:30
 */

namespace common\newforms\reduction;

use common\newforms\BaseForm;

class UpdateRStrategysForm extends BaseForm
{
    public $reduction_id;
    public $reduction_conditions_id;
    public $reduction_type;
    public $amount;
    public $point;
    public $discount;
    public $reduction_type_id;
    public $is_all_area;
    public $area_id;
    public $area_cn;
    public $is_limit;

    public function rules()
    {
        return [
            [['reduction_id', 'reduction_type', 'is_all_area'], 'required'],
            [['reduction_id', 'reduction_conditions_id', 'reduction_type', 'amount', 'point', 'discount', 'reduction_type_id', 'is_all_area'], 'integer', 'min' => 1],
            [['area_id', 'area_cn'], 'safe']
        ];
    }
}