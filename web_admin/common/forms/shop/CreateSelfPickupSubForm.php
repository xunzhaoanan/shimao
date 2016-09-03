<?php

namespace common\forms\shop;

use common\forms\BaseForm;

/**
 * Class CreateSelfPickupSubForm
 * @package common\forms
 */
class CreateSelfPickupSubForm extends BaseForm
{
    public $shop_sub_id;

    public function beforeValidate()
    {
        //分店id必须是数字集合
        if (!is_array($this->shop_sub_id)) return false;

        foreach ($this->shop_sub_id as $v) {
            if (!ctype_digit(strval($v))) return false;
        }

        return true;
    }

    public function rules()
    {
        return [
            [['shop_sub_id'], 'required'],
            [['shop_sub_id'], 'safe']
        ];
    }
}
