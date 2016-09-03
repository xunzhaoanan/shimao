<?php

namespace common\forms\shop;

use common\forms\BaseForm;

/**
 * Class FindSelfPickupSubForm
 * @package common\forms
 */
class FindSelfPickupSubForm extends BaseForm
{
    public $shop_type;
    public $name;
    public $province_id;
    public $city_id;
    public $district_id;
    public $count = 20;
    public $page = 0;
    public $sortStr;
    public $doFilter;
    public $search_all;

    public function rules()
    {
        return [
            [['province_id', 'city_id', 'district_id', 'page'], 'integer', 'min' => 0],
            [['name'], 'string', 'max' => 50],
            [['count'], 'integer', 'min' => 1, 'max' => 2000],
            [['sortStr'], 'safe'],
            [['doFilter', 'search_all'], 'safe'],
            [['shop_type'], 'in', 'range' => [1, 2]]
        ];
    }
}
