<?php
/**
 * Author: LiuPing
 * Date: 2016/05/16
 * Time: 13:30
 */

namespace common\newforms\reduction;

use common\newforms\BaseForm;

class CreateRStrategysForm extends BaseForm
{
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
            [['reduction_type', 'is_all_area'], 'required'],
            [['amount', 'point', 'discount', 'is_limit', 'area_id', 'area_cn', 'reduction_type_id'], 'safe']
        ];
    }
}