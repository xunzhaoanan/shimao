<?php

namespace common\newforms\members;

use common\newforms\BaseForm;
use common\newservices\Member;

class DiscountedProductSettingsForm extends BaseForm
{

    public $member_discounted_product_type;
    public $sku;
    public $sku_del;

    public function beforeValidate()
    {
        //sku必须是数字合集
        if ($this->sku && !is_array($this->sku)) return false;
        if ($this->sku_del && !is_array($this->sku_del)) return false;

        if ($this->sku) {
            foreach ($this->sku as $v) {
                if (!ctype_digit(strval($v))) return false;
            }
        }
        if ($this->sku_del) {
            foreach ($this->sku_del as $v1) {
                if (!ctype_digit(strval($v1))) return false;
            }
        }

        return true;
    }

    public function rules()
    {
        return [
            [['member_discounted_product_type'], 'required'],
            [['member_discounted_product_type'], 'in', 'range' => [Member::DISCOUNTED_ALL_PRODUCT, Member::DISCOUNTED_PART_PRODUCT]],
            [['sku', 'sku_del'], 'safe'],
        ];
    }

}