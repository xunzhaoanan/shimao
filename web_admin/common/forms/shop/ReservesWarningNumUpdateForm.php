<?php

namespace common\forms\shop;

use common\forms\BaseForm;

/**
 * Class ReservesWarningNumUpdateForm
 * @package common\forms
 */
class ReservesWarningNumUpdateForm extends BaseForm
{
    public $reserves_warning_num;


    public function rules()
    {
        return [
            [['reserves_warning_num'], 'safe']
        ];
    }
}
